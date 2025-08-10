package main

// HelloResponse はHelloエンドポイントのレスポンス構造体
type HelloResponse struct {
	Message string `json:"message"`
}

// CategoriesResponse はCategoriesエンドポイントのレスポンス構造体
type CategoriesResponse struct {
	Categories []string `json:"categories"`
}

// CalculatorResponse はCalculatorエンドポイントの成功レスポンス構造体
type CalculatorResponse struct {
	Result    float64 `json:"result"`
	Operation string  `json:"operation"`
}

// ErrorResponse はエラーレスポンス用の構造体
type ErrorResponse struct {
	Error string `json:"error"`
}

// CalculatorRequest はCalculatorエンドポイントのリクエストパラメータ
type CalculatorRequest struct {
	Operator string
	X        float64
	Y        float64
}
