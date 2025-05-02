<?php
// api/updateStudent.php
header('Content-Type: application/json');
require_once '../dbconfig.php';

$input = json_decode(file_get_contents('php://input'), true);
$id = intval($input['id']);
$nome = $conn->real_escape_string(trim($input['nome']));
// (repita para os outros campos...)

if (!$id) {
    echo json_encode(['status'=>'error','message'=>'ID inválido']);
    exit;
}

$sql = "UPDATE alunos SET nome = ?, cpf = ?, rg = ?, matricula = ?, email = ?, data_nascimento = ?, curso = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssssi", $nome, $cpf, $rg, $matricula, $email, $data_nascimento, $curso, $id);

if ($stmt->execute()) {
    echo json_encode(['status'=>'success','message'=>'Aluno atualizado']);
} else {
    echo json_encode(['status'=>'error','message'=>'Erro: '.$conn->error]);
}
$stmt->close();
$conn->close();
?>
