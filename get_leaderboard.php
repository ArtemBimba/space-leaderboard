<?php
include 'config.php';
$nickname = $_GET['nickname'] ?? null;
$result = pg_query($conn, "SELECT nickname, score FROM players ORDER BY score DESC, last_updated ASC");
$leaderboard = [];
$rank = 1;
$your_rank = null;
while ($row = pg_fetch_assoc($result)) {
    $entry = [
        "rank" => $rank,
        "nickname" => $row['nickname'],
        "score" => (int)$row['score']
    ];
    if ($row['nickname'] === $nickname) {
        $your_rank = $rank;
    }
    $leaderboard[] = $entry;
    $rank++;
}
$response = [
    "success" => true,
    "leaderboard" => $leaderboard,
    "your_rank" => $your_rank
];
echo json_encode($response);
?>
