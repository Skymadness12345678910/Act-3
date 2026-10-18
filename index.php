<?php
require_once 'core/dbConfig.php';

// READ: get all applications
$stmt = $pdo->query("SELECT * FROM job_applications ORDER BY applicationId DESC");
$applications = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Job Application Form</title>
</head>
<body>
    <h1>Software Engineer Job Application Form</h1>

    <!-- INSERT form -->
    <form action="insert.php" method="POST">
        <p>First Name: <input type="text" name="firstName" required></p>
        <p>Last Name: <input type="text" name="lastName" required></p>
        <p>Email: <input type="email" name="email" required></p>
        <p>Phone Number: <input type="text" name="phoneNumber" required></p>
        <p>Position Applied:
            <select name="positionApplied">
                <option>Software Engineer</option>
                <option>Network Administrator</option>
                <option>Database Administrator</option>
            </select>
        </p>
        <p>Years of Experience: <input type="number" name="yearsOfExperience" min="0" required></p>
        <p>Preferred Programming Language: <input type="text" name="preferredLanguage" required></p>
        <p>Expected Salary: <input type="number" step="0.01" name="expectedSalary" required></p>
        <p><input type="submit" value="Submit Application"></p>
    </form>

    <h2>All Applications</h2>
    <table border="1" cellpadding="5">
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Position</th>
            <th>Years Exp.</th>
            <th>Language</th>
            <th>Expected Salary</th>
            <th>Date Added</th>
            <th>Action</th>
        </tr>
        <?php foreach ($applications as $row) { ?>
        <tr>
            <td><?php echo $row['applicationId']; ?></td>
            <td><?php echo htmlspecialchars($row['firstName']); ?></td>
            <td><?php echo htmlspecialchars($row['lastName']); ?></td>
            <td><?php echo htmlspecialchars($row['email']); ?></td>
            <td><?php echo htmlspecialchars($row['phoneNumber']); ?></td>
            <td><?php echo htmlspecialchars($row['positionApplied']); ?></td>
            <td><?php echo $row['yearsOfExperience']; ?></td>
            <td><?php echo htmlspecialchars($row['preferredLanguage']); ?></td>
            <td><?php echo $row['expectedSalary']; ?></td>
            <td><?php echo $row['dateAdded']; ?></td>
            <td>
                <a href="update.php?id=<?php echo $row['applicationId']; ?>">Edit</a>
                <form action="delete.php" method="POST" style="display:inline;">
                    <input type="hidden" name="applicationId" value="<?php echo $row['applicationId']; ?>">
                    <input type="submit" value="Delete" onclick="return confirm('Delete this application?');">
                </form>
            </td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>
