<?php
function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function validatePhone($phone) {
    // Validation simple de numéro de téléphone
    return preg_match('/^[0-9]{10}$/', $phone);
}

function validateDate($date) {
    $d = DateTime::createFromFormat('Y-m-d H:i:s', $date);
    return $d && $d->format('Y-m-d H:i:s') === $date;
}

function validatePrice($price) {
    return is_numeric($price) && $price >= 0;
}

function validateDuration($duration) {
    return is_numeric($duration) && $duration > 0;
}

function sanitizeInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>