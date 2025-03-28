<?php 

	require "cfg.php";
	
	session_start();
	
	if(isset($_POST['login-btn'])){
		
		$username = $_POST['username'];
		$password = $_POST['password'];
		$sql = "SELECT * FROM users WHERE username='$username'";
		$found_user = $conn->query($sql);
		
		if(mysqli_num_rows($found_user) > 0){
			
			$user = $found_user->fetch_assoc();
			
			if(password_verify($password, $user['password'])){
				
				setcookie("id", $user['id'], time() + 3600, "/");
				
				header("Location: index.php");
			} else {
                echo "<script>alert('Hibás jelszó!')</script>";
			}
		} else {
			echo "<script>alert('Nincs ilyen felhasználó!')</script>";
		}
	}
?>
<!DOCTYPE html>
<html lang="hu">
   <head>
       <title>Bejelentkezés</title>
       <meta charset='UTF-8'>
       <meta name='description' content='Egysezű kő papír olló játék php segítségével'>
       <meta name='keywords' content='Kő papír olló, kő, papír, olló, game, minigame'>
       <meta name='author' content='Csontos Kincső'>
       <meta name='viewport' content='width=device-width, initial-scale=1.0'>
       <link rel='stylesheet' href='assets/css/styles.css'>
   </head>
   <body>
        <form method="post">
            <label>Bejelentkezés</label>
            <br>
            <label> Még nincs fiókod? <a href="reg.php">Regisztrálj!</a></label>
            <input type="text" name="username" placeholder="Felhasználónév">
            <input type="password" name="password" placeholder="Jelszó">
            <input type="submit" name="login-btn" value="Bejelentkezés!">
            <label><a href="forgotpass.php">Elfelejtett jelszó</a></label>
        </form>
        <div class="footer">
            <p>2025 doomhyena. Minden jog fenntartva.</p>
        </div>
   </body>
</html>