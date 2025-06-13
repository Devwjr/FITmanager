const express = require('express');
const router = express.Router();
const db = require('../config/db');

// Cadastro
router.post('/register', (req, res) => {
  const { nome, email, senha } = req.body;
  const query = 'INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)';
  db.query(query, [nome, email, senha], (err, result) => {
    if (err) return res.status(500).send(err);
    res.send('✅ Usuário cadastrado!');
  });
});

router.post('/login', (req, res) => {
  const { email, senha } = req.body;
  const query = 'SELECT * FROM usuarios WHERE email = ? AND senha = ?';
  db.query(query, [email, senha], (err, results) => {
    if (err) return res.status(500).send(err);
    if (results.length > 0) res.json(results[0]);
    else res.status(401).send('❌ Login inválido');
  });
});

module.exports = router;
