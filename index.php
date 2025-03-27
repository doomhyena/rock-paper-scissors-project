<?php
    require "cfg.php";

    if (!isset($_COOKIE['id'])) {
        header('Location: reg.php');
        exit();
    }

    $userid = $_COOKIE['id'];

    $user_query = "SELECT username FROM users WHERE id = '$userid'";
    $user_result = $conn->query($user_query);

    if ($user_result->num_rows > 0) {
        $user_row = $user_result->fetch_assoc();
        $username = $user_row['username'];
    } else {
        die("Hiba: Felhasználó nem található.");
    }

    $stats_query = "SELECT score, games_played AS total_games, wins, draws, losses FROM game WHERE username = '$username'";


    $stats_result = $conn->query($stats_query);

    if ($stats_result->num_rows > 0) {
        $stats = $stats_result->fetch_assoc();
        $score = $stats['score'];
        $total_games = $stats['total_games'];
        $wins = $stats['wins'];
        $draws = $stats['draws'];
        $losses = $stats['losses'];
    } else {
        $score = 0;
        $total_games = 0;
        $wins = 0;
        $draws = 0;
        $losses = 0;
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Főoldal</title>
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
        <h2>TOP 5 helyezett</h2>
        <div class="stats-container">
            <div class="ranking">
                <table border="1">
                    <tr>
                        <th>Helyezés</th>
                        <th>Felhasználónév</th>
                        <th>Pontszám</th>
                    </tr>
                    <?php
                    $ranking_query = "SELECT username, score FROM game ORDER BY score DESC LIMIT 5";
                    $ranking_result = $conn->query($ranking_query);

                    if ($ranking_result->num_rows > 0) {
                        $rank = 1;
                        while ($row = $ranking_result->fetch_assoc()) {
                            echo "<tr>
                                    <td>{$rank}</td>
                                    <td>{$row['username']}</td>
                                    <td>{$row['score']}</td>
                                </tr>";
                            $rank++;
                        }
                    } else {
                        echo "<tr><td colspan='3'>Nincs elérhető adat.</td></tr>";
                    }
                    ?>
                </table>
                <p>A teljes ranglistáért kattints <a href="rankinglist.php">ide</a>!</p>
            </div>
            <div class="stats">
                <h2>Statisztikáid</h2>
                <p><strong>Felhasználónév:</strong> <?php echo htmlspecialchars($username); ?></p>
                <p><strong>Pontszám:</strong> <?php echo $score; ?></p>
                <p><strong>Lejátszott meccsek:</strong> <?php echo $total_games; ?></p>
                <p><strong>Győzelmek:</strong> <?php echo $wins; ?></p>
                <p><strong>Döntetlenek:</strong> <?php echo $draws; ?></p>
                <p><strong>Vereségek:</strong> <?php echo $losses; ?></p>
            </div>
        </div>
        <footer>
            <p>&copy; 2025 doomhyena. Minden jog fenntartva.</p>
        </footer>
    </body>
</html>