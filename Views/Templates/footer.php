</div>
</main>
<footer class="py-4 bg-light mt-auto">
    <div class="container-fluid px-4">
        <div class="d-flex align-items-center justify-content-between small">
        <div class="text-muted">Copyright &copy; <a href="https://pro-tec.netlify.app/" target="_blank" rel="noopener noreferrer">Visita nuestra página web</a> <?php echo date("Y"); ?></div>
            <div>
                <a href="#">Privacy Policy</a>
                &middot;
                <a href="#">Terms &amp; Conditions</a>
            </div>
        </div>
    </div>
</footer>
</div>
</div>
<div id="cambiarPass" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title">Modificar Contraseña</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="frmCambiarPass" onsubmit="frmCambiarPass(event);" >
                    <div class="form-floating mb-3">
                        <input id="clave_actual" class="form-control" type="password" name="clave_actual">
                        <label for="clave_actual">Contraseña Actual</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input id="clave_nueva" class="form-control" type="password" name="clave_nueva">
                        <label for="clave_nueva">Contraseña Nueva</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input id="confirmar_clave" class="form-control" type="password" name="confirmar_clave">
                        <label for="confirmar_clave">Confirmar Contraseña</label>
                    </div>
                    <button class="btn btn-primary" type="submit">Modificar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url; ?>Assets/js/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="<?php echo base_url; ?>Assets/DataTables/datatables.min.js"></script>
<script src="<?php echo base_url; ?>Assets/js/scripts.js"></script>
<script>
    const base_url = "<?php echo base_url; ?>"
</script>
<script src="<?php echo base_url; ?>Assets/js/sweetalert2.all.min.js"></script>
<script src="<?php echo base_url; ?>Assets/js/chart.min.js"></script>
<script src="<?php echo base_url; ?>Assets/js/funciones.js"></script>

</body>
</html>


