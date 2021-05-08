<?php
session_start();

// initializing variables
// $user_id = $_SESSION['user_id'];
$username = "";
$email    = "";
$address  = "";
$phone = "";
$errors = array(); 

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'Fit_ecommerce');

// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $address = mysqli_real_escape_string($db, $_POST['address']);
  $phone = mysqli_real_escape_string($db, $_POST['phone']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($address)) { array_push($errors, "Address is required"); }
  if (empty($phone)) { array_push($errors, "Phone number is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['username'] === $username) {
      array_push($errors, "Username already exists");
    }

    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = $password_1;//encrypt the password before saving in the database

  	$query = "INSERT INTO users (username, email, password, address, phone) 
  			  VALUES('$username', '$email', '$password', '$address', '$phone')";
  	mysqli_query($db, $query);
  	$_SESSION['username'] = $username;
  	$_SESSION['success'] = "You are now logged in";
    $result = mysqli_query($db,"SELECT `user_id` FROM `users` WHERE `username` = '$username'") or die($query."<br/><br/>".mysqli_error($db));
      $row = mysqli_fetch_array($result); 
      $_SESSION['user_id'] = $row[0];
      printf($row[0]);
  	header('location: index.php');
  }
}

// ... 

// LOGIN USER
if (isset($_POST['login_user'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($username)) {
    array_push($errors, "Username is required");
  }
  if (empty($password)) {
    array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
     // $password = md5($password);
      $query = "SELECT * FROM `users` WHERE `username`='$username' AND `password`='$password'";
      $results = mysqli_query($db, $query);
      // print_r(mysqli_fetch_array($results));

      if ( mysqli_num_rows($results) > 0) {
        $_SESSION['username'] = $username;
        $_SESSION['success'] = "You are now logged in";

        $result = mysqli_query($db,"SELECT `usertype` FROM `users` WHERE `username` = '$username'") or die($query."<br/><br/>".mysqli_error($db));
        $row = mysqli_fetch_array($result); 
        $user_type=$row[0];
        print_r($row[0]);
        if($user_type==0 ){
          $result = mysqli_query($db,"SELECT `user_id` FROM `users` WHERE `username` = '$username'") or die($query."<br/><br/>".mysqli_error($db));
          $row = mysqli_fetch_array($result); 
          $_SESSION['user_id'] = $row[0];    
          
          header('location: index.php');
        }
        if($user_type==1 ){
          header('location: Admin/index.php');
        }
        if($user_type==2){
          header('location: Nutri/nutritionist.php');
        }

      }
      
      else {
        array_push($errors, "Wrong username/password combination");
      }
  }
}

//..


?>