let tblUsuarios, tblClientes, tblCajas, tblCategorias, tblProveedores, tblProductos, t_h_c, t_h_v, t_arqueo;
document.addEventListener("DOMContentLoaded", function () {
  const buttons = [{
    extend: 'excelHtml5',
    footer: true,
    title: 'Archivo',
    filename: 'Export_File',
    text: '<span class="badge bg-success"><i class="fas fa-file-excel"></i></span>'
  },
  {
    extend: 'pdfHtml5',
    download: 'open',
    footer: true,
    title: 'Reporte de usuarios',
    filename: 'Reporte de usuarios',
    text: '<span class="badge  bg-danger"><i class="fas fa-file-pdf"></i></span>',
    exportOptions: {
      columns: [0, ':visible']
    }
  },
  {
    extend: 'print',
    footer: true,
    filename: 'Export_File_print',
    text: '<span class="badge bg-dark"><i class="fas fa-print"></i></span>'
  },
  {
    extend: 'csvHtml5',
    footer: true,
    filename: 'Export_File_csv',
    text: '<span class="badge  bg-success"><i class="fas fa-file-csv"></i></span>'
  }, {
    extend: 'colvis',
    text: '<span class="badge  bg-info"><i class="fas fa-columns"></i></span>',
    postfixButtons: ['colvisRestore']
  }
  ]
  const dom = "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>" +
    "<'row'<'col-sm-12'tr>>" +
    "<'row'<'col-sm-5'i><'col-sm-7'p>>";
  tblUsuarios = $("#tblUsuarios").DataTable({
    ajax: {
      url: base_url + "Usuarios/listar",
      dataSrc: '',
    },
    columns: [
      {'data': 'id'},
      {'data': 'usuario'},
      {'data': 'nombre'},
      {'data': 'caja'},
      {'data': 'estado'},
      {'data': 'acciones'},
    ],
    language: {
      url: "//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json",
    },
    dom,
    buttons
  });
  // Fin de la tabla usuarios
  tblClientes = $("#tblClientes").DataTable({
    ajax: {
      url: base_url + "Clientes/listar",
      dataSrc: '',
    },
    columns: [
      {'data': 'id'},
      {'data': 'documento'},
      {'data': 'nombre'},
      {'data': 'telefono'},
      {'data': 'direccion'},
      {'data': 'estado'},
      {'data': 'acciones'},
    ],
    language: {
      url: "//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json",
    },
    dom,
    buttons
  });
  // Fin de la tabla clientes
  tblCajas = $("#tblCajas").DataTable({
    ajax: {
      url: base_url + "Cajas/listar",
      dataSrc: '',
    },
    columns: [
      {'data': 'id'},
      {'data': 'caja'},
      {'data': 'estado'},
      {'data': 'acciones'},
    ],
    language: {
      url: "//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json",
    },
    dom,
    buttons
  });
  //Fin de la tabla cajas
  tblCategorias = $("#tblCategorias").DataTable({
    ajax: {
      url: base_url + "Categorias/listar",
      dataSrc: '',
    },
    columns: [
      {'data': 'id'},
      {'data': 'categoria'},
      {'data': 'estado'},
      {'data': 'acciones'},
    ],
    language: {
      url: "//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json",
    },
    dom,
    buttons
  });
  // Fin de la tabla categorias
  tblProveedores = $("#tblProveedores").DataTable({
    ajax: {
      url: base_url + "Proveedores/listar",
      dataSrc: '',
    },
    columns: [
      {'data': 'id'},
      {'data': 'proveedor'},
      {'data': 'estado'},
      {'data': 'acciones'},
    ],
    language: {
      url: "//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json",
    },
    dom,
    buttons
  });
  // Fin de la tabla proveedores
  tblProductos = $("#tblProductos").DataTable({
    ajax: {
      url: base_url + "Productos/listar",
      dataSrc: '',
    },
    columns: [
      {'data': 'id'},
      {'data': 'codigo'},
      {'data': 'descripcion'},
      {'data': 'precio_venta'},
      {'data': 'cantidad'},
      {'data': 'estado'},
      {'data': 'acciones'},
    ],
    language: {
      url: "//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json",
    },
    dom,
    buttons
  });
  // Fin de la tabla productos
  t_h_c = $("#t_historial_c").DataTable({
    ajax: {
      url: base_url + "Compras/listar_historial",
      dataSrc: '',
    },
    columns: [
      {'data': 'id'},
      {'data': 'proveedor'},
      {'data': 'total'},
      {'data': 'fecha'},
      {'data': 'estado'},
      {'data': 'acciones'},
    ],
    language: {
      url: "//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json",
    },
    dom,
    buttons
  });
  t_h_v = $("#t_historial_v").DataTable({
    ajax: {
      url: base_url + "Compras/listar_historial_venta",
      dataSrc: '',
    },
    columns: [
      {'data': 'id'},
      {'data': 'nombre'},
      {'data': 'total'},
      {'data': 'fecha'},
      {'data': 'estado'},
      {'data': 'acciones'},
    ],
    language: {
      url: "//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json",
    },
    dom,
    buttons
  });
  t_arqueo = $("#t_arqueo").DataTable({
    ajax: {
      url: base_url + "Cajas/listar_arqueo",
      dataSrc: '',
    },
    columns: [
      {'data': 'id'},
      {'data': 'monto_inicial'},
      {'data': 'monto_final'},
      {'data': 'fecha_apertura'},
      {'data': 'fecha_cierre'},
      {'data': 'total_ventas'},
      {'data': 'monto_total'},
      {'data': 'estado'},
    ],
    language: {
      url: "//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json",
    },
    dom,
    buttons
  });
});
function frmCambiarPass(e) {
  e.preventDefault();
  const actual = document.getElementById("clave_actual").value;
  const nueva = document.getElementById("clave_nueva").value;
  const confirmar = document.getElementById("confirmar_clave").value;
  if (actual =='' || nueva == '' || confirmar == '') {
    alertas('Todos los campos son obligatorios', 'warning');
  }else{
    if (nueva != confirmar) {
      alertas ('las contraseñas no coinciden', 'warning');
    }else{
      const url = base_url + "Usuarios/cambiarPass";
      const frm = document.getElementById("frmCambiarPass");
      const http = new XMLHttpRequest();
      http.open("POST", url, true);
      http.send(new FormData(frm));
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          const res = JSON.parse(this.responseText);
          $("#cambiarPass").modal("hide");
          alertas(res.msg, res.icono);
          frm.reset();
        }
      };
    }
  }
}

