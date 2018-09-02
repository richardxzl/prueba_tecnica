Ejecutar el siguiente comando para generar la BD:
php app/console doctrine:database:create

Luego que se cree la BD, se ejecuta el schema para crear la tabla con sus campos
php app/console doctrine:schema:update --force

Nota: si al momento de crear la BD da algun error por tema de contraseña, deben poner la contraseña de la BD de mysql que tienen en su local, por defecto esta null y así fue como se creo