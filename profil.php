<?php 

	require "cfg.php";
		
	$userid = $_GET['userid'];
	
	$sql = "SELECT * FROM users WHERE id=$userid";
	$found_user = $conn->query($sql);
	$user = $found_user->fetch_assoc();
	
?>
<!DOCTYPE html>
<html>
   <head>
       <title>Profil</title>
       <meta charset='UTF-8'>
       <meta name='description' content='Egyszerű kő papír olló játék PHP segítségével'>
       <meta name='keywords' content='Kő papír olló, kő, papír, olló, game, minigame'>
       <meta name='author' content='Csontos Kincső'>
       <meta name='viewport' content='width=device-width, initial-scale=1.0'>
       <link rel='favicon' href='assets/pics/favicon.ico'>
       <link rel='stylesheet' href='assets/css/styles.css'>
   </head>
   <body>
   <nav>
        <ul>
            <li><a href="index.php">Főoldal</a></li>
            <li><a href="notify.php">Értesítések</a></li>
            <li><a href="search.php">Barát keresése</a></li>
            <li><a href="game.php">Játék</a></li>
            <li><a href="logout.php">Kijelentkezés</a></li>
        </ul>
    </nav>
    <div class="stats-container">
        <?php            
            $sql = "SELECT * FROM game WHERE username='$user[username]'";
            $found_user = $conn->query($sql);
            $user = $found_user->fetch_assoc();

            $forname = "SELECT * FROM users WHERE username='$user[username]'";
            $found_fullname = $conn->query($forname);
            $fullname = $found_fullname->fetch_assoc();

            echo "<div class='user-info'>";
            echo "<h2>$user[username] adatai:</h2>";
            echo "<p><strong>Felhasználónév:</strong>  $user[username]</p>";
            echo "<p><strong>Teljes név:</strong> $fullname[lastname] $fullname[firstname] </p>";  
            echo "<p><strong>Pontszám:</strong> $user[score] </p>";
            echo "<p><strong>Lejátszott meccsek:</strong> $user[games_played]</p>";
            echo "<p><strong>Győzelmek:</strong> $user[wins] </p>";
            echo "<p><strong>Döntetlenek:</strong> $user[draws]</p>";
            echo "<p><strong>Vereségek:</strong> $user[losses]</p>";
            echo "</div>";
        ?>
    </div>
   </body>
</html>