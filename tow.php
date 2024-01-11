<!DOCTYPE html>
<html>
<head>
  <title>Form Submission Result</title>
</head>
<body>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $firstName = $_POST["firstName"] ?? '';
  $middleName = $_POST["middleName"] ?? '';
  $lastName = $_POST["lastName"] ?? '';
  $email = $_POST["email"] ?? '';
  $sex = $_POST["sex"] ?? '';
  $subjects = isset($_POST["subject"]) ? $_POST["subject"] : [];

  
  $formData = array(
    "First Name" => $firstName,
    "Middle Name" => $middleName,
    "Last Name" => $lastName,
    "Email" => $email,
    "Sex" => $sex,
    "Subjects Taken" => implode(", ", $subjects) 
  );

  echo "<h2>Form Data Received:</h2>";
  echo "First Name: " . $firstName . "<br>";
  echo "Middle Name: " . $middleName . "<br>";
  echo "Last Name: " . $lastName . "<br>";
  echo "Email: " . $email . "<br>";
  echo "Sex: " . $sex . "<br>";
  echo "Subjects Taken: " . implode(", ", $subjects) . "<br>";

  echo "<hr/>";

  
  $file = fopen("form_data.csv", "a"); 
  if ($file !== false) {
    fputcsv($file, $formData); 
    fclose($file); 
    echo "<h2>Data has been saved to form_data.csv</h2>";
  } else {
    echo "<p>Failed to open file. Check permissions.</p>";
  }

  echo "<hr/>";
  
  echo "<table border='1'>";
  foreach ($formData as $key => $value) {
    echo "<tr>";
    echo "<td>{$key}</td><td>{$value}</td>";
    echo "</tr>";
  }
  echo "</table>";
} else {
  echo "<p>No data received.</p>";
}
?>

</body>
</html