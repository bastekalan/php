<?php
if (isset($_POST['calculate'])) {
    $weight = $_POST['weight'];
    $height = $_POST['height'];

    // Obliczanie BMI
    $bmi = $weight / ($height * $height);

    // Klasyfikacja BMI
    if ($bmi < 18.5) {
        $category = "Niedowaga";
    } elseif ($bmi >= 18.5 && $bmi < 24.9) {
        $category = "Normalna waga";
    } elseif ($bmi >= 25 && $bmi < 29.9) {
        $category = "Nadwaga";
    } else {
        $category = "Otyłość";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Kalkulator BMI</title>
    <style>
        body{
            background-color:white;
            font-family:sans-serif;
            display:flex;
            flex-direction:column;
            color:white;
            align-items: center;
        }
        .kalk{
            width:400px;
            background-color: #03a5fc;
            border-radius:10px;
            margin:20px;
            padding:20px;
            text-align:center;
            box-shadow: 0px 20px 20px #43bafa;
        }
        button{
            background-color:#7007ad;
            border:0px;
            font-size:20px;
            color:white;
            padding:15px;
            border-radius:10px;
            box-shadow: 0px 5px 5px #b74cf5;
        }
    </style>
</head>
<body>
    <div class="kalk">
        <h1>Kalkulator BMI</h1>
        <form action="" method="POST">
            <label for="weight">Waga (kg):</label>
            <input type="number" name="weight" step="0.01" required><br><br>

            <label for="height">Wzrost (m):</label>
            <input type="number" name="height" step="0.01" required><br><br>

            <button type="submit" name="calculate">Oblicz BMI</button>
        </form>
    </div>
    <?php
    if (isset($_POST['calculate'])) {
        echo "<div class=".'kalk'.">";
        echo "<h2>Wynik:</h2>";
        echo "<p><b>Twoje BMI: </b>" . number_format($bmi, 2) . "</p>";
        echo "<p><b>Kategoria: </b>" . $category . "</p>";
        echo "</div>";
    }
    ?>
</body>
</html>