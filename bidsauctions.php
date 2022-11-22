<?php

include_once 'dbConnection.php';
//session_start();
if (isset($_POST['winConfirm'])) {
    include 'mailer.php';

    $mail->addAddress($_POST['sellerMail'], $_POST['sellerName']);

    //Set the subject line
    $mail->Subject = 'Votre enchère a été complétée avec succès!';

    //Replace the plain text body with one created manually
    $mail->Body = $_POST['buyerName'] . ' a remporté votre enchère pour ' . $_POST['winningBid'] . '. Le montant correspondant sera versé sur votre compte.';

    //send the message, check for errors
    if (!$mail->send()) {
        echo "Erreur mail: " . $mail->ErrorInfo;
    } else {
        echo "Message envoyé!";
    }


    $mail->clearAddresses();



    $mail->addAddress($_POST['buyerMail'], $_POST['username']);

    $mail->Subject = 'Vous avez remporté une enchère avec succès';

    $mail->Body = 'Vous avez gagné le ' . $_POST['itemlabel'] . ' enchères! Le montant correspondant sera déduit de votre compte.';

    if (!$mail->send()) {
        echo "Erreur mail: " . $mail->ErrorInfo;
    } else {
        echo "Message envoyé!";
    }

    $id = $_POST['auction_id'];
    $updatesql = "UPDATE Auction
                                        SET win_confirmed=1
                                        WHERE auction_id=:auctionID";
    //                                echo $updatesql;
    $stmt = $db->prepare($updatesql);
    $stmt->bindParam(':auctionID', $id);
    $stmt->execute();
    header('location: bidsauctions.php');
}

