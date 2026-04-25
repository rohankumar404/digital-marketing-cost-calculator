@extends('layouts.app')

@section('title', 'Marketing Strategy Dashboard – Results')

@section('content')
<style>
    .results-page {
        min-height: 100vh;
        background-color: #272727;
        color: #ffffff;
        padding: 40px 20px;
        font-family: 'Inter', sans-serif;
    }
    .container {
        max-width: 1100px;
        margin: 0 auto;
    }
    .header {
        text-align: center;
        margin-bottom: 50px;
    }
    .header h1 {
        font-size: 32px;
        font-weight: 700;
        margin-bottom: 10px;
    }
    .header p {
        color: #aaa;
        font-size: 16px;
    }

    /* Dashboard Grid */
    .dashboard-grid {
        display: grid;
        grid-template-columns: 1.5fr 1fr;
        gap: 30px;
        position: relative;
    }
    @media (max-width: 992px) {
        .dashboard-grid { grid-template-columns: 1fr; }
    }

    /* Cards */
    .card {
        background: #333;
        border-radius: 20px;
        padding: 30px;
        border: 1px solid #444;
        box-shadow: 0 10px 30px rgba(0,0,0,0.3);
        margin-bottom: 20px;
    }
    .highlight-card {
        background: linear-gradient(135deg, #333 0%, #2a2a2a 100%);
        border-left: 5px solid #85f43a;
        text-align: center;
    }

    .label {
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: #85f43a;
        margin-bottom: 10px;
        font-weight: 600;
    }
    .big-number {
        font-size: 56px;
        font-weight: 800;
        color: #85f43a;
        margin: 10px 0;
    }
    .sub-value {
        color: #666;
        font-size: 14px;
    }

    /* Breakdown & Metrics */
    .metric-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
        margin-top: 30px;
    }
    .metric-box {
        background: #3a3a3a;
        padding: 20px;
        border-radius: 15px;
        text-align: center;
    }
    .metric-val {
        font-size: 24px;
        font-weight: 700;
        color: #ffffff;
        display: block;
        margin-top: 5px;
    }
    .breakdown-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 15px 0;
        border-bottom: 1px solid #444;
    }
    .breakdown-item:last-child { border-bottom: none; }
    .svc-cost { font-weight: 700; color: #85f43a; font-size: 18px; }

    /* Feature Gating */
    .gated-content {
        position: relative;
    }
    .gate-overlay {
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        z-index: 10;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 40px;
        text-align: center;
    }
    .gate-card {
        background: #222;
        border: 2px solid #85f43a;
        max-width: 450px;
        padding: 40px;
        box-shadow: 0 20px 50px rgba(0,0,0,0.6);
    }
    .blur-section {
        filter: blur(8px);
        pointer-events: none;
        user-select: none;
        opacity: 0.4;
    }

    /* Chart */
    .chart-container { height: 300px; margin-top: 20px; }

    /* Buttons */
    .btn-wrap { display: flex; gap: 15px; justify-content: center; margin-top: 10px; }
    .btn {
        padding: 12px 25px; border-radius: 12px; font-weight: 600;
        cursor: pointer; text-decoration: none; transition: 0.3s; border: none;
    }
    .btn-primary { background: #85f43a; color: #272727; }
    .btn-ghost { background: transparent; color: #fff; border: 1px solid #444; }
</style>

<div class="results-page">
    <div class="container">
        <div class="header">
            <h1>Strategy Breakdown</h1>
            <p>Based on your business profile for <strong>{{ $calculation->industry }}</strong></p>
        </div>

        <div class="dashboard-grid">
            
            {{-- Main Column --}}
            <div class="main-col" x-data="{ simBudget: {{ $calculation->total_cost }}, cpl: {{ $calculation->industry == 'SaaS' ? 45 : ($calculation->industry == 'Lead Gen' ? 25 : 35) }} }">
                
                {{-- Total Cost Card (Always Visible) --}}
                <div class="card highlight-card">
                    <div class="label">Total Monthly Investment</div>
                    <div class="big-number" x-text="$store.mapsily.format({{ $calculation->total_cost }})">${{ number_format($calculation->total_cost) }}</div>
                    <div class="sub-value">Estimated management & ad spend combined</div>
                    
                    @if(!$isGuest && !$isOverLimit && $calculation->strategy_suggestion)
                    <div style="margin-top:20px; padding:15px; background:rgba(133,244,58,0.05); border-radius:10px; border:1px solid rgba(133,244,58,0.1)">
                        <div class="label" style="margin-bottom:5px; font-size:12px">Strategy Insight</div>
                        <p style="font-size:14px; text-align:left; color:#ddd">{{ $calculation->strategy_suggestion }}</p>
                    </div>
                    @endif

                    <div class="metric-row">
                        <div class="metric-box">
                            <span class="label" style="color:#aaa">ROI Expectation</span>
                            <span class="metric-val" style="color:#85f43a">{{ $calculation->roi_range ?: 'N/A' }}</span>
                        </div>
                        <div class="metric-box">
                            <span class="label" style="color:#aaa">Budget Rec.</span>
                            <span class="metric-val" x-text="$store.mapsily.format({{ $calculation->total_cost * 0.9 }}) + ' - ' + $store.mapsily.format({{ $calculation->total_cost * 1.2 }})">
                                {{ '$'.number_format($calculation->total_cost*0.9).' - $'.number_format($calculation->total_cost*1.2) }}
                            </span>
                        </div>
                    </div>
                </div>

                {{-- Gated Content Section --}}
                <div class="gated-content">
                    @if($isGuest || $isOverLimit)
                    <div class="gate-overlay">
                        <div class="card gate-card">
                            @if($isGuest)
                                <h2 style="margin-bottom:15px">Unlock Advanced Features</h2>
                                <p style="color:#aaa; margin-bottom:25px; line-height:1.5">Sign in to view the service-wise breakdown, interactive budget simulator, and detailed marketing channel strategy.</p>
                                <a href="/register" class="btn btn-primary" style="display:inline-block">Join Free to Unlock →</a>
                                <p style="margin-top:15px; font-size:12px"><a href="/login" style="color:#85f43a; text-decoration:none">Already have an account? Log in</a></p>
                            @else
                                <h2 style="margin-bottom:15px">Usage Limit Reached</h2>
                                <p style="color:#aaa; margin-bottom:25px; line-height:1.5">You've reached your limit of 3 free calculations. Upgrade to PRO for unlimited reports and deep-dive strategy audits.</p>
                                <a href="/upgrade" class="btn btn-primary" style="display:inline-block">Upgrade to PRO ✦</a>
                            @endif
                        </div>
                    </div>
                    @endif

                    <div class="{{ $isGuest || $isOverLimit ? 'blur-section' : '' }}">
                        {{-- Budget Simulator --}}
                        <div class="card">
                            <h3 style="margin-bottom:15px">Budget Simulator</h3>
                            <div class="form-group" style="margin-bottom:25px">
                                <div style="display:flex; justify-content:space-between; margin-bottom:10px">
                                    <span style="font-weight:600">Simulated Monthly Budget</span>
                                    <span style="color:#85f43a; font-weight:800; font-size:18px" x-text="$store.mapsily.format(simBudget)"></span>
                                </div>
                                <input type="range" min="{{ round($calculation->total_cost * 0.5) }}" max="{{ round($calculation->total_cost * 3) }}" step="100" x-model="simBudget" style="width:100%; accent-color:#85f43a; cursor:pointer">
                            </div>
                            <div class="metric-row">
                                <div class="metric-box" style="background:#2a2a2a">
                                    <span class="label" style="font-size:10px">Est. Monthly Leads</span>
                                    <span class="metric-val" style="color:#85f43a; font-size:32px" x-text="Math.round(simBudget / cpl)"></span>
                                </div>
                                <div class="metric-box" style="background:#2a2a2a">
                                    <span class="label" style="font-size:10px">Est. Web Traffic</span>
                                    <span class="metric-val" style="color:#ffffff; font-size:32px" x-text="Math.round(simBudget / (cpl * 0.05)).toLocaleString()"></span>
                                </div>
                            </div>
                        </div>

                        {{-- Breakdown --}}
                        <div class="card">
                            <h3 style="margin-bottom:20px">Service-wise Breakdown</h3>
                            @foreach($calculation->services as $service)
                            <div class="breakdown-item">
                                <span style="font-weight:500">{{ $service->service_name }}</span>
                                <span class="svc-cost" x-text="$store.mapsily.format({{ $service->estimated_cost }}) + ' /mo'"></span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div> {{-- /.gated-content --}}
            </div> {{-- /.main-col --}}

            {{-- Sidebar Column --}}
            <div class="side-col">
                <div class="card {{ $isGuest || $isOverLimit ? 'blur-section' : '' }}">
                    <h3 style="text-align:center; margin-bottom:10px">Allocation</h3>
                    <div class="chart-container">
                        <canvas id="costChart"></canvas>
                    </div>
                    <p style="font-size:12px; color:#666; margin-top:20px; text-align:center">Budget weight by channel.</p>
                </div>

                <div class="btn-wrap" x-data="{ showEmailModal: false, email: '' }">
                    <a href="{{ route('calculator') }}" class="btn btn-ghost">New Estimate</a>
                    
                    @if($isGuest)
                        <button class="btn btn-primary" @click="showEmailModal = true">Download PDF</button>

                        {{-- Email Modal --}}
                        <div x-show="showEmailModal" 
                             class="gate-overlay" 
                             style="position:fixed; background:rgba(0,0,0,0.8); z-index:100; transition: 0.3s"
                             x-cloak>
                            <div class="card gate-card" @click.away="showEmailModal = false">
                                <h3 style="margin-bottom:10px">Where should we send it?</h3>
                                <p style="font-size:14px; color:#aaa; margin-bottom:20px">Enter your email to download your customized strategy report.</p>
                                
                                <form action="{{ route('proposals.store', $calculation->id) }}" method="POST">
                                    @csrf
                                    <input type="email" 
                                           name="email" 
                                           placeholder="Your business email" 
                                           required 
                                           style="width: 100%; padding: 12px; border-radius: 8px; border: 1px solid #444; background: #222; color: #fff; margin-bottom: 20px;">
                                    
                                    <input type="hidden" name="currency" :value="$store.mapsily.currency">
                                    
                                    <div style="display:flex; gap:10px">
                                        <button type="button" @click="showEmailModal = false" class="btn btn-ghost" style="flex:1">Cancel</button>
                                        <button type="submit" class="btn btn-primary" style="flex:1">Download →</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @else
                        <form action="{{ route('proposals.store', $calculation->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="currency" :value="$store.mapsily.currency">
                            <button type="submit" class="btn btn-primary">Download PDF</button>
                        </form>
                    @endif
                </div>
            </div> {{-- /.side-col --}}
        </div> {{-- /.dashboard-grid --}}
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('costChart');
    const chartData = @json($chartData);
    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: chartData.map(d => d.name),
            datasets: [{
                data: chartData.map(d => d.cost),
                backgroundColor: ['#85f43a','#47A805','#555555','#777777','#999999','#bbbbbb','#dddddd'],
                borderWidth: 0,
                hoverOffset: 10
            }]
        },
        options: { cutout: '70%', plugins: { legend: { position: 'bottom', labels: { color: '#fff', padding: 20, usePointStyle: true, font: { size: 12 } } } }, maintainAspectRatio: false }
    });
</script>
@endpush
@endsection
