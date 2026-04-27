<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Strategy Request Captured</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            background-color: #111;
            color: #fff;
            margin: 0;
            padding: 0;
        }

        .wrapper {
            width: 100%;
            table-layout: fixed;
            background-color: #000;
            padding: 40px 0;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #1a1a1a;
            border-radius: 24px;
            overflow: hidden;
            border: 1px solid #333;
        }

        .header {
            background-color: #111;
            padding: 40px;
            text-align: center;
            border-bottom: 1px solid #333;
        }

        .logo {
            width: 150px;
            margin-bottom: 5px;
        }

        .content {
            padding: 40px;
        }

        .title {
            font-size: 24px;
            font-weight: 800;
            color: #85f43a;
            margin-bottom: 30px;
            text-align: center;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .lead-card {
            background-color: #222;
            border-radius: 16px;
            border: 1px solid #444;
            overflow: hidden;
        }

        .lead-row {
            padding: 15px 20px;
            border-bottom: 1px solid #333;
            display: flex;
            align-items: center;
        }

        .lead-row:last-child {
            border-bottom: none;
        }

        .lead-label {
            width: 120px;
            font-size: 11px;
            font-weight: 800;
            color: #666;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .lead-value {
            flex: 1;
            font-size: 14px;
            font-weight: 600;
            color: #eee;
        }

        .footer {
            padding: 40px;
            text-align: center;
            font-size: 12px;
            color: #555;
            background-color: #111;
            border-top: 1px solid #333;
        }

        .footer a {
            color: #85f43a;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="container">
            <div class="header">
                <img src="https://mapsily.com/wp-content/uploads/2026/04/Mapsily-wihte-logo.png" alt="Mapsily"
                    class="logo">
            </div>

            <div class="content">
                <h1 class="title">New Strategy Request</h1>

                <div class="lead-card">
                    <div class="lead-row">
                        <div class="lead-label">Strategy For:</div>
                        <div class="lead-value">{{ $data['name'] }}</div>
                    </div>
                    <div class="lead-row">
                        <div class="lead-label">Email:</div>
                        <div class="lead-value">{{ $data['email'] }}</div>
                    </div>
                    <div class="lead-row">
                        <div class="lead-label">Phone:</div>
                        <div class="lead-value">{{ $data['phone'] }}</div>
                    </div>
                    <div class="lead-row">
                        <div class="lead-label">Company:</div>
                        <div class="lead-value">{{ $data['company'] ?? 'N/A' }}</div>
                    </div>
                    <div class="lead-row" style="flex-direction: column; align-items: flex-start; gap: 10px;">
                        <div class="lead-label">Requirement Brief:</div>
                        <div class="lead-value" style="line-height: 1.6; color: #aaa;">
                            {{ $data['message'] ?? 'No message provided.' }}</div>
                    </div>
                </div>
            </div>

            <div class="footer">
                <p>&copy; {{ date('Y') }} Mapsily. Sent from Digital Marketing Cost Calculator.</p>
                <p><a href="https://mapsily.com">Go to Command Center</a></p>
            </div>
        </div>
    </div>
</body>

</html>