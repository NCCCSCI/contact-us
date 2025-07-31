<?php
require_once 'common.php';

if (empty($_SESSION['count'])) {
	http_response_code(500);
	exit;
}

$_SESSION['ping'] = 0;

http_response_code(204);