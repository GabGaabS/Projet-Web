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
	<title>Panier</title>
	<meta charset="utf-8"> 
	<!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/shop-homepage.css" rel="stylesheet">

    <!-- Bootstrap Core JavaScript -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script> $(function(){ $("#footer").load("footer.html"); });</script> 
</head>
<body>
	<?php include('nav.php');?>
	<Div Align=Center> <h3>Panier</h3>
		<img src="panier.png" alt="Panier " height="250" width="250">
	<br><br><br><br><br><br><br><br><br><br>
		<form action="site_de_paiement.php" method="post">
			<table>
				<tr>
					<td>Le montant à payer est:</td>
					<td><input type="number" step="0.01" name="amount"></td>
				</tr> 
				<tr>
					<td colspan="2" align="center">
					<button onclick="window.location.href = 'file://C:\wamp64\www\web\site_de_paiement.php';">Cliquez Ici</button>
					</td> 
				</tr>
			</table> <br> </Div>
				
</form>
<div id="footer"></div>
</body>
<script> 
$(function(){$("#footer").load("footer.html"); });
</script> 
</html>




<?php

	//si le bouton est cliqué
	if (isset($_POST["button1"])) {

		//montant à payer
		$montant = isset($_POST["amount"])? $_POST["amount"] : "";
		if (empty($montant)) { 
			$montant = 0.0;
		}
		//si une selection de carte de crédit est faite
		$card = isset($_POST["creditCard"])? $_POST["creditCard"] :"";
		
		//afficher information sur le paiement
		echo "<br>Le montant à payer est: " . $montant;
		echo "<br>A payer par: " . $card;
	}
?>