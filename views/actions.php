<?php
  
  include("../functions.php");


  if ($_GET['action'] == "loginSignup") {

    $error = "";

    if(!$_POST['email']) {

      $error =  "An email address is required.";

    } else if (!$_POST['password']) {

      $error =  "A password address is required.";

    } else if (filter_var($_POST['email'],FILTER_VALIDATE_EMAIL) === false) {

        $error = "Please enter a valid email address";

    }
  }

    
    if ($error != "") {
      
      echo $error;
      exit();       

    }
    
    
    if ($_POST['loginActive'] == "0")  {

        $email = mysqli_real_escape_string($link, $_POST['email']);
        $password = mysqli_real_escape_string($link, $_POST['password']);
        $password = md5($email.md5($password));

        $query = "SELECT * FROM users WHERE email='$email' LIMIT 1";

        $result = mysqli_query($link, $query);

        if (mysqli_num_rows($result) > 0) $error = "That email address is already taken";
        else {
          $query = "INSERT INTO users (`email`, `password`) VALUES ('$email', '$password')";

    
    
        if (mysqli_query($link, $query)) {
              
              $hashedPassword = md5(md5($_SESSION['id']).$_POST['password']);
              $lastInsertedId = $_SESSION['id']; 

              $_SESSION['id'] = mysqli_insert_id($link);

              $query = "UPDATE users SET password='$hashedPassword' WHERE id=$lastInsertedId LIMIT 1";   
              
              echo 1;

              

            } else {

              $error = "Could not create user - please try again later";
            }

          }

        } else { 

          $query = "SELECT * FROM users WHERE email='$email' LIMIT 1";
          $result = mysqli_query($link, $query);
          $row = mysqli_fetch_assoc($result);

            if ($row['password'] == md5(md5($row['id']).$_POST['password'])) {

              echo 1;

              $_SESSION['id'] = $row['id'];
              
            } else {

              $error = "Could not find that username/password combination. Please try again";
            }
          

        }

        if ($error != "") {
              
          echo $error;
          exit();       


        }

    

?>