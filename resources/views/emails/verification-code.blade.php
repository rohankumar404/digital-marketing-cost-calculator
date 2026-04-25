<!DOCTYPE html>
<html>
<head>
    <style>
        .body { font-family: 'Inter', sans-serif; background: #f4f4f4; padding: 40px; }
        .card { background: #ffffff; padding: 40px; border-radius: 12px; max-width: 500px; margin: 0 auto; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
        .code { font-size: 32px; font-weight: 800; color: #85f43a; text-align: center; letter-spacing: 5px; margin: 30px 0; background: #272727; padding: 20px; border-radius: 8px; }
        .footer { font-size: 12px; color: #888; text-align: center; margin-top: 30px; }
    </style>
</head>
<body class="body">
    <div class="card">
        <h2 style="color: #272727; text-align: center;">Verify Your Identity</h2>
        <p style="color: #666; font-size: 14px; text-align: center;">Welcome to Mapsily! Use the 6-digit code below to complete your registration. This code will expire in 10 minutes.</p>
        
        <div class="code">{{ $code }}</div>
        
        <p style="color: #666; font-size: 13px; text-align: center;">If you did not request this, please ignore this email.</p>
    </div>
    <div class="footer">
        &copy; {{ date('Y') }} Mapsily Tools. All rights reserved.
    </div>
</body>
</html>
