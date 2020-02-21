<?header("Content-Type: text/html; charset=UTF-8")?>

<?if ( $this->input->is_ajax_request() ): ?>
	
	<?=doctype('html5')?>
	<?=HTML()?>
	<head>
		<meta charset="utf-8">
		<?=meta_property('og:title',	$title )?>
		
		<?=link_tag('css/second/',									'stylesheet')?>
		<?=link_tag('css/bootstrap/bootstrap.css',					'stylesheet')?>
		<?=link_tag('css/bootstrap/bootstrap-responsive.css',	'stylesheet')?>
		<?=link_tag('css/',											'stylesheet')?>
		
		<title>
			<?=$title?>
		</title>
	</head>
	
	<body class="container">
		
		<div id="content">
			
			<article>
	
<?else: ?>

	<?=doctype('html5')?>
	<?=HTML()?>
	<head>
		<meta charset="utf-8">
		
		<title>
			<?=$title?>
		</title>
		
		<?=meta_name('description',		lang('meta_description') )?>
		<?=meta_name('keywords',		lang('meta_keywords') )?>
		
		
		<?=meta_name('csrf_token_name',	$this->security->get_csrf_hash() )?>
		
		<?=meta_name('google',			'notranslate' )?>
		
		
		<?=link_tag('favicon.ico',		'icon',				'image/vnd.microsoft.icon')?>
		<?=link_tag('favicon.ico',		'shortcut icon',	'image/x-icon')?>
		<?=link_tag('favicon.ico',		'shortcut icon',	'image/ico')?>
		<?=link_tag('favicon.ico',		'apple-touch-icon',	'image/ico')?>
		
		
		<?=link_tag('' , 				'home',			'text/html', 			lang('Site_Slogan') )?>
		<?=link_tag('messages/',		'contents',		'text/html', 			lang('Site_Slogan') )?>
		<?=link_tag('sitemap.xml',		'sitemap',		'application/xml',		'Sitemap' )?>
		
		
		<?=meta_property('og:title',	lang('Site_Slogan') )?>
		
		
		<?=meta_name('viewport',		'width=device-width, initial-scale=1.0' )?>
		
		
		<?=link_tag('css/',	'stylesheet')?>
		<?=script_tag('js/library/modernizr_build.js')?>
		
	</head>
	
	<body class="container">
		
		<header id="header" class="">
			<!--<span id="loading">empty</span> footerfooter-->
			
			<div class="navbar">
				<div class="navbar-inner">
					<div class="container">
						
						<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</a>
						
						<a class="brand" href="/">
							<?=lang('Slogan')?>
						</a>
						
						<!-- Everything you want hidden at 940px or less, place within here -->
						<nav class="nav-collapse collapse">
							
							<ul class="nav">
								<li <?=( $this->uri->segment(1) == 'users' &&
												 $this->uri->segment(2) == '' ) ?
									'class="active">' : 'class="">' ?>
									<a href="/users/" title="<?=lang('form_empty')?>">
										<?=lang('Users')?></a>
								</li>
								<li <?=( $this->uri->segment(1) == 'messages' &&
												 $this->uri->segment(2) == '' ) ?
									'class="active">' : 'class="">' ?>
									<a href="/messages/" title="<?=lang('Messages')?>">
										<?=lang('Messages')?></a>
								</li>
								
								<li class="divider-vertical"></li>
								
								<?if ( ! $logged_in )  : ?>
								
									<li <?=(	$this->uri->segment(1) == 'auth' &&
														$this->uri->segment(2) == 'create_user' ) ?
										   'class="active">' : 'class="">' ?>
										   
										   <a href="/auth/create_user/" title="<?=lang('form_empty')?>">
										   
										   <?=lang('Registration')?></a>
									</li>
									
									
									<li <?=(	$this->uri->segment(1) == 'auth' &&
														$this->uri->segment(2) == 'login' ) ?
										   'class="active">' : 'class="">' ?>
										   
										   <a href="/auth/login/" title="<?=lang('form_empty')?>">
										   
										   <?=lang('Authorization')?></a>
									</li>
								
								<?else: ?>
									
									<li <?=(	$this->uri->segment(1) == 'messages' &&
														$this->uri->segment(2) == 'add' ) ?
										   'class="active">' : 'class="">' ?>
										   
										   <a href="/messages/add/"
											  title="<?=lang('Add_message')?>">
											  
										   <i class="icon-pencil"></i>
										   
											<?=lang('Message')?></a>
									</li>
								
								<?endif?>
								
							</ul>
							
						</nav>
							
						<?if ( $this->ion_auth->logged_in() ) : ?>
							<div class="btn-group pull-right">
								
								<a href="#"  data-toggle="dropdown" class="btn dropdown-toggle no-ajaxy">
									
									<i class="icon-cog"></i>
									
									 <?=lang('Profile')?>&nbsp;
									
									<span class="caret"></span>
									
								</a>
								
								<ul class="dropdown-menu">
									<li>
										<a href="/user/<?=$this->ion_auth->current_UID()?>/" title="<?=lang('form_empty')?>">
											<i class="icon-user"></i>
											 <?=lang('About')?>
										</a>
									</li>
									
									<li>
										<a href="/auth/edit/" title="<?=lang('form_empty')?>">
											<i class="icon-edit"></i>
											 <?=lang('Edit')?>
										</a>
									</li>
									
									<li>
										<a href="/auth/change_email/" title="<?=lang('form_empty')?>">
											<i class="icon-envelope"></i>
											 <?=lang('Email')?>
										</a>
									</li>
									
									<li>
										<a href="/auth/change_password/" title="<?=lang('form_empty')?>">
											<i class="icon-lock"></i>
											 <?=lang('Password')?>
										</a>
									</li>
									
									<li class="divider"></li>
									
									<li>
										<a href="/auth/logout/">
											<i class="icon-off"></i>
											 Sign Out
										</a>
									</li>
								</ul>
								
							</div>
						<?endif?>
					</div>
				</div>
			</div>
			
			<?if ( isset( $breadcrumb_1 ) ) : ?>
				<ul class="breadcrumb">
					<li>
						<?=anchor( $this->uri->segment(1).'/' , $breadcrumb_1 , array('title' => '') )?>
						<span class="divider">/</span>
					</li>
				</ul>
			<?endif?>
		</header>
		
		
		<div id="content">
			
			<article>
	
<?endif?>