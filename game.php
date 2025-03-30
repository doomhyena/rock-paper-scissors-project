<?php
    require "cfg.php";

    $user_id = $_COOKIE['id']; 
    $get_username = "SELECT username FROM users WHERE id = '$user_id'";
    $username_result = $conn->query($get_username);

    if ($username_result && $username_result->num_rows > 0) {
        $sql = $username_result->fetch_assoc();
        $username = $sql['username'];
    } else {
        die("Hiba: A felhasználó nem található az adatbázisban.");
    }

    $found_game = "SELECT * FROM game WHERE username = '$username'";
    $sql = $conn->query($found_game);
    
    if ($sql->num_rows == 0) {
        $sql = "INSERT INTO game (username, score, games_played, wins, draws, losses) 
                VALUES('$username', 0, 0, 0, 0, 0)";
        $conn->query($sql);
    }

    if (isset($_POST['user_move']) && isset($_POST['opponent_username'])) {
        $user_move = $_POST['user_move'];
        $opponent_username = $_POST['opponent_username'];

        $conn->query("INSERT INTO moves (username, move) VALUES ('$username', '$user_move')");

        $get_opponent_move = "SELECT move FROM moves WHERE username = '$opponent_username' ORDER BY created_at DESC LIMIT 1";
        $opponent_result = $conn->query($get_opponent_move);
        
        if ($opponent_result && $opponent_result->num_rows > 0) {
            $opponent_data = $opponent_result->fetch_assoc();
            $opponent_move = $opponent_data['move'];
        } else {
            echo "<script>alert('Az ellenfél még nem tett lépést!')</script>";
            exit();
        }

        $get_opponent_id = "SELECT id FROM users WHERE username = '$opponent_username'";
        $opponent_result = $conn->query($get_opponent_id);
        
        if ($opponent_result && $opponent_result->num_rows > 0) {
            $opponent_data = $opponent_result->fetch_assoc();
            $opponent_id = $opponent_data['id'];
            
            $check_friend_status = "SELECT * FROM friends 
                                    WHERE (toid = '$user_id' AND fromid = '$opponent_id' AND status = 1) 
                                    OR (fromid = '$user_id' AND toid = '$opponent_id' AND status = 1)";
            $friend_result = $conn->query($check_friend_status);

            if ($friend_result && $friend_result->num_rows > 0) {
                $winner = determine_winner($user_move, $opponent_move);

                if ($winner === 'user') {
                    $conn->query("UPDATE game SET score = score + 10, games_played = games_played + 1, wins = wins + 1 WHERE username = '$username'");
                    $conn->query("UPDATE game SET games_played = games_played + 1, losses = losses + 1 WHERE username = '$opponent_username'");
                    echo "<script>alert('Te nyertél! 10 pontot gyűjtöttél.')</script>";
                } elseif ($winner === 'opponent') {
                    $conn->query("UPDATE game SET games_played = games_played + 1, losses = losses + 1 WHERE username = '$username'");
                    $conn->query("UPDATE game SET score = score + 10, games_played = games_played + 1, wins = wins + 1 WHERE username = '$opponent_username'");
                    echo "<script>alert('Te vesztettél! Sok szerencsét legközelebb!')</script>";
                } else {
                    $conn->query("UPDATE game SET score = score + 5, games_played = games_played + 1, draws = draws + 1 WHERE username = '$username'");
                    $conn->query("UPDATE game SET score = score + 5, games_played = games_played + 1, draws = draws + 1 WHERE username = '$opponent_username'");
                    echo "<script>alert('Döntetlen! Mindkét játékos 5 pontot kap.')</script>";
                }
            } else {
                echo "<script>alert('Te csak barátokkal játszhatsz!')</script>";
            }
        } else {
            echo "<script>alert('Az ellenfél nem található!')</script>";
        }
    }

    function determine_winner($user_move, $opponent_move) {
        if ($user_move === $opponent_move) {
            return 'draw';
        }
        if (($user_move === 'rock' && $opponent_move === 'scissors') || 
            ($user_move === 'scissors' && $opponent_move === 'paper') || 
            ($user_move === 'paper' && $opponent_move === 'rock')) {
            return 'user';
        }
        return 'opponent';
    }
?>
<!DOCTYPE html>
<html>
   <head>
       <title>Játék</title>
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
    <form method="post">
        <label>Válassz egyet: </label>
        <select name="user_move">
            <option value="rock">Kő</option>
            <option value="paper">Papír</option>
            <option value="scissors">Olló</option>
        </select>
        <label>Játékos ellenfél:</label>
        <input type="text" name="opponent_username" placeholder="Írd be a barátod nevét" required>
        <input type="hidden" name="opponent_move" id="opponent_move">
        <input type="submit" value="Játék!">
    </form>
   </body>
</html>
