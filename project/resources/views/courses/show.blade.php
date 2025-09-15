@extends('layouts.app')

@section('title', $course->title . ' - SkillHub Professional Learning')
@section('description', 'Master ' . $course->title . ' with our comprehensive learning experience featuring interactive materials, assessments, and expert guidance.')

@section('styles')
<style>
    /* Ultra-Professional Course Details Styling */
    :root {
        --primary-gradient: linear-gradient(135deg, #2563eb, #10b981);
        --secondary-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        --success-gradient: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        --warning-gradient: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
        --premium-gold: linear-gradient(135deg, #ffd89b 0%, #19547b 100%);
        --glass-bg: rgba(255, 255, 255, 0.1);
        --glass-border: rgba(255, 255, 255, 0.2);
        --dark-glass: rgba(0, 0, 0, 0.1);
        --text-primary: #1a202c;
        --text-secondary: #4a5568;
        --text-light: #718096;
        --surface-white: #ffffff;
        --surface-light: #f7fafc;
        --surface-gray: #edf2f7;
        --border-light: rgba(0, 0, 0, 0.06);
        --shadow-subtle: 0 1px 3px rgba(0, 0, 0, 0.05);
        --shadow-medium: 0 4px 12px rgba(0, 0, 0, 0.15);
        --shadow-large: 0 8px 25px rgba(0, 0, 0, 0.2);
        --shadow-premium: 0 20px 40px rgba(0, 0, 0, 0.1);
        --border-radius: 20px;
        --border-radius-large: 24px;
        --animation-speed: 0.4s;
        --animation-curve: cubic-bezier(0.4, 0, 0.2, 1);
    }

    * {
        box-sizing: border-box;
    }

    body {
        margin: 0;
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        line-height: 1.6;
        color: var(--text-primary);
        background: #f8fafc;
    }

    /* Premium Page Layout */
    .course-page {
        min-height: 100vh;
        background:linear-gradient(135deg, var(--primary-color), var(--accent-color));
        position: relative;
        overflow-x: hidden;
    }

    .course-page::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: 
            radial-gradient(circle at 20% 80%, rgba(120, 119, 198, 0.3) 0%, transparent 50%),
            radial-gradient(circle at 80% 20%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
            radial-gradient(circle at 40% 40%, rgba(120, 119, 198, 0.2) 0%, transparent 50%);
        z-index: 1;
    }

    /* Premium Hero Section */
    .hero-section {
        position: relative;
        z-index: 2;
        padding: 6rem 0 4rem;
        text-align: center;
        color: white;
    }

    .hero-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 2rem;
    }

    .course-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: var(--glass-bg);
        border: 1px solid var(--glass-border);
        backdrop-filter: blur(20px);
        padding: 0.75rem 1.5rem;
        border-radius: 50px;
        font-size: 0.875rem;
        font-weight: 600;
        margin-bottom: 2rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .hero-title {
        font-size: clamp(2.5rem, 5vw, 4rem);
        font-weight: 800;
        line-height: 1.1;
        margin-bottom: 1.5rem;
        background: linear-gradient(135deg, #ffffff 0%, #f0f8ff 100%);
        background-clip: text;
        text-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
    }

    .hero-description {
        font-size: 1.25rem;
        max-width: 600px;
        margin: 0 auto 3rem;
        opacity: 0.95;
        line-height: 1.7;
    }

    .hero-stats {
        display: flex;
        justify-content: center;
        gap: 3rem;
        flex-wrap: wrap;
        margin-bottom: 3rem;
    }

    .stat-item {
        text-align: center;
        background: var(--glass-bg);
        backdrop-filter: blur(20px);
        border: 1px solid var(--glass-border);
        padding: 1.5rem 2rem;
        border-radius: var(--border-radius);
        min-width: 140px;
        transition: all 0.4s var(--animation-curve);
    }

    .stat-item:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 32px rgba(255, 255, 255, 0.2);
    }

    .stat-number {
        display: block;
        font-size: 1.75rem;
        font-weight: 700;
        margin-bottom: 0.25rem;
    }

    .stat-label {
        font-size: 0.875rem;
        opacity: 0.8;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    /* Hero Rating Section Styles */
    .rating-stat {
        background: var(--glass-bg);
        backdrop-filter: blur(20px);
        border: 1px solid var(--glass-border);
        position: relative;
        overflow: hidden;
        transition: all 0.4s var(--animation-curve);
    }

    .rating-stat::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #fbbf24, #f59e0b);
        transform: scaleX(0);
        transition: transform 0.4s var(--animation-curve);
    }

    .rating-stat:hover::before {
        transform: scaleX(1);
    }

    .rating-stat:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 32px rgba(251, 191, 36, 0.3);
    }

    .stat-rating-display {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 0.5rem;
    }

    .star-rating-hero {
        display: flex;
        gap: 3px;
        align-items: center;
        margin-bottom: 0.5rem;
    }

    .star-rating-hero .star {
        font-size: 1.5rem;
        line-height: 1;
        transition: all 0.3s ease;
        filter: drop-shadow(0 2px 4px rgba(0,0,0,0.2));
    }

    .star-rating-hero .star-full {
        color: #fbbf24;
        text-shadow: 0 2px 4px rgba(251, 191, 36, 0.6);
        animation: starPulse 4s ease-in-out infinite;
    }

    .star-rating-hero .star-empty {
        color: rgba(255, 255, 255, 0.4);
    }

    .star-rating-hero .star-half {
        position: relative;
        display: inline-block;
        color: rgba(255, 255, 255, 0.4);
    }

    .star-rating-hero .star-half::after {
        content: '★';
        color: #fbbf24;
        text-shadow: 0 2px 4px rgba(251, 191, 36, 0.6);
        position: absolute;
        left: 0;
        top: 0;
        width: 50%;
        overflow: hidden;
    }

    @keyframes starPulse {
        0%, 100% { 
            transform: scale(1);
            filter: brightness(1) drop-shadow(0 2px 4px rgba(0,0,0,0.2));
        }
        50% { 
            transform: scale(1.05);
            filter: brightness(1.1) drop-shadow(0 4px 8px rgba(251, 191, 36, 0.4));
        }
    }

    .rating-number {
        font-size: 1.75rem !important;
        font-weight: 800;
        background: linear-gradient(135deg, #fbbf24, #f59e0b);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    /* Rate Course Button in Hero */
    .rate-action {
        background: var(--glass-bg);
        backdrop-filter: blur(20px);
        border: 1px solid var(--glass-border);
        position: relative;
        overflow: hidden;
        cursor: pointer;
        transition: all 0.4s var(--animation-curve);
    }

    .rate-action::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--primary-color), var(--accent-color));
        transform: scaleX(0);
        transition: transform 0.4s var(--animation-curve);
    }

    .rate-action:hover::before {
        transform: scaleX(1);
    }

    .rate-action:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 32px rgba(37, 99, 235, 0.3);
    }

    .btn-rate-hero {
        background: none;
        border: none;
        color: white;
        cursor: pointer;
        width: 100%;
        padding: 0;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 0.75rem;
        transition: all 0.3s ease;
        text-decoration: none;
    }

    .btn-rate-hero:hover {
        transform: scale(1.05);
    }

    .btn-icon {
        width: 48px;
        height: 48px;
        background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
    }

    .btn-rate-hero:hover .btn-icon {
        transform: rotate(15deg) scale(1.1);
        box-shadow: 0 6px 20px rgba(37, 99, 235, 0.5);
    }

    .btn-text {
        font-size: 1rem;
        font-weight: 600;
        text-align: center;
        line-height: 1.2;
    }

    /* Guest Action Styles */
    .guest-action {
        background: var(--glass-bg);
        backdrop-filter: blur(20px);
        border: 1px solid var(--glass-border);
        position: relative;
        overflow: hidden;
        transition: all 0.4s var(--animation-curve);
    }

    .guest-action::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #10b981, #059669);
        transform: scaleX(0);
        transition: transform 0.4s var(--animation-curve);
    }

    .guest-action:hover::before {
        transform: scaleX(1);
    }

    .guest-action:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 32px rgba(16, 185, 129, 0.3);
    }

    .guest-login .btn-icon {
        background: linear-gradient(135deg, #10b981, #059669);
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
    }

    .guest-login:hover .btn-icon {
        box-shadow: 0 6px 20px rgba(16, 185, 129, 0.5);
    }

    /* Enhanced Rating Popup for Hero */
    .hero-rating-popup {
        max-width: 500px;
        background: white;
        border-radius: var(--border-radius-large);
        overflow: hidden;
        box-shadow: var(--shadow-premium);
        border: 1px solid var(--border-light);
    }

    .popup-header {
    background: linear-gradient(135deg, #2563eb, #10b981);
    color: white;
    padding: 3rem 2rem 2rem;
    text-align: center;
    position: relative;
    overflow: hidden;
}

.popup-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: 
        radial-gradient(circle at 20% 80%, rgba(120, 119, 198, 0.3) 0%, transparent 50%),
        radial-gradient(circle at 80% 20%, rgba(255, 255, 255, 0.1) 0%, transparent 50%);
    z-index: 1;
}

.popup-header > * {
    position: relative;
    z-index: 2;
}


    .popup-icon {
    width: 64px;
    height: 64px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.5rem;
    font-size: 1.75rem;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.3);
}

    .hero-rating-form .rating-title {
    margin: 0 0 0.75rem 0;
    font-size: 1.5rem;
    font-weight: 700;
    color: white;
    line-height: 1.3;
}

