<!-- Comentarios de las publicaciones -->
@foreach($comments as $comment)
    <div class="card-comments" @if($comment->parent_id != null) style="margin-left:40px;" @endif>
        <strong style="margin-right: 10px;">{{ $comment->user->name }} comentó:</strong>
        {{ $comment->body }}
        <a href="" id="reply"></a>
        <form method="post" action="{{ route('comments.store') }}">
            @csrf
            @auth <!--Solo los usuarios autorizados pueden ver esto. Los usuarios invitados no pueden comentar-->
            <div class="input-group mb-3">
                <input type="text" name="body" class="form-control form-control-sm" />
                
                <div class="input-group-append">
                    <button class="btn btn-success btn-sm" type="submit">Responder</button>
                </div>
                <input type="hidden" name="post_id" value="{{ $post_id }}" />
                <input type="hidden" name="parent_id" value="{{ $comment->id }}" />
            </div>
            @endauth

        </form>
            <!--Los comentarios tienen un boton de "ver comentarios", en caso de que no tenga ninguna respuesta, ese boton no se asigna-->
            @if(!$comment->replies->isEmpty())
                <div class="text-center">
                    <button id="ShowComments" type="button" class="card-link justify-content-center btn btn-light ">
                        Ver Comentarios</button>
                </div>
                @include('posts.showComments', ['comments' => $comment->replies])

            @else
            
            @endif

    </div>
@endforeach