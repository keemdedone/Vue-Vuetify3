<?php
include_once('../database.php');
$postdata = file_get_contents("php://input");
if (isset($postdata) && !empty($postdata)) {
    $request = json_decode($postdata);
    $firstName = $request->fName;
    $lastName = $request->lName;
    $username = $request->uName;
    $email = $request->email;
    $password = $request->password;

    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $id = $_GET['id'];
        try {
            $sql = "UPDATE users
                    SET uFirstname = '$firstName', 
                           uLastname = '$lastName', 
                           uUsername = '$username', 
                           uPassword = '$password',
                           uEmail = '$email' 
                    WHERE uID = :id";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
        } catch (PDOException $e) {
            error_log($e->getMessage());
            http_response_code(500);
        }
    }
}
