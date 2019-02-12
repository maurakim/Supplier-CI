<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Customer_model extends CI_Model
{
    private $_table = "customer";

    public $customer_id;
    public $name;
    public $address;

    public function rules()
    {
        return [
            ['field' => 'customer_id',
            'label' => 'Customer_id',
            'rules' => 'required'],

            ['field' => 'name',
            'label' => 'Name',
            'rules' => 'required'],

            ['field' => 'address',
            'label' => 'Address',
            'rules' => 'required'],

        ];
    }

    public function getAll()
    {
        return $this->db->get($this->_table)->result();
    }
    
    public function getById($customer_id)
    {
        return $this->db->get_where($this->_table, ["customer_id" => $customer_id])->row();
    }

    public function save()
    {
        $post = $this->input->post();
        $this->customer_id = $post['customer_id'];
        $this->name = $post["name"];
        $this->address = $post["address"];
        $this->db->insert($this->_table, $this);
    }

    public function update()
    {
        $post = $this->input->post();
        $this->customer_id = $post['customer_id'];
        $this->name = $post["name"];
        $this->address = $post["address"];
        $this->db->update($this->_table, $this, array('customer_id' => $post['customer_id']));
    }

    public function delete($customer_id)
    {
        return $this->db->delete($this->_table, array("customer_id" => $customer_id));
    }
}
