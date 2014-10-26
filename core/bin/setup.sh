#!/usr/bin/env sh

if [ ! -f 'config.sh' ]; then
	echo "No configuration file found. Please implement config.sample.sh"
	exit 1;
fi

# Load config
. ./config.sh

# Perhaps some prompting?

if [ -z $MYSQL_ROOT ]; then
 echo "MYSQL_ROOT setting not configured"
fi

if [ -z $MYSQL_ROOT_PW ]; then
 echo "MYSQL_ROOT setting not configured"
fi

if [ -z $LOG_PATH ]; then
 LOG_PATH="/tmp"
fi

SETUP=1