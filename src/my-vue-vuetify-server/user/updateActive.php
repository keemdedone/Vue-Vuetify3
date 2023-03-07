<?php
include_once('../database.php');
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    $value = $_GET['v'];
    try {
        $sql = "UPDATE users
                SET uActive = '$value'
                WHERE uID = :id";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    } catch (PDOException $e) {
        error_log($e->getMessage());
        http_response_code(500);
    }
}
