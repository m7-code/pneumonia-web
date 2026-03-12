@extends('layouts.app')

@section('title', 'About - PneumoFusion')

@push('styles')
<style>

.about-container {
    width: 100%;
    max-width: 1100px;
    margin: 0 auto;
    padding: 20px;
}

/* HEADER */
.about-header {
    text-align: center;
    margin-bottom: 50px;
}

.about-title {
    font-size: 3rem;
    font-weight: 800;
    margin-bottom: 15px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.about-subtitle {
    font-size: 1.3rem;
    color: var(--text);
    opacity: 0.8;
}

/* MAIN SECTION CARD STYLE */
.about-section {
    background: var(--card);
    backdrop-filter: blur(12px);
    border-radius: 20px;
    border: 1px solid var(--border);
    padding: 40px;
    margin-bottom: 30px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.08);
}

/* TITLES */
.section-title {
    font-size: 1.8rem;
    font-weight: 700;
    margin-bottom: 20px;
    color: var(--text);
    display: flex;
    align-items: center;
    gap: 12px;
}

.section-content {
    font-size: 1.05rem;
    line-height: 1.8;
    color: var(--text);
    opacity: 0.85;
}

/* FEATURES GRID */
.features-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 25px;
    margin-top: 30px;
}

.feature-card {
    background: rgba(102, 126, 234, 0.08);
    padding: 25px;
    border-radius: 15px;
    border: 1px solid var(--border);
}

.feature-icon {
    margin-bottom: 15px;
    display: flex;
    align-items: center;
    justify-content: flex-start;
}

.feature-title {
    font-size: 1.2rem;
    font-weight: 600;
    margin-bottom: 10px;
    color: var(--text);
}

.feature-text {
    font-size: 0.95rem;
    color: var(--text);
    opacity: 0.8;
    line-height: 1.6;
}

/* STATS GRID */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
    margin-top: 30px;
}

.stat-card {
    text-align: center;
    padding: 30px 20px;
    background: rgba(102, 126, 234, 0.08);
    border-radius: 15px;
    border: 1px solid var(--border);
}

.stat-number {
    font-size: 2.5rem;
    font-weight: 800;
    color: #667eea;
    margin-bottom: 10px;
}

.stat-label {
    font-size: 1rem;
    color: var(--text);
    opacity: 0.8;
}

/* CTA SECTION */
.cta-section {
    text-align: center;
    padding: 50px 40px;
    background: linear-gradient(
        135deg,
        rgba(102, 126, 234, 0.1) 0%,
        rgba(118, 75, 162, 0.1) 100%
    );
    border-radius: 20px;
    margin-top: 40px;
}

.cta-title {
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 15px;
    color: var(--text);
}

.cta-text {
    font-size: 1.1rem;
    margin-bottom: 30px;
    color: var(--text);
    opacity: 0.8;
}

.cta-button {
    display: inline-block;
    padding: 16px 45px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white !important;
    text-decoration: none;
    border-radius: 50px;
    font-size: 1.1rem;
    font-weight: 600;
    transition: 0.3s ease;
    box-shadow: 0 5px 20px rgba(102, 126, 234, 0.4);
}

.cta-button:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 30px rgba(102, 126, 234, 0.6);
}

/* MOBILE OPTIMIZATION */
@media (max-width: 768px) {

    .about-title {
        font-size: 2.2rem;
    }

    .about-subtitle {
        font-size: 1.1rem;
    }

    .features-grid {
        grid-template-columns: 1fr;
        gap: 20px;
    }

    .stats-grid {
        grid-template-columns: 1fr;
        gap: 15px;
    }

    .about-section {
        padding: 25px;
    }

    .cta-section {
        padding: 35px 25px;
    }
}

</style>
@endpush

