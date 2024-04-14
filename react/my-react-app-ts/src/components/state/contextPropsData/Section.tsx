import { useContext } from 'react';
import { LevelContext } from '../../context/LevelContext';

type SectionProps = {
    children: React.ReactNode;
};

const style = {
    section: {
        padding: '6px 10px',
        border: '2px solid #333',
        borderRadius: '0.5rem',
        opacity: 0.8,
    },
};

export default function Section({ children }: SectionProps) {
    const level = useContext(LevelContext);
    return (
        <section className="section" style={style.section}>
            <LevelContext.Provider value={level + 1}>
                {children}
            </LevelContext.Provider>
        </section>
    );
}
