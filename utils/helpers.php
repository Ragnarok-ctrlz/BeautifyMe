<?php
function redirect($url) {
    header("Location: $url");
    exit;
}

function isPostRequest() {
    return $_SERVER['REQUEST_METHOD'] === 'POST';
}

function formatPrice($price) {
    return number_format($price, 2, ',', ' ') . ' €';
}

function formatDuration($minutes) {
    $hours = floor($minutes / 60);
    $mins = $minutes % 60;
    if ($hours > 0) {
        return $hours . 'h' . ($mins > 0 ? sprintf('%02d', $mins) : '');
    } else {
        return $minutes . 'min';
    }
}

function getCurrentDateTime() {
    return date('Y-m-d H:i:s');
}

function generateSlug($string) {
    $slug = preg_replace('/[^a-z0-9]+/i', '-', $string);
    $slug = trim($slug, '-');
    $slug = strtolower($slug);
    return $slug;
}

function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function validatePhone($phone) {
    return preg_match('/^[0-9]{10}$/', $phone);
}

function validateDate($date) {
    $d = DateTime::createFromFormat('Y-m-d H:i:s', $date);
    return $d && $d->format('Y-m-d H:i:s') === $date;
}

function sanitizeInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>