<?php
// dbconfig.php
$servername = "sql105.infinityfree.com";   // ex: sql123.epizy.com
$username   = "if0_38880727";    // seu usuário (prefixo if0_)
$password   = "Cau12072007";   // senha da conta
$dbname     = "if0_38880727_XXX"; // nome completo do banco

// Cria conexão MySQLi
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}
// Opcional: definir charset
$conn->set_charset("utf8");
?>
