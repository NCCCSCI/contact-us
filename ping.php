<?php
require_once 'common.php';

// if the index.php page was not visited first, or the session timed out, report an error
// 500 is a generic error - it does not disclose any information as to why the request is being refused
if (empty($_SESSION['count'])) {
	http_response_code(500);
	// be sure to exit, to prevent the script from proceeding
	exit;
}
// set a variable so the timestamp of the file will be updated
$_SESSION['ping'] = 0;
// 204 means no content - the server processed the request successfully but is not sending anything back
http_response_code(204);