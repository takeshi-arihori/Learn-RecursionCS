import { Fragment } from "react";
import styled from "styled-components";

export const App = () => {
    return (
        <div>
            <List />
        </div>
    );
};

export default App;

const StyleWrap = styled.ul`
    display: flex;
    flex-direction: column;
    align-items: start;
`;

const StyleList = styled.li`
    list-style-type: none;
    margin: 10px 0;
`;

const people = [{
    id: 0,
    name: 'Creola Katherine Johnson',
    profession: 'mathematician',
}, {
    id: 1,
    name: 'Mario José Molina-Pasquel Henríquez',
    profession: 'chemist',
}, {
    id: 2,
    name: 'Mohammad Abdus Salam',
    profession: 'physicist',
}, {
    id: 3,
    name: 'Percy Lavon Julian',
    profession: 'chemist',
}, {
    id: 4,
    name: 'Subrahmanyan Chandrasekhar',
    profession: 'astrophysicist',
}];

export function List() {
    const listItems = people
        .filter(person => person.profession === 'chemist')
        .map(person => (
            <Fragment key={person.id}>
                <StyleList>
                    {person.name} : {person.profession}
                </StyleList>
            </Fragment>
        ));

    return <StyleWrap>{listItems}</StyleWrap>;
}
