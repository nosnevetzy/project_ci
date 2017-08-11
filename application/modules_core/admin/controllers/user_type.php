<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User_Type extends System_Core {

    function __construct() {

        parent:: __construct();
        $this->classname = strtolower(get_class());
        $this->pagename = $this->uri->rsegment(2);
        $this->methodname = $this->uri->rsegment(3);
        $this->function_name = 'user'; // use to call functions for access
        $this->list_content = '';

        $this->load->model('admin/user_accesses_model');
        $this->load->model('admin/departments_model');
        $this->load->model('admin/users_model');
        $this->load->model('admin/user_types_model');


        $this->load->model('admin/default_model');
        $this->load->model('admin/class_functions_model');
        //set list contents
    }

    function index() {
        redirect(admin_dir('user/list_user_page'));
    }

    /* ------------------------------------------------------------------------------------------------------------------------------------------- */
    /* ------------------------------- Page Function --------------------------------------------------------------------------------------------- */
    /* ------------------------------------------------------------------------------------------------------------------------------------------- */

    function list_user_type() {
        $data = array(
            'template' => parent::main_template(),
            'css_files' => $this->config->item('css_for_tables'),
            'js_files' => $this->config->item('js_for_tables'),
        );
        $this->load->view(admin_dir('user_type/list_user_type'), $data);
    }

    function add_user_type() {
        $data = array(
            'css_files' => $this->config->item('css_for_validation'),
            'js_files' => $this->config->item('js_for_validation'),
            'template' => parent::main_template(),
        );
        $this->load->view(admin_dir('user_type/add_user_type'), $data);
    }

    function edit_user_type() {
        $id_user_type = $this->Misc->decode_id($this->uri->rsegment(3));

        /* Check User if Exist */
        $row = $this->user_types_model->getFields($id_user_type);
        if ($row) {
            $data = array(
                'css_files' => $this->config->item('css_for_validation'),
                'js_files' => $this->config->item('js_for_validation'),
                'template' => parent::main_template(),
                'row' => $row,
            );
            $this->load->view(admin_dir('user_type/edit_user_type'), $data);
        } else {
            redirect(admin_dir('profile/view_pagenotfound_page'));
        }
    }

    function view_user_type() {
        $id_user_type = $this->Misc->decode_id($this->uri->rsegment(3));

        /* Check User Type if Exist */
        $row = $this->user_types_model->getFields($id_user_type);
        if ($row) {
            $data = array(
                'template' => parent::main_template(),
                'row' => $row,
            );
            $this->load->view(admin_dir('user_type/view_user_type'), $data);
        } else {
            redirect(admin_dir('profile/view_pagenotfound_page'));
        }
    }

    function access_user_page() {
        $data = array(
            'template' => parent::main_template(),
            'user_types' => $this->user_types_model->getSearch(array('id_user_type !=' => 1), "", array("user_type" => "ASC"), true),
            'classes' => $this->classes_model->getSearch("", "", array("class_name" => "ASC"), true)
        );

        $this->load->view(admin_dir('user/access_user_page'), $data);
    }

    function get_users_select() {
        $department_id = $this->tools->getPost('department_id');
        /* Check Department if Exist */
        $row = $this->users_model->getList(array('department_id' => $department_id))->result();
        if ($row) {
            $data = array(
                'row' => $row,
            );
            $this->load->view(admin_dir('user/extra/get_users_select'), $data);
        } else {
            redirect(admin_dir('profile/view_pagenotfound_page'));
        }
    }

    /* --------------------------------------------------------------------------------------------------------------------------------------------- */
    /* ------------------------------- Method Function --------------------------------------------------------------------------------------------- */
    /* --------------------------------------------------------------------------------------------------------------------------------------------- */

    function method() {
        if ($this->uri->rsegment(3) == 'list_user_type') { /* Method for User Type */
            self::_method_list_user_type();
        } else if ($this->uri->rsegment(3) == 'add_user_type') {
            self::_method_add_user_type();
        } else if ($this->uri->rsegment(3) == 'edit_user_type') {
            self::_method_edit_user_type();
        } else if ($this->uri->rsegment(3) == 'delete_user_type') {
            self::_method_delete_user_type();
        }
    }

    /* -------------------------------USER ACCESS---------------------------------------------------------------------------------------- */

    /*
     * Change User Access 
     */

    function _method_change_access() {
        if (IS_AJAX) {
            $user_access_status = ($_POST['check'] == 'true') ? 1 : 0;
            $status = ($_POST['check'] == 'true') ? 'Active' : 'Not Active';
            $id_user_type = $_POST['usertype'];
            $id_class_function = $_POST['item'];
            $row = $this->user_accesses_model->getSearch(array("ut.id_user_type" => $id_user_type, "cf.id_class_function" => $id_class_function), "", "", "", "", true);
            if ($row) {
                $datas = array(
                    'user_access_status' => $user_access_status,
                    'user_type_id' => $id_user_type,
                    'class_function_id' => $id_class_function,
                    'updated_by' => $this->my_session->get('admin', 'user_id'),
                    'updated_date' => date('Y-m-d H:i:s')
                );
                $this->user_accesses_model->update_table($datas, array("id_user_access" => $row->id_user_access));
                parent::save_log($row->id_user_access, "changed " . $row->user_type . " user access " . $row->class_function_title . " $status");
            } else if ($id_user_type != 1) {
                $datas = array(
                    'user_access_status' => $user_access_status,
                    'enabled' => 1,
                    'user_type_id' => $id_user_type,
                    'class_function_id' => $id_class_function,
                    'added_by' => $this->my_session->get('admin', 'user_id'),
                    'added_date' => date('Y-m-d H:i:s')
                );
                $id_user_access = $this->user_accesses_model->insert_table($datas);
                $user_type = $this->user_types_model->getValue($id_user_type, "user_type");
                $class_function_title = $this->class_functions_model->getValue($id_class_function, "class_function_title");
                parent::save_log($id_user_access, "changed $user_type user access $class_function_title active");
            }
        }
    }

    /*
     * 	List Access Class and Function
     */

    function _method_list_classfunction() {
        if (IS_AJAX) {

            $id_user_type = $_POST['usertype'];
            /* Check User Type if Exist */
            $row = $this->user_types_model->getFields($id_user_type);

            if ($row) {
                $class = (!empty($_POST['class'])) ? array('c.id_class' => $_POST['class']) : array();
                $data = array(
                    'class_functions' => $this->class_functions_model->classes_data($class),
                    'classes' => $this->classes_model->getSearch($class, "", array("class_title" => "ASC"), true),
                    'user_accesses' => $this->Misc->query_to_arr($this->user_accesses_model->getSearch(array("ut.id_user_type" => $id_user_type, "user_access_status" => 1), '', '', true), 'id_class_function'),
                    'id_user_type' => $id_user_type
                );
                $this->load->view(admin_dir('user/method/list_classfunction'), $data);
            }
        }
    }

    /* -------------------------------USER TYPE--------------------------------------------------------------------------------------- */

    /*
     * 	Delete User Type Method
     */

    function _method_delete_user_type() {
        if (IS_AJAX) {
            $id_user_type = $this->Misc->decode_id($_POST['item']);
            /* Check User Type if Exist */
            $row = $this->user_types_model->getFields($id_user_type);
            if ($row) {
                $datas = array(
                    'enabled' => 0,
                    'updated_by' => $this->my_session->get('admin', 'user_id'),
                    'updated_date' => date('Y-m-d H:i:s')
                );
                /* Delete User Type */
                $this->user_types_model->update_table($datas, array("id_user_type" => $id_user_type));
                parent::save_log($id_user_type, "deleted user type " . $row->user_type);
                $arr = array(
                    'message_alert' => "Successfully Deleted $row->user_type User Type",
                    'redirect' => $_POST['redirect'],
                    'status' => "success",
                    'id' => $id_user_type
                );
                $this->load->view(admin_dir('template/print'), array('print' => json_encode($arr)));
            }
        }
    }

    /*
     * 	Edit User Type Method
     */

    function _method_edit_user_type() {
        if (IS_AJAX) {
            $id_user_type = $this->Misc->decode_id($_POST['id']);
            /* Check User Type if Exist */
            $row = $this->user_types_model->getFields($id_user_type);
            if ($row) {
                $this->form_validation->set_rules('code', 'User Type', 'htmlspecialchars|trim|required');
                if ($this->form_validation->run() == FALSE) {
                    $arr = array(
                        'message_alert' => validation_errors(),
                        'redirect' => $_POST['redirect'],
                        'status' => "error",
                        'id' => 0
                    );
                } else {
                    /* Check User Type Exist */
                    $count = $this->user_types_model->getSearch(array("id_user_type !=" => $id_user_type, "user_type like" => $_POST['code']), "", "", "", true);
                    if ($count == 0) {
                        $datas = array(
                            'user_type' => $_POST['code'],
                            'updated_by' => $this->my_session->get('admin', 'user_id'),
                            'updated_date' => date('Y-m-d H:i:s')
                        );
                        /* Update User Type Info */
                        $this->user_types_model->update_table($datas, array("id_user_type" => $id_user_type));
                        parent::save_log($id_user_type, "updated user type " . $this->Misc->update_name_log($row->user_type, $_POST['code']));
                        $arr = array(
                            'message_alert' => " Successfully Saved User Type " . $_POST['code'] . ".",
                            'redirect' => $_POST['redirect'],
                            'status' => "success",
                            'id' => $id_user_type
                        );
                    } else {
                        $arr = array(
                            'message_alert' => "User Type " . $_POST['code'] . " Already Exists",
                            'redirect' => $_POST['redirect'],
                            'status' => "error",
                            'id' => 0
                        );
                    }
                }
                $this->load->view(admin_dir('template/print'), array('print' => json_encode($arr)));
            }
        }
    }

    /*
     * 	Add New User Type Method
     */

    function _method_add_user_type() {
        if (IS_AJAX) {
            $this->form_validation->set_rules('code', 'User Type', 'htmlspecialchars|trim|required');

            if ($this->form_validation->run() == FALSE) {
                $arr = array(
                    'message_alert' => validation_errors(),
                    'redirect' => $_POST['redirect'],
                    'status' => "error",
                    'id' => 0
                );
            } else {
                /* Check User Type Code Name Exist */
                $count = $this->user_types_model->getSearch(array("user_type like" => $_POST['code']), "", "", "", true);
                if ($count == 0) {
                    $datas = array(
                        'user_type' => $_POST['code'],
                        'enabled' => 1,
                        'added_by' => $this->my_session->get('admin', 'user_id'),
                        'added_date' => date('Y-m-d H:i:s')
                    );
                    /* Add New Class */
                    $id_user_type = $this->user_types_model->insert_table($datas);
                    parent::save_log($id_user_type, "added new user type " . $_POST['code']);
                    $arr = array(
                        'message_alert' => "Successfully Saved User Type " . $_POST['code'],
                        'redirect' => $_POST['redirect'],
                        'status' => "success",
                        'id' => $id_user_type
                    );
                } else {
                    $arr = array(
                        'message_alert' => "User Type " . $_POST['code'] . " already exists",
                        'redirect' => $_POST['redirect'],
                        'status' => "error",
                        'id' => 0
                    );
                }
            }
            $this->load->view(admin_dir('template/print'), array('print' => json_encode($arr)));
        }
    }

    /*
     * 	List User Type
     */

    function _method_list_user_type() {

        if (!IS_AJAX) {
            // Set confirmation message
            $this->session->set_flashdata('error', 'Direct access forbidden');
            redirect(admin_url($this->classname));
        }

        $this->list_content = array(
            'id' => array(
                'label' => 'ID',
                'type' => 'hidden',
                'type-class' => 'col-lg-12 uniform-input',
                'class' => 'col-lg-1',
                'var-value' => 'id_user_type',
            ),
            'user_type' => array(
                'label' => 'User Type',
                'type' => 'text',
                'type-class' => 'col-lg-12 uniform-input',
                'class' => 'col-lg-2',
                'var-value' => 'user_type',
            ),
        );
        $data = array(
            'search' => $this->tools->getPost('search'),
            'sort' => $this->tools->getPost('sort'),
        );


        /* Default Order */
        $sort_data = array(); //default sorting
        if (!empty($this->tools->getPost('sort'))) {
            $sort_by = $this->tools->getPost('sort', 'sort_by');
            $sort_type = $this->tools->getPost('sort', 'sort_type');
            $sort_data = array_merge($sort_data, array($sort_by => $sort_type));
        }

        //set condition for the list
        $condition = array();
        $string_condition = array();
        if (!empty($this->tools->getPost('search'))) {
            foreach ($this->tools->getPost('search') as $var => $val) {
                if ($val != '') {
                    if ($var == 'id_user_type') {
                        $condition = array_merge($condition, array($var => $val));
                    } else {
                        $condition = array_merge($condition, array($var . " like" => "%$val%"));
                    }
                }
            }
        }

        $data['list_count'] = $this->user_types_model->getList($condition, $sort_data, $string_condition)->num_rows();
        $data['list'] = $this->user_types_model->getListLimit($condition, $sort_data, $string_condition, $this->page, $this->display);


        $datas = array('page' => $this->page,
            'display' => $this->display,
            'num_button' => $this->num_button,
            'list_count' => $data['list_count'],
            'list' => $data['list'],
            'max_page' => ((ceil($data['list_count'] / $this->display)) <= 0) ? 1 : (ceil($data['list_count'] / $this->display)),
        );
        //column customizaton


        $details = array_merge($data, $this->Misc->get_pagination_data($datas)); //get pagination data
        $this->load->view(admin_dir('user_type/list/user_type_list'), $details);
    }

    /* ----------------------------------------------------------------------------------------------------------------------------------------------- */
    /* ------------------------------- Additional Module --------------------------------------------------------------------------------------------- */
    /* ----------------------------------------------------------------------------------------------------------------------------------------------- */


    /*
     * Show User Type Popup Form
     */

    function popupform_usertype() {
        if (IS_AJAX) {
            $redirect = (!empty($_POST['redirect'])) ? $_POST['redirect'] : "";

            if ($_POST['type'] == 1) { /* Add Form */
                $this->load->view(admin_dir('user/extra/popupform_usertype'), array('add' => 1, 'redirect' => $redirect));
            } else if ($_POST['type'] == 2 and ! empty($_POST['item'])) { /* Edit Form */
                $id_user_type = $this->Misc->decode_id($_POST['item']);
                $row = $this->user_types_model->getFields($id_user_type);
                if ($row) {
                    $this->load->view(admin_dir('user/extra/popupform_usertype'), array('edit' => 1, 'row' => $row, 'redirect' => $redirect));
                }
            }
        }
    }

}
