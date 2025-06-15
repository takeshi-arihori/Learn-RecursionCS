package usecase

import (
	"recursion/domain/entity"
	"recursion/domain/repository"
)

// TodoUsecase はTodoに関するアプリケーションロジックを実装
type TodoUsecase struct {
	repo repository.TodoRepository
}

// NewTodoUsecase は新しいTodoUsecaseを作成
func NewTodoUsecase(repo repository.TodoRepository) *TodoUsecase {
	return &TodoUsecase{
		repo: repo,
	}
}

// AddTask は新しいタスクを追加
func (u *TodoUsecase) AddTask(task string, nextID int) entity.Todo {
	todo := entity.Todo{
		ID:        nextID,
		Task:      task,
		Completed: false,
	}
	return u.repo.Save(todo)
}

// CompleteTask はタスクを完了としてマーク
func (u *TodoUsecase) CompleteTask(id int) bool {
	todo, exists := u.repo.GetByID(id)
	if !exists {
		return false
	}

	todo.Completed = true
	return u.repo.Update(todo)
}

// DeleteTask はタスクを削除
func (u *TodoUsecase) DeleteTask(id int) bool {
	return u.repo.Delete(id)
}

// ListTasks は全タスクを取得
func (u *TodoUsecase) ListTasks() []entity.Todo {
	return u.repo.GetAll()
}
