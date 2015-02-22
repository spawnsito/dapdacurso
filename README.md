Aplicación de muestra dapdacurso
================================

Código empleado para el curso en Dapda

1) Instalacion
---------------
1. Clonar repositorio:

    `git clone https://github.com/spawnsito/dapdacurso.git`

2. Actualizar dependencias mediante composer

    `php composer.phar update`

3. Crear base de datos
   
    `php app/console docrine:database:create`
    
    `php app/console doctrine:schema:create`
    
4. Cargar datos de prueba (datafixtures)

    `php app/console docrine:fixtures:load`

2) Acceso
---------

* Usuario de prueba

    `user:admin`
    
    `password:admin`

