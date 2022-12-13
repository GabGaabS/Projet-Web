<?php 
echo "	
Roles:
	1		Client;
	2		Vendeur;
	0		Admin.
";
header('refresh: 3; url = http://localhost/phpmyadmin/index.php?route=/sql&db=ebay_clone&table=users');
 ?>