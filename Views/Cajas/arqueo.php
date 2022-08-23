<?php include "Views/Templates/header.php"; ?>
<div class="card">
    <div class="card-header card-header-primary">
        Arqueo de Caja
    </div>
    <div class="card-body">
        <button class="btn btn-primary mb-3" type="button" onclick="arqueoCaja();">Nueva <i class="fas fa-plus"></i></button>
        <button class="btn btn-warning mb-3" type="button" onclick="cerrarCaja();">Cerrar <i class="fa-solid fa-x"></i></button>
        <div class="table-responsive">
            <table class="table table-light table-bordered table-hover" id="t_arqueo">
                <thead class="table-dark">
                    <tr>
                        <th>Id</th>
                        <th>Monto inicial</th>
                        <th>Monto final</th>
                        <th>Fecha apertura</th>
                        <th>Fecha cierre</th>
                        <th>Total ventas</th>
                        <th>Monto total</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Modal -->
<div id="abrir_caja" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="title">Arqueo Caja</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" id="frmAbrirCaja" onsubmit="abrirArqueo(event);">
                    <div class="form-floating mb-3">
                        <input type="hidden" id="id" name="id">
                        <input id="monto_inicial" class="form-control  mt-2" type="text" name="monto_inicial">
                        <label for="monto_inicial">Monto Inicial</label>
                    </div>
                    <div id="ocultar_campos">
                        <div class="form-floating mb-3">
                            <input id="monto_final" class="form-control" type="text" disabled>
                            <label for="monto_final">Monto Final</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input id="total_ventas" class="form-control" type="text" disabled>
                            <label for="total_ventas">Total Ventas</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input id="monto_general" class="form-control" type="text" disabled>
                            <label for="monto_general">Monto Total</label>
                        </div>
                    </div>
                    <button class="btn btn-primary mt-2" type="submit" id="btnAccion">Abrir</button>
                    <button class="btn btn-danger mt-2" type="button" data-bs-dismiss="modal">Cancelar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include "Views/Templates/footer.php"; ?>