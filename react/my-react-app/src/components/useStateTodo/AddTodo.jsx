import { useState } from "react";
import PropTypes from 'prop-types';

export const AddTodo = ({ onAddTodo }) => {
    const [title, setTitle] = useState('');
    return (
        <>
            <input
                placeholder="Add todo"
                value={title}
                onChange={e => setTitle(e.target.value)}
            />
            <button
                onClick={() => {
                    setTitle('');
                    onAddTodo(title);
                }}>
                Add
            </button>
        </>
    )
}

AddTodo.propTypes = {
    onAddTodo: PropTypes.func.isRequired
}

export default AddTodo