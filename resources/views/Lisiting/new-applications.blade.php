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
                                        <th>Status</th> <!-- New Status Column -->
                                        @if(!Auth::user()->hasRole('Citizen'))
                                            <th>Action</th> <!-- Only show this column if the user is NOT a Citizen -->
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
        @foreach ($nocs as $index => $noc)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $noc->application_id }}</td>
                <td>{{ $noc->applicant_name }}</td>
                <td>{{ \Carbon\Carbon::parse($noc->date)->format('d-m-Y') }}</td>
                <td>{{ $noc->phone_no }}</td>
                <td>
                    @php
                        $statusMap = [
                            '1' => '<span class="badge bg-success">Approved</span>',
                            '2' => '<span class="badge bg-danger">Rejected</span>',
                            'default' => '<span class="badge bg-warning">Pending</span>',
                        ];

                        $roleStatusMap = [
                            'Super Admin'=>$noc->sup_admin,
                            'Citizen'=>$noc->citizen,
                            'CLerk' => $noc->clerk_status,
                            'Junior Engineer' => $noc->jr_eng_status,
                            'Senior Engineer' => $noc->sr_eng_status,
                            'HOD' => $noc->hod_status,
                            'Citizen Engineer' => $noc->city_eng_status,
                        ];
                    @endphp
                    {{-- @dd(Auth::user()->roles[0]->name); --}}
                    @php $roleName = Auth::user()->roles[0]->name; @endphp
                    @if (Auth::user()->hasRole($roleName))

                     {{-- <div class="card-footer text-center"> --}}
                        {{-- <a href="{{ url()->previous() }}" class="btn btn-primary">Back</a> --}}
                         {{-- @if($nocData)

                        <a href="{{ route('download.pdf', $nocData->id) }}" class="btn btn-success">Download PDF</a>
                    @else
                        <p>Data not found.</p>
                    @endif
                    </div> --}}

                    {{-- <div class="row mb-3">
                        <div class="col-lg-12">
                            <a href="{{ route('applications.pdf','$nocData->id') }}" class="btn btn-primary">Download PDF</a>
                        </div>
                    </div> --}}
                    <a href="{{ route('download.pdf', $noc->id) }}" class="btn btn-success">Download PDF</a>


                                <a href="{{ route('apply-for-noc.show', $noc->id) }}" class="btn btn-info btn-sm" title="View">
                            <i data-feather="eye"></i>
                        </a>
                        @else

                        {!! $statusMap[$noc->status] ?? $statusMap['default'] !!}
                    @endif
                </td>
                {{-- @dd(Auth::user()->hasRole('Citizen')) --}}
                @if(!Auth::user()->hasRole('Citizen'))
                <td>
                    {!! $statusMap[$roleStatusMap[Auth::user()->roles[0]->name]] ?? $statusMap['default'] !!}
                            <button class="btn btn-success btn-sm clickStatus" onclick="openModal('approve', {{ $noc->id }})" data-id="{{ $noc->id }}" data-status="1" title="Approve Clerk"><i data-feather="check"></i> Approve</button>

                        <!-- Reject Button -->
                        <button class="btn btn-danger btn-sm clickStatus" data-id="{{ $noc->id }}" data-status="2" title="Reject"><i data-feather="x"></i> Reject</button>
                    @else


                </td>

                @endif

            </tr>
        @endforeach
    </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="statusModal" tabindex="-1" aria-labelledby="statusModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="post" action="{{ route('apply-for-noc.approve') }}" id="statusForm">
                        @csrf
                        <input type="hidden" id="hiddenId" name="id">
                        <input type="hidden" id="hiddenStatus" name="status">
                        <div class="modal-header">
                            <h5 class="modal-title" id="statusModalLabel">Update Application Status</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="description">Remarks</label>
                                <textarea name="remark" id="description" class="form-control" rows="3" required></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </x-admin.layout>

    <!-- JavaScript -->
    <script>
        $(document).ready(function(){
            $('body').on('click', '.clickStatus', function(){
                let id = $(this).attr('data-id');
                let status = $(this).attr('data-status');
                $('#hiddenId').val(id)
                $('#hiddenStatus').val(status)
                $('#statusModal').modal('show');
                if (status == 2) {
                $('#statusModalLabel').text('Reject Application');
            }
            $('#statusModal').modal('show');
        });
        });


    </script>
