<?php
require_once 'dbConnection.php';
?>

<?php
$errPrice = '';
if (isset($_POST['submit'])) {
    session_start();
    $name = $_POST['item-name'];
    $category = $_POST['item-category'];
    $description = $_POST['item-description'];
    $state = $_POST['item-state'];
    $startPrice = $_POST['start-price'];
    $reservePrice = $_POST['reserve-price'];
    $auctionDuration = $_POST['auction-duration'];
    $image_name = $_FILES['item-image']['name'];
    $tmp_name = $_FILES['item-image']['tmp_name'];
    $saveddate = date('mdy-Hms');
    $newfilename = 'uploads/item/' . $saveddate . '_' . $image_name;
    
            move_uploaded_file($tmp_name, $newfilename);

    $startdate = new DateTime();
    $enddate = $startdate;
    $formatstart = $startdate->format('Y-m-d H:i:s');
    $sql = 'SELECT duration FROM Duration WHERE duration_id = ' . $auctionDuration;
    $result = $db->query($sql);
    $row = $result->fetch();
    $value = $row['duration'];
    $enddate = $enddate->modify('+' . $value . ' day');
    $formatend = $enddate->format('Y-m-d H:i:s');
    $typeVente = $_POST['type_vente'];
    if ($reservePrice > $startPrice) {
        $itemSQL = 'INSERT INTO Item VALUES (NULL, :item_picture, :label, :description, :state_id, :category_id)';
        $auctionSQL = 'INSERT INTO Auction VALUES (NULL, :start_price, :reserve_price, :start_price, :start_time, :duration_id, :end_time,
              DEFAULT, FALSE, LAST_INSERT_ID(), :user_id, :type_vente)';
        $itemSTMT = $db->prepare($itemSQL);
        $itemSTMT->bindParam(':item_picture', $newfilename);
        $itemSTMT->bindParam(':label', $name);
        $itemSTMT->bindParam(':description', $description);
        $itemSTMT->bindParam(':state_id', $state);
        $itemSTMT->bindParam(':category_id', $category);
        $auctionSTMT = $db->prepare($auctionSQL);
        $auctionSTMT->bindParam(':start_price', $startPrice);
        $auctionSTMT->bindParam(':reserve_price', $reservePrice);
        $auctionSTMT->bindParam(':start_time', $formatstart);
        $auctionSTMT->bindParam(':duration_id', $auctionDuration);
        $auctionSTMT->bindParam(':end_time', $formatend);
        $auctionSTMT->bindParam(':user_id', $_SESSION['user_id']);
        $auctionSTMT->bindParam(':type_vente', $typeVente);
        $db->beginTransaction();
        $itemSTMT->execute();
        if (!$itemSTMT->rowCount()) {
            $db->rollBack();
            //echo 'item stmt failed';
        } else {
            $auctionSTMT->execute();
            if (!$auctionSTMT->rowCount()) {
                $db->rollBack();
                //echo 'auction stmt failed';
            } else {
                $db->commit();
                //echo 'success db';
                header('Location: listings.php');
            }
        }
    }
    else {
        $errPrice = "Please ensure that reserve price is bigger than start price";
    }
}
?>


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
    <title>Ajouter un produit</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Core JavaScript -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript">
      function catsel(sel) {
        if (sel.value=="-1" ) return;
        var opt=sel.getElementsByTagName("option" );
        for (var i=0; i<opt.length; i++) {
          var x=document.getElementById(opt[i].value);
          if (x) x.style.display="none";
        }
        var cat = document.getElementById(sel.value);
        if (cat) cat.style.display="block";
      }
    </script>
    <script> $(function(){ $("#footer").load("footer.html"); });</script> 

</head>

<body>

<?php
include 'nav.php';
?>


