<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Log extends System_Core {

    private $users_model = '';

    function __construct() {
        $this->classname = strtolower(get_class());
        $this->pagename = $this->uri->rsegment(2);
        $this->methodname = $this->uri->rsegment(3);
        parent:: __construct();
        $this->load->model('admin/users_model');
        $this->users_model = new users_model();
    }

    function index() {
        redirect(admin_url('log/login'));
    }

    function reset_newpassword() {
        $id_user = $this->Misc->decode_id($this->uri->rsegment(3));
        $user_resetkey = $this->uri->rsegment(4);
        if ($user_resetkey)
            $row = $this->users_model->getSearch(array('u.id_user' => $id_user, 'u.user_resetkey' => $user_resetkey), "", "", "", "", true);
        if ($row) {
            $this->form_validation->set_rules('newpassword', 'New Password', 'required|xss_clean|trim');
            $this->form_validation->set_rules('confirm', 'Confirm Password', 'required|matches[newpassword]|trim');
            if ($this->form_validation->run() == FALSE) {
                $data['inlinejs'][] = parent::sticky_message(array('type' => 'error', 'text' => validation_errors()));
                $this->load->view(admin_dir('log/reset_newpassword'), $data);
            } else {
                $data = array(
                    'user_password' => sha1($_POST['newpassword']),
                    'user_resetkey' => ""
                );
                $this->users_model->update_table($data, "id_user", $row->id_user);

                $data['inlinejs'][] = parent::sticky_message(array('type' => 'success', 'text' => "Successfully Changed"));
                $data['id'] = 1;
                $this->load->view(admin_dir('log/reset_newpassword'), $data);
            }
        }
    }

    function reset_password() {
        $data['template'] = parent::log_template();

        $this->form_validation->set_rules('code', 'ID', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        if ($this->form_validation->run() == FALSE) {
            $data['inlinejs'][] = parent::sticky_message(array('type' => 'error', 'text' => validation_errors()));
            $this->load->view(admin_dir('log/reset_password'), $data);
        } else {
            $code = $_POST['code'];
            $email = $_POST['email'];

            /* Check User Login */
            $row = $this->users_model->getSearch(array('u.user_code' => $code, 'u.user_email' => $email), "", "", "", "", true);
            if ($row) {
                $user_resetkey = sha1(date('YmdHissiHdmy') . rand(1, 100000));
                $id_user = $this->Misc->encode_id($row->id_user);
                $content = "To reset your password please click this link";
                $content.=" <a href='" . admin_url('log/reset_newpassword/' . $id_user . '/' . $user_resetkey) . "'>RESET PASSWORD</a>";

                $data = array(
                    'user_resetkey' => $user_resetkey
                );
                $this->users_model->update_table($data, "id_user", $row->id_user);

                parent::send_email($content, "Reset Password", $row->user_email, "", "no-reply@aet.com", "PHZP AET");

                $data['inlinejs'][] = parent::sticky_message(array('type' => 'success', 'text' => "Please check your email"));
                $this->load->view(admin_dir('log/reset_password'), $data);
            } else {
                $error = "Wrong ID or Email";
                $data['inlinejs'][] = parent::sticky_message(array('type' => 'error', 'text' => $error));
                $this->load->view(admin_dir('log/reset_password'), $data);
            }
        }
    }

    function login() {

        $data['template'] = parent::log_template();

        $this->form_validation->set_rules('code', 'ID', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        if ($this->form_validation->run() == FALSE) {
            $data['inlinejs'][] = parent::sticky_message(array('type' => 'error', 'text' => validation_errors()));
            $this->load->view(admin_dir('log/login'), $data);
        } else {
            $code = $_POST['code'];
            $password = sha1($_POST['password']);

            /* Check User Login */
            $row = $this->users_model->getSearch(array('u.user_code' => $code, 'u.user_password' => $password), "", "", "", "", true);
            if ($row) {
                $name = $this->Misc->display_name($row->user_fname, $row->user_mname, $row->user_lname);
                $sessdata = array(
                    'login' => TRUE,
                    'name' => $name,
                    'fname' => $row->user_fname,
                    'user_picture' => $row->user_picture,
                    'user_id' => $row->id_user,
                    'user_code' => $row->user_code,
                    'user_email' => $row->user_email,
                    'user_type' => $row->user_type,
                    'user_type_id' => $row->user_type_id,
                    'department_id' => $row->department_id
                );

                /* Set Session */
                $this->session->set_userdata('admin', $sessdata);

                parent::save_log();
                if ($this->session->userdata('redirect')) {
                    $redirect = $this->session->userdata('redirect');
                    $this->session->unset_userdata('redirect');
                    redirect($redirect);
                }
                redirect('admin/profile');
            } else {
                $error = "Wrong ID or Password";
                $data['inlinejs'][] = parent::sticky_message(array('type' => 'error', 'text' => $error));
                $this->load->view(admin_dir('log/login'), $data);
            }
        }
    }

    function logout() {
        parent::save_log();
        $this->session->unset_userdata('admin');
        $this->session->sess_destroy();
        redirect('admin/log');
    }

}
