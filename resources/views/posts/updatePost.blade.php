<!-- Modal modificar post-->
<div class="modal fade" id="modalUpdate" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Modificar Post</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form form="PostUpdate" method="POST" action="{{ route('updatePost') }}"  enctype="multipart/form-data">
            <input id="id_Update" type="hidden" name="id_Update" required>
            <div class="modal-body">
            
                @csrf

                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Titulo') }}</label>

                    <div class="col-md-6">
                        <input id="title_Update" type="text" class="form-control @error('name') is-invalid @enderror" name="title_Update" required>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="body_Update" class="col-md-4 col-form-label text-md-right">{{ __('Cuerpo') }}</label>

                    <div class="col-md-6">
                        <textarea class="form-control @error('body') is-invalid @enderror" rows="5" id="body_Update" name="body_Update" required></textarea>

                        @error('body')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="SelectImg" class="col-md-4 col-form-label text-md-right">{{ __('Imagen') }}</label>

                    <div class="col-md-6">
                    
                        <input id="SelectImg" type="file" class="form-control-file border @error('image') is-invalid @enderror" id="imagen" name="SelectImg">
                        <img id="image_Update" style="width: 200px !important;" alt="">
                        @error('image')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                

                
                
            </div>
            <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Cerrar') }}</button>
                    <button type="submit" class="btn btn-primary">{{ __('Actualizar Post') }}</button>
                </div>
        </form>

        

    </div>
</div>

</div>