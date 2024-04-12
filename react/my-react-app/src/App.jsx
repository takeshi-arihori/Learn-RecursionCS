import "./App.css";
import StatusBar, { SaveButton } from "./components/StatusBar";
// import SimpleFormWithCustomHook from "./components/customHook/SimpleFormWithCustomHook";
// import PostCode from "./components/postalAutoFill/PostCode";
// import Chat from "./components/Chat";
// import Video from "./components/Video";
// import { RandomCountry } from "./components/RandomCountry";
// import { TwitterPreview } from "./components/TwitterPreview";
// import { RecipeList } from "./components/RecipeList";
// import { Form } from "./components/Form";
// import Todos from "./components/Todos";

export default function App() {
    return (
        <div className="App">
            <header className="App-header">
                {/* <Todos /> */}
                {/* <Form /> */}
                {/* <RecipeList /> */}
                {/* <TwitterPreview /> */}
                {/* <RandomCountry /> */}
                {/* <Video /> */}
                {/* <Chat /> */}
                {/* <PostCode /> */}
                {/* <SimpleFormWithCustomHook /> */}
                <StatusBar />
                <SaveButton />
            </header>
        </div>
    );
}
