<?php
// Database credentials
$host = 'localhost';
$db   = 'college';
$user = 'root';       // your MySQL username
$pass = '';           // your MySQL password (usually empty in XAMPP)
$charset = 'utf8mb4';

// Set up DSN and options for PDO
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    // Create PDO instance (connect to DB)
    $pdo = new PDO($dsn, $user, $pass, $options);

    // Prepare and execute query
    $stmt = $pdo->query('SELECT student_id, first_name, email FROM student');

    // Fetch all results as associative arrays
    $students = $stmt->fetchAll();

} catch (\PDOException $e) {
    // Handle connection error
    echo "Database connection failed: " . $e->getMessage();
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Show MySQL Data</title>
    <style>
        table {
            border-collapse: collapse;
            width: 60%;
            margin: 50px auto;
            font-family: Arial, sans-serif;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #007BFF;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        caption {
            font-size: 1.5em;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <table>
        <caption>Student List</caption>
        <thead>
            <tr>
                <th>ID</th><th>Name</th><th>Email</th>
            </tr>
        </thead>
        <tbody>
           <?php if ($students && count($students) > 0): ?>
                <?php foreach ($students as $student): ?>
                <tr>
                    <td><?= htmlspecialchars($student['student_id']) ?></td>
                    <td><?= htmlspecialchars($student['first_name']) ?></td>
                    <td><?= htmlspecialchars($student['email']) ?></td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="3">No data found.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
