<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Update_fimware extends CI_Controller {

  public function __construct() {
							parent::__construct();

            		if($this->session->userdata('status') != "login"){
            			redirect(base_url("login"));
            		}
							$this->load->model('update_fimware_model');
							$this->load->helper('url_helper');
							$this->load->helper(array('form', 'url'));
              $this->load->library('session');
              $this->load->library('form_validation');

	}

	 public function index() {
      	require("asset/phpMQTT/phpMQTT.php");
        $id = $this->session->userdata("id_penguna");


        $data['penguna'] = $this->update_fimware_model->get_pengguna_for_index($id);
        $data['file_bin'] = $this->update_fimware_model->get_filebin_for_index($id);
        $data['device_iot'] = $this->update_fimware_model->get_device_for_index($id);
    		$data['error'] = ' ';

    		$this->load->view("templates/header.php");
    		$this->load->view('templates/sidebar_fimware.php');
    		$this->load->view('update_fimware/index.php',$data);
    		$this->load->view("templates/footer.php");
    }


    //upload file bin
    public function do_upload($id_penguna) {

          $config['upload_path']          = 'asset/uploads/';
          $config['allowed_types']        = 'bin|txt';
          $config['max_size']             = 1050;
         

          $this->load->library('upload', $config);

          if ( ! $this->upload->do_upload('userfile')){
                  $this->session->set_flashdata('item', $this->upload->display_errors());
                  redirect(site_url('update_fimware'));
              }else {

              $data = array(
                'file_name' => $this->upload->data('file_name'),
                'id_penguna' => $id_penguna,
              );

              $this->update_fimware_model->insert_file_bin($data);
              $this->session->set_flashdata('item','add file success');
              redirect(site_url('update_fimware'));
            }
    }
    //delete file bin
    public function delete_file($id) {
        $row = $this->update_fimware_model->get_by_id($id);

        if ($row) {
            unlink('asset/uploads/'.$row->file_name);
            $this->update_fimware_model->deletefile($id);
            $this->session->set_flashdata('message', 'Delete  Success');
            redirect(site_url('update_fimware'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('update_fimware'));
        }

    }
    //setting host server
    public function edit($id) {
      $row =$this->update_fimware_model->get_pengguna_byid($id);

      if ($row) {
         $data = array(
           'action' => site_url('update_fimware/updateaction'),
           'id_penguna' => set_value('id_penguna', $row->id_penguna),
           'host_server' => set_value('host_server', $row->host_server),
           'port_server' => set_value('port_server',$row->port_server),
           'username_server' => set_value('username_server',$row->username_server),
           'password_server' => set_value('password_server',$row->password_server),
          );

          $this->load->view("templates/header.php");
          $this->load->view('templates/sidebar_fimware.php');
          $this->load->view('update_fimware/edit_host.php',$data);
          $this->load->view("templates/footer.php");
      }else {
        $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('updatefimware'));
      }
    }

    //update host server
    public function updateaction()
    {
      $this->_rules();

      if ($this->form_validation->run() == FALSE) {
          $this->edit($this->input->post('id_penguna', TRUE));
      }else{
        $data = array(

          'host_server' => $this->input->post('host_server'),
          'port_server' => $this->input->post('port_server'),
          'username_server' => $this->input->post('username_server'),
          'password_server' => $this->input->post('password_server'),
         );

        $this->update_fimware_model->update($this->input->post('id_penguna', TRUE), $data);
        $this->session->set_flashdata('message', 'Update Record Success');
          redirect(site_url('update_fimware'));
      }
    }

    //publish to perangkat IoT
    public function publish(){
  
         $host = $this->input->post('host_server');
         $port = $this->input->post('port_server');
        echo "sukses publish"; 
	$client = new Mosquitto\Client();
         $client->connect($host, $port, 5);

         while (true) {
              try{
                   $client->loop();
                   $topic = $this->input->post('topic');
                   $payload =  file_get_contents('asset/uploads/'.$this->input->post('file_name'));
                   $qos = $this->input->post('qos');
                   $mid = $client->publish($topic,$payload,$qos);
                   $client->disconnect();
                   $client->loop();
                   }catch(Mosquitto\Exception $e){
                          return;
                   }
                    sleep(2);
              }
//	$this->session->set_flashdata('message', 'sukses publish file .bin');
  //        redirect(site_url('Update_fimware'));


          $client->disconnect();
          unset($client);
//          $this->session->set_flashdata('message', 'sukses publish file .bin');
  //        redirect(site_url('update_fimware'));
    }

    



    //>>>>>device iot list form
    //create device IoT
    public function create_device_iot($id){
      $data = array(
        'button' => 'Create',
        'action' => site_url('updatefimware/create_device_iot_action'),
        'name_device' => set_value('name_device'),
        'topic_publish' =>set_value('topic_publish'),
        'id_device' =>set_value('id_device'),
        'qos' =>set_value('qos'),
        'id_penguna' => $id,
      );

      $this->load->view("templates/header.php");
      $this->load->view('templates/sidebar_fimware.php');
      $this->load->view('update_fimware/form_device.php',$data);
      $this->load->view("templates/footer.php");

    }

    public function create_device_iot_action(){
      $this->_rules_device();
      if ($this->form_validation->run()== FALSE) {
        $this->create_device_iot($this->input->post('id_penguna',TRUE));
      }else{
        $data = array(
          'name_device' => $this->input->post('name_device') ,
          'topic_publish' => $this->input->post('topic_publish') ,
          'qos' => 0,
          'id_penguna' => $this->input->post('id_penguna') ,
        );
        $this->update_fimware_model->insert_device($data);
        $this->session->set_flashdata('message', 'create record sukses');
        redirect(site_url('update_fimware'));
      }
    }

    public function delete_device_iot($id)
    {
      $this->update_fimware_model->delete_device($id);
      $this->session->set_flashdata('message', 'Delete Record Success');
      redirect(site_url('update_fimware'));
    }

    public function edit_device_iot($id) {
      $row =$this->update_fimware_model->get_device_byid($id);

      if ($row) {
         $data = array(
           'button' => 'Update',
           'action' => site_url('updatefimware/edit_device_iot_action'),
           'id_device' => set_value('id_device', $row->id_device),
           'name_device' => set_value('name_device', $row->name_device),
           'topic_publish' => set_value('topic_publish',$row->topic_publish),
           'qos' => set_value('qos',$row->qos),
           'id_penguna' => set_value('id_penguna',$row->id_penguna),
          );

          $this->load->view("templates/header.php");
          $this->load->view('templates/sidebar_fimware.php');
          $this->load->view('update_fimware/form_device.php',$data);
          $this->load->view("templates/footer.php");
      }else {
        $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('updatefimware'));
      }
    }

    public function edit_device_iot_action()
    {
      $this->_rules_device();

      if ($this->form_validation->run() == FALSE) {
          $this->edit_device_iot($this->input->post('id_device', TRUE));
      }else{
        $data = array(

          'id_device' => $this->input->post('id_device'),
          'name_device' => $this->input->post('name_device'),
          'topic_publish' => $this->input->post('topic_publish'),
          'qos' => $this->input->post('qos'),
          'id_penguna' => $this->input->post('id_penguna'),
         );

        $this->update_fimware_model->update_device_iot($this->input->post('id_device', TRUE), $data);
        $this->session->set_flashdata('message', 'Update Record Success');
        redirect(site_url('update_fimware'));
      }
    }


    //validation
    public function _rules(){
      $this->form_validation->set_rules('host_server', 'host_server', 'trim|required');
      $this->form_validation->set_rules('port_server', 'port_server', 'trim|required');
      $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function _rules_device(){
      $this->form_validation->set_rules('name_device', 'name_device', 'trim|required');
      $this->form_validation->set_rules('topic_publish', 'topic_publish', 'trim|required');
      $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}
