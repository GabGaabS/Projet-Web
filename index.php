<?php
require_once('dbConnection.php');
?>
<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="apple-touch-icon" sizes="180x180" href="img/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="img/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">

    <title>Connexion</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/loginregister.css" rel="stylesheet">


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <script src="js/loginregister.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>


</head>

<body>


    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-login">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-6">
                                <a href="#" class="active" id="login-form-link">Se connecter</a>
                            </div>
                            <div class="col-xs-6">
                                <a href="#" id="register-form-link">S'inscrire</a>
                            </div>
                        </div>
                        <hr>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <form id="login-form" action="login.php" method="post" role="form" style="display: block;">
                                    <div class="form-group">
                                        <input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="Nom d'utilisateur" value="">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Mot de passe">
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-6 col-sm-offset-3">
                                                <input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Se connecter">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <form id="register-form" action="signup.php" method="post" role="form" style="display: none;">
                                    <div class="form-group">
                                        <input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="Nom d'utilisateur" value="">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="firstname" id="firstname" tabindex="2" class="form-control" placeholder="Prénom" value="">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="lastname" id="lastname" tabindex="3" class="form-control" placeholder="Nom" value="">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="email" id="email" tabindex="4" class="form-control" placeholder="Email" value="">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="dob" id="dob" tabindex="5" class="form-control" placeholder="Date de naissance" value="">
                                    </div>
                                    
                                    <div class="form-group">
                                        <input type="password" name="password" id="password" tabindex="6" class="form-control" placeholder="Mot de passe">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="confirm-password" id="confirm-password" tabindex="7" class="form-control" placeholder="Confirmation">
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-6 col-sm-offset-3">
                                                <input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register" value="S'inscrire">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="errorlog" style="visibility:hidden"></div>
    
    <?php
        if(isset($_GET['val'])){
            if($_GET['val']=="success"){
                echo "<script>
                        $(function() {
                            $('#errorlog').text('Registration Successful!').css('background-color','#1CA347').css('visibility','visible');
                            $('#errorlog').delay(2000).fadeOut('slow');
                        });
                     </script>";
            }else{
                $errString;
                if($_GET['val']==1){
                    $errString = 'Les mots de passes ne correspondent pas!';
                }else if($_GET['val']==2){
                    $errString = 'Case manquante!';
                }else{
                    $errString = 'Nom d\'utilisateur ou mot de passe déjà utilisé!';
                }

                echo "<script>
                        $(function() {
                            $('#errorlog').text('".$errString."').css('background-color','#FF072D').css('visibility','visible');
                            $('#errorlog').delay(2000).fadeOut('slow');
                            $('#login-form').fadeOut(8);
                            $('#register-form').delay(10).fadeIn(10);
                            $('#login-form-link').removeClass('active');
                            $('#register-form-link').addClass('active');
                        });
                     </script>";
            }
        }

        


    ?>
<div id="footer"></div>
</body>
<script> 
$(function(){$("#footer").load("footer.html"); });
</script> 
</html>