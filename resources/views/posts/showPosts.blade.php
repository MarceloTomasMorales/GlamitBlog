<script type="text/javascript">
    $(document).ready(function(){
        //Oculta todos los comentarios que tengan respuesta
        $('.card-comments').each(function(i) {
            $(this).children('.card-comments').addClass("hide");
        });

        $(document).on('click', '#ShowComments', function() {
            var comments = $(this).closest('.card-comments');
            comments.find('.card-comments').toggleClass("hide");
        });

        //Por cada like, se manda un post para guardar los likes
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        @auth
        $('i.glyphicon-thumbs-up').click(function(){    
            var id = $(this).parents(".panel").data('id');
            var c = $('#'+this.id+'-bs3').html();
            var cObjId = this.id;
            var cObj = $(this);

            $.ajax({
                type:'POST',
                url:'{{url("/LikePost")}}',
                data:{id:id},
                success:function(data){
                    console.log(data.success);
                    //Una vez obtenido el response se cambia la clase y el numero de likes
                    
                    if(jQuery.isEmptyObject(data.success)){
                        $('#'+cObjId+'-bs3').html(data.success);
                        $(cObj).toggleClass("like-post");
                    }
                }
            });

        });    
        @endauth    
        
    });

    function editarPost(id){
        //Request para obtener los datos para editar el post
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type:'GET',
            url:'{{url("/getPost")}}',
            data:{id:id},
            async:false,
            success:function(data){
                console.log(data);

                //Se asignan los valores a los campos del modal para editar el post
                
                $("#id_Update").val(data.id);

                $("#title_Update").val(data.title);
                
                $("#body_Update").val(data.body);
                
                $("#image_Update").attr("src", data.image);

            }
        });
    }

    function borrarPost(id){
        //Se asigna el id del post al modal para poder eliminarlo
        $("#id_Delete").val(id);
    }
    
</script>
<div class="container">
        
<div class="row justify-content-center">
<!--Muestra todos los posts-->
    @foreach($posts as $post)
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{$post->title}} - {{$post->created_at}}
                    @auth <!--Solo los usuarios autorizados pueden ver esto-->
                        @role("user") <!--Solo los usuarios con rol "user" estan autorizados para ver esto-->
                            @if(Auth::id() == $post->user_id) <!--Los usuarios solo pueden editar y borrar los posts que sean propios-->
                                <div class="dropdown" style="display: inline-grid;float: right;">
                                    <button type="button" class="btn btn-primary dropdown-toggle btn-sm float-right" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog" aria-hidden="true"></i></button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu2">
                                        <button class="dropdown-item" type="button" onclick="editarPost('{{$post->id}}')" data-toggle="modal" data-target="#modalUpdate" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</button>
                                        <button class="dropdown-item" type="button" onclick="borrarPost('{{$post->id}}')" data-toggle="modal" data-target="#modalDelete" ><i class="fa fa-trash" aria-hidden="true"></i> Eliminar</button>
                                    </div>
                                </div>
                            @endif
                        @endrole
                        @role("admin")<!--Solo los usuarios con rol "admin" estan autorizados para ver esto-->
                            <!--Admin puede editar y borrar cualquier post-->
                            <div class="dropdown" style="display: inline-grid;float: right;">
                                <button type="button" class="btn btn-primary dropdown-toggle btn-sm float-right" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog" aria-hidden="true"></i></button>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu2">
                                    <button class="dropdown-item" type="button" onclick="editarPost('{{$post->id}}')" data-toggle="modal" data-target="#modalUpdate" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</button>
                                    <button class="dropdown-item" type="button" onclick="borrarPost('{{$post->id}}')" data-toggle="modal" data-target="#modalDelete" ><i class="fa fa-trash" aria-hidden="true"></i> Eliminar</button>
                                </div>
                            </div>
                        @endrole

                    @endauth
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <p>
                        {{$post->body}}</p>
                            @if($post->image != "")
                                <img src="{{ asset($post->image) }}" class="img-thumbnail" alt="">
                            @endif
                            <div class="panel" data-id="{{ $post->id }}">
                                        
                                <div class="card-footer">
                                    
                                
                                        @auth <!--Solo los usuarios autorizados pueden dar like-->
                                            <i id="like{{$post->id}}" class="glyphicon glyphicon-thumbs-up {{ auth()->user()->hasLiked($post) ? 'like-post' : '' }}">
                                                <img id="like-button" src="{{ asset('images/icons8-me-gusta-64.png')}}" style="width: 25px; height:25px; float:right;"  alt="">  
                                                
                                                <div id="like{{$post->id}}-bs3" style="text-align: right; padding-right: 30px;">{{ $post->likers()->get()->count() }}</div> 
                                            </i> 
                                        @endauth
                                        @guest <!--Los invitados solo pueden ver los likes-->
                                            <i id="like{{$post->id}}" class="glyphicon glyphicon-thumbs-up">
                                                <img id="like-button" src="{{ asset('images/icons8-me-gusta-64.png')}}" style="width: 25px; height:25px; float:right;"  alt="">  
                                                
                                                <div id="like{{$post->id}}-bs3" style="text-align: right; padding-right: 30px;">{{ $post->likers()->get()->count() }}</div>  
                                            </i>
                                        @endguest
                                        
                                </div>

                            </div>

                    </div>
                </div>
                <div>
                @include('posts.showComments', ['comments' => $post->comments, 'post_id' => $post->id])
                </div>
                <div class="card-footer">
                    <strong>Comentar</strong>
                    @auth
                    <form method="post" action="{{ route('comments.store') }}">
                        @csrf
                        <div class="form-group">
                            <textarea class="form-control" name="body"></textarea>
                            <input type="hidden" name="post_id" value="{{ $post->id }}" />
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-success btn-sm float-right" value="Comentar" />
                        </div>

                            
                    </form>
                    @endauth

                    @guest
                    Inicie sesion para comentar y responder
                    @endguest
                </div>
            </div>
        </div>
    @endforeach
</div>
</div>

@include('posts.updatePost')

@include('posts.deletePost')