<?php

// Publisher Class

class Publisher {
	
	// Account Details
	private $id;
	private $companyname;
	private $email;
	private $password;
	
	// Billing Details
	private $active;
	private $address1;
	private $address2;
	private $city;
	private $state;
	private $zip;
	
	// Class Members
	private $isInitalized = false;
	
	
	function __construct()
	{
		$this->id = null;
		$this->companyname = null;
		$this->email = null;
		$this->password = null;
		$this->active = null;
		$this->address1 = null;
		$this->address2 = null;
		$this->city = null;
		$this->state = null;
		$this->zip = null;
		$this->isInitalized = true;
	}
	
	
	public function init($args)
	{
		$this->companyname = $args['companyname'];
		$this->email = $args['email'];
		$this->password = $args['password'];
		$this->address1 = $args['address1'];
		$this->address2 = $args['address2'];
		$this->city = $args['city'];
		$this->state = $args['state'];
		$this->zip = $args['zip'];
	}
	
	
	public function save()
	{
	
		try{
			
			// Construct DSN
			$dsn = 'mysql:host='.DBSettings::Host.';port='.DBSettings::Port.';dbname='.DBSettings::Database;
			
			// Construct Database Object
			$db = new PDO($dsn, DBSettings::Username, DBSettings::Password);
			
			// Construct Query String
			$Query = "INSERT INTO publisher (companyname, email, password, address1, address2, city, state, zip)
			VALUES (:companyname, :email, :password, :address1, :address2, :city, :state, :zip)";
			
			// Prepare SQL Query
			$Statement = $db->prepare($Query);
			
			// Execute Prepared Statement
			$Result = $Statement->execute(array(':companyname' => $this->companyname,
												':email' => $this->email,
												':password' => $this->password,
												':address1' => $this->address1,
												':address2' => $this->address2,
												':city' => $this->city,
												':state' => $this->state,
												':zip' => $this->zip));
										  
			
		} catch(PDOException $e)
		{
			throw new Exception("PDO Exception Occurred: ".$e->getMessage());
			return false;
		}
	
		
	}
	
	
	
}