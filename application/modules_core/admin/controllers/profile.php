<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Profile extends System_Core {

    public $users_model = '';

    function __construct() {
        $this->classname = strtolower(get_class());
        $this->pagename = $this->uri->rsegment(2);
        $this->methodname = $this->uri->rsegment(3);

        $this->function_name = 'profile'; // use to call functions for access

        parent:: __construct();

        $this->load->model('admin/users_model');
        $this->users_model = new users_model();

        $this->contents = array('model_directory' => 'admin/users_model',
            'model_name' => 'users_model',
            'filters' => array(),
            'functionName' => 'Profile Page',); // use to call functions for access
    }

    function index() {
        redirect('admin/profile/view_profile_page');
    }

    /* ------------------------------------------------------------------------------------------------------------------------------------------- */
    /* ------------------------------- Page Function --------------------------------------------------------------------------------------------- */
    /* ------------------------------------------------------------------------------------------------------------------------------------------- */

    function view_pagenotfound_page() {
        $this->load->view(admin_dir('profile/view_pagenotfound_page'));
    }

    function view_profile_page() {
        $id_user = $this->my_session->get('admin', 'user_id');
        $result = $this->users_model->getFields($id_user);
        if ($result) {
            $data = array(
                'template' => parent::main_template(),
                'row' => $result
            );
            $this->load->view(admin_dir('profile/view_profile_page'), $data);
        } else {
            redirect(admin_dir('profile/view_pagenotfound_page'));
        }
    }

    function edit_password_page() {
        $id_user = $this->my_session->get('admin', 'user_id');
        $result = $this->users_model->getFields($id_user);
        if ($result) {
            $data = array(
                'template' => parent::main_template(),
                'css_files' => $this->config->item('css_for_validation'),
                'js_files' => $this->config->item('js_for_validation'),
                'result' => $result
            );
            $this->load->view(admin_dir('profile/edit_password_page'), $data);
        } else {
            redirect(admin_dir('profile/view_pagenotfound_page'));
        }
    }

    function edit_myinfo_page() {
        $id_user = $this->my_session->get('admin', 'user_id');
        $result = $this->users_model->getFields($id_user);
        if ($result) {
            $data = array(
                'template' => parent::main_template(),
                'css_files' => $this->config->item('css_for_validation'),
                'js_files' => $this->config->item('js_for_validation'),
                'result' => $result
            );
            $this->load->view(admin_dir('profile/edit_myinfo_page'), $data);
        } else {
            redirect(admin_dir('profile/view_pagenotfound_page'));
        }
    }

    function take_picture_page() {
        $id_user = $this->my_session->get('admin', 'user_id');
        $result = $this->users_model->getFields($id_user);
        if ($result) {
            $data = array(
                'template' => parent::main_template(),
                'result' => $result
            );
            $this->load->view(admin_dir('profile/take_picture_page'), $data);
        } else {
            redirect(admin_dir('profile/view_pagenotfound_page'));
        }
    }

    /* --------------------------------------------------------------------------------------------------------------------------------------------- */
    /* ------------------------------- Method Function --------------------------------------------------------------------------------------------- */
    /* --------------------------------------------------------------------------------------------------------------------------------------------- */

    function method() {
        if ($this->uri->rsegment(3) == 'edit_password') {
            self::_method_edit_password();
        } else if ($this->uri->rsegment(3) == 'upload_mypicture') {
            self::_method_upload_mypicture();
        } else if ($this->uri->rsegment(3) == 'edit_myinfo') {
            self::_method_edit_myinfo();
        }
    }

    function _method_edit_myinfo() {
        if (IS_AJAX) {
            $id_user = $this->my_session->get('admin', 'user_id');
            $this->form_validation->set_rules('fname', 'First Name', 'htmlspecialchars|trim|required');
            $this->form_validation->set_rules('mname', 'Middle Name', 'htmlspecialchars|trim|required');
            $this->form_validation->set_rules('lname', 'Last Name', 'htmlspecialchars|trim|required');
            $this->form_validation->set_rules('street', 'Street', 'htmlspecialchars|trim|required');
            $this->form_validation->set_rules('city', 'City', 'htmlspecialchars|trim|required');
            $this->form_validation->set_rules('province', 'Province', 'htmlspecialchars|trim|required');
            $this->form_validation->set_rules('country', 'Country', 'htmlspecialchars|trim|required');
            $this->form_validation->set_rules('contact', 'Contact', 'htmlspecialchars|trim|required');
            if ($this->form_validation->run() == FALSE) {
                $arr = array(
                    'message_alert' => validation_errors(),
                    'redirect' => $_POST['redirect'],
                    'status' => "error",
                    'id' => 0
                );
            } else {
                $datas = array(
                    'user_fname' => $_POST['fname'],
                    'user_lname' => $_POST['lname'],
                    'user_mname' => $_POST['mname'],
                    'user_street' => $_POST['street'],
                    'user_city' => $_POST['city'],
                    'user_province' => $_POST['province'],
                    'user_country' => $_POST['country'],
                    // 'user_email'=>$_POST['email'],
                    'user_contact' => $_POST['contact']
                );
                /* Update User Info */
                $this->users_model->update_table($datas, array("id_user" => $id_user));
                parent::save_log($id_user, "updated information");
                $arr = array(
                    'message_alert' => "Successfully saved.",
                    'redirect' => $_POST['redirect'],
                    'status' => "success",
                    'id' => $id_user
                );
            }
            $this->load->view(admin_dir('template/print'), array('print' => json_encode($arr)));
        }
    }

    function _method_upload_mypicture() {
        $id_user = $this->my_session->get('admin', 'user_id');
        $path = parent::upload_user_path($id_user);
        if (!empty($_POST['image_data'])) {
            /* Convert Base64 to Picture */
            $convert = parent::convert_image($_POST['image_data'], $path['profile'], $path['profile_thumb']);
            if ($convert[0]) {
                $datas = array(
                    'user_picture' => $convert['file_name'],
                    'updated_by' => $id_user,
                    'updated_date' => date('Y-m-d H:i:s')
                );
                /* Update User Picture */
                $this->users_model->update_table($datas, array("id_user" => $id_user));
                parent::save_log($id_user, "took a picture");
                $arr = array(
                    'message_alert' => "Successfully Saved.",
                    'status' => "success",
                    'id' => 1
                );
            } else {
                $arr = array(
                    'message_alert' => $convert['error'],
                    'status' => "error",
                    'id' => 0
                );
            }
        } else if (!empty($_FILES)) {
            $filetype = 'gif|jpg|png';
            /* Upload Picture */
            $upload = parent::upload_file($path['profile'], $path['profile_thumb'], 'file', $filetype, '2048');
            if ($upload[0]) {
                $datas = array(
                    'user_picture' => $upload['orig_name'],
                    'updated_by' => $id_user,
                    'updated_date' => date('Y-m-d H:i:s')
                );
                /* Update User Picture */
                $this->users_model->update_table($datas, array("id_user" => $id_user));
                parent::save_log($id_user, "uploaded a picture");
                $arr = array(
                    'message_alert' => "Successfully Saved.",
                    'status' => "success",
                    'id' => 1
                );
            } else {
                $arr = array(
                    'message_alert' => $upload['error'],
                    'status' => "error",
                    'id' => 0
                );
            }
        } else {
            $arr = array(
                'message_alert' => "No file.",
                'status' => "error",
                'id' => 0
            );
        }
        $this->load->view(admin_dir('template/print'), array('print' => json_encode($arr)));
    }

    function _method_edit_password() {
        if (IS_AJAX) {
            $id_user = $this->my_session->get('admin', 'user_id');
            $this->form_validation->set_rules('oldpassword', 'Old Password', 'htmlspecialchars|trim|required');
            $this->form_validation->set_rules('newpassword', 'New Password', 'htmlspecialchars|trim|required|matches[confirmpassword]');
            $this->form_validation->set_rules('confirmpassword', 'Confirm Password', 'htmlspecialchars|trim|required');
            if ($this->form_validation->run() == FALSE) {
                $arr = array(
                    'message_alert' => validation_errors(),
                    'redirect' => $_POST['redirect'],
                    'status' => "error",
                    'id' => 0
                );
            } else {
                /* Check Old Password */
                $old_password = md5($_POST['oldpassword']);
                $result = $this->users_model->getSearch(array("u.id_user" => $id_user, "u.user_password like" => $old_password), "", "", "", true);
                if ($result) {
                    $datas = array(
                        'user_password' => md5($_POST['newpassword']),
                        'updated_by' => $id_user,
                        'updated_date' => date('Y-m-d H:i:s')
                    );
                    /* Save New Password */
                    $this->users_model->update_table($datas, array("id_user" => $id_user));
                    parent::save_log($id_user, "changed password");

                    $arr = array(
                        'message_alert' => "Password Successfully Changed.",
                        'redirect' => $_POST['redirect'],
                        'status' => "success",
                        'id' => $id_user
                    );
                } else {
                    $arr = array(
                        'message_alert' => "Wrong Old Password.",
                        'redirect' => $_POST['redirect'],
                        'status' => "error",
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
}
