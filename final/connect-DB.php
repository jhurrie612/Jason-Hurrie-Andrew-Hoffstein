<!-- Connecting -->
<?php
$databaseName = 'AHOFFSTE_labs';
$dsn = 'mysql:host=webdb.uvm.edu;dbname=' . $databaseName;
$username = 'ahoffste_writer';
$password = 'SbV47dyCfHP7';
$pdo = new PDO($dsn, $username, $password);
?>
<!-- Connection complete -->