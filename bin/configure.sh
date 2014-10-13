#!/usr/bin/env sh

if [ "$SETUP" != "1" ]; then
	. bin/setup.sh
fi

for RELEASE in $RELEASES; do
 echo "--- Creating configuration for $RELEASE"

 cp asset/db.template.ini "$EXPORT_PATH/$RELEASE/configurations/db.ini"
 cp asset/local.template.ini "$EXPORT_PATH/$RELEASE/configurations/local.ini"

 sed -i "s^@ROOT_USER@^$MYSQL_ROOT^" "$EXPORT_PATH/$RELEASE/configurations/db.ini"
 sed -i "s^@ROOT_PASSWORD@^$MYSQL_ROOT_PW^" "$EXPORT_PATH/$RELEASE/configurations/db.ini"


 sed -i "s^@ROOT_USER@^$MYSQL_ROOT^" "$EXPORT_PATH/$RELEASE/configurations/local.ini"
 sed -i "s^@ROOT_PASSWORD@^$MYSQL_ROOT_PW^" "$EXPORT_PATH/$RELEASE/configurations/local.ini"
 sed -i "s^@INSTANCE_PATH@^$EXPORT_PATH/$RELEASE^" "$EXPORT_PATH/$RELEASE/configurations/local.ini"
done;