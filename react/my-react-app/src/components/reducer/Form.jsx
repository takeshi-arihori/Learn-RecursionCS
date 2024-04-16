import { useReducer } from "react";
import reducer from "./reducer.js";

const initialState = { name: "Taylor", age: 42 };

const Form = () => {
    const [state, dispatch] = useReducer(reducer, initialState);

    const handleButtonClick = () => {
        dispatch({ type: "incremented_age" });
    };

    const handleInputChange = (e) => {
        dispatch({
            type: "changed_name",
            nextName: e.target.value,
        });
    };

    return (
        <>
            <input value={state.name} onChange={handleInputChange} />
            <button onClick={handleButtonClick}>Increment age</button>
            <p>
                Hello, {state.name}. You are {state.age}
            </p>
        </>
    );
};

export default Form;
