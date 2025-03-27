import $ from 'jquery';

$("#users").load("finduser.php?keresett=");

document.getElementById("search-box")?.addEventListener('keyup', (e: KeyboardEvent) => {
    const ertek: string = (e.target as HTMLInputElement).value;
    
    $("#users").load("finduser.php?keresett=" + ertek);
});