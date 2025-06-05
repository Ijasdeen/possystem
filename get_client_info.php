<?php
function get_client_ip() {
    $keys = ['HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'REMOTE_ADDR'];
    foreach ($keys as $key) {
        if (!empty($_SERVER[$key])) {
            $ipList = explode(',', $_SERVER[$key]);
            return trim($ipList[0]);
        }
    }
    return 'UNKNOWN';
}

$ip = get_client_ip();
$agent = $_SERVER['HTTP_USER_AGENT'];
$datetime = date('Y-m-d H:i:s');

echo json_encode([
    'ip' => $ip,
    'user_agent' => $agent,
    'datetime' => $datetime
]);
?>
