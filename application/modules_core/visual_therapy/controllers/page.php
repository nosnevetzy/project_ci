<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Page extends System_Core {

    function __construct() {

        parent:: __construct();
        $this->classname = strtolower(get_class());
        $this->pagename = $this->uri->rsegment(2);
        $this->methodname = $this->uri->rsegment(3);
        $this->function_name = 'user'; // use to call functions for access
        $this->list_content = '';
        $this->load->model('visual_therapy/visual_therapies_model');
    }

    function index() {
        
    }

    /* ----------------------------------------------------------------------------- */
    /* ------------------------------- Page Function ------------------------------- */
    /* ----------------------------------------------------------------------------- */

    function add_vt() {
        $data = array(
            'template' => parent::main_template(),
            'css_files' => $this->config->item('css_for_validation'),
            'js_files' => $this->config->item('js_for_validation'),
            'id_patient' => $_POST['id']
        );
        $this->load->view(vt_dir('add_vt'), $data);
    }

    function edit_vt() {
        $id_vt = $this->misc->decode_id($_POST['item']);

        /* Check User if Exist */
        $row = $this->visual_therapies_model->getFields($id_vt);
        if ($row) {
            $data = array(
                'template' => parent::main_template(),
                'css_files' => $this->config->item('css_for_validation'),
                'js_files' => $this->config->item('js_for_validation'),
                'row' => $row,
                'id_patient' => $this->misc->encode_id($row->patient_id)
            );
            $this->load->view(vt_dir('edit_vt'), $data);
        } else {
            redirect(admin_dir('profile/view_pagenotfound_page'));
        }
    }

    

    /* ------------------------------------------------------------------------------- */
    /* ------------------------------- Method Function ------------------------------- */
    /* ------------------------------------------------------------------------------- */

    function method() {
        if ($this->uri->rsegment(3) == 'add_vt') {
            self::_method_add_vt();
        } else if ($this->uri->rsegment(3) == 'edit_vt') {
            self::_method_edit_vt();
        } else if ($this->uri->rsegment(3) == 'delete_patient') {
            self::_method_delete_patient();
        }
    }

    /* ----------------------------------------------------------------------------------------USER ACCESS---------------------------------------------------------------------------------------- */

    /*
     * 	Delete User Method
     */

    function _method_delete_patient() {
        if (IS_AJAX) {
            $id_patient = $this->Misc->decode_id($_POST['item']);
            /* Check User if Exist */
            $row = $this->patients_model->getFields($id_patient);
            if ($row) {
                $datas = array(
                    'enabled' => 0,
                    'updated_by' => $this->my_session->get('admin', 'user_id'),
                    'updated_date' => date('Y-m-d H:i:s')
                );
                /* Delete User */
                $this->patients_model->update_table($datas, array("id_patient" => $id_patient));
                parent::save_log($id_patient, "deleted patient " . $this->Misc->display_name($row->patient_fname, $row->patient_mname, $row->patient_lname));
                $arr = array(
                    'message_alert' => "Patient Deleted ",
                    'redirect' => $_POST['redirect'],
                    'status' => "success",
                    'id' => $id_patient
                );
                $this->load->view(admin_dir('template/print'), array('print' => json_encode($arr)));
            }
        }
    }

    /*
     * 	Edit User Method
     */

    function _method_edit_vt() {
        if (IS_AJAX) {
          
            $id_vt = $this->Misc->decode_id($_POST['item']);
            /* Check User if Exist */
            $row = $this->visual_therapies_model->getFields($id_vt);
            if ($row) {
                $this->form_validation->set_rules('vt', 'Visual Therapy', 'htmlspecialchars|trim|required');
                if ($this->form_validation->run() == FALSE) {
                    $arr = array(
                        'message_alert' => validation_errors(),
                        'status' => "error",
                        'id' => 0
                    );
                } else {
                    $datas = array(
                        'visual_therapy' => $_POST['vt'],
                        'updated_by' => $this->my_session->get('admin', 'user_id'),
                        'updated_date' => date('Y-m-d H:i:s')
                    );

                    /* Update User Info */
                    $this->visual_therapies_model->update_table($datas, array("id_visual_therapy" => $id_vt));

                    parent::save_log($id_vt, "updated visual therapy ");
                    $arr = array(
                        'message_alert' => "Successfully Updated Visual Therapy.",
                        'status' => "success",
                        'id' => $id_vt
                    );
                }
                $this->load->view(admin_dir('template/print'), array('print' => json_encode($arr)));
            }
        }
    }

    /*
     * 	Add New User Method
     */

    function _method_add_vt() {
        if (IS_AJAX) {
            $this->form_validation->set_rules('vt', 'Visual Therapy', 'htmlspecialchars|trim|required');

            if ($this->form_validation->run() == FALSE) {
                $arr = array(
                    'message_alert' => validation_errors(),
                    'status' => "error",
                    'id' => 0
                );
            } else {

                $datas = array(
                    'patient_id' => $this->misc->decode_id($_POST['item']),
                    'visual_therapy' => $_POST['vt'],
                    'enabled' => 1,
                    'added_by' => $this->my_session->get('admin', 'user_id'),
                    'added_date' => date('Y-m-d H:i:s'),
                );
                $id_vt = $this->visual_therapies_model->insert_table($datas);

                parent::save_log($id_vt, "added new visual therapy ");

                $arr = array(
                    'message_alert' => "Successfully Saved Visual Therapy",
                    'status' => "success",
                    'id' => $id_vt
                );
            }
            $this->load->view(admin_dir('template/print'), array('print' => json_encode($arr)));
        }
    }

}
