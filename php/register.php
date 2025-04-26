<?php
require("db.php");

if($_SERVER['REQUEST_METHOD'] == "POST")
{
    $pattern = "1234567890";

    $length = strlen($pattern)-1;

    $v_code = [];

   for($i=0;$i<6;$i++)
   {
    $index = rand(0,$length);
 
    $v_code[] = $pattern[$index];
   }

   $ver_code =  implode($v_code);

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $check = "SELECT email FROM users WHERE email = '$email'";
    $response  = $db->query($check);

    if($response->num_rows != 0)
    {
        echo "usermatch";
    }
    else
    {
       $send_atc = mail($email,"Activation Code","Thank you For Choosing our Product <br>
                        Your Activation Code is".$ver_code,"From:chaudhariyogesh2732@gmail.com");

                        if($send_atc)
                        {
                            $store = "INSERT INTO users(full_name,email,password,activation_code)
                            VALUES('$username','$email','$password','$ver_code')";

                            if($db->query($store))
                            {
                             echo "success";
                            }
                            else
                            {
                            echo "failed";
                            }
                            
                        }
                        else
                        {
                            echo "Try again with other Email Id";
                        }
    }

}
else
{
    echo "unauthorised request";
}
?>