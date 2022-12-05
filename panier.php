<!DOCTYPE html>
<html>
<head>
	<title>Panier</title>
	<meta charset="utf-8"> 
</head>
<body>
	<Div Align=Center> <h3>Panier</h3>
		<img src="panier.png" alt="Panier " height="250" width="250">
	<br><br><br><br><br><br><br><br><br><br>
		<form action="TP5_Ex4_creditCard.php" method="post">
			<table>
				<tr>
					<td>Le montant à payer est:</td>
					<td><input type="number" step="0.01" name="amount"></td>
				</tr> 
				<tr>
					<td colspan="2" align="center">
					<input type="submit" name="button1" value="Submit">
					</td> 
				</tr>
			</table> <br> </Div>
				
</form>
</body> 
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