<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
$CI =& get_instance();
$CI->load->helper('url');
$CI->load->library('session');
$CI->load->library('encrypt');
$CI->config->item('base_url');

class Functions {

    public function encryptor($object)
    {
    	$encoded = $this->encrypt->encode($object);
    	return  $encoded;
    }
    public function random(){
    	return random_string('alnum', 16);
    }

    public function view($object,$data){
    	if (!$data):
    		$this->load->view($object,'');
    	else:
    		$this->load->view($object,$data);
    	endif;
    }
}

/* End of file Someclass.php */