const express = require('express');
const router = express.Router();
const db = require('../config/db');

// Listar treinos
router.get('/', (req, res) => {
  db.query('SELECT * FROM treinos', (err, results) => {
    if (err) return res.status(500).send(err);
    res.json(results);
  });
});

// Criar treino
router.post('/', (req, res) => {
  const { nome, descricao } = req.body;
  db.query(
    'INSERT INTO treinos (nome, descricao) VALUES (?, ?)',
    [nome, descricao],
    (err, result) => {
      if (err) return res.status(500).send(err);
      res.send('✅ Treino criado');
    }
  );
});

module.exports = router;
