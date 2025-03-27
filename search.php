<?php 

	require "cfg.php";
	
	if(!isset($_COOKIE['id'])){
		header("Location: reglog.php");
	}
	
	if(isset($_POST['add-friend-btn'])){
		
		$conn->query("INSERT INTO friends VALUES(id, $_COOKIE[id], $_GET[userid], 0)");

		header("Location: search.php");
		
	}

?>
<!DOCTYPE html>
<html lang="hu">
   <head>
	   <title>Keresés</title>
	   <meta charset='UTF-8'>
       <meta name='description' content='Egysezű kő papír olló játék php segítségével'>
       <meta name='keywords' content='Kő papír olló, kő, papír, olló, game, minigame'>
       <meta name='author' content='Csontos Kincső'>
       <meta name='viewport' content='width=device-width, initial-scale=1.0'>
       <link rel='stylesheet' href='assets/css/styles.css'>
	   <script src="http://code.jquery.com/jquery-latest.js"></script>
   </head>
   <body>
   <nav>
        <ul>                
            <li><a href="index.php">Főoldal</a></li>
            <li><a href="search.php">Barát keresés</a></li>
            <li><a href="">Játék</a></li>
            <li><a href="rankinglist.php">Ranglista</a></li>
            <li><a href="logout.php">Kijelentkezés</a></li>
        </ul>
    </nav>
	<input type="text" class="search-box" id="search-box" placeholder="Felhasználó keresése...">
	<div class="users" id="users"></div>
   </body>
   <script src="assets/js/script.js"></script>
</html>