<?php
/**
 * @package		cms_editor
 * @subpackage	cms3
 * @copyright	CopixTeam
 * @license		http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public Licence, see LICENCE file
 * @author		Sylvain VUIDART
 * @link		http://www.copix.org
 */

_classInclude ('wikirenderer|abstracttokenizercomponent');

class CmsComponentHr extends AbstractTokenizerComponent {
    protected $_startTag = '----';
    protected $_endTag = '';
    protected $_isContainerComponent = false;
	public function render ($pText, $pToken) {
    	return '<hr />';
    }
}

?>