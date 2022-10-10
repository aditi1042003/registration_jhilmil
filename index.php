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
    <!-- <link rel="stylesheet" href="doodle.css" /> -->
    <link rel="stylesheet" href="style.css">
  </head>
  
  <body>
    <!-- <css-doodle>
    <style>
      @grid: 50x1 / 50vmin;
      :container {
        perspective: 23vmin;
      }
      background: @m(
        @r(200, 240), 
        radial-gradient(
          @p(#00b8a9, #f8f3d4, #f6416c, #ffde7d) 15%,
          transparent 50%
        ) @r(100%) @r(100%) / @r(1%, 3%) @lr no-repeat
      );
  
      @size: 80%;
      @place-cell: center;
  
      border-radius: 50%;
      transform-style: preserve-3d;
      animation: scale-up 20s linear infinite;
      animation-delay: calc(@i * -.4s);
  
      @keyframes scale-up {
        0% {
          opacity: 0;
          transform: translate3d(0, 0, 0) rotate(0);
        }
        10% { 
          opacity: 1; 
        }
        95% {
          transform:
            translate3d(0, 0, @r(50vmin, 55vmin))
            rotate(@r(-360deg, 360deg));
        }
        100% {
          opacity: 0;
          transform: translate3d(0, 0, 1vmin);
        }
      }
    </style>
  </css-doodle> -->
  
  <div class="container-big">
  <video id="videoBG" poster="poster.png" autoplay muted loop>
		<source src="video.mp4" type="video/mp4">
	</video>
  <div class="text-effect">
    <span>Jhilmil '22</span>
  </div> 
  <header>
    <!-- <nav>
      <a href="#">HOME</a>
      <a href="#">BLOG</a>
      <a href="#">CONTACT</a>
      <a href="#">ABOUT</a>
      ul.menu-bar
      li Watch Now
	li Movies
	li TV Shows
	li Sports
	li Kids
	li Library
</nav> -->
<?php
    
    if(isset($_SESSION['logged_in'])&& $_SESSION['logged_in']==true){
      echo"
      <div class='user' >
      <span>$_SESSION[username] - <a href='logout.php'>LOGOUT</a></span>
      
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

  <div class="container">
  <!-- <div class="box">
    <span></span>
    <div class="content">
      <h2>INSTRUCTIONS</h2>
      <p>1. Register</p>
      <p>2. Verify E-mail</p>
      <p>3. Login</p>
      <p>4. Get your unique pass</p>
      <a href="#">Read More</a>
    </div>
  </div> -->
  <div class="box">
    <span></span>
    <div class="content">
      <h2>INSTRUCTIONS</h2>
      <p>1. Register</p>
      <p>2. Verify E-mail</p>
      <p>3. Login</p>
      <p>4. Get your unique pass</p>
      <!-- <a href="#">Read More</a> -->
    </div>
  </div>
  <!-- <div class="box">
    <span></span>
    <div class="content">
      <h2>INSTRUCTIONS</h2>
      <p>1. Register</p>
      <p>2. Verify E-mail</p>
      <p>3. Login</p>
      <p>4. Get your unique pass</p>
      <a href="#">Read More</a>
    </div>
  </div> -->
</div>
 
  <!-- <div class='instructions'>
    <h2>1.Register</h2>
  </br>
    <h2>2.Verify E-mail</h2>
  </br>
  <h2>3.Login</h2>
</br>
    <h2>4.Get your unique pass</h2>
  </br> 
  </div> -->
  



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

    
    echo"<div style='background: white; border:2px solid red'>
    <h1 style='text-align: center; margin-top: 50px'>click and get your pass</h1>
    <h1 style='text-align: center; margin-top: 50px'>
    <button type='button' onclick=\"popup('pass-popup')\">PASS</button>
    </h1>
    </div>";

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
    

    </div>
  </body>
  </html>