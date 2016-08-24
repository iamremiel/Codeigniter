<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vadmin extends CI_Controller {

		function __construct()
	{
		parent::__construct();
		$this->data['script_url'] = base_url().'cxase/';

	}


	public function index()
	{
		// $this->load->view('welcome_message');
		$this->login();
	}
	
	public function login(){
		$this->data['script_url'] = base_url().'cxase/';
		$this->data['title']="login";
		$this->data['message'] = $this->session->flashdata('message');

		$this->load->view('pages/vadmin/index',$this->data);
	}

	public function login_ctrl(){
		$success = $this->Tour_m->login('credentials');
		if($success): 
			$this->login();
		else:
			$this->session->set_flashdata('message','error'); 
			redirect(base_url('vadmin'));
			
		endif;
			}



	public function encryptor($sample){
	
    	$encoded = $this->encrypt->encode($sample);
    	echo  $encoded;
    
	}
	public function decryptor(){

		$sample ="KNthBe6DZsQCQRqWbNJ79rjg0n4d/bPpj4vN06bypeIDCWenBKZkx8ydMIm7k2azaZbtDpAWIzTqLFi1w6woyw==";
    	$decoded = $this->encrypt->decode($sample);
    	echo  $decoded;
    
	}
}
