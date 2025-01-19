import ProfileCard from "./ProfileCard.jsx";

export const App = () => {
    return (
        <div>
            <h1>My React App</h1>
            <ProfileCard
                name="Alice"
                age={20}
                sex={18}
                profession="Software Engineer"
            />
        </div>
    );
};

export default App;
