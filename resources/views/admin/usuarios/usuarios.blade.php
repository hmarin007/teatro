@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                  <a class="btn btn-xs btn-primary" href="#" onclick="nuevo();">
                    <i class="fa fa-plus-circle" aria-hidden="true"></i> NUEVO USUARIO
                  </a>
                </div>

                <div class="card-body">

                    <div class="col-sm-12">
                        <table id="tabla" class="display nowrap" cellspacing="0" width="100%">
                          <thead>
                            <tr>
                              <th>Nombres</th>
                              <th>Email</th>
                              <th>Opciones</th>
                            </tr>
                          </thead>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
    @include('modal.usuarios.usuario')
    <script type="text/javascript">
      
      $(document).ready(function() {
         
            listar();

      });
          // construye el datatable
          var listar = function(){
            var tabla = $('#tabla').DataTable({
              responsive: true, 
              processing: true, 
              serverSide: true,
              order: [],
              columnDefs: [{"targets": [ -1 ], "orderable": false, }],
              language: { "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json" },
              ajax: {
                  url: '{{ route("admin.usuarios.usuarios.data") }}',
            },
              columns: [
                  {data: 'name', name: 'name'},
                  {data: 'email', name: 'email'},
                  {data: 'opcion', name: 'opcion'}
              ]
            });
          }

          //destruye el datatable
          var destruir = function(){
            $('#tabla').dataTable().fnDestroy();
          }

          function nuevo(){
            $('#modal-form form')[0].reset();
            $('.modal-title').text('Crear Usuario');
            save_method = "add";
            $("#btnsend").prop('disabled', false); 
            $('#btnsend').val('Guardar');
            $('#cerrar').val('Cerrar');
            $('#modal-form').modal('show');
          }

          function editar(id) {
            
            save_method = 'edit';
            $('input[name=_method]').val('PATCH');
            $('#modal-form form')[0].reset();
            $('#btnsend').val('Editar');
            $('#cerrar').val('Cerrar');
            $.ajax({
              url: "{{ url('usuarios') }}" + '/' + id + "/edit",
              type: "GET",
              dataType: "JSON",
              success: function(data) {

                $('#modal-form').modal('show');
                $('.modal-title').text('Editar Usuario');
                $('#id').val(data.id);
                $('#name').val(data.name);
                $('#email').val(data.email);

              },
              error : function() {
                  //alert("Error, No existen datos");
              }
            });
          }


          $(function(){
              $('#modal-form form').validator().on('submit', function (e) {
                  if (!e.isDefaultPrevented()){
                      var id   = $('#id').val();
                      var tipo = "POST"; //nuevo
                      if (save_method == 'add'){ 
                        url  = "{{ url('usuarios') }}";     
                      }
                        else{ url = "{{ url('usuarios') . '/' }}" + id;
                        tipo = "PUT"; //editar
                      }
                      $.ajax({
                          url : url,
                          type : tipo,
                          data : $('#modal-form form').serialize(),
                          beforeSend: function(){
                            $("#btnsend").prop('disabled', true); 
                            $("#btnsend").value = "Procesando...";
                          },
                          success : function(data) {
                              $("#btnsend").value = "Procesado";
                              $('#modal-form').modal('hide');
                              $("#btnsend").prop('disabled', false); 

                              destruir();
                              listar();
                              swal({
                                  title: 'Proceso Exitoso!',
                                  text: data.msg,
                                  type: 'success'
                                  //timer: '4500'
                              })
                          },
                          error : function(data){
                              $("#btnsend").prop('disabled', false); 
                              swal({
                                  title: 'Error en el proceso...',
                                  text: data.msg,
                                  type: 'error'
                                  //timer: '4500'
                              })
                          }
                      });
                      return false;
                  }
              });
          });


          function eliminar(id){
            var csrf_token = $('meta[name="csrf-token"]').attr('content');
            swal({
                title: 'Está Seguro?',
                text: "El registro será eliminado permanentemente!",
                type: 'warning',
                showCancelButton: true,
                cancelButtonColor: '#3085d6',
                confirmButtonColor: '#d33',
                confirmButtonText: 'Si, Eliminar!',
                cancelButtonText: "No, Cancelar!",

            }).then(function () {
                $.ajax({
                    url : "{{ url('usuarios') }}" + '/' + id,
                    type : "POST",
                    data : {'_method' : 'DELETE', '_token' : csrf_token},
                    success : function(data) {
                        destruir();
                        listar();
                        swal({
                            title: 'Registro eliminado!',
                            text: data.msg,
                            type: 'success',
                            //timer: '1500'
                        })
                    },
                    error : function () {
                        swal({
                            title: 'Error, no se pudo eliminar...',
                            text: data.msg,
                            type: 'error',
                            //timer: '1500'
                        })
                    }
                });
            });
          }                              


  </script>
@endsection()
