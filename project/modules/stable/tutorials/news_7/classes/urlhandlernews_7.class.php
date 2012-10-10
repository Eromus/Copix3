<?php
/**
 * @package		tutorials
 * @subpackage 	news_7
 * @author		Gérald Croës
 * @copyright	CopixTeam
 * @link		http://copix.org
 * @license		http://www.gnu.org/licenses/lgpl.html GNU General Lesser  Public Licence, see LICENCE file
 */

/**
 * Gestion des URLS pour le module de nouvelles
 * @package	tutorials
 * @subpackage	news_7
 */
class UrlHandlerNews_7 extends CopixUrlHandler {
	/**
	 * Décrypte l'url
	 */
	function parse ($path, $mode) {
		if ($mode != 'prepend'){
			return false;
		}
		if($path[0]!="news_7"){
			return false;
		}

		$toReturn = array ();
		$toReturn['module'] = 'news_7';
		$toReturn['group'] = 'default';

		if (isset($path[1]) && is_numeric ($path[1])){
			$toReturn['action'] = 'show';
			$toReturn['id_news'] = $path[1];
		}elseif (isset($path[1]) && $path[1] == 'rss'){
			$toReturn['action'] = 'default';
			$toReturn['rss'] = 1;
		}else{
			return false;
		}
		return $toReturn;
	}

	/**
	 * Encode l'url
	 */
	function get ($dest, $parameters, $mode) {
		if ($mode == 'default'){
			return false;
		}else{
			if (isset ($dest['group']) && isset ($dest['module']) && isset ($dest['action'])){
				if ($dest['group'] == 'default' && $dest['module'] == 'news_7' && $dest['action'] == 'show' && isset ($parameters['id_news'])){
					$toReturn = new stdClass ();		
					$url = array ('news_7', $parameters['id_news']);
					unset ($parameters['id_news']);

					if (isset ($parameters['title_news'])){
						if (strlen ($parameters['title_news'])>0){
							$url[]=CopixUrl::escapeSpecialChars ($parameters['title_news']);
							unset ($parameters['title_news']);
						}
					}
					$toReturn->path = $url;				
					$toReturn->vars = $parameters;
					return $toReturn;
				}
			}
		}
	}
}
?>