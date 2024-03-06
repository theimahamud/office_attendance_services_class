<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ isset($data->title) ? $data->title : 'Notice For All' }}</title>
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
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h1>{{ isset($data->title) ? $data->title : 'Notice For All' }}</h1>
    </div>
    <div class="content">
        <p>Dear All,</p>
        <p>{{ isset($data->description) ? $data->description : '' }}</p>
        <p>Sincerely,</p>
        <p>Uibarn Ltd</p>
    </div>
</div>
</body>
</html>
