<?php


use Pusher\Pusher;

class Cron extends CI_Controller
{

    public function __construct() {
        parent::__construct();
    }

    public function send_message(){
        $this->load->config('pusher');

        // Get config variables
        $app_id     = $this->config->item('pusher_app_id');
        $app_key    = $this->config->item('pusher_app_key');
        $app_secret = $this->config->item('pusher_app_secret');
        $app_cluster = $this->config->item('pusher_app_cluster');


        $pusher = new Pusher($app_key,$app_secret,$app_id,['cluster'=>$app_cluster]);
        $sql = "SELECT * FROM message_sent WHERE is_sent=FALSE AND type=1";
        $query_res = $this->db->query($sql);
        $res = $query_res->result();

        if(count($res) == 0){
            return;
        }
        $text = "";
        $ids = [];
        foreach($res as $key=>$row){
            if($key>20){
                break;
            }
            $text.=$row->message."\n";
            $ids[] = $row->id;
            $this->db->where('id',$row->id)->update('message_sent',['is_sent'=>true]);
        }

        $result = $pusher->trigger("leak_notification",'receive_message',
            [
                'message'=>$text,
                'ids'=>implode(",",$ids)
            ]
        );
    }

}