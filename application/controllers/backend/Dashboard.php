<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		if( !$this->session->has_userdata('user') ) redirect('users');
	}

	public function index()
	{
		$data['halls']   = get_count('halls',null,null,'count');
		$data['artists'] = get_count('artists',null,null,'count');
		$data['buffets'] = get_count('buffets',null,null,'count');
		$data['decors']  = get_count('decors',null,null,'count');
		$data['flowers'] = get_count('flowers',null,null,'count');
		$data['foods']   = get_count('food_companies',null,null,'count');
		$data['cards']   = get_count('invite_cards',null,null,'count');
		$data['photos']  = get_count('photography',null,null,'count');
		$data['orders']  = get_count('order_user',null,null,'count');
		$data['admins']  = get_count('users',null,null,'count');
		$data['cities']  = get_count('cities',null,null,'count');
		$data['like']    = get_count('contact_us',['type_id'=>1],null,'count');
		$data['dislike'] = get_count('contact_us',['type_id'=>2],null,'count');

		$data['output']  = '';		
		$data['main_content'] = 'admin/main';
		$this->load->view('admin/blank',$data);
	}

	public function _example_output($output = null)
	{
		$this->load->view('admin/blank',(array)$output);
	}
	
	public function cities()
	{
		try{
			$crud = new grocery_CRUD();

            $crud->set_subject('مدن');
            $crud->columns('id','name');
            $crud->unique_fields(['name']);
            $crud->required_fields('name');    
			$crud->unset_read();
			$crud->unset_delete();
            $crud->display_as('id','المسلسل')->display_as('name','الاسم');

            $crud->set_table('cities');
            $output = $crud->render();
            
            $data['tbl'] = 'cities';
            $data['col'] = 'id';
            $output->data=$data;

			$this->_example_output($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
        }
	}

	public function about()
	{
		try{
			$crud = new grocery_CRUD();

            $crud->columns('id','title','description');
			$crud->unset_delete();
			$crud->unset_read();
            $crud->display_as('id','المسلسل')->display_as('title','العنوان')->display_as('description','الوصف');
            $crud->set_table('settings');
            $output = $crud->render();
            $data['tbl'] = 'settings';
            $data['col'] = 'id';
            $output->data=$data;

			$this->_example_output($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
        }
	}

	public function contact()
	{
		try{
			$crud = new grocery_CRUD();

            $crud->columns('id','message','type_id');
			$crud->unset_add();
			$crud->unset_edit();
            $crud->display_as('id','المسلسل')->display_as('message','الرسالة')->display_as('type_id','الحالة');
			$crud->field_type('type_id','dropdown',['1' => 'معجب','2' => 'غير معجب','3'=> 'رسالة']);
            $crud->set_table('contact_us');
            $output = $crud->render();
            $data['tbl'] = 'contact_us';
            $data['col'] = 'id';
            $output->data=$data;

			$this->_example_output($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
        }
	}
	
	public function imgs($cat=null,$id=null)
    {
		if ( !$id ) show_404();
		$data['images'] = get_table('images',['category_id'=>$cat, 'place_id'=> $id ]);
        $data['output'] = '';
        $data['main_content'] = 'admin/images';

        if ( $this->input->post('submit') )
        {
			if     ( $cat == 1 ) : $path = '/halls';
			elseif ( $cat == 2 ) : $path = '/flowers';
			elseif ( $cat == 3 ) : $path = '/foods';
			elseif ( $cat == 4 ) : $path = '/photographers';
			elseif ( $cat == 5 ) : $path = '/buffets';
			elseif ( $cat == 6 ) : $path = '/decors';
			elseif ( $cat == 7 ) : $path = '/artists';
			elseif ( $cat == 6 ) : $path = '/cards';
			endif;

			$images = $this->upload_model->uploads('uploads', realpath(APPPATH . '../assets/uploads') . $path);
			foreach ( $images as $img ) 
			{
				$pic['link'] = $img; 
				$pic['category_id'] = $cat; 
				$pic['place_id'] = $id;
				$arr[] = $pic;
			}

			$this->db->insert_batch('images',$arr); 
			redirect($_SERVER['HTTP_REFERER']);
        }

        $this->load->view('admin/blank',$data);
	}

	public function del_img($id=null)
    {
		if ( !$id ) show_404();
		$row = get_this( 'images',['id'=> $id ] );
		if ( !empty($row) ) 
		{
			if     ( $row['category_id'] == 1 ) : $path = 'halls/';
			elseif ( $row['category_id'] == 2 ) : $path = 'flowers/';
			elseif ( $row['category_id'] == 3 ) : $path = 'foods/';
			elseif ( $row['category_id'] == 4 ) : $path = 'photographers/';
			elseif ( $row['category_id'] == 5 ) : $path = 'buffets/';
			elseif ( $row['category_id'] == 6 ) : $path = 'decors/';
			elseif ( $row['category_id'] == 7 ) : $path = 'artists/';
			elseif ( $row['category_id'] == 6 ) : $path = 'cards/';
			endif;

			unlink('assets/uploads/' . $path . $row['link'] );
			$this->db->delete('images',['id'=> $id ]);
			redirect($_SERVER['HTTP_REFERER']);
		} 
		show_404();
	}

	public function maps($cat=null,$id=null) 
	{
        if (!$id || !$cat ) redirect( '/backend/dashboard' );
		
		if     ( $cat == 1 ) : $table = 'halls';
		elseif ( $cat == 2 ) : $table = 'flowers';
		elseif ( $cat == 4 ) : $table = 'photography';
		elseif ( $cat == 5 ) : $table = 'buffets';
		elseif ( $cat == 6 ) : $table = 'decors';
		endif;

        $place = $data['place'] = get_this($table,['id'=>$id]);
        if (!$place) redirect( '/backend/dashboard' );

        $thLat = ( $place['lat'] == 0  ) ? '29.375232935898936' : $place['lat'];
        $thLng = ( $place['lang'] == 0 ) ? '47.9777218573837'   : $place['lang'] ;

		$config['center'] = $thLat .','. $thLng;
		$config['zoom'] = '15';
		$this->googlemaps->initialize($config);

		$marker = [];
		$marker['position'] = $thLat .','. $thLng;
		$marker['draggable'] = true;
        $marker['ondragend'] = '$(".lat").val(event.latLng.lat());$(".lang").val(event.latLng.lng());';

        if ( $this->input->post('submit') )
        {
            $this->db->update($table,['lat'=> $this->input->post('lat'),'lang'=> $this->input->post('lang')],['id'=>$id]);
            redirect($_SERVER['HTTP_REFERER'],'refresh');
        }

		$this->googlemaps->add_marker($marker);
		$data['map'] = $this->googlemaps->create_map();
        $data['output'] = '';
        $data['main_content'] = 'admin/maps';
		$this->load->view('admin/blank', $data);

	}

}