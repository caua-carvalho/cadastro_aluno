<?php
// api/createStudent.php
header('Content-Type: application/json');
require_once '../dbconfig.php'; // Ajuste o caminho conforme a estrutura

// Obtém os dados JSON enviados pelo aplicativo
$input = json_decode(file_get_contents('php://input'), true);
$nome = $conn->real_escape_string(trim($input['nome']));
$cpf = $conn->real_escape_string(trim($input['cpf']));
$rg  = $conn->real_escape_string(trim($input['rg']));
$matricula = $conn->real_escape_string(trim($input['matricula']));
$email = $conn->real_escape_string(trim($input['email']));
$data_nascimento = $conn->real_escape_string(trim($input['data_nascimento']));
$curso = $conn->real_escape_string(trim($input['curso']));

// Validação simples (exemplo: campo obrigatório)
if (!$nome || !$cpf || !$rg || !$matricula) {
    echo json_encode(['status'=>'error','message'=>'Campos obrigatórios faltando']);
    exit;
}

// Preparar e executar a inserção
$sql = "INSERT INTO alunos (nome, cpf, rg, matricula, email, data_nascimento, curso)
        VALUES (?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssss", $nome, $cpf, $rg, $matricula, $email, $data_nascimento, $curso);

if ($stmt->execute()) {
    echo json_encode(['status'=>'success','message'=>'Aluno inserido com sucesso']);
} else {
    echo json_encode(['status'=>'error','message'=>'Erro: '. $conn->error]);
}
$stmt->close();
$conn->close();
?>
