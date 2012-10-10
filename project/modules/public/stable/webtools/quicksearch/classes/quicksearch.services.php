<?php
/**
 * @package		webtools
 * @subpackage	quicksearch
* @author		Croës Gérald
* @copyright	CopixTeam
* @link			http://copix.org
* @license		http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public Licence, see LICENCE file
*/

/**
 * Services pour ajouter / supprimer des éléments de la table de recherche
 * @package		webtools
 * @subpackage	quicksearch
 */
class ServicesQuickSearch extends CopixServices {
   /**
   * Fonction de suppression de ligne indexée
   */
   function deleteIndex () {
      //Création de l'objet DAO
      $DAOsearch = CopixDAOFactory::getInstanceOf('quicksearchindex');
      _ioDAO ('quicksearchindex')->delete ($this->getParam ('id'), $this->getParam ('kind'));
   }
   
   /**
   * Fonction de mise à jour d'une ligne indexée
   */
   function addOrUpdateIndex () {
      //On parcours les résultats de l'index trouvé. (Normalement un seul)
      if ($record = _ioDAO ('quicksearchindex')->get ($this->getParam ('id'), $this->getParam ('kind'))){
         //Mise à jour de l'index de recherche
         $record->idobj_srch  = $this->getParam ('id');
         $record->kind_srch     = $this->getParam ('kind');
         $record->keywords_srch = $this->getParam ('keywords');
         $record->title_srch   = $this->getParam ('title');
         $record->summary_srch  = $this->getParam ('summary');
         $record->content_srch = $this->getParam ('content');
         $record->url_srch = $this->getParam ('url');

         //Validation de donnée modifiées
         _ioDAO ('quicksearchindex')->update ($record);
      }else{
         $record = _record ('quicksearchindex');
         $record->idobj_srch  = $this->getParam ('id');
         $record->kind_srch     = $this->getParam ('kind');
         $record->keywords_srch = $this->getParam ('keywords');
         $record->title_srch   = $this->getParam ('title');
         $record->summary_srch  = $this->getParam ('summary');
         $record->content_srch = $this->getParam ('content');
         $record->url_srch = $this->getParam ('url');
         _ioDAO ('quicksearchindex')->insert ($record);
      }
   }
}
?>