<?php 

	require "cfg.php";
	
	$sql = "SELECT * FROM users WHERE username LIKE '%$_GET[keresett]%' AND id != $_COOKIE[id]";
	$founded_user = $conn->query($sql);
	while($user = $founded_user->fetch_assoc()){
		echo '<form class="user" method="post" action="search.php?userid='.$user['id'].'">
				<label>'.$user['username'].'</label>';
			$sql = "SELECT * FROM friends WHERE fromid=$_COOKIE[id] AND toid=$user[id] OR fromid=$user[id] AND toid=$_COOKIE[id]";
			$talalt_baratsag = $conn->query($sql);
			
			if(mysqli_num_rows($talalt_baratsag) == 0){
				echo '<input type="submit" name="add-friend-btn" value="Jelölés">';
			}
		echo '</form>';
	}
?>