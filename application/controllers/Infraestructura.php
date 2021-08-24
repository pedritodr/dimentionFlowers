<?php

class Infraestructura extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Infraestructura_model', 'infraestructura');
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

        $all_areas = $this->infraestructura->get_all();
        $data['all_areas'] = $all_areas;
        $this->load_view_admin_g("infraestructura/index",$data);
    }

    public function add_index(){
        if(!in_array($this->session->userdata('rol_id'),[1])){
            $this->log_out();
            redirect('login/index');
        }

        $this->load_view_admin_g('infraestructura/add');
    }

    public function add(){
        if(!in_array($this->session->userdata('rol_id'),[1])){
            $this->log_out();
            redirect('login/index');
        }

        $texto = $this->input->post('texto');

        $name_file = $_FILES['archivo']['name'];
        $w = 975;
        $h = 483;
        
        $separado = explode('.', $name_file);
        $ext = end($separado); // me quedo con la extension
        $allow_extension_array = ["JPEG", "JPG", "jpg", "jpeg", "png", "bmp", "gif"];
        $allow_extension = in_array($ext, $allow_extension_array);
        if ($allow_extension) {
            $result = save_image_from_post('archivo', './uploads/infraestructura', time(), $w, $h);
            if ($result[0]) {
                $data = ['texto'=>$texto,'photo' => $result[1]];
                $this->infraestructura->create($data);
                $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
                redirect("infraestructura/index", "location", 301);
            } else {
                $this->response->set_message($result[1], ResponseMessage::ERROR);
                redirect("infraestructura/add_index", "location", 301);
            }
        } else {

            $this->response->set_message(translate("not_allow_extension"), ResponseMessage::ERROR);
            redirect("infraestructura/add_index", "location", 301);
        }

       

    }

    function update_index($id = 0){
        if(!in_array($this->session->userdata('rol_id'),[1])){
            $this->log_out();
            redirect('login/index');
        }

        $infraestructura_object = $this->infraestructura->get_by_id($id);

        if($infraestructura_object){
            $data['infraestructura_object'] = $infraestructura_object;
            $this->load_view_admin_g('infraestructura/update',$data);
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
       
      
        $infraestructura_id = $this->input->post('infraestructura_id');

            $w = 975;
            $h = 483;
            
            $name_file = $_FILES['archivo']['name'];
            $separado = explode('.', $name_file);
            $ext = end($separado); // me quedo con la extension
            $allow_extension_array = ["JPEG", "JPG", "jpg", "jpeg", "png", "bmp", "gif"];
            $allow_extension = in_array($ext, $allow_extension_array);
            if ($allow_extension || $_FILES['archivo']['error'] == 4) {

                if ($_FILES['archivo']['error'] == 4) {
                    $data = ['texto'=>$texto];
                    $this->infraestructura->update($infraestructura_id, $data);
                    $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
                    redirect("infraestructura/index", "location", 301);
                } else {

                    $infraestructura_object = $this->infraestructura->get_by_id($infraestructura_id);

                    if ( $infraestructura_object) {

                        $result = save_image_from_post('archivo', './uploads/infraestructura', time(), $w, $h);
                        if ($result[0]) {
                            if (file_exists( $infraestructura_object->photo))
                                unlink( $infraestructura_object->photo);

                            $data = ['photo' => $result[1],'texto'=>$texto];
                            $this->infraestructura->update($infraestructura_id, $data);
                            $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
                            redirect("infraestructura/index", "location", 301);
                        } else {
                            $this->response->set_message($result[1], ResponseMessage::ERROR);
                            redirect("infraestructura/update_index/".$infraestructura_id, "location", 301);
                        }
                    } else {
                        show_404();
                    }
                }
            } else {

                $this->response->set_message(translate("not_allow_extension"), ResponseMessage::ERROR);
                redirect("infraestructura/update_index/" . $infraestructura_id, "location", 301);
            }

        
    }
    
    public function delete($id = 0){
        if(!in_array($this->session->userdata('rol_id'),[1])){
            $this->log_out();
            redirect('login/index');
        }

        $infraestructura_object = $this->infraestructura->get_by_id($id);

        if($infraestructura_object){
            $this->infraestructura->delete($id);
            $this->response->set_message(translate('data_deleted_ok'), ResponseMessage::SUCCESS);
            redirect("infraestructura/index");
        }else{
            show_404();
        }
    }





}
