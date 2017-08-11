<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
  |--------------------------------------------------------------------------
  | Notifications Model Class
  |--------------------------------------------------------------------------
  |
  | Handles the Notifications records
  |
  | @category		Model
  | @author		melin
 */

class Notifications_Model extends MY_Model {
    /* int primary key   */

    public $id_notification;

    /* int reference id  */
    public $class_id;

    /* int reference id  */
    public $reference_id;

    /* int user id  */
    public $user_id;

    /* int link  */
    public $link;

    /* varchar(32) item name  */
    public $status;

    /* tinyint(1) item specification  */
    public $todo;

    /* tinyint(1) item specification  */
    public $seen;

    /* tinyint(1) item specification  */
    public $done;

    /* date date updated */
    public $seen_date;

    /* string table name */
    protected $table = 'default_notifications';

    /* string table identifier */
    protected $identifier = 'id_notification';

    // ------------------------------------------------------------------------

    /*
     * Constructor
     *
     * Called automatically
     * Inherits method from the parent class
     */
    function __construct($id = '') {
        parent::__construct($id);
    }

    // ------------------------------------------------------------------------

    /*
     * Get values from object
     *
     * @access 		public
     * @return		array
     */
    public function getObjectFields() {
        if (isset($this->id))
            $fields['id_notification'] = (int) $this->misc->decode_id($this->id);
        $fields['class_id'] = (int) $this->class_id;
        $fields['reference_id'] = (int) $this->reference_id;
        $fields['user_id'] = (int) $this->user_id;
        $fields['link'] = ($this->link);
        $fields['status'] = $this->status;

        return $fields;
    }

    function getFields($id) {
        self::_select();
        self::_from();
        self::_join();
        self::_fix_arg();
        parent::where(array('n.id_notification' => $id));
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row();
        }

        return false;
    }

    function getValue($id, $select, $return = '') {
        $this->db->select($select);
        self::_from();
        self::_join();
        self::_fix_arg();
        parent::where(array('n.id_notification' => $id));
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $row = $query->row();
            if ($return) {
                return (!empty($row->{$return})) ? $row->{$return} : false;
            }
            return (!empty($row->{$select})) ? $row->{$select} : false;
        }
        return false;
    }

    function getSearch($where = array(), $group_by = array(), $order_by = array(), $result = FALSE, $count = FALSE, $row = FALSE) {
        self::_select();
        self::_from();
        self::_join();
        self::_fix_arg();
        parent::where($where);
        parent::group_by($group_by);
        parent::orderby($order_by);
        $query = $this->db->get();

        if ($result) {
            return $query->result();
        }

        if ($count) {
            return $query->num_rows();
        }

        if ($row) {
            if ($query->num_rows() > 0)
                return $query->row();
            return false;
        }

        return $query;
    }

    function getList($where = array(), $where_string = '', $order_by = array()) {
        self::_select();
        self::_from();
        self::_join();
        self::_fix_arg();
        if ((int) $this->session->userdata['admin']['user_type_id'] != 1) {
            parent::where($where);
        }
        parent::where_string($where_string);
        // parent::group_by("n.id_notification");
        $this->db->order_by('id_notification', 'ASC');
        parent::orderby($order_by);
        return $query = $this->db->get();
    }

    function getListLimit($where, $where_string, $order_by, $page, $number) {
        self::_select();
        self::_from();
        self::_join();
        self::_fix_arg();
        parent::where($where);
        parent::where_string($where_string);
        // parent::group_by("n.id_notification");
        parent::orderby($order_by);
        parent::pagelimit($page, $number);
        return $query = $this->db->get();
    }

    /*
     * From
     * @return void
     */

    private function _from() {
        $this->db->from("default_notifications n");
    }

    /*
     * SELECT
     * @return void
     */

    private function _select() {
        $this->db->select("
			n.*,
                        dc.class_name,dc.class_title
		");
    }

    /*
     * JOIN
     * @return void
     */

    private function _join() {
        $this->db->join('default_classes dc', 'dc.id_class = n.class_id', 'left');
        $this->db->join('default_users du', 'du.id_user = n.user_id', 'left');
    }

    /*
     * Fix Argument
     * @return void
     */

    private function _fix_arg() {
        $where = array('user_id' => $this->session->userdata['admin']['user_id']);
        if ((int) $this->session->userdata['admin']['user_type_id'] == 1) { //if super admin check all unseen notifications
            $this->db->where('(`todo`=0 AND `seen`= 0)');
            $this->db->or_where('(`todo`=1 AND `seen`=0)');
        } else {
            $this->db->where($where);
        }
    }

}
