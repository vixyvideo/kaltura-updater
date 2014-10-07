<?php
/**
 * @package deployment
 * @subpackage falcon.roles_and_permissions
 * 
 * Adds widevine plugin permissions
 * No need to re-run after server code deploy
 */

$script = realpath(dirname(__FILE__) . '/../../../../') . '/scripts/utils/permissions/addPermissionsAndItems.php';
$config = realpath(dirname(__FILE__) . '/../../../../') . '/plugins/drm/widevine/config/widevine_permissions_and_items.ini';
passthru("php $script $config");