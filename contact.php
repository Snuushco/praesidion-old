<?php
header('Content-Type: application/json');

// Validate input
$required_fields = ['naam', 'email', 'telefoon', 'bericht'];
$errors = [];

foreach ($required_fields as $field) {
    if (empty($_POST[$field])) {
        $errors[$field] = 'Dit veld is verplicht';
    }
}

if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = 'Ongeldig e-mailadres';
}

if (!empty($errors)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'errors' => $errors]);
    exit;
}

// Sanitize input
$naam = htmlspecialchars($_POST['naam']);
$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
$telefoon = htmlspecialchars($_POST['telefoon']);
$bericht = htmlspecialchars($_POST['bericht']);

// Prepare email
$to = 'info@praesidion.eu';
$subject = 'Nieuwe contactaanvraag van ' . $naam;
$message = "Naam: $naam\n";
$message .= "E-mail: $email\n";
$message .= "Telefoon: $telefoon\n\n";
$message .= "Bericht:\n$bericht";

$headers = "From: $email\r\n";
$headers .= "Reply-To: $email\r\n";
$headers .= "X-Mailer: PHP/" . phpversion();

// Send email
if (mail($to, $subject, $message, $headers)) {
    echo json_encode(['success' => true]);
} else {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Er is een fout opgetreden bij het versturen van het bericht']);
}
?> 