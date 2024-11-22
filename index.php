<?php
    # Directorio Proyecto
    define('DIR_STRG', __DIR__);
    # Incluir archivos de configuraciones
    require DIR_STRG . '/config/autoload.php';
    require DIR_STRG . '/vendor/autoload.php';
    require DIR_STRG . '/libraries/envmnt.php';
    # Cargar el enrutador
    use App\Core\Load;
    use App\Core\Router;
    # Crear instancia del enrutador
    $router = new Router();
    # Crear instancia para cargar las rutas
    $routeConfig = new Load($router);
    # Manejar la solicitud
    $router->handleRequest();
