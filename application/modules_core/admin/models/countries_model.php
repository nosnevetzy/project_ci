<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
  |--------------------------------------------------------------------------
  | Countries Model Class
  |--------------------------------------------------------------------------
  |
  | Handles the Countries records
  |
  | @category		Model
  | @author		melin
 */

class Countries_Model extends MY_Model {
    /* varchar(2) country code  */

    public $ccode;

    /* varchar(200) country name  */
    public $country;

    /* string table name */
    protected $table = 'countries';

    /* string table identifier */
    protected $identifier = 'ccode';

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
            $fields['ccode'] = $this->ccode;
        $fields['country'] = $this->country;

        return $fields;
    }

    function getFields($id) {
        self::_select();
        self::_from();
        self::_join();
        self::_fix_arg();
        parent::where(array('c.ccode' => $id));
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
        parent::where(array('c.ccode' => $id));
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

    function getList($where = array(), $where_string = array(), $order_by = array()) {
        self::_select();
        self::_from();
        self::_join();
        self::_fix_arg();
        parent::where($where);
        parent::where_string($where_string);
        // parent::group_by("c.ccode");
        parent::orderby($order_by);
        return $query = $this->db->get()->result();
    }

    function getListLimit($where, $where_string, $order_by, $page, $number) {
        self::_select();
        self::_from();
        self::_join();
        self::_fix_arg();
        parent::where($where);
        parent::where_string($where_string);
        // parent::group_by("c.ccode");
        parent::orderby($order_by);
        parent::pagelimit($page, $number);
        return $query = $this->db->get();
    }

    /*
     * Update Query
     * @return id
     */

    function update_table($data, $table_col, $key) {
        $this->db->where($table_col, $key);
        $this->db->update("countries c", $data);
        return $key;
    }

    /*
     * From
     * @return void
     */

    private function _from() {
        $this->db->from("countries c");
    }

    /*
     * SELECT
     * @return void
     */

    private function _select() {
        $this->db->select("
			c.*,
		");
    }

    /*
     * JOIN
     * @return void
     */

    private function _join() {
//        $this->db->join('default_user_types ut', 'ut.id_user_type = c.user_type_id', 'left');
    }

    /*
     * Fix Argument
     * @return void
     */

    private function _fix_arg() {
//        $this->db->where(array('c.enabled' => 1));
    }

}
