<?php include "Views/Templates/header.php"; ?>
<div class="card">
    <div class="card-header bg-primary text-white">
        Nueva Compra
    </div>
</div>
<div class="card">
    <div class="card-body">
        <form id="frmCompra">
            <div class="row">
                <div class="col-md-3 mb-3">
                    <div class="form-floating">
                        <input type="hidden" id="id" name="id">
                        <input id="codigo" class="form-control mt-2" type="text" name="codigo" onkeyup="buscarCodigo(event);">
                        <label for="codigo"><i class="fa-solid fa-barcode"></i> Código de barras</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-floating">
                        <input id="nombre" class="form-control mt-2" type="text" name="nombre" disabled>
                        <label for="nombre">Descripción</label>
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="form-floating">
                        <input id="cantidad" class="form-control mt-2" type="number" name="cantidad" onkeyup="calcularPrecio(event);" disabled>
                        <label for="cantidad">Cant</label>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-floating">
                        <input id="precio" class="form-control mt-2" type="text" name="precio" disabled>
                        <label for="precio">Precio</label>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-floating">
                        <input id="sub_total" class="form-control mt-2" type="text" name="sub_total">
                        <label for="sub_total">Sub Total</label>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="table-responsive">
    <table class="table table-light table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>Id</th>
                <th>Descripción</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>Sub Total</th>
                <th></th>
            </tr>
        </thead>
        <tbody id="tblDetalle">
        </tbody>
    </table>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-floating">
            <select name="proveedor" class="form-select mt-2" id="proveedor">
                <?php foreach ($data as $row) { ?>
                    <option value="<?php echo $row['id']; ?>"><?php echo $row['proveedor']; ?></option>
                <?php } ?>
            </select>
            <label for="proveedor">Seleccionar Proveedor</label>
        </div>
    </div>
    <div class="col-md-3 ms-auto">
        <div class="form-floating">
            <input id="total" class="form-control mt-2" type="text" name="total" placeholder="Total" disabled>
            <label for="total" class="fw-bold">Total a Pagar</label>
            <button class="btn btn-primary mt-2 w-100" type="button" onclick="procesar(1)">Generar Compra</button>
        </div>
    </div>
</div>
<?php include "Views/Templates/footer.php"; ?>

