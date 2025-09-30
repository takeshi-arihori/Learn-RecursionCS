#!/bin/bash

# RecursionCurriculum MySQLバックアップスクリプト

set -e

# カラー定義
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
CYAN='\033[0;36m'
NC='\033[0m' # No Color

# 設定
BACKUP_DIR="${BACKUP_DIR:-./backups}"
RETENTION_DAYS="${BACKUP_RETENTION_DAYS:-30}"
MYSQL_USER="${MYSQL_USER:-recursion_user}"
MYSQL_PASSWORD="${MYSQL_PASSWORD:-recursion_pass}"
MYSQL_DATABASE="${MYSQL_DATABASE:-recursion_db}"
MYSQL_ROOT_PASSWORD="${MYSQL_ROOT_PASSWORD:-root_password}"

# タイムスタンプ
TIMESTAMP=$(date +"%Y%m%d_%H%M%S")
BACKUP_FILE="${BACKUP_DIR}/recursion_db_${TIMESTAMP}.sql"
SCHEMA_FILE="${BACKUP_DIR}/recursion_db_schema_${TIMESTAMP}.sql"

echo -e "${CYAN}💾 RecursionCurriculum MySQLバックアップ開始${NC}"
echo "=========================================="

# バックアップディレクトリ作成
mkdir -p "$BACKUP_DIR"

# Dockerコンテナの実行確認
echo -e "${BLUE}🔍 MySQL コンテナ状態確認...${NC}"
if ! docker-compose ps mysql | grep -q "Up"; then
    echo -e "${RED}❌ MySQLコンテナが起動していません${NC}"
    echo -e "${YELLOW}💡 'make up' でコンテナを起動してください${NC}"
    exit 1
fi

echo -e "${GREEN}✅ MySQLコンテナが起動中です${NC}"

# データベース接続テスト
echo -e "\n${BLUE}🔌 データベース接続テスト...${NC}"
if ! docker-compose exec -T mysql mysql -u "$MYSQL_USER" -p"$MYSQL_PASSWORD" -e "SELECT 1;" >/dev/null 2>&1; then
    echo -e "${RED}❌ データベースに接続できません${NC}"
    echo -e "${YELLOW}💡 認証情報を確認してください${NC}"
    exit 1
fi

echo -e "${GREEN}✅ データベース接続成功${NC}"

# テーブル一覧表示
echo -e "\n${BLUE}📋 バックアップ対象テーブル:${NC}"
docker-compose exec -T mysql mysql -u "$MYSQL_USER" -p"$MYSQL_PASSWORD" "$MYSQL_DATABASE" -e "SHOW TABLES;" 2>/dev/null | grep -v Tables_in | sed 's/^/  - /'

# スキーマバックアップ（構造のみ）
echo -e "\n${YELLOW}🏗️  スキーマバックアップ作成中...${NC}"
if docker-compose exec -T mysql mysqldump \
    -u "$MYSQL_USER" \
    -p"$MYSQL_PASSWORD" \
    --no-data \
    --routines \
    --triggers \
    "$MYSQL_DATABASE" > "$SCHEMA_FILE"; then
    echo -e "${GREEN}✅ スキーマバックアップ完了: ${SCHEMA_FILE}${NC}"
else
    echo -e "${RED}❌ スキーマバックアップに失敗しました${NC}"
    exit 1
fi

# フルバックアップ（データ含む）
echo -e "\n${YELLOW}💾 フルバックアップ作成中...${NC}"
if docker-compose exec -T mysql mysqldump \
    -u "$MYSQL_USER" \
    -p"$MYSQL_PASSWORD" \
    --single-transaction \
    --routines \
    --triggers \
    --hex-blob \
    "$MYSQL_DATABASE" > "$BACKUP_FILE"; then
    echo -e "${GREEN}✅ フルバックアップ完了: ${BACKUP_FILE}${NC}"
else
    echo -e "${RED}❌ フルバックアップに失敗しました${NC}"
    exit 1
fi

# バックアップファイルサイズ確認
backup_size=$(ls -lh "$BACKUP_FILE" | awk '{print $5}')
schema_size=$(ls -lh "$SCHEMA_FILE" | awk '{print $5}')

echo -e "\n${CYAN}📊 バックアップ情報:${NC}"
echo -e "  フルバックアップ: ${backup_size}"
echo -e "  スキーマのみ: ${schema_size}"

# 圧縮バックアップ作成
echo -e "\n${YELLOW}🗜️  バックアップ圧縮中...${NC}"
gzip -c "$BACKUP_FILE" > "${BACKUP_FILE}.gz"
gzip -c "$SCHEMA_FILE" > "${SCHEMA_FILE}.gz"

