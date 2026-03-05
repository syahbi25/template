<?php
// Check database connection and user hashes
// Usage: php tools/check_db.php [host] [user] [pass] [database]

$host = $argv[1] ?? 'localhost';
$user = $argv[2] ?? 'root';
$pass = $argv[3] ?? '';
$db   = $argv[4] ?? 'codeigniter';

echo "Checking MySQL connection to {$host}/{$db} as {$user}\n";
$mysqli = @new mysqli($host, $user, $pass, $db);
if ($mysqli->connect_errno) {
    echo "Connection failed: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error . "\n";
    exit(1);
}

echo "Connected. Checking users table...\n";
$res = $mysqli->query("SHOW TABLES LIKE 'users'");
if (!$res || $res->num_rows === 0) {
    echo "Table `users` not found in database {$db}.\n";
    exit(2);
}

$q = $mysqli->query("SELECT id,username,role,status FROM users ORDER BY id");
if (!$q) {
    echo "Query failed: " . $mysqli->error . "\n";
    exit(3);
}

echo "Users:\n";
while ($row = $q->fetch_assoc()) {
    echo " - [{$row['id']}] {$row['username']} (role={$row['role']}, status={$row['status']})\n";
}

// check admin hash
$q2 = $mysqli->query("SELECT password FROM users WHERE username='admin' LIMIT 1");
if ($q2 && $q2->num_rows) {
    $hash = $q2->fetch_assoc()['password'];
    echo "\nAdmin password hash: {$hash}\n";
    $ok = password_verify('password123', $hash) ? 'MATCH' : 'NO MATCH';
    echo "password_verify('password123', admin_hash) => {$ok}\n";
} else {
    echo "\nAdmin user not found.\n";
}

$mysqli->close();
echo "\nDone.\n";
