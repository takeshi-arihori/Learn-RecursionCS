import { StrictMode } from 'react'
import { createRoot } from 'react-dom/client'
import './index.css'
import App from './App.jsx'

createRoot(document.getElementById('root')).render(
  <StrictMode>
    <App />
  </StrictMode>,
)


// React 18以降非推奨
// import React from 'react';
// import ReactDOM from 'react-dom';
// const element = <h1>Hello, world!</h1>;
// ReactDOM.render(element, document.getElementById('root'));