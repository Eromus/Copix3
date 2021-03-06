<?php
/**
 * @package		copix
 * @subpackage	cache
 * @author		Croës Gérald, Salleyron Julien
 * @copyright	CopixTeam
 * @link		http://copix.org
 * @license		http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public Licence, see LICENCE file
*/

/**
 * Gère le cache en mode User (c'est a dire qu'il est vidé au niveau d'une déconnexion)
 * 
 * @package		copix
 * @subpackage	cache
 */
class CopixCacheUserStrategy implements ICopixCacheStrategy {
	/**
	 * Indique si le cache est actif
	 * 
	 * @param array $pExtra Paramètres supplémentaires
	 * @return boolean
	 */
	public function isEnabled ($pExtra) {
		// ce système de cache sera toujours disponible, puisqu'il ne necessite rien de particulier pour fonctionner
		return true;
	}

	/**
	 * Lecture de données depuis le cache
	 *
	 * @param string $pId Identifiant de l'élément à récupérer 
	 * @param string $pType Type de cache ou récupérer les données
	 * @param array	$pExtra	Paramètres supplémentaires
	 * @return string
	 * @throws CopixCacheException
	 */	
	public function read ($pId, $pType, $pExtra) {
		if ($return = CopixSession::get ($this->_makeFileName ($pId, $pType, $pExtra), 'CopixCacheUser')) {
			return $return->data;
		}
		throw new CopixCacheException (_i18n ('copix:copixcache.error.contentNotFound', $pId));
	}

	/**
	 * Détermine le nom de fichier du cache
	 * 
	 * @param string $pId Identifiant de l'élément à récupérer 
	 * @param string $pType Type de cache ou récupérer les données
	 * @param array	$pExtra	Paramètres supplémentaires
	 */
	private function _makeFileName ($pId, $pType, $pExtra) {
		return md5 ($pId);
	}

	/**
	 * Enregistrement des éléments dans le cache
	 *
	 * @param string $pId Identifiant de l'élméent à écrire dans le cache 
	 * @param string $pType Type de cache ou écrire
	 * @param mixed $pContent Contenu
	 * @param array	$pExtra	Paramètres supplémentaires
	 */	
	public function write ($pId, $pContent, $pType, $pExtra) {
	    $toSave = new StdClass();
	    $toSave->data  = $pContent;
	    $toSave->time  = time();
		CopixSession::set ($this->_makeFileName ($pId, $pType, $pExtra), $toSave, 'CopixCacheUser');
	}

	/**
	 * Teste l'existence du cache
	 *
	 * @param string $pId Identifiant du cache
	 * @param string $pType Type de cache
	 * @param array	$pExtra	Paramètres supplémentaires
	 * @return boolean
	 */	
	public function exists ($pId, $pType, $pExtra) {
		if (($return = CopixSession::get ($this->_makeFileName ($pId, $pType, $pExtra), 'CopixCacheUser')) != null) {
			if ($pExtra['duration'] === null || $pExtra['duration'] == 0) {
				return true;
			}
			if ((time () - $return->time) < $pExtra['duration']) {
				return true;
			} else {
				$this->clear ($pId, $pType, $pExtra);
			}
		}
		return false;
	}

	/**
	 * Supression des éléments du cache
	 * Si $pId = null tout le type (ou sous-type) passé en paramètre du constructeur est vidé
	 *
	 * @param string $pId Identifiant de l'élément à supprimer
	 * @param string $pType Type de cache
	 * @param array	$pExtra	Paramètres supplémentaires
	 */
	public function clear ($pId, $pType, $pExtra) {
		if ($pId !== null) {
		    CopixSession::delete ($this->_makeFileName ($pId, $pType, $pExtra), 'CopixCacheUser');
		} else {
		    // Gestion fausse
			CopixSession::destroyNamespace ('CopixCacheUser');
		}
	}
}