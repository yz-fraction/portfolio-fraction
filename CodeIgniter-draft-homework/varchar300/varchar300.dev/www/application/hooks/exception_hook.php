<?php
if (! defined('BASEPATH')) exit('No direct script access allowed');

	/**
	* ��������� ����������� ����������
	*
	*/
	function addExceptionHandler()
	{
		set_exception_handler('_exception_handler2');
	}
	
	
	/**
	* ���������� ����������
	*
	*/
	function _exception_handler2($errstr)
	{
		$error =& load_class('Exceptions');
		
		$error->adminmail('1');
		
		// ������� ����� �� ���������� �� �����
	    echo $error->show_error('error', nl2br($errstr));
		
		// Should we log the error?  No?  We're done...
		$config =& get_config();
		if ($config['log_threshold'] == 0)
		{
			return;
		}
		
		// ����� ��������� � ���
		$error->log_exception('Exception', $errstr, '', '');
		
		exit;
	}

?>