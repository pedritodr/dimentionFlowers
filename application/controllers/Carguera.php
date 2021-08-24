<?php

class Carguera extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Carguera_model', 'carguera');
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

        $all_cargueras = $this->carguera->get_all();


        $data['all_cargueras'] = $all_cargueras;


        //var_dump($data);
        //die();

        $this->load_view_admin_g("carguera/index", $data);
    }

    public function add_index()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $this->load_view_admin_g('carguera/add');
    }

    public function add()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $nombre = $this->input->post('nombre');
        $email = $this->input->post('email');
        $address = $this->input->post('address');
        $person_contact = $this->input->post('person_contact');
        $phone = $this->input->post('phone');
        $skype = $this->input->post('skype');



        //establecer reglas de validacion
        $this->form_validation->set_rules('nombre', translate('nombre_lang'), 'required');


        if ($this->form_validation->run() == FALSE) { //si alguna de las reglas de validacion fallaron
            $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
            redirect("carguera/add_index", "location", 301);
        } else {
            $data = [
                'name' => $nombre,
                'address' => $address,
                'phone' => $phone,
                'person_contact' => $person_contact,
                'email' => $email,
                'skype' => $skype
            ];
            $this->carguera->create($data);
            $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
            redirect("carguera/index", "location", 301);
        }
    }

    function update_index($carguera_id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $carguera_object = $this->carguera->get_by_id($carguera_id);



        if ($carguera_object) {
            $data['carguera_object'] = $carguera_object;

            $this->load_view_admin_g('carguera/update', $data);
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
        $email = $this->input->post('email');
        $address = $this->input->post('address');
        $person_contact = $this->input->post('person_contact');
        $phone = $this->input->post('phone');
        $skype = $this->input->post('skype');
        $carguera_id = $this->input->post('carguera_id');

        $carguera_object = $this->carguera->get_by_id($carguera_id);
        if ($carguera_object) {
            //establecer reglas de validacion
            $this->form_validation->set_rules('nombre', translate('nombre_lang'), 'required');

            if ($this->form_validation->run() == FALSE) { //si alguna de las reglas de validacion fallaron
                $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
                redirect("carguera/update_index/" . $carguera_id, "location", 301);
            } else {
                $data = [
                    'name' => $nombre,
                    'address' => $address,
                    'phone' => $phone,
                    'person_contact' => $person_contact,
                    'email' => $email,
                    'skype' => $skype
                ];
                $this->carguera->update($carguera_id, $data);
                $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
                redirect("carguera/index", "location", 301);
            }
        }
    }
    public function delete($carguera_id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $carguera_object = $this->carguera->get_by_id($carguera_id);
        if ($carguera_object) {
            $this->carguera->delete($carguera_id);
            $this->response->set_message(translate('data_deleted_ok'), ResponseMessage::SUCCESS);
            redirect("carguera/index");
        } else {
            show_404();
        }
    }
}
