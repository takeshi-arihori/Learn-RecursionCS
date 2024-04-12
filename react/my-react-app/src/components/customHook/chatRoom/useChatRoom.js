import { useEffect } from 'react';
import { createConnection } from './chat.js';

export function useChatRoom({ serverUrl, roomId, onReceiveMessage }) {
    useEffect(() => {
        const options = {
            serverUrl: serverUrl,
            roomId: roomId
        };
        const connection = createConnection(options);
        connection.connect();
        connection.on('message', (msg) => {
            onReceiveMessage(msg);
        });
        return () => connection.disconnect();
    }, [roomId, serverUrl, onReceiveMessage]);
}