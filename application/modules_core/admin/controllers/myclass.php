<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Myclass extends System_Core {

    public $class_functions_model = '';
    public $classes_model = '';

    function __construct() {
        $this->classname = strtolower(get_class());
        $this->pagename = $this->uri->rsegment(2);
        $this->methodname = $this->uri->rsegment(3);
        parent:: __construct();
        $this->load->model('admin/class_functions_model');
        $this->load->model('admin/classes_model');
        $this->class_functions_model = new class_functions_model();
        $this->classes_model = new classes_model();

        $this->contents = array('model_directory' => 'admin/class_functions_model',
            'model_name' => 'class_functions_model',
            'filters' => array(),
            'functionName' => 'Class'); // use to call functions for access
    }

    function index() {
        redirect('admin/myclass/list_class_page');
    }

    /* ------------------------------------------------------------------------------------------------------------------------------------------- */
    /* ------------------------------- Page Function --------------------------------------------------------------------------------------------- */
    /* ------------------------------------------------------------------------------------------------------------------------------------------- */

    function list_class_page() {
        $classes = self::_list_classes_data();

        $data = array(
            'template' => parent::main_template(),
            'css_files' => $this->config->item('css_for_tables'),
            'js_files' => $this->config->item('js_for_tables'),
            'classes' => $classes['classes'],
            'class_functions' => $classes['class_functions']
        );
        $this->load->view(admin_dir('myclass/list_class_page'), $data);
    }

    /* --------------------------------------------------------------------------------------------------------------------------------------------- */
    /* ------------------------------- Method Function --------------------------------------------------------------------------------------------- */
    /* --------------------------------------------------------------------------------------------------------------------------------------------- */

    function method() {
        if ($this->uri->rsegment(3) == 'add_class') {
            self::_method_add_class();
        } else if ($this->uri->rsegment(3) == 'edit_class') {
            self::_method_edit_class();
        } else if ($this->uri->rsegment(3) == 'delete_class') {
            self::_method_delete_class();
        } else if ($this->uri->rsegment(3) == 'add_function') {
            self::_method_add_function();
        } else if ($this->uri->rsegment(3) == 'edit_function') {
            self::_method_edit_function();
        } else if ($this->uri->rsegment(3) == 'delete_function') {
            self::_method_delete_function();
        }
    }

    /*
     * 	Delete Function Method
     */

    function _method_delete_function() {
        if (IS_AJAX) {
            $id_class_function = $this->Misc->decode_id($_POST['item']);
            /* Check Function if Exist */
            $row = $this->class_functions_model->getFields($id_class_function);
            if ($row) {
                $datas = array(
                    'enabled' => 0,
                    'updated_by' => $this->my_session->get('admin', 'user_id'),
                    'updated_date' => date('Y-m-d H:i:s')
                );
                /* Delete Function */
                $this->class_functions_model->update_table($datas, "id_class_function", $id_class_function);
                parent::save_log($id_class_function, "deleted class function " . $row->class_function_name);

                $arr = array(
                    'message_alert' => $this->Misc->message_status('success', 'Function Deleted'),
                    'id' => 1
                );
                $this->load->view(admin_dir('template/print'), array('print' => json_encode($arr)));
            }
        }
    }

    /*
     * 	Edit Function Method
     */

    function _method_edit_function() {
        if (IS_AJAX) {
            $id_class_function = $this->Misc->decode_id($_POST['id']);
            /* Check Function if Exist */
            $row = $this->class_functions_model->getFields($id_class_function);
            if ($row) {
                $this->form_validation->set_rules('type', 'Type', 'htmlspecialchars|trim|required');
                $this->form_validation->set_rules('title', 'Function Title', 'htmlspecialchars|trim|required');
                $this->form_validation->set_rules('name', 'Function Name', 'htmlspecialchars|trim|required');
                if ($this->form_validation->run() == FALSE) {
                    $error = $this->Misc->oneline_string(validation_errors());
                    $arr = array(
                        'message_alert' => $this->Misc->message_status("error", $error),
                        'id' => 0
                    );
                } else {
                    /* Check Class Name Exist */
                    $count = $this->class_functions_model->getSearch(array("cf.id_class_function !=" => $id_class_function, "c.id_class like" => $row->id_class, "class_function_name like" => $_POST['name']), "", "", "", true);
                    if ($count == 0) {
                        $datas = array(
                            'class_function_name' => $_POST['name'],
                            'class_function_title' => $_POST['title'],
                            'class_function_type' => $_POST['type'],
                            'updated_by' => $this->my_session->get('admin', 'user_id'),
                            'updated_date' => date('Y-m-d H:i:s')
                        );
                        /* Update Function Info */
                        $this->class_functions_model->update_table($datas, "id_class_function", $id_class_function);
                        parent::save_log($id_class_function, "updated class function " . $this->Misc->update_name_log($row->class_function_name, $_POST['name']));

                        $arr = array(
                            'message_alert' => $this->Misc->message_status('success', 'Successfully saved'),
                            'id' => 1
                        );
                    } else {
                        $arr = array(
                            'message_alert' => $this->Misc->message_status("error", "Function name already exist"),
                            'id' => 0
                        );
                    }
                }
                $this->load->view(admin_dir('template/print'), array('print' => json_encode($arr)));
            }
        }
    }

    /*
     * 	Add New Function Method
     */

    function _method_add_function() {
        if (IS_AJAX) {
            $this->form_validation->set_rules('class', 'Class', 'htmlspecialchars|trim|required');
            $this->form_validation->set_rules('type', 'Type', 'htmlspecialchars|trim|required');
            $this->form_validation->set_rules('title', 'Title', 'htmlspecialchars|trim|required');
            $this->form_validation->set_rules('name', 'Name', 'htmlspecialchars|trim|required');
            if ($this->form_validation->run() == FALSE) {
                $error = $this->Misc->oneline_string(validation_errors());
                $arr = array(
                    'message_alert' => $this->Misc->message_status("error", $error),
                    'id' => 0
                );
            } else {
                /* Check Function if Exist */
                $count = $this->class_functions_model->getSearch(array("c.id_class" => $_POST['class'], "cf.class_function_name like" => $_POST['name'], "class_function_type" => $_POST['type']), "", "", "", true);
                if ($count == 0) {
                    $datas = array(
                        'class_function_name' => $_POST['name'],
                        'class_function_title' => $_POST['title'],
                        'class_function_type' => $_POST['type'],
                        'class_id' => $_POST['class'],
                        'enabled' => 1,
                        'added_by' => $this->my_session->get('admin', 'user_id'),
                        'added_date' => date('Y-m-d H:i:s')
                    );
                    /* Add New Function */
                    $id_class_function = $this->class_functions_model->insert_table($datas);
                    parent::save_log($id_class_function, "added new class function " . $_POST['name']);
                    $arr = array(
                        'message_alert' => $this->Misc->message_status("success", "Successfully saved"),
                        'id' => $id_class_function
                    );
                } else {
                    $arr = array(
                        'message_alert' => $this->Misc->message_status('error', "Function name already exist"),
                        'id' => 0
                    );
                }
            }
            $this->load->view(admin_dir('template/print'), array('print' => json_encode($arr)));
        }
    }

    /*
     * 	Delete Class Method
     */

    function _method_delete_class() {
        if (IS_AJAX) {
            $id_class = $this->Misc->decode_id($_POST['item']);
            /* Check Class if Exist */
            $row = $this->classes_model->getFields($id_class);
            if ($row) {
                $datas = array(
                    'enabled' => 0,
                    'updated_by' => $this->my_session->get('admin', 'user_id'),
                    'updated_date' => date('Y-m-d H:i:s')
                );
                /* Delete Class */
                $this->classes_model->update_table($datas, "id_class", $id_class);

                $datas = array(
                    'enabled' => 0,
                    'updated_by' => $this->my_session->get('admin', 'user_id'),
                    'updated_date' => date('Y-m-d H:i:s')
                );
                /* Delete Class Function by Class */
                $this->class_functions_model->update_table($datas, "class_id", $id_class);
                parent::save_log($id_class, "deleted class " . $row->class_name);

                $arr = array(
                    'message_alert' => $this->Misc->message_status('success', 'Deleted'),
                    'id' => 1
                );
                $this->load->view(admin_dir('template/print'), array('print' => json_encode($arr)));
            }
        }
    }

    /*
     * 	Edit Class Method
     */

    function _method_edit_class() {
        if (IS_AJAX) {
            $id_class = $this->Misc->decode_id($_POST['id']);
            /* Check Class if Exist */
            $row = $this->classes_model->getFields($id_class);
            if ($row) {
                $this->form_validation->set_rules('title', 'Title', 'htmlspecialchars|trim|required');
                $this->form_validation->set_rules('name', 'Class Name', 'htmlspecialchars|trim|required');
                if ($this->form_validation->run() == FALSE) {
                    $error = $this->Misc->oneline_string(validation_errors());
                    $arr = array(
                        'message_alert' => $this->Misc->message_status("error", $error),
                        'id' => 0
                    );
                } else {
                    /* Check Class Name Exist */
                    $count = $this->classes_model->getSearch(array("c.id_class !=" => $id_class, "c.class_name like" => $_POST['name']), "", "", "", true);
                    if ($count == 0) {
                        $datas = array(
                            'class_name' => $_POST['name'],
                            'class_title' => $_POST['title'],
                            'updated_by' => $this->my_session->get('admin', 'user_id'),
                            'updated_date' => date('Y-m-d H:i:s')
                        );
                        /* Update Class Info */
                        $this->classes_model->update_table($datas, "id_class", $id_class);
                        parent::save_log($id_class, "updated class " . $this->Misc->update_name_log($row->class_name, $_POST['name']));
                        $arr = array(
                            'message_alert' => $this->Misc->message_status("success", "Successfully saved"),
                            'id' => 1
                        );
                    } else {
                        $arr = array(
                            'message_alert' => $this->Misc->message_status("error", "Class name already exist"),
                            'id' => 0
                        );
                    }
                }
                $this->load->view(admin_dir('template/print'), array('print' => json_encode($arr)));
            }
        }
    }

    /*
     * 	Add New Class Method
     */

    function _method_add_class() {
        if (IS_AJAX) {
            $this->form_validation->set_rules('title', 'Title', 'htmlspecialchars|trim|required');
            $this->form_validation->set_rules('name', 'Class Name', 'htmlspecialchars|trim|required');
            if ($this->form_validation->run() == FALSE) {
                $error = $this->Misc->oneline_string(validation_errors());
                $arr = array(
                    'message_alert' => $this->Misc->message_status("error", $error),
                    'id' => 0
                );
            } else {
                /* Check Class Name Exist */
                $count = $this->classes_model->getSearch(array("c.class_name like" => $_POST['name']), "", "", "", true);
                if ($count == 0) {
                    $datas = array(
                        'class_name' => $_POST['name'],
                        'class_title' => $_POST['title'],
                        'enabled' => 1,
                        'added_by' => $this->my_session->get('admin', 'user_id'),
                        'added_date' => date('Y-m-d H:i:s')
                    );
                    /* Add New Class */
                    $id_class = $this->classes_model->insert_table($datas);
                    parent::save_log($id_class, "added new class " . $_POST['name']);
                    $arr = array(
                        'message_alert' => $this->Misc->message_status('success', 'Successfully saved'),
                        'id' => $id_class
                    );
                } else {
                    $arr = array(
                        'message_alert' => $this->Misc->message_status("error", "Class name already exist"),
                        'id' => 0
                    );
                }
            }
            $this->load->view(admin_dir('template/print'), array('print' => json_encode($arr)));
        }
    }

    /* ----------------------------------------------------------------------------------------------------------------------------------------------- */
    /* ------------------------------- Additional Module --------------------------------------------------------------------------------------------- */
    /* ----------------------------------------------------------------------------------------------------------------------------------------------- */

    /*
     * Show Function Popup Form
     */

    function popupform_function() {
        if (IS_AJAX) {
            $redirect = (!empty($_POST['redirect'])) ? $_POST['redirect'] : "";
            $classes = $this->classes_model->getSearch("", "", array('class_title' => 'ASC'), true);
            if ($_POST['type'] == 1) { /* Add Form */
                $this->load->view(admin_dir('myclass/extra/popupform_function'), array('add' => 1, 'redirect' => $redirect, 'classes' => $classes));
            } else if ($_POST['type'] == 2 and ! empty($_POST['item'])) { /* Edit Form */
                $id_class_function = $this->Misc->decode_id($_POST['item']);
                $row = $this->class_functions_model->getFields($id_class_function);
                if ($row) {
                    $this->load->view(admin_dir('myclass/extra/popupform_function'), array('edit' => 1, 'row' => $row, 'redirect' => $redirect, 'classes' => $classes));
                }
            }
        }
    }

    /*
     * Show Class Popup Form
     */

    function popupform_class() {
        if (IS_AJAX) {
            $redirect = (!empty($_POST['redirect'])) ? $_POST['redirect'] : "";
            if ($_POST['type'] == 1) { /* Add Form */
                $this->load->view(admin_dir('myclass/extra/popupform_class'), array('add' => 1, 'redirect' => $redirect));
            } else if ($_POST['type'] == 2 and ! empty($_POST['item'])) { /* Edit Form */
                $id_class = $this->Misc->decode_id($_POST['item']);
                $row = $this->classes_model->getFields($id_class);
                if ($row) {
                    $this->load->view(admin_dir('myclass/extra/popupform_class'), array('edit' => 1, 'row' => $row, 'redirect' => $redirect));
                }
            }
        }
    }

    /*
     * Get List of Classes and Function	
     */

    function _list_classes_data() {
        $result = $this->class_functions_model->getSearch("", "", array('class_function_type' => 'ASC', 'class_function_title' => 'ASC'), true);
        $layer = array();
        foreach ($result as $q) {
            $layer[$q->class_id][$q->class_function_type][$q->id_class_function] = $q;
        }

        $data = array(
            'class_functions' => $layer,
            'classes' => $this->classes_model->getSearch("", "", array('class_title' => 'ASC'), true)
        );

        return $data;
    }

}
