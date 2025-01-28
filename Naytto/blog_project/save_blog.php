<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Tietokantayhteyden tiedot
$servername = "localhost"; // Palvelin
$username = "root";       
$password = "";            
$dbname = "blog_database"; // Tietokannan nimi

// Luo yhteys tietokantaan
$conn = new mysqli($servername, $username, $password, $dbname);

// Tarkista yhteys
if ($conn->connect_error) {
    die("Tietokantayhteys epäonnistui: " . $conn->connect_error);
}

// Tarkista, että lomake on lähetetty
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Hae lomakkeen tiedot
    $title = $conn->real_escape_string($_POST['title']);
    $content = $conn->real_escape_string($_POST['content']);

    // SQL-kysely tietojen tallentamiseksi
    $sql = "INSERT INTO blogs (title, content) VALUES ('$title', '$content')";

    // Suorita kysely ja tarkista, onnistuiko tallennus
    if ($conn->query($sql) === TRUE) {
        echo "Blogi tallennettu onnistuneesti!";
    } else {
        echo "Virhe tallennuksessa: " . $conn->error;
    }
}

// Sulje tietokantayhteys
$conn->close();
?>
