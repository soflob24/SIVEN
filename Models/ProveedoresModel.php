<?php
class ProveedoresModel extends Query{
    private $proveedor, $id, $estado;
    public function __construct()
    {
        parent::__construct();
    }
    public function getProveedores()
    {
        $sql = "SELECT * FROM proveedores";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function registrarProveedor(string $proveedor)
    {
        $this->proveedor = $proveedor;
        $verificar = "SELECT * FROM proveedores WHERE proveedor = '$this->proveedor'";
        $existe = $this->select($verificar);
        if (empty($existe)) {
            $sql = "INSERT INTO proveedores (proveedor) VALUES (?)";
            $datos = array($this->proveedor);
            $data = $this->save($sql, $datos);
            if ($data == 1) {
                $res = "ok";
            }else{
                $res = "error";
            }
        }else{
            $res = "existe";
        }
        return $res;
    }
    public function modificarProveedor(string $proveedor, int $id)
    {
        $this->proveedor = $proveedor;
        $this->id = $id;
        $sql = "UPDATE proveedores SET proveedor = ? WHERE id = ?";
        $datos = array($this->proveedor, $this->id);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "modificado";
        } else {
            $res = "error";
        }
        return $res;
    }
    public function editarProveedor(int $id)
    {
        $sql = "SELECT * FROM proveedores WHERE id = $id";
        $data = $this->select($sql);
        return $data;
    }
    public function accionProveedor(int $estado, int $id)
    {
        $this->id = $id;
        $this->estado = $estado;
        $sql = "UPDATE proveedores SET estado = ? WHERE id = ?";
        $datos = array($this->estado, $this->id);
        $data = $this->save($sql, $datos);
        return $data;
    }
    public function verificarPermiso(int $id_user, string $nombre)
    {
        $sql = "SELECT p.id, p.permiso, d.id, d.id_usuario, d.id_permiso FROM permisos p INNER JOIN detalle_permisos d ON p.id = d.id_permiso WHERE d.id_usuario = $id_user AND p.permiso = '$nombre'";
        $data = $this->selectAll($sql);
        return $data;
    }
}
?>