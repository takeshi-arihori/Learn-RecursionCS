package main

import (
	"encoding/json"
	"fmt"
	"net/http"
	"strconv"
)

// enableCORS はCORSヘッダーを設定する
func enableCORS(w http.ResponseWriter) {
	w.Header().Set("Access-Control-Allow-Origin", "*")
	w.Header().Set("Access-Control-Allow-Methods", "GET, POST, PUT, DELETE, OPTIONS")
	w.Header().Set("Access-Control-Allow-Headers", "Content-Type, Authorization")
}

// helloHandler handles /api/hello endpoint
func helloHandler(w http.ResponseWriter, r *http.Request) {
	// CORS設定
	enableCORS(w)

	// OPTIONSリクエストの処理
	if r.Method == "OPTIONS" {
		w.WriteHeader(http.StatusOK)
		return
	}

	// クエリパラメータを解析する
	query := r.URL.Query()
	name := query.Get("name")

	// nameが空の場合のデフォルト値
	if name == "" {
		name = "World"
	}

	// レスポンス用のマップを作成
	response := map[string]string{
		"message": "Hello " + name,
	}

	// Content-Typeヘッダーをapplication/jsonに設定
	w.Header().Set("Content-Type", "application/json")

	// マップをJSONにエンコードしてレスポンスとして送信
	json.NewEncoder(w).Encode(response)
}

// categoriesHandler handles /api/categories endpoint
func categoriesHandler(w http.ResponseWriter, r *http.Request) {
	// CORS設定
	enableCORS(w)

	// OPTIONSリクエストの処理
	if r.Method == "OPTIONS" {
		w.WriteHeader(http.StatusOK)
		return
	}

	// カテゴリの配列を定義
	categories := []string{
		"Technology",
		"Sports",
		"Music",
		"Food",
		"Travel",
		"Books",
		"Movies",
		"Gaming",
	}

	// レスポンス用の構造体
	response := map[string][]string{
		"categories": categories,
	}

	// Content-Typeヘッダーをapplication/jsonに設定
	w.Header().Set("Content-Type", "application/json")

	// JSONにエンコードしてレスポンスとして送信
	json.NewEncoder(w).Encode(response)
}

// calculatorHandler handles /api/calculator endpoint
func calculatorHandler(w http.ResponseWriter, r *http.Request) {
	// CORS設定
	enableCORS(w)

	// OPTIONSリクエストの処理
	if r.Method == "OPTIONS" {
		w.WriteHeader(http.StatusOK)
		return
	}

	// クエリパラメータを解析
	query := r.URL.Query()
	operator := query.Get("o")
	xStr := query.Get("x")
	yStr := query.Get("y")

	// Content-Typeヘッダーをapplication/jsonに設定
	w.Header().Set("Content-Type", "application/json")

	// パラメータの検証
	if operator == "" || xStr == "" || yStr == "" {
		sendErrorResponse(w, http.StatusBadRequest, "Missing required parameters: o, x, y")
		return
	}

	// 数値に変換
	x, err := strconv.ParseFloat(xStr, 64)
	if err != nil {
		sendErrorResponse(w, http.StatusBadRequest, "Invalid number for parameter x")
		return
	}

	y, err := strconv.ParseFloat(yStr, 64)
	if err != nil {
		sendErrorResponse(w, http.StatusBadRequest, "Invalid number for parameter y")
		return
	}

	var result float64
	var calculationError string

	// 演算を実行
	switch operator {
	case "+", "plus", "add":
		result = x + y
	case "-", "minus", "sub":
		result = x - y
	case "*", "multiply", "mul":
		result = x * y
	case "/", "divide", "div":
		if y == 0 {
			calculationError = "Division by zero is not allowed"
		} else {
			result = x / y
		}
	default:
		calculationError = "Unsupported operator. Use +, -, *, / or plus, minus, multiply, divide"
	}

	// エラーがある場合
	if calculationError != "" {
		sendErrorResponse(w, http.StatusBadRequest, calculationError)
		return
	}

	// 成功レスポンス
	response := map[string]interface{}{
		"result":    result,
		"operation": fmt.Sprintf("%.2f %s %.2f", x, operator, y),
	}
	json.NewEncoder(w).Encode(response)
}

// sendErrorResponse はエラーレスポンスを送信するヘルパー関数
func sendErrorResponse(w http.ResponseWriter, statusCode int, message string) {
	enableCORS(w) // エラーレスポンスにもCORS設定
	w.WriteHeader(statusCode)
	response := map[string]string{
		"error": message,
	}
	json.NewEncoder(w).Encode(response)
}
