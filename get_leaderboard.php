<?php
header("Content-Type: application/json");
$host = "sql312.infinityfree.com";
$user = "if0_38949461";
$password = "Artem1911";
$dbname = "if0_38949461_spacedash";

$nickname = $_GET['nickname'] ?? null;
$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    echo json_encode(["success" => false, "message" => "Помилка з'єднання"]);
    exit;
}
$result = $conn->query("SELECT nickname, score FROM players ORDER BY score DESC, last_updated ASC");
$leaderboard = [];
$rank = 1;
$userRank = null;
while ($row = $result->fetch_assoc()) {
    $leaderboard[] = ["rank" => $rank, "nickname" => $row['nickname'], "score" => (int)$row['score']];
    if ($nickname && $row['nickname'] === $nickname) {
        $userRank = $rank;
    }
    $rank++;
}
$response = ["success" => true, "leaderboard" => $leaderboard];
if ($nickname) {
    $response["your_rank"] = $userRank;
}
echo json_encode($response);
$conn->close();
?>