@section('content')
<div class="about-container">

    <div class="about-header">
        <h1 class="about-title">About PneumoFusion</h1>
        <p class="about-subtitle">
            Revolutionizing Pneumonia Detection with AI Technology
        </p>
    </div>

    <!-- MISSION -->
    <div class="about-section">
        <h2 class="section-title">
            <!-- Target / Mission icon -->
            <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect width="32" height="32" rx="8" fill="url(#missionGrad)"/>
                <circle cx="16" cy="16" r="8" stroke="white" stroke-width="2"/>
                <circle cx="16" cy="16" r="4" stroke="white" stroke-width="2"/>
                <circle cx="16" cy="16" r="1.5" fill="white"/>
                <defs>
                    <linearGradient id="missionGrad" x1="0" y1="0" x2="32" y2="32" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#667eea"/>
                        <stop offset="1" stop-color="#764ba2"/>
                    </linearGradient>
                </defs>
            </svg>
            Our Mission
        </h2>
        <p class="section-content">
            PneumoFusion is dedicated to making healthcare more accessible and efficient
            through artificial intelligence technology for fast and reliable pneumonia detection.
        </p>
    </div>

    <!-- TECHNOLOGY -->
    <div class="about-section">
        <h2 class="section-title">
            <!-- Microscope / Tech icon -->
            <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect width="32" height="32" rx="8" fill="url(#techGrad)"/>
                <rect x="13" y="7" width="6" height="10" rx="3" stroke="white" stroke-width="2"/>
                <path d="M10 17a6 6 0 0 0 12 0" stroke="white" stroke-width="2" stroke-linecap="round"/>
                <line x1="16" y1="23" x2="16" y2="26" stroke="white" stroke-width="2" stroke-linecap="round"/>
                <line x1="12" y1="26" x2="20" y2="26" stroke="white" stroke-width="2" stroke-linecap="round"/>
                <defs>
                    <linearGradient id="techGrad" x1="0" y1="0" x2="32" y2="32" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#667eea"/>
                        <stop offset="1" stop-color="#764ba2"/>
                    </linearGradient>
                </defs>
            </svg>
            Our Technology
        </h2>
        <p class="section-content">
            Built on advanced deep learning architecture and trained on thousands of chest X-ray images.
        </p>

        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-number">95%+</div>
                <div class="stat-label">Accuracy Rate</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">&lt;5s</div>
                <div class="stat-label">Analysis Time</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">24/7</div>
                <div class="stat-label">Availability</div>
            </div>
        </div>
    </div>

    <!-- KEY FEATURES -->
    <div class="about-section">
        <h2 class="section-title">
            <!-- Star / sparkle icon -->
            <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect width="32" height="32" rx="8" fill="url(#featGrad)"/>
                <path d="M16 8l2.2 5.4L24 14.6l-4 3.9.9 5.5L16 21.4l-4.9 2.6.9-5.5-4-3.9 5.8-1.2L16 8z" stroke="white" stroke-width="2" stroke-linejoin="round" fill="none"/>
                <defs>
                    <linearGradient id="featGrad" x1="0" y1="0" x2="32" y2="32" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#667eea"/>
                        <stop offset="1" stop-color="#764ba2"/>
                    </linearGradient>
                </defs>
            </svg>
            Key Features
        </h2>

        <div class="features-grid">

            <!-- Deep Learning AI -->
            <div class="feature-card">
                <div class="feature-icon">
                    <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect width="48" height="48" rx="12" fill="url(#aiGrad)"/>
                        <circle cx="24" cy="20" r="6" stroke="white" stroke-width="2"/>
                        <path d="M14 36c0-5.5 4.5-10 10-10s10 4.5 10 10" stroke="white" stroke-width="2" stroke-linecap="round"/>
                        <circle cx="24" cy="20" r="2" fill="white"/>
                        <defs>
                            <linearGradient id="aiGrad" x1="0" y1="0" x2="48" y2="48" gradientUnits="userSpaceOnUse">
                                <stop stop-color="#667eea"/>
                                <stop offset="1" stop-color="#764ba2"/>
                            </linearGradient>
                        </defs>
                    </svg>
                </div>
                <h3 class="feature-title">Deep Learning AI</h3>
                <p class="feature-text">Advanced neural network for medical imaging</p>
            </div>

            <!-- Instant Results -->
            <div class="feature-card">
                <div class="feature-icon">
                    <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect width="48" height="48" rx="12" fill="url(#flashGrad)"/>
                        <path d="M27 12L17 26h10l-6 10 14-16H25l2-8z" stroke="white" stroke-width="2" stroke-linejoin="round" fill="none"/>
                        <defs>
                            <linearGradient id="flashGrad" x1="0" y1="0" x2="48" y2="48" gradientUnits="userSpaceOnUse">
                                <stop stop-color="#667eea"/>
                                <stop offset="1" stop-color="#764ba2"/>
                            </linearGradient>
                        </defs>
                    </svg>
                </div>
                <h3 class="feature-title">Instant Results</h3>
                <p class="feature-text">Get analysis and confidence scores in seconds</p>
            </div>

            <!-- Secure & Private -->
            <div class="feature-card">
                <div class="feature-icon">
                    <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect width="48" height="48" rx="12" fill="url(#lockGrad)"/>
                        <rect x="15" y="22" width="18" height="14" rx="3" stroke="white" stroke-width="2"/>
                        <path d="M19 22v-4a5 5 0 0 1 10 0v4" stroke="white" stroke-width="2" stroke-linecap="round"/>
                        <circle cx="24" cy="29" r="2" fill="white"/>
                        <defs>
                            <linearGradient id="lockGrad" x1="0" y1="0" x2="48" y2="48" gradientUnits="userSpaceOnUse">
                                <stop stop-color="#667eea"/>
                                <stop offset="1" stop-color="#764ba2"/>
                            </linearGradient>
                        </defs>
                    </svg>
                </div>
                <h3 class="feature-title">Secure & Private</h3>
                <p class="feature-text">Encrypted processing with privacy protection</p>
            </div>

            <!-- Detailed Reports -->
            <div class="feature-card">
                <div class="feature-icon">
                    <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect width="48" height="48" rx="12" fill="url(#chartGrad)"/>
                        <rect x="13" y="30" width="4" height="8" rx="1" fill="white"/>
                        <rect x="22" y="22" width="4" height="16" rx="1" fill="white"/>
                        <rect x="31" y="16" width="4" height="22" rx="1" fill="white"/>
                        <path d="M13 24l9-8 9-4" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <defs>
                            <linearGradient id="chartGrad" x1="0" y1="0" x2="48" y2="48" gradientUnits="userSpaceOnUse">
                                <stop stop-color="#667eea"/>
                                <stop offset="1" stop-color="#764ba2"/>
                            </linearGradient>
                        </defs>
                    </svg>
                </div>
                <h3 class="feature-title">Detailed Reports</h3>
                <p class="feature-text">Comprehensive diagnostic metrics</p>
            </div>

        </div>
    </div>

    <!-- CTA -->
    <div class="cta-section">
        <h2 class="cta-title">Ready to Try PneumoFusion?</h2>
        <p class="cta-text">
            Experience AI-powered medical diagnostics
        </p>

        @auth
            <a href="{{ route('results') }}" class="cta-button">
                Start Analysis →
            </a>
        @else
            <a href="{{ route('register') }}" class="cta-button">
                Get Started Free →
            </a>
        @endauth
    </div>

</div>
@endsection