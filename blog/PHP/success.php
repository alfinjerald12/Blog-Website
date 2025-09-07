<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: ../html/account.html"); // redirect if not logged in
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Welcome</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f9f9f9;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }
    .container {
      text-align: center;
      background: #fff;
      padding: 40px;
      border-radius: 12px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }
    h1 {
      color: #28a745;
    }
    p {
      font-size: 18px;
      margin-top: 10px;
      color: #333;
    }
    button {
      background-color: #007bff;
      color: white;
      border: none;
      padding: 12px 24px;
      border-radius: 6px;
      font-size: 16px;
      cursor: pointer;
      margin-top: 20px;
    }
    button:hover {
      background-color: #0056b3;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>🎉 Congratulations!</h1>
    <p>Hello, <strong><?php echo htmlspecialchars($_SESSION["user"]); ?></strong>!<br>
       Your account action was successful.</p>
    <form action="../html/home.html">
      <button type="submit">Continue to Homepage</button>
    </form>
  </div>
</body>
</html>
