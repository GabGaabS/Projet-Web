<?php
$dsn = 'mysql:host=localhost;dbname=ebay_clone';
$db_user = 'root';
$db_pass = '';

try{
    $db = new PDO($dsn, $db_user, $db_pass);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e){
    echo "Error: " . $e->getMessage();
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
$mail->CharSet = 'UTF-8'; //Format d'encodage à utiliser pour les caractères
$mail=SELECT email FROM users;
$blaze=SELECT last_name,first_name FROM users;


$mail->From       =  'OmnesMarketPlace@edu.ece.fr';                //L'email à afficher pour l'envoi
$mail->FromName   = 'Contact de Omnes MarketPlace';             //L'alias à afficher pour l'envoi

$mail->Subject    =  'Facture';                      //Le sujet du mail
$mail->WordWrap   = 500;                                //Nombre de caracteres pour le retour a la ligne automatique
$mail->AltBody = 'Bonjour,<br> Nous vous remercions de commander chez nous, notre équipe et moi, nous espérons vous revoir bientôt.<br> Cordialement.<br> Le groupe Omnes MarketPlace;          //Texte brut
$mail->IsHTML(false);                                  //Préciser qu'il faut utiliser le texte brut

if($Use_HTML == true){
   $mail->MsgHTML('<body>
        <header>
            <h1>Facture</h1>
                <p>Omnes MarketPlace</p>
                <p>Immeuble POLLUX
                <br>
                        37, Quai de Grenelle
                        75015 Paris
                        Tel : 01 44 39 06 00
                </p>
            
        </header>');                       //Le contenu au format HTML
   $mail->IsHTML(true);
}

$mail->addAddress("$mail", "$blaze");
$mail->addReplyTo("OmnesMarketPlace@edu.ece.fr", "Omnes Market Place");

if (!$mail->send()) {
      echo $mail->ErrorInfo;
} else{
      echo 'Message bien envoyé';
}