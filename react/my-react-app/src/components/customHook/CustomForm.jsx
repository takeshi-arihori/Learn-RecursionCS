import { useState } from "react";

// カスタムフックを使ってフォームを作成
const useFormInput = (initialValue) => {
    const [value, setValue] = useState(initialValue);

    const handleChange = (e) => {
        setValue(e.target.value);
    };

    const inputProps = {
        value,
        onChange: handleChange,
    };

    return inputProps;
};

const Form = () => {
    // カスタムフックを使ってフォームの状態を管理
    const firstNameProps = useFormInput("Taro");
    const lastNameProps = useFormInput("Tanaka");

    return (
        <>
            <label>
                First Name:
                <input {...firstNameProps} />
            </label>
            <br />
            <label>
                Last Name:
                <input {...lastNameProps} />
            </label>
            <p>
                <b>
                    Good morning, {firstNameProps.value} {lastNameProps.value}.
                </b>
            </p>
        </>
    );
};

export default Form;
