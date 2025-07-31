<?php

session_start();

$cookieParams = session_get_cookie_params();
$cookieParams['samesite'] = 'Strict';
session_set_cookie_params($cookieParams);