<?php

$config['per_page'] = PAGINATION_PER_PAGE;

# Pagination block wrapper
$config['full_tag_open'] = '<div class="pagination"><ul>';
$config['full_tag_close'] = '</ul></div>';

# Pages wrapper
$config['num_tag_open']		= '<li>';
$config['num_tag_close']	= '</li>';

# Pagination CSS class
$config['anchor_class'] = '';

# First/last link text
$config['first_link']	= lang('pagination_first_link');
$config['last_link']	= lang('pagination_last_link');

# First/last link symbol
$config['prev_link']	= '&larr;';
$config['next_link']	= '&rarr;';


# Next link tags
$config['next_tag_open']	= ' <li title="'.lang('pagination_next_link').'">';
$config['next_tag_close']	= '</li>';

# Prev link tags
$config['prev_tag_open']	= ' <li title="'.lang('pagination_prev_link').'">';
$config['prev_tag_close']	= '</li>';

# Current link tags
$config['cur_tag_open']		= '<li class="active"><a href="'.__CLASS__.'">';
$config['cur_tag_close']	= '</a></li>';

