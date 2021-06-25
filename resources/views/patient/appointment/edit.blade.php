@extends('layouts.app2')
@section('content')
<div class="col-md-12">
<!-- general form elements -->
<div class="card @if($errors->any()) card-danger @elseif(Session::get('msg')) card-success @else card-primary @endif">
    <div class="card-header">
    <h3 class="card-title">Statement Update</h3>

    </div>
    <div class="card-body pad">
    {{ Form::model($cms, ['method'=>'PATCH', 'route' => ['cms.update', $cms->cms_id]]) }}
        @include('backend.cms.form', ['submitButtonText'=>'Update'])
    {{ Form::close() }}
    </div>
<!-- /.card -->


</div>
<script>
CKEDITOR.replace( 'description' );
</script>
@endsection