<?php
/**
 * @package standard
 * @subpackage copixtest
 * @author		Croës Gérald
 * @copyright	CopixTeam
 * @link		http://copix.org
 * @license		http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public Licence, see LICENCE file
 */

/**
 * Tests sur la classe CopixSessionObject
 * @package standard
 * @subpackage copixtest
 */
class CopixTest_CopixSession extends CopixTest {
	public function setUp (){
		CopixContext::push ('copixtest');
	}
	public function tearDown (){
		CopixContext::pop ();
	}
	public function testDAO (){
	}
	public function testRecord (){
	}
	public function testClass (){
	}
}
?>