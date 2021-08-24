<?php

class Nunit extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Nunit_model', 'nunit');
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

        $all_nunits = $this->nunit->get_all();


        $data['all_nunits'] = $all_nunits;


        //var_dump($data);
        //die();

        $this->load_view_admin_g("nunit/index", $data);
    }

    public function add_index()
    {
        if (!in_array($this->session->userdata('role_id'), [1])) {
            $this->log_out();
            redirect('login/index');
        }

        $this->load_view_admin_g('nunit/add');
    }

    public function add()
    {
        if (!in_array($this->session->userdata('role_id'), [1])) {
            $this->log_out();
            redirect('login/index');
        }

        $nombre = $this->input->post('nombre');


        //establecer reglas de validacion
        $this->form_validation->set_rules('nombre', translate('nombre_lang'), 'required');


        if ($this->form_validation->run() == FALSE) { //si alguna de las reglas de validacion fallaron
            $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
            redirect("nunit/add_index", "location", 301);
        } else {
            $data = ['name' => $nombre];
            $this->nunit->create($data);
            $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
            redirect("nunit/index", "location", 301);
        }
    }

    function update_index($munit_id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1])) {
            $this->log_out();
            redirect('login/index');
        }

        $nunit_object = $this->nunit->get_by_id($munit_id);



        if ($nunit_object) {
            $data['nunit_object'] = $nunit_object;

            $this->load_view_admin_g('nunit/update', $data);
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

        $nombre = $this->input->post('nombre');

        $nunit_id = $this->input->post('nunit_id');

        $nunit_object = $this->nunit->get_by_id($nunit_id);
        if ($nunit_object) {
            //establecer reglas de validacion
            $this->form_validation->set_rules('nombre', translate('nombre_lang'), 'required');

            if ($this->form_validation->run() == FALSE) { //si alguna de las reglas de validacion fallaron
                $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
                redirect("nunit/update_index/" . $nunit_id, "location", 301);
            } else {
                $data = ['name' => $nombre];
                $this->nunit->update($nunit_id, $data);
                $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
                redirect("nunit/index", "location", 301);
            }
        }
    }
    public function delete($nunit_id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1])) {
            $this->log_out();
            redirect('login/index');
        }

        $nunit_object = $this->nunit->get_by_id($nunit_id);
        if ($nunit_object) {
            $this->nunit->delete($nunit_id);
            $this->response->set_message(translate('data_deleted_ok'), ResponseMessage::SUCCESS);
            redirect("nunit/index");
        } else {
            show_404();
        }
    }
}
