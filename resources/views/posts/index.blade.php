@extends('layouts.app')

@section('content')

<script type="text/javascript">
    function editarPost(e){
        //Se obtiene el row mas cercano de e para poder acceder a los datos que estan en la tabla
        //Y completar los campos del modal de modificar post
        var htmlString = $( e ).closest("tr");

        $("#id_Update").val(htmlString.children("td.id").text());

        $("#title_Update").val(htmlString.children("td.title").text());
        
        $("#body_Update").val(htmlString.children("td.body").text());
        
        $("#image_Update").attr("src", htmlString.children("td.image").find("img").attr("src"));
    }

    function borrarPost(id){
        $("#id_Delete").val(id);
    }

    $(document).ready(function(){
        //Cuando el modal esta abierto, se le asigna un evento para que cuando el usuario elija una imagen
        //la muestra en el mismo modal
        document.getElementById('SelectImg').onchange = function (evt) {
            var selectedFile = event.target.files[0];
            var reader = new FileReader();

            var imgtag = document.getElementById("image_Update");
            imgtag.title = selectedFile.name;

            reader.onload = function(event) {
                imgtag.src = event.target.result;
            };

            reader.readAsDataURL(selectedFile);
        }
    })
</script>

    @if(Session::has('message'))
        <p class="alert {{ Session::get('alert-class') }}">{{ Session::get('message') }}</p>
    @endif
<div class="row justify-content-center">
    <div class="col-md-8">
        <!-- Tabla que muestra los post de los usuarios con sus opciones para borrar y actualizar -->
        <table class="table">
            <thead>
                <tr>
                    <th scope="col"  style="display:none;">#</th>
                    <th scope="col">Titulo</th>
                    <th scope="col">Cuerpo</th>
                    <th scope="col">Imagen</th>
                    <th id="opcionesTHead"><em class="fa fa-cog"></em></th>
                </tr>
            </thead>
            <tbody>
                @foreach($posts as $post)
                <tr>
                    <td class="id" scope="row" style="display:none;">{{ $post->id }}</td>
                    <td class="title" scope="row">{{ $post->title }}</td>
                    <td class="body">{{ $post->body }}</td>
                    <td class="image"><img src="{{ asset($post->image) }}" style="width: 200px !important;" alt=""></td>
                    <td>
                        <div class="btn-group">
                            <button type="button" data-toggle="modal" data-target="#modalUpdate" class="btn btn-primary" onclick="editarPost(this)">Editar<i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                            <button type="button" data-toggle="modal" data-target="#modalDelete" class="btn btn-danger" onclick="borrarPost('{{$post->id}}')" >Eliminar<i class="fa fa-trash" aria-hidden="true"></i> </button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Se incluye el modal para modificar -->
    @include('posts.updatePost')

    <!-- Se incluye el modal para eliminar -->
    @include('posts.deletePost')

</div>
@endsection