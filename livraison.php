<?php

if(isset($_POST['envoi'])){ // si formulaire soumis
       header('Location: indexc.php?val=successdelivery');
       include('facturation.php');
       exit();
}

       $nomduclient = isset($_POST["nom-du-client"])? $_POST["nom-du-client"] : "";
       $prenomduclient = isset($_POST["prenom-du-client"])? $_POST["prenom-du-client"] : "";
       $adresse = isset($_POST["adresse"])? $_POST["adresse"] : "";
       $ville = isset($_POST["ville"])? $_POST["ville"] : "";
       $codepostal = isset($_POST["code-postal"])? $_POST["code-postal"] : "";
       $datedelivraison = isset($_POST["date-de-livraison"])? $_POST["date-de-livraison"] : "";
       

       $erreur = "";
       if ($nomduclient == "") {
              $erreur .= "Le champ Nom du Client est vide. <br>";
       }
       if ($prenomduclient == "") {
              $erreur .= "Le champ prenom du client est vide. <br>";
       }
       if ($adresse == "") {
              $erreur .= "Le champ adresse est vide. <br>";
       }
       if ($ville == "") {
              $erreur .= "Le champ ville est vide. <br>";
       }
       if ($codepostal == "") {
              $erreur .= "Le champ code postal est vide. <br>";
       }
       
       if ($datedelivraison == "") {
              $erreur .= "Le champ Date de livraison est vide. <br>";}
       if ($erreur != "") {
              echo "Erreur: <br>" . $erreur;
       } 
    if(!checkdate(12,13,2022))
           echo "Date non valide !";

    function valideDate($date, $format = 'Y-m-d H:i:s')
    {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
 }
?>