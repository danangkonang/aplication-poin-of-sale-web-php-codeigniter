<?php
$host="localhost";
$user="danang";
$pass="danang";
$db="penjualan";
// $conn = new mysqli($host, $user, $pass,$db);
// $create_table = $conn->query("CREATE TABLE products;");
// var_dump($create_table);
// $conn->close();

// $command = "mysql --user={$user} --password='{$pass}' "
//  . "-h {$host} -D {$db} < {$script_path}";

// $command = "mysql -U danang -P danang -S localhost -d penjualan 
// -Q 'SHOW TABLES'"

// shell_exec($command);

// $output = shell_exec("mysql -U danang -P danang -S localhost -D penjualan -Q 'SHOW TABLES'");
$output = shell_exec("mysql -U danang -P danang " . "./test.sql");
echo "<pre>$output</pre>";
