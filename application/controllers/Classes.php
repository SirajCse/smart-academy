<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Classes extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if (!$this->rbac->hasPrivilege('class', 'can_view')) {
            access_denied();
        }

        $this->session->set_userdata('top_menu', 'Academics');
        $this->session->set_userdata('sub_menu', 'classes/index');

        $data['title']      = 'Add Class';
        $data['title_list'] = 'Class List';

        $this->form_validation->set_rules(
            'class', $this->lang->line('class'), array(
                'required',
                array('class_exists', array($this->class_model, 'class_exists')),
            )
        );

        $this->form_validation->set_rules('code', $this->lang->line('code'), 'trim|xss_clean');
        $this->form_validation->set_rules('sections[]', $this->lang->line('section'), 'trim|required|xss_clean');

        if ($this->form_validation->run() !== false) {
            $class_array = array(
                'class' => $this->input->post('class'),
                'code'  => $this->input->post('code'), // ✅ added code
            );
            $sections = $this->input->post('sections');
            $this->classsection_model->add($class_array, $sections);

            $this->session->set_flashdata(
                'msg',
                '<div class="alert alert-success text-left">' . $this->lang->line('success_message') . '</div>'
            );
            redirect('classes');
        }

        $data['vehiclelist']  = $this->section_model->get();
        $data['vehroutelist'] = $this->classsection_model->getByID();
        $this->load->view('layout/header', $data);
        $this->load->view('class/classList', $data);
        $this->load->view('layout/footer', $data);
    }

    public function delete($id)
    {
        if (!$this->rbac->hasPrivilege('class', 'can_delete')) {
            access_denied();
        }

        $this->class_model->remove($id);

        $student_delete = $this->student_model->getUndefinedStudent();
        if (!empty($student_delete)) {
            $delte_student_array = array();
            foreach ($student_delete as $student_value) {
                $delte_student_array[] = $student_value->id;
            }
            $this->student_model->bulkdelete($delte_student_array);
        }

        redirect('classes');
    }

    public function edit($id)
    {
        if (!$this->rbac->hasPrivilege('class', 'can_edit')) {
            access_denied();
        }

        $this->session->set_userdata('top_menu', 'Academics');
        $this->session->set_userdata('sub_menu', 'classes/index');

        $data['title'] = 'Edit Class';
        $data['id'] = $id;

        // Get the class info along with its sections
        $vehroute = $this->classsection_model->getByID($id); // returns single object
        if (!$vehroute) {
            show_404();
        }

        $data['vehroute'] = $vehroute;

        // For listing all classes in the table
        $data['vehroutelist'] = $this->classsection_model->getAll(); // <-- you need a getAll method

        // For checkboxes (sections)
        $data['vehiclelist'] = $this->section_model->get();

        $this->form_validation->set_rules('class', $this->lang->line('class'), 'required');
        $this->form_validation->set_rules('code', $this->lang->line('code'), 'trim');
        $this->form_validation->set_rules('sections[]', $this->lang->line('sections'), 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('layout/header', $data);
            $this->load->view('class/classEdit', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $class_array = array(
                'id' => $id,
                'class' => $this->input->post('class'),
                'code' => $this->input->post('code')
            );
            $sections = $this->input->post('sections');
            $this->classsection_model->update($class_array, $sections);

            $this->session->set_flashdata('msg', '<div class="alert alert-success">' . $this->lang->line('update_message') . '</div>');
            redirect('classes/index');
        }
    }

    public function get_section($id)
    {
        $data['sections'] = $this->class_model->get_section($id);
        $this->load->view('class/_section_list', $data);
    }
}
