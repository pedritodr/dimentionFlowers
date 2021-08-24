<?php

class Documento extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Documento_model', 'doc');
        $this->load->library(array('session'));
        $this->load->helper("mabuya");

        @session_start();
        $this->load_language();
        $this->init_form_validation();
    }

    public function index()
    {

        if(!in_array($this->session->userdata('rol_id'),[1])){
            $this->log_out();
            redirect('login/index');
        }

        $all_documentos = $this->doc->get_all();
        $data['documentos'] = $all_documentos;
        $this->load_view_admin_g("documento/index",$data);
    }

    public function add_index(){
        if(!in_array($this->session->userdata('rol_id'),[1])){
            $this->log_out();
            redirect('login/index');
        }

        $this->load_view_admin_g('documento/add');
    }

    public function download($file= 0){
        if(!in_array($this->session->userdata('rol_id'),[1])){
            $this->log_out();
            redirect('login/index');
        }
        $documento_object = $this->doc->get_by_id($file);
        if($documento_object){
            download_file($documento_object->file,"application/pdf");
        }else{
            show_404();
        }
        
    }

    public function add(){
        if(!in_array($this->session->userdata('rol_id'),[1])){
            $this->log_out();
            redirect('login/index');
        }

        $texto = $this->input->post('texto');
        $nombre = $this->input->post('nombre');

        $name_file = $_FILES['archivo']['name'];
        
        
        $separado = explode('.', $name_file);
        $ext = end($separado); // me quedo con la extension
        $allow_extension_array = ["pdf", "PDF"];
        $allow_extension = in_array($ext, $allow_extension_array);
        if ($allow_extension) {
            $result = upload_from_post('archivo', './uploads/documento', time().'.'.$ext,8000000);
            if ($result[0]) {
                $data = ['texto'=>$texto,'file' => $result[1],'name'=>$nombre];
                $this->doc->create($data);
                $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
                redirect("documento/index", "location", 301);
            } else {
                $this->response->set_message($result[1], ResponseMessage::ERROR);
                redirect("documento/add_index", "location", 301);
            }
        } else {

            $this->response->set_message(translate("not_allow_extension"), ResponseMessage::ERROR);
            redirect("documento/add_index", "location", 301);
        }

       

    }

    function update_index($id = 0){
        if(!in_array($this->session->userdata('rol_id'),[1])){
            $this->log_out();
            redirect('login/index');
        }

        $documento_object = $this->doc->get_by_id($id);

        if($documento_object){
            $data['documento_object'] = $documento_object;
            $this->load_view_admin_g('documento/update',$data);
        }else{
            show_404();
        }
    }

    public function update(){
        if(!in_array($this->session->userdata('rol_id'),[1])){
            $this->log_out();
            redirect('login/index');
        }

        $texto = $this->input->post('texto');
        $nombre = $this->input->post('nombre');
       
      
        $documento_id = $this->input->post('documento_id');
            
        $name_file = $_FILES['archivo']['name'];
        $separado = explode('.', $name_file);
        $ext = end($separado); // me quedo con la extension
        $allow_extension_array = ["pdf", "PDF"];
        $allow_extension = in_array($ext, $allow_extension_array);
        if ($allow_extension || $_FILES['archivo']['error'] == 4) {

            if ($_FILES['archivo']['error'] == 4) {
                $data = ['texto'=>$texto,"name"=>$nombre];
                $this->doc->update($documento_id, $data);
                $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
                redirect("documento/index", "location", 301);
            } else {

                $documento_object = $this->doc->get_by_id($documento_id);

                if ($documento_object) {

                    $result = upload_from_post('archivo', './uploads/documento', time().'.'.$ext,8000000);
                    if ($result[0]) {
                        if (file_exists( $documento_object->file))
                            unlink($documento_object->file);

                        $data = ['file' => $result[1],'texto'=>$texto,'name'=>$nombre];
                        $this->doc->update($documento_id, $data);
                        $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
                        redirect("documento/index", "location", 301);
                    } else {
                        $this->response->set_message($result[1], ResponseMessage::ERROR);
                        redirect("documento/update_index/".$documento_id, "location", 301);
                    }
                } else {
                    show_404();
                }
            }
        } else {

            $this->response->set_message(translate("not_allow_extension"), ResponseMessage::ERROR);
            redirect("documento/update_index/".$documento_id, "location", 301);
        }

        
    }
    
    public function delete($id = 0){
        if(!in_array($this->session->userdata('rol_id'),[1])){
            $this->log_out();
            redirect('login/index');
        }

        $documento_object = $this->doc->get_by_id($id);

        if($documento_object){

            if(file_exists($documento_object->file)){
                unlink($documento_object->file);
            }

            $this->doc->delete($id);
            $this->response->set_message(translate('data_deleted_ok'), ResponseMessage::SUCCESS);
            redirect("documento/index");
        }else{
            show_404();
        }
    }





}
