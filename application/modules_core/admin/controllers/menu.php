<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Menu extends System_Core {

    function __construct() {
        $this->classname = strtolower(get_class());
        $this->pagename = $this->uri->rsegment(2);
        $this->methodname = $this->uri->rsegment(3);
        parent:: __construct();

        $this->load->model('admin/user_types_model');
        $this->load->model('admin/links_model');

        $this->function_name = 'menu';
    }

    function index() {
        redirect('admin/menu/list_typemenu_page');
    }

    /* ------------------------------------------------------------------------------------------------------------------------------------------- */
    /* ------------------------------- Page Function --------------------------------------------------------------------------------------------- */
    /* ------------------------------------------------------------------------------------------------------------------------------------------- */

    function list_typemenu() {
        $data = array(
            'template' => parent::main_template(),
            'css_files' => $this->config->item('css_for_tables'),
            'js_files' => $this->config->item('js_for_tables'),
        );

        $this->load->view(admin_dir('menu/list_typemenu'), $data);
    }

    function edit_menu() {
        $id_user_type = $this->Misc->decode_id($_POST['id']);
        $plink = array('ut.id_user_type' => $id_user_type, 'l.link_location' => 2, 'l.parent_link_id' => 0);
        $parent_link = $this->links_model->getSearch($plink, "", array('l.link_name' => 'ASC'), true);
        $id_link = $this->Misc->decode_id($_POST['item']);
        $row = $this->links_model->getFields($id_link);
        if ($row) {
            $data = array(
                'row' => $row,
                'parent_link' => $parent_link,
                'id_user_type' => $id_user_type
            );
            $this->load->view(admin_dir('menu/extra/popupform_link'), $data);
        } else {
            redirect(admin_dir('profile/view_pagenotfound_page'));
        }
    }

    function view_menu() {
        $id_user_type = $this->Misc->decode_id($this->uri->rsegment(3));
        $row = $this->user_types_model->getFields($id_user_type);
        if ($row) {
            $data = array(
                'row' => $row,
                'template' => parent::main_template(),
                'sidemenu' => parent::_query_menuhierarchy($this->links_model->getSearch(array('ut.id_user_type' => $id_user_type, 'l.link_location' => 2), "", array('l.link_order' => 'ASC'))),
                'topmenu' => $this->links_model->getSearch(array('ut.id_user_type' => $id_user_type, 'l.link_location' => 1, 'l.parent_link_id' => 0), "", array('l.link_order' => 'ASC'), true)
            );
            $this->load->view(admin_dir('menu/view_menu'), $data);
        } else {
            redirect(admin_dir('profile/view_pagenotfound_page'));
        }
    }

    /* --------------------------------------------------------------------------------------------------------------------------------------------- */
    /* ------------------------------- Method Function --------------------------------------------------------------------------------------------- */
    /* --------------------------------------------------------------------------------------------------------------------------------------------- */

    function method() {
        if ($this->uri->rsegment(3) == 'list_usertype') {
            self::_method_list_usertype();
        } else if ($this->uri->rsegment(3) == 'add_link') {
            self::_method_add_link();
        } else if ($this->uri->rsegment(3) == 'edit_link') {
            self::_method_edit_link();
        } else if ($this->uri->rsegment(3) == 'delete_link') {
            self::_method_delete_link();
        } else if ($this->uri->rsegment(3) == 'copy_link') {
            self::_method_copy_link();
        }
    }

    /*
     * 	Add New Link
     */

    function _method_add_link() {
        if (IS_AJAX) {
            $id_user_type = $this->Misc->decode_id($_POST['item']);
            /* Check User Type if Exist */
            $row = $this->user_types_model->getFields($id_user_type);
            if ($row) {
                $this->form_validation->set_rules('location', 'Location', 'htmlspecialchars|trim|required');
                $this->form_validation->set_rules('name', 'Name', 'htmlspecialchars|trim|required');
                $this->form_validation->set_rules('external', 'URL Source', 'htmlspecialchars|trim');
                $this->form_validation->set_rules('url', 'URL', 'htmlspecialchars|trim|required');
                $this->form_validation->set_rules('icon', 'Icon', 'htmlspecialchars|trim');
                $this->form_validation->set_rules('parent', 'Parent', 'htmlspecialchars|trim');
                $this->form_validation->set_rules('header', 'Header', 'htmlspecialchars|trim');
                $this->form_validation->set_rules('newtab', 'New Tab', 'htmlspecialchars|trim');
                if ($this->form_validation->run() == FALSE) {
                    $error = $this->Misc->oneline_string(validation_errors());
                    $arr = array(
                        'message_alert' => $this->Misc->message_status("error", $error),
                        'id' => 0
                    );
                } else {
                    if ($_POST['location'] == 1) {
                        $_POST['parent'] = 0;
                        $_POST['header'] = 0;
                    }
                    $datas = array(
                        'link_url' => $_POST['url'],
                        'link_name' => $_POST['name'],
                        'link_icon' => $_POST['icon'],
                        'link_newtab' => $_POST['newtab'],
                        'link_external' => $_POST['external'],
                        'link_location' => $_POST['location'],
                        'link_head' => $_POST['header'],
                        'link_order' => self::_newlink_order($_POST['location'], $_POST['parent'], $id_user_type), /* Get Order Number */
                        'parent_link_id' => $_POST['parent'],
                        'enabled' => 1,
                        'added_by' => $this->my_session->get('admin', 'user_id'),
                        'added_date' => date('Y-m-d H:i:s'),
                        'user_type_id' => $id_user_type
                    );
                    $id_link = $this->links_model->insert_table($datas);
                    /* Add new Link */
                    parent::save_log($id_link, "added new link " . $_POST['name']);
                    $arr = array(
                        'message_alert' => $this->Misc->message_status('success', 'Successfully saved'),
                        'id' => 1
                    );
                }
                $this->load->view(admin_dir('template/print'), array('print' => json_encode($arr)));
            }
        }
    }

    /*
     * 	Edit Link
     */

    function _method_edit_link() {
        if (IS_AJAX) {
            $id_user_type = $this->Misc->decode_id($_POST['item']);
            $id_link = $this->Misc->decode_id($_POST['id']);
            /* Check Link and User Type if Exist */
            $row = $this->links_model->getSearch(array("l.id_link" => $id_link, "id_user_type" => $id_user_type), "", "", "", "", true);
            if ($row) {
                $this->form_validation->set_rules('location', 'Location', 'htmlspecialchars|trim|required');
                $this->form_validation->set_rules('name', 'Name', 'htmlspecialchars|trim|required');
                $this->form_validation->set_rules('external', 'URL Source', 'htmlspecialchars|trim');
                $this->form_validation->set_rules('url', 'URL', 'htmlspecialchars|trim|required');
                $this->form_validation->set_rules('icon', 'Icon', 'htmlspecialchars|trim');
                $this->form_validation->set_rules('parent', 'Parent', 'htmlspecialchars|trim');
                $this->form_validation->set_rules('header', 'Header', 'htmlspecialchars|trim');
                $this->form_validation->set_rules('newtab', 'New Tab', 'htmlspecialchars|trim');
                if ($this->form_validation->run() == FALSE) {
                    $error = $this->Misc->oneline_string(validation_errors());
                    $arr = array(
                        'message_alert' => $this->Misc->message_status("error", $error),
                        'id' => 0
                    );
                } else {
                    if ($_POST['location'] == 1) {
                        $_POST['parent'] = 0;
                        $_POST['header'] = 0;
                    }

                    $datas = array(
                        'link_url' => $_POST['url'],
                        'link_name' => $_POST['name'],
                        'link_icon' => $_POST['icon'],
                        'link_newtab' => $_POST['newtab'],
                        'link_external' => $_POST['external'],
                        'link_location' => $_POST['location'],
                        'link_head' => $_POST['header'],
                        'link_order' => $_POST['order'],
                        'parent_link_id' => $_POST['parent'],
                        'updated_by' => $this->my_session->get('admin', 'user_id'),
                        'updated_date' => date('Y-m-d H:i:s')
                    );
                    $this->links_model->update_table($datas, "id_link", $id_link);
                    /* Update Link Info */
                    parent::save_log($id_link, "updated link " . $this->Misc->update_name_log($row->link_name, $_POST['name']));
                    $arr = array(
                        'message_alert' => $this->Misc->message_status('success', 'Successfully saved'),
                        'id' => 1
                    );
                }
                $this->load->view(admin_dir('template/print'), array('print' => json_encode($arr)));
            }
        }
    }

    /*
     * 	Delete Link
     */

    function _method_delete_link() {
        if (IS_AJAX) {

            $id_link = $this->Misc->decode_id($_POST['item']);
            $id_user_type = $this->Misc->decode_id($_POST['id']);
            /* Check Link and User Type if Exist */
            $row = $this->links_model->getSearch(array("l.id_link" => $id_link, "id_user_type" => $id_user_type), "", "", "", "", true);

            if ($row) {
                $datas = array(
                    'enabled' => 0,
                    'updated_by' => $this->my_session->get('admin', 'user_id'),
                    'updated_date' => date('Y-m-d H:i:s')
                );
                /* Delete Link */
                $this->links_model->update_table($datas, array("id_link" => $id_link));

                $datas = array(
                    'enabled' => 0,
                    'updated_by' => $this->my_session->get('admin', 'user_id'),
                    'updated_date' => date('Y-m-d H:i:s')
                );
                /* Delete Class Function by Class */
                $this->links_model->update_table($datas, array("parent_link_id" => $id_link));

                parent::save_log($id_link, "deleted link " . $row->link_name);

                $arr = array(
                    'message_alert' => "Successfully Deleted $row->link_name link",
                    'redirect' => $_POST['redirect'],
                    'status' => "success",
                    'id' => $id_link
                );
                $this->load->view(admin_dir('template/print'), array('print' => json_encode($arr)));
            }
        }
    }

    /*
     * 	Copy User Type's Link to Other User Type
     */

    function _method_copy_link() {
        if (IS_AJAX) {
            $this->form_validation->set_rules('from', 'Link From', 'htmlspecialchars|trim|required');
            $this->form_validation->set_rules('to', 'Copy To', 'htmlspecialchars|trim|required');
            if ($this->form_validation->run() == FALSE) {
                $error = $this->Misc->oneline_string(validation_errors());
                $arr = array(
                    'message_alert' => $this->Misc->message_status("error", $error),
                    'id' => 0
                );
            } else {
                if ($_POST['to'] != $_POST['from']) {

                    /* Start Query */
                    $this->db->trans_start();

                    $data = array(
                        'enabled' => 0,
                        'updated_by' => $this->my_session->get('admin', 'user_id'),
                        'updated_date' => date('Y-m-d H:i:s')
                    );
                    /* Delete Old Link */
                    $this->links_model->update_table($data, "user_type_id", $_POST['to']);

                    $result = $this->links_model->getSearch(array("id_user_type" => $_POST['from'], "l.parent_link_id" => 0), "", "", true);
                    foreach ($result as $q) {
                        $data = array(
                            'link_url' => $q->link_url,
                            'link_name' => $q->link_name,
                            'link_title' => $q->link_title,
                            'link_detail' => $q->link_detail,
                            'link_icon' => $q->link_icon,
                            'link_location' => $q->link_location,
                            'link_newtab' => $q->link_newtab,
                            'link_external' => $q->link_external,
                            'link_head' => $q->link_head,
                            'link_order' => $q->link_order,
                            'parent_link_id' => $q->parent_link_id,
                            'user_type_id' => $_POST['to'],
                            'enabled' => 1,
                            'added_by' => $this->my_session->get('admin', 'user_id'),
                            'added_date' => date('Y-m-d H:i:s')
                        );
                        /* Add New Link */
                        $id_link = $this->links_model->insert_table($data);

                        $result2 = $this->links_model->getSearch(array("id_user_type" => $_POST['from'], "l.parent_link_id" => $q->id_link), "", "", true);
                        $layer = '';
                        foreach ($result2 as $q2) {
                            $layer2 = array(
                                'link_url' => $q2->link_url,
                                'link_name' => $q2->link_name,
                                'link_title' => $q2->link_title,
                                'link_detail' => $q2->link_detail,
                                'link_icon' => $q2->link_icon,
                                'link_location' => $q2->link_location,
                                'link_newtab' => $q2->link_newtab,
                                'link_external' => $q2->link_external,
                                'link_head' => $q2->link_head,
                                'link_order' => $q2->link_order,
                                'parent_link_id' => $id_link,
                                'user_type_id' => $_POST['to'],
                                'enabled' => 1,
                                'added_by' => $this->my_session->get('admin', 'user_id'),
                                'added_date' => date('Y-m-d H:i:s')
                            );
                            $layer[] = $layer2;
                        }

                        if ($layer != '') {
                            /* Add New Sub Link */
                            $this->links_model->insert_batch_table($layer);
                        }
                    }
                    parent::save_log('', "Copy menu");

                    /* End Query */
                    $this->db->trans_complete();
                    $arr = array(
                        'message_alert' => $this->Misc->message_status('success', "Successfuly Saved"),
                        'id' => 1
                    );
                } else {
                    $error = $this->Misc->oneline_string(validation_errors());
                    $arr = array(
                        'message_alert' => $this->Misc->message_status("error", "Error in Link From and Copy To Fields"),
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
                'var-value' => 'id_user_type',
            ),
            'user_type' => array(
                'label' => 'User Type',
                'type' => 'text',
                'type-class' => 'col-lg-12 uniform-input',
                'class' => 'col-lg-2',
                'var-value' => 'user_type',
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
            $sort_data = array_merge($sort_data, array($sort_by => $sort_type));
        }

        //set condition for the list
        $condition = array();
        $string_condition = array();
        if (!empty($this->tools->getPost('search'))) {
            foreach ($this->tools->getPost('search') as $var => $val) {
                if ($val != '') {
                    if ($var == 'id_user_type') {
                        $condition = array_merge($condition, array($var => $val));
                    } else {
                        $condition = array_merge($condition, array($var . " like" => "%$val%"));
                    }
                }
            }
        }

        $data['list_count'] = $this->user_types_model->getList($condition, $sort_data, $string_condition)->num_rows();
        $data['list'] = $this->user_types_model->getListLimit($condition, $sort_data, $string_condition, $this->page, $this->display);

        $datas = array('page' => $this->page,
            'display' => $this->display,
            'num_button' => $this->num_button,
            'list_count' => $data['list_count'],
            'list' => $data['list'],
            'max_page' => ((ceil($data['list_count'] / $this->display)) <= 0) ? 1 : (ceil($data['list_count'] / $this->display)),
        );
        //column customizaton
        $details = array_merge($data, $this->Misc->get_pagination_data($datas)); //get pagination data
        $this->load->view(admin_dir('menu/list/user_type_list'), $details);
    }

    /* ----------------------------------------------------------------------------------------------------------------------------------------------- */
    /* ------------------------------- Additional Module --------------------------------------------------------------------------------------------- */
    /* ----------------------------------------------------------------------------------------------------------------------------------------------- */


    /*
     * Generate Order Number for New Added Link 
     */

    function _newlink_order($link_location, $parent_link_id, $user_type_id) {
        $count = $this->links_model->getSearch(array("l.link_location" => $link_location, "id_user_type" => $user_type_id, "l.parent_link_id" => $parent_link_id), "", "", "", true);
        return $count + 1;
    }

    /*
     * Show Link Popup Form
     */

    function popupform_link() {
        if (IS_AJAX) {
            $redirect = (!empty($_POST['redirect'])) ? $_POST['redirect'] : "";

            if ($_POST['type'] == 1) { /* Add Form */
                $id_user_type = $this->Misc->decode_id($_POST['id']);
                $parent_link = $this->links_model->getSearch(array('ut.id_user_type' => $id_user_type, 'l.link_location' => 2, 'l.parent_link_id' => 0), "", array('l.link_name' => 'ASC'), true);
                $this->load->view(admin_dir('menu/extra/popupform_link'), array('add' => 1, 'redirect' => $redirect, 'parent_link' => $parent_link, 'id_user_type' => $id_user_type));
            } else if ($_POST['type'] == 2 and ! empty($_POST['item'])) { /* Edit Form */
                $id_user_type = $this->Misc->decode_id($_POST['id']);
                $parent_link = $this->links_model->getSearch(array('ut.id_user_type' => $id_user_type, 'l.link_location' => 2, 'l.parent_link_id' => 0), "", array('l.link_name' => 'ASC'), true);
                $id_link = $this->Misc->decode_id($_POST['item']);
                $row = $this->links_model->getFields($id_link);
                if ($row) {
                    $this->load->view(admin_dir('menu/extra/popupform_link'), array('edit' => 1, 'row' => $row, 'redirect' => $redirect, 'parent_link' => $parent_link, 'id_user_type' => $id_user_type));
                }
            } else if ($_POST['type'] == 3) { /* Copy Form */
                $user_types = $this->user_types_model->getSearch("", "", array('user_type' => 'ASC'), true);
                $this->load->view(admin_dir('menu/extra/popupform_link'), array('copy' => 1, 'redirect' => $redirect, 'user_types' => $user_types));
            }
        }
    }

}
