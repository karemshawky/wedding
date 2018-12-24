<?php defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

class Flowers extends REST_Controller 
{

    function __construct()
    {
        parent::__construct();
    }

    public function latest_get()
    {   
        $id = (int) $this->get('type_id',TRUE);
        $limit  = ($this->get('per_page')) ? (int) $this->get('per_page') : 3; 
        $offset = ($this->get('page_num')) ? (int) $this->get('page_num') : 1;
        $page   = $offset * $limit- $limit;

        $data['status']  = 200;
        if ( $id == 1 || $id == 2 ){
            $data['results'] = get_table('flowers',['type_id'=>$id],['id','name','star','pic'], ['created_date','desc'],$limit,$page);
        }elseif ( $id == 3 ){
            $data['results'] = get_table('flowers',['type_id'=>$id],['id','name','star','pic','lat','lang'], ['created_date','desc'],$limit,$page);
        }
        
        if ($data['results']) {
            $this->response($data,200); 
        }else{
            $this->response(['status' => '400','message' => 'لا يوجد محلات زهور'],400); 
        }
    }

    public function id_get()
    {   
        $id = (int) $this->get('id',TRUE);

        if ($id) {
            $query = get_this('flowers',['id'=>$id]);
        }

        if ($query)
        {
            $data['status']  = 200;
            $pic[] = ['id'=>'0', 'link'=> $query['pic'] ];
            if ($query['type_id'] == 1)
                $pics  = get_table('images',[ 'category_id'=> 9, 'place_id'=> $query['id']], ['id','link'] );
            if ($query['type_id'] == 2)
                $pics  = get_table('images',[ 'category_id'=> 10, 'place_id'=> $query['id']], ['id','link'] );        
            if ($query['type_id'] == 3)
                $pics  = get_table('images',[ 'category_id'=> 11, 'place_id'=> $query['id']], ['id','link'] );
            unset($query['pic']);

            $data['results'] = $query;
            $data['results']['city'] = get_this('cities',['id'=> $query['city']],'name');
            $data['results']['images'] = array_merge($pic, $pics);

            $this->response($data,200);
        }else{
            $this->response(['status' => '400','message' => 'محل غير موجود'],400); 
        }
    }

}