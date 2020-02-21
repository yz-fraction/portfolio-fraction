<?php

/*
 * Remove post list columns.
 */
function CRDMN_Dashboard__post_list__columns( $columns, $post_type ) {
  
	switch ( $post_type ) {    

		case 'post':
			unset(
				$columns['featured_image'],
				$columns['tags'],
				$columns['author'] ,
				$columns['comments'] ,
				$columns['language_ru']
			);
			break;
	}

	return $columns;
}