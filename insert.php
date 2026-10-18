<?php
require_once 'core/dbConfig.php';

// INSERT: save a new application using a prepared statement
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sql = "INSERT INTO job_applications
            (firstName, lastName, email, phoneNumber, positionApplied, yearsOfExperience, preferredLanguage, expectedSalary)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $_POST['firstName'],
        $_POST['lastName'],
        $_POST['email'],
        $_POST['phoneNumber'],
        $_POST['positionApplied'],
        $_POST['yearsOfExperience'],
        $_POST['preferredLanguage'],
        $_POST['expectedSalary']
    ]);
}

header("Location: index.php");
exit;
?>
