<?php defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

class Home extends REST_Controller 
{

    function __construct()
    {
        parent::__construct();
    }

    public function search_info_get()
    {  
        $data['status']   = 200;
        $data['cities']   = get_table('cities');
        $data['category'] = get_table('category',['category_id'=>0],['id','name']);

        if ($data) {
            $this->response($data,200); 
        }
    }

    public function get_subcategory_get()
    {  
        $id = (int) $this->get('id',TRUE);

        $data['category'] = get_table('category',['category_id'=> $id],['id','name','pic']);

        if ( !empty($data['category']) ) {
            $data['status'] = 200;
            $this->response($data,200); 
        }else{
            $data['status'] = 400;
            $data['category'] = 'لا يوجد أقسام فرعية لهذا القسم';
            $this->response($data,400); 
        }
    }

    public function call_us_get()
    {  
        $data['status'] = 200;
        $data['phone']  = get_this('settings',['title'=>'الهاتف'],'description');
        if ($data) {
            $this->response($data,200); 
        }
    }

    public function menu_get()
    {  
        $limit  = ($this->get('per_page')) ? (int) $this->get('per_page') : 3; 
        $offset = ($this->get('page_num')) ? (int) $this->get('page_num') : 1;
        $page   = $offset * $limit- $limit;

        $id = (int) $this->get('id',TRUE);
        if( $id == 1 ) :
            $table = 'halls';             
        elseif ( $id == 4 ) :
            $table = 'photography';                                
        elseif ( $id == 5 ) : 
            $table = 'buffets';                               
        elseif ( $id == 6 ) :  
            $table = 'decors';                              
        elseif ( $id == 7 ) :
            $table = 'artists';                                
        elseif ( $id == 8 ) :  
            $table = 'invite_cards';                             
        endif;
        $data['category']  = get_table($table,null,['id','name','pic','star'],['created_date','desc'],$limit,$page);

        if ( $id == 2 ) :    
            $table = 'flowers';
            $data['category']['natural'] = get_table($table,['type_id'=> 1],['id','name','pic','star'],['created_date','desc'],$limit,$page);
            $data['category']['artificial'] = get_table($table,['type_id'=> 2],['id','name','pic','star'],['created_date','desc'],$limit,$page);
            $data['category']['koosh'] = get_table($table,['type_id'=> 3],['id','name','pic','star'],['created_date','desc'],$limit,$page);
        elseif ( $id == 3 ) :
            $table = 'food_companies';
            $data['category']['dessert'] = get_table($table,['type_id'=> 12],['id','name','pic','star'],['created_date','desc'],$limit,$page);
            $data['category']['pies'] = get_table($table,['type_id'=> 13],['id','name','pic','star'],['created_date','desc'],$limit,$page);
            $data['category']['juices'] = get_table($table,['type_id'=> 14],['id','name','pic','star'],['created_date','desc'],$limit,$page);
            $data['category']['coffee'] = get_table($table,['type_id'=> 15],['id','name','pic','star'],['created_date','desc'],$limit,$page);   
            $data['category']['chocolate'] = get_table($table,['type_id'=> 16],['id','name','pic','star'],['created_date','desc'],$limit,$page);
        endif;

        if ( $data['category'] ) {
            $data['status'] = 200;            
            $this->response($data,200); 
        }else{
            $data['status'] = 400;                        
            $data['category'] = 'قسم غير موجود';                        
            $this->response($data,400); 
        }
    }

    public function contact_post()
    {  
        $id = (int) $this->post('type_id',TRUE);
        $message =  trim($this->post('message',TRUE));
        
        $this->form_validation->set_rules($message,'','trim|xss_clean');
	 
        if( $this->form_validation->run() ){
                    
            $this->db->insert('contact_us',['type_id'=>$id,'message'=>$message]);
            $data['status']  = 200;
            $data['message'] = 'وصلت الرسالة بنجاح';
            $this->response($data,200);    	
        }else{
            $data['status']  = 400;
            $data['message'] = 'خطأ فى أرسال الرسالة';
            $this->response($data,400); 
        }
    }

