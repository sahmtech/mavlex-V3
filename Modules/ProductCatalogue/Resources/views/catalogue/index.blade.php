@extends('layouts.guest')
@section('title', $business->name)
@section('content')
<style>
    :root {
        --primary-color: #3b82f6;
        --primary-hover: #2563eb;
        --primary-light: #dbeafe;
        --secondary-color: #64748b;
        --success-color: #10b981;
        --danger-color: #ef4444;
        --warning-color: #f59e0b;
        
        /* Light theme */
        --bg-primary: #ffffff;
        --bg-secondary: #f8fafc;
        --bg-tertiary: #f1f5f9;
        --bg-hover: #f8fafc;
        --bg-card: #ffffff;
        --text-primary: #0f172a;
        --text-secondary: #475569;
        --text-muted: #64748b;
        --border-color: #e2e8f0;
        --border-hover: #cbd5e1;
        --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
        --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
        --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
        --shadow-xl: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
        --glass-bg: rgba(255, 255, 255, 0.85);
        --glass-border: rgba(255, 255, 255, 0.3);
        --accent-bg: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
    }

    [data-theme="dark"] {
        --bg-primary: #0f172a;
        --bg-secondary: #1e293b;
        --bg-tertiary: #334155;
        --bg-hover: #1e293b;
        --bg-card: #1e293b;
        --text-primary: #f8fafc;
        --text-secondary: #cbd5e1;
        --text-muted: #94a3b8;
        --border-color: #334155;
        --border-hover: #475569;
        --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.3);
        --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.3), 0 2px 4px -2px rgb(0 0 0 / 0.3);
        --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.3), 0 4px 6px -4px rgb(0 0 0 / 0.3);
        --shadow-xl: 0 20px 25px -5px rgb(0 0 0 / 0.3), 0 8px 10px -6px rgb(0 0 0 / 0.3);
        --glass-bg: rgba(15, 23, 42, 0.85);
        --glass-border: rgba(255, 255, 255, 0.1);
        --accent-bg: linear-gradient(135deg, #1e293b 0%, #334155 100%);
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        background: var(--bg-secondary);
        color: var(--text-primary);
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        line-height: 1.6;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        min-height: 100vh;
    }

    /* Navigation */
    .category-nav {
        position: sticky;
        top: 0;
        z-index: 1000;
        background: var(--glass-bg);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border-bottom: 1px solid var(--border-color);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .nav-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 16px 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 24px;
        min-height: 72px;
    }

    .navbar-brand {
        display: flex;
        align-items: center;
        text-decoration: none;
        color: var(--text-primary);
        font-weight: 800;
        font-size: 1.5rem;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        flex-shrink: 0;
        letter-spacing: -0.025em;
    }

    .navbar-brand:hover {
        color: var(--primary-color);
        transform: translateY(-1px);
    }

    .navbar-brand img {
        height: 40px;
        width: auto;
        transition: all 0.3s ease;
        border-radius: 8px;
    }

    .nav-center {
        flex: 1;
        display: flex;
        justify-content: center;
        max-width: 800px;
    }

    .nav-list {
        display: flex;
        list-style: none;
        gap: 4px;
        align-items: center;
        margin: 0;
        padding: 8px 8px 16px 8px;
        background: var(--bg-tertiary);
        border-radius: 60px;
        box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);
        border: 1px solid var(--border-color);
        overflow-x: auto;
        scrollbar-width: thin;
        scrollbar-color: rgba(156, 163, 175, 0.4) transparent;
        scroll-behavior: smooth;
        position: relative;
    }

    .nav-list::-webkit-scrollbar {
        height: 4px;
    }

    .nav-list::-webkit-scrollbar-track {
        background: transparent;
        border-radius: 2px;
        margin: 0 20px;
    }

    .nav-list::-webkit-scrollbar-thumb {
        background: rgba(156, 163, 175, 0.4);
        border-radius: 2px;
        transition: all 0.3s ease;
    }

    .nav-list::-webkit-scrollbar-thumb:hover {
        background: rgba(156, 163, 175, 0.7);
    }

    .nav-list:hover::-webkit-scrollbar-thumb {
        background: rgba(156, 163, 175, 0.6);
    }

    .menu-item {
        text-decoration: none;
        color: var(--text-secondary);
        font-weight: 600;
        font-size: 0.875rem;
        padding: 10px 20px;
        border-radius: 50px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        white-space: nowrap;
        min-width: fit-content;
    }

    .menu-item:hover,
    .menu-item.active {
        color: var(--text-primary);
        background: var(--bg-primary);
        box-shadow: var(--shadow-md);
        transform: translateY(-1px);
    }

    .menu-item.active {
        color: var(--primary-color);
        font-weight: 700;
    }

    .nav-actions {
        display: flex;
        align-items: center;
        gap: 12px;
        flex-shrink: 0;
    }

    /* Theme Toggle */
    .theme-toggle {
        background: var(--bg-tertiary);
        border: 1px solid var(--border-color);
        border-radius: 50px;
        padding: 10px;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        display: flex;
        align-items: center;
        justify-content: center;
        width: 44px;
        height: 44px;
        position: relative;
        overflow: hidden;
    }

    .theme-toggle::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: left 0.5s;
    }

    .theme-toggle:hover::before {
        left: 100%;
    }

    .theme-toggle:hover {
        background: var(--bg-primary);
        box-shadow: var(--shadow-lg);
        transform: scale(1.05);
        border-color: var(--primary-color);
    }

    .theme-toggle-icon {
        width: 20px;
        height: 20px;
        color: var(--text-primary);
        transition: all 0.3s ease;
        z-index: 1;
    }

    .menu-toggle {
        display: none;
        background: var(--bg-tertiary);
        border: 1px solid var(--border-color);
        color: var(--text-primary);
        border-radius: 12px;
        padding: 10px;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        width: 44px;
        height: 44px;
        align-items: center;
        justify-content: center;
    }

    .menu-toggle:hover {
        background: var(--bg-primary);
        box-shadow: var(--shadow-md);
        transform: scale(1.05);
    }

    /* Business Info Header */
    .business-header {
        background: var(--accent-bg);
        border-bottom: 1px solid var(--border-color);
        padding: 48px 24px;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .business-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: radial-gradient(circle at 30% 20%, rgba(59, 130, 246, 0.1) 0%, transparent 50%),
                    radial-gradient(circle at 70% 80%, rgba(16, 185, 129, 0.1) 0%, transparent 50%);
        pointer-events: none;
    }

    .business-header-content {
        position: relative;
        z-index: 1;
        max-width: 800px;
        margin: 0 auto;
    }

    .business-header h1 {
        font-size: 3rem;
        font-weight: 900;
        color: var(--text-primary);
        margin-bottom: 12px;
        letter-spacing: -0.03em;
        line-height: 1.1;
    }

    .business-header h2 {
        font-size: 1.375rem;
        font-weight: 600;
        color: var(--text-secondary);
        margin-bottom: 8px;
    }

    .business-header p {
        color: var(--text-muted);
        font-size: 1rem;
        max-width: 600px;
        margin: 0 auto;
    }

    /* Container */
    .container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 64px 24px;
        display: flex;
        flex-direction: column;
        gap: 80px;
    }

    /* Product Categories */
    .product-category {
        width: 100%;
    }

    .category-title {
        font-size: 2.5rem;
        font-weight: 800;
        text-align: center;
        margin-bottom: 40px;
        color: var(--text-primary);
        position: relative;
        letter-spacing: -0.025em;
    }

    .category-title::after {
        content: '';
        position: absolute;
        bottom: -12px;
        left: 50%;
        transform: translateX(-50%);
        width: 80px;
        height: 4px;
        background: var(--primary-color);
        border-radius: 2px;
    }

    .product-list {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
        gap: 32px;
        margin-top: 40px;
    }

    /* Product Cards */
    .product-card {
        background: var(--bg-card);
        border-radius: 20px;
        overflow: hidden;
        box-shadow: var(--shadow-md);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid var(--border-color);
        position: relative;
        backdrop-filter: blur(10px);
    }

    .product-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg, var(--primary-color), var(--success-color));
        transform: scaleX(0);
        transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        border-radius: 20px 20px 0 0;
    }

    .product-card:hover::before {
        transform: scaleX(1);
    }

    .product-card:hover {
        transform: translateY(-8px) scale(1.01);
        box-shadow: var(--shadow-xl);
        border-color: var(--border-hover);
    }

    .product-image {
        height: 260px;
        overflow: hidden;
        position: relative;
        background: var(--bg-secondary);
    }

    .product-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .product-card:hover .product-image img {
        transform: scale(1.08);
    }

    .product-discount-badge {
        position: absolute;
        top: 16px;
        right: 16px;
        background: var(--danger-color);
        color: white;
        padding: 8px 14px;
        border-radius: 50px;
        font-size: 0.8rem;
        font-weight: 700;
        box-shadow: var(--shadow-lg);
        z-index: 10;
        animation: bounce 2s infinite;
    }

    @keyframes bounce {
        0%, 20%, 53%, 80%, 100% { transform: translateY(0); }
        40%, 43% { transform: translateY(-8px); }
        70% { transform: translateY(-4px); }
        90% { transform: translateY(-2px); }
    }

    .product-details {
        padding: 24px;
    }

    .product-title {
        font-size: 1.375rem;
        font-weight: 700;
        margin-bottom: 12px;
        color: var(--text-primary);
        line-height: 1.3;
        letter-spacing: -0.025em;
    }

    .product-title a {
        color: inherit;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .product-title a:hover {
        color: var(--primary-color);
    }

    .product-price {
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--success-color);
        margin-bottom: 12px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .product-price .price-label {
        font-size: 0.9rem;
        font-weight: 500;
        color: var(--text-secondary);
    }

    .price-range {
        color: var(--text-secondary);
        font-weight: 500;
    }

    .product-sku {
        font-size: 0.9rem;
        color: var(--text-muted);
        margin-bottom: 12px;
        background: var(--bg-tertiary);
        padding: 6px 12px;
        border-radius: 8px;
        display: inline-block;
    }

    .product-sku strong {
        color: var(--text-secondary);
    }

    .product-description {
        color: var(--text-secondary);
        font-size: 0.95rem;
        line-height: 1.6;
        margin-bottom: 16px;
    }

    .stock-status {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 6px 16px;
        border-radius: 50px;
        font-size: 0.85rem;
        font-weight: 600;
        margin-bottom: 16px;
        background: var(--success-color);
        color: white;
        box-shadow: var(--shadow-sm);
    }

    .stock-status::before {
        content: '●';
        font-size: 0.7rem;
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.5; }
    }

    .variation-select {
        width: 100%;
        padding: 12px 16px;
        border: 2px solid var(--border-color);
        border-radius: 12px;
        background: var(--bg-secondary);
        color: var(--text-primary);
        font-size: 0.95rem;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        margin-bottom: 12px;
        appearance: none;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e");
        background-position: right 12px center;
        background-repeat: no-repeat;
        background-size: 16px;
        padding-right: 44px;
        cursor: pointer;
        font-weight: 500;
    }

    .variation-select:focus {
        outline: none;
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        background-color: var(--bg-primary);
    }

    .variation-select:hover {
        border-color: var(--primary-color);
        background-color: var(--bg-primary);
    }

    /* Footer */
    .footer {
        background: var(--bg-primary);
        color: var(--text-secondary);
        text-align: center;
        padding: 64px 24px;
        margin-top: 40px;
        border-top: 1px solid var(--border-color);
        position: relative;
    }

    .footer::before {
        content: '';
        position: absolute;
        top: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 100px;
        height: 3px;
        background: var(--primary-color);
        border-radius: 0 0 2px 2px;
    }

    .main-footer {
        font-size: 0.9rem;
        line-height: 1.6;
        max-width: 800px;
        margin: 0 auto;
    }

    .business-address {
        margin-top: 24px;
        padding-top: 24px;
        border-top: 1px solid var(--border-color);
        color: var(--text-muted);
        font-size: 0.95rem;
    }

    .business-address strong {
        color: var(--text-secondary);
        display: block;
        margin-bottom: 8px;
        font-size: 1.1rem;
    }

    .footer a {
        color: var(--primary-color);
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .footer a:hover {
        color: var(--primary-hover);
        text-decoration: underline;
    }

    /* Mobile Navigation Overlay */
    .mobile-nav-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        backdrop-filter: blur(4px);
        z-index: 999;
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s ease;
    }

    .mobile-nav-overlay.show {
        opacity: 1;
        visibility: visible;
    }

    .mobile-nav {
        position: fixed;
        top: 72px;
        left: 16px;
        right: 16px;
        background: var(--bg-primary);
        border: 1px solid var(--border-color);
        border-radius: 20px;
        padding: 24px;
        box-shadow: var(--shadow-xl);
        z-index: 1000;
        transform: translateY(-20px);
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        max-height: calc(100vh - 120px);
        overflow-y: auto;
    }

    .mobile-nav.show {
        transform: translateY(0);
        opacity: 1;
        visibility: visible;
    }

    .mobile-nav .nav-list {
        flex-direction: column;
        gap: 8px;
        background: transparent;
        padding: 0;
        border: none;
        box-shadow: none;
    }

    .mobile-nav .menu-item {
        display: block;
        padding: 16px 20px;
        border-radius: 12px;
        text-align: center;
        width: 100%;
        font-size: 1rem;
        font-weight: 600;
    }

    /* Responsive Design */
    @media (max-width: 1200px) {
        .nav-container {
            padding: 12px 20px;
            gap: 20px;
        }
        
        .nav-center {
            max-width: 600px;
        }
        
        .nav-list {
            gap: 2px;
            padding: 6px;
        }
        
        .menu-item {
            padding: 8px 14px;
            font-size: 0.85rem;
        }
    }

    @media (max-width: 1100px) {
        .nav-container {
            padding: 10px 16px;
            gap: 16px;
            min-height: 64px;
        }
        
        .navbar-brand {
            font-size: 1.25rem;
        }
        
        .navbar-brand img {
            height: 32px;
        }
        
        .nav-center {
            max-width: 500px;
        }
        
        .nav-list {
            gap: 2px;
            padding: 4px;
        }
        
        .menu-item {
            padding: 6px 12px;
            font-size: 0.8rem;
        }

        .business-header {
            padding: 32px 16px;
        }
        
        .business-header h1 {
            font-size: 2.5rem;
        }
        
        .business-header h2 {
            font-size: 1.25rem;
        }

        .product-list {
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 24px;
        }
    }
    
    @media (max-width: 1024px) {
        .product-list {
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
        }
    }

    @media (max-width: 768px) {
        .nav-container {
            padding: 12px 16px;
            gap: 16px;
        }

        .nav-center {
            display: none;
        }

        .menu-toggle {
            display: flex;
        }

        .business-header {
            padding: 40px 16px;
        }

        .business-header h1 {
            font-size: 2.25rem;
        }

        .category-title {
            font-size: 2rem;
        }

        .container {
            padding: 48px 16px;
            gap: 64px;
        }

        .product-list {
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
        }
    }

    @media (max-width: 480px) {
        .business-header h1 {
            font-size: 1.875rem;
        }

        .product-list {
            grid-template-columns: 1fr;
        }

        .mobile-nav {
            left: 12px;
            right: 12px;
            top: 68px;
        }

        .container {
            padding: 32px 12px;
        }
    }

    /* Animations */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .product-card {
        animation: fadeInUp 0.6s ease forwards;
    }

    .product-card:nth-child(2n) {
        animation-delay: 0.1s;
    }

    .product-card:nth-child(3n) {
        animation-delay: 0.2s;
    }

    /* Smooth scrolling */
    html {
        scroll-behavior: smooth;
    }

    /* Loading state */
    .loading {
        opacity: 0.7;
        pointer-events: none;
        transition: opacity 0.3s ease;
    }

    /* Custom scrollbar */
    ::-webkit-scrollbar {
        width: 8px;
    }

    ::-webkit-scrollbar-track {
        background: var(--bg-secondary);
    }

    ::-webkit-scrollbar-thumb {
        background: var(--border-color);
        border-radius: 4px;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: var(--text-muted);
    }

    /* Focus styles for accessibility */
    .theme-toggle:focus,
    .menu-toggle:focus,
    .menu-item:focus,
    .variation-select:focus {
        outline: 2px solid var(--primary-color);
        outline-offset: 2px;
    }

    /* Loading spinner fix */
    .loading-spinner {
        width: 40px;
        height: 40px;
        border: 3px solid var(--border-color);
        border-top: 3px solid var(--primary-color);
        border-radius: 50%;
        margin: 0 auto 20px;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
</style>

@php
$lightLogo = $business->light_logo;
$darkLogo = $business->dark_logo;
@endphp

<!-- Mobile Navigation Overlay -->
<div class="mobile-nav-overlay" id="mobileNavOverlay"></div>

<!-- Navigation -->
<nav class="category-nav">
    <div class="nav-container">
        <a class="navbar-brand" href="#top">
            @if(!empty($business->logo))
                <img src="{{ upload_asset('uploads/business_logos/' . $darkLogo) }}" alt="{{$business->name}}" id="navLogo">
            @else
                <span>{{$business->name}}</span>
            @endif
        </a>
        
        <div class="nav-center">
            <ul class="nav-list">
                @foreach($categories as $key => $value)
                    <li><a href="#category{{ $key }}" class="menu-item">{{ $value }}</a></li>
                @endforeach
                <li><a href="#category0" class="menu-item">Uncategorized</a></li>
            </ul>
        </div>
        
        <div class="nav-actions">
            <button class="theme-toggle" id="themeToggle" aria-label="Toggle dark mode">
                <svg class="theme-toggle-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
            </button>
            
            <button class="menu-toggle" id="menuToggle" aria-label="Toggle navigation">
                <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </div>
    </div>
</nav>

<!-- Mobile Navigation -->
<div class="mobile-nav" id="mobileNav">
    <ul class="nav-list">
        @foreach($categories as $key => $value)
            <li><a href="#category{{ $key }}" class="menu-item">{{ $value }}</a></li>
        @endforeach
        <li><a href="#category0" class="menu-item">Uncategorized</a></li>
    </ul>
</div>

<!-- Business Header -->
<header class="business-header" id="top">
    <div class="business-header-content">
        <h1>{{$business->name}}</h1>
        <h2>{{$business_location->name}}</h2>
        <p>{!! $business_location->location_address !!}</p>
    </div>
</header>

<!-- Main Content -->
<div class="container content">
    @foreach($products as $product_category)
        @php
            $category = $product_category->first()->category ?? null;
            $category_name = $category->name ?? 'Uncategorized';
            $category_id = $category->id ?? '0';
        @endphp

        <section id="category{{ $category_id }}" class="product-category">
            <h2 class="category-title">{{ $category_name }}</h2>
            <div class="product-list">
                @foreach($product_category as $product)
                    @php
                        $discount = $discounts->firstWhere('brand_id', $product->brand_id)
                            ?? $discounts->firstWhere('category_id', $product->category_id);
                        $max_price = $product->variations->max('sell_price_inc_tax');
                        $min_price = $product->variations->min('sell_price_inc_tax');
                        $stock_status = '';

                        if ($product->enable_stock == 1 && $product->type == 'single') {
                            if ($product->variation_qty <= 0) {
                                $stock_status = __('productcatalogue::lang.out_of_stock');
                            } else {
                                $stock_status = __('productcatalogue::lang.in_stock');
                            }
                        }
                    @endphp

                    <div class="product-card">
                        <div class="product-image">
                            <img src="{{$product->image_url}}" alt="{{$product->name}}" class="main-product-image">
                            @if(!empty($discount))
                                <span class="product-discount-badge">-{{ $discount->discount_amount }}%</span>
                            @endif
                        </div>
                        
                        <div class="product-details">
                            <h3 class="product-title">
                                <a href="#" class="show-product-details" 
                                   data-href="{{action([\Modules\ProductCatalogue\Http\Controllers\ProductCatalogueController::class, 'show'], [$business->id, $product->id])}}?location_id={{$business_location->id}}">
                                    {{$product->name}}
                                </a>
                            </h3>

                            <div class="product-price">
                                <span class="price-label">@lang('lang_v1.price'):</span>
                                <span class="display_currency price-display-min" data-currency_symbol="true">{{ $min_price }}</span>
                                @if($max_price != $min_price)
                                    <span class="price-range">
                                        - <span class="display_currency price-display-max" data-currency_symbol="true">{{ $max_price }}</span>
                                    </span>
                                @endif
                            </div>

                            <div class="product-sku"><strong>@lang('product.sku'):</strong> <span class="sku-display">{{ $product->sku }}</span></div>

                            @if(!empty($stock_status))
                                <div class="stock-status">{{ $stock_status }}</div>
                            @endif

                            @if(!empty($product->product_description))
                                <p class="product-description">
                                    {{ Str::limit(strip_tags($product->product_description), 120) }}
                                </p>
                            @endif

                            @if($product->type == 'variable')
                                @php
                                    $variations = $product->variations->groupBy('product_variation_id');
                                @endphp
                                @foreach($variations as $product_variation)
                                    <select class="variation-select">
                                        @foreach($product_variation as $variation)
                                            @php
                                                $variation_image_url = !empty($variation->media->first())
                                                    ? $variation->media->first()->display_url
                                                    : $product->image_url;
                                            @endphp
                                            <option
                                                value="{{ $variation->id }}"
                                                data-image_url="{{ $variation_image_url }}"
                                                data-price="{{ $variation->sell_price_inc_tax }}"
                                                data-sku="{{ $variation->sub_sku }}"
                                                data-label="{{ $variation->name }} ({{ $variation->sub_sku }})">
                                                {{ $variation->name }} ({{ $variation->sub_sku }}) - {{ $variation->sell_price_inc_tax }}
                                            </option>
                                        @endforeach
                                    </select>
                                @endforeach
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    @endforeach
</div>

<!-- Product Modal -->
<div class="modal fade product_modal" tabindex="-1" role="dialog" aria-labelledby="productModalLabel"></div>

<!-- Footer -->
<div class="footer">
    @php
        $appVersion = config('author.app_version');
    @endphp
    <footer class="main-footer no-print">
        <div>
            {{ config('app.name', 'BardPOS') }} - V{{ $appVersion }} | 
            @lang('lang_v1.copyright_text', ['year' => date('Y')])
        </div>
        <div class="business-address">
            <strong>{{$business->name}}</strong>
            {!! $business_location->location_address !!}
        </div>
    </footer>
</div>

@stop

@section('javascript')
<script type="text/javascript">
(function($) {
    $(document).ready(function() {
        // Initialize theme
        initializeTheme();
        
        // Set global currency
        __currency_symbol = $('input#__symbol').val();
        __currency_thousand_separator = $('input#__thousand').val();
        __currency_decimal_separator = $('input#__decimal').val();
        __currency_symbol_placement = $('input#__symbol_placement').val();
        __currency_precision = $('input#__precision').length > 0 ? $('input#__precision').val() : 2;
        __quantity_precision = $('input#__quantity_precision').length > 0 ? $('input#__quantity_precision').val() : 2;

        if ($('input#p_symbol').length > 0) {
            __p_currency_symbol = $('input#p_symbol').val();
            __p_currency_thousand_separator = $('input#p_thousand').val();
            __p_currency_decimal_separator = $('input#p_decimal').val();
        }

        __currency_convert_recursively($('.content'));
        
        // Format prices in select options
        formatPriceTexts();
        
        // Set active menu item based on scroll position
        updateActiveMenuItem();
    });

    // Theme functionality
    function initializeTheme() {
        const savedTheme = localStorage.getItem('theme') || 'light';
        document.documentElement.setAttribute('data-theme', savedTheme);
        updateThemeIcon(savedTheme);
        updateLogo(savedTheme);
    }

    function toggleTheme() {
        const currentTheme = document.documentElement.getAttribute('data-theme');
        const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
        
        document.documentElement.setAttribute('data-theme', newTheme);
        localStorage.setItem('theme', newTheme);
        updateThemeIcon(newTheme);
        updateLogo(newTheme);
    }

    function updateThemeIcon(theme) {
        const icon = document.querySelector('.theme-toggle-icon');
        if (theme === 'dark') {
            icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>';
        } else {
            icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>';
        }
    }

    function updateLogo(theme) {
        const logo = document.getElementById('navLogo');
        if (logo) {
            const lightLogo = '{{ $lightLogo }}';
            const darkLogo = '{{ $darkLogo }}';
            if (theme === 'dark' && lightLogo) {
                logo.src = "{{ upload_asset('uploads/business_logos/') }}/" + lightLogo;
            } else if (darkLogo) {
                logo.src = "{{ upload_asset('uploads/business_logos/') }}/" + darkLogo;
            }
        }
    }

    function formatPriceTexts() {
        $('.variation-select').each(function() {
            formatPriceText($(this));
        });
    }

    function formatPriceText($select) {
        $select.find('option').each(function() {
            const $opt = $(this);
            const price = $opt.data('price');
            if (price == null || price === '') return;

            let formatted;
            if (typeof __currency_trans_from_en === 'function' && typeof __currency_precision !== 'undefined') {
                formatted = __currency_trans_from_en(price, true);
            } else {
                const sym = (typeof __currency_symbol !== 'undefined') ? __currency_symbol : '';
                const prec = (typeof __currency_precision !== 'undefined') ? __currency_precision : 2;
                formatted = (sym ? sym + ' ' : '') + Number(price).toFixed(prec);
            }

            const baseLabel = $opt.data('label');
            if (baseLabel) {
                $opt.text(baseLabel + ' - ' + formatted);
            }
        });
    }

    function updateActiveMenuItem() {
        const sections = $('.product-category');
        const menuItems = $('.menu-item');
        
        $(window).on('scroll', function() {
            let current = '';
            const scrollPos = $(this).scrollTop() + 120;
            
            sections.each(function() {
                const top = $(this).offset().top;
                const bottom = top + $(this).outerHeight();
                
                if (scrollPos >= top && scrollPos <= bottom) {
                    current = $(this).attr('id');
                }
            });
            
            menuItems.removeClass('active');
            if (current) {
                $('.menu-item[href="#' + current + '"]').addClass('active');
            }
        });
    }

    function toggleMobileMenu() {
        const $mobileNav = $('#mobileNav');
        const $overlay = $('#mobileNavOverlay');
        const $menuToggle = $('#menuToggle');
        
        $mobileNav.toggleClass('show');
        $overlay.toggleClass('show');
        
        // Animate hamburger icon
        const icon = $menuToggle.find('svg');
        if ($mobileNav.hasClass('show')) {
            icon.html('<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>');
            document.body.style.overflow = 'hidden';
        } else {
            icon.html('<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>');
            document.body.style.overflow = '';
        }
    }

    function closeMobileMenu() {
        $('#mobileNav').removeClass('show');
        $('#mobileNavOverlay').removeClass('show');
        $('#menuToggle svg').html('<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>');
        document.body.style.overflow = '';
    }

    // Event handlers
    $('#themeToggle').on('click', toggleTheme);
    $('#menuToggle').on('click', toggleMobileMenu);
    $('#mobileNavOverlay').on('click', closeMobileMenu);

    // Smooth scrolling for menu items
    $(document).on('click', '.menu-item', function(e) {
        e.preventDefault();
        const target = $(this).attr('href');
        
        if ($(target).length) {
            // Close mobile menu
            closeMobileMenu();
            
            // Smooth scroll with offset for sticky nav
            $('html, body').animate({
                scrollTop: $(target).offset().top - 90
            }, 600, 'easeInOutCubic');
        }
    });

    // Variation select change handler
    $(document).on('change', '.variation-select', function() {
        const $selectedOption = $(this).find(':selected');
        const newImageUrl = $selectedOption.data('image_url');
        const newPrice = $selectedOption.data('price');
        const newSku = $selectedOption.data('sku');
        const $productCard = $(this).closest('.product-card');
        
        // Add loading state
        $productCard.addClass('loading');
        
        // Update image with fade effect
        const $img = $productCard.find('.product-image img');
        $img.fadeOut(200, function() {
            $(this).attr('src', newImageUrl).fadeIn(200);
        });
        
        // Update price and SKU
        $productCard.find('.price-display-min').text(newPrice);
        $productCard.find('.price-range').remove();
        $productCard.find('.sku-display').text(newSku);
        
        // Convert currency and remove loading state
        __currency_convert_recursively($productCard);
        
        setTimeout(() => {
            $productCard.removeClass('loading');
        }, 300);
    });

    // Product details modal with improved loading
    $(document).on('click', '.show-product-details', function(e) {
        e.preventDefault();
        const url = $(this).data('href');
        
        $.ajax({
            url: url,
            dataType: 'html',
            timeout: 10000, // 10 second timeout
            beforeSend: function() {
                // Show improved loading state
                $('.product_modal').html(`
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content" style="background: var(--bg-primary); border: 1px solid var(--border-color); border-radius: 20px; box-shadow: var(--shadow-xl); overflow: hidden;">
                            <div class="modal-body text-center" style="padding: 60px; color: var(--text-primary);">
                                <div class="loading-spinner"></div>
                                <h4 style="color: var(--text-primary); margin-bottom: 8px; font-weight: 600;">Loading Product Details</h4>
                                <p style="color: var(--text-secondary); margin: 0;">Please wait while we fetch the information...</p>
                            </div>
                        </div>
                    </div>
                `).modal('show');
            },
            success: function(result) {
                $('.product_modal').html(result);
                __currency_convert_recursively($('.product_modal'));
            },
            error: function(xhr, status, error) {
                let errorMessage = 'Unable to load product details. Please try again.';
                if (status === 'timeout') {
                    errorMessage = 'Request timed out. Please check your connection and try again.';
                } else if (xhr.status === 404) {
                    errorMessage = 'Product not found.';
                } else if (xhr.status >= 500) {
                    errorMessage = 'Server error. Please try again later.';
                }
                
                $('.product_modal').html(`
                    <div class="modal-dialog">
                        <div class="modal-content" style="background: var(--bg-primary); border: 1px solid var(--border-color); border-radius: 20px; box-shadow: var(--shadow-xl);">
                            <div class="modal-body text-center" style="padding: 48px; color: var(--text-primary);">
                                <div style="color: var(--danger-color); font-size: 3rem; margin-bottom: 20px;">⚠️</div>
                                <h4 style="color: var(--text-primary); margin-bottom: 12px; font-weight: 600;">Oops! Something went wrong</h4>
                                <p style="color: var(--text-secondary); margin-bottom: 24px; line-height: 1.5;">${errorMessage}</p>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal" style="padding: 12px 24px; border-radius: 12px; background: var(--primary-color); border: none; color: white; cursor: pointer; font-weight: 600; transition: all 0.3s ease;">Close</button>
                            </div>
                        </div>
                    </div>
                `);
            }
        });
    });

    // Enhanced scroll effects
    let lastScrollTop = 0;
    $(window).scroll(function() {
        const scrollTop = $(this).scrollTop();
        const nav = $('.category-nav');
        
        // Add shadow to nav when scrolling
        if (scrollTop > 20) {
            nav.css({
                'box-shadow': 'var(--shadow-lg)',
                'background': 'var(--glass-bg)'
            });
        } else {
            nav.css({
                'box-shadow': 'var(--shadow-sm)',
                'background': 'var(--glass-bg)'
            });
        }
        
        lastScrollTop = scrollTop;
    });

    // Close mobile menu when window is resized to desktop
    $(window).on('resize', function() {
        if ($(window).width() > 768) {
            closeMobileMenu();
        }
    });

    // Add intersection observer for animations
    if ('IntersectionObserver' in window) {
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.animationPlayState = 'running';
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);

        // Observe product cards
        $('.product-card').each(function() {
            this.style.animationPlayState = 'paused';
            observer.observe(this);
        });
    }

    // Add easing function for smooth scrolling
    $.easing.easeInOutCubic = function(x, t, b, c, d) {
        if ((t /= d / 2) < 1) return c / 2 * t * t * t + b;
        return c / 2 * ((t -= 2) * t * t + 2) + b;
    };

    // Dynamic mutation observer for new variation selects
    const observer = new MutationObserver(function(mutations) {
        mutations.forEach(function(mutation) {
            $(mutation.addedNodes).find('.variation-select').each(function() {
                formatPriceText($(this));
            });
        });
    });
    
    observer.observe(document.body, { 
        childList: true, 
        subtree: true 
    });

    // Add keyboard navigation support
    $(document).on('keydown', function(e) {
        // ESC key closes mobile menu and modals
        if (e.keyCode === 27) {
            closeMobileMenu();
            $('.product_modal').modal('hide');
        }
    });

    // Prevent body scroll when mobile menu is open
    $(document).on('touchmove', function(e) {
        if ($('#mobileNav').hasClass('show')) {
            e.preventDefault();
        }
    });

    // Add loading states for images
    $('.product-image img').on('load', function() {
        $(this).closest('.product-card').removeClass('loading');
    }).on('error', function() {
        // Handle image load errors with a clean placeholder
        $(this).attr('src', 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMzQwIiBoZWlnaHQ9IjI2MCIgdmlld0JveD0iMCAwIDM0MCAyNjAiIGZpbGw9Im5vbmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjxyZWN0IHdpZHRoPSIzNDAiIGhlaWdodD0iMjYwIiBmaWxsPSIjRjFGNUY5Ii8+CjxjaXJjbGUgY3g9IjE3MCIgY3k9IjEwMCIgcj0iMzAiIGZpbGw9IiM5NEEzQjgiLz4KPHBhdGggZD0iTTI2MCAyMDBIODBWMTYwTDEyMCAxMjBMMTcwIDE3MEwyMjAgMTIwTDI2MCAxNjBWMjAwWiIgZmlsbD0iIzk0QTNCOCIvPgo8dGV4dCB4PSIxNzAiIHk9IjIzNSIgdGV4dC1hbmNob3I9Im1pZGRsZSIgZmlsbD0iIzY0NzQ4QiIgZm9udC1zaXplPSIxNCIgZm9udC1mYW1pbHk9Ii1hcHBsZS1zeXN0ZW0sIEJsaW5rTWFjU3lzdGVtRm9udCwgU2Vnb2UgVUksIFJvYm90bywgc2Fucy1zZXJpZiI+SW1hZ2UgTm90IEF2YWlsYWJsZTwvdGV4dD4KPHN2Zz4=');
    });

})(jQuery);
</script>
@endsection