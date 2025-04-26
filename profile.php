<?php

session_start();

if(empty($_SESSION['user']))
{
    header("Location:login.php");
}

require("php/db.php");

$user_email = $_SESSION['user'];

$user_sql = "SELECT * FROM users WHERE email = '$user_email'";

$user_res = $db->query($user_sql);

$user_data = $user_res->fetch_assoc();

$user_name = $user_data['full_name'];

$total_storage = $user_data['storage'];

$used_storage = $user_data['used_storage'];

$per = round(($used_storage*100)/$total_storage,2);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" 
    integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<style>
    .main-container{
        width: 100%;
        height: 100vh; 
    }
    .left{
        width:17%;
        height: 100%;
        background-color:#080429; 
    }
    .right{
        width:83%;
        height:100%;
        overflow:auto;   
    }
    .profile_pic{
        width:100px;
        height: 100px;
        border-radius:100%;
        border:4px solid white;
    }

    .line
    {
        background-color :#fff !important;
        width: 100%;
        height:2px;
    }

    .storage{
        width:80%;
    }
</style>

<body>
    <div class="main-container d-flex">
        <div class="left">
            <div class="d-flex justify-content-center align-items-center flex-column pt-5">
                <div class = "profile_pic d-flex justify-content-center align-items-center">
                    <i class="fa fa-user fs-1 text-white"></i>
                </div>
                <span class = "text-white fs-3 mt-3"><?php echo $user_name; ?></span>

                <hr class="line">

                <button class="btn btn-light rounded-pill upload"><i class="fa fa-upload"></i>Upload File</button>
                <hr class="line">

                <span class="text-white mb-2">STORAGE</span>
                <div class ="progress storage">
                    <div class="progress-bar bg-primary" style= "width:<?php echo $per; ?>%"></div>
                </div>

                <span class="text-white"><span><?php echo round($used_storage,2) ?>MB</span>/<?php echo round($total_storage,2)?>MB</span>



                <a href="php/logout.php" class="btn btn-light rounded-pill mt-3">Logout</a>

            </div>
        </div>

        <div class="right">
        <nav class="navbar navbar-light bg-light p-3 shadow-sm sticky-sm-top">
          <div class="container-fluid">

           <form class="d-flex ms-auto" role="search">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
             <button class="btn btn-outline-primary" type="submit">Search</button>
           </form>

          </div>
        </nav>
        <div class="content p-4">
            <h1>Lorem ipsum dolor sit amet consectetur adipisicing elit. Asperiores ducimus autem pariatur. Quaerat maxime cumque accusamus sunt corporis sapiente dolorum ex id numquam amet commodi consequuntur officia odit perspiciatis porro, ducimus est! Dignissimos cumque omnis sunt praesentium, placeat neque, quidem iure repudiandae error doloribus excepturi. Impedit minima ea magnam? Quisquam voluptatum magnam sunt dolorum vel eius repellat quaerat sint, corporis quo iste ab voluptates hic deleniti! Amet omnis aperiam ducimus laborum mollitia? Consequuntur harum nihil, ducimus vitae reiciendis doloribus molestiae velit aperiam numquam aliquid cumque obcaecati sint iusto provident recusandae neque voluptate minus aspernatur laborum amet in ullam. Aliquid saepe nobis beatae tempore unde sapiente id. Ipsam necessitatibus unde hic in dignissimos suscipit voluptatum nulla nostrum, consectetur, nemo eaque. Quaerat, blanditiis maiores, nihil eveniet id dolorem hic nemo alias cupiditate sit sunt recusandae nesciunt magnam esse rerum sint porro illo doloribus voluptatibus officia velit! Nam dolorum, laudantium aliquam, nesciunt, repellat qui nihil repellendus laborum adipisci eius nulla perferendis itaque dolores non. Eius doloribus eum perferendis nesciunt ipsa, rem harum possimus non. Repellendus optio nisi dignissimos iusto recusandae, quibusdam et aliquid. Eos, aspernatur mollitia tenetur eius facilis repellendus maiores dolor cumque cum, architecto, 
                alias esse quam praesentium! Quam aperiam voluptates qui.</h1>
        </div>
        
        </div>

    </div>
    <script>
        $(document).ready(function(){
            $(".upload").click(function(){
                var input = document.createElement("INPUT");
                input.setAttribute("type","file");
                input.click();
                input.onchange = function(){
                    var file = new FormData();
                    file.append("data",input.files[0]);

                    $.ajax({
                        type:"POST",
                        url:"php/upload.php",
                        data:file,
                        processData:false,
                        contentType:false,
                        cache:false,
                        success:function(response){
                            console.log(response);
                        }
                    })
                }
            })
        });
    </script>

</body>
</html>