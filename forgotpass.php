<!DOCTYPE html>
<html>
   <head>
       <title>Elfelejtett Jelszó</title>
       <meta charset='UTF-8'>
       <meta name='description' content='Egyszerű kő papír olló játék PHP segítségével'>
       <meta name='keywords' content='Kő papír olló, kő, papír, olló, game, minigame'>
       <meta name='author' content='Csontos Kincső'>
       <meta name='viewport' content='width=device-width, initial-scale=1.0'>
       <link rel='stylesheet' href='assets/css/styles.css'>
   </head>
   <body>
        <?php 
            require "cfg.php";

            if(isset($_POST['forg-btn'])){
                $username = $_POST['username'];
                $sql = "SELECT * FROM users WHERE username='$username'";
                $found_user = $conn->query($sql);
                
                if(mysqli_num_rows($found_user) > 0){
                    
                    $user = $found_user->fetch_assoc();
                    
                    echo "<form method='post' action='forgotpass.php?userid=$user[id]'>";
                    echo '	<input type="password" name="password1" placeholder="Jelszó">';
                    echo '	<br><br>';
                    echo '	<input type="password" name="password2" placeholder="Jelszó újra">';
                    echo '	<br><br>';
                    echo '	<input type="submit" name="new-pass-btn">';
                    echo '</form>';
                    
                } else {
                    
                    echo "Nincs ilyen felhasználó!";
                    
                }
                
            } else if(isset($_POST['new-pass-btn'])) {
                
                $userid = $_GET['userid'];
                
                if($_POST['password1'] == $_POST['password2']){
                
                    $sql = "SELECT * FROM users WHERE id=$userid";
                    $found_user = $conn->query($sql);
                    $user = $found_user->fetch_assoc();
                    
                    if($_POST['password1'] != $user['password']){
                        
                        $password = $_POST['password1'];
                        $conn->query("UPDATE users SET password='$password' WHERE id=$userid");
                        
                        echo "A jelszavad sikeresen megváltozott!";
                        echo "<br><br>";
                        echo "<a href='login.php'>Bejelentkezés</a>";
                        
                    } else {
                        
                        echo "Az új jelszavad nem egyezhet a régivel.";
                        
                    }
                
                } else {
                    echo "A két jelszó nem egyezik!";
                }
            } else {
                echo '<h1>Add meg a felhasználónevedet!</h1>';
                echo '<form method="post">';
                echo '	<input type="text" name="username" placeholder="Felhasználónév">';
                echo '	<input type="submit" name="forg-btn">';
                echo '</form>';
            }
        ?>
        <div class="footer">
            <p>2025 doomhyena. Minden jog fenntartva.</p>
        </div>
   </body>
</html>