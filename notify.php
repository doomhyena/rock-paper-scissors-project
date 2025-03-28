<?php 

	require "cfg.php";
	
	if(!isset($_COOKIE['id'])){
		header("Location: reglog.php");
	}
	
	if(isset($_POST['add-friend-btn'])){
		
		$conn->query("UPDATE friends SET status=1 WHERE fromid=$_GET[userid] AND toid=$_COOKIE[id]");
		
		header("Location: index.php");
		
	}

?>
<!DOCTYPE html>
<html>
   <head>
       <title>Oldal neve</title>
       <meta charset='UTF-8'>
       <meta name='description' content='Egyszerű kő papír olló játék PHP segítségével'>
       <meta name='keywords' content='Kő papír olló, kő, papír, olló, game, minigame'>
       <meta name='author' content='Csontos Kincső'>
       <meta name='viewport' content='width=device-width, initial-scale=1.0'>
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
    <div class="users">
    <?php
        $sql = "SELECT * FROM friends WHERE toid=$_COOKIE[id] AND status=0";
        $found_requests = $conn->query($sql);
        while($requests = $found_requests->fetch_assoc()){
            $sql = "SELECT * FROM users WHERE id=$requests[fromid]";
            $found_requester = $conn->query($sql);
            $requests = $found_requester->fetch_assoc();
    
            echo '<form method="post" action="notifs.php?userid='.$requests['id'].'">';
            echo '<label>'.$requests['username'].'</label>';
            echo '<input type="submit" name="add-friend-btn" value="Visszaigazolás">';
            echo '</form>';
    
        } ?>
    </div>
    <div class="footer">
        <p>2025 doomhyena. Minden jog fenntartva.</p>
    </div>
    </body>
</html>