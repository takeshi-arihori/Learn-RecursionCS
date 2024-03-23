import "./App.css";
import { RecipeList } from "./components/RecipeList";
// import { Form } from "./components/Form";
// import Todos from "./components/Todos";

export default function App() {
    return (
        <div className="App">
            <header className="App-header">
                {/* <Todos /> */}
                {/* <Form /> */}
                <RecipeList />
            </header>
        </div>
    );
}
