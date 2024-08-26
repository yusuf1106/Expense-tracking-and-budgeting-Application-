<?php
require_once('../config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);  // Using MD5 to hash the password
    
    // Create a new database connection instance
    $db = new DBConnection();
    $conn = $db->conn;

    // Prepare SQL statement to insert user into the database
    $sql = "INSERT INTO users (firstname, lastname, username, password, type, date_added, date_updated) VALUES (?, ?, ?, ?, 0, NOW(), NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssss', $firstname, $lastname, $username, $password);
    
    if ($stmt->execute()) {
        header('Location: login.php?signup=success');
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
