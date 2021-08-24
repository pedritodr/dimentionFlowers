<?php

class Motivo extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Motivo_model', 'motivo');
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

        $all_motivos = $this->motivo->get_all(['is_active' => 1]);
        $data['all_motivos'] = $all_motivos;

        $this->load_view_admin_g("motivo/index", $data);
    }

    public function add_index()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $this->load_view_admin_g('motivo/add');
    }

    public function add()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $motivo = $this->input->post('motivo');

        //establecer reglas de validacion
        $this->form_validation->set_rules('motivo', translate('motivo_lang'), 'required');


        if ($this->form_validation->run() == FALSE) { //si alguna de las reglas de validacion fallaron
            $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
            redirect("motivo/add_index", "location", 301);
        } else {
            $data = [
                'motivo' => $motivo,
                'is_active' => 1
            ];
            $this->motivo->create($data);
            $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
            redirect("motivo/index", "location", 301);
        }
    }

    function update_index($motivo_id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $motivo_object = $this->motivo->get_by_id($motivo_id);

        if ($motivo_object) {
            $data['motivo_object'] = $motivo_object;
            $this->load_view_admin_g('motivo/update', $data);
        } else {
            show_404();
        }
    }

    public function update()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $motivo = $this->input->post('motivo');

        $motivo_id = $this->input->post('motivo_id');

        $motivo_object = $this->motivo->get_by_id($motivo_id);
        if ($motivo_object) {
            //establecer reglas de validacion
            $this->form_validation->set_rules('motivo', translate('motivo_lang'), 'required');

            if ($this->form_validation->run() == FALSE) { //si alguna de las reglas de validacion fallaron
                $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
                redirect("motivo/update_index/" . $motivo_id, "location", 301);
            } else {
                $data = [
                    'motivo' => $motivo
                ];
                $this->motivo->update($motivo_id, $data);
                $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
                redirect("motivo/index", "location", 301);
            }
        }
    }

    public function delete($motivo_id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $motivo_object = $this->motivo->get_by_id($motivo_id);

        if ($motivo_object) {
            $data = [
                'is_active' => 2,
            ];
            $this->motivo->update($motivo_id, $data);
            $this->response->set_message(translate('data_deleted_ok'), ResponseMessage::SUCCESS);
            redirect("motivo/index");
        } else {
            show_404();
        }
    }
}
