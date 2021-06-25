            
            <div class="card card-danger  card-outline collapsed-card">
                <div class="card-header" data-card-widget="collapse">
                <h3 class="card-title">Insurance Information</h3>
                <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>

                </div>
              </div>
              <div class="card-body">
                <form role="form" action="{{route('patient.insurancesubmit')}}" id="form3" novalidate="novalidate">
                    <!-- ------------------------------------------------------------------------------------------- -->
                    <div class="row">
                        <div class="form-group col-6 required">
                            <label for="primary_insurance_company" clas="required">Primary Insurance Company<span class="text-danger">*</span></label>
                            <input type="text" name="primary_insurance_company" value="" class="form-control" id="primary_insurance_company" placeholder="Primary Insurance Company Name">
                        </div>
                        <div class="form-group col-6">
                            <label for="policy_number" clas="required">Policy Number<span class="text-danger">*</span></label>
                            <input type="text" name="policy_number" value=" " class="form-control" id="policy_number" placeholder="Policy Number">
                        </div>
                    </div>
                    <!-- ------------------------------------------------------------------------------------------- -->
                    
                    <div class="row">
                        <div class="form-group col-6 required">
                            <label for="group_number" clas="required">Group Number<span class="text-danger">*</span></label>
                            <input type="text" name="group_number" value="" class="form-control" id="group_number" placeholder="Group Number">
                        </div>
                        <div class="form-group col-6">
                            <label for="primary_insurance_phone_no" clas="required">Primary Insurance Phone Number<span class="text-danger">*</span></label>
                            <input type="text" name="primary_insurance_phone_no" value=" " class="form-control" id="primary_insurance_phone_no" placeholder="Primary Insurance Phone Number">
                        </div>
                    </div>
                    
                    <!-- ------------------------------------------------------------------------------------------- -->
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="subscriber_name" clas="required">Primary Insurance Phone Number<span class="text-danger">*</span></label>
                            <input type="text" name="subscriber_name" value=" " class="form-control" id="subscriber_name" placeholder="Subscriber Name">
                        </div>
                        <div class="form-group col-6 required">
                            <label for="dob" clas="required">Date of Birth<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="dob" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask>
                        </div>
                    </div>

                    <!-- ------------------------------------------------------------------------------------------- -->
                    <div class="row">
                        <div class="form-group col-6 required">
                            <label for="subscriber_name" clas="required">Group Number<span class="text-danger">*</span></label>
                            <input type="text" name="group_number" value="" class="form-control" id="group_number" placeholder="Group Number">
                        </div>
                        <div class="form-group col-6">
                            <label for="subscriber_name" clas="required">Primary Insurance Phone Number<span class="text-danger">*</span></label>
                            <input type="text" name="subscriber_name" value=" " class="form-control" id="subscriber_name" placeholder="Subscriber Name">
                        </div>
                    </div>
                    
                    <!-- ------------------------------------------------------------------------------------------- -->
                    
                    <div class="row">
                    {{--dd($CentralController::getCountryById(1))--}}
                        <div class="form-group col-6" data-select2-id="48">
                            <label clas="required">Country</label>
                            <select class="form-control select2" id="country" name="country" style="width: 100%;">
                            @foreach($country as $key => $value)  
                                <option value="{{$value['id']}}">{{$value['title']}}</option>
                            @endforeach 
                            </select>
                        </div>
                        <div class="form-group col-6">
                            <label>State</label>
                            <select class="form-control select2" name="state" id="state" style="width: 100%;">
                            @if(!is_null(Auth::guard('patient')->user()->state))
                              @php
                                $state = $CentralController->getStateById(Auth::guard('patient')->user()->country);
                              @endphp
                              @foreach($state as $key => $value)  
                                  <option value="{{$value['id']}}">{{$value['title']}}</option>
                              @endforeach
                            @endif    
                            </select>
                        </div>
                    </div>
                    <!-- ------------------------------------------------------------------------------------------- -->
                    <div class="row">
                        
                        <div class="form-group col-6">
                            <label>DOB</label>
                            <input type="text" class="form-control" name="dob" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask>
                        </div>

                        <?php $depart_id_value = array(); ?>
                        @if(!is_null(Auth::guard('patient')->user()->depart_id))
                            <?php $depart_id_value = explode(",",Auth::guard('patient')->user()->depart_id); ?>
                        @endif
                        <div class="form-group col-6 select2-purple">
                            <label clas="required">Related Depart<span class="text-danger">*</span></label>
                            <select class="form-control select2 select2-purple" name="depart_id[]" id="depart" multiple="multiple" style="width: 100%;">
                                @foreach($specilitization as $key => $value)
                                    <option {{ in_array($value['id'], $depart_id_value)?'selected=selected':'' }} value="{{$value['id']}}">{{$value['title']}}</option>
                                @endforeach 
                            </select>
                        </div>
                        
                    </div>
                    <!-- ------------------------------------------------------------------------------------------- -->
                    <div class="row">
                        
                        <div class="form-group col-6">
                            <label>Image</label>
                            <div class="custom-file">
                                <input type="file" name="image" class="form-control custom-file-input" id="image">
                                <label class="custom-file-label" for="image">Choose file</label>
                            </div>
                        </div>
                        <div class="form-group col-6">
                            <label for="contact_no" clas="required">Contact No.<span class="text-danger">*</span></label>
                            <input type="text" name="contact_no" value="{{ Auth::guard('patient')->user()->contact_no }}" class="form-control" id="contact_no" placeholder="Contact Number">
                        </div>
                    </div>
                    <!-- ------------------------------------------------------------------------------------------- -->
                @if(Session::has('status'))
                      <div class="row">
                        <div class="col-md-12">
                          <div class="alert alert-success alert-dismissible">
                            {{ Session::get('status') }}.
                          </div>
                        </div>
                      </div>
                    @endif
                  <!-- ------------------------------------------------------------------------------------------- -->
                
                
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-danger">Submit</button>
                </div>
              </form>
            </div>

            

            