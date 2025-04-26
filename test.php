<?php

$check = mail("dispatchsilvassa@rukshmani.com","Testing Purpose","This is a Testing email from XAMPP servar",
     "From:chaudhariyogesh2732@gmail.com");

     if($check == true)
     {
         echo "email send successfully";
     }
     else
     {
         echo "email not send successfully";
     }

?>