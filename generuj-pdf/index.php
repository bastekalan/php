<?php
if (isset($_POST['submit'])) {
    $header = $_POST['header'];
    $content = $_POST['content'];

    // Utwórz nagłówki odpowiedzi
    header('Content-Type: application/pdf');
    header('Content-Disposition: inline; filename="file.pdf"');

    // Utwórz strukturę pliku PDF
    $pdf = '%PDF-1.3' . "\n";
    $pdf .= '1 0 obj' . "\n";
    $pdf .= '<< /Type /Catalog /Pages 2 0 R >>' . "\n";
    $pdf .= 'endobj' . "\n";
    $pdf .= '2 0 obj' . "\n";
    $pdf .= '<< /Type /Pages /Kids [3 0 R] /Count 1 >>' . "\n";
    $pdf .= 'endobj' . "\n";
    $pdf .= '3 0 obj' . "\n";
    $pdf .= '<< /Type /Page /Parent 2 0 R /Contents [4 0 R 5 0 R] /MediaBox [0 0 612 792] >>' . "\n";
    $pdf .= 'endobj' . "\n";
    $pdf .= '4 0 obj' . "\n";
    $pdf .= '<< /Length 5 0 R >>' . "\n";
    $pdf .= 'stream' . "\n";
    $pdf .= 'BT' . "\n";
    $pdf .= '/F1 16 Tf' . "\n";
    $pdf .= '50 700 Td' . "\n"; // Pozycja nagłówka
    $pdf .= '(' . $header . ') Tj' . "\n"; // Treść nagłówka
    $pdf .= 'ET' . "\n";
    $pdf .= 'endstream' . "\n";
    $pdf .= 'endobj' . "\n";
    $pdf .= '5 0 obj' . "\n";
    $pdf .= '<< /Length 6 0 R >>' . "\n";
    $pdf .= 'stream' . "\n";
    $pdf .= 'BT' . "\n";
    $pdf .= '/F1 12 Tf' . "\n";
    $pdf .= '50 650 Td' . "\n"; // Pozycja akapitu
    $pdf .= '(' . $content . ') Tj' . "\n"; // Treść akapitu
    $pdf .= 'ET' . "\n";
    $pdf .= 'endstream' . "\n";
    $pdf .= 'endobj' . "\n";
    $pdf .= '6 0 obj' . "\n";
    $pdf .= strlen($content) . "\n";
    $pdf .= 'endobj' . "\n";
    $pdf .= 'xref' . "\n";
    $pdf .= '0 7' . "\n";
    $pdf .= '0000000000 65535 f ' . "\n";
    $pdf .= '0000000009 00000 n ' . "\n";
    $pdf .= '0000000074 00000 n ' . "\n";
    $pdf .= '0000000123 00000 n ' . "\n";
    $pdf .= '0000000191 00000 n ' . "\n";
    $pdf .= '0000000268 00000 n ' . "\n";
    $pdf .= '0000000347 00000 n ' . "\n";
    $pdf .= 'trailer' . "\n";
    $pdf .= '<< /Size 7 /Root 1 0 R >>' . "\n";
    $pdf .= 'startxref' . "\n";
    $pdf .= '417' . "\n";
    $pdf .= '%%EOF';

    // Wygeneruj zawartość pliku PDF
    echo $pdf;
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Wczytywanie treści i generowanie PDF</title>
</head>
<body>
    <h2>Wczytywanie treści i generowanie PDF</h2>
    <form action="" method="POST">
        <label for="header">Nagłówek:</label><br>
        <input type="text" name="header" required><br><br>

        <label for="content">Treść:</label><br>
        <textarea name="content" rows="10" cols="50" required></textarea><br><br>

        <button type="submit" name="submit">Generuj PDF</button>
    </form>
</body>
</html>