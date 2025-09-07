<?php
// --- Database Configuration ---
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'pixeldiary');

// --- Create Connection ---
$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// --- Check Connection ---
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// --- Process Form Data ---
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = htmlspecialchars(trim($_POST['post-title']));
    $author = htmlspecialchars(trim($_POST['post-author']));
    $content = htmlspecialchars(trim($_POST['post-content']));

    if (!empty($title) && !empty($author) && !empty($content)) {
        $sql = "INSERT INTO posts (title, author, content) VALUES (?, ?, ?)";

        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("sss", $title, $author, $content);

            if ($stmt->execute()) {
                // ✅ Show success message page
                echo "
                <!DOCTYPE html>
                <html lang='en'>
                <head>
                    <meta charset='UTF-8'>
                    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                    <title>Blog Published</title>
                    <style>
                        body {
                            font-family: Arial, sans-serif;
                            background: #f4f4f9;
                            display: flex;
                            justify-content: center;
                            align-items: center;
                            height: 100vh;
                            margin: 0;
                        }
                        .box {
                            background: #fff;
                            padding: 40px;
                            border-radius: 12px;
                            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
                            text-align: center;
                        }
                        h1 {
                            color: #28a745;
                            margin-bottom: 10px;
                        }
                        p {
                            font-size: 18px;
                            margin-bottom: 20px;
                        }
                        button {
                            background-color: #007bff;
                            color: white;
                            border: none;
                            padding: 12px 25px;
                            border-radius: 6px;
                            font-size: 16px;
                            cursor: pointer;
                            transition: 0.3s;
                        }
                        button:hover {
                            background-color: #0056b3;
                        }
                    </style>
                </head>
                <body>
                    <div class='box'>
                        <h1>🎉 Congratulations!</h1>
                        <p>Your blog is published successfully.</p>
                        <form action='../HTML/home.html'>
                            <button type='submit'>Continue</button>
                        </form>
                    </div>
                </body>
                </html>
                ";
                $stmt->close();
                $conn->close();
                exit();
            }
            $stmt->close();
        }
    }
}

$conn->close();
?>
