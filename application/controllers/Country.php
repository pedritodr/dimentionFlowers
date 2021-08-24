<?php

class Country extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Country_model', 'country');
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

        $all_countrys = $this->country->get_all();


        $data['allcountrys'] = $all_countrys;


        //var_dump($data);
        //die();

        $this->load_view_admin_g("country/index", $data);
    }

    public function add_index()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $this->load_view_admin_g('country/add');
    }

    public function add()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $nombre = $this->input->post('nombre');


        //establecer reglas de validacion
        $this->form_validation->set_rules('nombre', translate('nombre_lang'), 'required');


        if ($this->form_validation->run() == FALSE) { //si alguna de las reglas de validacion fallaron
            $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
            redirect("country/add_index", "location", 301);
        } else {
            $data = ['name' => $nombre];
            $this->country->create($data);
            $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
            redirect("country/index", "location", 301);
        }
    }

    function update_index($country_id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $country_object = $this->country->get_by_id($country_id);



        if ($country_object) {
            $data['country_object'] = $country_object;

            $this->load_view_admin_g('country/update', $data);
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

        $nombre = $this->input->post('nombre');

        $country_id = $this->input->post('pais_id');

        $country_object = $this->country->get_by_id($country_id);
        if ($country_object) {
            //establecer reglas de validacion
            $this->form_validation->set_rules('nombre', translate('nombre_lang'), 'required');

            if ($this->form_validation->run() == FALSE) { //si alguna de las reglas de validacion fallaron
                $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
                redirect("country/update_index/" . $country_id, "location", 301);
            } else {
                $data = ['name' => $nombre];
                $this->country->update($country_id, $data);
                $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
                redirect("country/index", "location", 301);
            }
        }
    }
    public function delete($country_id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $country_object = $this->country->get_by_id($country_id);
        if ($country_object) {
            $this->country->delete($country_id);
            $this->response->set_message(translate('data_deleted_ok'), ResponseMessage::SUCCESS);
            redirect("country/index");
        } else {
            show_404();
        }
    }
    /*  public function change($pais_id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1])) {
            $this->log_out();
            redirect('login/index');
        }

        $pais_object = $this->pais->get_by_id($pais_id);

        if ($pais_object) {
            if ($pais_object->is_active == 1)
                $this->pais->update($pais_id, ['is_active' => 0]);
            if ($pais_object->is_active == 0)
                $this->pais->update($pais_id, ['is_active' => 1]);
            $this->response->set_message(translate('data_changed_ok'), ResponseMessage::SUCCESS);
            redirect("pais/index");
        } else {
            show_404();
        }
    }*/
}
