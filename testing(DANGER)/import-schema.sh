#!/usr/bin/env sh

. bin/setup.sh

#prompt for backup folder
echo "Enter the full system path to your backup folder"
read  SQL_FOLDER

if [ ! -d $SQL_FOLDER ]; then
	echo "Invalid folder"
	exit 1
fi

