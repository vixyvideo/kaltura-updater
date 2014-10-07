#!/usr/bin/env sh

. bin/setup.sh

$SCHEMAS="kaltura"
$SCHEMAS="$SCHEMAS kaltura_sphinx_log"
$SCHEMAS="$SCHEMAS kalturadw"
$SCHEMAS="$SCHEMAS kalturadw_bisources"
$SCHEMAS="$SCHEMAS kalturadw_ds"
$SCHEMAS="$SCHEMAS kalturalog"

for SCHEMA in $SCHEMAS 
do
	echo "Dropping schema $SCHEMA"
	$(mysql -u$MYSQL_ROOT -p$MYSQL_ROOT_PW -e "DROP SCHEMA $SCHEMA;")
done