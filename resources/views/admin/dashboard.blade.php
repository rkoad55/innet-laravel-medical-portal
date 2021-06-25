@extends('layouts.app3')

@section('content')
<section class="content-header">
      <div class="container-fluid">
<div class="row">
          
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fa fa-hospital" aria-hidden="true"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Department</span>
                <span class="info-box-number">500</span>
              </div>
            </div>
          </div>
          <div class="clearfix hidden-md-up"></div>
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fa fa-user-md"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Doctor</span>
                <span class="info-box-number">{{$doctor_count}}</span>
              </div>
            </div>
          </div>
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fa fa-wheelchair"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Patient</span>
                <span class="info-box-number">{{$patient_count}}</span>
              </div>
            </div>
          </div>
        </div>
        </div>
      </section>
@endsection