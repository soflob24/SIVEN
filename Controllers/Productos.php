<?php
class Productos extends Controller{
    public function __construct() {
        session_start();

        parent::__construct();
    }
    public function index()
    {
        $id_user = $_SESSION['id_usuario'];
        $verificar = $this->model->verificarPermiso($id_user, 'productos');
        if (!empty($verificar) || $id_user == 1) {
            $data['categorias'] = $this->model->getCategorias();
            $data['proveedores'] = $this->model->getProveedores();
            $this->views->getView($this, "index", $data);
        } else {
            header('Location: '.base_url. 'Errors/permisos');
        }
    }
    public function listar(){

        $data = $this->model->getProductos();
        for ($i=0; $i < count($data); $i++) {
            if ($data[$i]['estado'] == 1) {
                $data[$i]['estado'] = '<span class="badge bg-success">Activo</span>';
                $data[$i]['acciones'] = '<div>
                <button class="btn btn-primary" type="button" onclick="btnEditarPro('.$data[$i]['id'].');"><i class="fas fa-edit"></i></button>
                <button class="btn btn-danger" type="button" onclick="btnEliminarPro('.$data[$i]['id'].');"><i class="fas fa-trash-alt"></i></button>
                <div/>';
            }else{
                $data[$i]['estado'] = '<span class="badge bg-danger">Inactivo</span>';
                $data[$i]['acciones'] = '<div>
                <button class="btn btn-success" type="button" onclick="btnReingresarPro('.$data[$i]['id'].');"><i class="fas fa-circle"></i></button>
                <div/>';
            }
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function registrar(){
        
        $codigo = $_POST['codigo'];
        $nombre = $_POST['nombre'];
        $precio_compra = $_POST['precio_compra'];
        $precio_venta = $_POST['precio_venta'];
        $categoria = $_POST['categoria'];
        $proveedor = $_POST['proveedor'];
        $id = $_POST['id'];
        if (empty($codigo) || empty($nombre) || empty($precio_compra) || empty($precio_venta) || empty($categoria) || empty($proveedor)) {
            $msg = array('msg' => 'Todo los campos son obligatorios', 'icono' => 'warning');
        }else{
            if ($id == "") {
                    $data = $this->model->registrarProducto($codigo, $nombre, $precio_compra, $precio_venta, $categoria, $proveedor);
                    if ($data == "ok") {
                        $msg = array('msg' => 'Producto registrado exitosamente', 'icono' => 'success');
                    }else if($data == "existe") {
                        $msg = array('msg' => 'El producto ya existe', 'icono' => 'warning');
                    }else{
                        $msg = array('msg' => 'Error al registrar el producto', 'icono' => 'error');
                    }
            }else {
                $data = $this->model->modificarProducto($codigo, $nombre, $precio_compra, $precio_venta, $categoria, $proveedor, $id);
                if ($data == "modificado") {
                    $msg = array('msg' => 'Producto modificado exitosamente', 'icono' => 'success');
                }else{
                    $msg = array('msg' => 'Error al modificar el producto', 'icono' => 'error');
                }
            }
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function editar(int $id){

        $data = $this->model->editarPro($id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function eliminar(int $id)
    {
        $data = $this->model->accionPro(0, $id);
        if ($data == 1) {
            $msg = array('msg' => 'Producto eliminado exitosamente', 'icono' => 'success');
        }else{
            $msg = array('msg' => 'Error al eliminar el producto', 'icono' => 'error');
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function reingresar(int $id)
    {
        $data = $this->model->accionPro(1, $id);
        if ($data == 1) {
            $msg = array('msg' => 'Producto reingresado exitosamente', 'icono' => 'success');
        }else{
            $msg = array('msg' => 'Error al reingresar el producto', 'icono' => 'error');
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
        
}
?>