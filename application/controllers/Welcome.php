<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'libraries/swift_mailer/swift_required.php';

class Welcome extends CI_Controller
{
    
    function __construct()
    {
        parent::__construct();
        $logged_in=$this->Tour_m->check_logged();
        $this->data['script_url'] = base_url() . 'cxase/materialize/';
        $this->load->library('My_phpmailer');
        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        
    }
    
    public function index()
    {
        // $this->load->view('welcome_message');
        $this->rem();
    }

    public function sess_check_out(){
        $logged_in=$this->Tour_m->check_logged();
        if(!$logged_in)
        {
            redirect(base_url());
        }

    }

    function if_registered(){
    
    $requestedEmail  = $_POST['email'];
    // $requestedEmail='jenson1@jenson.in';
    $checker = $this->Tour_m->get_data_woption_row('ternuhan','email',$requestedEmail);

    if (!$checker):
        echo "true";
    
    else:
        echo"false";
    endif;

    // if( in_array($requestedEmail, $registeredEmail) ){
    //     echo 'false';
    // }
    // else{
    //     echo 'true';
    // }

    }

    function email_body(){
    echo "<strong>Good Day Cielo!</strong><br></br><p>Thank you for Registration</p>";
    }

    function emailer($sendto,$recipientname,$emailbody,$subject){
                 
        //Create the Transport
        $transport = Swift_MailTransport::newInstance();

        /*
        You could alternatively use a different transport such as Sendmail or Mail:

        //Sendmail
        $transport = Swift_SendmailTransport::newInstance('/usr/sbin/sendmail -bs');

        //Mail
        $transport = Swift_MailTransport::newInstance();
        */

        //Create the message
        $message = Swift_Message::newInstance();

        //Give the message a subject
        $message->setSubject($subject)
                ->setFrom(array('noreply@domain.com' => 'CHH IT Team'))
                ->setTo(array($sendto => $recipientname))
                ->setBody('Here is the message itself')
                ->addPart($emailbody, 'text/html')
        ;

        //Create the Mailer using your created Transport
        $mailer = Swift_Mailer::newInstance($transport);

        //Send the message
        $result = $mailer->send($message);

        if ($result) {
            echo "Email sent successfully";
        } else {
            echo "Email failed to send";
        }
                               
    }

    function check_if_exist(){

    $requestedcode = $_POST['code'];
    // $requestedEmail='jenson1@jenson.in';
    $checker = $this->Tour_m->get_data_woption_row_log('ternuhan','hash',$requestedcode);

    if (!$checker):
        echo "false";
    
    else:
        echo"true";

    endif;

    // if( in_array($requestedEmail, $registeredEmail) ){
    //     echo 'false';
    // }
    // else{
    //     echo 'true';
    // }

    }

    function rem(){
        $this->data['hash']       = $this->functions->random();
        $this->data['title']      = 'Ternuhan System';
        $this->data['script_url'] = base_url() . 'cxase/materialize/';
        $this->data['message']    = $this->session->flashdata('message');
        $this->data['img_url']    = base_url() . 'cxase/imgs/icons/';
        // $this->data['invested_sum'] = $this->Tour_m->get_sum_data('amounts','amount','hash',$);
        $this->data['edit_user']  = "";
        $this->data['users']      = $this->Tour_m->get_all_data('ternuhan');
        $this->data['page'] = 'homepage';
        $this->load->view('index',$this->data);
    }


    function rem_ctrl(){

        $checker = $this->Tour_m->get_data_woption_row_log('ternuhan','hash',$_POST['code']);
        switch ($checker['type']) {

        case 0:
            echo "Admin";
            redirect(base_url('welcome/crud_admin'));
            break;
        
        case 1:
            echo "Editor";
            redirect(base_url('welcome/crud_editor'));
            break;
        
        case 2:
            echo "User";
            redirect(base_url('welcome/crud'));
            break;

        default:
            echo "Default";
            redirect(base_url('welcome/crud'));
            break;
    }
        // redirect(base_url('welcome/crud/'));
    }
    
