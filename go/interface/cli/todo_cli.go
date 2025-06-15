package cli

import (
	"bufio"
	"fmt"
	"os"
	"recursion/domain/usecase"
	"strconv"
)

// TodoCLI はコマンドラインインターフェースを提供
type TodoCLI struct {
	todoUsecase *usecase.TodoUsecase
	scanner     *bufio.Scanner
}

// NewTodoCLI は新しいTodoCLIを作成
func NewTodoCLI(todoUsecase *usecase.TodoUsecase) *TodoCLI {
	return &TodoCLI{
		todoUsecase: todoUsecase,
		scanner:     bufio.NewScanner(os.Stdin),
	}
}

// Run はCLIを実行
func (cli *TodoCLI) Run() {
	for {
		fmt.Println("\nTODOアプリ")
		fmt.Println("1: タスク追加")
		fmt.Println("2: タスク完了")
		fmt.Println("3: タスク削除")
		fmt.Println("4: タスク一覧")
		fmt.Println("0: 終了")
		fmt.Print("選択してください: ")

		cli.scanner.Scan()
		choice := cli.scanner.Text()

		switch choice {
		case "1":
			cli.addTask()
		case "2":
			cli.completeTask()
		case "3":
			cli.deleteTask()
		case "4":
			cli.listTasks()
		case "0":
			fmt.Println("アプリを終了します")
			return
		default:
			fmt.Println("無効な選択です。もう一度試してください")
		}
	}
}

// addTask はタスクを追加
func (cli *TodoCLI) addTask() {
	fmt.Print("新しいタスクを入力: ")
	cli.scanner.Scan()
	task := cli.scanner.Text()

	// 現在のリポジトリ実装では、usecaseでnextIDを管理していないため、0を渡す
	// 実際のIDはリポジトリ側で割り当てられる
	todo := cli.todoUsecase.AddTask(task, 0)
	fmt.Printf("タスク追加: [%d] %s\n", todo.ID, todo.Task)
}

// completeTask はタスクを完了としてマーク
func (cli *TodoCLI) completeTask() {
	fmt.Print("完了するタスクのIDを入力: ")
	cli.scanner.Scan()
	id, err := strconv.Atoi(cli.scanner.Text())
	if err != nil {
		fmt.Println("有効な数値を入力してください")
		return
	}

	if cli.todoUsecase.CompleteTask(id) {
		fmt.Printf("タスク完了: [%d]\n", id)
	} else {
		fmt.Printf("ID %dのタスクは見つかりませんでした\n", id)
	}
}

// deleteTask はタスクを削除
func (cli *TodoCLI) deleteTask() {
	fmt.Print("削除するタスクのIDを入力: ")
	cli.scanner.Scan()
	id, err := strconv.Atoi(cli.scanner.Text())
	if err != nil {
		fmt.Println("有効な数値を入力してください")
		return
	}

	if cli.todoUsecase.DeleteTask(id) {
		fmt.Printf("タスク削除: [%d]\n", id)
	} else {
		fmt.Printf("ID %dのタスクは見つかりませんでした\n", id)
	}
}

// listTasks は全タスクを表示
func (cli *TodoCLI) listTasks() {
	todos := cli.todoUsecase.ListTasks()

	if len(todos) == 0 {
		fmt.Println("タスクはありません")
		return
	}

	fmt.Println("===== TODOリスト =====")
	for _, todo := range todos {
		status := " "
		if todo.Completed {
			status = "✓"
		}
		fmt.Printf("[%d] [%s] %s\n", todo.ID, status, todo.Task)
	}
	fmt.Println("====================")
}
