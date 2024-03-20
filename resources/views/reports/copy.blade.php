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
                    <td>Rubel Mahamud</td>
                </tr>
                <tr>
                    <td><strong>Month</strong></td>
                    <td>:</td>
                    <td>January</td>
                </tr>
                <tr>
                    <td><strong>Year</strong></td>
                    <td>:</td>
                    <td>2024</td>
                </tr>
                <tr>
                    <td><strong>Company</strong></td>
                    <td>:</td>
                    <td>Uibarn Ltd</td>
                </tr>
                <tr>
                    <td><strong>Date</strong></td>
                    <td>:</td>
                    <td><span id="currentDate"></span></td>
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
                        <tr>
                            <td>1</td>
                            <td>20-03-2024</td>
                            <td>10:20 AM</td>
                            <td>10:20 PM</td>
                            <td>Present</td>
                            <td>12 h 30 m</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>20-03-2024</td>
                            <td>10:20 AM</td>
                            <td>10:20 PM</td>
                            <td>Present</td>
                            <td>12 h 30 m</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>20-03-2024</td>
                            <td>10:20 AM</td>
                            <td>10:20 PM</td>
                            <td>Present</td>
                            <td>12 h 30 m</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>20-03-2024</td>
                            <td>10:20 AM</td>
                            <td>10:20 PM</td>
                            <td>Present</td>
                            <td>12 h 30 m</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>20-03-2024</td>
                            <td>10:20 AM</td>
                            <td>10:20 PM</td>
                            <td>Present</td>
                            <td>12 h 30 m</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>20-03-2024</td>
                            <td>10:20 AM</td>
                            <td>10:20 PM</td>
                            <td>Present</td>
                            <td>12 h 30 m</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>20-03-2024</td>
                            <td>10:20 AM</td>
                            <td>10:20 PM</td>
                            <td>Present</td>
                            <td>12 h 30 m</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>20-03-2024</td>
                            <td>10:20 AM</td>
                            <td>10:20 PM</td>
                            <td>Present</td>
                            <td>12 h 30 m</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>20-03-2024</td>
                            <td>10:20 AM</td>
                            <td>10:20 PM</td>
                            <td>Present</td>
                            <td>12 h 30 m</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>20-03-2024</td>
                            <td>10:20 AM</td>
                            <td>10:20 PM</td>
                            <td>Present</td>
                            <td>12 h 30 m</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>20-03-2024</td>
                            <td>10:20 AM</td>
                            <td>10:20 PM</td>
                            <td>Present</td>
                            <td>12 h 30 m</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>20-03-2024</td>
                            <td>10:20 AM</td>
                            <td>10:20 PM</td>
                            <td>Present</td>
                            <td>12 h 30 m</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</body>
<script>
    // JavaScript to get and display the current date in "Y-m-d" format
    const currentDateElement = document.getElementById('currentDate');
    const currentDate = new Date();
    const year = currentDate.getFullYear();
    const month = String(currentDate.getMonth() + 1).padStart(2, '0');
    const day = String(currentDate.getDate()).padStart(2, '0');
    const formattedDate = `${day}-${month}-${year}`;
    currentDateElement.textContent = formattedDate;
</script>
</html>