    function cruds($hash)
    {
        if (empty($hash)) {
            redirect(base_url());
        }

            $hashval = $this->session->userdata('logged_user')['hash'];
            $getuser = $this->Tour_m->get_data_woption_row('ternuhan','hash',$hashval);
            $getdatarow = $this->Tour_m->get_data_woption_row('ternuhan','hash',$hash);
        if (isset($_GET['id'])):
            // $reg = $this->Tour_m->registered('ternuhan','email');
            $getdatarow = $this->Tour_m->get_data_woption_row('ternuhan','hash',$hash);
            $this->data['hash']         = $hash;
            $this->data['message']      = $this->session->flashdata('message');
            $this->data['edit_user']    = $this->Tour_m->get_one_data('ternuhan', 'hash', $hash);
            $this->data['invested_sum'] = $this->Tour_m->get_sum_data('amounts', 'amount', 'hash', $hash);
            $this->data['invested']     = $this->Tour_m->get_data_woption('amounts', 'hash', $hash);
            $this->data['message']      = $this->session->flashdata('message');
            switch($getuser['type'])
            {
                case 0:
                        $this->load->view('ajax', $this->data);
                break;
                
                case 1:
                        $this->load->view('ajax', $this->data);
                break;
                
                case 2:
                        $this->load->view('ajax1', $this->data);
                break;
            }
        
        elseif (isset($_POST['edit'])):
            $hashed=$this->Tour_m->get_specific_data('ternuhan','hash',$hash);
            if ($hashed != $hash or empty($hash)) {
            redirect(base_url());         
            }
            $name    = $_POST['first_name'] . ' ' . $_POST['last_name'] . ' ' . $_POST['extension'];
            $amount  = $_POST['amount'];
            $amt_add = $_POST['amount_add'];
            if (empty($_POST['amount_add'])):
                $data = array(
                    'name' => $name,
                    'amount' => $amount
                );
                $this->Tour_m->update_data('ternuhan', 'hash', $hash, $data);
                $this->session->set_flashdata('message', 2);
                redirect(base_url('welcome/crud'));
            else:
              /*  $config['upload_path']   = './uploads/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size']      = '0';
                $config['max_width']     = '0';
                $config['max_height']    = '0';
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                
                if (!$this->upload->do_upload('file')):
                    $error = array(
                        'error' => $this->upload->display_errors()
                    );
                // $this->load->view('upload_form', $error);
                    
                // echo "FAILED!";
                    echo "<pre>";
                    echo print_r($error);
                    print_r($_POST);
                    print_r($_FILES);
                    echo "</pre>";
                else:
                    $data                     = array(
                        'upload_data' => $this->upload->data()
                    );
                    $config['image_library']  = 'gd2';
                    $config['source_image']   = './uploads/' . $data['upload_data']['file_name'];
                    $config['create_thumb']   = TRUE;
                    $config['maintain_ratio'] = TRUE;
                    $config['width']          = 75;
                    $config['height']         = 50;
                    $this->load->library('image_lib', $config);
                    $this->image_lib->resize();*/

                    $sum = $_POST['amount'] + $_POST['amount_add'];
                    
                    $data  = array(
                        'name' => $name,
                        'amount' => $sum,
                     //   'picture' => $data['upload_data']['file_name'],
                       // 'picture_thumb' => $data['upload_data']['raw_name'] . '_thumb' . $data['upload_data']['file_ext']
                    );
                    $datas = array(
                        'amount' => $amt_add,
                        'created_date' => date('Y/m/d'),
                        'hash' => $hash
                    );


                    $bodymessage = '<strong>Good Day '.$name.'</strong><br></br>
                                    <p>You Currently have : <b>PHP '.$sum.'</b> in your account</p>';
                    $bodymessage1 = '<strong>Good Day '.$name.'</strong><br></br>
                                    <p>Currently have : <b>PHP '.$sum.'</b> in account</p>
                                    <p>Edited by: '.$getuser['name'].'</p>';
                    $subject = 'Investment Update';

                    $this->emailer($getdatarow['email'],$getdatarow['name'],$bodymessage,$subject);
                    $this->emailer('iamremiel@gmail.com','Remmar',$bodymessage1,'CC');
                                            
                    $this->Tour_m->add_data('amounts', $datas);
                    $this->Tour_m->update_data('ternuhan', 'hash', $hash, $data);
                     $this->session->set_flashdata('message', 2);
                    if($getuser['type']==1):
                    redirect(base_url('welcome/crud_editor'));
                    elseif($getuser['type']==2):
                    redirect(base_url('welcome/crud'));
                    else:
                    redirect(base_url('welcome/crud_admin'));
                    endif;
                    
                    
               
                // endif;
            endif;
        elseif (isset($_POST['add'])):
            $name                    = $_POST['first_name'] . ' ' . $_POST['last_name'] . ' ' . $_POST['extension'];
            $amount                  = $_POST['amount'];
            $email                   = $_POST['email'];
            $config['upload_path']   = './uploads/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size']      = '0';
            $config['max_width']     = '0';
            $config['max_height']    = '0';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if ($this->Tour_m->registered('ternuhan','email',$_POST['email'])):
                   $this->session->set_flashdata('message', 3);
                   redirect(base_url());
                else:
                    if (!$this->upload->do_upload('userfile')):
                $error = array(
                    'error' => $this->upload->display_errors()
                );
            // $this->load->view('upload_form', $error);
                
