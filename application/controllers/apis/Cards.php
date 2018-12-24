<?php defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

class Cards extends REST_Controller 
{

    function __construct()
    {
        parent::__construct();
    }

    public function latest_get()
    {   
        $limit  = ($this->get('per_page')) ? (int) $this->get('per_page') : 3; 
        $offset = ($this->get('page_num')) ? (int) $this->get('page_num') : 1;
        $page   = $offset * $limit- $limit;

        $data['status']  = 200;
        $data['results'] = get_table('invite_cards',null,['id','name','star','pic'], ['created_date','desc'],$limit,$page);
        
        if ($data) {
            $this->response($data,200); 
        }else{
            $this->response(['status' => '400','message' => 'لا يوجد بطاقات دعوة'],400); 
        }
    }

    public function id_get()
    {   
        $id = (int) $this->get('id',TRUE);

        if ($id) {
            $query = get_this('invite_cards',['id'=>$id]);
        }

        if ($query)
        {
            $data['status']  = 200;
            $pic[] = ['id'=>'0', 'link'=> $query['pic'] ];
            $pics  = get_table('images',[ 'category_id'=> 8, 'place_id'=> $query['id']], ['id','link'] );
            unset($query['pic']);

            $data['results'] = $query;
            $data['results']['city'] = get_this('cities',['id'=> $query['city']],'name');
            $data['results']['images'] = array_merge($pic, $pics);

            $this->response($data,200);
        }else{
            $this->response(['status' => '400','message' => 'بطاقة دعوة غير موجودة'],400); 
        }
    }

}