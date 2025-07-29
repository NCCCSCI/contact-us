<?php
// since these statements are required for all the pages they are in a single common file

// session_start must be called before any output is sent to the client
session_start();

// this is the result of a warning from Firefox which adds another layer of security
$cookieParams = session_get_cookie_params();
$cookieParams['samesite'] = 'Strict';
session_set_cookie_params($cookieParams);