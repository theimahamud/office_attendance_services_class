<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leave Application</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/fontawesome.min.css"
          integrity="sha512-RvQxwf+3zJuNwl4e0sZjQeX7kUa3o82bDETpgVCH2RiwYSZVDdFJ7N/woNigN/ldyOOoKw8584jM4plQdt8bhA=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/brands.min.css">
    <style>
        /* @import url('http://fonts.cdnfonts.com/css/inter'); */
        body {
            display: block;
            margin: 0px;
        }

        .email {
            width: 600px;
            background-color: #F4F4F4;
            padding: 33px 0px;
            margin: auto;
        }

        h2 {
            font-family: 'Inter', sans-serif;
            color: #262D36;
            font-size: 24px;
            font-weight: 500;
            text-align: center;
        }

        h3 {
            font-family: 'Inter', sans-serif;
            color: #15203E;
            font-size: 18px;
            font-weight: 500;
        }

        h6 {
            font-family: 'Inter';
            font-style: normal;
            font-weight: 400;
            font-size: 14px;
            line-height: 25px;
            color: #6A6F7D;
            margin: 0px;
        }

        h5 {
            font-family: 'Inter';
            font-style: normal;
            font-weight: 500;
            font-size: 12px;
            line-height: 25px;
            color: #6A6F7D;
            text-align: center;
            margin: 0px;
        }

        p {
            margin: 0px;
        }

        p {
            font-family: 'Inter';
            font-style: normal;
            font-weight: 400;
            font-size: 16px;
            line-height: 25px;
            color: #6A6F7D;
        }

        a.web-link {
            font-family: 'Inter';
            font-style: normal;
            font-weight: 500;
            font-size: 16px;
            line-height: 25px;
            text-decoration-line: underline;
            color: #2763FE;
        }

        .email-logo {
            text-align: center;
            margin-bottom: 30px;
        }

        .email-contain {
            background-color: #ffff;
            border-radius: 10px;
            margin: 30px;
        }

        .contain-title {
            text-align: center;
            padding-top: 25px;
            font-size: 24px;
            color: #15203E;
            text-transform: uppercase;
        }

        .contain-img {
            text-align: center;
            margin: 24px 0px 45px 0px;
        }

        .contain-img img {
            width: 300px;
            object-fit: cover;
        }

        button.btn-1 {
            background: #2863FF;
            color: #ffff;
            border: none;
            font-family: 'Inter', sans-serif;
            font-size: 14px;
            font-weight: 600;
            line-height: 24px;
            padding: 12px 24px;
            cursor: pointer;
            border-radius: 6px;
        }

        hr.email-hr {
            border: 0.5px solid #E4E4E4;
            margin: 30px 0px 30px 0px;
            background: #E4E4E4;
        }

        .email-button {
            text-align: center;
            margin-top: 40px;
            margin-bottom: 30px;
        }

        .email-footer {
            margin-top: 12px;
        }

       .social-icon li {
            list-style: none;
            display: contents;
        }

        .social-icon {
            text-align: center;
            padding-top: 15px;
        }

        .email-contain h6 {
            margin-top: 30px;
        }

        ul {
            margin: 0;
            padding: 0;
        }

        .email-footer-logo {
            text-align: center;
            margin-top: 25px;
        }

        .social-icon ul li a img {
            height: 27px;
            width: 27px;
            padding: 3px;
        }

        .email-content {

            padding: 0px 35px 65px 35px;
        }
        .leave-info{
            margin-top: 10px;
        }

        .leave-info ul {
            list-style: none;
            padding: 0;
        }

        .leave-info ul li {
            font-family: 'Inter';
            position: relative;
            padding-left: 20px;
            margin-bottom: 10px;
            font-style: normal;
            font-weight: 400;
            font-size: 16px;
            line-height: 25px;
            color: #6A6F7D;
        }

        .leave-info ul li:before {
            content: "";
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background-color: #3498db;
        }

    </style>
</head>

<body>
<section class="email">
    @include('emails.header')

    <div class="email-contain">
        <h2 class="contain-title">Leave Application</h2>
        <div class="contain-img">
            <img src="{{ asset('assets/admin/mail/leave-request.svg') }}" alt="birthday">
        </div>
        <div class="email-content">
            <h3>Dear HR,</h3>
            <p>You have receive a leave request from {{ $data->user->name ?? 'an employee' }}.</p>

            <div class="leave-info">
                <ul>
                    <li>From: {{ isset($data->start_date) ? \Carbon\Carbon::parse($data->start_date)->format('d-m-Y') : 'Unknown' }}</li>
                    <li>To: {{ isset($data->end_date) ? \Carbon\Carbon::parse($data->end_date)->format('d-m-Y') : 'Unknown' }}</li>
                    <li>Number of Leave: {{ isset($data->days) ? $data->days . ' Days' : 'Unknown' }}</li>
                    <li>Referred By: {{ isset($data->referredBy->name) ? $data->referredBy->name : 'Unknown' }}</li>
                    <li>Leave Type: {{ isset($data->leavePolicy->title) ? $data->leavePolicy->title : 'Unknown' }}</li>
                </ul>
            </div>

            <p><span>Leave Reason: </span><span>{{ isset($data->leave_reason) ? $data->leave_reason : 'No reason provided No reason provided No reason provided No reason provided' }}</span></p>

            <hr class="email-hr">
            <p>
                If you have any questions, just reply to this email or live chat
                with <a href="#">24/7 support team</a> - We’re always happy to help out.
            </p>
            <h6>- The Uibarn Team</h6>
        </div>
    </div>

    @include('emails.footer')
</section>
</body>

</html>
