<?php

require("connection.php");
if(isset($_GET['email'])){
    $query="SELECT * FROM `registered_user` WHERE `email_id`='$_GET[email]'";
    $result=mysqli_query($con,$query);
    if($result){
        if(mysqli_num_rows($result)==1){
            $result_fetch=mysqli_fetch_assoc($result);
            $src=$result_fetch['image_id'];
            
                    echo"
                    <script>
                        alert('Authenticate user  $src');
                        
                        </script>
                        ";
                    echo"
                    <div align='center'>
                    <h2> user profile pic:</h2>
                    <img id='image' src='$src' alt='image' width='50%' height='50%' />
                    </div>";


            }else{
                echo"
        <script>
        alert('Not verified QR code');
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
}else{
    echo"
        <script>
        alert('Not valid QR');
        window.location.href='index.php';
        </script>
        ";

}

?>

