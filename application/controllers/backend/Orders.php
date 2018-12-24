<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Orders extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		if( !$this->session->has_userdata('user') ) redirect('backend/users');
	}

    public function _example_output($output = null)
	{
		$this->load->view('admin/blank',(array)$output);
    }
    
    public function index()
	{
        try{
            $crud = new grocery_CRUD();
            
            $crud->set_subject('طلبات');
            $crud->unset_add();
			$crud->unset_edit();
            $crud->unset_delete();
            $crud->unset_fields('token_id','ver_code');
            $crud->columns('id','first_name','last_name','email','phone','city','address','card_type','card_number','order_date');
            $crud->set_primary_key('id','cities');            
            $crud->set_relation('city','cities','name');    
            $crud->add_action('تفاصيل الطلب', base_url().'assets/grocery_crud/themes/flexigrid/css/images/details.png', 'backend/orders/details');
            $crud->field_type('card_type','dropdown',['1' => 'فيزا','2' => 'كينت']);
            $crud->display_as('id','المسلسل')->display_as('first_name','الاسم الاول')->display_as('last_name','الاسم الأخير')->display_as('email','البريد الالكترونى')->display_as('city','المدينة')->display_as('phone','الهاتف')->display_as('address','العنوان')->display_as('card_type','نوع بطاقة الائتمان')->display_as('card_number','رقم بطاقة الائتمان')->display_as('order_date','تاريخ الطلب');
            $crud->set_table('order_user');
            $output = $crud->render();
            
            $data['tbl'] = 'order_user';
            $data['col'] = 'id';
            $output->data=$data;

			$this->_example_output($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
        }
    }

    public function details($id=null)
    {
        if ( !$id ) show_404();
        $data['id'] = $id;
        $data['details']= get_table('search',['order_id'=>$id]);
        $data['others'] = get_this('other_food',['order_id'=>$id],'message');
        $data['output'] = '';
        $data['main_content'] = 'admin/details';
        $this->load->view('admin/blank',$data);
    }

    public function _callback_value_price($value)
    {
        return $value." KWD";
    } 

}