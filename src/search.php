<?php

require_once __DIR__ . '/db_config.php';

$keyword = $_GET['keyword'] ?? '';

// 1. Input validation
if (empty($keyword)) {
    die("Keyword is required.");
}

if (mb_strlen($keyword, 'UTF-8') > 100) {
    die("Keyword too long.");
}

// 2. SQL Injection prevention (prepared statement)
$stmt = $conn->prepare("
    SELECT id, name, illness_history 
    FROM patient_records 
    WHERE name LIKE :keyword
");

$stmt->execute([
    ':keyword' => '%' . $keyword . '%'
]);

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

// 3. Output handling (XSS prevention)
if ($results) {
    foreach ($results as $row) {

        echo "<div>";
        echo "Search keyword: " . htmlspecialchars($keyword, ENT_QUOTES, 'UTF-8') . "<br>";
        echo "Patient: " . htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8') . "<br>";
        echo "History: " . htmlspecialchars($row['illness_history'], ENT_QUOTES, 'UTF-8') . "<br>";
        echo "</div><hr>";
    }
} else {
    echo "No results found for: " . htmlspecialchars($keyword, ENT_QUOTES, 'UTF-8');
}