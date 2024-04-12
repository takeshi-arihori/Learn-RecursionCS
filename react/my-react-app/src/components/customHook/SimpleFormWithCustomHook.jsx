import { useState } from "react";

// カスタムフック
function useFormField(initialValue) {
    const [value, setValue] = useState(initialValue);

    const handleChange = (e) => {
        setValue(e.target.value);
    };

    return {
        value,
        onChange: handleChange,
    };
}

export const SimpleFormWithCustomHook = () => {
    const name = useFormField("");
    const email = useFormField("");

    const handleSubmit = (e) => {
        console.log(e);
        e.preventDefault();
        alert(`Name: ${name.value}, Email: ${email.value}`);
    };

    return (
        <form onSubmit={handleSubmit}>
            <input type="text" {...name} placeholder="Name" />
            <input type="email" {...email} placeholder="Email" />
            <button type="submit">Submit</button>
        </form>
    );
};

export default SimpleFormWithCustomHook;
