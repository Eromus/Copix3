<?php
/**
* @package   standard
* @subpackage plugin_theme_module
* @author   Croes Gérald, Salleyron Julien
* @copyright 2001-2006 CopixTeam
* @link      http://copix.org
* @license  http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public Licence, see LICENCE file
*/

/**
* Plugin qui permet d'associer un thème à un module
* @package   standard
* @subpackage plugin_theme_module
*/
class PluginAjaxable extends CopixPlugin {
	public function beforeProcess (){
		/*if ($theme = $this->config->getThemeFor (CopixRequest::get ('module'))){
			CopixTpl::setTheme ($theme);
		}
		//Ajout d'une gestion de tpl par thème
		$config=CopixConfig::instance();
		$theme = CopixTpl::getThemeInformations (CopixTpl::getTheme ());
		if ($theme->tpl!=null) {
    		$config->mainTemplate   = $theme->tpl;
		}
		*/
	}
	
	public function afterProcess ($actionreturn) {
	    if ($actionreturn->code == CopixActionReturn::PPO && _request('ajaxreturn') == true) {
	        if (is_array($actionreturn->more)) {
	            $actionreturn->more['mainTemplate'] = null;
	        } else {
	            $actionreturn->more = array('template'=>$actionreturn->more, 'mainTemplate'=>null);
	        }
	    }
	    
	}
}
?>