<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vuser extends CI_Controller {

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
		$this->data['page']= "login";
		$this->data['message'] = $this->session->flashdata('message');

		$this->viewer('pages/user/index',$this->data);
	}

	public function login_ctrl(){
		$success = $this->Tour_m->login('credentials');
		if($success): 
			$this->data['page'] = 'members_area';
			$this->members_area();
		else:
			$this->session->set_flashdata('message','error'); 
			redirect(base_url('vuser'));
			
		endif;
			}


	public function members_area(){
		$this->data['page']='members_area';
		$this->viewer('pages/user/index',$this->data);
	}



	// useful functions
		public function viewer($object,$data){
			if(!$data):
			return $this->load->view($object);
			else:
			return $this->load->view($object,$this->data);
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
