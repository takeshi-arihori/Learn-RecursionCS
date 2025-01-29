import { useState } from 'react'
import PropTypes from 'prop-types'

export const TaskList = ({
    todos,
    onChangeTodo,
    onDeleteTodo
}) => {
    return (
        <ul>
            {todos.map(todo => (
                <li key={todo.id}>
                    <Task
                        todo={todo}
                        onChange={onChangeTodo}
                        onDelete={onDeleteTodo}
                    />
                </li>
            ))}
        </ul>
    );
}

const Task = ({ todo, onChange, onDelete }) => {
    const [isEditing, setIsEditing] = useState(false);
    let todoContent;
    if (isEditing) {
        todoContent = (
            <>
                <input
                    value={todo.title}
                    onChange={e => {
                        onChange({
                            ...todo,
                            title: e.target.value
                        });
                    }} />
                <button onClick={() => setIsEditing(false)}>
                    Save
                </button>
            </>
        );
    } else {
        todoContent = (
            <>
                {todo.title}
                <button onClick={() => setIsEditing(true)}>
                    Edit
                </button>
            </>
        );
    }
    return (
        <label>
            <input
                type="checkbox"
                checked={todo.done}
                onChange={e => {
                    onChange({
                        ...todo,
                        done: e.target.checked
                    });
                }}
            />
            {todoContent}
            <button onClick={() => onDelete(todo.id)}>
                Delete
            </button>
        </label>
    );
}


TaskList.propTypes = {
    todos: PropTypes.array.isRequired,
    onChangeTodo: PropTypes.func.isRequired,
    onDeleteTodo: PropTypes.func.isRequired
}

Task.propTypes = {
    todo: PropTypes.object.isRequired,
    onChange: PropTypes.func.isRequired,
    onDelete: PropTypes.func.isRequired
}

export default TaskList