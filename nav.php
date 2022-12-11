<?php
require_once 'dbConnection.php';
session_start();
?>

<link rel="stylesheet" href="css/nav.css" type="text/css">
<body>
    <header>
            <!-- Navigation -->
            <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
                <div class="container-fluid">

                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                                data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                            <span class="sr-only">Afficher la navbar</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="indexc.php">Omnes Marketplace</a>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav">
            <!-- Options dans la navbar -->
            <!-- accueil -->
                            <li>
                                <a href="indexc.php">Accueil</a>
                            </li>
                            <li>
                                <?php
                                if ($_SESSION['role_id'] == 2) {
                                    echo '<a href="bidsauctions.php">Vos ventes</a>';
                                }
                                ?>
                            </li>
                            <li>
                                <?php
                                if ($_SESSION['role_id'] == 2) {
                                    echo '<a href="addauction.php">Vendre un produit</a>';
                                }
                                ?>
                            </li>

            <!--
                            
                                else if ($_SESSION['role_id'] == 1) {
                                    echo '<a href="bidsauctions.php">Vos achats</a>';
                                }
                                ?>
                            </li>
                            
                                                -->
                            <!--  Tout parcourir -->
                            <li>
                                <a href="listings.php">Tout parcourir</a>
                            </li>

                            <!-- Notif -->
                            <li>
                                <a href="notif.php">Notification</a>
                            </li>

                            <!-- Panier -->
                            <li>
                                <a href="panier.php">Panier</a>
                            </li>

                            <!-- Votre compte-->
                            <li>
                                <a href="profile.php">Votre compte</a>
                            </li>
                            <!--Panel admin-->
                            <li>
                                <?php
                                if ($_SESSION['role_id'] == 0){
                                    echo '<a href="admin.php">Panel admin</a>';
                                } 
                                ?>
                            </li>
                            <!-- Se déco-->
                            <li>
                                <a href="logout.php">Se déconnecter</a>
                            </li>
                        </ul>
                        <form class="navbar-form navbar-right" role="form" method="get" action="listings.php">
                            <!-- Search Name -->
                            <div class="form-group">
                                <label class="sr-only" for="item-name">Produit</label>
                                <input id="item-name" name="search-name" placeholder="Nom du produit ou description" class="form-control">
                            </div>
                            <!-- Search Category -->
                            <div class="form-group">
                                <label class="sr-only" for="item-category">Catégorie</label>
                                <select id="item-category" name="search-category" class="form-control">
                                    <option value = "0" selected>Catégories</option>
                                    <?php
                                    $sql = 'SELECT * FROM Category';
                                    foreach ($db -> query($sql) as $row) { ?>
                                        <option value = "<?php echo $row['category_id']; ?>"><?php echo $row['category']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <!-- Search State -->
                            <div class="form-group">
                                <label class="sr-only" for="item-state">Etat</label>
                                <select id="item-state" name="search-state" class="form-control">
                                    <option value = "0" selected>N'importe quel état</option>
                                    <?php
                                    $sql = 'SELECT * FROM State';
                                    foreach ($db->query($sql) as $row) { ?>
                                        <option value="<?php echo $row['state_id']; ?>"><?php echo $row['state']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <!-- Search Auction -->
                            <div class="form-group">
                                <label class="sr-only" for="submit">Chercher</label>
                                <button id="submit" name="sort" value="1" class="btn btn-primary" type="hidden">Chercher</button>
                            </div>
                        </form>
                    </div>
                </div>
            </nav>
    </header>

    <br>
    <section>
        <br>
        <center>
        <p><font color=red size="5pt" face="impact" ></font></p>
        </center>
        </br>
    </section>
    </br>
