<?php
include 'config.php';
$nickname = $_POST['nickname'] ?? '';
if (!$nickname) {
    echo json_encode(["success" => false, "message" => "Нікнейм порожній"]);
    exit;
}
$result = pg_query_params($conn, "SELECT 1 FROM players WHERE nickname = $1", [$nickname]);
if (pg_num_rows($result) > 0) {
    echo json_encode(["success" => false, "message" => "Такий нік вже існує"]);
} else {
    $res = pg_query_params($conn, "INSERT INTO players (nickname, score) VALUES ($1, 0)", [$nickname]);
    if ($res) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "message" => "Помилка при реєстрації"]);
    }
}
?>
