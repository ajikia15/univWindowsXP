<?php
session_start();
require_once 'db_connection.php';

$profilePictures = [
  1 => 'profile1.jpg',
  2 => 'profile2.jpg',
  3 => 'profile3.jpg',
  4 => 'profile4.jpg',
  5 => 'profile5.jpg',
  6 => 'profile6.jpg'
];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Retrieve form data
  $username = $_POST["username"];
  $email = $_POST["email"];
  $password = $_POST["password"];
  $confirmPassword = $_POST["confirm_password"];
  $profilePicture = $_POST["profile_picture"];

  // Validate form data
  $errors = [];

  // Validate username
  if (empty($username)) {
    $errors[] = "Username is required.";
  }

  // Validate email
  if (empty($email)) {
    $errors[] = "Email is required.";
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Invalid email format.";
  }

  // Validate password
  if (empty($password)) {
    $errors[] = "Password is required.";
  } elseif (strlen($password) < 8) {
    $errors[] = "Password should be at least 8 characters long.";
  }

  // Validate confirm password
  if (empty($confirmPassword)) {
    $errors[] = "Confirm password is required.";
  } elseif ($password !== $confirmPassword) {
    $errors[] = "Passwords do not match.";
  }

  // If there are no errors, proceed with registration
  if (empty($errors)) {
    try {
      // Hash the password
      $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

      // Prepare the SQL statement
      $stmt = $pdo->prepare("INSERT INTO users (username, email, password, profile_picture) VALUES (?, ?, ?, ?)");

      // Bind the parameters with the form data
      $stmt->bindParam(1, $username);
      $stmt->bindParam(2, $email);
      $stmt->bindParam(3, $hashedPassword);
      $stmt->bindParam(4, $profilePicture);

      // Execute the prepared statement
      $stmt->execute();

      // Redirect to a success page or perform any other desired action
      header("Location: index.php");
      exit;
    } catch (PDOException $e) {
      die("Failed to insert user into database: " . $e->getMessage());
    }
  } else {
    // Store the errors in a session variable
    $_SESSION['errors'] = $errors;

    // Redirect back to the index.php file
    header("Location: register.php");
    exit;
  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Register</title>
      <script src="https://cdn.tailwindcss.com"></script>

</head>
<body>
<div class="bg-blue-800 h-[10vh] w-full"></div>
<div class="h-[80vh]  flex items-center bg-indigo-500  text-white justify-center py-12 px-4 sm:px-6 lg:px-8">
  <div class="max-w-md w-full space-y-8">
    <div>
      <h2 class="mt-6 text-center text-3xl font-bold">
        Register
      </h2>
    </div>
    <form method="POST" action="register.php" id="registrationForm">
      <div class="rounded-md shadow-sm ">
        <div>
          <label for="username" class="sr-only">Username</label>
          <input id="username" name="username" type="text" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm" placeholder="Username">
        </div>
        <div>
          <label for="email" class="sr-only">Email</label>
          <input id="email" name="email" type="email" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-none focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm" placeholder="Email">
        </div>
        <div>
          <label for="password" class="sr-only">Password</label>
          <input id="password" name="password" type="password" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-none focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm" placeholder="Password">
        </div>
        <div>
          <label for="confirm_password" class="sr-only">Confirm Password</label>
          <input id="confirm_password" name="confirm_password" type="password" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm" placeholder="Confirm Password">
        </div>
      </div>
      <div class="py-6">
        <label class="block text-sm font-medium">Profile Picture:</label>
        <div class="mt-1 grid grid-cols-3 gap-4">
          <?php foreach ($profilePictures as $pictureNumber => $picture) : ?>
            <label class="flex flex-col items-center">
              <img class="w-36 h-36 rounded-xl border-2 border-gray-600" src="media/<?php echo $picture; ?>">
              <input type="radio" name="profile_picture" value="<?php echo $pictureNumber; ?>" class="form-radio h-4 w-4 text-indigo-600">

            </label>
          <?php endforeach; ?>
        </div>
      </div>
      <div>
        <label for="age" class="sr-only">Age</label>
        <input id="age" name="age" type="number" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-none focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm" placeholder="Age (not essential)">
      </div>
      <div>
        <button type="submit" class="group relative w-1/2 mx-auto my-2 flex justify-center py-2 px-4 border border-transparent rounded-md text-white focus:outline-none bg-green-600 font-bold">
          Register
        </button>
      </div>
    </form>
  </div>
</div>
<div class="bg-blue-800 h-[10vh] w-full"></div>
</body>
</html>