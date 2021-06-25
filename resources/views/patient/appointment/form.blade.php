<script src="{{ asset('admin/plugins/ckeditor_4/ckeditor.js') }}"></script>
    <div class="card-body pad">
        <div class="row">


        <div class="form-group col-6">
            <label for="title">Title<span class="red-star">*</span></label>
            <input type="text" name="title" value="{{old('title', isset($cms)?$cms->title:'')}}" class="form-control @error('title') is-invalid @enderror" id="title" placeholder="Title">
            @error('title')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-group col-6">
            <label for="url">Slug<span class="red-star">*</span></label>
            <input type="text" name="slug" value="{{old('slug', isset($cms)?$cms->slug:'')}}" class="form-control @error('slug') is-invalid @enderror" id="slug" placeholder="slug">
            @error('slug')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-group col-6">
            <label for="meta_title">Meta Title<span class="red-star">*</span></label>
            <input type="text" name="meta_title" value="{{old('meta_title', isset($cms)?$cms->meta_title:'')}}" class="form-control @error('meta_title') is-invalid @enderror" id="meta_title" placeholder="Meta Title">
            @error('meta_title')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group col-6">
            <label for="meta_title">Meta Keyword<span class="red-star">*</span></label>
            <input type="text" name="meta_keyword" value="{{old('meta_keyword', isset($cms)?$cms->meta_keyword:'')}}" class="form-control @error('meta_keyword') is-invalid @enderror" id="meta_keyword" placeholder="Meta Keyword">
            @error('meta_keyword')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-group col-12">
            <label for="meta_description">Meta Description</label>
            <textarea name="meta_description" class="form-control @error('meta_description') is-invalid @enderror" id="meta_description" placeholder="Place some text here" cols="80">{{old('meta_description', isset($cms)?$cms->meta_description:'')}}</textarea>
            @error('meta_description')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-group col-12">
            <label for="description">Description</label>
            <textarea name="description" class="ckeditor @error('description') is-invalid @enderror" id="description" placeholder="Place some text here" rows="10" cols="80">{{old('description', isset($cms)?$cms->description:'')}}</textarea>
            @error('description')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-group has-feedback col-md-6{{ $errors->has('status') ? ' has-error' : '' }}">
        {!! Form::label('status', 'Status') !!}
        {!! Form::select('status', ['1' => 'Enable', '0' => 'Disable'] , isset($cms->status) && $cms->status == 1 ? 1 : 0, ['class'=>'form-control', '']) !!}
        @if ($errors->has('status'))
                <span class="help-block">
                        <strong>{{ $errors->first('status') }}</strong>
                </span>
        @endif
    </div>

    

    {{--<div class="form-group col-6">
    <div id="delmsg" class="alert hide"></div>

            <label for="file">Image<span class="red-star">*</span></label>
            @if(isset($cms) && strlen($cms->image))
            @include ('backend.common.confirm-img-delete')
                <img name="image" src="{{url($cms->image)}}" id="imagedel" width="100" height="100" />
                <a id="del_id" class = "formConfirm" href="javascript:void(0);" 
                    data-form="#frmDelete-{{$cms->statement_id}}-cms-imagedelete-imagedel-image-del_id"
                    data-title="Delete Image" 
                    data-message="Are you sure you want to delete?">Delete</a>
                    <input type="file" name="image" class="form-control image hide" id="image">

            @else

                <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                   @error('image')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                 @enderror
            @endif
    </div>--}}

        
        </div>
    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
    <script type="text/javascript">
CKEDITOR.replace( 'description' );


</script>