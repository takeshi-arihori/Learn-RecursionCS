#!/bin/bash

# RecursionCurriculum 全プロジェクトテスト実行スクリプト

set -e

# カラー定義
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
CYAN='\033[0;36m'
NC='\033[0m' # No Color

# 実行開始時刻
start_time=$(date +%s)

echo -e "${CYAN}🧪 RecursionCurriculum 全プロジェクトテスト実行${NC}"
echo "=========================================="

# PHPプロジェクトリスト
projects=(
    "beginner/php"
    "intermediate/php"
    "advanced/php"
    "oop"
    "dynamic-web-server"
)

# テスト結果格納配列
declare -A test_results
total_tests=0
passed_tests=0
failed_tests=0

# 各プロジェクトのテスト実行
for project in "${projects[@]}"; do
    echo -e "\n${BLUE}📂 Testing: ${project}${NC}"
    echo "------------------------------------------"

    # composer.jsonの存在確認
    if [ ! -f "/workspace/${project}/composer.json" ]; then
        echo -e "${YELLOW}⚠️  composer.json が見つかりません。スキップします。${NC}"
        test_results[$project]="SKIPPED"
        continue
    fi

    # 依存関係の確認・インストール
    if [ ! -d "/workspace/${project}/vendor" ]; then
        echo -e "${YELLOW}📦 依存関係をインストール中...${NC}"
        if ! composer install --working-dir="/workspace/${project}" --no-interaction --quiet; then
            echo -e "${RED}❌ 依存関係のインストールに失敗しました${NC}"
            test_results[$project]="DEPENDENCY_ERROR"
            ((failed_tests++))
            continue
        fi
    fi

    # テストコマンドの存在確認
    if ! composer show --working-dir="/workspace/${project}" | grep -q "pestphp/pest\|phpunit/phpunit"; then
        echo -e "${YELLOW}⚠️  テストフレームワークが見つかりません。スキップします。${NC}"
        test_results[$project]="NO_TEST_FRAMEWORK"
        continue
    fi

    # テスト実行
    echo -e "${CYAN}🔬 テスト実行中...${NC}"
    ((total_tests++))

    # ログファイル準備
    log_file="/tmp/test_${project//\//_}.log"

    # テスト実行（出力をキャプチャ）
    if composer test --working-dir="/workspace/${project}" > "$log_file" 2>&1; then
        echo -e "${GREEN}✅ テスト成功${NC}"
        test_results[$project]="PASSED"
        ((passed_tests++))

        # 簡潔な結果表示
        if grep -q "tests.*assertions" "$log_file"; then
            result_line=$(grep "tests.*assertions" "$log_file" | tail -1)
            echo -e "${GREEN}   ${result_line}${NC}"
        elif grep -q "PASS" "$log_file"; then
            pass_count=$(grep -c "PASS" "$log_file" || echo "0")
            echo -e "${GREEN}   ${pass_count} tests passed${NC}"
        fi

    else
        echo -e "${RED}❌ テスト失敗${NC}"
        test_results[$project]="FAILED"
        ((failed_tests++))

        # エラーの詳細表示（最後の数行のみ）
        echo -e "${RED}エラー詳細:${NC}"
        tail -n 5 "$log_file" | sed 's/^/   /'
    fi

    # 一時ログファイル削除
    rm -f "$log_file"
done

# 実行終了時刻
end_time=$(date +%s)
duration=$((end_time - start_time))

echo -e "\n=========================================="
echo -e "${CYAN}📊 テスト実行結果サマリー${NC}"
echo "=========================================="

# 結果詳細表示
for project in "${projects[@]}"; do
    result=${test_results[$project]:-"NOT_EXECUTED"}
    case $result in
        "PASSED")
            echo -e "${GREEN}✅ ${project}: 成功${NC}"
            ;;
        "FAILED")
            echo -e "${RED}❌ ${project}: 失敗${NC}"
            ;;
        "SKIPPED")
            echo -e "${YELLOW}⏭️  ${project}: スキップ (composer.jsonなし)${NC}"
            ;;
        "NO_TEST_FRAMEWORK")
            echo -e "${YELLOW}⏭️  ${project}: スキップ (テストフレームワークなし)${NC}"
            ;;
        "DEPENDENCY_ERROR")
            echo -e "${RED}💥 ${project}: 依存関係エラー${NC}"
            ;;
        *)
            echo -e "${YELLOW}❓ ${project}: 未実行${NC}"
            ;;
    esac
done

echo ""
echo -e "実行プロジェクト数: ${BLUE}${total_tests}${NC}"
echo -e "成功: ${GREEN}${passed_tests}${NC}"
echo -e "失敗: ${RED}${failed_tests}${NC}"
echo -e "実行時間: ${YELLOW}${duration}秒${NC}"

# 終了コード設定
if [ $failed_tests -eq 0 ] && [ $total_tests -gt 0 ]; then
    echo -e "\n${GREEN}🎉 全テストが成功しました！${NC}"
    exit 0
elif [ $total_tests -eq 0 ]; then
    echo -e "\n${YELLOW}⚠️  実行可能なテストが見つかりませんでした${NC}"
    exit 1
else
    echo -e "\n${RED}💥 一部のテストが失敗しました${NC}"
    exit 1
fi