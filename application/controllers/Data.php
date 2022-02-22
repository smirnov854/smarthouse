<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data extends CI_Controller {
     
    private $error = "";
  
    public function __construct()
    {
        parent::__construct();
        $this->load->model('data_model');
        $this->load->model('flat_model');
    }

    public function index()
    {
        $this->show_export_page();
    }


    public function show_export_page(){
        $this->load->view("includes/header");
        $this->load->view("includes/menu");
        $this->load->view("data/export");
        $this->load->view("includes/footer");
    }
    
    public function do_export(){
        $params = json_decode(file_get_contents('php://input'));
        $search_params = [
            "date_start"=>$params->dateStart,
            "date_end"=>$params->dateEnd,
            "flats"=>$params->flats
        ];
        $export_data = $this->data_model->prepare_to_export($search_params);
        $file_name = "uploads/export/".time().".csv";
        $file_handle = fopen($file_name,"w");
        fputs($file_handle, chr(0xEF) . chr(0xBB) . chr(0xBF)); // BOM
        foreach($export_data as $row){
            $res_arr = [];
            foreach ($row  as $key=>$tmp){
                $res_arr[$key] = str_replace('.',",",$tmp);
            }
            $arr_to_write = [
                $res_arr['flat_name'],
                $res_arr['fm_name'],
                $res_arr['sum_value'],
                $res_arr['deveui'],
                $res_arr['flat_id'],
                $res_arr['acc_id'],
            ];

            fputcsv($file_handle,$arr_to_write,';');
        }
        fclose($file_handle);
        echo json_encode(['status'=>200,'file_name'=>$file_name]);
    }

    public function do_import(){
        $config['upload_path']          = './uploads/import/';
        $config['allowed_types']        = 'csv';
        $config['max_size']             = 10000;

        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        $this->upload->do_upload('file');
        $file_handle = fopen($this->upload->data('full_path'),"r");
        while(($data = fgetcsv($file_handle,"999",";")) == true){
            $flat_data = $this->flat_model->get_by_name($data[1]);
            $update_arr = [
                "date"=>$data[0],
                "amount"=>$data[2],
                "debt"=>$data[3],
                "to_pay"=>$data[4],
            ];
            $this->db->where('flat_id',$flat_data->id)->update('invoice',$update_arr);
        }
        echo json_encode(['status'=>200,'message'=>'Успешно загружeно']);
        return;
    }
}
