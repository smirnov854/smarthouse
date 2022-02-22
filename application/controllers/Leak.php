<?php

class Leak extends CI_Controller
{
    public function __construct() {
        parent::__construct();

        $this->load->model("user_model");
        $this->load->model("leak_model");
    }

    public function index() {
        $this->show_list();
    }

    public function show_list(){
        $this->load->view('includes/header');
        $this->load->view("includes/menu");
        $this->load->view("leak/leak_list");
        $this->load->view('includes/footer');
    }

    public function get_type_list(){
        $meter_type_list = $this->flat_meter_model->get_types();
        $result = [
            "status"=>200,
            "contents"=>$meter_type_list,
        ];
        echo json_encode($result);
    }

    public function search($page){

        $user_data = $this->session->userdata();
        $params = json_decode(file_get_contents('php://input'));
        try {
            $search_params = [
                "flat_id"=>$params->flat_id,
                "tube"=>$params->tube,
                "flat_name"=>$params->flat_name,
                "date_from"=>$params->date_from,
                "date_to"=>$params->date_to,
                "value"=>$params->value,
                "limit"=>25,
                "order_by"=>$params->order_by,
                "order_by_direction"=>$params->order_by_direction,
                "offset"=>(!empty($page) ? ($page-1)*25:0)
            ];
            $leak_list = $this->leak_model->get_list($search_params);
            if ($leak_list === FALSE) {
                throw new Exception("Ошибка обращения к БД!", 300);
            }
            $result = [
                "status" => 200,
                "content" => $leak_list,
                "total_rows"=>(count($leak_list)>0 ? $leak_list[0]->total_count : 0),
            ];
        } catch (Exception $ex) {
            $result = array("message" => $ex->getMessage(),
                "status" => $ex->getCode());
        }
        echo json_encode($result);

    }

    public function delete($id){
        try {
            if(empty($id) || !is_numeric($id)){
                throw new Exception("Ошибка получения id!",301);
            }
            if(!$this->flat_meter_model->delete($id)){
                throw new Exception('Ошибка удаления',302);
            }
            $result = [
                "status" => 200,
            ];
        } catch (Exception $ex) {
            $result = array("message" => $ex->getMessage(),
                "status" => $ex->getCode());
        }
        echo json_encode($result);
    }



    public function add_new_meter(){
        $params = json_decode(file_get_contents('php://input'));
        $common_info = array(
            "name" => $params->name,
            "flat_id"=>$params->flat_id,
            "acc_id"=>$params->acc_id,
            "meter_type_id"=>$params->meter_type_id,
            "port"=>$params->port,
            "tube"=>$params->tube,
            "value"=>$params->value,
        );

        try {
            if (empty($common_info['name'])){
                throw new Exception("Ошибка заполнения формы!", 300);
            }
            $res = $this->flat_meter_model->add($common_info);
            if (!$res) {
                throw new Exception("Ошибка обращения к базе данных!", 2);
            }
            $result = [
                "status" => 200,
                "message" => "Данные добавлены!",
                "content"=>[]
            ];
        } catch (Exception $ex) {
            $result = array("message" => $ex->getMessage(),
                "status" => $ex->getCode());
        }
        echo json_encode($result);
    }

    public function edit_meter($id){
        $params = json_decode(file_get_contents('php://input'));
        $common_info = array(
            "name" => $params->name,
            "flat_id"=>$params->flat_id,
            "acc_id"=>$params->acc_id,
            "meter_type_id"=>$params->meter_type_id,
            "port"=>$params->port,
            "tube"=>$params->tube,
            "value"=>$params->value,
        );

        try {
            if (empty($common_info['name'])){
                throw new Exception("Ошибка заполнения формы!", 300);
            }
            $res = $this->flat_meter_model->edit($id,$common_info);
            if (!$res) {
                throw new Exception("Ошибка обращения к базе данных!", 2);
            }
            $result = [
                "status" => 200,
                "message" => "Данные обновлены!",
                "content"=>[]
            ];
        } catch (Exception $ex) {
            $result = array("message" => $ex->getMessage(),
                "status" => $ex->getCode());
        }
        echo json_encode($result);
    }

    public function set_message_status(){
        $this->load->model("message_model");
        $ids = $this->input->post('ids');
        $this->message_model->setStatus($ids);
        return json_encode(['status'=>200]);
    }




}