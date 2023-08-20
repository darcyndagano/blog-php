<?php 
session_start();

// connect to database
	const MYSQL_HOST = 'localhost';
	const MYSQL_PORT = 3306;
	const MYSQL_NAME = 'blog';
	const MYSQL_USER = 'root';
	const MYSQL_PASSWORD = '';

try {
    $conn = new PDO(
        sprintf('mysql:host=%s;dbname=%s;port=%s', MYSQL_HOST, MYSQL_NAME, MYSQL_PORT),
        MYSQL_USER,
        MYSQL_PASSWORD
    );
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(Exception $exception) {
    die('Erreur : '.$exception->getMessage());
}
	
      

	define ('ROOT_PATH', realpath(dirname(__FILE__)));
	define('BASE_URL', 'http://localhost/blog/');
?>