function frmUsuario() {
  document.getElementById("title").innerHTML = "Nuevo Usuario";
  document.getElementById("btnAccion").innerHTML = "Registrar";
  document.getElementById("claves").classList.remove("d-none");
  document.getElementById("frmUsuario").reset();
  $("#nuevo_usuario").modal("show");
  document.getElementById("id").value = "";
}
function registrarUser(e) {
  e.preventDefault();
  const usuario = document.getElementById("usuario");
  const nombre = document.getElementById("nombre");
  const caja = document.getElementById("caja");
  if (usuario.value == "" || nombre.value == "" || caja.value == "") {
    alertas("Todo los campos son obligatorios", "warning");
  } else {
    const url = base_url + "Usuarios/registrar";
    const frm = document.getElementById("frmUsuario");
    const http = new XMLHttpRequest();
    http.open("POST", url, true);
    http.send(new FormData(frm));
    http.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        const res = JSON.parse(this.responseText);
        alertas(res.msg, res.icono);
        frm.reset();
        $("#nuevo_usuario").modal("hide");
        tblUsuarios.ajax.reload();
      }
    };
  }
}
function btnEditarUser(id) {
  document.getElementById("title").innerHTML = "Actualizar Usuario";
  document.getElementById("btnAccion").innerHTML = "Modificar";
  const url = base_url + "Usuarios/editar/" + id;
  const http = new XMLHttpRequest();
  http.open("GET", url, true);
  http.send();
  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      const res = JSON.parse(this.responseText);
      document.getElementById("id").value = res.id;
      document.getElementById("usuario").value = res.usuario;
      document.getElementById("nombre").value = res.nombre;
      document.getElementById("caja").value = res.id_caja;
      document.getElementById("claves").classList.add("d-none");
      $("#nuevo_usuario").modal("show");
    }
  };
}
function btnEliminarUser(id) {
  Swal.fire({
    title: "Está seguro de eliminar?",
    text: "El usuario cambiará a estado inactivo!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si",
    cancelButtonText: "Cancelar",
  }).then((result) => {
    if (result.isConfirmed) {
      const url = base_url + "Usuarios/eliminar/" + id;
      const http = new XMLHttpRequest();
      http.open("GET", url, true);
      http.send();
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          const res = JSON.parse(this.responseText);
          alertas(res.msg, res.icono);
          tblUsuarios.ajax.reload();
        }
      };
    }
  });
}
function btnReingresarUser(id) {
  Swal.fire({
    title: "Está seguro de reingresar?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si",
    cancelButtonText: "Cancelar",
  }).then((result) => {
    if (result.isConfirmed) {
      const url = base_url + "Usuarios/reingresar/" + id;
      const http = new XMLHttpRequest();
      http.open("GET", url, true);
      http.send();
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          const res = JSON.parse(this.responseText);
          alertas(res.msg, res.icono);
          tblUsuarios.ajax.reload();
        }
      };
    }
  });
}
// Fin Usuarios

