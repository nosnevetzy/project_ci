<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
  |--------------------------------------------------------------------------
  | Notifications Class
  |--------------------------------------------------------------------------
  |
  | Handles the Notifications panel
  |
  | @category		Controller
  | @author		melin
 */

class Notifications extends System_Core {

    public $notifications_model = '';
    public $list_content = array();
    public $contents = array();

    function __construct() {
        $this->classname = strtolower(get_class());
        $this->pagename = $this->uri->rsegment(2);
        $this->methodname = $this->uri->rsegment(3);
        parent:: __construct();

        //id
        $this->id = $this->Misc->decode_id($this->uri->rsegment(3));

        //initiate models
        $this->notifications_model = new Notifications_Model();
        $this->list_content = array(
            'id' => array(
                'label' => 'ID',
                'type' => 'text',
                'type-class' => 'col-lg-12 uniform-input',
                'class' => 'col-lg-1',
                'var-value' => 'id_item_brand',
            ),
            'class_title' => array(
                'label' => 'Notification Name',
                'type' => 'text',
                'type-class' => 'col-lg-12 uniform-input',
                'class' => 'col-lg-4',
                'var-value' => 'class_title',
            ),
            'status' => array(
                'label' => 'Notification Code',
                'type' => 'text',
                'type-class' => 'col-lg-12 uniform-input',
                'class' => 'col-lg-3',
                'var-value' => 'status',
            ),
        );
    }

    function index() {
        
    }

    /* ------------------------------------------------------------------------------------------------------------------------------------------- */
    /* ------------------------------- Page Function --------------------------------------------------------------------------------------------- */
    /* ------------------------------------------------------------------------------------------------------------------------------------------- */

    // --------------------------------------------------------------------

    /*
     * Get Modules Notification Based on User and User Type
     *
     * @access		public
     * @return		void
     */
    function modules_notification() {
        $this->notifications_model = new Notifications_Model();
        $_where1 = array(
            'user_id' => $this->session->userdata['admin']['user_id'],
            'seen' => 0,
            'todo' => 0
        );
        $_where2 = array(
            'user_id' => $this->session->userdata['admin']['user_id'],
            'seen' => 0,
            'todo' => 1
        );

        $notifications1 = $this->notifications_model->getList($_where1)->result();
        $notifications = array_merge($this->notifications_model->getList($_where2)->result(), $notifications1);
        
        $this->load->view(admin_dir('template/notifications'), array('notifications' => $notifications));
    }

    // --------------------------------------------------------------------

    /*
     * Get Modules Notification Based on User and User Type
     *
     * @access		public
     * @return		void
     */
    function count_notifications() {
        $this->notifications_model = new Notifications_Model();
        $_where1 = array(
            'user_id' => $this->session->userdata['admin']['user_id'],
            'seen' => 0,
            'todo' => 0
        );
        $_where2 = array(
            'user_id' => $this->session->userdata['admin']['user_id'],
            'seen' => 0,
            'todo' => 1
        );
        $notifications1 = $this->notifications_model->getList($_where1)->result();
        $notifications = array_merge($this->notifications_model->getList($_where2)->result(), $notifications1);
        echo count($notifications);
    }

    /* ---------- Notification LIST ------------------------------------------------------------------------------------------------------------------ */
    /*
     * Update Notification to seen
     */

    function _method_update_notification() {
        if (!IS_AJAX) {
            // Set confirmation message
            $this->session->set_flashdata('error', 'Direct access forbidden');
            redirect(admin_url($this->classname));
        }
        $this->db->trans_start();
        $id = $this->tools->getPost('id');
        $notif_model = new Notifications_Model($id);
        $notif_model->update('', array('seen' => 1, 'seen_date' => date('Y-m-d H:i:s')));
        $this->db->trans_complete();

        //return count of remaining notifications
        self::count_notifications();
    }

}
