<?php include "Views/Templates/header.php"; ?>
<form action="<?php echo base_url; ?>Compras/pdf" method="POST" target="_blank">
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label for="min">Desde</label>
                <input type="date" value="<?php echo date('Y-m-d'); ?>" name="desde" id="min">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="hasta">Hasta</label>
                <input type="date" value="<?php echo date('Y-m-d'); ?>" name="hasta" id="hasta">
            </div>
        </div>
        <div class="col-md-3" id="btnPdf">
            <div class="form-group">
                <button type="submit" class="btn btn-danger">PDF</button>
            </div>
        </div>
    </div>
</form>
<div class="card mt-3">
    <div class="card-header bg-dark text-white">
        Ventas
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-light" id="t_historial_v">
                <thead class="table-dark">
                    <tr>
                        <th>Id</th>
                        <th>Clientes</th>
                        <th>Total</th>
                        <th>Fecha Venta</th>
                        <th>Estado</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include "Views/Templates/footer.php"; ?>