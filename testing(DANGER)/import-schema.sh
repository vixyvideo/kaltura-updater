#!/usr/bin/env sh

. bin/setup.sh

#prompt for backup folder if it is not set in config
if [ ! -d "$SQL_FOLDER" ]; then
	echo "Enter the full system path to your backup folder"  
	read  SQL_FOLDER
fi

if [ ! -d $SQL_FOLDER ]; then
	echo "Invalid folder"
	exit 1
fi

for FILE in `find $SQL_FOLDER -name '*.mysql'`
do
  echo "Importing $FILE"
  FILENAME=$(basename $FILE)
  SCHEMA=`echo $FILENAME | grep --color -P -o '[a-z_]*' | head -1`

  echo "Creating schema $SCHEMA"
  $(mysql -u$MYSQL_ROOT -p$MYSQL_ROOT_PW -e "CREATE DATABASE $SCHEMA;")

  echo "Importing $FILE into $SCHEMA"
  $(mysql -u$MYSQL_ROOT -p$MYSQL_ROOT_PW $SCHEMA < $FILE)
done
