<?php


class Leak_model extends CI_Model
{
    public $table_name = "flat_sensor";

    public function get_list($search_params  =[])
    {
        extract($search_params);
        if(!empty($limit)){
            $this->db->limit($limit);
        }
        if(!empty($offset)){
            $this->db->offset($offset);
        }

        if(!empty($flat_id)){
            $this->db->where("fs.flat_id",$flat_id,FALSE);
        }

        if(!empty($tube)){
            $this->db->where("fs.tube LIKE '$tube'",NULL,FALSE);
        }

        if(!empty($flat_name)){
            $this->db->where("fl.name ='$flat_name'",NULL,FALSE);
        }

        if(isset($value) && is_numeric($value)){
            if($value == -1){
                $this->db->where(" fs.value IS NULL ",NULL,FALSE);
            }else{
                $this->db->where("fs.value ='$value'",NULL,FALSE);
            }

        }

        if(!empty($order_by) && !empty($order_by_direction)){
            $this->db->order_by("$order_by $order_by_direction");
        }else{
            $this->db->order_by("fs.id DESC");
        }

        $this->db->where("fs.name LIKE '%дат.про%'");
        $query = $this->db->select("fs.id,
                                    fs.tube as fs_tube,
                                    fl.name as flat_name,
                                    (
                                        SELECT string_agg(phone, ',') 
                                        FROM flat_person 
                                        WHERE flat_person.flat_id=fl.id
                                    ) as person_phone,
                                    fs.value as fs_type,
                                    fs.port as port,
                                   
                                    (fs.stamp + interval '5' hour) as fs_stamp,
                                    count(*) OVER() AS total_count")
            ->join("flat fl","fl.id=fs.flat_id","LEFT")
            ->get("$this->table_name fs");

        return $query->result();
    }

}