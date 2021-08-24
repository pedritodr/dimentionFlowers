<?php

class Login extends CI_Controller
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
    }



    public function index()
    {

        $this->load->view("login");
    }

    public function auth()
    {
        $email = $this->input->post('email');
        $password = md5($this->input->post('password'));


        $user = $this->user->get_all(['email' => $email, 'password' => $password], TRUE);


        if ($user) {

            $session_data = object_to_array($user);
            $this->session->set_userdata($session_data);

            if ($user->role_id == 1 || $user->role_id == 2 || $user->role_id == 4) {
                redirect("dashboard/index");
            } else {
                redirect(site_url());
            }
        } else {
            $this->response->set_message("Error de autenticación", ResponseMessage::ERROR);
            redirect("login/index");
        }
    }

    public function facebook_auth()
    {
    }

    public function logout()
    {
        parent::log_out();
        redirect(site_url());
    }

    public function recover_password_index()
    {
        $this->load->view("recover_password");
    }

    public function recover_password()
    {
        $email = $this->input->post("email");
        $this->load->model("Usuario_model", "user");
        $user_object = $this->user->get_user_by_email($email);
        if ($user_object) {


            $new_password = time();
            $this->user->update($user_object->usuario_id, ["password" => md5($new_password)]);

            $this->load->library('email');

            $config['protocol'] = 'smtp';
            $config['smtp_host'] = 'smtp.zoho.com';
            $config['smtp_user'] = 'info@datalabcenter.com';
            $config['smtp_pass'] = "Q12we34rt5";
            $config['smtp_port'] = '465';
            //$config['smtp_timeout'] = '5';
            //$config['smtp_keepalive'] = TRUE;
            $config['smtp_crypto'] = 'ssl';
            $config['charset'] = 'utf-8';
            $config['newline'] = "\r\n";
            $config['mailtype'] = 'html';
            $config['wordwrap'] = TRUE;

            $this->email->initialize($config);

            $this->email->from('info@datalabcenter.com', 'Cambio de contraseña Julio Verne');
            $this->load->model('Empresa_model', 'empresa');
            $empresa_object = $this->empresa->get_by_id(1);
            $correo_empresa = $empresa_object->email;
            $this->email->to($correo_empresa);

            $this->email->subject("Cambio de clave");
            $mensaje = "Estimado usuario: <br /> La contraseña ha sido generada satisfactoriamente.  <br /> Su nueva contraseña es: <b>" . $new_password . "</b>. <br /> Muchas gracias";
            $this->email->message($mensaje);

            // $result = $this->email->send();

            $this->email->send();

            $this->response->set_message("La contraseña ha sido cambiada correctamente", ResponseMessage::SUCCESS);
            redirect("login/index");
        } else {
            $this->response->set_message("El correo electrónico no existe", ResponseMessage::ERROR);
            redirect("login/index");
        }
    }
}
