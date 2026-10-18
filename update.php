<?php
require_once 'core/dbConfig.php';

// UPDATE: save changes when the edit form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sql = "UPDATE job_applications SET
                firstName = ?, lastName = ?, email = ?, phoneNumber = ?,
                positionApplied = ?, yearsOfExperience = ?, preferredLanguage = ?, expectedSalary = ?
            WHERE applicationId = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $_POST['firstName'],
        $_POST['lastName'],
        $_POST['email'],
        $_POST['phoneNumber'],
        $_POST['positionApplied'],
        $_POST['yearsOfExperience'],
        $_POST['preferredLanguage'],
        $_POST['expectedSalary'],
        $_POST['applicationId']
    ]);
    header("Location: index.php");
    exit;
}

// Otherwise, load the record to show in the form
$stmt = $pdo->prepare("SELECT * FROM job_applications WHERE applicationId = ?");
$stmt->execute([$_GET['id']]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$row) {
    die("Application not found.");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update Application</title>
</head>
<body>
    <h1>Update Application</h1>

    <form action="update.php" method="POST">
        <input type="hidden" name="applicationId" value="<?php echo $row['applicationId']; ?>">
        <p>First Name: <input type="text" name="firstName" value="<?php echo htmlspecialchars($row['firstName']); ?>" required></p>
        <p>Last Name: <input type="text" name="lastName" value="<?php echo htmlspecialchars($row['lastName']); ?>" required></p>
        <p>Email: <input type="email" name="email" value="<?php echo htmlspecialchars($row['email']); ?>" required></p>
        <p>Phone Number: <input type="text" name="phoneNumber" value="<?php echo htmlspecialchars($row['phoneNumber']); ?>" required></p>
        <p>Position Applied:
            <select name="positionApplied">
                <?php foreach (['Software Engineer', 'Network Administrator', 'Database Administrator'] as $p) { ?>
                    <option <?php if ($row['positionApplied'] == $p) echo 'selected'; ?>><?php echo $p; ?></option>
                <?php } ?>
            </select>
        </p>
        <p>Years of Experience: <input type="number" name="yearsOfExperience" min="0" value="<?php echo $row['yearsOfExperience']; ?>" required></p>
        <p>Preferred Programming Language: <input type="text" name="preferredLanguage" value="<?php echo htmlspecialchars($row['preferredLanguage']); ?>" required></p>
        <p>Expected Salary: <input type="number" step="0.01" name="expectedSalary" value="<?php echo $row['expectedSalary']; ?>" required></p>
        <p>
            <input type="submit" value="Save Changes">
            <a href="index.php">Cancel</a>
        </p>
    </form>
</body>
</html>
