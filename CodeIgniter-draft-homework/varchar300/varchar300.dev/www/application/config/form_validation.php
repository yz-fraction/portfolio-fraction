<?php
$config = array(
                 'auth/login' => array(
                                    array(
                                            'field'		=> 'identity',
                                            'label'		=> 'lang:Email',
                                            'rules'		=> 'required|valid_email|min_length[8]|max_length[50]'
                                         ),
                                    array(
                                            'field'		=> 'password',
                                            'label'		=> 'lang:Password',
                                            'rules'		=> 'required|min_length[8]|max_length[20]'
                                         ),
                                    ),
                 'message' => array(
                                    array(
                                            'field'		=> 'message',
                                            'label'		=> 'lang:Message',
                                            'rules'		=> 'required|alpha_punctuation|trim|min_length[5]|max_length[300]|xss_clean|prep_for_form'
                                         ),
                                    ),
                 'dossier_create_user' => array(
                                    array(
                                            'field' => 'name',
                                            'label' => 'lang:Name',
                                            'rules' => 'required|alpha_rus|trim|min_length[2]|max_length[15]|xss_clean|prep_for_form'
                                         ),
                                    array(
                                            'field' => 'surname',
                                            'label' => 'lang:Surname',
                                            'rules' => 'required|alpha_rus|min_length[2]|max_length[15]|xss_clean|prep_for_form'
                                         ),
                                    array(
                                            'field' => 'sex',
                                            'label' => 'lang:Sex',
                                            'rules' => 'required|numeric|exact_length[1]'
                                         ),
                                    array(
                                            'field' => 'age',
                                            'label' => 'lang:Age',
                                            'rules' => 'required|numeric|exact_length[4]'
                                         ),
                                    array(
                                            'field' => 'city',
                                            'label' => 'lang:City',
                                            'rules' => 'required|alpha_dash|min_length[2]|max_length[20]|xss_clean|prep_for_form'
                                         ),
                                    array(
                                            'field' => 'country',
                                            'label' => 'lang:Country',
                                            'rules' => 'required|numeric'
                                         ),
                                    array(
                                            'field' => 'socium',
                                            'label' => 'lang:Socium',
                                            'rules' => 'required|alpha_dash|min_length[5]|max_length[30]|xss_clean|prep_for_form'
                                         ),
									
                                    array(
                                            'field' => 'email',
                                            'label' => 'lang:Email',
                                            'rules' => 'required|valid_email|max_length[50]'
                                         ),
                                    array(
                                            'field' => 'password',
                                            'label' => 'lang:Password',
                                            'rules' => 'required|min_length[8]|max_length[20]|matches[password_confirm]'
                                         ),
                                    array(
                                            'field' => 'password_confirm',
                                            'label' => 'lang:Password_confirm',
                                            'rules' => 'required|min_length[8]|max_length[20]'
                                         )
                                    ),
				 
                 'dossier_edit_user' => array(
                                    array(
                                            'field' => 'name',
                                            'label' => 'lang:Name',
                                            'rules' => 'required|alpha_rus|trim|min_length[2]|max_length[15]|xss_clean|prep_for_form'
                                         ),
                                    array(
                                            'field' => 'surname',
                                            'label' => 'lang:Surname',
                                            'rules' => 'required|alpha_rus|min_length[2]|max_length[15]|xss_clean|prep_for_form'
                                         ),
                                    array(
                                            'field' => 'sex',
                                            'label' => 'lang:Sex',
                                            'rules' => 'required|numeric|exact_length[1]'
                                         ),
                                    array(
                                            'field' => 'age',
                                            'label' => 'lang:Age',
                                            'rules' => 'required|numeric|exact_length[4]'
                                         ),
                                    array(
                                            'field' => 'city',
                                            'label' => 'lang:City',
                                            'rules' => 'required|alpha_dash|min_length[2]|max_length[20]|xss_clean|prep_for_form'
                                         ),
                                    array(
                                            'field' => 'country',
                                            'label' => 'lang:Country',
                                            'rules' => 'required|numeric'
                                         ),
                                    array(
                                            'field' => 'socium',
                                            'label' => 'lang:Socium',
                                            'rules' => 'required|alpha_dash|min_length[5]|max_length[30]|xss_clean|prep_for_form'
                                         ),
                                    ),
				 
                 'dossier_edit_password' => array(
                                    array(
                                            'field' => 'password_old',
                                            'label' => 'lang:Password_old',
                                            'rules' => 'required|min_length[8]|max_length[20]'
                                         ),
                                    array(
                                            'field' => 'password_new',
                                            'label' => 'lang:Password_new',
                                            'rules' => 'required|min_length[8]|max_length[20]|matches[password_new_confirm]'
                                         ),
                                    array(
                                            'field' => 'password_new_confirm',
                                            'label' => 'lang:Password_new_confirm',
                                            'rules' => 'required|min_length[8]|max_length[20]'
                                         )
                                    ),
				 
                 'dossier_edit_email' => array(
                                    array(
                                            'field' => 'email',
                                            'label' => 'lang:Email',
                                            'rules' => 'required|valid_email|min_length[8]|max_length[50]'
                                         ),
									
                                    array(
                                            'field' => 'password',
                                            'label' => 'lang:Password',
                                            'rules' => 'required|min_length[8]|max_length[20]'
                                         ),
                                    )                          
               );
?>