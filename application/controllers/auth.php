<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	//The fully extended and cleaned up ionAuth
	//By @jackthedev

	//log the user in
    function login()
    {
        
        $this->data['title'] = "Login";

        //validate form input
        $this->form_validation->set_rules('identity', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == true)
        {
            //check to see if the user is logging in
            //check for "remember me"
            $remember = (bool) $this->input->post('remember');

            if ($this->ion_auth->login($this->input->post('identity'), $this->input->post('password'), $remember))
            {
                //if the login is successful
                //redirect them to the admin panel
                $this->session->set_flashdata('message', $this->ion_auth->messages());
                redirect('dashboard', 'refresh');
            }
            else
            {
                //if the login was un-successful
                //redirect them back to the login page
                $this->session->set_flashdata('message', $this->ion_auth->errors());
                redirect('login', 'refresh'); //use redirects instead of loading views for compatibility with MY_Controller libraries
            }
        }
        else
        {
            //the user is not logging in so display the login page
            //set the flash data error message if there is one
            if (validation_errors())
            {
                $this->data['message'] = "<p>Check the form for errors</p>";
            }
            if($this->session->flashdata('message'))
            {
                $this->data['message'] = $this->session->flashdata('message');
            }

            $this->data['identity'] = array(
            	'name' => 'identity',
                'id' => 'identity',
                'type' => 'text',
                'value' => $this->form_validation->set_value('identity'),
                'class' => 'form-control',
                'placeholder' => 'Email',
            );
            
            $this->data['password'] = array(
            	'name' => 'password',
                'id' => 'password',
                'type' => 'password',
                'class' => 'form-control',
                'placeholder' => 'Password',
            );

            //Load view into body array           
            $this->data['body'] = "auth/login"; 
            //Load template view
            $this->load->view('auth/layout/template', $this->data);
        }
    }

	//log the user out
	function logout()
	{
		//log the user out
		$logout = $this->ion_auth->logout();

		//redirect them to the login page
		$this->session->set_flashdata('message', "Logout was successful");
		redirect('login');
	}

	//change password
	function change_password()
	{
		$this->data['title'] = 'Change Password';

		$this->form_validation->set_rules('old', 'Old Password', 'required');
		$this->form_validation->set_rules('new', 'New Password', 'required|min_length[6]|matches[new_confirm]');
		$this->form_validation->set_rules('new_confirm', 'Confirm New Password', 'required');

		if (!$this->ion_auth->logged_in())
		{
			redirect('login', 'refresh');
		}

		$user = $this->ion_auth->user()->row();

		if ($this->form_validation->run() == false)
		{
			//display the form
			//set the flash data error message if there is one
			if (validation_errors())
            {
                $this->data['message'] = "<p>Check the form for errors</p>";
            }
            else
            {
                $this->data['message'] = $this->session->flashdata('message');
            }

			$this->data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
			$this->data['old_password'] = array(
				'name' => 'old',
				'id'   => 'old',
				'type' => 'password',
				'class' => 'form-control',
			);
			$this->data['new_password'] = array(
				'name' => 'new',
				'id'   => 'new',
				'type' => 'password',
				'pattern' => '^.{'.$this->data['min_password_length'].'}.*$',
			    'class' => 'form-control',
			);
			$this->data['new_password_confirm'] = array(
				'name' => 'new_confirm',
				'id'   => 'new_confirm',
				'type' => 'password',
				'pattern' => '^.{'.$this->data['min_password_length'].'}.*$',
				'class' => 'form-control',
			);
			$this->data['user_id'] = array(
				'name'  => 'user_id',
				'id'    => 'user_id',
				'type'  => 'hidden',
				'value' => $user->id,

			);

			//render
			$this->data['body'] = 'dashboard/change_password';
			$this->load->view('dashboard/layout/template', $this->data);
		}
		else
		{
			$identity = $this->session->userdata($this->config->item('identity', 'ion_auth'));

			$change = $this->ion_auth->change_password($identity, $this->input->post('old'), $this->input->post('new'));

			if ($change)
			{
				//if the password was successfully changed
				$this->session->set_flashdata('message', 'Your password was successfully changed.');
				redirect('settings/change-password', 'refresh');
			}
			else
			{
				$this->session->set_flashdata('message', '<p>Unable to change your password, please try again.</p>');
				redirect('settings/change-password', 'refresh');
			}
		}
	}

	//forgot password
	function forgot_password()
	{
        //Set page title   
        $this->data['title'] = 'Forgot Password';
     
		$this->form_validation->set_rules('email', 'Email', 'required');
		
		if ($this->form_validation->run() == false)
		{
			//setup the input
			$this->data['email'] = array(
				'name' => 'email',
				'id' => 'email', 
				'class' => 'form-control', 
				'placeholder' => 'Email Address',
			);

			if ( $this->config->item('identity', 'ion_auth') == 'username' )
			{
				$this->data['identity_label'] = 'Username';
			}
			else
			{
				$this->data['identity_label'] = 'Email Address';
			}

			//set any errors and display the form
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
            
            //store forget password view in body variable
			$this->data['body'] = "auth/forgot_password"; 
			//load template file
			$this->load->view('auth/layout/template', $this->data);
		}
		else
		{
			// get identity for that email
            $identity = $this->ion_auth->where('email', strtolower($this->input->post('email')))->users()->row();
            if(empty($identity)) {
                $this->ion_auth->set_message('forgot_password_email_not_found');
                $this->session->set_flashdata('message', $this->ion_auth->messages());
                redirect("forgot-password", 'refresh');
            }
            
			//run the forgotten password method to email an activation code to the user
			$forgotten = $this->ion_auth->forgotten_password($identity->{$this->config->item('identity', 'ion_auth')});

			if ($forgotten)
			{
				//if there were no errors
				$this->session->set_flashdata('message', 'Password reset email sent, please check your email.');
				redirect("forgot-password", 'refresh'); //we should display a confirmation page here instead of the login page
			}
			else
			{
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect("forgot-password", 'refresh');
			}
		}
	}

	//reset password - final step for forgotten password
	public function reset_password($code = NULL)
	{
	
        //set the page title
		$this->data['title'] = "Reset Password";

		if (!$code)
		{
			show_404();
		}

		$user = $this->ion_auth->forgotten_password_check($code);

		if ($user)
		{
			
			//if the code is valid then display the password reset form
			$this->form_validation->set_rules('new', 'New Password', 'required|min_length[6]|matches[new_confirm]');
			$this->form_validation->set_rules('new_confirm', ' Confirm New Password', 'required');

			if ($this->form_validation->run() == false)
			{
				
				//display the form
			    //set the flash data error message if there is one
			    if (validation_errors())
                {
                    $this->data['message'] = "<p>Check the form for errors</p>";
                }
                else
                {
                    $this->data['message'] = $this->session->flashdata('message');
                }


				$this->data['new_password'] = array(
					'name' => 'new',
					'id'   => 'new',
				    'type' => 'password',
					'pattern' => '^.{6}.*$',
					'class' => 'form-control',
				);
				$this->data['new_password_confirm'] = array(
					'name' => 'new_confirm',
					'id'   => 'new_confirm',
					'type' => 'password',
					'pattern' => '^.{6}.*$',
					'class' => 'form-control',
				);
				$this->data['user_id'] = array(
					'name'  => 'user_id',
					'id'    => 'user_id',
					'type'  => 'hidden',
					'value' => $user->id,

				);
				
				$this->data['code'] = $code;

				//store reset pass view in body variable
				$this->data['body'] = 'auth/reset_password';
                //load template file
				$this->load->view('auth/layout/template', $this->data);
			}
			else
			{
				// do we have a valid request?
				if ( $user->id != $this->input->post('user_id'))
				{
					//something fishy might be up
					$this->ion_auth->clear_forgotten_password_code($code);
				}
				else
				{
					// finally change the password
					$identity = $user->{$this->config->item('identity', 'ion_auth')};

					$change = $this->ion_auth->reset_password($identity, $this->input->post('new'));

                    if ($change)
                    {
                        //if the password was successfully changed
                        $this->session->set_flashdata('message', 'Password successfully changed');
                        redirect('login','refresh');
                    }
                    else
                    {
                        $this->session->set_flashdata('message', $this->ion_auth->errors());
                        redirect('reset-password/' . $code, 'refresh');
                    }
				}
			}
		}
		else
		{
			//if the code is invalid then send them back to the forgot password page
			$this->session->set_flashdata('message', $this->ion_auth->errors());
			redirect("auth/forgot_password", 'refresh');
		}
	}

	//create a new user
	function create_user()
	{
		//set page title
		$this->data['title'] = "Register";


		//validate form input
		$this->form_validation->set_rules('first_name', 'First Name', 'required|xss_clean');
		$this->form_validation->set_rules('last_name', 'Last Name', 'required|xss_clean');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]|matches[password_confirm]');
		$this->form_validation->set_rules('password_confirm', 'Password Confirm', 'required');

		if ($this->form_validation->run() == true)
		{
			$username = ucfirst($this->input->post('first_name')) . ' ' . ucfirst($this->input->post('last_name'));
			$email    = strtolower($this->input->post('email'));
			$password = $this->input->post('password');

			$additional_data = array(
				'first_name' => ucfirst($this->input->post('first_name')),
				'last_name'  => ucfirst($this->input->post('last_name')),
			);
		}
		if ($this->form_validation->run() == true && $this->ion_auth->register($username, $password, $email, $additional_data))
		{
			//check to see if we are creating the user
			//redirect them back to the admin page
			$this->session->set_flashdata('message', 'Registration successful, please login below!');
			redirect("login", 'refresh');
		}
		else
		{
			//display the create user form
			//set the flash data error message if there is one
			if (validation_errors())
            {
                $this->data['message'] = "<p>Check the form for errors</p>";
            }
            else
            {
                $this->data['message'] = $this->session->flashdata('message');
            }

			$this->data['first_name'] = array(
				'name'  => 'first_name',
				'id'    => 'first_name',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('first_name'),
				'class' => 'form-control',
			);
			$this->data['last_name'] = array(
				'name'  => 'last_name',
				'id'    => 'last_name',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('last_name'),
				'class' => 'form-control',
			);
			$this->data['email'] = array(
				'name'  => 'email',
				'id'    => 'email',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('email'),
				'class' => 'form-control',
			);

			$this->data['password'] = array(
				'name'  => 'password',
				'id'    => 'password',
				'type'  => 'password',
				'value' => $this->form_validation->set_value('password'),
				'class' => 'form-control',
			);
			$this->data['password_confirm'] = array(
				'name'  => 'password_confirm',
				'id'    => 'password_confirm',
				'type'  => 'password',
				'value' => $this->form_validation->set_value('password_confirm'),
				'class' => 'form-control',
			);
            
            //store create user view into body array
			$this->data['body'] = 'auth/create_user';
			//load template file
			$this->load->view('auth/layout/template', $this->data);
		}
	}

	//edit a user
	function edit_user($id)
	{
		//set page title
		$this->data['title'] = "Edit User";

        //check if user is logged in and admin
		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
		{
			redirect('dashboard', 'refresh');
		}

		$user = $this->ion_auth->user($id)->row();
		$groups  =$this->ion_auth->groups()->result_array();
		$currentGroups = $this->ion_auth->get_users_groups($id)->result();

		//validate form input
		$this->form_validation->set_rules('first_name', 'First Name', 'required|xss_clean');
		$this->form_validation->set_rules('last_name', 'Last Name', 'required|xss_clean');
		$this->form_validation->set_rules('email', 'Email', 'required|xss_clean');
		$this->form_validation->set_rules('groups', 'Groups', 'xss_clean');

		if (isset($_POST) && !empty($_POST))
		{

			$data = array(
				'first_name' => ucfirst($this->input->post('first_name')),
				'last_name'  => ucfirst($this->input->post('last_name')),
				'email'  => $this->input->post('email'),
			);

			//Update the groups user belongs to
			$groupData = $this->input->post('groups');

			if (isset($groupData) && !empty($groupData)) {

				$this->ion_auth->remove_from_group('', $id);

				foreach ($groupData as $grp) {
					$this->ion_auth->add_to_group($grp, $id);
				}

			}

			//update the password if it was posted
			if ($this->input->post('password'))
			{
				$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]|matches[password_confirm]');
				$this->form_validation->set_rules('password_confirm', 'Confirm Password', 'required');

				$data['password'] = $this->input->post('password');
			}

			if ($this->form_validation->run() === TRUE)
			{
				$this->ion_auth->update($user->id, $data);

				//check to see if we are creating the user
				//redirect them back to the admin page
				$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><strong>Yippee!</strong><p>User successfully updated!</p></div>');
				redirect("admin/users", 'refresh');
			}
		}

		//set the flash data error message if there is one
		if (validation_errors())
        {
            $this->data['message'] = "<p>Check the form for errors</p>";
        }
        else
        {
            $this->data['message'] = $this->session->flashdata('message');
        }

		//pass the user to the view
		$this->data['user'] = $user;
		$this->data['groups'] = $groups;
		$this->data['currentGroups'] = $currentGroups;

		$this->data['first_name'] = array(
			'name'  => 'first_name',
			'id'    => 'first_name',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('first_name', $user->first_name),
			'class' => 'form-control',
		);
		$this->data['last_name'] = array(
			'name'  => 'last_name',
			'id'    => 'last_name',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('last_name', $user->last_name),
			'class' => 'form-control',
		);
		$this->data['email'] = array(
			'name'  => 'email',
			'id'    => 'email',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('email', $user->email),
			'class' => 'form-control',
		);
		$this->data['password'] = array(
			'name' => 'password',
			'id'   => 'password',
			'type' => 'password',
			'class' => 'form-control',
		);
		$this->data['password_confirm'] = array(
			'name' => 'password_confirm',
			'id'   => 'password_confirm',
			'type' => 'password',
			'class' => 'form-control',
		);

        //store edit user view into body variable
        $this->data['body'] = 'admin/edit_user';
        //load template view
		$this->load->view('dashboard/layout/template', $this->data);
	}


	function user_management()
	{
        //set page title
		$this->data['title'] = 'User Management';

		if (!$this->ion_auth->logged_in())
		{
			//redirect them to the login page
			redirect('login', 'refresh');
		}
		elseif (!$this->ion_auth->is_admin()) //remove this elseif if you want to enable this for non-admins
		{
			redirect('dashboard', 'refresh');
		}
		else
		{
			//set the flash data error message if there is one
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			//list the users
			$this->data['users'] = $this->ion_auth->users()->result();


			foreach ($this->data['users'] as $k => $user)
			{
				$this->data['users'][$k]->groups = $this->ion_auth->get_users_groups($user->id)->result();
			}

            //store user_management view into variable
			$this->data['body'] = 'admin/user_management';
			//load template view
			$this->load->view('dashboard/layout/template', $this->data);
		}
	}

	function delete_user($id)
	{
        //dont want non-admins deleting people by mistake or thinking they are hax0rz!
	    if (!$this->ion_auth->is_admin()) 
		{
			redirect('dashboard');
		}

        //root admin can never be deleted.
        //if id equals 1 (which is root) redirect with message
		if($id == 1)
		{
			$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><strong>Something went wrong!</strong><p>You cant delete the root admin.</p></div>');
			redirect('admin/users');
		}
        
        //if all is good delete the user
		$this->ion_auth->delete_user($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><strong>Yippee!</strong><p>User successfully deleted.</p></div>');
        redirect('admin/users');
	
	}



}
