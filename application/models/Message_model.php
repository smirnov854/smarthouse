<?php
class Message_model extends CI_Model{
    public function setStatus($ids){
        $expl = explode(",",$ids);
        foreach ($expl as $row){
            $this->db->where('id',$row)->update('message_sent',['is_sent'=>true]);
        }
    }
}