<?php defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('get_this')) {
    /**
     * 1- Get one coloumn from row
     * 2- Get one row from table
     */
    function get_this($table = null, $where = null, $colomn = null)
    {
        if (empty($table) || empty($where)) {
            return false;
        } else {
            $ci = &get_instance();
            $role = $ci->db->get_where($table, $where)->row_array();
            if (!empty($colomn)) {
                return $role[$colomn];
            } else {
                return $role;
            }
        }
    }
}
if (!function_exists('get_table')) {
    /**
     *  1- Get all data from table based on query($where)
     *  2- Get all data from table with select
     *  3- Get all data from table
     *  4- Get all data from table with pagniation
     */
    function get_table($table = null, $where = null, $select = null, $order = null, $limit = null, $offset = null)
    {
        if (!$table) :
            return false; else :
            $ci = &get_instance();
        if ($select) {
            $ci->db->select($select);
        }
        if ($where) {
            $ci->db->where($where);
        }
        if ($order) {
            $ci->db->order_by($order[0], $order[1]);
        }
        return $ci->db->get($table, $limit, $offset)->result();
        endif;
    }
}
if (!function_exists('get_count')) {
    /**
     * 1- Get (SUMN) of one coloumn in table
     * 2- Get (COUNT) number of rows from table based on query($where)
     * 3- Get (COUNT) number of all rows of table
     */
    function get_count($table = null, $where = null, $col = null, $count = null)
    {
        if (!$table) :
           return false; else :
           $ci = &get_instance();
        if ($where) {
            $ci->db->where($where);
        }
        if ($col) :
               $ci->db->select_sum($col);
        return $ci->db->get($table)->result()[0]->$col; elseif ($count == 'count') :
               return $ci->db->count_all_results($table);
        endif;
        endif;
    }
}
if (!function_exists('get_avg')) {
    function get_avg($table, $table_id = '', $id = '')
    {
        $ci = &get_instance();
        if ($id) {
            $rate = $ci->db->select_avg('rate')->get_where($table, [$table_id => $id])->row()->rate;
        }
        if ($rate) {
            return $rate;
        } else {
            return 0;
        }
    }
}
if (!function_exists('generate_password')) {
    function generate_password($len = 5)
    {
        $charset = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        $base = strlen($charset);
        $result = '';

        $now = explode(' ', microtime())[1];
        while ($now >= $base) {
            $i = $now % $base;
            $result = $charset[$i] . $result;
            $now /= $base;
        }
        return substr($result, -5);
    }
}
if (!function_exists('get_setting')) {
    function get_setting($name)
    {
        $CI = &get_instance();
        $query = $CI->db->get_where('settings', ['name' => $name])->result();
        if ($query) {
            return $query[0]->value;
        } else {
            return '';
        }
    }
}
if (!function_exists('show_message')) {
    function show_message($message, $type = 'success')
    {
        $type = ($type == 'success') ? 'success' : 'danger';
        return '<div class="alert media fade in remove alert-' . $type . ' alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    ' . $message . '
                </div>';
    }
}
if (!function_exists('send_notification')) {
    function send_notification($token, $title, $message)
    {
        //API access key from Google API's Console
        define('API_ACCESS_KEY', 'API_ACCESS_KEY_HERE');
        //prep the bundle
        $msg = ['title' => $title, 'body' => $message];
        $fields = ['registration_ids' => $token, 'notification' => $msg];
        $headers = ['Authorization: key=' . API_ACCESS_KEY, 'Content-Type: application/json'];
        //Send Reponse To FireBase Server
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        // Execute post
        $result = curl_exec($ch);
        // if($result === false){
        //         die('Curl failed:' .curl_errno($ch));
        // }
        //Close connection
        curl_close($ch);
        //print_r($result);exit;
        //return $result;
    }
}
