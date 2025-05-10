<?php
include 'config.php';
$nickname = $_POST['nickname'] ?? '';
if (!$nickname) {
    echo json_encode(["success" => false, "message" => "Немає ніка"]);
    exit;
}
$res = pg_query_params($conn, "DELETE FROM players WHERE nickname = $1", [$nickname]);
if ($res) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false]);
}
?>