.rating-subtitle {
    margin: 0;
    opacity: 0.95;
    font-size: 1rem;
    line-height: 1.5;
}

/* FIXED: Rating Stars - Properly centered and functional */
.hero-rating-form .rating-stars {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 0.75rem;
    margin: 2.5rem 0 1.5rem 0;
    padding: 0 2rem;
    flex-direction: row-reverse;
}

    .hero-rating-form .rating-stars input[type="radio"] {
        display: none;
    }

    .hero-rating-form .rating-stars label {
    font-size: 3.5rem;
    color: #e5e7eb;
    cursor: pointer;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    filter: drop-shadow(0 4px 12px rgba(0,0,0,0.15));
    position: relative;
    line-height: 1;
    user-select: none;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 60px;
    height: 60px;
}

    .hero-rating-form .rating-stars label:hover {
    transform: scale(1.15);
    color: #fbbf24 !important;
    filter: drop-shadow(0 6px 16px rgba(251, 191, 36, 0.4));
}

    .hero-rating-form .rating-stars input[type="radio"]:checked + label {
    color: #fbbf24 !important;
    text-shadow: 0 4px 12px rgba(251, 191, 36, 0.8);
    transform: scale(1.1);
}

.hero-rating-form .rating-stars label:hover ~ label {
    color: #fbbf24 !important;
    text-shadow: 0 4px 12px rgba(251, 191, 36, 0.8);
    transform: scale(1.1);
}

/* FIXED: Rating Labels - Properly spaced */
.rating-labels {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0 2rem 2rem 2rem;
    font-size: 0.875rem;
    color: #6b7280;
    gap: 0.5rem;
}

.rating-label {
    opacity: 0.6;
    transition: all 0.3s ease;
    font-weight: 500;
    text-align: center;
    flex: 1;
    padding: 0.5rem 0.25rem;
    border-radius: 8px;
}

    .rating-label.active {
    opacity: 1;
    color: #2563eb;
    font-weight: 600;
    background: rgba(37, 99, 235, 0.1);
    border: 1px solid rgba(37, 99, 235, 0.2);
    transform: scale(1.05);
}

    .hero-submit-btn {
    margin: 0 2rem 2rem 2rem;
    width: calc(100% - 4rem);
    padding: 1rem 2rem;
    font-size: 1.125rem;
    font-weight: 600;
    border-radius: 12px;
    background: linear-gradient(135deg, #2563eb, #10b981);
    transition: all 0.3s ease;
    border: none;
    color: white;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.75rem;
    box-shadow: 0 4px 16px rgba(37, 99, 235, 0.3);
    position: relative;
    overflow: hidden;
}

.hero-submit-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
    transition: left 0.6s ease;
}

.hero-submit-btn:hover::before {
    left: 100%;
}

    .hero-submit-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(37, 99, 235, 0.4);
    }

    .hero-submit-btn:active {
    transform: translateY(-1px);
    box-shadow: 0 4px 16px rgba(37, 99, 235, 0.3);
}

.hero-submit-btn i {
    font-size: 1.125rem;
    transition: transform 0.3s ease;
}

.hero-submit-btn:hover i {
    transform: rotate(15deg) scale(1.1);
}

/* Loading State */
.hero-submit-btn:disabled {
    opacity: 0.8;
    cursor: not-allowed;
    transform: none !important;
}

