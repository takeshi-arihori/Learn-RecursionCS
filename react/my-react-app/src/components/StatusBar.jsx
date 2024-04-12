import { useState, useEffect } from "react";

export default function StatusBar() {
    const isOnline = useOnlineStatus();
    return <h1>{isOnline ? "✅ Online" : "❌ Disconnected"}</h1>;
}

export function SaveButton() {
    const isOnline = useOnlineStatus();

    function handleSaveClick() {
        console.log("✅ Progress saved");
    }

    return (
        <button disabled={!isOnline} onClick={handleSaveClick}>
            {isOnline ? "Save progress" : "Reconnecting..."}
        </button>
    );
}

function useOnlineStatus() {
    const [isOnline, setIsOnline] = useState(true);
    useEffect(() => {
        function handleOnline() {
            setIsOnline(true);
        }
        function handleOffline() {
            setIsOnline(false);
        }

        window.addEventListener("online", handleOnline);
        window.addEventListener("offline", handleOffline);

        return () => {
            window.removeEventListener("online", handleOnline);
            window.removeEventListener("offline", handleOffline);
        };
    }, []);
    return isOnline;
}
