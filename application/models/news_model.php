<?php defined('BASEPATH') OR exit('No direct script access allowed');


/*

When working with this file you will be working with the following files also

application/model/news_model.php
application/config/routes.php 
application/views/dashboard
application/controllers/news.php

good idea to have the above open while you are coding 


*/

class News_model extends CI_Model
{

    // check out this link for db querying in codeigniter
    // http://ellislab.com/codeigniter/user-guide/database/active_record.html

    function get_all_news()
    {
        //declare what we want to select 
        $this->db->select('id, news_title, news_content, created_at');
        $this->db->order_by('id', 'desc');
        //from which table and assign a variable
        $query = $this->db->get_where('news');

        //return the query in a array
        return $query->result_array();
    }

    function get_news($id) 
    {
        $query = $this->db->get_where('news', array('id' => $id));        
        return $query->row_array();
    }

    function update_news($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('news', $data);
    }


    function delete_news($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('news');
    }

    function add_news($data)
    {
        $this->db->insert('news', $data);
        $id = $this->db->insert_id();
        return (isset($id)) ? $id : FALSE;
    }



}