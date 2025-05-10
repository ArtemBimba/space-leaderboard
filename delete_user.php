<?php
header("Content-Type: application/json");
$host = "sql312.infinityfree.com";
$user = "if0_38949461";
$password = "Artem1911";
$dbname = "if0_38949461_spacedash";

$nickname = $_POST['nickname'] ?? '';
if (empty($nickname)) {
    echo json_encode(["success" => false, "message" => "Нік не передано"]);
    exit;
}
$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    echo json_encode(["success" => false, "message" => "Помилка з'єднання"]);
    exit;
}
$stmt = $conn->prepare("DELETE FROM players WHERE nickname = ?");
$stmt->bind_param("s", $nickname);
if ($stmt->execute()) {
    echo json_encode(["success" => true, "message" => "Обліковий запис видалено"]);
} else {
    echo json_encode(["success" => false, "message" => "Помилка при видаленні"]);
}
$conn->close();
?>
