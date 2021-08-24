<?php

class Servicio extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('servicio_model', 'servicio');
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

        $all_servicios = $this->servicio->get_all();
        $data['all_servicios'] = $all_servicios;
        $this->load_view_admin_g("servicio/index", $data);
    }
    public function add_index()
    {
        if (!in_array($this->session->userdata('role_id'), [1])) {
            $this->log_out();
            redirect('login/index');
        }

        $this->load_view_admin_g('servicio/add');
    }



    public function add()
    {
        if (!in_array($this->session->userdata('role_id'), [1])) {
            $this->log_out();
            redirect('login/index');
        }

        $titulo = $this->input->post('titulo');
        $cantidad = $this->input->post('cantidad');


        //en caso de que todo este bien

        $data = ['titulo' => $titulo, 'cantidad' => $cantidad, 'is_active' => 1];
        $this->servicio->create($data);
        $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
        redirect("servicio/index", "location", 301);
    }

    function update_index($servicio_id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1])) {
            $this->log_out();
            redirect('login/index');
        }

        $servicio_object = $this->servicio->get_by_id($servicio_id);

        if ($servicio_object) {
            $data['servicio_object'] = $servicio_object;
            $this->load_view_admin_g('servicio/update', $data);
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
        $cantidad = $this->input->post('cantidad');
        $servicio_id = $this->input->post('servicio_id');


        $servicio_object = $this->servicio->get_by_id($servicio_id);
        if ($servicio_object) {
            $data = ['titulo' => $titulo, 'cantidad' => $cantidad, 'is_active' => 1];
            $this->servicio->update($servicio_id, $data);
            $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
            redirect("servicio/index", "location", 301);
        } else {
            show_404();
        }
    }

    public function change($servicio_id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1])) {
            $this->log_out();
            redirect('login/index');
        }

        $servicio_object = $this->servicio->get_by_id($servicio_id);

        if ($servicio_object) {
            if ($servicio_object->is_active == 1)
                $this->servicio->update($servicio_id, ['is_active' => 0]);
            if ($servicio_object->is_active == 0)
                $this->servicio->update($servicio_id, ['is_active' => 1]);
            $this->response->set_message(translate('data_changed_ok'), ResponseMessage::SUCCESS);
            redirect("servicio/index");
        } else {
            show_404();
        }
    }

    public function delete($servicio_id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1])) {
            $this->log_out();
            redirect('login/index');
        }

        $servicio_object = $this->servicio->get_by_id($servicio_id);
        if ($servicio_object) {
            $this->servicio->delete($servicio_id);
            $this->response->set_message(translate('data_deleted_ok'), ResponseMessage::SUCCESS);
            redirect("servicio/index");
        } else {
            show_404();
        }
    }
}
