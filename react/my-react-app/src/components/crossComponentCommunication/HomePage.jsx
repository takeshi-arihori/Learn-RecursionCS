import { useUser } from "./context/UserProvider";

const HomePage = () => {
    const { user } = useUser();
    return (
        <div>
            <h1>ホームページ</h1>
            <p>
                こんにちは、{user.name}
                さん。こちらはホームページです。Reactの`useContext`フックを使って、このページとAboutページ間でユーザー名を共有します。
            </p>
        </div>
    );
};

export default HomePage;
