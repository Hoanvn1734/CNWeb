<?php
session_start();

// Gan session
function session_set($key, $value) {
    $_SESSION[$key] = $value;
}

// Lay session
function session_get($key) {
    return isset($_SESSION[$key]) ? $_SESSION[$key] : false;
}

// Xoa session
function session_delete($key) {
    if(isset($_SESSION[$key])) {
        unset($_SESSION[$key]);
    }
}
