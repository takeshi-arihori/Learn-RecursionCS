import style from 'styled-components';


export const ButtonStyle = style.button`
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

export const ButtonStyleRed = style(ButtonStyle)`
    background-color: #f44336;

    &:hover {
        background-color: #da190b;
    }
`;
