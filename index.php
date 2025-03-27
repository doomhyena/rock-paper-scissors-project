<?php

    require "cfg.php";

    if(!isset($_COOKIE['id'])) {
        header('Location: reg.php');
    }

?>
<!DOCTYPE html>
<html>
   <head>
       <title>Főoldal</title>
       <meta charset='UTF-8'>
       <meta name='description' content='Egysezű kő papír olló játék php segítségével'>
       <meta name='keywords' content='Kő papír olló, kő, papír, olló, game, minigame'>
       <meta name='author' content='Csontos Kincső'>
       <meta name='viewport' content='width=device-width, initial-scale=1.0'>
       <link rel='stylesheet' href='assets/css/styles.css'>
   </head>
   <body>
   <nav>
        <ul>                
            <li><a href="index.php">Főoldal</a></li>
            <li><a href="search.php">Barát keresés</a></li>
            <li><a href="game.php">Játék</a></li>
            <li><a href="rankinglist.php">Ranglista</a></li>
            <li><a href="logout.php">Kijelentkezés</a></li>
        </ul>
    </nav>
   </body>
</html>