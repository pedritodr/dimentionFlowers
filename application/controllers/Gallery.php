<?php

class Gallery extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Gallery_model', 'gallery');
        $this->load->library(array('session'));
        $this->load->helper("mabuya");

        @session_start();
        $this->load_language();
        $this->init_form_validation();
    }

    public function index()
    {

        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        //imagenes de la galeria
        $galleries = $this->gallery->get_all();

        $data['galleries'] = $galleries;

        $this->load_view_admin_g("gallery/index", $data);
    }


    public function add()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        /*  $texto = $this->input->post("texto");
        $url = $this->input->post("url");
 */

        $name_file = $_FILES['archivo']['name'];
        $separado = explode('.', $name_file);
        $ext = end($separado); // me quedo con la extension
        $allow_extension_array = ["JPEG", "JPG", "jpg", "jpeg", "png", "bmp", "gif"];
        $allow_extension = in_array($ext, $allow_extension_array);
        if ($allow_extension) {
            $result = save_image_from_post('archivo', './uploads/gallery', time(), 471, 404);
            if ($result[0]) {
                $data = ['image' => $result[1]];
                $this->gallery->create($data);
                $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
                redirect("gallery/index", "location", 301);
            } else {
                $this->response->set_message($result[1], ResponseMessage::ERROR);
                redirect("gallery/index", "location", 301);
            }
        } else {

            $this->response->set_message(translate("not_allow_extension"), ResponseMessage::ERROR);
            redirect("gallery/index", "location", 301);
        }
    }

    public function delete($gallery_id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $gallery_object = $this->gallery->get_by_id($gallery_id);

        if ($gallery_object) {
            $this->gallery->delete($gallery_id);
            $this->response->set_message(translate('data_deleted_ok'), ResponseMessage::SUCCESS);
            redirect("gallery/index");
        } else {
            show_404();
        }
    }
}
