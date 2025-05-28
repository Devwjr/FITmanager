<?php
require_once '../includes/protect.php';
require_once '../includes/database.php';

$id = $_GET['id'];
$aluno_id = $_GET['aluno'];

$stmt = $pdo->prepare("DELETE FROM treinos WHERE id = ?");
$stmt->execute([$id]);

header("Location: treinos_aluno.php?id=$aluno_id");
exit;
