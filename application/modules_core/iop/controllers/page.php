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
        $this->load->model('iop/iop_model');
    }

    function index() {
        
    }

    /* ----------------------------------------------------------------------------- */
    /* ------------------------------- Page Function ------------------------------- */
    /* ----------------------------------------------------------------------------- */

    function add_iop() {
        if (IS_AJAX) {
            $data = array(
                'template' => parent::main_template(),
                'css_files' => $this->config->item('css_for_validation'),
                'js_files' => $this->config->item('js_for_validation'),
                'id_patient' => $_POST['id']
            );
            $this->load->view(iop_dir('add_iop'), $data);
        }
    }

    function edit_iop() {
        $id_iop = $this->misc->decode_id($_POST['item']);

        /* Check User if Exist */
        $row = $this->iop_model->getFields($id_iop);
        if ($row) {
            $data = array(
                'template' => parent::main_template(),
                'css_files' => $this->config->item('css_for_validation'),
                'js_files' => $this->config->item('js_for_validation'),
                'row' => $row,
                'id_patient' => $this->misc->encode_id($row->patient_id)
            );
            $this->load->view(iop_dir('edit_iop'), $data);
        } else {
            redirect(admin_dir('profile/view_pagenotfound_page'));
        }
    }

    /* ------------------------------------------------------------------------------- */
    /* ------------------------------- Method Function ------------------------------- */
    /* ------------------------------------------------------------------------------- */

    function method() {
        if ($this->uri->rsegment(3) == 'add_iop') {
            self::_method_add_iop();
        } else if ($this->uri->rsegment(3) == 'edit_iop') {
            self::_method_edit_iop();
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

    function _method_edit_iop() {
        if (IS_AJAX) {

            $id_iop = $this->Misc->decode_id($_POST['item']);
            /* Check User if Exist */
            $row = $this->iop_model->getFields($id_iop);
            if ($row) {
                $this->form_validation->set_rules('iop', 'IOP Measurement', 'htmlspecialchars|trim|required');
                if ($this->form_validation->run() == FALSE) {
                    $arr = array(
                        'message_alert' => validation_errors(),
                        'status' => "error",
                        'id' => 0
                    );
                } else {
                    $datas = array(
                        'iop' => $_POST['iop'],
                        'updated_by' => $this->my_session->get('admin', 'user_id'),
                        'updated_date' => date('Y-m-d H:i:s')
                    );

                    /* Update User Info */
                    $this->iop_model->update_table($datas, array("id_iop" => $id_iop));

                    parent::save_log($id_iop, "updated iop ");
                    $arr = array(
                        'message_alert' => "Successfully Updated IOP Measurement.",
                        'status' => "success",
                        'id' => $id_iop
                    );
                }
                $this->load->view(admin_dir('template/print'), array('print' => json_encode($arr)));
            }
        }
    }

    /*
     * 	Add New User Method
     */

    function _method_add_iop() {
        if (IS_AJAX) {
            $this->form_validation->set_rules('iop', 'IOP Measurement', 'htmlspecialchars|trim|required');

            if ($this->form_validation->run() == FALSE) {
                $arr = array(
                    'message_alert' => validation_errors(),
                    'status' => "error",
                    'id' => 0
                );
            } else {

                $datas = array(
                    'patient_id' => $this->misc->decode_id($_POST['item']),
                    'iop' => $_POST['iop'],
                    'enabled' => 1,
                    'added_by' => $this->my_session->get('admin', 'user_id'),
                    'added_date' => date('Y-m-d H:i:s'),
                );
                $id_iop = $this->iop_model->insert_table($datas);

                parent::save_log($id_iop, "added new iop");

                $arr = array(
                    'message_alert' => "Successfully Saved IOP Measurement",
                    'status' => "success",
                    'id' => $id_iop
                );
            }
            $this->load->view(admin_dir('template/print'), array('print' => json_encode($arr)));
        }
    }

}
