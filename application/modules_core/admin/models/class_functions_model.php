<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Class_Functions_Model extends MY_Model {
    /* string table name */

    protected $alias = 'cf';

    /* string table name */
    protected $table = 'default_class_functions';

    /* string table identifier */
    protected $identifier = "id_class_function";

    function __construct($id = '') {
        parent:: __construct($id, $this->table, $this->identifier);
    }

    function getFields($id) {
        self::_select();
        self::_from();
        self::_join();
        self::_fix_arg();
        parent::where(array("$this->identifier" => $id));
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
        parent::where(array("$this->alias.$this->identififer" => $id));
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

    /*
     * From
     * @return void
     */

    private function _from() {
        $this->db->from("$this->table $this->alias");
    }

    /*
     * SELECT
     * @return void
     */

    private function _select() {
        $this->db->select("
			$this->alias.*,
			c.id_class, c.class_name, c.class_title,
			au.user_fname as add_user_fname, au.user_mname as add_user_mname, au.user_lname as add_user_lname, au.user_code as add_user_code,au.user_email as add_user_email, au.user_picture as add_user_picture,
			uu.user_fname as update_user_fname, uu.user_mname as update_user_mname, uu.user_lname as update_user_lname, uu.user_code as update_user_code,uu.user_email as update_user_email, uu.user_picture as update_user_picture
		");
    }

    /*
     * JOIN
     * @return void
     */

    private function _join() {
        $this->db->join('default_classes c', 'c.id_class = cf.class_id', 'left');
        $this->db->join('default_users au', 'au.id_user = cf.added_by', 'left');
        $this->db->join('default_users uu', 'uu.id_user = cf.updated_by', 'left');
    }

    /*
     * Fix Argument
     * @return void
     */

    private function _fix_arg() {
        $this->db->where(array("$this->alias.enabled" => 1));
    }

    /*
     * Insert Query
     * @return id
     */

    function insert_table($data) {
        $this->db->insert("$this->table", $data);
        return $this->db->insert_id();
    }

    /*
     * Batch Insert Query
     * @return void
     */

    function insert_batch_table($data) {
        $this->db->insert_batch("$this->table", $data);
    }

    /*
     * Update Query
     * @return void
     */

    function update_table($data, $where) {
        $this->db->where($where);
        $this->db->update("$this->table", $data);
    }

    /*
     * Batch Update Query
     * @return void
     */

    function update_batch_table($data, $table_col) {
        $this->db->update_batch("$this->table", $data, $table_col);
    }

    /*
     * Delete Query
     * @return void
     */

    function delete_table($table_col, $key) {
        $this->db->delete("$this->table", array($table_col => $key));
    }

    /*
     * Custom
     */

    /*
     * User Type Allowed
     */

    function is_user_allowed($user_type_id, $where = array()) {
        $this->db->select("user_access_status");
        self::_from();
        $this->db->join('default_user_accesses ua', "cf.id_class_function = ua.class_function_id and ua.user_type_id='$user_type_id'", 'left');
        self::_fix_arg();
        parent::where($where);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $row = $query->row();
            if ($row->user_access_status == 1) {
                return true;
            } else {
                return false;
            }
        } else {
            return true;
        }
    }

    /*
     * User Type Access
     */

    function allowed_user_accesses($user_type_id) {
        $this->db->select("user_access_status, class_name, class_function_type, class_function_name");
        self::_from();
        $this->db->join('default_user_accesses ua', "cf.id_class_function = ua.class_function_id and ua.user_type_id='$user_type_id'", 'left');
        $this->db->join('default_classes c', "c.id_class = cf.class_id", 'left');
        self::_fix_arg();
        $query = $this->db->get();
        $layer = array();
        foreach ($query->result() as $q) {
            if ($q->user_access_status == 1) {
                $value = 'true';
            } else {
                $value = 'false';
            }
            $layer[$q->class_name][($q->class_function_type == 1) ? 'page' : 'method'][$q->class_function_name] = $value;
        }
        return $layer;
    }

    /*
     * Class Data
     */

    function classes_data($where = array()) {
        $result = self::getSearch($where, '', array('class_function_type' => 'ASC', 'class_function_title' => 'ASC'), true);
        $layer = array();
        foreach ($result as $q) {
            $layer[$q->class_id][$q->class_function_type][$q->id_class_function] = $q;
        }
        return $layer;
    }

}
