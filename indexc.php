<?php
require("dbConnection.php");
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Accueil</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i">
    <link rel="stylesheet" href="./css/Roboto.css">
    <link rel="stylesheet" href="./fonts/font-awesome.min.css">
    <link rel="stylesheet" href="./css/Footer-Basic.css">
    <link rel="stylesheet" href="./css/Map-Clean.css">
    <link rel="stylesheet" href="./css/Shop-item-1.css">
    <link rel="stylesheet" href="./css/Shop-item.css">
    <link rel="stylesheet" href="./css/Shopping-Grid.css">
    <link rel="stylesheet" href="./css/untitled.css">
        <link rel="apple-touch-icon" sizes="180x180" href="img/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="img/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <script> $(function(){ $("#footer").load("footer.html"); });</script> 
</head>

<body>
    <?php include('nav.php');
    if(isset($_GET['val'])){
        if($_GET['val']=="successdelivery"){
                echo "<script>
                        $(function() {
                            $('#errorlog').text('Commande passée avec succes!').css('background-color','#1CA347').css('visibility','visible');
                            $('#errorlog').delay(2000).fadeOut('slow');
                        });
                     </script>";
            }}
    ?>
    <header class="" style="background-color: #140e0e;background-image: url('./img/fdprojet1.jpg');opacity: 1;">
        <div class="masthead-content"></div>
        <center>
        <h2 class="masthead-subheading mb-0" style="font-size: 40px;" >Site de vente réalisé par les étudiants de L'ECE</h2>
        <h1 class="masthead-heading mb-0" style="font-size: 100px;">Omnes MarketPlace</h1>
        </center>
    </header><div class="shopping-grid">
    <div class="container">
    <h2 class="text-center"><FONT color="black" face=impact ><b>Ventes flash<b><br> Des offres à ne pas rater!!!</FONT></h2>
    <div class="row">
            <div class="product-grid7">
                <?php
                $sql = "SELECT A.current_bid, A.auction_id, I.item_picture, I.label, I.description, S.state 
            FROM Auction A, Item I, State S ORDER BY RAND() LIMIT 4";
                $stmt = $db -> prepare($sql);
                $stmt -> execute();
                $result = $stmt -> fetchAll();
                ?>
    <div class="col-md-12" style="padding-top:2px">
        <?php
        foreach ($result as $item) {
             {?>
        <div id="auction" class="col-md-3">
            <div class="thumbnail">
                <img src="<?php echo $item['item_picture']; ?>" alt="Item image" style="width:450px; height:250px">
                <div class="caption">
                    <h4 class="pull-right">$ <?php echo $item['current_bid']; ?></h4>
                    <h4><a href="productpage.php?auct=<?php echo $item['auction_id']; ?>"><?php echo $item['label']; ?> (<?php echo $item['state']; ?>)</a></h4>
                    <p><?php echo $item['description']; ?></p>
                </div>
            </div>
        </div>
        <?php }} ?>
</div>
</div>
    <div></div>
    <div></div>
    <div class="map-clean">
        <div class="container">
            <div class="intro">
                <h2 class="text-center">Où sommes-nous ?</h2>
                <p class="text-center">Retrouvez notre shop directement à l'adresse:<br>Immeuble POLLUX37,<br> Quai de Grenelle<br>75015 Paris<br>Tel : 01 44 39 06 00<br>Email :  OmnesMarketPlace@edu.ece.fr</p>
            </div>
        </div>
        <center>
        <iframe allowfullscreen frameborder="0" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2625.35566398962!2d2.2864078148539444!3d48.85142790915226!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e6701b4f58251b%3A0x167f5a60fb94aa76!2sECE.%20Ecole%20d&#39;ing%C3%A9nieurs.%20Engineering%20school.!5e0!3m2!1sfr!2sfr!4v1670777969911!5m2!1sfr!2sfr" width="100%" height="450" referrerpolicy="no-referrer-when-downgrade" ></iframe>

    </center>
    </div>
    <script
        src="./js/jquery.min.js"></script>
        <script src="./bootstrap/js/bootstrap.min.js"></script>
<div id="footer"></div>
</body>
<script> 
$(function(){$("#footer").load("footer.html"); });
</script> 
</html>