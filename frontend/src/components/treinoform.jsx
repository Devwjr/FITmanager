import { useState } from 'react';
import axios from 'axios';
import { useNavigate } from 'react-router-dom';

export default function TreinoForm() {
  const [nome, setNome] = useState('');
  const [descricao, setDescricao] = useState('');
  const nav = useNavigate();

  const handleSave = () => {
    axios.post('http://localhost:3001/api/treinos', { nome, descricao })
      .then(() => nav('/dashboard'))
      .catch(() => alert('Erro ao salvar'));
  };

  return (
    <div className="max-w-md mx-auto mt-20 p-6 bg-white shadow rounded">
      <h2 className="text-2xl mb-4">Novo Treino</h2>
      <input type="text" placeholder="Nome do treino" value={nome}
        onChange={e => setNome(e.target.value)}
        className="w-full p-2 mb-3 border rounded" />
      <textarea placeholder="Descrição" value={descricao}
        onChange={e => setDescricao(e.target.value)}
        className="w-full p-2 mb-3 border rounded h-24" />
      <button onClick={handleSave}
        className="w-full bg-blue-500 text-white py-2 rounded">Salvar</button>
    </div>
  );
}
