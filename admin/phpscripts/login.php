<?php
  function logIn($username, $password, $ip) {
    require_once('connect.php');
    $username = mysqli_real_escape_string($link, $username);
    $password = mysqli_real_escape_string($link, $password);
    $loginstring = "SELECT * FROM tbl_user WHERE user_name='{$username}' AND user_pass='{$password}'";
    // echo $loginstring;
    $user_set = mysqli_query($link, $loginstring);
    // echo mysqli_num_rows();
    if(mysqli_num_rows($user_set)){
      $founduser = mysqli_fetch_array($user_set, MYSQLI_ASSOC);
      $id = $founduser['user_id'];
      // echo $id;
      $_SESSION['user_id'] = $id;
      $_SESSION['user_name'] = $founduser['user_fname'];
      if(mysqli_query($link, $loginstring)){
        $update = "UPDATE tbl_user SET user_ip='{$ip}' WHERE user_id={$id}";
        $updatequery = mysqli_query($link, $update);

        // $attemptsQuer = "UPDATE tbl_user SET user_attempts= '0' WHERE user_name='{$_SESSION['username']}'"
        // $setattempts=mysqli_query($link, $attemptsQuer);

      }
      redirect_to("admin_index.php");
    }else{
      $message = "Learn how to type mens";
      return $message;

      if($username = $_SESSION['username'] && $password !== $_SESSION['user_pass']){

        $userID = mysqli_real_escape_string($_POST['username']);
        $password = md5(mysqli_real_escape_string($_POST['password']));

        $checkloginQuer = mysqli_query("SELECT * FROM tbl_user WHERE user_name = '{$userID}' AND Password = '{$password}'") or die(mysqli_error());

      } else {

        if (isset($_SESSION['LoggedAttempts'])){
            $_SESSION['LoggedAttempts']++;
          }else{
            $_SESSION['LoggedAttempts'] = 0;
          }

          $loginQuer = "UPDATE tbl_user SET user_attempts WHERE ";
      }
    }

    mysqli_close($link);
  }

  // function lockoutUser($username, $password) {
  //   $username = mysqli_real_escape_string($link, $username);
  //
  // }

 ?>
