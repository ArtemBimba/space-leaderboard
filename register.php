<?php
header("Content-Type: application/json");
$host = "sql312.infinityfree.com";
$user = "if0_38949461";
$password = "Artem1911";
$dbname = "if0_38949461_spacedash";

$nickname = $_POST['nickname'] ?? '';
if (empty($nickname)) {
    echo json_encode(["success" => false, "message" => "Нікнейм не передано"]);
    exit;
}
$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    echo json_encode(["success" => false, "message" => "Помилка з'єднання"]);
    exit;
}
$stmt = $conn->prepare("SELECT id FROM players WHERE nickname = ?");
$stmt->bind_param("s", $nickname);
$stmt->execute();
$stmt->store_result();
if ($stmt->num_rows > 0) {
    echo json_encode(["success" => false, "message" => "Такий нік уже існує"]);
} else {
    $stmt = $conn->prepare("INSERT INTO players (nickname, score) VALUES (?, 0)");
    $stmt->bind_param("s", $nickname);
    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Гравця зареєстровано"]);
    } else {
        echo json_encode(["success" => false, "message" => "Помилка при додаванні"]);
    }
}
$conn->close();
?>
