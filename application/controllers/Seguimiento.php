<?php

class Seguimiento extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Seguimiento_model', 'seguimiento');
        $this->load->model('Client_model', 'cliente');
        $this->load->library(array('session'));
        $this->load->helper("mabuya");

        @session_start();
        $this->load_language();
        $this->init_form_validation();
    }

    public function index($client_id = 0)
    {

        if(!in_array($this->session->userdata('rol_id'),[1])){
            $this->log_out();
            redirect('login/index');
        }

        $client_object = $this->cliente->get_by_id($client_id);
        if($client_object)
        {
            $all_seguimiento = $this->seguimiento->get_by_client($client_id);
            $data['all_seguimiento'] = $all_seguimiento;
            $data['client_object'] = $client_object;
            $this->load_view_admin_g("seguimiento/index",$data);
        }
        else show_404();

    }

    public function add_index($client_id = 0){
        if(!in_array($this->session->userdata('rol_id'),[1])){
            $this->log_out();
            redirect('login/index');
        }
        $client_object = $this->cliente->get_by_id($client_id);
        if($client_object)
        {
            $data['client_object'] = $client_object;
            $this->load_view_admin_g('seguimiento/add',$data);
        }
        else show_404();
    }

    public function add(){
        if(!in_array($this->session->userdata('rol_id'),[1])){
            $this->log_out();
            redirect('login/index');
        }

        $name = $this->input->post('name');
        $desc = $this->input->post('desc');
        $tipo = $this->input->post('tipo');
        $cliente_id = $this->input->post('cliente_id');
        //establecer reglas de validacion
        $this->form_validation->set_rules('name', translate('nombre_lang'), 'required');



        if ($this->form_validation->run() == FALSE){ //si alguna de las reglas de validacion fallaron
            $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
            redirect("seguimiento/add_index");

        }  //en caso de que todo este bien
        $client_object = $this->cliente->get_by_id($cliente_id);
        if($client_object) {
            $data = ['nombre' => $name, 'is_active' => 1, 'texto' => $desc, 'tipo' => $tipo, 'cliente_id' => $cliente_id,'fecha'=>date('Y-m-d h:i:s a')];
            $name_file = $_FILES['archivo']['name'];
            $separado = explode('.', $name_file);
            $ext = end($separado); // me quedo con la extension
            $allow_extension_array = ["JPEG", "JPG", "jpg", "jpeg", "png", "bmp", "gif", "pdf", "PDF", "mpg", "avi", "mp4", "doc", "docx", "rar", "zip"];
            $allow_extension = in_array($ext, $allow_extension_array);
            if ($allow_extension) {
                $result = upload_from_post('archivo', './uploads/seguimiento', time().'.'.$ext);
                if ($result[0]) {
                    $data ['archivo'] = $result[1];

                }
            } else {

                $this->response->set_message(translate("not_allow_extension"), ResponseMessage::ERROR);
                redirect("seguimiento/add_index/" . $cliente_id, "location", 301);
            }

            $this->seguimiento->create($data);
            $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
            redirect("seguimiento/index/". $cliente_id, "location", 301);
        } show_404();

    }

    function update_index($cat_id = 0){
        if(!in_array($this->session->userdata('rol_id'),[1])){
            $this->log_out();
            redirect('login/index');
        }

        $seguimiento_object = $this->seguimiento->get_by_id($cat_id);

        if($seguimiento_object){
            $data['seguimiento_object'] = $seguimiento_object;
            $this->load_view_admin_g('seguimiento/update',$data);
        }else{
            show_404();
        }
    }

    /*public function update(){
        if(!in_array($this->session->userdata('rol_id'),[1])){
            $this->log_out();
            redirect('login/index');
        }

        $name = $this->input->post('name');
        $desc = $this->input->post('desc');
        $tipo = $this->input->post('tipo');
        $seguimiento_id = $this->input->post('seguimiento_id');

        //establecer reglas de validacion
        $this->form_validation->set_rules('name', translate('nombre_lang'), 'required');


        if ($this->form_validation->run() == FALSE){ //si alguna de las reglas de validacion fallaron
            $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
            redirect("seguimiento/update_index/".$seguimiento_id);

        }
        else { //en caso de que todo este bien

            $name_file = $_FILES['archivo']['name'];
            $separado = explode('.', $name_file);
            $ext = end($separado); // me quedo con la extension
            $allow_extension_array = ["JPEG", "JPG", "jpg", "jpeg", "png", "bmp", "gif", "pdf", "PDF", "mpg", "avi", "mp4", "doc", "docx", "rar", "zip"];
            $allow_extension = in_array($ext, $allow_extension_array);
            if ($allow_extension || $_FILES['archivo']['error'] == 4) {

                if ($_FILES['archivo']['error'] == 4) {
                    $data = ['nombre'=>$name,'descripcion'=>$desc];
                    $this->seguimiento->update($seguimiento_id, $data);
                    $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
                    redirect("seguimiento/index", "location", 301);
                } else {

                    $seguimiento_object = $this->seguimiento->get_by_id($seguimiento_id);

                    if ( $seguimiento_object) {

                        $result = upload_from_post('archivo', './uploads/seguimiento', time().'.'.$ext);
                        if ($result[0]) {
                            if (file_exists( $seguimiento_object->archivo))
                                unlink( $seguimiento_object->archivo);

                            $data = ['nombre'=>$name, 'is_active'=>1,'archivo' => $result[1],'descripcion'=>$desc];
                            $this->seguimiento->update($seguimiento_id, $data);
                            $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
                            redirect("seguimiento/index", "location", 301);
                        } else {
                            $this->response->set_message($result[1], ResponseMessage::ERROR);
                            redirect("seguimiento/add_index", "location", 301);
                        }
                    } else {
                        show_404();
                    }
                }
            } else {

                $this->response->set_message(translate("not_allow_extension"), ResponseMessage::ERROR);
                redirect("seguimiento/update_index/" . $seguimiento_id, "location", 301);
            }

        }
    }*/
    
    public function delete($cat_id = 0){
        if(!in_array($this->session->userdata('rol_id'),[1])){
            $this->log_out();
            redirect('login/index');
        }

        $seguimiento_object = $this->seguimiento->get_by_id($cat_id);

        if($seguimiento_object){
            $this->seguimiento->update($cat_id,['is_active'=>0]);
            $this->response->set_message(translate('data_deleted_ok'), ResponseMessage::SUCCESS);
            redirect("seguimiento/index/".$seguimiento_object->cliente_id);
        }else{
            show_404();
        }
    }





}
