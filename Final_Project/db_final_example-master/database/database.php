<?php
	class Database
	{
		protected $db; // db variable

		public function __construct() {

			/*
			 * Host information
			 */

			// define(host, 'Your-Host');
			// define(user, 'Your-Username');
			// define(password, 'Your-Password');
			// define(database, 'Your-Database');
			// define(port, 'Your-Port');
			
		define(host, 'localhost');
		define(user, 'root');
		define(password, '');
		define(database, 'final_project');
		define(port, 3306);
	// echo '123';
	// connect to the database
	$mysqli = new mysqli(host, user, password, database,port);

			$this->db = $mysqli;
			
		}
	}
	error_reporting(E_ALL ^ E_WARNING ^ E_NOTICE);
?>