.hero-submit-btn:disabled:hover {
    transform: none !important;
    box-shadow: 0 4px 16px rgba(37, 99, 235, 0.3) !important;
}

    /* Success Animation */
    @keyframes ratingSuccess {
        0% { transform: scale(1); }
        50% { transform: scale(1.05); }
        100% { transform: scale(1); }
    }

    .rating-stat.updated {
        animation: ratingSuccess 0.6s ease;
    }

    .rating-stat.updated .star-rating-hero .star-full {
        animation: starCelebration 1s ease;
    }

    @keyframes starCelebration {
        0%, 100% { transform: scale(1) rotate(0deg); }
        25% { transform: scale(1.2) rotate(5deg); }
        75% { transform: scale(1.2) rotate(-5deg); }
    }

    /* Premium Content Container */
    .content-wrapper {
        position: relative;
        z-index: 2;
        background: var(--surface-light);
        border-radius: 40px 40px 0 0;
        margin-top: -2rem;
        padding: 4rem 0 2rem;
        box-shadow: 0 -10px 40px rgba(0, 0, 0, 0.1);
    }

    .content-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 2rem;
    }

    /* Premium Section Cards */
    .content-section {
        background: var(--surface-white);
        border-radius: var(--border-radius-large);
        margin-bottom: 2rem;
        box-shadow: var(--shadow-medium);
        border: 1px solid var(--border-light);
        overflow: hidden;
        transition: all var(--animation-speed) var(--animation-curve);
    }

    .content-section:hover {
        transform: translateY(-4px);
        box-shadow: var(--shadow-premium);
    }

    .section-header {
        background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
        color: white;
        padding: 2rem 2.5rem;
        cursor: pointer;
        transition: all var(--animation-speed) var(--animation-curve);
        position: relative;
        overflow: hidden;
    }

    .section-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: left 0.6s ease;
    }

    .section-header:hover::before {
        left: 100%;
    }

    .section-header:hover {
        background: var(--primary-color);
    }

    .section-title {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin: 0;
        font-size: 1.5rem;
        font-weight: 700;
    }

    .section-icon-wrapper {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .section-icon {
        width: 28px;
        height: 28px;
        padding: 8px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .toggle-indicator {
        background: rgba(255, 255, 255, 0.2);
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
        font-weight: 700;
        transition: all var(--animation-speed) var(--animation-curve);
    }

    .section-content {
        display: none;
        padding: 3rem 2.5rem;
        background: var(--surface-white);
        animation: slideDown var(--animation-speed) var(--animation-curve);
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Premium Chapter Cards */
    .chapter-list {
        display: grid;
        gap: 1.5rem;
    }

    .chapter-item {
        background: var(--surface-light);
        border-radius: var(--border-radius);
        border: 1px solid var(--border-light);
        overflow: hidden;
        transition: all var(--animation-speed) var(--animation-curve);
    }

    .chapter-item:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-medium);
    }

    .chapter-header {
        background: linear-gradient(135deg, var(--surface-white) 0%, var(--surface-light) 100%);
        padding: 1.5rem 2rem;
        cursor: pointer;
        border: none;
        width: 100%;
        text-align: left;
        display: flex;
        align-items: center;
        justify-content: space-between;
        transition: all var(--animation-speed) var(--animation-curve);
        border-bottom: 1px solid var(--border-light);
    }

    .chapter-header:hover {
        background: linear-gradient(135deg, #f7fafc 0%, #edf2f7 100%);
    }

    .chapter-title {
        display: flex;
        align-items: center;
        gap: 1rem;
        font-size: 1.125rem;
        font-weight: 600;
        color: var(--text-primary);
    }

    .chapter-number {
        background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
        color: white;
        width: 32px;
        height: 32px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.875rem;
        font-weight: 700;
    }

    .chapter-content {
        display: none;
        padding: 2rem;
        background: var(--surface-white);
    }

    .chapter-description {
        color: var(--text-secondary);
        line-height: 1.7;
        margin-bottom: 2rem;
        font-size: 1rem;
    }

    /* Premium Resource Cards */
    .resources-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
        gap: 1.5rem;
        margin-top: 2rem;
    }

    .resource-card {
        background: var(--surface-white);
        border-radius: var(--border-radius);
        padding: 2rem;
        border: 1px solid var(--border-light);
        transition: all var(--animation-speed) var(--animation-curve);
        position: relative;
        overflow: hidden;
    }

    .resource-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: var(--warning-gradient);
        transform: scaleX(0);
        transition: transform var(--animation-speed) var(--animation-curve);
    }

    .resource-card:hover::before {
        transform: scaleX(1);
    }

    .resource-card:hover {
        transform: translateY(-4px);
        box-shadow: var(--shadow-large);
    }

    .resource-header {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 1.5rem;
    }

    .resource-icon {
        width: 48px;
        height: 48px;
        background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.25rem;
    }

    .resource-info h4 {
        margin: 0 0 0.25rem 0;
        font-size: 1.125rem;
        font-weight: 600;
        color: var(--text-primary);
    }

    .resource-meta {
        font-size: 0.875rem;
        color: var(--text-light);
    }

    .resource-action {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
        color: white;
        padding: 0.75rem 1.5rem;
        border-radius: 12px;
        text-decoration: none;
        font-weight: 600;
        font-size: 0.9rem;
        transition: all var(--animation-speed) var(--animation-curve);
        border: none;
        cursor: pointer;
    }

    .resource-action:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-medium);
    }

    /* Premium Activity Cards */
    .activities-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
        gap: 2rem;
    }

    .activity-card {
        background: var(--surface-white);
        border-radius: var(--border-radius-large);
        overflow: hidden;
        box-shadow: var(--shadow-medium);
        border: 1px solid var(--border-light);
        transition: all var(--animation-speed) var(--animation-curve);
        position: relative;
    }

    .activity-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 6px;
        background: var(--success-gradient);
        transform: scaleX(0);
        transition: transform var(--animation-speed) var(--animation-curve);
    }

    .activity-card.quiz::before {
        background: var(--warning-gradient);
    }

    .activity-card:hover::before {
        transform: scaleX(1);
    }

    .activity-card:hover {
        transform: translateY(-8px);
        box-shadow: var(--shadow-premium);
    }

    .activity-header {
        background: var(--warning-gradient);
        color: white;
        padding: 2rem;
        text-align: center;
        position: relative;
    }

    .activity-card.quiz .activity-header {
        background: var(--warning-gradient);
    }

    .activity-icon {
        width: 64px;
        height: 64px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
        font-size: 1.75rem;
    }

    .activity-body {
        padding: 2rem;
    }

    .activity-title {
        font-size: 1.25rem;
        font-weight: 700;
        margin-bottom: 1rem;
        color: var(--text-primary);
    }

    .activity-description {
        color: var(--text-secondary);
        line-height: 1.6;
        margin-bottom: 2rem;
    }

    .activity-meta {
        display: flex;
        gap: 1rem;
        margin-bottom: 2rem;
        font-size: 0.875rem;
        color: var(--text-light);
    }

    .meta-item {
        display: flex;
        align-items: center;
        gap: 0.25rem;
    }

    /* Premium Video Section */
    .video-section {
        background: var(--surface-white);
        border-radius: var(--border-radius-large);
        overflow: hidden;
        box-shadow: var(--shadow-large);
        border: 1px solid var(--border-light);
    }

    .video-container {
        position: relative;
        padding-bottom: 56.25%;
        height: 0;
        background: #000;
    }

    .video-container iframe {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        border: none;
    }

    .video-footer {
        padding: 2rem;
        background: linear-gradient(135deg, var(--surface-light) 0%, var(--surface-white) 100%);
        border-top: 1px solid var(--border-light);
    }

    .external-link {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        color: var(--text-primary);
        font-weight: 600;
        text-decoration: none;
        transition: all var(--animation-speed) var(--animation-curve);
    }

    .external-link:hover {
        color: #1ac77f;
        transform: translateX(4px);
    }

    /* Premium Navigation */
    .navigation-section {
        text-align: center;
        padding: 4rem 0;
    }

    .back-button {
        display: inline-flex;
        align-items: center;
        gap: 0.75rem;
        background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
        color: white;
        padding: 1rem 2rem;
        border-radius: 50px;
        text-decoration: none;
        font-weight: 600;
        font-size: 1.1rem;
        transition: all var(--animation-speed) var(--animation-curve);
        box-shadow: var(--shadow-medium);
        border: none;
        cursor: pointer;
        position: relative;
        overflow: hidden;
    }

    .back-button::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
        transition: left 0.6s ease;
    }

    .back-button:hover::before {
        left: 100%;
    }

    .back-button:hover {
        transform: translateY(-3px);
        box-shadow: var(--shadow-large);
    }

    /* No Content State */
    .no-content {
        text-align: center;
        padding: 4rem 2rem;
        color: var(--text-light);
    }

    .no-content-icon {
        width: 80px;
        height: 80px;
        background: var(--surface-gray);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        font-size: 2rem;
        color: var(--text-light);
    }

    .no-content h3 {
        margin-bottom: 0.5rem;
        color: var(--text-secondary);
    }

    /* Rating Overlay */
    .rating-overlay {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.6);
    backdrop-filter: blur(8px);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 2000;
    opacity: 1;
    transition: all 0.3s ease;
    padding: 1rem;
}

.rating-overlay.hidden {
    opacity: 0;
    visibility: hidden;
    pointer-events: none;
}

/* FIXED: Rating Popup Container */
.rating-popup {
    background: white;
    border-radius: 20px;
    max-width: 500px;
    width: 100%;
    position: relative;
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    transform: scale(1);
    transition: transform 0.3s ease;
    overflow: hidden;
}

.rating-overlay.hidden .rating-popup {
    transform: scale(0.9);
}

/* FIXED: Close Button - Now properly positioned */
.close-rating {
    position: absolute;
    top: 1.5rem;
    right: 1.5rem;
    background: rgba(255, 255, 255, 0.3);
    border: none;
    font-size: 1.5rem;
    cursor: pointer;
    color: white;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
    z-index: 10;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.close-rating:hover {
    background: rgba(255, 255, 255, 0.5);
    color: white;
    transform: scale(1.1);
}

    .rating-title {
        font-size: 1.5rem;
        font-weight: 600;
        margin-bottom: 1.5rem;
        color: var(--text-primary);
        text-align: center;
    }

    .rating-stars {
        display: flex;
        justify-content: center;
        gap: 0.5rem;
        margin-bottom: 2rem;
        flex-direction: row-reverse;
    }

    .rating-stars input[type="radio"] {
        display: none;
    }

    .rating-stars label {
        font-size: 2.5rem;
        color: #e5e7eb;
        cursor: pointer;
        transition: all 0.2s ease;
        filter: drop-shadow(0 2px 4px rgba(0,0,0,0.1));
    }

    .rating-stars label:hover {
        transform: scale(1.2);
        color: #fbbf24;
    }

    .rating-stars input[type="radio"]:checked ~ input[type="radio"] + label {
        color: #fbbf24 !important;
    }

    .rating-stars input[type="radio"]:hover ~ input[type="radio"] + label {
        color: #fbbf24 !important;
    }

    .rating-btn {
        padding: 1rem;
        font-size: 1.1rem;
        background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
        color: white;
        border: none;
        border-radius: 12px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .rating-btn:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-medium);
    }

    /* Responsive Design */
    @media (max-width: 1024px) {
        .hero-stats {
            gap: 2rem;
        }
        
        .stat-item {
            padding: 1rem 1.5rem;
            min-width: 120px;
        }

        .star-rating-hero .star {
            font-size: 1.25rem;
        }
        
        .btn-icon {
            width: 40px;
            height: 40px;
            font-size: 1.25rem;
        }
    }

    @media (max-width: 768px) {
        .hero-section {
            padding: 4rem 0 3rem;
        }

        .hero-container,
        .content-container {
            padding: 0 1.5rem;
        }

        .rating-subtitle {
        font-size: 0.9rem;
    }

        .hero-stats {
            gap: 1rem;
            grid-template-columns: repeat(2, 1fr);
        }

        .stat-item {
            padding: 0.75rem 1rem;
            min-width: 100px;
        }

        .stat-number {
            font-size: 1.5rem;
        }

        .section-header,
        .section-content {
            padding: 1.5rem;
        }

        .chapter-header {
            padding: 1rem 1.5rem;
        }

        .chapter-content {
            padding: 1.5rem;
        }

        .activities-grid,
        .resources-grid {
            grid-template-columns: 1fr;
            gap: 1rem;
        }

        .activity-header,
        .activity-body {
            padding: 1.5rem;
        }

        .rating-popup {
        margin: 1rem;
        max-width: calc(100vw - 2rem);
        border-radius: 16px;
    }
        
        .popup-header {
        padding: 2.5rem 1.5rem 1.5rem;
    }

     .popup-icon {
        width: 56px;
        height: 56px;
        font-size: 1.5rem;
        margin-bottom: 1rem;
    }
        
        .hero-rating-form .rating-title {
        font-size: 1.375rem;
    }

    .hero-rating-form .rating-stars {
        gap: 0.5rem;
        margin: 2rem 0 1rem 0;
        padding: 0 1.5rem;
    }
    
    .hero-rating-form .rating-stars label {
        font-size: 3rem;
        width: 50px;
        height: 50px;
    }
    
    .rating-labels {
        padding: 0 1.5rem 1.5rem 1.5rem;
        font-size: 0.8rem;
        flex-wrap: wrap;
        gap: 0.25rem;
    }
    
    .rating-label {
        font-size: 0.75rem;
        padding: 0.375rem 0.25rem;
    }
    
    .hero-submit-btn {
        margin: 0 1.5rem 1.5rem 1.5rem;
        width: calc(100% - 3rem);
        font-size: 1rem;
        padding: 0.875rem 1.5rem;
    }
    
    .close-rating {
        top: 1rem;
        right: 1rem;
        width: 36px;
        height: 36px;
        font-size: 1.25rem;
    }

    }

    @media (max-width: 480px) {
        .content-wrapper {
            border-radius: 20px 20px 0 0;
            padding: 2rem 0 1rem;
        }

        .hero-stats {
            flex-direction: column;
            align-items: center;
            gap: 1rem;
        }

        .popup-header {
        padding: 2rem 1rem 1rem;
    }

        .resource-card {
            padding: 1.5rem;
        }

        .chapter-title {
            font-size: 1rem;
        }

        .section-title {
            font-size: 1.25rem;
        }

        .hero-rating-form .rating-stars {
            gap: 0.5rem;
            margin: 1.5rem 0 1rem 0;
        }
        
        .hero-rating-form .rating-stars label {
            font-size: 2rem;
        }
        
        .rating-labels {
        padding: 0 1rem 1rem 1rem;
        flex-direction: column;
        gap: 0.5rem;
        text-align: center;
    }

     .rating-label {
        width: 100%;
    }
    
    .hero-submit-btn {
        margin: 0 1rem 1rem 1rem;
        width: calc(100% - 2rem);
    }
    }

    /* Advanced Animations */
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

    @keyframes pulse {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.8; }
    }

    .animate-on-scroll {
        opacity: 0;
        animation: fadeInUp 0.6s ease forwards;
    }

    /* Premium Focus States */
    .section-header:focus,
    .chapter-header:focus,
    .resource-action:focus,
    .back-button:focus,
    .btn-rate-hero:focus {
        outline: 3px solid rgba(102, 126, 234, 0.5);
        outline-offset: 2px;
    }

    .hero-rating-form .rating-stars label:focus {
        outline: 3px solid var(--primary-color);
        outline-offset: 2px;
        border-radius: 50%;
    }

    .hero-rating-form .rating-stars label:focus-visible {
    outline: 3px solid #2563eb;
    outline-offset: 4px;
    border-radius: 50%;
}

