package main

import (
	"fmt"
	"net/http"
)

func main() {
	fmt.Println("Starting the server on port 8000!")

	// ルートとハンドラ関数を定義
	http.HandleFunc("/api/hello", helloHandler)
	http.HandleFunc("/api/categories", categoriesHandler)
	http.HandleFunc("/api/calculator", calculatorHandler)

	// 8000番ポートでサーバを開始
	fmt.Println("Server running at http://localhost:8000")
	fmt.Println("Available endpoints:")
	fmt.Println("  GET http://localhost:8000/api/hello?name=your_name")
	fmt.Println("  GET http://localhost:8000/api/categories")
	fmt.Println("  GET http://localhost:8000/api/calculator?o=+&x=10&y=5")

	err := http.ListenAndServe(":8000", nil)
	if err != nil {
		fmt.Printf("Server failed to start: %v\n", err)
	}
}
