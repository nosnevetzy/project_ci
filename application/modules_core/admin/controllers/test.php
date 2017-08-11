<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Test extends System_Core {

    public $users_model = '';
    public $user_types_model = '';
    public $classes_model = '';
    public $class_functions_model = '';
    public $user_accesses_model = '';

    function __construct() {
        $this->classname = strtolower(get_class());
        $this->pagename = $this->uri->rsegment(2);
        $this->methodname = $this->uri->rsegment(3);
        parent:: __construct();
        $this->load->model('admin/users_model');
        $this->load->model('admin/user_types_model');
        $this->load->model('admin/classes_model');
        $this->load->model('admin/class_functions_model');
        $this->load->model('admin/user_accesses_model');
        $this->load->model('admin/departments_model');

        $this->users_model = new users_model();
        $this->user_types_model = new user_types_model();
        $this->classes_model = new classes_model();
        $this->class_functions_model = new class_functions_model();
        $this->user_accesses_model = new user_accesses_model();
        $this->departments_model = new Departments_Model();

        $this->contents = array('model_directory' => 'admin/users_model',
            'model_name' => 'users_model',
            'filters' => array(),
            'functionName' => 'user_page',); // use to call functions for access
    }

    function index() {
        redirect(admin_dir('user/list_user_page'));
    }

    /* ------------------------------------------------------------------------------------------------------------------------------------------- */
    /* ------------------------------- Page Function --------------------------------------------------------------------------------------------- */
    /* ------------------------------------------------------------------------------------------------------------------------------------------- */

    function list_usertype_page() {
        $data = array(
            'template' => parent::main_template()
        );
        $this->load->view(admin_dir('user/list_usertype_page'), $data);
    }

    function test_link1() {

        $id_user = $this->my_session->get('admin', 'user_id');
        $result = $this->users_model->getFields($id_user);
        if ($result) {
            $data = array(
                'template' => parent::main_template(),
                'result' => $result
            );
           
            $this->load->view(admin_dir('test/view_profile_page'), $data);
        } else {
            redirect(admin_dir('profile/view_pagenotfound_page'));
        }
    }

    function test_link2() {

        $data = array(
            'template' => parent::main_template()
        );
       
        $this->load->view(admin_dir('test/list_user_page'), $data);
    }

    function add_user_page() {
        $data = array(
            'template' => parent::main_template(),
            'user_types' => $this->user_types_model->getSearch("", "", array("ut.user_type" => "ASC"), true),
            'departments' => $this->departments_model->getSearch("", "", array("d.department_name" => "ASC"), true)
        );
        $this->load->view(admin_dir('user/add_user_page'), $data);
    }

    function edit_user_page() {
        $id_user = $this->Misc->decode_id($this->uri->rsegment(3));

        /* Check User if Exist */
        $row = $this->users_model->getFields($id_user);
        if ($row) {
            $data = array(
                'template' => parent::main_template(),
                'row' => $row,
                'user_types' => $this->user_types_model->getSearch("", "", array("ut.user_type" => "ASC"), true),
                'departments' => $this->departments_model->getSearch("", "", array("d.department_name" => "ASC"), true)
            );
            $this->load->view(admin_dir('user/edit_user_page'), $data);
        } else {
            redirect(admin_dir('profile/view_pagenotfound_page'));
        }
    }

    function asd() {

        /* Check User if Exist */
        $row = $this->users_model->getFields(1);
        if ($row) {
            $data = array(
                'template' => parent::main_template(),
                'row' => $row,
                'user_types' => $this->user_types_model->getSearch("", "", array("ut.user_type" => "ASC"), true),
                'departments' => $this->departments_model->getSearch("", "", array("d.department_name" => "ASC"), true)
            );
            $this->load->view(admin_dir('user/view_user_page'), $data);
        } else {
            redirect(admin_dir('profile/view_pagenotfound_page'));
        }
    }

    function access_user_page() {
        $data = array(
            'template' => parent::main_template(),
            'user_types' => $this->user_types_model->getSearch(array('ut.id_user_type !=' => 1), "", array("ut.user_type" => "ASC"), true),
            'classes' => $this->classes_model->getSearch("", "", array("c.class_name" => "ASC"), true)
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
        if ($this->uri->rsegment(3) == 'list_usertype') { /* Method for User Type */
            self::_method_list_usertype();
        } else if ($this->uri->rsegment(3) == 'add_usertype') {
            self::_method_add_usertype();
        } else if ($this->uri->rsegment(3) == 'edit_usertype') {
            self::_method_edit_usertype();
        } else if ($this->uri->rsegment(3) == 'delete_usertype') {
            self::_method_delete_usertype();
        } else if ($this->uri->rsegment(3) == 'list_user') { /* Method for User */
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
                $this->user_accesses_model->update_table($datas, "id_user_access", $row->id_user_access);
                parent::save_log("change " . $row->user_type . " user access " . $row->class_function_title . " $status", 'user_accesses', $row->id_user_access);
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
                parent::save_log("change $user_type user access $class_function_title active", 'user_accesses', $id_user_access);
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
                    'classes' => $this->classes_model->getSearch($class, "", array("c.class_title" => "ASC"), true),
                    'user_accesses' => $this->Misc->query_to_arr($this->user_accesses_model->getSearch(array("ut.id_user_type" => $id_user_type, "user_access_status" => 1), '', '', true), 'id_class_function'),
                    'id_user_type' => $id_user_type
                );
                $this->load->view(admin_dir('user/method/list_classfunction'), $data);
            }
        }
    }

    /* -------------------------------USER----------------------------------------------------------------------------------------------- */


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
                $this->users_model->update_table($datas, "id_user", $id_user);
                parent::save_log("delete user " . $this->Misc->display_name($row->user_fname, $row->user_mname, $row->user_lname), 'users', $id_user);
                $arr = array(
                    'message_alert' => $this->Misc->message_status('success', 'Deleted'),
                    'id' => 1
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
                $this->form_validation->set_rules('address', 'Address', 'htmlspecialchars|trim');
                $this->form_validation->set_rules('contact', 'Contact No', 'htmlspecialchars|trim');
                $this->form_validation->set_rules('usertype', 'User Type', 'htmlspecialchars|trim|required');
                $this->form_validation->set_rules('email', 'Email', 'htmlspecialchars|trim|valid_email');
                $this->form_validation->set_rules('password', 'Password', 'htmlspecialchars|trim');
                $this->form_validation->set_rules('department', 'Department', 'htmlspecialchars|trim');

                if ($this->form_validation->run() == FALSE) {
                    $error = $this->Misc->oneline_string(validation_errors());
                    $arr = array(
                        'message_alert' => $this->Misc->message_status("error", $error),
                        'id' => 0
                    );
                } else {
                    /* Check User Exist */
                    if (!empty($_POST['email']))
                        $count = $this->users_model->getSearch(array("u.id_user !=" => $id_user, "u.user_email like" => $_POST['email']), "", "", "", true);
                    else
                        $count = 0;

                    if ($count == 0) {
                        $datas = array(
                            'user_fname' => $_POST['fname'],
                            'user_lname' => $_POST['lname'],
                            'user_mname' => $_POST['mname'],
                            'user_address' => $_POST['address'],
                            'user_contact' => $_POST['contact'],
                            'user_type_id' => $_POST['usertype'],
                            'user_email' => $_POST['email'],
                            'department_id' => $_POST['department'],
                            'updated_by' => $this->my_session->get('admin', 'user_id'),
                            'updated_date' => date('Y-m-d H:i:s')
                        );

                        if (!empty($_POST['password']))
                            $datas['user_password'] = md5($_POST['password']);

                        /* Update User Info */
                        $this->users_model->update_table($datas, "id_user", $id_user);
                        parent::save_log("update work contract " . $this->Misc->update_name_log($this->Misc->display_name($row->user_fname, $row->user_mname, $row->user_lname), $this->Misc->display_name($_POST['fname'], $_POST['mname'], $_POST['lname'])), 'users', $id_user);
                        $arr = array(
                            'message_alert' => $this->Misc->message_status('success', 'Successfully saved'),
                            'id' => $id_user
                        );
                    }else {
                        $arr = array(
                            'message_alert' => $this->Misc->message_status('error', "Email already exist"),
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
            $this->form_validation->set_rules('address', 'Address', 'htmlspecialchars|trim');
            $this->form_validation->set_rules('contact', 'Contact No', 'htmlspecialchars|trim');
            $this->form_validation->set_rules('usertype', 'User Type', 'htmlspecialchars|trim|required');
            $this->form_validation->set_rules('email', 'Email', 'htmlspecialchars|trim|valid_email');
            $this->form_validation->set_rules('password', 'Password', 'htmlspecialchars|trim|required');
            $this->form_validation->set_rules('department', 'Department', 'htmlspecialchars|trim');

            if ($this->form_validation->run() == FALSE) {
                $error = $this->Misc->oneline_string(validation_errors());
                $arr = array(
                    'message_alert' => $this->Misc->message_status("error", $error),
                    'id' => 0
                );
            } else {
                if (!empty($_POST['email']))
                    $count = $this->users_model->getSearch("u.user_code like '" . $_POST['code'] . "' OR u.user_email like '" . $_POST['email'] . "'", "", "", "", true);
                else
                    $count = $this->users_model->getSearch("u.user_code like '" . $_POST['code'] . "'", "", "", "", true);

                if ($count == 0) {
                    $datas = array(
                        'user_code' => $_POST['code'],
                        'user_fname' => $_POST['fname'],
                        'user_lname' => $_POST['lname'],
                        'user_mname' => $_POST['mname'],
                        'user_address' => $_POST['address'],
                        'user_contact' => $_POST['contact'],
                        'user_type_id' => $_POST['usertype'],
                        'user_email' => $_POST['email'],
                        'department_id' => $_POST['department'],
                        'user_password' => md5($_POST['password']),
                        'user_picture' => "profile.jpg",
                        'user_state' => 1,
                        'enabled' => 1,
                        'added_by' => $this->my_session->get('admin', 'user_id'),
                        'added_date' => date('Y-m-d H:i:s'),
                    );
                    $id_user = $this->users_model->insert_table($datas);
                    parent::save_log("add new user " . $this->Misc->display_name($_POST['fname'], $_POST['mname'], $_POST['lname']), 'users', $id_user);
                    $path = parent::upload_user_path($id_user);
                    copy(avatars_dir('profile.jpg'), $path['profile'] . "profile.jpg");
                    copy(avatars_dir('profile.jpg'), $path['profile_thumb'] . "profile.jpg");

                    $arr = array(
                        'message_alert' => $this->Misc->message_status('success', 'Successfully saved'),
                        'id' => $id_user
                    );
                } else {
                    $arr = array(
                        'message_alert' => $this->Misc->message_status("error", "Code or Email already exist. "),
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
        if (IS_AJAX) {
            $datas = array(
                'search' => $_POST['search'],
                'page' => $_POST['page'],
                'sort' => $_POST['sort'],
                'display' => $_POST['display'],
                'num_button' => 5
            );
            /* Get User List */
            $data = modules::run(admin_dir('lists/_request_data'), '_user_list', $datas);
            $data['search'] = $_POST['search'];
            $data['sort'] = $_POST['sort'];
            $this->load->view(admin_dir('lists/user/user'), $data);
        }
    }

    /* -------------------------------USER TYPE--------------------------------------------------------------------------------------- */

    /*
     * 	Delete User Type Method
     */

    function _method_delete_usertype() {
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
                $this->user_types_model->update_table($datas, "id_user_type", $id_user_type);
                parent::save_log("delete user type " . $row->user_type, 'user_types', $id_user_type);
                $arr = array(
                    'message_alert' => $this->Misc->message_status('success', 'Deleted'),
                    'id' => 1
                );
                $this->load->view(admin_dir('template/print'), array('print' => json_encode($arr)));
            }
        }
    }

    /*
     * 	Edit User Type Method
     */

    function _method_edit_usertype() {
        if (IS_AJAX) {
            $id_user_type = $this->Misc->decode_id($_POST['id']);
            /* Check User Type if Exist */
            $row = $this->user_types_model->getFields($id_user_type);
            if ($row) {
                $this->form_validation->set_rules('name', 'Name', 'htmlspecialchars|trim|required');
                $this->form_validation->set_rules('code', 'Code', 'htmlspecialchars|trim|required');
                if ($this->form_validation->run() == FALSE) {
                    $error = $this->Misc->oneline_string(validation_errors());
                    $arr = array(
                        'message_alert' => $this->Misc->message_status("error", $error),
                        'id' => 0
                    );
                } else {
                    /* Check User Type Exist */
                    $count = $this->user_types_model->getSearch(array("ut.id_user_type !=" => $id_user_type, "ut.user_type like" => $_POST['name']), "", "", "", true);
                    if ($count == 0) {
                        $datas = array(
                            'user_type' => $_POST['name'],
                            'updated_by' => $this->my_session->get('admin', 'user_id'),
                            'updated_date' => date('Y-m-d H:i:s')
                        );
                        /* Update User Type Info */
                        $this->user_types_model->update_table($datas, "id_user_type", $id_user_type);
                        parent::save_log("update user type " . $this->Misc->update_name_log($row->user_type, $_POST['name']), 'user_types', $id_user_type);
                        $arr = array(
                            'message_alert' => $this->Misc->message_status('success', 'Successfully saved'),
                            'id' => $id_user_type
                        );
                    } else {
                        $arr = array(
                            'message_alert' => $this->Misc->message_status('error', "Code already exist"),
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

    function _method_add_usertype() {
        if (IS_AJAX) {
            $this->form_validation->set_rules('name', 'Name', 'htmlspecialchars|trim|required');
            $this->form_validation->set_rules('code', 'Code', 'htmlspecialchars|trim|required');

            if ($this->form_validation->run() == FALSE) {
                $error = $this->Misc->oneline_string(validation_errors());
                $arr = array(
                    'message_alert' => $this->Misc->message_status("error", $error),
                    'id' => 0
                );
            } else {
                /* Check User Type Code Name Exist */
                $count = $this->user_types_model->getSearch(array("ut.user_type like" => $_POST['name']), "", "", "", true);
                if ($count == 0) {
                    $datas = array(
                        'user_type' => $_POST['name'],
                        'enabled' => 1,
                        'added_by' => $this->my_session->get('admin', 'user_id'),
                        'added_date' => date('Y-m-d H:i:s')
                    );
                    /* Add New Class */
                    $id_user_type = $this->user_types_model->insert_table($datas);
                    parent::save_log("add new user type " . $_POST['name'], 'user_types', $id_user_type);
                    $arr = array(
                        'message_alert' => $this->Misc->message_status('success', 'Successfully saved'),
                        'id' => $id_user_type
                    );
                } else {
                    $arr = array(
                        'message_alert' => $this->Misc->message_status("error", "Code already exist"),
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

    function _method_list_usertype() {
        if (IS_AJAX) {
            $datas = array(
                'search' => $_POST['search'],
                'page' => $_POST['page'],
                'sort' => $_POST['sort'],
                'display' => $_POST['display'],
                'num_button' => 5
            );
            /* Get User Type List */
            $data = modules::run(admin_dir('lists/_request_data'), '_user_type_list', $datas);
            $data['search'] = $_POST['search'];
            $data['sort'] = $_POST['sort'];
            $this->load->view(admin_dir('lists/user/user_type'), $data);
        }
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