            // echo "FAILED!";
                echo "<pre>";
                echo print_r($error);
                print_r($_POST);
                print_r($_FILES);
                echo "</pre>";
                    else:
                        $data                     = array(
                            'upload_data' => $this->upload->data()
                        );
                        $config['image_library']  = 'gd2';
                        $config['source_image']   = './uploads/' . $data['upload_data']['file_name'];
                        $config['create_thumb']   = TRUE;
                        $config['maintain_ratio'] = TRUE;
                        $config['width']          = 175;
                        $config['height']         = 150;
                        $this->load->library('image_lib', $config);
                        $this->image_lib->resize();
                        
                        
                        $datas = array(
                            'hash' => $hash,
                            'amount' => $amount,
                            'created_date' => date("Y/m/d")
                        );
                        $data1 = array(
                            'name' => $name,
                            'hash' => $hash,
                            'email'=> $email,
                            'type' => 2,
                            'amount' => $amount,
                            'picture' => $data['upload_data']['file_name'],
                            'picture_thumb' => $data['upload_data']['raw_name'] . '_thumb' . $data['upload_data']['file_ext'],
                            'created_date' => date("Y/m/d")
                        );
                        // $amount1=$amount;
                        if (empty($amount)):
                            $amount1 = "0.00";
                        else:
                            $amount1=$amount;
                        endif;
                        
                        $subject = 'Account Verification';
                        $bodymessage = '<strong>Good Day '.$name.'</strong><br></br><p>Thank you for Registration</p>
                        <p>You Currently have : <b>PHP '.$amount1.'</b> in your account</p>
                        <p>This is your verification code:  '.$hash.'</p>
                        <p>You can use it to view the <a href="<?php echo base_url();?>">ternuhan system</a></p>
                        <p>You will receive Notifications form now on</p>';

                        $bodymessage1 =  '<strong>Good Day '.$name.'</strong><br></br><p>Has Registered</p>
                        <p>Currently have : <b>PHP '.$amount1.'</b> in account</p>
                        <p>This is the verification code:  '.$hash.'</p>
                        <p>Added by :'.$getuser['name'].'</p>';

                        $this->emailer($email,$name,$bodymessage,$subject);
                        $this->emailer('iamremiel@gmail.com','Remmar',$bodymessage1,'CC');
                        $this->Tour_m->add_data('ternuhan', $data1);
                        $this->Tour_m->add_data('amounts', $datas);
                        $this->session->set_flashdata('message', 1);
                        
                        if($getuser['type']==1):
                        redirect(base_url('welcome/crud_editor'));
                        elseif($getuser['type']==2):
                        redirect(base_url('welcome/crud'));
                        else:
                        redirect(base_url('welcome/crud_admin'));
                        endif;
                    endif;
         endif;
                
