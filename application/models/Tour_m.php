<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Tour_m extends CI_Model
{
	function __construct()
	{
		parent::__construct();

	}

	public  function check_logged(){
    return ($this->session->userdata('logged_user'))?TRUE:FALSE;
  	}

	public function login($table_name){
		$this->db->select('*');
		$this->db->from($table_name);
		$this->db->where('email',$_POST['email']);
		
		$query=$this->db->get();

		$query = $query->result_array();

		if($this->encrypt->decode($query[0]['pass']) == $_POST['pass']):

		$datas = array('email' => $query[0]['email'],
       					'hash' => $query[0]['hash'],);
        $this->session->set_userdata('logged_user',$datas);
        return $query;

        else:
        return false;
    	endif;
	}

	public  function registered($table_name,$column_where,$data){
    $this->db->select('*');
    $this->db->from($table_name);
   // $this->db->where('users_id_number', $this->input->post(''));
    $this->db->or_where($column_where, $data);
    $query = $this->db->get();
      if ($query->num_rows() > 0) {
      foreach ($query->result() as $row) {
        $data[] = $row;
        }
      return $data;
    }
      return false;
  	}

  		public function get_specific_data($table_name,$table_column,$strings)
	{
		$this->db->select($table_column);
		$result	= $this->db->get_where($table_name, array($table_column=>$strings));
		$result	= $result->row();
		return $result->$table_column;
	}

/*	public function login($table_name,$column_where,$column_pass,$hash){
    $this->db->select('*');
    $this->db->from($table_name);
    $this->db->where($column_where , $this->input->post('username'));
    $query = $this->db->get();
    $query = $query->result_array();

    if($this->encrypt->decode($query[0][$column_pass])==$this->input->post('password')) {
    //   $this->session->set_userdata('logged_user',$query[0]['alumni_email']);
       $datas = array($column_where => $query[0][$column_where],
       				  $hash => $query[0][$hash],);
       		//		  'logged_email'=> $query[0]['users_id_number']);
       $this->session->set_userdata('logged_user',$datas);
      return $query;
      }else{
      return false;
      }
      }*/

	public function select_pass($email){
		$this->db->select('pass');
		$this->db->from('credentials');
		$this->db->where('email',$email);
		$query=$this->db->get();

		if($query->num_rows() > 0): 
		   $decoded = $this->encrypt->decode($query);
		   endif;
	}

	public function add_data($table_name,$data)
	{
		$this->db->insert($table_name,$data);
		$this->db->insert_id();
	}

	public function update_data($table_name,$table_column,$hash,$data)
	{
		$this->db->where($table_column,$hash);
		$this->db->update($table_name,$data);
		
		//$this->db->insert_id();
	}

	public function get_sum_data($table_name,$table_column,$table_column1,$hash){
		$this->db->select_sum($table_column);
		$this->db->where($table_column1,$hash);
		$query = $this->db->get($table_name);
		return $query->first_row('array');
	}

	public function get_data_woption($table_name,$table_column,$hash)
	{
		$this->db->select('*');
		$this->db->from($table_name);
		$this->db->where($table_column,$hash);
		$query=$this->db->get();
		return $query->result_array();
	}

	public function get_two_data_woption_row($table_name,$table_column,$table_column1,$hash)
	{
		$this->db->select('*');
		$this->db->from($table_name);
		$this->db->where($table_column,$hash);
		$this->db->or_where($table_column1,$hash);
		$query=$this->db->get();
		return $query->first_row('array');
	}

	public function get_data_woption_row($table_name,$table_column,$hash)
	{
		$this->db->select('*');
		$this->db->from($table_name);
		$this->db->where($table_column,$hash);
		$query=$this->db->get();
		return $query->first_row('array');
	}

	public function get_data_woption_row_log($table_name,$table_column,$hash)
	{
		$this->db->select('*');
		$this->db->from($table_name);
		$this->db->where($table_column,$hash);
		$query=$this->db->get();
		// return $query->first_row('array');

		$datas = array($table_column => $hash);
        $this->session->set_userdata('logged_user',$datas);
        
		$query = $query->first_row('array');
		return $query;

		$datas = array($table_column => $hash);
        $this->session->set_userdata('logged_user',$datas);


	}

		public function get_all_data($table_name)
	{
		$this->db->select('*');
		$this->db->from($table_name);
		// $this->db->where($table_column,$hash);
		$query=$this->db->get();
		return $query->result_array();
		// return $query->first_row('array');
	}

	public function get_one_data($table_name,$column_name,$id)
	{
		$this->db-> select('*');
		$this->db-> from($table_name);
		$this->db->where($column_name,$id);
		$query = $this->db->get();
		return $query->first_row('array');
	}

   
  public function delete($table_name,$column_name,$n,$hash)
  {
  	for($i=0; $i < $n; $i++)
	{
	//$result = mysql_query("DELETE FROM member where member_id='$id[$i]'");
	$this->db->where($column_name, $hash[$i]);
	$this->db->delete($table_name); 
	}
  	
  }

      public function delete_data($hash,$table_column1,$table_name)
	{
		$this->db->where($table_column1, $hash);
		$this->db->delete($table_name);
	}

   public function update($table_name,$column_name,$n,$hash,$data)
  {
  	for($i=0; $i < $n; $i++)
	{
	//$result = mysql_query("DELETE FROM member where member_id='$id[$i]'");
	$this->db->where($column_name, $hash[$i]);
	$this->db->update($table_name,$data); 
	}
  	
 	 }

}