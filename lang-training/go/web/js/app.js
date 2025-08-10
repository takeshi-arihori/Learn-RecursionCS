// API Base URL
const API_BASE_URL = 'http://localhost:8000';

// DOM要素が読み込まれた後に実行
document.addEventListener('DOMContentLoaded', function () {
    // ページロード時にサーバー接続状況を確認
    checkServerStatus();
});

/**
 * Hello API を呼び出す
 */
async function callHelloAPI() {
    const nameInput = document.getElementById('nameInput');
    const responseElement = document.getElementById('helloResponse');
    const name = nameInput.value.trim();

    try {
        // ローディング表示
        responseElement.textContent = '🔄 API呼び出し中...';
        responseElement.className = '';

        // APIエンドポイントURL構築
        const url = `${API_BASE_URL}/api/hello${name ? `?name=${encodeURIComponent(name)}` : ''}`;

        // API呼び出し
        const response = await fetch(url);
        const data = await response.json();

        // レスポンス表示
        displayResponse(responseElement, data, response.ok);

    } catch (error) {
        displayError(responseElement, `接続エラー: ${error.message}`);
    }
}

/**
 * Categories API を呼び出す
 */
async function callCategoriesAPI() {
    const responseElement = document.getElementById('categoriesResponse');
    const categoriesListElement = document.getElementById('categoriesList');

    try {
        // ローディング表示
        responseElement.textContent = '🔄 API呼び出し中...';
        responseElement.className = '';
        categoriesListElement.innerHTML = '';

        // API呼び出し
        const response = await fetch(`${API_BASE_URL}/api/categories`);
        const data = await response.json();

        // レスポンス表示
        displayResponse(responseElement, data, response.ok);

        // カテゴリ一覧をカード形式で表示
        if (response.ok && data.categories) {
            displayCategoriesGrid(data.categories);
        }

    } catch (error) {
        displayError(responseElement, `接続エラー: ${error.message}`);
    }
}

/**
 * Calculator API を呼び出す
 */
async function callCalculatorAPI() {
    const numberX = document.getElementById('numberX').value;
    const numberY = document.getElementById('numberY').value;
    const operator = document.getElementById('operator').value;
    const responseElement = document.getElementById('calculatorResponse');
    const resultElement = document.getElementById('calculatorResult');

    try {
        // ローディング表示
        responseElement.textContent = '🔄 API呼び出し中...';
        responseElement.className = '';
        resultElement.innerHTML = '';

        // 入力値検証
        if (!numberX || !numberY) {
            displayError(responseElement, '数値を入力してください');
            return;
        }

        // APIエンドポイントURL構築
        const url = `${API_BASE_URL}/api/calculator?o=${encodeURIComponent(operator)}&x=${encodeURIComponent(numberX)}&y=${encodeURIComponent(numberY)}`;

        // API呼び出し
        const response = await fetch(url);
        const data = await response.json();

        // レスポンス表示
        displayResponse(responseElement, data, response.ok);

        // 計算結果を大きく表示
        if (response.ok && typeof data.result !== 'undefined') {
            displayCalculatorResult(data);
        }

    } catch (error) {
        displayError(responseElement, `接続エラー: ${error.message}`);
    }
}

/**
 * サーバー接続状況を確認
 */
async function checkServerStatus() {
    const statusElement = document.getElementById('serverStatus');
    const indicator = statusElement.querySelector('.status-indicator');
    const text = statusElement.querySelector('span:last-child');

    try {
        // シンプルなHello APIで接続確認
        const response = await fetch(`${API_BASE_URL}/api/hello`, {
            method: 'GET',
            timeout: 5000
        });

        if (response.ok) {
            indicator.className = 'status-indicator online';
            text.textContent = 'サーバー接続: オンライン ✅';
        } else {
            indicator.className = 'status-indicator offline';
            text.textContent = 'サーバー接続: エラー ❌';
        }
    } catch (error) {
        indicator.className = 'status-indicator offline';
        text.textContent = 'サーバー接続: オフライン ❌';
    }
}

/**
 * レスポンスを表示する共通関数
 */
function displayResponse(element, data, isSuccess) {
    element.textContent = JSON.stringify(data, null, 2);
    element.className = isSuccess ? 'response-success' : 'response-error';
}

/**
 * エラーを表示する共通関数
 */
function displayError(element, message) {
    element.textContent = message;
    element.className = 'response-error';
}

/**
 * カテゴリ一覧をグリッド形式で表示
 */
function displayCategoriesGrid(categories) {
    const categoriesListElement = document.getElementById('categoriesList');

    categoriesListElement.innerHTML = categories
        .map(category => `<div class="category-item">${category}</div>`)
        .join('');
}

/**
 * 計算結果を大きく表示
 */
function displayCalculatorResult(data) {
    const resultElement = document.getElementById('calculatorResult');

    resultElement.innerHTML = `
        <div>🧮 計算結果: ${data.result}</div>
        <div style="font-size: 1rem; margin-top: 10px; opacity: 0.9;">
            ${data.operation || ''}
        </div>
    `;
}

/**
 * Enter キーでのAPI呼び出しサポート
 */
document.getElementById('nameInput').addEventListener('keypress', function (e) {
    if (e.key === 'Enter') {
        callHelloAPI();
    }
});

document.getElementById('numberX').addEventListener('keypress', function (e) {
    if (e.key === 'Enter') {
        callCalculatorAPI();
    }
});

document.getElementById('numberY').addEventListener('keypress', function (e) {
    if (e.key === 'Enter') {
        callCalculatorAPI();
    }
});

/**
 * CORS エラー対応のためのヘルパー関数
 */
function enableCORSMode() {
    console.log('🌐 CORS モードが有効です。サーバー側でCORS設定を確認してください。');
}

// アプリケーション初期化
enableCORSMode();
