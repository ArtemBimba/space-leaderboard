<?php
include 'config.php';
$nickname = $_POST['nickname'] ?? '';
$score = (int)($_POST['score'] ?? 0);
if (!$nickname) {
    echo json_encode(["success" => false, "message" => "Немає ніка"]);
    exit;
}
$res = pg_query_params($conn, "UPDATE players SET score = $1, last_updated = CURRENT_TIMESTAMP WHERE nickname = $2 AND score < $1", [$score, $nickname]);
if (pg_affected_rows($res) > 0) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false]);
}
?>
