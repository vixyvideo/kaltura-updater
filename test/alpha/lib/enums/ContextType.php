<?php
/**
 * @package Core
 * @subpackage model.enum
 */ 
interface ContextType extends BaseEnum
{
	const PLAY = 1;
	const DOWNLOAD = 2;
	const THUMBNAIL = 3;
	const EXPORT = 5;
}
