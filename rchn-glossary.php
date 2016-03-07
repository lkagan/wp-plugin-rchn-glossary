<?php
/**
 * Plugin Name: RC Heli Nation Glossary
 * Version: 1.0
 * Description: Glossary for RC Heli Nation
 * Author: Superiocity, Inc. (Larry Kagan)
 * Author URI: www.superiocity.com
 * @package Rchn-glossary
 */
require_once 'post-types/definition.php';

class RCHN_Glossary 
{
	protected $wpdb;
	
	public function __construct() {
		$this->wpdb = $GLOBALS['wpdb'];
		add_shortcode( 'rchn_glossary', array($this, 'list_terms') );
	}
	
	
	public function list_terms()
	{
		$sql = "
			select post_name, post_title, post_content from {$this->wpdb->prefix}posts
			where post_status = 'publish'
				  and post_type = 'definition'
			order by post_name";

		$rows = $this->wpdb->get_results( $sql );
		$num_terms = count( $rows );
		$list = '';

		if ( $num_terms ) {
			$list .= '<dl class="rchn-definition-list">';
			
			for ( $i = 0; $i < $num_terms; ++$i ) {
				$list .= "<dt>{$rows[$i]->post_title}</dt><dd>{$rows[$i]->post_content}</dd>";
			}

			$list .= '</dl>';
		}

		return $list;
	}
}

new RCHN_Glossary();