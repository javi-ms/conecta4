<?php
	require_once "configDB.php"; // datos config. BD
	
	class ConectaDB
	{
		private $_host;
		private $_database;
		private $_user;
		private $_pass;
		private $_port;
		private $_mngDB;		
		
		public function __construct()
		{
			$this->_host = HOST;
			$this->_database = DATABASE;
			$this->_user = USER;
			$this->_pass = PASS;
			$this->_port = PORT;

			//Cadena de conexión
			$dsn = 'mysql:host=' . $this->_host . ';'
					. 'dbname=' . $this->_database . ';'
					. 'port=' . $this->_port;

			try {
				$this->_mngDB = new PDO($dsn, $this->_user, $this->_pass);
				$this->_mngDB->query("SET NAMES UTF8");
			} catch (PDOException $e) {
				printf("Conexión fallida: %s\n", $e->getMessage());
				exit();
			}
		}

		/**
		 * Devuelve el manejador de la base 
		 * de datos
		 */
		public function get_mngDB()
		{
			return $this->_mngDB;
		}	

		/**
		 * Prepara y ejecuta una consulta a
		 * la base de datos, para obtener su
		 * resultado
		 */
		public function query($sql, $values=array())
		{
			$_result = false;
			
			try {
			  $result = $this->_mngDB->prepare($sql);
			  $result->execute($values);
  			  $_result = $result->fetchAll(PDO::FETCH_ASSOC);
			} catch (PDOException $e) {
				printf("Conexión fallida: %s\n", $e->getMessage());
				exit();
			}
			return $_result;
		}
		
		/**
		 * Devuelve el número de filas afectadas 
		 * por la última sentencia DELETE, INSERT 
		 * o UPDATE ejecutada por el objeto 
		 * PDOStatemente 
		 */
		public function rowCount($sql, $values=array())
		{
	        $_result = false;

	        try{
	        	$_consult = $this->_mngDB->prepare($sql);
	        	$_consult->execute($values);
	        	$_result = $_consult->rowCount();
	        }catch(PDOException $e){
	            printf("Consulta fallida: %s\n", $e->getMessage());
	            exit();
	        }
	        return $_result;
	    }
	}