<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
	
class Assignment extends CI_Model
{
	function __construct()
    {
        parent::__construct();
    }
	
	/**
	 * 通过assignment对象hid获取assignment对象
	 */
	function get_assignment_by_aid($aid, $table = 'assignment')
	{
		$this->db->where('aid', $aid);
		return $this->db->get($table);
	}
	
	/**
     * 添加一次作业,向数据表插入数据 $data 数组或者对象
     * @return bool
     */
    function add_assignment($data, $table = 'assignment') {
        $data['create_date'] = date("Y-m-d");
        if (!$this->db->insert($table, $data))
            return false;
        return true;
    }
	
	
	/**
     *
     * @return 成功则返回true
     */
    function delete_assignment_by_aid($aid, $table = 'assignment') {
        $this->db->where('aid', $aid);
        if (!$this->db->delete($table))
            return false;
        return true;
    }
	
}

?>