<?php

class Credito extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Credito_model', 'credito');
        $this->load->library(array('session'));
        $this->load->helper("mabuya");

        @session_start();
        $this->load_language();
        $this->init_form_validation();
    }

    public function index_cliente()
    {

        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $all_creditos = $this->credito->get_all_creditos_cliente();


        $data['all_creditos'] = $all_creditos;


        //var_dump($data);
        //die();

        $this->load_view_admin_g("credito/index_cliente", $data);
    }
    public function index_finca()
    {

        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $all_creditos = $this->credito->get_all_creditos_finca();


        $data['all_creditos'] = $all_creditos;


        //var_dump($data);
        //die();

        $this->load_view_admin_g("credito/index_finca", $data);
    }

    public function add_index_cliente()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }
        $this->load->model('Client_model', 'client');
        $this->load->model('Motivo_model', 'motivo');
        $data['clientes'] = $this->client->get_all();
        $data['motivos'] = $this->motivo->get_all();
        $this->load_view_admin_g('credito/add_credito_cliente', $data);
    }
    public function add_index_finca()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }
        $this->load->model('Provider_model', 'provider');
        $this->load->model('Motivo_model', 'motivo');
        $data['providers'] = $this->provider->get_all();
        $data['motivos'] = $this->motivo->get_all();
        $this->load_view_admin_g('credito/add_credito_finca', $data);
    }


    public function add_credito_cliente()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }
        $factura = $this->input->post('facturas');
        $measure = $this->input->post('measure_id');
        $cliente = $this->input->post('cliente');
        $orden = $this->input->post('orden');
        $finca = $this->input->post('fincas');
        $variedad = $this->input->post('variedad');
        $motivo = $this->input->post('motivo');
        $tallos = $this->input->post('tallos');
        $bunches = $this->input->post('bunches');
        if ($bunches == "" || $bunches == NULL) {
            $bunches = 0;
        }
        if ($tallos == "" || $tallos == NULL) {
            $tallos = 0;
        }
        $valor_cliente = $this->input->post('valor_cliente');
        $valor_finca = $this->input->post('valor_finca');
        $nro = $this->input->post('nro_factura');
        $this->load->model('Invoice_provider_model', 'invoice_provider');
        $this->load->model('Invoice_provider_element_model', 'invoice_provider_element');
        $invoice = $this->invoice_provider->get_by_factura($factura, $nro);

        if ($invoice) {
            if ($invoice->fecha_create == "0000-00-00") {
                $fecha_factura = $invoice->date_invoice_carguera;
            } else {
                $fecha_factura = $invoice->fecha_create;
            }
        } else {
            $invoice = $this->invoice_provider_element->get_by_factura($factura, $nro);

            $fecha_factura = $invoice->fecha_create;
        }

        $this->load->model('Request_model', 'request');
        $request = $this->request->get_by_id($orden);
        $fecha_po = $request->date_time_reception;
        //establecer reglas de validacion
        $this->form_validation->set_rules('cliente', translate('client_lang'), 'required');

        if ($this->form_validation->run() == FALSE) { //si alguna de las reglas de validacion fallaron
            $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
            redirect("credito/add_index_cliente", "location", 301);
        } else {
            $data = [
                'nro_factura' => $factura,
                'cliente_id' => $cliente,
                'po' => $orden,
                'provider_id' => $finca,
                'product_id' => $variedad,
                'motivo_id' => $motivo,
                'tallos' => $tallos,
                'bunches' => $bunches,
                'valor_cliente' => $valor_cliente,
                'valor_finca' => $valor_finca,
                'tipo' => 1,
                'is_active' => 1,
                'nro_invoice' => $nro,
                'fecha_factura' => $fecha_factura,
                'fecha_vuelo' => $fecha_po,
                'variedad' => $measure
            ];
            $this->credito->create($data);
            $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
            redirect("credito/index_cliente", "location", 301);
        }
    }
    public function add_credito_finca()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }


        $factura = $this->input->post('facturas');
        $finca = $this->input->post('fincas');
        $variedad = $this->input->post('variedad');
        $motivo = $this->input->post('motivo');
        $tallos = $this->input->post('tallos');
        $bunches = $this->input->post('bunches');
        $valor = $this->input->post('valor');
        $nro = $this->input->post('nro_factura');
        $this->load->model('Invoice_provider_model', 'invoice_provider');
        $this->load->model('Invoice_provider_element_model', 'invoice_provider_element');
        $invoice = $this->invoice_provider->get_by_factura($factura, $nro);

        if ($invoice) {
            if ($invoice->fecha_create == "0000-00-00") {
                $fecha = $invoice->date_invoice_carguera;
            } else {
                $fecha = $invoice->fecha_create;
            }
        } else {
            $invoice = $this->invoice_provider_element->get_by_factura($factura, $nro);
            $fecha = $invoice->fecha_create;
        }
        //establecer reglas de validacion
        $this->form_validation->set_rules('fincas', translate('finca_lang'), 'required');


        if ($this->form_validation->run() == FALSE) { //si alguna de las reglas de validacion fallaron
            $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
            redirect("credito/add_index_finca", "location", 301);
        } else {
            $data = [
                'nro_factura' => $factura,
                'provider_id' => $finca,
                'product_id' => $variedad,
                'motivo_id' => $motivo,
                'tallos' => $tallos,
                'valor' => $valor,
                'tipo' => 2,
                'is_active' => 1,
                'nro_invoice' => $nro,
                'fecha_factura' => $fecha,
                'bunches' => $bunches
            ];
            $this->credito->create($data);
            $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
            redirect("credito/index_finca", "location", 301);
        }
    }

    public function update_credito_cliente()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }
        $credito_id = $this->input->post('credito_id');
        $factura = $this->input->post('facturas');
        $measure = $this->input->post('measure_id');
        $cliente = $this->input->post('cliente');
        $orden = $this->input->post('orden');
        $finca = $this->input->post('fincas');
        $variedad = $this->input->post('variedad');
        $motivo = $this->input->post('motivo');
        $tallos = $this->input->post('tallos');
        $bunches = $this->input->post('bunches');
        if ($bunches == "" || $bunches == NULL) {
            $bunches = 0;
        }
        if ($tallos == "" || $tallos == NULL) {
            $tallos = 0;
        }
        $valor_cliente = $this->input->post('valor_cliente');
        $valor_finca = $this->input->post('valor_finca');
        $nro = $this->input->post('nro_factura');
        $this->load->model('Invoice_provider_model', 'invoice_provider');
        $this->load->model('Invoice_provider_element_model', 'invoice_provider_element');
        $invoice = $this->invoice_provider->get_by_factura($factura, $nro);

        if ($invoice) {
            if ($invoice->fecha_create == "0000-00-00") {
                $fecha_factura = $invoice->date_invoice_carguera;
            } else {
                $fecha_factura = $invoice->fecha_create;
            }
        } else {
            $invoice = $this->invoice_provider_element->get_by_factura($factura, $nro);

            $fecha_factura = $invoice->fecha_create;
        }

        $this->load->model('Request_model', 'request');
        $request = $this->request->get_by_id($orden);
        $fecha_po = $request->date_time_reception;
        //establecer reglas de validacion
        $this->form_validation->set_rules('cliente', translate('client_lang'), 'required');


        if ($this->form_validation->run() == FALSE) { //si alguna de las reglas de validacion fallaron
            $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
            redirect("credito/update_index_cliente", "location", 301);
        } else {
            $data = [
                'nro_factura' => $factura,
                'cliente_id' => $cliente,
                'po' => $orden,
                'provider_id' => $finca,
                'product_id' => $variedad,
                'motivo_id' => $motivo,
                'tallos' => $tallos,
                'bunches' => $bunches,
                'valor_cliente' => $valor_cliente,
                'valor_finca' => $valor_finca,
                'tipo' => 1,
                'is_active' => 1,
                'nro_invoice' => $nro,
                'fecha_factura' => $fecha_factura,
                'fecha_vuelo' => $fecha_po,
                'variedad' => $measure
            ];
            $this->credito->update($credito_id, $data);
            $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
            redirect("credito/index_cliente", "location", 301);
        }
    }
    public function update_credito_finca()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }


        $factura = $this->input->post('facturas');
        $credito_id = $this->input->post('credito_id');
        $finca = $this->input->post('fincas');
        $variedad = $this->input->post('variedad');
        $motivo = $this->input->post('motivo');
        $tallos = $this->input->post('tallos');
        $bunches = $this->input->post('bunches');
        $valor = $this->input->post('valor');
        $nro = $this->input->post('nro_factura');
        $this->load->model('Invoice_provider_model', 'invoice_provider');
        $this->load->model('Invoice_provider_element_model', 'invoice_provider_element');
        $invoice = $this->invoice_provider->get_by_factura($factura, $nro);

        if ($invoice) {
            if ($invoice->fecha_create == "0000-00-00") {
                $fecha = $invoice->date_invoice_carguera;
            } else {
                $fecha = $invoice->fecha_create;
            }
        } else {
            $invoice = $this->invoice_provider_element->get_by_factura($factura, $nro);
            $fecha = $invoice->fecha_create;
        }
        //establecer reglas de validacion
        $this->form_validation->set_rules('fincas', translate('finca_lang'), 'required');

        if ($this->form_validation->run() == FALSE) { //si alguna de las reglas de validacion fallaron
            $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
            redirect("credito/update_index_finca", "location", 301);
        } else {
            $data = [
                'nro_factura' => $factura,
                'provider_id' => $finca,
                'product_id' => $variedad,
                'motivo_id' => $motivo,
                'tallos' => $tallos,
                'valor' => $valor,
                'nro_invoice' => $nro,
                'bunches' => $bunches,
                'fecha_factura' => $fecha
            ];
            $this->credito->update($credito_id, $data);
            $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
            redirect("credito/index_finca", "location", 301);
        }
    }
    function update_index_cliente($credito_id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $credito_object = $this->credito->get_by_id($credito_id);

        if ($credito_object) {
            $this->load->model('client_model', 'client');
            $this->load->model('Motivo_model', 'motivo');
            $data['clientes'] = $this->client->get_all();
            $data['motivos'] = $this->motivo->get_all();
            $data['credito_object'] = $credito_object;

            $this->load_view_admin_g('credito/update_credito_cliente', $data);
        } else {
            show_404();
        }
    }
    function update_index_finca($credito_id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $credito_object = $this->credito->get_by_id($credito_id);

        if ($credito_object) {
            $this->load->model('Provider_model', 'provider');
            $this->load->model('Motivo_model', 'motivo');
            $data['providers'] = $this->provider->get_all();
            $data['motivos'] = $this->motivo->get_all();
            $data['credito_object'] = $credito_object;

            $this->load_view_admin_g('credito/update_credito_finca', $data);
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
    public function delete($credito_id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $credito_object = $this->credito->get_by_id($credito_id);
        if ($credito_object) {
            $this->credito->delete($credito_id);
            $this->response->set_message(translate('data_deleted_ok'), ResponseMessage::SUCCESS);
            redirect("credito/index_cliente");
        } else {
            show_404();
        }
    }
    public function delete_credito($credito_id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $credito_object = $this->credito->get_by_id($credito_id);
        if ($credito_object) {
            $this->credito->update($credito_id, ['is_active' => 0]);
            $this->response->set_message(translate('data_deleted_ok'), ResponseMessage::SUCCESS);
            redirect("credito/index_cliente");
        } else {
            show_404();
        }
    }

    public function get_po()
    {

        $this->load->model('Request_model', 'request');

        $cliente = $this->input->post('cliente');
        $result = $this->request->get_po_by_cliente($cliente);

        echo json_encode($result);
        exit();
    }
    public function get_fincas()
    {

        $this->load->model('Request_model', 'request');
        $this->load->model('Buy_model', 'buy');
        $this->load->model('Buy_element_model', 'buy_element');
        $po = $this->input->post('po');
        $buy = $this->buy->get_buy_by_request_id($po);
        $buy_element = $this->buy_element->get_provider_by_buy($buy->buy_id);

        echo json_encode($buy_element);
        exit();
    }
    public function get_variedades()
    {

        $this->load->model('Request_model', 'request');
        $this->load->model('Request_product_model', 'request_product');
        $this->load->model('Buy_model', 'buy');
        $this->load->model('Buy_element_model', 'buy_element');
        $finca = $this->input->post('pro');
        $request_id = $this->input->post('po');
        $result = $this->request_product->get_products_by_provider($finca, $request_id);

        echo json_encode($result);
        exit();
    }
    public function get_credito()
    {

        $finca = $this->input->post('provider');
        $request_id = $this->input->post('po');
        $product = $this->input->post('product');
        $result = $this->credito->get_credito_by_ids($product, $finca, $request_id);

        echo json_encode($result);
        exit();
    }
    public function get_facturas()
    {
        $this->load->model('Buy_element_model', 'buy_element');
        $this->load->model('Invoice_provider_model', 'invoice_provider');
        $this->load->model('Invoice_provider_element_model', 'invoice_provider_element');

        $finca = $this->input->post('fincas');
        $request_id = $this->input->post('request_id');
        $array = [];
        $facturas_element = [];
        $facturas = $this->invoice_provider->get_facturas_by_provider_2($finca, $request_id);
        $result = $this->buy_element->get_by_id_elementos_provider($finca, $request_id);
        foreach ($result as $item) {
            $objecto = $this->invoice_provider_element->get_buy_element_by_id($item->buy_element_id);
            if ($objecto) {
                array_push($facturas_element, $objecto);
            }
        }
        foreach ($facturas_element as $item) {
            $obj =  new \stdClass;
            $obj->nro_invoice = $item->nro_invoice;
            $obj->id =  $item->invoice_provider_element_id;
            array_push($array, $obj);
        }

        foreach ($facturas as $factura) {
            if ($factura->nro_invoice != "") {
                $obj =  new \stdClass;
                $obj->nro_invoice = $factura->nro_invoice;
                $obj->id =  $factura->invoice_provider_id;
                array_push($array, $obj);
            }
        }
        echo json_encode($array);
        exit();
    }
    public function get_variedades_finca()
    {
        $this->load->model('Invoice_provider_element_model', 'invoice_provider_element');
        $this->load->model('Invoice_provider_model', 'invoice_provider');
        $this->load->model('Buy_element_model', 'buy_element');
        $array = [];
        $factura_id = $this->input->post('factura_id');
        $factura = $this->input->post('factura');
        $result = $this->invoice_provider_element->get_by_factura($factura_id, $factura);
        if ($result) {
            $product = $this->buy_element->get_productos_by_buy_element($result->buy_element_id);

            if (strpos($product->product, 'ROSE') !== false || strpos($product->product, 'ASSORTED') !== false) {
                $cajas = $this->buy_element->get_box_element_id($result->buy_element_id);
                if ($cajas) {
                    foreach ($cajas as $caja) {
                        $caja->element = $this->buy_element->get_element_by_id($caja->box_element_id);
                    }

                    foreach ($cajas as $item) {
                        foreach ($item->element as $elemento) {
                            array_push($array, $elemento);
                        }
                    }
                }
                if (count($array) > 0) {
                    $product = $array;
                }
            }
        } else {
            $result_2 = $this->invoice_provider->get_by_factura($factura_id, $factura);
            $product = $this->buy_element->get_buy_elements($result_2->buy_id, $result_2->provider_id);
            if ($product) {
                foreach ($product as $item) {
                    if (strpos($item->product, 'ROSE') !== false || strpos($item->product, 'ASSORTED') !== false) {
                        $cajas = $this->buy_element->get_box_element_id($item->buy_element_id);
                        if ($cajas) {
                            foreach ($cajas as $caja) {
                                $caja->element = $this->buy_element->get_element_by_id($caja->box_element_id);
                            }

                            foreach ($cajas as $item) {
                                foreach ($item->element as $elemento) {
                                    array_push($array, $elemento);
                                }
                            }
                        } else {
                            array_push($array, $item);
                        }
                    } else {
                        array_push($array, $item);
                    }
                }
                if (count($array) > 0) {
                    $product = $array;
                }
            }
        }

        echo json_encode($product);
        exit();
    }
    public function get_credito_finca()
    {

        $finca = $this->input->post('provider');
        $product = $this->input->post('product');
        $nro = $this->input->post('nro');
        $result = $this->credito->get_credito_by_ids_2($product, $finca, $nro);

        echo json_encode($result);
        exit();
    }
    public function convertir()
    {
        $array_archivos = [];
        $directorio = opendir("uploads/noticia"); //ruta actual
        while ($archivo = readdir($directorio)) //obtenemos un archivo y luego otro sucesivamente
        {

            if (is_dir($archivo)) //verificamos si es o no un directorio
            {
                echo "[" . $archivo . "]<br />"; //de ser un directorio lo envolvemos entre corchetes
            } else {
                $obj =  new \stdClass;
                $obj->archivo = $archivo;
                $archivo = "uploads/noticia/" . $archivo;
                $obj->ruta = $archivo;

                array_push($array_archivos, $obj);
                echo $archivo . "<br />";
            }
        }
        foreach ($array_archivos as $item) {
            $name_file =   $item->archivo;
            $separado = explode('.', $name_file);
            $ext = end($separado); // me quedo con la extension
            if ($ext == "JPG") {
                rename($item->ruta, "uploads/noticia/" . $separado[0] . ".jpg");
            }
        }
        $directorio = opendir("uploads/noticia"); //ruta actual
        while ($archivo = readdir($directorio)) //obtenemos un archivo y luego otro sucesivamente
        {

            if (is_dir($archivo)) //verificamos si es o no un directorio
            {
                echo "[" . $archivo . "]<br />"; //de ser un directorio lo envolvemos entre corchetes
            } else {
                $obj =  new \stdClass;
                $obj->archivo = $archivo;
                $archivo = "uploads/noticia/" . $archivo;
                $obj->ruta = $archivo;

                array_push($array_archivos, $obj);
                echo $archivo . "<br />";
            }
        }
    }
    public function get_facturas_prueba()
    {
        $this->load->model('Buy_element_model', 'buy_element');
        $this->load->model('Invoice_provider_model', 'invoice_provider');
        $this->load->model('Invoice_provider_element_model', 'invoice_provider_element');

        $finca = $this->input->post('fincas');
        $request_id = $this->input->post('request_id');
        $array = [];
        $facturas_element = [];
        $facturas = $this->invoice_provider->get_facturas_by_provider_2(33, 856);
        $facturas =     $this->invoice_provider_element->get_by_factura(1576, 7110);
        $result = $this->buy_element->get_by_id_elementos_provider(33, 856);
        $result_2 = $this->invoice_provider->get_by_factura(1576, 7110);
        $product = $this->buy_element->get_buy_elements($result_2->buy_id, $result_2->provider_id);
        var_dump($product);
        die();
        if ($product) {
            foreach ($product as $item) {
                if (strpos($item->product, 'ROSE') !== false || strpos($item->product, 'ASSORTED') !== false) {
                    $cajas = $this->buy_element->get_box_element_id($item->buy_element_id);
                    var_dump($cajas);
                    die();
                    if ($cajas) {
                        foreach ($cajas as $caja) {
                            $caja->element = $this->buy_element->get_element_by_id($caja->box_element_id);
                        }

                        foreach ($cajas as $item) {
                            foreach ($item->element as $elemento) {
                                array_push($array, $elemento);
                            }
                        }
                    } else {
                        array_push($array, $item);
                    }
                } else {
                    array_push($array, $item);
                }
            }
            if (count($array) > 0) {
                $product = $array;
            }
        }

        foreach ($result as $item) {
            $objecto = $this->invoice_provider_element->get_buy_element_by_id($item->buy_element_id);
            if ($objecto) {
                array_push($facturas_element, $objecto);
            }
        }
        foreach ($facturas_element as $item) {
            $obj =  new \stdClass;
            $obj->nro_invoice = $item->nro_invoice;
            $obj->id =  $item->invoice_provider_element_id;
            array_push($array, $obj);
        }

        foreach ($facturas as $factura) {
            if ($factura->nro_invoice != "") {
                $obj =  new \stdClass;
                $obj->nro_invoice = $factura->nro_invoice;
                $obj->id =  $factura->invoice_provider_id;
                array_push($array, $obj);
            }
        }
        var_dump($array);
        die();
    }

    public function exportar_creditos()
    {
        $this->load->library("excel");
        $object = new PHPExcel();


        $fecha_inicio = date('Y-m-d', strtotime($this->input->post('fecha_inicio_credito')));
        $fecha_fin = date('Y-m-d', strtotime($this->input->post('fecha_fin_credito')));
        $cliente_id = $this->input->post('clientes_credito');

        $this->load->model('Empresa_model', 'company');
        $this->load->model('Client_model', 'cliente');
        $this->load->model('Credito_model', 'credito');

        $result = $this->credito->get_all_creditos_cliente_by_date_exportar($fecha_inicio, $fecha_fin, $cliente_id);

        if ($cliente_id > 0) {
            $cliente_object = $this->cliente->get_by_id($cliente_id);
        }

        $object->setActiveSheetIndex(0)->mergeCells('A3:D3');
        $object->setActiveSheetIndex(0)->mergeCells('E3:G3');
        $object->setActiveSheetIndex(0)->mergeCells('A4:D4');
        $object->setActiveSheetIndex(0)->mergeCells('E4:G4');
        //  $object->setActiveSheetIndex(0)->mergeCells('A2:B2');
        $gdImage = imagecreatefromjpeg('assets/nuevo.jpg');
        // Add a drawing to the worksheetecho date('H:i:s') . " Add a drawing to the worksheet\n";
        $objDrawing = new PHPExcel_Worksheet_MemoryDrawing();
        $objDrawing->setName('Sample image');
        $objDrawing->setDescription('Sample image');
        $objDrawing->setImageResource($gdImage);
        $objDrawing->setRenderingFunction(PHPExcel_Worksheet_MemoryDrawing::RENDERING_JPEG);
        $objDrawing->setMimeType(PHPExcel_Worksheet_MemoryDrawing::MIMETYPE_DEFAULT);
        $objDrawing->setHeight(60);
        $objDrawing->setCoordinates('A3');
        $objDrawing->setWorksheet($object->getActiveSheet());
        $object->getActiveSheet()->getRowDimension('3')->setRowHeight(60);
        $object->getActiveSheet()->getStyle("A5")->getFont()->setBold(true);

        $object->getActiveSheet()->setCellValueByColumnAndRow(4, 3, "Rango de fechas: " . $fecha_inicio . " / " . $fecha_fin);
        if ($cliente_id == 0) {
            $object->getActiveSheet()->setCellValueByColumnAndRow(4, 4,  "Todos los clientes");
        } else {
            $object->getActiveSheet()->setCellValueByColumnAndRow(4, 4,  $cliente_object->cliente_name);
        }
        //  $objWorksheet->getActiveSheet()->getColumnDimension('A')->setWidth(100);
        $table_columns = array("FECHA DE VUELO","PO", "CLIENTE", "FINCA","No. FACTURA", "VARIEDAD", "No. BUNCHES", "No. TALLOS", "MOTIVO", "VALOR FINCA", "VALOR CLIENTE");

        $column = 0;

        foreach ($table_columns as $field) {
            $object->getActiveSheet()->setCellValueByColumnAndRow($column, 5, $field);
            $column++;
        }
        for ($col = 'A'; $col != 'L'; $col++) {
            $object->getActiveSheet()->getColumnDimension($col)->setAutoSize(true);
        }

        $estilo = array(
            'borders' => array(
                'outline' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );
        $object->getActiveSheet()->getStyle("E3")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $object->getActiveSheet()->getStyle("E3")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);


        $object->getActiveSheet()->getStyle('A3:O3')->applyFromArray($estilo);
        $object->getActiveSheet()->getStyle('A4:O4')->applyFromArray($estilo);
        $object->getActiveSheet()->getStyle('A5')->applyFromArray($estilo);
        $object->getActiveSheet()->getStyle('B5')->applyFromArray($estilo);
        $object->getActiveSheet()->getStyle('C5')->applyFromArray($estilo);
        $object->getActiveSheet()->getStyle('D5')->applyFromArray($estilo);
        $object->getActiveSheet()->getStyle('E5')->applyFromArray($estilo);
        $object->getActiveSheet()->getStyle('F5')->applyFromArray($estilo);
        $object->getActiveSheet()->getStyle('G5')->applyFromArray($estilo);
        $object->getActiveSheet()->getStyle('H5')->applyFromArray($estilo);
        $object->getActiveSheet()->getStyle('I5')->applyFromArray($estilo);
        $object->getActiveSheet()->getStyle('J5')->applyFromArray($estilo);
        $object->getActiveSheet()->getStyle('K5')->applyFromArray($estilo);
        $object->getActiveSheet()->getStyle("A3:O3")->getFont()->setBold(true);
        $object->getActiveSheet()->getStyle("A4:O4")->getFont()->setBold(true);
        $object->getActiveSheet()->getStyle("A5:O5")->getFont()->setBold(true);

        $excel_row = 6;
        $count = 0;
        foreach ($result as $item) {
            $count++;
            $object->getActiveSheet()->getStyle('A' . $excel_row)->applyFromArray($estilo);
            $object->getActiveSheet()->getStyle('B' . $excel_row)->applyFromArray($estilo);
            $object->getActiveSheet()->getStyle('C' . $excel_row)->applyFromArray($estilo);
            $object->getActiveSheet()->getStyle('D' . $excel_row)->applyFromArray($estilo);
            $object->getActiveSheet()->getStyle('E' . $excel_row)->applyFromArray($estilo);
            $object->getActiveSheet()->getStyle('F' . $excel_row)->applyFromArray($estilo);
            $object->getActiveSheet()->getStyle('G' . $excel_row)->applyFromArray($estilo);
            $object->getActiveSheet()->getStyle('H' . $excel_row)->applyFromArray($estilo);
            $object->getActiveSheet()->getStyle('I' . $excel_row)->applyFromArray($estilo);
            $object->getActiveSheet()->getStyle('J' . $excel_row)->applyFromArray($estilo);
            $object->getActiveSheet()->getStyle('K' . $excel_row)->applyFromArray($estilo);
            $object->getActiveSheet()->getStyle('J' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
            $object->getActiveSheet()->getStyle('k' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
            $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $item->fecha_vuelo);
            $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $item->purchase_order);
            $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $item->cliente);
            $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $item->provider);
            $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $item->nro_factura);
            $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $item->variedad);
            $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, (int) $item->bunches);
            $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, (int) $item->tallos);
            $object->getActiveSheet()->setCellValueByColumnAndRow(8, $excel_row, $item->motivo);
            $object->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row, (float) $item->valor_finca);
            $object->getActiveSheet()->setCellValueByColumnAndRow(10, $excel_row, (float) $item->valor_cliente);
            $excel_row++;
        }
        $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        if ($cliente_id == 0) {
            header('Content-Disposition: attachment;filename="Reporte de creditos.xls"');
        } else {
            header('Content-Disposition: attachment;filename="Reporte de creditos ' . $cliente_object->cliente_name . '.xls"');
        }
        ob_end_clean();
        ob_start();

        $object_writer->save('php://output');
    }
}
