<?php

class Noticia extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Noticia_model', 'noticia');
        $this->load->model('Category_model', 'cat');
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

        $all_noticias = $this->noticia->get_all();
        $data['all_noticias'] = $all_noticias;
        $this->load_view_admin_g("noticia/index",$data);
    }

    public function add_index(){
        if(!in_array($this->session->userdata('role_id'),[1])){
            $this->log_out();
            redirect('login/index');
        }

        
        $this->load_view_admin_g('noticia/add');
    }

    public function add(){
        if(!in_array($this->session->userdata('role_id'),[1])){
            $this->log_out();
            redirect('login/index');
        }


        $nombre = $this->input->post('titulo');
        $pre = $this->input->post('presentacion');
        $cuerpo = $this->input->post('cuerpo');      
        $dates = $this->input->post('dates');
        $fecha_inicio = substr($dates, 0, 10);
        $fecha_salida = substr($dates, -10);
        //establecer reglas de validacion
        $this->form_validation->set_rules('titulo', translate('nombre_lang'), 'required');
        $this->form_validation->set_rules('presentacion', translate('presentacion_lang'), 'required');        
        $this->form_validation->set_rules('dates', translate('date_inicio_salida_lang'), 'required');





        if ($this->form_validation->run() == FALSE){ //si alguna de las reglas de validacion fallaron
            $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
            redirect("noticia/add_index");

        } else { //en caso de que todo este bien
            $name_file = $_FILES['archivo']['name'];
            $separado = explode('.', $name_file);
            $ext = end($separado); // me quedo con la extension
            $allow_extension_array = ["JPEG", "JPG", "jpg", "jpeg", "png", "bmp", "gif"];
            $allow_extension = in_array($ext, $allow_extension_array);
            if ($allow_extension) {
                $result = save_image_from_post('archivo', './uploads/noticia', time(), 570, 340);
                if ($result[0]) {
                    $data = [ 'is_active'=>1,'presentacion'=>$pre,'cuerpo'=>$cuerpo,'nombre'=>$nombre,'imagen' => $result[1],
                        'fecha_inicio'=>$fecha_inicio,'fecha_fin'=>$fecha_salida,'fecha_creacion'=>date('Y-m-d')];
                    $id = $this->noticia->create($data);
                   
                    $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
                    redirect("noticia/index", "location", 301);
                } else {
                    $this->response->set_message($result[1], ResponseMessage::ERROR);
                    redirect("noticia/add_index", "location", 301);
                }
            } else {

                $this->response->set_message(translate("not_allow_extension"), ResponseMessage::ERROR);
                redirect("noticia/add_index", "location", 301);
            }

        }

    }

    function update_index($noticia_id = 0){
        if(!in_array($this->session->userdata('role_id'),[1])){
            $this->log_out();
            redirect('login/index');
        }

        $noticia_object = $this->noticia->get_by_id($noticia_id);

        if($noticia_object){                       
            $data['noticia_object'] = $noticia_object;
            $this->load_view_admin_g('noticia/update',$data);
        }else{
            show_404();
        }
    }

    public function update(){
        if(!in_array($this->session->userdata('role_id'),[1])){
            $this->log_out();
            redirect('login/index');
        }

        $nombre = $this->input->post('titulo');
        $pre = $this->input->post('presentacion');
        $cuerpo = $this->input->post('cuerpo');
       
        $dates = $this->input->post('dates');
        $fecha_inicio = substr($dates, 0, 10);
        $fecha_salida = substr($dates, -10);
        //establecer reglas de validacion
        $this->form_validation->set_rules('titulo', translate('nombre_lang'), 'required');
        $this->form_validation->set_rules('presentacion', translate('presentacion_lang'), 'required');
        
        $this->form_validation->set_rules('dates', translate('date_inicio_salida_lang'), 'required');

        $noticia_id = $this->input->post('noticia_id');

        if ($this->form_validation->run() == FALSE){ //si alguna de las reglas de validacion fallaron
            $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
            redirect("noticia/update_index/".$noticia_id);

        }
        else { //en caso de que todo este bien
            $name_file = $_FILES['archivo']['name'];
            $separado = explode('.', $name_file);
            $ext = end($separado); // me quedo con la extension
            $allow_extension_array = ["JPEG", "JPG", "jpg", "jpeg", "png", "bmp", "gif"];
            $allow_extension = in_array($ext, $allow_extension_array);
            if ($allow_extension || $_FILES['archivo']['error'] == 4) {

                if ($_FILES['archivo']['error'] == 4) {
                    $data = [ 'is_active'=>1,'presentacion'=>$pre,'cuerpo'=>$cuerpo,'nombre'=>$nombre,
                        'fecha_inicio'=>$fecha_inicio,'fecha_fin'=>$fecha_salida,'fecha_modificacion'=>date('Y-m-d')];
                    $this->noticia->update($noticia_id, $data);
                   
                    $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
                    redirect("noticia/index", "location", 301);
                } else {

                    $noticia_object = $this->noticia->get_by_id($noticia_id);

                    if ( $noticia_object) {

                        $result = save_image_from_post('archivo', './uploads/noticia', time(),570, 340);
                        if ($result[0]) {
                            if (file_exists( $noticia_object->imagen))
                                unlink( $noticia_object->imagen);

                            $data = [ 'is_active'=>1,'presentacion'=>$pre,'cuerpo'=>$cuerpo,'nombre'=>$nombre,'imagen' => $result[1],
                                'fecha_inicio'=>$fecha_inicio,'fecha_fin'=>$fecha_salida,'fecha_modificacion'=>date('Y-m-d')];
                            $this->noticia->update($noticia_id, $data);
                         
                            $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
                            redirect("noticia/index", "location", 301);
                        } else {
                            $this->response->set_message($result[1], ResponseMessage::ERROR);
                            redirect("noticia/add_index", "location", 301);
                        }
                    } else {
                        show_404();
                    }
                }
            } else {

                $this->response->set_message(translate("not_allow_extension"), ResponseMessage::ERROR);
                redirect("noticia/update_index/" . $noticia_id, "location", 301);
            }

        }
    }

    public function change($noticia_id = 0){
        if(!in_array($this->session->userdata('role_id'),[1])){
            $this->log_out();
            redirect('login/index');
        }

        $noticia_object = $this->noticia->get_by_id($noticia_id);

        if($noticia_object){
            if($noticia_object->is_active == 1)
                $this->noticia->update($noticia_id,['is_active'=>0]);
            if($noticia_object->is_active == 0)
                $this->noticia->update($noticia_id,['is_active'=>1]);
            $this->response->set_message(translate('data_changed_ok'), ResponseMessage::SUCCESS);
            redirect("noticia/index");
        }else{
            show_404();
        }
    }

    public function delete($noticia_id = 0){
        if(!in_array($this->session->userdata('role_id'),[1])){
            $this->log_out();
            redirect('login/index');
        }

        $noticia_object = $this->noticia->get_by_id($noticia_id);

        if($noticia_object){
            $this->noticia->delete($noticia_id);
            $this->response->set_message(translate('data_deleted_ok'), ResponseMessage::SUCCESS);
            redirect("noticia/index");
        }else{
            show_404();
        }
    }




}
