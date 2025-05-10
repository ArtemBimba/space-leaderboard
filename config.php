<?php
// PostgreSQL конфіг
$host = "dpg-d0fqesc9c44c73bj32cg-a";
$port = "5432";
$dbname = "space_leaderboard";
$user = "space_user";
$password = "9vAPNPNWX3LiIuWUguU8fLNTbKXQv1lk";

$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");
if (!$conn) {
    echo json_encode(["success" => false, "message" => "Помилка підключення до бази"]);
    exit;
}
header("Content-Type: application/json");
?>
