#!/bin/bash

# RecursionCurriculum 全プロジェクト品質チェックスクリプト

set -e

# カラー定義
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
CYAN='\033[0;36m'
BOLD='\033[1m'
NC='\033[0m' # No Color

# 実行開始時刻
start_time=$(date +%s)

echo -e "${BOLD}${CYAN}✨ RecursionCurriculum 品質チェック実行${NC}"
echo "=========================================="

# PHPプロジェクトリスト
projects=(
    "beginner/php"
    "intermediate/php"
    "advanced/php"
    "oop"
    "dynamic-web-server"
)

# チェック結果格納配列
declare -A format_results
declare -A phpstan_results
declare -A test_results

total_projects=0
passed_projects=0
failed_projects=0

# 各プロジェクトの品質チェック実行
for project in "${projects[@]}"; do
    echo -e "\n${BOLD}${BLUE}📂 Quality Check: ${project}${NC}"
    echo "------------------------------------------"

    # composer.jsonの存在確認
    if [ ! -f "/workspace/${project}/composer.json" ]; then
        echo -e "${YELLOW}⚠️  composer.json が見つかりません。スキップします。${NC}"
        continue
    fi

    ((total_projects++))
    project_failed=false

    # 依存関係の確認・インストール
    if [ ! -d "/workspace/${project}/vendor" ]; then
        echo -e "${YELLOW}📦 依存関係をインストール中...${NC}"
        if ! composer install --working-dir="/workspace/${project}" --no-interaction --quiet; then
            echo -e "${RED}❌ 依存関係のインストールに失敗しました${NC}"
            project_failed=true
        fi
    fi

    # 1. コードフォーマットチェック
    echo -e "${CYAN}🎨 コードフォーマットチェック...${NC}"
    if composer format:check --working-dir="/workspace/${project}" >/dev/null 2>&1; then
        echo -e "${GREEN}  ✅ フォーマット: OK${NC}"
        format_results[$project]="PASSED"
    else
        echo -e "${RED}  ❌ フォーマット: NG${NC}"
        echo -e "${YELLOW}     💡 'composer format' で修正できます${NC}"
        format_results[$project]="FAILED"
        project_failed=true
    fi

    # 2. PHPStan静的解析
    echo -e "${CYAN}🔍 PHPStan静的解析...${NC}"
    if composer analyze --working-dir="/workspace/${project}" >/dev/null 2>&1; then
        echo -e "${GREEN}  ✅ PHPStan: OK${NC}"
        phpstan_results[$project]="PASSED"
    else
        echo -e "${RED}  ❌ PHPStan: NG${NC}"
        echo -e "${YELLOW}     💡 型エラーを修正してください${NC}"
        phpstan_results[$project]="FAILED"
        project_failed=true
    fi

    # 3. テスト実行
    echo -e "${CYAN}🧪 テスト実行...${NC}"
    if composer test --working-dir="/workspace/${project}" >/dev/null 2>&1; then
        echo -e "${GREEN}  ✅ テスト: OK${NC}"
        test_results[$project]="PASSED"
    else
        echo -e "${RED}  ❌ テスト: NG${NC}"
        echo -e "${YELLOW}     💡 テストを修正してください${NC}"
        test_results[$project]="FAILED"
        project_failed=true
    fi

    # プロジェクト結果カウント
    if [ "$project_failed" = true ]; then
        ((failed_projects++))
        echo -e "${RED}💥 ${project}: 品質チェック失敗${NC}"
    else
        ((passed_projects++))
        echo -e "${GREEN}🎉 ${project}: 品質チェック成功${NC}"
    fi
done

# 実行終了時刻
end_time=$(date +%s)
duration=$((end_time - start_time))

echo -e "\n=========================================="
echo -e "${BOLD}${CYAN}📊 品質チェック結果サマリー${NC}"
echo "=========================================="

# 詳細結果表示
for project in "${projects[@]}"; do
    if [ ! -f "/workspace/${project}/composer.json" ]; then
        continue
    fi

    echo -e "\n${BOLD}${BLUE}📂 ${project}${NC}"

    # フォーマット結果
    case ${format_results[$project]:-"NOT_EXECUTED"} in
        "PASSED") echo -e "  🎨 フォーマット: ${GREEN}✅ OK${NC}" ;;
        "FAILED") echo -e "  🎨 フォーマット: ${RED}❌ NG${NC}" ;;
        *) echo -e "  🎨 フォーマット: ${YELLOW}❓ 未実行${NC}" ;;
    esac

    # PHPStan結果
    case ${phpstan_results[$project]:-"NOT_EXECUTED"} in
        "PASSED") echo -e "  🔍 PHPStan:     ${GREEN}✅ OK${NC}" ;;
        "FAILED") echo -e "  🔍 PHPStan:     ${RED}❌ NG${NC}" ;;
        *) echo -e "  🔍 PHPStan:     ${YELLOW}❓ 未実行${NC}" ;;
    esac

    # テスト結果
    case ${test_results[$project]:-"NOT_EXECUTED"} in
        "PASSED") echo -e "  🧪 テスト:      ${GREEN}✅ OK${NC}" ;;
        "FAILED") echo -e "  🧪 テスト:      ${RED}❌ NG${NC}" ;;
        *) echo -e "  🧪 テスト:      ${YELLOW}❓ 未実行${NC}" ;;
    esac