function frmCliente() {
  document.getElementById("title").innerHTML = "Nuevo Cliente";
  document.getElementById("btnAccion").innerHTML = "Registrar";
  document.getElementById("frmCliente").reset();
  $("#nuevo_cliente").modal("show");
  document.getElementById("id").value = "";
}
function registrarCli(e) {
  e.preventDefault();
  const documento = document.getElementById("documento");
  const nombre = document.getElementById("nombre");
  const telefono = document.getElementById("telefono");
  const direccion = document.getElementById("direccion");
  if (
    documento.value == "" || nombre.value == "" || telefono.value == "" || direccion.value == "") {
    alertas("Todo los campos son obligatorios", "warning");
  } else {
    const url = base_url + "Clientes/registrar";
    const frm = document.getElementById("frmCliente");
    const http = new XMLHttpRequest();
    http.open("POST", url, true);
    http.send(new FormData(frm));
    http.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        console.log(this.responseText);
        const res = JSON.parse(this.responseText);
        alertas(res.msg, res.icono);
        frm.reset();
        $("#nuevo_cliente").modal("hide");
        tblClientes.ajax.reload();
      }
    };
  }
}
function btnEditarCli(id) {
  document.getElementById("title").innerHTML = "Actualizar Cliente";
  document.getElementById("btnAccion").innerHTML = "Modificar";
  const url = base_url + "Clientes/editar/" + id;
  const http = new XMLHttpRequest();
  http.open("GET", url, true);
  http.send();
  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      const res = JSON.parse(this.responseText);
      document.getElementById("id").value = res.id;
      document.getElementById("documento").value = res.documento;
      document.getElementById("nombre").value = res.nombre;
      document.getElementById("telefono").value = res.telefono;
      document.getElementById("direccion").value = res.direccion;
      $("#nuevo_cliente").modal("show");
    }
  };
}
function btnEliminarCli(id) {
  Swal.fire({
    title: "Está seguro de eliminar?",
    text: "El cliente cambiará a estado inactivo!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si",
    cancelButtonText: "Cancelar",
  }).then((result) => {
    if (result.isConfirmed) {
      const url = base_url + "Clientes/eliminar/" + id;
      const http = new XMLHttpRequest();
      http.open("GET", url, true);
      http.send();
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          const res = JSON.parse(this.responseText);
          alertas(res.msg, res.icono);
          tblClientes.ajax.reload();
        }
      };
    }
  });
}
function btnReingresarCli(id) {
  Swal.fire({
    title: "Está seguro de reingresar?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si",
    cancelButtonText: "Cancelar",
  }).then((result) => {
    if (result.isConfirmed) {
      const url = base_url + "Clientes/reingresar/" + id;
      const http = new XMLHttpRequest();
      http.open("GET", url, true);
      http.send();
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          const res = JSON.parse(this.responseText);
          alertas(res.msg, res.icono);
          tblClientes.ajax.reload();
        }
      };
    }
  });
}
// Fin Clientes

