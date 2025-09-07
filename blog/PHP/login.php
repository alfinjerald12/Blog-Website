<?php
session_start();
require_once "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username_or_email = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    // Search by username OR email
    $sql = "SELECT id, username, email, password FROM users WHERE username = ? OR email = ? LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username_or_email, $username_or_email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        if (password_verify($password, $row["password"])) {
    $_SESSION["user"] = $row["username"];
    header("Location: success.php");
    exit;
        } else {
            echo "Invalid password!";
        }
    } else {
        echo "User not found!";
    }

    $stmt->close();
}
$conn->close();
?>
