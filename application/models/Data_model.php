<?php


class Data_model extends CI_Model
{
    public function prepare_to_export($search_params)
    {
        $date_start = $search_params['date_start'];
        $date_end = $search_params['date_end'];
        $flats = $search_params['flats'];
        $this->db->where("fm.name <>'дат.про'",NULL,FALSE);
        if(!empty($date_start)){
            $this->db->where("md.stamp>= '$date_start 00:00:00'",NULL,FALSE);
        }
        if(!empty($date_end)){
            $this->db->where("md.stamp< '$date_end 00:00:00'",NULL,FALSE);
        }
        if(!empty($flats)){
            $this->db->where("fl.name LIKE '$flats'",NULL,FALSE);
        }

        $result = $this->db->select("fm.flat_id,
                                     fm.id,
                                     fm.acc_id,
                                     fm.name as fm_name,
                                     fl.id as flat_id,
                                     fl.name as flat_name,
                                     acc.deveui,
                                     SUM(fm.value) as sum_value,
                                     ")
                           ->join("flat as fl","fl.id=fm.flat_id","left")
                           ->join("meter_data as md","md.meter_id=fm.id","left")
                           ->join("acc","acc.id=fm.acc_id","left")
                           ->group_by("fm.flat_id,fm.id,fm.acc_id,fl.id,fl.name,acc.deveui")
                           ->order_by('fm.flat_id')
                           ->order_by('fm.name')
                           ->get('flat_meter fm');
        return $result->result_array();
        /*
        $sql = "
                    SELECT fm.flat_id,fm.id,fm.acc_id,fl.id,fl.name,acc.deveui,SUM(fm.value) as sum_value
                    FROM flat_meter fm
                    LEFT JOIN flat as fl ON fl.id=fm.flat_id
                    LEFT JOIN meter_data as md ON md.meter_id=fm.id
                    LEFT JOIN acc ON acc.id=fm.acc_id
                    WHERE fm.name <>'дат.про' 
                      AND md.stamp>= '".$date_start."' 
                      AND md.stamp<  '".$date_end."'
                      AND flats
                    GROUP BY fm.flat_id,fm.id,fm.acc_id,fl.id,fl.name,acc.deveui
                    ";*/

    }
}