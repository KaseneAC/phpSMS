<?php

// Subscriber Class

class Subscriber {
	
	private $id;
	private $publisherid;
	private $firstname;
	private $lastname;
	private $email;
	private $cellnumber;
	private $carrier;
	
	
	private $isInitalized = false;
	
	// Constructior - Set All Members To Null
	function __construct()
	{
		$this->id = null;
		$this->publisherid = null;
		$this->firstname = null;
		$this->lastname = null;
		$this->email = null;
		$this->cellnumber = null;
		$this->carrier = null;
		$this->isInitalized = true;
	}
	
	// init() - Manually Set Variables
	function init($args)
	{
		$this->publisherid = $args['publisherid'];
		$this->firstname = $args['firstname'];
		$this->lastname = $args['lastname'];
		$this->email = $args['email'];
		$this->cellnumber = $args['cellnumber'];
		$this->carrier = $args['carrier'];
	}
	
	
	
	// save() - Save This Subscriber To Database
	function save()
	{
		
		// Check If Object Has Been Initalized 
		if ($this->isInitalized)
		{
	
			try{
				// Construct DSN
				$dsn = 'mysql:host='.DBSettings::Host.';port='.DBSettings::Port.';dbname='.DBSettings::Database;
				
				// Construct Database Object
				$db = new PDO($dsn, DBSettings::Username, DBSettings::Password);
				
				// Construct Query String
				$Query = "INSERT INTO subscriber (publisherid, firstname, lastname, email, cellnumber, carrier)
				VALUES (:publisherid, :firstname, :lastname, :email, :cellnumber, :carrier)";
				
				// Prepare SQL Query
				$Statement = $db->prepare($Query);
				
				// Execute Prepared Statement
				$Result = $Statement->execute(array(':publisherid' => $this->publisherid,
										  ':firstname' => $this->firstname,
										  ':lastname' => $this->lastname,
										  ':email' => $this->email,
										  ':cellnumber' => $this->cellnumber,
										  ':carrier' => $this->carrier));
										  
				
				if ($Result) // Check For Statement Execution Error
				{
					// Get Affected Rows
					$Result = $Statement->rowCount();
					
					// Make Sure 1 New Entry Was Saved
					if ($Result == 1) // If Query Executed Insert On 1 Row
					{
						return true;
						
					} else
					{
						throw new Exception("Insert Query Returned ".$Result.' Affected Rows.');
						return false;
					}
					
					
				} else
				{
					throw new Exception('There Was A MySQL Error: '.$Statement->errorInfo());
					return false;
				}	
					
				
			} catch(PDOException $e)
			{
				throw new Exception('PDO Exception Occurred: '.$e->getMessage());
				return false;
			}
		
		
		} else
		{
			throw new Exception("Publisher Has Not Been Initialized Properly.");
			return false;
		}
	}
	
	
	// load(id) - Load This Subscribers Data From Database
	// id: The Index ID Of The Subscriber To Load
	function load($id)
	{
		try{

			// Construct DSN
			$dsn = 'mysql:host='.DBSettings::Host.';port='.DBSettings::Port.';dbname='.DBSettings::Database;
		
			// Construct Database Object
			$db = new PDO($dsn, DBSettings::Username, DBSettings::Password);
			
			
			// Construct Query String
			$Query = "SELECT * FROM subscriber WHERE id = :id LIMIT 1";
			
			// Prepare SQL Query
			$Statement = $db->prepare($Query);
			
			// Execute Prepared Statement
			$Result = $Statement->execute(array(':id' => $id));
			
			$SubObject = $Statement->fetchObject();
			
			// Populate This Object With Remote Data
			$this->id = $SubObject->id;
			$this->publisherid = $SubObject->publisherid;
			$this->firstname = $SubObject->firstname;
			$this->lastname = $SubObject->lastname;
			$this->email = $SubObject->email;
			$this->cellnumber = $SubObject->cellnumber;
			$this->carrier = $SubObject->carrier;
			
		
			
		} catch(PDOException $e)
		{
			echo "PDO Exception Occurred: ".$e->getMessage();
			return false;
		}
	}
	
	
	
}