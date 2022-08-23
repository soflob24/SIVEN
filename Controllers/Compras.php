<?php
class Compras extends Controller {
    public function __construct() {
        session_start();
        parent::__construct();
    }
    public function index()
    {
        $id_user = $_SESSION['id_usuario'];
        $verificar = $this->model->verificarPermiso($id_user, 'nueva_compra');
        if (!empty($verificar) || $id_user == 1) {
            $data = $this->model->getProveedores();
            $this->views->getView($this, 'index', $data);
        } else {
            header('Location: '.base_url. 'Errors/permisos');
        }
    }
    public function ventas()
    {
        $id_user = $_SESSION['id_usuario'];
        $verificar = $this->model->verificarPermiso($id_user, 'nueva_venta');
        if (!empty($verificar) || $id_user == 1) {
            $data = $this->model->getClientes();
            $this->views->getView($this, 'ventas', $data);
        } else {
            header('Location: '.base_url. 'Errors/permisos');
        }
    }
    public function buscarCodigo($cod)
    {
        $data = $this->model->getProCod($cod);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function ingresar()
    {
        $id = $_POST['id'];
        $datos = $this->model->getProductos($id);
        $id_producto = $datos['id'];
        $id_usuario = $_SESSION['id_usuario'];
        $precio = $datos['precio_compra'];
        $cantidad = $_POST['cantidad'];
        $comprobar = $this->model->consultarDetalle('detalle', $id_producto, $id_usuario);
        if (empty($comprobar)) {
            $sub_total = $precio * $cantidad;
            $data = $this->model->registrarDetalle('detalle', $id_producto, $id_usuario, $precio, $cantidad, $sub_total);
            if ($data == 'ok') {
                $msg = array('msg' => 'Producto ingresado a la compra', 'icono' => 'success');
            }else {
                $msg = array('msg' => 'Error al ingresar el producto a la compra', 'icono' => 'error');
            }
        }else {
            $total_cantidad = $comprobar['cantidad'] + $cantidad;
            $sub_total = $total_cantidad * $precio;
            $data = $this->model->actualizarDetalle('detalle', $precio, $total_cantidad, $sub_total, $id_producto, $id_usuario);
            if ($data == 'modificado') {
                $msg = array('msg' => 'Producto actualizado', 'icono' => 'success');
            }else {
                $msg = array('msg' => 'Error al modificar el producto', 'icono' => 'error');
            }
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function ingresarVenta()
    {
        $id = $_POST['id'];
        $datos = $this->model->getProductos($id);
        $id_producto = $datos['id'];
        $id_usuario = $_SESSION['id_usuario'];
        $precio = $datos['precio_venta'];
        $cantidad = $_POST['cantidad'];
        $comprobar = $this->model->consultarDetalle('detalle_temp', $id_producto, $id_usuario);
        if (empty($comprobar)) {
            if ($datos['cantidad'] >= $cantidad) {
                $sub_total = $precio * $cantidad;
                $data = $this->model->registrarDetalle('detalle_temp', $id_producto, $id_usuario, $precio, $cantidad, $sub_total);
                if ($data == 'ok') {
                    $msg = array('msg' => 'Producto ingresado a la venta', 'icono' => 'success');
                }else {
                    $msg = array('msg' => 'Error al ingresar el producto a la venta', 'icono' => 'error');
                }
            }else{
                $msg = array('msg' => 'Stock no disponible: '.$datos['cantidad'], 'icono' => 'warning');
            }
        }else {
            $total_cantidad = $comprobar['cantidad'] + $cantidad;
            $sub_total = $total_cantidad * $precio;
            if ($datos['cantidad'] < $total_cantidad) {
                $msg = array('msg' => 'Stock no disponible', 'icono' => 'warning');
            } else{
                $data = $this->model->actualizarDetalle('detalle_temp', $precio, $total_cantidad, $sub_total, $id_producto, $id_usuario);
                if ($data == 'modificado') {
                    $msg = array('msg' => 'Producto actualizado', 'icono' => 'success');
                }else {
                    $msg = array('msg' => 'Error al modificar el producto', 'icono' => 'error');
                }
            }
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function listar($table)
    {
        $id_usuario = $_SESSION['id_usuario'];
        $data['detalle'] = $this->model->getDetalle($table, $id_usuario);

        $data['total_pagar'] = $this->model->calcularCompra($table, $id_usuario);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function delete($id)
    {
        $data = $this->model->deleteDetalle('detalle', $id);
        if ($data == 'ok') {
            $msg = array('msg' => 'Producto eliminado', 'icono' => 'success');
        }else {
            $msg = array('msg' => 'Error al eliminar el producto', 'icono' => 'error');
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function deleteVenta($id)
    {
        $data = $this->model->deleteDetalle('detalle_temp', $id);
        if ($data == 'ok') {
            $msg = array('msg' => 'Producto eliminado', 'icono' => 'success');
        }else {
            $msg = array('msg' => 'Error al eliminar el producto', 'icono' => 'error');
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function registrarCompra($id_proveedor)
    {
        $id_usuario = $_SESSION['id_usuario'];
        $total = $this->model->calcularCompra('detalle', $id_usuario);
        $data = $this->model->registrarCompra($id_proveedor, $total['total']);
        if ($data == 'ok') {
            $detalle = $this->model->getDetalle('detalle', $id_usuario);
            $id_compra = $this->model->getId('compras');
            foreach ($detalle as $row) {
                $cantidad = $row['cantidad'];
                $precio = $row['precio'];
                $id_pro = $row['id_producto'];
                $sub_total = $cantidad * $precio;
                $this->model->registrarDetalleCompra($id_compra['id'], $id_pro, $cantidad, $precio, $sub_total);
                $stock_actual = $this->model->getProductos($id_pro);
                $stock = $stock_actual['cantidad'] + $cantidad;
                $this->model->actualizarStock($stock, $id_pro);
            }
            $vaciar = $this->model->vaciarDetalle('detalle', $id_usuario);
            if ($vaciar == 'ok') {
                $msg = array('msg' => 'ok', 'id_compra' => $id_compra['id']);
            }
        }else {
            $msg = array('msg' => 'Error al realizar la compra', 'icono' => 'error');
            
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function registrarVenta($id_cliente)
    {
        $id_usuario = $_SESSION['id_usuario'];
        $verificar = $this->model->verificarCaja($id_usuario);
        if (empty($verificar)) {
            $msg = array ('msg' => 'La caja se encuentra cerrada', 'icono' => 'warning');
        } else {
            $total = $this->model->calcularCompra('detalle_temp', $id_usuario);
            $data = $this->model->registrarVenta($id_usuario, $id_cliente, $total['total']);
            if ($data == 'ok') {
                $detalle = $this->model->getDetalle('detalle_temp', $id_usuario);
                $id_venta = $this->model->getId('ventas');
                foreach ($detalle as $row) {
                    $cantidad = $row['cantidad'];
                    $desc = $row['descuento'];
                    $precio = $row['precio'];
                    $id_pro = $row['id_producto'];
                    $sub_total = ($cantidad * $precio) - $desc;
                    $this->model->registrarDetalleVenta($id_venta['id'], $id_pro, $cantidad, $desc, $precio, $sub_total);
                    $stock_actual = $this->model->getProductos($id_pro);
                    $stock = $stock_actual['cantidad'] - $cantidad;
                    $this->model->actualizarStock($stock, $id_pro);
                }
                $vaciar = $this->model->vaciarDetalle('detalle_temp', $id_usuario);
                if ($vaciar == 'ok') {
                    $msg = array('msg' => 'ok', 'id_venta' => $id_venta['id']);
                }
            }else {
                $msg = array('msg' => 'Error al realizar la venta', 'icono' => 'error');    
            }
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function generarPdf($id_compra)
    {
        $empresa = $this->model->getEmpresa();
        $productos = $this->model->getProCompra($id_compra);
        require('Libraries/fpdf/fpdf.php');

        $pdf = new FPDF('P','mm', array(85, 200));
        $pdf->AddPage();
        $pdf->SetMargins(5, 0, 0);
        $pdf->setTitle('Reporte de Compra');
        $pdf->SetFont('Arial','B',14);
        $pdf->Cell(65,10, utf8_decode($empresa['nombre']), 0, 1, 'C');
        $pdf->Image(base_url . 'Assets/img/logo.png', 57, 20, 23, 21);
        $pdf->SetFont('Arial','B',9);
        $pdf->Cell(18, 5, 'Rut: ', 0, 0, 'L');
        $pdf->SetFont('Arial','',9);
        $pdf->Cell(20, 5, $empresa['rut'], 0, 1, 'L');

        $pdf->SetFont('Arial','B',9);
        $pdf->Cell(18, 5, utf8_decode('Teléfono: '), 0, 0, 'L');
        $pdf->SetFont('Arial','',9);
        $pdf->Cell(20, 5, $empresa['telefono'], 0, 1, 'L');

        $pdf->SetFont('Arial','B',9);
        $pdf->Cell(18, 5, utf8_decode('Dirección: '), 0, 0, 'L');
        $pdf->SetFont('Arial','',9);
        $pdf->Cell(20, 5, utf8_decode($empresa['direccion']), 0, 1, 'L');

        $pdf->SetFont('Arial','B',9);
        $pdf->Cell(18, 5, 'Folio: ', 0, 0, 'L');
        $pdf->SetFont('Arial','',9);
        $pdf->Cell(20, 5, $id_compra, 0, 1, 'L');
        $pdf->Ln();
        //Encabezado de proveedores
        $pdf->SetFillColor(6, 68, 124);
        $pdf->SetTextColor(255,255,255);
        $pdf->SetFont('Arial','B',8);
        $pdf->Cell(75, 5, 'Proveedor', 0, 1, 'L', true);
        $pdf->SetTextColor(0,0,0);
        $proveedores = $this->model->proveedoresCompra($id_compra);
        $pdf->SetFont('Arial','',8);
        $pdf->Cell(75, 5, $proveedores['proveedor'], 0, 1, 'L');
        $pdf->Ln();
        //Encabezado de productos
        $pdf->SetFillColor(6, 68, 124);
        $pdf->SetTextColor(255,255,255);
        $pdf->SetFont('Arial','B',8);
        $pdf->Cell(10, 5, 'Cant', 0, 0, 'L', true);
        $pdf->Cell(35, 5, utf8_decode('Descripción'), 0, 0, 'L', true);
        $pdf->Cell(15, 5, 'Precio', 0, 0, 'L', true);
        $pdf->Cell(15, 5, 'Sub Total', 0, 1, 'L', true);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetFont('Arial','',8);
        $total = 0.00;
        foreach ($productos as $row) {
            $total = $total + $row['sub_total'];
            $pdf->Cell(10, 5, $row['cantidad'], 0, 0, 'L');
            $pdf->Cell(35, 5, utf8_decode($row['descripcion']), 0, 0, 'L');
            $pdf->Cell(15, 5, $row['precio'], 0, 0, 'L');
            $pdf->Cell(15, 5, number_format($row['sub_total'], 3, '.', ','), 0, 1, 'L');
        }
        $pdf->Ln();
        $pdf->Cell(70, 5, 'Total a pagar', 0, 1, 'R');
        $pdf->Cell(70, 5, number_format($total, 3, '.', ','), 0, 1, 'R');
        $pdf->Output();
    }
    public function generarPdfVenta($id_venta)
    {
        $empresa = $this->model->getEmpresa();
        $descuento = $this->model->getDescuento($id_venta);
        $productos = $this->model->getProVenta($id_venta);
        require('Libraries/fpdf/fpdf.php');

        $pdf = new FPDF('P','mm', array(85, 200));
        $pdf->AddPage();
        $pdf->SetMargins(5, 0, 0);
        $pdf->setTitle('Reporte de Venta');
        $pdf->SetFont('Arial','B',14);
        $pdf->Cell(65,10, utf8_decode($empresa['nombre']), 0, 1, 'C');
        $pdf->Image(base_url . 'Assets/img/logo.png', 57, 20, 23, 21);
        $pdf->SetFont('Arial','B',9);
        $pdf->Cell(18, 5, 'Rut: ', 0, 0, 'L');
        $pdf->SetFont('Arial','',9);
        $pdf->Cell(20, 5, $empresa['rut'], 0, 1, 'L');

        $pdf->SetFont('Arial','B',9);
        $pdf->Cell(18, 5, utf8_decode('Teléfono: '), 0, 0, 'L');
        $pdf->SetFont('Arial','',9);
        $pdf->Cell(20, 5, $empresa['telefono'], 0, 1, 'L');

        $pdf->SetFont('Arial','B',9);
        $pdf->Cell(18, 5, utf8_decode('Dirección: '), 0, 0, 'L');
        $pdf->SetFont('Arial','',9);
        $pdf->Cell(20, 5, utf8_decode($empresa['direccion']), 0, 1, 'L');

        $pdf->SetFont('Arial','B',9);
        $pdf->Cell(18, 5, 'Folio: ', 0, 0, 'L');
        $pdf->SetFont('Arial','',9);
        $pdf->Cell(20, 5, $id_venta, 0, 1, 'L');
        $pdf->Ln();
        //Encabezado de clientes
        $pdf->SetFillColor(6, 68, 124);
        $pdf->SetTextColor(255,255,255);
        $pdf->SetFont('Arial','B',7);
        $pdf->Cell(25, 5, 'Cliente', 0, 0, 'L', true);
        $pdf->Cell(25, 5, utf8_decode('Teléfono'), 0, 0, 'L', true);
        $pdf->Cell(25, 5, utf8_decode('Dirección'), 0, 1, 'L', true);
        $pdf->SetTextColor(0,0,0);
        $clientes = $this->model->clientesVenta($id_venta);
        $pdf->SetFont('Arial','',7);
        $pdf->Cell(25, 5, $clientes['nombre'], 0, 0, 'L');
        $pdf->Cell(25, 5, $clientes['telefono'], 0, 0, 'L');
        $pdf->Cell(25, 5, utf8_decode($clientes['direccion']), 0, 1, 'L');
        $pdf->Ln();
        //Encabezado de productos
        $pdf->SetFillColor(6, 68, 124);
        $pdf->SetTextColor(255,255,255);
        $pdf->SetFont('Arial','B',7);
        $pdf->Cell(10, 5, 'Cant', 0, 0, 'L', true);
        $pdf->Cell(35, 5, utf8_decode('Descripción'), 0, 0, 'L', true);
        $pdf->Cell(15, 5, 'Precio', 0, 0, 'L', true);
        $pdf->Cell(15, 5, 'Sub Total', 0, 1, 'L', true);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetFont('Arial','',7);
        $total = 0.00;
        foreach ($productos as $row) {
            $total = $total + $row['sub_total'];
            $pdf->Cell(10, 5, $row['cantidad'], 0, 0, 'L');
            $pdf->Cell(35, 5, utf8_decode($row['descripcion']), 0, 0, 'L');
            $pdf->Cell(15, 5, $row['precio'], 0, 0, 'L');
            $pdf->Cell(15, 5, number_format($row['sub_total'], 3, '.', ','), 0, 1, 'L');
        }
        $pdf->Ln();
        $pdf->Cell(70, 5, 'Descuento', 0, 1, 'R');
        $pdf->Cell(70, 5, number_format($descuento['total'], 3, '.', ','), 0, 1, 'R');
        $pdf->Cell(70, 5, 'Total a pagar', 0, 1, 'R');
        $pdf->Cell(70, 5, number_format($total, 3, '.', ','), 0, 1, 'R');
        $pdf->Output();
    }
    public function historial()
    {
        $id_user = $_SESSION['id_usuario'];
        $verificar = $this->model->verificarPermiso($id_user, 'historial_compras');
        if (!empty($verificar) || $id_user == 1) {
            $this->views->getView($this, 'historial');
        } else {
            header('Location: '.base_url. 'Errors/permisos');
        }
    }
    public function historial_ventas()
    {
        $id_user = $_SESSION['id_usuario'];
        $verificar = $this->model->verificarPermiso($id_user, 'historial_ventas');
        if (!empty($verificar) || $id_user == 1) {
            $this->views->getView($this, 'historial_ventas');
        } else {
            header('Location: '.base_url. 'Errors/permisos');
        }
    }
    public function listar_historial()
    {
        $data = $this->model->getHistorialCompras();
        for ($i=0; $i < count($data); $i++) {
            if ($data[$i]['estado'] == 1) {
                $data[$i]['estado'] = '<span class="badge bg-success">Completado</span>';
                $data[$i]['acciones'] = '<div>
                <button class="btn btn-warning" onclick="btnAnularC('.$data[$i]['id'].')"><i class="fa-solid fa-ban"></i></button>
                <a class="btn btn-danger" href="'.base_url. "Compras/generarPdf/".$data[$i]['id'].'" target="_blank"><i class="fas fa-file-pdf"></i></a>
                <div/>';

            }else{
                $data[$i]['estado'] = '<span class="badge bg-danger">Anulado</span>';
                $data[$i]['acciones'] = '<div>
                <a class="btn btn-danger" href="'.base_url. "Compras/generarPdf/".$data[$i]['id'].'" target="_blank"><i class="fas fa-file-pdf"></i></a>
                <div/>';
            }
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function listar_historial_venta()
    {
        $data = $this->model->getHistorialVentas();
        for ($i=0; $i < count($data); $i++) {
            if ($data[$i]['estado'] == 1) {
                $data[$i]['estado'] = '<span class="badge bg-success">Completado</span>';
                $data[$i]['acciones'] = '<div>
                <button class="btn btn-warning" onclick="btnAnularV('.$data[$i]['id'].')"><i class="fa-solid fa-ban"></i></button>
                <a class="btn btn-danger" href="'.base_url. "Compras/generarPdfVenta/".$data[$i]['id'].'" target="_blank"><i class="fas fa-file-pdf"></i></a>
                <div/>';

            }else{
                $data[$i]['estado'] = '<span class="badge bg-danger">Anulado</span>';
                $data[$i]['acciones'] = '<div>
                <a class="btn btn-danger" href="'.base_url. "Compras/generarPdfVenta/".$data[$i]['id'].'" target="_blank"><i class="fas fa-file-pdf"></i></a>
                <div/>';
            }
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function calcularDescuento($datos)
    {
        $array = explode(",", $datos);
        $id = $array[0];
        $desc = $array[1];
        if (empty($id) || empty($desc)) {
            $msg = array('msg' => 'Error', 'icono' => 'error');
        }else {
            $descuento_actual = $this->model->verificarDescuento($id);
            $descuento_total = $descuento_actual['descuento'] + $desc;
            $sub_total = ($descuento_actual['cantidad'] * $descuento_actual['precio']) - $descuento_total;
            $data = $this->model->actualizarDescuento($descuento_total, $sub_total, $id);
            if ($data == 'ok') {
                $msg = array('msg' => 'Descuento aplicado', 'icono' => 'success');
            }else {
                $msg = array('msg' => 'Error al aplicar el descuento', 'icono' => 'error');
            }
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function anularCompra($id_compra)
    {
        $data = $this->model->getAnularCompra($id_compra);
        $anular = $this->model->getAnular($id_compra);
        foreach ($data as $row) {
            $stock_actual = $this->model->getProductos($row['id_producto']);
            $stock = $stock_actual['cantidad'] - $row['cantidad'];
            $this->model->actualizarStock($stock, $row['id_producto']);
        }
        if ($anular == 'ok') {
            $msg = array('msg' => 'Compra anulada', 'icono' => 'success');
        }else {
            $msg = array('msg' => 'Error al anular la compra', 'icono' => 'error');
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function anularVenta($id_venta)
    {
        $data = $this->model->getAnularVenta($id_venta);
        $anularV = $this->model->getAnularV($id_venta);
        foreach ($data as $row) {
            $stock_actual = $this->model->getProductos($row['id_producto']);
            $stock = $stock_actual['cantidad'] + $row['cantidad'];
            $this->model->actualizarStock($stock, $row['id_producto']);
        }
        if ($anularV == 'ok') {
            $msg = array('msg' => 'Venta anulada', 'icono' => 'success');
        }else {
            $msg = array('msg' => 'Error al anular la venta', 'icono' => 'error');
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function pdf()
    {
        $empresa = $this->model->getEmpresa();
        $desde = $_POST['desde'];
        $hasta = $_POST['hasta'];
        if (empty($desde) || empty($hasta)){
           $data = $this->model->getHistorialVentas();
        }else {
            $data = $this->model->getRangoFechas($desde, $hasta);
        }
        require('Libraries/fpdf/fpdf.php');

        $pdf = new FPDF('P','mm', array(297, 170));
        $pdf->AddPage();
        $pdf->SetMargins(10, 0, 0);
        $pdf->setTitle('Reporte de Ventas');
        $pdf->SetFont('Arial','B',16);
        $pdf->Cell(150, 5, utf8_decode($empresa['nombre']), 0, 1, 'C',);
        $pdf->Ln();
        $pdf->Image(base_url . 'Assets/img/logo.png', 130, 12, 27, 25);
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(20, 5, 'Rut: ', 0, 0, 'L');
        $pdf->SetFont('Arial','',10);
        $pdf->Cell(20, 5, $empresa['rut'], 0, 1, 'L');

        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(20, 5, utf8_decode('Teléfono: '), 0, 0, 'L');
        $pdf->SetFont('Arial','',10);
        $pdf->Cell(20, 5, $empresa['telefono'], 0, 1, 'L');

        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(20, 5, utf8_decode('Dirección: '), 0, 0, 'L');
        $pdf->SetFont('Arial','',10);
        $pdf->Cell(20, 5, utf8_decode($empresa['direccion']), 0, 1, 'L');
        $pdf->Ln();

        $pdf->SetFont('Arial','B',12);
        $pdf->SetFillColor(6, 68, 124);
        $pdf->SetTextColor(255,255,255);
        
        $pdf->Cell(10, 7, 'Id', 0, 0, 'L', true);
        $pdf->Cell(80, 7, 'Cliente', 0, 0, 'L', true);
        $pdf->Cell(40, 7, 'Fecha y Hora', 0, 0, 'L', true);
        $pdf->Cell(20, 7, 'Total', 0, 1, 'L', true);
        $pdf->Ln(2);

        $pdf->SetFont('Arial','',10);
        $pdf->SetTextColor(0,0,0);
        foreach ($data as $row) {
            $pdf->Cell(10, 5, $row['id'], 0, 0, 'L');
            $pdf->Cell(80, 5, $row['nombre'], 0, 0, 'L');
            $pdf->Cell(40, 5, $row['fecha'], 0, 0, 'L');
            $pdf->Cell(20, 5, $row['total'], 0, 1, 'L');
        }
        $pdf->Output();
    }
}
