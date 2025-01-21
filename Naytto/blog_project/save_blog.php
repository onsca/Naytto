<?php
// Tietokantayhteyden tiedot
$servername = "localhost";
$username = "root";
$password = ""; // Aseta oma tietokannan salasana
$dbname = "blog_database";

// Luo yhteys tietokantaan
$conn = new mysqli($servername, $username, $password, $dbname);

// Tarkista yhteys
if ($conn->connect_error) {
    die("Yhteys epäonnistui: " . $conn->connect_error);
}

// Tallenna lomakkeen tiedot
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $conn->real_escape_string($_POST['title']);
    $content = $conn->real_escape_string($_POST['content']);
    $tags = $conn->real_escape_string($_POST['tags']);
    $keywords = $conn->real_escape_string($_POST['keywords']);

    $sql = "INSERT INTO blogs (title, content, tags, keywords) VALUES ('$title', '$content', '$tags', '$keywords')";

    if ($conn->query($sql) === TRUE) {
        echo "Blogi tallennettu onnistuneesti!";
    } else {
        echo "Virhe: " . $sql . "<br>" . $conn->error;
    }
}

// Sulje yhteys
$conn->close();
?>
