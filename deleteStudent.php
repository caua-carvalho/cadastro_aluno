<?php
// api/deleteStudent.php
header('Content-Type: application/json');
require_once '../dbconfig.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if (!$id) {
    echo json_encode(['status'=>'error','message'=>'ID inválido']);
    exit;
}

$stmt = $conn->prepare("DELETE FROM alunos WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo json_encode(['status'=>'success','message'=>'Aluno excluído']);
} else {
    echo json_encode(['status'=>'error','message'=>'Erro: '.$conn->error]);
}
$stmt->close();
$conn->close();
?>
