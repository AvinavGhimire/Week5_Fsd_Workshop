<?php
require "header.php";
require "functions.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $fileName = uploadPortfolioFile($_FILES["portfolio"]);
        echo "File uploaded: " . $fileName;
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
?>

<form method="post" enctype="multipart/form-data">
    Select File: <input type="file" name="portfolio"><br><br>
    <button type="submit">Upload</button>
</form>

<?php require "footer.php"; ?>