function frmCaja() {
  document.getElementById("title").innerHTML = "Nueva Caja";
  document.getElementById("btnAccion").innerHTML = "Registrar";
  document.getElementById("frmCaja").reset();
  $("#nuevaCaja").modal("show");
  document.getElementById("id").value = "";
}
function registrarCaja(e) {
  e.preventDefault();
  const nombre = document.getElementById("nombre");
  if (nombre.value == "") {
    alertas('El nombre es requerido', 'warning');
  } else {
    const url = base_url + "Cajas/registrar";
    const frm = document.getElementById("frmCaja");
    const http = new XMLHttpRequest();
    http.open("POST", url, true);
    http.send(new FormData(frm));
    http.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        const res = JSON.parse(this.responseText);
        alertas(res.msg, res.icono);
        frm.reset();
        $('#nuevaCaja').modal('hide');
        tblCajas.ajax.reload();
      }
    };
  }
}
function btnEditarCaja(id) {
  document.getElementById("title").innerHTML = "Actualizar Caja";
  document.getElementById("btnAccion").innerHTML = "Modificar";
  const url = base_url + "Cajas/editar/" + id;
  const http = new XMLHttpRequest();
  http.open("GET", url, true);
  http.send();
  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      const res = JSON.parse(this.responseText);
      document.getElementById("id").value = res.id;
      document.getElementById("nombre").value = res.caja;
      $("#nuevaCaja").modal("show");
    }
  };
}
function btnEliminarCaja(id) {
  Swal.fire({
    title: "Está seguro de eliminar?",
    text: "La caja cambiará a estado inactivo!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si",
    cancelButtonText: "Cancelar",
  }).then((result) => {
    if (result.isConfirmed) {
      const url = base_url + "Cajas/eliminar/" + id;
      const http = new XMLHttpRequest();
      http.open("GET", url, true);
      http.send();
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          const res = JSON.parse(this.responseText);
          alertas(res.msg, res.icono);
          tblCajas.ajax.reload();
        }
      };
    }
  });
}
function btnReingresarCaja(id) {
  Swal.fire({
    title: "Está seguro de reingresar?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si",
    cancelButtonText: "Cancelar",
  }).then((result) => {
    if (result.isConfirmed) {
      const url = base_url + "Cajas/reingresar/" + id;
      const http = new XMLHttpRequest();
      http.open("GET", url, true);
      http.send();
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          const res = JSON.parse(this.responseText);
          alertas(res.msg, res.icono);
          tblCajas.ajax.reload();
        }
      };
    }
  });
}
// Fin Cajas

function frmCategoria() {
  document.getElementById("title").innerHTML = "Nueva Categoría";
  document.getElementById("btnAccion").innerHTML = "Registrar";
  document.getElementById("frmCategoria").reset();
  $("#nueva_categoria").modal("show");
  document.getElementById("id").value = "";
}
function registrarCat(e) {
  e.preventDefault();
  const nombre = document.getElementById("nombre");
  if (nombre.value == "") {
    alertas('El nombre es requerido', 'warning');
  } else {
    const url = base_url + "Categorias/registrar";
    const frm = document.getElementById("frmCategoria");
    const http = new XMLHttpRequest();
    http.open("POST", url, true);
    http.send(new FormData(frm));
    http.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        const res = JSON.parse(this.responseText);
        alertas(res.msg, res.icono);
        frm.reset();
        $("#nueva_categoria").modal("hide");
        tblCategorias.ajax.reload();
      }
    };
  }
}
function btnEditarCat(id) {
  document.getElementById("title").innerHTML = "Actualizar Categoría";
  document.getElementById("btnAccion").innerHTML = "Modificar";
  const url = base_url + "Categorias/editar/" + id;
  const http = new XMLHttpRequest();
  http.open("GET", url, true);
  http.send();
  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      const res = JSON.parse(this.responseText);
      document.getElementById("id").value = res.id;
      document.getElementById("nombre").value = res.categoria;
      $("#nueva_categoria").modal("show");
    }
  };
}
function btnEliminarCat(id) {
  Swal.fire({
    title: "Está seguro de eliminar?",
    text: "La categoría cambiará a estado inactivo!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si",
    cancelButtonText: "Cancelar",
  }).then((result) => {
    if (result.isConfirmed) {
      const url = base_url + "Categorias/eliminar/" + id;
      const http = new XMLHttpRequest();
      http.open("GET", url, true);
      http.send();
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          const res = JSON.parse(this.responseText);
          alertas(res.msg, res.icono);
          tblCategorias.ajax.reload();
        }
      };
    }
  });
}
function btnReingresarCat(id) {
  Swal.fire({
    title: "Está seguro de reingresar?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si",
    cancelButtonText: "Cancelar",
  }).then((result) => {
    if (result.isConfirmed) {
      const url = base_url + "Categorias/reingresar/" + id;
      const http = new XMLHttpRequest();
      http.open("GET", url, true);
      http.send();
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          const res = JSON.parse(this.responseText);
          alertas(res.msg, res.icono);
          tblCategorias.ajax.reload();
        }
      };
    }
  });
}
// Fin categorias

