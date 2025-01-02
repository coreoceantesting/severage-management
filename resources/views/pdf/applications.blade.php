<!DOCTYPE html>
<html>
<head>
    <title>Application List</title>
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
    <h1>Application List</h1>
    <table>
        <thead>
            <tr>
                <th>Sr.No</th>
                <th>Application No</th>
                <th>Applicant Name</th>
                <th>Date</th>
                <th>Phone No</th>
                <th>Status</th>
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
                                '1' => 'Approved',
                                '2' => 'Rejected',
                                'default' => 'Pending',
                            ];
                        @endphp
                        {{ $statusMap[$noc->status] ?? $statusMap['default'] }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
