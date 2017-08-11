<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User extends System_Core {

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
        $this->load->model('admin/classes_model');
        $this->load->model('admin/class_functions_model');
        //set list contents
    }

    function index() {
        redirect(admin_dir('user/list_user_page'));
    }

    /* ----------------------------------------------------------------------------- */
    /* ------------------------------- Page Function ------------------------------- */
    /* ----------------------------------------------------------------------------- */

    function list_user() {
        $data = array(
            'template' => parent::main_template(),
            'css_files' => $this->config->item('css_for_tables'),
            'js_files' => $this->config->item('js_for_tables'),
        );
        $this->load->view(admin_dir('user/list_user'), $data);
    }

    function add_user() {
        $data = array(
            'template' => parent::main_template(),
            'css_files' => $this->config->item('css_for_validation'),
            'js_files' => $this->config->item('js_for_validation'),
            'user_types' => $this->user_types_model->getSearch("", "", array("user_type" => "ASC"), true),
            'departments' => $this->departments_model->getSearch("", "", array("department_name" => "ASC"), true),
        );
        $this->load->view(admin_dir('user/add_user'), $data);
    }

    function edit_user() {
        $id_user = $this->Misc->decode_id($this->uri->rsegment(3));

        /* Check User if Exist */
        $row = $this->users_model->getFields($id_user);
        if ($row) {
            $data = array(
                'template' => parent::main_template(),
                'css_files' => $this->config->item('css_for_validation'),
                'js_files' => $this->config->item('js_for_validation'),
                'row' => $row,
                'user_types' => $this->user_types_model->getSearch("", "", array("user_type" => "ASC"), true),
                'departments' => $this->departments_model->getSearch("", "", array("department_name" => "ASC"), true),
            );
            $this->load->view(admin_dir('user/edit_user'), $data);
        } else {
            redirect(admin_dir('profile/view_pagenotfound_page'));
        }
    }

    function view_user() {
        $id_user = $this->Misc->decode_id($this->uri->rsegment(3));

        /* Check User if Exist */
        $row = $this->users_model->getFields($id_user);
        if ($row) {
            $data = array(
                'template' => parent::main_template(),
                'row' => $row,
                'user_types' => $this->user_types_model->getSearch("", "", array("user_type" => "ASC"), true),
                'departments' => $this->departments_model->getSearch("", "", array("department_name" => "ASC"), true),
            );
            $this->load->view(admin_dir('user/view_user'), $data);
        } else {
            redirect(admin_dir('profile/view_pagenotfound_page'));
        }
    }

    function user_access() {
        $data = array(
            'template' => parent::main_template(),
            'user_types' => $this->user_types_model->getSearch(array('id_user_type !=' => 1), "", array("user_type" => "ASC"), true),
            'classes' => $this->classes_model->getSearch("", "", array("class_name" => "ASC"), true)
        );

        $this->load->view(admin_dir('user/access_user_page'), $data);
    }

    /* ------------------------------------------------------------------------------- */
    /* ------------------------------- Method Function ------------------------------- */
    /* ------------------------------------------------------------------------------- */

    function method() {
        if ($this->uri->rsegment(3) == 'list_user') { /* Method for User */
            self::_method_list_user();
        } else if ($this->uri->rsegment(3) == 'add_user') {
            self::_method_add_user();
        } else if ($this->uri->rsegment(3) == 'edit_user') {
            self::_method_edit_user();
        } else if ($this->uri->rsegment(3) == 'delete_user') {
            self::_method_delete_user();
        } else if ($this->uri->rsegment(3) == 'list_classfunction') { /*  Method for User Access */
            self::_method_list_classfunction();
        } else if ($this->uri->rsegment(3) == 'change_access') {
            self::_method_change_access();
        }
    }

    /* ----------------------------------------------------------------------------------------USER ACCESS---------------------------------------------------------------------------------------- */

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

    /* -----------------------------------------------------------------------------------------------USER----------------------------------------------------------------------------------------------- */


    /*
     * 	Delete User Method
     */

    function _method_delete_user() {
        if (IS_AJAX) {
            $id_user = $this->Misc->decode_id($_POST['item']);
            /* Check User if Exist */
            $row = $this->users_model->getFields($id_user);
            if ($row) {
                $datas = array(
                    'enabled' => 0,
                    'updated_by' => $this->my_session->get('admin', 'user_id'),
                    'updated_date' => date('Y-m-d H:i:s')
                );
                /* Delete User */
                $this->users_model->update_table($datas, array("id_user" => $id_user));
                parent::save_log($id_user, "deleted user " . $this->Misc->display_name($row->user_fname, $row->user_mname, $row->user_lname));
                $arr = array(
                    'message_alert' => "User $row->user_code Deleted ",
                    'redirect' => $_POST['redirect'],
                    'status' => "success",
                    'id' => $id_user
                );
                $this->load->view(admin_dir('template/print'), array('print' => json_encode($arr)));
            }
        }
    }

    /*
     * 	Edit User Method
     */

    function _method_edit_user() {
        if (IS_AJAX) {
            $id_user = $this->Misc->decode_id($_POST['id']);
            /* Check User if Exist */
            $row = $this->users_model->getFields($id_user);
            if ($row) {
                $this->form_validation->set_rules('fname', 'First Name', 'htmlspecialchars|trim|required');
                $this->form_validation->set_rules('mname', 'Middle Name', 'htmlspecialchars|trim|required');
                $this->form_validation->set_rules('lname', 'Last Name', 'htmlspecialchars|trim|required');
                $this->form_validation->set_rules('street', 'Street', 'htmlspecialchars|trim');
                $this->form_validation->set_rules('city', 'City', 'htmlspecialchars|trim');
                $this->form_validation->set_rules('province', 'Province', 'htmlspecialchars|trim');
                $this->form_validation->set_rules('country', 'Country', 'htmlspecialchars|trim');
                $this->form_validation->set_rules('contact', 'Contact No', 'htmlspecialchars|trim');
                $this->form_validation->set_rules('usertype[]', 'User Type', 'htmlspecialchars|trim|required');
                $this->form_validation->set_rules('email', 'Email', 'htmlspecialchars|trim|valid_email');
                $this->form_validation->set_rules('password', 'Password', 'htmlspecialchars|trim');
                $this->form_validation->set_rules('department', 'Department', 'htmlspecialchars|trim');

                if ($this->form_validation->run() == FALSE) {
                    $arr = array(
                        'message_alert' => validation_errors(),
                        'redirect' => $_POST['redirect'],
                        'status' => "error",
                        'id' => 0
                    );
                } else {
                    /* Check User Exist */
                    if (!empty($_POST['email'])) {
                        $user = $this->users_model->getSearch(array("user_email like" => $_POST['email']), "", "", "", "", true);
                        if ($user->id_user == $id_user) {
                            $count = 0;
                        } else {
                            $count = 1;
                        }
                    } else {
                        $count = 0;
                    }

                    if ($count == 0) {
                        $datas = array(
                            'user_type_id' => $_POST['usertype'],
                            'user_fname' => $_POST['fname'],
                            'user_lname' => $_POST['lname'],
                            'user_mname' => $_POST['mname'],
                            'user_street' => $_POST['street'],
                            'user_city' => $_POST['city'],
                            'user_province' => $_POST['province'],
                            'user_country' => $_POST['country'],
                            'user_contact' => $_POST['contact'],
                            'user_email' => $_POST['email'],
                            'department_id' => $_POST['department'],
                            'updated_by' => $this->my_session->get('admin', 'user_id'),
                            'updated_date' => date('Y-m-d H:i:s')
                        );

                        if (!empty($_POST['password']))
                            $datas['user_password'] = sha1($_POST['password']);

                        /* Update User Info */
                        $this->users_model->update_table($datas, array("id_user" => $id_user));


                        parent::save_log($id_user, "updated user " . $this->Misc->update_name_log($this->Misc->display_name($row->user_fname, $row->user_mname, $row->user_lname), $this->Misc->display_name($_POST['fname'], $_POST['mname'], $_POST['lname'])));
                        $arr = array(
                            'message_alert' => "Successfully updated user.",
                            'redirect' => $_POST['redirect'],
                            'status' => "success",
                            'id' => $id_user
                        );
                    }else {
                        $arr = array(
                            'message_alert' => "Email already exists.",
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
     * 	Add New User Method
     */

    function _method_add_user() {
        if (IS_AJAX) {
            $this->form_validation->set_rules('code', 'ID No.', 'htmlspecialchars|trim|required');
            $this->form_validation->set_rules('fname', 'First Name', 'htmlspecialchars|trim|required');
            $this->form_validation->set_rules('mname', 'Middle Name', 'htmlspecialchars|trim|required');
            $this->form_validation->set_rules('lname', 'Last Name', 'htmlspecialchars|trim|required');
            $this->form_validation->set_rules('street', 'Street', 'htmlspecialchars|trim');
            $this->form_validation->set_rules('city', 'City', 'htmlspecialchars|trim');
            $this->form_validation->set_rules('province', 'Province', 'htmlspecialchars|trim');
            $this->form_validation->set_rules('country', 'Country', 'htmlspecialchars|trim');
            $this->form_validation->set_rules('contact', 'Contact No', 'htmlspecialchars|trim');
            $this->form_validation->set_rules('usertype[]', 'User Type', 'htmlspecialchars|trim|required');
            $this->form_validation->set_rules('email', 'Email', 'htmlspecialchars|trim|valid_email');
            $this->form_validation->set_rules('password', 'Password', 'htmlspecialchars|trim|required');
            $this->form_validation->set_rules('department', 'Department', 'htmlspecialchars|trim');
            if ($this->form_validation->run() == FALSE) {
                $arr = array(
                    'message_alert' => validation_errors(),
                    'redirect' => $_POST['redirect'],
                    'status' => "error",
                    'id' => 0
                );
            } else {

                if (!empty($_POST['email']))
                    $count = $this->users_model->getSearch("user_code like '" . $_POST['code'] . "' OR user_email like '" . $_POST['email'] . "'", "", "", "", true);
                else
                    $count = $this->users_model->getSearch("user_code like '" . $_POST['code'] . "'", "", "", "", true);

                if ($count == 0) {
                    $datas = array(
                        'user_type_id' => $_POST['usertype'],
                        'user_code' => $_POST['code'],
                        'user_fname' => $_POST['fname'],
                        'user_lname' => $_POST['lname'],
                        'user_mname' => $_POST['mname'],
                        'user_street' => $_POST['street'],
                        'user_city' => $_POST['city'],
                        'user_province' => $_POST['province'],
                        'user_country' => $_POST['country'],
                        'user_contact' => $_POST['contact'],
                        'user_email' => $_POST['email'],
                        'department_id' => $_POST['department'],
                        'user_password' => sha1($_POST['password']),
                        'user_picture' => "profile.jpg",
                        'enabled' => 1,
                        'added_by' => $this->my_session->get('admin', 'user_id'),
                        'added_date' => date('Y-m-d H:i:s'),
                    );
                    $id_user = $this->users_model->insert_table($datas);

                    parent::save_log($id_user, "added new user " . $this->Misc->display_name($_POST['fname'], $_POST['mname'], $_POST['lname']));

                    $arr = array(
                        'message_alert' => "Successfully saved user " . $_POST['code'],
                        'redirect' => $_POST['redirect'],
                        'status' => "success",
                        'id' => $id_user
                    );
                } else {
                    $arr = array(
                        'message_alert' => "Code or Email already exists.",
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
     * 	List User
     */

    function _method_list_user() {
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
                'var-value' => 'id_user',
            ),
            'user_code' => array(
                'label' => 'Code',
                'type' => 'text',
                'type-class' => 'col-lg-12 uniform-input',
                'class' => 'col-lg-2',
                'var-value' => 'user_code',
            ),
            'user_name' => array(
                'label' => 'Name',
                'type' => 'text',
                'type-class' => 'col-lg-12 uniform-input',
                'class' => 'col-lg-2',
                'var-value' => 'user_name',
            ),
            'user_type' => array(
                'label' => 'User Type',
                'type' => 'text',
                'type-class' => 'col-lg-12 uniform-input',
                'class' => 'col-lg-2',
                'var-value' => 'user_type',
            ),
            'department_name' => array(
                'label' => 'Department',
                'type' => 'text',
                'type-class' => 'col-lg-12 uniform-input',
                'class' => 'col-lg-2',
                'var-value' => 'department_name',
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
            switch ($sort_by) {
                case 'user_name':
                    $sort_by = 'user_mname';
                    break;
                default:
                    # code...
                    break;
            }
            $sort_data = array_merge($sort_data, array($sort_by => $sort_type));
        }

        //set condition for the list
        $condition = array();
        $string_condition = array();


        if (!empty($this->tools->getPost('search'))) {
            foreach ($this->tools->getPost('search') as $var => $val) {
                if ($val != '') {
                    if ($var == 'id_user') {
                        $condition = array_merge($condition, array($var => $val));
                    } else if ($var == 'user_name') {
                        $condition = array_merge($condition, array("`user_fname` LIKE '%$val%' OR `user_mname` LIKE '%$val%' OR user_lname LIKE '%$val%'" => NULL));
                    } else if ($var == 'user_type') {
                        $condition = array_merge($condition, array("`user_type` LIKE '%$val%'" => NULL));
                    } else {
                        $condition = array_merge($condition, array($var . " like" => "%$val%"));
                    }
                }
            }
        }

        $data['list_count'] = $this->users_model->getList($condition, $string_condition, $sort_data)->num_rows();

        $data['list'] = $this->users_model->getListLimit($condition, $string_condition, $sort_data, $this->page, $this->display);

        foreach ($data['list']->result() as $q) {
            $q->user_name = "$q->user_fname $q->user_lname";
        }

        $datas = array('page' => $this->page,
            'display' => $this->display,
            'num_button' => $this->num_button,
            'list_count' => $data['list_count'],
            'list' => $data['list'],
            'max_page' => ((ceil($data['list_count'] / $this->display)) <= 0) ? 1 : (ceil($data['list_count'] / $this->display)),
        );



        $details = array_merge($data, $this->Misc->get_pagination_data($datas)); //get pagination data
        $this->load->view(admin_dir('user/list/user_list'), $details);
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
