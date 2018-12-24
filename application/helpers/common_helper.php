<?php defined('BASEPATH') OR exit('No direct script access allowed');

if ( !function_exists ('_price') )
{
    /** 
     * - Get currency name 
     */ 
    function _price($value)
    {
        return $value." KWD";
    } 
}
if ( !function_exists ('_hours') )
{
    /** 
     * - Get hours  
     */ 
    function _hours($value)
    {
        return $value." ساعة";
    } 
}
if ( !function_exists ('_star') )
{
    /** 
     * - Get star  
     */ 
    function _star($value)
    {
        return $value." نجمة";
    } 
}
if ( !function_exists ('_person') )
{
    /** 
     * - Get number of persons  
     */ 
    function _person($value)
    {
        return $value." شخص";
    } 
}

if ( !function_exists ('_area') )
{
    /** 
     * - Get area meter  
     */ 
    function _area($value)
    {
        return $value." م2";
    }  
}

if ( !function_exists ('_rooms') )
{
    /** 
     * - Get rooms name  
     */ 
    function _rooms($value)
    {
        return $value." غرفة";
    }
}

if ( !function_exists ('_windows') )
{
    /** 
     * - Get windows name  
     */ 
    function _windows($value)
    {
        return $value." نافذة";
    } 
}

if ( !function_exists ('_bathrooms') )
{
    /** 
     * - Get bathrooms name
     */ 
    function _bathrooms($value)
    {
        return $value." دورة مياه";
    }  
}
if ( !function_exists ('encrypt_password_callback') )
{
    /** 
     * - Encrypt password only if is not empty. Else don't change the password to an empty field 
     */ 
    function encrypt_password_callback($post_array, $primary_key) 
    {      
        if(!empty($post_array['password']))
        {
            $post_array['password'] = md5(md5(sha1($post_array['password'])));
        }else{
            unset($post_array['password']);
        }
        return $post_array;
    }
}
if ( !function_exists ('set_password_input_to_empty') )
{
    /** 
     * - Hidden input for password 
     */   
    function set_password_input_to_empty() 
    {
        return "<input type='password' name='password' value='' />";
    }
}
if ( !function_exists ('resize_original_image') )
{
    /** 
     * - Get original image to resize after upload  
     */ 
    function resize_original_image($uploader_response,$field_info, $files_to_upload)
    {
        $CK =& get_instance();

        $CK->load->library('image_moo');
        $CK->load->config('grocery_crud');
        $CK->config->set_item('grocery_crud_file_upload_allow_file_types','gif|jpeg|jpg|png');

        $file_uploaded = $field_info->upload_path.'/'.$uploader_response[0]->name; 
        $CK->image_moo->load($file_uploaded)->resize_crop(1024,693)->save($file_uploaded,true);
        return true;
    }
}