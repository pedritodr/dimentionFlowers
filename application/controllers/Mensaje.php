<?php

class Mensaje extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Mensaje_model', 'mensaje');
        $this->load->library(array('session'));
        $this->load->helper("mabuya");

        @session_start();
        $this->load_language();
        $this->init_form_validation();
    }

    public function index()
    {

        if (!in_array($this->session->userdata('role_id'), [1])) {
            $this->log_out();
            redirect('login/index');
        }

        $all_mensajes = $this->mensaje->get_all();
        $data['all_mensajes'] = $all_mensajes;
        $this->load_view_admin_g("mensaje/index", $data);
    }

    public function delete($id = 0){
        if(!in_array($this->session->userdata('role_id'),[1])){
            $this->log_out();
            redirect('login/index');
        }

        $mensaje_object = $this->mensaje->get_by_id($id);

        if($mensaje_object){
            $this->mensaje->update($id,['is_active'=>0]);
            $this->response->set_message(translate('data_deleted_ok'), ResponseMessage::SUCCESS);
            redirect("mensaje/index");
        }else{
            show_404();
        }
    }

}