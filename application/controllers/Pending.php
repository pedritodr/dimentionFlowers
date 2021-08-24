<?php

class Pending extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Pending_model', 'pending');
        $this->load->library(array('session'));
        $this->load->helper("mabuya");

        @session_start();
        $this->load_language();
        $this->init_form_validation();
    }

    public function index()
    {

        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }
        $this->load->model('Motivo_model', 'motivo');
        //  $all_pendings = $this->pending->get_all_pending_by_request_id();
        $all_pendings = $this->pending->get_all_pending_by_group();
        foreach ($all_pendings as $item) {
            $providers = $this->pending->get_all_pending_by_request_id($item->request_id, $item->provider_id);
            /*   if ($providers) {
                foreach ($providers as $provi) {
                    $provi->motivo_lista = $this->motivo->get_by_id($provi->motivo_csm);
                }
            } */
            $item->providers = $providers;
        }
        // var_dump($all_pendings);
        // die();
        $data['all_pendings'] = $all_pendings;
        $this->load_view_admin_g("pending/index", $data);
    }

    public function add_index()
    {
        if (!in_array($this->session->userdata('role_id'), [1])) {
            $this->log_out();
            redirect('login/index');
        }

        $this->load_view_admin_g('nunit/add');
    }


    function exportar($request_id = 0, $provider_id = 0)
    {
        $this->load->library("excel");
        $object = new PHPExcel();

        $pendings = $this->pending->get_all_pending_by_request_id($request_id, $provider_id);
        $this->load->model('Request_model', 'request');
        $this->load->model('Provider_model', 'provider');
        $provider = $this->provider->get_by_id($provider_id);
        $request = $this->request->get_by_id($request_id);

        // $object->setActiveSheetIndex(0);
        $object->setActiveSheetIndex(0)->mergeCells('A3:F3');
        //  $object->setActiveSheetIndex(0)->mergeCells('A2:B2');

        $object->getActiveSheet()->setCellValueByColumnAndRow('A', 3, "Finca: " . $provider->name);
        $object->getActiveSheet()->setCellValueByColumnAndRow(0, 4, "Nro invoice: 0");
        $object->getActiveSheet()->setCellValueByColumnAndRow(1, 4, "PO: " . $request->purchase_order);

        $object->getActiveSheet()->getStyle("A5")->getFont()->setBold(true);
        $table_columns = array("MOTIVO", "VARIEDAD", "MEDIDA/PESO", "NRO CAJAS", "PRECIO", "TOTAL");

        $column = 0;

        foreach ($table_columns as $field) {
            $object->getActiveSheet()->setCellValueByColumnAndRow($column, 5, $field);
            $column++;
        }
        for ($col = 'A'; $col != 'F'; $col++) {
            $object->getActiveSheet()->getColumnDimension($col)->setAutoSize(true);
        }

        $estilo = array(
            'borders' => array(
                'outline' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );

        $object->getActiveSheet()->getStyle('A3:F3')->applyFromArray($estilo);
        $object->getActiveSheet()->getStyle('A4:F4')->applyFromArray($estilo);
        $object->getActiveSheet()->getStyle('A5')->applyFromArray($estilo);
        $object->getActiveSheet()->getStyle('B5')->applyFromArray($estilo);
        $object->getActiveSheet()->getStyle('B4')->applyFromArray($estilo);
        $object->getActiveSheet()->getStyle('C5')->applyFromArray($estilo);
        $object->getActiveSheet()->getStyle('D5')->applyFromArray($estilo);
        $object->getActiveSheet()->getStyle('E5')->applyFromArray($estilo);
        $object->getActiveSheet()->getStyle('F5')->applyFromArray($estilo);

        $object->getActiveSheet()->getStyle("A3:F3")->getFont()->setBold(true);
        $object->getActiveSheet()->getStyle("A4:F4")->getFont()->setBold(true);
        $object->getActiveSheet()->getStyle("A5:F5")->getFont()->setBold(true);

        $excel_row = 6;
        $total = 0;
        foreach ($pendings as $item) {

            $object->getActiveSheet()->getStyle('A' . $excel_row)->applyFromArray($estilo);
            $object->getActiveSheet()->getStyle('B' . $excel_row)->applyFromArray($estilo);
            $object->getActiveSheet()->getStyle('C' . $excel_row)->applyFromArray($estilo);
            $object->getActiveSheet()->getStyle('D' . $excel_row)->applyFromArray($estilo);
            $object->getActiveSheet()->getStyle('E' . $excel_row)->applyFromArray($estilo);
            $object->getActiveSheet()->getStyle('F' . $excel_row)->applyFromArray($estilo);

            $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $item->reason);
            $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $item->product);
            $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $item->measure);
            $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $item->qty);
            $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, number_format($item->price, 2));
            $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, number_format(((int) $item->qty * (float) $item->price), 2));

            $total = $total + ((int) $item->qty * (float) $item->price);

            $excel_row++;
        }

        $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, "TOTAL = " . number_format($total, 2));
        $object->getActiveSheet()->getStyle('A' . $excel_row)->applyFromArray($estilo);
        $object->getActiveSheet()->getStyle('B' . $excel_row)->applyFromArray($estilo);
        $object->getActiveSheet()->getStyle('C' . $excel_row)->applyFromArray($estilo);
        $object->getActiveSheet()->getStyle('D' . $excel_row)->applyFromArray($estilo);
        $object->getActiveSheet()->getStyle('E' . $excel_row)->applyFromArray($estilo);
        $object->getActiveSheet()->getStyle('F' . $excel_row)->applyFromArray($estilo);

        $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Factura por finca devueltas.xls"');
        ob_end_clean();
        ob_start();

        $object_writer->save('php://output');
    }
}
