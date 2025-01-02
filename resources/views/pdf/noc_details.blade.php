{{-- <!DOCTYPE html>
<html>
<head>
    <title>NOC Details</title>
    <style>
        /* Add your custom styles here */
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>NOC Details</h1>
    <div>
        <strong>Applicant Name:</strong> {{ $nocData->applicant_name }}<br>
        <strong>Date:</strong> {{ \Carbon\Carbon::parse($nocData->date)->format('d-m-Y') }}<br>
        <strong>Property Type:</strong> {{ $propertyTypes->where('id', $nocData->property_type)->first()->property_type_name ?? 'N/A' }}<br>
        <strong>Address of Applicant:</strong> {{ $nocData->address_of_applicant }}<br>
        <strong>Address of Property:</strong> {{ $nocData->address_of_property }}<br>
        <strong>Phone Number:</strong> {{ $nocData->phone_no }}<br>
        <strong>Aadhaar No:</strong> {{ $nocData->addhar_no }}<br>
        <strong>Document:</strong> <a href="{{ asset('storage/app/'.$nocData->file_path) }}" target="_blank">View Document</a><br>
    </div>

    <h2>NOC Status Details</h2>
    <table>
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
                        <b>Approved by clerk</b>
                    @elseif($nocData->clerk_status == 2)
                        <b>Rejected by clerk</b>
                    @else
                        Status not available
                    @endif
                </td>
                <td>{{ $nocData->clerk_remark ?? 'No remarks available' }}</td>
            </tr>
            <tr>
                <td>2</td>
                <td>Junior Engineer</td>
                <td>
                    @if($noc Data->jr_eng_status == 0)
                        <b>Pending by Junior Engineer</b>
                    @elseif($nocData->jr_eng_status == 1)
                        <b>Approved by Junior Engineer</b>
                    @elseif($nocData->jr_eng_status == 2)
                        <b>Rejected by Junior Engineer</b>
                    @else
                        Status not available
                    @endif
                </td>
                <td>{{ $nocData->jr_eng_remark ?? 'No remarks available' }}</td>
            </tr>
            <tr>
                <td>3</td>
                <td>Senior Engineer</td>
                <td>
                    @if($nocData->sr_eng_status == 0)
                        <b>Pending by Senior Engineer</b>
                    @elseif($nocData->sr_eng_status == 1)
                        <b>Approved by Senior Engineer</b>
                    @elseif($nocData->sr_eng_status == 2)
                        <b>Rejected by Senior Engineer</b>
                    @else
                        Status not available
                    @endif
                </td>
                <td>{{ $nocData->sr_eng_remark ?? 'No remarks available' }}</td>
            </tr>
            <tr>
                <td>4</td>
                <td>HOD</td>
                <td>
                    @if($nocData->hod_status == 0)
                        <b>Pending by HOD</b>
                    @elseif($nocData->hod_status == 1)
                        <b>Approved by HOD</b>
                    @elseif($nocData->hod_status == 2)
                        <b>Rejected by HOD</b>
                    @else
                        Status not available
                    @endif
                </td>
                <td>{{ $nocData->hod_remark ?? 'No remarks available' }}</td>
            </tr>
            <tr>
                <td>5</td>
                <td>City Engineer</td>
                <td>
                    @if($nocData->city_eng_status == 0)
                        <b>Pending by City Engineer</b>
                    @elseif($nocData->city_eng_status == 1)
                        <b>Approved by City Engineer</b>
                    @elseif($nocData->city_eng_status == 2)
                        <b>Rejected by City Engineer</b>
                    @else
                        Status not available
                    @endif
                </td>
                <td>{{ $nocData->city_eng_remark ?? 'No remarks available' }}</td>
            </tr>
        </tbody>
    </table>
</body>
</html> --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NOC Details PDF</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>

    <h2>NOC Details</h2>
    <p><strong>Applicant Name:</strong> {{ $nocData->applicant_name }}</p>
    <p><strong>Date:</strong> {{ $nocData->date }}</p>
    <p><strong>Property Type:</strong> {{ $nocData->property_type}}</p>
    <p><strong>Address of Applicant:</strong> {{ $nocData->address_of_applicant }}</p>
    <p><strong>Address of Property:</strong> {{ $nocData->address_of_property }}</p>
    <p><strong>Phone Number:</strong> {{ $nocData->phone_no }}</p>
    <p><strong>Aadhar No:</strong> {{ $nocData->addhar_no }}</p>

    <h3>NOC Status Details</h3>
    <table>
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
                        <b>Approved by clerk</b>
                    @elseif($nocData->clerk_status == 2)
                        <b>Rejected by clerk</b>
                    @else
                        Status not available
                    @endif
                </td>
                <td>{{ $nocData->clerk_remark ?? 'No remarks available' }}</td>
            </tr>
            <tr>
                <td>2</td>
                <td>Junior Engineer</td>
                <td>
                    @if($nocData->jr_eng_status == 0)
                        <b>Pending by Junior Engineer</b>
                    @elseif($nocData->jr_eng_status == 1)
                        <b>Approved by Junior Engineer</b>
                    @elseif($nocData->jr_eng_status == 2)
                        <b>Rejected by Junior Engineer</b>
                    @else
                        Status not available
                    @endif
                </td>
                <td>{{ $nocData->jr_eng_remark ?? 'No remarks available' }}</td>
            </tr>
            <tr>
                <td>3</td>
                <td>Senior Engineer</td>
                <td>
                    @if($nocData->sr_eng_status == 0)
                        <b>Pending by Senior Engineer</b>
                    @elseif($nocData->sr_eng_status == 1)
                        <b>Approved by Senior Engineer</b>
                    @elseif($nocData->sr_eng_status == 2)
                        <b>Rejected by Senior Engineer</b>
                    @else
                        Status not available
                    @endif
                </td>
                <td>{{ $nocData->sr_eng_remark ?? 'No remarks available' }}</td>
            </tr>
            <tr>
                <td>4</td>
                <td>HOD</td>
                <td>
                    @if($nocData->hod_status == 0)
                        <b>Pending by HOD</b>
                    @elseif($nocData->hod_status == 1)
                        <b>Approved by HOD</b>
                    @elseif($nocData->hod_status == 2)
                        <b>Rejected by HOD</b>
                    @else
                        Status not available
                    @endif
                </td>
                <td>{{ $nocData->hod_remark ?? 'No remarks available' }}</td>
            </tr>
            <tr>
                <td>5</td>
                <td>City Engineer</td>
                <td>
                    @if($nocData->city_eng_status == 0)
                        <b>Pending by City Engineer</b>
                    @elseif($nocData->city_eng_status == 1)
                        <b>Approved by City Engineer</b>
                    @elseif($nocData->city_eng_status == 2)
                        <b>Rejected by City Engineer</b>
                    @else
                        Status not available
                    @endif
                </td>
                <td>{{ $nocData->city_eng_remark ?? 'No remarks available' }}</td>
            </tr>
        </tbody>
    </table>

</body>
</html>
