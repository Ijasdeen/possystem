<?php
// SECURITY: Optional secret key for basic protection
$secret = 'mysecret123'; // CHANGE THIS

if (!isset($_GET['key']) || $_GET['key'] !== $secret) {
    http_response_code(403);
    echo "Unauthorized";
    exit;
}

// Run the Git pull
$cmd = 'cd /home/ijasdeen/public_html/possystem2 && git pull 2>&1';
$output = shell_exec($cmd);
echo "<pre>$output</pre>";
?>
