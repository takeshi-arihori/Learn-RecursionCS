import "./App.css";
// import CounterComponent from "./components/redux/CounterComponent";
import { Provider } from "react-redux";
import store from "./components/redux/store";
// import TodoApp from "./components/todoList/TodoApp";
// import Form from "./components/reducer/Form";
// import { Home } from "./components/crossComponentCommunication/Home";
// import { ChatRoom } from "./components/customHook/chatRoom/ChatRoom";
// import StatusBar, { SaveButton } from "./components/StatusBar";
// import CustomForm from "./components/customHook/CustomForm";
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
    <Provider store={store}>
      {/* <Todos /> */}
      {/* <Form /> */}
      {/* <RecipeList /> */}
      {/* <TwitterPreview /> */}
      {/* <RandomCountry /> */}
      {/* <Video /> */}
      {/* <Chat /> */}
      {/* <PostCode /> */}
      {/* <SimpleFormWithCustomHook /> */}
      {/* <StatusBar /> */}
      {/* <SaveButton /> */}
      {/* <CustomForm /> */}
      {/* <ChatRoom /> */}
      {/* <Home /> */}
      {/* <Form /> */}
      {/* <TodoApp /> */}
      {/* <CounterComponent /> */}
    </Provider>
  );
}
