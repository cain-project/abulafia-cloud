#!/bin/sh
#
# popola-database.sh
#
# Esegue lo script SQL per creare le tabelle necessarie.
# TODO: sostituire con un sistema di migrazioni.
#

set -ex

/usr/bin/mysql \
    -u $RDS_USERNAME \
    -p$RDS_PASSWORD \
    -h $RDS_HOSTNAME \
    $RDS_DB_NAME \
      < .ebextensions/scripts/popola-database.sql