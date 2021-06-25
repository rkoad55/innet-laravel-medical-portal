@extends('layouts.app3')
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-12">
            <div class="card card-dark  card-outline">
                <div class="card-header">
                 <h3 class="card-title">Edit Appointment</h3>
                </div>
                <div class="card-body pad">
                    {{ Form::model($appointment, ['method'=>'PATCH', 'route' => ['appointment.update', $appointment->id], 'enctype'=>'multipart/form-data']) }}
                        @include('admin.appointment.form', ['submitButtonText'=>'Update'])
                    {{ Form::close() }}
                </div>
          </div>
        </div>
      </div>
    </section>
<script>
// CKEDITOR.replace( 'description' );
</script>
@endsection