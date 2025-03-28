<?php
    require "cfg.php";

    if (!isset($_COOKIE['id'])) {
        header('Location: reg.php');
        exit();
    }

    $get_username = "SELECT username FROM users WHERE id = '{$_COOKIE['id']}'";
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

    if (isset($_POST['user_move']) && isset($_POST['opponent_move']) && isset($_POST['opponent_username'])) {
        $user_move = $_POST['user_move'];
        $opponent_move = $_POST['opponent_move'];
        $opponent_username = $_POST['opponent_username'];

        $check_friend_status = "SELECT * FROM friends 
                                WHERE (toid = '$username' AND fromid = '$opponent_username' AND status = 1) 
                                OR (fromid = '$opponent_username' AND toid = '$username' AND status = 1)";
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
        <input type="hidden" name="opponent_move" value="opponent's move here">
        <input type="submit" value="Játék!">
    </form>
    <div class="footer">
        <p>2025 doomhyena. Minden jog fenntartva.</p>
    </div>
   </body>
</html>
