package inmemory

import (
	"recursion/domain/entity"
)

// InMemoryTodoRepository はインメモリでTodoRepositoryを実装
type InMemoryTodoRepository struct {
	todos  []entity.Todo
	nextID int
}

// NewInMemoryTodoRepository は新しいInMemoryTodoRepositoryを作成
func NewInMemoryTodoRepository() *InMemoryTodoRepository {
	return &InMemoryTodoRepository{
		todos:  []entity.Todo{},
		nextID: 1,
	}
}

// GetAll は全てのTodoを取得
func (r *InMemoryTodoRepository) GetAll() []entity.Todo {
	return r.todos
}

// GetByID は指定IDのTodoを取得
func (r *InMemoryTodoRepository) GetByID(id int) (entity.Todo, bool) {
	for _, todo := range r.todos {
		if todo.ID == id {
			return todo, true
		}
	}
	return entity.Todo{}, false
}

// Save は新しいTodoを保存
func (r *InMemoryTodoRepository) Save(todo entity.Todo) entity.Todo {
	todo.ID = r.nextID
	r.todos = append(r.todos, todo)
	r.nextID++
	return todo
}

// Update はTodoを更新
func (r *InMemoryTodoRepository) Update(todo entity.Todo) bool {
	for i, t := range r.todos {
		if t.ID == todo.ID {
			r.todos[i] = todo
			return true
		}
	}
	return false
}

// Delete はTodoを削除
func (r *InMemoryTodoRepository) Delete(id int) bool {
	for i, todo := range r.todos {
		if todo.ID == id {
			// スライスから要素を削除
			r.todos = append(r.todos[:i], r.todos[i+1:]...)
			return true
		}
	}
	return false
}

// GetNextID は次のIDを取得
func (r *InMemoryTodoRepository) GetNextID() int {
	return r.nextID
}
