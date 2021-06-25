@extends('layouts.app3')
@section('content')
{{--<link rel="stylesheet" href="{{ asset('admin/plugins/select2/css/select2.css') }}">
<script src="{{ asset('admin/plugins/select2/js/select2.js') }}"></script>--}}
      <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card card-dark card-outline">
            <div class="card-header">
              <h3 class="card-title">Add Deparment</h3>
            </div>
            <div class="card-body pad">
              {{ Form::open(array('url' => '/admin/appointment', 'id' => 'appointment-add', 'role' => 'form', 'enctype'=>'multipart/form-data')) }}
              @include('admin.appointment.form', ['submitButtonText'=>'Add'])
              {{ Form::close() }}
            </div>
          </div>
        </div>
      </div>
      </section>
@endsection