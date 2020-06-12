@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Mensajes para que el usuario sepa si su peticion se realizo -->
        @if(Session::has('message'))
            <p class="alert {{ Session::get('alert-class') }}">{{ Session::get('message') }}</p>
        @endif

    @auth <!--Solo los usuarios autorizados pueden ver esto-->
        @can("create post") <!--Solo los usuarios con permiso de "create post" pueden ver esto-->
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Nuevo Post</div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('newPost') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="titulo">Título:</label>
                                    <input type="text" class="form-control form-control-sm @error('titulo') is-invalid @enderror" id="titulo" name="titulo" required>
                                    
                                    <!-- En caso de que el input de titulo este vacio o incorrecto se muestra el mensaje de error -->
                                    @error('titulo')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="cuerpo">Cuerpo:</label>
                                    <textarea class="form-control @error('titulo') is-invalid @enderror" rows="5" id="body" name="cuerpo" required></textarea>

                                    <!-- En caso de que el input de cuerpo este vacio o incorrecto se muestra el mensaje de error -->
                                    @error('cuerpo')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="imagen">Imagen:</label>
                                    <input type="file" class="form-control-file border" id="imagen" name="imagen">
                                </div>

                                <button type="submit" class="btn btn-success btn-sm float-right">Publicar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endcan
    @endauth

    <!-- Incluye la viste para mostrar todos los post -->
    @include('posts.showPosts')

</div>
@endsection
