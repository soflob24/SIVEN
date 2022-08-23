<?php include "Views/Templates/header.php"; ?>
<div class="card">
    <div class="card-header bg-dark text-white">
        Datos de la empresa
    </div>
    <div class="card-body">
        <form id="frmEmpresa">
        <div class="row">
            <div class="col-md-6">
                <div class="form-floating mb-3">
                    <input id="id" class="form-control" type="hidden" name="id" value="<?php echo $data['id'] ?>">
                    <input id="rut" class="form-control mt-2" type="text" name="rut" value="<?php echo $data['rut'] ?>">
                    <label for="rut">Rut</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating mb-3">
                    <input id="nombre" class="form-control mt-2" type="text" name="nombre" value="<?php echo $data['nombre'] ?>">
                    <label for="nombre">Nombre</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating mb-3">
                    <input id="telefono" class="form-control mt-2" type="text" name="telefono" value="<?php echo $data['telefono'] ?>">
                    <label for="telefono">Teléfono</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating mb-3">
                    <input id="direccion" class="form-control mt-2" type="text" name="direccion" value="<?php echo $data['direccion'] ?>">
                    <label for="direccion">Dirección</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating mb-3">
                    <textarea id="mensaje" class="form-control mt-2" name="mensaje" rows="3"><?php echo $data['mensaje'] ?></textarea>
                    <label for="mensaje">Mensaje</label>
                </div>
            </div>
        </div>
        <button class="btn btn-primary" type="button" onclick="modificarEmpresa()">Modificar</button>
        </form>
    </div>
</div>

<?php include "Views/Templates/footer.php"; ?>