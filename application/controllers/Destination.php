

<?php

class Destination extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Destination_model', 'destination');
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

        $all_destinations = $this->destination->get_all();


        $data['all_destinations'] = $all_destinations;


        $this->load_view_admin_g("destination/index", $data);
    }

    public function add_index()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }
        $this->load->model('Country_model', 'country');
        $all_countrys = $this->country->get_all();
        $data['all_countrys'] = $all_countrys;
        $this->load_view_admin_g('destination/add', $data);
    }

    public function add()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $nombre = $this->input->post('nombre');
        $pais = $this->input->post('pais');


        //establecer reglas de validacion
        $this->form_validation->set_rules('nombre', translate('nombre_lang'), 'required');
        $this->form_validation->set_rules('pais', "Seleccione un País", 'required');



        if ($this->form_validation->run() == FALSE) { //si alguna de las reglas de validacion fallaron
            $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
            redirect("destination/add_index", "location", 301);
        } else {
            $data = ['name' => $nombre, 'country_id' => $pais];
            $this->destination->create($data);
            $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
            redirect("destination/index", "location", 301);
        }
    }

    function update_index($destination_id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $destination_object = $this->destination->get_by_id($destination_id);

        $this->load->model('Country_model', 'country');
        $all_countrys = $this->country->get_all();
        $data['all_countrys'] = $all_countrys;



        if ($destination_object) {
            $data['destination_object'] = $destination_object;

            $this->load_view_admin_g('destination/update', $data);
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

        $destination_id = $this->input->post('ciudad_id');
        $pais = $this->input->post('pais');


        $destination_object = $this->destination->get_by_id($destination_id);
        if ($destination_object) {
            //establecer reglas de validacion
            $this->form_validation->set_rules('nombre', translate('nombre_lang'), 'required');
            $this->form_validation->set_rules('pais', "Seleccione un País", 'required');

            if ($this->form_validation->run() == FALSE) { //si alguna de las reglas de validacion fallaron
                $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
                redirect("destination/update_index/" . $destination_id, "location", 301);
            } else {
                $data = ['name' => $nombre, 'country_id' => $pais];
                $this->destination->update($destination_id, $data);
                $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
                redirect("destination/index", "location", 301);
            }
        }
    }
    public function delete($destination_id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $destination_object = $this->destination->get_by_id($destination_id);
        if ($destination_object) {
            $this->destination->delete($destination_id);
            $this->response->set_message(translate('data_deleted_ok'), ResponseMessage::SUCCESS);
            redirect("destination/index");
        } else {
            show_404();
        }
    }
}
