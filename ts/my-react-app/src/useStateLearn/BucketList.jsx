import { Title } from './UseStateLearn'
import { useImmer } from 'use-immer';
import PropTypes from 'prop-types';

// let nextId = 3;
const initialList = [
    { id: 0, title: 'Big Bellies', seen: false },
    { id: 1, title: 'Lunar Landscape', seen: false },
    { id: 2, title: 'Terracotta Army', seen: true },
];

export const ItemList = ({ artworks, onToggle }) => {
    return (
        <ul>
            {artworks.map(artwork => (
                <li key={artwork.id}>
                    <label>
                        <input
                            type="checkbox"
                            checked={artwork.seen}
                            onChange={e => {
                                onToggle(
                                    artwork.id,
                                    e.target.checked
                                );
                            }}
                        />
                        {artwork.title}
                    </label>
                </li>
            ))}
        </ul>
    );
}

export const BucketList = () => {
    const [list, updateList] = useImmer(initialList);

    function handleToggle(artworkId, nextSeen) {
        updateList(draft => {
            const artwork = draft.find(a =>
                a.id === artworkId
            );
            artwork.seen = nextSeen;
        });
    }

    return (
        <>
            <Title>Immer</Title>
            <h3>Art Bucket List</h3>
            <h4>My list of art to see:</h4>
            <ItemList
                artworks={list}
                onToggle={handleToggle}
            />
        </>
    )
}


ItemList.propTypes = {
    artworks: PropTypes.arrayOf(
        PropTypes.shape({
            id: PropTypes.number.isRequired,
            title: PropTypes.string.isRequired,
            seen: PropTypes.bool.isRequired,
        })
    ).isRequired,
    onToggle: PropTypes.func.isRequired,
};

export default BucketList