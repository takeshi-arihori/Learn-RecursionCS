import { useContext } from 'react';
import { LevelContext } from '../../context/LevelContext';

type HeadingProps = {
    children: React.ReactNode;
}

export default function Heading({ children }: HeadingProps) {
    const level = useContext(LevelContext);
    switch (level) {
        case 1:
            return <h1 className="text-6xl font-bold py-1">{children}</h1>;
        case 2:
            return <h2 className="text-5xl font-bold py-1">{children}</h2>;
        case 3:
            return <h3 className="text-4xl font-bold py-1">{children}</h3>;
        case 4:
            return <h4 className="text-3xl font-bold py-1">{children}</h4>;
        case 5:
            return <h5 className="text-2xl font-bold py-1">{children}</h5>;
        case 6:
            return <h6 className="text-xl font-bold py-1">{children}</h6>;
        default:
            throw Error('Unknown level: ' + level);
    }
}
