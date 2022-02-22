<?php

class Warning_model extends CI_Model
{
    public $table_name = "notify_person";
    
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
            $this->db->where("np.flat_id",$flat_id);
        }

        if(!empty($person_id)){
            $this->db->where("np.person_id",$person_id);
        }
        
        $query = $this->db->select("np.*, flat.name as flat_name, flat_person.name as person_name,count(*) OVER() AS total_count")
                          ->join("flat_person","flat_person.id=np.person_id","LEFT")
                          ->join("flat","flat.id=np.flat_id","LEFT")
                          ->order_by("np.id DESC")
                          ->get("notify_person np");
        
        return $query->result();        
    }
    
    public function add($common_info) {
        if(!empty($common_info['person_id'])){
            if(!$this->is_person_exists($common_info['person_id'])){
                throw new Exception("Жильца с указанным ID не существует",300);    
            }
            
        }
        return parent::add($common_info); // TODO: Change the autogenerated stub
    }

    public function is_person_exists($id){
        $res = $this->db->where("id",$id)->get("flat_person");
        $result = $res->result();
        if(count($result) == 0 ){
            return FALSE;
        }
        return TRUE;
    }


    public function get_new_warnings(){
        $result = $this->db->select("COUNT(1) as cnt",FALSE)->where('is_sent=false',null,false)->get('message_sent');
        return $result->result()[0];
    }


}