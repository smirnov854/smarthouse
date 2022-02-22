<?php

class Water_control_model extends CI_Model
{
    public $table_name = "water_control";

    public function get_list($search_params = [])
    {
        extract($search_params);
        if (!empty($limit)) {
            $this->db->limit($limit);
        }

        if (!empty($offset)) {
            $this->db->offset($offset);
        }


        if (!empty($tube)) {
            $this->db->where("wc.tube LIKE '%$tube%'", NULL, FALSE);
        }

        if (!empty($status)) {
            $status = $status == 1 ? "false" : "true";
            $this->db->where("wc.status=$status ", NULL, FALSE);
        }



        $query = $this->db->select("wc.id as wc_id,                                    
                                    CASE 
                                     WHEN wc.status IS false THEN 0
                                    ELSE 1
                                    END as wc_status,
                                    wc.tube as fl_tube,                                     
                                    count(*) OVER() AS total_count",FALSE)
            ->where("wc.tube IS NOT NULL", NULL, FALSE)
            ->order_by('wc_id')
            ->get("water_control wc");
        //echo $this->db->last_query();

        return $query->result();
    }

    public function change_status($data)
    {
        if (empty($data['tube'])) {
            return false;
        }

        $new_status = empty($data['cur_status']) ? true : false;
        $query = $this->db->where("tube='" . $data['tube'] . "'")
                          ->update("water_control", ['status' => $new_status]);


        return $query;
    }
}