#!/usr/bin/env sh

if [ "$SETUP" != "1" ]; then
	. bin/setup.sh
fi

#init exports caching folder, if missing
if [ ! -d "exports" ];
then
	mkdir exports
fi

for TAG in $RELEASES
do
	echo "--- Checking export/$TAG"
	if [ ! -d "exports/$TAG" ]; 
	then
		echo "--- No local cache for $TAG found. Starting export"
	    $(SSHPASS=onlyread SVN_SSH='/usr/bin/sshpass -e ssh' /usr/bin/svn export  --username 'svnread' --password 'onlyread' svn+ssh://svnread@kelev.kaltura.com/usr/local/kalsource/backend/server/RELEASES/$TAG "exports/$TAG")
	else 
		echo "--- Local cache found for $TAG. Skipping"
	fi
done
