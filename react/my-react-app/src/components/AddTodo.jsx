// AddTodo.jsx
import { useState } from "react";

export default function AddTodo({ onAddTodo }) {
  const [title, setTitle] = useState("");

  return (
    <div className="flex space-x-2">
      <input
        className="flex-1 px-4 py-2 border border-gray-300 rounded shadow focus:outline-none focus:ring-2 focus:ring-indigo-500"
        placeholder="Add todo"
        value={title}
        onChange={(e) => setTitle(e.target.value)}
      />
      <button
        className="px-4 py-2 bg-indigo-500 text-white rounded shadow hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
        onClick={() => {
          if (title.trim() !== "") {
            onAddTodo(title);
            setTitle("");
          }
        }}
      >
        Add
      </button>
    </div>
  );
}
