@extends('layouts.app')

@section('title', 'Digital Marketing Cost Calculator – Free Estimate')
@section('meta_description', 'Get an instant, tailored estimate for SEO, PPC, Social Media & more. Free for all business types.')

@push('styles')
@push('styles')
    <style>
        /* ═══════════════════════════════════════════════════
                                                                                           GLOBAL THEME & RESET
                                                                                        ═══════════════════════════════════════════════════ */
        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        .calc-page {
            min-height: 100vh;
            padding: 30px 0 100px;
            background-color: #1a1a1a;
            color: #fff;
            position: relative;
            overflow-x: hidden;
            width: 100%;
            font-family: 'Inter', sans-serif;
        }

        /* ── Hero header ── */
        .calc-header {
            text-align: center;
            margin: 60px auto 80px;
            max-width: 900px;
            padding: 0 20px;
        }

        .calc-header .badge {
            background: rgba(133, 244, 58, 0.1);
            border: 1px solid rgba(133, 244, 58, 0.2);
            color: #85f43a;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 6px 16px;
            border-radius: 100px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            margin-bottom: 30px;
        }

        .calc-header h1 {
            font-family: 'Outfit', sans-serif;
            font-size: clamp(2.5rem, 6vw, 3rem);
            font-weight: 800;
            margin-bottom: 20px;
            letter-spacing: -2px;
            line-height: 1.1;
            color: #fff;
        }

        .calc-header h1 span {
            color: #85f43a;
        }

        .calc-header p {
            color: #888;
            max-width: 650px;
            margin: 0 auto;
            font-size: 18px;
            line-height: 1.6;
            font-weight: 400;
        }

        /* ── Progress Navigator ── */
        .progress-nav {
            display: flex;
            justify-content: center;
            gap: 0;
            margin-bottom: 100px;
            position: relative;
            max-width: 1000px;
            margin-left: auto;
            margin-right: auto;
            padding: 0 20px;
        }

        .progress-nav::before {
            content: '';
            position: absolute;
            top: 25px;
            left: 15%;
            right: 15%;
            height: 1px;
            background: #333;
            z-index: 0;
        }

        .nav-step {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 15px;
            position: relative;
            z-index: 1;
        }

        .nav-circle {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: #2a2a2a;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 18px;
            color: #666;
            border: 2px solid #333;
            transition: 0.3s;
        }

        .nav-step.active .nav-circle {
            background: #85f43a;
            color: #000;
            border-color: #85f43a;
            box-shadow: 0 0 20px rgba(133, 244, 58, 0.3);
        }

        .nav-label {
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #666;
            text-align: center;
        }

        .nav-step.active .nav-label {
            color: #fff;
        }

        /* ── Main Layout (Flex) ── */
        .calc-container {
            max-width: 1300px;
            margin: 0 auto;
            justify-content: space-between;
            align-items: flex-start;
            gap: 40px;
            padding: 0 30px;
            width: 100%;
        }

        .calc-main-col {
            width: 100%;
            display: flex;
            gap: 30px;
            min-width: 0;
        }

        .calc-sidebar {
            flex: 0 0 30%;
            width: 30%;
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        @media (max-width: 1100px) {
            .calc-container {
                flex-direction: column;
            }

            .calc-main-col,
            .calc-sidebar {
                flex: 0 0 100%;
                width: 100%;
            }
        }

        /* ── Card Styles ── */
        .calc-card {
            flex: 0 0 70%;
            width: 70%;
            background: #222;
            border-radius: 16px;
            border: 1px solid #2a2a2a;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .calc-card-header {
            padding: 24px 30px;
            border-bottom: 1px solid #2a2a2a;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card-title {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 18px;
            font-weight: 700;
            color: #fff;
        }

        .step-pill {
            background: #2a2a2a;
            color: #eee;
            font-size: 11px;
            font-weight: 600;
            padding: 4px 12px;
            border-radius: 6px;
        }

        .calc-card-body {
            padding: 40px 30px;
        }

        /* ── Sidebar Items ── */
        .sidebar-box {
            background: #222;
            border-radius: 12px;
            padding: 24px;
            margin-bottom: 20px;
            border: 1px solid #2a2a2a;
        }

        .sidebar-box h4 {
            font-size: 15px;
            font-weight: 700;
            margin-bottom: 15px;
            color: #fff;
        }

        .sidebar-feature {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
        }

        .feature-icon {
            width: 40px;
            height: 40px;
            background: #2a2a2a;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            color: #85f43a;
        }

        .feature-text h5 {
            font-size: 14px;
            font-weight: 700;
            margin-bottom: 4px;
        }

        .feature-text p {
            font-size: 12px;
            color: #888;
            line-height: 1.4;
        }

        /* ── Pro Card ── */
        .pro-card {
            background: #222;
            border-radius: 16px;
            padding: 40px 30px;
            text-align: center;
            border: 1px solid #2a2a2a;
            position: relative;
        }

        .pro-badge {
            position: absolute;
            top: 20px;
            right: 20px;
            background: #85f43a;
            color: #000;
            font-size: 10px;
            font-weight: 800;
            padding: 4px 10px;
            border-radius: 4px;
        }

        .pro-card h3 {
            font-size: 22px;
            font-weight: 800;
            margin: 20px 0 10px;
        }

        .pro-card p {
            font-size: 13px;
            color: #888;
            margin-bottom: 25px;
            line-height: 1.5;
        }

        .pro-features {
            text-align: left;
            margin-bottom: 30px;
        }

        .pro-feature-item {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 13px;
            margin-bottom: 12px;
            color: #ddd;
        }

        .pro-feature-item i {
            color: #85f43a;
            font-size: 14px;
        }

        .btn-pro {
            background: #85f43a;
            color: #000;
            width: 100%;
            padding: 14px;
            border-radius: 10px;
            font-weight: 800;
            font-size: 14px;
            border: none;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn-pro:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(133, 244, 58, 0.2);
        }

        @media (max-width: 1100px) {
            .calc-container {
                grid-template-columns: 1fr !important;
            }

            .nav-label {
                display: none;
            }

            .progress-nav::before {
                left: 5%;
                right: 5%;
            }
        }


        /* ═══════════════════════════════════════════════════
                                                                                           PROGRESS BAR
                                                                                        ═══════════════════════════════════════════════════ */
        .progress-header {
            padding: 28px 32px 0;
        }

        .progress-steps {
            display: flex;
            align-items: center;
            gap: 0;
            margin-bottom: 8px;
        }

        .step-item {
            display: flex;
            align-items: center;
            flex: 1;
        }

        .step-bubble {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            font-weight: 700;
            flex-shrink: 0;
            transition: background .3s, color .3s, box-shadow .3s;
            position: relative;
            z-index: 1;
        }

        .step-bubble.done {
            background: #85f43a;
            color: #000;
            box-shadow: 0 0 14px rgba(133, 244, 58, .45);
        }

        .step-bubble.active {
            background: #85f43a;
            color: #000;
            box-shadow: 0 0 20px rgba(133, 244, 58, .6);
            animation: pulse-dot 1.8s ease infinite;
        }

        .step-bubble.pending {
            background: #323232;
            color: #666;
            border: 2px solid #3a3a3a;
        }

        @keyframes pulse-dot {

            0%,
            100% {
                box-shadow: 0 0 14px rgba(133, 244, 58, .5);
            }

            50% {
                box-shadow: 0 0 24px rgba(133, 244, 58, .85);
            }
        }

        .step-connector {
            flex: 1;
            height: 3px;
            border-radius: 2px;
            margin: 0 4px;
            transition: background .4s;
        }

        .step-connector.done {
            background: #85f43a;
        }

        .step-connector.pending {
            background: #323232;
        }

        .step-labels {
            display: flex;
            justify-content: space-between;
            margin-bottom: 24px;
        }

        .step-label {
            font-size: 11px;
            font-weight: 500;
            color: #555;
            text-align: center;
            flex: 1;
            transition: color .3s;
        }

        .step-label.active {
            color: #85f43a;
        }

        .step-label.done {
            color: #a0a0a0;
        }

        /* ── Thin track bar ──────────────────────────────── */
        .progress-track {
            height: 3px;
            background: #2a2a2a;
            border-radius: 2px;
            margin: 0 32px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #47A805, #85f43a);
            border-radius: 2px;
            transition: width .5s cubic-bezier(.4, 0, .2, 1);
            box-shadow: 0 0 10px rgba(133, 244, 58, .5);
        }

        /* ═══════════════════════════════════════════════════
                                                                                           STEP BODY
                                                                                        ═══════════════════════════════════════════════════ */
        .step-body {
            padding: 32px 32px 0;
        }

        .step-title {
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 4px;
        }

        .step-subtitle {
            color: #a0a0a0;
            font-size: .9rem;
            margin-bottom: 28px;
        }

        /* ── Form grid ───────────────────────────────────── */
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .form-grid.single {
            grid-template-columns: 1fr;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .form-group.full {
            grid-column: 1 / -1;
        }

        label {
            font-size: 13px;
            font-weight: 600;
            color: #ccc;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        label .required {
            color: #85f43a;
        }

        input[type="text"],
        input[type="number"],
        input[type="email"],
        select,
        textarea {
            background: #2a2a2a;
            border: 1.5px solid #3a3a3a;
            border-radius: 10px;
            color: #fff;
            font-family: 'Inter', sans-serif;
            font-size: 14px;
            padding: 12px 16px;
            width: 100%;
            transition: border-color .2s, box-shadow .2s;
            appearance: none;
            -webkit-appearance: none;
            outline: none;
        }

        input:focus,
        select:focus,
        textarea:focus {
            border-color: #85f43a;
            box-shadow: 0 0 0 3px rgba(133, 244, 58, .12);
        }

        select {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8'%3E%3Cpath d='M1 1l5 5 5-5' stroke='%2385f43a' stroke-width='2' fill='none' stroke-linecap='round'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 14px center;
            padding-right: 38px;
        }

        select option {
            background: #272727;
        }

        .input-prefix {
            position: relative;
        }

        .input-prefix span {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #85f43a;
            font-weight: 700;
            font-size: 15px;
            pointer-events: none;
        }

        .input-prefix input {
            padding-left: 32px;
        }

        .field-hint {
            font-size: 11px;
            color: #666;
            margin-top: 2px;
        }

        /* ── Error state ─────────────────────────────────── */
        .field-error input,
        .field-error select {
            border-color: #f43a3a !important;
        }

        .err-msg {
            font-size: 11px;
            color: #f47a3a;
            margin-top: 2px;
        }

        /* ═══════════════════════════════════════════════════
                                                                                           STEP 2 – SERVICE CARDS
                                                                                        ═══════════════════════════════════════════════════ */
        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(190px, 1fr));
            gap: 14px;
        }

        .service-card {
            position: relative;
            border: 2px solid #323232;
            border-radius: 14px;
            padding: 20px 16px;
            cursor: pointer;
            transition: border-color .2s, background .2s, transform .15s;
            user-select: none;
            background: #252525;
        }

        .service-card:hover {
            border-color: rgba(133, 244, 58, .4);
            transform: translateY(-2px);
        }

        .service-card.selected {
            border-color: #85f43a;
            background: rgba(133, 244, 58, .06);
            box-shadow: 0 0 18px rgba(133, 244, 58, .15);
        }

        .service-card input[type="checkbox"] {
            position: absolute;
            opacity: 0;
            width: 0;
            height: 0;
        }

        .service-icon {
            width: 44px;
            height: 44px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            margin-bottom: 12px;
            background: rgba(133, 244, 58, .08);
        }

        .service-card.selected .service-icon {
            background: rgba(133, 244, 58, .15);
        }

        .service-name {
            font-size: 14px;
            font-weight: 700;
            margin-bottom: 4px;
        }

        .service-desc {
            font-size: 12px;
            color: #777;
            line-height: 1.5;
        }

        .check-badge {
            position: absolute;
            top: 12px;
            right: 12px;
            width: 22px;
            height: 22px;
            background: #85f43a;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            color: #000;
            font-weight: 800;
            opacity: 0;
            transform: scale(.6);
            transition: opacity .2s, transform .25s cubic-bezier(.34, 1.56, .64, 1);
        }

        .service-card.selected .check-badge {
            opacity: 1;
            transform: scale(1);
        }

        /* ═══════════════════════════════════════════════════
                                                                                           STEP 3 – SERVICE INPUTS
                                                                                        ═══════════════════════════════════════════════════ */
        .service-block {
            border: 1.5px solid #2e2e2e;
            border-radius: 14px;
            padding: 20px;
            margin-bottom: 16px;
            background: #222;
            transition: border-color .2s;
        }

        .service-block:last-child {
            margin-bottom: 0;
        }

        .service-block-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 18px;
        }

        .service-block-icon {
            width: 36px;
            height: 36px;
            border-radius: 8px;
            background: rgba(133, 244, 58, .1);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            flex-shrink: 0;
        }

        .service-block-title {
            font-size: 15px;
            font-weight: 700;
        }

        .service-block-sub {
            font-size: 12px;
            color: #666;
        }

        .mini-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
        }

        /* Platform tags */
        .platform-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-top: 4px;
        }

        .platform-tag {
            display: flex;
            align-items: center;
            gap: 6px;
            padding: 7px 14px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            border: 1.5px solid #3a3a3a;
            background: #2a2a2a;
            color: #999;
            transition: border-color .2s, background .2s, color .2s;
            user-select: none;
        }

        .platform-tag:hover {
            border-color: rgba(133, 244, 58, .4);
            color: #ccc;
        }

        .platform-tag.active {
            border-color: #85f43a;
            background: rgba(133, 244, 58, .1);
            color: #85f43a;
        }

        /* ═══════════════════════════════════════════════════
                                                                                           STEP 4 – REVIEW
                                                                                        ═══════════════════════════════════════════════════ */
        .review-section {
            margin-bottom: 24px;
        }

        .review-label {
            font-size: 11px;
            font-weight: 700;
            letter-spacing: .08em;
            text-transform: uppercase;
            color: #555;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .review-label::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #2e2e2e;
        }

        .review-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid #252525;
            font-size: 14px;
        }

        .review-row:last-child {
            border-bottom: none;
        }

        .review-row span:first-child {
            color: #888;
        }

        .review-row span:last-child {
            font-weight: 600;
            color: #fff;
        }

        .review-services {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .review-tag {
            background: rgba(133, 244, 58, .1);
            border: 1px solid rgba(133, 244, 58, .25);
            color: #85f43a;
            font-size: 12px;
            font-weight: 600;
            padding: 4px 12px;
            border-radius: 999px;
        }

        .service-estimate-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 14px;
            background: #222;
            border-radius: 10px;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .service-estimate-row:last-child {
            margin-bottom: 0;
        }

        .service-estimate-row .name {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #ccc;
        }

        .service-estimate-row .cost {
            font-weight: 700;
            color: #85f43a;
        }

        .total-box {
            background: linear-gradient(135deg, rgba(133, 244, 58, .07) 0%, rgba(71, 168, 5, .04) 100%);
            border: 1.5px solid rgba(133, 244, 58, .25);
            border-radius: 14px;
            padding: 20px 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
        }

        .total-box .label {
            font-size: 14px;
            color: #aaa;
            font-weight: 500;
        }

        .total-box .label span {
            display: block;
            font-size: 11px;
            color: #555;
            margin-top: 2px;
        }

        .total-box .amount {
            font-size: 2rem;
            font-weight: 800;
            color: #85f43a;
        }

        .total-box .roi {
            font-size: 12px;
            color: #85f43a;
            background: rgba(133, 244, 58, .1);
            padding: 3px 10px;
            border-radius: 999px;
            margin-top: 4px;
            display: inline-block;
        }

        /* ═══════════════════════════════════════════════════
                                                                                           NAVIGATION FOOTER
                                                                                        ═══════════════════════════════════════════════════ */
        .calc-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 28px 32px;
            border-top: 1px solid #252525;
            margin-top: 32px;
            gap: 16px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 13px 28px;
            border-radius: 10px;
            font-family: 'Inter', sans-serif;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            border: none;
            transition: transform .15s, box-shadow .2s, opacity .2s;
            outline: none;
        }

        .btn:active {
            transform: scale(.97);
        }

        .btn-ghost {
            background: transparent;
            color: #888;
            border: 1.5px solid #3a3a3a;
        }

        .btn-ghost:hover {
            border-color: #555;
            color: #ccc;
        }

        .btn-primary {
            background: #85f43a;
            color: #000;
            box-shadow: 0 4px 20px rgba(133, 244, 58, .3);
        }

        .btn-primary:hover {
            box-shadow: 0 6px 28px rgba(133, 244, 58, .5);
            transform: translateY(-1px);
        }

        .btn-primary:disabled {
            opacity: .45;
            cursor: not-allowed;
            box-shadow: none;
            transform: none;
        }

        .btn-success {
            background: linear-gradient(135deg, #85f43a, #47A805);
            color: #000;
            box-shadow: 0 4px 24px rgba(133, 244, 58, .4);
            font-size: 15px;
            padding: 15px 36px;
        }

        .btn-success:hover {
            box-shadow: 0 8px 36px rgba(133, 244, 58, .6);
            transform: translateY(-2px);
        }

        /* ── Slide transitions ───────────────────────────── */
        [x-cloak] {
            display: none !important;
        }

        .slide-enter-active,
        .slide-leave-active {
            transition: all .3s cubic-bezier(.4, 0, .2, 1);
        }

        .slide-enter-from {
            opacity: 0;
            transform: translateX(30px);
        }

        .slide-leave-to {
            opacity: 0;
            transform: translateX(-30px);
        }

        /* ── Step count indicator ────────────────────────── */
        .step-counter {
            font-size: 12px;
            color: #555;
            font-weight: 500;
        }

        .step-counter span {
            color: #85f43a;
            font-weight: 700;
        }

        /* ── Info banner ─────────────────────────────────── */
        .info-banner {
            background: rgba(133, 244, 58, .05);
            border: 1px solid rgba(133, 244, 58, .15);
            border-radius: 10px;
            padding: 12px 16px;
            font-size: 13px;
            color: #85f43a;
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin-bottom: 24px;
        }

        .info-banner svg {
            flex-shrink: 0;
            margin-top: 1px;
        }

        /* ═══════════════════════════════════════════════════
                                                                                           RESPONSIVE
                                                                                        ═══════════════════════════════════════════════════ */

        @media (max-width: 480px) {
            .services-grid {
                grid-template-columns: 1fr;
            }

            .calc-header h1 {
                font-size: 1.8rem;
            }

            .calc-header p {
                font-size: 0.95rem;
            }
        }
    </style>
@endpush

@section('content')
    <div class="calc-page" x-data="calculator()" x-cloak>
        {{-- Hero Header --}}
        <div class="calc-header">
            <div class="badge">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3">
                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
                </svg>
                Free Tool
            </div>
            <h1>Digital Marketing <span>Cost Calculator</span></h1>
            <p>Calculate your estimated marketing budget across SEO, Google Ads, and Social Media in seconds. Track your
                growth and see how you stack up against the competition.</p>
        </div>

        {{-- Progress Navigator --}}
        <div class="progress-nav">
            <template x-for="(s, i) in steps" :key="i">
                <div class="nav-step" :class="{ active: currentStep === i+1, done: currentStep > i+1 }">
                    <div class="nav-circle" x-text="i+1"></div>
                    <div class="nav-label" x-text="s"></div>
                </div>
            </template>
        </div>

        <div class="calc-container">
            <div class="calc-main-col">
                {{-- Calculator Card --}}
                <div class="calc-card">
                    {{-- Header inside card --}}
                    <div class="calc-card-header">
                        <h3 class="card-title">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#85f43a" stroke-width="2.5">
                                <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5" />
                            </svg>
                            Calculator Setup
                        </h3>
                        <div class="step-pill" x-text="'Step ' + currentStep + ' of 4'"></div>
                    </div>

                    {{-- Thin track bar --}}
                    <div class="progress-track" style="height: 2px;">
                        <div class="progress-fill" :style="'width:' + progressPct + '%'"
                            style="height: 100%; background: #85f43a; box-shadow: 0 0 10px rgba(133,244,58,0.5);"></div>
                    </div>

                    {{-- Step 1 --}}
                    <div class="step-body" x-show="currentStep === 1" ...>
                        <h2
                            style="font-size: 28px; font-weight: 900; color: #fff; margin-bottom: 12px; letter-spacing: -0.5px;">
                            Tell us about your business</h2>
                        <p style="font-size: 16px; color: #888; margin-bottom: 40px;">This helps us tailor the estimate to
                            your specific context.</p>

                        <div class="form-grid">

                            {{-- Business Type --}}
                            <div class="form-group" :class="{ 'field-error': errors.business_type }">
                                <label for="business_type">Business Type <span class="required">*</span></label>
                                <select id="business_type" x-model="form.business_type"
                                    @change="clearError('business_type')">
                                    <option value="">Select type…</option>
                                    <option value="B2B">B2B (Business to Business)</option>
                                    <option value="B2C">B2C (Business to Consumer)</option>
                                    <option value="eCommerce">eCommerce</option>
                                    <option value="SaaS">SaaS / Software</option>
                                    <option value="Local">Local Business</option>
                                    <option value="Nonprofit">Non-profit</option>
                                </select>
                                <span class="err-msg" x-show="errors.business_type" x-text="errors.business_type"></span>
                            </div>

                            {{-- Industry --}}
                            <div class="form-group" :class="{ 'field-error': errors.industry }">
                                <label for="industry">Industry <span class="required">*</span></label>
                                <select id="industry" x-model="form.industry" @change="clearError('industry')">
                                    <option value="">Select industry…</option>
                                    <option value="Healthcare">Healthcare</option>
                                    <option value="Finance">Finance / Fintech</option>
                                    <option value="Retail">Retail</option>
                                    <option value="Real Estate">Real Estate</option>
                                    <option value="Education">Education</option>
                                    <option value="Technology">Technology</option>
                                    <option value="Food & Beverage">Food & Beverage</option>
                                    <option value="Legal">Legal</option>
                                    <option value="Travel">Travel & Hospitality</option>
                                    <option value="Other">Other</option>
                                </select>
                                <span class="err-msg" x-show="errors.industry" x-text="errors.industry"></span>
                            </div>

                            {{-- Target Location --}}
                            <div class="form-group" :class="{ 'field-error': errors.target_location }">
                                <label for="target_location">Target Location <span class="required">*</span></label>
                                <select id="target_location" x-model="form.target_location"
                                    @change="clearError('target_location')">
                                    <option value="">Select location…</option>
                                    <option value="Local (City/Region)">Local (City / Region)</option>
                                    <option value="National (USA)">National (USA)</option>
                                    <option value="National (UK)">National (UK)</option>
                                    <option value="National (Australia)">National (Australia)</option>
                                    <option value="National (Canada)">National (Canada)</option>
                                    <option value="National (India)">National (India)</option>
                                    <option value="Global">Global</option>
                                </select>
                                <span class="err-msg" x-show="errors.target_location"
                                    x-text="errors.target_location"></span>
                            </div>

                            {{-- Growth Stage --}}
                            <div class="form-group" :class="{ 'field-error': errors.growth_stage }">
                                <label for="growth_stage">Growth Stage <span class="required">*</span></label>
                                <select id="growth_stage" x-model="form.growth_stage" @change="clearError('growth_stage')">
                                    <option value="">Select stage…</option>
                                    <option value="Awareness">Awareness (New brand / launch)</option>
                                    <option value="Growth">Growth (Expanding market share)</option>
                                    <option value="Scale">Scale (Scaling efficiency & reach)</option>
                                </select>
                                <span class="err-msg" x-show="errors.growth_stage" x-text="errors.growth_stage"></span>
                            </div>

                            {{-- Monthly Revenue --}}
                            <div class="form-group full">
                                <label for="monthly_revenue">Current Monthly Revenue <span
                                        style="color:#555; font-weight:400">(optional)</span></label>
                                <div class="input-prefix">
                                    <span>$</span>
                                    <input type="number" id="monthly_revenue" x-model="form.monthly_revenue"
                                        placeholder="e.g. 25000" min="0" step="500">
                                </div>
                                <p class="field-hint">Used to calculate ROI projections. Leave blank if you'd rather not
                                    share.</p>
                            </div>

                        </div>
                    </div>

                    {{-- ════════════════════════════════════════
                    STEP 2 – Services Selection
                    ════════════════════════════════════════ --}}
                    <div class="step-body" x-show="currentStep === 2" x-transition:enter="slide-enter-active"
                        x-transition:enter-start="slide-enter-from" x-transition:leave="slide-leave-active"
                        x-transition:leave-end="slide-leave-to">

                        <h2 class="step-title">Which services do you need?</h2>
                        <p class="step-subtitle">Select all that apply — you can configure each one next.</p>

                        <div class="info-banner" x-show="errors.services">
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                                <circle cx="8" cy="8" r="7" stroke="#85f43a" stroke-width="1.5" />
                                <path d="M8 5v4M8 11v.5" stroke="#85f43a" stroke-width="1.8" stroke-linecap="round" />
                            </svg>
                            Please select at least one service to continue.
                        </div>

                        <div class="services-grid">
                            <template x-for="svc in serviceOptions" :key="svc.key">
                                <label class="service-card" :class="{ selected: isSelected(svc.key) }"
                                    :for="'svc_' + svc.key">
                                    <input type="checkbox" :id="'svc_' + svc.key" :value="svc.key"
                                        @change="toggleService(svc.key)">
                                    <div class="check-badge">✓</div>
                                    <div class="service-icon" x-text="svc.icon"></div>
                                    <div class="service-name" x-text="svc.name"></div>
                                    <div class="service-desc" x-text="svc.desc"></div>
                                </label>
                            </template>
                        </div>

                    </div>

                    {{-- ════════════════════════════════════════
                    STEP 3 – Service Inputs
                    ════════════════════════════════════════ --}}
                    <div class="step-body" x-show="currentStep === 3" x-transition:enter="slide-enter-active"
                        x-transition:enter-start="slide-enter-from" x-transition:leave="slide-leave-active"
                        x-transition:leave-end="slide-leave-to">

                        <h2 class="step-title">Configure each service</h2>
                        <p class="step-subtitle">Enter your targets so we can estimate accurate costs.</p>

                        {{-- SEO --}}
                        <div class="service-block" x-show="isSelected('seo')">
                            <div class="service-block-header">
                                <div class="service-block-icon">🔍</div>
                                <div>
                                    <div class="service-block-title">Search Engine Optimisation (SEO)</div>
                                    <div class="service-block-sub">Keyword targeting & on-page strategy</div>
                                </div>
                            </div>
                            <div class="mini-grid">
                                <div class="form-group">
                                    <label for="seo_keywords">Number of Keywords</label>
                                    <input type="number" id="seo_keywords" x-model="inputs.seo.keywords"
                                        placeholder="e.g. 50" min="1">
                                </div>
                                <div class="form-group">
                                    <label for="seo_country">Target Country</label>
                                    <input type="text" id="seo_country" x-model="inputs.seo.target_country"
                                        placeholder="e.g. USA, UK">
                                </div>
                                <div class="form-group">
                                    <label for="seo_competition">Competition Level</label>
                                    <select id="seo_competition" x-model="inputs.seo.competition_level">
                                        <option value="Low">Low</option>
                                        <option value="Medium">Medium</option>
                                        <option value="High">High</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="seo_pages">Landing Pages</label>
                                    <input type="number" id="seo_pages" x-model="inputs.seo.pages" placeholder="e.g. 10"
                                        min="1">
                                </div>
                            </div>
                        </div>

                        {{-- Google Ads --}}
                        <div class="service-block" x-show="isSelected('google_ads')">
                            <div class="service-block-header">
                                <div class="service-block-icon">⚡</div>
                                <div>
                                    <div class="service-block-title">Google Ads</div>
                                    <div class="service-block-sub">Search, display & shopping campaigns</div>
                                </div>
                            </div>
                            <div class="mini-grid">
                                <div class="form-group">
                                    <label for="gads_budget">Monthly Ad Spend</label>
                                    <div class="input-prefix">
                                        <span>$</span>
                                        <input type="number" id="gads_budget" x-model="inputs.google_ads.budget"
                                            placeholder="e.g. 3000" min="100">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="gads_cpc">Target Cost-Per-Click</label>
                                    <div class="input-prefix">
                                        <span>$</span>
                                        <input type="number" id="gads_cpc" x-model="inputs.google_ads.cpc"
                                            placeholder="e.g. 2.50" min="0.01" step="0.01">
                                    </div>
                                </div>
                                <div class="form-group full">
                                    <label for="gads_type">Campaign Type</label>
                                    <select id="gads_type" x-model="inputs.google_ads.campaign_type">
                                        <option value="Search">Search</option>
                                        <option value="Display">Display</option>
                                        <option value="Shopping">Shopping</option>
                                        <option value="Performance Max">Performance Max</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        {{-- Website Development --}}
                        <div class="service-block" x-show="isSelected('website')">
                            <div class="service-block-header">
                                <div class="service-block-icon">🌐</div>
                                <div>
                                    <div class="service-block-title">Website Development</div>
                                    <div class="service-block-sub">Design, build & optimise a converting site</div>
                                </div>
                            </div>
                            <div class="mini-grid">
                                <div class="form-group">
                                    <label for="web_pages">Number of Pages</label>
                                    <input type="number" id="web_pages" x-model="inputs.website.pages" placeholder="e.g. 10"
                                        min="1">
                                </div>
                                <div class="form-group">
                                    <label>Project Type</label>
                                    <div class="platform-tags">
                                        <template x-for="t in ['New Build','Redesign','Landing Page','eCommerce']" :key="t">
                                            <div class="platform-tag" :class="{ active: inputs.website.project_type === t }"
                                                @click="inputs.website.project_type = t" x-text="t"></div>
                                        </template>
                                    </div>
                                </div>
                                <div class="form-group full">
                                    <label>Features</label>
                                    <div class="platform-tags">
                                        <template
                                            x-for="f in ['Blog', 'Contact Form', 'Live Chat', 'Booking System', 'User Accounts']"
                                            :key="f">
                                            <div class="platform-tag"
                                                :class="{ active: inputs.website.features.includes(f) }"
                                                @click="toggleWebsiteFeature(f)" x-text="f"></div>
                                        </template>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Local SEO --}}
                        <div class="service-block" x-show="isSelected('local_seo')">
                            <div class="service-block-header">
                                <div class="service-block-icon">📍</div>
                                <div>
                                    <div class="service-block-title">Local SEO</div>
                                    <div class="service-block-sub">Google Business Profile & local citations</div>
                                </div>
                            </div>
                            <div class="mini-grid">
                                <div class="form-group">
                                    <label for="local_locations">Number of Locations</label>
                                    <input type="number" id="local_locations" x-model="inputs.local_seo.locations"
                                        placeholder="e.g. 3" min="1">
                                    <p class="field-hint">Each location needs its own profile</p>
                                </div>
                                <div class="form-group">
                                    <label>Include GBP Setup?</label>
                                    <div class="platform-tags">
                                        <div class="platform-tag" :class="{ active: inputs.local_seo.gbp_setup === true }"
                                            @click="inputs.local_seo.gbp_setup = true">Yes — set it up</div>
                                        <div class="platform-tag" :class="{ active: inputs.local_seo.gbp_setup === false }"
                                            @click="inputs.local_seo.gbp_setup = false">Already active</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Social Media --}}
                        <div class="service-block" x-show="isSelected('social')">
                            <div class="service-block-header">
                                <div class="service-block-icon">📱</div>
                                <div>
                                    <div class="service-block-title">Social Media Marketing</div>
                                    <div class="service-block-sub">Organic content, community & paid social</div>
                                </div>
                            </div>
                            <div class="form-group" style="margin-bottom:16px">
                                <label>Platforms</label>
                                <div class="platform-tags">
                                    <template
                                        x-for="p in ['Instagram','Facebook','LinkedIn','TikTok','Twitter/X','Pinterest','YouTube']"
                                        :key="p">
                                        <div class="platform-tag" :class="{ active: inputs.social.platforms.includes(p) }"
                                            @click="togglePlatform(p)" x-text="p"></div>
                                    </template>
                                </div>
                            </div>
                            <div class="mini-grid">
                                <div class="form-group">
                                    <label for="social_posts_week">Posts per Week</label>
                                    <input type="number" id="social_posts_week" x-model="inputs.social.posts_per_week"
                                        placeholder="e.g. 3" min="1">
                                </div>
                                <div class="form-group">
                                    <label for="social_paid">Ad Spend</label>
                                    <div class="input-prefix">
                                        <span>$</span>
                                        <input type="number" id="social_paid" x-model="inputs.social.paid_budget"
                                            placeholder="e.g. 500" min="0">
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Email Marketing --}}
                        <div class="service-block" x-show="isSelected('email')">
                            <div class="service-block-header">
                                <div class="service-block-icon">📧</div>
                                <div>
                                    <div class="service-block-title">Email Marketing</div>
                                    <div class="service-block-sub">Campaigns, automation & list management</div>
                                </div>
                            </div>
                            <div class="mini-grid">
                                <div class="form-group">
                                    <label for="email_list">List Size (subscribers)</label>
                                    <input type="number" id="email_list" x-model="inputs.email.list_size"
                                        placeholder="e.g. 5000" min="1">
                                </div>
                                <div class="form-group">
                                    <label for="email_freq">Emails per Month</label>
                                    <input type="number" id="email_freq" x-model="inputs.email.emails_per_month"
                                        placeholder="e.g. 8" min="1">
                                </div>
                            </div>
                        </div>

                        {{-- Content Marketing --}}
                        <div class="service-block" x-show="isSelected('content')">
                            <div class="service-block-header">
                                <div class="service-block-icon">✍️</div>
                                <div>
                                    <div class="service-block-title">Content Marketing</div>
                                    <div class="service-block-sub">Blog articles, guides & thought leadership</div>
                                </div>
                            </div>
                            <div class="mini-grid">
                                <div class="form-group">
                                    <label for="content_articles">Articles per Month</label>
                                    <input type="number" id="content_articles" x-model="inputs.content.articles_per_month"
                                        placeholder="e.g. 4" min="1">
                                </div>
                                <div class="form-group">
                                    <label for="content_words">Avg. Word Count</label>
                                    <input type="number" id="content_words" x-model="inputs.content.word_count"
                                        placeholder="e.g. 1500" min="500" step="100">
                                </div>
                            </div>
                        </div>

                    </div>

                    {{-- ════════════════════════════════════════
                    STEP 4 – Review & Calculate
                    ════════════════════════════════════════ --}}
                    <div class="step-body" x-show="currentStep === 4" x-transition:enter="slide-enter-active"
                        x-transition:enter-start="slide-enter-from" x-transition:leave="slide-leave-active"
                        x-transition:leave-end="slide-leave-to">

                        <h2 class="step-title">Review & get your estimate</h2>
                        <p class="step-subtitle">Confirm your details below, then hit Calculate.</p>

                        {{-- Business details summary --}}
                        <div class="review-section">
                            <div class="review-label">Business Details</div>
                            <div class="review-row">
                                <span>Business Type</span>
                                <span x-text="form.business_type || '—'"></span>
                            </div>
                            <div class="review-row">
                                <span>Industry</span>
                                <span x-text="form.industry || '—'"></span>
                            </div>
                            <div class="review-row">
                                <span>Target Location</span>
                                <span x-text="form.target_location || '—'"></span>
                            </div>
                            <div class="review-row">
                                <span>Growth Stage</span>
                                <span x-text="form.growth_stage || '—'"></span>
                            </div>
                            <div class="review-row" x-show="form.monthly_revenue">
                                <span>Monthly Revenue</span>
                                <span x-text="'$' + Number(form.monthly_revenue).toLocaleString()"></span>
                            </div>
                        </div>

                        {{-- Selected services --}}
                        <div class="review-section">
                            <div class="review-label">Selected Services</div>
                            <div class="review-services">
                                <template x-for="svc in selectedServiceLabels()" :key="svc">
                                    <span class="review-tag" x-text="svc"></span>
                                </template>
                            </div>
                        </div>

                        {{-- Cost breakdown --}}
                        <div class="review-section" x-show="result !== null">
                            <div class="review-label">Cost Breakdown</div>
                            <template x-for="item in result?.breakdown || []" :key="item.name">
                                <div class="service-estimate-row">
                                    <span class="name">
                                        <span x-text="item.icon"></span>
                                        <span x-text="item.name"></span>
                                    </span>
                                    <span class="cost" x-text="'$' + item.cost.toLocaleString() + ' /mo'"></span>
                                </div>
                            </template>
                        </div>

                        {{-- Calculate CTA (before result) --}}
                        <div x-show="result === null" style="text-align:center; padding: 20px 0 4px;">
                            <p style="color:#666; font-size:13px; margin-bottom:16px;">
                                Click <strong style="color:#85f43a">Calculate</strong> to generate your personalised
                                estimate.
                            </p>
                        </div>

                        {{-- Total box (after result) --}}
                        <div class="total-box" x-show="result !== null">
                            <div class="label">
                                Estimated Monthly Investment
                                <span>Based on your inputs & industry benchmarks</span>
                                <div class="roi" x-show="result?.roi" x-text="'📈 Est. ROI: ' + result?.roi"></div>
                            </div>
                            <div style="text-align:right">
                                <div class="amount" x-text="'$' + result?.total?.toLocaleString()"></div>
                                <div style="font-size:12px; color:#666; margin-top:2px">per month</div>
                            </div>
                        </div>

                    </div>

                    {{-- ── Navigation Footer ── --}}
                    <div class="calc-footer">
                        <span class="step-counter">Step <span x-text="currentStep"></span> of <span
                                x-text="steps.length"></span></span>

                        <div style="display:flex; gap:10px; margin-left:auto">
                            {{-- Back --}}
                            <button class="btn btn-ghost" @click="prevStep" x-show="currentStep > 1">
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                                    <path d="M10 4L6 8l4 4" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                                Back
                            </button>

                            {{-- Next (steps 1–3) --}}
                            <button class="btn btn-primary" @click="nextStep" x-show="currentStep < 4"
                                x-text="currentStep === 3 ? 'Review →' : 'Next →'">
                            </button>

                            {{-- Calculate (step 4, before result) --}}
                            <button class="btn btn-success" @click="calculate"
                                x-show="currentStep === 4 && result === null">
                                ✦ Calculate My Costs
                            </button>

                            {{-- Start Over (after result) --}}
                            <button class="btn btn-ghost" @click="reset" x-show="currentStep === 4 && result !== null">
                                Start Over
                            </button>

                            {{-- Save / Submit (after result) --}}
                            <button class="btn btn-primary" @click="submitForm"
                                x-show="currentStep === 4 && result !== null">
                                Save Estimate →
                            </button>
                        </div>
                    </div> {{-- /.calc-card --}}
                </div> {{-- /.calc-main-col --}}

                <div class="calc-sidebar">
                    {{-- Why use this tool --}}
                    <div class="sidebar-card"
                        style="margin-bottom: 25px; padding: 25px; background: rgba(255,255,255,0.02); border: 1px solid rgba(255,255,255,0.05); border-radius: 16px;">
                        <h3
                            style="font-size: 11px; font-weight: 700; color: #fff; margin-bottom: 25px; text-transform: uppercase; letter-spacing: 1.5px; opacity: 0.6;">
                            Why use this tool?</h3>

                        <div class="benefit-item" style="margin-bottom: 25px; display: flex; gap: 15px;">
                            <div class="benefit-icon"
                                style="flex-shrink: 0; width: 34px; height: 34px; background: rgba(133,244,58,0.05); color: #85f43a; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2">
                                    <path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z" />
                                </svg>
                            </div>
                            <div class="benefit-text">
                                <h4
                                    style="font-size: 13px; font-weight: 700; color: #fff; margin-bottom: 4px; margin-top: 0;">
                                    Quick
                                    Insights</h4>
                                <p style="font-size: 11px; color: #777; line-height: 1.5;">Instantly understand how well
                                    your content resonates with your audience.</p>
                            </div>
                        </div>

                        <div class="benefit-item" style="margin-bottom: 25px; display: flex; gap: 15px;">
                            <div class="benefit-icon"
                                style="flex-shrink: 0; width: 34px; height: 34px; background: rgba(133,244,58,0.05); color: #85f43a; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2">
                                    <path d="M12 20V10M18 20V4M6 20v-4" />
                                </svg>
                            </div>
                            <div class="benefit-text">
                                <h4
                                    style="font-size: 13px; font-weight: 700; color: #fff; margin-bottom: 4px; margin-top: 0;">
                                    Track Growth
                                </h4>
                                <p style="font-size: 11px; color: #777; line-height: 1.5;">Measure your performance over
                                    time by saving your historical data.</p>
                            </div>
                        </div>

                        <div class="benefit-item" style="display: flex; gap: 15px;">
                            <div class="benefit-icon"
                                style="flex-shrink: 0; width: 34px; height: 34px; background: rgba(133,244,58,0.05); color: #85f43a; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2">
                                    <circle cx="12" cy="12" r="10" />
                                    <path d="M2 12h20M12 2a15 15 0 0 1 0 20 15 15 0 0 1 0-20z" />
                                </svg>
                            </div>
                            <div class="benefit-text">
                                <h4
                                    style="font-size: 13px; font-weight: 700; color: #fff; margin-bottom: 4px; margin-top: 0;">
                                    Benchmark
                                </h4>
                                <p style="font-size: 11px; color: #777; line-height: 1.5;">Compare your rates against
                                    industry standards and competitors.</p>
                            </div>
                        </div>
                    </div>

                    {{-- Upgrade to Pro Card --}}
                    <div class="sidebar-card"
                        style="padding: 40px 30px; text-align: center; position: relative; overflow: hidden; background: rgba(255,255,255,0.02); border: 1px solid rgba(255,255,255,0.05); border-radius: 16px;">
                        <div
                            style="position: absolute; top: 0; right: 0; background: #85f43a; color: #000; font-size: 9px; font-weight: 800; padding: 4px 12px; border-bottom-left-radius: 12px; letter-spacing: 1px;">
                            PRO</div>

                        <div
                            style="width: 56px; height: 56px; background: rgba(133,244,58,0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 25px; color: #85f43a; border: 1px solid rgba(133,244,58,0.2);">
                            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">
                                <path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z" />
                            </svg>
                        </div>

                        <h3 style="font-size: 20px; font-weight: 800; color: #fff; margin-bottom: 12px;">Upgrade to Pro</h3>
                        <p
                            style="color: #888; font-size: 12px; margin-bottom: 30px; line-height: 1.6; max-width: 200px; margin-left: auto; margin-right: auto;">
                            Unlock bulk analysis, competitor benchmarking, and export your reports.</p>

                        <ul
                            style="text-align: left; margin-bottom: 35px; font-size: 12px; color: #ccc; list-style: none; padding: 0; max-width: 180px; margin-left: auto; margin-right: auto;">
                            <li style="margin-bottom: 15px; display: flex; align-items: center; gap: 10px;">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#85f43a"
                                    stroke-width="4">
                                    <path d="M20 6L9 17l-5-5" />
                                </svg>
                                Connect accounts directly
                            </li>
                            <li style="margin-bottom: 15px; display: flex; align-items: center; gap: 10px;">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#85f43a"
                                    stroke-width="4">
                                    <path d="M20 6L9 17l-5-5" />
                                </svg>
                                PDF / CSV Exporting
                            </li>
                            <li style="display: flex; align-items: center; gap: 10px;">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#85f43a"
                                    stroke-width="4">
                                    <path d="M20 6L9 17l-5-5" />
                                </svg>
                                White-label reports
                            </li>
                        </ul>

                        <button class="btn btn-primary"
                            style="width: 100%; justify-content: center; padding: 15px; background: #85f43a; color: #000; border-radius: 10px; font-weight: 800; font-size: 13px;">Get
                            Pro for $9/mo</button>
                    </div>
                </div> {{-- /.calc-sidebar --}}
            </div> {{-- /.calc-container --}}
        </div> {{-- /.calc-page --}}
