<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Supplier_model extends CI_Model
{
    private $_table = "supplier";

    public $supplier_id;
    public $supplier_name;
    public $supplier_address;

    public function rules()
    {
        return [
            ['field' => 'supplier_id',
            'label' => 'Supplier_id',
            'rules' => 'required'],

            ['field' => 'supplier_name',
            'label' => 'Name',
            'rules' => 'required'],

            ['field' => 'aupplier_address',
            'label' => 'Address',
            'rules' => 'required'],

        ];
    }

    public function getAll()
    {
        return $this->db->get($this->_table)->result();
    }
    
    public function getById($supplier_id)
    {
        return $this->db->get_where($this->_table, ["supplier_id" => $supplier_id])->row();
    }

    public function save()
    {
        $post = $this->input->post();
        $this->supplier_id = $post['supplier_id'];
        $this->supplier_name = $post["name"];
        $this->supplier_address = $post["address"];
        $this->db->insert($this->_table, $this);
    }

    public function update()
    {
        $post = $this->input->post();
        $this->supplier_id = $post['supplier_id'];
        $this->supplier_name = $post["name"];
        $this->supplier_address = $post["address"];
        $this->db->update($this->_table, $this, array('supplier_id' => $post['supplier_id']));
    }

    public function delete($supplier_id)
    {
        return $this->db->delete($this->_table, array("supplier_id" => $supplier_id));
    }
}
