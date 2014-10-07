<?php
/**
 * @package Core
 * @subpackage model.data
 */
class kStorageExportJobData extends kStorageJobData
{
	/**
	 * @var bool
	 */   	
    private $force;
	
	/**
	 * @var bool
	 */
    private $createLink;
    
    /**
	 * @return the $force
	 */
	public function getForce()
	{
		return $this->force;
	}

	/**
	 * @param $force the $force to set
	 */
	public function setForce($force)
	{
		$this->force = $force;
	}
	/**
	 * @return the $createLink
	 */
	public function getCreateLink()
	{
		return $this->createLink;
	}

	/**
	 * @param createLink the $createLink to set
	 */
	public function setCreateLink($createLink)
	{
		$this->createLink = $createLink;
	}
}
