<?php
//Comunicación Controller y Model
class Controller{
    public function __construct()
    {
        $this->views = new Views();
        $this->cargarModel();
    }
    public function cargarModel() // Método
    {
        // Traer todos los modelos por medio de la clase
        $model = get_class($this)."Model";
        // Establecer la ruta 
        $ruta = "Models/".$model.".php"; 
        if (file_exists($ruta)) {
            require_once $ruta;
            $this->model = new $model();
        }
    }
}
 
?>