if [ -f "${BACKUP_FILE}.gz" ] && [ -f "${SCHEMA_FILE}.gz" ]; then
    # 元ファイル削除
    rm "$BACKUP_FILE" "$SCHEMA_FILE"

    # 圧縮後サイズ確認
    compressed_backup_size=$(ls -lh "${BACKUP_FILE}.gz" | awk '{print $5}')
    compressed_schema_size=$(ls -lh "${SCHEMA_FILE}.gz" | awk '{print $5}')

    echo -e "${GREEN}✅ 圧縮完了${NC}"
    echo -e "  フルバックアップ: ${compressed_backup_size} (${BACKUP_FILE}.gz)"
    echo -e "  スキーマのみ: ${compressed_schema_size} (${SCHEMA_FILE}.gz)"
else
    echo -e "${RED}❌ 圧縮に失敗しました${NC}"
fi

# 古いバックアップファイル削除
echo -e "\n${YELLOW}🗑️  古いバックアップファイル削除中 (${RETENTION_DAYS}日以上前)...${NC}"
deleted_count=$(find "$BACKUP_DIR" -name "recursion_db_*.sql.gz" -mtime +$RETENTION_DAYS -delete -print | wc -l)

if [ "$deleted_count" -gt 0 ]; then
    echo -e "${GREEN}✅ ${deleted_count}個の古いファイルを削除しました${NC}"
else
    echo -e "${BLUE}ℹ️  削除対象の古いファイルはありませんでした${NC}"
fi

# バックアップ一覧表示
echo -e "\n${CYAN}📁 現在のバックアップファイル:${NC}"
ls -lht "$BACKUP_DIR"/recursion_db_*.sql.gz 2>/dev/null | head -5 | while read -r line; do
    echo -e "  ${line}"
done

# リストア方法の説明
echo -e "\n${CYAN}📖 リストア方法:${NC}"
echo -e "  ${YELLOW}# フルリストア${NC}"
echo -e "  gunzip -c ${BACKUP_FILE}.gz | docker-compose exec -T mysql mysql -u $MYSQL_USER -p$MYSQL_PASSWORD $MYSQL_DATABASE"
echo -e ""
echo -e "  ${YELLOW}# または Makefile使用${NC}"
echo -e "  make db-restore BACKUP_FILE=${BACKUP_FILE}.gz"

echo -e "\n${GREEN}🎉 バックアップ処理が完了しました！${NC}"

# バックアップ検証（オプション）
if [ "${VERIFY_BACKUP:-false}" = "true" ]; then
    echo -e "\n${YELLOW}🔍 バックアップ検証中...${NC}"

    # テスト用データベースに復元してテスト
    TEST_DB="recursion_db_backup_test"

    # テストDB作成
    docker-compose exec -T mysql mysql -u root -p"$MYSQL_ROOT_PASSWORD" -e "DROP DATABASE IF EXISTS $TEST_DB; CREATE DATABASE $TEST_DB;"

    # 復元テスト
    if gunzip -c "${BACKUP_FILE}.gz" | docker-compose exec -T mysql mysql -u root -p"$MYSQL_ROOT_PASSWORD" "$TEST_DB"; then
        # テーブル数比較
        original_tables=$(docker-compose exec -T mysql mysql -u "$MYSQL_USER" -p"$MYSQL_PASSWORD" "$MYSQL_DATABASE" -e "SHOW TABLES;" 2>/dev/null | grep -v Tables_in | wc -l)
        restored_tables=$(docker-compose exec -T mysql mysql -u root -p"$MYSQL_ROOT_PASSWORD" "$TEST_DB" -e "SHOW TABLES;" 2>/dev/null | grep -v Tables_in | wc -l)

        if [ "$original_tables" -eq "$restored_tables" ]; then
            echo -e "${GREEN}✅ バックアップ検証成功 (${original_tables}テーブル)${NC}"
        else
            echo -e "${RED}❌ バックアップ検証失敗 (元:${original_tables} vs 復元:${restored_tables})${NC}"
        fi
    else
        echo -e "${RED}❌ バックアップ検証失敗 (復元エラー)${NC}"
    fi

    # テストDB削除
    docker-compose exec -T mysql mysql -u root -p"$MYSQL_ROOT_PASSWORD" -e "DROP DATABASE IF EXISTS $TEST_DB;"
fi

echo -e "\n${CYAN}💾 バックアップ完了: $(date)${NC}"