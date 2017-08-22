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

        $this->load->model('patients/patients_model');
        $this->load->model('visual_therapy/visual_therapies_model');
        $this->load->model('iop/iop_model');
        $this->load->model('refraction/refractions_model');
    }

    function index() {
        
    }

    /* ----------------------------------------------------------------------------- */
    /* ------------------------------- Page Function ------------------------------- */
    /* ----------------------------------------------------------------------------- */

    function add_patient() {
        $data = array(
            'template' => parent::main_template(),
            'css_files' => $this->config->item('css_for_validation'),
            'js_files' => $this->config->item('js_for_validation')
        );
        $this->load->view(patients_dir('add_patient'), $data);
    }

    function edit_patient() {
        $id_patient = $this->Misc->decode_id($this->uri->rsegment(3));

        /* Check User if Exist */
        $row = $this->patients_model->getFields($id_patient);
        if ($row) {
            $data = array(
                'template' => parent::main_template(),
                'css_files' => $this->config->item('css_for_validation'),
                'js_files' => $this->config->item('js_for_validation'),
                'row' => $row,
            );
            $this->load->view(patients_dir('edit_patient'), $data);
        } else {
            redirect(admin_dir('profile/view_pagenotfound_page'));
        }
    }

    function view_patient() {
        $id_patient = $this->Misc->decode_id($this->uri->rsegment(3));

        /* Check User if Exist */
        $row = $this->patients_model->getFields($id_patient);
        $vt = $this->visual_therapies_model->getListPatient($id_patient);
        $iop = $this->iop_model->getListPatient($id_patient);
        $refraction = $this->refractions_model->getListPatient($id_patient);

        if ($row) {
            $data = array(
                'template' => parent::main_template(),
                'row' => $row,
                'vt' => $vt,
                'iop' => $iop,
                'refraction' => $refraction,
                'active' => 'class="active"'
            );
            $this->load->view(patients_dir('view_patient'), $data);
        } else {
            redirect(admin_dir('profile/view_pagenotfound_page'));
        }
    }

    /* ------------------------------------------------------------------------------- */
    /* ------------------------------- Method Function ------------------------------- */
    /* ------------------------------------------------------------------------------- */

    function method() {
        if ($this->uri->rsegment(3) == 'add_patient') {
            self::_method_add_patient();
        } else if ($this->uri->rsegment(3) == 'edit_patient') {
            self::_method_edit_patient();
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

    function _method_edit_patient() {
        if (IS_AJAX) {
            $id_patient = $this->Misc->decode_id($_POST['id']);
            /* Check User if Exist */
            $row = $this->patients_model->getFields($id_patient);
            if ($row) {
                $this->form_validation->set_rules('fname', 'First Name', 'htmlspecialchars|trim|required|max_length[128]');
                $this->form_validation->set_rules('mname', 'Middle Name', 'htmlspecialchars|trim|max_length[128]');
                $this->form_validation->set_rules('lname', 'Last Name', 'htmlspecialchars|trim|required|max_length[128]');
                $this->form_validation->set_rules('address', 'Address', 'htmlspecialchars|trim|max_length[512]');
                $this->form_validation->set_rules('birthdate', 'Birth Date', 'htmlspecialchars|trim|required|max_length[15]');
                $this->form_validation->set_rules('gender', 'Gender', 'htmlspecialchars|trim|max_length[8]');
                $this->form_validation->set_rules('contact', 'Contact No', 'htmlspecialchars|trim|max_length[16]');
                $this->form_validation->set_rules('occupation', 'Occupation', 'htmlspecialchars|trim|max_length[64]');

                if ($this->form_validation->run() == FALSE) {
                    $arr = array(
                        'message_alert' => validation_errors(),
                        'redirect' => $_POST['redirect'],
                        'status' => "error",
                        'id' => 0
                    );
                } else {
                    /* Check User Exist */
                    $patient = $this->patients_model->getSearch("patient_fname like '" . $_POST['fname'] . "' AND patient_lname like '" . $_POST['lname'] . "' AND patient_birthdate = '" . $_POST['birthdate'] . "'", "", "", true);
                    if ($patient) {
                        if ($patient[0]->id_patient == $id_patient) {
                            $count = 0;
                        } else {
                            $count = 1;
                        }
                    } else {
                        $count = 0;
                    }
                    if ($count == 0) {
                        $datas = array(
                            'patient_fname' => $_POST['fname'],
                            'patient_lname' => $_POST['lname'],
                            'patient_mname' => $_POST['mname'],
                            'patient_address' => $_POST['address'],
                            'patient_birthdate' => $_POST['birthdate'],
                            'patient_gender' => $_POST['gender'],
                            'patient_contact' => $_POST['contact'],
                            'patient_occupation' => $_POST['occupation'],
                            'updated_by' => $this->my_session->get('admin', 'user_id'),
                            'updated_date' => date('Y-m-d H:i:s')
                        );

                        /* Update User Info */
                        $this->patients_model->update_table($datas, array("id_patient" => $id_patient));

                        parent::save_log($id_patient, "updated Patient " . $this->Misc->update_name_log($this->Misc->display_name($row->patient_fname, $row->patient_mname, $row->patient_lname), $this->Misc->display_name($_POST['fname'], $_POST['mname'], $_POST['lname'])));
                        $arr = array(
                            'message_alert' => "Successfully Updated Patient.",
                            'redirect' => $_POST['redirect'],
                            'status' => "success",
                            'id' => $id_patient
                        );
                    } else {
                        $arr = array(
                            'message_alert' => "Patient already exists.",
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

    function _method_add_patient() {
        if (IS_AJAX) {
            $this->form_validation->set_rules('fname', 'First Name', 'htmlspecialchars|trim|required|max_length[128]');
            $this->form_validation->set_rules('mname', 'Middle Name', 'htmlspecialchars|trim|max_length[128]');
            $this->form_validation->set_rules('lname', 'Last Name', 'htmlspecialchars|trim|required|max_length[128]');
            $this->form_validation->set_rules('address', 'Address', 'htmlspecialchars|trim|max_length[512]');
            $this->form_validation->set_rules('birthdate', 'Birth Date', 'htmlspecialchars|trim|required|max_length[15]');
            $this->form_validation->set_rules('gender', 'Gender', 'htmlspecialchars|trim|max_length[8]');
            $this->form_validation->set_rules('contact', 'Contact No', 'htmlspecialchars|trim|max_length[16]');
            $this->form_validation->set_rules('occupation', 'Occupation', 'htmlspecialchars|trim|max_length[64]');

            if ($this->form_validation->run() == FALSE) {
                $arr = array(
                    'message_alert' => validation_errors(),
                    'redirect' => $_POST['redirect'],
                    'status' => "error",
                    'id' => 0
                );
            } else {
                $count = $this->patients_model->getSearch("patient_fname like '" . $_POST['fname'] . "' AND patient_lname like '" . $_POST['lname'] . "' AND patient_birthdate = '" . $_POST['birthdate'] . "'", "", "", "", true);
                if ($count == 0) {
                    $datas = array(
                        'patient_fname' => $_POST['fname'],
                        'patient_lname' => $_POST['lname'],
                        'patient_mname' => $_POST['mname'],
                        'patient_address' => $_POST['address'],
                        'patient_birthdate' => $_POST['birthdate'],
                        'patient_gender' => $_POST['gender'],
                        'patient_contact' => $_POST['contact'],
                        'patient_occupation' => $_POST['occupation'],
                        'enabled' => 1,
                        'added_by' => $this->my_session->get('admin', 'user_id'),
                        'added_date' => date('Y-m-d H:i:s'),
                    );
                    $id_patient = $this->patients_model->insert_table($datas);

                    parent::save_log($id_patient, "added new patient " . $this->Misc->display_name($_POST['fname'], $_POST['mname'], $_POST['lname']));

                    $arr = array(
                        'message_alert' => "Successfully Saved Patient-" . $this->Misc->display_name($_POST['fname'], "", $_POST['lname']),
                        'redirect' => $_POST['redirect'],
                        'status' => "success",
                        'id' => $id_patient
                    );
                } else {
                    $arr = array(
                        'message_alert' => "Patient already exists.",
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
