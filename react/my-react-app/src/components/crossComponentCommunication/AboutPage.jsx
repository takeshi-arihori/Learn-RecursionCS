import { useUser } from "./context/UserProvider";

const AboutPage = () => {
    const { user, setUser } = useUser();

    const handleNameChange = () => {
        const newName = prompt(
            "新しいユーザー名を入力してください:",
            user.name
        );
        if (newName && newName.trim() !== "") {
            setUser({ name: newName });
        }
    };

    return (
        <div>
            <h1>About</h1>
            <p>
                現在のユーザーは{user.name}
                です。このページでは、ユーザー名を変更することができます。
            </p>
            <button onClick={handleNameChange}>ユーザー名を変更</button>
        </div>
    );
};

export default AboutPage;
