import style from 'styled-components'
import UseStateLearn from './UseStateLearn';

const StyleWrapper = style.div`
    font-family: Arial, sans-serif;
    width: 90%;
    margin: 0 auto;
    margin-top: 30px;
`;

const App = () => {
    return (
        <StyleWrapper>
            <UseStateLearn />
        </StyleWrapper>
    )
}

export default App
