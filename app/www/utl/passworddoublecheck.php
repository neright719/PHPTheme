<?php

function password_double_check($password, $password_again) {
    if (empty($password) || empty($password_again)) {
        return false;
    }
    if ($password !== $password_again) {
        return false;
    }
    return true;
}