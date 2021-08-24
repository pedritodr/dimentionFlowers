<?php

class Promocion_compra extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Promocion_compra_model', 'promocion_compra');
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

        $all_promociones_compra = $this->promocion_compra->get_all_promociones();


        $data['all_promociones_compra'] = $all_promociones_compra;


        //var_dump($data);
        //die();

        $this->load_view_admin_g("promocion_compra/index", $data);
    }
    public function get_promocion()
    {

        if (!in_array($this->session->userdata('role_id'), [1])) {
            $this->log_out();
            redirect('login/index');
        }
        $id = $this->input->post('id');

        $compra_object = $this->promocion_compra->get_promocion_by_id($id);
      

        echo json_encode($compra_object);
        exit();
    }
}
