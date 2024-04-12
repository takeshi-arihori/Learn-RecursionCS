import { useState } from "react";
import Room from "./Room.jsx";

export const ChatRoom = () => {
    const [roomId, setRoomId] = useState("general");
    return (
        <>
            <label>
                Choose the chat room:{" "}
                <select
                    value={roomId}
                    onChange={(e) => setRoomId(e.target.value)}
                >
                    <option value="general">general</option>
                    <option value="travel">travel</option>
                    <option value="music">music</option>
                </select>
            </label>
            <hr />
            <Room roomId={roomId} />
        </>
    );
};
