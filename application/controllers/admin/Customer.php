<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("customer_model");
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data["customer"] = $this->customer_model->getAll();
        $this->load->view("admin/customer/list", $data);
    }

    public function add()
    {
        $customer = $this->customer_model;
        $validation = $this->form_validation;
        $validation->set_rules($customer->rules());

        if ($validation->run()) {
            $customer->save();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
            $this->load->view("admin/customer");
        }

        $this->load->view("admin/customer/new_form");
    }

    public function edit($customer_id = null)
    {
        if (!isset($customer_id)) redirect('admin/customer');
       
        $customer = $this->customer_model;
        $validation = $this->form_validation;
        $validation->set_rules($customer->rules());

        if ($validation->run()) {
            $customer->update();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
            redirect('admin/customer');
        }

        $data["customer"] = $customer->getById($customer_id);
        if (!$data["customer"]) show_404();
        
        $this->load->view("admin/customer/edit_form", $data);
    }

    public function delete($customer_id=null)
    {
        if (!isset($customer_id)) show_404();
        
        if ($this->customer_model->delete($customer_id)) {
            redirect(site_url('admin/customer'));
        }
    }
}
