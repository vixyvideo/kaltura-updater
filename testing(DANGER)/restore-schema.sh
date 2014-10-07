#/usr/bin/env sh

echo "- Drop schema"
. testing(DANGER)/drop-schema.sh

echo "- Restore schema"
. testing(DANGER)/import-schema.sh