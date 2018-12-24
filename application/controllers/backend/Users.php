<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller{

    public function __construct() 
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('email');        
    }

    public function index()
    {
        if( $this->session->has_userdata('user') ) redirect('backend/dashboard');
        $this->form_validation->set_rules('user_name', 'User Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required' );
        $data['message'] = Null;
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            if ($this->form_validation->run())
            {
                $username = $this->input->post('user_name');
                $password = $this->input->post('password');
                $role = ($this->input->post('role')) ? $this->input->post('role') : 1;
                $pass = md5(md5(sha1($password)));
                $user_data = $this->main_model->get_admin($username,$pass,$role)->row();
                if( $user_data )
                {
                    unset( $user_data->password );
                    $this->session->set_userdata('user',$user_data);
                    redirect('backend/dashboard');
                }else{
                    $this->session->set_flashdata('message',show_message('خطأ فى الأسم / كلمة المرور ', 'danger'));
                    redirect('/backend/users');
                }
            }  
        }
        $this->load->view('admin/login',$data);
    }

    public function forget()
    {
        $this->form_validation->set_rules('e_mail', 'Email', 'required|valid_email');
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            if ($this->form_validation->run())
            {
                $email = $this->input->post('e_mail');
                $member_data = get_this('users',['e_mail'=>$email]);
                $settings = get_table('settings');
                if($member_data){
                    $new_pass = generate_password(10);
                    $this->main_model->update('users',['password'=>md5(md5(sha1($new_pass)))],['user_id'=>$member_data['user_id']]);
                    $this->email->to($member_data['e_mail']);
                    $this->email->from($settings[5]->value, $settings[1]->value);
                    $this->email->subject('Password Changes');
                    $this->email->message('السلام عليكم .. تم تغيير كلمة السر .. كلمة السر الجديدة هى : '.$new_pass);
                    $this->email->send();
                    $this->session->set_flashdata('message',show_message2('تم أرسال بريد لك بكلمة السر الجديدة'));
                    redirect('users');
                }else{
                    $this->session->set_flashdata('message',show_message2('هذا البريد غير موجود ', 'danger'));
                    redirect('users');
                }
            } 
        }
        $this->load->view('admin/login');
    }

    function logout() 
    {
        $this->session->sess_destroy();
        redirect('/backend/users');
    }
}