package main

import (
	"recursion/domain/usecase"
	"recursion/infrastructure/inmemory"
	"recursion/interface/cli"
)

func main() {
	// リポジトリの初期化
	todoRepo := inmemory.NewInMemoryTodoRepository()

	// ユースケースの初期化
	todoUsecase := usecase.NewTodoUsecase(todoRepo)

	// CLIの初期化と実行
	todoCLI := cli.NewTodoCLI(todoUsecase)
	todoCLI.Run()
}
