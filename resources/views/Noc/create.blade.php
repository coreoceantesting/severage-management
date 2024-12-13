<x-admin.layout>
    <x-slot name="title">Apply For NOC</x-slot>
    <x-slot name="heading">Apply For NOC</x-slot>
    {{-- <x-slot name="subheading">Test</x-slot> --}}


        <!-- Add Form -->
        <div class="row" id="addContainer">
            <div class="col-sm-12">
                <div class="card">
                    <form class="theme-form" name="addForm" id="addForm" enctype="multipart/form-data">
                        @csrf

                        <div class="card-header">
                            <h4 class="card-title">Apply For NOC</h4>
                        </div>
                        <div class="card-body">
                            <div class="mb-3 row">
                                
                                <div class="col-md-4">
                                    <label class="col-form-label" for="name">Applicant Name <span class="text-danger">*</span></label>
                                    <input class="form-control" id="applicant_name" name="applicant_name" type="text" placeholder="Enter Applicant Name">
                                    <span class="text-danger is-invalid applicant_name_err"></span>
                                </div>

                                <div class="col-md-4">
                                    <label class="col-form-label" for="date">Date <span class="text-danger">*</span></label>
                                    <input class="form-control" id="date" name="date" type="date">
                                    <span class="text-danger is-invalid date_err"></span>
                                </div>

                                <div class="col-md-4">
                                    <label class="col-form-label" for="property_type">Property Type <span class="text-danger">*</span></label>
                                    <select class="form-control" name="property_type" id="property_type">
                                        <option value="">Select Property Type</option>
                                        @foreach ( $propertyTypes as $type)
                                            <option value="{{ $type->id }}">{{ $type->property_type_name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger is-invalid property_type_err"></span>
                                </div>

                                <div class="col-md-4">
                                    <label class="col-form-label" for="address_of_applicant">Address Of Applicant <span class="text-danger">*</span></label>
                                    <textarea class="form-control" name="address_of_applicant" id="address_of_applicant" cols="30" rows="2" placeholder="Enter Applicant Address"></textarea>
                                    <span class="text-danger is-invalid address_of_applicant_err"></span>
                                </div>

                                <div class="col-md-4">
                                    <label class="col-form-label" for="address_of_property">Address Of Property <span class="text-danger">*</span></label>
                                    <textarea class="form-control" name="address_of_property" id="address_of_property" cols="30" rows="2" placeholder="Enter Property Address"></textarea>
                                    <span class="text-danger is-invalid address_of_property_err"></span>
                                </div>

                                <div class="col-md-4">
                                    <label class="col-form-label" for="phone_no">Phone Number <span class="text-danger">*</span></label>
                                    <input class="form-control" id="phone_no" name="phone_no" type="text" placeholder="Enter Phone Number">
                                    <span class="text-danger is-invalid phone_no_err"></span>
                                </div>

                                <div class="col-md-4">
                                    <label class="col-form-label" for="addhar_no">Addhar No<span class="text-danger">*</span></label>
                                    <input class="form-control" id="addhar_no" name="addhar_no" type="text" placeholder="Enter Addhar No">
                                    <span class="text-danger is-invalid addhar_no_err"></span>
                                </div>

                            </div>

                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary" id="addSubmit">Submit</button>
                            <button type="reset" class="btn btn-warning">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


</x-admin.layout>


{{-- Add --}}
<script>
    $("#addForm").submit(function(e) {
        e.preventDefault();
        $("#addSubmit").prop('disabled', true);

        var formdata = new FormData(this);
        $.ajax({
            url: '{{ route('wards.store') }}',
            type: 'POST',
            data: formdata,
            contentType: false,
            processData: false,
            success: function(data)
            {
                $("#addSubmit").prop('disabled', false);
                if (!data.error2)
                    swal("Successful!", data.success, "success")
                        .then((action) => {
                            window.location.href = '{{ route('wards.index') }}';
                        });
                else
                    swal("Error!", data.error2, "error");
            },
            statusCode: {
                422: function(responseObject, textStatus, jqXHR) {
                    $("#addSubmit").prop('disabled', false);
                    resetErrors();
                    printErrMsg(responseObject.responseJSON.errors);
                },
                500: function(responseObject, textStatus, errorThrown) {
                    $("#addSubmit").prop('disabled', false);
                    swal("Error occured!", "Something went wrong please try again", "error");
                }
            }
        });

    });
</script>





