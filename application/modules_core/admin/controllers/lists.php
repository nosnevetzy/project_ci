<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Lists extends System_Core {
    function __construct() {
        $this->classname = strtolower(get_class());
        $this->pagename = $this->uri->rsegment(2);
        $this->methodname = $this->uri->rsegment(3);
        parent:: __construct();
        
    }

    /*
     * Request Data 
     */

    function _request_data($method, $data) {
        $condition = '';
        if (!empty($data['condition'])) {
            $condition = $data['condition'];
        }

        $stringcondition = '';
        if (!empty($data['stringcondition'])) {
            $stringcondition = $data['stringcondition'];
        }

        $page = 1;
        if ($data['page'] != '') {
            $page = $data['page'];
        }

        $display = 10;
        if ($data['display'] != '') {
            $display = $data['display'];
        }

        return self::$method($data['search'], $page, $data['sort'], $display, $data['num_button'], $condition, $stringcondition, $data['contents']);
    }

    /*
     * Generate Return List Data
     */

    function _generate_data($list_count, $list, $page, $display, $num_button) {
        $data['page'] = $page;
        $data['display'] = $display;
        $data['list'] = $list;
        $data['printlist'] = $list_count;
        $data['list_count'] = $list_count->num_rows();
        $data['max_page'] = ((ceil($list_count->num_rows() / $display))<=0)?1:(ceil($list_count->num_rows() / $display));

        /* Button and Pages Initialization */
        if ($data['list_count'] > 0) {
            $start_rowcount = (($page - 1) * $display) + 1;
            $end_rowcount = (($page - 1) * $display) + $list->num_rows();
            $data['rowcount'] = array('start' => $start_rowcount, 'end' => $end_rowcount);

            $batch_button = ceil($page / $num_button);
            $start_button = (($batch_button - 1) * $num_button) + 1;
            $end_button = (($batch_button - 1) * $num_button) + $num_button;
            if ($end_button > $data['max_page']) {
                $end_button = $end_button - ($end_button - $data['max_page']);
            }
            $next_button = $page + 1;
            if ($next_button > $data['max_page']) {
                $next_button = 0;
            }
            $prev_button = $page - 1;
            if ($prev_button <= 0) {
                $prev_button = 0;
            }
            $data['button'] = array('start' => $start_button, 'end' => $end_button, 'next' => $next_button, 'prev' => $prev_button);
        }

        return $data;
    }

    /* ------------------------------- List Process --------------------------------------------------------------------------------------------- */
    /* ------------------------------- Manipulate List --------------------------------------------------------------------------------------------- */

    /*
     * List For User
     */

    function _user_list($search, $page, $sort, $display, $num_button, $fixcondition = array()) {
        $this->load->model('admin/users_model');
        $users_model = new users_model();
        /* Default Order */
        $sort_data = array('u.user_lname' => 'ASC', 'u.user_fname' => 'ASC');
        if (!empty($sort)) {
            if ($sort['sort_by'] == 'user_name') {
                $sort_data = array('u.user_lname' => $sort['sort_type'], 'u.user_fname' => $sort['sort_type']);
            } else if ($sort['sort_by'] == 'sup_user') {
                $sort_data = array('su.user_lname' => $sort['sort_type'], 'su.user_fname' => $sort['sort_type']);
            } else {
                $sort_data = array($sort['sort_by'] => $sort['sort_type']);
            }
        }

        /* Where Condition */
        $condition_string = array();
        $condition = array();

        if (!empty($fixcondition)) {
            $condition = array_merge($condition, $fixcondition);
        }

        /* Search Condition */
        if (!empty($search)) {
            foreach ($search as $var => $val) {
                if ($val != '') {
                    if ($var == 'id_user') {
                        $condition = array_merge($condition, array("u." . $var => $val));
                    } else if ($var == 'user_code' OR $var == 'user_position') {
                        $condition = array_merge($condition, array("u." . $var . " like" => $val));
                    } else if ($var == 'add_user' or $var == 'edit_user' or $var == 'sup_user') { /* User Name Search */
                        if ($var == 'add_user')
                            $pt = 'au';
                        if ($var == 'edit_user')
                            $pt = 'uu';
                        if ($var == 'sup_user')
                            $pt = 'su';
                        if ($var == 'user_name')
                            $pt = 'u';
                        if (!empty($pt)) {
                            $explodeitem = explode(" ", $val);
                            if (!empty($explodeitem))
                                foreach ($explodeitem as $var2 => $val2) {
                                    $condition_string[] = "( $pt.user_fname like '%" . $val2 . "%' or $pt.user_lname like '%" . $val2 . "%' or $pt.user_mname like '%" . $val2 . "%' )";
                                }
                        }
                    } else {
                        $condition = array_merge($condition, array($var . " like" => "%" . $val . "%"));
                    }
                }
            }
        }

        /* Query Process */
        $list_count = $users_model->getList($condition, $condition_string, $sort_data);
        $list = $users_model->getListLimit($condition, $condition_string, $sort_data, $page, $display);
        return self::_generate_data($list_count, $list, $page, $display, $num_button);
    }

    /*
     * List For User Type
     */

    function _user_type_list($search, $page, $sort, $display, $num_button, $fixcondition = array()) {
        $this->load->model('admin/user_types_model');
        $user_types_model = new user_types_model();
        /* Default Order */
        $sort_data = array('user_type' => 'ASC');
        if (!empty($sort)) {
            $sort_data = array($sort['sort_by'] => $sort['sort_type']);
        }

        /* Where Condition */
        $condition_string = array();
        $condition = array();

        if (!empty($fixcondition)) {
            $condition = array_merge($condition, $fixcondition);
        }

        /* Search Condition */
        if (!empty($search)) {
            foreach ($search as $var => $val) {
                if ($val != '') {
                    if ($var == 'id_user_type') {
                        $condition = array_merge($condition, array($var => $val));
                    } else if ($var == 'add_user' or $var == 'edit_user') { /* User Name Search */
                        if ($var == 'add_user')
                            $pt = 'au';
                        if ($var == 'edit_user')
                            $pt = 'uu';
                        if (!empty($pt)) {
                            $explodeitem = explode(" ", $val);
                            if (!empty($explodeitem))
                                foreach ($explodeitem as $var2 => $val2) {
                                    $condition_string[] = "( $pt.user_fname like '%" . $val2 . "%' or $pt.user_lname like '%" . $val2 . "%' or $pt.user_mname like '%" . $val2 . "%' )";
                                }
                        }
                    } else {
                        $condition = array_merge($condition, array($var . " like" => "%" . $val . "%"));
                    }
                }
            }
        }

        /* Query Process */
        $list_count = $user_types_model->getList($condition, $condition_string, $sort_data);
        $list = $user_types_model->getListLimit($condition, $condition_string, $sort_data, $page, $display);
        return self::_generate_data($list_count, $list, $page, $display, $num_button);
    }

    /*
     * Get List
     */

    function _get_list($search, $page, $sort, $display, $num_button, $fixcondition = array(), $condition_string = array(), $contents) {
        $this->load->model($contents['model_directory']);
        $model = new $contents['model_name']('','');
        
        /* Default Order */
        $sort_data = array();
        foreach ($contents['filters'] as $column_name => $val) {
            $sort_data = array($column_name => 'ASC');
        }
        if (!empty($sort)) {
            $sort_data = array($sort['sort_by'] => $sort['sort_type']);
        }

        /* Where Condition */
        $condition = array();

        if (!empty($fixcondition)) {
            $condition = array_merge($condition, $fixcondition);
        }

        /* If with Condition */
        if (!empty($search['condition'])) {
            $condition = array_merge($condition, $search['condition']);
        }

        /* Query Process */
        $list_count = $model->getList($condition, $condition_string, $sort_data);
        $list = $model->getListLimit($condition, $condition_string, $sort_data, $page, $display);
        return self::_generate_data($list_count, $list, $page, $display, $num_button);
    }

}
