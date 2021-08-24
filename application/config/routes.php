<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'front';
$route['404_override'] = 'front/show_404';
$route['translate_uri_dashes'] = FALSE;

$route['portada'] = 'front/index';
$route['login'] = 'login/index';
$route['about'] = 'front/about';
$route['contact'] = 'front/contacto';
$route['galery/(:any)'] = 'front/shop/$1';
$route['galery'] = 'front/shop/';

$route['productos/(:any)'] = 'front/categorias_variante/$1';
$route['productos'] = 'front/categorias_variante/';

require_once(BASEPATH . 'database/DB' . '.php');
$db = &DB();

/*


$query = $db->get( 'service' );
$result = $query->result();
foreach( $result as $row )
{
    $route[strtolower(seo_url($row->nombre))] = 'front/view_service/'.$row->service_id;
}
*/
/*
$query = $db->get('solicitud');
$result = $query->result();
//var_dump($result);
//die();
foreach ($result as $row) {
    $route['intercambiar-informacion/' . $row->solicitud_id] = 'front/chat/' . $row->solicitud_id;
}

$query = $db->get('noticia');
$result = $query->result();
foreach ($result as $row) {
    $route[strtolower('noticia/' . strtolower(seo_url($row->nombre)))] = 'front/view_new/' . $row->noticia_id;
}
*/
/*
$query = $db->get( 'categoria' );
$result = $query->result();
foreach( $result as $row )
{
    $route[strtolower('universidad/categoria/'.strtolower(seo_url($row->nombre)))] = 'front/news/'.$row->categoria_id;
}

*/
function seo_url($cadena)
{
    $cadena = utf8_decode($cadena);
    $cadena = str_replace(' ', '-', $cadena);
    $cadena = str_replace('%', '', $cadena);
    $cadena = str_replace('?', '', $cadena);
    $cadena = str_replace('+', '', $cadena);
    $cadena = str_replace('%', '', $cadena);
    $cadena = str_replace(',', '', $cadena);
    $cadena = str_replace('?', '', $cadena);
    $cadena = str_replace('/', '', $cadena);
    $cadena = str_replace(':', '', $cadena);
    $cadena = str_replace('(', '', $cadena);
    $cadena = str_replace(')', '', $cadena);
    $cadena = str_replace('??', '', $cadena);
    $cadena = str_replace('`', '', $cadena);
    $cadena = str_replace('!', '', $cadena);
    $cadena = str_replace('¿', '', $cadena);
    $cadena = str_replace("'", "-", $cadena);
    $originales = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿ??';
    $modificadas = 'aaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr';
    $cadena = strtr($cadena, utf8_decode($originales), $modificadas);

    return $cadena;
}
