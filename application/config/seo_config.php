<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once( BASEPATH .'database/DB'. '.php' );
$db =& DB();
$query = $db->get( 'empresa' );
$empresa = $query->row();
$config['seo_title'] = strip_tags($empresa->nombre);
$config['seo_desc'] = strip_tags($empresa->desc_corta);
$config['seo_imgurl'] = strip_tags(base_url($empresa->imagen));
