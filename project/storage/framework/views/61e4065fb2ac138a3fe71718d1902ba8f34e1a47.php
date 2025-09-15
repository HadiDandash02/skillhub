

<?php $__env->startSection('title', 'SkillHub - Professional Learning & Career Platform'); ?>
<?php $__env->startSection('description', 'Advance your tech career with SkillHub\'s comprehensive LMS, job matching, resume builder, and personalized learning paths.'); ?>

<?php $__env->startSection('styles'); ?>
<!-- FontAwesome Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
    /* Ensure icons are properly displayed */
    .fas, .far, .fab {
        font-family: "Font Awesome 6 Free", "Font Awesome 6 Brands" !important;
        font-weight: 900;
        display: inline-block;
        font-style: normal;
        font-variant: normal;
        text-rendering: auto;
        line-height: 1;
    }

    /* Icon specific styling */
    i.fas, i.far, i.fab {
        font-size: inherit;
        line-height: inherit;
        vertical-align: baseline;
    }

    /* Ensure hero badge icons are visible */
    .hero-badge i {
        color: white;
        font-size: 1rem;
        margin-right: 0.5rem;
    }

    /* Ensure button icons are visible */
    .btn-hero-primary i,
    .btn-hero-secondary i {
        font-size: 1.125rem;
        line-height: 1;
    }

    /* Ensure feature icons are visible */
    .hero-feature i {
        color: var(--accent-color);
        font-size: 1.125rem;
        margin-right: 0.75rem;
    }

    /* Ensure showcase icons are visible */
    .showcase-icon i {
        color: white;
        font-size: 2rem;
        line-height: 1;
    }

    .feature-icon-small i {
        color: white;
        font-size: 1.125rem;
        line-height: 1;
    }

    /* Ensure service card icons are visible */
    .service-icon i {
        color: white;
        font-size: 3rem;
        line-height: 1;
    }

    /* Ensure value feature icons are visible */
    .value-feature-icon i {
        color: white;
        font-size: 1.25rem;
        line-height: 1;
    }

    /* Ensure step numbers and icons are visible */
    .step-number {
        color: white;
        font-weight: 700;
        font-size: 1.125rem;
        line-height: 1;
    }

    /* Ensure CTA badge icons are visible */
    .cta-badge i,
    .section-badge i {
        color: white;
        font-size: 0.875rem;
        margin-right: 0.5rem;
    }

    /* Ensure service CTA icons are visible */
    .service-cta i {
        color: white;
        font-size: 1rem;
        margin-left: 0.5rem;
    }
    :root {
        /* Primary Color Scheme - Matching other blades */
        --primary-gradient: linear-gradient(135deg, #2563eb, #10b981);
        --primary-color: #2563eb;
        --primary-dark: #1d4ed8;
        --accent-color: #10b981;
        --accent-dark: #059669;
        
        /* Glass morphism effects */
        --glass-bg: rgba(255, 255, 255, 0.1);
        --glass-border: rgba(255, 255, 255, 0.2);
        
        /* Text colors */
        --text-primary: #1a202c;
        --text-secondary: #4a5568;
        --text-light: #718096;
        
        /* Surface colors */
        --surface-white: #ffffff;
        --surface-light: #f7fafc;
        --surface-gray: #edf2f7;
        --border-light: rgba(0, 0, 0, 0.06);
        
        /* Shadows */
        --shadow-subtle: 0 1px 3px rgba(0, 0, 0, 0.05);
        --shadow-medium: 0 4px 12px rgba(0, 0, 0, 0.15);
        --shadow-large: 0 8px 25px rgba(0, 0, 0, 0.2);
        --shadow-premium: 0 20px 40px rgba(0, 0, 0, 0.1);
        
        /* Border radius */
        --border-radius: 20px;
        --border-radius-large: 24px;
        
        /* Animation */
        --animation-speed: 0.4s;
        --animation-curve: cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* Hero Section - Reduced bottom padding */
    .hero {
        background: var(--primary-gradient);
        color: white;
        padding: 6rem 0 3rem;
        position: relative;
        overflow: hidden;
        margin-top: -1px;
    }

    .hero::before {
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

    .hero-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 2rem;
        position: relative;
        z-index: 2;
    }

    .hero-content {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 5rem;
        align-items: center;
        min-height: 60vh;
    }

    .hero-text {
        animation: fadeInLeft 1s ease-out;
    }

    .hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.75rem;
        background: var(--glass-bg);
        border: 1px solid var(--glass-border);
        backdrop-filter: blur(20px);
        padding: 1rem 2rem;
        border-radius: 50px;
        font-size: 0.875rem;
        font-weight: 600;
        margin-bottom: 2.5rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .hero-text h1 {
        font-size: clamp(3rem, 5vw, 4.5rem);
        font-weight: 900;
        margin-bottom: 2rem;
        line-height: 1.1;
        background: linear-gradient(135deg, #ffffff 0%, #f0f8ff 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .hero-text .subtitle {
        font-size: 1.375rem;
        margin-bottom: 3rem;
        opacity: 0.95;
        font-weight: 400;
        line-height: 1.6;
        max-width: 520px;
    }

    .hero-buttons {
        display: flex;
        gap: 1.25rem;
        flex-wrap: wrap;
        margin-bottom: 3rem;
    }

    .btn-hero-primary {
        background: var(--surface-white);
        color: var(--primary-color);
        padding: 1.5rem 3rem;
        border-radius: 16px;
        text-decoration: none;
        font-weight: 700;
        font-size: 1.125rem;
        transition: all var(--animation-speed) var(--animation-curve);
        border: 2px solid transparent;
        display: inline-flex;
        align-items: center;
        gap: 0.75rem;
        box-shadow: 0 8px 25px rgba(255, 255, 255, 0.25);
        position: relative;
        overflow: hidden;
        min-width: 200px;
        justify-content: center;
    }

    .btn-hero-primary::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(37, 99, 235, 0.1), transparent);
        transition: left 0.8s ease;
    }

    .btn-hero-primary:hover::before {
        left: 100%;
    }

    .btn-hero-secondary {
        background: var(--glass-bg);
        border: 2px solid var(--glass-border);
        backdrop-filter: blur(20px);
        color: white;
        padding: 1.5rem 3rem;
        border-radius: 16px;
        text-decoration: none;
        font-weight: 700;
        font-size: 1.125rem;
        transition: all var(--animation-speed) var(--animation-curve);
        display: inline-flex;
        align-items: center;
        gap: 0.75rem;
        min-width: 200px;
        justify-content: center;
    }

    .btn-hero-primary:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 35px rgba(255, 255, 255, 0.35);
        color: var(--primary-dark);
    }

    .btn-hero-secondary:hover {
        background: rgba(255, 255, 255, 0.2);
        border-color: white;
        transform: translateY(-4px);
        color: white;
    }

    .hero-features {
        display: flex;
        gap: 2rem;
        margin-top: 2rem;
        flex-wrap: wrap;
    }

    .hero-feature {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        font-size: 0.95rem;
        opacity: 0.9;
    }

    .hero-feature i {
        color: var(--accent-color);
        font-size: 1.125rem;
    }

    /* Professional Visual Section */
    .hero-visual {
        display: flex;
        justify-content: center;
        align-items: center;
        animation: fadeInRight 1s ease-out;
    }

    .hero-showcase {
        background: var(--glass-bg);
        backdrop-filter: blur(20px);
        border-radius: var(--border-radius-large);
        padding: 3rem;
        border: 1px solid var(--glass-border);
        width: 100%;
        max-width: 500px;
        box-shadow: var(--shadow-premium);
        position: relative;
        overflow: hidden;
    }

    .hero-showcase::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--primary-color), var(--accent-color));
    }

    .showcase-header {
        text-align: center;
        margin-bottom: 2.5rem;
    }

    .showcase-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #fbbf24, #f59e0b);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        margin: 0 auto 1.5rem;
        box-shadow: 0 8px 25px rgba(251, 191, 36, 0.3);
    }

    .showcase-title {
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        opacity: 0.95;
    }

    .showcase-subtitle {
        font-size: 0.95rem;
        opacity: 0.8;
    }

    .showcase-features {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    .showcase-feature {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1rem;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 12px;
        transition: all var(--animation-speed) var(--animation-curve);
    }

    .showcase-feature:hover {
        background: rgba(255, 255, 255, 0.15);
        transform: translateX(5px);
    }

    .feature-icon-small {
        width: 40px;
        height: 40px;
        background: var(--accent-color);
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.125rem;
        flex-shrink: 0;
    }

    .feature-content h4 {
        margin: 0 0 0.25rem 0;
        font-size: 1rem;
        font-weight: 600;
        opacity: 0.95;
    }

    .feature-content p {
        margin: 0;
        font-size: 0.875rem;
        opacity: 0.8;
        line-height: 1.4;
    }

    /* Services Section - Reduced padding */
    .services-section {
        padding: 4rem 0;
        background: var(--surface-light);
        position: relative;
    }

    .services-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 2rem;
    }

    .services-header {
        text-align: center;
        margin-bottom: 5rem;
        animation: fadeInUp 0.8s ease-out;
    }

    .section-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: var(--primary-color);
        color: white;
        padding: 0.75rem 1.5rem;
        border-radius: 50px;
        font-size: 0.875rem;
        font-weight: 700;
        margin-bottom: 2rem;
        text-transform: uppercase;
        letter-spacing: 0.1em;
    }

    .services-header h2 {
        font-size: clamp(2.5rem, 4vw, 3.5rem);
        font-weight: 800;
        margin-bottom: 1.5rem;
        color: var(--text-primary);
        background: var(--primary-gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        line-height: 1.2;
    }

    .services-subtitle {
        font-size: 1.25rem;
        color: var(--text-light);
        max-width: 700px;
        margin: 0 auto;
        line-height: 1.6;
    }

    .services-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(380px, 1fr));
        gap: 2.5rem;
        margin-top: 2rem;
    }

    .service-card {
        background: var(--surface-white);
        padding: 3.5rem 3rem;
        border-radius: var(--border-radius-large);
        box-shadow: var(--shadow-subtle);
        border: 1px solid var(--border-light);
        transition: all var(--animation-speed) var(--animation-curve);
        position: relative;
        overflow: hidden;
        text-decoration: none;
        color: var(--text-primary);
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        min-height: 380px;
        justify-content: center;
        /* Removed animation that might cause layout issues */
    }

    .service-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: var(--primary-gradient);
        transform: scaleX(0);
        transition: transform var(--animation-speed) var(--animation-curve);
    }

    .service-card:hover {
        transform: translateY(-12px);
        box-shadow: var(--shadow-premium);
        border-color: var(--primary-color);
    }

    .service-card:hover::before {
        transform: scaleX(1);
    }

    .service-icon {
        width: 100px;
        height: 100px;
        margin-bottom: 2.5rem;
        border-radius: var(--border-radius);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 3rem;
        transition: all var(--animation-speed) var(--animation-curve);
        position: relative;
    }

    .service-card:nth-child(1) .service-icon {
        background: linear-gradient(135deg, #3b82f6, #1d4ed8);
        box-shadow: 0 12px 35px rgba(59, 130, 246, 0.3);
    }

    .service-card:nth-child(2) .service-icon {
        background: linear-gradient(135deg, #10b981, #059669);
        box-shadow: 0 12px 35px rgba(16, 185, 129, 0.3);
    }

    .service-card:hover .service-icon {
        transform: scale(1.1) rotate(5deg);
        box-shadow: 0 16px 45px rgba(0, 0, 0, 0.2);
    }

    .service-title {
        font-size: 1.75rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
        color: var(--text-primary);
        line-height: 1.3;
    }

    .service-description {
        color: var(--text-light);
        line-height: 1.6;
        font-size: 1.125rem;
        margin-bottom: 2rem;
    }

    .service-cta {
        background: var(--primary-gradient);
        color: white;
        padding: 1rem 2rem;
        border-radius: 12px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all var(--animation-speed) var(--animation-curve);
        margin-top: auto;
    }

    .service-card:hover .service-cta {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(37, 99, 235, 0.3);
    }

    /* Value Proposition Section - Reduced padding */
    .value-section {
        padding: 4rem 0;
        background: var(--surface-white);
        position: relative;
    }

    .value-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 2rem;
    }

    .value-content {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 5rem;
        align-items: center;
    }

    .value-text {
        animation: fadeInLeft 0.8s ease-out;
    }

    .value-text h2 {
        font-size: clamp(2.5rem, 4vw, 3.25rem);
        font-weight: 800;
        margin-bottom: 2rem;
        color: var(--text-primary);
        line-height: 1.2;
    }

    .value-text p {
        font-size: 1.25rem;
        color: var(--text-light);
        line-height: 1.6;
        margin-bottom: 3rem;
    }

    .value-features {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    .value-feature {
        display: flex;
        align-items: flex-start;
        gap: 1rem;
    }

    .value-feature-icon {
        width: 48px;
        height: 48px;
        background: var(--primary-gradient);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.25rem;
        flex-shrink: 0;
        margin-top: 0.25rem;
    }

    .value-feature-content h4 {
        margin: 0 0 0.5rem 0;
        font-size: 1.125rem;
        font-weight: 600;
        color: var(--text-primary);
    }

    .value-feature-content p {
        margin: 0;
        color: var(--text-light);
        line-height: 1.5;
    }

    .value-visual {
        animation: fadeInRight 0.8s ease-out;
        display: flex;
        justify-content: center;
    }

    .value-graphic {
        background: var(--surface-light);
        border-radius: var(--border-radius-large);
        padding: 3rem;
        border: 1px solid var(--border-light);
        box-shadow: var(--shadow-medium);
        max-width: 450px;
        width: 100%;
    }

    .value-steps {
        display: flex;
        flex-direction: column;
        gap: 2rem;
    }

    .value-step {
        display: flex;
        align-items: center;
        gap: 1.5rem;
        padding: 1.5rem;
        background: var(--surface-white);
        border-radius: 16px;
        box-shadow: var(--shadow-subtle);
        transition: all var(--animation-speed) var(--animation-curve);
    }

    .value-step:hover {
        transform: translateX(10px);
        box-shadow: var(--shadow-medium);
    }

    .step-number {
        width: 48px;
        height: 48px;
        background: var(--primary-gradient);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 700;
        font-size: 1.125rem;
        flex-shrink: 0;
    }

    .step-content h4 {
        margin: 0 0 0.25rem 0;
        font-size: 1rem;
        font-weight: 600;
        color: var(--text-primary);
    }

    .step-content p {
        margin: 0;
        font-size: 0.875rem;
        color: var(--text-light);
        line-height: 1.4;
    }

    /* Call to Action Section - Reduced padding */
    .cta-section {
        background: var(--primary-gradient);
        padding: 4rem 0;
        color: white;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .cta-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: 
            radial-gradient(circle at 30% 70%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
            radial-gradient(circle at 70% 30%, rgba(16, 185, 129, 0.2) 0%, transparent 50%);
        z-index: 1;
    }

    .cta-container {
        max-width: 900px;
        margin: 0 auto;
        padding: 0 2rem;
        position: relative;
        z-index: 2;
        animation: fadeInUp 0.8s ease-out;
    }

    .cta-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.75rem;
        background: var(--glass-bg);
        border: 1px solid var(--glass-border);
        backdrop-filter: blur(20px);
        padding: 1rem 2rem;
        border-radius: 50px;
        font-size: 0.875rem;
        font-weight: 700;
        margin-bottom: 2.5rem;
        text-transform: uppercase;
        letter-spacing: 0.1em;
    }

    .cta-section h3 {
        font-size: clamp(2.5rem, 4vw, 3.5rem);
        font-weight: 800;
        margin-bottom: 2rem;
        line-height: 1.2;
        background: linear-gradient(135deg, #ffffff 0%, #f0f8ff 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .cta-section p {
        font-size: 1.375rem;
        margin-bottom: 3.5rem;
        opacity: 0.95;
        line-height: 1.6;
        max-width: 700px;
        margin-left: auto;
        margin-right: auto;
    }

    .cta-buttons {
        display: flex;
        gap: 1.25rem;
        justify-content: center;
        flex-wrap: wrap;
    }

    /* Animations */
    @keyframes fadeInLeft {
        from {
            opacity: 0;
            transform: translateX(-50px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes fadeInRight {
        from {
            opacity: 0;
            transform: translateX(50px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

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

    .service-card:nth-child(1) { animation-delay: 0.1s; }
    .service-card:nth-child(2) { animation-delay: 0.2s; }

    /* Responsive Design */
    @media (max-width: 1024px) {
        .hero-content,
        .value-content {
            grid-template-columns: 1fr;
            text-align: center;
            gap: 3rem;
        }

        .services-grid {
            grid-template-columns: 1fr;
            max-width: 500px;
            margin: 4rem auto 0;
        }
    }

    @media (max-width: 768px) {
        .hero {
            padding: 6rem 0 4rem;
        }

        .hero-content {
            min-height: auto;
        }

        .hero-text h1 {
            font-size: 2.5rem;
        }

        .hero-text .subtitle {
            font-size: 1.125rem;
        }

        .hero-buttons {
            justify-content: center;
            flex-direction: column;
            align-items: center;
        }

        .btn-hero-primary,
        .btn-hero-secondary {
            width: 100%;
            max-width: 320px;
        }

        .hero-features {
            justify-content: center;
            flex-direction: column;
            gap: 1rem;
        }

        .service-card {
            padding: 2.5rem 2rem;
            min-height: 320px;
        }

        .services-section,
        .value-section,
        .cta-section {
            padding: 5rem 0;
        }

        .value-text h2 {
            font-size: 2.25rem;
        }

        .value-text p {
            font-size: 1.125rem;
        }

        .cta-buttons {
            flex-direction: column;
            align-items: center;
        }
    }

    @media (max-width: 480px) {
        .hero-container,
        .services-container,
        .value-container,
        .cta-container {
            padding: 0 1rem;
        }

        .hero-showcase {
            padding: 2rem;
        }

        .service-card {
            padding: 2rem 1.5rem;
        }

        .value-graphic {
            padding: 2rem;
        }
    }

    /* Accessibility */
    @media (prefers-reduced-motion: reduce) {
        * {
            animation-duration: 0.01ms !important;
            animation-iteration-count: 1 !important;
            transition-duration: 0.01ms !important;
        }
    }

    /* Focus states for accessibility */
    .btn-hero-primary:focus,
    .btn-hero-secondary:focus,
    .service-card:focus {
        outline: 3px solid rgba(255, 255, 255, 0.5);
        outline-offset: 2px;
    }

    /* High contrast mode support */
    @media (prefers-contrast: high) {
        .service-card {
            border-width: 2px;
        }
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-container">
            <div class="hero-content">
                <div class="hero-text">
                    <div class="hero-badge">
                        <i class="fas fa-graduation-cap"></i>
                        <span>Professional Learning Platform</span>
                    </div>
                    <h1>Master Your Tech Career Journey</h1>
                    <p class="subtitle">Transform your professional future with our comprehensive learning platform. Access expert courses, build industry connections, and accelerate your career growth with personalized guidance.</p>
                    
                    <div class="hero-buttons">
                        <?php if(auth()->guard()->check()): ?>
                            <a href="<?php echo e(url('/lms')); ?>" class="btn-hero-primary">
                                <i class="fas fa-play-circle"></i>
                                <span>Continue Learning</span>
                            </a>
                            <a href="<?php echo e(route('careerservices')); ?>" class="btn-hero-secondary">
                                <i class="fas fa-briefcase"></i>
                                <span>Career Services</span>
                            </a>
                        <?php else: ?>
                            <a href="<?php echo e(route('register')); ?>" class="btn-hero-primary">
                                <i class="fas fa-rocket"></i>
                                <span>Start Your Journey</span>
                            </a>
                            <a href="<?php echo e(route('login')); ?>" class="btn-hero-secondary">
                                <i class="fas fa-sign-in-alt"></i>
                                        <span>Continue Your Journey</span>
                            </a>
                        <?php endif; ?>
                    </div>

                    <div class="hero-features">
                        <div class="hero-feature">
                            <i class="fas fa-infinity"></i>
                            <span>Unlimited Access</span>
                        </div>
                        <div class="hero-feature">
                            <i class="fas fa-certificate"></i>
                            <span>Industry Recognized</span>
                        </div>
                        <div class="hero-feature">
                            <i class="fas fa-users"></i>
                            <span>Expert Community</span>
                        </div>
                    </div>
                </div>

                <div class="hero-visual">
                    <div class="hero-showcase">
                        <div class="showcase-header">
                            <div class="showcase-icon">
                                <i class="fas fa-chart-line"></i>
                            </div>
                            <h3 class="showcase-title">Your Learning Dashboard</h3>
                            <p class="showcase-subtitle">Track progress and achievements</p>
                        </div>
                        
                        <div class="showcase-features">
                            <div class="showcase-feature">
                                <div class="feature-icon-small">
                                    <i class="fas fa-book-open"></i>
                                </div>
                                <div class="feature-content">
                                    <h4>Interactive Courses</h4>
                                    <p>Hands-on learning with real projects</p>
                                </div>
                            </div>
                            <div class="showcase-feature">
                                <div class="feature-icon-small">
                                    <i class="fas fa-route"></i>
                                </div>
                                <div class="feature-content">
                                    <h4>Personalized Paths</h4>
                                    <p>AI-powered learning recommendations</p>
                                </div>
                            </div>
                            <div class="showcase-feature">
                                <div class="feature-icon-small">
                                    <i class="fas fa-trophy"></i>
                                </div>
                                <div class="feature-content">
                                    <h4>Career Advancement</h4>
                                    <p>Direct path to job opportunities</p>
                                </div>
                            </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="services-section">
        <div class="services-container">
            <div class="services-header">
                <div class="section-badge">
                    <i class="fas fa-star"></i>
                    <span>Core Services</span>
                </div>
                <h2>Everything You Need to Succeed</h2>
                <p class="services-subtitle">
                    Comprehensive tools and services designed to accelerate your learning journey and career advancement in the tech industry.
                </p>
            </div>
            
            <div class="services-grid">
                <a href="<?php echo e(url('/lms')); ?>" class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <h3 class="service-title">Learning Management System</h3>
                    <p class="service-description">
                        Access comprehensive courses with interactive content, practical projects, and personalized learning paths tailored to your career goals.
                    </p>
                    <div class="service-cta">
                        <span>Explore Courses</span>
                        <i class="fas fa-arrow-right"></i>
                    </div>
                </a>

                <a href="<?php echo e(route('careerservices')); ?>" class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-briefcase"></i>
                    </div>
                    <h3 class="service-title">Career Services Hub</h3>
                    <p class="service-description">
                        Professional resume building, job matching, application tracking, and career guidance to help you land your dream position.
                    </p>
                    <div class="service-cta">
                        <span>Launch Career</span>
                        <i class="fas fa-arrow-right"></i>
                    </div>
                </a>
            </div>
        </div>
    </section>

    <!-- Value Proposition Section -->
    <section class="value-section">
        <div class="value-container">
            <div class="value-content">
                <div class="value-text">
                    <h2>Why Choose SkillHub?</h2>
                    <p>
                        We combine cutting-edge learning technology with proven career development strategies to create a comprehensive platform that transforms your professional journey.
                    </p>
                    
                    <div class="value-features">
                        <div class="value-feature">
                            <div class="value-feature-icon">
                                <i class="fas fa-brain"></i>
                            </div>
                            <div class="value-feature-content">
                                <h4>AI-Powered Learning</h4>
                                <p>Personalized course recommendations and adaptive learning paths based on your goals and progress.</p>
                            </div>
                        </div>
                        <div class="value-feature">
                            <div class="value-feature-icon">
                                <i class="fas fa-briefcase"></i>
                            </div>
                            <div class="value-feature-content">
                                <h4>Career Development</h4>
                                <p>Professional resume building, job matching, and application tracking to advance your career.</p>
                            </div>
                        </div>
                        <div class="value-feature">
                            <div class="value-feature-icon">
                                <i class="fas fa-graduation-cap"></i>
                            </div>
                            <div class="value-feature-content">
                                <h4>Comprehensive Learning</h4>
                                <p>Access to interactive courses, practical projects, and skill assessments tailored to your goals.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="value-visual">
                    <div class="value-graphic">
                        <div class="value-steps">
                            <div class="value-step">
                                <div class="step-number">1</div>
                                <div class="step-content">
                                    <h4>Choose Your Path</h4>
                                    <p>Select from curated learning tracks</p>
                                </div>
                            </div>
                            <div class="value-step">
                                <div class="step-number">2</div>
                                <div class="step-content">
                                    <h4>Learn & Practice</h4>
                                    <p>Hands-on projects with expert guidance</p>
                                </div>
                            </div>
                            <div class="value-step">
                                <div class="step-number">3</div>
                                <div class="step-content">
                                    <h4>Land Your Job</h4>
                                    <p>Apply with confidence and expert support</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action Section -->
    
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Enhanced intersection observer for smooth animations
        const observerOptions = {
            threshold: 0.15,
            rootMargin: '0px 0px -100px 0px'
        };

        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        // Observe elements for fade-in animations
        document.querySelectorAll('.service-card, .value-feature, .value-step').forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(30px)';
            el.style.transition = 'all 0.8s cubic-bezier(0.4, 0, 0.2, 1)';
            observer.observe(el);
        });
        document.querySelectorAll('.service-card').forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-15px) scale(1.02)';
                
                const icon = this.querySelector('.service-icon');
                const cta = this.querySelector('.service-cta');
                
                if (icon) {
                    icon.style.transform = 'scale(1.15) rotate(8deg)';
                }
                
                if (cta) {
                    cta.style.transform = 'translateY(-5px)';
                }
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(-12px)';
                
                const icon = this.querySelector('.service-icon');
                const cta = this.querySelector('.service-cta');
                
                if (icon) {
                    icon.style.transform = 'scale(1.1) rotate(5deg)';
                }
                
                if (cta) {
                    cta.style.transform = 'translateY(0)';
                }
            });
        });

        // Smooth parallax effect for hero background
        let lastScrollY = window.pageYOffset;
        
        const handleScroll = () => {
            const scrolled = window.pageYOffset;
            const hero = document.querySelector('.hero');
            
            if (hero) {
                const rate = scrolled * -0.3;
                hero.style.transform = `translateY(${rate}px)`;
            }
            
            lastScrollY = scrolled;
        };

        // Throttled scroll handler for better performance
        let ticking = false;
        window.addEventListener('scroll', () => {
            if (!ticking) {
                requestAnimationFrame(() => {
                    handleScroll();
                    ticking = false;
                });
                ticking = true;
            }
        });

        // Enhanced button interactions with ripple effect
        document.querySelectorAll('.btn-hero-primary, .btn-hero-secondary').forEach(button => {
            button.addEventListener('click', function(e) {
                // Create ripple effect
                const ripple = document.createElement('span');
                const rect = this.getBoundingClientRect();
                const size = Math.max(rect.width, rect.height);
                const x = e.clientX - rect.left - size / 2;
                const y = e.clientY - rect.top - size / 2;
                
                ripple.style.width = ripple.style.height = size + 'px';
                ripple.style.left = x + 'px';
                ripple.style.top = y + 'px';
                ripple.classList.add('ripple');
                
                this.appendChild(ripple);
                
                setTimeout(() => {
                    ripple.remove();
                }, 600);
            });

            button.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-4px) scale(1.02)';
            });
            
            button.addEventListener('mouseleave', function() {
                this.style.transform = '';
            });
        });

        // Showcase feature animations
        document.querySelectorAll('.showcase-feature').forEach((feature, index) => {
            feature.addEventListener('mouseenter', function() {
                this.style.transform = 'translateX(8px) scale(1.02)';
                this.style.background = 'rgba(255, 255, 255, 0.2)';
            });
            
            feature.addEventListener('mouseleave', function() {
                this.style.transform = 'translateX(5px)';
                this.style.background = 'rgba(255, 255, 255, 0.15)';
            });

            // Staggered entrance animation
            setTimeout(() => {
                feature.style.transform = 'translateX(0)';
                feature.style.opacity = '1';
            }, index * 200);
        });

        // Value step interactions
        document.querySelectorAll('.value-step').forEach(step => {
            step.addEventListener('mouseenter', function() {
                this.style.transform = 'translateX(15px) scale(1.02)';
                
                const number = this.querySelector('.step-number');
                if (number) {
                    number.style.transform = 'scale(1.1) rotate(5deg)';
                }
            });
            
            step.addEventListener('mouseleave', function() {
                this.style.transform = 'translateX(10px)';
                
                const number = this.querySelector('.step-number');
                if (number) {
                    number.style.transform = 'scale(1)';
                }
            });
        });

        // Value feature hover effects
        document.querySelectorAll('.value-feature').forEach(feature => {
            feature.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-5px)';
                
                const icon = this.querySelector('.value-feature-icon');
                if (icon) {
                    icon.style.transform = 'scale(1.1) rotate(5deg)';
                }
            });
            
            feature.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
                
                const icon = this.querySelector('.value-feature-icon');
                if (icon) {
                    icon.style.transform = 'scale(1)';
                }
            });
        });

        // Hero features animation
        document.querySelectorAll('.hero-feature').forEach((feature, index) => {
            feature.style.opacity = '0';
            feature.style.transform = 'translateY(20px)';
            feature.style.transition = 'all 0.6s cubic-bezier(0.4, 0, 0.2, 1)';
            
            setTimeout(() => {
                feature.style.opacity = '1';
                feature.style.transform = 'translateY(0)';
            }, 1500 + (index * 200));
        });

        // Add click tracking for user engagement analytics
        document.querySelectorAll('a[href], button').forEach(element => {
            element.addEventListener('click', function() {
                const elementText = this.textContent.trim();
                const elementHref = this.href || 'internal-action';
                console.log(`User engagement: ${elementText} | Target: ${elementHref}`);
                // Analytics integration point
            });
        });

        // Progressive enhancement for reduced motion users
        const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)');
        
        if (prefersReducedMotion.matches) {
            // Disable complex animations for accessibility
            document.querySelectorAll('*').forEach(el => {
                el.style.animationDuration = '0.1s';
                el.style.transitionDuration = '0.1s';
            });
        }

        console.log('🎯 SkillHub Professional Home loaded successfully!');
    });

    // Add dynamic ripple effect styles
    const rippleStyles = document.createElement('style');
    rippleStyles.textContent = `
        .ripple {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.4);
            pointer-events: none;
            transform: scale(0);
            animation: ripple-animation 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        @keyframes ripple-animation {
            to {
                transform: scale(2);
                opacity: 0;
            }
        }
        
        /* Smooth focus transitions */
        *:focus {
            transition: outline 0.2s ease;
        }
        
        /* Enhanced hover states */
        .showcase-feature,
        .value-step,
        .value-feature {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
    `;
    document.head.appendChild(rippleStyles);
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ACER NITRO\Desktop\SkillHubProject\resources\views/home.blade.php ENDPATH**/ ?>