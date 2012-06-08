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
	 * ͨ��assignment����hid��ȡassignment����
	 */
	function get_assignment_by_aid($aid, $table = 'assignment')
	{
		$this->db->where('aid', $aid);
		return $this->db->get($table);
	}
	
	/**
     * ���һ����ҵ,�����ݱ�������� $data ������߶���
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
     * @return �ɹ��򷵻�true
     */
    function delete_assignment_by_aid($aid, $table = 'assignment') {
        $this->db->where('aid', $aid);
        if (!$this->db->delete($table))
            return false;
        return true;
    }
	
}

?>