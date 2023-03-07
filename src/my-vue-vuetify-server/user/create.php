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

    $sql = "INSERT INTO users (uFirstName,uLastName,uUserName,uEmail,uPassword) 
            VALUES (:firstName, :lastName, :username, :email, :password)";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':firstName', $firstName);
    $stmt->bindParam(':lastName', $lastName);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);

    $stmt->execute();
}
