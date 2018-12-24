<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Foods extends CI_Controller {

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

            $crud->set_subject('تقديم ');
            $crud->columns('id','name','type_id','city','star','price','pic','created_date');
            $crud->set_field_upload('pic','assets/uploads/foods');
            $crud->set_primary_key('id','cities');            
            $crud->set_relation('city','cities','name');
            $crud->unique_fields(['name','pic']);
            $crud->required_fields('name','city','pic','star','price','type_id','created_date');
            $crud->callback_column('price','_price');     
            $crud->callback_column('star','_star');
            $crud->callback_after_upload('resize_original_image');  
            $crud->add_action('الصور', base_url().'assets/img/images.png', 'backend/dashboard/imgs/3','imgx');     
            $crud->field_type('star','dropdown',['1' => '1','2' => '2','3' =>'3' ,'4' => '4','5' => '5']);
            $crud->field_type('type_id','dropdown',['12' => 'الحلو','13' => 'الفطائر','14' =>'عصائر' ,'15' => 'القهوة','16' => 'الشوكولاته']);
            $crud->display_as('id','المسلسل')->display_as('name','الاسم')->display_as('city','المدينة')->display_as('star','التقييم')->display_as('type_id','القسم')->display_as('price','السعر')->display_as('pic','صورة')->display_as('created_date','تاريخ التسجيل');

            $crud->set_table('food_companies');
            $output = $crud->render();
            
            $data['tbl'] = 'food_companies';
            $data['col'] = 'id';
            $output->data=$data;

			$this->_example_output($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
        }
    }

    public function others()
	{
        try{
			$crud = new grocery_CRUD();

            $crud->unset_add();
            $crud->unset_edit();
            $crud->set_subject('تقديم ');
            $crud->columns('id','order_id','message'); 
            $crud->display_as('id','المسلسل')->display_as('order_id','رقم الطلب')->display_as('message','الطلب');
            $crud->set_table('other_food');
            $output = $crud->render();
            
            $data['tbl'] = 'other_food';
            $data['col'] = 'id';
            $output->data=$data;

			$this->_example_output($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
        }
    }

}