@endsection

    @push('scripts')
        <script>
            function calculator() {
                return {
                    currentStep: 1,
                    steps: ['Business Details', 'Services', 'Configure', 'Review'],
                    result: null,
                    errors: {},

                    /* ── Business form data ── */
                    form: {
                        business_type: '',
                        industry: '',
                        target_location: '',
                        monthly_revenue: '',
                        growth_stage: '',
                    },

                    /* ── Selected service keys ── */
                    selectedServices: [],

                    /* ── Service-specific inputs ── */
                    inputs: {
                        seo: { keywords: '', pages: '', target_country: '', competition_level: 'Medium' },
                        google_ads: { budget: '', cpc: '', campaign_type: 'Search' },
                        social: { platforms: [], posts_per_week: '', paid_budget: '' },
                        content: { articles_per_month: '', word_count: '' },
                        website: { pages: '', project_type: 'New Build', features: [] },
                        local_seo: { locations: '', gbp_setup: false },
                        email: { list_size: '', emails_per_month: '' },
                    },

                    /* ── Service catalogue ── */
                    serviceOptions: [
                        { key: 'seo', icon: '🔍', name: 'SEO', desc: 'Organic rankings, keyword targeting & on-page optimisation.' },
                        { key: 'google_ads', icon: '⚡', name: 'Google Ads', desc: 'Search, display & shopping campaigns with managed bidding.' },
                        { key: 'social', icon: '📱', name: 'Social Media', desc: 'Content creation, scheduling & paid social campaigns.' },
                        { key: 'content', icon: '✍️', name: 'Content Marketing', desc: 'Blog articles, guides & SEO-driven long-form content.' },
                        { key: 'website', icon: '🌐', name: 'Website Development', desc: 'Design, build & optimise a high-converting website.' },
                        { key: 'local_seo', icon: '📍', name: 'Local SEO', desc: 'Google Business Profile, citations & local rankings.' },
                        { key: 'email', icon: '📧', name: 'Email Marketing', desc: 'Campaigns, drip sequences & subscriber list growth.' },
                    ],

                    /* ── Computed progress ── */
                    get progressPct() {
                        return ((this.currentStep - 1) / (this.steps.length - 1)) * 100;
                    },

                    /* ── Helpers ── */
                    isSelected(key) { return this.selectedServices.includes(key); },
                    clearError(field) { delete this.errors[field]; },

                    toggleService(key) {
                        const idx = this.selectedServices.indexOf(key);
                        if (idx === -1) this.selectedServices.push(key);
                        else this.selectedServices.splice(idx, 1);
                    },

                    togglePlatform(p) {
                        const idx = this.inputs.social.platforms.indexOf(p);
                        if (idx === -1) this.inputs.social.platforms.push(p);
                        else this.inputs.social.platforms.splice(idx, 1);
                    },

                    toggleWebsiteFeature(f) {
                        const idx = this.inputs.website.features.indexOf(f);
                        if (idx === -1) this.inputs.website.features.push(f);
                        else this.inputs.website.features.splice(idx, 1);
                    },

                    selectedServiceLabels() {
                        return this.serviceOptions
                            .filter(s => this.selectedServices.includes(s.key))
                            .map(s => s.name);
                    },

                    /* ── Validation ── */
                    validateStep1() {
                        this.errors = {};
                        if (!this.form.business_type) this.errors.business_type = 'Please select a business type.';
                        if (!this.form.industry) this.errors.industry = 'Please select your industry.';
                        if (!this.form.target_location) this.errors.target_location = 'Please select a target location.';
                        if (!this.form.growth_stage) this.errors.growth_stage = 'Please select your growth stage.';
                        return Object.keys(this.errors).length === 0;
                    },

                    validateStep2() {
                        this.errors = {};
                        if (this.selectedServices.length === 0)
                            this.errors.services = true;
                        return Object.keys(this.errors).length === 0;
                    },

                    /* ── Navigation ── */
                    nextStep() {
                        if (this.currentStep === 1 && !this.validateStep1()) return;
                        if (this.currentStep === 2 && !this.validateStep2()) return;
                        if (this.currentStep < this.steps.length) this.currentStep++;
                    },

                    prevStep() {
                        if (this.currentStep > 1) {
                            this.result = null;
                            this.currentStep--;
                        }
                    },

                    /* ── Estimation engine ── */
                    calculate() {
                        const breakdown = [];
                        let total = 0;

                        if (this.isSelected('seo')) {
                            const kw = Number(this.inputs.seo.keywords) || 30;
                            const pages = Number(this.inputs.seo.pages) || 5;
                            const cost = Math.round(kw * 8 + pages * 120 + 400);
                            breakdown.push({ icon: '🔍', name: 'SEO', cost });
                            total += cost;
                        }

                        if (this.isSelected('google_ads')) {
                            const budget = Number(this.inputs.google_ads.budget) || 1000;
                            const mgmtFee = Math.round(budget * 0.18);
                            const cost = budget + mgmtFee;
                            breakdown.push({ icon: '⚡', name: 'Google Ads', cost });
                            total += cost;
                        }

                        if (this.isSelected('social')) {
                            const posts = Number(this.inputs.social.posts_per_month) || 12;
                            const paidBudget = Number(this.inputs.social.paid_budget) || 0;
                            const platforms = this.inputs.social.platforms.length || 1;
                            const cost = Math.round(posts * 45 * Math.min(platforms, 3) * 0.6 + paidBudget + 300);
                            breakdown.push({ icon: '📱', name: 'Social Media', cost });
                            total += cost;
                        }

                        if (this.isSelected('content')) {
                            const articles = Number(this.inputs.content.articles_per_month) || 2;
                            const words = Number(this.inputs.content.word_count) || 1200;
                            const cost = Math.round(articles * words * 0.06 + 200);
                            breakdown.push({ icon: '✍️', name: 'Content Marketing', cost });
                            total += cost;
                        }

                        if (this.isSelected('website')) {
                            const pages = Number(this.inputs.website.pages) || 5;
                            const type = this.inputs.website.project_type || 'New Build';
                            const baseMap = { 'New Build': 3500, 'Redesign': 2500, 'Landing Page': 800, 'eCommerce': 5500 };
                            const cost = Math.round((baseMap[type] || 3500) + pages * 180);
                            // Spread over 12 months for monthly equivalent
                            breakdown.push({ icon: '🌐', name: 'Website Development', cost: Math.round(cost / 12) });
                            total += Math.round(cost / 12);
                        }

                        if (this.isSelected('local_seo')) {
                            const locs = Number(this.inputs.local_seo.locations) || 1;
                            const gbp = this.inputs.local_seo.gbp_setup ? 200 : 0;
                            const cost = Math.round(locs * 350 + gbp);
                            breakdown.push({ icon: '📍', name: 'Local SEO', cost });
                            total += cost;
                        }

                        if (this.isSelected('email')) {
                            const listSize = Number(this.inputs.email.list_size) || 1000;
                            const freq = Number(this.inputs.email.emails_per_month) || 4;
                            const cost = Math.round(listSize * 0.012 + freq * 80 + 150);
                            breakdown.push({ icon: '📧', name: 'Email Marketing', cost });
                            total += cost;
                        }

                        /* ROI projection */
                        let roi = null;
                        if (this.form.monthly_revenue && total > 0) {
                            const rev = Number(this.form.monthly_revenue);
                            const roiLow = Math.round((rev * 0.15) / total * 10) / 10;
                            const roiHigh = Math.round((rev * 0.35) / total * 10) / 10;
                            roi = `${roiLow}x – ${roiHigh}x`;
                        }

                        this.result = { breakdown, total, roi };
                    },

                    /* ── Reset ── */
                    reset() {
                        this.currentStep = 1;
                        this.result = null;
                        this.errors = {};
                        this.selectedServices = [];
                        this.form = { business_type: '', industry: '', target_location: '', monthly_revenue: '', growth_stage: '' };
                        this.inputs = {
                            seo: { keywords: '', pages: '', target_country: '', competition_level: 'Medium' },
                            google_ads: { budget: '', cpc: '', campaign_type: 'Search' },
                            social: { platforms: [], posts_per_week: '', paid_budget: '' },
                            content: { articles_per_month: '', word_count: '' },
                            website: { pages: '', project_type: 'New Build', features: [] },
                            local_seo: { locations: '', gbp_setup: false },
                            email: { list_size: '', emails_per_month: '' },
                        };
                    },

                    /* ── Submit ── */
                    async submitForm() {
                        const payload = {
                            business_type: this.form.business_type,
                            industry: this.form.industry,
                            target_location: this.form.target_location,
                            growth_stage: this.form.growth_stage,
                            monthly_revenue: this.form.monthly_revenue,
                            services: this.selectedServices,
                            inputs: this.inputs,
                        };

                        try {
                            const response = await fetch('{{ route('calculations.store') }}', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify(payload)
                            });

                            const data = await response.json();

                            if (data.success) {
                                // Redirect to the results dashboard
                                window.location.href = data.redirect_url;
                            } else {
                                alert('Error: ' + (data.message || 'Validation failed'));
                            }
                        } catch (error) {
                            console.error('Submission failed:', error);
                            alert('Something went wrong. Please try again.');
                        }
                    },
                };
            }
        </script>
    @endpush