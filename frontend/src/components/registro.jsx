import { useState } from 'react';
import axios from 'axios';
import { useNavigate, Link } from 'react-router-dom';

export default function Register() {
  const [nome, setNome] = useState('');
  const [email, setEmail] = useState('');
  const [senha, setSenha] = useState('');
  const nav = useNavigate();

  const handleRegister = () => {
    axios.post('http://localhost:3001/api/users/register', { nome, email, senha })
      .then(() => {
        alert('Registrado com sucesso!');
        nav('/');
      })
      .catch(err => alert(err.response.data));
  };

  return (
    <div className="max-w-md mx-auto mt-20 p-6 bg-white shadow rounded">
      <h2 className="text-2xl mb-4">Criar conta</h2>
      <input type="text" placeholder="Nome" value={nome}
        onChange={e => setNome(e.target.value)}
        className="w-full p-2 mb-3 border rounded" />
      <input type="text" placeholder="Email" value={email}
        onChange={e => setEmail(e.target.value)}
        className="w-full p-2 mb-3 border rounded" />
      <input type="password" placeholder="Senha" value={senha}
        onChange={e => setSenha(e.target.value)}
        className="w-full p-2 mb-3 border rounded" />
      <button onClick={handleRegister}
        className="w-full bg-green-500 text-white py-2 rounded">Registrar</button>
      <div className="mt-4 text-center">
        <Link to="/" className="text-blue-500">Já tem conta? Login</Link>
      </div>
    </div>
  );
}
