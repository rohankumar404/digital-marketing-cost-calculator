<!DOCTYPE html>
<html>
<head>
    <style>
        .body { font-family: sans-serif; padding: 20px; color: #333; }
        .table { width: 100%; border-collapse: collapse; }
        .table td { padding: 10px; border-bottom: 1px solid #eee; }
        .label { font-weight: bold; color: #666; width: 150px; }
    </style>
</head>
<body>
    <h2>New Lead Details</h2>
    <p>A user has requested a better solution through the Mapsily Tools CTA.</p>
    
    <table class="table">
        <tr><td class="label">Name:</td><td>{{ $data['name'] }}</td></tr>
        <tr><td class="label">Email:</td><td>{{ $data['email'] }}</td></tr>
        <tr><td class="label">Phone:</td><td>{{ $data['phone'] }}</td></tr>
        <tr><td class="label">Company:</td><td>{{ $data['company'] ?? 'N/A' }}</td></tr>
        <tr><td class="label">Message:</td><td>{{ $data['message'] ?? 'N/A' }}</td></tr>
    </table>

    <p style="margin-top: 30px; font-size: 12px; color: #999;">Sent from Mapsily Cost Calculator</p>
</body>
</html>
