import "./App.css";
import { Form } from "./components/Form";
import Todos from "./components/Todos";
import React from "react";

export default function App() {
  return (
    <div className="App">
      <header className="App-header">
        <Todos />
        <Form />
      </header>
    </div>
  );
}
