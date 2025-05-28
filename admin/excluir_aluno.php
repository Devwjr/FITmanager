<?php
require_once '../includes/protect.php';
require_once '../includes/database.php';

$id = $_GET['id'];
$stmt = $pdo->prepare("DELETE FROM alunos WHERE id = ?");
$stmt->execute([$id]);

header("Location: alunos.php");
exit;
