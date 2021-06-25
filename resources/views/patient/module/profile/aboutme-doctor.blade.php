<div class="card card-danger  card-outline">
    <div class="card-header">
    <h3 class="card-title">About Patient</h3>
    </div>
    <div class="card-body">
    
    <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>
    @php
        $country = $CentralController->getCountryById($doctor->country);
        $state = $CentralController->getCountryById($doctor->state);
        //$doctor_avalibility = $CentralController->getDoctorAvalibilityById($doctor->id);
        //dd($country[0]['title']);
    @endphp
    <p class="text-muted">{{$doctor->address}}, {{isset($country[0]['title'])?$country[0]['title']:''}}, {{isset($state[0]['title'])?$state[0]['title']:''}}</p>
    <hr>
    <strong><i class="fas fa-hospital mr-1"></i> Related Depart</strong>
    @php
        $Specialization = $CentralController->getSpecializationById($doctor->specialization_id);
    @endphp
    <p class="text-muted">
        @foreach($Specialization as $key => $value)
            <span class="tag tag-danger">{{$value['title']}}, </span>
        @endforeach
    </p>
    <hr>
    <strong><i class="far fa-file-alt mr-1"></i>Personal Notes</strong>
    <p class="text-muted">{{Auth::guard('patient')->user()->note}}.</p>
    </div>
</div>