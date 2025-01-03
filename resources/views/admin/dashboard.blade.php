<x-admin.layout>
    <x-slot name="title">Dashboard</x-slot>
    <x-slot name="heading">Dashboard</x-slot>
    {{-- <x-slot name="subheading">Test</x-slot> --}}

    <div class="row">
        <div class="col">
            {{-- @if (Auth::user()->roles->pluck('name')[0] == "Citizen")
                <div class="card">
                    <div class="card-header">
                        Required Documents ( आवश्यक कागदपत्रे )
                    </div>
                    <div class="card-body">
                        <ul>
                            @foreach ($docs as $doc)
                                <li>{{ $doc->document_name }} ( {{ $doc->document_name_in_marathi }} )</li>
                            @endforeach

                        </ul>
                    </div>
                </div>
            @endif --}}
            <div class="d-flex flex-column h-100">                {{-- <div class="row h-100">
                    <div class="col-12 d-none">
                        <div class="card">
                            <div class="card-body p-0">
                                <div class="alert alert-warning border-0 rounded-0 m-0 d-flex align-items-center" role="alert">
                                    <i data-feather="alert-triangle" class="text-warning me-2 icon-sm"></i>
                                    <div class="flex-grow-1 text-truncate">
                                        Your free trial
                                        expired in
                                        <b>17</b> days.
                                    </div>
                                    <div class="flex-shrink-0">
                                        <a href="pages-pricing.html" class="text-reset text-decoration-underline"><b>Upgrade</b></a>
                                    </div>
                                </div>

                                <div class="row align-items-end">
                                    <div class="col-sm-8">
                                        <div class="p-3">
                                            <p class="fs-16 lh-base">
                                                Upgrade your
                                                plan from a
                                                <span class="fw-semibold">Free
                                                    trial</span>, to
                                                ‘Premium
                                                Plan’
                                                <i class="mdi mdi-arrow-right"></i>
                                            </p>
                                            <div class="mt-3">
                                                <a href="pages-pricing.html" class="btn btn-success">Upgrade
                                                    Account!</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="px-3">
                                            <img src="assets/images/user-illustarator-2.png" class="img-fluid" alt="" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end card-body-->
                        </div>
                    </div>
                    <!-- end col-->
                </div> --}}

                <div class="row">
                    <div class="col-md-6">

                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center p-3 border rounded shadow-sm bg-white">
                                    <div>
                                        <p class="fw-medium text-muted mb-1">
                                            Total Users
                                        </p>
                                        <h2 class="mt-2 text-primary">
                                            {{ $totalUsers }}
                                        </h2>

                                    </div>
                                    <div>
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-primary-subtle rounded-circle fs-3">
                                                <i class="ri-user-3-line text-primary"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card-->

                    <!-- end col-->

                    <div class="col-md-6">
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <p class="fw-medium text-muted mb-0">
                                            Wards
                                        </p>
                                        <h2 class="mt-2 text-primary">
                                            {{ $wards }}
                                        </h2>
                                    </div>
                                    <div>
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-info-subtle rounded-circle fs-3">
                                                <i data-feather="activity" class="text-info"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card-->
                    </div>
                    <!-- end col-->
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <p class="fw-medium text-muted mb-0">
                                            PropertyType
                                        </p>
                                        <h2 class="mt-2 text-primary">
                                            {{ $property }}
                                        </h2>

                                    </div>
                                    <div>
                                        <div class="avatar-sm ">
                                            <span class="avatar-title bg-info-subtle rounded-circle fs-3">
                                                <i data-feather="clock" class="text-info"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card-->
                    </div>
                    <!-- end col-->

                    {{-- <div class="col-md-6">
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <p class="fw-medium text-muted mb-0">
                                            Bounce Rate
                                        </p>
                                        <h2 class="mt-4 ff-secondary fw-semibold">
                                            <span class="counter-value" data-target="33.48">0</span>%
                                        </h2>
                                        <p class="mb-0 text-muted">
                                            <span class="badge bg-light text-success mb-0">
                                                <i class="ri-arrow-up-line align-middle"></i>
                                                7.05 %
                                            </span>
                                            vs. previous
                                            month
                                        </p>
                                    </div>
                                    <div>
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-info-subtle rounded-circle fs-2">
                                                <i data-feather="external-link" class="text-info"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card-->
                    </div> --}}
                    <!-- end col-->
                </div>
            </div>
        </div>
    </div>



    @push('scripts')
    @endpush

</x-admin.layout>
