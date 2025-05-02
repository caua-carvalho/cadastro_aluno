<?php
// api/getStudents.php
header('Content-Type: application/json');
require_once '../dbconfig.php';

$cpf = isset($_GET['cpf']) ? $_GET['cpf'] : '';
$rg  = isset($_GET['rg'])  ? $_GET['rg']  : '';
$mat = isset($_GET['matricula']) ? $_GET['matricula'] : '';

$whereClauses = [];
$params = [];
$types = "";

// Monta filtros dinamicamente
if ($cpf !== '') {
    $whereClauses[] = "cpf = ?";
    $types .= "s";
    $params[] = $cpf;
}
if ($rg !== '') {
    $whereClauses[] = "rg = ?";
    $types .= "s";
    $params[] = $rg;
}
if ($mat !== '') {
    $whereClauses[] = "matricula = ?";
    $types .= "s";
    $params[] = $mat;
}

$sql = "SELECT * FROM alunos";
if (count($whereClauses) > 0) {
    $sql .= " WHERE " . implode(" OR ", $whereClauses);
}

$stmt = $conn->prepare($sql);
if (count($params) > 0) {
    // Bind dinâmico
    $stmt->bind_param($types, ...$params);
}
$stmt->execute();
$result = $stmt->get_result();

$alunos = [];
while ($row = $result->fetch_assoc()) {
    $alunos[] = $row;
}
echo json_encode(['alunos' => $alunos]);

$stmt->close();
$conn->close();
?>
