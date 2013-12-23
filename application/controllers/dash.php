<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*

When working with this file you will be working with the following files also

application/model/dashboard_model.php
application/config/routes.php 
application/views/dashboard
application/controllers/dash.php

good idea to have the above open while you are coding 


*/


class Dash extends CI_Controller {

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
        $this->load->model('dashboard_model');           
    }

    function index()
    {
        $this->data['title'] = "Home";
        $this->data['body'] = "dashboard/home";

        //passing $this->data as a second parameter when loading the view 
        //will allow us access to anything stored in there on the frontend
        $this->load->view('dashboard/layout/template', $this->data);
    }

}