function frmProveedor() {
  document.getElementById("title").innerHTML = "Nuevo Proveedor";
  document.getElementById("btnAccion").innerHTML = "Registrar";
  document.getElementById("frmProveedor").reset();
  $("#nuevo_proveedor").modal("show");
  document.getElementById("id").value = "";
}
function registrarProveedor(e) {
  e.preventDefault();
  const nombre = document.getElementById("nombre");
  if (nombre.value == "") {
    alertas('El nombre es requerido', 'warning');
  } else {
    const url = base_url + "Proveedores/registrar";
    const frm = document.getElementById("frmProveedor");
    const http = new XMLHttpRequest();
    http.open("POST", url, true);
    http.send(new FormData(frm));
    http.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        const res = JSON.parse(this.responseText);
        alertas(res.msg, res.icono);
        frm.reset();
        $("#nuevo_proveedor").modal("hide");
        tblProveedores.ajax.reload();
      }
    };
  }
}
function btnEditarProveedor(id) {
  document.getElementById("title").innerHTML = "Actualizar Proveedor";
  document.getElementById("btnAccion").innerHTML = "Modificar";
  const url = base_url + "Proveedores/editar/" + id;
  const http = new XMLHttpRequest();
  http.open("GET", url, true);
  http.send();
  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      const res = JSON.parse(this.responseText);
      document.getElementById("id").value = res.id;
      document.getElementById("nombre").value = res.proveedor;
      $("#nuevo_proveedor").modal("show");
    }
  };
}
function btnEliminarProveedor(id) {
  Swal.fire({
    title: "Está seguro de eliminar?",
    text: "El proveedor cambiará a estado inactivo!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si",
    cancelButtonText: "Cancelar",
  }).then((result) => {
    if (result.isConfirmed) {
      const url = base_url + "Proveedores/eliminar/" + id;
      const http = new XMLHttpRequest();
      http.open("GET", url, true);
      http.send();
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          const res = JSON.parse(this.responseText);
          alertas(res.msg, res.icono);
          tblProveedores.ajax.reload();
        }
      };
    }
  });
}
function btnReingresarProveedor(id) {
  Swal.fire({
    title: "Está seguro de reingresar?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si",
    cancelButtonText: "Cancelar",
  }).then((result) => {
    if (result.isConfirmed) {
      const url = base_url + "Proveedores/reingresar/" + id;
      const http = new XMLHttpRequest();
      http.open("GET", url, true);
      http.send();
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          const res = JSON.parse(this.responseText);
          alertas(res.msg, res.icono);
          tblProveedores.ajax.reload();
        }
      };
    }
  });
}
// Fin proveedores

function frmProducto() {
  document.getElementById("title").innerHTML = "Nuevo Producto";
  document.getElementById("btnAccion").innerHTML = "Registrar";
  document.getElementById("frmProducto").reset();
  $("#nuevo_producto").modal("show");
  document.getElementById("id").value = "";
}
function registrarPro(e) {
  e.preventDefault();
  const codigo = document.getElementById("codigo");
  const nombre = document.getElementById("nombre");
  const precio_compra = document.getElementById("precio_compra");
  const precio_venta = document.getElementById("precio_venta");
  const id_categoria = document.getElementById("categoria");
  const id_proveedor = document.getElementById("proveedor");
  if (
    codigo.value == "" || nombre.value == "" || precio_compra.value == "" || precio_venta.value == "" || id_categoria.value == "" || id_proveedor.value == "") {
    alertas("Todo los campos son obligatorios", "warning");
  } else {
    const url = base_url + "Productos/registrar";
    const frm = document.getElementById("frmProducto");
    const http = new XMLHttpRequest();
    http.open("POST", url, true);
    http.send(new FormData(frm));
    http.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        const res = JSON.parse(this.responseText);
        alertas(res.msg, res.icono);
        frm.reset();
        $("#nuevo_producto").modal("hide");
        tblProductos.ajax.reload();
      }
    };
  }
}
function btnEditarPro(id) {
  document.getElementById("title").innerHTML = "Actualizar Producto";
  document.getElementById("btnAccion").innerHTML = "Modificar";
  const url = base_url + "Productos/editar/" + id;
  const http = new XMLHttpRequest();
  http.open("GET", url, true);
  http.send();
  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      const res = JSON.parse(this.responseText);
      document.getElementById("id").value = res.id;
      document.getElementById("codigo").value = res.codigo;
      document.getElementById("nombre").value = res.descripcion;
      document.getElementById("precio_venta").value = res.precio_venta;
      document.getElementById("precio_compra").value = res.precio_compra;
      document.getElementById("categoria").value = res.id_categoria;
      document.getElementById("proveedor").value = res.id_proveedor;
      $("#nuevo_producto").modal("show");
    }
  };
}
function btnEliminarPro(id) {
  Swal.fire({
    title: "Está seguro de eliminar?",
    text: "El producto cambiará a estado inactivo!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si",
    cancelButtonText: "Cancelar",
  }).then((result) => {
    if (result.isConfirmed) {
      const url = base_url + "Productos/eliminar/" + id;
      const http = new XMLHttpRequest();
      http.open("GET", url, true);
      http.send();
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          const res = JSON.parse(this.responseText);
          alertas(res.msg, res.icono);
          tblProductos.ajax.reload();
        }
      };
    }
  });
}
function btnReingresarPro(id) {
  Swal.fire({
    title: "Está seguro de reingresar?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si",
    cancelButtonText: "Cancelar",
  }).then((result) => {
    if (result.isConfirmed) {
      const url = base_url + "Productos/reingresar/" + id;
      const http = new XMLHttpRequest();
      http.open("GET", url, true);
      http.send();
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          const res = JSON.parse(this.responseText);
          alertas(res.msg, res.icono);
          tblProductos.ajax.reload();
        }
      };
    }
  });
}
// Fin productos

