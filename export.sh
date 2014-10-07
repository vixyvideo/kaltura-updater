#!/usr/bin/env sh

TAGS="gemini_2012_09_19"
TAGS="$TAGS gemini_2012_10_22"
TAGS="$TAGS gemini_2013_01_07"
TAGS="$TAGS gemini_2013_01_28"
TAGS="$TAGS gemini_2013_02_18"
TAGS="$TAGS gemini_2013_02_22"
TAGS="$TAGS gemini_2013_03_04"
TAGS="$TAGS gemini_2013_03_14"
TAGS="$TAGS gemini_2013_03_18"
TAGS="$TAGS gemini_2013_04_15"
TAGS="$TAGS gemini_2013_04_29"
TAGS="$TAGS gemini_2013_05_06"
TAGS="$TAGS gemini_2013_06_04"
TAGS="$TAGS gemini_2013_07_16"
TAGS="$TAGS gemini_2013_07_16_1"
TAGS="$TAGS falcon_2012_08_20"

echo "Exporting tags"
for TAG in $TAGS
do
	echo "Checking export/$TAG"
	if [ ! -d "export/$TAG" ]; 
	then
		echo "No local cache for $TAG found. Starting export"
	    $(SSHPASS=onlyread SVN_SSH='/usr/bin/sshpass -e ssh' /usr/bin/svn export  --username 'svnread' --password 'onlyread' --non-interactive svn+ssh://svnread@kelev.kaltura.com/usr/local/kalsource/backend/server/tags/$TAG "export/$TAG")
	else 
		echo "Local cache found for $TAG. Skipping"
	fi
done
