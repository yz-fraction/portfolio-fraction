<?header("Content-Type: text/html; charset=UTF-8")?>

<?if ( $this->input->is_ajax_request() ): ?>
	
	<?=doctype('html5')?>
	<?=HTML()?>
	<head>
		<meta charset="utf-8">
		
		<?=meta_property('og:title',	$title )?>
		
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
		
		<?=meta_name('csrf_token_name',	$this->security->get_csrf_hash() )?>
		
		
		<?=link_tag('css/',	'stylesheet')?>
		
		<?=script_tag('js/library/jquery-1.7.1.min.js')?>
		<?=script_tag('js/library/bootstrap.min.js')?>
		<?=script_tag('js/library/ajaxupload.js')?>
		<?=script_tag('js/A-grade/')?>
		
	</head>
	
	<body class="container">
		
		<header id="header" class="">
			
			<div class="navbar">
				<div class="navbar-inner">
					<div class="container">
						
						<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</a>
						
						<a class="brand" href="/">
							<?=lang('Site_Slogan')?>
						</a>
						
						<!-- Everything you want hidden at 940px or less, place within here -->
						<nav class="nav-collapse collapse">
							
							<ul class="nav">
								
								<li class="divider-vertical"></li>
								
								<li <?=( $this->uri->segment(1) == 'book' &&
												 $this->uri->segment(2) == 'create' ) ?
									'class="active">' : 'class="">' ?>
									
									<a href="/book/create/" title="<?=lang('header_Add')?>">
										
										<i class="icon-file"></i>
										
										<?=lang('header_Add')?>
										
									</a>
								</li>
								
								
								<li class="divider-vertical"></li>
								
								
								<li <?=( $this->uri->segment(1) == 'book' &&
												 $this->uri->segment(2) == '' ) ?
									'class="active">' : 'class="">' ?>
									
									<a href="/book/" title="<?=lang('Books')?>">
										
										<i class="icon-book"></i>
										
										<?=lang('Books')?>
										
									</a>
								</li>
								
								
								<li <?=( $this->uri->segment(1) == 'rubric' &&
												 $this->uri->segment(2) == '' ) ?
									'class="active">' : 'class="">' ?>
									
									<a href="/rubric/" title="<?=lang('Rubrics')?>">
										
										<i class="icon-tag"></i>
										
										<?=lang('Rubrics')?>
										
									</a>
								</li>
								
								
							</ul>
							
						</nav>
						
					</div>
				</div>
			</div>
			
			<?if ( isset( $breadcrumb_1 ) ) : ?>
				<ul class="breadcrumb">
					
					<li>
						
						<?=anchor( $this->uri->segment(1).'/' , $breadcrumb_1 , array('title' => '') )?>
						
						<span class="divider">/</span>
						
					</li>
					
					<?if ( isset( $breadcrumb_2 ) ) : ?>
					<li>
						
						<?=$breadcrumb_2?>
						
					</li>
					<?endif?>
					
				</ul>
			<?endif?>
		</header>
		
		
		<div id="content">
			
			<article>
	
<?endif?>