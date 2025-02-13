import { useState } from "react"
import AddTodo from "../components/useStateTodo/AddTodo"
import TaskList from "../components/useStateTodo/TaskList"
import { Title } from "./UseStateLearn";

let nextId = 3;
const initialTodos = [
    {
        id: 1,
        title: 'Learn React',
        done: true
    },
    {
        id: 2,
        title: 'Learn TypeScript',
        done: false
    },
    {
        id: 3,
        title: 'Learn GraphQL',
        done: false
    }
];
export const TaskApp = () => {
    const [todos, setTodos] = useState(initialTodos);

    function handleAddTodo(title) {
        setTodos([
            ...todos,
            {
                id: nextId++,
                title,
                done: false
            }
        ]);
    }
    function handleChangeTodo(nextTodo) {
        setTodos(todos.map(t => {
            if (t.id === nextTodo.id) {
                return nextTodo;
            }
            return t;
        }));
    }

    function handleDeleteTodo(todoId) {
        setTodos(
            todos.filter(t => t.id !== todoId)
        )
    }
    return (
        <>
            <Title>List</Title>
            <AddTodo
                onAddTodo={handleAddTodo}
            />
            <TaskList
                todos={todos}
                onChangeTodo={handleChangeTodo}
                onDeleteTodo={handleDeleteTodo}
            />
        </>

    )
}

export default TaskApp