<?php
/**
 * @package api
 * @subpackage objects
 */
class KalturaSourceFileSyncDescriptorArray extends KalturaTypedArray
{
	public static function fromDbArray($arr)
	{
		$newArr = new KalturaSourceFileSyncDescriptorArray();
		if ($arr == null)
			return $newArr;
		foreach ($arr as $obj)
		{
    		$nObj = new KalturaSourceFileSyncDescriptor();
			$nObj->fromObject($obj);
			$newArr[] = $nObj;
		}
		
		return $newArr;
	}
		
	public function __construct()
	{
		parent::__construct("KalturaSourceFileSyncDescriptor");	
	}
}