function buscarCodigo(e) {
  e.preventDefault();
  const cod = document.getElementById("codigo").value;
  if (cod != '') {
    if (e.which == 13) {
      const url = base_url + "Compras/buscarCodigo/" + cod;
      const http = new XMLHttpRequest();
      http.open("GET", url, true);
      http.send();
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          const res = JSON.parse(this.responseText);
          if (res) {
            document.getElementById("nombre").value = res.descripcion;
            document.getElementById("precio").value = res.precio_compra;
            document.getElementById("id").value = res.id;
            document.getElementById("cantidad").removeAttribute("disabled");
            document.getElementById("cantidad").focus();
          } else {
            alertas('El producto no existe', 'warning');
            document.getElementById("codigo").value = "";
            document.getElementById("codigo").focus();
          }
        }
      };
    }
  } else {
    alertas('Ingrese el código', 'warning');
  }
}

function buscarCodigoVenta(e) {
  e.preventDefault();
  const cod = document.getElementById("codigo").value;
  if (cod != '') {
    if (e.which == 13) {
      const url = base_url + "Compras/buscarCodigo/" + cod;
      const http = new XMLHttpRequest();
      http.open("GET", url, true);
      http.send();
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          const res = JSON.parse(this.responseText);
          if (res) {
            document.getElementById("nombre").value = res.descripcion;
            document.getElementById("precio").value = res.precio_venta;
            document.getElementById("id").value = res.id;
            document.getElementById("cantidad").removeAttribute("disabled");
            document.getElementById("cantidad").focus();
          } else {
            alertas('El producto no existe', 'warning');
            document.getElementById("codigo").value = "";
            document.getElementById("codigo").focus();
          }
        }
      };
    }
  } else {
    alertas('Ingrese el código', 'warning');
  }
}

function calcularPrecio(e) {
  e.preventDefault();
  const cant = document.getElementById("cantidad").value;
  const precio = document.getElementById("precio").value;
  document.getElementById("sub_total").value = precio * cant;
  if (e.which == 13) {
    if (cant > 0) {
      const url = base_url + "Compras/ingresar";
      const frm = document.getElementById("frmCompra");
      const http = new XMLHttpRequest();
      http.open("POST", url, true);
      http.send(new FormData(frm));
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          const res = JSON.parse(this.responseText);
          alertas(res.msg, res.icono);
          frm.reset();
          cargarDetalle();
        }
        document.getElementById("cantidad").setAttribute('disabled', 'disabled');
        document.getElementById("codigo").focus();
      };
    }
  }
}

function calcularPrecioVenta(e) {
  e.preventDefault();
  const cant = document.getElementById("cantidad").value;
  const precio = document.getElementById("precio").value;
  document.getElementById("sub_total").value = precio * cant;
  if (e.which == 13) {
    if (cant > 0) {
      const url = base_url + "Compras/ingresarVenta";
      const frm = document.getElementById("frmVenta");
      const http = new XMLHttpRequest();
      http.open("POST", url, true);
      http.send(new FormData(frm));
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          const res = JSON.parse(this.responseText);
          alertas(res.msg, res.icono);
          frm.reset();
          cargarDetalleVenta();
        }
        document.getElementById("cantidad").setAttribute('disabled', 'disabled');
        document.getElementById("codigo").focus();
      };
    }
  }
}
if (document.getElementById("tblDetalle")) {
  cargarDetalle();
}
if (document.getElementById("tblDetalleVenta")) {
  cargarDetalleVenta();
}

function cargarDetalle() {
  const url = base_url + "Compras/listar/detalle";
  const http = new XMLHttpRequest();
  http.open("GET", url, true);
  http.send();
  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      const res = JSON.parse(this.responseText);
      let html = "";
      res.detalle.forEach((row) => {
        html += `<tr>
                <td>${row["id"]}</td>
                <td>${row["descripcion"]}</td>
                <td>${row["cantidad"]}</td>
                <td>${row["precio"]}</td>
                <td>${row["sub_total"]}</td>
                <td>
                <button class="btn btn-danger" type="button" onclick="deleteDetalle(${row["id"]}, 1)"><i class="fa-solid fa-trash-can"></i></button>
                </td>
                </tr>`;
      });
      document.getElementById("tblDetalle").innerHTML = html;
      document.getElementById("total").value = res.total_pagar.total;
    }
  };
}

