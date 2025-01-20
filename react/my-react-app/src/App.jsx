import styled from "styled-components";
import PropTypes from "prop-types";

export const App = () => {
    return (
        <div>
            <PackingList />
        </div>
    );
};

const ListLayout = styled.li`
    list-style-type: none;
    display: flex;
    gap: 5px;
`;

Item.propTypes = {
    name: PropTypes.string.isRequired,
    isPacked: PropTypes.bool.isRequired,
};

export function Item({ name, isPacked }) {
    return (
        <ListLayout>
            {name} {isPacked ? "✅" : "❌"}
        </ListLayout>
    );
}

export function PackingList() {
    return (
        <section>
            <h1>Sally Ride&apos;s Packing List</h1>
            <ul>
                <Item isPacked={true} name="Space suit" />
                <Item isPacked={true} name="Helmet with a golden leaf" />
                <Item isPacked={false} name="Photo of Tam" />
                <Item isPacked={false} name="Telescope" />
            </ul>
        </section>
    );
}

export default App;
