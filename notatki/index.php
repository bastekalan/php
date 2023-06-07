<?php
session_start();

// Połączenie z bazą danych
$host = "localhost";
$username = "nazwa_uzytkownika";
$password = "haslo_uzytkownika";
$database = "nazwa_bazy_danych";

$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
    die("Błąd połączenia z bazą danych: " . $conn->connect_error);
}

// Obsługa tworzenia nowej notatki
if (isset($_POST['create_note'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $user_id = $_SESSION['user_id'];

    $sql = "INSERT INTO notes (title, content, user_id) VALUES ('$title', '$content', '$user_id')";
    if ($conn->query($sql) === TRUE) {
        echo "Notatka została dodana.";
    } else {
        echo "Błąd: " . $sql . "<br>" . $conn->error;
    }
}

// Obsługa edycji notatki
if (isset($_POST['edit_note'])) {
    $note_id = $_POST['note_id'];
    $title = $_POST['title'];
    $content = $_POST['content'];

    $sql = "UPDATE notes SET title='$title', content='$content' WHERE id='$note_id'";
    if ($conn->query($sql) === TRUE) {
        echo "Notatka została zaktualizowana.";
    } else {
        echo "Błąd: " . $sql . "<br>" . $conn->error;
    }
}

// Obsługa usuwania notatki
if (isset($_GET['delete_note'])) {
    $note_id = $_GET['delete_note'];

    $sql = "DELETE FROM notes WHERE id='$note_id'";
    if ($conn->query($sql) === TRUE) {
        echo "Notatka została usunięta.";
    } else {
        echo "Błąd: " . $sql . "<br>" . $conn->error;
    }
}

// Pobranie notatek dla zalogowanego użytkownika
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM notes WHERE user_id='$user_id'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Zarządzanie notatkami</title>
</head>
<body>
    <h2>Moje notatki</h2>
    <form action="" method="POST">
        <input type="text" name="title" placeholder="Tytuł" required>
        <textarea name="content" placeholder="Treść" required></textarea>
        <button type="submit" name="create_note">Dodaj notatkę</button>
    </form>

    <h3>Moje notatki:</h3>
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<h4>" . $row['title'] . "</h4>";
            echo "<p>" . $row['content'] . "</p>";
            echo "<a href='edit_note.php?note_id=" . $row['id'] . "'>Edytuj</a>";
            echo "<a href='?delete_note=" . $row['id'] . "'>Usuń</a>";
            echo "<hr>";
        }
    } else {
        echo "Brak notatek.";
    }
    ?>

</body>
</html>

<?php
$conn->close();
?>