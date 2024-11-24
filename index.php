<?php
    # Directorio Proyecto
    define('DIR', __DIR__);

    # Incluir archivos de configuraciones
    require DIR . '/config/autoload.php';
    require DIR . '/vendor/autoload.php';

    # Cargar variables
    use App\Library\Envmnt;
    # Cargar el enrutador
    use App\Core\Load;
    # Cargar el enrutador
    use App\Core\Router;

    use App\Library\Doctrine;
    use App\Doctrine\BaseDoctrine;
    use App\Doctrine\OrmDoctrine;
    
    # Crear instancia del enrutador
    $router = new Router();
    # Crear instancia para cargar las rutas
    $config = new Load($router);
    # Manejar la solicitud
    $router->handleRequest();

    # Instanciar base de datos
    $base = new BaseDoctrine();
    # Acceder a la funcion
    $server = $base->server();

    # Instanciar orm para la bd
    $orm = new OrmDoctrine($base);
    # Ejecutar base de datos
    $orm->execute();

    if ($_ENV['DB_ORM'] !== "drop") {
        # Verificar conexion de prueba
        $server = $server ? $base->connect() : "";
        # Verificar base de datos
        $verify = $server ? $base->verify() : "";

        # Listar tablas de la base de datos
        $tables = $verify ? $base->table() : "";
        if (empty($tables)) { echo "Empty Tables"; }
        if (!empty($tables)) { echo "Tables Founds"; }
        if (!empty($tables)) { print_r($tables); }

        $doctrine = new Doctrine();
        $doctrine->manager();
    }
?>
