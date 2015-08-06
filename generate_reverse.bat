@ECHO OFF

::php application/libraries/doctrine/orm/bin/doctrine orm:schema-tool:create
php application/libraries/doctrine/orm/bin/doctrine orm:schema-tool:update --force

pause 