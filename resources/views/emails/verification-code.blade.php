<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mapsily Verification - Action Required</title>
    <style>
        body { font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; background-color: #111; color: #fff; margin: 0; padding: 0; }
        .wrapper { width: 100%; table-layout: fixed; background-color: #000; padding: 40px 0; }
        .container { max-width: 600px; margin: 0 auto; background-color: #1a1a1a; border-radius: 24px; overflow: hidden; border: 1px solid #333; }
        .header { background-color: #111; padding: 40px; text-align: center; border-bottom: 1px solid #333; }
        .logo { width: 150px; margin-bottom: 20px; }
        .content { padding: 40px; text-align: center; }
        .title { font-size: 28px; font-weight: 800; color: #fff; margin-bottom: 20px; letter-spacing: -0.02em; }
        .subtitle { font-size: 16px; color: #888; margin-bottom: 40px; line-height: 1.6; }
        .otp-container { background-color: rgba(133, 244, 58, 0.1); border: 2px solid #85f43a; border-radius: 16px; padding: 30px; margin-bottom: 40px; display: inline-block; width: 80%; }
        .otp-code { font-size: 48px; font-weight: 900; color: #85f43a; letter-spacing: 12px; margin: 0; font-family: monospace; }
        .cta-btn { display: inline-block; background-color: #85f43a; color: #000; padding: 18px 45px; border-radius: 12px; font-weight: 800; font-size: 16px; text-decoration: none; text-transform: uppercase; letter-spacing: 1px; transition: 0.3s; }
        .footer { padding: 40px; text-align: center; font-size: 12px; color: #555; background-color: #111; border-top: 1px solid #333; }
        .footer a { color: #85f43a; text-decoration: none; }
        .social { margin-top: 20px; }
        .social img { width: 24px; margin: 0 10px; opacity: 0.5; }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container">
            <div class="header">
                <img src="https://mapsily.com/wp-content/uploads/2024/01/mapsily-logo-white.png" alt="Mapsily" class="logo">
            </div>
            
            <div class="content">
                <h1 class="title">Verify Your Account</h1>
                <p class="subtitle">Secure your access to the Mapsily Digital Marketing Calculator. Use the cryptographically generated code below to finalize your registration.</p>
                
                <div class="otp-container">
                    <p class="otp-code">{{ $code }}</p>
                </div>
                
                <p style="color: #666; font-size: 14px; margin-bottom: 20px;">This code will expire in 10 minutes. If you did not request this, please ignore this email.</p>
                
                <a href="{{ url('/') }}" class="cta-btn">Finalize Verification</a>
            </div>
            
            <div class="footer">
                <p>&copy; {{ date('Y') }} Mapsily. All rights reserved.</p>
                <p>High-Performance Digital Growth Solutions.</p>
                <p><a href="https://mapsily.com">Visit Website</a> | <a href="mailto:support@mapsily.com">Support</a></p>
                
                <div class="social">
                    {{-- Social links could go here --}}
                </div>
            </div>
        </div>
    </div>
</body>
</html>
