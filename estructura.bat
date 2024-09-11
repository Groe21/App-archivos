@echo off
SET "project_dir=mi_app_drive"

REM Crear estructura de carpetas
mkdir "%project_dir%\config"
mkdir "%project_dir%\public"
mkdir "%project_dir%\public\assets\css"
mkdir "%project_dir%\public\assets\js"
mkdir "%project_dir%\public\assets\img"
mkdir "%project_dir%\public\assets\uploads"
mkdir "%project_dir%\src\controllers"
mkdir "%project_dir%\src\models"
mkdir "%project_dir%\src\views\usuarios"
mkdir "%project_dir%\src\views\carpetas"
mkdir "%project_dir%\src\views\documentos"
mkdir "%project_dir%\src\helpers"
mkdir "%project_dir%\logs"

REM Crear archivos con contenido básico
echo <?php ^> "%project_dir%\config\config.php"
echo // ConfiguraciÃ³n de la base de datos >> "%project_dir%\config\config.php"
echo. >> "%project_dir%\config\config.php"
echo ?> >> "%project_dir%\config\config.php"

echo <?php ^> "%project_dir%\public\index.php"
echo // Punto de entrada principal >> "%project_dir%\public\index.php"
echo. >> "%project_dir%\public\index.php"
echo ?> >> "%project_dir%\public\index.php"

echo Options -Indexes > "%project_dir%\public\.htaccess"

echo /* Estilos CSS personalizados */ > "%project_dir%\public\assets\css\estilos.css"

echo // Scripts JavaScript personalizados > "%project_dir%\public\assets\js\scripts.js"

echo <?php ^> "%project_dir%\src\controllers\ControladorUsuarios.php"
echo // Controlador para usuarios >> "%project_dir%\src\controllers\ControladorUsuarios.php"
echo. >> "%project_dir%\src\controllers\ControladorUsuarios.php"
echo ?> >> "%project_dir%\src\controllers\ControladorUsuarios.php"

echo <?php ^> "%project_dir%\src\controllers\ControladorCarpetas.php"
echo // Controlador para carpetas >> "%project_dir%\src\controllers\ControladorCarpetas.php"
echo. >> "%project_dir%\src\controllers\ControladorCarpetas.php"
echo ?> >> "%project_dir%\src\controllers\ControladorCarpetas.php"

echo <?php ^> "%project_dir%\src\controllers\ControladorDocumentos.php"
echo // Controlador para documentos >> "%project_dir%\src\controllers\ControladorDocumentos.php"
echo. >> "%project_dir%\src\controllers\ControladorDocumentos.php"
echo ?> >> "%project_dir%\src\controllers\ControladorDocumentos.php"

echo <?php ^> "%project_dir%\src\models\Usuario.php"
echo // Modelo para la tabla usuarios >> "%project_dir%\src\models\Usuario.php"
echo. >> "%project_dir%\src\models\Usuario.php"
echo ?> >> "%project_dir%\src\models\Usuario.php"

echo <?php ^> "%project_dir%\src\models\Carpeta.php"
echo // Modelo para la tabla carpetas >> "%project_dir%\src\models\Carpeta.php"
echo. >> "%project_dir%\src\models\Carpeta.php"
echo ?> >> "%project_dir%\src\models\Carpeta.php"

echo <?php ^> "%project_dir%\src\models\Documento.php"
echo // Modelo para la tabla documentos >> "%project_dir%\src\models\Documento.php"
echo. >> "%project_dir%\src\models\Documento.php"
echo ?> >> "%project_dir%\src\models\Documento.php"

echo <?php ^> "%project_dir%\src\views\layout.php"
echo // Layout para las vistas >> "%project_dir%\src\views\layout.php"
echo. >> "%project_dir%\src\views\layout.php"
echo ?> >> "%project_dir%\src\views\layout.php"

echo <?php ^> "%project_dir%\src\helpers\autenticacion.php"
echo // Funciones de ayuda para autenticaciÃ³n >> "%project_dir%\src\helpers\autenticacion.php"
echo. >> "%project_dir%\src\helpers\autenticacion.php"
echo ?> >> "%project_dir%\src\helpers\autenticacion.php"

echo > "%project_dir%\logs\errores.log"

echo Estructura de proyecto creada con Ã©xito.
