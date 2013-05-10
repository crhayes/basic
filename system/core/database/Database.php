<?php

namespace Core\Database;

use PDO;
use PDOException;

class DatabaseConnectionException extends \Exception {}

class Database
{
	/**
	 * Store a PDO instance.
	 * 
	 * @var PDO
	 */
	private $connection;

	/**
	 * Methods allowed for fetching results.
	 * 
	 * @var array
	 */
	private $fetchMethods = array('query', 'row', 'field');

	/**
	 * Create a new PDO connection with the given credentials.
	 * 
	 * @param  array 	$credentials
	 * @return void
	 */
	public function __construct($credentials)
	{
		extract($credentials);

		try {
			$this->connection = new PDO("mysql:host=$host;dbname=$database", $username, $password);
		} catch (PDOException $e) {
		    throw new DatabaseConnectionException('Incorrect database credentials provided');
		}
	}

	/**
	 * Create a new Database_Result object.
	 *
	 * Called by an instantiated Database object.
	 * 
	 * @param  int 		$fetchMethod
	 * @param  string 	$query
	 * @param  array 	$bindings
	 * @param  int 		$fetchMode
	 * @return Core\Database\Query
	 */
	public function queryObject($fetchMethod, $query, $bindings = null, $fetchMode = null)
	{
		$databaseQuery = new Query($this->connection, $query, $bindings, $fetchMethod, $fetchMode);

		return $databaseQuery->execute();
	}


	/**
	 * Magic method to capture undefined instantiated object method calls.
	 * 
	 * @param  string 	$name
	 * @param  array 	$arguments
	 * @return Core\Database\Query
	 */
	public function __call($name, $arguments)
	{
		// Add the name of the function called as the first argument (fetchMethod)
		array_unshift($arguments, $name);

		if (in_array($name, $this->fetchMethods)) {
			return call_user_func_array(array($this, 'queryObject'), $arguments);
		}
	}
}

