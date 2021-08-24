<?php

class Service extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Service_model', 'service');
        $this->load->model('Category_model', 'cat');
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

        $all_services = $this->service->get_all();
        $data['all_services'] = $all_services;
        $this->load_view_admin_g("service/index",$data);
    }

    public function add_index(){
        if(!in_array($this->session->userdata('rol_id'),[1])){
            $this->log_out();
            redirect('login/index');
        }

        $data['all_cats'] = $this->cat->get_all();
        $this->load_view_admin_g('service/add',$data);
    }

    public function add(){
        if(!in_array($this->session->userdata('rol_id'),[1])){
            $this->log_out();
            redirect('login/index');
        }


        $nombre = $this->input->post('nombre');
        $desc = $this->input->post('desc');


        $icono = $this->input->post('icono');
        $resumen = $this->input->post('resumen');

        //establecer reglas de validacion
        $this->form_validation->set_rules('nombre', translate('nombre_lang'), 'required');
        $this->form_validation->set_rules('desc', translate('description_lang'), 'required');
        
        if ($this->form_validation->run() == FALSE){ //si alguna de las reglas de validacion fallaron
            $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
            redirect("service/add_index");

        } else { //en caso de que todo este bien
            $name_file = $_FILES['archivo']['name'];
            $separado = explode('.', $name_file);
            $ext = end($separado); // me quedo con la extension
            $allow_extension_array = ["JPEG", "JPG", "jpg", "jpeg", "png", "bmp", "gif"];
            $allow_extension = in_array($ext, $allow_extension_array);
            if ($allow_extension) {
                $result = save_image_from_post('archivo', './uploads/service', time(), 360, 220);
                if ($result[0]) {
                    $data = [ 'is_active'=>1,'descripcion'=>$desc,'nombre'=>$nombre,'imagen' => $result[1],'icono'=>$icono,'resumen'=>$resumen];
                    $id = $this->service->create($data);

                    $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
                    redirect("service/index", "location", 301);
                } else {
                    $this->response->set_message($result[1], ResponseMessage::ERROR);
                    redirect("service/add_index", "location", 301);
                }
            } else {

                $this->response->set_message(translate("not_allow_extension"), ResponseMessage::ERROR);
                redirect("service/add_index", "location", 301);
            }

        }

    }

    function update_index($service_id = 0){
        if(!in_array($this->session->userdata('rol_id'),[1])){
            $this->log_out();
            redirect('login/index');
        }

        $service_object = $this->service->get_by_id($service_id);

        if($service_object){
            $data['all_cats'] = $this->cat->get_all();
            $data['cats'] = $this->service->get_all_cat_by_service_simple($service_id);
            $data['service_object'] = $service_object;
            $this->load_view_admin_g('service/update',$data);
        }else{
            show_404();
        }
    }

    public function update(){
        if(!in_array($this->session->userdata('rol_id'),[1])){
            $this->log_out();
            redirect('login/index');
        }

        $nombre = $this->input->post('nombre');
        $desc = $this->input->post('desc');

        $icono = $this->input->post('icono');
        $resumen = $this->input->post('resumen');

        //establecer reglas de validacion
        $this->form_validation->set_rules('nombre', translate('nombre_lang'), 'required');
        $this->form_validation->set_rules('desc', translate('description_lang'), 'required');


        $service_id = $this->input->post('service_id');

        if ($this->form_validation->run() == FALSE){ //si alguna de las reglas de validacion fallaron
            $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
            redirect("service/update_index/".$service_id);

        }
        else { //en caso de que todo este bien
            $name_file = $_FILES['archivo']['name'];
            $separado = explode('.', $name_file);
            $ext = end($separado); // me quedo con la extension
            $allow_extension_array = ["JPEG", "JPG", "jpg", "jpeg", "png", "bmp", "gif"];
            $allow_extension = in_array($ext, $allow_extension_array);
            if ($allow_extension || $_FILES['archivo']['error'] == 4) {

                if ($_FILES['archivo']['error'] == 4) {
                    $data = [ 'is_active'=>1,'descripcion'=>$desc,'nombre'=>$nombre,'resumen'=>$resumen,'icono'=>$icono];
                    $this->service->update($service_id, $data);
                    $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
                    redirect("service/index", "location", 301);
                } else {

                    $service_object = $this->service->get_by_id($service_id);

                    if ( $service_object) {

                        $result = save_image_from_post('archivo', './uploads/service', time(),360, 220);
                        if ($result[0]) {
                            if (file_exists( $service_object->imagen))
                                unlink( $service_object->imagen);

                            $data = [ 'is_active'=>1,'descripcion'=>$desc,'nombre'=>$nombre,'imagen' => $result[1],'resumen'=>$resumen,'icono'=>$icono];
                            $this->service->update($service_id, $data);

                            $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
                            redirect("service/index", "location", 301);
                        } else {
                            $this->response->set_message($result[1], ResponseMessage::ERROR);
                            redirect("service/add_index", "location", 301);
                        }
                    } else {
                        show_404();
                    }
                }
            } else {

                $this->response->set_message(translate("not_allow_extension"), ResponseMessage::ERROR);
                redirect("service/update_index/" . $service_id, "location", 301);
            }

        }
    }

    public function delete($service_id = 0){
        if(!in_array($this->session->userdata('rol_id'),[1])){
            $this->log_out();
            redirect('login/index');
        }

        $service_object = $this->service->get_by_id($service_id);

        if($service_object){
            $this->service->update($service_id,['is_active'=>0]);
            $this->response->set_message(translate('data_deleted_ok'), ResponseMessage::SUCCESS);
            redirect("service/index");
        }else{
            show_404();
        }
    }

    public function estrella($service_id = 0){
        if(!in_array($this->session->userdata('rol_id'),[1])){
            $this->log_out();
            redirect('login/index');
        }

        $service_object = $this->service->get_by_id($service_id);

        if($service_object){
            $this->service->estrella($service_id);
            $this->response->set_message(translate('data_update_ok'), ResponseMessage::SUCCESS);
            redirect("service/index");
        }else{
            show_404();
        }
    }





}
