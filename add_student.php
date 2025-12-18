<?php
require "header.php";
require "functions.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $name = formatName($_POST["name"]);
        $email = $_POST["email"];
        $skills = $_POST["skills"];

        if (!$name || !validateEmail($email) || empty($skills)) {
            throw new Exception("Invalid input");
        }

        $skillsArray = cleanSkills($skills);
        saveStudent($name, $email, $skillsArray);

        echo "Student saved successfully";
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
?>

<form method="post">
    Name: <input type="text" name="name"><br><br>
    Email: <input type="text" name="email"><br><br>
    Skills: <input type="text" name="skills"><br><br>
    <button type="submit">Save</button>
</form>

<?php require "footer.php"; ?>
