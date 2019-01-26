<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Registration</title>

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
        
        <link href="assets/css/lib/font-awesome.min.css" rel="stylesheet">
        <link href="assets/css/lib/themify-icons.css" rel="stylesheet">
        <link href="assets/css/lib/bootstrap.min.css" rel="stylesheet">
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
                        <div class="login-content" style="margin: 0; padding: 0;">
                            <div class="login-logo" style="color: #000;font-size: 2.8em;">
                                Saksham Bharat
                            </div>
                            <div class="login-form">
                                <h4>Register to Administration</h4>
                                <form>
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" class="form-control" name="name" placeholder="Name" id="name" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Email address</label>
                                        <input type="email" class="form-control" name="email" placeholder="Email" id="email" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" class="form-control" name="password" placeholder="Password" id="password" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Educational Qualification</label>
                                        <input type="text" class="form-control" name="qualif" placeholder="Educational Qualification" id="qualification">
                                    </div>
                                    <div class="form-group">
                                        <label>Occupation</label>
                                        <input type="text" class="form-control" name="occupation" placeholder="Occupation" id="occupation">
                                    </div>
                                   
                                    <div class="form-group">
                                        <label>Category</label>
                                        <div class="container">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="catagory" id="govt" value="Government Official">
                                            <label class="form-check-label" for="govt">Government Official</label>
                                        </div>
                                         <div class="form-check">
                                            <input class="form-check-input" type="radio" name="catagory" id="investor" value="Investor" checked="checked">
                                            <label class="form-check-label" for="investor">Investor</label>
                                        </div>
                                         <div class="form-check">
                                            <input class="form-check-input" type="radio" name="catagory" id="aspirant" value="Aspirant">
                                            <label class="form-check-label" for="aspirant">Aspirant</label>
                                        </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Gender</label>
                                        <div class="container">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="gender" id="male" value="Male" checked="checked">
                                            <label class="form-check-label" for="male">Male</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="gender" id="female" value="Female">
                                            <label class="form-check-label" for="female">Female</label>
                                        </div>
                                            <div class="form-check">
                                            <input class="form-check-input" type="radio" name="gender" id="others" value="Others">
                                            <label class="form-check-label" for="female">Others</label>
                                        </div>
                                        </div>
                                    </div>
                                   <div class="form-group">
                                        <label>Employment Status</label>
                                       <div class="container">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="status" id="yes" value="Yes" checked="checked">
                                            <label class="form-check-label" for="yes">Yes</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="status" id="no" value="No">
                                            <label class="form-check-label" for="no">No</label>
                                        </div>
                                       </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Aim</label>
                                        <textarea class="form-control" id="aim" name="aim" rows="3"></textarea>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox"> Agree the terms and policy 
                                        </label>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-flat m-b-30 m-t-30" id="register">Register</button>
                                    <div class="register-link m-t-15 text-center">
                                        <p>Already have account ? <a href="page-login.html"> Sign in</a></p>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript" src="assets/js/jquery-3.3.1.min.js"></script>
        <script type="text/javascript">
            
        $(function() {
            
            $('#register').click(function(e) {
                e.preventDefault();
                var name = $("input[name=fname]").val().trim(),
                    email = $("input[name=email]").val().trim(),
                    password = $("input[name=password]").val().trim(),
                    occupation = $("input[name=occupation]").val().trim(),
                    qualif = $("input[name=qualif]").val().trim(),
                    catagory = $("input[name=catagory]").val().trim(),
                    gender = $("input[name=gender]").val().trim(),
                    employ = $("input[name=employ]").val().trim(),
                    aim = $("input[name=aim]").val().trim();

                    $.post("register_control.php",
                    {
                        name: name,
                        email: email,
                        password: password,
                        occupation: occupation,
                        qualif: qualif,
                        catagory: catagory,
                        gender: gender,
                        employ: employ,
                        aim: aim

                    },function(data, status){
                        console.log("Response");
                        console.log("Data: " + data + "\nStatus: " + status);
                        if(status=='success'){
                            console.log(data);

                            if(data["status"]=="200"){         
                                alert("Registered successfully. Verification mail has been sent.");
                            }else{
                                alert("Error!"+data['message']);
                            }
                        }else{
                            console.log("Failed "+data);
                            alert("Invalid Credentials!!");
                        }
                    },"json");
            });
        });

        </script>
    </body>
    
</html>
