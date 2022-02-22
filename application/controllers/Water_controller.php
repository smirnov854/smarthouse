<?php


class Water_controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model("user_model");
        $this->load->model("water_control_model");
    }

    public function index()
    {
        $this->show_list();
    }

    public function show_list()
    {
        $this->load->view('includes/header');
        $this->load->view("includes/menu");
        $this->load->view("water_control/water_control_list");
        $this->load->view('includes/footer');
    }



    public function search($page)
    {

        $user_data = $this->session->userdata();
        $params = json_decode(file_get_contents('php://input'));
        try {
            $search_params = [
              #  "flat_id" => $params->flat_id,
                 "tube" => $params->tube,
              #  "flat_name" => $params->flat_name,
              #  "date_from" => $params->date_from,
              #  "date_to" => $params->date_to,
                "status"=> $params->status,
                "limit" => 25,
                "offset" => (!empty($page) ? ($page - 1) * 25 : 0)
            ];
            $meter_list = $this->water_control_model->get_list($search_params);
            if ($meter_list === FALSE) {
                throw new Exception("Ошибка обращения к БД!", 300);
            }
            $result = [
                "status" => 200,
                "content" => $meter_list,
                "total_rows" => (count($meter_list) > 0 ? $meter_list[0]->total_count : 0),
            ];
        } catch (Exception $ex) {
            $result = array("message" => $ex->getMessage(),
                "status" => $ex->getCode());
        }
        echo json_encode($result);

    }





    public function change_status()
    {
        $params = json_decode(file_get_contents('php://input'));
        $common_info = array(
            "tube" => $params->tube,
            "cur_status"=>$params->cur_status
        );

        try {
            if (empty($common_info['tube'])) {
                throw new Exception("Ошибка получения номера стояка!", 300);
            }
            $new_status = empty($common_info['cur_status']) ? true : false;
            $res = $this->water_control_model->change_status($common_info);
            if (!$res) {
                throw new Exception("Ошибка обращения к базе данных!", 2);
            }
            $result = [
                "status" => 200,
                "message" => "Данные обновлены!",
                "content" => $new_status
            ];
        } catch (Exception $ex) {
            $result = array("message" => $ex->getMessage(),
                "status" => $ex->getCode());
        }
        echo json_encode($result);
    }


}