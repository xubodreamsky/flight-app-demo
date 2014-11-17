#!/bin/bash

PATH=/bin:/sbin:/usr/bin:/usr/sbin:$PATH

DB_HOST=localhost
DB_PORT=3306
DB_USER=root
DB_PASS=
DB_NAME=demo
DB_FILE=`dirname $0`/demo.sql

mysql -h $DB_HOST -P $DB_PORT -u $DB_USER -p$DB_PASS $DB_NAME < $DB_FILE

