@extends('layouts.app')

@section('title', 'Mapsily Tools – Strategic Business Growth Calculators')

@section('content')
<div class="flex items-center justify-center w-full transition-opacity opacity-100 duration-750 lg:grow starting:opacity-0" style="padding: 100px 20px; background: #1a1a1a;">
    <main class="flex max-w-[335px] w-full flex-col-reverse lg:max-w-5xl lg:flex-row" style="background: #222; border-radius: 30px; overflow: hidden; border: 1px solid rgba(255,255,255,0.05); box-shadow: 0 50px 100px rgba(0,0,0,0.5);">
        <div class="text-[13px] leading-[20px] flex-1 p-6 pb-12 lg:p-20 bg-[#1a1a1a] dark:text-[#EDEDEC]">
            <div style="display: inline-flex; align-items: center; gap: 8px; background: rgba(133,244,58,0.1); padding: 6px 15px; border-radius: 50px; margin-bottom: 25px; border: 1px solid rgba(133,244,58,0.2);">
                <span style="width: 6px; height: 6px; background: #85f43a; border-radius: 50%;"></span>
                <span style="color: #85f43a; font-size: 11px; font-weight: 800; text-transform: uppercase; letter-spacing: 1px;">Now in Beta</span>
            </div>
            
            <h1 style="font-size: 42px; font-weight: 800; color: #fff; line-height: 1.1; margin-bottom: 20px;">Strategic <span style="color: #85f43a;">Marketing</span> Intelligence.</h1>
            <p style="font-size: 16px; color: #888; margin-bottom: 40px; line-height: 1.6;">Our high-performance calculator evaluates your niche, audience, and goals to deliver a precise cost roadmap in 60 seconds.</p>
            
            <div style="display: flex; gap: 20px; flex-wrap: wrap;">
                <a href="{{ route('calculator') }}" class="header-btn" style="padding: 18px 40px; font-size: 15px; min-width: 200px; justify-content: center;">
                    Start Evaluation →
                </a>
                <a href="https://mapsily.com" target="_blank" class="btn btn-outline" style="padding: 18px 40px; border-radius: 50px; border: 1px solid rgba(255,255,255,0.1); color: #fff; text-decoration: none; font-weight: 800; font-size: 14px; text-transform: uppercase;">
                    Learn More
                </a>
            </div>

            <div style="margin-top: 60px; display: flex; gap: 40px; border-top: 1px solid rgba(255,255,255,0.05); padding-top: 40px;">
                <div>
                    <span style="display: block; font-size: 24px; font-weight: 800; color: #fff;">1.2M+</span>
                    <span style="font-size: 12px; color: #666; text-transform: uppercase; font-weight: 700;">Data Points</span>
                </div>
                <div>
                    <span style="display: block; font-size: 24px; font-weight: 800; color: #fff;">99.8%</span>
                    <span style="font-size: 12px; color: #666; text-transform: uppercase; font-weight: 700;">Accuracy</span>
                </div>
            </div>
        </div>
        
        <div class="bg-[#222] relative lg:-ml-px -mb-px lg:mb-0 aspect-[335/376] lg:aspect-auto w-full lg:w-[450px] shrink-0 overflow-hidden flex items-center justify-center" style="background: radial-gradient(circle at center, rgba(133,244,58,0.1) 0%, rgba(0,0,0,0) 70%);">
             <div style="padding: 40px; text-align: center;">
                 <div style="width: 80px; height: 80px; background: rgba(133,244,58,0.1); color: #85f43a; border-radius: 20px; display: flex; align-items: center; justify-content: center; margin: 0 auto 30px; font-size: 32px;">
                    <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                    </svg>
                 </div>
                 <h2 style="color: #fff; font-size: 20px; font-weight: 800; margin-bottom: 10px;">Tailored Strategies</h2>
                 <p style="color: #666; font-size: 14px;">Proprietary algorithms designed for modern agency workflows.</p>
             </div>
        </div>
    </main>
</div>
@endsection
