#!/usr/bin/env sh
echo "Exporting schemas and routines"

SCHEMAS="kaltura kalturadw kalturadw_bisources kalturadw_ds kalturalog kaltura_sphinx_log"

if [ -z $1 ]; then
	echo "Call script like: export-structure.sh <root-user> <root-pw> <export path>"
	exit 1
fi

if [ -z $2 ]; then
	echo "Call script like: export-structure.sh <root-user> <root-pw> <export path>"
	exit 1
fi

if [ -z $3 ] || [ ! -d "$3" ]; then
	echo "Call script like: export-structure.sh <root-user> <root-pw> <export path>"
	exit 1
fi

for SCHEMA in $SCHEMAS
do
	echo "Exporting full export for $SCHEMA to $SCHEMA.full.sql";
	mysqldump -u$1 -p$2 --routines --no-data --skip-opt $SCHEMA > "$3/$SCHEMA.full.sql"

    echo "Exporting routines & triggers export for $SCHEMA to $SCHEMA.routines.sql";
	mysqldump -u$1 -p$2 --routines --no-create-info --no-data --skip-opt $SCHEMA > "$3/$SCHEMA.routines.sql"
done