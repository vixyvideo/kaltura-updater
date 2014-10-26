#!/usr/bin/env sh

if [ "$SETUP" != "1" ]; then
	. bin/setup.sh
fi

TIMESTAMP=$(date +%s)

for RELEASE in $RELEASES; do
 echo "--- Running update.php for $RELEASE"
 cd "$EXPORT_PATH/$RELEASE/deployment/updates"
 php "update.php" > "$LOG_PATH/run-update-$TIMESTAMP" 2>&1
done;