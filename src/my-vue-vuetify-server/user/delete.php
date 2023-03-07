<?php
include_once('../database.php');
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    $date = Date('Y-m-d H:i:s');
    try {
        $sql = "UPDATE users
                SET uDeleted = 1,
                    uDeletedOn = :date
                WHERE uID = :id";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':date', $date);
        $stmt->execute();
    } catch (PDOException $e) {
        error_log($e->getMessage());
        http_response_code(500);
    }
}
