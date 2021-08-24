<?php

class Plan_compra extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Plan_compra_model', 'plan_compra');
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

        $all_plans_compra = $this->plan_compra->get_all_compras();


        $data['all_plans_compra'] = $all_plans_compra;


        //var_dump($data);
        //die();

        $this->load_view_admin_g("plan_compra/index", $data);
    }
    public function get_plan()
    {

        if (!in_array($this->session->userdata('role_id'), [1])) {
            $this->log_out();
            redirect('login/index');
        }
        $id = $this->input->post('id');

        $compra_object = $this->plan_compra->get_compra_by_id($id);


        echo json_encode($compra_object);
        exit();
    }
}
