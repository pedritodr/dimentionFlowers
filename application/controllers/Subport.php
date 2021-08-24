

<?php

class Subport extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Subport_model', 'subport');
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

        $all_subports = $this->subport->get_all();


        $data['all_subports'] = $all_subports;


        $this->load_view_admin_g("subport/index", $data);
    }

    public function add_index()
    {
        if (!in_array($this->session->userdata('role_id'), [1])) {
            $this->log_out();
            redirect('login/index');
        }
        $this->load->model('Destination_model', 'destination');
        $all_destinations = $this->destination->get_all();
        $data['all_destinations'] = $all_destinations;
        $this->load_view_admin_g('subport/add', $data);
    }

    public function add_marcacion()
    {
        if (!in_array($this->session->userdata('role_id'), [1])) {
            $this->log_out();
            redirect('login/index');
        }

        $nombre = $this->input->post('nombre');
        $codigo = $this->input->post('cod');
        $destination_id = $this->input->post('destination');


        //establecer reglas de validacion
        $this->form_validation->set_rules('nombre', translate('nombre_lang'), 'required');
        $this->form_validation->set_rules('cod', translate('cod_lang'), 'required');
        $this->form_validation->set_rules('destination', "Seleccione un destino", 'required');



        if ($this->form_validation->run() == FALSE) { //si alguna de las reglas de validacion fallaron
            $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
            redirect("subport/add_index", "location", 301);
        } else {
            $data = ['name' => $nombre, 'destination_id' => $destination_id, 'code' => $codigo];
            $this->subport->create($data);
            $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
            redirect("subport/index", "location", 301);
        }
    }

    function update_index($subport_id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1])) {
            $this->log_out();
            redirect('login/index');
        }

        $subport_object = $this->subport->get_by_id($subport_id);

        $this->load->model('Destination_model', 'destination');
        $all_destinations = $this->destination->get_all();




        if ($subport_object) {
            $data['subport_object'] = $subport_object;
            $data['all_destinations'] = $all_destinations;
            $this->load_view_admin_g('subport/update', $data);
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
        $codigo = $this->input->post('cod');
        $destination_id = $this->input->post('destination');
        $subport_id = $this->input->post('subport_id');


        $subport_object = $this->subport->get_by_id($subport_id);
        if ($subport_object) {
            //establecer reglas de validacion
            $this->form_validation->set_rules('nombre', translate('nombre_lang'), 'required');
            $this->form_validation->set_rules('cod', translate('cod_lang'), 'required');
            $this->form_validation->set_rules('destination', "Seleccione un destino", 'required');

            if ($this->form_validation->run() == FALSE) { //si alguna de las reglas de validacion fallaron
                $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
                redirect("subport/update_index/" . $subport_id, "location", 301);
            } else {
                $data = ['name' => $nombre, 'destination_id' => $destination_id, 'code' => $codigo];
                $this->subport->update($subport_id, $data);
                $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
                redirect("subport/index", "location", 301);
            }
        }
    }
    public function delete($subport_id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1])) {
            $this->log_out();
            redirect('login/index');
        }

        $subport_object = $this->subport->get_by_id($subport_id);
        if ($subport_object) {
            $this->subport->delete($subport_id);
            $this->response->set_message(translate('data_deleted_ok'), ResponseMessage::SUCCESS);
            redirect("subport/index");
        } else {
            show_404();
        }
    }
}
