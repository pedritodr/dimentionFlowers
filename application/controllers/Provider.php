<?php

class Provider extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Provider_model', 'provider');
        $this->load->library(array('session'));
        $this->load->helper("mabuya");

        @session_start();
        $this->load_language();
        $this->init_form_validation();
    }

    public function index()
    {

        if (!in_array($this->session->userdata('role_id'), [1, 2, 4])) {
            $this->log_out();
            redirect('login/index');
        }
        $this->load->model('Product_model', 'product');
        $all_providers = $this->provider->get_all(['is_active' => 0]);
        $this->session->set_userdata('providers', $all_providers);
        foreach ($all_providers as $provider) {
            $provider->products = $this->provider->get_all_products_by_provider($provider->provider_id);
            $provider->categories =  $this->provider->get_all_categorias_by_provider($provider->provider_id);
        }


        $data['all_providers'] = $all_providers;

        $this->load_view_admin_g("provider/index", $data);
    }

    public function add_index()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2, 4])) {
            $this->log_out();
            redirect('login/index');
        }


        $this->load_view_admin_g('provider/add');
    }

    public function add()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2, 4])) {
            $this->log_out();
            redirect('login/index');
        }

        $name = $this->input->post('name');
        $identificacion = $this->input->post('identificacion');
        $email = $this->input->post('email');
        $phone = $this->input->post('phone');
        $person_payment = $this->input->post('person_payment');
        $banking = $this->input->post('banking');
        $additional = $this->input->post('additional');
        $varieties = $this->input->post('varieties');
        $address = $this->input->post('address');
        $seller = $this->input->post('seller');
        $email_seller = $this->input->post('email_seller');
        $phone_seller = $this->input->post('phone_seller');
        $email_payment = $this->input->post('email_payment');
        $phone_payment = $this->input->post('phone_payment');
        $skype_seller = $this->input->post('skype_seller');
        $skype_payment = $this->input->post('skype_payment');
        $name_commercial = $this->input->post('nombre_comercial');



        $data = ['name' => $name, 'tax_id' => $identificacion, 'email' => $email, 'phone' => $phone, 'address' => $address, 'seller' => $seller, 'phone_seller' => $phone_seller, 'skype_seller' => $skype_seller, 'email_seller' => $email_seller, 'person_payment' => $person_payment, 'email_payment ' => $email_payment, 'phone_payment   ' => $phone_payment, 'skype_payment   ' => $skype_payment, 'data_banking' => $banking, 'data_additional' => $additional, 'name_commercial' => $name_commercial, 'is_active' => 0];
        $this->provider->create($data);

        $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
        redirect("provider/index", "location", 301);
    }

    function update_index($provider_id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2, 4])) {
            $this->log_out();
            redirect('login/index');
        }

        $provider_object = $this->provider->get_by_id($provider_id);
        $this->load->model('Product_model', 'product');
        $all_products = $this->product->get_all_products_measure();

        $data['all_products'] = $all_products;


        if ($provider_object) {
            $data['provider_object'] = $provider_object;
            // $products = $this->provider->get_all_products_by_provider_simple($provider_id);
            //  $data['products'] = $products;

            $this->load_view_admin_g('provider/update', $data);
        } else {
            show_404();
        }
    }
    function ver_index($provider_id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2, 4])) {
            $this->log_out();
            redirect('login/index');
        }

        $provider_object = $this->provider->get_by_id($provider_id);
        $this->load->model('Product_model', 'product');
        $all_products = $this->product->get_all_products_measure();

        $data['all_products'] = $all_products;


        if ($provider_object) {
            $data['provider_object'] = $provider_object;
            // $products = $this->provider->get_all_products_by_provider_simple($provider_id);
            //  $data['products'] = $products;

            $this->load_view_admin_g('provider/ver_detalle', $data);
        } else {
            show_404();
        }
    }
    public function update()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2, 4])) {
            $this->log_out();
            redirect('login/index');
        }

        $name = $this->input->post('name');
        $identificacion = $this->input->post('identificacion');
        $email = $this->input->post('email');
        $phone = $this->input->post('phone');
        $person_payment = $this->input->post('person_payment');
        $banking = $this->input->post('banking');
        $additional = $this->input->post('additional');
        $varieties = $this->input->post('varieties');
        $address = $this->input->post('address');
        $seller = $this->input->post('seller');
        $email_seller = $this->input->post('email_seller');
        $phone_seller = $this->input->post('phone_seller');
        $email_payment = $this->input->post('email_payment');
        $phone_payment = $this->input->post('phone_payment');
        $skype_seller = $this->input->post('skype_seller');
        $skype_payment = $this->input->post('skype_payment');
        $name_commercial = $this->input->post('nombre_comercial');

        $provider_id = $this->input->post('provider_id');

        $provider_object = $this->provider->get_by_id($provider_id);

        if ($provider_object) {

            $data = ['name' => $name, 'tax_id' => $identificacion, 'email' => $email, 'phone' => $phone, 'address' => $address, 'seller' => $seller, 'phone_seller' => $phone_seller, 'skype_seller' => $skype_seller, 'email_seller' => $email_seller, 'person_payment' => $person_payment, 'email_payment ' => $email_payment, 'phone_payment   ' => $phone_payment, 'skype_payment   ' => $skype_payment, 'data_banking' => $banking, 'data_additional' => $additional, 'name_commercial' => $name_commercial];

            $this->provider->update($provider_id, $data);

            $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
            redirect("provider/index", "location", 301);
        }
    }
    public function delete($provider_id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2, 4])) {
            $this->log_out();
            redirect('login/index');
        }

        $provider_object = $this->provider->get_by_id($provider_id);
        if ($provider_object) {
            $data = [
                'is_active' => 1,
            ];
            $this->provider->update($provider_id, $data);

            $this->response->set_message(translate('data_deleted_ok'), ResponseMessage::SUCCESS);
            redirect("provider/index");
        } else {
            show_404();
        }
    }
    function products($provider_id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2, 4])) {
            $this->log_out();
            redirect('login/index');
        }
        $this->load->model('Measure_model', 'measure');
        $this->load->model('Product_category_model', 'category');
        $this->load->model('Product_model', 'product');
        $object_provider = $this->provider->get_by_id($provider_id);
        if ($object_provider) {
            $all_products = $this->provider->get_all_products_by_provider($provider_id);

            $result_products  = $this->provider->get_all_products_by_provider_simple($provider_id);
            $all_categories = $this->category->get_all();
            $lista_products = $this->product->get_all(['status' => 1]);

            $data['lista_products'] = $lista_products;
            $data['result_products'] = $result_products;
            $data['all_categories'] = $all_categories;
            $data['all_products'] = $all_products;
            $data['provider_id'] = $provider_id;

            $this->load_view_admin_g('provider/products', $data);
        } else {
            show_404();
        }
    }
    function ver_products($provider_id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2, 4])) {
            $this->log_out();
            redirect('login/index');
        }
        $this->load->model('Measure_model', 'measure');
        $this->load->model('Product_category_model', 'category');
        $this->load->model('Product_model', 'product');
        $object_provider = $this->provider->get_by_id($provider_id);
        if ($object_provider) {
            $all_products = $this->provider->get_all_products_by_provider($provider_id);


            $all_categories = $this->category->get_all();
            $lista_products = $this->product->get_all(['status' => 1], false, 'name', 'asc', false, false, 0);

            $data['lista_products'] = $lista_products;
            $data['all_categories'] = $all_categories;
            $data['all_products'] = $all_products;
            $data['provider_id'] = $provider_id;

            $this->load_view_admin_g('provider/ver_products', $data);
        } else {
            show_404();
        }
    }
    function products_add($provider_id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2, 4])) {
            $this->log_out();
            redirect('login/index');
        }
        $this->load->model('Product_model', 'product');
        $this->load->model('Measure_model', 'measure');
        $this->load->model('Product_category_model', 'category');


        $object_provider = $this->provider->get_by_id($provider_id);
        if ($object_provider) {

            $all_products = $this->product->get_all(['status' => 1]);
            $all_measures = $this->measure->get_all();
            $all_categories = $this->category->get_all();

            $data['all_measures'] = $all_measures;

            $data['all_categories'] = $all_categories;

            $data['all_products'] = $all_products;

            $data['provider_id'] = $provider_id;

            $this->load_view_admin_g('provider/add_product', $data);
        } else {
            show_404();
        }
    }
    function add_product($provider_id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2, 4])) {
            $this->log_out();
            redirect('login/index');
        }

        $provider_id  = $this->input->post('provider_id');
        $products  = $this->input->post('variety');
        $object_provider = $this->provider->get_by_id($provider_id);
        if ($object_provider) {
            //establecer reglas de validacion
            if ($products) {
                if (count($products) > 0) {
                    $this->provider->create_provider_products_array($provider_id, $products);
                    $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
                    redirect("provider/products/" . $provider_id, "location", 301);
                } else {
                    $this->response->set_message("Selecciones las variedades", ResponseMessage::ERROR);
                    redirect("provider/products/" . $provider_id, "location", 301);
                }
            } else {
                $this->response->set_message("Selecciones las variedades", ResponseMessage::ERROR);
                redirect("provider/products/" . $provider_id, "location", 301);
            }
        } else {
            show_404();
        }
    }
    function update_product_index($provider_product_id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2, 4])) {
            $this->log_out();
            redirect('login/index');
        }
        $this->load->model('Product_model', 'product');
        $this->load->model('Measure_model', 'measure');
        $this->load->model('Product_category_model', 'category');
        $object_provider_product = $this->provider->get_by_id_provider_product($provider_product_id);
        if ($object_provider_product) {
            $object_product =  $this->product->get_by_id($object_provider_product->product_id);
            $all_products = $this->product->get_all(['status' => 1]);
            $all_measures = $this->measure->get_all();
            $object_provider_product = $this->provider->get_by_id_provider_product($provider_product_id);
            //$object_meaures = $this->provider->get_all_products_by_provider_simple($provider_product_id);
            $all_categories = $this->category->get_all();

            $data['object_product'] = $object_product;
            $data['all_categories'] = $all_categories;
            $data['all_measures'] = $all_measures;
            $data['all_products'] = $all_products;
            $data['provider_id'] = $object_provider_product->provider_id;
            $data['object_provider_product'] = $object_provider_product;
            // $data['object_meaures'] = $object_meaures;

            $this->load_view_admin_g('provider/update_product', $data);
        } else {
            show_404();
        }
    }

    function update_product()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2, 4])) {
            $this->log_out();
            redirect('login/index');
        }
        $measure  = $this->input->post('medida');
        $provider_id  = $this->input->post('provider_id');
        $provider_product_id  = $this->input->post('provider_product_id');
        $object_provider_product = $this->provider->get_by_id_provider_product($provider_product_id);

        $product_id  = $this->input->post('variety');

        //establecer reglas de validacion
        $this->form_validation->set_rules('medida', translate('measures_lang'), 'required');
        $this->form_validation->set_rules('variety', translate('varieties_lang'), 'required');

        if ($this->form_validation->run() == FALSE) { //si alguna de las reglas de validacion fallaron
            $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
            redirect("provider/update_product_index/" . $provider_product_id, "location", 301);
        } else {
            if ($object_provider_product) {
                $data = ['product_id' => $product_id];
                $this->provider->update_product($provider_product_id, $data);
                $this->provider->create_provider_products_measure_array($provider_product_id, $measure);
                $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
                redirect("provider/products/" . $provider_id, "location", 301);
            } else {
                show_404();
            }
        }
    }
    public function delete_provider_product($provider_product_id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2, 4])) {
            $this->log_out();
            redirect('login/index');
        }

        $provider_product_object = $this->provider->get_by_id_provider_product($provider_product_id);
        if ($provider_product_object) {
            $this->provider->delete_provider_product($provider_product_id);
            // $this->provider->delete_provider_product_measure($provider_product_id);
            $this->response->set_message(translate('data_deleted_ok'), ResponseMessage::SUCCESS);
            redirect("provider/products/" . $provider_product_object->provider_id, "location", 301);
        } else {
            show_404();
        }
    }
    public function get_product_by_category()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2, 4])) {
            $this->log_out();
            redirect('login/index');
        }

        $this->load->model('Product_model', 'product');
        $id = $this->input->post('id');
        $provider_id = $this->input->post('provider_id');
        $all_products   = $this->provider->get_products_by_category($id);
        $lista_products = $this->provider->get_all_products_by_provider_ids($provider_id);
        $all_products_ids = [];

        if ($lista_products) {
            foreach ($all_products as $item) {
                if (!in_array($item->product_id, $lista_products)) {

                    $o = new stdClass;
                    $o->product_id = $item->product_id;
                    $o->name = $item->name;

                    array_push($all_products_ids, $o);
                }
            }

            echo json_encode($all_products_ids);
            exit();
        } else {
            echo json_encode($all_products);
            exit();
        }
    }
    public function get_all_measures()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2, 4])) {
            $this->log_out();
            redirect('login/index');
        }
        $this->load->model('Measure_model', 'measure');
        $all_measures = $this->measure->get_all();

        echo json_encode($all_measures);
        exit();
    }
}
