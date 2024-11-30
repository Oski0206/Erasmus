<?php
// Start sesji, jeśli jeszcze nie została rozpoczęta
session_start();

// Usunięcie wszystkich zmiennych sesji
$_SESSION = [];

// Zniszczenie sesji
session_destroy();

// Opcjonalnie usunięcie ciasteczka sesji (jeśli zostało utworzone)
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Przekierowanie użytkownika (np. na stronę logowania)
header("Location: index.php");
exit();
?>
