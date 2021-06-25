<div class="card card-danger card-outline">
    <div class="card-header">
    <h3 class="card-title">About Me</h3>
    </div>
    <div class="card-body">
        <strong><i class="far fa-file-alt mr-1"></i>Personal Notes</strong>
         <p class="text-muted">{!! Auth::guard('doctor')->user()->note !!}.</p>
        <hr>
        <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>
            @php
                $country = $CentralController->getCountryById(Auth::guard('doctor')->user()->country);
                $state = $CentralController->getCountryById(Auth::guard('doctor')->user()->state);
            @endphp
            <p class="text-muted">{{Auth::guard('doctor')->user()->address}}, {{isset($country[0]['title'])?$country[0]['title']:''}}, {{isset($state[0]['title'])?$state[0]['title']:''}}</p>
            <hr>
            <strong><i class="fas fa-pencil-alt mr-1"></i> Specialization</strong>
            @php
                $Specialization = $CentralController->getSpecializationById(Auth::guard('doctor')->user()->specialization_id);
            @endphp
            <p class="text-muted">
                @foreach($Specialization as $key => $value)
                    <span class="tag tag-danger">{{$value['title']}},   </span>
                @endforeach
            </p>
            <hr>
    </div>
</div>