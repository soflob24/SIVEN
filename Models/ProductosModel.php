<?php
class ProductosModel extends Query{
    private $codigo, $nombre, $precio_compra, $precio_venta, $id_categoria, $id_proveedor, $id, $estado;
    public function __construct()
    {
        parent::__construct();
    }
    public function getCategorias()
    {
        $sql = "SELECT * FROM categorias WHERE estado = 1";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function getProveedores()
    {
        $sql = "SELECT * FROM proveedores WHERE estado = 1";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function getProductos()
    {
        $sql = "SELECT p.*, c.id AS id_categoria, c.categoria, proveedores.id AS id_proveedor, proveedores.proveedor FROM productos p INNER JOIN categorias c ON p.id_categoria = c.id INNER JOIN proveedores ON p.id_proveedor = proveedores.id";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function registrarProducto(string $codigo, string $nombre, string $precio_compra, string $precio_venta, string $id_categoria, string $id_proveedor)
    {
        $this->codigo = $codigo;
        $this->nombre = $nombre;
        $this->precio_compra = $precio_compra;
        $this->precio_venta = $precio_venta;
        $this-> id_categoria = $id_categoria;
        $this->id_proveedor = $id_proveedor;
        $verificar = "SELECT * FROM productos WHERE codigo = '$this->codigo'";
        $existe = $this->select($verificar);
        if (empty($existe)) {
            $sql = "INSERT INTO productos(codigo, descripcion, precio_compra, precio_venta, id_categoria, id_proveedor ) VALUES (?,?,?,?,?,?)";
            $datos = array($this->codigo, $this->nombre, $this->precio_compra, $this->precio_venta, $this->id_categoria, $this->id_proveedor);
            $data = $this->save($sql, $datos);
            if ($data == 1) {
                $res = 'ok';
            }else{
                $res = "error";
            }
        }else {
            $res = "existe";
        }
        return $res;
    }
    public function modificarProducto(string $codigo, string $nombre, string $precio_compra, string $precio_venta, string $id_categoria, string $id_proveedor, int $id)
    {
        $this->codigo = $codigo;
        $this->nombre = $nombre;
        $this->precio_compra = $precio_compra;
        $this->precio_venta = $precio_venta;
        $this-> id_categoria = $id_categoria;
        $this->id_proveedor = $id_proveedor;
        $this->id = $id;
        $sql = "UPDATE productos SET codigo = ?, descripcion = ?, precio_compra = ?, precio_venta = ?, id_categoria = ?, id_proveedor = ? WHERE id = ?";
            $datos = array($this->codigo, $this->nombre, $this->precio_compra, $this->precio_venta, $this->id_categoria, $this->id_proveedor, $this->id);
            $data = $this->save($sql, $datos);
            if ($data == 1) {
                $res = 'modificado';
            }else{
                $res = "error";
            }
        return $res;
    }
    public function editarPro(int $id){
        
        $sql = "SELECT * FROM productos WHERE id = $id";
        $data = $this->select($sql);
        return $data;
    }
    public function accionPro(int $estado, int $id)
    {
        $this->id = $id;
        $this->estado = $estado;
        $sql = "UPDATE productos SET estado = ? WHERE id = ?";
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