<?php

require("connection.php");
if(isset($_GET['email'])&& isset($_GET['v_code'])){
    $query="SELECT * FROM `registered_user` WHERE `email_id`='$_GET[email]' AND `verification_code`='$_GET[v_code]'";
    $result=mysqli_query($con,$query);
    if($result){
        if(mysqli_num_rows($result)==1){
            $result_fetch=mysqli_fetch_assoc($result);
            if($result_fetch['is_verified']==0){
                $update=" UPDATE `registered_user` SET `is_verified`='1' WHERE `email_id`='$result_fetch[email_id]'";
                if(mysqli_query($con,$update)){
                    echo"
                        <script>
                        alert('email registered sucessfuly');
                        window.location.href='index.php';
                        </script>
                        ";

                }else{
                    echo"
                        <script>
                        alert('cannot run query');
                        window.location.href='index.php';
                        </script>
                        ";
                }

            }else{
                echo"
        <script>
        alert('Email Already registered');
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