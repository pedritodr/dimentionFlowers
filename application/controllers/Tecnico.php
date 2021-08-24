<?php

class Tecnico extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Usuario_model', 'user');
        $this->load->library(array('session'));
        $this->load->helper("mabuya");

        @session_start();
        $this->load_language();
        $this->init_form_validation();
    }

    public function index()
    {
        if (!in_array($this->session->userdata('role_id'), [2])) {
            $this->log_out();
            redirect('login/index');
        }
        $user_id = $this->session->userdata('user_id');

        $this->load->model('Solicitud_model', 'solicitud');
        $this->load->model('Solicitud_tecnico_model', 'solicitud_tecnico');
        $this->load->model('Visita_model', 'visita');


        $solicitudes_recibidas = $this->solicitud->get_solicitudes_recibidas($user_id);



        foreach ($solicitudes_recibidas as $solicitud) {
            $solicitud->visitas = $this->visita->get_by_id_tecnico($solicitud->tecnico_id, $solicitud->solicitud_id);
        }

        $data['solicitudes_recibidas'] =  $solicitudes_recibidas;

        $this->load_view_admin_g("tecnico/solicitudes_recibidas", $data);
    }

    public function atendidas()
    {
        if (!in_array($this->session->userdata('role_id'), [2])) {
            $this->log_out();
            redirect('login/index');
        }
        $user_id = $this->session->userdata('user_id');

        $this->load->model('Solicitud_model', 'solicitud');
        $this->load->model('Solicitud_tecnico_model', 'solicitud_tecnico');
        $this->load->model('Visita_model', 'visita');


        $solicitudes_atendidas = $this->solicitud->get_solicitudes_atendidas($user_id);



        foreach ($solicitudes_atendidas as $solicitud) {
            $solicitud->visitas = $this->visita->get_by_id_tecnico($solicitud->tecnico_id, $solicitud->solicitud_id);
        }

        $data['solicitudes_atendidas'] =  $solicitudes_atendidas;

        $this->load_view_admin_g("tecnico/solicitudes_atendidas", $data);
    }

    public function enviar_precio()
    {
        if (!in_array($this->session->userdata('role_id'), [2])) {
            $this->log_out();
            redirect('login/index');
        }
        $solicitud_id = $this->input->post("solicitud_id");
        $precio = $this->input->post('precio');
        $tecnico_id = $this->session->userdata('user_id');
        //establecer reglas de validacion
        $this->form_validation->set_rules('precio', translate('precio_lang'), 'required');

        if ($this->form_validation->run() == FALSE) { //si alguna de las reglas de validacion fallaron
            $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
            redirect("tecnico/index");
        } else { //en caso de que todo este bien
            $data = [
                'precio' => $precio,
                'estado_tecnico' => 1

            ];
            $this->load->model('Solicitud_tecnico_model', 'solicitud_tecnico');

            $this->solicitud_tecnico->update($solicitud_id, $tecnico_id, $data);
        }
        $this->response->set_message("Se ha enviado el precio exitosamente.", ResponseMessage::SUCCESS);
        redirect("tecnico/index");
    }



    public function solicitar_visita($solicitud_id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [2])) {
            $this->log_out();
            redirect('login/index');
        }
        $this->load->model('Solicitud_tecnico_model', 'solicitud_tecnico');

        $tecnico_id = $this->session->userdata('user_id');


        $solicitud_object = $this->solicitud_tecnico->get_by_id_tecnico($solicitud_id, $tecnico_id);

        if ($solicitud_object) {
            $data = [
                'solicitud_id' => $solicitud_id,
                'tecnico_id' =>   $tecnico_id

            ];
            $this->load->model('Visita_model', 'visita');

            $this->visita->create($data);

            $this->response->set_message("Se ha generado una solicitud de visita exitosamente.", ResponseMessage::SUCCESS);
            redirect("tecnico/index");
        }
    }

    public function llamar_chat($solicitud_id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [2])) {
            $this->log_out();
            redirect('login/index');
        }
        $this->load->model('Info_model', 'info');
        $this->load->model('Solicitud_tecnico_model', 'solicitud_tecnico');

        $tecnico_id = $this->session->userdata('user_id');

        $solicitud_object = $this->solicitud_tecnico->get_by_id_tecnico($solicitud_id, $tecnico_id);
        if ($solicitud_object) {
            $data['infos'] = $this->info->get_all_info_by_solicitud($solicitud_id);
            $data['solicitud'] = $solicitud_id;
            $this->load_view_admin_g("tecnico/chat", $data);
        } else {
            show_404();
        }
    }

    public function enviar_mensaje()
    {
        if (!in_array($this->session->userdata('role_id'), [2])) {
            $this->log_out();
            redirect('login/index');
        }
        $this->load->model('Info_model', 'info');
        $contenido = $this->input->post('contenido');
        $solicitud_id = $this->input->post('solicitud_id');
        $fecha = date('Y-n-j');
        $hora = date("H:i:s");
        $user_id = $this->session->userdata('user_id');



        $this->form_validation->set_rules('contenido', translate('message_lang'), 'required');




        if ($this->form_validation->run() == FALSE) { //si alguna de las reglas de validacion fallaron
            $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
            redirect("tecnico/llamar_chat/$solicitud_id");
        } else { //en caso de que todo este bien
            if ($_FILES['archivo']['name'] == "") {
                $data = ['solicitud_id' => $solicitud_id, 'contenido' => $contenido, 'fecha' => $fecha, 'hora' => $hora, 'user_id' => $user_id];
                $id = $this->info->create($data);
                $this->response->set_message(translate("message_saved_ok"), ResponseMessage::SUCCESS);
                redirect("tecnico/llamar_chat/$solicitud_id");
            } else {
                $name_file = $_FILES['archivo']['name'];
                $separado = explode('.', $name_file);
                $ext = end($separado); // me quedo con la extension
                $allow_extension_array = ["JPEG", "JPG", "jpg", "jpeg", "png", "bmp", "gif"];
                $allow_extension = in_array($ext, $allow_extension_array);
                if ($allow_extension) {
                    $result = save_image_from_post('archivo', './uploads/infos', time(), 1360, 720);
                    if ($result[0]) {
                        $data = ['solicitud_id' => $solicitud_id, 'contenido' => $contenido,  'imagen' => $result[1], 'fecha' => $fecha, 'hora' => $hora, 'user_id' => $user_id];
                        $id = $this->info->create($data);
                        $this->response->set_message(translate("message_saved_ok"), ResponseMessage::SUCCESS);
                        redirect("tecnico/llamar_chat/$solicitud_id");
                    }
                } else {

                    $this->response->set_message(translate("not_allow_extension"), ResponseMessage::ERROR);
                    redirect("tecnico/llamar_chat/$solicitud_id");
                }
            }
        }
    }

    public function descargar_imagen($id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [2])) {
            $this->log_out();
            redirect('login/index');
        }
        $this->load->model('Info_model', 'info');
        $info = $this->info->get_by_id($id);
        $file = $info->imagen;
        if ($file) {
            download_file($file);
        } else {
            show_404();
        }
    }

    public function cancelar_solicitud($solicitud_id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [2])) {
            $this->log_out();
            redirect('login/index');
        }
        $this->load->model('Solicitud_tecnico_model', 'solicitud_tecnico');

        $tecnico_id = $this->session->userdata('user_id');

        $solicitud_object = $this->solicitud_tecnico->get_by_id_tecnico($solicitud_id, $tecnico_id);
        if ($solicitud_object) {
            $data = ['estado_tecnico' => 5];
            $this->solicitud_tecnico->update_tecnico($solicitud_id, $tecnico_id, $data);
            $this->response->set_message(translate("Solicitud cancelada correctamente."), ResponseMessage::SUCCESS);
            redirect("tecnico/index");
        }
    }

    public function culminar_solicitud($solicitud_id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [2])) {
            $this->log_out();
            redirect('login/index');
        }
        $this->load->model('Solicitud_tecnico_model', 'solicitud_tecnico');
        $this->load->model('Solicitud_model', 'solicitud');


        $tecnico_id = $this->session->userdata('user_id');

        $solicitud_object = $this->solicitud_tecnico->get_by_id_tecnico($solicitud_id, $tecnico_id);
        if ($solicitud_object) {
            $data1 = ['estado_tecnico' => 6];
            $this->solicitud_tecnico->update_tecnico($solicitud_id, $tecnico_id, $data1);
            $data2 = ['estado_solicitud' => 2];
            $this->solicitud->update($solicitud_id, $data2);
            $this->response->set_message(translate("Solicitud culminada correctamente."), ResponseMessage::SUCCESS);
            redirect("tecnico/index");
        }
    }
}
