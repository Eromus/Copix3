<?php
/**
* @package		copix
* @subpackage	smarty_plugins
* @author		Croës Gérald
* @copyright	CopixTeam
* @link			http://copix.org
* @license		http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public Licence, see LICENCE file
*/

/**
 * Création d'une liste déroulante
 */
function smarty_function_colorpicker ($params, $me) {
	if (isset ($params['assign'])){
		$me->assign ($params['assign'], _tag ('colorpicker', $params));
	} else {
		return _tag ('colorpicker', $params);
	}
}
?>