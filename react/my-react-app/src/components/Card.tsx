import { FC } from 'react';
import { EditButton } from './EditButton';

interface CardProps {
    isAdmin: boolean;
}

// styleオブジェクトに対してReact.CSSPropertiesを使用して型を明示的に指定
const style: React.CSSProperties = {
    width: "300px",
    height: "200px",
    margin: "8px",
    borderRadius: "8px",
    backgroundColor: "#e9dbd0",
    display: "flex",
    flexDirection: "column", // この値はReact.CSSPropertiesによって正しく型付けされます
    justifyContent: "center",
    alignItems: "center",
};

export const Card: FC<CardProps> = ({ isAdmin }) => {
    return (
        <div style={style}>
            <p>山田たろう</p>
            <EditButton isAdmin={isAdmin} />
        </div>
    );
};
