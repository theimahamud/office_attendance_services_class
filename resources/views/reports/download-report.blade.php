<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 30px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }
        .card-body {
            padding: 0;
        }

        .card-header{
            text-align: center;
            font-size: 25px;
            font-weight: 700;
            margin-bottom: 5px;
        }
        .user-info-table {
            /*width: 100%;*/
            margin-bottom: 20px;
            border-collapse: collapse;
        }
        .user-info-table th,
        .user-info-table td {
            padding: 8px;
            /*border-bottom: 1px solid #ddd;*/
            text-align: left;
        }
        .user-info-table th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        .attendance-table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #ddd;
        }
        .attendance-table th,
        .attendance-table td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }
        .attendance-table th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        .status-Absent {
            color: red;
        }
        .status-Present {
            color: green;
        }
        .status-Weekend {
            color: blue;
        }
        .status-Holiday {
            color: orange;
        }
        .status-Leave {
            color: purple;
        }

        @media print {
            body {
                width: 210mm; /* A4 width */
                height: 297mm; /* A4 height */
                margin: 0; /* Reset default browser margin */
                padding: 0; /* Reset default browser padding */
            }

            .container {
                width: 100%; /* Full width */
                max-width: 100%; /* Ensure content fits within A4 width */
                margin: 0 auto; /* Center content horizontally */
                padding: 0; /* Reset padding */
            }

            .card {
                page-break-inside: avoid; /* Avoid splitting card across pages */
            }

            .card-body {
                padding: 0; /* Reset padding */
            }

            .attendance-table {
                width: 100%; /* Full width */
                max-width: 100%; /* Ensure table fits within container */
                border-collapse: collapse; /* Collapse table borders */
                margin-top: 10px; /* Add margin between tables */
            }

            .attendance-table th,
            .attendance-table td {
                padding: 8px; /* Adjust padding */
            }

            .status-Absent,
            .status-Present,
            .status-Weekend,
            .status-Holiday,
            .status-Leave {
                /* Adjust status colors for better visibility on print */
                color: black;
            }

            /* Optionally, you can hide certain elements from printing */
            /* For example, you may not want to print the header or some other elements */
            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body>
<div class="container">
    <div class="card">
        <div class="card-header">Monthly Attendance Report</div>
        <div class="card-body">
            <table class="user-info-table">
                <tr>
                    <td><strong>Name</strong></td>
                    <td>:</td>
                    <td>{{ $user->name }}</td>
                </tr>
                <tr>
                    <td><strong>Month</strong></td>
                    <td>:</td>
                    <td>{{ date("F", mktime(0, 0, 0, $month, 1)) }}</td>
                </tr>
                <tr>
                    <td><strong>Year</strong></td>
                    <td>:</td>
                    <td>{{ $year }}</td>
                </tr>
                <tr>
                    <td><strong>Company</strong></td>
                    <td>:</td>
                    <td>{{ $company_name }}</td>
                </tr>
                <tr>
                    <td><strong>Date</strong></td>
                    <td>:</td>
                    <td>{{ date('d-m-Y') }}</td>
                </tr>
            </table>
            <div class="table-responsive">
                <table class="attendance-table">
                    <thead>
                    <tr>
                        <th>SL</th>
                        <th>Date</th>
                        <th>Check-in Time</th>
                        <th>Check-out Time</th>
                        <th>Status</th>
                        <th>Work Hour</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($attendance_report as $key => $attendance)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $attendance->check_in_out_date }}</td>
                            <td>{{ isset($attendance->check_in) ? date('h:i A', strtotime($attendance->check_in)) : 'Null' }}</td>
                            <td>{{ isset($attendance->check_out) ? date('h:i A', strtotime($attendance->check_out)) : 'Null' }}</td>
                            <td class="status-{{ $attendance->status }}">{{ $attendance->status }}</td>
                            <td>
                                @if(isset($attendance->check_in) && isset($attendance->check_out))
                                    {{ \Carbon\Carbon::parse($attendance->check_in)->diff(\Carbon\Carbon::parse($attendance->check_out))->format('%Hh %Im') }}
                                @else
                                    Null
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</body>
</html>
