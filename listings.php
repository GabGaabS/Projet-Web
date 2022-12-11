<?php
include 'nav.php';

//If search has been submitted
if (isset($_GET['sort'])) {
    $name = $_GET['search-name'];
    $category = $_GET['search-category'];
    $state = $_GET['search-state'];
    $sort = $_GET['sort'];
    //If category is set to a category
    if ($category != 0) {
        //If state is set to a state
        if ($state != 0) {
            if ($sort == 1) {
                $sql = 'SELECT A.current_bid, A.end_time, A.viewings, A.auction_id, I.item_picture, I.label, I.description, S.state
                        FROM Auction A, Item I, State S WHERE (I.label LIKE :search OR I.description LIKE :search)
                        AND I.category_id = :category AND A.item_id = I.item_id AND I.state_id = :state AND I.state_id = S.state_id
                        ORDER BY A.end_time ASC';
                $stmt = $db->prepare($sql);
                $stmt->bindValue(':search', '%' . $name . '%');
                $stmt->bindParam(':category', $category);
                $stmt->bindParam(':state', $state);
            } else if ($sort == 2) {
                $sql = 'SELECT A.current_bid, A.end_time, A.viewings,A.auction_id, I.item_picture, I.label, I.description, S.state
                        FROM Auction A, Item I, State S WHERE (I.label LIKE :search OR I.description LIKE :search)
                        AND I.category_id = :category AND A.item_id = I.item_id AND I.state_id = :state AND I.state_id = S.state_id
                        ORDER BY A.end_time DESC';
                $stmt = $db->prepare($sql);
                $stmt->bindValue(':search', '%' . $name . '%');
                $stmt->bindParam(':category', $category);
                $stmt->bindParam(':state', $state);
            } else if ($sort == 3) {
                $sql = 'SELECT A.current_bid, A.end_time, A.viewings, A.auction_id, I.item_picture, I.label, I.description, S.state
                        FROM Auction A, Item I, State S WHERE (I.label LIKE :search OR I.description LIKE :search)
                        AND I.category_id = :category AND A.item_id = I.item_id AND I.state_id = :state AND I.state_id = S.state_id
                        ORDER BY A.current_bid ASC';
                $stmt = $db->prepare($sql);
                $stmt->bindValue(':search', '%' . $name . '%');
                $stmt->bindParam(':category', $category);
                $stmt->bindParam(':state', $state);
            } else if ($sort == 4) {
                $sql = 'SELECT A.current_bid, A.end_time, A.viewings, A.auction_id, I.item_picture, I.label, I.description, S.state
                        FROM Auction A, Item I, State S WHERE (I.label LIKE :search OR I.description LIKE :search)
                        AND I.category_id = :category AND A.item_id = I.item_id AND I.state_id = :state AND I.state_id = S.state_id
                        ORDER BY A.current_bid DESC';
                $stmt = $db->prepare($sql);
                $stmt->bindValue(':search', '%' . $name . '%');
                $stmt->bindParam(':category', $category);
                $stmt->bindParam(':state', $state);
            }
        }
        //If state is set to all states
        else {
            if ($sort == 1) {
                $sql = 'SELECT A.current_bid, A.end_time, A.viewings, A.auction_id, I.item_picture, I.label, I.description, S.state
                            FROM Auction A, Item I, State S WHERE (I.label LIKE :search OR I.description LIKE :search)
                            AND I.category_id = :category AND A.item_id = I.item_id AND I.state_id = S.state_id
                            ORDER BY A.end_time ASC';
                $stmt = $db->prepare($sql);
                $stmt->bindValue(':search', '%' . $name . '%');
                $stmt->bindParam(':category', $category);
            } else if ($sort == 2) {
                $sql = 'SELECT A.current_bid, A.end_time, A.viewings,A.auction_id, I.item_picture, I.label, I.description, S.state
                        FROM Auction A, Item I, State S WHERE (I.label LIKE :search OR I.description LIKE :search)
                        AND I.category_id = :category AND A.item_id = I.item_id AND I.state_id = S.state_id
                        ORDER BY A.end_time DESC';
                $stmt = $db->prepare($sql);
                $stmt->bindValue(':search', '%' . $name . '%');
                $stmt->bindParam(':category', $category);
            } else if ($sort == 3) {
                $sql = 'SELECT A.current_bid, A.end_time, A.viewings, A.auction_id, I.item_picture, I.label, I.description, S.state
                        FROM Auction A, Item I, State S WHERE (I.label LIKE :search OR I.description LIKE :search)
                        AND I.category_id = :category AND A.item_id = I.item_id AND I.state_id = S.state_id
                        ORDER BY A.current_bid ASC';
                $stmt = $db->prepare($sql);
                $stmt->bindValue(':search', '%' . $name . '%');
                $stmt->bindParam(':category', $category);
            } else if ($sort == 4) {
                $sql = 'SELECT A.current_bid, A.end_time, A.viewings, A.auction_id, I.item_picture, I.label, I.description, S.state
                        FROM Auction A, Item I, State S WHERE (I.label LIKE :search OR I.description LIKE :search)
                        AND I.category_id = :category AND A.item_id = I.item_id AND I.state_id = S.state_id
                        ORDER BY A.current_bid DESC';
                $stmt = $db->prepare($sql);
                $stmt->bindValue(':search', '%' . $name . '%');
                $stmt->bindParam(':category', $category);
            }
        }
    }
    //If category is set to all categories
    else if ($category == 0) {
        //If state is set to a state
        if ($state != 0) {
            if ($sort == 1) {
                $sql = 'SELECT A.current_bid, A.end_time, A.viewings, A.auction_id, I.item_picture, I.label, I.description, S.state
                        FROM Auction A, Item I, State S WHERE (I.label LIKE :search OR I.description LIKE :search)
                        AND A.item_id = I.item_id AND I.state_id = :state AND I.state_id = S.state_id ORDER BY A.end_time ASC';
                $stmt = $db->prepare($sql);
                $stmt->bindValue(':search', '%' . $name . '%');
                $stmt->bindParam(':state', $state);
            }
            else if ($sort == 2) {
                $sql = 'SELECT A.current_bid, A.end_time, A.viewings, A.auction_id, I.item_picture, I.label, I.description, S.state
                        FROM Auction A, Item I, State S WHERE (I.label LIKE :search OR I.description LIKE :search)
                        AND A.item_id = I.item_id AND I.state_id = :state AND I.state_id = S.state_id ORDER BY A.end_time DESC';
                $stmt = $db->prepare($sql);
                $stmt->bindValue(':search', '%' . $name . '%');
                $stmt->bindParam(':state', $state);
            }
            else if ($sort == 3) {
                $sql = 'SELECT A.current_bid, A.end_time, A.viewings, A.auction_id, I.item_picture, I.label, I.description, S.state
                        FROM Auction A, Item I, State S WHERE (I.label LIKE :search OR I.description LIKE :search)
                        AND A.item_id = I.item_id AND I.state_id = :state AND I.state_id = S.state_id ORDER BY A.current_bid ASC';
                $stmt = $db->prepare($sql);
                $stmt->bindValue(':search', '%' . $name . '%');
                $stmt->bindParam(':state', $state);
            }
            else if ($sort == 4) {
                $sql = 'SELECT A.current_bid, A.end_time, A.viewings, A.auction_id, I.item_picture, I.label, I.description, S.state
                        FROM Auction A, Item I, State S WHERE (I.label LIKE :search OR I.description LIKE :search)
                        AND A.item_id = I.item_id AND I.state_id = :state AND I.state_id = S.state_id ORDER BY A.current_bid DESC';
                $stmt = $db->prepare($sql);
                $stmt->bindValue(':search', '%' . $name . '%');
                $stmt->bindParam(':state', $state);
            }
        }
        //If state is set to all states
        else {
            if ($sort == 1) {
                $sql = 'SELECT A.current_bid, A.end_time, A.viewings, A.auction_id, I.item_picture, I.label, I.description, S.state
                        FROM Auction A, Item I, State S WHERE (I.label LIKE :search OR I.description LIKE :search)
                        AND A.item_id = I.item_id AND I.state_id = S.state_id ORDER BY A.end_time ASC';
                $stmt = $db->prepare($sql);
                $stmt->bindValue(':search', '%' . $name . '%');
            }
            else if ($sort == 2) {
                $sql = 'SELECT A.current_bid, A.end_time, A.viewings, A.auction_id, I.item_picture, I.label, I.description, S.state
                        FROM Auction A, Item I, State S WHERE (I.label LIKE :search OR I.description LIKE :search)
                        AND A.item_id = I.item_id AND I.state_id = S.state_id ORDER BY A.end_time DESC';
                $stmt = $db->prepare($sql);
                $stmt->bindValue(':search', '%' . $name . '%');
            }
            else if ($sort == 3) {
                $sql = 'SELECT A.current_bid, A.end_time, A.viewings, A.auction_id, I.item_picture, I.label, I.description, S.state
                        FROM Auction A, Item I, State S WHERE (I.label LIKE :search OR I.description LIKE :search)
                        AND A.item_id = I.item_id AND I.state_id = S.state_id ORDER BY A.current_bid ASC';
                $stmt = $db->prepare($sql);
                $stmt->bindValue(':search', '%' . $name . '%');
            }
            else if ($sort == 4) {
                $sql = 'SELECT A.current_bid, A.end_time, A.viewings, A.auction_id, I.item_picture, I.label, I.description, S.state
                        FROM Auction A, Item I, State S WHERE (I.label LIKE :search OR I.description LIKE :search)
                        AND A.item_id = I.item_id AND I.state_id = S.state_id ORDER BY A.current_bid DESC';
                $stmt = $db->prepare($sql);
                $stmt->bindValue(':search', '%' . $name . '%');
            }
        }
    }
    $stmt->execute();
    $result = $stmt->fetchAll();
    $currentLink = 'listings.php?search-name=' . $name . '&search-category=' . $category . '&search-state=' . $state;
}
//If search has not been submitted
else {
    $sql = 'SELECT A.current_bid, A.end_time, A.viewings, A.auction_id, I.item_picture, I.label, I.description, S.state
            FROM Auction A, Item I, State S WHERE A.item_id = I.item_id AND I.state_id = S.state_id ORDER BY A.end_time ASC';
    $stmt = $db -> prepare($sql);
    $stmt -> execute();
    $result = $stmt -> fetchAll();
    $currentLink = 'listings.php?search-name=&search-category=0&search-state=0';
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

    <title>Tout parcourir</title>


    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/shop-homepage.css" rel="stylesheet">

    <!-- Bootstrap Core JavaScript -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script> $(function(){ $("#footer").load("footer.html"); });</script> 

</head>

<body>

    <div class="col-md-6 col-md-offset-3 text-center">
        <div class="btn-group btn-group-justified" role="group">
            <a href="<?php echo $currentLink.'&sort=1'?>" class="btn btn-primary" role="button">Temps restant le plus bas</a>
            <a href="<?php echo $currentLink.'&sort=2'?>" class="btn btn-primary" role="button">Temps restant le plus haut</a>
            <a href="<?php echo $currentLink.'&sort=3'?>" class="btn btn-primary" role="button">Prix croissant</a>
            <a href="<?php echo $currentLink.'&sort=4'?>" class="btn btn-primary" role="button">Prix décroissant</a>
        </div>
    </div>

    <div class="col-md-12" style="padding-top:20px">
        <?php
        foreach ($result as $item) {
            if (new DateTime($item['end_time']) > new DateTime()) {?>
        <div id="auction" class="col-md-3">
            <div class="thumbnail">
                <img src="<?php echo $item['item_picture']; ?>" alt="Item image" style="width:250px; height:250px">
                <div class="caption">
                    <h4 class="pull-right">$ <?php echo $item['current_bid']; ?></h4>
                    <h4><a href="productpage.php?auct=<?php echo $item['auction_id']; ?>"><?php echo $item['label']; ?> (<?php echo $item['state']; ?>)</a></h4>
                    <p><?php echo $item['description']; ?></p>
                </div>
                <div class="row viewings">
                    <div class="col-md-6">Viewings: <?php echo $item['viewings']; ?></div>
                    <div class="col-md-6 text-right">
                        <?php
                        $now = new DateTime();
                        $endDate = new DateTime($item['end_time']);
                        $interval = $endDate -> diff($now);
                        echo $interval -> format('%a Days and %h Hours'); ?>
                    </div>
                </div>
            </div>
        </div>
        <?php }} ?>
    </div>
<div id="footer"></div>
</body>
<script> 
$(function(){$("#footer").load("footer.html"); });
</script> 

</html>
