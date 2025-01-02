<x-admin.layout>
    <x-slot name="title">View NOC Details</x-slot>
    <x-slot name="heading">View NOC Details</x-slot>

    <!-- Add Form -->
    <div class="row" id="addContainer">
        <div class="col-sm-12">
            <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4 class="card-title">NOC Details</h4>

            </div>
                <div class="card-body">
                    <div class="mb-3 row">

                        <div class="col-md-4">
                            <label class="col-form-label" for="name">Applicant Name <span class="text-danger">*</span></label>
                            <input class="form-control" id="applicant_name" name="applicant_name" type="text" placeholder="Enter Applicant Name" value="{{ $nocData->applicant_name }}" readonly>
                        </div>

                        <div class="col-md-4">
                            <label class="col-form-label" for="date">Date <span class="text-danger">*</span></label>
                            <input class="form-control" id="date" name="date" type="date" value="{{ $nocData->date }}" readonly>
                        </div>

                        <div class="col-md-4">
                            <label class="col-form-label" for="property_type">Property Type <span class="text-danger">*</span></label>
                            <select class="form-control" name="property_type" id="property_type" disabled>
                                <option value="">Select Property Type</option>
                                @foreach ( $propertyTypes as $type)
                                    <option value="{{ $type->id }}" @if($type->id == $nocData->property_type) selected @endif>{{ $type->property_type_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="col-form-label" for="address_of_applicant">Address Of Applicant <span class="text-danger">*</span></label>
                            <textarea class="form-control" name="address_of_applicant" id="address_of_applicant" cols="30" rows="2" placeholder="Enter Applicant Address" readonly>{{ $nocData->address_of_applicant }}</textarea>
                        </div>

                        <div class="col-md-4">
                            <label class="col-form-label" for="address_of_property">Address Of Property <span class="text-danger">*</span></label>
                            <textarea class="form-control" name="address_of_property" id="address_of_property" cols="30" rows="2" placeholder="Enter Property Address" readonly>{{ $nocData->address_of_property }}</textarea>
                        </div>

                        <div class="col-md-4">
                            <label class="col-form-label" for="phone_no">Phone Number <span class="text-danger">*</span></label>
                            <input class="form-control" id="phone_no" name="phone_no" type="text" placeholder="Enter Phone Number" value="{{ $nocData->phone_no }}" readonly>
                        </div>

                        <div class="col-md-4">
                            <label class="col-form-label" for="addhar_no">Addhar No<span class="text-danger">*</span></label>
                            <input class="form-control" id="addhar_no" name="addhar_no" type="text" placeholder="Enter Addhar No" value="{{ $nocData->addhar_no }}" readonly>
                        </div>

                        <div class="col-md-4">
                            <label class="col-form-label" for="file_path">Document<span class="text-danger">*</span></label>
                            <input class="form-control" id="file_path" name="file_path" type="file">
                            <div class="mt-2">
                                <a href="{{ asset('storage/'.$nocData->file_path) }}" target="_blank" class="btn btn-link">View Document</a>
                            </div>


                            <span class="text-danger is-invalid aadhar_pans_err"></span>
                        </div>


                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">NOC Status Details</h4>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Role</th>
                                                <th>Status</th>
                                                <th>Remark</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>Clerk</td>
                                                <td>
                                                    @if($nocData->clerk_status == 0)
                                                        <b>Pending by clerk</b>
                                                    @elseif($nocData->clerk_status == 1)
                                                       <b> Approve by clerk </b>
                                                    @elseif($nocData->clerk_status == 2)
                                                        <b>Reject by clerk</b>
                                                    @else
                                                        Status not available
                                                    @endif
                                                </td>
                                                <td>
                                                    {{ $nocData->clerk_remark ?? 'No remarks available' }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Junior Engineer</td>
                                                <td>
                                                    @if($nocData->jr_eng_status == 0)
                                                        <b>Pending by Junior Engineer</b>
                                                    @elseif($nocData->jr_eng_status == 1)
                                                     <b>  Approve by Junior Engineer</b>
                                                    @elseif($nocData->jr_eng_status == 2)
                                                        <b>Reject by Junior Engineer</b>
                                                    @else
                                                        Status not available
                                                    @endif
                                                </td>
                                                <td>
                                                    {{ $nocData->jr_eng_remark ?? 'No remarks available' }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>Senior Engineer</td>
                                                <td>
                                                    @if($nocData->sr_eng_status == 0)
                                                        <b>Pending by Senior Engineer</b>
                                                    @elseif($nocData->sr_eng_status == 1)
                                                        <b> Approve by Senior Engineer </b>
                                                    @elseif($nocData->sr_eng_status == 2)
                                                        <b>Reject by Senior Engineer</b>
                                                    @else
                                                        Status not available
                                                    @endif
                                                </td>
                                                <td>
                                                    {{ $nocData->sr_eng_remark ?? 'No remarks available' }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>4</td>
                                                <td>HOD</td>
                                                <td>
                                                    @if($nocData->hod_status == 0)
                                                        <b>Pending by HOD</b>
                                                    @elseif($nocData->hod_status == 1)
                                                     <b>   Approve by HOD </b>
                                                    @elseif($nocData->hod_status == 2)
                                                        <b>Reject by HOD</b>
                                                    @else
                                                        Status not available
                                                    @endif
                                                </td>
                                                <td>
                                                    {{ $nocData->hod_remark ?? 'No remarks available' }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>5</td>
                                                <td>City Engineer</td>
                                                <td>
                                                    @if($nocData->city_eng_status == 0)
                                                        <b>Pending by City Engineer</b>
                                                    @elseif($nocData->city_eng_status == 1)
                                                     <b>   Approve by City Engineer </b>
                                                    @elseif($nocData->city_eng_status == 2)
                                                        <b>Reject by City Engineer</b>
                                                    @else
                                                        Status not available
                                                    @endif
                                                </td>
                                                <td>
                                                    {{ $nocData->city_eng_remark ?? 'No remarks available' }}
                                                </td>
                                            </tr>
                                  </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="card-footer text-center">
                    <a href="{{ url()->previous() }}" class="btn btn-primary">Back</a>
                </div>

            </div>
        </div>
    </div>

</x-admin.layout>

{{-- mobile and adhar validation --}}
<script>
     $(document).ready(function () {
        $('#phone_no').on('input', function () {
            const phoneValue = $(this).val();
            $(this).val(phoneValue.replace(/[^0-9]/g, '').substring(0, 10));
        });

        // Validate Aadhaar Number (12 digits only)
        $('#addhar_no').on('input', function () {
            const aadhaarValue = $(this).val();
            $(this).val(aadhaarValue.replace(/[^0-9]/g, '').substring(0, 12));
        });
     });

</script>





