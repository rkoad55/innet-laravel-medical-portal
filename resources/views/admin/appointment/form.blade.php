<script src="{{ asset('assets/plugins/summernote/summernote-bs4.min.js') }}"></script>
<link rel="stylesheet" href="{{ asset('assets/plugins/summernote/summernote-bs4.css') }}">
    <div class="card-body pad">
        <div class="row">


        <div class="form-group col-md-12">
            <label for="title">Title<span class="red-star">*</span></label>
            <input type="text" name="title" value="{{old('title', isset($appointment)?$appointment->title:'')}}" class="form-control @error('title') is-invalid @enderror" id="title" placeholder="Title">
            @error('title')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <!--<div class="form-group col-6">
            <label for="url">Slug<span class="red-star">*</span></label>
            <input type="text" name="slug" value="{{old('slug', isset($appointment)?$appointment->slug:'')}}" class="form-control @error('slug') is-invalid @enderror" id="slug" placeholder="Slug">
            @error('slug')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-group col-6">
            <label for="meta_title">Meta Title<span class="red-star">*</span></label>
            <input type="text" name="meta_title" value="{{old('meta_title', isset($appointment)?$appointment->meta_title:'')}}" class="form-control @error('meta_title') is-invalid @enderror" id="meta_title" placeholder="Meta Title">
            @error('meta_title')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group col-6">
            <label for="meta_title">Meta Keyword<span class="red-star">*</span></label>
            <input type="text" name="meta_keyword" value="{{old('meta_keyword', isset($appointment)?$appointment->meta_keyword:'')}}" class="form-control @error('meta_keyword') is-invalid @enderror" id="meta_keyword" placeholder="Meta Keyword">
            @error('meta_keyword')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-group col-12">
            <label for="meta_description">Meta Description</label>
            <textarea name="meta_description" class="form-control @error('meta_description') is-invalid @enderror" id="meta_description" placeholder="Place some text here" cols="80">{{old('meta_description', isset($appointment)?$appointment->meta_description:'')}}</textarea>
            @error('meta_description')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-group col-12">
            <label for="short_description">Short Description</label>
            <textarea class="form-control" name="short_description" placeholder="Place some text here" style="">{{isset($appointment)?$appointment->short_description:''}}</textarea>
            @error('short_description')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>-->

        <div class="form-group col-12">
            <label for="description">Description</label>
            <textarea class="textarea" name="description" placeholder="Place some text here" style="">{{isset($appointment)?$appointment->description:''}}</textarea>
            @error('description')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        

    

    <!-- <div class="form-group col-6">
    <div id="delmsg" class="alert hide"></div>

            <label for="file">Feature Image<span class="red-star">*</span></label>
            @if(isset($appointment) && strlen($appointment->image))
            @include ('admin.common.confirm-img-delete')
                <img src="{{asset($appointment->image)}}" id="imagedel" width="100" height="100" />
                <a id="del_id" class = "formConfirm" href="javascript:void(0);" 
                    data-form="#frmDelete-{{$appointment->id}}-appointment-imagedelete-imagedel-feature_image-del_id"
                    data-title="Delete Image" 
                    data-message="Are you sure you want to delete?">Delete</a>
                    <div class="custom-file image hide" id="feature_image">
                      <input type="file" name="image" class="form-control custom-file-input @error('image') is-invalid @enderror" id="image">
                      <label class="custom-file-label" for="image">Choose file</label>
                    </div>

            @else
                <div class="custom-file">
                  <input type="file" name="image" class="form-control custom-file-input @error('image') is-invalid @enderror" id="image">
                  <label class="custom-file-label" for="image">Choose file</label>
                </div>

                   @error('image')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                 @enderror
            @endif
    </div> -->

    <div class="form-group has-feedback col-md-6{{ $errors->has('status') ? ' has-error' : '' }}">
        {!! Form::label('status', 'Status') !!}
        {!! Form::select('status', ['1' => 'Enable', '0' => 'Disable'] , isset($appointment->status) && $appointment->status == $appointment->status ? $appointment->status : 1, ['class'=>'form-control', '']) !!}
        @if ($errors->has('status'))
                <span class="help-block">
                        <strong>{{ $errors->first('status') }}</strong>
                </span>
        @endif
    </div>

        
        </div>
    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-dark">Submit</button>
    </div>
    <script type="text/javascript">
$(function () {
  $('.textarea').summernote({
    height: 250, // set editor height
   minHeight: null, // set minimum height of editor
    maxHeight: null, // set maximum height of editor
    focus: true // set focus to editable area after initializing summernote
  });
});

$('#title').focusout(function() {
  var text = $('#title').val();
  text = text.toLowerCase().replace(/[^\w ]+/g,'').replace(/ +/g,'-');
  // alert(text);
  var slug = $('#slug').val(text);

});
$('#image').on('change',function(){
                //get the file name
    var fileName = $(this).val().split("\\");
    // alert(fileName[0]);
    //replace the "Choose a file" label
    $(this).next('.custom-file-label').html(fileName[2]);

});

</script>