.hero-submit-btn:focus-visible {
    outline: 3px solid #2563eb;
    outline-offset: 2px;
}

.close-rating:focus-visible {
    outline: 3px solid rgba(255, 255, 255, 0.8);
    outline-offset: 2px;
}

    /* Loading States */
    .loading {
        animation: pulse 2s infinite;
    }

    /* Slide animations for notifications */
    @keyframes slideInRight {
        from {
            opacity: 0;
            transform: translateX(100%);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes slideOutRight {
        from {
            opacity: 1;
            transform: translateX(0);
        }
        to {
            opacity: 0;
            transform: translateX(100%);
        }
    }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endsection

@section('content')
<div class="course-page">
    <!-- Premium Hero Section -->
    <section class="hero-section">
        <div class="hero-container">
            <h1 class="hero-title">{{ $course->title }}</h1>
            <p class="hero-description">{{ $course->description }}</p>
            
            <div class="hero-stats">
                <div class="stat-item">
                    <span class="stat-number">{{ $course->chapters->count() }}</span>
                    <span class="stat-label">Chapters</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">{{ $course->quizzes->count() }}</span>
                    <span class="stat-label">Quizzes</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">{{ $course->challenges->count() }}</span>
                    <span class="stat-label">Challenges</span>
                </div>
                
                <!-- NEW: Rating Display Section -->
                <div class="stat-item rating-stat">
                    <div class="stat-rating-display">
                        <div class="star-rating-hero" id="hero-star-rating-{{ $course->id }}">
                            @php
                                $rating = $course->averageRating();
                                $fullStars = floor($rating);
                                $hasHalfStar = ($rating - $fullStars) >= 0.25 && ($rating - $fullStars) < 0.75;
                                $emptyStars = 5 - $fullStars - ($hasHalfStar ? 1 : 0);
                            @endphp
                            @for ($i = 0; $i < $fullStars; $i++)
                                <span class="star star-full">★</span>
                            @endfor
                            @if ($hasHalfStar)
                                <span class="star star-half">★</span>
                            @endif
                            @for ($i = 0; $i < $emptyStars; $i++)
                                <span class="star star-empty">☆</span>
                            @endfor
                        </div>
                        <span class="stat-number rating-number" id="hero-rating-number-{{ $course->id }}">{{ number_format($course->averageRating(), 1) }}</span>
                    </div>
                    <span class="stat-label">Course Rating</span>
                </div>
                
                <!-- NEW: Rate Course Button (Only for authenticated users) -->
                @auth
                <div class="stat-item rate-action">
                    <button class="btn-rate-hero rate-toggle" data-course="{{ $course->id }}">
                        <div class="btn-icon">
                            <i class="fas fa-star"></i>
                        </div>
                        <span class="btn-text">
                            @php
                                $userRating = \App\Models\Rating::where('course_id', $course->id)
                                                ->where('user_id', auth()->id())
                                                ->first();
                            @endphp
                            {{ $userRating ? 'Update Rating' : 'Rate Course' }}
                        </span>
                    </button>
                    <span class="stat-label">
                        @if($userRating)
                            Your Rating: {{ $userRating->rating }}/5
                        @else
                            Share Your Experience
                        @endif
                    </span>
                </div>
                @endauth
                
                @guest
                <div class="stat-item guest-action">
                    <a href="{{ route('login') }}" class="btn-rate-hero guest-login">
                        <div class="btn-icon">
                            <i class="fas fa-sign-in-alt"></i>
                        </div>
                        <span class="btn-text">Login to Rate</span>
                    </a>
                    <span class="stat-label">Join Our Community</span>
                </div>
                @endguest
            </div>
        </div>
    </section>

    <!-- Rating Overlay (Add this right after the hero section, before content-wrapper) -->
    @auth
    <div class="rating-overlay hidden" id="rating-overlay-{{ $course->id }}">
        <div class="rating-popup hero-rating-popup">
            <span class="close-rating" data-course="{{ $course->id }}">&times;</span>
            <form action="{{ route('ratings.store', $course->id) }}" method="POST" class="rating-form hero-rating-form">
                @csrf
                <div class="popup-header">
                    <div class="popup-icon">
                        <i class="fas fa-star"></i>
                    </div>
                    <h3 class="rating-title">Rate "{{ $course->title }}"</h3>
                    <p class="rating-subtitle">Help other learners by sharing your experience</p>
                </div>
                
                <div class="rating-stars">
                    @for ($i = 5; $i >= 1; $i--)
                        <input type="radio" id="hero-star{{ $i }}-{{ $course->id }}" name="rating" value="{{ $i }}" required>
                        <label for="hero-star{{ $i }}-{{ $course->id }}" class="star">★</label>
                    @endfor
                </div>
                
                <div class="rating-labels">
                    <span class="rating-label" data-rating="1">Poor</span>
                    <span class="rating-label" data-rating="2">Fair</span>
                    <span class="rating-label" data-rating="3">Good</span>
                    <span class="rating-label" data-rating="4">Great</span>
                    <span class="rating-label" data-rating="5">Excellent</span>
                </div>
                
                <button type="submit" class="btn-primary rating-btn hero-submit-btn">
                    <i class="fas fa-star"></i>
                    Submit Rating
                </button>
            </form>
        </div>
    </div>
    @endauth

    <!-- Premium Content Wrapper -->
    <div class="content-wrapper">
        <div class="content-container">
            
            <!-- Chapters Section -->
            @if($course->chapters->count())
            <div class="content-section animate-on-scroll">
                <div class="section-header" onclick="toggleSection('chapters')">
                    <div class="section-title">
                        <div class="section-icon-wrapper">
                            <div class="section-icon">
                                <i class="fas fa-book-open"></i>
                            </div>
                            <span>Course Chapters & Learning Materials</span>
                        </div>
                        <div class="toggle-indicator" id="chapters-icon">+</div>
                    </div>
                </div>
                <div id="chapters" class="section-content">
                    <div class="chapter-list">
                        @foreach($course->chapters as $chapter)
                        <div class="chapter-item">
                            <button class="chapter-header" onclick="toggleChapterDetails({{ $chapter->id }})">
                                <div class="chapter-title">
                                    <div class="chapter-number">{{ $loop->iteration }}</div>
                                    <span>{{ $chapter->title }}</span>
                                </div>
                                <div class="toggle-indicator" id="chapter-icon-{{ $chapter->id }}">+</div>
                            </button>
                            
                            <div id="chapter-details-{{ $chapter->id }}" class="chapter-content">
                                <div class="chapter-description">
                                    <p>{{ $chapter->description }}</p>
                                </div>
                                
                                @if($chapter->pdfs->count())
                                <div class="resources-grid">
                                    @foreach($chapter->pdfs as $pdf)
                                    <div class="resource-card">
                                        <div class="resource-header">
                                            <div class="resource-icon">
                                                <i class="fas fa-file-pdf"></i>
                                            </div>
                                            <div class="resource-info">
                                                <h4>{{ $pdf->title }}</h4>
                                                <div class="resource-meta">PDF Document • Learning Material</div>
                                            </div>
                                        </div>
                                        <a href="{{ asset('storage/pdfs/' . $pdf->pdf_path) }}" target="_blank" class="resource-action">
                                            <i class="fas fa-external-link-alt"></i>
                                            View Document
                                        </a>
                                    </div>
                                    @endforeach
                                </div>
                                @else
                                <div class="no-content">
                                    <div class="no-content-icon">
                                        <i class="fas fa-folder-open"></i>
                                    </div>
                                    <h3>No Materials Yet</h3>
                                    <p>Learning materials for this chapter will be available soon.</p>
                                </div>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
            
            <!-- Quizzes Section -->
            @if($course->quizzes->count())
            <div class="content-section animate-on-scroll">
                <div class="section-header" onclick="toggleSection('quizzes')">
                    <div class="section-title">
                        <div class="section-icon-wrapper">
                            <div class="section-icon">
                                <i class="fas fa-brain"></i>
                            </div>
                            <span>Interactive Quizzes & Assessments</span>
                        </div>
                        <div class="toggle-indicator" id="quizzes-icon">+</div>
                    </div>
                </div>
                <div id="quizzes" class="section-content">
                    <div class="activities-grid">
                        @foreach($course->quizzes as $quiz)
                        <div class="activity-card quiz">
                            <div class="activity-header">
                                <div class="activity-icon">
                                    <i class="fas fa-question-circle"></i>
                                </div>
                            </div>
                            <div class="activity-body">
                                <h3 class="activity-title">{{ $quiz->title }}</h3>
                                <p class="activity-description">{{ $quiz->description }}</p>
                                <div class="activity-meta">
                                    <div class="meta-item">
                                        <i class="fas fa-clock"></i>
                                        <span>Self-paced</span>
                                    </div>
                                    <div class="meta-item">
                                        <i class="fas fa-medal"></i>
                                        <span>Assessment</span>
                                    </div>
                                </div>
                                <a href="{{ route('quiz.show', $quiz->id) }}" class="resource-action">
                                    <i class="fas fa-play"></i>
                                    Start Quiz
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif

            <!-- Challenges Section -->
            @if($course->challenges->count())
            <div class="content-section animate-on-scroll">
                <div class="section-header" onclick="toggleSection('challenges')">
                    <div class="section-title">
                        <div class="section-icon-wrapper">
                            <div class="section-icon">
                                <i class="fas fa-trophy"></i>
                            </div>
                            <span>Coding Challenges & Projects</span>
                        </div>
                        <div class="toggle-indicator" id="challenges-icon">+</div>
                    </div>
                </div>
                <div id="challenges" class="section-content">
                    <div class="activities-grid">
                        @foreach($course->challenges as $challenge)
                        <div class="activity-card">
                            <div class="activity-header">
                                <div class="activity-icon">
                                    <i class="fas fa-code"></i>
                                </div>
                            </div>
                            <div class="activity-body">
                                <h3 class="activity-title">{{ $challenge->title }}</h3>
                                <p class="activity-description">{{ $challenge->description }}</p>
                                <div class="activity-meta">
                                    <div class="meta-item">
                                        <i class="fas fa-laptop-code"></i>
                                        <span>Hands-on</span>
                                    </div>
                                    <div class="meta-item">
                                        <i class="fas fa-star"></i>
                                        <span>Challenge</span>
                                    </div>
                                </div>
                                <a href="{{ route('challenge.show', $challenge->id) }}" class="resource-action">
                                    <i class="fas fa-rocket"></i>
                                    Start Challenge
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif

            <!-- Video Tutorials Section -->
            <div class="content-section animate-on-scroll">
                <div class="section-header" onclick="toggleSection('tutorials')">
                    <div class="section-title">
                        <div class="section-icon-wrapper">
                            <div class="section-icon">
                                <i class="fas fa-play-circle"></i>
                            </div>
                            <span>Tutorials</span>
                        </div>
                        <div class="toggle-indicator" id="tutorials-icon">+</div>
                    </div>
                </div>
                <div id="tutorials" class="section-content">
                    @if($tutorialLink)
                    <div class="video-section">
                        @if($embedUrl)
                        <div class="video-container">
                            <iframe src="{{ $embedUrl }}" 
                                    frameborder="0" 
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                    allowfullscreen>
                            </iframe>
                        </div>
                        @else
                         <div class="video-container" style="display: flex; align-items: center; justify-content: center; background: #f8fafc; min-height: 300px;">
                            <div style="text-align: center;">
                                <i class="fas fa-external-link-alt" style="font-size: 3rem; color: #64748b; margin-bottom: 1rem;"></i>
                                <h3 style="color: #334155; margin-bottom: 0.5rem;">External Content</h3>
                                <p style="color: #64748b; margin-bottom: 1.5rem;">This content cannot be embedded. Click the link below to view it.</p>
                                <a href="{{ $tutorialLink }}" target="_blank" class="resource-action">
                                    <i class="fas fa-external-link-alt"></i>
                                    Open Content
                                </a>
                            </div>
                        </div>
                        @endif
                        <div class="video-footer">
                            <a href="{{ $tutorialLink }}" target="_blank" class="external-link">
                                <i class="fas fa-external-link-alt"></i>
                                <span>Visit Course Website for More Resources</span>
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                    @else
                    <div class="no-content">
                        <div class="no-content-icon">
                            <i class="fas fa-video"></i>
                        </div>
                        <h3>No Video Tutorials Yet</h3>
                        <p>Video tutorials for this course will be available soon.</p>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Premium Navigation -->
            <div class="navigation-section">
                @php
                    $user = Auth::user();
                    $route = 'lms'; // default route

                    if ($user) {
                        switch ($user->role) {
                            case 'admin':
                                $route = 'admin.courses';
                                break;
                            case 'instructor':
                                $route = 'instructor.dashboard';
                                break;
                            default:
                                $route = 'lms'; // fallback for normal users
                        }
                    }
                @endphp

                <a href="{{ route($route) }}" class="back-button">
                    <i class="fas fa-arrow-left"></i>
                    <span>Back</span>
                </a>
            </div>

        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Premium JavaScript for Ultra-Professional Course Details
    class CourseDetailsManager {
        constructor() {
            this.activeAnimations = new Set();
            this.observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };
            this.init();
        }

        init() {
            this.setupIntersectionObserver();
            this.setupSmoothToggling();
            this.setupKeyboardNavigation();
            this.setupProgressiveEnhancement();
            this.initializeSections();
            console.log('🚀 Premium Course Details Manager initialized');
        }

        setupIntersectionObserver() {
            if (!window.IntersectionObserver) return;

            const observer = new IntersectionObserver((entries) => {
                entries.forEach((entry, index) => {
                    if (entry.isIntersecting && !entry.target.classList.contains('animated')) {
                        setTimeout(() => {
                            entry.target.style.opacity = '1';
                            entry.target.style.transform = 'translateY(0)';
                            entry.target.classList.add('animated');
                        }, index * 100);
                    }
                });
            }, this.observerOptions);

            document.querySelectorAll('.animate-on-scroll').forEach(el => {
                el.style.opacity = '0';
                el.style.transform = 'translateY(30px)';
                el.style.transition = 'all 0.6s cubic-bezier(0.4, 0, 0.2, 1)';
                observer.observe(el);
            });
        }

        setupSmoothToggling() {
            // Enhanced section toggling with smooth animations
            window.toggleSection = (sectionId) => {
                const content = document.getElementById(sectionId);
                const icon = document.getElementById(`${sectionId}-icon`);
                
                if (!content || !icon) return;

                const isVisible = content.style.display === 'block';
                
                if (isVisible) {
                    this.hideSection(content, icon);
                } else {
                    this.showSection(content, icon);
                }
            };

            // Enhanced chapter toggling
            window.toggleChapterDetails = (chapterId) => {
                const content = document.getElementById(`chapter-details-${chapterId}`);
                const icon = document.getElementById(`chapter-icon-${chapterId}`);
                
                if (!content || !icon) return;

                const isVisible = content.style.display === 'block';
                
                if (isVisible) {
                    this.hideSection(content, icon);
                } else {
                    this.showSection(content, icon);
                }
            };
        }

        showSection(content, icon) {
            content.style.display = 'block';
            content.style.opacity = '0';
            content.style.transform = 'translateY(-20px)';
            
            // Smooth icon rotation
            icon.style.transform = 'rotate(45deg)';
            icon.textContent = '×';
            
            // Smooth content reveal
            requestAnimationFrame(() => {
                content.style.transition = 'all 0.4s cubic-bezier(0.4, 0, 0.2, 1)';
                content.style.opacity = '1';
                content.style.transform = 'translateY(0)';
            });

            // Animate child elements
            this.animateChildren(content);
        }

        hideSection(content, icon) {
            content.style.transition = 'all 0.3s cubic-bezier(0.4, 0, 0.2, 1)';
            content.style.opacity = '0';
            content.style.transform = 'translateY(-10px)';
            
            // Smooth icon rotation
            icon.style.transform = 'rotate(0deg)';
            icon.textContent = '+';
            
            setTimeout(() => {
                content.style.display = 'none';
            }, 300);
        }

        animateChildren(container) {
            const children = container.querySelectorAll('.chapter-item, .activity-card, .resource-card');
            children.forEach((child, index) => {
                child.style.opacity = '0';
                child.style.transform = 'translateY(20px)';
                
                setTimeout(() => {
                    child.style.transition = 'all 0.4s cubic-bezier(0.4, 0, 0.2, 1)';
                    child.style.opacity = '1';
                    child.style.transform = 'translateY(0)';
                }, index * 100);
            });
        }

        setupKeyboardNavigation() {
            document.addEventListener('keydown', (e) => {
                // ESC to close all sections
                if (e.key === 'Escape') {
                    this.closeAllSections();
                }
                
                // Enter or Space to toggle sections
                if ((e.key === 'Enter' || e.key === ' ') && e.target.classList.contains('section-header')) {
                    e.preventDefault();
                    e.target.click();
                }
            });
        }

        closeAllSections() {
            const openSections = document.querySelectorAll('.section-content[style*="display: block"], .chapter-content[style*="display: block"]');
            openSections.forEach(section => {
                const sectionId = section.id;
                if (sectionId.includes('chapter-details-')) {
                    const chapterId = sectionId.replace('chapter-details-', '');
                    toggleChapterDetails(parseInt(chapterId));
                } else {
                    toggleSection(sectionId);
                }
            });
        }

        setupProgressiveEnhancement() {
            // Enhanced hover effects
            document.querySelectorAll('.activity-card, .resource-card, .chapter-item').forEach(card => {
                card.addEventListener('mouseenter', this.handleCardHover.bind(this));
                card.addEventListener('mouseleave', this.handleCardLeave.bind(this));
            });

            // Smooth scrolling for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', (e) => {
                    e.preventDefault();
                    const target = document.querySelector(anchor.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });

            // Enhanced focus management
            this.setupFocusManagement();
        }

        handleCardHover(e) {
            const card = e.target.closest('.activity-card, .resource-card, .chapter-item');
            if (!card) return;

            card.style.transform = 'translateY(-8px) scale(1.02)';
            
            // Add subtle glow effect
            const glowId = `glow-${Date.now()}`;
            this.activeAnimations.add(glowId);
            
            setTimeout(() => {
                if (this.activeAnimations.has(glowId)) {
                    card.style.boxShadow = '0 20px 40px rgba(0, 0, 0, 0.15)';
                }
            }, 50);
        }

        handleCardLeave(e) {
            const card = e.target.closest('.activity-card, .resource-card, .chapter-item');
            if (!card) return;

            card.style.transform = '';
            card.style.boxShadow = '';
            
            // Clear active animations
            this.activeAnimations.clear();
        }

        setupFocusManagement() {
            // Enhanced focus indicators
            const focusableElements = document.querySelectorAll('.section-header, .chapter-header, .resource-action, .back-button');
            
            focusableElements.forEach(element => {
                element.addEventListener('focus', (e) => {
                    e.target.style.boxShadow = '0 0 0 3px rgba(102, 126, 234, 0.3)';
                });
                
                element.addEventListener('blur', (e) => {
                    e.target.style.boxShadow = '';
                });
            });
        }

        initializeSections() {
            // Initialize all sections as closed
            const sections = ['chapters', 'quizzes', 'challenges', 'tutorials'];
            sections.forEach(sectionId => {
                const element = document.getElementById(sectionId);
                if (element) {
                    element.style.display = 'none';
                }
            });

            // Initialize chapter sections as closed
            document.querySelectorAll('[id^="chapter-details-"]').forEach(element => {
                element.style.display = 'none';
            });
        }

        // Public methods for external access
        openSection(sectionId) {
            const content = document.getElementById(sectionId);
            const icon = document.getElementById(`${sectionId}-icon`);
            if (content && icon) {
                this.showSection(content, icon);
            }
        }

        closeSection(sectionId) {
            const content = document.getElementById(sectionId);
            const icon = document.getElementById(`${sectionId}-icon`);
            if (content && icon) {
                this.hideSection(content, icon);
            }
        }
    }

    // Initialize the premium course details manager
    document.addEventListener('DOMContentLoaded', () => {
        window.courseManager = new CourseDetailsManager();
        
        // Performance monitoring
        if (window.performance && window.performance.mark) {
            window.performance.mark('course-details-loaded');
        }
        
        // Accessibility enhancements
        document.querySelectorAll('.section-header, .chapter-header').forEach(header => {
            header.setAttribute('role', 'button');
            header.setAttribute('tabindex', '0');
            header.setAttribute('aria-expanded', 'false');
        });
        
        console.log('✨ Ultra-Professional Course Details Page loaded successfully!');
    });

    // Handle dynamic content loading
    window.addEventListener('load', () => {
        // Preload video thumbnails
        const videoContainers = document.querySelectorAll('.video-container iframe');
        videoContainers.forEach(iframe => {
            iframe.addEventListener('load', () => {
                console.log('📹 Video content loaded successfully');
            });
        });
        
        // Initialize progressive image loading
        if ('IntersectionObserver' in window) {
            const imageObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        if (img.dataset.src) {
                            img.src = img.dataset.src;
                            img.classList.remove('loading');
                            imageObserver.unobserve(img);
                        }
                    }
                });
            });
            
            document.querySelectorAll('img[data-src]').forEach(img => {
                img.classList.add('loading');
                imageObserver.observe(img);
            });
        }
    });

    // Error handling and fallbacks
    window.addEventListener('error', (e) => {
        console.warn('Course details error handled:', e.message);
        // Graceful degradation for unsupported features
    });

    // Export for potential external use
    window.CourseDetailsAPI = {
        openSection: (id) => window.courseManager?.openSection(id),
        closeSection: (id) => window.courseManager?.closeSection(id),
        closeAll: () => window.courseManager?.closeAllSections()
    };
