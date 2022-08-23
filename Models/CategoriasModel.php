<?php
class CategoriasModel extends Query{
    private $categoria, $id, $estado;
    public function __construct()
    {
        parent::__construct();
    }
    public function getCategorias()
    {
        $sql = "SELECT * FROM categorias";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function registrarCategoria(string $categoria)
    {
        $this->categoria = $categoria;
        $verificar = "SELECT * FROM categorias WHERE categoria = '$this->categoria'";
        $existe = $this->select($verificar);
        if (empty($existe)) {
            $sql = "INSERT INTO categorias (categoria) VALUES (?)";
            $datos = array($this->categoria);
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
    public function modificarCategoria(string $categoria, int $id)
    {
        $this->categoria = $categoria;
        $this->id = $id;
        $sql = "UPDATE categorias SET categoria = ? WHERE id = ?";
        $datos = array($this->categoria, $this->id);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "modificado";
        } else {
            $res = "error";
        }
        return $res;
    }
    public function editarCategoria(int $id)
    {
        $sql = "SELECT * FROM categorias WHERE id = $id";
        $data = $this->select($sql);
        return $data;
    }
    public function accionCategoria(int $estado, int $id)
    {
        $this->id = $id;
        $this->estado = $estado;
        $sql = "UPDATE categorias SET estado = ? WHERE id = ?";
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