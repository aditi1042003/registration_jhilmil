<?php 

require('connection.php');
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


function sendMail($email,$v_code){

    require ('PHPMailer/PHPMailer.php');
    require ('PHPMailer/SMTP.php');
    require ('PHPMailer/Exception.php');
    

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'devilqueen404nf@gmail.com';                     //SMTP username
    $mail->Password   = 'rlbxbkeshqhpsqyd';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('devilqueen404nf@gmail.com', 'JHILMIL');
    $mail->addAddress($email);     //Add a recipient
    #$mail->addAddress('ellen@example.com');               //Name is optional
    #$mail->addReplyTo('info@example.com', 'Information');
    #$mail->addCC('cc@example.com');
    #$mail->addBCC('bcc@example.com');

    //Attachments
    #$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    #$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Email verification JHILMIL';
    $mail->Body    = "Thanks for registration!
    Click the link below to verify yourself:
        <a href='http://localhost/REGISTRATION_PHP/verify.php?email=$email&v_code=$v_code'>Verify</a>";
    #$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    #echo 'Message has been sent';
    return true;
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    #return false;
}


}

#$_SESSION['logged_in']=false;

#for login
if(isset($_POST['login'])){
    $query="SELECT * FROM `registered_user` WHERE `email_id`='$_POST[email_username]' OR `user_name`='$_POST[email_username]'";
    $result=mysqli_query($con,$query);

    if($result){

        if(mysqli_num_rows($result)==1){

            $result_fetch=mysqli_fetch_assoc($result);
            if($result_fetch['is_verified']==1){
            if(password_verify($_POST['password'],$result_fetch['password'])){
                #if password verify
                #echo"right";
                $_SESSION['logged_in']=true;
                $_SESSION['username']=$result_fetch['user_name'];
                $_SESSION['college']=$result_fetch['college_name'];
                $_SESSION['name']=$result_fetch['full_name'];
                $_SESSION['email']=$result_fetch['email_id'];
                #$_SESSION['is_verified']=$result_fetch['is_verified'];
                $_SESSION['profile']=$result_fetch['profile_id'];


                header("location: index.php");

            }else{
                echo"
        <script>
        alert('Incorrect password');
        window.location.href='index.php';
        </script>
        ";
            }

        }else{
            #email not verified
            echo"
            <script>
            alert('Email not verified');
            window.location.href='index.php';
            </script>
            ";

        }


        }else{
            echo"
        <script>
        alert('Email or username not registered');
        window.location.href='index.php';
        </script>
        ";

        }

    }else{
        echo"
        <script>
        alert('cannot run query');
        window.location.href='index.php';
        </script>
        ";
    }


}

#registration of user
if(isset($_POST['register'])){
    $user_exist_query="SELECT * FROM `registered_user` WHERE `user_name`='$_POST[username]'OR `email_id`='$_POST[email]' ";
    $result=mysqli_query($con,$user_exist_query);

    #for registration of user

    if($result){
        #for duplicate entry check
        if(mysqli_num_rows($result)>0){
            $result_fetch=mysqli_fetch_assoc($result);
            if($result_fetch['user_name']==$_POST['username']){

            echo"
            <script>
            alert('$result_fetch[user_name]--User Name exists , please enter another');
            window.location.href='index.php';
            </script>
            ";

        }else{
            #error for email already registered
            echo"
            <script>
            alert('$result_fetch[email_id]--E-mail exists , please enter another');
            window.location.href='index.php';
            </script>
            ";


        }
    }else{
        #new user registration

        $password=password_hash($_POST['password'],PASSWORD_BCRYPT);
        $v_code=bin2hex(random_bytes(16));
        $profileimage=$_FILES['profile_id'];
        $imageid=$_FILES['image_id'];

       # print_r($imageid);
       # print_r($profileimage);
        $imagefilename=$imageid['name'];
        $profilefilename=$profileimage['name'];
        $imagefiletemp=$imageid['tmp_name'];
        $profilefiletemp=$profileimage['tmp_name'];

        $imagename_seprate=explode('.',$imagefilename);
        $profilename_seprate=explode('.',$profilefilename);

        $profile_extension=strtolower(end($profilename_seprate));
        $image_extension=strtolower(end($imagename_seprate));

        $upload_image='images/'.$imagefilename;
        $upload_profile='images/'.$profilefilename;
        move_uploaded_file($imagefiletemp,$upload_image);
        move_uploaded_file($profilefiletemp,$upload_profile);



        #echo$profileimage;

        $query="INSERT INTO `registered_user`(`profile_id`,`full_name`, `user_name`, `email_id`,`image_id`,`college_name`, `phone_number`, `password`,`verification_code`,`is_verified`) VALUES ('$upload_profile','$_POST[fullname]','$_POST[username]','$_POST[email]','$upload_image','$_POST[college_name]','$_POST[phone_number]','$password','$v_code','0')";
        if(mysqli_query($con,$query)&& sendMail($_POST['email'],$v_code)){
            #data inserted successfully
            echo"
            <script>
            alert('registration sucessful');
            window.location.href='index.php';
            </script>
            ";



        }
        else{
            echo"
            <script>
            alert('could not run query: server down');
            window.location.href='index.php';
            </script>
            ";

       }

    }

    }else{

        echo"
        <script>
        alert('cannot run query');
        window.location.href='index.php';
        </script>
        ";
    }
}
?>