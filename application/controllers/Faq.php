<?php

class Faq extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Faq_model', 'faq');
        $this->load->library(array('session'));
        $this->load->helper("mabuya");

        @session_start();
        $this->load_language();
        $this->init_form_validation();
    }

    public function index()
    {

        if(!in_array($this->session->userdata('role_id'),[1])){
            $this->log_out();
            redirect('login/index');
        }

        $faqs = $this->faq->get_all();
        $data['faqs'] = $faqs;
        $this->load_view_admin_g("faq/index",$data);
    }

    public function add_index(){
        if(!in_array($this->session->userdata('role_id'),[1])){
            $this->log_out();
            redirect('login/index');
        }

        $this->load_view_admin_g('faq/add');
    }

    

    public function add(){
        if(!in_array($this->session->userdata('role_id'),[1])){
            $this->log_out();
            redirect('login/index');
        }

        $respuesta = $this->input->post('respuesta');
        $pregunta = $this->input->post('pregunta');
        $orden = $this->input->post('orden');

       
        $this->form_validation->set_rules('pregunta', "Pregunta", 'required');
        $this->form_validation->set_rules('orden', "Orden", 'required');
      

        if ($this->form_validation->run() == FALSE){ //si alguna de las reglas de validacion fallaron
            $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
            redirect("faq/add_index");
        }else {      
       
            $data = ['orden'=>$orden,'pregunta' => $pregunta,'respuesta'=>$respuesta];
            $this->faq->create($data);
            $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
            redirect("faq/index", "location", 301);
            
        }

       

    }

    function update_index($id = 0){
        if(!in_array($this->session->userdata('role_id'),[1])){
            $this->log_out();
            redirect('login/index');
        }

        $faq_object = $this->faq->get_by_id($id);

        if($faq_object){
            $data['faq_object'] = $faq_object;
            $this->load_view_admin_g('faq/update',$data);
        }else{
            show_404();
        }
    }

    public function update(){
        if(!in_array($this->session->userdata('role_id'),[1])){
            $this->log_out();
            redirect('login/index');
        }

        $respuesta = $this->input->post('respuesta');
        $pregunta = $this->input->post('pregunta');
        $orden = $this->input->post('orden');

        $faq_id = $this->input->post('faq_id');

       
        $this->form_validation->set_rules('pregunta', "Pregunta", 'required');
        $this->form_validation->set_rules('orden', "Orden", 'required');
      

        if ($this->form_validation->run() == FALSE){ //si alguna de las reglas de validacion fallaron
            $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
            redirect("faq/update_index/".$faq_id);
        }else {      
       
            $data = ['orden'=>$orden,'pregunta' => $pregunta,'respuesta'=>$respuesta];
            $this->faq->update($faq_id,$data);
            $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
            redirect("faq/index", "location", 301);
            
        }

        
    }
    
    public function delete($id = 0){
        if(!in_array($this->session->userdata('role_id'),[1])){
            $this->log_out();
            redirect('login/index');
        }

        $faq_object = $this->faq->get_by_id($id);

        if($faq_object){


            $this->faq->delete($id);
            $this->response->set_message(translate('data_deleted_ok'), ResponseMessage::SUCCESS);
            redirect("faq/index");
        }else{
            show_404();
        }
    }





}
