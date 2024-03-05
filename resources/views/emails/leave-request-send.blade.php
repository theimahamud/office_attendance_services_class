<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leave Request</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f9f9f9;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }
        .header {
            background-color: #007bff;
            color: #ffffff;
            padding: 1px;
            text-align: center;
            border-bottom: 2px solid #0056b3;
        }
        .content {
            padding: 30px;
            text-align: left;
        }
        .content p {
            margin-bottom: 15px;
            line-height: 1.6;
        }
        .button {
            display: inline-block;
            background-color: #007bff;
            color: #ffffff;
            padding: 10px 14px;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h1>Application For Leave</h1>
    </div>
    <div class="content">
        <p>Dear HR,</p>
        @isset($data->name)
            <p>You have received a leave request from <strong>{{ $data->name }}</strong>:</p>
        @endisset
        <ul>
            @isset($data->leave_policy_name)
                <li>Leave Type: <strong>{{ $data->leave_policy_name }}</strong></li>
            @endisset
            @isset($data->start_date)
                <li>From: <strong>{{ $data->start_date }}</strong></li>
            @endisset
            @isset($data->end_date)
                <li>To: <strong>{{ $data->end_date }}</strong></li>
            @endisset
            @isset($data->days)
                <li>Number of Leave: <strong>{{ $data->days }} Days</strong></li>
            @endisset
            @isset($data->referred_by)
                <li>Referred By: <strong>{{ $data->referred_by }}</strong></li>
            @endisset
            @isset($data->leave_reason)
                <li>Leave Reason: <strong>{{ $data->leave_reason }}</strong></li>
            @endisset
        </ul>
        <p>Please review the request and take necessary action.</p>
        @isset($data->view_request_link)
            <a href="{{ $data->view_request_link }}" class="button">View Request</a>
        @endisset
    </div>
</div>
</body>
</html>
