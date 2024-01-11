<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $firstName = $_POST["firstName"];
    $middleName = $_POST["middleName"];
    $surname = $_POST["surname"];
    $email = $_POST["email"];
    $sex = $_POST["sex"];
    $subjects = isset($_POST["subjects"]) ? implode(', ', $_POST["subjects"]) : "No subjects selected";

    // Database connection parameters
    $servername = "localhost";
    $username_db = "root";
    $password_db = '';
    $dbname = "form1";

    // Create connection
    $conn = new mysqli($servername, $username_db, $password_db, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert data into the database
    $sql = "INSERT INTO form1 (firstName,middleName, surname, email, sex, subjects)
            VALUES ('$firstName', '$middleName', '$surname', '$email', '$sex', '$subjects')";

    if ($conn->query($sql) === TRUE) {
        echo "<h2>Submitted Information</h2>";
        echo "<p>Data has been successfully inserted into the database.</p>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close connection
    $conn->close();
} else {
    // Redirect to the form if accessed directly
    header("Location: index.html");
    exit();
}
?>