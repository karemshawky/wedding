<?php defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

class Food extends REST_Controller 
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
        $data['results'] = get_table('food_companies',['type_id'=>$id],['id','name','star','pic'], ['created_date','desc'],$limit,$page);
        
        if ($data['results']) {
            $this->response($data,200); 
        }else{
            $this->response(['status' => '400','message' => 'لا يوجد محلات تقديم'],400); 
        }
    }

    public function id_get()
    {   
        $id = (int) $this->get('id',TRUE);

        if ($id) {
            $query = get_this('food_companies',['id'=>$id]);
        }
        if ($query)
        {
            $data['status']  = 200;
            $pic[] = ['id'=>'0', 'link'=> $query['pic'] ];
            if ($query['type_id'] == 12)
                $pics  = get_table('images',[ 'category_id'=> 12, 'place_id'=> $query['id']], ['id','link'] );
            if ($query['type_id'] == 13)
                $pics  = get_table('images',[ 'category_id'=> 13, 'place_id'=> $query['id']], ['id','link'] );        
            if ($query['type_id'] == 14)
                $pics  = get_table('images',[ 'category_id'=> 14, 'place_id'=> $query['id']], ['id','link'] );
            if ($query['type_id'] == 15)
                $pics  = get_table('images',[ 'category_id'=> 15, 'place_id'=> $query['id']], ['id','link'] );
            if ($query['type_id'] == 16)
                $pics  = get_table('images',[ 'category_id'=> 16, 'place_id'=> $query['id']], ['id','link'] );
            if ($query['type_id'] == 17)
                $pics  = get_table('images',[ 'category_id'=> 17, 'place_id'=> $query['id']], ['id','link'] );    
            unset($query['pic']);

            $data['results'] = $query;
            $data['results']['city'] = get_this('cities',['id'=> $query['city']],'name');
            $data['results']['images'] = array_merge($pic, $pics);

            $this->response($data,200);
        }else{
            $this->response(['status' => '400','message' => 'محل غير موجود'],400); 
        }
    }

    public function other_food_post()
    {  
        $id = (int) $this->post('order_id',TRUE);
        $message =  trim($this->post('message',TRUE));
        
        $this->form_validation->set_rules($message,'','trim|xss_clean');
	 
        if( $this->form_validation->run() ){
                    
            $this->db->insert('other_food',['order_id'=>$id,'message'=>$message]);
            $data['status']  = 200;
            $data['message'] = 'وصلت الرسالة بنجاح';
            $this->response($data,200);    	
        }else{
            $data['status']  = 400;
            $data['message'] = 'خطأ فى أرسال الرسالة';
            $this->response($data,400); 
        }
    }
}