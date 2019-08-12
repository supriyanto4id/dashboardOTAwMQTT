<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct() {
							parent::__construct();
							
							if($this->session->userdata('status') != "login"){
								redirect(base_url("login"));
							}
	}

	public function index()
	{
			//The URL of the resource that is protected by Basic HTTP Authentication.
			$infoServer = '52.187.166.10:18083/api/v3/brokers';
			$listClient = '52.187.166.10:18083/api/v3/connections/';
			$listSubscribe = '52.187.166.10:18083/api/v3/subscriptions/';
			//Your username.
			$username = 'admin';
			
			//Your password.
			$password = 'public';
			
			//Initiate cURL.
			$chInfoServer = curl_init($infoServer);
			$chListClient = curl_init($listClient);
			$chListSubscribe = curl_init($listSubscribe);
			
			//Specify the username and password using the CURLOPT_USERPWD option.
			curl_setopt($chInfoServer, CURLOPT_USERPWD, $username . ":" . $password);  
			//Specify the username and password using the CURLOPT_USERPWD option.
			curl_setopt($chListClient, CURLOPT_USERPWD, $username . ":" . $password);  
			//Specify the username and password using the CURLOPT_USERPWD option.
			curl_setopt($chListSubscribe, CURLOPT_USERPWD, $username . ":" . $password);  
			
			//Tell cURL to return the output as a string instead
			//of dumping it to the browser.
			curl_setopt($chInfoServer, CURLOPT_RETURNTRANSFER, true);
			//of dumping it to the browser.
			curl_setopt($chListClient, CURLOPT_RETURNTRANSFER, true);
			//of dumping it to the browser.
			curl_setopt($chListSubscribe, CURLOPT_RETURNTRANSFER, true);
			
			//Execute the cURL request.
			$responseInfoServer = curl_exec($chInfoServer);
			$responseListClient = curl_exec($chListClient);
			$responseListSubscribe = curl_exec($chListSubscribe);
			
			//Check for errors.
			if(curl_errno($chInfoServer)){
				//If an error occured, throw an Exception.
				throw new Exception(curl_error($chInfoServer));
			}

			//Check for errors.
			if(curl_errno($chListClient)){
				//If an error occured, throw an Exception.
				throw new Exception(curl_error($chListClient));
			}
			
			//Check for errors.
			if(curl_errno($chListSubscribe)){
				//If an error occured, throw an Exception.
				throw new Exception(curl_error($chListSubscribe));
			}
			
			//parsing data dengan mengunakan objek
			$parsingData = json_decode($responseInfoServer);
			$parsingListClient= json_decode($responseListClient,true);
			$parsingListSubscribe= json_decode($responseListSubscribe,true);
	
			//menyimpan pada variabel $data berisi array data yang akan di tampilkan
			$data = array (
				'date_time' =>$parsingData->data[0]->datetime,
				'node' =>  $parsingData->data[0]->node,
				'node_status' => $parsingData->data[0]->node_status,
				'otp_release' => $parsingData->data[0]->otp_release,
				'uptime' => $parsingData->data[0]->uptime,
				'version' => $parsingData->data[0]->version,
				'sysdescr' => $parsingData->data[0]->sysdescr,
				'parsingListClient' => $parsingListClient,
				'parsingListSubscribe'=> $parsingListSubscribe
				
			);

			$this->load->view("templates/header.php");
			$this->load->view("templates/sidebar_dashboard.php");
			$this->load->view('dashboard/index.php', $data);
			$this->load->view("templates/footer.php");
			
			
		}

		
}
