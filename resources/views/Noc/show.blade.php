<x-admin.layout>
    <x-slot name="title">View NOC Details</x-slot>
    <x-slot name="heading">View NOC Details</x-slot>
    {{-- <x-slot name="subheading">Test</x-slot> --}}


        <!-- Add Form -->
        <div class="row" id="addContainer">
            <div class="col-sm-12">
                <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">NOC Details</h4>
                        </div>
                        <div class="card-body">
                            <div class="mb-3 row">
                                
                                <div class="col-md-4">
                                    <label class="col-form-label" for="name">Applicant Name <span class="text-danger">*</span></label>
                                    <input class="form-control" id="applicant_name" name="applicant_name" type="text" placeholder="Enter Applicant Name" value="{{ $Noc_data->applicant_name }}" readonly>
                                    <span class="text-danger is-invalid applicant_name_err"></span>
                                </div>

                                <div class="col-md-4">
                                    <label class="col-form-label" for="date">Date <span class="text-danger">*</span></label>
                                    <input class="form-control" id="date" name="date" type="date" value="{{ $Noc_data->date }}" readonly>
                                    <span class="text-danger is-invalid date_err"></span>
                                </div>

                                <div class="col-md-4">
                                    <label class="col-form-label" for="property_type">Property Type <span class="text-danger">*</span></label>
                                    <select class="form-control" name="property_type" id="property_type" disabled>
                                        <option value="">Select Property Type</option>
                                        @foreach ( $propertyTypes as $type)
                                            <option value="{{ $type->id }}" @if($type->id == $Noc_data->property_type) selected @endif>{{ $type->property_type_name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger is-invalid property_type_err"></span>
                                </div>

                                <div class="col-md-4">
                                    <label class="col-form-label" for="address_of_applicant">Address Of Applicant <span class="text-danger">*</span></label>
                                    <textarea class="form-control" name="address_of_applicant" id="address_of_applicant" cols="30" rows="2" placeholder="Enter Applicant Address" readonly>{{ $Noc_data->address_of_applicant }}</textarea>
                                    <span class="text-danger is-invalid address_of_applicant_err"></span>
                                </div>

                                <div class="col-md-4">
                                    <label class="col-form-label" for="address_of_property">Address Of Property <span class="text-danger">*</span></label>
                                    <textarea class="form-control" name="address_of_property" id="address_of_property" cols="30" rows="2" placeholder="Enter Property Address" readonly>{{ $Noc_data->address_of_property }}</textarea>
                                    <span class="text-danger is-invalid address_of_property_err"></span>
                                </div>

                                <div class="col-md-4">
                                    <label class="col-form-label" for="phone_no">Phone Number <span class="text-danger">*</span></label>
                                    <input class="form-control" id="phone_no" name="phone_no" type="text" placeholder="Enter Phone Number" value="{{ $Noc_data->phone_no }}" readonly>
                                    <span class="text-danger is-invalid phone_no_err"></span>
                                </div>

                                <div class="col-md-4">
                                    <label class="col-form-label" for="addhar_no">Addhar No<span class="text-danger">*</span></label>
                                    <input class="form-control" id="addhar_no" name="addhar_no" type="text" placeholder="Enter Addhar No" value="{{ $Noc_data->addhar_no }}" readonly>
                                    <span class="text-danger is-invalid addhar_no_err"></span>
                                </div>

                                @foreach ($noc_documents as $documents)
                                    <div class="col-md-4">
                                        <label class="col-form-label" for="docs">{{ $documents->document_name }} ( {{ $documents->document_name_in_marathi }} ) @if($documents->is_required == '1')<span class="text-danger">*</span> @endif</label>
                                        <input class="form-control" id="docs" name="doc[]" type="file" @if($documents->is_required == '1') required @endif disabled>
                                        <input type="hidden" name="doc_id[]" value="{{ $documents->id }}">
                                        <a href="{{asset('storage/'.$documents->file_path)}}" target="__blank">View Document</a>
                                        <span class="text-danger is-invalid docs_err"></span>
                                    </div>
                                @endforeach
                            </div>

                            <div class="card-footer text-center">
                                <a href="{{ url()->previous() }}" class="btn btn-primary" >Back</a>
                            </div>

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





