import { useState } from 'react'
import style from 'styled-components'

const StyleWrapper = style.div`
    font-family: Arial, sans-serif;
    width: 90%;
    margin: 0 auto;
    margin-top: 30px;
`;

const ElementWrap = style.div`
    margin-bottom: 20px;
`;

const ButtonStyle = style.button`
    background-color: #4CAF50;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    margin-right: 10px;
    font-size: 16px;
    transition: background-color 0.3s;

    &:hover {
        background-color: #45a049;
    }
`;

const ButtonStyleRed = style(ButtonStyle)`
    background-color: #f44336;

    &:hover {
        background-color: #da190b;
    }
`;

const LabelStyle = style.label`
    display: flex;
    align-items: center;
    cursor: pointer;
    font-size: 16px;
    color: #333;
    user-select: none;

    input {
        margin-right: 10px;
    }
`;

const TitleStyle = style.h1`
    font-size: 24px;
    text-align: center;
    color: #333;
`;

const App = () => {
    return (
        <StyleWrapper>
            <Counter />
            <MyCheckBox />
            <MyInput />
            <Form />
        </StyleWrapper>
    )
}

import PropTypes from 'prop-types';

const Title = ({ children }) => {
    return <TitleStyle>{children}</TitleStyle>
}

const Counter = () => {
    const [count, setCount] = useState(0);
    return (
        <ElementWrap>
            <Title>Counter App</Title>
            <p>Count: {count}</p>
            <ButtonStyle onClick={() => setCount(count + 1)}>Increment</ButtonStyle>
            <ButtonStyleRed onClick={() => setCount(count - 1)}>Decrement</ButtonStyleRed>
        </ElementWrap>
    )
}


const MyCheckBox = () => {
    const [liked, setLiked] = useState(true);

    function handleChange(e) {
        setLiked(e.target.checked);
    }

    return (
        <ElementWrap>
            <Title>Like Button</Title>
            <LabelStyle>
                <input
                    type='checkbox'
                    checked={liked}
                    onChange={handleChange}
                />
                I like this
            </LabelStyle>
            <p>You {liked ? 'liked' : 'did not like'} this.</p>
        </ElementWrap>
    )
}
Title.propTypes = {
    children: PropTypes.node.isRequired,
};

const MyInput = () => {
    const [text, setText] = useState('');

    function handleChange(e) {
        setText(e.target.value);
    }

    return (
        <ElementWrap>
            <Title>Input Field</Title>
            <input
                type='text'
                value={text}
                onChange={handleChange}
            />
            <p>You typed: {text}</p>
            <ButtonStyleRed onClick={() => setText('')}>Clear</ButtonStyleRed>
        </ElementWrap>
    );
}

const Form = () => {
    const [name, setName] = useState('');
    const [age, setAge] = useState(30);

    const handleClick = () => {
        setAge(age => age + 1);
        setAge(age => age + 1);
        setAge(age => age + 1);
    }

    const incrementAge = () => {
        setAge(age => age + 1);
    }

    return (
        <ElementWrap>
            <input
                value={name}
                onChange={e => setName(e.target.value)}
            />
            <button onClick={handleClick}>
                Increment Age
            </button>
            <p>Hello, {name}. You are {age}</p>
            <button onClick={() => {
                incrementAge();
                incrementAge();
                incrementAge();
                incrementAge();
                incrementAge();
            }}>
                Age+5
            </button>
        </ElementWrap>
    );
}


export default App
