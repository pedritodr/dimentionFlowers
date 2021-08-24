<?php

class Activelog extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Activelog_model', 'activelog');
        $this->load->library(array('session'));
        $this->load->helper("mabuya");

        @session_start();
        $this->load_language();
        $this->init_form_validation();
    }

    public function index()
    {

        if (!in_array($this->session->userdata('rol_id'), [1])) {
            $this->log_out();
            redirect('login/index');
        }

        $all_logs = $this->activelog->get_all_fecha(date("Y-m-d"));
        $data['all_logs'] = $all_logs;
        $data['fecha'] = date("Y-m-d");
        $this->load_view_admin_g("activelog/index", $data);
    }


    public function buscar_por_fecha(){
        if (!in_array($this->session->userdata('rol_id'), [1])) {
            $this->log_out();
            redirect('login/index');
        }

        $fecha = $this->input->post("date");
        $all_logs = $this->activelog->get_all_fecha($fecha);
        $data['all_logs'] = $all_logs;
        $data['fecha'] = $fecha;
        $this->load_view_admin_g("activelog/index", $data);
    }


}
