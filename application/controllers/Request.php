<?php

class Request extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Request_model', 'request');
        $this->load->model('Product_model', 'product');

        $this->load->model('Request_product_box_model', 'request_product_box');
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
        $this->load->model('Destination_model', 'destination');
        $this->load->model('Type_box_model', 'type_box');
        $this->load->model('Carguera_model', 'carguera');
        $this->load->model('Measure_model', 'measure');
        $all_cargueras = $this->carguera->get_all();
        $all_type_box = $this->type_box->get_all();
        $all_destinations = $this->destination->get_all();
        $all_measures = $this->measure->get_all();
        $data['all_cargueras'] = $all_cargueras;
        $data['all_type_box'] = $all_type_box;
        $data['all_destinations'] = $all_destinations;
        $data['all_measures'] = $all_measures;
        $all_requests = $this->request->get_all_request();
        /*   foreach ($all_requests as $item) {
            $item->invoice_object = $this->request->get_invoice_by_request($item->request_id);
        } */

        $data['all_requests'] = $all_requests;

        $this->load_view_admin_g("request/index", $data);
    }
    public function pedido_index($request_id)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2, 4])) {
            $this->log_out();
            redirect('login/index');
        }
        $this->load->model('Product_model', 'product');
        $this->load->model('Client_model', 'cliente');
        $this->load->model('Destination_model', 'destination');
        $this->load->model('Type_box_model', 'type_box');
        $this->load->model('Product_category_model', 'product_category');
        $this->load->model('Carguera_model', 'carguera');
        $this->load->model('Measure_model', 'measure');
        $this->load->model('Request_model', 'request');
        $pedido_object = $this->request->get_by_id($request_id);
        $all_pedido = $this->request->get_request_by_id($request_id);
        //  var_dump($all_pedido);
        //die();
        $id = $this->input->post('category');

        $all_cargueras = $this->carguera->get_all();
        $all_type_box = $this->type_box->get_all();
        $all_clientes = $this->cliente->get_all();
        $all_destinations = $this->destination->get_all();
        $all_measures = $this->measure->get_all();

        $all_product_category = $this->product_category->get_all(['is_active' => 1]);

        $data['all_cargueras'] = $all_cargueras;
        $data['all_product_category'] = $all_product_category;
        $data['all_type_box'] = $all_type_box;
        $data['all_destinations'] = $all_destinations;
        $data['all_clientes'] = $all_clientes;
        $data['all_measures'] = $all_measures;
        $data['all_pedido'] = $all_pedido;
        $data['pedido_object'] = $pedido_object;
        if ($pedido_object) {
            $this->session->set_flashdata('data_po', $pedido_object->purchase_order);
        }
        if ($id == NULL) {

            $all_products = $this->product->get_all_products();
            /* foreach ($all_products as $product) {
                $product->measure = $this->variety->get_by_variety_id($product->product_id);
            }*/
            $data['all_products'] = $all_products;
        } else {
            $all_products = $this->product->get_all_products_by_id($id);


            if ($all_products) {
                $data['all_products'] = $all_products;
            } else {

                $this->response->set_message("No se encontraron productos", ResponseMessage::ERROR);
                redirect("client/pedido_index");
            }
        }
        $this->load_view_admin_g("request/resquest", $data);
    }

    public function pedido_index_2($request_id)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2, 4])) {
            $this->log_out();
            redirect('login/index');
        }
        $this->load->model('Product_model', 'product');
        $this->load->model('Client_model', 'cliente');
        $this->load->model('Destination_model', 'destination');
        $this->load->model('Type_box_model', 'type_box');
        $this->load->model('Product_category_model', 'product_category');
        $this->load->model('Carguera_model', 'carguera');
        $this->load->model('Measure_model', 'measure');
        $this->load->model('Request_model', 'request');
        $pedido_object = $this->request->get_by_id($request_id);
        $all_pedido = $this->request->get_request_by_id($request_id);
        //  var_dump($all_pedido);
        //die();
        $id = $this->input->post('category');

        $all_cargueras = $this->carguera->get_all();
        $all_type_box = $this->type_box->get_all();
        $all_clientes = $this->cliente->get_all();
        $all_destinations = $this->destination->get_all();
        $all_measures = $this->measure->get_all();

        $all_product_category = $this->product_category->get_all(['is_active' => 1]);

        $data['all_cargueras'] = $all_cargueras;
        $data['all_product_category'] = $all_product_category;
        $data['all_type_box'] = $all_type_box;
        $data['all_destinations'] = $all_destinations;
        $data['all_clientes'] = $all_clientes;
        $data['all_measures'] = $all_measures;
        $data['all_pedido'] = $all_pedido;
        $data['pedido_object'] = $pedido_object;
        if ($pedido_object) {
            $this->session->set_flashdata('data_po', $pedido_object->purchase_order);
        }
        if ($id == NULL) {

            $all_products = $this->product->get_all_products();
            /* foreach ($all_products as $product) {
                $product->measure = $this->variety->get_by_variety_id($product->product_id);
            }*/
            $data['all_products'] = $all_products;
        } else {
            $all_products = $this->product->get_all_products_by_id($id);


            if ($all_products) {
                $data['all_products'] = $all_products;
            } else {

                $this->response->set_message("No se encontraron productos", ResponseMessage::ERROR);
                redirect("request/index");
            }
        }

        $this->load_view_admin_g("request/resquest_2", $data);
    }

    public function get_all()
    {

        if (!in_array($this->session->userdata('role_id'), [1, 2, 4])) {
            $this->log_out();
            redirect('login/index');
        }

        $id = $this->input->post('id');

        $all_request = $this->request->get_all_request_by_id($id);
        foreach ($all_request as $item) {
            $item->box = $this->request_product_box->get_all_request_box_by_id($item->request_product_id);
            //   $item->measure = $this->variety->get_by_measure($item->variety_measure_id);
        }
        echo json_encode($all_request);
        exit();
    }


    public function get_provider_by_variety()
    {

        if (!in_array($this->session->userdata('role_id'), [1, 2, 4])) {
            $this->log_out();
            redirect('login/index');
        }
        $this->load->model('Provider_model', 'provider');
        $this->load->model('Product_model', 'product');
        $id = $this->input->post('id');
        $product = $this->product->get_by_id($id);
        $all_providers = [];
        $proveedores = [];
        $all_providers = $this->provider->get_all_providers_by_variety($id);
        if ($all_providers) {
            foreach ($all_providers as $provi) {
                if (!in_array($provi->provider_id, $proveedores)) {
                    array_push($proveedores, $provi->provider_id);
                }
            }

            $product_categorie_color = $this->product->get_all_products_by_categoria_id($product->product_category_id, $product->colour);

            if ($product_categorie_color) {

                foreach ($product_categorie_color as $item) {
                    $provider_object = $this->provider->get_all_providers_by_variety_object($item->product_id);
                    if ($provider_object) {
                        foreach ($provider_object as $object) {
                            if (!in_array($object->provider_id, $proveedores)) {
                                array_push($proveedores, $object->provider_id);
                                array_push($all_providers, $object);
                            }
                        }
                    }
                }
            }

            $validacion = false;
        } else {
            $validacion = true;
            $product_categorie_color = $this->product->get_all_products_by_categoria_id($product->product_category_id, $product->colour);


            if ($product_categorie_color) {

                foreach ($product_categorie_color as $item) {
                    $provider_object = $this->provider->get_all_providers_by_variety_object($item->product_id);
                    if ($provider_object) {
                        foreach ($provider_object as $object) {
                            if (!in_array($object->provider_id, $proveedores)) {
                                array_push($proveedores, $object->provider_id);
                                array_push($all_providers, $object);
                            }
                        }
                    }
                }
            }
        }

        function object_sorter($clave, $orden = null)
        {
            return function ($a, $b) use ($clave, $orden) {
                $result = ($orden == "DESC") ? strnatcmp($b->$clave, $a->$clave) : strnatcmp($a->$clave, $b->$clave);
                return $result;
            };
        }

        usort($all_providers, object_sorter('name', 'ASC'));
        $data['all_providers'] = $all_providers;
        $data['validacion'] = $validacion;

        echo json_encode($data);

        exit();
    }


    public function add_buy_request_index($id)
    {

        if (!in_array($this->session->userdata('role_id'), [1, 2, 4])) {
            $this->log_out();
            redirect('login/index');
        }
        $this->load->model('Buy_element_model', 'buy_element');


        $object_request = $this->request->get_by_id($id);

        if ($object_request) {

            $all_varieties = $this->request->get_all_request_variety_by_id($id);

            foreach ($all_varieties as $item) {
                $item->box = $this->request_product_box->get_all_request_box_by_id($item->request_product_id);
                $item->buy = $this->buy_element->get_buy_by_id($item->request_product_id);
            }
            if ($object_request) {
                $this->session->set_flashdata('data_po', $object_request->purchase_order);
            }
            $data['all_varieties'] = $all_varieties;

            $data['object_request'] = $object_request;
            // var_dump($data);
            // die();
            $this->load_view_admin_g("request/buy_request_index", $data);
        } else {
            show_404();
        }
    }

    public function add_buy()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2, 4])) {
            $this->log_out();
            redirect('login/index');
        }
        $this->load->model('Request_model', 'request');
        $this->load->model('Buy_model', 'buy');
        $this->load->model('Buy_element_model', 'buy_element');

        $this->load->model('Request_product_model', 'request_product');
        $this->load->model('Request_product_box_model', 'request_product_box');

        $request_variety_id = $this->input->post('request_variety_id');
        $buy_id = $this->input->post('buy_id');

        $date = date("Y-m-d");
        $user_id = $this->session->userdata('user_id');

        //$data = [];
        $data = json_decode($_POST['array']);

        $object_request_variety = $this->request_product->get_by_id($request_variety_id);
        $object_buy = $this->buy->get_buy_by_request_id($object_request_variety->request_id);


        if ($object_buy) {
            $buy = $object_buy->buy_id;
        } else {
            $data_buy = [
                'request_id' => $object_request_variety->request_id,
                'user_id' => $user_id
            ];

            $buy = $this->buy->create($data_buy);
        }

        for ($i = 0; $i < count($data); $i++) {
            $provider_id = (int) $data[$i]->provider_id;
            $qty = (int) $data[$i]->cantidad;
            $price = (float) $data[$i]->precio;
            $etiqueta = $data[$i]->etiqueta;

            $data_buy_element = [
                'provider_id' => $provider_id,
                'qty' => $qty,
                'price' => $price,
                'request_product_id' => $request_variety_id,
                'buy_id' => (int) $buy,
                'etiqueta' => $etiqueta,
                'date' => $date,
                'iva_active' => 0
            ];
            $buy_element = $this->buy_element->create($data_buy_element);
        }
        /*   $all_varieties = $this->request->get_all_request_variety_by_id( $object_request_variety->request_id);
        foreach ($all_varieties as $item) {
            $item->buy = $this->buy_element->get_buy_by_id($item->request_variety_id);

        }*/
        //  $this->request_variety->update($request_variety_id, $data);
        $this->response->set_message("compra realizada correctamente", ResponseMessage::SUCCESS);
        echo json_encode($buy_element);
        exit();
    }

    public function get_all_buy()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2, 4])) {
            $this->log_out();
            redirect('login/index');
        }
        $this->load->model('Buy_model', 'buy');
        $this->load->model('Buy_element_model', 'buy_element');
        $this->load->model('Product_model', 'product');
        $this->load->model('Request_product_model', 'request_product');
        $id = $this->input->post('id');
        $all_request = $this->request_product->get_by_id_request($id);
        foreach ($all_request as $item) {
            $boxs = $this->buy_element->get_box_element_id($item->buy_element_id);
            if ($boxs) {
                foreach ($boxs as $box) {
                    $box->element = $this->buy_element->get_element_by_id($box->box_element_id);
                }
            }
            $item->boxs = $boxs;
            //  $item->element = $this->buy_element->get_element_by_id($item->buy_element_id);
        }
        echo json_encode($all_request);
        exit();
    }

    function export_excel()
    {
        $this->load->library("excel");
        $object = new PHPExcel();
        $this->load->model('Request_product_model', 'request_product');
        $this->load->model('Buy_element_model', 'buy_element');
        $id = $this->input->post('id');
        $all_request = $this->request_product->get_by_id_request($id);
        foreach ($all_request as $item) {
            //  $item->element = $this->buy_element->get_element_by_id($item->buy_element_id);
            $boxs = $this->buy_element->get_box_element_id($item->buy_element_id);

            if ($boxs) {

                foreach ($boxs as $box) {
                    $box->element = $this->buy_element->get_element_by_id($box->box_element_id);
                }
            }
            $item->boxs = $boxs;
        }
        // $object->setActiveSheetIndex(0);
        $object->setActiveSheetIndex(0)->mergeCells('A3:J3');
        //  $object->setActiveSheetIndex(0)->mergeCells('A2:B2');

        $object->getActiveSheet()->setCellValueByColumnAndRow('A3', 3, $all_request[0]->purchase_order);
        $object->getActiveSheet()->getStyle('A3:H3')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $object->getActiveSheet()->getStyle('A4:H4')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        //  $object->getActiveSheet()->getStyle('A3:H3')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);





        $object->getActiveSheet()->getStyle("A3")->getFont()->setBold(true);
        $table_columns = array("FINCA", "VARIEDAD", "MEDIDA", "CAJAS", "TIPO DE CAJAS", "TALLOS", "MARCACION", "DESTINO", "PRECIO CLIENTE", "PRECIO FINCA");
        //  $object->getActiveSheet()->getStyle("A1")->getFont()->setBold(true);



        // $object->getActiveSheet()->getStyle('A2:I2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        // $object->getActiveSheet()->getStyle('A2:I2')->getFill()->getStartColor()->setARGB('29bb04');
        // Add some data


        $column = 0;

        foreach ($table_columns as $field) {
            $object->getActiveSheet()->setCellValueByColumnAndRow($column, 4, $field);
            $column++;
        }
        for ($col = 'A'; $col != 'K'; $col++) {
            $object->getActiveSheet()->getColumnDimension($col)->setAutoSize(true);
        }

        $estilo = array(
            'borders' => array(
                'outline' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );

        //  $object->getActiveSheet()->getStyle('A2:J2')->applyFromArray($estilo);
        $object->getActiveSheet()->getStyle('A3:J3')->applyFromArray($estilo);
        $object->getActiveSheet()->getStyle('A4:J4')->applyFromArray($estilo);


        // $object->getActiveSheet()->getStyle("A2:H2")->getFont()->setBold(true);
        $object->getActiveSheet()->getStyle("A3:J3")->getFont()->setBold(true);
        $object->getActiveSheet()->getStyle("A4:J4")->getFont()->setBold(true);



        $excel_row = 5;
        $total_box = 0;
        foreach ($all_request as $item) {
            $contador = 1;
            if (count($item->boxs) > 0) {
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

                $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $item->name);
                if ($item->etiqueta == NULL) {
                    $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $item->product);
                } else {
                    $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $item->etiqueta);
                }

                $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, "");
                $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $item->qty_buy);
                $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, "");
                $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, "");
                $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $item->dialing);
                $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, $item->destination);
                $object->getActiveSheet()->setCellValueByColumnAndRow(8, $excel_row, "");
                $object->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row, "");


                $total_box = $total_box + $item->qty_buy;

                $excel_row++;
                foreach ($item->boxs as $box) {
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

                    $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, "");
                    $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, "Nro de cajas: " . $box->nro_cajas);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, "");
                    $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, "");
                    $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $box->box);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, "");
                    $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, "");
                    $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, "");
                    $object->getActiveSheet()->setCellValueByColumnAndRow(8, $excel_row, "");
                    $object->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row, "");
                    $excel_row++;

                    $contador++;
                    foreach ($box->element as $element) {
                        $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, "");
                        $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $element->product);
                        $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $element->name);
                        $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, "");
                        $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, "");
                        $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $element->nro_bunches * $element->stems_bunch);
                        $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, "");
                        $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, "");
                        $object->getActiveSheet()->setCellValueByColumnAndRow(8, $excel_row, $element->price_cliente);
                        $object->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row,  $element->price_finca);
                        $excel_row++;
                    }
                }
            } else {
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

                $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $item->name);
                if ($item->etiqueta == NULL) {
                    $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $item->product);
                } else {
                    $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $item->etiqueta);
                }

                $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $item->measure);
                $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $item->qty_buy);
                $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $item->box_type);
                $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $item->total_steams);
                $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $item->dialing);
                $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, $item->destination);
                $object->getActiveSheet()->setCellValueByColumnAndRow(8, $excel_row, $item->precio_cliente);
                $object->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row,  $item->precio_finca);



                $total_box = $total_box + $item->qty_buy;

                $excel_row++;
            }
        }

        $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, "TOTAL: " . $total_box . " CAJAS");
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

        $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Compra.xls"');
        ob_end_clean();
        ob_start();

        $object_writer->save('php://output');
    }

    public function export_pdf()
    {
        $this->load->model('Request_product_model', 'request_product');
        $id = $this->input->post('id2');

        $all_request = $this->request->get_all_request_by_id($id);
        foreach ($all_request as $item) {
            $item->box = $this->request_product_box->get_all_request_box_by_id($item->request_product_id);
            // $item->measure = $this->variety->get_by_measure($item->variety_measure_id);
        }

        $data['all_request'] =  $all_request;;
        $hoy = date("dmyhis");


        $html = $this->load->view('request/pdf', $data, true);

        //$html="asdf";
        //this the the PDF filename that user will get to download
        $pdfFilePath = "Dimention_flowers_PO.pdf";

        //load mPDF library
        $this->load->library('M_pdf');
        $mpdf = new mPDF('c', 'A4-L');
        $mpdf->WriteHTML($html);
        $mpdf->Output($pdfFilePath, "D");
        // //generate the PDF from the given html
        //  $this->m_pdf->pdf->WriteHTML($html);

        //  //download it.
        //  $this->m_pdf->pdf->Output($pdfFilePath, "D");
    }

    public function provider_index($id = 0)
    {

        if (!in_array($this->session->userdata('role_id'), [1, 2, 4])) {
            $this->log_out();
            redirect('login/index');
        }
        $this->load->model('Buy_model', 'buy');
        $this->load->model('Buy_element_model', 'buy_element');
        $this->load->model('Variety_model', 'variety');
        $this->load->model('Provider_model', 'provider');
        $this->load->model('Invoice_provider_model', 'invoice_provider');
        $this->load->model('Invoice_provider_element_model', 'invoice_provider_element');
        $objecto = $this->request->get_by_id($id);
        $all_request = $this->buy->get_by_request_id2($id);

        foreach ($all_request as $item) {
            $provider = $this->buy_element->get_element_by_provider_id($item->request_id, $item->provider_id);
            foreach ($provider as $pro) {
                $pro->factura_element = $this->invoice_provider_element->get_buy_element_by_id($pro->buy_element_id);
            }
            $item->provider = $provider;
            $item->invoice_provider = $this->invoice_provider->get_by_id2($item->provider_id, $item->buy_id);
            $boxs = $this->buy_element->get_box_element_id($item->buy_element_id);

            if ($boxs) {

                foreach ($boxs as $box) {

                    $box->element = $this->buy_element->get_element_by_id($box->box_element_id);
                }
            }
            $item->boxs = $boxs;

            $item->contador_elements = count($provider);
        }


        // var_dump($all_request);
        // die();
        if ($objecto) {
            $this->session->set_flashdata('data_po', $objecto->purchase_order);
        }
        $data['all_request'] = $all_request;
        $data['request_id'] = $id;
        $this->load_view_admin_g("request/provider_index", $data);
    }
    public function confirmar_factura($id = 0, $provider_id = 0, $contador_1 = 0, $contador_2 = 0)
    {

        if (!in_array($this->session->userdata('role_id'), [1, 2, 4])) {
            $this->log_out();
            redirect('login/index');
        }
        $contador_facturas = $this->session->userdata('contador_facturas');
        $contador_cargueras = $this->session->userdata('contador_cargueras');

        $this->load->model('Provider_model', 'provider');
        $this->load->model('Buy_element_model', 'buy_element');
        $this->load->model('Request_model', 'request');
        $this->load->model('Measure_model', 'measure');
        $this->load->model('Motivo_model', 'motivo');
        $this->load->model('Type_box_model', 'type_box');
        $this->load->model('Invoice_provider_model', 'invoice_provider');
        $this->load->model('Invoice_provider_element_model', 'invoice_provider_element');

        $all_measures = $this->measure->get_all();
        $all_motivos = $this->motivo->get_all(['is_active' => 1]);
        $type_boxs = $this->type_box->get_all();
        $all_buy_element   = $this->buy_element->get_element_by_provider_id($id, $provider_id);

        $buy_id = $all_buy_element[0]->buy_id;
        $invoice = $this->invoice_provider->get_by_id2($provider_id, $buy_id);

        $count = 0;
        foreach ($all_buy_element as $item) {
            $boxs = $this->buy_element->get_box_element_id($item->buy_element_id);

            if ($boxs) {

                foreach ($boxs as $box) {
                    $count += $box->nro_cajas;
                    $box->element = $this->buy_element->get_element_by_id($box->box_element_id);
                }
            }
            $item->boxs = $boxs;
            $item->count =  $count;
            $item->factura = $this->invoice_provider_element->get_buy_element_by_id($item->buy_element_id);
        }
        //   var_dump($all_buy_element);
        // die();
        $variedades = $this->provider->get_all_products_by_provider($provider_id);
        $provider_object = $this->provider->get_by_id($provider_id);
        $request_object = $this->request->get_by_id($id);
        $data['type_boxs'] = $type_boxs;
        $data['all_motivos'] = $all_motivos;
        $data['invoice'] = $invoice;
        $data['variedades'] = $variedades;
        $data['all_measures'] = $all_measures;
        $data['all_buy_element'] = $all_buy_element;
        $data['provider_object'] = $provider_object;
        $data['request_object'] = $request_object;
        $data['request_id'] = $id;
        $data['contador_elementos'] = $contador_1;
        $data['contador_facturas'] = $contador_facturas;
        $data['contador_cargueras'] = $contador_cargueras;
        $this->load_view_admin_g("request/index_factura_provider", $data);
    }
    public function confirmar_carguera()
    {

        if (!in_array($this->session->userdata('role_id'), [1, 2, 4])) {
            $this->log_out();
            redirect('login/index');
        }
        $this->load->model('Invoice_provider_model', 'invoice_provider');
        $this->load->model('Buy_element_model', 'buy_element');
        $this->load->model('Provider_model', 'provider');

        $this->load->model('Empresa_model', 'empresa');
        $object_empresa = $this->empresa->get_by_id(1);

        $provider_id = $this->input->post('provider_carguera');
        $buy_id = $this->input->post('buy_carguera');
        $request_id = $this->input->post('request_id_carguera');
        $awb = $this->input->post('awb');
        $hawb = $this->input->post('hawb');
        $airline = $this->input->post('airline');
        $contador_facturas = $this->input->post('carguera_contador1');
        $contador_cargueras = $this->input->post('carguera_contador2');
        $contador_elementos = $this->input->post('carguera_contador3');

        $valida = false;
        $invoice = $this->invoice_provider->get_by_id2($provider_id, $buy_id);
        if ($invoice) {


            $cod = (int) $object_empresa->secuencial_carguera + 1;
            $data = [
                'awb' =>  $awb,
                'hawb' => $hawb,
                'airline' => $airline,
                'date_invoice_carguera' => date('Y-m-d'),
                'cod_carguera' => $cod,
                'referendum' => $object_empresa->referendum
            ];
            $this->invoice_provider->update($invoice->invoice_provider_id, $data);
            $this->empresa->update(1, ['secuencial_carguera' => ($object_empresa->secuencial_carguera + 1)]);

            $valida = true;
        } else {
            $cod = (int) $object_empresa->secuencial_carguera + 1;
            $this->invoice_provider->create(['buy_id' => $buy_id, 'awb' => $awb, 'hawb' => $hawb, 'airline' => $airline, 'is_active' => 0, 'date_invoice_carguera' => date('Y-m-d'), 'provider_id' => $provider_id, 'cod_carguera' => $cod, 'nro_invoice' => "", 'fecha_create' => date('Y-m-d'), 'referendum' => $object_empresa->referendum]);
            $this->empresa->update(1, ['secuencial_carguera' => ($object_empresa->secuencial_carguera + 1)]);
            $valida = true;
        }
        $count = (int) $contador_cargueras + 1;

        if ((int) $contador_elementos == $count && (int) $contador_elementos == (int) $contador_facturas) {
            if ($valida) {

                $this->request->update($request_id, ['state' => 2]);
            }
        }



        $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
        redirect("request/provider_index/" . $request_id, "location", 301);
    }
    public function confirmar_factura_ajax()
    {

        if (!in_array($this->session->userdata('role_id'), [1, 2, 4])) {
            $this->log_out();
            redirect('login/index');
        }
        $id = $this->input->post('id');

        $this->load->model('Buy_element_model', 'buy_element');

        $all_buy_element   = $this->buy_element->get_element_by_provider_id($id);

        //var_dump($all_request);
        //   die();
        echo json_encode($all_buy_element);
        exit();
    }
    public function update_request()
    {

        if (!in_array($this->session->userdata('role_id'), [1, 2, 4])) {
            $this->log_out();
            redirect('login/index');
        }

        $data = ['state' => 1];
        $request_id = $this->input->post('request_id');
        $row = $this->request->update($request_id, $data);
        $objecto = $this->request->get_by_id($request_id);
        if ($objecto) {
            $this->session->set_flashdata('data_po', $objecto->purchase_order);
        }
        echo json_encode($row);
        exit();
    }
    public function update_buy_element()
    {

        if (!in_array($this->session->userdata('role_id'), [1, 2, 4])) {
            $this->log_out();
            redirect('login/index');
        }
        $this->load->model('Request_product_model', 'request_product');
        $this->load->model('Product_model', 'product');
        $this->load->model('Request_model', 'request');
        $this->load->model('Request_product_box_model', 'request_product_box');
        $this->load->model('Buy_element_model', 'buy_element');
        $this->load->model('Pending_model', 'pending');
        $this->load->model('buy_model', 'buy');
        $buy_element_id = $this->input->post('buy_element_id');
        $measure = $this->input->post('measure_buy_update');
        $provider_id = $this->input->post('provider_id');
        $reason = $this->input->post('reason');
        $qty = (int) $this->input->post('qty');
        $price = (float) $this->input->post('precio');
        $object_buy_element = $this->buy_element->get_by_id($buy_element_id);
        $object_buy = $this->buy->get_by_id($object_buy_element->buy_id);
        $request_id = $object_buy->request_id;
        $object_request = $this->request->get_by_id($request_id);
        $request_product_object = $this->request_product->get_by_id($object_buy_element->request_product_id);
        $product_id = $request_product_object->product_id;
        $object_producto = $this->product->get_by_id($product_id);
        $measure_id = $request_product_object->measure_id;
        if ($object_buy_element) {
            if ($measure_id != $measure) {
                if ($measure > 0) {
                    $this->request_product->update($object_buy_element->request_product_id, ['measure_id' => $measure]);
                }
            }


            if ($qty == $object_buy_element->qty) {
                $data_buy_element = [
                    'price' => $price
                ];
                $this->buy_element->update($buy_element_id, $data_buy_element);
            } else {

                if ($qty > 0) {

                    $cantidad_pendiente = $object_buy_element->qty - $qty;

                    $data_pending = [
                        'provider_id' => $provider_id,
                        'qty' => $cantidad_pendiente,
                        'request_id' =>  $object_buy->request_id,
                        'reason' =>  $reason,
                        'price' => $price,
                        'measure_id' => $measure_id,
                        'product_id' => $product_id
                    ];

                    $this->pending->create($data_pending);
                    $data_buy_element = [
                        'qty' => $qty,
                        'price' => $price
                    ];
                    $this->buy_element->update($buy_element_id, $data_buy_element);
                    $object_request_variety = $this->request_product->get_by_id($object_buy_element->request_product_id);

                    $object_request_variety_box = $this->request_product_box->get_by_box_id($object_buy_element->request_product_id);

                    $cantidad_cajas =  $object_request_variety_box->qty - $cantidad_pendiente;

                    $data_box = ['qty' => $cantidad_cajas];
                    $this->request_product_box->update($object_request_variety_box->request_product_box_id, $data_box);


                    if ($object_producto->product_category_id == 31 || $object_producto->product_category_id == 4 || $object_producto->product_category_id == 5 || $object_producto->product_category_id == 27 || $object_producto->product_category_id == 10 || $object_producto->product_category_id == 25) {
                        if (($object_producto->product_category_id == 31 && ($object_request->cliente_id == 6)) || ($object_producto->product_category_id == 31 && ($object_request->cliente_id == 12))) {

                            $precio_total = $cantidad_cajas *  $object_request_variety->unit_price * $object_request_variety->qty_bunches;
                            $precio_total = $cantidad_cajas *  $object_request_variety->unit_price * $object_request_variety->total_steams;
                        } else {
                            if ($object_request->cliente_id != 5) {
                                if ($object_producto->product_category_id == 25) {
                                    $precio_total = $cantidad_cajas *  $object_request_variety->unit_price * $object_request_variety->qty_bunches;
                                } else {
                                    $precio_total = $cantidad_cajas *  $object_request_variety->unit_price * $object_request_variety->total_steams;
                                }
                            } else {
                                $precio_total = $cantidad_cajas *  $object_request_variety->unit_price * $object_request_variety->qty_bunches;
                            }
                        }
                    } else {

                        if ((($object_producto->product_category_id == 3) && ($object_request->cliente_id == 9))) {
                            $precio_total = $cantidad_cajas *  $object_request_variety->unit_price * $object_request_variety->qty_bunches;
                        } else {
                            if ($object_request->cliente_id == 5) {
                                if ($object_producto->product_category_id == 6 || $object_producto->product_category_id == 7 || $object_producto->product_category_id == 8) {

                                    $precio_total = $cantidad_cajas *  $object_request_variety->unit_price * $object_request_variety->qty_bunches;
                                }
                            } else {
                                $precio_total = $cantidad_cajas *  $object_request_variety->unit_price * $object_request_variety->total_steams;
                            }
                        }
                    }




                    $data_request_variety = ['total_price' => $precio_total];
                    $this->request_product->update($object_buy_element->request_product_id, $data_request_variety);
                    //actualiza el buy element
                    //result es la cantidad pendiente
                } elseif ($qty == 0) {

                    $cantidad_pendiente = $object_buy_element->qty;
                    $data_pending = [
                        'provider_id' => $provider_id,
                        'qty' => $cantidad_pendiente,
                        'request_id' =>  $object_buy->request_id,
                        'reason' =>  $reason,
                        'price' => $price,
                        'measure_id' => $measure_id,
                        'product_id' => $product_id
                    ];

                    $this->pending->create($data_pending);

                    $this->buy_element->delete($buy_element_id);
                    $object_request_variety_box = $this->request_product_box->get_by_box_id($object_buy_element->request_product_id);
                    $cantidad_box = $object_request_variety_box->qty - $cantidad_pendiente;
                    if ($cantidad_box > 0) {
                        $object_request_variety = $this->request_product->get_by_id($object_buy_element->request_product_id);
                        $data_box = ['qty' => $cantidad_box];
                        $this->request_product_box->update($object_request_variety_box->request_product_box_id, $data_box);
                        if ($object_producto->product_category_id == 31 || $object_producto->product_category_id == 4 || $object_producto->product_category_id == 5 || $object_producto->product_category_id == 27 || $object_producto->product_category_id == 10 || $object_producto->product_category_id == 25) {
                            if (($object_producto->product_category_id == 31 && ($object_request->cliente_id == 6)) || ($object_producto->product_category_id == 31 && ($object_request->cliente_id == 12))) {

                                $precio_total = $cantidad_box *  $object_request_variety->unit_price * $object_request_variety->qty_bunches;
                                $precio_total = $cantidad_box *  $object_request_variety->unit_price * $object_request_variety->total_steams;
                            } else {
                                if ($object_request->cliente_id != 5) {
                                    if ($object_producto->product_category_id == 25) {
                                        $precio_total = $cantidad_box *  $object_request_variety->unit_price * $object_request_variety->qty_bunches;
                                    } else {
                                        $precio_total = $cantidad_box *  $object_request_variety->unit_price * $object_request_variety->total_steams;
                                    }
                                } else {
                                    $precio_total = $cantidad_box *  $object_request_variety->unit_price * $object_request_variety->qty_bunches;
                                }
                            }
                        } else {

                            if ((($object_producto->product_category_id == 3) && ($object_request->cliente_id == 9))) {
                                $precio_total = $cantidad_box *  $object_request_variety->unit_price * $object_request_variety->qty_bunches;
                            } else {
                                if ($object_request->cliente_id == 5) {
                                    if ($object_producto->product_category_id == 6 || $object_producto->product_category_id == 7 || $object_producto->product_category_id == 8) {

                                        $precio_total = $cantidad_box *  $object_request_variety->unit_price * $object_request_variety->qty_bunches;
                                    }
                                } else {
                                    $precio_total = $cantidad_box *  $object_request_variety->unit_price * $object_request_variety->total_steams;
                                }
                            }
                        }

                        $data_request_variety = ['total_price' => $precio_total];
                        $this->request_product->update($object_buy_element->request_product_id, $data_request_variety);
                    } elseif ($cantidad_box == 0) {
                        $this->request_product_box->delete($object_request_variety_box->request_product_box_id);
                        $this->request_product->delete($object_request_variety_box->request_product_id);
                    }

                    //elimina el buy element
                }
            }
        }

        $result = $this->buy_element->get_by_id_elementos($provider_id, $buy_element_id);
        if (!$result) {
            $this->buy_element->delete($buy_element_id);
            $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
            redirect("request/provider_index/" . $request_id, "location", 301);
        } else {
            $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
            redirect("request/confirmar_factura/" . $request_id . '/' . $provider_id, "location", 301);
        }
    }
    public function confirmar_invoice()
    {

        if (!in_array($this->session->userdata('role_id'), [1, 2, 4])) {
            $this->log_out();
            redirect('login/index');
        }
        $this->load->model('Invoice_provider_model', 'invoice_provider');
        $this->load->model('Buy_model', 'buy');
        $this->load->model('Request_model', 'request');
        $this->load->model('Provider_model', 'provider');
        $this->load->model('Empresa_model', 'empresa');
        $object_empresa = $this->empresa->get_by_id(1);
        $contador_elementos = $this->input->post('contador_1');
        $contador_facturas = $this->input->post('contador_2');
        $contador_cargueras = $this->input->post('contador_3');
        $nro_invoice = $this->input->post('nro_invoice');
        $provider_id = $this->input->post('invo_provider_id');
        $request_id = $this->input->post('invo_request_id');
        $buy_id = $this->input->post('invo_buy_id');
        $total = $this->input->post('total_factura');
        $valida = false;
        $invoice = $this->invoice_provider->get_by_id2($provider_id, $buy_id);

        if ($invoice) {
            $data = [
                'nro_invoice' =>  $nro_invoice,
                'fecha_create' => date('Y-m-d'),
                'total' => $total
            ];
            $this->invoice_provider->update($invoice->invoice_provider_id, $data);
            $valida = true;
        } else {

            $this->invoice_provider->create(['total' => $total, 'buy_id' => $buy_id, 'is_active' => 0, 'provider_id' => $provider_id, 'nro_invoice' =>  $nro_invoice, 'cod_carguera' => 0, 'date_invoice_carguera' => date('Y-m-d'), 'fecha_create' => date('Y-m-d'), 'referendum' => $object_empresa->referendum]);
        }

        $object_buy = $this->buy->get_by_id($buy_id);

        $data_request = [
            'state' => 2
        ];
        $count = (int) $contador_facturas + 1;

        if ((int) $contador_elementos == $count && (int) $contador_elementos == (int) $contador_cargueras) {
            if ($valida) {
                $this->request->update($object_buy->request_id, $data_request);
            }
        }


        $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
        redirect("request/provider_index/" . $request_id, "location", 301);
    }
    public function confirmar_invoice_element()
    {

        if (!in_array($this->session->userdata('role_id'), [1, 2, 4])) {
            $this->log_out();
            redirect('login/index');
        }
        $this->load->model('Invoice_provider_model', 'invoice_provider');
        $this->load->model('Buy_model', 'buy');
        $this->load->model('Request_model', 'request');
        $this->load->model('Provider_model', 'provider');
        $this->load->model('Invoice_provider_element_model', 'invoice_provider_element');
        $contador_elementos = $this->input->post('contador_1_factura_element');
        $contador_facturas = $this->input->post('contador_2_factura_element');
        $contador_cargueras = $this->input->post('contador_3_factura_element');
        $contador_cajas = $this->input->post('contador_cajas');
        $contador_items = $this->input->post('contador_items');
        $contador_facturas_element = $this->input->post('contador_facturas_element');
        $contador_buy_element = $this->input->post('contador_buy_element');
        $nro_invoice = $this->input->post('nro_invoice_factura_element');
        $provider_id = $this->input->post('provider_id_factura_element');
        $buy_element = $this->input->post('buy_element_id_factura_element');
        $request_id = $this->input->post('request_id_factura_element');
        $total = $this->input->post('total_factura_element');
        $valida = false;
        $data = [
            'nro_invoice' =>  $nro_invoice,
            'buy_element_id' => $buy_element,
            'total' => $total,
            'fecha_create' => date('Y-m-d')
        ];
        $id = $this->invoice_provider_element->create($data);
        if ($id) {
            $valida = true;
        }
        $data_request = [
            'state' => 2
        ];
        $count = (int) $contador_facturas + 1;
        if ((int) $contador_buy_element == (int) $contador_facturas_element + 1) {
            if ((int) $contador_cargueras == (int) $contador_elementos && (int) $contador_elementos == $count) {
                if ($valida) {
                    $this->request->update($request_id, $data_request);
                }
            }
        }
        $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
        redirect("request/confirmar_factura/" . $request_id . "/" . $provider_id . "/" . $contador_elementos . "/" . $contador_facturas, "location", 301);
    }
    public function update_invoice_element()
    {

        if (!in_array($this->session->userdata('role_id'), [1, 2, 4])) {
            $this->log_out();
            redirect('login/index');
        }
        $this->load->model('Invoice_provider_model', 'invoice_provider');
        $this->load->model('Buy_model', 'buy');
        $this->load->model('Request_model', 'request');
        $this->load->model('Provider_model', 'provider');
        $this->load->model('Invoice_provider_element_model', 'invoice_provider_element');

        $contador_elementos = $this->input->post('contador_1_factura_element_update');
        $contador_facturas = $this->input->post('contador_2_factura_element_update');
        $nro_invoice = $this->input->post('nro_invoice_factura_element_update');
        $provider_id = $this->input->post('provider_id_factura_element_update');
        $buy_element = $this->input->post('buy_element_id_factura_element_update');
        $request_id = $this->input->post('request_id_factura_element_update');
        $total = $this->input->post('total_factura_element_update');


        $data = [
            'nro_invoice' =>  $nro_invoice,
            'total' => $total
        ];

        $this->invoice_provider_element->update($buy_element, $data);

        $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
        redirect("request/confirmar_factura/" . $request_id . "/" . $provider_id . "/" . $contador_elementos . "/" . $contador_facturas, "location", 301);
    }

    public function fecha_vuelo()
    {

        if (!in_array($this->session->userdata('role_id'), [1, 2, 4])) {
            $this->log_out();
            redirect('login/index');
        }

        $this->load->model('Request_model', 'request');
        $fecha = date('Y-m-d', strtotime($this->input->post('date_reception')));
        $request_id = $this->input->post('request_id');
        $objecto = $this->request->get_by_id($request_id);
        if ($objecto) {
            $this->session->set_flashdata('data_po', $objecto->purchase_order);
        }
        $this->request->update($request_id, ['date_time_reception' => $fecha]);

        $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
        redirect("request/index/", "location", 301);
    }

    function exportar_factura_provider($provider_id = 0, $buy_id)
    {

        $this->load->model('Buy_model', 'buy');
        $this->load->model('Buy_element_model', 'buy_element');
        $this->load->model('Variety_model', 'variety');
        $this->load->model('Provider_model', 'provider');
        $this->load->model('Invoice_provider_model', 'invoice_provider');
        $this->load->model('Invoice_provider_element_model', 'invoice_provider_element');
        // $all_request = $this->buy->get_by_request_id2($id);

        // $item->provider = $this->buy_element->get_element_by_provider_id($item->request_id);
        $invoice_provider_object = $this->invoice_provider->get_invoice_by_id($provider_id, $buy_id);
        $all_buy_elements = $this->buy_element->get_element_by_provider_id($invoice_provider_object->request_id, $provider_id);
        foreach ($all_buy_elements as $item) {
            $item->factura_element = $this->invoice_provider_element->get_buy_element_by_id($item->buy_element_id);
            $boxs = $this->buy_element->get_box_element_id($item->buy_element_id);

            if ($boxs) {

                foreach ($boxs as $box) {
                    $box->element = $this->buy_element->get_element_by_id($box->box_element_id);
                }
            }
            $item->boxs = $boxs;
        }

        /*$all_request = $this->buy->get_by_request_factura($id);

        foreach ($all_request as $item) {
            $item->invoice_provider = $this->invoice_provider->get_by_id($item->provider_id, $item->buy_id);
        }*/
        $elementos_factura = [];
        $sin_facturas = [];
        foreach ($all_buy_elements as $item) {

            if ($item->factura_element) {
                array_push($elementos_factura, $item);
            } else {
                array_push($sin_facturas, $item);
            }
        }
        $this->load->library("excel");
        $object = new PHPExcel();
        $excel_row = 6;
        if (count($sin_facturas) > 0) {

            // $object->setActiveSheetIndex(0);
            $object->setActiveSheetIndex(0)->mergeCells('A3:G3');
            //  $object->setActiveSheetIndex(0)->mergeCells('A2:B2');

            $object->getActiveSheet()->setCellValueByColumnAndRow('A', 3, "Finca: " . $invoice_provider_object->provider);
            $object->getActiveSheet()->setCellValueByColumnAndRow(0, 4, "Nro invoice: " . $invoice_provider_object->nro_invoice);
            $object->getActiveSheet()->setCellValueByColumnAndRow(1, 4, "PO: " . $invoice_provider_object->purchase_order);

            $object->getActiveSheet()->getStyle("A5")->getFont()->setBold(true);
            $table_columns = array("VARIEDAD", "MEDIDA/PESO", "BUNCHES", "TALLOS", "NRO CAJAS", "PRECIO", "TOTAL");

            $column = 0;

            foreach ($table_columns as $field) {
                $object->getActiveSheet()->setCellValueByColumnAndRow($column, 5, $field);
                $column++;
            }
            for ($col = 'A'; $col != 'G'; $col++) {
                $object->getActiveSheet()->getColumnDimension($col)->setAutoSize(true);
            }

            $estilo = array(
                'borders' => array(
                    'outline' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                )
            );

            $object->getActiveSheet()->getStyle('A3:G3')->applyFromArray($estilo);
            $object->getActiveSheet()->getStyle('A4:G4')->applyFromArray($estilo);
            $object->getActiveSheet()->getStyle('A5')->applyFromArray($estilo);
            $object->getActiveSheet()->getStyle('B5')->applyFromArray($estilo);
            $object->getActiveSheet()->getStyle('B4')->applyFromArray($estilo);
            $object->getActiveSheet()->getStyle('C5')->applyFromArray($estilo);
            $object->getActiveSheet()->getStyle('D5')->applyFromArray($estilo);
            $object->getActiveSheet()->getStyle('E5')->applyFromArray($estilo);
            $object->getActiveSheet()->getStyle('F5')->applyFromArray($estilo);
            $object->getActiveSheet()->getStyle('G5')->applyFromArray($estilo);
            $object->getActiveSheet()->getStyle("A3:G3")->getFont()->setBold(true);
            $object->getActiveSheet()->getStyle("A4:G4")->getFont()->setBold(true);
            $object->getActiveSheet()->getStyle("A5:G5")->getFont()->setBold(true);

            //    $excel_row = 6;
            $total = 0;
            foreach ($sin_facturas as $item) {

                $object->getActiveSheet()->getStyle('A' . $excel_row)->applyFromArray($estilo);
                $object->getActiveSheet()->getStyle('B' . $excel_row)->applyFromArray($estilo);
                $object->getActiveSheet()->getStyle('C' . $excel_row)->applyFromArray($estilo);
                $object->getActiveSheet()->getStyle('D' . $excel_row)->applyFromArray($estilo);
                $object->getActiveSheet()->getStyle('E' . $excel_row)->applyFromArray($estilo);
                $object->getActiveSheet()->getStyle('F' . $excel_row)->applyFromArray($estilo);
                $object->getActiveSheet()->getStyle('G' . $excel_row)->applyFromArray($estilo);
                if ($item->etiqueta == NULL) {
                    $producto = $item->product;
                } else {
                    $producto = $item->etiqueta;
                }
                $precio = 0;
                if ($item->product_category_id == 31 || $item->product_category_id == 4 || $item->product_category_id == 5 || $item->product_category_id == 27 || $item->product_category_id == 10 || $item->product_category_id == 25) {
                    if (($item->product_category_id == 31 && ($item->cliente_id == 6)) || ($item->product_category_id == 31 && ($item->cliente_id == 12))) {
                        $precio = number_format(((int) $item->qty * (float) $item->price * (int) $item->qty_bunches), 2);
                    } else {
                        if ($item->cliente_id != 5) {
                            if ($item->product_category_id == 25) {
                                $precio = number_format(((int) $item->qty * (float) $item->price * (int) $item->qty_bunches), 2);
                            } else {
                                $precio =  number_format(((int) $item->qty * (float) $item->price * (int) $item->total_steams), 2);
                            }
                        } else {
                            $precio = number_format(((int) $item->qty * (float) $item->price * (int) $item->qty_bunches), 2);
                        }
                    }
                } else {

                    if ((($item->product_category_id == 3) && ($item->cliente_id == 9))) {
                        $precio = number_format(((int) $item->qty * (float) $item->price * (int) $item->qty_bunches), 2);
                    } else {
                        if ($item->cliente_id == 5) {
                            if ($item->product_category_id == 6 || $item->product_category_id == 7 || $item->product_category_id == 8 || $item->product_category_id == 36) {

                                $precio = number_format(((int) $item->qty * (float) $item->price * (int) $item->qty_bunches), 2);
                            } else {
                                $precio = number_format(((int) $item->qty * (float) $item->price * (int) $item->total_steams), 2);
                            }
                        } else {
                            $precio = number_format(((int) $item->qty * (float) $item->price * (int) $item->total_steams), 2);
                        }
                    }
                }
                $contador = 1;
                if (count($item->boxs) > 0) {

                    $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $producto);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, "");
                    $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, "");
                    $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, "");
                    $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $item->qty);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, "");
                    $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, "");
                    $excel_row++;
                    foreach ($item->boxs as $box) {
                        $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, "Items de la  caja");
                        $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, "");
                        $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, "");
                        $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, "");
                        $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, "");
                        $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, "");
                        $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, "");
                        $excel_row++;
                        foreach ($box->element as $element) {

                            $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $element->product);
                            $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $element->name);
                            $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $element->nro_bunches);
                            $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $element->nro_bunches * $element->stems_bunch);
                            $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, "");
                            $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, number_format($element->price_finca, 2));
                            $precio = (((int) $element->nro_bunches * (int) $element->stems_bunch) * (float) $element->price_finca);
                            $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row,  number_format($precio, 2));
                            $total = $total + number_format($precio, 2);
                            $excel_row++;
                        }
                        $total = $total * (int) $box->nro_cajas;
                        $contador++;
                    }
                } else {
                    $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $producto);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $item->measure);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $item->qty_bunches);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $item->total_steams);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $item->qty);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, number_format($item->price, 2));
                    $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $precio);

                    $total = $total + $precio;

                    $excel_row++;
                }
            }
            $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, "TOTAL = ");
            $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, "$" . number_format($total, 2));
            $object->getActiveSheet()->getStyle('A' . $excel_row)->applyFromArray($estilo);
            $object->getActiveSheet()->getStyle('B' . $excel_row)->applyFromArray($estilo);
            $object->getActiveSheet()->getStyle('C' . $excel_row)->applyFromArray($estilo);
            $object->getActiveSheet()->getStyle('D' . $excel_row)->applyFromArray($estilo);
            $object->getActiveSheet()->getStyle('E' . $excel_row)->applyFromArray($estilo);
            $object->getActiveSheet()->getStyle('F' . $excel_row)->applyFromArray($estilo);
            $object->getActiveSheet()->getStyle('G' . $excel_row)->applyFromArray($estilo);
            // $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
            /*      header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="Factura por finca.xls"');
            ob_end_clean();
            ob_start();

            $object_writer->save('php://output'); */
        }
        if (count($elementos_factura) > 0) {

            foreach ($elementos_factura as $factura) {
                if ($excel_row == 6) {

                    $object->setActiveSheetIndex(0)->mergeCells('A3:G3');
                    $object->getActiveSheet()->setCellValueByColumnAndRow('A', 3, "Finca: " . $invoice_provider_object->provider);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(0, 4, "Nro invoice: " . $factura->factura_element->nro_invoice);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(1, 4, "PO: " . $invoice_provider_object->purchase_order);

                    $object->getActiveSheet()->getStyle("A5")->getFont()->setBold(true);
                    $table_columns = array("VARIEDAD", "MEDIDA/PESO", "BUNCHES", "TALLOS", "NRO CAJAS", "PRECIO", "TOTAL");

                    $column = 0;

                    foreach ($table_columns as $field) {
                        $object->getActiveSheet()->setCellValueByColumnAndRow($column, 5, $field);
                        $column++;
                    }
                    for ($col = 'A'; $col != 'G'; $col++) {
                        $object->getActiveSheet()->getColumnDimension($col)->setAutoSize(true);
                    }

                    $estilo = array(
                        'borders' => array(
                            'outline' => array(
                                'style' => PHPExcel_Style_Border::BORDER_THIN
                            )
                        )
                    );

                    $object->getActiveSheet()->getStyle('A3:G3')->applyFromArray($estilo);
                    $object->getActiveSheet()->getStyle('A4:G4')->applyFromArray($estilo);
                    $object->getActiveSheet()->getStyle('A5')->applyFromArray($estilo);
                    $object->getActiveSheet()->getStyle('B5')->applyFromArray($estilo);
                    $object->getActiveSheet()->getStyle('B4')->applyFromArray($estilo);
                    $object->getActiveSheet()->getStyle('C5')->applyFromArray($estilo);
                    $object->getActiveSheet()->getStyle('D5')->applyFromArray($estilo);
                    $object->getActiveSheet()->getStyle('E5')->applyFromArray($estilo);
                    $object->getActiveSheet()->getStyle('F5')->applyFromArray($estilo);
                    $object->getActiveSheet()->getStyle('G5')->applyFromArray($estilo);
                    $object->getActiveSheet()->getStyle("A3:G3")->getFont()->setBold(true);
                    $object->getActiveSheet()->getStyle("A4:G4")->getFont()->setBold(true);
                    $object->getActiveSheet()->getStyle("A5:G5")->getFont()->setBold(true);
                } else {

                    $rango = $excel_row + 2;
                    $rango2 = $excel_row + 3;
                    $rango3 = $excel_row + 4;
                    $object->setActiveSheetIndex(0)->mergeCells('A' . $rango . ':G' . $rango);
                    $object->getActiveSheet()->setCellValueByColumnAndRow('A', $rango, "Finca: " . $invoice_provider_object->provider);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(0, $rango2, "Nro invoice: " . $factura->factura_element->nro_invoice);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(1, $rango2, "PO: " . $invoice_provider_object->purchase_order);

                    $object->getActiveSheet()->getStyle("A" . $rango3)->getFont()->setBold(true);
                    $table_columns = array("VARIEDAD", "MEDIDA/PESO", "BUNCHES", "TALLOS", "NRO CAJAS", "PRECIO", "TOTAL");

                    $column = 0;

                    foreach ($table_columns as $field) {
                        $object->getActiveSheet()->setCellValueByColumnAndRow($column, $rango3, $field);
                        $column++;
                    }
                    for ($col = 'A'; $col != 'G'; $col++) {
                        $object->getActiveSheet()->getColumnDimension($col)->setAutoSize(true);
                    }

                    $estilo = array(
                        'borders' => array(
                            'outline' => array(
                                'style' => PHPExcel_Style_Border::BORDER_THIN
                            )
                        )
                    );
                    $object->getActiveSheet()->getStyle('A' . $rango . ':G' . $rango)->applyFromArray($estilo);
                    $object->getActiveSheet()->getStyle('A' . $rango2 . ':G' . $rango2)->applyFromArray($estilo);
                    $object->getActiveSheet()->getStyle('A' . $rango3)->applyFromArray($estilo);
                    $object->getActiveSheet()->getStyle('B' . $rango3)->applyFromArray($estilo);
                    $object->getActiveSheet()->getStyle('B' . $rango2)->applyFromArray($estilo);
                    $object->getActiveSheet()->getStyle('C' . $rango3)->applyFromArray($estilo);
                    $object->getActiveSheet()->getStyle('D' . $rango3)->applyFromArray($estilo);
                    $object->getActiveSheet()->getStyle('E' . $rango3)->applyFromArray($estilo);
                    $object->getActiveSheet()->getStyle('F' . $rango3)->applyFromArray($estilo);
                    $object->getActiveSheet()->getStyle('G' . $rango3)->applyFromArray($estilo);
                    $object->getActiveSheet()->getStyle('A' . $rango . ':G' . $rango)->getFont()->setBold(true);
                    $object->getActiveSheet()->getStyle('A' . $rango2 . ':G' . $rango2)->getFont()->setBold(true);
                    $object->getActiveSheet()->getStyle('A' . $rango3 . ':G' . $rango3)->getFont()->setBold(true);

                    $excel_row = $excel_row + 5;
                }


                $total = 0;

                $object->getActiveSheet()->getStyle('A' . $excel_row)->applyFromArray($estilo);
                $object->getActiveSheet()->getStyle('B' . $excel_row)->applyFromArray($estilo);
                $object->getActiveSheet()->getStyle('C' . $excel_row)->applyFromArray($estilo);
                $object->getActiveSheet()->getStyle('D' . $excel_row)->applyFromArray($estilo);
                $object->getActiveSheet()->getStyle('E' . $excel_row)->applyFromArray($estilo);
                $object->getActiveSheet()->getStyle('F' . $excel_row)->applyFromArray($estilo);
                $object->getActiveSheet()->getStyle('G' . $excel_row)->applyFromArray($estilo);
                if ($factura->etiqueta == NULL) {
                    $producto = $factura->product;
                } else {
                    $producto = $factura->etiqueta;
                }
                $precio = 0;
                if ($factura->product_category_id == 31 || $factura->product_category_id == 4 || $factura->product_category_id == 5 || $factura->product_category_id == 27 || $factura->product_category_id == 10 || $factura->product_category_id == 25) {
                    if (($factura->product_category_id == 31 && ($factura->cliente_id == 6)) || ($factura->product_category_id == 31 && ($factura->cliente_id == 12))) {
                        $precio = number_format(((int) $factura->qty * (float) $factura->price * (int) $factura->qty_bunches), 2);
                    } else {
                        if ($factura->cliente_id != 5) {
                            if ($factura->product_category_id == 25) {
                                $precio = number_format(((int) $factura->qty * (float) $factura->price * (int) $factura->qty_bunches), 2);
                            } else {
                                $precio =  number_format(((int) $factura->qty * (float) $factura->price * (int) $factura->total_steams), 2);
                            }
                        } else {
                            $precio = number_format(((int) $factura->qty * (float) $factura->price * (int) $factura->qty_bunches), 2);
                        }
                    }
                } else {

                    if ((($factura->product_category_id == 3) && ($factura->cliente_id == 9))) {
                        $precio = number_format(((int) $factura->qty * (float) $factura->price * (int) $factura->qty_bunches), 2);
                    } else {
                        if ($factura->cliente_id == 5) {
                            if ($factura->product_category_id == 6 || $factura->product_category_id == 7 || $factura->product_category_id == 8) {

                                $precio = number_format(((int) $factura->qty * (float) $factura->price * (int) $factura->qty_bunches), 2);
                            } else {
                                $precio = number_format(((int) $factura->qty * (float) $factura->price * (int) $factura->total_steams), 2);
                            }
                        } else {
                            $precio = number_format(((int) $factura->qty * (float) $factura->price * (int) $factura->total_steams), 2);
                        }
                    }
                }
                $contador = 1;
                if (count($factura->boxs) > 0) {

                    $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $producto);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, "");
                    $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, "");
                    $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, "");
                    $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $factura->qty);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, "");
                    $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, "");
                    $excel_row++;
                    foreach ($factura->boxs as $box) {
                        $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, "Items caja nro: " . $contador);
                        $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, "");
                        $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, "");
                        $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, "");
                        $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, "");
                        $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, "");
                        $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, "");
                        $excel_row++;
                        foreach ($box->element as $element) {

                            $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $element->product);
                            $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $element->name);
                            $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $element->nro_bunches);
                            $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $element->nro_bunches * $element->stems_bunch);
                            $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, "");
                            $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, number_format($element->price_finca, 2));
                            $precio = (((int) $element->nro_bunches * (int) $element->stems_bunch) * (float) $element->price_finca);
                            $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row,  number_format($precio, 2));
                            $total = $total + number_format($precio, 2);
                            $excel_row++;
                        }
                        $contador++;
                    }
                } else {
                    $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $producto);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $factura->measure);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $factura->qty_bunches);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $factura->total_steams);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $factura->qty);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, number_format($factura->price, 2));
                    $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $precio);

                    $total = $total + $precio;

                    $excel_row++;
                }

                $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, "TOTAL = ");
                $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, "$" . number_format($total, 2));
                $object->getActiveSheet()->getStyle('A' . $excel_row)->applyFromArray($estilo);
                $object->getActiveSheet()->getStyle('B' . $excel_row)->applyFromArray($estilo);
                $object->getActiveSheet()->getStyle('C' . $excel_row)->applyFromArray($estilo);
                $object->getActiveSheet()->getStyle('D' . $excel_row)->applyFromArray($estilo);
                $object->getActiveSheet()->getStyle('E' . $excel_row)->applyFromArray($estilo);
                $object->getActiveSheet()->getStyle('F' . $excel_row)->applyFromArray($estilo);
                $object->getActiveSheet()->getStyle('G' . $excel_row)->applyFromArray($estilo);
            }
            $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="Factura por finca.xls"');
            ob_end_clean();
            ob_start();
            $object_writer->save('php://output');
        }
        $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Factura por finca.xls"');
        ob_end_clean();
        ob_start();
        $object_writer->save('php://output');
    }
    public function exportar_factura($request_id = 0)
    {
        $this->load->model('Empresa_model', 'company');
        $this->load->model('Buy_model', 'buy');
        $this->load->model('Buy_element_model', 'buy_element');
        $this->load->model('Client_model', 'cliente');
        $this->load->model('Provider_model', 'provider');
        $this->load->model('Invoice_provider_model', 'invoice_provider');
        $this->load->model('Reques_model', 'invoice_provider');
        $empresa_object = $this->company->get_by_id(1);
        $invoice_object = $this->request->get_invoice_by_request($request_id);

        $request_object = $this->request->get_by_id($request_id);
        $all_request_product = $this->request->get_request_product_by_dailing($request_id);
        $cliente_object = $this->cliente->get_cliente_by_id($request_object->cliente_id);
        $objecto = $this->request->get_by_id($request_id);
        // $all_buy_element = $this->buy_element->get_element_by_request_id($request_id);
        $all_providers = $this->buy_element->get_element_by_request_group($request_id);

        foreach ($all_providers as $item) {
            $item->contador = count($this->buy_element->get_element_by_request_pro($item->buy_id, $item->provider_id));
            $item->elementos = $this->buy_element->get_element_by_request_id2($request_id, $item->provider_id);
            foreach ($item->elementos as $elemento) {
                $boxs = $this->buy_element->get_box_element_id($elemento->buy_element_id);

                if ($boxs) {

                    foreach ($boxs as $box) {
                        $box->element = $this->buy_element->get_element_by_id($box->box_element_id);
                    }
                }
                $elemento->boxs = $boxs;
            }
        }

        if ($invoice_object) {

            if ($objecto) {
                $this->session->set_flashdata('data_po', $objecto->purchase_order);
            }
            $data['all_buy_element'] = $all_providers;
            $data['all_request_product'] = $all_request_product;
            $data['cliente_object'] = $cliente_object;
            $data['request_object'] = $request_object;
            $data['invoice_object'] = $invoice_object;
            $data['empresa_object'] = $empresa_object;
            //   $data['compara'] = $all_providers;
            $html = $this->load->view('request/factura_pdf', $data, true);
            $pdfFilePath = "Dimention_flowers_PO.pdf";

            //load mPDF library
            $this->load->library('M_pdf');
            $mpdf = new mPDF('c', 'A4');

            $mpdf->WriteHTML($html);
            //  ob_clean();
            $mpdf->Output($pdfFilePath, "D");
            exit();
        } else {
            show_404();
        }
    }

    public function programation()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2, 4])) {
            $this->log_out();
            redirect('login/index');
        }
        $this->load->model('Buy_element_model', 'buy_element');
        $fecha = date('Y-m-d', strtotime($this->input->post('date_reception')));
        $cliente_id = $this->input->post('clientes_programacion');

        $request_date =  $this->request->get_request_by_date($fecha);

        foreach ($request_date as $item) {
            $item->all_requests = $this->request->get_request_all($item->date_time_reception, $cliente_id);


            foreach ($item->all_requests as $all_requests) {
                $buy_element = $this->buy_element->get_element_by_request_id($all_requests->request_id);

                if ($buy_element) {
                    foreach ($buy_element as $item) {
                        $item->element = $this->buy_element->get_element_by_id($item->buy_element_id);
                    }
                }
                $all_requests->buy_element = $buy_element;
            }
        }
        /*   foreach ($request_date as $item) {
            $item->all_requests = $this->request->get_request_all($item->date_time_reception, $cliente_id);
            foreach ($item->all_requests as $all_requests) {
                $buy_element = $this->buy_element->get_element_by_request_id($all_requests->request_id);

                if ($buy_element) {
                    foreach ($buy_element as $item) {
                        $item->element = $this->buy_element->get_element_by_id($item->buy_element_id);
                    }
                }
                $all_requests->buy_element = $buy_element;
            }
        }*/

        $data['request_date'] = $request_date;
        $data['cliente_id'] = $cliente_id;

        $this->load_view_admin_g("request/index_programation", $data);
    }

    function exportar_programation($date_time_reception = 0, $cliente_id = 0)
    {
        $this->load->library("excel");
        $object = new PHPExcel();

        $this->load->model('Buy_element_model', 'buy_element');

        $request_date =  $this->request->get_request_by_date($date_time_reception);
        foreach ($request_date as $item) {
            $item->all_requests = $this->request->get_request_all($item->date_time_reception, $cliente_id);
            foreach ($item->all_requests as $all_requests) {
                $buy_element = $this->buy_element->get_element_by_request_id($all_requests->request_id);

                if ($buy_element) {
                    foreach ($buy_element as $item) {
                        $item->element = $this->buy_element->get_element_by_id($item->buy_element_id);
                    }
                }
                $all_requests->buy_element = $buy_element;
            }
        }



        // $object->setActiveSheetIndex(0);
        $object->setActiveSheetIndex(0)->mergeCells('A3:I3');
        //  $object->setActiveSheetIndex(0)->mergeCells('A2:B2');

        $object->getActiveSheet()->setCellValueByColumnAndRow('A', 3, "PROGRAMACION");
        $object->getActiveSheet()->setCellValueByColumnAndRow(0, 4, "FECHA DE VUELO: " . $date_time_reception);


        $object->getActiveSheet()->getStyle("A5")->getFont()->setBold(true);
        $table_columns = array("FINCA", "VARIEDAD", "MEDIDA", "NRO CAJAS", "TIPO DE CAJA", "TALLOS", "MARCACION", "DESTINO", "PO");

        $column = 0;

        foreach ($table_columns as $field) {
            $object->getActiveSheet()->setCellValueByColumnAndRow($column, 5, $field);
            $column++;
        }
        for ($col = 'A'; $col != 'I'; $col++) {
            $object->getActiveSheet()->getColumnDimension($col)->setAutoSize(true);
        }

        $estilo = array(
            'borders' => array(
                'outline' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );

        $object->getActiveSheet()->getStyle('A3:I3')->applyFromArray($estilo);
        $object->getActiveSheet()->getStyle('A4:I4')->applyFromArray($estilo);
        $object->getActiveSheet()->getStyle('A5')->applyFromArray($estilo);
        $object->getActiveSheet()->getStyle('B5')->applyFromArray($estilo);
        $object->getActiveSheet()->getStyle('B4')->applyFromArray($estilo);
        $object->getActiveSheet()->getStyle('C5')->applyFromArray($estilo);
        $object->getActiveSheet()->getStyle('D5')->applyFromArray($estilo);
        $object->getActiveSheet()->getStyle('E5')->applyFromArray($estilo);
        $object->getActiveSheet()->getStyle('F5')->applyFromArray($estilo);
        $object->getActiveSheet()->getStyle('G5')->applyFromArray($estilo);
        $object->getActiveSheet()->getStyle('H5')->applyFromArray($estilo);
        $object->getActiveSheet()->getStyle('I5')->applyFromArray($estilo);


        $object->getActiveSheet()->getStyle("A3:I3")->getFont()->setBold(true);
        $object->getActiveSheet()->getStyle("A4:I4")->getFont()->setBold(true);
        $object->getActiveSheet()->getStyle("A5:I5")->getFont()->setBold(true);

        $excel_row = 6;
        $total = 0;

        foreach ($request_date as $item) {

            foreach ($item->all_requests as $buy_element) {
                foreach ($buy_element->buy_element as $element) {

                    $object->getActiveSheet()->getStyle('A' . $excel_row)->applyFromArray($estilo);
                    $object->getActiveSheet()->getStyle('B' . $excel_row)->applyFromArray($estilo);
                    $object->getActiveSheet()->getStyle('C' . $excel_row)->applyFromArray($estilo);
                    $object->getActiveSheet()->getStyle('D' . $excel_row)->applyFromArray($estilo);
                    $object->getActiveSheet()->getStyle('E' . $excel_row)->applyFromArray($estilo);
                    $object->getActiveSheet()->getStyle('F' . $excel_row)->applyFromArray($estilo);
                    $object->getActiveSheet()->getStyle('G' . $excel_row)->applyFromArray($estilo);
                    $object->getActiveSheet()->getStyle('H' . $excel_row)->applyFromArray($estilo);
                    $object->getActiveSheet()->getStyle('I' . $excel_row)->applyFromArray($estilo);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $element->provider);
                    if ($element->etiqueta == NULL) {
                        $producto = $element->product;
                    } else {
                        $producto = $element->etiqueta;
                    }
                    $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $producto);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $element->measure);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $element->qty);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $element->box);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $element->total_steams);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row,  $element->dialing);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row,  $element->destination);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(8, $excel_row,  $element->purchase_order);
                    $total = $total + $element->qty;

                    $excel_row++;
                    if ($element->element) {
                        foreach ($element->element as $item) {
                            $object->getActiveSheet()->getStyle('A' . $excel_row)->applyFromArray($estilo);
                            $object->getActiveSheet()->getStyle('B' . $excel_row)->applyFromArray($estilo);
                            $object->getActiveSheet()->getStyle('C' . $excel_row)->applyFromArray($estilo);
                            $object->getActiveSheet()->getStyle('D' . $excel_row)->applyFromArray($estilo);
                            $object->getActiveSheet()->getStyle('E' . $excel_row)->applyFromArray($estilo);
                            $object->getActiveSheet()->getStyle('F' . $excel_row)->applyFromArray($estilo);
                            $object->getActiveSheet()->getStyle('G' . $excel_row)->applyFromArray($estilo);
                            $object->getActiveSheet()->getStyle('H' . $excel_row)->applyFromArray($estilo);
                            $object->getActiveSheet()->getStyle('I' . $excel_row)->applyFromArray($estilo);

                            $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $item->product);
                            $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $item->name);
                            $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, "");
                            $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, "");
                            $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $item->nro_bunches * $item->stems_bunch);
                            $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row,  "");
                            $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, "");
                            $object->getActiveSheet()->setCellValueByColumnAndRow(8, $excel_row,  "");
                            $excel_row++;
                        }
                    }
                }
            }
        }

        $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, "TOTAL = " . $total);
        $object->getActiveSheet()->getStyle('A' . $excel_row)->applyFromArray($estilo);
        $object->getActiveSheet()->getStyle('B' . $excel_row)->applyFromArray($estilo);
        $object->getActiveSheet()->getStyle('C' . $excel_row)->applyFromArray($estilo);
        $object->getActiveSheet()->getStyle('D' . $excel_row)->applyFromArray($estilo);
        $object->getActiveSheet()->getStyle('E' . $excel_row)->applyFromArray($estilo);
        $object->getActiveSheet()->getStyle('F' . $excel_row)->applyFromArray($estilo);
        $object->getActiveSheet()->getStyle('G' . $excel_row)->applyFromArray($estilo);
        $object->getActiveSheet()->getStyle('H' . $excel_row)->applyFromArray($estilo);
        $object->getActiveSheet()->getStyle('I' . $excel_row)->applyFromArray($estilo);
        $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Programacion.xls"');
        ob_end_clean();
        ob_start();

        $object_writer->save('php://output');
    }

    public function add_factura_index($id)
    {

        if (!in_array($this->session->userdata('role_id'), [1, 2, 4])) {
            $this->log_out();
            redirect('login/index');
        }
        $this->load->model('client_model', 'client');
        $this->load->model('Buy_model', 'buy');
        $this->load->model('Buy_element_model', 'buy_element');
        $buy_object = $this->buy->get_buy_by_request_id($id);
        $max = $this->buy_element->get_all_by_buy_id($buy_object->buy_id);
        $object_request = $this->request->get_by_id($id);
        if ($object_request) {
            $cliente = $this->client->get_by_id($object_request->cliente_id);
            $data['cliente'] = $cliente;
            $data['object_request'] = $object_request;
            $data['awb_max'] = $max;


            $this->load_view_admin_g("request/add_factura_index", $data);
        } else {
            show_404();
        }
    }

    public function add_factura()
    {

        if (!in_array($this->session->userdata('role_id'), [1, 2, 4])) {
            $this->log_out();
            redirect('login/index');
        }
        $this->load->model('Empresa_model', 'company');
        $this->load->model('Buy_model', 'buy');
        $this->load->model('Buy_element_model', 'buy_element');
        $this->load->model('Client_model', 'client');
        $this->load->model('Provider_model', 'provider');
        $this->load->model('Invoice_provider_model', 'invoice_provider');
        $this->load->model('Request_model', 'request');
        $request_id = $this->input->post('request_id');
        $objecto = $this->request->get_by_id($request_id);
        $nro_factura = $this->input->post('nro_factura');
        $request_obj = $this->request->get_by_id($request_id);
        $cliente_obj = $this->client->get_by_id($request_obj->cliente_id);
        $obj = $this->request->get_by_invoice_request_id($request_id);
        $awb = $this->input->post('awb');
        $price = $this->input->post('price');
        $date = date("y-m-d");
        //establecer reglas de validacion
        $this->form_validation->set_rules('nro_factura', translate('nro_factura'), 'required');
        $this->form_validation->set_rules('awb', translate('awb_lang'), 'required');
        $this->form_validation->set_rules('price', translate('price_transporte_lang'), 'numeric|required');

        if ($this->form_validation->run() == FALSE) { //si alguna de las reglas de validacion fallaron
            $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
            redirect("request/add_factura_index/" . $request_id);
        } else {

            if (!$obj) {
                $data = ['nro_invoice' => $nro_factura, 'awb' => $awb, 'price_transporte' => $price, 'date' => $date, 'request_id' => $request_id];
                $id =  $this->request->create_invoice($data);
                $this->request->update($request_id, ['invoice_active' => 1]);
                $invoice_object = $this->request->get_by_invoice_id($id);
                if ($invoice_object) {
                    $all_providers = $this->buy_element->get_element_by_request_group($request_id);
                    foreach ($all_providers as $pro) {
                        $pro->contador = count($this->buy_element->get_element_by_request_pro($pro->buy_id, $pro->provider_id));
                        $pro->elementos = $this->buy_element->get_element_by_request_id2($request_id, $pro->provider_id);
                        foreach ($pro->elementos as $elemento) {
                            $boxs = $this->buy_element->get_box_element_id($elemento->buy_element_id);
                            if ($boxs) {
                                foreach ($boxs as $box) {
                                    $box->element = $this->buy_element->get_element_by_id($box->box_element_id);
                                }
                            }
                            $elemento->boxs = $boxs;
                        }
                    }
                    $acum_total_price = 0;
                    $acum_QB = 0;
                    $acum_total_steams = 0;
                    $acum_HB = 0;
                    $acum_total_bunches = 0;
                    $acum_EB = 0;
                    foreach ($all_providers as $item) {

                        foreach ($item->elementos as $elemento) {

                            if (count($elemento->boxs) > 0) {

                                if ($elemento->box == "QB") {
                                    $acum_QB += $elemento->qty;
                                }
                                if ($elemento->box == "HB") {
                                    $acum_HB += $elemento->qty;
                                }
                                if ($elemento->box == "EB") {
                                    $acum_EB += $elemento->qty;
                                }

                                $elemento->box;
                                $elemento->product;
                                foreach ($elemento->boxs as $box) {
                                    foreach ($box->element as $pro) {

                                        $total_bunches =  (int) $pro->nro_bunches * (int) $box->nro_cajas;
                                        $acum_total_bunches += $total_bunches;
                                        $total_steams =  (int) $pro->nro_bunches * (int) $pro->stems_bunch * (int) $box->nro_cajas;
                                        $price_unit = (float) $pro->price_cliente;
                                        $acum_total_steams += (int) $total_steams;
                                        $sub = $price_unit * $total_steams;

                                        $acum_total_price += $sub;
                                    }
                                }
                            } else {

                                if ($elemento->box == "QB") {
                                    $acum_QB += $elemento->qty;
                                }
                                if ($elemento->box == "HB") {
                                    $acum_HB += $elemento->qty;
                                }
                                if ($elemento->box == "EB") {
                                    $acum_EB += $elemento->qty;
                                }

                                $unit = (float) $elemento->unit_price;

                                if ($elemento->product_category_id  == 4 || $elemento->product_category_id  == 5 || $elemento->product_category_id  == 27 || $elemento->product_category_id  == 31 || $elemento->product_category_id  == 10 || $elemento->product_category_id  == 25) {

                                    if (($elemento->product_category_id == 31 && ($request_obj->cliente_id == 6)) || ($elemento->product_category_id == 31 && ($request_obj->cliente_id == 12))) {

                                        $sub = number_format(((float) $elemento->qty *  number_format($unit, 3)  * (float) $elemento->qty_bunches), 2);
                                        $acum_total_price = $acum_total_price + ((float) $elemento->qty *  number_format($unit, 2)  * (int) $elemento->qty_bunches);
                                        $bunches = (int) $elemento->qty_bunches * (int) $elemento->qty;
                                        $tallos = (int) $elemento->total_steams * (int) $elemento->qty;
                                        $acum_total_bunches = $acum_total_bunches + $bunches;
                                        $acum_total_steams = $acum_total_steams + $tallos;
                                    } else {
                                        if ($request_obj->cliente_id != 5) {
                                            if ($elemento->product_category_id == 25) {
                                                $sub = number_format(((float) $elemento->qty *  number_format($unit, 3)  * (int) $elemento->qty_bunches), 2);
                                                $acum_total_price = $acum_total_price + ((float) $elemento->qty *  number_format($unit, 3) * (int) $elemento->qty_bunches);
                                                $bunches = (int) $elemento->qty_bunches * (int) $elemento->qty;
                                                $tallos = (int) $elemento->total_steams * (int) $elemento->qty;
                                                $acum_total_bunches = $acum_total_bunches + $bunches;
                                                $acum_total_steams = $acum_total_steams + $tallos;
                                            } else {
                                                $sub = number_format(((float) $elemento->qty *  number_format($unit, 3)  * (int) $elemento->total_steams), 2);
                                                $acum_total_price = $acum_total_price + ((float) $elemento->qty *  number_format($unit, 3)  * (int) $elemento->total_steams);
                                                $bunches = (int) $elemento->qty_bunches * (int) $elemento->qty;
                                                $tallos = (int) $elemento->total_steams * (int) $elemento->qty;
                                                $acum_total_bunches = $acum_total_bunches + $bunches;
                                                $acum_total_steams = $acum_total_steams + $tallos;
                                            }
                                        } else {
                                            $sub = number_format(((float) $elemento->qty *  number_format($unit, 3)  * (int) $elemento->qty_bunches), 2);
                                            $acum_total_price = $acum_total_price + ((float) $elemento->qty * number_format($unit, 3)  * (int) $elemento->qty_bunches);
                                            $bunches = (int) $elemento->qty_bunches * (int) $elemento->qty;
                                            $tallos = (int) $elemento->total_steams * (int) $elemento->qty;
                                            $acum_total_bunches = $acum_total_bunches + $bunches;
                                            $acum_total_steams = $acum_total_steams + $tallos;
                                        }
                                    }
                                } else {
                                    if ((($item->product_category_id == 3) && ($request_obj->cliente_id == 9))) {

                                        $sub = number_format(((float) $elemento->qty *  number_format($unit, 3)  * (int) $elemento->qty_bunches), 2);
                                        $acum_total_price = $acum_total_price + ((float) $elemento->qty *  number_format($unit, 3)  * (int) $elemento->qty_bunches);
                                        $bunches = (int) $elemento->qty_bunches * (int) $elemento->qty;
                                        $tallos = (int) $elemento->total_steams * (int) $elemento->qty;
                                        $acum_total_bunches = $acum_total_bunches + $bunches;
                                        $acum_total_steams = $acum_total_steams + $tallos;
                                    } else {
                                        if ($elemento->product_category_id  == 6 || $elemento->product_category_id  == 7 || $elemento->product_category_id  == 8) {
                                            if ($request_obj->cliente_id  == 5) {
                                                $sub = number_format(((float) $elemento->qty *  number_format($unit, 3)  * (int) $elemento->qty_bunches), 2);
                                                $acum_total_price = $acum_total_price + ((float) $elemento->qty *  number_format($unit, 3)  * (int) $elemento->qty_bunches);
                                                $bunches = (int) $elemento->qty_bunches * (int) $elemento->qty;
                                                $tallos = (int) $elemento->total_steams * (int) $elemento->qty;
                                                $acum_total_bunches = $acum_total_bunches + $bunches;
                                                $acum_total_steams = $acum_total_steams + $tallos;
                                            } else {

                                                $sub = number_format(((int) $elemento->qty *  number_format($unit, 3)  * (int) $elemento->total_steams), 2);
                                                $acum_total_price = $acum_total_price + ((float) $elemento->qty *  number_format($unit, 3)  * (int) $elemento->total_steams);
                                                $bunches = (int) $elemento->qty_bunches * (int) $elemento->qty;
                                                $tallos = (int) $elemento->total_steams * (int) $elemento->qty;
                                                $acum_total_bunches = $acum_total_bunches + $bunches;
                                                $acum_total_steams = $acum_total_steams + $tallos;
                                            }
                                        } else {
                                            $sub = number_format((int) $elemento->qty *  number_format($unit, 3) * (int) $elemento->total_steams, 2);
                                            $acum_total_price = $acum_total_price + ((int) $elemento->qty *  number_format($unit, 3)  * (int) $elemento->total_steams);
                                            $bunches = (int) $elemento->qty_bunches * (int) $elemento->qty;
                                            $tallos = (int) $elemento->total_steams * (int) $elemento->qty;
                                            $acum_total_bunches = $acum_total_bunches + $bunches;
                                            $acum_total_steams = $acum_total_steams + $tallos;
                                        }
                                    }
                                }
                            }
                        }
                    }
                    $calculo =  $acum_total_price + (float) $invoice_object->price_transporte;
                    $this->request->update_invoice($request_id, ['total_invoice' => $calculo]);
                }

                if ($id) {
                    if ($objecto) {
                        $this->session->set_flashdata('data_po', $objecto->purchase_order);
                    }
                    $this->client->update($cliente_obj->cliente_id, ['secuencial' => $nro_factura]);
                    $this->session->set_flashdata('request_id', $request_id);
                    $this->session->set_flashdata('incoive_id', $id);

                    $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);

                    redirect("request/index", "location", 301);
                } else {
                    if ($objecto) {
                        $this->session->set_flashdata('data_po', $objecto->purchase_order);
                    }
                    $this->response->set_message("Error en generar factura del cliente", ResponseMessage::SUCCESS);
                    redirect("request/index", "location", 301);
                }
            } else {
                if ($objecto) {
                    $this->session->set_flashdata('data_po', $objecto->purchase_order);
                }
                $this->response->set_message("Error en generar factura del cliente ya pertenece a un PO", ResponseMessage::SUCCESS);
                redirect("request/index", "location", 301);
            }
        }
    }
    public function edit_request()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2, 4])) {
            $this->log_out();
            redirect('login/index');
        }
        $this->load->model('Request_model', 'request');
        $this->load->model('Request_product_model', 'request_product');
        $this->load->model('Request_product_box_model', 'request_product_box');
        $this->load->model('Request_model', 'request');

        $purchase = $this->input->post('purchase');
        $date_purchase = $this->input->post('date_purchase');
        $date_reception = $this->input->post('date_reception');
        $request_id = $this->input->post('request_id');
        $request_product_ids = [];
        $data = json_decode($_POST['array']);

        $data_request = [
            'date_time_reception' => $date_reception,
            'date_purchase' => $date_purchase,
            'purchase_order' => $purchase,
            'state' => 0
        ];
        $this->request->update($request_id, $data_request);

        for ($i = 0; $i < count($data); $i++) {
            $request_product_id =  $data[$i]->request_product_id;
            $product_measure_id =  $data[$i]->variety_measure_id;
            $dialing_name = $data[$i]->dialing_name;
            $qty_bunches = $data[$i]->qty_bunches;
            $unit_price = $data[$i]->precio;
            $tolal_price = $data[$i]->subtotal;
            $box_type_id = $data[$i]->tipo_id;
            $total_steams = $data[$i]->total_bunches;
            $product_id = $data[$i]->product_id;
            $qty = $data[$i]->cantidad;
            $destino_id = $data[$i]->destino_id;
            $carguera_id = $data[$i]->carguera_id;
            if ($request_product_id > 0) {
                $data_request_product = [
                    'measure_id' => $product_measure_id,
                    'product_id' => $product_id,
                    'dialing_name' => $dialing_name,
                    'qty_bunches' => $qty_bunches,
                    'unit_price' => $unit_price,
                    'total_price' => $tolal_price,
                    'total_steams' => $total_steams,
                    'destination_id' => $destino_id,
                    'carguera_id' => $carguera_id,
                ];
                $result = $this->request_product->update($request_product_id, $data_request_product);
                if ($result) {
                    $data_request_product_box = [
                        'qty' => $qty,
                        'box_type_id' => $box_type_id
                    ];
                    $this->request_product_box->update_request_product_id($request_product_id, $data_request_product_box);
                }
                array_push($request_product_ids, $request_product_id);
            } else {
                $data_request_product = [
                    'request_id' => $request_id,
                    'measure_id' => $product_measure_id,
                    'product_id' => $product_id,
                    'dialing_name' => $dialing_name,
                    'qty_bunches' => $qty_bunches,
                    'unit_price' => $unit_price,
                    'total_price' => $tolal_price,
                    'total_steams' => $total_steams,
                    'destination_id' => $destino_id,
                    'carguera_id' => $carguera_id,
                    'status' => 0
                ];
                $request_product_id = $this->request_product->create($data_request_product);
                if ($request_product_id) {
                    $data_request_product_box = [
                        'request_product_id' => $request_product_id,
                        'qty' => $qty,
                        'box_type_id' => $box_type_id
                    ];
                    $this->request_product_box->create($data_request_product_box);
                }
                array_push($request_product_ids, $request_product_id);
            }
        }
        $all_pedido = $this->request->get_request_by_id($request_id);
        foreach ($all_pedido as $item) {
            if (!in_array($item->request_product_id, $request_product_ids)) {
                $this->request_product_box->delete_request_product_id($item->request_product_id);
                $this->request_product->delete($item->request_product_id);
            }
        }
        $objecto = $this->request->get_by_id($request_id);
        if ($objecto) {
            $this->session->set_flashdata('data_po', $objecto->purchase_order);
        }
        $this->response->set_message("pedido editado correctamente", ResponseMessage::SUCCESS);

        echo json_encode(1);
        exit();
    }
    public function update_variedad_element()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2, 4])) {
            $this->log_out();
            redirect('login/index');
        }

        $variedad = $this->input->post('variedad');
        $buy_element_id = $this->input->post('buy_element_id');
        $request_id = $this->input->post('request_id');
        $provider_id = $this->input->post('provider_id');
        //establecer reglas de validacion
        $this->form_validation->set_rules('variedad', "El campo variedad no puede estar vacio.", 'required');



        if ($this->form_validation->run() == FALSE) { //si alguna de las reglas de validacion fallaron
            $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
            redirect("request/confirmar_factura/" . $request_id . "/" . $provider_id);
        } else { //en caso de que todo este bien
            $data = [
                'etiqueta' => $variedad
            ];
            $this->load->model('Buy_element_model', 'buy_element');
            $this->buy_element->update($buy_element_id, $data);
            $this->response->set_message(translate('data_saved_ok'), ResponseMessage::SUCCESS);
            redirect("request/confirmar_factura/" . $request_id . "/" . $provider_id);
        }
    }
    public function exportar_factura_pro($provider_id = 0, $buy_id)
    {


        $this->load->model('Buy_model', 'buy');
        $this->load->model('Buy_element_model', 'buy_element');
        $this->load->model('Variety_model', 'variety');
        $this->load->model('Provider_model', 'provider');
        $this->load->model('Client_model', 'cliente');
        $this->load->model('Carguera_model', 'carguera');
        $this->load->model('Request_model', 'request');
        $this->load->model('Invoice_provider_model', 'invoice_provider');

        // $all_request = $this->buy->get_by_request_id2($id);

        // $item->provider = $this->buy_element->get_element_by_provider_id($item->request_id);
        $invoice_provider_object = $this->invoice_provider->get_invoice_by_id($provider_id, $buy_id);

        $invoice_provider_object2 = $this->invoice_provider->get_invoice_by_id2($provider_id, $buy_id);

        $all_buy_elements = $this->buy_element->get_element_by_provider_id($invoice_provider_object->request_id, $provider_id);
        foreach ($all_buy_elements as $item) {
            $boxs = $this->buy_element->get_box_element_id($item->buy_element_id);

            if ($boxs) {

                foreach ($boxs as $box) {
                    $box->element = $this->buy_element->get_element_by_id($box->box_element_id);
                }
            }
            $item->boxs = $boxs;
        }

        $carguera = $this->carguera->get_by_id($all_buy_elements[0]->carguera_id);
        $request = $this->request->get_by_id($invoice_provider_object->request_id);
        $cliente = $this->cliente->get_by_id($request->cliente_id);
        $provider = $this->provider->get_by_id($provider_id);
        $data['invoice_provider_object'] = $invoice_provider_object;
        $data['invoice_provider_object2'] = $invoice_provider_object2;
        $data['all_buy_elements'] = $all_buy_elements;
        $data['cliente'] = $cliente;
        $data['request_object'] = $request;
        $data['carguera'] = $carguera;
        $data['cod'] = $invoice_provider_object->cod_carguera;
        $data['provider'] = $provider;

        $html = $this->load->view('request/factura_pro', $data, true);
        $pdfFilePath = "Dimention_flowers_PO.pdf";

        //load mPDF library
        $this->load->library('M_pdf');
        $mpdf = new mPDF('c', 'A4');
        $mpdf->WriteHTML($html);
        $mpdf->Output($pdfFilePath, "D");
    }
    public function exportar_factura_packing($provider_id = 0, $buy_id)
    {


        $this->load->model('Buy_model', 'buy');
        $this->load->model('Buy_element_model', 'buy_element');
        $this->load->model('Variety_model', 'variety');
        $this->load->model('Provider_model', 'provider');
        $this->load->model('Client_model', 'cliente');
        $this->load->model('Carguera_model', 'carguera');
        $this->load->model('Request_model', 'request');
        $this->load->model('Invoice_provider_model', 'invoice_provider');

        // $all_request = $this->buy->get_by_request_id2($id);

        // $item->provider = $this->buy_element->get_element_by_provider_id($item->request_id);
        $invoice_provider_object = $this->invoice_provider->get_invoice_by_id($provider_id, $buy_id);

        $invoice_provider_object2 = $this->invoice_provider->get_invoice_by_id2($provider_id, $buy_id);

        $all_buy_elements = $this->buy_element->get_element_by_provider_id($invoice_provider_object->request_id, $provider_id);
        foreach ($all_buy_elements as $item) {
            $boxs = $this->buy_element->get_box_element_id($item->buy_element_id);

            if ($boxs) {

                foreach ($boxs as $box) {
                    $box->element = $this->buy_element->get_element_by_id($box->box_element_id);
                }
            }
            $item->boxs = $boxs;
        }

        $carguera = $this->carguera->get_by_id($all_buy_elements[0]->carguera_id);
        $request = $this->request->get_by_id($invoice_provider_object->request_id);
        $cliente = $this->cliente->get_by_id($request->cliente_id);
        $provider = $this->provider->get_by_id($provider_id);
        $data['invoice_provider_object'] = $invoice_provider_object;
        $data['invoice_provider_object2'] = $invoice_provider_object2;
        $data['all_buy_elements'] = $all_buy_elements;
        $data['cliente'] = $cliente;
        $data['request_object'] = $request;
        $data['carguera'] = $carguera;
        $data['cod'] = $invoice_provider_object->cod_carguera;
        $data['provider'] = $provider;

        $html = $this->load->view('request/factura_packing', $data, true);
        $pdfFilePath = "Dimention_flowers_PO.pdf";

        //load mPDF library
        $this->load->library('M_pdf');
        $mpdf = new mPDF('c', 'A4');
        $mpdf->WriteHTML($html);
        $mpdf->Output($pdfFilePath, "D");
    }
    public function add_elements()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2, 4])) {
            $this->log_out();
            redirect('login/index');
        }
        $this->load->model('Request_model', 'request');
        $this->load->model('Buy_model', 'buy');
        $this->load->model('Buy_element_model', 'buy_element');

        $this->load->model('Request_product_model', 'request_product');
        $this->load->model('Request_product_box_model', 'request_product_box');

        $buy_element = $this->input->post('buy_element');
        $request = $this->input->post('request');
        $provider = $this->input->post('provider');
        $box_type = $this->input->post('box_type');
        $nro_cajas = $this->input->post('nro_cajas');
        $user_id = $this->session->userdata('user_id');
        $data = json_decode($_POST['array']);
        $box_element_id =  $this->buy_element->create_box_element(['box_type_id' => $box_type, 'buy_element_id' => $buy_element, 'nro_cajas' => $nro_cajas]);
        if ($box_element_id) {
            for ($i = 0; $i < count($data); $i++) {

                $etiqueta = $data[$i]->etiqueta;
                $measure_id = $data[$i]->measure_id;
                $nro_bunches = $data[$i]->nro_bunches;
                $price_cliente = $data[$i]->price_cliente;
                $price_finca = $data[$i]->price_finca;


                $data_buy_element = [
                    'product_id' => $etiqueta,
                    'measure_id' => $measure_id,
                    'nro_bunches' => $nro_bunches,
                    'price_cliente' => $price_cliente,
                    'price_finca' => $price_finca,
                    'box_element_id' => $box_element_id

                ];
                $this->buy_element->create_element($data_buy_element);
            }
        }
        $this->response->set_message("compra realizada correctamente", ResponseMessage::SUCCESS);

        echo json_encode($data);
        exit();
    }

    public function add_elements_2()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2, 4])) {
            $this->log_out();
            redirect('login/index');
        }
        $this->load->model('Request_model', 'request');
        $this->load->model('Buy_model', 'buy');
        $this->load->model('Buy_element_model', 'buy_element');

        $this->load->model('Request_product_model', 'request_product');
        $this->load->model('Request_product_box_model', 'request_product_box');

        $buy_element = $this->input->post('buy_element');
        $request = $this->input->post('request');
        $provider = $this->input->post('provider');
        $box_type = $this->input->post('box_type');
        $nro_cajas = $this->input->post('nro_cajas');
        $user_id = $this->session->userdata('user_id');
        $data = json_decode($_POST['array']);
        $box_element_id =   $this->input->post('box_element');
        if ($box_element_id) {
            for ($i = 0; $i < count($data); $i++) {

                $etiqueta = $data[$i]->etiqueta;
                $measure_id = $data[$i]->measure_id;
                $nro_bunches = $data[$i]->nro_bunches;
                $price_cliente = $data[$i]->price_cliente;
                $price_finca = $data[$i]->price_finca;


                $data_buy_element = [
                    'product_id' => $etiqueta,
                    'measure_id' => $measure_id,
                    'nro_bunches' => $nro_bunches,
                    'price_cliente' => $price_cliente,
                    'price_finca' => $price_finca,
                    'box_element_id' => $box_element_id

                ];
                $this->buy_element->create_element($data_buy_element);
            }
        }
        $this->response->set_message("compra realizada correctamente", ResponseMessage::SUCCESS);

        echo json_encode($data);
        exit();
    }
    public function delete_item()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2, 4])) {
            $this->log_out();
            redirect('login/index');
        }

        $this->load->model('Buy_element_model', 'buy_element');
        $request_id = $this->input->post('request_delete');
        $provider_id = $this->input->post('provider_delete');
        $element_id = $this->input->post('element_id');

        $this->buy_element->delete_element($element_id);
        $this->response->set_message("item eliminado correctamente", ResponseMessage::SUCCESS);
        redirect("request/confirmar_factura/" . $request_id . "/" . $provider_id, "location", 301);
    }
    public function delete_all()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2, 4])) {
            $this->log_out();
            redirect('login/index');
        }

        $this->load->model('Buy_element_model', 'buy_element');
        $request_id = $this->input->post('request_delete_all');
        $provider_id = $this->input->post('provider_delete_all');
        $box_id = $this->input->post('box_id_delete_all');

        $this->buy_element->delete_box($box_id);
        $this->buy_element->delete_box_elements($box_id);
        $this->response->set_message("Eliminado correctamente", ResponseMessage::SUCCESS);
        redirect("request/confirmar_factura/" . $request_id . "/" . $provider_id, "location", 301);
    }
    public function update_item()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2, 4])) {
            $this->log_out();
            redirect('login/index');
        }

        $this->load->model('Buy_element_model', 'buy_element');
        $request_id = $this->input->post('request_id_update_item');
        $provider_id = $this->input->post('provider_id_update_item');
        $etiqueta_editar = $this->input->post('etiqueta_editar');
        $measure_editar = $this->input->post('measure_editar');
        $nro_bunches_editar = $this->input->post('nro_bunches_editar');
        $precio_cliente_editar = $this->input->post('precio_cliente_editar');
        $precio_finca_editar = $this->input->post('precio_finca_editar');
        $element_id = $this->input->post('element_id_update');
        $data = [
            'product_id' => $etiqueta_editar,
            'measure_id' => $measure_editar,
            'nro_bunches' => $nro_bunches_editar,
            'price_cliente' => $precio_cliente_editar,
            'price_finca' => $precio_finca_editar
        ];
        $this->buy_element->update_element($element_id, $data);
        $this->response->set_message("item actualizado correctamente", ResponseMessage::SUCCESS);
        redirect("request/confirmar_factura/" . $request_id . "/" . $provider_id, "location", 301);
    }

    public function update_box()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2, 4])) {
            $this->log_out();
            redirect('login/index');
        }

        $this->load->model('Buy_element_model', 'buy_element');
        $request_id = $this->input->post('request_id_box');
        $provider_id = $this->input->post('provider_id_box');
        $nro_cajas = $this->input->post('nro_cajas_box');

        $type_box = $this->input->post('type_box_editar');

        $box_element_id = $this->input->post('box_element_id_box');
        if ($nro_cajas) {
            $data = [
                'box_type_id' => $type_box,
                'nro_cajas' => $nro_cajas
            ];
        } else {
            $data = [
                'box_type_id' => $type_box,

            ];
        }

        $this->buy_element->update_box($box_element_id, $data);
        $this->response->set_message("item actualizado correctamente", ResponseMessage::SUCCESS);
        redirect("request/confirmar_factura/" . $request_id . "/" . $provider_id, "location", 301);
    }

    public function update_nro_invoice()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2, 4])) {
            $this->log_out();
            redirect('login/index');
        }

        $this->load->model('Invoice_provider_model', 'invoice');
        $request_id = $this->input->post('request_id_invoice');
        $provider_id = $this->input->post('provider_id_invoice');
        $nro_invoice = $this->input->post('invoice_nro');
        $nro_invoice_id = $this->input->post('nro_invoice_id');
        $total = $this->input->post('update_invoice_provider');


        $this->invoice->update($nro_invoice_id, ['nro_invoice' => $nro_invoice, 'total' => $total]);
        $this->response->set_message("item actualizado correctamente", ResponseMessage::SUCCESS);
        redirect("request/confirmar_factura/" . $request_id . "/" . $provider_id, "location", 301);
    }
    public function update_factura_carguera()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2, 4])) {
            $this->log_out();
            redirect('login/index');
        }

        $this->load->model('Invoice_provider_model', 'invoice');
        $request_id = $this->input->post('request_id_carguera_editar');
        $awb = $this->input->post('awb_editar');
        $hawb = $this->input->post('hawb_editar');
        $airline = $this->input->post('airline_editar');
        $nro_invoice_id = $this->input->post('invoice_provider_id_editar');


        $this->invoice->update($nro_invoice_id, ['awb' => $awb, 'hawb' => $hawb, 'airline' => $airline]);
        $this->response->set_message("Factura actualizada correctamente", ResponseMessage::SUCCESS);
        redirect("request/provider_index/" . $request_id, "location", 301);
    }

    public function calcular_iva()
    {

        if (!in_array($this->session->userdata('role_id'), [1, 2, 4])) {
            $this->log_out();
            redirect('login/index');
        }

        $this->load->model('Buy_element_model', 'buy_element');
        $provider_id = $this->input->post('provider_id_iva');
        $request_id = $this->input->post('request_id_iva');
        $all_buy_element   = $this->buy_element->get_element_by_provider_id($request_id, $provider_id);
        foreach ($all_buy_element as $item) {
            $boxs = $this->buy_element->get_box_element_id($item->buy_element_id);

            if ($boxs) {

                foreach ($boxs as $box) {
                    $box->element = $this->buy_element->get_element_by_id($box->box_element_id);
                }
            }
            $item->boxs = $boxs;
        }

        foreach ($all_buy_element as $item) {
            $iva = number_format($item->price, 2) * 1.12;
            $this->buy_element->update($item->buy_element_id, ['price' => $iva, 'iva_active' => 1]);
            if (count($item->boxs) > 0) {

                foreach ($item->boxs as $box) {
                    foreach ($box->element as $element) {
                        $iva = number_format($element->price_finca, 2) * 1.12;
                        $this->buy_element->update_element($element->element_id, ['price_finca' => $iva]);
                    }
                }
            }
        }
        $this->response->set_message(translate("mensaje_iva_lang"), ResponseMessage::SUCCESS);
        redirect("request/confirmar_factura/" . $request_id . "/" . $provider_id, "location", 301);
    }


    public function cambiar_finca()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2, 4])) {
            $this->log_out();
            redirect('login/index');
        }

        $this->load->model('Buy_element_model', 'buy_element');
        $request_id = $this->input->post('request_id_finca');
        $provider_id = $this->input->post('provider_id_finca');
        $nro_qty = $this->input->post('nro_cajas_proveedor');
        $provider_seleccionado = $this->input->post('providers');
        $buy_element_finca = $this->input->post('buy_element_finca');

        $object_buy_element = $this->buy_element->get_by_id($buy_element_finca);

        $diferencia = (int) $object_buy_element->qty - (int) $nro_qty;

        if ($diferencia == 0) {
            $this->buy_element->update($buy_element_finca, ['provider_id' => $provider_seleccionado]);
        } else {
            $this->buy_element->update($buy_element_finca, ['qty' => $diferencia]);
            $this->buy_element->create(['qty' => $nro_qty, 'price' => $object_buy_element->price, 'provider_id' => $provider_seleccionado, 'buy_id' => $object_buy_element->buy_id, 'request_product_id' => $object_buy_element->request_product_id, 'date' => date('Y-m-d'), 'etiqueta' => $object_buy_element->etiqueta, 'iva_active' => 0]);
        }

        $this->response->set_message("Actualizado la finca correctamente", ResponseMessage::SUCCESS);
        redirect("request/provider_index/" . $request_id, "location", 301);
    }


    public function update_item_po()
    {

        $this->load->model('Request_model', 'request');
        $this->load->model('Request_product_model', 'request_product');
        $this->load->model('Request_product_box_model', 'request_product_box');

        $marcacion = $this->input->post('marcacion');
        $carguera = $this->input->post('carguera');
        $cantidad_cajas =  $this->input->post('cantidad_cajas');
        $precio_unitario = $this->input->post('precio_unitario');
        $qty_bunches = $this->input->post('qty_bunches');
        $measure = $this->input->post('measure');
        $total_tallos = $this->input->post('total_tallos');
        $total_precio = $this->input->post('total_precio');
        $separado = explode('$', $total_precio);
        $total_precio = end($separado);
        $request_product_id = $this->input->post('request_product_id');
        $request_box_id = $this->input->post('request_box_id');
        $steams_bunch = $this->input->post('steams_bunch');
        $destino = $this->input->post('destino');
        $tipo_caja =  $this->input->post('tipo_caja_update');
        $data_1 = ['dialing_name' => $marcacion, 'qty_bunches' => $qty_bunches, 'total_steams' => $total_tallos, 'unit_price' => $precio_unitario, 'total_price' => $total_precio, 'measure_id' => $measure, 'destination_id' => $destino, 'carguera_id' => $carguera];
        $data_2 = ['qty' => $cantidad_cajas, 'box_type_id' => $tipo_caja];

        $result_product = $this->request_product->update($request_product_id, $data_1);
        $result_box =   $this->request_product_box->update($request_box_id, $data_2);

        if ($result_box > 0 || $result_product > 0) {
            $valido = true;
        } else {
            $valido = false;
        }

        echo json_encode($valido);
        exit();
    }

    function exportar_estados()
    {

        $this->load->library("excel");
        $object = new PHPExcel();
        $fecha_inicio = date('Y-m-d', strtotime($this->input->post('fecha_inicio')));
        $fecha_fin = date('Y-m-d', strtotime($this->input->post('fecha_fin')));
        $cliente_id = $this->input->post('clientes_estado');

        $this->load->model('Empresa_model', 'company');
        $this->load->model('Buy_model', 'buy');
        $this->load->model('Buy_element_model', 'buy_element');
        $this->load->model('Client_model', 'cliente');
        $this->load->model('Provider_model', 'provider');
        $this->load->model('Invoice_provider_model', 'invoice_provider');
        $this->load->model('Request_model', 'request');
        $this->load->model('Credito_model', 'credito');
        $this->load->model('Payment_model', 'payment');
        $this->load->model('Motivo_model', 'mt');
        $cliente_object = $this->cliente->get_by_id($cliente_id);
        $result = $this->request->get_request_estado_credito($fecha_inicio, $fecha_fin, $cliente_id);
        $array_pagos = [];
        $array_sin_pagos = [];
        foreach ($result as $item) {
            $pago = $this->payment->get_by_payment_invoice($item->invoice_id, $item->request_id);
            if ($pago) {
                $pago->payment = $this->payment->get_by_id($pago->payment_id);
                array_push($array_pagos, $pago);
            } else {
                array_push($array_sin_pagos, $item);
            }
        }

        $arbol = array();
        foreach ($array_pagos as $item) {
            $creditos = $this->credito->get_all_creditos_by_po_3($item->request_id);
            if ($creditos) {
                foreach ($creditos as $credito) {
                    $credito->motivo = $this->mt->get_by_id($credito->motivo_id);
                }
            }
            $item->obj_request = $this->request->get_request_estado_credito_pagos($item->request_id);
            $item->creditos = $creditos;
            $count_arbol =  count($arbol);
            if ($count_arbol > 0) {
                $arbol[$item->payment_id][] = $item;
            } else {
                $arbol[$item->payment_id] = array();
                $arbol[$item->payment_id][] = $item;
            }
        }
        foreach ($array_sin_pagos as $item) {
            $creditos = $this->credito->get_all_creditos_by_po_3($item->request_id);
            if ($creditos) {
                foreach ($creditos as $credito) {
                    $credito->motivo = $this->mt->get_by_id($credito->motivo_id);
                }
            }
            $item->creditos = $creditos;
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

        $object->getActiveSheet()->setCellValueByColumnAndRow(4, 3, "ACCOUNT STATEMENT");
        $object->getActiveSheet()->setCellValueByColumnAndRow(4, 4,  $cliente_object->cliente_name);
        //  $objWorksheet->getActiveSheet()->getColumnDimension('A')->setWidth(100);
        $table_columns = array("DATE", "AWB", "INVOICE", "P.ORDER", "VALUE", "CREDIT", "PAYMENTS", "TO PAY");

        $column = 0;
        $acum_totales_prices = 0;
        foreach ($table_columns as $field) {
            $object->getActiveSheet()->setCellValueByColumnAndRow($column, 5, $field);
            $column++;
        }
        for ($col = 'A'; $col != 'H'; $col++) {
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


        $object->getActiveSheet()->getStyle('A3:G3')->applyFromArray($estilo);
        $object->getActiveSheet()->getStyle('A4:G4')->applyFromArray($estilo);
        $object->getActiveSheet()->getStyle('A5')->applyFromArray($estilo);
        $object->getActiveSheet()->getStyle('B5')->applyFromArray($estilo);
        $object->getActiveSheet()->getStyle('B4')->applyFromArray($estilo);
        $object->getActiveSheet()->getStyle('C5')->applyFromArray($estilo);
        $object->getActiveSheet()->getStyle('D5')->applyFromArray($estilo);
        $object->getActiveSheet()->getStyle('E5')->applyFromArray($estilo);
        $object->getActiveSheet()->getStyle('F5')->applyFromArray($estilo);
        $object->getActiveSheet()->getStyle('G5')->applyFromArray($estilo);
        $object->getActiveSheet()->getStyle('H5')->applyFromArray($estilo);
        $object->getActiveSheet()->getStyle("A3:H3")->getFont()->setBold(true);
        $object->getActiveSheet()->getStyle("A4:H4")->getFont()->setBold(true);
        $object->getActiveSheet()->getStyle("A5:H5")->getFont()->setBold(true);

        $excel_row = 6;
        foreach ($arbol as $item) {
            foreach ($item as $obj) {
                if (count($obj->creditos) > 0) {
                    $object->getActiveSheet()->getStyle('A' . $excel_row)->applyFromArray($estilo);
                    $object->getActiveSheet()->getStyle('B' . $excel_row)->applyFromArray($estilo);
                    $object->getActiveSheet()->getStyle('C' . $excel_row)->applyFromArray($estilo);
                    $object->getActiveSheet()->getStyle('D' . $excel_row)->applyFromArray($estilo);
                    $object->getActiveSheet()->getStyle('E' . $excel_row)->applyFromArray($estilo);
                    $object->getActiveSheet()->getStyle('F' . $excel_row)->applyFromArray($estilo);
                    $object->getActiveSheet()->getStyle('G' . $excel_row)->applyFromArray($estilo);
                    $object->getActiveSheet()->getStyle('H' . $excel_row)->applyFromArray($estilo);
                    $object->getActiveSheet()->getStyle('E' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                    $object->getActiveSheet()->getStyle('F' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                    $object->getActiveSheet()->getStyle('G' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                    $object->getActiveSheet()->getStyle('H' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $obj->obj_request->date_time_reception);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $obj->obj_request->awb);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $obj->obj_request->nro_invoice);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $obj->obj_request->purchase_order);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, (float) $obj->obj_request->total_invoice);
                    $acum_totales_prices += (float) $obj->obj_request->total_invoice;
                    $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, "");
                    $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, "");
                    $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, $acum_totales_prices);
                    $excel_row++;
                    foreach ($obj->creditos as $credito) {
                        $object->getActiveSheet()->getStyle('A' . $excel_row)->applyFromArray($estilo);
                        $object->getActiveSheet()->getStyle('B' . $excel_row)->applyFromArray($estilo);
                        $object->getActiveSheet()->getStyle('C' . $excel_row)->applyFromArray($estilo);
                        $object->getActiveSheet()->getStyle('D' . $excel_row)->applyFromArray($estilo);
                        $object->getActiveSheet()->getStyle('E' . $excel_row)->applyFromArray($estilo);
                        $object->getActiveSheet()->getStyle('F' . $excel_row)->applyFromArray($estilo);
                        $object->getActiveSheet()->getStyle('G' . $excel_row)->applyFromArray($estilo);
                        $object->getActiveSheet()->getStyle('H' . $excel_row)->applyFromArray($estilo);
                        $object->getActiveSheet()->getStyle('E' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                        $object->getActiveSheet()->getStyle('F' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                        $object->getActiveSheet()->getStyle('G' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                        $object->getActiveSheet()->getStyle('H' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                        $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, "");
                        $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $credito->variedad . " " . $credito->motivo->motivo);
                        $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, "");
                        $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, "");
                        $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, "");
                        $acum_totales_prices = $acum_totales_prices - (float) $credito->valor_cliente;
                        $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, (float) $credito->valor_cliente);
                        $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, "");
                        $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, $acum_totales_prices);
                        $excel_row++;
                    }
                } else {
                    $object->getActiveSheet()->getStyle('A' . $excel_row)->applyFromArray($estilo);
                    $object->getActiveSheet()->getStyle('B' . $excel_row)->applyFromArray($estilo);
                    $object->getActiveSheet()->getStyle('C' . $excel_row)->applyFromArray($estilo);
                    $object->getActiveSheet()->getStyle('D' . $excel_row)->applyFromArray($estilo);
                    $object->getActiveSheet()->getStyle('E' . $excel_row)->applyFromArray($estilo);
                    $object->getActiveSheet()->getStyle('F' . $excel_row)->applyFromArray($estilo);
                    $object->getActiveSheet()->getStyle('G' . $excel_row)->applyFromArray($estilo);
                    $object->getActiveSheet()->getStyle('H' . $excel_row)->applyFromArray($estilo);
                    $object->getActiveSheet()->getStyle('E' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                    $object->getActiveSheet()->getStyle('F' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                    $object->getActiveSheet()->getStyle('G' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                    $object->getActiveSheet()->getStyle('H' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $obj->obj_request->date_time_reception);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $obj->obj_request->awb);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $obj->obj_request->nro_invoice);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $obj->obj_request->purchase_order);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, (float) $obj->obj_request->total_invoice);
                    $acum_totales_prices += (float) $obj->obj_request->total_invoice;
                    $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, "");
                    $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, "");
                    $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, $acum_totales_prices);
                    $excel_row++;
                }
            }
            $fecha_pago = $item[0]->payment->fecha_pago;
            if ($item[0]->payment->tipo_pago == 2) {
                $tipo_pago = "Costo de transferencia:";
            }

            $costo_transferencia = (float)$item[0]->payment->costo_transferencia;

            $object->getActiveSheet()->getStyle('A' . $excel_row)->applyFromArray($estilo);
            $object->getActiveSheet()->getStyle('B' . $excel_row)->applyFromArray($estilo);
            $object->getActiveSheet()->getStyle('C' . $excel_row)->applyFromArray($estilo);
            $object->getActiveSheet()->getStyle('D' . $excel_row)->applyFromArray($estilo);
            $object->getActiveSheet()->getStyle('E' . $excel_row)->applyFromArray($estilo);
            $object->getActiveSheet()->getStyle('F' . $excel_row)->applyFromArray($estilo);
            $object->getActiveSheet()->getStyle('G' . $excel_row)->applyFromArray($estilo);
            $object->getActiveSheet()->getStyle('H' . $excel_row)->applyFromArray($estilo);
            $object->getActiveSheet()->getStyle('E' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
            $object->getActiveSheet()->getStyle('F' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
            $object->getActiveSheet()->getStyle('G' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
            $object->getActiveSheet()->getStyle('H' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
            $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $fecha_pago);
            $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $tipo_pago);
            $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, "");
            $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, "");
            $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, "");
            $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, "");
            $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $costo_transferencia);
            $acum_totales_prices = $acum_totales_prices - $costo_transferencia;
            $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, $acum_totales_prices);
            $excel_row++;


            $fecha_pago = $item[0]->payment->fecha_pago;
            if ($item[0]->payment->tipo_pago == 1) {
                $tipo_pago = "Cheque N:";
            } elseif ($item[0]->payment->tipo_pago == 2) {
                $tipo_pago = "Transferencia N:";
            } else {
                $tipo_pago = "Efectivo";
            }
            $nro_payment = $item[0]->payment->nro_transaccion;
            $total_payment = (float)$item[0]->payment->total;
            $object->getActiveSheet()->getStyle('A' . $excel_row)->applyFromArray($estilo);
            $object->getActiveSheet()->getStyle('B' . $excel_row)->applyFromArray($estilo);
            $object->getActiveSheet()->getStyle('C' . $excel_row)->applyFromArray($estilo);
            $object->getActiveSheet()->getStyle('D' . $excel_row)->applyFromArray($estilo);
            $object->getActiveSheet()->getStyle('E' . $excel_row)->applyFromArray($estilo);
            $object->getActiveSheet()->getStyle('F' . $excel_row)->applyFromArray($estilo);
            $object->getActiveSheet()->getStyle('G' . $excel_row)->applyFromArray($estilo);
            $object->getActiveSheet()->getStyle('H' . $excel_row)->applyFromArray($estilo);
            $object->getActiveSheet()->getStyle('E' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
            $object->getActiveSheet()->getStyle('F' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
            $object->getActiveSheet()->getStyle('G' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
            $object->getActiveSheet()->getStyle('H' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
            $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $fecha_pago);
            $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $tipo_pago . " " . $nro_payment);
            $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, "");
            $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, "");
            $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, "");
            $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, "");
            $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $total_payment);
            $acum_totales_prices = $acum_totales_prices - $total_payment;
            $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, $acum_totales_prices);
            $excel_row++;
        }
        foreach ($array_sin_pagos as $item) {
            if (count($item->creditos) > 0) {
                $object->getActiveSheet()->getStyle('A' . $excel_row)->applyFromArray($estilo);
                $object->getActiveSheet()->getStyle('B' . $excel_row)->applyFromArray($estilo);
                $object->getActiveSheet()->getStyle('C' . $excel_row)->applyFromArray($estilo);
                $object->getActiveSheet()->getStyle('D' . $excel_row)->applyFromArray($estilo);
                $object->getActiveSheet()->getStyle('E' . $excel_row)->applyFromArray($estilo);
                $object->getActiveSheet()->getStyle('F' . $excel_row)->applyFromArray($estilo);
                $object->getActiveSheet()->getStyle('G' . $excel_row)->applyFromArray($estilo);
                $object->getActiveSheet()->getStyle('H' . $excel_row)->applyFromArray($estilo);
                $object->getActiveSheet()->getStyle('E' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                $object->getActiveSheet()->getStyle('F' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                $object->getActiveSheet()->getStyle('G' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                $object->getActiveSheet()->getStyle('H' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $item->date_time_reception);
                $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $item->awb);
                $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $item->nro_invoice);
                $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $item->purchase_order);
                $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, (float) $item->total_invoice);
                $acum_totales_prices += (float) $item->total_invoice;
                $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, "");
                $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, "");
                $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, $acum_totales_prices);
                $excel_row++;
                foreach ($item->creditos as $credito) {
                    $object->getActiveSheet()->getStyle('A' . $excel_row)->applyFromArray($estilo);
                    $object->getActiveSheet()->getStyle('B' . $excel_row)->applyFromArray($estilo);
                    $object->getActiveSheet()->getStyle('C' . $excel_row)->applyFromArray($estilo);
                    $object->getActiveSheet()->getStyle('D' . $excel_row)->applyFromArray($estilo);
                    $object->getActiveSheet()->getStyle('E' . $excel_row)->applyFromArray($estilo);
                    $object->getActiveSheet()->getStyle('F' . $excel_row)->applyFromArray($estilo);
                    $object->getActiveSheet()->getStyle('G' . $excel_row)->applyFromArray($estilo);
                    $object->getActiveSheet()->getStyle('H' . $excel_row)->applyFromArray($estilo);
                    $object->getActiveSheet()->getStyle('E' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                    $object->getActiveSheet()->getStyle('F' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                    $object->getActiveSheet()->getStyle('G' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                    $object->getActiveSheet()->getStyle('H' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, "");
                    $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $credito->variedad . " " . $credito->motivo->motivo);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, "");
                    $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, "");
                    $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, "");
                    $acum_totales_prices = $acum_totales_prices - (float) $credito->valor_cliente;
                    $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, (float) $credito->valor_cliente);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, "");
                    $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, $acum_totales_prices);
                    $excel_row++;
                }
            } else {
                $object->getActiveSheet()->getStyle('A' . $excel_row)->applyFromArray($estilo);
                $object->getActiveSheet()->getStyle('B' . $excel_row)->applyFromArray($estilo);
                $object->getActiveSheet()->getStyle('C' . $excel_row)->applyFromArray($estilo);
                $object->getActiveSheet()->getStyle('D' . $excel_row)->applyFromArray($estilo);
                $object->getActiveSheet()->getStyle('E' . $excel_row)->applyFromArray($estilo);
                $object->getActiveSheet()->getStyle('F' . $excel_row)->applyFromArray($estilo);
                $object->getActiveSheet()->getStyle('G' . $excel_row)->applyFromArray($estilo);
                $object->getActiveSheet()->getStyle('H' . $excel_row)->applyFromArray($estilo);
                $object->getActiveSheet()->getStyle('E' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                $object->getActiveSheet()->getStyle('F' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                $object->getActiveSheet()->getStyle('G' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                $object->getActiveSheet()->getStyle('H' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $item->date_time_reception);
                $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $item->awb);
                $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $item->nro_invoice);
                $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $item->purchase_order);
                $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, (float) $item->total_invoice);
                $acum_totales_prices += (float) $item->total_invoice;
                $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, "");
                $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, "");
                $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, $acum_totales_prices);
                $excel_row++;
            }
        }
        $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Estado de cuenta ' . $cliente_object->cliente_name . '.xls"');
        ob_end_clean();
        ob_start();

        $object_writer->save('php://output');
    }

    function exportar_estados_fincas()
    {
        $this->load->library("excel");
        $object = new PHPExcel();
        $fecha_inicio = date('Y-m-d', strtotime($this->input->post('fecha_finca_inicio')));
        $fecha_fin = date('Y-m-d', strtotime($this->input->post('fecha_finca_fin')));
        $provider_id = $this->input->post('finca_estado');
        $this->load->model('Empresa_model', 'company');
        $this->load->model('Provider_model', 'provider');
        $this->load->model('Buy_model', 'buy');
        $this->load->model('Buy_element_model', 'buy_element');
        $this->load->model('Client_model', 'cliente');
        $this->load->model('Provider_model', 'provider');
        $this->load->model('Invoice_provider_model', 'invoice_provider');
        $this->load->model('Request_model', 'request');
        $this->load->model('Payment_model', 'payment');
        $this->load->model('Credito_model', 'credito');
        $this->load->model('Motivo_model', 'mt');
        $this->load->model('Pending_model', 'pending');
        $provider_object = $this->provider->get_by_id($provider_id);
        $result = $this->request->get_request_estado_by_id_fincas($fecha_inicio, $fecha_fin, $provider_id);
        $result2 = $this->request->get_request_estado_by_id_fincas_2($fecha_inicio, $fecha_fin, $provider_id);
        $array_pagos = [];
        $array_sin_pagos = [];
        $facturas = [];
        foreach ($result as $fac) {
            if ($fac->provider_id == $provider_id) {
                $creditos = $this->credito->get_all_creditos_by_po($fac->request_id, $provider_id);
                $pending = $this->pending->get_all_pending_by_request_id($fac->request_id, $provider_id);
                if ($creditos) {
                    foreach ($creditos as $credito) {
                        $credito->motivo = $this->mt->get_by_id($credito->motivo_id);
                    }
                } else {
                    $creditos = NULL;
                }
                $monto = 0;
                $obj = new stdClass();
                $obj->fecha = $fac->date_time_reception;
                $obj->credito = $creditos;
                $obj->total = $fac->total;
                $obj->nro_factura = $fac->nro_invoice;
                $obj->cliente = $fac->cliente;
                $obj->monto = $monto;
                $obj->po = $fac->po;
                $obj->request_id = $fac->request_id;
                $obj->pending = $pending;
                array_push($facturas, $obj);
            }
        }

        foreach ($result2 as $fac2) {
            if ($fac2->provider_id == $provider_id) {
                $creditos = $this->credito->get_all_creditos_by_po($fac2->request_id, $provider_id);
                $pending = $this->pending->get_all_pending_by_request_id($fac2->request_id, $provider_id);
                if ($creditos) {
                    foreach ($creditos as $credito) {
                        $credito->motivo = $this->mt->get_by_id($credito->motivo_id);
                    }
                } else {
                    $creditos = NULL;
                }
                $monto = 0;

                $obj_2 = new stdClass();
                $obj_2->fecha = $fac2->date_time_reception;
                $obj_2->credito = $creditos;
                $obj_2->total = $fac2->total;
                $obj_2->nro_factura = $fac2->nro_invoice;
                $obj_2->cliente = $fac2->cliente;
                $obj_2->monto = $monto;
                $obj_2->po = $fac->po;
                $obj_2->request_id = $fac2->request_id;
                $obj_2->pending = $pending;
                array_push($facturas, $obj_2);
            }
        }
        foreach ($facturas as $item) {
            $pago = $this->payment->get_by_payment_invoice_finca($item->nro_factura, $item->request_id);
            if ($pago) {
                $pago->obj_payment =  $this->payment->get_by_payment_finca($pago->payment_finca_id);
                $item->pago = $pago;
                array_push($array_pagos, $item);
            } else {
                array_push($array_sin_pagos, $item);
            }
        }

        $arbol = array();
        foreach ($array_pagos as $item) {
            $count_arbol =  count($arbol);
            if ($count_arbol > 0) {
                $arbol[$item->pago->payment_finca_id][] = $item;
            } else {
                $arbol[$item->pago->payment_finca_id] = array();
                $arbol[$item->pago->payment_finca_id][] = $item;
            }
        }
        //var_dump($arbol[5][0]);die();
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

        $object->getActiveSheet()->setCellValueByColumnAndRow(4, 3, "DETALLE DE PAGOS");
        $object->getActiveSheet()->setCellValueByColumnAndRow(4, 4,  $provider_object->name);
        //  $objWorksheet->getActiveSheet()->getColumnDimension('A')->setWidth(100);
        $table_columns = array("FECHA", "PO", "FACTURA", "VALOR", "CRÉDITO", "MOTIVO", "TRANSFERENCIA", "SALDO");

        $column = 0;
        $acum_totales_prices = 0;
        foreach ($table_columns as $field) {
            $object->getActiveSheet()->setCellValueByColumnAndRow($column, 5, $field);
            $column++;
        }
        for ($col = 'A'; $col != 'I'; $col++) {
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


        $object->getActiveSheet()->getStyle('A3:H3')->applyFromArray($estilo);
        $object->getActiveSheet()->getStyle('A4:H4')->applyFromArray($estilo);
        $object->getActiveSheet()->getStyle('A5')->applyFromArray($estilo);
        $object->getActiveSheet()->getStyle('B5')->applyFromArray($estilo);
        $object->getActiveSheet()->getStyle('B4')->applyFromArray($estilo);
        $object->getActiveSheet()->getStyle('C5')->applyFromArray($estilo);
        $object->getActiveSheet()->getStyle('D5')->applyFromArray($estilo);
        $object->getActiveSheet()->getStyle('E5')->applyFromArray($estilo);
        $object->getActiveSheet()->getStyle('G5')->applyFromArray($estilo);
        $object->getActiveSheet()->getStyle('G5')->applyFromArray($estilo);
        $object->getActiveSheet()->getStyle('G5')->applyFromArray($estilo);
        $object->getActiveSheet()->getStyle("A3:H3")->getFont()->setBold(true);
        $object->getActiveSheet()->getStyle("A4:H4")->getFont()->setBold(true);
        $object->getActiveSheet()->getStyle("A5:H5")->getFont()->setBold(true);

        $excel_row = 6;
        $acum_totales_prices = 0;
        foreach ($arbol as $a) {
            foreach ($a as $item) {
                if ($item->credito) {
                    $object->getActiveSheet()->getStyle('A' . $excel_row)->applyFromArray($estilo);
                    $object->getActiveSheet()->getStyle('B' . $excel_row)->applyFromArray($estilo);
                    $object->getActiveSheet()->getStyle('C' . $excel_row)->applyFromArray($estilo);
                    $object->getActiveSheet()->getStyle('D' . $excel_row)->applyFromArray($estilo);
                    $object->getActiveSheet()->getStyle('E' . $excel_row)->applyFromArray($estilo);
                    $object->getActiveSheet()->getStyle('F' . $excel_row)->applyFromArray($estilo);
                    $object->getActiveSheet()->getStyle('G' . $excel_row)->applyFromArray($estilo);
                    $object->getActiveSheet()->getStyle('H' . $excel_row)->applyFromArray($estilo);
                    $object->getActiveSheet()->getStyle('D' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                    $object->getActiveSheet()->getStyle('E' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                    $object->getActiveSheet()->getStyle('G' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                    $object->getActiveSheet()->getStyle('H' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $item->fecha);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $item->po);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $item->nro_factura);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, (float) $item->total);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, "");
                    $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, "");
                    $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, "");
                    $acum_totales_prices += (float) $item->total;
                    $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, $acum_totales_prices);
                    $excel_row++;
                    foreach ($item->credito as $credito) {
                        $object->getActiveSheet()->getStyle('A' . $excel_row)->applyFromArray($estilo);
                        $object->getActiveSheet()->getStyle('B' . $excel_row)->applyFromArray($estilo);
                        $object->getActiveSheet()->getStyle('C' . $excel_row)->applyFromArray($estilo);
                        $object->getActiveSheet()->getStyle('D' . $excel_row)->applyFromArray($estilo);
                        $object->getActiveSheet()->getStyle('E' . $excel_row)->applyFromArray($estilo);
                        $object->getActiveSheet()->getStyle('F' . $excel_row)->applyFromArray($estilo);
                        $object->getActiveSheet()->getStyle('G' . $excel_row)->applyFromArray($estilo);
                        $object->getActiveSheet()->getStyle('H' . $excel_row)->applyFromArray($estilo);
                        $object->getActiveSheet()->getStyle('D' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                        $object->getActiveSheet()->getStyle('E' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                        $object->getActiveSheet()->getStyle('G' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                        $object->getActiveSheet()->getStyle('H' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                        $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, "");
                        $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, "");
                        $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, "");
                        $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, "");
                        $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, (float) $credito->valor_finca);
                        $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $credito->variedad . " " . $credito->motivo->motivo);
                        $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, "");
                        $acum_totales_prices -= (float) $credito->valor_finca;
                        $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, $acum_totales_prices);
                        $excel_row++;
                    }
                    if ($item->pending) {
                        foreach ($item->pending as $pending) {
                            $object->getActiveSheet()->getStyle('A' . $excel_row)->applyFromArray($estilo);
                            $object->getActiveSheet()->getStyle('B' . $excel_row)->applyFromArray($estilo);
                            $object->getActiveSheet()->getStyle('C' . $excel_row)->applyFromArray($estilo);
                            $object->getActiveSheet()->getStyle('D' . $excel_row)->applyFromArray($estilo);
                            $object->getActiveSheet()->getStyle('E' . $excel_row)->applyFromArray($estilo);
                            $object->getActiveSheet()->getStyle('F' . $excel_row)->applyFromArray($estilo);
                            $object->getActiveSheet()->getStyle('G' . $excel_row)->applyFromArray($estilo);
                            $object->getActiveSheet()->getStyle('H' . $excel_row)->applyFromArray($estilo);
                            $object->getActiveSheet()->getStyle('D' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                            $object->getActiveSheet()->getStyle('E' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                            $object->getActiveSheet()->getStyle('G' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                            $object->getActiveSheet()->getStyle('H' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                            $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, "");
                            $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, "");
                            $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, "");
                            $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, "");
                            $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, "");
                            $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $pending->reason . ", " . $pending->product . "-" . $pending->measure . ", Nro cajas: " . $pending->qty);
                            $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, "");
                            $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, "");
                            $excel_row++;
                        }
                    }
                } else {
                    $object->getActiveSheet()->getStyle('A' . $excel_row)->applyFromArray($estilo);
                    $object->getActiveSheet()->getStyle('B' . $excel_row)->applyFromArray($estilo);
                    $object->getActiveSheet()->getStyle('C' . $excel_row)->applyFromArray($estilo);
                    $object->getActiveSheet()->getStyle('D' . $excel_row)->applyFromArray($estilo);
                    $object->getActiveSheet()->getStyle('E' . $excel_row)->applyFromArray($estilo);
                    $object->getActiveSheet()->getStyle('F' . $excel_row)->applyFromArray($estilo);
                    $object->getActiveSheet()->getStyle('G' . $excel_row)->applyFromArray($estilo);
                    $object->getActiveSheet()->getStyle('H' . $excel_row)->applyFromArray($estilo);
                    $object->getActiveSheet()->getStyle('D' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                    $object->getActiveSheet()->getStyle('E' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                    $object->getActiveSheet()->getStyle('G' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                    $object->getActiveSheet()->getStyle('H' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $item->fecha);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $item->po);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $item->nro_factura);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, (float) $item->total);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, "");
                    $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, "");
                    $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, "");
                    $acum_totales_prices += (float) $item->total;
                    $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, $acum_totales_prices);
                    $excel_row++;
                    if ($item->pending) {
                        foreach ($item->pending as $pending) {
                            $object->getActiveSheet()->getStyle('A' . $excel_row)->applyFromArray($estilo);
                            $object->getActiveSheet()->getStyle('B' . $excel_row)->applyFromArray($estilo);
                            $object->getActiveSheet()->getStyle('C' . $excel_row)->applyFromArray($estilo);
                            $object->getActiveSheet()->getStyle('D' . $excel_row)->applyFromArray($estilo);
                            $object->getActiveSheet()->getStyle('E' . $excel_row)->applyFromArray($estilo);
                            $object->getActiveSheet()->getStyle('F' . $excel_row)->applyFromArray($estilo);
                            $object->getActiveSheet()->getStyle('G' . $excel_row)->applyFromArray($estilo);
                            $object->getActiveSheet()->getStyle('H' . $excel_row)->applyFromArray($estilo);
                            $object->getActiveSheet()->getStyle('D' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                            $object->getActiveSheet()->getStyle('E' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                            $object->getActiveSheet()->getStyle('G' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                            $object->getActiveSheet()->getStyle('H' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                            $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, "");
                            $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, "");
                            $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, "");
                            $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, "");
                            $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, "");
                            $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $pending->reason  . ", " . $pending->product . "-" . $pending->measure . ", Nro cajas: " . $pending->qty);
                            $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, "");
                            $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, "");
                            $excel_row++;
                        }
                    }
                }
            }
            $fecha_pago = $a[0]->pago->obj_payment->fecha_pago;
            if ($a[0]->pago->obj_payment->tipo_pago == 2) {
                $tipo_pago = "Costo de transferencia:";
            }
            $costo_transferencia = (float)$a[0]->pago->obj_payment->costo_transferencia;
            $object->getActiveSheet()->getStyle('A' . $excel_row)->applyFromArray($estilo);
            $object->getActiveSheet()->getStyle('B' . $excel_row)->applyFromArray($estilo);
            $object->getActiveSheet()->getStyle('C' . $excel_row)->applyFromArray($estilo);
            $object->getActiveSheet()->getStyle('D' . $excel_row)->applyFromArray($estilo);
            $object->getActiveSheet()->getStyle('E' . $excel_row)->applyFromArray($estilo);
            $object->getActiveSheet()->getStyle('F' . $excel_row)->applyFromArray($estilo);
            $object->getActiveSheet()->getStyle('G' . $excel_row)->applyFromArray($estilo);
            $object->getActiveSheet()->getStyle('H' . $excel_row)->applyFromArray($estilo);
            $object->getActiveSheet()->getStyle('E' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
            $object->getActiveSheet()->getStyle('F' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
            $object->getActiveSheet()->getStyle('G' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
            $object->getActiveSheet()->getStyle('H' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
            $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $fecha_pago);
            $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $tipo_pago);
            $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, "");
            $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, "");
            $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, "");
            $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, "");
            $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $costo_transferencia);
            $acum_totales_prices = $acum_totales_prices - $costo_transferencia;
            $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, $acum_totales_prices);
            $excel_row++;

            $fecha_pago = $a[0]->pago->obj_payment->fecha_pago;
            if ($a[0]->pago->obj_payment->tipo_pago == 1) {
                $tipo_pago = "Cheque N:";
            } elseif ($a[0]->pago->obj_payment->tipo_pago == 2) {
                $tipo_pago = "Transferencia N:";
            } else {
                $tipo_pago = "Efectivo";
            }
            $nro_payment = $a[0]->pago->obj_payment->nro_transaccion;
            $total_payment = (float)$a[0]->pago->obj_payment->total;
            $object->getActiveSheet()->getStyle('A' . $excel_row)->applyFromArray($estilo);
            $object->getActiveSheet()->getStyle('B' . $excel_row)->applyFromArray($estilo);
            $object->getActiveSheet()->getStyle('C' . $excel_row)->applyFromArray($estilo);
            $object->getActiveSheet()->getStyle('D' . $excel_row)->applyFromArray($estilo);
            $object->getActiveSheet()->getStyle('E' . $excel_row)->applyFromArray($estilo);
            $object->getActiveSheet()->getStyle('F' . $excel_row)->applyFromArray($estilo);
            $object->getActiveSheet()->getStyle('G' . $excel_row)->applyFromArray($estilo);
            $object->getActiveSheet()->getStyle('H' . $excel_row)->applyFromArray($estilo);
            $object->getActiveSheet()->getStyle('E' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
            $object->getActiveSheet()->getStyle('F' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
            $object->getActiveSheet()->getStyle('G' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
            $object->getActiveSheet()->getStyle('H' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
            $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $fecha_pago);
            $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $tipo_pago . " " . $nro_payment);
            $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, "");
            $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, "");
            $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, "");
            $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, "");
            $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $total_payment);
            $acum_totales_prices = $acum_totales_prices - $total_payment;
            $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, $acum_totales_prices);
            $excel_row++;
        }
        foreach ($array_sin_pagos as $item) {

            if ($item->credito) {
                $object->getActiveSheet()->getStyle('A' . $excel_row)->applyFromArray($estilo);
                $object->getActiveSheet()->getStyle('B' . $excel_row)->applyFromArray($estilo);
                $object->getActiveSheet()->getStyle('C' . $excel_row)->applyFromArray($estilo);
                $object->getActiveSheet()->getStyle('D' . $excel_row)->applyFromArray($estilo);
                $object->getActiveSheet()->getStyle('E' . $excel_row)->applyFromArray($estilo);
                $object->getActiveSheet()->getStyle('F' . $excel_row)->applyFromArray($estilo);
                $object->getActiveSheet()->getStyle('G' . $excel_row)->applyFromArray($estilo);
                $object->getActiveSheet()->getStyle('H' . $excel_row)->applyFromArray($estilo);
                $object->getActiveSheet()->getStyle('D' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                $object->getActiveSheet()->getStyle('E' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                $object->getActiveSheet()->getStyle('G' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                $object->getActiveSheet()->getStyle('H' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $item->fecha);
                $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $item->po);
                $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $item->nro_factura);
                $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, (float) $item->total);
                $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, "");
                $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, "");
                $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, "");
                $acum_totales_prices += (float) $item->total;
                $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, $acum_totales_prices);
                $excel_row++;
                foreach ($item->credito as $credito) {
                    $object->getActiveSheet()->getStyle('A' . $excel_row)->applyFromArray($estilo);
                    $object->getActiveSheet()->getStyle('B' . $excel_row)->applyFromArray($estilo);
                    $object->getActiveSheet()->getStyle('C' . $excel_row)->applyFromArray($estilo);
                    $object->getActiveSheet()->getStyle('D' . $excel_row)->applyFromArray($estilo);
                    $object->getActiveSheet()->getStyle('E' . $excel_row)->applyFromArray($estilo);
                    $object->getActiveSheet()->getStyle('F' . $excel_row)->applyFromArray($estilo);
                    $object->getActiveSheet()->getStyle('G' . $excel_row)->applyFromArray($estilo);
                    $object->getActiveSheet()->getStyle('H' . $excel_row)->applyFromArray($estilo);
                    $object->getActiveSheet()->getStyle('D' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                    $object->getActiveSheet()->getStyle('E' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                    $object->getActiveSheet()->getStyle('G' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                    $object->getActiveSheet()->getStyle('H' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, "");
                    $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, "");
                    $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, "");
                    $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, "");
                    $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, (float) $credito->valor_finca);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $credito->variedad . " " . $credito->motivo->motivo);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, "");
                    $acum_totales_prices -= (float) $credito->valor_finca;
                    $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, $acum_totales_prices);
                    $excel_row++;
                }
                if ($item->pending) {
                    foreach ($item->pending as $pending) {
                        $object->getActiveSheet()->getStyle('A' . $excel_row)->applyFromArray($estilo);
                        $object->getActiveSheet()->getStyle('B' . $excel_row)->applyFromArray($estilo);
                        $object->getActiveSheet()->getStyle('C' . $excel_row)->applyFromArray($estilo);
                        $object->getActiveSheet()->getStyle('D' . $excel_row)->applyFromArray($estilo);
                        $object->getActiveSheet()->getStyle('E' . $excel_row)->applyFromArray($estilo);
                        $object->getActiveSheet()->getStyle('F' . $excel_row)->applyFromArray($estilo);
                        $object->getActiveSheet()->getStyle('G' . $excel_row)->applyFromArray($estilo);
                        $object->getActiveSheet()->getStyle('H' . $excel_row)->applyFromArray($estilo);
                        $object->getActiveSheet()->getStyle('D' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                        $object->getActiveSheet()->getStyle('E' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                        $object->getActiveSheet()->getStyle('G' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                        $object->getActiveSheet()->getStyle('H' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                        $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, "");
                        $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, "");
                        $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, "");
                        $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, "");
                        $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, "");
                        $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $pending->reason . ", " . $pending->product . "-" . $pending->measure . ", Nro cajas: " . $pending->qty);
                        $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, "");
                        $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, "");
                        $excel_row++;
                    }
                }
            } else {
                $object->getActiveSheet()->getStyle('A' . $excel_row)->applyFromArray($estilo);
                $object->getActiveSheet()->getStyle('B' . $excel_row)->applyFromArray($estilo);
                $object->getActiveSheet()->getStyle('C' . $excel_row)->applyFromArray($estilo);
                $object->getActiveSheet()->getStyle('D' . $excel_row)->applyFromArray($estilo);
                $object->getActiveSheet()->getStyle('E' . $excel_row)->applyFromArray($estilo);
                $object->getActiveSheet()->getStyle('F' . $excel_row)->applyFromArray($estilo);
                $object->getActiveSheet()->getStyle('G' . $excel_row)->applyFromArray($estilo);
                $object->getActiveSheet()->getStyle('H' . $excel_row)->applyFromArray($estilo);
                $object->getActiveSheet()->getStyle('D' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                $object->getActiveSheet()->getStyle('E' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                $object->getActiveSheet()->getStyle('G' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                $object->getActiveSheet()->getStyle('H' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $item->fecha);
                $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $item->po);
                $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $item->nro_factura);
                $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, (float) $item->total);
                $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, "");
                $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, "");
                $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, "");
                $acum_totales_prices += (float) $item->total;
                $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, $acum_totales_prices);
                $excel_row++;
                if ($item->pending) {
                    foreach ($item->pending as $pending) {
                        $object->getActiveSheet()->getStyle('A' . $excel_row)->applyFromArray($estilo);
                        $object->getActiveSheet()->getStyle('B' . $excel_row)->applyFromArray($estilo);
                        $object->getActiveSheet()->getStyle('C' . $excel_row)->applyFromArray($estilo);
                        $object->getActiveSheet()->getStyle('D' . $excel_row)->applyFromArray($estilo);
                        $object->getActiveSheet()->getStyle('E' . $excel_row)->applyFromArray($estilo);
                        $object->getActiveSheet()->getStyle('F' . $excel_row)->applyFromArray($estilo);
                        $object->getActiveSheet()->getStyle('G' . $excel_row)->applyFromArray($estilo);
                        $object->getActiveSheet()->getStyle('H' . $excel_row)->applyFromArray($estilo);
                        $object->getActiveSheet()->getStyle('D' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                        $object->getActiveSheet()->getStyle('E' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                        $object->getActiveSheet()->getStyle('G' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                        $object->getActiveSheet()->getStyle('H' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                        $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, "");
                        $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, "");
                        $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, "");
                        $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, "");
                        $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, "");
                        $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $pending->reason . ", " . $pending->product . "-" . $pending->measure . ", Nro cajas: " . $pending->qty);
                        $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, "");
                        $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, "");
                        $excel_row++;
                    }
                }
            }
        }
        $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Estado de cuenta ' . $provider_object->name . '.xls"');
        ob_end_clean();
        ob_start();

        $object_writer->save('php://output');
    }
    public function totales()
    {
        $this->load->model('Invoice_provider_model', 'invoice_provider');
        $this->load->model('Invoice_provider_element_model', 'invoice_provider_element');
        $facturas = $this->invoice_provider->get_all();
        $this->load->model('Buy_element_model', 'buy_element');

        foreach ($facturas as $factura) {
            $array = [];
            if ($factura->total == 0) {


                $invoice_provider_object = $this->invoice_provider->get_invoice_by_id($factura->provider_id, $factura->buy_id);
                if ($invoice_provider_object) {
                    $all_buy_elements = $this->buy_element->get_element_by_provider_id($invoice_provider_object->request_id, $factura->provider_id);
                    if ($all_buy_elements) {
                        foreach ($all_buy_elements as $item) {
                            $item->factura_element = $this->invoice_provider_element->get_buy_element_by_id($item->buy_element_id);
                            $boxs = $this->buy_element->get_box_element_id($item->buy_element_id);

                            if ($boxs) {

                                foreach ($boxs as $box) {
                                    $box->element = $this->buy_element->get_element_by_id($box->box_element_id);
                                }
                            }
                            $item->boxs = $boxs;
                        }
                        $elementos_factura = [];
                        $sin_facturas = [];
                        foreach ($all_buy_elements as $item) {

                            if ($item->factura_element) {
                                array_push($elementos_factura, $item);
                            } else {
                                array_push($sin_facturas, $item);
                            }
                        }

                        if (count($sin_facturas) > 0) {
                            $total = 0;
                            foreach ($sin_facturas as $sin) {



                                $precio = 0;
                                if ($sin->product_category_id == 31 || $sin->product_category_id == 4 || $sin->product_category_id == 5 || $sin->product_category_id == 27 || $sin->product_category_id == 10 || $sin->product_category_id == 25) {
                                    if (($sin->product_category_id == 31 && ($sin->cliente_id == 6)) || ($sin->product_category_id == 31 && ($sin->cliente_id == 12))) {
                                        $precio = number_format(((int) $sin->qty * (float) $sin->price * (int) $sin->qty_bunches), 2);
                                    } else {
                                        if ($sin->cliente_id != 5) {
                                            if ($sin->product_category_id == 25) {
                                                $precio = number_format(((int) $sin->qty * (float) $sin->price * (int) $sin->qty_bunches), 2);
                                            } else {
                                                $precio =  number_format(((int) $sin->qty * (float) $sin->price * (int) $sin->total_steams), 2);
                                            }
                                        } else {
                                            $precio = number_format(((int) $sin->qty * (float) $sin->price * (int) $sin->qty_bunches), 2);
                                        }
                                    }
                                } else {

                                    if ((($sin->product_category_id == 3) && ($sin->cliente_id == 9))) {
                                        $precio = number_format(((int) $sin->qty * (float) $sin->price * (int) $sin->qty_bunches), 2);
                                    } else {
                                        if ($sin->cliente_id == 5) {
                                            if ($sin->product_category_id == 6 || $sin->product_category_id == 7 || $sin->product_category_id == 8) {

                                                $precio = number_format(((int) $sin->qty * (float) $sin->price * (int) $sin->qty_bunches), 2);
                                            } else {
                                                $precio = number_format(((int) $sin->qty * (float) $sin->price * (int) $sin->total_steams), 2);
                                            }
                                        } else {
                                            $precio = number_format(((int) $sin->qty * (float) $sin->price * (int) $sin->total_steams), 2);
                                        }
                                    }
                                }

                                if (count($sin->boxs) > 0) {


                                    foreach ($item->boxs as $box) {

                                        foreach ($box->element as $element) {

                                            $precio = (((int) $element->nro_bunches * (int) $element->stems_bunch) * (float) $element->price_finca);

                                            $total = $total + $precio;
                                        }
                                    }
                                } else {

                                    $total = $total + $precio;
                                }
                            }
                            $this->invoice_provider->update($factura->invoice_provider_id, ['total' => $total]);
                        }
                    }
                }
            }
        }
        echo "todo actualizado";
        exit();
    }
    public function index_pago_finca()
    {

        if (!in_array($this->session->userdata('role_id'), [1, 2, 4])) {
            $this->log_out();
            redirect('login/index');
        }
        $index = $this->session->userdata('index_pago_finca');
        $fecha_inicio = $this->input->post('fecha_pago_finca_inicio');

        if ($fecha_inicio == "" && $index) {
            $fecha_inicio = $index->fecha_inicio;
            $fecha_fin = $index->fecha_fin;
            $provider_id = $index->provider;
        } else {

            $fecha_inicio = date('Y-m-d', strtotime($this->input->post('fecha_pago_finca_inicio')));
            $fecha_fin = date('Y-m-d', strtotime($this->input->post('fecha_pago_finca_fin')));
            $provider_id = $this->input->post('finca_pago');
            $obj_session = new stdClass();
            $obj_session->fecha_inicio = $fecha_inicio;
            $obj_session->fecha_fin = $fecha_fin;
            $obj_session->provider = $provider_id;
            $this->session->set_userdata('index_pago_finca', $obj_session);
            $index = $this->session->userdata('index_pago_finca');
        }
        $this->load->model('Empresa_model', 'company');
        $this->load->model('Provider_model', 'provider');
        $this->load->model('Buy_model', 'buy');
        $this->load->model('Buy_element_model', 'buy_element');
        $this->load->model('Client_model', 'cliente');
        $this->load->model('Provider_model', 'provider');
        $this->load->model('Invoice_provider_model', 'invoice_provider');
        $this->load->model('Request_model', 'request');
        $this->load->model('Credito_model', 'credito');
        $this->load->model('Payment_model', 'payment');
        $this->load->model('Pending_model', 'pending');
        $provider_object = $this->provider->get_by_id($provider_id);
        $result = $this->request->get_request_estado_by_id_fincas($fecha_inicio, $fecha_fin, $provider_id);
        $result2 = $this->request->get_request_estado_by_id_fincas_2($fecha_inicio, $fecha_fin, $provider_id);
        $facturas = [];
        foreach ($result as $fac) {
            $credito = $this->credito->get_by_creditos_cliente($fac->invoice_provider_id);
            $pago = $this->payment->get_by_payment_invoice_finca($fac->nro_invoice, $fac->request_id);
            if ($pago) {
                $pago->obj_payment =  $this->payment->get_by_payment_finca($pago->payment_finca_id);
            }
            $obj = new stdClass();
            $obj->fecha = $fac->date_time_reception;
            $obj->credito = $credito;
            $obj->total = $fac->total;
            $obj->nro_factura = $fac->nro_invoice;
            $obj->cliente = $fac->cliente;
            $obj->pago = $pago;
            $obj->nro = $fac->invoice_provider_id;
            $obj->request_id = $fac->request_id;
            $obj->pending = $this->pending->get_by_id_po($fac->request_id, $provider_id);
            array_push($facturas, $obj);
        }

        foreach ($result2 as $fac2) {
            $credito = $this->credito->get_by_creditos_cliente($fac2->invoice_provider_element_id);
            $pago = $this->payment->get_by_payment_invoice_finca($fac->nro_invoice, $fac->request_id);
            if ($pago) {
                $pago->obj_payment =  $this->payment->get_by_payment_finca($pago->payment_finca_id);
            }
            $obj_2 = new stdClass();
            $obj_2->fecha = $fac2->date_time_reception;
            $obj_2->credito = $credito;
            $obj_2->total = $fac2->total;
            $obj_2->nro_factura = $fac2->nro_invoice;
            $obj_2->cliente = $fac->cliente;
            $obj_2->pago = $pago;
            $obj_2->nro = $fac2->invoice_provider_element_id;
            $obj_2->request_id = $fac2->request_id;
            $obj_2->pending = $this->pending->get_by_id_po($fac->request_id, $provider_id);
            array_push($facturas, $obj_2);
        }
        $data['facturas'] = $facturas;
        $data['provider'] = $provider_object;


        $this->load_view_admin_g("request/index_pago_finca", $data);
    }

    public function add_pago()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2, 4])) {
            $this->log_out();
            redirect('login/index');
        }

        $fecha_pagar_finca = date('Y-m-d', strtotime($this->input->post('fecha_pagar_finca')));
        $valor_pagar_finca = $this->input->post('valor_pagar_finca');
        $tipo_pago_finca = $this->input->post('tipo_pago_finca');
        $datos = json_decode($_POST['array']);
        $banco_finca = $this->input->post('banco_finca');
        $this->load->model('Payment_model', 'payment');
        $nro_transaccion_finca = $this->input->post('nro_transaccion_finca');
        $costo_transferencia = $this->input->post('costo_transferencia');
        //establecer reglas de validacion

        $this->form_validation->set_rules('fecha_pagar_finca', "Seleccione la fecha del pago", 'required');
        $this->form_validation->set_rules('valor_pagar_finca', "Ingrese el valor a pgar", 'required');
        $this->form_validation->set_rules('tipo_pago_finca', "Seleccione un tipo de pago", 'required');
        $this->form_validation->set_rules('nro_transaccion_finca', "Ingrese el nro de transacción", 'required');
        $this->form_validation->set_rules('banco_finca', "Ingrese un banco", 'required');
        if ($this->form_validation->run() == FALSE) { //si alguna de las reglas de validacion fallaron
            $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
            redirect("request/index_pago_finca", "location", 301);
        } else {
            $data = [
                'fecha_pago' => $fecha_pagar_finca,
                'banco' => $banco_finca,
                'tipo_pago' => $tipo_pago_finca,
                'nro_transaccion' => $nro_transaccion_finca,
                'costo_transferencia' => $costo_transferencia,
                'total' => $valor_pagar_finca
            ];
            $id = $this->payment->create_payment_finca($data);
            if ($id) {
                foreach ($datos as $item) {
                    $data_invoice = [
                        'valor_pagar' => $item->valor,
                        'nro_factura' => $item->nro,
                        'request_id' => $item->request_id,
                        'payment_finca_id' => $id
                    ];
                    $this->payment->create_payment_invoice_finca($data_invoice);
                }
            }

            $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
            redirect("request/index_pago_finca", "location", 301);
        }
    }
    public function update_pago()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2, 4])) {
            $this->log_out();
            redirect('login/index');
        }

        $fecha_pagar_finca =  date('Y-m-d', strtotime($this->input->post('fecha_pagar_finca_editar')));
        $valor_pagar_finca = $this->input->post('valor_pagar_finca_editar');
        $tipo_pago_finca = $this->input->post('tipo_pago_finca_editar');
        $payment_id = $this->input->post('payment_id');
        $nro_transaccion_finca_editar = $this->input->post('nro_transaccion_finca_editar');
        $banco_finca = $this->input->post('banco_finca_editar');

        $this->load->model('Payment_model', 'payment');
        //establecer reglas de validacion

        $this->form_validation->set_rules('fecha_pagar_finca_editar', "Seleccione la fecha del pago", 'required');
        $this->form_validation->set_rules('valor_pagar_finca_editar', "Ingrese el valor a pgar", 'required');
        $this->form_validation->set_rules('tipo_pago_finca_editar', "Seleccione un tipo de pago", 'required');
        $this->form_validation->set_rules('nro_transaccion_finca_editar', "Ingrese el nro de transacción", 'required');
        $this->form_validation->set_rules('banco_finca_editar', "Ingrese un banco", 'required');
        if ($this->form_validation->run() == FALSE) { //si alguna de las reglas de validacion fallaron
            $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
            redirect("request/index_pago_finca", "location", 301);
        } else {
            $data = ['fecha_pago' => $fecha_pagar_finca, 'valor_pagar' => $valor_pagar_finca, 'banco' => $banco_finca, 'tipo_pago' => $tipo_pago_finca, 'nro_transaccion' => $nro_transaccion_finca_editar];
            $this->payment->update($payment_id, $data);
            $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
            redirect("request/index_pago_finca", "location", 301);
        }
    }
    public function index_pago_cliente()
    {

        if (!in_array($this->session->userdata('role_id'), [1, 2, 4])) {
            $this->log_out();
            redirect('login/index');
        }
        $index = $this->session->userdata('index_pago_cliente');
        $fecha_inicio = $this->input->post('fecha_pago_inicio_cliente');

        if ($fecha_inicio == "" && $index) {
            $fecha_inicio = $index->fecha_inicio;
            $fecha_fin = $index->fecha_fin;
            $cliente_id = $index->cliente;
        } else {

            $fecha_inicio = date('Y-m-d', strtotime($this->input->post('fecha_pago_inicio_cliente')));
            $fecha_fin = date('Y-m-d', strtotime($this->input->post('fecha_pago_fin_cliente')));
            $cliente_id = $this->input->post('clientes_pago');
            $obj_session = new stdClass();
            $obj_session->fecha_inicio = $fecha_inicio;
            $obj_session->fecha_fin = $fecha_fin;
            $obj_session->cliente = $cliente_id;
            $this->session->set_userdata('index_pago_cliente', $obj_session);
            $index = $this->session->userdata('index_pago_cliente');
        }


        $this->load->model('Empresa_model', 'company');
        $this->load->model('Provider_model', 'provider');
        $this->load->model('Buy_model', 'buy');
        $this->load->model('Buy_element_model', 'buy_element');
        $this->load->model('Client_model', 'cliente');
        $this->load->model('Invoice_provider_model', 'invoice_provider');
        $this->load->model('Request_model', 'request');
        $this->load->model('Credito_model', 'credito');
        $this->load->model('Payment_model', 'payment');
        $cliente_object = $this->cliente->get_by_id($cliente_id);
        $result = $this->request->get_request_estado_credito($fecha_inicio, $fecha_fin, $cliente_id);

        foreach ($result as $item) {
            //  $item->credito = $this->credito->get_credito_by_po($item->request_id);
            $creditos = $this->credito->get_all_creditos_by_po_3($item->request_id);
            $valor_credito = 0;
            if ($creditos) {
                foreach ($creditos as $credito) {
                    $valor_credito += (float) number_format($credito->valor_cliente, 2);
                }
            }
            if ($valor_credito > 0) {
                $item->credito = $valor_credito;
            } else {
                $item->credito = NULL;
            }
            //$item->credito = $this->credito->get_credito_by_po2($item->request_id);

            $pago = $this->payment->get_by_payment_invoice($item->invoice_id, $item->request_id);
            if ($pago) {
                $obj = $this->payment->get_by_id($pago->payment_id);
                $obj_session = new stdClass();
                $obj_session->fecha_pago = $obj->fecha_pago;
                $obj_session->valor_pagar = $pago->valor_pagar;
                $obj_session->banco = $obj->banco;
                $obj_session->nro_transaccion = $obj->nro_transaccion;
                $obj_session->tipo_pago = $obj->tipo_pago;
                $item->pago = $obj_session;
            } else {
                $item->pago = null;
            }
        }

        $data['facturas'] = $result;
        $data['cliente'] = $cliente_object;


        $this->load_view_admin_g("request/index_pago_cliente", $data);
    }

    public function add_pago_cliente()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2, 4])) {
            $this->log_out();
            redirect('login/index');
        }

        $fecha_pagar_cliente = date('Y-m-d', strtotime($this->input->post('fecha_pagar_cliente')));
        $tipo_pago_cliente = $this->input->post('tipo_pago_cliente');
        $valor_pagar_cliente = $this->input->post('valor_pagar_cliente');
        $datos = json_decode($_POST['array']);
        $costo_transferencia = $this->input->post('costo_transferencia');
        $banco_cliente = $this->input->post('banco_cliente');
        $nro_transaccion_cliente = $this->input->post('nro_transaccion_cliente');
        $this->load->model('Payment_model', 'payment');
        //establecer reglas de validacion

        $this->form_validation->set_rules('fecha_pagar_cliente', "Seleccione la fecha del pago", 'required');
        $this->form_validation->set_rules('valor_pagar_cliente', "Ingrese el valor a pgar", 'required');
        $this->form_validation->set_rules('tipo_pago_cliente', "Seleccione un tipo de pago", 'required');
        $this->form_validation->set_rules('nro_transaccion_cliente', "Ingrese el nro de trasacción", 'required');
        $this->form_validation->set_rules('banco_cliente', "Ingrese un banco", 'required');
        if ($this->form_validation->run() == FALSE) { //si alguna de las reglas de validacion fallaron
            $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
            redirect("request/index_pago_cliente", "location", 301);
        } else {
            $data = [
                'fecha_pago' => $fecha_pagar_cliente,
                'banco' => $banco_cliente,
                'tipo_pago' => $tipo_pago_cliente,
                'nro_transaccion' => $nro_transaccion_cliente,
                'total' => $valor_pagar_cliente,
                'costo_transferencia' => $costo_transferencia
            ];
            $id = $this->payment->create($data);
            if ($id) {
                foreach ($datos as $item) {
                    $data_invoice = [
                        'valor_pagar' => $item->valor,
                        'nro_factura' => $item->nro,
                        'request_id' => $item->request_id,
                        'payment_id' => $id
                    ];
                    $this->payment->create_payment_invoice($data_invoice);
                }
            }
            $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
            redirect("request/index_pago_cliente", "location", 301);
        }
    }

    public function update_pago_cliente()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2, 4])) {
            $this->log_out();
            redirect('login/index');
        }

        $fecha_pagar_cliente_editar =  date('Y-m-d', strtotime($this->input->post('fecha_pagar_cliente_editar')));
        $valor_pagar_cliente_editar = $this->input->post('valor_pagar_cliente_editar');
        $tipo_pago_cliente_editar = $this->input->post('tipo_pago_cliente_editar');
        $payment_id = $this->input->post('payment_id_cliente');
        $banco_cliente_editar = $this->input->post('banco_cliente_editar');
        $nro_transaccion_cliente_editar = $this->input->post('nro_transaccion_cliente_editar');
        $this->load->model('Payment_model', 'payment');
        //establecer reglas de validacion

        $this->form_validation->set_rules('fecha_pagar_cliente_editar', "Seleccione la fecha del pago", 'required');
        $this->form_validation->set_rules('valor_pagar_cliente_editar', "Ingrese el valor a pgar", 'required');
        $this->form_validation->set_rules('tipo_pago_cliente_editar', "Seleccione un tipo de pago", 'required');
        $this->form_validation->set_rules('banco_cliente_editar', "Ingrese un banco", 'required');
        if ($this->form_validation->run() == FALSE) { //si alguna de las reglas de validacion fallaron
            $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
            redirect("request/index_pago_cliente", "location", 301);
        } else {
            $data = ['fecha_pago' => $fecha_pagar_cliente_editar, 'valor_pagar' => $valor_pagar_cliente_editar, 'banco' => $banco_cliente_editar, 'tipo_pago' => $tipo_pago_cliente_editar, 'nro_transaccion' => $nro_transaccion_cliente_editar];
            $this->payment->update($payment_id, $data);
            $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
            redirect("request/index_pago_cliente", "location", 301);
        }
    }
    public function buscar_repetidos()
    {
        $this->load->model('Request_model', 'request');
        $duplicados = [];
        $facturas = $this->request->get_all_invoice();
        foreach ($facturas as $item) {
            $result = $this->request->get_by_invoice_nro($item->request_id);
            if (count($result) >= 2) {
                array_push($duplicados, $item->request_id);
            }
        }
        var_dump($duplicados);
        exit();
    }
    public function update_total_invoice()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2, 4])) {
            $this->log_out();
            redirect('login/index');
        }
        $this->load->model('Empresa_model', 'company');
        $this->load->model('Buy_model', 'buy');
        $this->load->model('Buy_element_model', 'buy_element');
        $this->load->model('Client_model', 'client');
        $this->load->model('Provider_model', 'provider');
        $this->load->model('Invoice_provider_model', 'invoice_provider');
        $this->load->model('Request_model', 'request');
        $request_id = $this->input->post('request_id_total_invoice');
        $awb = $this->input->post('awb_update');
        $price_transporte = $this->input->post('price_transport_update');
        $objecto = $this->request->get_by_id($request_id);
        $request_obj = $this->request->get_by_id($request_id);
        // $cliente_obj = $this->client->get_by_id($request_obj->cliente_id);
        $invoice_object = $this->request->get_by_invoice_request_id($request_id);
        if ($invoice_object) {
            $all_providers = $this->buy_element->get_element_by_request_group($request_id);

            foreach ($all_providers as $pro) {
                $pro->contador = count($this->buy_element->get_element_by_request_pro($pro->buy_id, $pro->provider_id));
                $pro->elementos = $this->buy_element->get_element_by_request_id2($request_id, $pro->provider_id);
                foreach ($pro->elementos as $elemento) {
                    $boxs = $this->buy_element->get_box_element_id($elemento->buy_element_id);

                    if ($boxs) {

                        foreach ($boxs as $box) {
                            $box->element = $this->buy_element->get_element_by_id($box->box_element_id);
                        }
                    }
                    $elemento->boxs = $boxs;
                }
            }
            $acum_total_price = 0;
            $acum_QB = 0;
            $acum_total_steams = 0;
            $acum_HB = 0;
            $acum_total_bunches = 0;
            $acum_EB = 0;
            foreach ($all_providers as $item) {

                foreach ($item->elementos as $elemento) {

                    if (count($elemento->boxs) > 0) {

                        if ($elemento->box == "QB") {
                            $acum_QB += $elemento->qty;
                        }
                        if ($elemento->box == "HB") {
                            $acum_HB += $elemento->qty;
                        }
                        if ($elemento->box == "EB") {
                            $acum_EB += $elemento->qty;
                        }

                        $elemento->box;
                        $elemento->product;
                        foreach ($elemento->boxs as $box) {
                            foreach ($box->element as $pro) {
                                $total_bunches =  (int) $pro->nro_bunches * (int) $box->nro_cajas;
                                $acum_total_bunches += $total_bunches;
                                $total_steams =  (int) $pro->nro_bunches * (int) $pro->stems_bunch * (int) $box->nro_cajas;
                                $price_unit = (float) $pro->price_cliente;
                                $acum_total_steams += (int) $total_steams;

                                if ($elemento->product_category_id  == 4 || $elemento->product_category_id  == 5 || $elemento->product_category_id  == 27 || $elemento->product_category_id  == 31 || $elemento->product_category_id  == 10 || $elemento->product_category_id  == 25) {
                                    if (($elemento->product_category_id == 31 && ($request_obj->cliente_id == 6)) || ($elemento->product_category_id == 31 && ($request_obj->cliente_id == 12))) {
                                        $sub = $price_unit * $total_bunches;
                                        $acum_total_price += $sub;
                                    } else {
                                        if ($request_obj->cliente_id != 5) {
                                            if ($elemento->product_category_id == 25) {
                                                $sub = $price_unit * $total_bunches;
                                                $acum_total_price += $sub;
                                            } else {
                                                $sub = $price_unit * $total_steams;
                                                $acum_total_price += $sub;
                                            }
                                        } else {
                                            $sub = $price_unit * $total_bunches;
                                            $acum_total_price += $sub;
                                        }
                                    }
                                } else {
                                    if ((($item->product_category_id == 3) && ($item->cliente_id == 9))) {
                                        $sub = $price_unit * $total_bunches;
                                        $acum_total_price += $sub;
                                    } else {
                                        if ($elemento->product_category_id  == 6 || $elemento->product_category_id  == 7 || $elemento->product_category_id  == 8 || $elemento->product_category_id  == 36) {
                                            if ($request_obj->cliente_id  == 5) {
                                                $sub = $price_unit * $total_bunches;
                                                $acum_total_price += $sub;
                                            } else {
                                                $sub = $price_unit * $total_steams;
                                                $acum_total_price += $sub;
                                            }
                                        } else {
                                            $sub = $price_unit * $total_steams;
                                            $acum_total_price += $sub;
                                        }
                                    }
                                }
                                /*      $total_bunches =  (int) $pro->nro_bunches * (int) $box->nro_cajas;
                                $acum_total_bunches += $total_bunches;
                                $total_steams =  (int) $pro->nro_bunches * (int) $pro->stems_bunch * (int) $box->nro_cajas;
                                $price_unit = (float) $pro->price_cliente;
                                $acum_total_steams += (int) $total_steams;
                                $sub = $price_unit * $total_steams;
                                echo $sub . "<br />";
                                $acum_total_price += $sub; */
                            }
                        }
                    } else {

                        if ($elemento->box == "QB") {
                            $acum_QB += $elemento->qty;
                        }
                        if ($elemento->box == "HB") {
                            $acum_HB += $elemento->qty;
                        }
                        if ($elemento->box == "EB") {
                            $acum_EB += $elemento->qty;
                        }

                        $unit = (float) $elemento->unit_price;

                        if ($elemento->product_category_id  == 4 || $elemento->product_category_id  == 5 || $elemento->product_category_id  == 27 || $elemento->product_category_id  == 31 || $elemento->product_category_id  == 10 || $elemento->product_category_id  == 25) {

                            if (($elemento->product_category_id == 31 && ($request_obj->cliente_id == 6)) || ($elemento->product_category_id == 31 && ($request_obj->cliente_id == 12))) {

                                $sub = number_format(((float) $elemento->qty *  number_format($unit, 3)  * (float) $elemento->qty_bunches), 2);
                                $acum_total_price = $acum_total_price + ((float) $elemento->qty *  number_format($unit, 2)  * (int) $elemento->qty_bunches);
                                $bunches = (int) $elemento->qty_bunches * (int) $elemento->qty;
                                $tallos = (int) $elemento->total_steams * (int) $elemento->qty;
                                $acum_total_bunches = $acum_total_bunches + $bunches;
                                $acum_total_steams = $acum_total_steams + $tallos;
                            } else {
                                if ($request_obj->cliente_id != 5) {
                                    if ($elemento->product_category_id == 25) {
                                        $sub = number_format(((float) $elemento->qty *  number_format($unit, 3)  * (int) $elemento->qty_bunches), 2);
                                        $acum_total_price = $acum_total_price + ((float) $elemento->qty *  number_format($unit, 3) * (int) $elemento->qty_bunches);
                                        $bunches = (int) $elemento->qty_bunches * (int) $elemento->qty;
                                        $tallos = (int) $elemento->total_steams * (int) $elemento->qty;
                                        $acum_total_bunches = $acum_total_bunches + $bunches;
                                        $acum_total_steams = $acum_total_steams + $tallos;
                                    } else {
                                        $sub = number_format(((float) $elemento->qty *  number_format($unit, 3)  * (int) $elemento->total_steams), 2);
                                        $acum_total_price = $acum_total_price + ((float) $elemento->qty *  number_format($unit, 3)  * (int) $elemento->total_steams);
                                        $bunches = (int) $elemento->qty_bunches * (int) $elemento->qty;
                                        $tallos = (int) $elemento->total_steams * (int) $elemento->qty;
                                        $acum_total_bunches = $acum_total_bunches + $bunches;
                                        $acum_total_steams = $acum_total_steams + $tallos;
                                    }
                                } else {
                                    $sub = number_format(((float) $elemento->qty *  number_format($unit, 3)  * (int) $elemento->qty_bunches), 2);
                                    $acum_total_price = $acum_total_price + ((float) $elemento->qty * number_format($unit, 3)  * (int) $elemento->qty_bunches);
                                    $bunches = (int) $elemento->qty_bunches * (int) $elemento->qty;
                                    $tallos = (int) $elemento->total_steams * (int) $elemento->qty;
                                    $acum_total_bunches = $acum_total_bunches + $bunches;
                                    $acum_total_steams = $acum_total_steams + $tallos;
                                }
                            }
                        } else {
                            if ((($item->product_category_id == 3) && ($request_obj->cliente_id == 9))) {

                                $sub = number_format(((float) $elemento->qty *  number_format($unit, 3)  * (int) $elemento->qty_bunches), 2);
                                $acum_total_price = $acum_total_price + ((float) $elemento->qty *  number_format($unit, 3)  * (int) $elemento->qty_bunches);
                                $bunches = (int) $elemento->qty_bunches * (int) $elemento->qty;
                                $tallos = (int) $elemento->total_steams * (int) $elemento->qty;
                                $acum_total_bunches = $acum_total_bunches + $bunches;
                                $acum_total_steams = $acum_total_steams + $tallos;
                            } else {
                                if ($elemento->product_category_id  == 6 || $elemento->product_category_id  == 7 || $elemento->product_category_id  == 8) {
                                    if ($request_obj->cliente_id  == 5) {
                                        $sub = number_format(((float) $elemento->qty *  number_format($unit, 3)  * (int) $elemento->qty_bunches), 2);
                                        $acum_total_price = $acum_total_price + ((float) $elemento->qty *  number_format($unit, 3)  * (int) $elemento->qty_bunches);
                                        $bunches = (int) $elemento->qty_bunches * (int) $elemento->qty;
                                        $tallos = (int) $elemento->total_steams * (int) $elemento->qty;
                                        $acum_total_bunches = $acum_total_bunches + $bunches;
                                        $acum_total_steams = $acum_total_steams + $tallos;
                                    } else {

                                        $sub = number_format(((int) $elemento->qty *  number_format($unit, 3)  * (int) $elemento->total_steams), 2);
                                        $acum_total_price = $acum_total_price + ((float) $elemento->qty *  number_format($unit, 3)  * (int) $elemento->total_steams);
                                        $bunches = (int) $elemento->qty_bunches * (int) $elemento->qty;
                                        $tallos = (int) $elemento->total_steams * (int) $elemento->qty;
                                        $acum_total_bunches = $acum_total_bunches + $bunches;
                                        $acum_total_steams = $acum_total_steams + $tallos;
                                    }
                                } else {
                                    $sub = number_format((int) $elemento->qty *  number_format($unit, 3) * (int) $elemento->total_steams, 2);
                                    $acum_total_price = $acum_total_price + ((int) $elemento->qty *  number_format($unit, 3)  * (int) $elemento->total_steams);
                                    $bunches = (int) $elemento->qty_bunches * (int) $elemento->qty;
                                    $tallos = (int) $elemento->total_steams * (int) $elemento->qty;
                                    $acum_total_bunches = $acum_total_bunches + $bunches;
                                    $acum_total_steams = $acum_total_steams + $tallos;
                                }
                            }
                        }
                    }
                }
            }
            $calculo =  $acum_total_price + (float) $price_transporte;
            $id =    $this->request->update_invoice($request_id, ['total_invoice' => $calculo, 'awb' => $awb, 'price_transporte' => $price_transporte]);
            if ($objecto) {
                $this->session->set_flashdata('data_po', $objecto->purchase_order);
            }
            if ($id) {
                $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
                redirect("request/index", "location", 301);
            } else {
                $this->response->set_message("Error en actualizar el valor de la  factura del cliente", ResponseMessage::SUCCESS);
                redirect("request/index", "location", 301);
            }
        }
    }
    public function exportar_utilidad()
    {
        $this->load->library("excel");
        $object = new PHPExcel();
        $fecha_inicio = date('Y-m-d', strtotime($this->input->post('fecha_inicio_utilidad')));
        $fecha_fin = date('Y-m-d', strtotime($this->input->post('fecha_fin_utilidad')));
        $cliente_id = $this->input->post('clientes_utilidad');
        $this->load->model('Empresa_model', 'company');
        $this->load->model('Buy_model', 'buy');
        $this->load->model('Buy_element_model', 'buy_element');
        $this->load->model('Client_model', 'cliente');
        $this->load->model('Provider_model', 'provider');
        $this->load->model('Invoice_provider_model', 'invoice_provider');
        $this->load->model('Request_model', 'request');
        $this->load->model('Credito_model', 'credito');
        $this->load->model('Payment_model', 'payment');
        $result = $this->request->get_element_by_request_group($fecha_inicio, $fecha_fin, $cliente_id);
        foreach ($result as $item) {
            $item->elementos = $this->buy_element->get_element_by_request_id2($item->request_id, $item->provider_id);
            foreach ($item->elementos as $elemento) {
                $boxs = $this->buy_element->get_box_element_id($elemento->buy_element_id);
                if ($boxs) {
                    foreach ($boxs as $box) {
                        $box->element = $this->buy_element->get_element_by_id($box->box_element_id);
                    }
                }
                $elemento->boxs = $boxs;
            }
        }
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
        $table_columns = array("FECHA DE VUELO", "PO", "CLIENTE", "FINCA", "No. CAJAS", "TIPO DE CAJA", "VARIEDAD", "MEDIDA", "No. BUNCHES", "No. TALLOS", "PRECIO FINCA", "PRECIO CLIENTE", "VALOR FINCA", "VALOR CLIENTE", "UTILIDAD");

        $column = 0;

        foreach ($table_columns as $field) {
            $object->getActiveSheet()->setCellValueByColumnAndRow($column, 5, $field);
            $column++;
        }
        for ($col = 'A'; $col != 'P'; $col++) {
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
        $object->getActiveSheet()->getStyle('L5')->applyFromArray($estilo);
        $object->getActiveSheet()->getStyle('M5')->applyFromArray($estilo);
        $object->getActiveSheet()->getStyle('N5')->applyFromArray($estilo);
        $object->getActiveSheet()->getStyle('O5')->applyFromArray($estilo);
        $object->getActiveSheet()->getStyle("A3:O3")->getFont()->setBold(true);
        $object->getActiveSheet()->getStyle("A4:O4")->getFont()->setBold(true);
        $object->getActiveSheet()->getStyle("A5:O5")->getFont()->setBold(true);

        $excel_row = 6;
        foreach ($result as $item) {

            foreach ($item->elementos as $elemento) {
                if (count($elemento->boxs) > 0) {
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
                    $object->getActiveSheet()->getStyle('L' . $excel_row)->applyFromArray($estilo);
                    $object->getActiveSheet()->getStyle('M' . $excel_row)->applyFromArray($estilo);
                    $object->getActiveSheet()->getStyle('N' . $excel_row)->applyFromArray($estilo);
                    $object->getActiveSheet()->getStyle('O' . $excel_row)->applyFromArray($estilo);
                    $object->getActiveSheet()->getStyle('E' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                    $object->getActiveSheet()->getStyle('I' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                    $object->getActiveSheet()->getStyle('J' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                    $object->getActiveSheet()->getStyle('K' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                    $object->getActiveSheet()->getStyle('L' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                    $object->getActiveSheet()->getStyle('M' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                    $object->getActiveSheet()->getStyle('N' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                    $object->getActiveSheet()->getStyle('O' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $elemento->date_time_reception);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $elemento->purchase_order);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $elemento->cliente);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $elemento->provider);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, (int) $elemento->cajas);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $elemento->box);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $elemento->product);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, "");
                    $object->getActiveSheet()->setCellValueByColumnAndRow(8, $excel_row, "");
                    $object->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row, "");
                    $object->getActiveSheet()->setCellValueByColumnAndRow(10, $excel_row, "");
                    $object->getActiveSheet()->setCellValueByColumnAndRow(11, $excel_row, "");
                    $object->getActiveSheet()->setCellValueByColumnAndRow(12, $excel_row, "");
                    $object->getActiveSheet()->setCellValueByColumnAndRow(13, $excel_row, "");
                    $object->getActiveSheet()->setCellValueByColumnAndRow(14, $excel_row, "");
                    $excel_row++;
                    foreach ($elemento->boxs as $box) {
                        foreach ($box->element as $pro) {
                            $bunches_cajas =  (int) $pro->nro_bunches * (int) $box->nro_cajas;
                            $tallos_caja =  (int) $pro->nro_bunches * (int) $pro->stems_bunch * (int) $box->nro_cajas;
                            $price_unit_cliente = (float) $pro->price_cliente;
                            $price_unit_finca = (float) $pro->price_finca;
                            $total_cliente_caja =  $tallos_caja *  $price_unit_cliente;
                            $total_finca_caja =  $tallos_caja *  $price_unit_finca;
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
                            $object->getActiveSheet()->getStyle('L' . $excel_row)->applyFromArray($estilo);
                            $object->getActiveSheet()->getStyle('M' . $excel_row)->applyFromArray($estilo);
                            $object->getActiveSheet()->getStyle('N' . $excel_row)->applyFromArray($estilo);
                            $object->getActiveSheet()->getStyle('O' . $excel_row)->applyFromArray($estilo);
                            $object->getActiveSheet()->getStyle('E' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                            $object->getActiveSheet()->getStyle('I' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                            $object->getActiveSheet()->getStyle('J' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                            $object->getActiveSheet()->getStyle('K' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                            $object->getActiveSheet()->getStyle('L' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                            $object->getActiveSheet()->getStyle('M' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                            $object->getActiveSheet()->getStyle('N' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                            $object->getActiveSheet()->getStyle('O' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                            $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, "");
                            $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, "");
                            $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, "");
                            $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, "");
                            $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, "");
                            $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, "");
                            $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $pro->product);
                            $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, $pro->name);
                            $object->getActiveSheet()->setCellValueByColumnAndRow(8, $excel_row, (int) $bunches_cajas);
                            $object->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row, (int)$tallos_caja);
                            $object->getActiveSheet()->setCellValueByColumnAndRow(10, $excel_row, (float)  $price_unit_finca);
                            $object->getActiveSheet()->setCellValueByColumnAndRow(11, $excel_row,  (float)  $price_unit_cliente);
                            $utilidad = $total_cliente_caja - $total_finca_caja;
                            $object->getActiveSheet()->setCellValueByColumnAndRow(12, $excel_row, $total_finca_caja);
                            $object->getActiveSheet()->setCellValueByColumnAndRow(13, $excel_row, $total_cliente_caja);
                            $object->getActiveSheet()->setCellValueByColumnAndRow(14, $excel_row, $utilidad);
                            $excel_row++;
                        }
                    }
                } else {
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
                    $object->getActiveSheet()->getStyle('L' . $excel_row)->applyFromArray($estilo);
                    $object->getActiveSheet()->getStyle('M' . $excel_row)->applyFromArray($estilo);
                    $object->getActiveSheet()->getStyle('N' . $excel_row)->applyFromArray($estilo);
                    $object->getActiveSheet()->getStyle('O' . $excel_row)->applyFromArray($estilo);
                    $object->getActiveSheet()->getStyle('E' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                    $object->getActiveSheet()->getStyle('I' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                    $object->getActiveSheet()->getStyle('J' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                    $object->getActiveSheet()->getStyle('K' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                    $object->getActiveSheet()->getStyle('L' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                    $object->getActiveSheet()->getStyle('M' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                    $object->getActiveSheet()->getStyle('N' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                    $object->getActiveSheet()->getStyle('O' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $elemento->date_time_reception);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $elemento->purchase_order);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $elemento->cliente);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $elemento->provider);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, (int) $elemento->cajas);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $elemento->box);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $elemento->product);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, $elemento->measure);
                    $total_bunches = (int)$elemento->qty_bunches * (int)$elemento->qty;
                    $total_tallos = (int) $elemento->total_steams * (int) $elemento->qty;
                    $object->getActiveSheet()->setCellValueByColumnAndRow(8, $excel_row, (int) $total_bunches);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row, (int)$total_tallos);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(10, $excel_row, (float)  $elemento->price);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(11, $excel_row,  (float)  $elemento->unit_price);
                    $total_cliente = 0;
                    $total_finca = 0;
                    if ($elemento->product_category_id  == 4 || $elemento->product_category_id  == 5 || $elemento->product_category_id  == 27 || $elemento->product_category_id  == 31 || $elemento->product_category_id  == 10 || $elemento->product_category_id  == 25) {
                        if (($elemento->product_category_id == 31 && ($elemento->cliente_id == 6)) || ($elemento->product_category_id == 31 && ($elemento->cliente_id == 12))) {
                            $total_cliente = number_format(((float) $elemento->qty *  number_format($elemento->unit_price, 3)  * (float) $elemento->qty_bunches), 2);
                            $total_finca = number_format(((float) $elemento->qty *  number_format($elemento->price, 3)  * (float) $elemento->qty_bunches), 2);
                        } else {
                            if ($elemento->cliente_id != 5) {
                                if ($elemento->product_category_id == 25) {
                                    $total_cliente = number_format(((float) $elemento->qty *  number_format($elemento->unit_price, 3)  * (int) $elemento->qty_bunches), 2);
                                    $total_finca = number_format(((float) $elemento->qty *  number_format($elemento->price, 3)  * (int) $elemento->qty_bunches), 2);
                                } else {
                                    $total_cliente = number_format(((float) $elemento->qty *  number_format($elemento->unit_price, 3)  * (int) $elemento->total_steams), 2);
                                    $total_finca = number_format(((float) $elemento->qty *  number_format($elemento->price, 3)  * (int) $elemento->total_steams), 2);
                                }
                            } else {
                                $total_cliente = number_format(((float) $elemento->qty *  number_format($elemento->unit_price, 3)  * (int) $elemento->qty_bunches), 2);
                                $total_finca = number_format(((float) $elemento->qty *  number_format($elemento->price, 3)  * (int) $elemento->qty_bunches), 2);
                            }
                        }
                    } else {
                        if ((($elemento->product_category_id == 3) && ($elemento->cliente_id == 9))) {
                            $total_cliente = number_format(((float) $elemento->qty *  number_format($elemento->unit_price, 3)  * (int) $elemento->qty_bunches), 2);
                            $total_finca = number_format(((float) $elemento->qty *  number_format($elemento->price, 3)  * (int) $elemento->qty_bunches), 2);
                        } else {
                            if ($elemento->product_category_id  == 6 || $elemento->product_category_id  == 7 || $elemento->product_category_id  == 8 || $elemento->product_category_id  == 36) {
                                if ($elemento->cliente_id  == 5) {
                                    $total_cliente = number_format(((float) $elemento->qty *  number_format($elemento->unit_price, 3)  * (int) $elemento->qty_bunches), 2);
                                    $total_finca = number_format(((float) $elemento->qty *  number_format($elemento->price, 3)  * (int) $elemento->qty_bunches), 2);
                                } else {
                                    $total_cliente = number_format(((int) $elemento->qty *  number_format($elemento->unit_price, 3)  * (int) $elemento->total_steams), 2);
                                    $total_finca = number_format(((int) $elemento->qty *  number_format($elemento->price, 3)  * (int) $elemento->total_steams), 2);
                                }
                            } else {
                                $total_cliente = number_format((int) $elemento->qty *  number_format($elemento->unit_price, 3) * (int) $elemento->total_steams, 2);
                                $total_finca = number_format((int) $elemento->qty *  number_format($elemento->price, 3) * (int) $elemento->total_steams, 2);
                            }
                        }
                    }
                    $utilidad = $total_cliente - $total_finca;
                    $object->getActiveSheet()->setCellValueByColumnAndRow(12, $excel_row, $total_finca);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(13, $excel_row, $total_cliente);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(14, $excel_row, $utilidad);
                    $excel_row++;
                }
            }
        }
        $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        if ($cliente_id == 0) {
            header('Content-Disposition: attachment;filename="Reporte de utilidad.xls"');
        } else {
            header('Content-Disposition: attachment;filename="Reporte de utilidad ' . $cliente_object->cliente_name . '.xls"');
        }
        ob_end_clean();
        ob_start();

        $object_writer->save('php://output');
    }
    public function exportar_utilidad_finca()
    {
        $this->load->library("excel");
        $object = new PHPExcel();

        $fecha_inicio = date('Y-m-d', strtotime($this->input->post('fecha_inicio_utilidad_finca')));
        $fecha_fin = date('Y-m-d', strtotime($this->input->post('fecha_fin_utilidad_finca')));
        $cliente_id = $this->input->post('clientes_utilidad_finca');
        $provider_id = $this->input->post('finca_utilidad');
        $this->load->model('Empresa_model', 'company');
        $this->load->model('Buy_model', 'buy');
        $this->load->model('Buy_element_model', 'buy_element');
        $this->load->model('Client_model', 'cliente');
        $this->load->model('Provider_model', 'provider');
        $this->load->model('Invoice_provider_model', 'invoice_provider');
        $this->load->model('Request_model', 'request');
        $this->load->model('Credito_model', 'credito');
        $this->load->model('Payment_model', 'payment');
        $obj_provider = $this->provider->get_by_id($provider_id);
        $result = $this->request->get_element_by_request_group_finca($fecha_inicio, $fecha_fin, $cliente_id, $provider_id);
        foreach ($result as $item) {
            $item->elementos = $this->buy_element->get_element_by_request_id2($item->request_id, $item->provider_id);
            foreach ($item->elementos as $elemento) {
                $boxs = $this->buy_element->get_box_element_id($elemento->buy_element_id);
                if ($boxs) {
                    foreach ($boxs as $box) {
                        $box->element = $this->buy_element->get_element_by_id($box->box_element_id);
                    }
                }
                $elemento->boxs = $boxs;
            }
        }

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
        $object->getActiveSheet()->setCellValueByColumnAndRow(4, 4,  "Finca: " . $obj_provider->name);

        //  $objWorksheet->getActiveSheet()->getColumnDimension('A')->setWidth(100);
        $table_columns = array("FECHA DE VUELO", "PO", "CLIENTE", "No. CAJAS", "TIPO DE CAJA", "VARIEDAD", "MEDIDA", "No. BUNCHES", "No. TALLOS", "PRECIO FINCA", "PRECIO CLIENTE", "VALOR FINCA", "VALOR CLIENTE", "UTILIDAD");

        $column = 0;

        foreach ($table_columns as $field) {
            $object->getActiveSheet()->setCellValueByColumnAndRow($column, 5, $field);
            $column++;
        }
        for ($col = 'A'; $col != 'O'; $col++) {
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


        $object->getActiveSheet()->getStyle('A3:N3')->applyFromArray($estilo);
        $object->getActiveSheet()->getStyle('A4:N4')->applyFromArray($estilo);
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
        $object->getActiveSheet()->getStyle('L5')->applyFromArray($estilo);
        $object->getActiveSheet()->getStyle('M5')->applyFromArray($estilo);
        $object->getActiveSheet()->getStyle('N5')->applyFromArray($estilo);

        $object->getActiveSheet()->getStyle("A3:N3")->getFont()->setBold(true);
        $object->getActiveSheet()->getStyle("A4:N4")->getFont()->setBold(true);
        $object->getActiveSheet()->getStyle("A5:N5")->getFont()->setBold(true);

        $excel_row = 6;
        foreach ($result as $item) {

            foreach ($item->elementos as $elemento) {
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
                $object->getActiveSheet()->getStyle('L' . $excel_row)->applyFromArray($estilo);
                $object->getActiveSheet()->getStyle('M' . $excel_row)->applyFromArray($estilo);
                $object->getActiveSheet()->getStyle('N' . $excel_row)->applyFromArray($estilo);
                $object->getActiveSheet()->getStyle('D' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                $object->getActiveSheet()->getStyle('H' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                $object->getActiveSheet()->getStyle('I' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                $object->getActiveSheet()->getStyle('J' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                $object->getActiveSheet()->getStyle('K' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                $object->getActiveSheet()->getStyle('L' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                $object->getActiveSheet()->getStyle('M' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                $object->getActiveSheet()->getStyle('N' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $elemento->date_time_reception);
                $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $elemento->purchase_order);
                $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $elemento->cliente);
                $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, (int) $elemento->cajas);
                $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $elemento->box);
                $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $elemento->product);
                $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, "");
                $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, "");
                $object->getActiveSheet()->setCellValueByColumnAndRow(8, $excel_row, "");
                $object->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row, "");
                $object->getActiveSheet()->setCellValueByColumnAndRow(10, $excel_row, "");
                $object->getActiveSheet()->setCellValueByColumnAndRow(11, $excel_row, "");
                $object->getActiveSheet()->setCellValueByColumnAndRow(12, $excel_row, "");
                $object->getActiveSheet()->setCellValueByColumnAndRow(13, $excel_row, "");
                $excel_row++;
                if (count($elemento->boxs) > 0) {

                    foreach ($elemento->boxs as $box) {
                        foreach ($box->element as $pro) {
                            $bunches_cajas =  (int) $pro->nro_bunches * (int) $box->nro_cajas;
                            $tallos_caja =  (int) $pro->nro_bunches * (int) $pro->stems_bunch * (int) $box->nro_cajas;
                            $price_unit_cliente = (float) $pro->price_cliente;
                            $price_unit_finca = (float) $pro->price_finca;
                            $total_cliente_caja =  $tallos_caja *  $price_unit_cliente;
                            $total_finca_caja =  $tallos_caja *  $price_unit_finca;
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
                            $object->getActiveSheet()->getStyle('L' . $excel_row)->applyFromArray($estilo);
                            $object->getActiveSheet()->getStyle('M' . $excel_row)->applyFromArray($estilo);
                            $object->getActiveSheet()->getStyle('N' . $excel_row)->applyFromArray($estilo);
                            $object->getActiveSheet()->getStyle('D' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                            $object->getActiveSheet()->getStyle('H' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                            $object->getActiveSheet()->getStyle('I' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                            $object->getActiveSheet()->getStyle('J' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                            $object->getActiveSheet()->getStyle('K' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                            $object->getActiveSheet()->getStyle('L' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                            $object->getActiveSheet()->getStyle('M' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                            $object->getActiveSheet()->getStyle('N' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                            $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, "");
                            $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, "");
                            $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, "");
                            $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, "");
                            $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, "");
                            $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $pro->product);
                            $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $pro->name);
                            $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, (int) $bunches_cajas);
                            $object->getActiveSheet()->setCellValueByColumnAndRow(8, $excel_row, (int)$tallos_caja);
                            $object->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row, (float)  $price_unit_finca);
                            $object->getActiveSheet()->setCellValueByColumnAndRow(10, $excel_row,  (float)  $price_unit_cliente);
                            $utilidad = $total_cliente_caja - $total_finca_caja;
                            $object->getActiveSheet()->setCellValueByColumnAndRow(11, $excel_row, $total_finca_caja);
                            $object->getActiveSheet()->setCellValueByColumnAndRow(12, $excel_row, $total_cliente_caja);
                            $object->getActiveSheet()->setCellValueByColumnAndRow(13, $excel_row, $utilidad);
                            $excel_row++;
                        }
                    }
                } else {
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
                    $object->getActiveSheet()->getStyle('L' . $excel_row)->applyFromArray($estilo);
                    $object->getActiveSheet()->getStyle('M' . $excel_row)->applyFromArray($estilo);
                    $object->getActiveSheet()->getStyle('N' . $excel_row)->applyFromArray($estilo);
                    $object->getActiveSheet()->getStyle('D' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                    $object->getActiveSheet()->getStyle('H' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                    $object->getActiveSheet()->getStyle('I' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                    $object->getActiveSheet()->getStyle('J' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                    $object->getActiveSheet()->getStyle('K' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                    $object->getActiveSheet()->getStyle('L' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                    $object->getActiveSheet()->getStyle('M' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                    $object->getActiveSheet()->getStyle('N' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $elemento->date_time_reception);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $elemento->purchase_order);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $elemento->cliente);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, (int) $elemento->cajas);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $elemento->box);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $elemento->product);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $elemento->measure);
                    $total_bunches = (int)$elemento->qty_bunches * (int)$elemento->qty;
                    $total_tallos = (int) $elemento->total_steams * (int) $elemento->qty;
                    $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, (int) $total_bunches);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(8, $excel_row, (int)$total_tallos);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row, (float)  $elemento->price);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(10, $excel_row,  (float)  $elemento->unit_price);
                    $total_cliente = 0;
                    $total_finca = 0;
                    if ($elemento->product_category_id  == 4 || $elemento->product_category_id  == 5 || $elemento->product_category_id  == 27 || $elemento->product_category_id  == 31 || $elemento->product_category_id  == 10 || $elemento->product_category_id  == 25) {
                        if (($elemento->product_category_id == 31 && ($elemento->cliente_id == 6)) || ($elemento->product_category_id == 31 && ($elemento->cliente_id == 12))) {
                            $total_cliente = number_format(((float) $elemento->qty *  number_format($elemento->unit_price, 3)  * (float) $elemento->qty_bunches), 2);
                            $total_finca = number_format(((float) $elemento->qty *  number_format($elemento->price, 3)  * (float) $elemento->qty_bunches), 2);
                        } else {
                            if ($elemento->cliente_id != 5) {
                                if ($elemento->product_category_id == 25) {
                                    $total_cliente = number_format(((float) $elemento->qty *  number_format($elemento->unit_price, 3)  * (int) $elemento->qty_bunches), 2);
                                    $total_finca = number_format(((float) $elemento->qty *  number_format($elemento->price, 3)  * (int) $elemento->qty_bunches), 2);
                                } else {
                                    $total_cliente = number_format(((float) $elemento->qty *  number_format($elemento->unit_price, 3)  * (int) $elemento->total_steams), 2);
                                    $total_finca = number_format(((float) $elemento->qty *  number_format($elemento->price, 3)  * (int) $elemento->total_steams), 2);
                                }
                            } else {
                                $total_cliente = number_format(((float) $elemento->qty *  number_format($elemento->unit_price, 3)  * (int) $elemento->qty_bunches), 2);
                                $total_finca = number_format(((float) $elemento->qty *  number_format($elemento->price, 3)  * (int) $elemento->qty_bunches), 2);
                            }
                        }
                    } else {
                        if ((($elemento->product_category_id == 3) && ($elemento->cliente_id == 9))) {
                            $total_cliente = number_format(((float) $elemento->qty *  number_format($elemento->unit_price, 3)  * (int) $elemento->qty_bunches), 2);
                            $total_finca = number_format(((float) $elemento->qty *  number_format($elemento->price, 3)  * (int) $elemento->qty_bunches), 2);
                        } else {
                            if ($elemento->product_category_id  == 6 || $elemento->product_category_id  == 7 || $elemento->product_category_id  == 8 || $elemento->product_category_id  == 36) {
                                if ($elemento->cliente_id  == 5) {
                                    $total_cliente = number_format(((float) $elemento->qty *  number_format($elemento->unit_price, 3)  * (int) $elemento->qty_bunches), 2);
                                    $total_finca = number_format(((float) $elemento->qty *  number_format($elemento->price, 3)  * (int) $elemento->qty_bunches), 2);
                                } else {
                                    $total_cliente = number_format(((int) $elemento->qty *  number_format($elemento->unit_price, 3)  * (int) $elemento->total_steams), 2);
                                    $total_finca = number_format(((int) $elemento->qty *  number_format($elemento->price, 3)  * (int) $elemento->total_steams), 2);
                                }
                            } else {
                                $total_cliente = number_format((int) $elemento->qty *  number_format($elemento->unit_price, 3) * (int) $elemento->total_steams, 2);
                                $total_finca = number_format((int) $elemento->qty *  number_format($elemento->price, 3) * (int) $elemento->total_steams, 2);
                            }
                        }
                    }
                    $utilidad = $total_cliente - $total_finca;
                    $object->getActiveSheet()->setCellValueByColumnAndRow(11, $excel_row, $total_finca);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(12, $excel_row, $total_cliente);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(13, $excel_row, $utilidad);
                    $excel_row++;
                }
            }
        }
        $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        if ($cliente_id == 0) {
            header('Content-Disposition: attachment;filename="Reporte de utilidad.xls"');
        } else {
            header('Content-Disposition: attachment;filename="Reporte de utilidad ' . $obj_provider->name . '.xls"');
        }
        ob_end_clean();
        ob_start();

        $object_writer->save('php://output');
    }

    public function update_invoices_actives()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2, 4])) {
            $this->log_out();
            redirect('login/index');
        }
        $all_requests = $this->request->get_all_request();
        $updates = [];
        foreach ($all_requests as $item) {
            $invoice_object = $this->request->get_invoice_by_request($item->request_id);
            if ($invoice_object) {
                $this->request->update($item->request_id, ['invoice_active' => 1]);
                $updates[] = $invoice_object;
            }
        }
        var_dump($updates);
        exit();
    }
    public function get_invoice_by_id()
    {
        $id = $this->input->post('id');
        $invoice_object = $this->request->get_invoice_by_request($id);
        echo json_encode(['status' => 200, 'invoice' => $invoice_object]);
        exit();
    }
    public function update_po_status()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            echo json_encode(['status' => 404, 'msg' => 'No tiene permiso para realizar esta operación']);
            exit();
        }
        $this->load->model('Buy_element_model', 'buy_element');
        $this->load->model('Buy_model', 'buy');
        $this->load->model('Variety_model', 'variety');
        $this->load->model('Provider_model', 'provider');
        $this->load->model('Invoice_provider_model', 'invoice_provider');
        $this->load->model('Invoice_provider_element_model', 'invoice_provider_element');

        $requestId = $this->input->post('requestId');
        $objecto = $this->request->get_by_id($requestId);
        $this->session->set_flashdata('data_po', $objecto->purchase_order);

        if ($objecto->state == 0) {
            $boxs = $this->request->get_all_request_variety_by_id($requestId);
            $acumQtyBuy = 0;
            $acumQty = 0;
            foreach ($boxs as $item) {
                $obejctBoxs = $this->request_product_box->get_all_request_box_by_id($item->request_product_id);
                $objectBuy = $this->buy_element->get_buy_by_id($item->request_product_id);
                if ($objectBuy) {
                    foreach ($objectBuy as $buy) {
                        $acumQtyBuy += $buy->qty;
                    }
                }
                $acumQty += $obejctBoxs->qty;
            }
            $complete = $acumQty - $acumQtyBuy;
            if ($complete > 0) {
                echo json_encode(['status' => 404, 'msg' => 'Faltan compras para realizar esta operación']);
                exit();
            } else {
                $this->request->update($requestId, ['state' => 1]);
                echo json_encode(['status' => 200, 'msg' => 'Po actualizado correctamente']);
                exit();
            }
        } else if ($objecto->state == 1) {
            $requests = $this->buy->get_by_request_id2($requestId);
            $countInvoices = 0;
            $countCargueras = 0;
            $countTotalItems = 0;
            foreach ($requests as $item) {
                $invoice_provider = $this->invoice_provider->get_by_id2($item->provider_id, $item->buy_id);
                $provider = $this->buy_element->get_element_by_provider_id($item->request_id, $item->provider_id);
                $countTotalItems++;
                if ($invoice_provider) {
                    if ($invoice_provider->awb !== '') {
                        $countCargueras++;
                    }
                    if ($invoice_provider->nro_invoice !== '') {
                        $countInvoices++;
                    } else {
                        $countInvoiceElement = 0;
                        foreach ($provider as $pro) {
                            $factura_element = $this->invoice_provider_element->get_buy_element_by_id($pro->buy_element_id);
                            if ($factura_element) {
                                $countInvoiceElement++;
                            }
                        }
                        if ($countInvoiceElement === count($provider)) {
                            $countInvoices++;
                        }
                    }
                } else {
                    $countInvoiceElement = 0;
                    foreach ($provider as $pro) {
                        $factura_element = $this->invoice_provider_element->get_buy_element_by_id($pro->buy_element_id);
                        if ($factura_element) {
                            $countInvoiceElement++;
                        }
                    }
                    if ($countInvoiceElement === count($provider)) {
                        $countInvoices++;
                    }
                }
            }
            if ($countInvoices === 0) {
                echo json_encode(['status' => 404, 'msg' => 'Faltan facturas por confirmar']);
                exit();
            }
            if ($countCargueras === 0) {
                echo json_encode(['status' => 404, 'msg' => 'Faltan por confirmar las cargueras']);
                exit();
            }
            if ($countTotalItems === $countCargueras && $countTotalItems === $countInvoices) {
                $this->request->update($requestId, ['state' => 2]);
                echo json_encode(['status' => 200, 'msg' => 'Po actualizado correctamente']);
                exit();
            } else if ($countTotalItems === $countCargueras && $countTotalItems !== $countInvoices) {
                echo json_encode(['status' => 404, 'msg' => 'Faltan facturas por confirmar']);
                exit();
            } else {
                echo json_encode(['status' => 404, 'msg' => 'Faltan por confirmar las cargueras']);
                exit();
            }
        } else {
            echo json_encode(['status' => 404, 'msg' => 'El PO ya se encuentra actualizado']);
            exit();
        }
    }

    public function delete_po()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            echo json_encode(['status' => 404, 'msg' => 'No tiene permiso para realizar esta operación']);
            exit();
        }

        $requestId = $this->input->post('requestId');
        $objecto = $this->request->get_by_id($requestId);
        $this->session->set_flashdata('data_po', $objecto->purchase_order);
        $this->request->update($requestId, ['state' => -1]);
        echo json_encode(['status' => 200, 'msg' => 'Po eliminado correctamente']);
        exit();
    }
}
