<x-admin.layout>
    <x-slot name="title">New Application List</x-slot>
    <x-slot name="heading">New Application List</x-slot>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="buttons-datatables" class="table table-bordered nowrap align-middle" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Sr.No</th>
                                    <th>Application No</th>
                                    <th>Applicant Name</th>
                                    <th>Date</th>
                                    <th>Phone No</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($nocs as $index => $noc)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $noc->application_id }}</td>
                                        <td>{{ $noc->applicant_name }}</td>
                                        <td>{{ \Carbon\Carbon::parse($noc->date)->format('d-m-Y') }}</td>
                                        <td>{{ $noc->phone_no}}</td>
                                        <td>
                                            {{-- <button class="edit-element btn text-secondary px-2 py-1" title="Edit document" data-id="{{ $noc->id }}"><i data-feather="edit"></i></button>
                                            <button class="btn text-danger rem-element px-2 py-1" title="Delete document" data-id="{{ $noc->id }}"><i data-feather="trash-2"></i> </button> --}}
                                            <a href="{{ route('apply-for-noc.show', $noc->id) }}" class="view-element btn text-secondary px-2 py-1"><i data-feather="eye"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-admin.layout>