<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('ion_auth');
		
		//$this->output->cache(5);
	}

	# redirect if needed, otherwise display the user list
	function index()
	{

		if ( ! $this->ion_auth->logged_in() )
		{
			# Redirect them to the login page
			redirect('auth/login', 'refresh');
		}
		elseif ( ! $this->ion_auth->is_admin() )
		{
			# Redirect them to the home page because they must be an administrator to view this
			redirect($this->config->item('base_url'), 'refresh');
		}
		else
		{
			//set the flash data error message if there is one
			$this->data['message'] = $this->data['message'] = $this->ion_auth->errors();

			//list the users
			$this->data['users'] = $this->ion_auth->users()->result();
			foreach ($this->data['users'] as $k => $user)
			{
				$this->data['users'][$k]->groups = $this->ion_auth->get_users_groups($user->id)->result();
			}


			$this->load->view('auth/index', $this->data);
		}
	}

	//log the user in
	function login()
	{
		if ( $this->form_validation->run() == TRUE )
		{
			//check to see if the user is logging in
			//check for "remember me"
			$remember = (bool) $this->input->post('remember');
			
			if ($this->ion_auth->login($this->input->post('identity'), $this->input->post('password'), $remember))
			{
				# If the login is successful
				# redirect them back to the home page
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				redirect($this->config->item('base_url'), 'refresh');
			}
			else
			{ //if the login was un-successful
				//redirect them back to the login page
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect('auth/login', 'refresh'); //use redirects instead of loading views for compatibility with MY_Controller libraries
			}
		}
		else
		{  //the user is not logging in so display the login page
			//set the flash data error message if there is one
			$this->data['message'] = $this->data['message'] = $this->ion_auth->errors();
			
			$this->data['identity'] = array('id'		=> 'identity' ,
											'name'		=> 'identity' ,
											
											'class'		=> 'span3' ,
											
											'type'		=> 'text' ,
											
											'title'		=> lang('form_please_fill_in_this_field') ,
											
											'required'	=> '' ,
											'pattern'	=> '^.{7}.*$' ,
											
											'value'		=> $this->form_validation->set_value('identity'),
			);
			$this->data['password'] = array('id'		=> 'password' ,
											'name'		=> 'password' ,
											
											'class'		=> 'span3' ,
											
											'type'		=> 'password' ,
											
											'title'		=> lang('form_please_fill_in_this_field') ,
											
											'required'	=> '' ,
											'pattern'	=> '(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$' ,
			);
			
			$this->load->view('auth/V_auth_login', $this->data);
		}
	}

	//log the user out
	function logout()
	{
		$this->data['title'] = "Logout";

		//log the user out
		$logout = $this->ion_auth->logout();

		//redirect them back to the page they came from
		redirect('auth', 'refresh');
	}

	//change password
	function change_password()
	{		
		if ( ! $this->ion_auth->logged_in() )
		{
			redirect('auth/login', 'refresh');
		}
		
		$user		= $this->ion_auth->user()->row();
		$email		= $this->ion_auth->current_email();
		$identity	= $this->session->userdata($this->config->item('identity', 'ion_auth'));
		
		# Change the password
		$change_password = $this->ion_auth->change_password( $identity , $this->input->post('password_old') , $this->input->post('password_new') );
		
		$this->data['message'] = $this->session->flashdata('message');
		
		$this->data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
		
		# Form fields
		$this->data['form_password']= array('id'			=> 'form_change_password',
											'name'			=> 'form_change_password',
											
											'class'			=> '',
		);
		$this->data['password_old'] = array(
											'name'			=> 'password_old',
											'id'			=> 'password_old',
											
											'type'			=> 'password',
											
											'title'		=> lang('form_please_fill_in_this_field') ,
											
											'required'	=> '' ,
											'pattern'	=> '(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$' ,
		);
		$this->data['password_new'] = array(
											'name'			=> 'password_new',
											'id'			=> 'password_new',
											
											'type'			=> 'password',
											
											'title'		=> lang('form_please_fill_in_this_field') ,
											
											'required'	=> '' ,
											'pattern'	=> '(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$' ,
		);
		$this->data['password_new_confirm'] = array(
											'name'			=> 'password_new_confirm',
											'id'			=> 'password_new_confirm',
											
											'type'			=> 'password',
											
											'title'		=> lang('form_please_fill_in_this_field') ,
											
											'required'	=> '' ,
											'pattern'	=> '(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$' ,
		);
		$this->data['submit']		= array('id'			=> 'users_password_submit',
											'name'			=> 'users_password_submit',
											
											'class'			=> 'btn',
											
											'value'			=> lang('form_password_submit'),
		);
		
		if ( ! $this->form_validation->run('dossier_edit_password') OR
			 ! $change_password )
		{
			# Set the flash data error message if there is one
			if( $_POST )
			{
				$this->data['message'] = $this->ion_auth->errors();
			}
			
			# Error: AJAX Request
			if ( $this->input->is_ajax_request_form() )
			{
				$message = array(
									'email'					=> form_error('email') ,
									'password_old'			=> form_error('password_old') ,
									'password_new'			=> form_error('password_new') ,
									'password_new_confirm'	=> form_error('password_new_confirm') ,
									'password_error'		=> $this->data['message'] ,
								);
				echo json_encode( $message );
			}
			
			# Error: Standart Request
			else
			{
				$this->load->view('auth/V_auth_change_password', $this->data );
			}
		}
		else
		{			
			if ( $change_password )
			{
				# if the password was successfully changed
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				
				$this->logout();
			}
			else
			{
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				
				$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
				
				$this->load->view('auth/V_auth_change_password', $this->data);
			}
		}
	}

	//forgot password
	function forgot_password()
	{
		$this->form_validation->set_rules('email', 'Email Address', 'required');
		if ($this->form_validation->run() == false)
		{
			//setup the input
			$this->data['email'] = array('name' => 'email',
				'id' => 'email',
			);
			//set any errors and display the form
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
			$this->load->view('auth/forgot_password', $this->data);
		}
		else
		{
			//run the forgotten password method to email an activation code to the user
			$forgotten = $this->ion_auth->forgotten_password($this->input->post('email'));

			if ($forgotten)
			{ //if there were no errors
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				redirect("auth/login", 'refresh'); //we should display a confirmation page here instead of the login page
			}
			else
			{
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect("auth/forgot_password", 'refresh');
			}
		}
	}

	//reset password - final step for forgotten password
	public function reset_password($code = NULL)
	{
		if (!$code)
		{
			show_404();
		}

		$user = $this->ion_auth->forgotten_password_check($code);

		if ($user)
		{  //if the code is valid then display the password reset form

			$this->form_validation->set_rules('new', 'New Password', 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
			$this->form_validation->set_rules('new_confirm', 'Confirm New Password', 'required');

			if ($this->form_validation->run() == false)
			{//display the form
				//set the flash data error message if there is one
				$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

				$this->data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
				$this->data['new_password'] = array(
					'name' => 'new',
					'id'   => 'new',
				'type' => 'password',
											
											'title'		=> lang('form_please_fill_in_this_field') ,
					'pattern' => '^.{'.$this->data['min_password_length'].'}.*$',
				);
				$this->data['new_password_confirm'] = array(
					'name' => 'new_confirm',
					'id'   => 'new_confirm',
											
											'required'	=> '' ,
											'pattern'	=> '(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$' ,
					'type' => 'password',
											
											'title'		=> lang('form_please_fill_in_this_field') ,
				);
				$this->data['user_id'] = array(
					'name'  => 'user_id',
					'id'    => 'user_id',
					'type'  => 'hidden',
					'value' => $user->id,
				);
				$this->data['csrf'] = $this->_get_csrf_nonce();
				$this->data['code'] = $code;

				//render
				$this->load->view('auth/reset_password', $this->data);
			}
			else
			{
				// do we have a valid request?
				if ($this->_valid_csrf_nonce() === FALSE || $user->id != $this->input->post('user_id')) {

					//something fishy might be up
					$this->ion_auth->clear_forgotten_password_code($code);

					show_404();

				} else {
					// finally change the password
					$identity = $user->{$this->config->item('identity', 'ion_auth')};

					$change = $this->ion_auth->reset_password($identity, $this->input->post('new'));

					if ($change)
					{ //if the password was successfully changed
						$this->session->set_flashdata('message', $this->ion_auth->messages());
						$this->logout();
					}
					else
					{
						$this->session->set_flashdata('message', $this->ion_auth->errors());
						redirect('auth/reset_password/' . $code, 'refresh');
					}
				}
			}
		}
		else
		{ //if the code is invalid then send them back to the forgot password page
			$this->session->set_flashdata('message', $this->ion_auth->errors());
			redirect("auth/forgot_password", 'refresh');
		}
	}


	//activate the user
	function activate($id, $code=false)
	{
		if ($code !== false)
			$activation = $this->ion_auth->activate($id, $code);
		else if ($this->ion_auth->is_admin())
			$activation = $this->ion_auth->activate($id);

		if ($activation)
		{
			//redirect them to the auth page
			$this->session->set_flashdata('message', $this->ion_auth->messages());
			redirect("auth", 'refresh');
		}
		else
		{
			//redirect them to the forgot password page
			$this->session->set_flashdata('message', $this->ion_auth->errors());
			redirect("auth/forgot_password", 'refresh');
		}
	}

	//deactivate the user
	function deactivate($id = NULL)
	{
		$id = $this->config->item('use_mongodb', 'ion_auth') ? (string) $id : (int) $id;

		$this->load->library('form_validation');
		$this->form_validation->set_rules('confirm', 'confirmation', 'required');
		$this->form_validation->set_rules('id', 'user ID', 'required|alpha_numeric');

		if ($this->form_validation->run() == FALSE)
		{
			// insert csrf check
			$this->data['csrf'] = $this->_get_csrf_nonce();
			$this->data['user'] = $this->ion_auth->user($id)->row();

			$this->load->view('auth/deactivate_user', $this->data);
		}
		else
		{
			// do we really want to deactivate?
			if ($this->input->post('confirm') == 'yes')
			{
				// do we have a valid request?
				if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('id'))
				{
					show_404();
				}

				// do we have the right userlevel?
				if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin())
				{
					$this->ion_auth->deactivate($id);
				}
			}

			//redirect them back to the auth page
			redirect('auth', 'refresh');
		}
	}

	# Create a new user
	function create_user()
	{
		
		if ( $this->ion_auth->logged_in() )
		{
			redirect('/', 'refresh');
		}
		
		//Проверяем, авторизован ли пользователь и включен ли в группу администраторов (функция is_admin).
		//if ( ! $this->ion_auth->logged_in() || ! $this->ion_auth->is_admin() )
		
		//Проверяем, авторизован ли пользователь
		if ( $this->ion_auth->logged_in() )
		{
			redirect('auth', 'refresh');
		}
		
		if ( $this->form_validation->run('dossier_create_user') == TRUE )
		{
			//$username	= strtolower($this->input->post('name')) . ' ' . strtolower($this->input->post('surname'));
			$username	= $this->input->post('name') . ' ' . $this->input->post('surname');
			$email		= $this->input->post('email');
			$password	= $this->input->post('password');
			
			$additional_data = array(	'name'			=> $this->input->post('name'),
										'surname'		=> $this->input->post('surname'),
										'sex'			=> $this->input->post('sex'),
										'age'			=> $this->input->post('age'),
										'city'			=> $this->input->post('city'),
										'country'		=> $this->input->post('country'),
										'socium'		=> $this->input->post('socium'),
			);
		}
		
		# Trying to insert valid data
		if ($this->form_validation->run('dossier_create_user') == TRUE &&
			$this->ion_auth->register( $username , $password , $email , $additional_data ) )
		{
			# check to see if we are creating the user
			# redirect them back to the admin page
			$this->session->set_flashdata('message', "User Created");
			
			//redirect("auth", 'refresh');
			$data['action'] = 'form_dossier_created';
			
			$this->load->view('auth/V_auth_dossier', $data );
		}
		else
		{
			# Get registration form
			$data = $this->form_array( 'dossier_create_user' );
			
			# display the create user form
			# set the flash data error message if there is one
			$data['message'] = $this->ion_auth->errors();
			
			$this->load->view('auth/V_auth_dossier', $data );
		}
	}
	
	
	public function edit()
	{
		$user		= $this->ion_auth->user()->row();
		$user_id	= $user->id;
		
		$this->load->library('form_validation');
		
		# Validation error
		if ( $this->form_validation->run('dossier_edit_user') == FALSE )
		{
			$data['dossier'] = $this->M_user->show_dossier( $user_id );
			
			$data = $this->form_array( 'dossier_edit_user' );
			
			# Validation error: AJAX Request
			if ( $this->input->is_ajax_request_form()  )
			{	
				$dossier = array(
									'name'		=> form_error('name'),
									'surname'	=> form_error('surname'),
									'age'		=> form_error('age'),
									'city'		=> form_error('city'),
									'socium'	=> form_error('socium'),
									
									'male'		=> form_error('male'),
									'female'	=> form_error('female'),
									'female'	=> form_error('sex'),
									
									'country'	=> form_error('country'),
								);
				echo json_encode( $dossier );
			}
			
			# Validation error: Standart Request
			else
			{
				//$this->load->view('V_users_edit_article', $data );
				$this->load->view('auth/V_auth_dossier', $data );
			}
		}
		
		# Validation success
		else
		{
			# Insert dossier
			$edit	= $this->M_user->edit( $this->input->post() );
			
			if( $edit )
			{
				# Validation success: AJAX Request
				if ( $this->input->is_ajax_request_form() )
				{
					$submitted = array(
										'submit'		=> AJAX_good_response( lang('form_dossier_submitted') ) ,
									);
					echo json_encode( $submitted );
				}
				
				# Validation success: Standart Request
				else
				{
					$data['action'] = 'form_dossier_submitted';
					
					$this->load->view('auth/V_auth_dossier', $data );
				}
			}
			else
			{
				
			}
		}
	}
	
	
	public function change_email()
	{
		if ( ! $this->ion_auth->logged_in() )
		{
			redirect('auth/login', 'refresh');
		}
		
		$this->data['message'] = NULL;
		
		$UID	= $this->ion_auth->current_UID();
		$email	= $this->ion_auth->current_email();
		
		# Password is valid?
		$password_check = $this->ion_auth->password_check( $this->input->post('password') );
		
		# Minimal password length
		$this->data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
		
		# Form fields and attributes
		$this->data['form_email']	= array('id'			=> 'form_change_email',
											'name'			=> 'form_email',
											
											'class'			=> '',
		);
		$this->data['email']		= array('id'			=> 'email',
											'name'			=> 'email',
											
											'class'			=> '',
											
											'size'			=> '50',
											'maxlength'		=> '90',
											
											'title'			=> lang('form_please_fill_in_this_field') ,
											
											'value'			=> set_value( 'email' , $email ) ,
											'placeholder'	=> lang('Email'),
		);
		$this->data['password'] = array(	'id'			=> 'password',
											'name'			=> 'password',
											
											'type'			=> 'password',
											
											'title'			=> lang('form_please_fill_in_this_field') ,
											
											'required'		=> '' ,
											'pattern'		=> '(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$' ,
		);
		$this->data['submit']		= array('id'			=> 'users_email_submit',
											'name'			=> 'users_email_submit',
											
											'class'			=> 'btn',
											
											'value'			=> lang('form_email_submit'),
		);
		if ( ! $this->form_validation->run('dossier_edit_email') OR	! $password_check )
		{
			# Message: „Password is invalid“
			# $this->data['message'] = lang('Error_password');
			
			# Set the flash data error message if there is one
			if( $_POST )
			{
				$this->data['message'] = $this->ion_auth->errors();
			}
			
			# Error: AJAX Request
			if ( $this->input->is_ajax_request_form() )
			{
				$message = array(
									'email'		=> form_error('email') ,
									'password'	=> ( form_error('password') == '' ) ? $this->data['message'] : form_error('password') ,
								);
				echo json_encode( $message );
			}
			
			# Error: Standart Request
			else
			{
				$this->load->view('auth/V_auth_change_email', $this->data );
			}
		}
		else
		{
			if ( $password_check )
			{
				# Change the email
				$data			= array( 'email' => $this->input->post('email') );
				$change_email	= $this->ion_auth->update( $UID, $data );
				
				# Success Page: AJAX Request
				if ( $this->input->is_ajax_request_form() )
				{
					$submitted = array(
										'submit'		=> AJAX_good_response( lang('form_email_submitted') ),
									);
					echo json_encode( $submitted );
				}
				
				# Success Page: Standart Request
				else
				{
					# success message
					$this->data['form_email_submitted'] = lang('form_email_submitted');
					
					$this->load->view('auth/V_auth_change_email', $this->data);
				}
			}
			else
			{
				$this->load->view('auth/V_auth_change_email', $this->data);
			}
		}
	}

	function _get_csrf_nonce()
	{
		$this->load->helper('string');
		$key = random_string('alnum', 8);
		$value = random_string('alnum', 20);
		$this->session->set_flashdata('csrfkey', $key);
		$this->session->set_flashdata('csrfvalue', $value);

		return array($key => $value);
	}

	function _valid_csrf_nonce()
	{
		if ($this->input->post($this->session->flashdata('csrfkey')) !== FALSE &&
				$this->input->post($this->session->flashdata('csrfkey')) == $this->session->flashdata('csrfvalue'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	
	public function form_array( $action )
	{
		$dossier = NULL;
		
		if( $action == 'dossier_edit_user' )
		{
			$user		= $this->ion_auth->user()->row();
			$user_id	= $user->id;
			$dossier	= $this->M_user->show_dossier( $user_id );
			$dossier	= $dossier[0];
			
			$data['form']['action'] = 'edit';
			
			$data['form']['h1'] = lang('Edit_dossier');
		}
		elseif( $action == 'dossier_create_user' )
		{
			$data['form']['action'] = 'create_user';
			
			$data['form']['h1'] = lang('Create_user');
		}
		elseif( $action == 'dossier_edit_password' )
		{	
			$data['form']['action'] = 'edit_password';
			
			$data['form']['h1'] = lang('Create_user');
		}
		
		# form tag
		$data['form']['form']		= array('id'			=> 'users_edit_form',
											'method'		=> 'post',
											
											'class'			=> 'form-horizontal',
		);
		
		# label tag
		$data['form']['label_attr']	= array(
											'class'			=> 'form_label',
		);
		
		# Email field
		if( $action == 'dossier_create_user' )
		{
			$data['form']['email']	= array('id'			=> 'users_edit_email',
											'name'			=> 'email',
											
											'class'			=> 'span3',
											
											'size'			=> '50',
											'maxlength'		=> '90',
											
											'title'			=> lang('form_please_fill_in_this_field') ,
											
											'required'		=> '' ,
											
											'type'			=> 'email' ,
											
											'value'			=> set_value( 'email' , ( $dossier != NULL ) ? $dossier['email'] : NULL ) ,
											'placeholder'	=> lang('Email'),
			);
		}
		
		# input tags
		$data['form']['name']		= array('id'			=> 'users_edit_name',
											'name'			=> 'name',
											
											'class'			=> 'span3',
											
											'size'			=> '15',
											'maxlength'		=> '15',
											
											'title'			=> lang('form_please_fill_in_this_field') ,
											
											'required'		=> '',
											'pattern'		=> '^[а-яА-яїЇіІёЁ\s\-]{2,20}$',
											
											'value'			=> set_value( 'name' , ( $dossier != NULL ) ? $dossier['name'] : NULL ) ,
											'placeholder'	=> lang('Name'),
		);
		$data['form']['surname']	= array('id'			=> 'users_edit_surname',
											'name'			=> 'surname',
											
											'class'			=> 'span3',
											
											'size'			=> '15',
											'maxlength'		=> '15',
											
											'title'			=> lang('form_please_fill_in_this_field') ,
											
											'required'		=> '',
											'pattern'		=> '^[а-яА-яїЇіІёЁ\s\-]{2,20}$',
											
											'value'			=> set_value( 'surname' , ( $dossier != NULL ) ? $dossier['surname'] : NULL ) ,
											'placeholder'	=> lang('Surname'),
		);
		$data['form']['age']		= array('id'			=> 'users_edit_age',
											'name'			=> 'age',
											
											'class'			=> 'input-mini',
											
											'size'			=> '4',
											'maxlength'		=> '4',
											
											'title'			=> lang('form_please_fill_in_this_field') ,
											
											'required'		=> '',
											'pattern'		=> '[0-9]{4}',
											
											'value'			=> set_value( 'age' , ( $dossier != NULL ) ? $dossier['age'] : NULL ) ,
											'placeholder'	=> lang('Year'),
		);
		$data['form']['city']		= array('id'			=> 'users_edit_city',
											'name'			=> 'city',
											
											'class'			=> 'span3',
											
											'size'			=> '30',
											'maxlength'		=> '20',
											
											'title'			=> lang('form_please_fill_in_this_field') ,
											
											'required'		=> '',
											'pattern'		=> '^[а-яА-яїЇіІёЁ\s\-]{2,20}$',
											
											'value'			=> set_value( 'city' , ( $dossier != NULL ) ? $dossier['city'] : NULL ) ,
											'placeholder'	=> lang('City'),
		);
		$data['form']['socium']		= array('id'			=> 'users_edit_socium',
											'name'			=> 'socium',
											
											'class'			=> 'span3',
											
											'size'			=> '30',
											'maxlength'		=> '30',
											
											'title'			=> lang('form_please_fill_in_this_field') ,
											
											'required'		=> '',
											'pattern'		=> '^([a-zA-Z0-9а-яА-яїЇіІёЁ]|[\-_!,;:?\.]|[«»—„“”]){1,20}$',
											
											'value'			=> set_value( 'socium' , ( $dossier != NULL ) ? $dossier['socium'] : NULL ) ,
											'placeholder'	=> lang('Socium'),
		);
		
		# Password fieds
		if( $action == 'dossier_create_user' OR $action == 'dossier_edit_user' )
		{
			$data['form']['password']			= array('id'			=> 'password',
														'name'			=> 'password',
														
														'class'			=> 'span3',
														
														'size'			=> '30',
														'maxlength'		=> '20',
														
														'title'			=> lang('form_please_fill_in_this_field') ,
														
														'required'		=> '' ,
														'pattern'		=> '(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$' ,
														
														'type'			=> 'password',
														
														'value'			=> set_value('password'),
														'placeholder'	=> lang('Password'),
			);
			$data['form']['password_confirm']	= array('name'			=> 'password_confirm',
														'id'			=> 'password_confirm',
														
														'class'			=> 'span3',
														
														'size'			=> '30',
														'maxlength'		=> '20',
														
														'title'			=> lang('form_please_fill_in_this_field') ,
														
														'required'		=> '' ,
														'pattern'		=> '(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$' ,
														
														'type'			=> 'password',
														
														'value'			=> set_value('password_confirm'),
														'placeholder'	=> lang('Password_confirm'),
			);
			$data['form']['password_old']		= array('id'			=> 'password_old',
														'name'			=> 'password_old',
														
														'class'			=> 'input-medium',
														
														'size'			=> '30',
														'maxlength'		=> '20',
														
														'title'			=> lang('form_please_fill_in_this_field') ,
														
														'required'		=> '' ,
														'pattern'		=> '(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$' ,
														
														'type'			=> 'password',
														
														'value'			=> set_value('password_old'),
														'placeholder'	=> lang('Password'),
			);
		}
		# radio tags
		$data['form']['sex']['male']	= array('id'			=> 'users_edit_male',
												'name'			=> 'sex',
												
												'class'			=> 'radio',
												
												'value'			=> 1,
		);
		$data['form']['sex']['female']	= array('id'			=> 'users_edit_female',
												'name'			=> 'sex',
												
												'class'			=> 'radio',
												
												'value'			=> 0,
		);
		
		if ( $action == 'dossier_edit_user' )
		{
			if ( (bool)$dossier['sex'] == TRUE OR ( isset( $_POST['sex'][0]) AND $_POST['sex'][0] == 1 ) )
			{
				$data['form']['sex']['male']['checked']		= 'checked';
			}
			else
			{
				$data['form']['sex']['female']['checked']	= 'checked';
			}
		}
		elseif ( $action == 'dossier_create_user' && !isset($_POST['sex'][0]) )
		{
			
		}
		else
		{
			if ( isset($_POST['sex'][0]) AND $_POST['sex'][0] == 1 )
			{
				$data['form']['sex']['male']['checked']		= 'checked';
			}
			else
			{
				$data['form']['sex']['female']['checked']	= 'checked';
			}
		}
		
		
		# select-option tags
		$data['form']['country']	= 'id="users_edit_country required"';
		$data['form']['countries']	= $this->M_user->get_countries();
		$data['form']['country_id']	= $dossier['country_id'];
		
		# submit button
		$data['form']['submit']		= array('id'			=> 'users_'.$data['form']['action'].'_submit',
											'name'			=> 'users_edit_submit',
											
											'class'			=> 'btn',
											
											'value'			=> lang('form_users_edit_submit'),
		);
		
		
		return $data['form'];
	}

}
