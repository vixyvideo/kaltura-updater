<?php
/**
 * @package plugins.quickTimeTools
 * @subpackage lib
 */
class KOperationEngineQtTools  extends KSingleOutputOperationEngine
{
	protected $tmpFolder;
	
	public function configure(KSchedularTaskConfig $taskConfig, KalturaConvartableJobData $data, KalturaBatchJob $job, KalturaClient $client, KalturaConfiguration $clientConfig)
	{
		parent::configure($taskConfig, $data, $job, $client, $clientConfig);
		$this->tmpFolder = $taskConfig->params->localTempPath;
	}
	
	public function operate(kOperator $operator = null, $inFilePath, $configFilePath = null)
	{
		$qtInFilePath = "$this->tmpFolder/$inFilePath.stb";

		if(symlink($inFilePath, $qtInFilePath))
			$inFilePath = $qtInFilePath;
		
		return parent::operate($operator, $inFilePath, $configFilePath);
	}
}