</script>

<!-- Hero Rating System Script -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('🎯 UNIFIED RATING SYSTEM LOADED - LMS + Hero Support!');
    
    // 1. OPEN RATING POPUP (Works for both LMS cards and hero section)
    document.querySelectorAll('.rate-toggle').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const courseId = this.dataset.course;
            const overlay = document.getElementById(`rating-overlay-${courseId}`);
            if (overlay) {
                overlay.classList.remove('hidden');
                
                // Check if user has existing rating and pre-select it
                const existingRating = getUserCurrentRating(courseId);
                if (existingRating) {
                    const radioInput = overlay.querySelector(`input[value="${existingRating}"]`);
                    if (radioInput) {
                        radioInput.checked = true;
                        const starGroup = overlay.querySelector('.rating-stars');
                        updateStarDisplay(starGroup, existingRating);
                        
                        // Update popup title for re-rating
                        const title = overlay.querySelector('.rating-title');
                        if (title) {
                            if (title.textContent.includes('"')) {
                                // Hero version with course title
                                title.innerHTML = title.innerHTML.replace('Rate "', 'Update Rating for "');
                            } else {
                                // LMS version
                                title.innerHTML = `Update Your Rating <span style="color: #f59e0b; font-size: 0.9rem;">(Currently: ${existingRating}/5)</span>`;
                            }
                        }
                    }
                }
                
                console.log('✅ Opened rating popup for course:', courseId);
            }
        });
    });
    
    // 2. CLOSE RATING POPUP  
    document.querySelectorAll('.close-rating').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const courseId = this.dataset.course;
            const overlay = document.getElementById(`rating-overlay-${courseId}`);
            if (overlay) {
                overlay.classList.add('hidden');
                resetRatingPopup(overlay);
                console.log('❌ Closed rating popup');
            }
        });
    });
    
    // 3. CLICK OUTSIDE TO CLOSE
    document.querySelectorAll('.rating-overlay').forEach(overlay => {
        overlay.addEventListener('click', function(e) {
            if (e.target === this) {
                this.classList.add('hidden');
                resetRatingPopup(this);
            }
        });
    });

    // 4. STAR RATING - ENHANCED FOR BOTH LMS AND HERO
    document.querySelectorAll('.rating-stars').forEach(starGroup => {
        const labels = starGroup.querySelectorAll('label');
        const inputs = starGroup.querySelectorAll('input[type="radio"]');
        
        // Make stars clickable
        labels.forEach(label => {
            const input = document.getElementById(label.getAttribute('for'));
            if (input) {
                const rating = parseInt(input.value);
                
                // Click star to select rating
                label.addEventListener('click', function(e) {
                    e.preventDefault();
                    input.checked = true;
                    updateStarDisplay(starGroup, rating);
                    
                    // Update rating labels if in hero popup
                    if (starGroup.closest('.hero-rating-form')) {
                        updateHeroRatingLabel(rating);
                    }
                    
                    console.log('⭐ Selected rating:', rating);
                });
                
                // Hover effect
                label.addEventListener('mouseenter', function() {
                    updateStarDisplay(starGroup, rating);
                    
                    // Update rating labels if in hero popup
                    if (starGroup.closest('.hero-rating-form')) {
                        updateHeroRatingLabel(rating);
                    }
                });
            }
        });
        
        // Reset on mouse leave
        starGroup.addEventListener('mouseleave', function() {
            const checkedInput = starGroup.querySelector('input:checked');
            if (checkedInput) {
                const rating = parseInt(checkedInput.value);
                updateStarDisplay(starGroup, rating);
                
                // Update rating labels if in hero popup
                if (starGroup.closest('.hero-rating-form')) {
                    updateHeroRatingLabel(rating);
                }
            } else {
                resetStars(starGroup);
                
                // Reset rating labels if in hero popup
                if (starGroup.closest('.hero-rating-form')) {
                    resetHeroRatingLabels();
                }
            }
        });
    });
    
    // Helper function to update star colors
    function updateStarDisplay(starGroup, rating) {
        const labels = starGroup.querySelectorAll('label');
        labels.forEach(label => {
            const input = document.getElementById(label.getAttribute('for'));
            if (input) {
                const starValue = parseInt(input.value);
                if (starValue <= rating) {
                    label.style.color = '#fbbf24'; // Gold
                    label.style.transform = starGroup.closest('.hero-rating-form') ? 'scale(1.2)' : 'scale(1.1)';
                } else {
                    label.style.color = '#e5e7eb'; // Gray
                    label.style.transform = 'scale(1)';
                }
            }
        });
    }
    
    // Helper function to reset stars
    function resetStars(starGroup) {
        const labels = starGroup.querySelectorAll('label');
        labels.forEach(label => {
            label.style.color = '#e5e7eb';
            label.style.transform = 'scale(1)';
        });
    }

    // Helper function to reset popup state
    function resetRatingPopup(overlay) {
        const form = overlay.querySelector('.rating-form');
        if (form) {
            form.reset();
            const starGroup = overlay.querySelector('.rating-stars');
            if (starGroup) {
                resetStars(starGroup);
            }
            
            // Reset title
            const title = overlay.querySelector('.rating-title');
            if (title) {
                if (title.textContent.includes('"')) {
                    // Hero version - restore original title
                    const courseTitle = title.textContent.match(/"([^"]+)"/)?.[1];
                    if (courseTitle) {
                        title.innerHTML = `Rate "${courseTitle}"`;
                    }
                } else {
                    // LMS version
                    title.innerHTML = 'Rate this Course';
                }
            }
            
            // Reset hero rating labels
            if (form.classList.contains('hero-rating-form')) {
                resetHeroRatingLabels();
            }
        }
    }

    // Helper function for hero rating labels
     function updateHeroRatingLabel(rating) {
        const ratingLabels = document.querySelectorAll('.rating-label');
        ratingLabels.forEach((label, index) => {
            if (index + 1 === rating) {
                label.classList.add('active');
            } else {
                label.classList.remove('active');
            }
        });
    }
    
    function resetHeroRatingLabels() {
        const ratingLabels = document.querySelectorAll('.rating-label');
        ratingLabels.forEach(label => {
            label.classList.remove('active');
        });
    }

    // Make functions globally available
    window.updateHeroStarDisplay = updateHeroStarDisplay;
    window.resetHeroStars = resetHeroStars;
    window.updateHeroRatingLabel = updateHeroRatingLabel;
    window.resetHeroRatingLabels = resetHeroRatingLabels;
    
    console.log('✅ Hero Rating System Fixed and Ready');

    // Helper function to get user's current rating
    function getUserCurrentRating(courseId) {
        // Try to get from hero section first
        const heroRatingLabel = document.querySelector('.rate-action .stat-label');
        if (heroRatingLabel && heroRatingLabel.textContent.includes('Your Rating:')) {
            const match = heroRatingLabel.textContent.match(/Your Rating: (\d+)\/5/);
            if (match) return parseInt(match[1]);
        }
        
        // Try to get from LMS card
        const lmsRatingSpan = document.querySelector(`[data-course="${courseId}"]`)?.parentElement?.querySelector('.current-rating');
        if (lmsRatingSpan) {
            const match = lmsRatingSpan.textContent.match(/Your rating: (\d+)\/5/);
            if (match) return parseInt(match[1]);
        }
        
        return null;
    }

    // 5. FORM SUBMISSION - ENHANCED FOR BOTH LMS AND HERO
    document.querySelectorAll('.rating-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault(); // STOP default submission
            
            const selectedRating = this.querySelector('input[name="rating"]:checked');
            const submitBtn = this.querySelector('.rating-btn');
            const courseId = extractCourseId(this);
            const existingRating = getUserCurrentRating(courseId);
            const isHeroForm = this.classList.contains('hero-rating-form');
            
            console.log('🚀 SUBMITTING RATING:', {
                courseId: courseId,
                rating: selectedRating ? selectedRating.value : 'NONE',
                existingRating: existingRating,
                isHeroForm: isHeroForm,
                formAction: this.action
            });
            
            if (!selectedRating) {
                alert('❌ Please select a rating first!');
                return;
            }
            
            // Show loading
            const originalButtonText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Submitting...';
            submitBtn.disabled = true;
            
            // AJAX submission
            const formData = new FormData();
            formData.append('rating', selectedRating.value);
            formData.append('_token', getCSRFToken());
            
            const submitUrl = this.action;
            
            fetch(submitUrl, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': getCSRFToken()
                }
            })
            .then(response => {
                console.log('📡 Response status:', response.status);
                
                if (response.ok || response.status === 302) {
                    console.log('✅ SUCCESS: Rating submitted successfully');
                    
                    // Close popup
                    const overlay = this.closest('.rating-overlay');
                    if (overlay) {
                        overlay.classList.add('hidden');
                        resetRatingPopup(overlay);
                    }
                    
                    // Handle success differently for LMS vs Hero
                    if (isHeroForm) {
                        handleHeroRatingSuccess(courseId, selectedRating.value, existingRating);
                    } else {
                        handleLmsRatingSuccess(courseId, selectedRating.value, existingRating);
                    }
                    
                    // Try to get JSON response for new average rating
                    if (response.headers.get('content-type')?.includes('application/json')) {
                        return response.json().then(data => {
                            console.log('📊 Got JSON response:', data);
                            
                            if (data.average_rating) {
                                updateAllRatingDisplays(courseId, data.average_rating);
                            }
                        });
                    } else {
                        // For redirect responses, manually fetch the new rating
                        fetchAndUpdateRating(courseId);
                    }
                    
                    return true;
                } else {
                    return response.text().then(text => {
                        console.error('❌ Server error:', text);
                        throw new Error(`Server responded with ${response.status}`);
                    });
                }
            })
            .catch(error => {
                console.error('❌ ERROR:', error);
                alert('❌ Something went wrong. Please try again.');
            })
            .finally(() => {
                // Reset button
                submitBtn.innerHTML = originalButtonText;
                submitBtn.disabled = false;
            });
        });
    });
    
    // Helper functions
    function extractCourseId(form) {
        // Try multiple methods to get course ID
        const urlParts = form.action.split('/');
        let courseId = urlParts[urlParts.length - 1];
        
        if (courseId === 'store' || courseId === 'ratings') {
            courseId = urlParts[urlParts.length - 2];
        }
        
        // Fallback: get from overlay ID
        if (!courseId || courseId === 'rate') {
            const overlay = form.closest('.rating-overlay');
            if (overlay && overlay.id) {
                courseId = overlay.id.replace('rating-overlay-', '');
            }
        }
        
        console.log('🎯 Extracted course ID:', courseId);
        return courseId;
    }
    
    function getCSRFToken() {
        const token = document.querySelector('meta[name="csrf-token"]');
        if (token) {
            return token.getAttribute('content');
        }
        
        // Fallback
        const hiddenInput = document.querySelector('input[name="_token"]');
        if (hiddenInput) {
            return hiddenInput.value;
        }
        
        console.error('🚨 CSRF token not found!');
        return '';
    }
    
    function handleHeroRatingSuccess(courseId, newRating, existingRating) {
        console.log('🎊 Handling hero rating success');
        
        // Update button text
        const rateButton = document.querySelector(`[data-course="${courseId}"] .btn-text`);
        const rateLabel = document.querySelector(`[data-course="${courseId}"]`).parentElement.querySelector('.stat-label');
        
        if (rateButton) {
            rateButton.textContent = 'Update Rating';
        }
        
        if (rateLabel) {
            rateLabel.textContent = `Your Rating: ${newRating}/5`;
        }
        
        // Add success animation
        const ratingStat = document.querySelector('.rating-stat');
        if (ratingStat) {
            ratingStat.classList.add('updated');
            setTimeout(() => {
                ratingStat.classList.remove('updated');
            }, 1000);
        }
        
        // Show success notification
        showHeroRatingSuccess(newRating);
        
        // Fetch and update new average rating
        fetchAndUpdateRating(courseId);
    }
    
    function handleLmsRatingSuccess(courseId, newRating, existingRating) {
        console.log('🎯 Handling LMS rating success');
        
        const rateButton = document.querySelector(`[data-course="${courseId}"]`);
        if (rateButton) {
            rateButton.innerHTML = `<i class="fas fa-star"></i> Rate`;
        }
        
        // Show success message
        const isUpdate = existingRating !== null;
        const message = isUpdate 
            ? `✅ Rating updated to ${newRating}/5!` 
            : `✅ Rating submitted: ${newRating}/5!`;
        showSuccessNotification(message);
    }
    
    function fetchAndUpdateRating(courseId) {
        fetch(`/lms/${courseId}/rating-info`, {
            headers: { 'Accept': 'application/json' }
        })
        .then(r => r.json())
        .then(data => {
            if (data.success && data.average_rating) {
                updateAllRatingDisplays(courseId, data.average_rating);
            }
        })
        .catch(e => console.log('Could not fetch updated rating:', e));
    }
    
    function updateAllRatingDisplays(courseId, newAverageRating) {
        console.log('🔄 Updating all rating displays');
        
        // Update hero section
        updateHeroRatingDisplay(courseId, newAverageRating);
        
        // Update LMS card if exists
        updateLmsRatingDisplay(courseId, newAverageRating);
    }
    
    function updateHeroRatingDisplay(courseId, newAverageRating) {
        const heroStarRating = document.getElementById(`hero-star-rating-${courseId}`);
        const heroRatingNumber = document.getElementById(`hero-rating-number-${courseId}`);
        
        if (heroStarRating) {
            updateHeroStars(heroStarRating, newAverageRating);
        }
        
        if (heroRatingNumber) {
            heroRatingNumber.textContent = parseFloat(newAverageRating).toFixed(1);
        }
        
        console.log('✅ Hero rating display updated');
    }
    
    function updateLmsRatingDisplay(courseId, newAverageRating) {
        // Find LMS card rating section
        const rateButton = document.querySelector(`[data-course="${courseId}"]`);
        const courseCard = rateButton?.closest('.course-card');
        
        if (!courseCard) return;
        
        const ratingSection = courseCard.querySelector('.rating-section');
        if (!ratingSection) return;
        
        // Update rating text
        const ratingText = ratingSection.querySelector('.rating-text');
        if (ratingText) {
            const formattedRating = parseFloat(newAverageRating).toFixed(2);
            ratingText.textContent = `${formattedRating}/5`;
        }
        
        // Update stars
        const starRating = ratingSection.querySelector('.star-rating');
        if (starRating) {
            updateLmsStars(starRating, newAverageRating);
        }
        
        console.log('✅ LMS rating display updated');
    }
    
    function updateHeroStars(starContainer, averageRating) {
        const rating = parseFloat(averageRating);
        const fullStars = Math.floor(rating);
        const decimal = rating - fullStars;
        const hasHalfStar = decimal >= 0.25 && decimal < 0.75;
        const emptyStars = 5 - fullStars - (hasHalfStar ? 1 : 0);
        
        // Clear existing stars
        starContainer.innerHTML = '';
        
        // Add full stars
        for (let i = 1; i <= fullStars; i++) {
            const star = document.createElement('span');
            star.className = 'star star-full';
            star.innerHTML = '★';
            starContainer.appendChild(star);
        }
        
        // Add half star if needed
        if (hasHalfStar) {
            const halfStar = document.createElement('span');
            halfStar.className = 'star star-half';
            halfStar.innerHTML = '★';
            starContainer.appendChild(halfStar);
        }
        
        // Add empty stars
        for (let i = 1; i <= emptyStars; i++) {
            const star = document.createElement('span');
            star.className = 'star star-empty';
            star.innerHTML = '☆';
            starContainer.appendChild(star);
        }
    }
    
    function updateLmsStars(starContainer, averageRating) {
        const rating = parseFloat(averageRating);
        const fullStars = Math.floor(rating);
        const decimal = rating - fullStars;
        const hasHalfStar = decimal >= 0.25 && decimal < 0.75;
        const emptyStars = 5 - fullStars - (hasHalfStar ? 1 : 0);
        
        // Clear existing stars
        starContainer.innerHTML = '';
        
        // Add full stars
        for (let i = 1; i <= fullStars; i++) {
            const star = document.createElement('span');
            star.className = 'star star-full';
            star.innerHTML = '★';
            star.style.color = '#fbbf24';
            star.style.textShadow = '0 1px 2px rgba(251, 191, 36, 0.4)';
            starContainer.appendChild(star);
        }
        
        // Add half star if needed
        if (hasHalfStar) {
            const halfStar = document.createElement('span');
            halfStar.className = 'star star-half';
            halfStar.style.position = 'relative';
            halfStar.style.display = 'inline-block';
            halfStar.style.color = '#d1d5db';
            halfStar.innerHTML = '★';
            
            const halfFill = document.createElement('span');
            halfFill.style.position = 'absolute';
            halfFill.style.left = '0';
            halfFill.style.top = '0';
            halfFill.style.width = '50%';
            halfFill.style.overflow = 'hidden';
            halfFill.style.color = '#fbbf24';
            halfFill.style.textShadow = '0 1px 2px rgba(251, 191, 36, 0.4)';
            halfFill.innerHTML = '★';
            
            halfStar.appendChild(halfFill);
            starContainer.appendChild(halfStar);
        }
        
        // Add empty stars
        for (let i = 1; i <= emptyStars; i++) {
            const star = document.createElement('span');
            star.className = 'star star-empty';
            star.innerHTML = '☆';
            star.style.color = '#d1d5db';
            starContainer.appendChild(star);
        }
    }
    
    function showHeroRatingSuccess(userRating) {
        // Create and show success notification
        const notification = document.createElement('div');
        notification.style.cssText = `
            position: fixed;
            top: 100px;
            right: 20px;
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            padding: 1rem 1.5rem;
            border-radius: 12px;
            box-shadow: 0 8px 25px rgba(16, 185, 129, 0.4);
            z-index: 9999;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            animation: slideInRight 0.4s ease;
        `;
        
        notification.innerHTML = `
            <i class="fas fa-star" style="font-size: 1.25rem;"></i>
            <div>
                <div>Rating submitted: ${userRating}/5</div>
                <div style="font-size: 0.875rem; opacity: 0.9;">Thank you for your feedback!</div>
            </div>
        `;
        
        document.body.appendChild(notification);
        
        setTimeout(() => {
            notification.style.animation = 'slideOutRight 0.4s ease';
            setTimeout(() => {
                if (document.body.contains(notification)) {
                    document.body.removeChild(notification);
                }
            }, 400);
        }, 3000);
    }
    
    
    console.log('🎉 UNIFIED RATING SYSTEM COMPLETE - Hero + LMS Support!');
});
</script>
@endsection