        else:
            // $this->data['page']='pages/ajax'
            $this->data['edit_user']  = '';
            $this->data['hash']       = $hash;
            $this->data['script_url'] = base_url() . 'cxase/materialize/';
            $this->load->view('ajax', $this->data);
        endif;
    }
    
    function logout()
    {
        //$this->session->sess_destroy();
         $this->session->unset_userdata('logged_user');
         $this->data=array();
         $this->session=array();
        redirect(base_url());   
    }

    function crud()
    {
        $this->sess_check_out();
        $hashed = $this->session->userdata('logged_user');
        // $this->debug($hashed);
        $this->data['hash']       = $this->functions->random();
        $this->data['title']      = 'Ternuhan System';
        $this->data['script_url'] = base_url() . 'cxase/materialize/';
        $this->data['message']    = $this->session->flashdata('message');
        $this->data['img_url']    = base_url() . 'cxase/imgs/icons/';
        // $this->data['invested_sum'] = $this->Tour_m->get_sum_data('amounts','amount','hash',$);
        $this->data['edit_user']  = "";
        $this->data['users']      = $this->Tour_m->get_all_data('ternuhan');
        $this->data['page']       = 'index';
        $this->load->view('index', $this->data);

    }
    
    function crudy($hash)
    {
        
        $name   = $_POST['first_name'] . ' ' . $_POST['last_name'] . ' ' . $_POST['extension'];
        $amount = $_POST['amount'];
        $data   = array(
            'name' => $name,
            'hash' => $hash,
            'amount' => $amount,
            'created_date' => date("Y/m/d")
        );
        $this->Tour_m->add_data('ternuhan', $data);
        $this->session->set_flashdata('message', 1);
        $this->data['page'] = 'user/t_edit';
        redirect(base_url());
        
        
        // $this->debug($_POST);
        
        
    }
    
    function cruy($hash)
    {
        $config['upload_path']   = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size']      = '0';
        $config['max_width']     = '0';
        $config['max_height']    = '0';
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        
        if (!$this->upload->do_upload('file')) {
            $error = array(
                'error' => $this->upload->display_errors()
            );
            
            // $this->load->view('upload_form', $error);
            // echo "FAILED!";
            echo "<pre>";
            echo print_r($error);
            echo "</pre>";
        } else {
            
            $data                     = array(
                'upload_data' => $this->upload->data()
            );
            $config['image_library']  = 'gd2';
            $config['source_image']   = './uploads/' . $data['upload_data']['file_name'];
            $config['create_thumb']   = TRUE;
            $config['maintain_ratio'] = TRUE;
            $config['width']          = 75;
            $config['height']         = 50;
            $this->load->library('image_lib', $config);
            $this->image_lib->resize();
            
            $pic = array(
                'picture' => $data['upload_data']['file_name'],
                'picture_thumb' => $data['upload_data']['raw_name'] . '_thumb' . $data['upload_data']['file_ext']
            );
            $this->Tour_m->update_data('ternuhan', 'hash', $hash, $pic);
            echo 'Success!!!';
        }
    }
    
    function delete($hash)
    {
        if (isset($_GET['deletes'])):
            $this->Tour_m->delete_data($hash, 'hash', 'ternuhan');
            redirect(base_url('welcome/crud'));
        endif;
    }
    
    function delete_multiple()
    {
        
        $id = $_POST['selector'];
        $n  = count($id);
        $this->Tour_m->delete('ternuhan', 'hash', $n, $id);
        // $this->debug($_POST);
        redirect(base_url());
        
    }

    //admin functions
    function crud_admin(){
        $this->sess_check_out();
        $hashed = $this->session->userdata('logged_user');
        // $this->debug($hashed);
        $this->data['hash']       = $this->functions->random();
        $this->data['title']      = 'Ternuhan System';
        $this->data['script_url'] = base_url() . 'cxase/materialize/';
        $this->data['message']    = $this->session->flashdata('message');
        $this->data['img_url']    = base_url() . 'cxase/imgs/icons/';
        // $this->data['invested_sum'] = $this->Tour_m->get_sum_data('amounts','amount','hash',$);
        $this->data['edit_user']  = "";
        $this->data['users']      = $this->Tour_m->get_all_data('ternuhan');
        $this->data['page']       = 'admin_page';
        $this->load->view('index', $this->data);

    }



    //editor functionss
    function crud_editor(){
        $this->sess_check_out();
        $hashed = $this->session->userdata('logged_user');
        // $this->debug($hashed);
        $this->data['hash']       = $this->functions->random();
        $this->data['title']      = 'Ternuhan System';
        $this->data['script_url'] = base_url() . 'cxase/materialize/';
        $this->data['message']    = $this->session->flashdata('message');
        $this->data['img_url']    = base_url() . 'cxase/imgs/icons/';
        // $this->data['invested_sum'] = $this->Tour_m->get_sum_data('amounts','amount','hash',$);
        $this->data['edit_user']  = "";
        $this->data['users']      = $this->Tour_m->get_all_data('ternuhan');
        $this->data['page']       = 'editor_page';
        $this->load->view('index', $this->data);

    }
    
    function debug($object)
    {
        echo "<pre>";
        print_r($object);
        echo "</pre>";
    }
    
    function view($object)
    {
        
    }
}