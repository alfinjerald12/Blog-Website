<?php
// Database Configuration
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'pixeldiary');

// Create Connection
$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check Connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
