<?php

include $_SERVER['DOCUMENT_ROOT'] . '/includes/website_parameters.php';

include $_SERVER['DOCUMENT_ROOT'] . '/includes/session_config.php';

include $_SERVER['DOCUMENT_ROOT'] . '/includes/database.php';

include $_SERVER['DOCUMENT_ROOT'] . '/includes/avatar.php';

include $_SERVER['DOCUMENT_ROOT'] . '/includes/user_data.php';

$_SESSION['csrf_token'] = $_SESSION['csrf_token'] ?? bin2hex(random_bytes(32));


if ($setting_maintenance === true && !in_array(basename($_SERVER['PHP_SELF']), ['maintenance_page.php', 'auth-form.php', 'auth-form-update.php'])) {
    header(header: 'location: ' . $_SERVER['DOCUMENT_ROOT'] . '/infos/maintenance_page.php');
    exit;
}


include $_SERVER['DOCUMENT_ROOT'] . '/includes/visitors.php';

include $_SERVER['DOCUMENT_ROOT'] . '/includes/errors_log.php';

?>