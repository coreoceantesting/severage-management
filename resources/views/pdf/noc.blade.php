<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NOC Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .table th, .table td {
            padding: 8px;
            border: 1px solid #ddd;
        }
        .table th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>NOC Details</h1>
    <p><strong>Applicant Name:</strong> {{ $nocData->applicant_name }}</p>
    <p><strong>Property Type:</strong> {{ $nocData->property_type}}</p>
    <p><strong>Date:</strong> {{ $nocData->date }}</p>

    <p><strong>Address of Applicant:</strong> {{ $nocData->address_of_applicant }}</p>
    <p><strong>Address of Property:</strong> {{ $nocData->address_of_property }}</p>

    <p><strong>Phone Number:</strong>{{ $nocData->phone_no }}</p>
    <p><strong>Addhar No:</strong>{{ $nocData->addhar_no }}</p>

    {{-- <h2>Document Details</h2>
    @foreach ($noc_documents as $document)
    <p>
        <strong>{{ $document->document_name ?? 'No document name' }}</strong>:
        <a href="{{ asset('storage/app/' . $document->file_path) }}" target="_blank">View</a>
    </p>
@endforeach --}}

    <h2>Status Details</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Role</th>
                <th>Status</th>
                <th>Remark</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Clerk</td>
                <td>{{ $nocData->clerk_status == 1 ? 'Approved' : 'Pending' }}</td>
                <td>{{ $nocData->clerk_remark ?? 'No remarks' }}</td>
            </tr>
            <tr>
                <td>Junior Engineer</td>
                <td>{{ $nocData->jr_eng_status == 1 ? 'Approved' : 'Pending' }}</td>
                <td>{{ $nocData->jr_eng_remark ?? 'No remarks' }}</td>
            </tr>
            <tr>
                <td>Senior Engineer</td>
                <td>{{ $nocData->sr_eng_status == 1 ? 'Approved' : 'Pending' }}</td>
                <td>{{ $nocData->sr_eng_remark ?? 'No remarks' }}</td>
            </tr>
            <tr>
                <td>HOD</td>
                <td>{{ $nocData->hod_status == 1 ? 'Approved' : 'Pending' }}</td>
                <td>{{ $nocData->hod_remark ?? 'No remarks' }}</td>
            </tr>
            <tr>
                <td>City Engineer</td>
                <td>{{ $nocData->city_eng_status == 1 ? 'Approved' : 'Pending' }}</td>
                <td>{{ $nocData->city_eng_remark ?? 'No remarks' }}</td>
            </tr>
            <!-- Add other statuses as needed -->
        </tbody>
    </table>


</body>
</html>
