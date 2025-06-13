import { useState } from 'react';
import axios from 'axios';
import { useNavigate, Link } from 'react-router-dom';

export default function Login() {
  const [email, setEmail] = useState('');
  const [senha, setSenha] = useState('');
  const nav = useNavigate();

  const handleLogin = () => {
    axios.post('http://localhost:3001/api/users/login', { email, senha })
      .then(res => {
        localStorage.setItem('user', JSON.stringify(res.data));
        nav('/dashboard');
      })
      .catch(() => alert('Login inválido'));
  };

  return (
    <div className="max-w-md mx-auto mt-20 p-6 bg-white shadow rounded">
      <h2 className="text-2xl mb-4">Login</h2>
      <input type="text" placeholder="Email" value={email}
        onChange={e => setEmail(e.target.value)}
        className="w-full p-2 mb-3 border rounded" />
      <input type="password" placeholder="Senha" value={senha}
        onChange={e => setSenha(e.target.value)}
        className="w-full p-2 mb-3 border rounded" />
      <button onClick={handleLogin}
        className="w-full bg-blue-500 text-white py-2 rounded">Entrar</button>
      <div className="mt-4 text-center">
        <Link to="/register" className="text-blue-500">Criar conta</Link>
      </div>
    </div>
  );
}
