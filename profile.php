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

    <title>Profile</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/profile.css" rel="stylesheet">
    <link href="css/rating.css" rel="stylesheet">

    <!-- Bootstrap Core JavaScript -->

    <link class="jsbin" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/base/jquery-ui.css"
          rel="stylesheet" type="text/css"/>
    <script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.0/jquery-ui.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/rating.js"></script>
    <meta charset=utf-8/>
</head>

<body>
<?php include('nav.php');
require("dbConnection.php");
$ctrl = true;
$userSEI = $_SESSION['user_id']; 
if (isset($_GET["user"])) {
    $ctrl = false;
    $user = $_GET["user"];
} else {
    $ctrl = true;

//        Get the user signed in if we don't specify a user in URL
    $user = $_SESSION['user_id'];
}
//
$resp = $db->prepare('SELECT * FROM Users WHERE user_id = :user');
$resp->bindParam(':user', $user);
$resp->execute();
$data = $resp->fetch();
$resp->closeCursor();

//    Need to check if set and also not yourself as you cant vote for yourself
if (isset($_GET["user"]) && $user != $_SESSION['user_id']) {
//        Use the foreign user if referring to someone in URL
    include('foreign.php');
} else {
//        Use the foreign user if referring to someone in URL
    include('self.php');
}
?>

<div id="footer"></div>
</body>
<script> 
$(function(){$("#footer").load("footer.html"); });
</script> 
</html>