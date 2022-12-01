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
