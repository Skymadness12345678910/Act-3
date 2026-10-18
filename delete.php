<?php
require_once 'core/dbConfig.php';

// DELETE: remove one application by its ID
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("DELETE FROM job_applications WHERE applicationId = ?");
    $stmt->execute([$_POST['applicationId']]);
}

header("Location: index.php");
exit;
?>
