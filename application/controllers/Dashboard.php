<?php
require(APPPATH . "libraries/facebook/src/facebook.php");

class Dashboard extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('User_model', 'user');
        $this->load->library(array('session'));
        $this->load->helper("mabuya");

        @session_start();
        $this->load_language();
        $this->init_form_validation();
        if (!in_array($this->session->userdata('role_id'), [1, 2, 3, 4])) {
            $this->log_out();
            redirect('login/index');
        }
    }

    public function index()
    {
        if (in_array($this->session->userdata('role_id'), [1, 2, 3, 4])) {
            $this->load->model('Client_model', 'cliente');
            $this->load->model('Provider_model', 'provider');
            $this->load->model('Mensaje_model', 'mensaje');
            $all_providers = $this->provider->get_all(['is_active' => 0]);
            $all_clientes = $this->cliente->get_all();
            $this->session->set_userdata('clientes', $all_clientes);
            $this->session->set_userdata('providers', $all_providers);
            $data['all_mensajes'] = $this->mensaje->get_all();
            $this->load_view_admin_g('dashboard/index_admin', $data);
        }
    }
}
