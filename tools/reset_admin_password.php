<?php
// Reset admin password to a given value (default: password123)
// Usage: php tools/reset_admin_password.php [host] [user] [pass] [database] [newpassword]

$host = $argv[1] ?? 'localhost';
$user = $argv[2] ?? 'root';
$pass = $argv[3] ?? '';
$db   = $argv[4] ?? 'codeigniter';
$new  = $argv[5] ?? 'password123';

echo "Connecting to {$host}/{$db} as {$user}...\n";
$mysqli = @new mysqli($host, $user, $pass, $db);
if ($mysqli->connect_errno) {
    echo "Connection failed: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error . "\n";
    exit(1);
}

$hash = password_hash($new, PASSWORD_BCRYPT);
$stmt = $mysqli->prepare("UPDATE users SET password = ? WHERE username = 'admin'");
if (!$stmt) {
    echo "Prepare failed: " . $mysqli->error . "\n";
    exit(2);
}
$stmt->bind_param('s', $hash);
if ($stmt->execute()) {
    echo "Admin password updated to '{$new}' (bcrypt).\n";
} else {
    echo "Update failed: " . $stmt->error . "\n";
}
$stmt->close();
$mysqli->close();

echo "Done.\n";
