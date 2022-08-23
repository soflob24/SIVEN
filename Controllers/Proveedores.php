<?php
class Proveedores extends Controller{
    public function __construct() {
        session_start();

        parent::__construct();
    }
    public function index()
    {
        $id_user = $_SESSION['id_usuario'];
        $verificar = $this->model->verificarPermiso($id_user, 'proveedores');
        if (!empty($verificar) || $id_user == 1) {
            $this->views->getView($this, "index");
        } else {
            header('Location: '.base_url. 'Errors/permisos');
        }        
    }
    public function listar(){
        $data = $this->model->getProveedores();
        for ($i=0; $i < count($data); $i++) {
            if ($data[$i]['estado'] == 1) {
                $data[$i]['estado'] = '<span class="badge bg-success">Activo</span>';
                $data[$i]['acciones'] = '<div>
                <button class="btn btn-primary" type="button" onclick="btnEditarProveedor('.$data[$i]['id'].');"><i class="fas fa-edit"></i></button>
                <button class="btn btn-danger" type="button" onclick="btnEliminarProveedor('.$data[$i]['id'].');"><i class="fas fa-trash-alt"></i></button>
                <div/>';
            }else{
                $data[$i]['estado'] = '<span class="badge bg-danger">Inactivo</span>';
                $data[$i]['acciones'] = '<div>
                <button class="btn btn-success" type="button" onclick="btnReingresarProveedor('.$data[$i]['id'].');"><i class="fas fa-circle"></i></button>
                <div/>';
            }
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function registrar(){
        
        $id = $_POST['id'];
        $proveedor = $_POST['nombre'];
        if (empty($proveedor)) {
            $msg = array('msg' => 'El campo es requerido', 'icono' => 'warning');
        }else{
            if ($id == "") {
                $data = $this->model->registrarProveedor($proveedor);
                if ($data == "ok") {
                    $msg = array('msg' => 'Proveedor registrado exitosamente', 'icono' => 'success');
                }else if($data == "existe") {
                    $msg = array('msg' => 'El proveedor ya existe', 'icono' => 'warning');
                }else{
                    $msg = array('msg' => 'Error al registrar el proveedor', 'icono' => 'error');
                }
            }else {
                $data = $this->model->modificarProveedor($proveedor, $id);
                if ($data == "modificado") {
                    $msg = array('msg' => 'Proveedor modificado exitosamente', 'icono' => 'success');
                }else{
                    $msg = array('msg' => 'Error al modificar el proveedor', 'icono' => 'error');
                }
            }
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function editar(int $id){

        $data = $this->model->editarProveedor($id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function eliminar(int $id)
    {
        $data = $this->model->accionProveedor(0, $id);
        if ($data == 1) {
            $msg = array('msg' => 'Proveedor eliminado exitosamente', 'icono' => 'success');
        }else{
            $msg = array('msg' => 'Error al eliminar el proveedor', 'icono' => 'error');
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function reingresar(int $id)
    {
        $data = $this->model->accionProveedor(1, $id);
        if ($data == 1) {
            $msg = array('msg' => 'Proveedor reingresado exitosamente', 'icono' => 'success');
        }else{
            $msg = array('msg' => 'Error al reingresar el proveedor', 'icono' => 'error');
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
        
}
?>