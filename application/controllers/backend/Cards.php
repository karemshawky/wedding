<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cards extends CI_Controller {

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

            $crud->set_subject('بطاقة دعوة');
            $crud->columns('id','name','city','star','price','pic','created_date');
            $crud->set_field_upload('pic','assets/uploads/cards');
            $crud->set_primary_key('id','cities');            
            $crud->set_relation('city','cities','name');
            $crud->unique_fields(['name','pic']);
            $crud->required_fields('name','city','pic','star','price');
            $crud->callback_column('price','_price');     
            $crud->callback_column('star','_star');
            $crud->callback_after_upload('resize_original_image');   
            $crud->add_action('الصور', base_url().'assets/img/images.png', 'backend/dashboard/imgs/8','imgx');   
            $crud->field_type('star','dropdown',['1' => '1','2' => '2','3' =>'3' ,'4' => '4','5' => '5']);
            $crud->display_as('id','المسلسل')->display_as('name','الاسم')->display_as('city','المدينة')->display_as('star','التقييم')->display_as('price','السعر')->display_as('pic','صورة')->display_as('created_date','تاريخ التسجيل');

            $crud->set_table('invite_cards');
            $output = $crud->render();
            
            $data['tbl'] = 'invite_cards';
            $data['col'] = 'id';
            $output->data=$data;

			$this->_example_output($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
        }
    }

}