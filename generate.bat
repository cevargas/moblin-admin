@ECHO OFF

php application/libraries/doctrine/orm/bin/doctrine orm:convert-mapping --force --from-database --namespace=Entities\ yml ./models/generated/
php application/libraries/doctrine/orm/bin/doctrine orm:generate-entities --regenerate-entities="1" --generate-annotations=true ./models/ 

pause 