<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Upload_model extends CI_Model {

 //protected $path;

	function __construct()
	{
    parent::__construct();
    //$this->path = realpath(APPPATH . '../assets/uploads/files');
  }
  
  function set_upload_options($path)
  { 
    // upload an image options
    $config = [];
    $config['upload_path'] = $path;
    $config['allowed_types'] = 'gif|jpg|png';
    $config['max_size'] = '0';
    $config['quality'] = '70%';
    $config['encrypt_name'] = TRUE;
    $config['overwrite'] = FALSE;
    return $config;
  }
    
  function set_resize_option($img=null,$path)
  {
    // create resized image
    $riz = [];    
    $riz['image_library'] = 'GD2';
    $riz['source_image']	= $img['full_path'];
    $riz['new_image'] = $path;
    $riz['create_thumb'] = FALSE;
    $riz['maintain_ratio'] = FALSE;
    $riz['width'] = '1024';
    $riz['height'] = '693';

    $this->image_lib->initialize($riz);
    $this->image_lib->resize();
    $this->image_lib->clear();

  }

  function uploads( $fieldName = 'upload', $path ='' )
  {
    $files = $_FILES;
    $count = count($_FILES[$fieldName]['name']);
    for($i=0; $i<$count; $i++)
    {
      $_FILES[$fieldName]['name']= $files[$fieldName]['name'][$i];
      $_FILES[$fieldName]['type']= $files[$fieldName]['type'][$i];
      $_FILES[$fieldName]['tmp_name']= $files[$fieldName]['tmp_name'][$i];
      $_FILES[$fieldName]['error']= $files[$fieldName]['error'][$i];
      $_FILES[$fieldName]['size']= $files[$fieldName]['size'][$i];

      $this->upload->initialize($this->set_upload_options($path));
      $this->upload->do_upload($fieldName);
      $upload_data = $this->upload->data();
      $this->set_resize_option($upload_data,$path);
      
      $name_array[] = $upload_data['file_name'];
      $fileName = $upload_data['file_name'];
      $images[] = $fileName;
      
    }
    return $images;
  }

}