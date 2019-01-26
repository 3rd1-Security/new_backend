<?php
  if (isset($_COOKIE['uid']) && is_numeric($_COOKIE['uid']) 
      && in_array($_COOKIE['uid'], array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10))) {
    header('Location: home.php');
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login</title>

    <!-- ================= Favicon ================== -->
    <!-- Standard -->
    <link rel="shortcut icon" href="http://placehold.it/64.png/000/fff">
    <!-- Retina iPad Touch Icon-->
    <link rel="apple-touch-icon" sizes="144x144" href="http://placehold.it/144.png/000/fff">
    <!-- Retina iPhone Touch Icon-->
    <link rel="apple-touch-icon" sizes="114x114" href="http://placehold.it/114.png/000/fff">
    <!-- Standard iPad Touch Icon-->
    <link rel="apple-touch-icon" sizes="72x72" href="http://placehold.it/72.png/000/fff">
    <!-- Standard iPhone Touch Icon-->
    <link rel="apple-touch-icon" sizes="57x57" href="http://placehold.it/57.png/000/fff">

    <!-- Styles -->
    <script type="text/javascript" src="assets/js/jquery-3.3.1.min.js"></script>
    <link href="assets/css/lib/font-awesome.min.css" rel="stylesheet">
    <link href="assets/css/lib/themify-icons.css" rel="stylesheet">
    <link href="assets/css/lib/bootstrap.min.css" rel="stylesheet">
    <link href="assets/js/lib/jquery.min.js" rel="text/javascript">
    <link href="assets/css/lib/helper.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    
    
        <style>
            .bg-primary .unix-login .container-fluid .row .col-lg-6 .login-content{
                border: 2px solid #000;
            }
        </style>
        
    
    
</head>

<body class="bg-primary">

    <div class="unix-login">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="login-content"  style="margin: 0; padding: 0;"s>
                        <div class="login-logo" style="color: #000;font-size: 2.8em;">
                                Saksham Bharat
                            </div>
                            <div class="login-form">
                            <h4>Administratior Login</h4>
                             <!--div id="wrapper">
                                <div id="success">Fool</div>
                                <div id="err"></div>
                            </div-->
                            <form method="POST" action="check_login.php">
                                <div class="form-group">
                                    <label>Email address</label>
                                    <input type="email" name="email" class="form-control" placeholder="Email" id="email">
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" name="password" class="form-control" placeholder="Password" id="password">
                                </div>
                                <div class="checkbox">
                                    <label>
                    <input type="checkbox"> Remember Me
                  </label>
                                    <label class="pull-right">
                    <a href="#">Forgotten Password?</a>
                  </label>

                                </div>
                                <button type="submit" class="btn btn-primary btn-flat m-b-30 m-t-30" id="login">Sign in</button>
                                <div class="register-link m-t-15 text-center">
                                    <p>Don't have account ? <a href="register.php"> Sign Up Here</a></p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<script type="text/javascript">
  <?php
    echo (isset($_GET['err']) && $_GET['err'] == 'invalid') ? 'alert("Invalid Credentials!")' : '';
  ?>
</script>

</html>