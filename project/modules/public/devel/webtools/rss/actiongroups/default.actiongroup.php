<?php
class ActionGroupDefault extends CopixActionGroup{
	
	public function processDefault(){
		 $ppo = new CopixPPO();
		 $ppo->MAIN = CopixZone::process('RSS');
		 return _arDirectPPO($ppo,'generictools|blank.tpl',array('kind'=>CopixRequest::get('category')));
	}
	
}
?>