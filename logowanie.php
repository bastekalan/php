<?php
session_start();

// Konfiguracja bazy danych
$dbHost = 'localhost';
$dbUser = 'username';
$dbPass = 'password';
$dbName = 'database';

// Połączenie z bazą danych
$db = new mysqli($dbHost, $dbUser, $dbPass, $dbName);

// Sprawdzenie połączenia
if ($db->connect_error) {
    die("Błąd połączenia z bazą danych: " . $db->connect_error);
}

// Rejestracja użytkownika
if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Walidacja danych wejściowych - należy dodać dodatkową walidację, zabezpieczenia, etc.
    
    // Sprawdzenie, czy użytkownik już istnieje w bazie danych
    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = $db->query($query);
    
    if ($result->num_rows > 0) {
        echo "Użytkownik o takiej nazwie już istnieje.";
    } else {
        // Dodanie nowego użytkownika do bazy danych
        $query = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
        
        if ($db->query($query) === TRUE) {
            echo "Pomyślnie zarejestrowano. Możesz się teraz zalogować.";
        } else {
            echo "Błąd rejestracji: " . $db->error;
        }
    }
}

// Logowanie użytkownika
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Walidacja danych wejściowych - należy dodać dodatkową walidację, zabezpieczenia, etc.

    // Sprawdzenie, czy użytkownik istnieje w bazie danych
    $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = $db->query($query);
    
    if ($result->num_rows > 0) {
        // Zalogowano pomyślnie
        $_SESSION['username'] = $username;
        echo "Pomyślnie zalogowano.";
    } else {
        echo "Błędne dane logowania.";
    }
}

// Wylogowanie użytkownika
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("Location: logowanie.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Rejestracja i logowanie</title>
</head>
<body>
    <h1>Rejestracja</h1>
    <form method="post" action="logowanie.php">
        <label>Nazwa użytkownika:</label>
        <input type="text" name="username" required>
        <br>
        <label>Hasło:</label>
        <input type="password" name="password" required>
        <br>
        <input type="submit" name="register" value="Zarejestruj">
    </form>

    <h1>Logowanie</h1>
    <form method="post" action="logowanie.php">
        <label>Nazwa użytkownika:</label>
        <input type="text" name="username" required>
        <br>
        <label>Hasło:</label>
        <input type="password" name="password" required>
        <br>
        <input type="submit" name="login" value="Zaloguj">
    </form>

    <?php if (isset($_SESSION['username'])) : ?>
        <h1>Witaj, <?php echo $_SESSION['username']; ?></h1>
        <a href="logowanie.php?logout=true">Wyloguj</a>
    <?php endif; ?>
</body>
</html>