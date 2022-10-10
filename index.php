<?php  require('connection.php');
session_start();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JHILMIL</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
    <h2>jhilmil</h2>
    <nav>
      <a href="#">HOME</a>
      <a href="#">BLOG</a>
      <a href="#">CONTACT</a>
      <a href="#">ABOUT</a>
    </nav>
    <?php
    
    if(isset($_SESSION['logged_in'])&& $_SESSION['logged_in']==true){
      echo"
      <div class='user' >
      <span>$_SESSION[username]</span> - <a href='logout.php'>LOGOUT</a>
      
      </div>";

     
     
    }else{
      #\" because browser has diffuclty to interpret quote under qoute
      echo"
      <div class='sign-in-up'>
      <button type='button' onclick=\"popup('login-popup')\">LOGIN</button>
      <button type='button' onclick=\"popup('register-popup')\">REGISTER</button>
    </div>";

   

    }

    ?>
    
  </header>
 
  <div class='instructions'>
    <h2>1.Register</h2>
  </br>
    <h2>2.Verify E-mail</h2>
  </br>
    <h2>3.Login</h2>
  </br>
    <h2>4.Get your unique pass</h2>
  </br> 
  </div>




  <div class="popup-container" id="login-popup">
    <div class="popup">
      <form method="POST" action="login_register.php">
        <h2>
          <span>USER LOGIN</span>
          <button type="reset" onclick="popup('login-popup')">X</button>
        </h2>
        <input type="text" placeholder="E-mail or Username" name="email_username">
        <input type="password" placeholder="Password" name="password">
        <button type="submit" class="login-btn" name="login">LOGIN</button>
      </form>
    </div>
  </div>

  <div class="popup-container" id="register-popup">
    <div class="register popup">
      <form method="POST" action="login_register.php"  enctype="multipart/form-data">
        <h2>
          <span>USER REGISTER</span>
          <button type="reset" onclick="popup('register-popup')">X</button>
        </h2>
        <label for="img">Select Profile Image:</label>
        <input type="file" placeholder="Upload Profile Pic" name="profile_id" accept="image/*,.pdf">
        <input type="text" placeholder="Full Name" name="fullname">
        <input type="text" placeholder="Username" name="username">
        <input type="email" placeholder="E-mail" name="email">
        <label for="img">Select ID Proof:</label>
        <select name = "dropdown" style="background-color: transparent;font-size: 14px;
    font-weight: 400; " placeholder="select id  type to upload">
            <option value = "College_id" >College id</option>
            <option value = "Aadhar_card">Aadhar card</option>
            <option value = "Pancard">Pancard</option>
         </select>
        <input type="file" placeholder="Upload Image" name="image_id" accept="image/*,.pdf">
        <input type="text" placeholder="College Name" name="college_name">
        <input type="text" placeholder="Phone Number" name="phone_number">





        <input type="password" placeholder="Password" name="password">
        <button type="submit" class="register-btn" name="register">REGISTER</button>
      </form>
    </div>
  </div>


  <?php
  if(isset($_SESSION['logged_in'])&& $_SESSION['logged_in']==true){


  echo"<h1 style='text-align: center; margin-top: 50px'>click and get your pass</h1>
  <h1 style='text-align: center; margin-top: 50px'>
  <button type='button' onclick=\"popup('pass-popup')\">PASS</button>
  </h1>";

    require_once 'phpqrcode/qrlib.php';
    $path='qrimages/';
    #echo"<img src='$_SESSION[profile]' style='height:50px; width:50px '>";
    #$_SESSION['username']=$result_fetch['user_name'];
    #$_SESSION['college']=$result_fetch['college_name'];
    #$_SESSION['name']=$result_fetch['full_name'];
    #$_SESSION['email']=$result_fetch['email_id'];
    #$_SESSION['is_verified']="verified user";
    #$_SESSION['profile']=$result_fetch['profile_id'];
    $email=$_SESSION['email'];
    
    $qrcode=$path.time().".png";
    
    QRcode::png("'http://localhost/REGISTRATION_PHP/user.php?email=$email", $qrcode,'H',4,4);
    
    echo "
    <div class='popup-container' id='pass-popup'>
    <div class='pass popup'>
    <h1 style='text-align: center; margin-top: 50px'>welcome to jhilmil-$_SESSION[username]
    <button type='button' onclick=\"popup('pass-popup')\">X</button></h1>
    </br>
    <h3 style='text-align: center; margin-top: 10px'>Download your pass</h3>
    <div align='center'>
    <a href='".$qrcode."' download='jhilmil_pass'>
    <button type='button'>Download</button>
    </a>
    </br>
    <img src='".$qrcode."'>
    </div>
    </div>
    </div>
    ";
    
    
    

  }else{
    ;
    #echo"plus plus";
  }


  ?>

  <script>
    function popup(popup_name)
    {
      get_popup=document.getElementById(popup_name);
      if(get_popup.style.display=="flex")
      {
        get_popup.style.display="none";
      }
      else
      {
        get_popup.style.display="flex";
      }
    }
  </script>
    
</body>
</html>