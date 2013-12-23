<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*

When working with this file you will be working with the following files also

application/model/news_model.php
application/config/routes.php 
application/views/dashboard
application/controllers/dash.php

good idea to have the above open while you are coding 


*/


class News extends CI_Controller {

    function __construct()
    {
        parent::__construct();

        //check if the user is logged in    
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('login', 'refresh');
        }

        //grab the users info 
        $this->data['user'] = $this->ion_auth->user()->row();
        //load the model
        $this->load->model('news_model');           
    }

    function index()
    {
        //set the page title
        $this->data['title'] = 'News';
       
        //grab all the news from the get_all_news function in the model
        $this->data['news'] = $this->news_model->get_all_news();

        //store the view location in an array
        $this->data['body'] = 'dashboard/news';

        //load the view with our data 
        $this->load->view('dashboard/layout/template', $this->data);
    }

   /*
    * Below are the news administrative functions
    *
    */

    function news_management()
    {
        $this->data['title'] = 'News Management';

        //check if user is admin
        if (!$this->ion_auth->is_admin()) 
        {
            redirect('dashboard');
        } 

        //set the flash data error message if there is one
        $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

        //grab all news from the model
        $this->data['news'] = $this->news_model->get_all_news();
            
        //load the view into body array
        $this->data['body'] = 'admin/news_management';
        $this->load->view('dashboard/layout/template', $this->data);

    }

    function add_news()
    {

        //dont want memebers accessing this function
        //if they are not a an admin redirect them
        if (!$this->ion_auth->is_admin()) 
        {
            redirect('dashboard');
        }

        $this->data['title'] = 'Add News';        

        //set validation rules for the add news form 
        $this->form_validation->set_rules('news_title', 'Title', 'required|xss_clean');
        $this->form_validation->set_rules('news_content', 'Description', 'required|xss_clean');

        $datestring = "%Y-%m-%d"; //get the date

        if ($this->form_validation->run() == true)
        {                
            $data = array(
                'news_title'        => $this->input->post('news_title'),
                'news_content'      => $this->input->post('news_content'),
                'created_at'    => mdate($datestring) //insert date

            );
                        
            // insert the new data
            $this->news_model->add_news($data);

            //set flash data success message and redirect
            $this->session->set_flashdata('message', '<div class="alert alert-success"><a class="close" href="#" data-dismiss="alert">×</a><h4><i class="icon-ok-sign"></i> Yippee!</h4>News saved successfully!</div>');
            redirect('admin/news');
                    
        }
        //if the news post couldnt be added we need to show the form with some errors
        //or obviously the form hasnt been submitted yet
        else
        {
            //if there is some validation errors lets show a message on the form
            if (validation_errors())
            {
                $this->data['message'] = "<p>Check the form for errors</p>";
            }
            else
            {
                $this->data['message'] = $this->session->flashdata('message');
            }
            

            $this->data['news_title'] = array(
                'name'      => 'news_title',
                'type'      => 'text',
                'class'     => 'form-control',
                'value'     => $this->form_validation->set_value('news_title'),
            );

            $this->data['news_content'] = array(
                'name'      => 'news_content',
                'type'      => 'text',
                'class'     => 'form-control',
                'value'     => $this->form_validation->set_value('news_content'),
            );       
            
            //load the view in an array
            $this->data['body'] = 'admin/add_news';
            //load the template
            $this->load->view('dashboard/layout/template', $this->data);
        }
    }

    function edit_news($id)
    {
        //dont want memebers accessing this function
        //if they are not a an admin redirect them
        if (!$this->ion_auth->is_admin()) 
        {
            redirect('dashboard');
        }

        $this->data['title'] = 'Edit News';

        //get said news post and store into a variable
        $news_post = $this->news_model->get_news($id);

        //set rules for form validation - bare minimum 
        $this->form_validation->set_rules('news_title', 'News Title', 'required|xss_clean');
        $this->form_validation->set_rules('news_content', 'News Content', 'required|xss_clean');

        if (isset($_POST) && !empty($_POST))
        {   
            //grab the data submitted in an array    
            $data = array(
                'news_title' => $this->input->post('news_title'),
                'news_content' => $this->input->post('news_content')
            );

            //if form validation returns true we can update the database
            if ($this->form_validation->run() === true)
            {
                $this->news_model->update_news($id, $data);

                $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><strong>Yippee!</strong><p>News post successfully updated</p></div>');
                redirect('admin/news');
            }           
        }


        //if there is some validation errors lets show a message on the form
        if (validation_errors())
        {
            $this->data['message'] = "<p>Check the form for errors</p>";
        }
        else
        {
            $this->data['message'] = $this->session->flashdata('message');
        }


        //set some data for the form, just like you would with basic html/php
        $this->data['news_title'] = array(
            'name'      => 'news_title',
            'type'      => 'text',
            'class'     => 'form-control',
            'value'     => $this->form_validation->set_value('news_title', $news_post['news_title']),
        );

        $this->data['news_content'] = array(
            'name'      => 'news_content',
            'type'      => 'text',
            'class'     => 'form-control',
            'value'     => $this->form_validation->set_value('news_content', $news_post['news_content']),
        );       

        //store the view location in an array
        $this->data['body'] = 'admin/edit_news';
        //load the view with our data 
        $this->load->view('dashboard/layout/template', $this->data);
    }

    function delete_news($id)
    {

        //dont want memebers accessing this function
        //if they are not a an admin redirect them
        if (!$this->ion_auth->is_admin()) 
        {
            redirect('dashboard');
        }
        
        //delete the snippet
        $this->news_model->delete_news($id);

        //set message and redirect
        $this->session->set_flashdata('message', '<div class="alert alert-success"><a class="close" href="#" data-dismiss="alert">×</a><h4><i class="icon-ok-sign"></i> Yippee!</h4>News post deleted successfully!</div>');
        redirect('admin/news');

    }
}