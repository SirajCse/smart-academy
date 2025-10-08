<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Classsection_model extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->current_session = $this->setting_model->getCurrentSession();
    }

    // Get sections of a class
    public function get($classid = null)
    {
        $this->db->select('class_sections.id,class_sections.section_id,sections.section');
        $this->db->from('class_sections');
        $this->db->join('sections', 'sections.id = class_sections.section_id');
        $this->db->where('class_sections.class_id', $classid);
        $this->db->order_by('class_sections.id');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function update($data)
    {
        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            $this->db->update('classes', $data);
        }
    }

    public function add($data, $sections)
    {
        $this->db->trans_start();
        $this->db->trans_strict(false);

        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            $this->db->update('classes', $data);
            $class_id = $data['id'];
        } else {
            $this->db->insert('classes', $data);
            $class_id = $this->db->insert_id();
        }

        $sections_array = [];
        foreach ($sections as $sec) {
            $sections_array[] = [
                'class_id'   => $class_id,
                'section_id' => $sec,
            ];
        }
        if (!empty($sections_array)) {
            $this->db->insert_batch('class_sections', $sections_array);
        }

        $this->db->trans_complete();
        return $this->db->trans_status();
    }

    // Get a single class with sections
    public function getByID($id = null)
    {
        $this->db->select('classes.*')->from('classes');
        if ($id) {
            $this->db->where('classes.id', $id);
        } else {
            $this->db->order_by('classes.id', 'DESC');
        }

        $query = $this->db->get();

        if ($id) {
            $class = $query->row(); // Single object
            if ($class) {
                $class->vehicles = $this->getVechileByRoute($class->id);
            }
            return $class;
        } else {
            $classes = $query->result();
            foreach ($classes as $cls) {
                $cls->vehicles = $this->getVechileByRoute($cls->id);
            }
            return $classes;
        }
    }

    public function getAll()
    {
        $this->db->select('classes.id, classes.class, classes.code');
        $this->db->from('classes');
        $this->db->order_by('classes.id', 'DESC');
        $query = $this->db->get();
        $classes = $query->result();

        // Attach sections to each class
        foreach ($classes as $class) {
            $this->db->select('sections.id, sections.section');
            $this->db->from('class_sections'); // table linking classes to sections
            $this->db->join('sections', 'sections.id = class_sections.section_id', 'left');
            $this->db->where('class_sections.class_id', $class->id);
            $class->vehicles = $this->db->get()->result();
        }

        return $classes;
    }


    public function getVechileByRoute($class_id)
    {
        $this->db->select('class_sections.id,class_sections.class_id,class_sections.section_id,sections.section')
            ->from('class_sections')
            ->join('sections', 'sections.id = class_sections.section_id')
            ->where('class_sections.class_id', $class_id)
            ->order_by('class_sections.id', 'ASC');

        $query = $this->db->get();
        return $query->result();
    }

    public function remove($class_id, $array)
    {
        $this->db->where('class_id', $class_id);
        $this->db->where_in('section_id', $array);
        $this->db->delete('class_sections');
    }
}