if (isset($_POST['stopAuction']) and is_numeric($_POST['stopAuction'])) {
    $now = new DateTime();
    $time = $now->format("Y-m-d H:i:s");
    $id = $_POST['stopAuction'];
//                                echo $time;
    $updatesql = "UPDATE Auction
                                SET end_time=:nowtime
                                WHERE auction_id=:auctionID";
//                                echo $updatesql;
    $stmt = $db->prepare($updatesql);
    $stmt->bindParam(':nowtime', $time);
    $stmt->bindParam(':auctionID', $id);
    $stmt->execute();
    header('location: bidsauctions.php');
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

    <title>Produit</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <script src="js/jquery.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <script src="clockCode/countdown.js"></script>
    <script>
        $('#confirmwin').on('click', function () {
            var $el = $(this),
                textNode = this.lastChild;
            $el.find('span').toggleClass('glyphicon-fire glyphicon-road');
            textNode.nodeValue = ($el.hasClass('showArchived') ? 'Confirm Win' : 'Win Confirmed');
            $el.toggleClass('showArchived');
        });
    </script>

</head>

<body>

<!-- Navigation -->
<?php
include 'nav.php';
?>

<div class="container" style="padding-top:50px">
    <div class="row" style="padding-top:50px">
        <div class="col-sm-12 col-md-10 col-lg-12">
            <!--            Start of table-->
            <table class="table table-hover">
                <!--                    This is the headers of the table-->
                <thead>
                <tr>
                    <th>Product</th>
                    <th class="text-center">Info</th>
                    <?php
                    if ($_SESSION['role_id'] == 2) {
                        echo '<th class="text-center">Prix d\'achat immédiat</th>';
                    } else if ($_SESSION['role_id'] == 1) {
                        echo '<th class="text-center">Votre dernier prix</th>';
                    }
                    ?>
                    <?php
                    if ($_SESSION['role_id'] == 2) {
                        echo '<th class="text-center">Prix actuel</th>';
                    } else if ($_SESSION['role_id'] == 1) {
                        echo '<th class="text-center">Prix actuel</th>';
                    }
                    ?>
                    <th> Action</th>
                </tr>
                </thead>
                <!--                The body of the table-->
                <tbody>
                <?php
                $userid = $_SESSION['user_id'];
                //If bidder
                if ($_SESSION['role_id'] == 1) {
                    $sql = "SELECT a.auction_id,a.reserve_price, a.viewings, i.label,i.item_picture,max(b.bid_price) as bid_price,u.first_name, u.username, b.user_id, a.user_id AS sellerID, u.email, a.end_time, a.current_bid FROM Bids b
                            INNER JOIN Auction a ON a.auction_id = b.auction_id
                            INNER JOIN Users u ON u.user_id = a.user_id
                            INNER JOIN Item i ON a.item_id = i.item_id WHERE b.user_id = $userid
                            GROUP BY b.auction_id ORDER BY a.end_time DESC";
                }
                //               //If seller
                if ($_SESSION['role_id'] == 2) {
//                    No information on bids
                    $sql = "SELECT * FROM Auction a
                            INNER JOIN Users u ON a.user_id = u.user_id
                            INNER JOIN Item i ON a.item_id = i.item_id WHERE a.user_id = $userid
                            ORDER BY a.end_time DESC";
                }
                try {
                    $data = $db->query($sql);
                    $data->setFetchMode(PDO::FETCH_ASSOC);
                } catch (PDOException $e) {
                    echo 'ERROR: ' . $e->getMessage();
                }
                ?>
                <?php while ($bidauction = $data->fetch()): ?>
                    <tr style="vertical-align">
                        <td class="col-sm-12 col-md-4">
                            <div class="media">
                                <a class="thumbnail pull-left" href="#"> <img class="media-object"
                                                                              src="<?php
                                                                              echo $bidauction['item_picture'];
                                                                              ?>"
                                                                              style="width: 72px; height: 72px;"> </a>
                                <div class="media-body">
                                    <h4 class="media-heading">
                                        <a href="productpage.php?auct=<?php echo $bidauction['auction_id']; ?>">
                                            <?php
                                            echo htmlspecialchars($bidauction['label']);
                                            ?></a></h4>
                                    <?php
                                    if ($_SESSION['role_id'] == 1) {
                                        ?>
                                        <h5 class="media-heading"> Vendu par: <a
                                                href="profile.php?user=<?php echo $bidauction['sellerID']; ?>"><?php
                                                echo htmlspecialchars($bidauction['username'])
                                                ?></a></h5>
                                        <?php
                                    }
                                    ?>
                                    <?php
                                    $auctionID = $bidauction['auction_id'];
                                    $bidSQL = 'SELECT u.user_id, u.username, u.email, u.first_name, u.last_name, a.win_confirmed FROM
                                            Bids b, Users u, Auction a WHERE b.user_id =u.user_id AND b.auction_id =:auctionID AND a.auction_id =:auctionID ORDER BY b.bid_price DESC LIMIT 1';
                                    $bidSQL = $db->prepare($bidSQL);
                                    $bidSQL->bindParam(':auctionID', $auctionID);
                                    $bidSQL->execute();
                                    $result = $bidSQL->fetch();
                                    $enddt = strtotime($bidauction['end_time']);
                                    ?>
                                    <!--                                    Time remaining in days and minutes-->
                                    <h5 id="timeRem" class="media-heading"> Temps restant: <em>
                                            <?php
                                            $daysremaining = date("z", $enddt) - date("z");
                                            $hoursremaining = date("G", $enddt) - date("G");
                                            $minutesremaining = date("i", $enddt) - date("i");
                                            $secondsremaining = date("s", $enddt) - date("s");
                                            if ($enddt > time()) {
                                                if ($daysremaining >= 1) {
                                                    echo htmlspecialchars($daysremaining) . ' jours' . ' ';
                                                    if ($hoursremaining > 0) {
                                                        echo htmlspecialchars($hoursremaining) . ' heures' . ' ';
                                                    } else {
                                                        echo '0 heure ';
                                                    }
                                                } else if ($daysremaining < 1) {
                                                    if ($hoursremaining >= 1) {
                                                        if ($hoursremaining > 0) {
                                                            echo htmlspecialchars($hoursremaining) . ' heures' . ' ';
                                                        } else {
                                                            echo '0 heure ';
                                                        }
                                                        if ($minutesremaining > 0) {
                                                            echo htmlspecialchars($minutesremaining) . ' minutes' . ' ';
                                                        } else {
                                                            echo '0 minute ';
                                                        }
                                                        if ($secondsremaining > 0) {
                                                            echo htmlspecialchars($secondsremaining) . ' secondes';
                                                        } else {
                                                            echo '0 seconde ';
                                                        }
                                                    } else if ($hoursremaining < 1) {
                                                        if ($minutesremaining > 0) {
                                                            echo htmlspecialchars($minutesremaining) . ' minutes' . ' ';
                                                        } else {
                                                            echo '0 minute ';
                                                        }
                                                        if ($secondsremaining > 0) {
                                                            echo htmlspecialchars($secondsremaining) . ' secondes';
                                                        } else {
                                                            echo '0 seconde ';
                                                        }
                                                    }
                                                }
                                            } else {
                                                echo 'Désolé, temps expiré!';
                                            };
                                            ?>
                                        </em>
                                    </h5>
                                    <!--                                    If your bid is more than current bid, bid isnt finished etc-->
                                    <?php
                                    if ($_SESSION['role_id'] == 1) {
                                        echo '<span>Status: </span><span class="text-success"><strong>';

                                        if ($bidauction['bid_price'] >= $bidauction['current_bid'] && $enddt > time()) {
                                            echo 'Plus offrant';
                                        }
                                        if ($bidauction['bid_price'] < $bidauction['current_bid'] && $enddt > time()) {
                                            echo 'Losing Item';
                                        }
                                        if ($bidauction['bid_price'] < $bidauction['current_bid'] && $enddt < time()) {
                                            echo 'Produit perdu';
                                        }
                                        if ($bidauction['bid_price'] >= $bidauction['current_bid'] && $enddt < time() && $result['win_confirmed'] == 1) {
                                            echo 'Achat confirmé';
                                        }
                                        if ($enddt < time() && $result['win_confirmed'] == 0 && $bidauction['current_bid'] > $bidauction['reserve_price'] && $bidauction['bid_price'] >= $bidauction['current_bid'] ) {
                                            echo 'Produit gagné mais non confirmé';
                                        }
                                        if ($enddt < time() && ($bidauction['current_bid'] < $bidauction['reserve_price'])) {
                                            echo 'N\'a pas atteint le prix immédiat';
                                        }
                                    }
                                    if ($_SESSION['role_id'] == 2) {
                                        echo '<span>Status: </span><span class="text-success"><strong>';
                                        if ($enddt > time()) {
                                            echo 'Enchère en cours';
                                        }

                                        if ($result['win_confirmed'] == 1) {
                                            echo 'Win Confirmed';
                                        }
                                        if ($enddt <= time() && $result['win_confirmed'] == 0 && $bidauction['current_bid'] > $bidauction['reserve_price']) {
                                            echo 'Item Won but Unconfirmed';
                                        }
                                        if ($enddt <= time() && ($bidauction['current_bid'] < $bidauction['reserve_price'])) {
                                            echo 'Didn\'t meet reserve';
                                        }
                                    }
                                    echo '</strong></span>';

                                    ?>

                                </div>
                            </div>
                        </td>
                        <td class="col-sm-2 col-md-2"><strong></strong>
                            <h5 class="media-heading"> Nombre d'enchère: <?php
                                $numsql = "SELECT count(b.bid_id) as bidcount FROM Bids b
                            WHERE auction_id=$auctionID GROUP BY auction_id ";
                                try {
                                    $numdata = $db->query($numsql);
                                    $numdata->setFetchMode(PDO::FETCH_ASSOC);
                                    $numbids = $numdata->fetch();
                                } catch (PDOException $e) {
                                    echo 'ERROR: ' . $e->getMessage();
                                }
                                echo htmlspecialchars($numbids['bidcount']);
                                ?></h5>
                            <h5 class="media-heading"> Highest Bidder: <a
                                    href="profile.php?user=<?php echo $result['user_id']; ?>"><?php
                                    echo htmlspecialchars($result['username'])
                                    ?></a></h5>
                            <h5 class="media-heading"> Viewings: <?php
                                echo htmlspecialchars($bidauction['viewings'])
                                ?></h5>
                        </td>
                        <td class="col-sm-2 col-md-2 text-center"><strong><?php
                                if ($_SESSION['role_id'] == 1) {
                                    echo htmlspecialchars($bidauction['bid_price']);

                                }
                                if ($_SESSION['role_id'] == 2) {
                                    echo htmlspecialchars($bidauction['reserve_price']);
                                }
                                ?></strong></td>
                        <td class="col-sm-2 col-md-2 text-center"><strong><?php

                                echo htmlspecialchars($bidauction['current_bid']);
                                ?>
                                <!--                                <div>-->
                                <!--                                    <span>Reserve: </span><span class="text-success"><strong>-->
                                <!--                                            --><?php
                                //                                            echo $bidauction['reserve_price'];
                                //                                            ?>
                                <!--                                        </strong></span><br>-->
                                <!--                                </div>-->
                                <!---->

                            </strong>

                        </td>
                        <td class="col-sm-2 col-md-2">
                            <!--                            Raise bid logic-->
                            <?php
                            if ($_SESSION['role_id'] == 1 && $enddt > time()) {
                                $id = $bidauction['auction_id'];
                                echo '<a href="productpage.php?auct=' . $id . '" class="btn btn-success" style="margin-top:10px">
    <span class="glyphicon glyphicon-hand-up"></span> Raise Bid
    </a>';
                            }
                            if ($_SESSION['role_id'] == 2 && $enddt > time()) {
                                ?>
                                <form action="bidsauctions.php" method="POST">
                                    <button type="submit" id="stopauction" name="stopAuction"
                                            value="<?php echo $bidauction['auction_id']; ?>"
                                            class="btn btn-danger stopAuction">
                                        Stop Auction
                                    </button>
                                </form>
                                <?php
                            }
                            if ($_SESSION['role_id'] == 2 && $enddt <= time()) {
                                ?>
                                <form>
                                    <button type="submit" class="btn btn-success" onclick="alert('This auction has already finished!')">
                                        Auction Finished
                                    </button>
                                </form>
                                <?php
                            }
                            ?>
                            <?php
                            //                            Stop auction logic

                            ?>
                            <!--                            Confirm win logic-->
                            <?php
                            if ($_SESSION['role_id'] == 1 && $enddt < time() && $bidauction['bid_price'] >= $bidauction['current_bid']
                                && $bidauction['current_bid'] > $bidauction['reserve_price']) {
                                if ($result['win_confirmed'] == 1) {
                                    ?>
                            <form>
                                <button onclick="alert('You have already confirmed this win!')" type="submit" id="confirmwin" name="winConfirm" class="btn btn-success showArchived">
                                    <span class="glyphicon glyphicon-play"></span>
                                    Win Confirmed
                                    </button>
                                </form>
                                    <?php
                                }
                                else {
                                    ?>

                                    <form action="bidsauctions.php" method="post">
                                        <input hidden name="auction_id"
                                               value="<?php echo $bidauction['auction_id']; ?>"/>
                                        <input hidden name="sellerMail" value="<?php echo $bidauction['email']; ?>"/>
                                        <input hidden name="sellerName"
                                               value="<?php echo $bidauction['first_name']; ?>"/>
                                        <input hidden name="buyerName" value="<?php echo $result['username']; ?>"/>
                                        <input hidden name="winningBid"
                                               value="<?php echo $bidauction['current_bid']; ?>"/>
                                        <input hidden name="buyerMail" value="<?php echo $result['email']; ?>"/>
                                        <input hidden name="itemlabel" value="<?php echo $bidauction['label']; ?>"/>
                                        <button type="submit" id="confirmwin" name="winConfirm"
                                                class="btn btn-success showArchived">
                                            <span class="glyphicon glyphicon-play"></span>
                                            Confirm Win
                                        </button>
                                    </form>
                                    <?php
                                }
                                ?>
                                <?php
                            }
                            ?>
                        </td>
                    </tr>
                <?php endwhile; ?>
                <tr>
                    <td>  </td>
                    <td>  </td>
                    <td>  </td>
                    <td></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    //This doesn't work because button disappears anyways
    $('#stopauction').on('click', function () {
        var $el = $(this),
            textNode = this.lastChild;
        $el.find('span').toggleClass('glyphicon-fire glyphicon-road');
        textNode.nodeValue = ($el.hasClass('stopAuction') ? 'Stop Auction' : 'Auction Stopped');
        $el.toggleClass('stopAuction');
    });



</script>
</body>
</html>