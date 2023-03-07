<?php
include_once('../database.php');

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    try {
        $sql = "SELECT uFirstname as firstName, 
                       uLastname as lastName, 
                       uUsername as username, 
                       uPassword as password,
                       uEmail as email 
                FROM users
                WHERE uID = :id
                AND uDeleted = 0";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            echo json_encode($result);
        } else {
            http_response_code(404);
        }
    } catch (PDOException $e) {
        error_log($e->getMessage());
        http_response_code(500);
    }
}
