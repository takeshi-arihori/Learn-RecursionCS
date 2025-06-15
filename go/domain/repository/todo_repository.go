package repository

import "recursion/domain/entity"

// TodoRepository はTodoエンティティの永続化を担当するインターフェース
type TodoRepository interface {
	GetAll() []entity.Todo
	GetByID(id int) (entity.Todo, bool)
	Save(todo entity.Todo) entity.Todo
	Update(todo entity.Todo) bool
	Delete(id int) bool
}
