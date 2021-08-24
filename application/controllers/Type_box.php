<?php

class Type_box extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Type_box_model', 'type_box');
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

        $all_type_boxs = $this->type_box->get_all();


        $data['all_type_boxs'] = $all_type_boxs;

        $this->load_view_admin_g("type_box/index", $data);
    }

    public function add_index()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $this->load_view_admin_g('type_box/add');
    }

    public function add()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $name = $this->input->post('name');
        $max = $this->input->post('max');


        //establecer reglas de validacion
        $this->form_validation->set_rules('name', translate('nombre_lang'), 'required');
        $this->form_validation->set_rules('max', translate('max_item_lang'), 'numeric|required');



        if ($this->form_validation->run() == FALSE) { //si alguna de las reglas de validacion fallaron
            $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
            redirect("type_box/add_index", "location", 301);
        } else {
            $data = ['name' => $name, 'max_number_of_item' => $max];
            $this->type_box->create($data);
            $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
            redirect("type_box/index", "location", 301);
        }
    }

    function update_index($type_box_id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $type_box_object = $this->type_box->get_by_id($type_box_id);



        if ($type_box_object) {
            $data['type_box_object'] = $type_box_object;

            $this->load_view_admin_g('type_box/update', $data);
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

        $name = $this->input->post('name');
        $max = $this->input->post('max');

        $type_box_id = $this->input->post('type_box_id');

        $type_box_object = $this->type_box->get_by_id($type_box_id);
        if ($type_box_object) {
            //establecer reglas de validacion
            $this->form_validation->set_rules('name', translate('nombre_lang'), 'required');
            $this->form_validation->set_rules('max', translate('max_item_lang'), 'numeric|required');

            if ($this->form_validation->run() == FALSE) { //si alguna de las reglas de validacion fallaron
                $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
                redirect("type_box/update_index/" . $type_box_id, "location", 301);
            } else {
                $data = ['name' => $name, 'max_number_of_item' => $max];
                $this->type_box->update($type_box_id, $data);
                $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
                redirect("type_box/index", "location", 301);
            }
        }
    }
    public function delete($type_box_id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $type_box_object = $this->type_box->get_by_id($type_box_id);
        if ($type_box_object) {
            $this->type_box->delete($type_box_id);
            $this->response->set_message(translate('data_deleted_ok'), ResponseMessage::SUCCESS);
            redirect("type_box/index");
        } else {
            show_404();
        }
    }
}
