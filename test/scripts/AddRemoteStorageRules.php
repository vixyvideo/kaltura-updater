<?php
ini_set("memory_limit","256M");

require_once 'bootstrap.php';

if ($argc < 4)
{
    die("Script requires 3 parameters: valid storage profile ID, type: internal_high, internal_normal, external and the valid metadata profile id.\r\n");
}

$storageProfileId = $argv[1];
$storageType = $argv[2];
$metadataProfileId = $argv[3];

$storageProfile = StorageProfilePeer::retrieveByPK($storageProfileId);
if (!$storageProfile)
{
    die('Invalid storage profile ID provided.\n');
}

$rule = new kRule();
$ruleAction = new kRuleAction(RuleActionType::ADD_TO_STORAGE);
$rule->setActions(array($ruleAction));


if ($storageType == "external")
{
	$condition = new kMatchMetadataCondition();
	$condition->setXPath("/metadata/Delivery");
	$condition->setProfileId($metadataProfileId);
	$value1 = new kStringValue("external");
	$value2 = new kStringValue("both");
	$condition->setValues(array($value1, $value2));
	
	$rule->setConditions(array($condition));
}
else if($storageType == "internal_normal" )
{
	$condition1 = new kMatchMetadataCondition();
	$condition1->setXPath("/metadata/Delivery");
	$condition1->setProfileId($metadataProfileId);
	$value1 = new kStringValue("internal");
	$value2 = new kStringValue("both");
	$condition1->setValues(array($value1, $value2));
	
	$condition2 = new kMatchMetadataCondition();
	$condition2->setXPath("/metadata/Priority");
	$condition2->setProfileId($metadataProfileId);
	$value = new kStringValue("normal");
	$condition2->setValues(array($value));
	
	$rule->setConditions(array($condition1, $condition2));
}
else if($storageType == "internal_high" )
{
	$condition1 = new kMatchMetadataCondition();
	$condition1->setXPath("/metadata/Delivery");
	$condition1->setProfileId($metadataProfileId);
	$value1 = new kStringValue("internal");
	$value2 = new kStringValue("both");
	$condition1->setValues(array($value1, $value2));
	
	$condition2 = new kMatchMetadataCondition();
	$condition2->setXPath("/metadata/Priority");
	$condition2->setProfileId($metadataProfileId);
	$value = new kStringValue("high");
	$condition2->setValues(array($value));
	
	$rule->setConditions(array($condition1, $condition2));
}
else
	die("invalid type ".$storageType); 

$storageProfile->setRules(array($rule));
$storageProfile->save();

echo "Storage Profile with ID <$storageProfileId> updated.\r\n";