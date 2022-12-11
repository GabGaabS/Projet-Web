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
    <title>Paiement</title>
    <link rel="site de paiement" href="./css/site_de_paiement.css">
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/shop-homepage.css" rel="stylesheet">

    <!-- Bootstrap Core JavaScript -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script> $(function(){ $("#footer").load("footer.html"); });</script> 
  <script src="https://www.paypal.com/sdk/js?client-id=test&currency=EUR"></script>
</head>
<body>
    <?php
include 'nav.php';
?>
     <div id="header">
        <center>
            <h1>Paiement</h1>
        </center>
        </div>
    <br><br><br><br><br>
    <section>
<center>
        <div id="paypal-button-container"></div>
        <script>
            paypal.Buttons({
      
      createOrder: (data, actions) => {
        return actions.order.create({
          purchase_units: [{
            amount: {
              value: '80.00'
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
</center>
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
<div id="footer"></div>
</body>
<script> 
$(function(){$("#footer").load("footer.html"); });
</script> 
</html>
