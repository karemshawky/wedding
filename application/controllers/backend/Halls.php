<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Halls extends CI_Controller {

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

            $crud->set_subject('قاعة');
            $crud->columns('id','name','city','type_id','star','price','pic','area','people','rooms','windows','bathrooms','lat','lang','created_date');
            $crud->set_field_upload('pic','assets/uploads/halls');
            $crud->set_primary_key('id','cities');            
            $crud->set_relation('city','cities','name');
            $crud->required_fields('name','city','type_id','star','pic','price','area','people','created_date');
            $crud->unique_fields(['name','pic']);
            $crud->change_field_type('lat', 'hidden');
            $crud->change_field_type('lang', 'hidden');
            $crud->callback_column('area','_area');     
            $crud->callback_column('star','_star');
            $crud->callback_column('price','_price');     
            $crud->callback_column('rooms','_rooms');     
            $crud->callback_column('people','_person');     
            $crud->callback_column('windows','_windows');     
            $crud->callback_column('bathrooms','_bathrooms');     
            $crud->callback_after_upload('resize_original_image');    
            $crud->add_action('الصور', base_url().'assets/img/images.png', 'backend/dashboard/imgs/1','imgx');
            $crud->add_action('خريطة', base_url().'assets/img/map.png', 'backend/dashboard/maps/1','imgx');   
            $crud->field_type('type_id','dropdown',['1' => 'زواج','2' => 'خطوبة','3' =>'أستقبال' ,'4' => 'تخرج']);
            $crud->field_type('star','dropdown',['1' => '1','2' => '2','3' =>'3' ,'4' => '4','5' => '5']);
            $crud->display_as('id','المسلسل')->display_as('name','الاسم')->display_as('city','المدينة')->display_as('type_id','النوع')->display_as('star','التقييم')->display_as('price','السعر')->display_as('pic','صورة')->display_as('area','المساحة')->display_as('people','السعة')->display_as('rooms','عدد الغرف')->display_as('windows','عدد النوافذ')->display_as('bathrooms','عدد دورات المياه')->display_as('lat','خط عرض')->display_as('lang','خط طول')->display_as('created_date','تاريخ التسجيل');

            $crud->set_table('halls');
            $output = $crud->render();
            
            $data['tbl'] = 'halls';
            $data['col'] = 'id';
            $output->data=$data;

			$this->_example_output($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
        }
    }

}