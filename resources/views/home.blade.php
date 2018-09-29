@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">Seleccione las butacas a reservar..</div>

                <div class="card-body">
                    <form role="form" action="" method="POST" name="form" id="form">
                        {{ csrf_field() }} {{ method_field('POST') }}

                        <table class="table">
                            <tr>                
                                @foreach($butacas_fila_1 as $key=>$value)
                                    <td>{{ $value }}
                                        <input name="butacas[]" type="checkbox" value="{{ $value }}" id="{{ $key }}" class="checkbox"> 
                                    </td>
                                @endforeach
                            </tr>
                            <tr>                
                                @foreach($butacas_fila_2 as $key=>$value)
                                    <td>{{ $value }}
                                        <input name="butacas[]" type="checkbox" value="{{ $value }}" id="{{ $key }}" class="checkbox"> 
                                    </td>
                                @endforeach
                            </tr>
                            <tr>                
                                @foreach($butacas_fila_3 as $key=>$value)
                                    <td>{{ $value }}
                                        <input name="butacas[]" type="checkbox" value="{{ $value }}" id="{{ $key }}" class="checkbox"> 
                                    </td>
                                @endforeach
                            </tr>
                            <tr>                
                                @foreach($butacas_fila_4 as $key=>$value)
                                    <td>{{ $value }}
                                        <input name="butacas[]" type="checkbox" value="{{ $value }}" id="{{ $key }}" class="checkbox"> 
                                    </td>
                                @endforeach
                            </tr>
                            <tr>                
                                @foreach($butacas_fila_5 as $key=>$value)
                                    <td>{{ $value }}
                                        <input name="butacas[]" type="checkbox" value="{{ $value }}" id="{{ $key }}" class="checkbox"> 
                                    </td>
                                @endforeach
                            </tr>
                        </table>

                        <input  type="hidden"  name="save_method" id="save_method" value="add">
                        <input  type="hidden"  name="fecha" id="fecha" value="{{ date('Y-m-d') }}">
                        <input  type="hidden"  name="usuario" value="{{ Auth::user()->id }}"> 


                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">Info las butacas a reservar..</div>

                <div class="card-body">
                    <button type="submit" class="btn btn-primary" name="btnsend"> <i class="fa fa-check"></i> Confirmar Reservación</button>
                </div>
            </div>
        </div>

        </form>

    </div>
</div>
<script type="text/javascript">
$('#1').prop('checked')
    $(function(){
        $('#form').validator().on('submit', function (e) {
            if (!e.isDefaultPrevented()){
                var id   = $('#id').val();
                var save_method   = $('#save_method').val();
                var tipo = "POST"; //nuevo
                if (save_method == 'add'){ 
                    url = "{{ url('reservacion') }}" ;     
                }
                else{ url = "{{ url('reservacion') . '/' }}" + id;
                    tipo = "PUT"; //editar
                }
                $.ajax({
                    url : url,
                    type : tipo,
                    data : $('#form').serialize(),
                    beforeSend: function(){
                    $("#btnsend").prop('disabled', true); 
                    $("#btnsend").value = "Procesando...";
                    },
                    success : function(data) {
                        $("#btnsend").value = "Procesado";
                        $("#btnsend").prop('disabled', false); 
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



    $('.checkbox').each(function(){

        $(this).hide().after('<div class="class_checkbox" />');

    });

    $('.class_checkbox').on('click',function(){

       $(this).toggleClass('checked').prev().prop('checked',$(this).is('.checked'));

    });

    function Program(butacas){

        var butacasArr  = butacas.split(",");
        var butacasJSON = JSON.stringify(butacasArr);

        $('.checkbox').filter(function () {    
          if (butacasJSON.indexOf(this.id) != -1)
                return $(this).closest('td').find(':checkbox');
        }).prop("checked", true);

    }

    $(document).ready(function(){

       //

    });


</script>
@endsection