function cargarDetalleVenta() {
  const url = base_url + "Compras/listar/detalle_temp";
  const http = new XMLHttpRequest();
  http.open("GET", url, true);
  http.send();
  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      const res = JSON.parse(this.responseText);
      let html = "";
      res.detalle.forEach((row) => {
        html += `<tr>
                <td>${row["id"]}</td>
                <td>${row["descripcion"]}</td>
                <td>${row["cantidad"]}</td>
                <td><input class="form-control" type="text" placeholder="Descuento" onkeyup="calcularDescuento(event, ${row["id"]})"></td>
                <td>${row["descuento"]}</td>
                <td>${row["precio"]}</td>
                <td>${row["sub_total"]}</td>
                <td>
                <button class="btn btn-danger" type="button" onclick="deleteDetalle(${row["id"]}, 2)"><i class="fa-solid fa-trash-can"></i></button>
                </td>
                </tr>`;
      });
      document.getElementById("tblDetalleVenta").innerHTML = html;
      document.getElementById("total").value = res.total_pagar.total;
    }
  };
}
function calcularDescuento(e, id) {
  e.preventDefault();
  if (e.target.value == '') {
    alertas('Ingrese el descuento', 'warning');
  }else{
    if (e.which == 13) {
      const url = base_url + "Compras/calcularDescuento/" + id + '/' + e.target.value;
      const http = new XMLHttpRequest();
      http.open("GET", url, true);
      http.send();
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          const res = JSON.parse(this.responseText);
          alertas(res.msg, res.icono);
          cargarDetalleVenta();
        }
      };
    }
  }
}

function deleteDetalle(id, accion) {
  let url;
  if (accion == 1) {
    url = base_url + "Compras/delete/" + id;
  } else {
    url = base_url + "Compras/deleteVenta/" + id;
  }
  const http = new XMLHttpRequest();
  http.open("GET", url, true);
  http.send();
  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      const res = JSON.parse(this.responseText);
      alertas(res.msg, res.icono);
      if (accion == 1) {
        cargarDetalle();
      } else {
        cargarDetalleVenta();
      }
    }
  };
}

function procesar(accion) {
  Swal.fire({
    title: "Está seguro de realizar la acción?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si",
    cancelButtonText: "Cancelar",
  }).then((result) => {
    if (result.isConfirmed) {
      let url;
      if (accion == 1) {
        const id_proveedor = document.getElementById("proveedor").value;
        url = base_url + "Compras/registrarCompra/" + id_proveedor;
      }else{
        const id_cliente = document.getElementById("cliente").value;
        url = base_url + "Compras/registrarVenta/" + id_cliente;
      }
      const http = new XMLHttpRequest();
      http.open("GET", url, true);
      http.send();
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          const res = JSON.parse(this.responseText);
          if (res.msg == "ok") {
            let ruta;
            if (accion == 1) {
              alertas("Compra realizada exitosamente", "success");
              ruta = base_url + "Compras/generarPdf/" + res.id_compra;
            }else{
              alertas("Venta realizada exitosamente", "success");
              ruta = base_url + "Compras/generarPdfVenta/" + res.id_venta;
            }
            window.open(ruta);
            setTimeout(() => {
              window.location.reload();
            }, 3000);
          } else {
            alertas(res.msg, res.icono);
          }
        }
      };
    }
  });
}

function modificarEmpresa() {
  const frm = document.getElementById("frmEmpresa");
  const url = base_url + "Administracion/modificar";
  const http = new XMLHttpRequest();
  http.open("POST", url, true);
  http.send(new FormData(frm));
  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      const res = JSON.parse(this.responseText);
      alertas(res.msg, res.icono);
    }
  };
}

