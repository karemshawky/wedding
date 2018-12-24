<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admins extends CI_Controller
{
    public function __construct() 
    {
        parent::__construct();
        $this->load->database();
    }

    public function _example_output($output = null)
	{
		$this->load->view('admin/blank',(array)$output);
    }
    
    public function index()
	{
        if( $this->session->user->role != 1 ) redirect('backend/users');

        try{
			$crud = new grocery_CRUD();

            $crud->set_subject('مسئول');
            $crud->columns('id','name','email','phone','city','pic','role','is_active','created_date');
            $crud->required_fields('name','email','phone','city','role','pic','created_date');
            $crud->unique_fields(['email','phone']);
            $crud->set_field_upload('pic','assets/uploads/admins');
            $crud->callback_add_field('password','set_password_input_to_empty');
            $crud->callback_before_insert('encrypt_password_callback');  
            $crud->callback_edit_field('password','set_password_input_to_empty');
            $crud->callback_before_update('encrypt_password_callback');
            $crud->callback_after_upload('resize_original_image');       
            $crud->field_type('role','dropdown',['1'=>'مدير النظام','2'=>'مسئول']);
            $crud->set_primary_key('id','cities');            
            $crud->set_relation('city','cities','name');
            $crud->display_as('id','المسلسل')->display_as('name','الاسم')->display_as('password','كلمة المرور')->display_as('email','البريد الالكترونى')->display_as('pic','صورة')->display_as('phone','هاتف')->display_as('city','المدينة')->display_as('role','النوع')->display_as('is_active','الحالة')->display_as('created_date','تاريخ الانضمام');
            $crud->set_table('users');
            $output = $crud->render();
            
            $data['tbl'] = 'users';
            $data['col'] = 'id';

			$this->_example_output($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
        }
    }

    public function profile($id=null)
	{
        $man = get_this('users',['id'=> $this->session->user->id],'id');
        if ( $this->session->user->id  == $man ) {

            try{
                $crud = new grocery_CRUD();

                $crud->set_subject('مسئول');
                $crud->columns('id','name','email','phone','city','pic');
                $crud->required_fields('name','email','phone','city','pic');
                $crud->unique_fields(['email','phone']);
                $crud->unset_fields('role','is_active','created_date');
                $crud->unset_add();
                $crud->unset_delete();
                $crud->set_field_upload('pic','assets/uploads/admins');
                $crud->callback_add_field('password','set_password_input_to_empty');
                $crud->callback_before_insert('encrypt_password_callback');        
                $crud->callback_edit_field('password','set_password_input_to_empty');
                $crud->callback_before_update('encrypt_password_callback');
                $crud->callback_after_upload('resize_original_image');       
                $crud->set_primary_key('id','cities');            
                $crud->set_relation('city','cities','name');
                $crud->display_as('id','المسلسل')->display_as('name','الاسم')->display_as('password','كلمة المرور')->display_as('email','البريد الالكترونى')->display_as('pic','صورة')->display_as('phone','هاتف')->display_as('city','المدينة');
                $crud->where('users.id',$this->session->user->id);
                $crud->set_table('users');
                $output = $crud->render();
                $data['tbl'] = 'users';
                $data['col'] = 'id';

                $this->_example_output($output);

            }catch(Exception $e){
                show_error($e->getMessage().' --- '.$e->getTraceAsString());
            }

        }
    }

}    