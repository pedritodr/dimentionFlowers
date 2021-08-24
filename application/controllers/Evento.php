<?php

class Evento extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Evento_model', 'evento');
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

        $all_eventos = $this->evento->get_all();
        $data['eventos'] = $all_eventos;
        $this->load_view_admin_g("evento/index",$data);
    }

    public function add_index(){
        if(!in_array($this->session->userdata('rol_id'),[1])){
            $this->log_out();
            redirect('login/index');
        }

        $this->load_view_admin_g('evento/add');
    }

    public function add(){
        if(!in_array($this->session->userdata('rol_id'),[1])){
            $this->log_out();
            redirect('login/index');
        }

        $name = $this->input->post('name');
        $lugar = $this->input->post('lugar');
        $fecha = $this->input->post('fecha');
        $horario = $this->input->post('horario');
        $costo = $this->input->post('costo');
        $texto = $this->input->post('texto');


        $this->form_validation->set_rules('name', "Nombre", 'required');
        $this->form_validation->set_rules('lugar', "Lugar", 'required');
        $this->form_validation->set_rules('fecha', "Fecha", 'required');
        $this->form_validation->set_rules('horario', "Horario", 'required');
        $this->form_validation->set_rules('costo', "Costo", 'required|numeric');

        if ($this->form_validation->run() == FALSE){ //si alguna de las reglas de validacion fallaron
            $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
            redirect("evento/add_index");

        }else {

            $name_file = $_FILES['archivo']['name'];
            $w = 360;
            $h = 220;
            
            $separado = explode('.', $name_file);
            $ext = end($separado); // me quedo con la extension
            $allow_extension_array = ["JPEG", "JPG", "jpg", "jpeg", "png", "bmp", "gif"];
            $allow_extension = in_array($ext, $allow_extension_array);
            if ($allow_extension) {
                $result = save_image_from_post('archivo', './uploads/eventos', time(), $w, $h);
                if ($result[0]) {
                    $data = ['name'=>$name,'photo' => $result[1],'horario'=>$horario,'fecha'=>$fecha,'lugar'=>$lugar,'costo'=>$costo,'descripcion'=>$texto];
                    $this->evento->create($data);
                    $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
                    redirect("evento/index", "location", 301);
                } else {
                    $this->response->set_message($result[1], ResponseMessage::ERROR);
                    redirect("evento/add_index", "location", 301);
                }
            } else {

                $this->response->set_message(translate("not_allow_extension"), ResponseMessage::ERROR);
                redirect("evento/add_index", "location", 301);
            }

        }

       

    }

    function update_index($id = 0){
        if(!in_array($this->session->userdata('rol_id'),[1])){
            $this->log_out();
            redirect('login/index');
        }

        $evento_object = $this->evento->get_by_id($id);

        if($evento_object){
            $data['evento_object'] = $evento_object;
            $this->load_view_admin_g('evento/update',$data);
        }else{
            show_404();
        }
    }

    public function update(){
        if(!in_array($this->session->userdata('rol_id'),[1])){
            $this->log_out();
            redirect('login/index');
        }

        $name = $this->input->post('name');
        $lugar = $this->input->post('lugar');
        $fecha = $this->input->post('fecha');
        $horario = $this->input->post('horario');
        $costo = $this->input->post('costo');
        $texto = $this->input->post('texto');


        $this->form_validation->set_rules('name', "Nombre", 'required');
        $this->form_validation->set_rules('lugar', "Lugar", 'required');
        $this->form_validation->set_rules('fecha', "Fecha", 'required');
        $this->form_validation->set_rules('horario', "Horario", 'required');
        $this->form_validation->set_rules('costo', "Costo", 'required|numeric');
       
      
        $evento_id = $this->input->post('evento_id');

        if ($this->form_validation->run() == FALSE){ //si alguna de las reglas de validacion fallaron
            $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
            redirect("evento/update_index/".$evento_id);

        }else {

            $w = 360;
            $h = 220;

            $name_file = $_FILES['archivo']['name'];
            $separado = explode('.', $name_file);
            $ext = end($separado); // me quedo con la extension
            $allow_extension_array = ["JPEG", "JPG", "jpg", "jpeg", "png", "bmp", "gif"];
            $allow_extension = in_array($ext, $allow_extension_array);
            if ($allow_extension || $_FILES['archivo']['error'] == 4) {

                if ($_FILES['archivo']['error'] == 4) {
                    $data = ['name'=>$name,'horario'=>$horario,'fecha'=>$fecha,'lugar'=>$lugar,'costo'=>$costo,'descripcion'=>$texto];
                    $this->evento->update($evento_id, $data);
                    $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
                    redirect("evento/index", "location", 301);
                } else {

                    $evento_object = $this->evento->get_by_id($evento_id);

                    if ( $evento_object) {

                        $result = save_image_from_post('archivo', './uploads/eventos', time(), $w, $h);
                        if ($result[0]) {
                            if (file_exists( $evento_object->photo))
                                unlink( $evento_object->photo);

                            $data = ['name'=>$name,'photo' => $result[1],'horario'=>$horario,'fecha'=>$fecha,'lugar'=>$lugar,'costo'=>$costo,'descripcion'=>$texto];
                            $this->evento->update($evento_id, $data);
                            $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
                            redirect("evento/index", "location", 301);
                        } else {
                            $this->response->set_message($result[1], ResponseMessage::ERROR);
                            redirect("evento/update_index/".$evento_id);
                        }
                    } else {
                        show_404();
                    }
                }
            } else {

                $this->response->set_message(translate("not_allow_extension"), ResponseMessage::ERROR);
                redirect("evento/update_index/".$evento_id);
            }

        }
    }
    
    public function delete($id = 0){
        if(!in_array($this->session->userdata('rol_id'),[1])){
            $this->log_out();
            redirect('login/index');
        }

        $evento_object = $this->evento->get_by_id($id);

        if($evento_object){
            $this->evento->delete($id);
            $this->response->set_message(translate('data_deleted_ok'), ResponseMessage::SUCCESS);
            redirect("evento/index");
        }else{
            show_404();
        }
    }





}