function alertas(mensaje, icono) {
  Swal.fire({
    position: "top-end",
    icon: icono,
    title: mensaje,
    showConfirmButton: false,
    timer: 3000,
  });
}
if (document.getElementById('stock_minimo')) {
  reporteStock();
  productosVendidos();
}
function reporteStock() {
  const url = base_url + "Administracion/reporteStock";
  const http = new XMLHttpRequest();
  http.open("GET", url, true);
  http.send();
  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      const res = JSON.parse(this.responseText);
      alertas(res.msg, res.icono);
      let nombre = [];
      let cantidad = [];
      for (let i = 0; i < res.length; i++) {
        nombre.push(res[i]['descripcion']);
        cantidad.push(res[i]['cantidad']);
      }
      var ctx = document.getElementById("stock_minimo");
      var myPieChart = new Chart(ctx, {
        type: 'pie',
        data: {
          labels: nombre,
          datasets: [{
            data: cantidad,
            backgroundColor: ['#0B5B67', '#FBDD8E', '#F6BABA', '#7ACE67', '#FF6961'],
          }],
        },
      });
    }
  };
}
function productosVendidos() {
  const url = base_url + "Administracion/productosVendidos";
  const http = new XMLHttpRequest();
  http.open("GET", url, true);
  http.send();
  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      const res = JSON.parse(this.responseText);
      alertas(res.msg, res.icono);
      let nombre = [];
      let cantidad = [];
      for (let i = 0; i < res.length; i++) {
        nombre.push(res[i]['descripcion']);
        cantidad.push(res[i]['total']);
      }
      var ctx = document.getElementById("productosVendidos");
      var myPieChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
          labels: nombre,
          datasets: [{
            data: cantidad,
            backgroundColor: ['#62DCB9', '#FEA73F', '#9A9CEA', '#F7F052', '#FF6666'],
          }],
        },
      });
    }
  };
}
function btnAnularC(id) {
  Swal.fire({
    title: "Está seguro de anular la compra?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si",
    cancelButtonText: "Cancelar",
  }).then((result) => {
    if (result.isConfirmed) {
      const url = base_url + "Compras/anularCompra/" + id;
      const http = new XMLHttpRequest();
      http.open("GET", url, true);
      http.send();
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          const res = JSON.parse(this.responseText);
          alertas(res.msg, res.icono);
          t_h_c.ajax.reload();

        }
      };
    }
  });
}
function btnAnularV(id) {
  Swal.fire({
    title: "Está seguro de anular la venta?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si",
    cancelButtonText: "Cancelar",
  }).then((result) => {
    if (result.isConfirmed) {
      const url = base_url + "Compras/anularVenta/" + id;
      const http = new XMLHttpRequest();
      http.open("GET", url, true);
      http.send();
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          const res = JSON.parse(this.responseText);
          alertas(res.msg, res.icono);
          t_h_v.ajax.reload();
          
        }
      };
    }
  });
}
function arqueoCaja() {
  document.getElementById('ocultar_campos').classList.add('d-none');
  document.getElementById("monto_inicial").value = '';
  document.getElementById('btnAccion').textContent = 'Abrir caja';
  $('#abrir_caja').modal('show');
}
function abrirArqueo(e) {
  e.preventDefault();
  const monto_inicial = document.getElementById('monto_inicial').value;
  if (monto_inicial == '') {
    alertas('Ingrese el Monto Inicial', 'warning');
  } else{
    const frm = document.getElementById('frmAbrirCaja');
    const url = base_url + "Cajas/abrirArqueo";
    const http = new XMLHttpRequest();
    http.open("POST", url, true);
    http.send(new FormData(frm));
    http.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        console.log(this.responseText);
        const res = JSON.parse(this.responseText);
        alertas(res.msg, res.icono);
        t_arqueo.ajax.reload();
        $('#abrir_caja').modal('hide');
      }
    };
  }
}
function cerrarCaja() {
  const url = base_url + "Cajas/getVentas";
  const http = new XMLHttpRequest();
  http.open("GET", url, true);
  http.send();
  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      const res = JSON.parse(this.responseText);
      document.getElementById('monto_final').value = res.monto_total.total;
      document.getElementById('total_ventas').value = res.total_ventas.total;
      document.getElementById('monto_inicial').value = res.inicial.monto_inicial;
      document.getElementById('monto_general').value = res.monto_general;
      document.getElementById('id').value = res.inicial.id;
      document.getElementById('ocultar_campos').classList.remove('d-none');
      document.getElementById('btnAccion').textContent = 'Cerrar caja';
      $('#abrir_caja').modal('show');
    }
  };
}
function registrarPermisos(e) {
  e.preventDefault();
  const url = base_url + "Usuarios/registrarPermiso";
  const frm = document.getElementById('formulario');
  const http = new XMLHttpRequest();
  http.open("POST", url, true);
  http.send(new FormData(frm));
  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      const res = JSON.parse(this.responseText);
      if (res != '') {
        alertas(res.msg, res.icono);
      } else {
        alertas('Error no identificado', 'error');
      }
    }
  };
}

