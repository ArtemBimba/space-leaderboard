<?php
header("Content-Type: application/json");
$host = "sql312.infinityfree.com";
$user = "if0_38949461";
$password = "Artem1911";
$dbname = "if0_38949461_spacedash";

$nickname = $_POST['nickname'] ?? '';
$score = intval($_POST['score'] ?? 0);
if (empty($nickname)) {
    echo json_encode(["success" => false, "message" => "Нікнейм не передано"]);
    exit;
}
$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    echo json_encode(["success" => false, "message" => "Помилка з'єднання"]);
    exit;
}
$stmt = $conn->prepare("UPDATE players SET score = ? WHERE nickname = ? AND score < ?");
$stmt->bind_param("isi", $score, $nickname, $score);
if ($stmt->execute()) {
    echo json_encode(["success" => true, "message" => "Результат оновлено"]);
} else {
    echo json_encode(["success" => false, "message" => "Помилка при оновленні"]);
}
$conn->close();
?>
