<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{
    public function index(){
        Log::info(Post::where('user_id', auth()->user()->id)->get());

        //Regresa la vista con los datos de la misma
        return view("posts.index", ["posts"=>Post::where('user_id', auth()->user()->id)->orderBy("user_id", "desc")->get()]);
    }
    
    public function store(Request $request){
        Log::info($request->all());
        //Crea y guarda el post
        try {
            $publicacion = new Post;
            $publicacion->title = $request->get("titulo");
            $publicacion->body = $request->get("cuerpo");
            $publicacion->user_id = auth()->user()->id;

            //No es obligatorio subir una imagen
            if ($request->file('imagen') != null) {
                //Se le cambia el nombre a la imagen para evitar conflictos con los nombres
                //Formato: tiempo + extension de la imagen
                $nombre = time().'.'.$request->file('imagen')->extension();
                $request->file('imagen')->storeAs('', $nombre , 'public');
                
                //Se guarda la ubicacion
                $publicacion->image="images\\".$nombre;
            }else{
                //Se guarda la ubicacion como vacia ya que el usuario decidio no postear una imagen
                $publicacion->image="";
            }

            //Se guarda la publicacion
            $publicacion->save();

            //Se guarda el mensaje en la Session del usuario para mostrar en la vista
            Session::flash('message', 'Post creado correctamente!');
            Session::flash('alert-class', 'alert-info'); 
            Log::info("Post creado correctamente!");
        
            return redirect("/home");
        } catch (\Exception $e) {
            //Si ocurre algun error, se muestra el mensaje en la vista
            Session::flash('message', 'Ha ocurrido un error al crear el post!');
            Session::flash('alert-class', 'alert-danger'); 
            Log::info("Ha ocurrido un error al crear el post! ".$e);
            
            return redirect()->back();

        }
    }

    public function update(Request $request){
        Log::info($request->all());
        //Actualiza el post
        try {
            //Se encuentra el post por el id y se actualiza
            $post = Post::find($request->id_Update);
            $post->title = $request->title_Update;
            $post->body = $request->body_Update;
            if ($request->file('SelectImg') != null) {
                $nombre = time().'.'.$request->file('SelectImg')->extension();
                $request->file('SelectImg')->storeAs('', $nombre , 'public');
                $post->image="images\\".$nombre;
            }
            
            $post->update();

            Log::info(Post::withTrashed()->get());
            
            //Se guarda el mensaje en la Session del usuario para mostrar en la vista
            Session::flash('message', 'Post actualizado correctamente!');
            Session::flash('alert-class', 'alert-info');             
            Log::info("Post actualizado correctamente!");
            
            return redirect()->back();
        } catch (\Exception $e) {
            //Si ocurre algun error, se muestra el mensaje en la vista
            Session::flash('message', 'Ha ocurrido un error al eliminar el post!');
            Session::flash('alert-class', 'alert-danger'); 
            Log::info("Ha ocurrido un error al eliminar el post! ".$e);
            
            return redirect()->back();

        }
    }

    public function getPost(Request $request){
        Log::info(Post::find($request->id));
        //Se obtiene los datos del unico post que se requiere
        return response()->json(Post::find($request->id));
    }

    public function delete(Request $request){
        Log::info($request->all());
        try {
            //Busca el post por el id y lo borra
            Post::find($request->id_Delete)->delete();
            
            //Se guarda el mensaje en la Session del usuario para mostrar en la vista
            Session::flash('message', 'Post eliminado correctamente!');
            Session::flash('alert-class', 'alert-info'); 
            Log::info("Post eliminado correctamente!");
            
            return redirect()->back();
          
        } catch (\Exception $e) {
            //Si ocurre algun error, se muestra el mensaje en la vista        
            Session::flash('message', 'Ha ocurrido un error al eliminar el post!');
            Session::flash('alert-class', 'alert-danger'); 
            
            Log::info("Ha ocurrido un error al eliminar el post! ".$e);
            
            return redirect()->back();
        }
    }

    public function getAllPost(){
        Log::info(Post::all());
        //Se obtiene los datos de todos los posts
        return view('posts.index',['posts'=>Post::all()]);
    }
}
