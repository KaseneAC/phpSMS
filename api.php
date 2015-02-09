<?php

// *-------------------------------------------------*
// |SMS Notification Service API                     |
// |Developed By Kasene Clark - City Side Productions|
// *-------------------------------------------------*

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include Classes
include_once('carrier.php');
include_once('dbsettings.php');
include_once('publisher.php');
include_once('subscriber.php');
include_once('urlrouter.php');
// End Include Classes



// API Class

class API {
	
	
	
	
	
}




$mPublisher = new Publisher();
$mPublisher->init(array('companyname' => "City Side Productions",
						'email' => "kasene@citysideproductions.com",
						'password' => md5("Delete321"),
						'address1' => "1519 N Natrona St",
						'address2' => "",
						'city' => "Philadelphia",
						'state' => "PA",
						'zip' => "19121"));

print_r($mPublisher);

