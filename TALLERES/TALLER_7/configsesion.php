<?php

session_start([
    'cookie_lifetime' => 600, // 10 minutos
    'cookie_secure' => true, 
    'cookie_httponly' => true, 
]);

function setUserCookie($username) {
    setcookie('username', htmlspecialchars($username), time() + 600, "/", "", true, true); // 10 minutos
}

function sanitize($data) {
    return htmlspecialchars(trim($data));
}
?>
