import { useState } from 'react'
import style from 'styled-components'
import TaskApp from './TaskApp';
import { ElementWrap } from '../css/Wrap';
import { ButtonStyle, ButtonStyleRed } from '../components/Button';

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

// Form Object
const FormObjectInner = style.div`
    display: flex;
    flex-direction: column;
    margin-bottom: 10px;
`;


import PropTypes from 'prop-types';

export const Title = ({ children }) => {
    return <TitleStyle>{children}</TitleStyle>
}

export const Counter = () => {
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


export const MyCheckBox = () => {
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

export const MyInput = () => {
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

export const Form = () => {
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
            <Title>Form</Title>
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

// フォーム
export const FormObject = () => {
    const [form, setForm] = useState({
        firstName: '',
        lastName: '',
        email: '',
    });

    return (
        <ElementWrap>
            <Title>Form Object</Title>
            <FormObjectInner>
                <label>
                    First name:
                    <input
                        value={form.firstName}
                        onChange={e => setForm({
                            ...form,
                            firstName: e.target.value
                        })}
                    />
                </label>
                <label>
                    Last name:
                    <input
                        value={form.lastName}
                        onChange={e => setForm({
                            ...form,
                            lastName: e.target.value
                        })}
                    />
                </label>
                <label>
                    Email:
                    <input
                        value={form.email}
                        onChange={e => setForm({
                            ...form,
                            email: e.target.value
                        })}
                    />
                </label>
            </FormObjectInner>
            <p>
                {form.firstName}{' '}
                {form.lastName}{' '}
                ({form.email})
            </p>
        </ElementWrap>
    );
}

// フォーム ネストされたオブジェクト
export const FormObjectNested = () => {
    const [person, setPerson] = useState({
        name: 'Niki de Saint Phalle',
        artwork: {
            title: 'Blue Nana',
            city: 'Hamburg',
            image: 'https://i.imgur.com/Sd1AgUOm.jpg',
        }
    });

    function handleNameChange(e) {
        setPerson({
            ...person,
            name: e.target.value
        })
    }

    function handleTitleChange(e) {
        setPerson({
            ...person,
            artwork: {
                ...person.artwork,
                title: e.target.value
            }
        });
    }

    function handleCityChange(e) {
        setPerson({
            ...person,
            artwork: {
                ...person.artwork,
                city: e.target.value
            }
        });
    }

    function handleImageChange(e) {
        setPerson({
            ...person,
            artwork: {
                ...person.artwork,
                image: e.target.value
            }
        });
    }

    return (
        <ElementWrap>
            <Title>Form Object Nested</Title>
            <label>
                Name:
                <input
                    value={person.name}
                    onChange={handleNameChange}
                />
            </label>
            <label>
                Title:
                <input
                    value={person.artwork.title}
                    onChange={handleTitleChange}
                />
            </label>
            <label>
                City:
                <input
                    value={person.artwork.city}
                    onChange={handleCityChange}
                />
            </label>
            <label>
                Image:
                <input
                    value={person.artwork.image}
                    onChange={handleImageChange}
                />
            </label>
            <p>
                <i>{person.artwork.title}</i>
                {' by '}
                {person.name}
                <br />
                (located in {person.artwork.city})
            </p>
            <img
                src={person.artwork.image}
                alt={person.artwork.title}
            />
        </ElementWrap>
    );
}

// リスト(配列)


// Immerで簡潔な更新オブジェクトを書く


export const UseStateLearn = () => {
    return (
        <ElementWrap>
            <Counter />
            <MyCheckBox />
            <MyInput />
            <Form />
            <FormObject />
            <FormObjectNested />
            <TaskApp />
        </ElementWrap>
    );
}


export default UseStateLearn;
