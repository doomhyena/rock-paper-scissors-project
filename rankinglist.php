<!DOCTYPE html>
<html lang="hu">
    <head>
        <title>Ranglista</title>
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
                <li><a href="notify.php">Értesítések</a></li>
                <li><a href="search.php">Barát keresése</a></li>
                <li><a href="game.php">Játék</a></li>
                <li><a href="logout.php">Kijelentkezés</a></li>
            </ul>
        </nav>
        <h2>Játékosok ranglistája</h2>
        <table border="1">
            <tr>
                <th>Helyezés</th>
                <th>Felhasználónév</th>
                <th>Pontszám</th>
            </tr>
            <?php
            require "cfg.php";

            $ranking_query = "SELECT username, score FROM game ORDER BY score DESC";
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
        <footer>
            <p>&copy; 2025 doomhyena. Minden jog fenntartva.</p>
        </footer>
    </body>
</html>