<form class="form-horizontal" style="padding-top:50px" role="form" method="post" action="addauction.php"
      enctype="multipart/form-data">
    <fieldset style="padding-top:50px">
        <!-- Item Name -->
        <div class="form-group">
            <label class="col-md-4 control-label" for="item-name">Nom du produit</label>
            <div class="col-md-4">
                <input id="item-name" name="item-name" placeholder="Nom du produit" class="form-control" required>
            </div>
        </div>
        <!-- Item Category -->
        <div class="form-group">
            <label class="col-md-4 control-label" for="item-category">Catégorie</label>
            <div class="col-md-4">
                <select id="item-category" name="item-category" class="form-control" required>
                    <option selected disabled hidden>Catégorie</option>
                    <?php
                    $sql = 'SELECT * FROM Category';
                    foreach ($db->query($sql) as $row) { ?>
                        <option value="<?php echo $row['category_id']; ?>"><?php echo $row['category']; ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <!-- Item Description -->
        <div class="form-group">
            <label class="col-md-4 control-label" for="item-description">Description</label>
            <div class="col-md-4">
                <textarea class="form-control" id="item-description" name="item-description"
                          style="resize:none" required></textarea>
            </div>
        </div>
        <!-- Type de vente -->
        <table>
      <tr>
        <td>
        Type de vente :
        </td>
        <td>
          <select onchange="catsel(this)">
          <!--<option value="-1">None</option>!-->
            <option value="1" type_vente="1">Vente classique</option>
            <option value="2" type_vente="2">Vente par enchère</option>
            <option value="3" type_vente="3">Vente par négociation</option>
          </select>
        </td>
      </tr>
      <tr>
        <td colspan="2">
          <div id="1"> <!-- Vente immédiate -->
            <table border="0"><tr><td>
        <!-- Start Price -->
        <div class="form-group">
            <label class="col-md-4 control-label" for="start-price">Prix</label>
            <div class="col-md-4">
                <div class = "input-group">
                    <span class="input-group-addon">$</span>
                    <input type="number" id="start-price" name="start-price" placeholder="Prix" class="form-control" required>
                </div>
            </div>
        </div>
        <!-- Item Image -->
        <div class="form-group">
            <label class="col-md-4 control-label" for="item-image">Poster une image</label>
            <div class="col-md-4">
                <input id="item-image" name="item-image" class="input-file" type="file" required>
            </div>
        </div>
        <!-- Submit Auction -->
        <div class="form-group">
            <label class="col-md-4 control-label" for="submit"></label>
            <div class="col-md-4">
                <button id="submit" name="submit" class="btn btn-primary" required>Vendre</button>
            </div>
        </div></td></tr></table>
          </div>
          </div>
          <div id="2">
            <table border="0"><tr><td><!-- Item State -->
        <div class="form-group">
            <label class="col-md-4 control-label" for="item-state">Etat du produit</label>
            <div class="col-md-4">
                <select id="item-state" name="item-state" class="form-control" required>
                    <option value="" selected disabled hidden>Please Select a Condition</option>
                    <?php
                    $sql = 'SELECT * FROM State';
                    foreach ($db->query($sql) as $row) { ?>
                        <option value="<?php echo $row['state_id']; ?>"><?php echo $row['state']; ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <!-- Start Price -->
        <div class="form-group">
            <label class="col-md-4 control-label" for="start-price">Prix</label>
            <div class="col-md-4">
                <div class = "input-group">
                    <span class="input-group-addon">$</span>
                    <input type="number" id="start-price" name="start-price" placeholder="Prix" class="form-control" required>
                </div>
            </div>
        </div>
        <!-- Reserve Price -->
        <div class="form-group">
            <label class="col-md-4 control-label" for="reserve-price">Prix de réserve</label>
            <div class="col-md-4">
                <div class = "input-group">
                    <span class="input-group-addon">$</span>
                    <input type="number" id="reserve-price" name="reserve-price" placeholder="Prix de reserve" class="form-control" required>
                </div>
                <?php if (!empty($errPrice)){
                    echo $errPrice;
                } ?>
            </div>
        </div>
        <!-- Auction Duration -->
        <div class="form-group">
            <label class="col-md-4 control-label" for="auction-duration">Durée</label>
            <div class="col-md-4">
                <select id="auction-duration" name="auction-duration" class="form-control" required>
                    <option value="" selected disabled hidden>Durée de l'enchère</option>
                    <?php
                    $sql = 'SELECT * FROM Duration';
                    foreach ($db->query($sql) as $row) { ?>
                        <option value="<?php echo $row['duration_id']; ?>"><?php echo $row['duration']; ?> Jour(s)</option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <!-- Item Image -->
        <div class="form-group">
            <label class="col-md-4 control-label" for="item-image">Poster une image</label>
            <div class="col-md-4">
                <input id="item-image" name="item-image" class="input-file" type="file" required>
            </div>
        </div>
        <!-- Submit Auction -->
        <div class="form-group">
            <label class="col-md-4 control-label" for="submit"></label>
            <div class="col-md-4">
                <button id="submit" name="submit" class="btn btn-primary" required>Placer l'enchère</button>
            </div>
        </div></td></tr></table>
          </div>
          <div id="3">
            <table border="0"><tr><td><!-- Vente par négociation -->
        <!-- Start Price -->
        <div class="form-group">
            <label class="col-md-4 control-label" for="start-price">Prix initial</label>
            <div class="col-md-4">
                <div class = "input-group">
                    <span class="input-group-addon">$</span>
                    <input type="number" id="start-price" name="start-price" placeholder="Prix" class="form-control" required>
                </div>
            </div>
        </div>
        <!-- Item Image -->
        <div class="form-group">
            <label class="col-md-4 control-label" for="item-image">Poster une image</label>
            <div class="col-md-4">
                <input id="item-image" name="item-image" class="input-file" type="file" required>
            </div>
        </div>
        <!-- Submit Auction -->
        <div class="form-group">
            <label class="col-md-4 control-label" for="submit"></label>
            <div class="col-md-4">
                <button id="submit" name="submit" class="btn btn-primary" required>Proposer la vente</button>
            </div>
        </div></td></tr></table>
          </div>
        </td>
      </tr>
    </table>
        
    </fieldset>
</form>

<div id="footer"></div>
</body>
<script> 
$(function(){$("#footer").load("footer.html"); });
</script> 
</html>