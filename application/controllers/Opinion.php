<?php

class Opinion extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Opinion_model', 'opinion');
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

        $all_opiniones = $this->opinion->get_all();
        $data['all_opiniones'] = $all_opiniones;
        $this->load->model("Empresa_model","empresa");
        $empresa_object = $this->empresa->get_by_id(1);
        $data['empresa_object'] = $empresa_object;
        $this->load_view_admin_g("opinion/index",$data);
    }

    public function add_index(){
        if(!in_array($this->session->userdata('role_id'),[1])){
            $this->log_out();
            redirect('login/index');
        }

        $this->load_view_admin_g('opinion/add');
    }

    public function add(){
        if(!in_array($this->session->userdata('role_id'),[1])){
            $this->log_out();
            redirect('login/index');
        }


        $nombre_padre = $this->input->post('nombre_padre');
        $comentario = $this->input->post('comentario');
       
       
        
        //establecer reglas de validacion
        $this->form_validation->set_rules('nombre_padre', "Nombre", 'required');
        $this->form_validation->set_rules('comentario', "Comentario", 'required');
        



        if ($this->form_validation->run() == FALSE){ //si alguna de las reglas de validacion fallaron
            $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
            redirect("opinion/add_index");

        } else { //en caso de que todo este bien
            $name_file = $_FILES['archivo']['name'];
            $w = 225;
            $h = 225;
           
            $separado = explode('.', $name_file);
            $ext = end($separado); // me quedo con la extension
            $allow_extension_array = ["JPEG", "JPG", "jpg", "jpeg", "png", "bmp", "gif"];
            $allow_extension = in_array($ext, $allow_extension_array);
            if ($allow_extension) {
                $result = save_image_from_post('archivo', './uploads/opiniones', time(), $w, $h);
                if ($result[0]) {
                    $data = [ 'nombre_padre'=>$nombre_padre,'opinion'=>$comentario,'photo' => $result[1]];
                    $this->opinion->create($data);
                    $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
                    redirect("opinion/index", "location", 301);
                } else {
                    $this->response->set_message($result[1], ResponseMessage::ERROR);
                    redirect("opinion/add_index", "location", 301);
                }
            } else {

                $this->response->set_message(translate("not_allow_extension"), ResponseMessage::ERROR);
                redirect("opinion/add_index", "location", 301);
            }

        }

    }

    function update_index($opinion_id = 0){
        if(!in_array($this->session->userdata('role_id'),[1])){
            $this->log_out();
            redirect('login/index');
        }

        $opinion_object = $this->opinion->get_by_id($opinion_id);

        if($opinion_object){
            $data['opinion_object'] = $opinion_object;
            $this->load_view_admin_g('opinion/update',$data);
        }else{
            show_404();
        }
    }

    public function update(){
        if(!in_array($this->session->userdata('role_id'),[1])){
            $this->log_out();
            redirect('login/index');
        }

        $nombre_padre = $this->input->post('nombre_padre');
        $comentario = $this->input->post('comentario');
       
       
        
        //establecer reglas de validacion
        $this->form_validation->set_rules('nombre_padre', "Nombre", 'required');
        $this->form_validation->set_rules('comentario', "Comentario", 'required');
      
        $opinion_id = $this->input->post('opinion_id');

        if ($this->form_validation->run() == FALSE){ //si alguna de las reglas de validacion fallaron
            $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
            redirect("opinion/update_index/".$opinion_id);

        }
        else { //en caso de que todo este bien
            $w = 225;
            $h = 225;
            
            $name_file = $_FILES['archivo']['name'];
            $separado = explode('.', $name_file);
            $ext = end($separado); // me quedo con la extension
            $allow_extension_array = ["JPEG", "JPG", "jpg", "jpeg", "png", "bmp", "gif"];
            $allow_extension = in_array($ext, $allow_extension_array);
            if ($allow_extension || $_FILES['archivo']['error'] == 4) {

                if ($_FILES['archivo']['error'] == 4) {
                    $data = ['nombre_padre'=>$nombre_padre,'opinion'=>$comentario];
                    $this->opinion->update($opinion_id, $data);
                    
                    $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
                    redirect("opinion/index", "location", 301);
                } else {

                    $opinion_object = $this->opinion->get_by_id($opinion_id);

                    if ( $opinion_object) {

                        $result = save_image_from_post('archivo', './uploads/opiniones', time(), $w, $h);
                        if ($result[0]) {
                            if (file_exists( $opinion_object->photo))
                                unlink( $opinion_object->photo);

                            $data = ['nombre_padre'=>$nombre_padre,'opinion'=>$comentario,'photo'=>$result[1]];
                            $this->opinion->update($opinion_id, $data);
                            $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
                            redirect("opinion/index", "location", 301);
                        } else {
                            $this->response->set_message($result[1], ResponseMessage::ERROR);
                            redirect("opinion/add_index", "location", 301);
                        }
                    } else {
                        show_404();
                    }
                }
            } else {

                $this->response->set_message(translate("not_allow_extension"), ResponseMessage::ERROR);
                redirect("opinion/update_index/" . $opinion_id, "location", 301);
            }

        }
    }
    
    public function delete($opinion_id = 0){
        if(!in_array($this->session->userdata('role_id'),[1])){
            $this->log_out();
            redirect('login/index');
        }

        $opinion_object = $this->opinion->get_by_id($opinion_id);

        if($opinion_object){
            $this->opinion->delete($opinion_id);
            $this->response->set_message(translate('data_deleted_ok'), ResponseMessage::SUCCESS);
            redirect("opinion/index");
        }else{
            show_404();
        }
    }





}
