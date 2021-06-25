@extends('layouts.app2')
@section('content')
{{--<link rel="stylesheet" href="{{ asset('public/admin/plugins/select2/css/select2.css') }}">
<script src="{{ asset('public/admin/plugins/select2/js/select2.js') }}"></script>--}}
<div class="content-header">
        <div class="container-fluid">
        <section class="content">
      <div class="row">
        <div class="col-12">
<div class="card @if($errors->any()) card-danger @elseif(Session::get('msg')) card-success @else card-primary @endif">
    <div class="card-header">
    <h3 class="card-title">Add Cms Pages</h3>
    </div>
    {{ Form::open(array('url' => '/admin/cms', 'id' => 'cms-add', 'role' => 'form', 'enctype'=>'multipart/form-data')) }}

    <div class="card-body pad">
    @include('backend.cms.form', ['submitButtonText'=>'Add'])
    {{ Form::close() }}
</div>
<!-- /.card -->


</div>
</div>
</div>
</section>
</div>
</div>
@endsection