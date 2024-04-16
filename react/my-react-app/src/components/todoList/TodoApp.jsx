import { useReducer, useState } from "react";
import todoReducer from "./reducer/todoReducer";

const initialState = {
    todos: [],
};

export const TodoApp = () => {
    const [state, dispatch] = useReducer(todoReducer, initialState);
    const [text, setText] = useState("");

    const handleSubmit = (e) => {
        e.preventDefault();
        if (!text.trim()) return;
        dispatch({ type: "add", text });
        setText("");
    };

    return (
        <div className="max-w-96 mx-auto mt-10 p-5 shadow-lg rounded-lg bg-white">
            <h1 className="text-lg font-bold text-center mb-4">Todo List</h1>
            <form onSubmit={handleSubmit} className="flex gap-2 mb-4">
                <input
                    type="text"
                    value={text}
                    onChange={(e) => setText(e.target.value)}
                    className="flex-1 p-2 border rounded border-gray-300"
                    placeholder="Add a new task"
                />
                <button
                    type="submit"
                    className="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                >
                    Add Todo
                </button>
            </form>
            <ul>
                {state.todos.map((todo) => (
                    <li
                        key={todo.id}
                        className="flex items-center justify-between mb-2 bg-gray-100 p-2 rounded shadow-sm"
                    >
                        <input
                            type="checkbox"
                            checked={todo.completed}
                            onChange={() =>
                                dispatch({ type: "toggle", id: todo.id })
                            }
                            className="mr-2"
                        />
                        <span
                            className={`flex-1 ${
                                todo.completed ? "line-through" : ""
                            }`}
                        >
                            {todo.text}
                        </span>
                        <button
                            onClick={() =>
                                dispatch({ type: "delete", id: todo.id })
                            }
                            className="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded"
                        >
                            Delete
                        </button>
                    </li>
                ))}
            </ul>
        </div>
    );
};

export default TodoApp;
