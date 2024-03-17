import React, { FC } from 'react';
import { EditButton } from './EditButton';

interface CardProps {
    isAdmin: boolean;
}

const style: React.CSSProperties = {
    margin: "8px",
    borderRadius: "8px",
    backgroundColor: "#e9dbd0",
    display: "flex",
    flexDirection: "column",
    justifyContent: "center",
    alignItems: "center",
};

export const Card: FC<CardProps> = () => {
    return (
        <div style={style}>
            <p>山田たろう</p>
            <EditButton />
        </div>
    );
};
