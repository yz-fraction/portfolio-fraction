<?php
class MY_Exceptions extends CI_Exceptions
{
	/**
	 * 404 Page Not Found Handler
	 * 
	 * Метод дополняет базовый возможностю отсылать администратору сообщение
	 * в случае возникновения ошибки
	 *
	 * @access	private
	 * @param	string
	 * @return	string
	 */
	function show_404($page = '')
	{	
		# Отсылаем сообщение
		$message = '404 Page Not Found --> '.$page;
		//$this->adminmail($message);
		
		parent::show_404($page);
	}


	// --------------------------------------------------------------------


	/**
	 * Exception Logger
	 *
	 * Метод заменяет базовый добавляя возможности
	 * отсылать сообщению администратору сайта о ошибках
	 * и выводить дополнительную информацию в лог
	 *
	 * @access	private
	 * @param	string	the error severity
	 * @param	string	the error string
	 * @param	string	the error filepath
	 * @param	string	the error line number
	 * @return	string
	 */
	function log_exception( $severity , $message , $filepath , $line )
	{
		# Отсылаем сообщение администратору сайта
		//$this->adminmail($message);
		
		$severity = ( ! isset($this->levels[$severity])) ? $severity : $this->levels[$severity];
		
		# Дополняем текст сообщения дампам переменных окружения
		$message .= "\n" . $this->GetGlobalVariables() . $filepath.' '.$line . "\n\n";
		
		log_message('error', 'Severity: '.$severity.'  --> '.$message, TRUE);
	}

	
	// --------------------------------------------------------------------


	/**
    * Возвращает дамп переменных окружения
    *
    * @return string дамп переменных окружения
    */    
    function GetGlobalVariables()
    {
		$content = 'REMOTE_ADDR = '.$_SERVER["REMOTE_ADDR"]."\n";
		
		if (isset($_SERVER["HTTP_REFERER"]))
		{
			$content .= 'HTTP_REFERER = '.$_SERVER["HTTP_REFERER"]."\n";
		}

		$content .= 'USER_AGENT = '.$_SERVER["HTTP_USER_AGENT"]."\n";		
		$content .= '$_SERVER[\'REQUEST_URI\'] = ';
        $content .=  var_export(@$_SERVER['REQUEST_URI'], true);
        $content .= "\n".'$_GET = ';
        $content .=  var_export(@$_GET, true);
        $content .= "\n".'$_POST = ';
        $content .=  var_export(@$_POST, true);
        $content .= "\n";
		
        return $content;
    }


	// --------------------------------------------------------------------


	/**
	 * Метод отсылает сообщение о ошибки на почту администратору
	 * 
	 * @return 
	 * @param object $message
	 */
	function adminmail($message)
	{
		$CI =& get_instance();
		
		// Если конфиг не загружен - загружаем
		if (!isset($CI->config))
		{
			$CI->config = & load_class('Config');
		}

		// Если загрузчик не загружен - загружаем
		if (!isset($CI->load))
		{
			$CI->load = & load_class('Loader');
		}
		
		// Загружаем класс email
		if (!isset($CI->email))
		{
			$CI->email = & load_class('Email');
		}
		
		// Для почтового класса необходим класс Language
		if (!isset($CI->lang))
		{
			$CI->lang = & load_class('Language');
		}
		
		// Почтовый адрес администратора
		$email = $CI->config->item('log_to_email');
		
		// Если адрес не указан - ничего не делаем
		if (!strlen($email))
		{
			return;
		}
		
		
		
		// Отсылаем
		//$CI->load->library('email');

		$CI->email->from('noreply');
		$CI->email->to($email);
		$CI->email->subject('Возникла ошибка на сайте');
		$CI->email->message($message);

		$CI->email->send();
	}
}
?>