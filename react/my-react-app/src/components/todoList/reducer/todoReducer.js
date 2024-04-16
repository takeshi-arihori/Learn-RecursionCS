const todoReducer = (state, action) => {
    switch (action.type) {
        case 'add':
            return { todos: [...state.todos, { id: Date.now(), text: action.text, completed: false }] };
        case 'toggle':
            return {
                todos: state.todos.map(todo =>
                    todo.id === action.id ? { ...todo, completed: !todo.completed } : todo
                )
            };
        case 'delete':
            return { todos: state.todos.filter(todo => todo.id !== action.id) };
        default:
            throw new Error();
    }
};

export default todoReducer;