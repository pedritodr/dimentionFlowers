<?php

class Plan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Plan_model', 'plan');
        $this->load->model('Plan_categoria_model', 'plan_categoria');
        $this->load->model('Servicio_model', 'servicio');
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

        $all_planes = $this->plan->get_all_planes();
        $data['all_planes'] = $all_planes;

        $this->load_view_admin_g("plan/index", $data);
    }

    public function add_index()
    {
        if (!in_array($this->session->userdata('role_id'), [1])) {
            $this->log_out();
            redirect('login/index');
        }

        $all_categorias = $this->plan_categoria->get_all();
        $data['all_categorias'] = $all_categorias;




        $this->load_view_admin_g('plan/add', $data);
    }

    public function add()
    {
        if (!in_array($this->session->userdata('role_id'), [1])) {
            $this->log_out();
            redirect('login/index');
        }

        $nombre = $this->input->post('nombre');
        $cant = $this->input->post('cant');
        $precio = $this->input->post('precio');
        $duracion = $this->input->post('duracion');
        $plan_categoria_id = $this->input->post('categoria');



        //en caso de que todo este bien

        //establecer reglas de validacion
        $this->form_validation->set_rules('nombre', translate('nombre_lang'), 'required');
        $this->form_validation->set_rules('precio', translate('precio_lang'), 'numeric|required');
        $this->form_validation->set_rules('cant', translate('maximo_lang'), 'numeric|required');
        $this->form_validation->set_rules('duracion', translate('duracion_lang'), 'numeric|required');
        $this->form_validation->set_rules('categoria', "Seleccione una categoria", 'required');




        if ($this->form_validation->run() == FALSE) { //si alguna de las reglas de validacion fallaron
            $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
            redirect("plan/add_index", "location", 301);
        } else {
            $data = ['nombre' => $nombre, 'cant_dias_duracion' => $cant, 'precio' => $precio, 'max_servicios' => $duracion, 'is_active' => 1, 'destacado' => 0, 'plan_categoria_id' => $plan_categoria_id];
            $this->plan->create($data);
            $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
            redirect("plan/index", "location", 301);
        }
    }

    function update_index($plan_id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1])) {
            $this->log_out();
            redirect('login/index');
        }

        $plan_object = $this->plan->get_by_id($plan_id);
        $data['all_categorias'] = $this->plan_categoria->get_all();


        if ($plan_object) {
            $all_categorias = $this->plan_categoria->get_all();

            $data['all_categorias'] = $all_categorias;

            $data['plan_object'] = $plan_object;

            $this->load_view_admin_g('plan/update', $data);
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
        $precio = $this->input->post('precio');
        $cantidad = $this->input->post('cant');
        $duracion = $this->input->post('duracion');
        $plan_id = $this->input->post('plan_id');
        $plan_categoria_id = $this->input->post('categoria');




        $plan_object = $this->plan->get_by_id($plan_id);
        if ($plan_object) {
            //establecer reglas de validacion
            $this->form_validation->set_rules('nombre', translate('nombre_lang'), 'required');
            $this->form_validation->set_rules('precio', translate('precio_lang'), 'numeric|required');
            $this->form_validation->set_rules('cant', translate('maximo_lang'), 'numeric|required');
            $this->form_validation->set_rules('duracion', translate('duracion_lang'), 'numeric|required');


            if ($this->form_validation->run() == FALSE) { //si alguna de las reglas de validacion fallaron
                $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
                redirect("plan/update_index/" . $plan_id, "location", 301);
            } else {
                $data = ['nombre' => $nombre, 'cant_dias_duracion' => $cantidad, 'precio' => $precio, 'max_servicios' => $duracion, 'is_active' => 1, 'destacado' => 0, 'plan_categoria_id' => $plan_categoria_id];
                $this->plan->update($plan_id, $data);
                $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
                redirect("plan/index", "location", 301);
            }
        }
    }

    public function change($plan_id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1])) {
            $this->log_out();
            redirect('login/index');
        }

        $plan_object = $this->plan->get_by_id($plan_id);

        if ($plan_object) {
            if ($plan_object->is_active == 1)
                $this->plan->update($plan_id, ['is_active' => 0]);
            if ($plan_object->is_active == 0)
                $this->plan->update($plan_id, ['is_active' => 1]);
            $this->response->set_message(translate('data_changed_ok'), ResponseMessage::SUCCESS);
            redirect("plan/index");
        } else {
            show_404();
        }
    }

    public function delete($plan_id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1])) {
            $this->log_out();
            redirect('login/index');
        }

        $plan_object = $this->plan->get_by_id($plan_id);
        if ($plan_object) {
            $this->plan->delete($plan_id);
            $this->response->set_message(translate('data_deleted_ok'), ResponseMessage::SUCCESS);
            redirect("plan/index");
        } else {
            show_404();
        }
    }

    public function add_servicio_index($plan_id)
    {
        if (!in_array($this->session->userdata('role_id'), [1])) {
            $this->log_out();
            redirect('login/index');
        }
        $plan_object = $this->plan->get_by_id($plan_id);
        if ($plan_object) {
            $data['plan_object'] = $plan_object;
            $all_servicios = $this->servicio->get_all(['plan_id' => $plan_id]);
            $data['all_servicios'] = $all_servicios;

            $this->load_view_admin_g("plan/servicios", $data);
        } else show_404();
    }
    public function add_categoria_index()
    {
        if (!in_array($this->session->userdata('role_id'), [1])) {
            $this->log_out();
            redirect('login/index');
        }

        $all_categorias = $this->plan_categoria->get_all();
        $data['all_categorias'] = $all_categorias;
        $this->load_view_admin_g("plan/categoria", $data);
    }
    public function add_categoria()
    {
        if (!in_array($this->session->userdata('role_id'), [1])) {
            $this->log_out();
            redirect('login/index');
        }
        $titulo = $this->input->post('titulo');
        $descripcion = $this->input->post('descripcion');


        //establecer reglas de validacion
        $this->form_validation->set_rules('titulo', translate('titulo_lang'), 'required');
        $this->form_validation->set_rules('descripcion', translate('add_descripcion_lang'), 'required');
        if ($this->form_validation->run() == FALSE) { //si alguna de las reglas de validacion fallaron
            $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
            redirect("plan/add_categoria_index", "location", 301);
        } else {
            $data = ['titulo' => $titulo, 'descripcion' => $descripcion];

            $this->plan_categoria->create($data);
            $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
            redirect("plan/add_categoria_index", "location", 301);
        }
    }




    public function add_servicios()
    {
        if (!in_array($this->session->userdata('role_id'), [1])) {
            $this->log_out();
            redirect('login/index');
        }
        $plan_id = $this->input->post("plan_id");
        $titulo = $this->input->post('titulo');
        $plan_object = $this->plan->get_by_id($plan_id);


        if (isset($plan_object)) { //en caso de que todo este bien
            $titulo = $this->input->post('titulo');
            $cantidad = $this->input->post('cantidad');

            //establecer reglas de validacion
            $this->form_validation->set_rules('titulo', translate('titulo_lang'), 'required');
            $this->form_validation->set_rules('cantidad', translate('cant_lang'), 'required');
            if ($this->form_validation->run() == FALSE) { //si alguna de las reglas de validacion fallaron
                $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
                redirect("plan/add_servicio_index/" . $plan_id, "location", 301);
            } else {
                $data = ['titulo' => $titulo, 'cantidad' => $cantidad, 'is_active' => 1, 'plan_id' => $plan_id];
                $this->servicio->create($data);
                $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
                redirect("plan/add_servicio_index/" . $plan_id, "location", 301);
            }
        } else {
            show_404();
        }
    }


    public function delete_servicio($servicio_id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1])) {
            $this->log_out();
            redirect('login/index');
        }

        $servicio_object = $this->servicio->get_by_id($servicio_id);

        $plan_id = $servicio_object->plan_id;

        if (isset($servicio_object)) {
            $this->servicio->delete($servicio_id);
            $this->response->set_message(translate('data_deleted_ok'), ResponseMessage::SUCCESS);
            redirect("plan/add_servicio_index/" . $plan_id);
        } else {
            show_404();
        }
    }

    public function destacado($plan_id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1])) {
            $this->log_out();
            redirect('login/index');
        }

        $plan_object = $this->plan->get_by_id($plan_id);

        if ($plan_object) {
            if ($plan_object->destacado == 1)
                $this->plan->update($plan_id, ['destacado' => 0]);
            if ($plan_object->destacado == 0)
                $this->plan->update($plan_id, ['destacado' => 1]);
            $this->response->set_message(translate('data_update_ok'), ResponseMessage::SUCCESS);
            redirect("plan/index");
        } else {
            show_404();
        }
    }

    function update_index_categoria($plan_categoria_id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1])) {
            $this->log_out();
            redirect('login/index');
        }

        $plan_categoria_object = $this->plan_categoria->get_by_id($plan_categoria_id);

        if ($plan_categoria_object) {
            $data['plan_categoria_object'] = $plan_categoria_object;
            $this->load_view_admin_g('plan/update_categoria', $data);
        } else {
            show_404();
        }
    }

    function update_index_servicio($servicio_id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1])) {
            $this->log_out();
            redirect('login/index');
        }

        $plan_servicio_object = $this->servicio->get_by_id($servicio_id);

        if ($plan_servicio_object) {
            $data['plan_servicio_object'] = $plan_servicio_object;
            $this->load_view_admin_g('plan/update_servicio', $data);
        } else {
            show_404();
        }
    }

    public function update_servicio()
    {
        if (!in_array($this->session->userdata('role_id'), [1])) {
            $this->log_out();
            redirect('login/index');
        }

        $titulo = $this->input->post('titulo');
        $cantidad = $this->input->post('cantidad');
        $servicio_id = $this->input->post('servicio_id');

        //establecer reglas de validacion
        $this->form_validation->set_rules('titulo', translate('titulo_lang'), 'required');
        $this->form_validation->set_rules('cantidad', translate('cant_lang'), 'required');
        if ($this->form_validation->run() == FALSE) { //si alguna de las reglas de validacion fallaron
            $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
            redirect("plan/update_index_servicio/" . $servicio_id, "location", 301);
        } else {
            $data = ['titulo' => $titulo, 'cantidad' => $cantidad];

            $this->servicio->update($servicio_id, $data);
            $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
            redirect("plan/index", "location", 301);
        }
    }

    public function update_categoria()
    {
        if (!in_array($this->session->userdata('role_id'), [1])) {
            $this->log_out();
            redirect('login/index');
        }

        $titulo = $this->input->post('titulo');
        $descripcion = $this->input->post('descripcion');
        $plan_categoria_id = $this->input->post('plan_categoria_id');

        //establecer reglas de validacion
        $this->form_validation->set_rules('titulo', translate('titulo_lang'), 'required');
        $this->form_validation->set_rules('descripcion', translate('add_descripcion_lang'), 'required');
        if ($this->form_validation->run() == FALSE) { //si alguna de las reglas de validacion fallaron
            $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
            redirect("plan/update_index_categoria/" . $plan_categoria_id, "location", 301);
        } else {
            $data = ['titulo' => $titulo, 'descripcion' => $descripcion];

            $this->plan_categoria->update($plan_categoria_id, $data);
            $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
            redirect("plan/add_categoria_index", "location", 301);
        }
    }
    public function delete_categoria($plan_categoria_id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1])) {
            $this->log_out();
            redirect('login/index');
        }

        $plan_categoria_object = $this->plan_categoria->get_by_id($plan_categoria_id);
        if ($plan_categoria_object) {
            $this->plan_categoria->delete($plan_categoria_id);
            $this->response->set_message(translate('data_deleted_ok'), ResponseMessage::SUCCESS);
            redirect("plan/add_categoria_index");
        } else {
            show_404();
        }
    }
    public function add_foto()
    {
        if (!in_array($this->session->userdata('role_id'), [1])) {
            $this->log_out();
            redirect('login/index');
        }
        $plan_id = $this->input->post("plan_id");
        $plan_object = $this->plan->get_by_id($plan_id);

        if ($plan_object->foto != "") {
            if (file_exists($plan_object->foto))
                unlink($plan_object->foto);

            $name_file = $_FILES['archivo']['name'];
            $w = 445;
            $h = 342;

            $separado = explode('.', $name_file);
            $ext = end($separado); // me quedo con la extension
            $allow_extension_array = ["JPEG", "JPG", "jpg", "jpeg", "png", "bmp", "gif"];
            $allow_extension = in_array($ext, $allow_extension_array);
            if ($allow_extension) {
                $result = save_image_from_post('archivo', './uploads/planes', time(), $w, $h);
                if ($result[0]) {
                    $data = ['foto' => $result[1]];
                    $this->plan->foto($plan_id, $data);
                    $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
                    redirect("plan/index", "location", 301);
                } else {
                    $this->response->set_message($result[1], ResponseMessage::ERROR);
                    redirect("plan/add_foto_index/" . $plan_id, "location", 301);
                }
            }
        } else {


            $name_file = $_FILES['archivo']['name'];
            $w = 730;
            $h = 342;

            $separado = explode('.', $name_file);
            $ext = end($separado); // me quedo con la extension
            $allow_extension_array = ["JPEG", "JPG", "jpg", "jpeg", "png", "bmp", "gif"];
            $allow_extension = in_array($ext, $allow_extension_array);
            if ($allow_extension) {
                $result = save_image_from_post('archivo', './uploads/planes', time(), $w, $h);
                if ($result[0]) {
                    $data = ['foto' => $result[1]];
                    $this->plan->foto($plan_id, $data);
                    $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
                    redirect("plan/add_index_foto/" . $plan_id, "location", 301);
                } else {
                    $this->response->set_message($result[1], ResponseMessage::ERROR);
                    redirect("plan/index", "location", 301);
                }
            } else {

                $this->response->set_message(translate("not_allow_extension"), ResponseMessage::ERROR);
                redirect("plan/add_foto_index/" . $plan_id, "location", 301);
            }
        }
    }


    public function add_index_foto($plan_id)
    {
        if (!in_array($this->session->userdata('role_id'), [1])) {
            $this->log_out();
            redirect('login/index');
        }

        $foto_object = $this->plan->get_by_id($plan_id);
        $data['foto_object'] = $foto_object;




        $this->load_view_admin_g('plan/foto', $data);
    }
}
