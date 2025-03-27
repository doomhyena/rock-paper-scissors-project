// Külső php fájl behívása
import $ from 'jquery';

// Kereső doboz figyelése
$("#users").load("finduser.php?keresett=");

// Kereső doboz figyelése
document.getElementById("search-box")?.addEventListener('keyup', (e: KeyboardEvent) => {
    const ertek: string = (e.target as HTMLInputElement).value;
    
    $("#users").load("finduser.php?keresett=" + ertek);
});