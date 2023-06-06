<?php
session_start();
require_once 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Retrieve form data
  $email = $_POST["email"];
  $password = $_POST["password"];

  // Validate form data
  $errors = [];

  // Validate email
  if (empty($email)) {
    $errors[] = "Email is required.";
  }

  // Validate password
  if (empty($password)) {
    $errors[] = "Password is required.";
  }

  // If there are no errors, proceed with login
  if (empty($errors)) {
    try {
      // Retrieve user from the database based on email
      $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
      $stmt->bindParam(1, $email);
      $stmt->execute();
      $user = $stmt->fetch(PDO::FETCH_ASSOC);

      // Verify password
      if ($user && password_verify($password, $user['password'])) {
        // Password is correct, log in the user
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];

        // Redirect to a success page or perform any other desired action
        header("Location: pc.php");
        exit;
      } else {
        $errors[] = "Invalid email or password.";
      }
    } catch (PDOException $e) {
      die("Failed to retrieve user from database: " . $e->getMessage());
    }
  }
}
else {
  // Retrieve all users from the database
  try {
    $stmt = $pdo->prepare("SELECT * FROM users");
    $stmt->execute();
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
  } catch (PDOException $e) {
    die("Failed to retrieve users from the database: " . $e->getMessage());
  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <style>
    .errors {
      color: red;
    }
  </style>
</head>
<body>
  <h1>Login</h1>
  <?php if (!empty($errors)): ?>
    <div class="errors">
      <?php foreach ($errors as $error): ?>
        <p><?php echo $error; ?></p>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
  
  <h2>Select your account:</h2>
  <?php if (!empty($users)): ?>
    <ul>
      <?php foreach ($users as $user): ?>
        <li>
          <?php echo $user['username']; ?>
          <button onclick="showLoginForm(<?php echo $user['id']; ?>)">Login</button>
          <div id="loginForm-<?php echo $user['id']; ?>" style="display: none;">
            <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
              <input type="hidden" name="email" value="<?php echo $user['email']; ?>">
              <div>
                <label>Password:</label>
                <input type="password" name="password" required>
              </div>
              <div>
                <input type="submit" value="Login">
              </div>
            </form>
          </div>
        </li>
      <?php endforeach; ?>
    </ul>
  <?php else: ?>
    <a >Register your account:</a>
  <?php endif; ?>

  <script>
    function showLoginForm(userId) {
      var loginForm = document.getElementById("loginForm-" + userId);
      if (loginForm.style.display === "none") {
        loginForm.style.display = "block";
      } else {
        loginForm.style.display = "none";
      }
    }
  </script>
</body>
</html>