done

# 全体サマリー
echo -e "\n${BOLD}📈 全体統計${NC}"
echo "----------------------------------------"
echo -e "実行プロジェクト数: ${BLUE}${total_projects}${NC}"
echo -e "成功: ${GREEN}${passed_projects}${NC}"
echo -e "失敗: ${RED}${failed_projects}${NC}"
echo -e "実行時間: ${YELLOW}${duration}秒${NC}"

# 品質スコア計算
if [ $total_projects -gt 0 ]; then
    quality_score=$(( (passed_projects * 100) / total_projects ))
    echo -e "品質スコア: ${CYAN}${quality_score}%${NC}"

    # スコアに応じたメッセージ
    if [ $quality_score -eq 100 ]; then
        echo -e "\n${GREEN}🏆 完璧です！全プロジェクトが品質基準を満たしています${NC}"
    elif [ $quality_score -ge 80 ]; then
        echo -e "\n${GREEN}🎉 優秀です！品質スコアが80%以上です${NC}"
    elif [ $quality_score -ge 60 ]; then
        echo -e "\n${YELLOW}⚠️  改善が必要です。品質スコアが80%未満です${NC}"
    else
        echo -e "\n${RED}💥 大幅な改善が必要です。品質スコアが60%未満です${NC}"
    fi
fi

# 改善提案
if [ $failed_projects -gt 0 ]; then
    echo -e "\n${BOLD}${YELLOW}💡 改善提案${NC}"
    echo "----------------------------------------"

    # フォーマットエラーのあるプロジェクト
    format_failed=()
    for project in "${projects[@]}"; do
        if [ "${format_results[$project]}" = "FAILED" ]; then
            format_failed+=("$project")
        fi
    done

    if [ ${#format_failed[@]} -gt 0 ]; then
        echo -e "${CYAN}🎨 フォーマット修正:${NC}"
        for project in "${format_failed[@]}"; do
            echo -e "  make format # または cd ${project} && composer format"
        done
        echo ""
    fi

    # PHPStanエラーのあるプロジェクト
    phpstan_failed=()
    for project in "${projects[@]}"; do
        if [ "${phpstan_results[$project]}" = "FAILED" ]; then
            phpstan_failed+=("$project")
        fi
    done

    if [ ${#phpstan_failed[@]} -gt 0 ]; then
        echo -e "${CYAN}🔍 PHPStan修正:${NC}"
        echo -e "  各プロジェクトで型エラーを修正してください"
        echo -e "  詳細: cd <project> && composer analyze"
        echo ""
    fi

    # テストエラーのあるプロジェクト
    test_failed=()
    for project in "${projects[@]}"; do
        if [ "${test_results[$project]}" = "FAILED" ]; then
            test_failed+=("$project")
        fi
    done

    if [ ${#test_failed[@]} -gt 0 ]; then
        echo -e "${CYAN}🧪 テスト修正:${NC}"
        echo -e "  失敗したテストを修正してください"
        echo -e "  詳細: cd <project> && composer test"
        echo ""
    fi
fi

# CI/CD推奨設定
echo -e "\n${BOLD}${CYAN}🚀 CI/CD推奨設定${NC}"
echo "----------------------------------------"
echo -e "GitHub Actionsでの品質チェック自動化:"
echo -e "1. make quality をCI/CDパイプラインに追加"
echo -e "2. プルリクエスト時の自動チェック設定"
echo -e "3. 品質スコア80%未満でマージブロック"

echo -e "\n${CYAN}✨ 品質チェック完了: $(date)${NC}"

# 終了コード設定
if [ $failed_projects -eq 0 ] && [ $total_projects -gt 0 ]; then
    exit 0
elif [ $total_projects -eq 0 ]; then
    echo -e "\n${YELLOW}⚠️  チェック可能なプロジェクトが見つかりませんでした${NC}"
    exit 1
else
    exit 1
fi