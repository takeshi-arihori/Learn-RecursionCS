import { useEffect } from "react";

export const Chat = () => {
    useEffect(() => {
        const connection = createConnection();
        connection.connect();

        return () => {
            connection.disconnect();
        };
    }, []);

    return <h1>Welcome to the chat!!!</h1>;
};

export const createConnection = () => {
    return {
        connect() {
            console.log("✅ Connecting...");
        },
        disconnect() {
            console.log("❌ Disconnected.");
        },
    };
};

export default Chat;
