import { useState, useEffect } from 'react';
import axios from 'axios';
import { Link } from 'react-router-dom';

export default function Dashboard() {
  const [treinos, setTreinos] = useState([]);

  useEffect(() => {
    axios.get('http://localhost:3001/api/treinos')
      .then(res => setTreinos(res.data))
      .catch(() => alert('Erro ao carregar treinos'));
  }, []);

  return (
    <div className="max-w-2xl mx-auto mt-10 p-6 bg-white shadow rounded">
      <h2 className="text-2xl mb-4 flex justify-between items-center">
        Treinos
        <Link to="/novo-treino"
          className="bg-blue-500 text-white px-4 py-2 rounded">+ Novo</Link>
      </h2>
      <ul>
        {treinos.map(t => (
          <li key={t.id} className="border-b py-2">
            <strong>{t.nome}</strong><br/>
            <small>{t.descricao}</small>
          </li>
        ))}
      </ul>
    </div>
  );
}
