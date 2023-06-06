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
   // retrieve form data
   $email = $_POST["email"];
   $password = $_POST["password"];

   // validate form data
   $errors = [];

   // validate email
   if (empty($email)) {
     $errors[] = "Email is required.";
   }

   // validate password
   if (empty($password)) {
     $errors[] = "Password is required.";
   }

   // if there are no errors, proceed with login
   if (empty($errors)) {
     try {
       // retrieve user from the database based on email
       $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
       $stmt->bindParam(1, $email);
       $stmt->execute();
       $user = $stmt->fetch(PDO::FETCH_ASSOC);

       // verify password
       if ($user && password_verify($password, $user['password'])) {
         // Password is correct, log in the user
         $_SESSION['user_id'] = $user['id'];
         $_SESSION['username'] = $user['username'];
         $_SESSION['profile_picture'] = $user['profile_picture'];
         // redirect to a success page or perform any other desired action
         header("Location: pc.php");
         exit;
       } else {
         $errors[] = "Invalid email or password.";
       }
     } catch (PDOException $e) {
       die("Failed to retrieve user from the database: " . $e->getMessage());
     }
   }
} elseif (isset($_GET['guest'])) {
  // Log in as a guest
  $guestId = $_GET['guest'];
  if (isset($profilePictures[$guestId])) {
    $_SESSION['user_id'] = -1; // Unique ID for guest
    $_SESSION['username'] = 'Guest';
    $_SESSION['profile_picture'] = $guestId;
    header("Location: pc.php");
    exit;
  } else {
    die("Invalid guest ID.");
  }
} else {
   // retrieve all users from the database
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
      <title>Welcome</title>
      <script src="https://cdn.tailwindcss.com"></script>
   </head>
   <body>
      <?php if (isset($_SESSION['errors'])) { ?>
      <div class="error">
         <ul>
            <?php foreach ($_SESSION['errors'] as $error) { ?>
            <li><?php echo $error; ?></li>
            <?php } ?>
         </ul>
      </div>
      <?php
         unset($_SESSION['errors']);
         }
         ?>
      <div class="bg-blue-800 h-[10vh] w-full"></div>
      <div class="w-full h-[80vh] grid place-items-center bg-indigo-500 text-white">
         <div class="grid w-full grid-cols-2 h-4/5 gap-x-6">
            <div class="relative flex flex-col items-end justify-center px-4">
               <img src="media/winxplogonscreen.png" class="w-1/3">
               <div class="absolute top-0 bottom-0 right-0 w-1 bg-white bg-gradient-to-b from-indigo-500 via-blue-200 to-indigo-500">
               </div>
            </div>
            <div class="grid items-center overflow-y-scroll">
               <div>
                  <?php if (!empty($users)): ?>
                  <div class="flex flex-row items-center h-16 gap-x-2 ">
                     <p>Select your account OR</p>
                     <a href="register.php">
                      <button>Register</button></a>
                  </div>
                  <ul class="grid grid-cols-1">
                     <?php foreach ($users as $user): ?>
                     <li class="flex cursor-pointer flex-row items-center px-2 rounded-lg h-28 from-blue-800 to-indigo-500 gap-x-4" onclick="toggleLoginForm(this)">
                            <ul class="w-24 aspect-square rounded-lg bg-white  bg-white text-black grid place-items-center">
                              <img class="rounded-lg" src="media/<?php echo $profilePictures[$user['profile_picture']]; ?>">
                            </ul>
                        <ul>
                           <?php echo $user['username']; ?>
                           <ul class="login-form" style="display: none;">
                              <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                                 <input type="hidden" name="email" value="<?php echo $user['email']; ?>">
                                 <div class="flex flex-col">
                                    <label>Type your password:</label>
                                    <div class="flex flex-row items-center gap-x-1">
                                       <input type="password" name="password" class="w-4/5 h-8 text-black rounded-md shadow-xl border-2 outline-none border-gray-600" required onclick="stopEventPropagation(event)">
                                       <div class="w-8 h-8 rounded-full">
                                          <button type="submit" class="grid w-full h-full text-transparent bg-green-600 hover:bg-green-800 transition-all border-2 border-white rounded-lg place-items-center" onclick="stopEventPropagation(event)">
                                             <svg xmlns="http://www.w3.org/2000/svg"  width="24" height="24" viewBox="0 0 1024 1024" class="text-white">
                                                <path fill="currentColor" d="M869 487.8L491.2 159.9c-2.9-2.5-6.6-3.9-10.5-3.9h-88.5c-7.4 0-10.8 9.2-5.2 14l350.2 304H152c-4.4 0-8 3.6-8 8v60c0 4.4 3.6 8 8 8h585.1L386.9 854c-5.6 4.9-2.2 14 5.2 14h91.5c1.9 0 3.8-.7 5.2-2L869 536.2a32.07 32.07 0 0 0 0-48.4z"/>
                                             </svg>
                                          </button>
                                       </div>
                                    </div>
                                 </div>
                              </form>
                           </ul>
                        </ul>
                     </li>
                     <?php endforeach; ?>
                     <li class="flex cursor-pointer flex-row items-center px-2 rounded-lg h-28 from-blue-800 to-indigo-500 gap-x-4" onclick="loginAsGuest()">
                        <ul class="w-24 aspect-square rounded-lg bg-white  bg-white text-black grid place-items-center">
                           <img class="rounded-lg" src="guest-profile.jpg">
                        </ul>
                        <ul>
                           Guest
                           <ul class="login-form" style="display: none;">
                              <a href="?guest=1" class="w-full h-full flex items-center justify-center">Log in as Guest</a>
                           </ul>
                        </ul>
                     </li>
                  </ul>
                  <?php else: ?>
                  <p>Wrong Password</p>
                  <?php endif; ?>
               </div>
            </div>
         </div>
      </div>
      <div class="bg-blue-800 h-[10vh] w-full"></div>
      <script>
         function toggleLoginForm(liElement) {
           var loginForm = liElement.querySelector(".login-form");
           var prevForm = document.querySelector(".login-form[style='display: block;']");
           var prevClickedLi = document.querySelector(".bg-gradient-to-r");
         
           if (loginForm.style.display === "none") {
             if (prevForm) {
               prevForm.style.display = "none";
             }
             loginForm.style.display = "block";
             liElement.classList.add("bg-gradient-to-r");
           } else {
             loginForm.style.display = "none";
             liElement.classList.remove("bg-gradient-to-r");
           }
         
           if (prevClickedLi && prevClickedLi !== liElement) {
             prevClickedLi.classList.remove("bg-gradient-to-r");
             prevClickedLi.querySelector(".login-form").style.display = "none";
           }
         }
         
         function stopEventPropagation(event) {
           event.stopPropagation();
         }
         
         function loginAsGuest() {
           window.location.href = "?guest=1";
         }
      </script>
   </body>
</html>
