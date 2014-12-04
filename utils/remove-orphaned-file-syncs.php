<?PHP

$rootuser = @$argv[1];
$rootpw = @$argv[2];

if ( !$rootuser || !$rootpw ) {
  echo "Please run script as repopulateCategoryEntryPartner.php <rootuser> <rootpw>\n";
  die();
}

$dbh = @mysql_connect('localhost',$rootuser, $rootpw);

if ( !$dbh ) {
 echo "Could not connect to mysql, wrong credentials?\n";
 die();
}

mysql_select_db('kaltura');

$syncs = mysql_query("select id, partner_id, file_root, file_path from file_sync where file_type = 1");

$c = 0;
$ids = array();
while($sync = mysql_fetch_object($syncs)){
   $full_path = $sync->file_root.$sync->file_path;
   if ( !file_exists($full_path) ){
	echo "$sync->id, $sync->partner_id, $full_path\n";
	$c+=1;
	$ids[] = $sync->id;
   }
}

echo "$c objects found";

$str = implode(",",$ids);
mysql_query("Delete from file_sync where id in({$str});");

