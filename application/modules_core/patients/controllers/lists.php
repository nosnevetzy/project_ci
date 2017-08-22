<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Lists extends System_Core {

    function __construct() {

        parent:: __construct();
        $this->classname = strtolower(get_class());
        $this->pagename = $this->uri->rsegment(2);
        $this->methodname = $this->uri->rsegment(3);

        $this->load->model('patients/patients_model');

        //set list contents
    }

    function index() {
        self::patients();
    }

    /* ----------------------------------------------------------------------------- */
    /* ------------------------------- Page Function ------------------------------- */
    /* ----------------------------------------------------------------------------- */

    function patients() {
        $data = array(
            'template' => parent::main_template(),
            'css_files' => $this->config->item('css_for_tables'),
            'js_files' => $this->config->item('js_for_tables'),
        );
        $this->load->view(patients_dir('list_patient'), $data);
    }

    /* ------------------------------------------------------------------------------- */
    /* ------------------------------- Method Function ------------------------------- */
    /* ------------------------------------------------------------------------------- */

    function method() {
        if ($this->uri->rsegment(3) == 'list_patient') { /* Method for User */
            self::_method_list_patient();
        }
    }

    /* ----------------------------------------------------------------------------------------USER ACCESS---------------------------------------------------------------------------------------- */

    function _method_list_patient() {
        if (!IS_AJAX) {
            // Set confirmation message
            $this->session->set_flashdata('error', 'Direct access forbidden');
            redirect(admin_url($this->classname));
        }

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
                    } else {
                        $condition = array_merge($condition, array($var . " like" => "%$val%"));
                    }
                }
            }
        }

        $data['list_count'] = $this->patients_model->getList($condition, $string_condition, $sort_data)->num_rows();

        $data['list'] = $this->patients_model->getListLimit($condition, $string_condition, $sort_data, $this->page, $this->display);


        $datas = array('page' => $this->page,
            'display' => $this->display,
            'num_button' => $this->num_button,
            'list_count' => $data['list_count'],
            'list' => $data['list'],
            'max_page' => ((ceil($data['list_count'] / $this->display)) <= 0) ? 1 : (ceil($data['list_count'] / $this->display)),
        );

        $details = array_merge($data, $this->Misc->get_pagination_data($datas)); //get pagination data
        $this->load->view(patients_dir('list/patient_list'), $details);
    }

}
