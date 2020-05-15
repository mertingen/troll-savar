<?php

session_start();

unset($_SESSION['access_token']);
unset($_SESSION['access_token_secret']);

echo json_encode(array('success'));