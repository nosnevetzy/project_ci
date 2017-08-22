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
        $this->load->model('refraction/refractions_model');
    }

    function index() {
        
    }

    /* ----------------------------------------------------------------------------- */
    /* ------------------------------- Page Function ------------------------------- */
    /* ----------------------------------------------------------------------------- */

    function add_refraction() {
        if (IS_AJAX) {
            $data = array(
                'template' => parent::main_template(),
                'css_files' => $this->config->item('css_for_validation'),
                'js_files' => $this->config->item('js_for_validation'),
                'id_patient' => $_POST['id']
            );
            $this->load->view(refraction_dir('add_refraction'), $data);
        }
    }

    function edit_refraction() {
        $id_refraction = $this->misc->decode_id($_POST['item']);

        /* Check User if Exist */
        $row = $this->refractions_model->getFields($id_refraction);
        if ($row) {
            $data = array(
                'template' => parent::main_template(),
                'css_files' => $this->config->item('css_for_validation'),
                'js_files' => $this->config->item('js_for_validation'),
                'row' => $row,
                'id_patient' => $this->misc->encode_id($row->patient_id)
            );
            $this->load->view(refraction_dir('edit_refraction'), $data);
        } else {
            redirect(admin_dir('profile/view_pagenotfound_page'));
        }
    }

    /* ------------------------------------------------------------------------------- */
    /* ------------------------------- Method Function ------------------------------- */
    /* ------------------------------------------------------------------------------- */

    function method() {
        if ($this->uri->rsegment(3) == 'add_refraction') {
            self::_method_add_refraction();
        } else if ($this->uri->rsegment(3) == 'edit_refraction') {
            self::_method_edit_refraction();
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

    function _method_edit_refraction() {
        if (IS_AJAX) {
            $id_refraction = $this->Misc->decode_id($_POST['item']);

            /* Check User if Exist */
            $row = $this->refractions_model->getFields($id_refraction);
            if ($row) {
                $this->form_validation->set_rules('odsphere', 'OD Sphere', 'htmlspecialchars|trim|required');
                $this->form_validation->set_rules('odcylinder', 'OD Cylinder', 'htmlspecialchars|trim|required');
                $this->form_validation->set_rules('odaxis', 'OD Axis', 'htmlspecialchars|trim|required');
                $this->form_validation->set_rules('odpd', 'OD PD', 'htmlspecialchars|trim|required');
                $this->form_validation->set_rules('ossphere', 'OS Sphere', 'htmlspecialchars|trim|required');
                $this->form_validation->set_rules('oscylinder', 'OS Cylinder', 'htmlspecialchars|trim|required');
                $this->form_validation->set_rules('osaxis', 'OS Axis', 'htmlspecialchars|trim|required');
                $this->form_validation->set_rules('ospd', 'OS PD', 'htmlspecialchars|trim|required');
                if ($this->form_validation->run() == FALSE) {
                    $arr = array(
                        'message_alert' => validation_errors(),
                        'status' => "error",
                        'id' => 0
                    );
                } else {
                    $datas = array(
                        'os_sphere' => $_POST['ossphere'],
                        'os_cylinder' => $_POST['oscylinder'],
                        'os_axis' => $_POST['osaxis'],
                        'os_pd' => $_POST['ospd'],
                        'od_sphere' => $_POST['odsphere'],
                        'od_cylinder' => $_POST['odcylinder'],
                        'od_axis' => $_POST['odaxis'],
                        'od_pd' => $_POST['odpd'],
                        'updated_by' => $this->my_session->get('admin', 'user_id'),
                        'updated_date' => date('Y-m-d H:i:s')
                    );

                    /* Update User Info */
                    $this->refractions_model->update_table($datas, array("id_refraction" => $id_refraction));

                    parent::save_log($id_refraction, "updated refraction ");
                    $arr = array(
                        'message_alert' => "Successfully Updated Refraction.",
                        'status' => "success",
                        'id' => $id_refraction
                    );
                }
                $this->load->view(admin_dir('template/print'), array('print' => json_encode($arr)));
            }
        }
    }

    /*
     * 	Add New User Method
     */

    function _method_add_refraction() {
        if (IS_AJAX) {

            $this->form_validation->set_rules('odsphere', 'OD Sphere', 'htmlspecialchars|trim|required');
            $this->form_validation->set_rules('odcylinder', 'OD Cylinder', 'htmlspecialchars|trim|required');
            $this->form_validation->set_rules('odaxis', 'OD Axis', 'htmlspecialchars|trim|required');
            $this->form_validation->set_rules('odpd', 'OD PD', 'htmlspecialchars|trim|required');
            $this->form_validation->set_rules('ossphere', 'OS Sphere', 'htmlspecialchars|trim|required');
            $this->form_validation->set_rules('oscylinder', 'OS Cylinder', 'htmlspecialchars|trim|required');
            $this->form_validation->set_rules('osaxis', 'OS Axis', 'htmlspecialchars|trim|required');
            $this->form_validation->set_rules('ospd', 'OS PD', 'htmlspecialchars|trim|required');

            if ($this->form_validation->run() == FALSE) {
                $arr = array(
                    'message_alert' => validation_errors(),
                    'status' => "error",
                    'id' => 0
                );
            } else {

                $datas = array(
                    'patient_id' => $this->misc->decode_id($_POST['item']),
                    'os_sphere' => $_POST['ossphere'],
                    'os_cylinder' => $_POST['oscylinder'],
                    'os_axis' => $_POST['osaxis'],
                    'os_pd' => $_POST['ospd'],
                    'od_sphere' => $_POST['odsphere'],
                    'od_cylinder' => $_POST['odcylinder'],
                    'od_axis' => $_POST['odaxis'],
                    'od_pd' => $_POST['odpd'],
                    'enabled' => 1,
                    'added_by' => $this->my_session->get('admin', 'user_id'),
                    'added_date' => date('Y-m-d H:i:s'),
                );
                $id_refraction = $this->refractions_model->insert_table($datas);

                parent::save_log($id_refraction, "added new refraction");

                $arr = array(
                    'message_alert' => "Successfully Saved Refraction",
                    'status' => "success",
                    'id' => $id_refraction
                );
            }
            $this->load->view(admin_dir('template/print'), array('print' => json_encode($arr)));
        }
    }

}
