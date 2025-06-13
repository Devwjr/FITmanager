import React from 'react';
import { BrowserRouter, Routes, Route, Navigate } from 'react-router-dom';
import Login from './components/Login';
import Register from './components/Register';
import Dashboard from './components/Dashboard';
import TreinoForm from './components/TreinoForm';

function App() {
  const logged = !!localStorage.getItem('user');
  return (
    <BrowserRouter>
      <Routes>
        <Route path="/" element={ logged ? <Navigate to="/dashboard" /> : <Login /> } />
        <Route path="/register" element={<Register />} />
        <Route path="/dashboard" element={ logged ? <Dashboard /> : <Navigate to="/" />} />
        <Route path="/novo-treino" element={ logged ? <TreinoForm /> : <Navigate to="/" />} />
      </Routes>
    </BrowserRouter>
  );
}

export default App;
