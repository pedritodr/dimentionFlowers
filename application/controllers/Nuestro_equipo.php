<?php

class Nuestro_equipo extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Equipo_model', 'equipo');
        $this->load->library(array('session'));
        $this->load->helper("mabuya");

        @session_start();
        $this->load_language();
        $this->init_form_validation();
    }

    public function index()
    {

        if (!in_array($this->session->userdata('role_id'), [1])) {
            $this->log_out();
            redirect('login/index');
        }

        $equipo = $this->equipo->get_all(['is_active' => 1]);
        $data['equipo'] = $equipo;
        $this->load_view_admin_g("nuestro_equipo/index", $data);
    }

    public function add_index()
    {
        if (!in_array($this->session->userdata('role_id'), [1])) {
            $this->log_out();
            redirect('login/index');
        }

        $this->load_view_admin_g('nuestro_equipo/add');
    }

    public function add()
    {
        if (!in_array($this->session->userdata('role_id'), [1])) {
            $this->log_out();
            redirect('login/index');
        }
        $nombre = $this->input->post('nombres');
        $email = $this->input->post('email');
        $skype = $this->input->post('skype');
        $puesto = $this->input->post('puesto');
        $celular = $this->input->post('celular');
        //   $tipo = $this->input->post('tipo');
        //establecer reglas de validacion
        $this->form_validation->set_rules('nombres', "Nombres y apellidos", 'required');
        $this->form_validation->set_rules('email', translate('email_lang'), 'required');
        $this->form_validation->set_rules('skype', translate('skype_lang'), 'required');
        $this->form_validation->set_rules('celular', translate('celular_lang'), 'required');
        $this->form_validation->set_rules('puesto', translate('cargo_lang'), 'required');

        if ($this->form_validation->run() == FALSE) { //si alguna de las reglas de validacion fallaron
            $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
            redirect("nuestro_equipo/add_index");
        } else { //en caso de que todo este bien
            $name_file = $_FILES['archivo']['name'];
            $w = 540;
            $h = 660;

            $separado = explode('.', $name_file);
            $ext = end($separado); // me quedo con la extension
            $allow_extension_array = ["JPEG", "JPG", "jpg", "jpeg", "png", "bmp", "gif"];
            $allow_extension = in_array($ext, $allow_extension_array);
            if ($allow_extension) {
                $result = save_image_from_post('archivo', './uploads/equipo', time(), $w, $h);
                if ($result[0]) {
                    $data = ['is_active' => 1, 'nombre' => $nombre, 'email' => $email, 'skype' => $skype, 'imagen' => $result[1], 'puesto' => $puesto, 'celular' => $celular];
                    $this->equipo->create($data);
                    $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
                    redirect("nuestro_equipo/index", "location", 301);
                } else {
                    $this->response->set_message($result[1], ResponseMessage::ERROR);
                    redirect("nuestro_equipo/add_index", "location", 301);
                }
            } else {

                $this->response->set_message(translate("not_allow_extension"), ResponseMessage::ERROR);
                redirect("nuestro_equipo/add_index", "location", 301);
            }
        }
    }

    function update_index($equipo_id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1])) {
            $this->log_out();
            redirect('login/index');
        }

        $equipo = $this->equipo->get_by_id($equipo_id);

        if ($equipo) {
            $data['equipo'] = $equipo;
            $this->load_view_admin_g('nuestro_equipo/update', $data);
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
        $nombre = $this->input->post('nombres');
        $email = $this->input->post('email');
        $skype = $this->input->post('skype');
        $puesto = $this->input->post('puesto');
        $celular = $this->input->post('celular');
        $equipo_id = $this->input->post('equipo_id');
        $equipo = $this->equipo->get_by_id($equipo_id);
        //establecer reglas de validacion
        $this->form_validation->set_rules('nombres', "Nombres y apellidos", 'required');
        $this->form_validation->set_rules('email', translate('email_lang'), 'required');
        $this->form_validation->set_rules('skype', translate('skype_lang'), 'required');
        $this->form_validation->set_rules('celular', translate('celular_lang'), 'required');
        $this->form_validation->set_rules('puesto', translate('cargo_lang'), 'required');
        if ($this->form_validation->run() == FALSE) { //si alguna de las reglas de validacion fallaron
            $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
            redirect("nuestro_equipo/update_index/" . $equipo_id);
        } else { //en caso de que todo este bien
            if ($equipo) {
                $w = 540;
                $h = 660;
                $name_file = $_FILES['archivo']['name'];
                $separado = explode('.', $name_file);
                $ext = end($separado); // me quedo con la extension
                $allow_extension_array = ["JPEG", "JPG", "jpg", "jpeg", "png", "bmp", "gif"];
                $allow_extension = in_array($ext, $allow_extension_array);
                if ($allow_extension || $_FILES['archivo']['error'] == 4) {

                    if ($_FILES['archivo']['error'] == 4) {
                        $data = ['is_active' => 1, 'nombre' => $nombre, 'email' => $email, 'skype' => $skype, 'puesto' => $puesto, 'celular' => $celular];
                        $this->equipo->update($equipo_id, $data);
                        $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
                        redirect("nuestro_equipo/index", "location", 301);
                    } else {
                        $result = save_image_from_post('archivo', './uploads/equipo', time(), $w, $h);
                        if ($result[0]) {
                            if (file_exists($equipo->imagen))
                                unlink($equipo->imagen);

                            $data = ['is_active' => 1, 'nombre' => $nombre, 'email' => $email, 'skype' => $skype, 'imagen' => $result[1], 'puesto' => $puesto, 'celular' => $celular];
                            $this->equipo->update($equipo_id, $data);
                            $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
                            redirect("nuestro_equipo/index", "location", 301);
                        } else {
                            $this->response->set_message($result[1], ResponseMessage::ERROR);
                            redirect("nuestro_equipo/update_index/" . $equipo_id, "location", 301);
                        }
                    }
                } else {
                    $this->response->set_message(translate("not_allow_extension"), ResponseMessage::ERROR);
                    redirect("nuestro_equipo/update_index/" . $equipo_id, "location", 301);
                }
            } else {
                show_404();
            }
        }
    }

    public function delete($equipo_id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1])) {
            $this->log_out();
            redirect('login/index');
        }

        $equipo = $this->equipo->get_by_id($equipo_id);
        if ($equipo) {
            $this->equipo->update($equipo_id, ['is_active' => 0]);
            $this->response->set_message(translate('data_deleted_ok'), ResponseMessage::SUCCESS);
            redirect("nuestro_equipo/index");
        } else {
            show_404();
        }
    }
}
