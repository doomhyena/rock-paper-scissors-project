	// Külső php fájl behívása
	$("#users").load("finduser.php?keresett=");
	
	document.getElementById("search-box").addEventListener('keyup', (e) => {
		
		var ertek = e.target.value;
		
		$("#users").load("finduser.php?keresett="+ertek);
		
	});
	