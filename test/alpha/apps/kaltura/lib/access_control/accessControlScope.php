<?php
/**
 * @package Core
 * @subpackage model.data
 */
class accessControlScope extends kScope
{
	
	public function __construct()
	{
		parent::__construct();
	
		$this->setContexts(array(ContextType::PLAY));
	}
	

}