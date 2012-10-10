<?php
class PortletSitemap extends Portlet{
const DEFAULT_HTML_DISPLAY_TEMPLATE = 'heading|portlettemplates/default.sitemap.php';
	
	/**
	 * Initialisation des paramètres de la portlet
	 */
	public function __construct (){
		//seuls les titles sont autorisés dans cette portlet
		parent::__construct ();
		$this->type_portlet = "PortletSitemap";
	}

	/**
	 * rendu du contenu de la portlet
	 *
	 * @param string $pRendererContext le contexte de rendu (Modification, Moteur de recherche, affichage, ....)
	 * @param string $pRendererMode    le mode de rendu demandé (généralement le format de sortie attendu)
	 * @return string
	 */
	protected function _renderContent ($pRendererMode, $pRendererContext){
		if ($pRendererMode == RendererMode::HTML){
			return $this->_renderHTML ($pRendererContext);
		}
		throw new CopixException ('Mode de rendu non pris en charge');
	}

	/**
	 * Rendu pour le mode HTML
	 *
	 * @param string $pRendererContext le contexte de rendu
	 * @return string
	 */
	private function _renderHTML ($pRendererContext){
		if ($pRendererContext == RendererContext::DISPLAYED || $this->getEtat () == self::DISPLAYED){
			return $this->_renderHTMLDisplay ();
		}else{
			return $this->_renderHTMLUpdate ();
		}
	}
	
	/**
	 * Retourne le contenu du template de la portlet en rendu update
	 *
	 * @return String
	 */
	private function _renderHTMLUpdate (){
		$toReturn = CopixZone::process ('portal|PortletMenu', array('portlet'=>$this, 'module'=>'portal', 'xmlPath'=>CopixTpl::getFilePath("heading|portlettemplates/sitemaptemplates.xml")));
		$tpl = new CopixTpl ();
		$tpl->assign ('portlet', $this);	
		$toReturn .= $tpl->fetch ('heading|portlettemplates/portletsitemap.form.php');
		return $toReturn;
	}

	/**
	 * Retourne le contenu du template de la portlet en rendu display
	 *
	 * @return String
	 */
	private function _renderHTMLDisplay (){
		$tpl = new CopixTpl ();
		$tpl->assign ('portlet', $this);	
		$params = new CopixParameterHandler ();
		$params->setParams($this->_moreData);
		
		$tpl->assign ('sitemapId', $params->getParam('sitemapId'));

		return $tpl->fetch ($params->getParam('template', self::DEFAULT_HTML_DISPLAY_TEMPLATE));
	}

}
