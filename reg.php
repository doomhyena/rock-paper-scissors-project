<?php 

	require "cfg.php";
	
	if(isset($_POST['reg-btn'])){
		
        $lastname = $_POST['lastanme'];
        $firstname = $_POST['firstname'];
		$username = $_POST['username'];
		$password = $_POST['password1'];
		$passwordtwo = $_POST['password2'];
		$sql = "SELECT * FROM users WHERE username='$username'";
		$found_user = $conn->query($sql);
		
		if(mysqli_num_rows($found_user) == 0){
			if($password == $passwordtwo){
                $titkositott_jelszo = password_hash($password, PASSWORD_DEFAULT);
				$conn->query("INSERT INTO users VALUES(id, '$lastname', '$firstname', '$username', '$titkositott_jelszo')");
				header("Location: login.php");
			} else {
				echo "A jelszavak nem egyeznek!";
			}
		} else {
			echo "Már létezik ilyen felhasználó!";
		}
	}
?>
<!DOCTYPE html>
<html lang="hu">
   <head>
       <title>Regisztráció</title>
       <meta charset='UTF-8'>
       <meta name='description' content='Egysezű kő papír olló játék php segítségével'>
       <meta name='keywords' content='Kő papír olló, kő, papír, olló, game, minigame'>
       <meta name='author' content='Csontos Kincső'>
       <meta name='viewport' content='width=device-width, initial-scale=1.0'>
       <link rel='stylesheet' href='assets/css/styles.css'>
   </head>
   <body>
    <form method="post">
        <label>Regisztráció</label>
        <br>
        <label>Már van fiókod? <a href="login.php">Jelentkezz be!</a></label>
        <input type="text" name="lastanme" placeholder="Vezetéknév">
        <input type="text" name="firstname" placeholder="Keresztnév">
        <input type="text" name="username" placeholder="Felhasználónév">
        <input type="password" name="password1" placeholder="Jelszó">
        <input type="password" name="password2" placeholder="Jelszó újra">
        <input type="submit" name="reg-btn" value="Regisztráció!">
    </form>
    <div class="footer">
        <p>2025 doomhyena. Minden jog fenntartva.</p>
    </div>
   </body>
</html>