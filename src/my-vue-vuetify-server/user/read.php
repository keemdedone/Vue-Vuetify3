<?php
include_once('../database.php');

$sql = "SELECT * 
        FROM users 
        WHERE uLevel < 5
        AND uDeleted = 0";
$stmt = $conn->prepare($sql);
$stmt->execute();

$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($result);