    public function search_it_get()
    {  
        $city  = ($this->get('city_id')) ? (int) $this->get('city_id'): 0;
        $date  = ($this->get('date')) ? $this->get('date') : date('Y-m-d');
        $price = ($this->get('price')) ? (int) $this->get('price'): 1;     
        $occasion = ($this->get('occasion')) ? (int) $this->get('occasion'): 3; 
        $category = ($this->get('category_id')) ? (int) $this->get('category_id'): 1; 

        $limit  = ($this->get('per_page')) ? (int) $this->get('per_page') : 3; 
        $offset = ($this->get('page_num')) ? (int) $this->get('page_num') : 1;
        $page   = $offset * $limit- $limit;

        if( $category == 1 ) {
            $cat = get_table('search',['city'=> $city, 'category_id'=>1,'order_date'=> $date]);
            if($cat){
                foreach ($cat as $not) {
                    $arr1[] = $not->shop_id;
                    $res = $this->main_model->not_reserve('halls',['city'=>$city,'price <='=>$price,'type_id'=> $occasion ],$arr1,['id','name','pic','star'],$limit,$page);
                }
            }else{
                $all = get_table('halls',['city'=>$city,'price <='=>$price,'type_id'=> $occasion ],['id','name','pic','star'],['created_date','desc'],$limit,$page);
            }
        }

        if ( $category == 4 ) 
        {
            $table = 'photography';
            $cat = get_table('search',['city'=> $city, 'category_id'=>4,'order_date'=> $date]);
            if($cat){
                foreach ($cat as $not) {
                    $arr1[] = $not->shop_id;
                    $res = $this->main_model->not_reserve($table,['city'=>$city,'price <='=>$price ],$arr1,['id','name','pic','star'],$limit,$page);
                }
            }else{
                $all = get_table($table,['city'=>$city,'price <='=>$price ],['id','name','pic','star'],['created_date','desc'],$limit,$page);
            }    
        } 

        if ( $category == 6 ) {
            $table = 'decors';
            $cat = get_table('search',['city'=> $city, 'category_id'=>6,'order_date'=> $date]);
            if($cat){
                foreach ($cat as $not) {
                    $arr1[] = $not->shop_id;
                    $res = $this->main_model->not_reserve($table,['city'=>$city,'price <='=>$price ],$arr1,['id','name','pic','star'],$limit,$page);
                }
            }else{
                $all = get_table($table,['city'=>$city,'price <='=>$price ],['id','name','pic','star'],['created_date','desc'],$limit,$page);
            } 
        }        
                                
        if ( $category == 7 ) {
            $cat = get_table('search',['city'=> $city, 'category_id'=>7,'order_date'=> $date]);
            if($cat){
                foreach ($cat as $not) {
                    $arr1[] = $not->shop_id;
                    $res = $this->main_model->not_reserve('artists',['city'=>$city,'price <='=>$price ],$arr1,['id','name','pic','star'],$limit,$page);
                }
            }else{
                $all = get_table('artists',['city'=>$city,'price <='=>$price ],['id','name','pic','star'],['created_date','desc'],$limit,$page);
            }
        }

        if ( $category == 5 ) : 
            $all = get_table('buffets',['city'=>$city,'price <='=>$price ],['id','name','pic','star'],['created_date','desc'],$limit,$page);
        elseif ( $category == 8 ) :  
            $all = get_table('invite_cards',['city'=>$city,'price <='=>$price ],['id','name','pic','star'],['created_date','desc'],$limit,$page);      
        endif;

        if ( $category == 2 ) :    
            $table = 'flowers';
            $all['natural'] = get_table($table,['city'=>$city,'price <='=>$price,'type_id'=> 1],['id','name','pic','star'],['created_date','desc'],$limit,$page);
            $all['artificial'] = get_table($table,['city'=>$city,'price <='=>$price,'type_id'=> 2],['id','name','pic','star'],['created_date','desc'],$limit,$page);
            $all['koosh'] = get_table($table,['city'=>$city,'price <='=>$price,'type_id'=> 3],['id','name','pic','star'],['created_date','desc'],$limit,$page);
        elseif ( $category == 3 ) :
            $table = 'food_companies';
            $all['dessert'] = get_table($table,['city'=>$city,'price <='=>$price,'type_id'=> 12],['id','name','pic','star'],['created_date','desc'],$limit,$page);
            $all['pies'] = get_table($table,['city'=>$city,'price <='=>$price,'type_id'=> 13],['id','name','pic','star'],['created_date','desc'],$limit,$page);
            $all['juices'] = get_table($table,['city'=>$city,'price <='=>$price,'type_id'=> 14],['id','name','pic','star'],['created_date','desc'],$limit,$page);
            $all['coffee'] = get_table($table,['city'=>$city,'price <='=>$price,'type_id'=> 15],['id','name','pic','star'],['created_date','desc'],$limit,$page);   
            $all['chocolate'] = get_table($table,['city'=>$city,'price <='=>$price,'type_id'=> 16],['id','name','pic','star'],['created_date','desc'],$limit,$page);
        endif;

        $data['status']  = 200;            
        if ( !empty($res) ){
            $data['results'] = $res;
        }elseif( empty($res) && !empty($all) ){
            $data['results'] = $all;
        }elseif( empty($res) && empty($all) ){
            $data['status']  = 400;                        
            $data['results'] = 'لا يوجد نتائج';
            $this->response($data,400); 
        }
        $this->response($data,200);             
    }

    public function reserved_get()
    { 
        $category = ($this->get('category_id')) ? (int) $this->get('category_id'): 1; 
        $shop = ($this->get('shop_id')) ? (int) $this->get('shop_id'): 1; 

        if ( $category && $shop ) {
            $result = get_table('search',[ 'category_id'=>$category, 'shop_id'=>$shop, 'order_date >='=> date('Y-m-d') ],['id','category_id','shop_id','order_date']);
            if ( $result ) 
            {
                $data['status']  = 200;
                $data['results'] = $result;
                $this->response($data,200); 
            }else{
                $data['status']  = 400;                        
                $data['results'] = 'لا يوجد نتائج';
                $this->response($data,400); 
            }
        }
    }

    public function make_order_post()
    {  
        $newOrderId =  $this->db->select_max('id')->get('order_user')->row(); 

        // $id = (int) $this->post('type_id',TRUE);
        // $message =  $this->post('message');
                 
        //$this->db->insert('contact_us',['type_id'=>$id,'message'=>$message]);

        $data['status']  = 200;
        $data['message'] = $newOrderId;
        $this->response($data,200);   
    }

}