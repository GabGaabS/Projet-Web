
<!DOCTYPE html>
<html lang="en">
<center>
<head>

	<header>
			<link rel="site de paiement" href="./css/site_de_paiement.css">
		<div id="header">
			<h1>Paiement</h1>
		</div>
	</header>
	<br><br><br><br><br>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Shop Homepage - Start Bootstrap Template</title>
  <script src="https://www.paypal.com/sdk/js?client-id=test&currency=EUR"></script>
</head>
<body>
	<section>

  		<div id="paypal-button-container"></div>
  		<script>
    		paypal.Buttons({
      
      createOrder: (data, actions) => {
        return actions.order.create({
          purchase_units: [{
            amount: {
              value: <?php
              $total = $panier->getTotal()/100;
              ?>
            }
          }]
        });
      },
      // Finalize the transaction after payer approval
      onApprove: (data, actions) => {
        return actions.order.capture().then(function(orderData) {
          console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
          const transaction = orderData.purchase_units[0].payments.captures[0];
          alert(`Transaction ${transaction.status}: ${transaction.id}\n\nSee console for all available details`);

        });
      }
    }).render('#paypal-button-container');
  </script>

</section>
  <section>
  	
  <h2>adresse de livraison</h2>
  <form action="livraison.php" method="post">
              <style type="text/css">
               body{
                   background-color: #eeee;
               }
               h2 {
                   text-align : center;
                   color : black;
                   padding: 20px;
                   width : 650px;
                   margin : 0 auto 20px auto;
                   border-radius: 5px;

               }
               table{
                   width: 660px;
                   margin: auto;
                   background-color: #FFD700;}
              </style>
               <table border="1">
                      
                     <tr>
                            <td>Nom du client </td>
                            <td><input type="text" name="nom-du-client"></td>
                     </tr>
                     <tr>
                            <td> Prenom du client </td>
                            <td>
                                   <input type="text" name="prenom-du-client">
                            </td>
                            <br />
                     </tr>
                     <tr>
                            <td> adresse </td>
                            <td>
                                   <input type="text" name="adresse">
                            </td>
                            <br />
                     </tr>
                     <tr>
                            <td> ville </td>
                            <td>
                                   <input type="text" name="ville">
                            </td>
                            <br />
                     </tr>
                     <tr>
                            <td> code postal </td>
                            <td>
                                   <input type="text" name="code-postal">
                            </td>
                            <br />
                     </tr>
                     <tr>
                            <td> date de livraison</td>
                            <td>
                                   <input type="date" name="date-de-livraison">
                            </td>
                            <br />
                     </tr>
            


                     <tr>
                            <td colspan="2" align="center"><input type="submit"
                                   name="Valider" value="Valider"></td>
                            </tr>
              

       </table>
       </form>
</section>
</center>
<footer>
	<center>
		<h3>Restons en contact</h3>
        <p class="Emplois"> <br>
        	Email :  OmnesMarketPlace@edu.ece.fr
            <br>
            Adresse:
            POLLUX
            37, Quai de Grenelle
            75015 Paris<br>
            Tel : 01 44 39 06 00
            </p>
        </center>

    </footer>
</body>
   
</body>
</html>
