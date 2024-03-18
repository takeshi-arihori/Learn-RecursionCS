// TaskList.jsx
import { useState } from "react";

export default function TaskList({ todos, onChangeTodo, onDeleteTodo }) {
  return (
    <ul className="divide-y divide-gray-200">
      {todos.map((todo) => (
        <li key={todo.id} className="p-3 hover:bg-gray-50">
          <Task todo={todo} onChange={onChangeTodo} onDelete={onDeleteTodo} />
        </li>
      ))}
    </ul>
  );
}

function Task({ todo, onChange, onDelete }) {
  const [isEditing, setIsEditing] = useState(false);

  let todoContent;
  if (isEditing) {
    todoContent = (
      <div className="flex items-center space-x-2">
        <input
          className="flex-1 px-4 py-2 border border-gray-300 rounded shadow focus:outline-none focus:ring-2 focus:ring-indigo-500"
          value={todo.title}
          onChange={(e) => onChange({ ...todo, title: e.target.value })}
        />
        <button
          className="px-4 py-2 bg-green-500 text-white rounded shadow hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2"
          onClick={() => setIsEditing(false)}
        >
          Save
        </button>
      </div>
    );
  } else {
    todoContent = (
      <div className="flex justify-between items-center">
        <span className={`${todo.done ? "line-through" : ""} flex-1`}>
          {todo.title}
        </span>
        <button
          className="px-4 py-2 bg-blue-500 text-white rounded shadow hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 ml-2"
          onClick={() => setIsEditing(true)}
        >
          Edit
        </button>
        <button
          className="px-4 py-2 bg-red-500 text-white rounded shadow hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 ml-2"
          onClick={() => onDelete(todo.id)}
        >
          Delete
        </button>
      </div>
    );
  }

  return (
    <div className="flex items-center space-x-2">
      <input
        type="checkbox"
        checked={todo.done}
        className="w-4 h-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500"
        onChange={(e) => onChange({ ...todo, done: e.target.checked })}
      />
      {todoContent}
    </div>
  );
}
