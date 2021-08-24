<?php

class Sobre_nosotros extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Sobre_nosotros_model', 'nosotros');
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

        $nosotros = $this->nosotros->get_all(['is_active' => 1]);
        $data['nosotros'] = $nosotros;
        $this->load_view_admin_g("sobre_nosotros/index", $data);
    }

    public function add_index()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $this->load_view_admin_g('sobre_nosotros/add');
    }

    public function add()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }
        $titulo = $this->input->post('titulo');
        $desc = $this->input->post('desc');
        $desc_corta = $this->input->post('desc_corta');
        //establecer reglas de validacion
        $this->form_validation->set_rules('titulo', translate('titulo_lang'), 'required');
        $this->form_validation->set_rules('desc', translate('add_descripcion_lang'), 'required');
        $this->form_validation->set_rules('desc_corta', translate('descripcion_corta_lang'), 'required');
        //   $this->form_validation->set_rules('text2', translate('text_lang'), 'required');
        if ($this->form_validation->run() == FALSE) { //si alguna de las reglas de validacion fallaron
            $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
            redirect("sobre_nosotros/add_index");
        } else { //en caso de que todo este bien
            $name_file = $_FILES['archivo']['name'];
            $icon_file = $_FILES['icon']['name'];
            $separado = explode('.', $name_file);
            $separado_icon = explode('.', $icon_file);
            $ext_icon = end($separado_icon); // me quedo con la extension
            $ext = end($separado); // me quedo con la extension
            $allow_extension_array = ["JPEG", "JPG", "jpg", "jpeg", "png", "bmp", "gif"];
            $allow_extension = in_array($ext, $allow_extension_array);
            $allow_extension_icon = in_array($ext_icon, $allow_extension_array);
            if ($allow_extension && $allow_extension_icon) {
                $result = save_image_from_post('archivo', './uploads/nosotros', time(), 471, 404);

                if ($result[0]) {
                    $result_icon = save_image_from_post('icon', './uploads/nosotros', time(), 257, 257);
                    if ($result_icon[0]) {
                        $data = ['is_active' => 1, 'titulo' => $titulo, 'descripcion' => $desc, 'imagen' => $result[1], 'icono' => $result_icon[1], 'descripcion_corta' => $desc_corta];
                        $this->nosotros->create($data);
                        $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
                        redirect("sobre_nosotros/index", "location", 301);
                    } else {
                        $this->response->set_message($result_icon[1], ResponseMessage::ERROR);
                        redirect("sobre_nosotros/add_index", "location", 301);
                    }
                } else {
                    $this->response->set_message($result[1], ResponseMessage::ERROR);
                    redirect("sobre_nosotros/add_index", "location", 301);
                }
            } else {

                $this->response->set_message(translate("not_allow_extension"), ResponseMessage::ERROR);
                redirect("sobre_nosotros/add_index", "location", 301);
            }
        }
    }

    function update_index($sobre_nosotros_id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $nosotros = $this->nosotros->get_by_id($sobre_nosotros_id);

        if ($nosotros) {
            $data['nosotros'] = $nosotros;
            $this->load_view_admin_g('sobre_nosotros/update', $data);
        } else {
            show_404();
        }
    }

    public function update()
    {
        if (!in_array($this->session->userdata('role_id'), [1])) {
            $this->log_out();
            redirect('login/index');
        }

        $titulo = $this->input->post('titulo');
        $desc = $this->input->post('desc');
        $desc_corta = $this->input->post('desc_corta');
        $sobre_nosotros_id = $this->input->post('sobre_nosotros_id');
        $nosotros = $this->nosotros->get_by_id($sobre_nosotros_id);
        //establecer reglas de validacion
        $this->form_validation->set_rules('titulo', translate('titulo_lang'), 'required');
        $this->form_validation->set_rules('desc', translate('add_descripcion_lang'), 'required');
        $this->form_validation->set_rules('desc_corta', translate('descripcion_corta_lang'), 'required');
        if ($this->form_validation->run() == FALSE) { //si alguna de las reglas de validacion fallaron
            $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
            redirect("sobre_nosotros/update_index/" . $sobre_nosotros_id);
        } else { //en caso de que todo este bien
            $name_file = $_FILES['archivo']['name'];
            $name_file2 = $_FILES['icon']['name'];

            $separado = explode('.', $name_file);
            $separado2 = explode('.', $name_file2);

            $ext = end($separado); // me quedo con la extension
            $ext2 = end($separado2); // me quedo con la extension

            $allow_extension_array = ["JPEG", "JPG", "jpg", "jpeg", "png", "bmp", "gif"];

            $allow_extension = in_array($ext, $allow_extension_array);
            $allow_extension2 = in_array($ext2, $allow_extension_array);

            if ($nosotros) {
                if (($allow_extension || $_FILES['archivo']['error'] == 4) or ($allow_extension2 || $_FILES['icon']['error'] == 4)) {

                    $data = ['titulo' => $titulo, 'descripcion' => $desc, 'descripcion_corta' => $desc_corta];
                    if ($_FILES['archivo']['error'] != 4) {
                        $result = save_image_from_post('archivo', './uploads/nosotros', time(), 471, 404);
                        if ($result[0]) {
                            if (file_exists($nosotros->imagen))
                                unlink($nosotros->imagen);
                            $data['imagen'] = $result[1];
                        } else {
                            $this->response->set_message($result[1], ResponseMessage::ERROR);
                            redirect("sobre_nosotros/update_index/" . $sobre_nosotros_id);
                        }
                    }
                    if ($_FILES['icon']['error'] != 4) {
                        $result_icon = save_image_from_post('icon', './uploads/nosotros/iconos', time(), 257, 257);
                        if ($result_icon[0]) {
                            if (file_exists($nosotros->icono))
                                unlink($nosotros->icono);
                            $data['icono'] = $result_icon[1];
                        } else {
                            $this->response->set_message($result_icon[1], ResponseMessage::ERROR);
                            redirect("sobre_nosotros/update_index/" . $sobre_nosotros_id);
                        }
                    }
                    $this->nosotros->update($sobre_nosotros_id, $data);
                    $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
                    redirect("sobre_nosotros/index");
                } else {
                    $this->response->set_message(translate("not_allow_extension"), ResponseMessage::ERROR);
                    redirect("sobre_nosotros/update_index/" . $sobre_nosotros_id);
                }
            } else {
                show_404();
            }
        }
    }

    public function delete($sobre_nosotros_id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $nosotros = $this->nosotros->get_by_id($sobre_nosotros_id);

        if ($nosotros) {
            $this->nosotros->update($sobre_nosotros_id, ['is_active' => 0]);
            $this->response->set_message(translate('data_deleted_ok'), ResponseMessage::SUCCESS);
            redirect("sobre_nosotros/index");
        } else {
            show_404();
        }
    }
}
