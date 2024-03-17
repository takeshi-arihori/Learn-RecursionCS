import React from 'react'
import ReactDOM from 'react-dom/client'
import { App } from './App.tsx'
import { AdminFlagContext, AdminFlagProvider } from './components/providers/AdminFlagProvider';
import './index.css'
import './output.css'

ReactDOM.createRoot(document.getElementById('root')!).render(
  <AdminFlagProvider>
    <App />
  </AdminFlagProvider>
)
