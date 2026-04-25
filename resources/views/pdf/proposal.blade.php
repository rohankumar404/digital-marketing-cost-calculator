<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Marketing Proposal - {{ $calculation->business_type }}</title>
    <style>
        body { font-family: 'Helvetica', sans-serif; color: #333; line-height: 1.5; font-size: 13px; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 2px solid #85f43a; padding-bottom: 10px; }
        .header h1 { color: #272727; margin: 0; }
        .section { margin-bottom: 30px; }
        .section-title { font-size: 18px; font-weight: bold; color: #47A805; margin-bottom: 10px; border-left: 4px solid #85f43a; padding-left: 10px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th { background-color: #f8f8f8; text-align: left; padding: 10px; border: 1px solid #ddd; }
        td { padding: 10px; border: 1px solid #ddd; }
        .total-row { font-weight: bold; background-color: #e9fbe0; }
        .footer { margin-top: 50px; font-size: 12px; text-align: center; color: #777; }
        .strategy-box { background-color: #f0fdf4; border: 1px solid #dcfce7; padding: 15px; border-radius: 5px; }
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ public_path('assets/img/mapsily-logo.png') }}" alt="Mapsily Logo" style="height: 40px; margin-bottom: 15px;">
        <h1>Digital Marketing Proposal</h1>
        <p>Prepared for: {{ $calculation->industry }} | {{ $calculation->business_type }}</p>
    </div>

    <div class="section">
        <div class="section-title">Business Overview</div>
        <table>
            <tr><td><strong>Industry:</strong></td><td>{{ $calculation->industry }}</td></tr>
            <tr><td><strong>Target Location:</strong></td><td>{{ $calculation->target_location }}</td></tr>
            <tr><td><strong>Growth Stage:</strong></td><td>{{ $calculation->growth_stage }}</td></tr>
            @if($calculation->monthly_revenue)
            <tr><td><strong>Current Revenue:</strong></td><td>{{ $formatCurrency($calculation->monthly_revenue) }} /mo</td></tr>
            @endif
        </table>
    </div>

    <div class="section">
        <div class="section-title">Recommended Strategy Allocation</div>
        <div class="strategy-box">
            <p>{{ $calculation->strategy_suggestion ?: 'Focus on a balanced approach across paid and organic channels.' }}</p>
        </div>
    </div>

    <div class="section">
        <div class="section-title">Investment Breakdown</div>
        <table>
            <thead>
                <tr>
                    <th>Service Channel</th>
                    <th>Estimated Monthly Investment</th>
                </tr>
            </thead>
            <tbody>
                @foreach($calculation->services as $service)
                <tr>
                    <td>{{ $service->service_name }}</td>
                    <td>{{ $formatCurrency($service->estimated_cost) }}</td>
                </tr>
                @endforeach
                <tr class="total-row">
                    <td><strong>Total Estimated Investment</strong></td>
                    <td><strong>{{ $formatCurrency($calculation->total_cost) }} /mo</strong></td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="section">
        <div class="section-title">ROI & Budget Expectations</div>
        <p><strong>Projected ROI Range:</strong> {{ $calculation->roi_range ?: 'N/A' }}</p>
        <p><strong>Recommended Monthly Budget:</strong> {{ $calculation->budget_recommendation ?: 'Standard buffers apply.' }}</p>
    </div>

    <div class="footer">
        <p>This is an automated estimate provided by Mapsily Digital Marketing Calculator.</p>
        <p>&copy; {{ date('Y') }} Mapsily Tools. All rights reserved.</p>
    </div>
</body>
</html>
