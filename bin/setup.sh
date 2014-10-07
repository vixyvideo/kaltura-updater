#!/usr/bin/env sh

if [ ! -f 'config.sh' ]; then
	echo "No configuration file found. Please implement config.sample.sh"
	exit 1;
fi

# Load config
. ./config.sh

# Perhaps some prompting?

SETUP=1