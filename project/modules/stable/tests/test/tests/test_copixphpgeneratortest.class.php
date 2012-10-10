<?php
/**
 * @package		standard
 * @subpackage	test
 * @author		Steevan BARBOYON
 * @copyright	CopixTeam
 * @link		http://copix.org
 * @license		http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public Licence, see LICENCE file
 */

/**
 * Test de CopixPHPGenerator
 * 
 * @package		standard
 * @subpackage	test
 */
class Test_CopixPHPGeneratorTest extends CopixTest {
	/**
	 * Attend la prochaine seconde, utilise pour être sur que le tests se passent dans la seconde de génération des fichiers
	 *
	 * @return int
	 */
	private function _waitNextSecond () {
		$toReturn = time ();
		while ($toReturn == time ()) {}
		return $toReturn + 1;
	}
	
	/**
	 * Retourne le contenu que devrait retourner getGenerator
	 *
	 * @param int $pTime time () du moment de l'appel
	 * @param int $pLine Numéro de la ligne de l'appel
	 * @param string $pFunction Nom de la fonction de l'appel
	 * @return string
	 */
	private function _getGenerator ($pTime, $pFile, $pLine, $pFunction) {
		$toReturn = '/**';
		$toReturn .= "\n" . ' * This file was generated by a PHP script on ' . date ('m/d/Y', $pTime) . ' at ' . date ('H:i:s', $pTime);
		$toReturn .= "\n" . ' *';
		$toReturn .= "\n" . ' * File : ' . $pFile;
		$toReturn .= "\n" . ' * Line : ' . $pLine;
		$toReturn .= "\n" . ' * Function : ' . $pFunction;
		$toReturn .= "\n" . ' */';
		$toReturn .= "\n";
		$toReturn .= "\n";
		return $toReturn;
	}
	
	/**
	 * Test __construct, write, getContent, getGenerator
	 */
	public function testSomethings () {
		$path = COPIX_TEMP_PATH . 'modules/test/copixphpgenerator_testconstructwrite.tmp';
		$time = $this->_waitNextSecond ();
		
		// test le construct avec des déclarations de variables en paramètre
		$test = array ('$varString' => 'myValue', '$varInt' => 18, '$varBoolean' => true);
		$line = __LINE__ + 1;
		$php = new CopixPHPGenerator ($test);
		$content = $php->getContent ();
		$test = '<?php';
		$test .= "\n" . $this->_getGenerator ($time, __FILE__, $line, __CLASS__ . '->' . __FUNCTION__);
		$test .= '$varString = \'myValue\';';
		$test .= "\n" . '$varInt = 18;';
		$test .= "\n" . '$varBoolean = true;';
		$test .= "\n";
		$test .= "\n" . '?>';
		$this->assertEquals ($test, $content);
		
		// test getGenerator
		$generator = $php->getGenerator ('myFile', 18, 'myFunction');
		$this->assertEquals ($this->_getGenerator ($time, 'myFile', 18, 'myFunction'), $generator);
	}
	
	/**
	 * Test getVariableDeclaration
	 */
	public function testGetVariableDeclaration () {
		$php = new CopixPHPGenerator ();
		
		// type string
		$var = 'myValue';
		$varTest = '$var = \'myValue\';';
		$varTest .= "\n";
		$declaration = $php->getVariableDeclaration ('$var', $var);
		$this->assertEquals ($declaration, $varTest);
		
		// type int
		$var = 18;
		$varTest = '$var = 18;';
		$varTest .= "\n";
		$declaration = $php->getVariableDeclaration ('$var', $var);
		$this->assertEquals ($declaration, $varTest);
		
		// type boolean
		$var = true;
		$varTest = '$var = true;';
		$varTest .= "\n";
		$declaration = $php->getVariableDeclaration ('$var', $var);
		$this->assertEquals ($declaration, $varTest);
		$var = false;
		$varTest = '$var = false;';
		$varTest .= "\n";
		$declaration = $php->getVariableDeclaration ('$var', $var);
		$this->assertEquals ($declaration, $varTest);
		
		// type object (TestObjectPHPGenerator)
		$var = new TestObjectPHPGenerator ('myPrivateValue');
		$varTest = '$var = TestObjectPHPGenerator::__set_state(array(';
		$varTest .= "\n" . '   \'_protectedProperty\' => 18,';
		$varTest .= "\n" . '   \'_privateProperty\' => \'myPrivateValue\',';
		$varTest .= "\n" . '   \'property\' => \'testValue\',';
		$varTest .= "\n" . '));';
		$varTest .= "\n";
		$declaration = $php->getVariableDeclaration ('$var', $var);
		$this->assertEquals ($declaration, $varTest);
		// pour montrer que les variables statiques ne sont pas enregistrées
		TestObjectPHPGenerator::$staticProperty = 'myNewValue';
		$declaration = $php->getVariableDeclaration ('$var', $var);
		$this->assertEquals ($declaration, $varTest);
		
		// type array
		$var = array (0 => 'test', 'key' => 'value');
		$varTest = '$var = array (';
		$varTest .= "\n" . '  0 => \'test\',';
		$varTest .= "\n" . '  \'key\' => \'value\',';
		$varTest .= "\n" . ');';
		$varTest .= "\n";
		$declaration = $php->getVariableDeclaration ('$var', $var);
		$this->assertEquals ($declaration, $varTest);
	}
	
	/**
	 * Test getEndLine
	 */
	public function testGetEndLine () {
		$php = new CopixPHPGenerator ();
		$this->assertEquals ("\n\n\n\n", $php->getEndLine (4));
		$this->assertEquals ("\n", $php->getEndLine (1));
	}
}

/**
 * Classe pour tester le getVariableDeclaration
 *
 * @package		standard
 * @subpackage	test
 */
class TestObjectPHPGenerator {
	protected $_protectedProperty = 18;
	private $_privateProperty = null;
	public $property = 'testValue';
	public static $staticProperty = 'staticValue';
	public function __construct ($pPrivateValue) {
		$this->_privateProperty = $pPrivateValue;
	}
}