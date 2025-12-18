<?php

function formatName($name)
{
    return ucwords(strtolower(trim($name)));
}

function validateEmail($email)
{
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function cleanSkills($string)
{
    $skills = explode(",", $string);
    return array_map('trim', $skills);
}

function saveStudent($name, $email, $skillsArray)
{
    $data = $name . "|" . $email . "|" . implode(",", $skillsArray) . PHP_EOL;
    file_put_contents("students.txt", $data, FILE_APPEND);
}

function uploadPortfolioFile($file)
{
    if ($file['error'] !== 0) {
        throw new Exception("Upload error");
    }

    if ($file['size'] > 2097152) {
        throw new Exception("File too large");
    }

    $allowed = ['pdf', 'jpg', 'jpeg', 'png'];
    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

    if (!in_array($ext, $allowed)) {
        throw new Exception("Invalid file type");
    }

    if (!is_dir("uploads")) {
        mkdir("uploads");
    }

    $newName = uniqid("portfolio_") . "." . $ext;
    $path = "uploads/" . $newName;

    if (!move_uploaded_file($file['tmp_name'], $path)) {
        throw new Exception("Failed to move file");
    }

    return $newName;
}
