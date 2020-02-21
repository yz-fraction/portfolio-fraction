<?php
$config = array(
                'book_update' => array(
                                    array(
                                            'field'	=> 'title',
                                            'label'	=> 'lang:Title',
                                            'rules'	=> 'required|trim|min_length[3]|max_length[60]|xss_clean|prep_for_form'
                                         ),
                                    array(
                                            'field'	=> 'author',
                                            'label'	=> 'lang:Author',
                                            'rules'	=> 'required|trim|min_length[5]|max_length[80]|xss_clean|prep_for_form'
                                         ),
									array(
                                            'field' => 'rubrics[]',
                                            'label' => 'lang:Rubric',
                                            'rules' => 'required|numeric|min_length[1]|max_length[2]'
                                         ),
                                    ),
				
               );
?>