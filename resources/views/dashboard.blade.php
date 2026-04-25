@extends('layouts.app')

@section('title', 'Admin Dashboard – My Calculations')

@section('content')
<style>
    .dashboard-page {
        min-height: 100vh;
        background-color: #1A1A1A;
        color: #ffffff;
        padding: 50px 20px;
    }
    .dash-container {
        max-width: 1300px;
        margin: 0 auto;
    }
    .dash-grid-row {
        display: grid;
        grid-template-columns: 2.5fr 1fr;
        gap: 40px;
    }
    @media (max-width: 1024px) {
        .dash-grid-row { grid-template-columns: 1fr; }
    }

    /* Professional Card Styles */
    .card {
        background: #242424;
        border-radius: 20px;
        padding: 30px;
        border: 1px solid rgba(255,255,255,0.05);
        box-shadow: 0 10px 40px rgba(0,0,0,0.2);
    }
    .card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
        padding-bottom: 15px;
        border-bottom: 1px solid rgba(255,255,255,0.05);
    }
    .card-title { font-size: 18px; font-weight: 700; color: #fff; }

    /* Account Status Sidebar */
    .status-item {
        display: flex;
        justify-content: space-between;
        margin-bottom: 15px;
        font-size: 14px;
    }
    .status-label { color: #888; }
    .status-val { color: #fff; font-weight: 600; }
    .badge-plan {
        background: rgba(133,244,58,0.1);
        color: #85f43a;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
    }

    /* Progress bar */
    .usage-bar-bg { background: #333; height: 8px; border-radius: 4px; margin: 10px 0; overflow: hidden; }
    .usage-bar-fill { background: #85f43a; height: 100%; border-radius: 4px; transition: 0.5s; }

    /* Calculation List */
    .calc-row {
        background: #2D2D2D;
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 15px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        transition: 0.2s;
        border: 1px solid transparent;
    }
    .calc-row:hover { border-color: #85f43a; background: #333; }
    .calc-main { display: flex; align-items: center; gap: 20px; }
    .calc-icon { 
        width: 48px; height: 48px; background: rgba(133,244,58,0.05); 
        border-radius: 12px; display: flex; align-items: center; justify-content: center;
        color: #85f43a; font-size: 18px; font-weight: 800;
    }
    .calc-details h4 { font-size: 16px; margin: 0; }
    .calc-details p { font-size: 12px; color: #888; margin-top: 4px; }
    
    .calc-action { text-align: right; }
    .calc-total { font-size: 18px; font-weight: 700; color: #85f43a; display: block; }
    .calc-view { font-size: 12px; color: #aaa; text-decoration: none; margin-top: 4px; display: inline-block; }
    .calc-view:hover { color: #fff; }

    .btn-new {
        background: #85f43a; color: #000; padding: 12px 24px; border-radius: 12px;
        font-weight: 700; text-decoration: none; display: inline-block; transition: 0.2s;
    }
    .btn-new:hover { transform: translateY(-2px); box-shadow: 0 10px 20px rgba(133,244,58,0.2); }
</style>

<div class="dashboard-page" style="padding: 60px 0;">
    <div class="dash-container">
        
        <div class="dash-grid-row">
            {{-- Main Calculations Column --}}
            <div class="main-content">
                <div class="card" style="background: #1e1e1e; border: 1px solid rgba(255,255,255,0.05); border-radius: 24px; padding: 40px;">
                    <div class="card-header" style="border-bottom: 1px solid rgba(255,255,255,0.05); margin-bottom: 30px; padding-bottom: 20px;">
                        <h2 class="card-title" style="font-size: 24px; font-weight: 800;">Recent Estimations</h2>
                        <a href="{{ route('calculator') }}" class="header-btn" style="padding: 10px 25px;">New Strategy Audit +</a>
                    </div>

                    <div class="calc-list">
                        @forelse($calculations as $calc)
                            <div class="calc-row">
                                <div class="calc-main">
                                    <div class="calc-icon">
                                        {{ substr($calc->industry, 0, 1) }}
                                    </div>
                                    <div class="calc-details">
                                        <h4>{{ $calc->industry }} Strategy Audit</h4>
                                        <p>{{ $calc->business_type }} • {{ $calc->target_location }} • {{ $calc->created_at->format('M d, Y') }}</p>
                                    </div>
                                </div>
                                <div class="calc-action">
                                    <span class="calc-total">${{ number_format($calc->total_cost) }} <small style="font-size: 10px; opacity: 0.5;">/mo</small></span>
                                    <a href="{{ route('calculations.show', $calc->id) }}" class="calc-view">View Strategy Details →</a>
                                </div>
                            </div>
                        @empty
                            <div style="text-align:center; padding:60px 0; border: 2px dashed #333; border-radius: 20px;">
                                <p style="color:#666; margin-bottom:20px">No reports generated yet.</p>
                                <a href="{{ route('calculator') }}" class="btn-new">Generate First Report</a>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            {{-- Sidebar Column --}}
            <div class="sidebar">
                <div class="card" style="background: #1e1e1e; border: 1px solid rgba(255,255,255,0.05); border-radius: 24px; padding: 30px;">
                    <div class="card-header" style="border-bottom: 1px solid rgba(255,255,255,0.05); margin-bottom: 20px; padding-bottom: 15px;">
                        <h2 class="card-title" style="font-size: 18px; font-weight: 800;">Account Status</h2>
                    </div>
                    
                    <div class="status-item">
                        <span class="status-label">Current Plan</span>
                        <span class="badge-plan">Free Tier</span>
                    </div>

                    <div class="status-item">
                        <span class="status-label">Member Since</span>
                        <span class="status-val">{{ auth()->user()->created_at->format('M Y') }}</span>
                    </div>

                    <div style="margin-top: 25px;">
                        <div style="display:flex; justify-content:space-between; align-items: flex-end;">
                            <span class="status-label" style="font-size: 12px;">Calculation Limit</span>
                            <span style="font-size: 20px; font-weight: 800; color: #85f43a;">
                                {{ 3 - (auth()->user()->usageLimit ? auth()->user()->usageLimit->usage_count : 0) }} 
                                <small style="font-size: 10px; font-weight: 500; color: #888;">turns left</small>
                            </span>
                        </div>
                        <div class="usage-bar-bg">
                            @php
                                $usage = auth()->user()->usageLimit ? auth()->user()->usageLimit->usage_count : 0;
                                $percent = ($usage / 3) * 100;
                            @endphp
                            <div class="usage-bar-fill" style="width: {{ 100 - $percent }}%"></div>
                        </div>
                        <p style="font-size: 11px; color: #666; margin-top: 5px;">
                            You have 3 free calculations per account. Upgrade to Pro for unlimited reports.
                        </p>
                    </div>

                    <button class="header-btn" style="width: 100%; margin-top: 25px; background: transparent; border: 1px solid var(--primary); color: var(--primary); justify-content: center;">Upgrade to Pro ✧</button>
                </div>

                <div class="card" style="margin-top: 25px; background: rgba(133,244,58,0.03); border: 1px solid rgba(133,244,58,0.1); border-radius: 24px; padding: 25px;">
                    <h3 style="font-size: 14px; margin-bottom: 10px; color: #fff; font-weight: 800; text-transform: uppercase;">Need Assistance?</h3>
                    <p style="font-size: 13px; color: #888; margin-bottom: 20px;">Book a free strategy synchronization call with our agency experts.</p>
                    <button @click="openLead = true" style="background: none; border: none; color: var(--primary); font-size: 13px; font-weight: 700; cursor: pointer; padding: 0;">Connect With Strategy Team →</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
