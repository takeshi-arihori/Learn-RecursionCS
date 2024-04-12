import { useState } from "react";
import { useChatRoom } from "./useChatRoom.js";
import { showNotification } from "./notifications.js";
// PropTypesをimportする
import PropTypes from "prop-types";

// roomIdの型を定義

Room.propTypes = {
    roomId: PropTypes.string.isRequired,
};

// Roomコンポーネントを定義

export default function Room({ roomId }) {
    const [serverUrl, setServerUrl] = useState("https://localhost:1234");

    useChatRoom({
        roomId: roomId,
        serverUrl: serverUrl,
        onReceiveMessage(msg) {
            showNotification("New message: " + msg);
        },
    });

    return (
        <>
            <label>
                Server URL:
                <input
                    value={serverUrl}
                    onChange={(e) => setServerUrl(e.target.value)}
                />
            </label>
            <h1>Welcome to the {roomId} room!</h1>
        </>
    );
}
