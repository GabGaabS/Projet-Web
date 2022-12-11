<?php
require("dbConnection.php");

if(isset($_POST["username"],$_POST["password"])){

    $resp = $db->prepare('SELECT user_id, username, role_id FROM Users WHERE username = :username AND passwd = :password');

    $hashedPass = sha1($_POST["password"],false);

    $resp->bindParam(':username',$_POST["username"]);
    $resp->bindParam(':password',$hashedPass); #Le mdp est crypté un peu ( du bon sha1 )

    $resp->execute();

    if($resp->rowCount() == 0){
        echo "Nom d'utilisation ou Mot de passe incorrectes !";
        header("Location: index.php");
    }else{
        $data = $resp->fetch();
        session_start();
        $y = $data["user_id"];
        $_SESSION["role_id"] = $data["role_id"];
        $_SESSION["user_id"] = $y;
        $_SESSION["first_name"] = $data["username"];
        header("Location: indexc.php");
    }
}else{
    echo "Problème de connexion, ré-essayez";
    header("Location: index.php");
}
?>