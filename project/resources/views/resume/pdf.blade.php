<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professional Resume - {{ $name }}</title>
    <style>
        /* Professional Resume Template Styles */
        :root {
            /* Primary Color Scheme - Matching other blades */
            --primary-gradient: linear-gradient(135deg, #2563eb, #10b981);
            --primary-color: #2563eb;
            --primary-dark: #1d4ed8;
            --accent-color: #10b981;
            --accent-dark: #059669;
            
            /* Text colors */
            --text-primary: #1a202c;
            --text-secondary: #4a5568;
            --text-light: #718096;
            --text-white: #ffffff;
            
            /* Surface colors */
            --surface-white: #ffffff;
            --surface-light: #f7fafc;
            --surface-gray: #edf2f7;
            --border-light: rgba(0, 0, 0, 0.06);
            --border-medium: rgba(0, 0, 0, 0.12);
            
            /* Shadows */
            --shadow-subtle: 0 1px 3px rgba(0, 0, 0, 0.05);
            --shadow-medium: 0 4px 12px rgba(0, 0, 0, 0.15);
            --shadow-large: 0 8px 25px rgba(0, 0, 0, 0.2);
            
            /* Border radius */
            --border-radius: 16px;
            --border-radius-large: 20px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Roboto', 'Oxygen', 'Ubuntu', 'Cantarell', sans-serif;
            line-height: 1.6;
            color: var(--text-primary);
            background: var(--surface-light);
            padding: 20px;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        /* Professional Resume Container */
        .resume-container {
            max-width: 850px;
            margin: 0 auto;
            background: var(--surface-white);
            box-shadow: var(--shadow-large);
            border-radius: var(--border-radius-large);
            overflow: hidden;
            position: relative;
        }

        /* Professional Header Section */
        .resume-header {
            background: var(--primary-gradient);
            color: var(--text-white);
            padding: 3rem 3rem 2rem;
            position: relative;
            overflow: hidden;
        }

        .resume-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                radial-gradient(circle at 80% 20%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 20% 80%, rgba(255, 255, 255, 0.05) 0%, transparent 50%);
            z-index: 1;
        }

        .header-content {
            position: relative;
            z-index: 2;
            text-align: center;
        }

        .name-title {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 0.5rem;
            letter-spacing: -0.02em;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .professional-subtitle {
            font-size: 1.125rem;
            opacity: 0.9;
            font-weight: 500;
            margin-bottom: 2rem;
            letter-spacing: 0.025em;
        }

        /* Contact Information Grid */
        .contact-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-top: 1.5rem;
        }

        .contact-item {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 12px;
            padding: 1rem;
            text-align: center;
            transition: all 0.3s ease;
        }

        .contact-icon {
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 0.5rem;
            font-size: 1.125rem;
        }

        .contact-label {
            font-size: 0.875rem;
            opacity: 0.8;
            margin-bottom: 0.25rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            font-weight: 600;
        }

        .contact-value {
            font-size: 1rem;
            font-weight: 500;
            word-break: break-all;
        }

        /* Resume Content */
        .resume-content {
            padding: 3rem;
        }

        /* Section Styling */
        .resume-section {
            margin-bottom: 3rem;
        }

        .resume-section:last-child {
            margin-bottom: 0;
        }

        .section-header {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid var(--surface-gray);
            position: relative;
        }

        .section-header::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 60px;
            height: 2px;
            background: var(--primary-gradient);
            border-radius: 1px;
        }

        .section-icon {
            width: 48px;
            height: 48px;
            background: var(--primary-gradient);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.25rem;
        }

        .section-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--text-primary);
            margin: 0;
        }

        /* Summary Section */
        .summary-content {
            background: linear-gradient(135deg, var(--surface-light) 0%, rgba(37, 99, 235, 0.03) 100%);
            border: 1px solid var(--border-light);
            border-radius: var(--border-radius);
            padding: 2rem;
            position: relative;
            overflow: hidden;
        }

        .summary-content::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background: var(--primary-gradient);
        }

        .summary-text {
            font-size: 1.125rem;
            line-height: 1.7;
            color: var(--text-secondary);
            font-style: italic;
            margin: 0;
            position: relative;
            z-index: 1;
        }

        /* Quote styling for summary */
        .summary-text::before {
            content: '"';
            font-size: 4rem;
            color: var(--primary-color);
            opacity: 0.1;
            position: absolute;
            top: -1rem;
            left: -0.5rem;
            font-family: Georgia, serif;
            line-height: 1;
        }

        /* Skills Section (if added later) */
        .skills-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-top: 1rem;
        }

        .skill-item {
            background: var(--surface-light);
            border: 1px solid var(--border-light);
            border-radius: 12px;
            padding: 1rem;
            text-align: center;
            transition: all 0.3s ease;
        }

        .skill-item:hover {
            box-shadow: var(--shadow-medium);
            transform: translateY(-2px);
        }

        /* Professional Footer */
        .resume-footer {
            background: linear-gradient(135deg, var(--surface-gray) 0%, var(--surface-light) 100%);
            padding: 2rem 3rem;
            text-align: center;
            border-top: 1px solid var(--border-light);
            position: relative;
        }

        .footer-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .brand-info {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .brand-logo {
            width: 32px;
            height: 32px;
            background: var(--primary-gradient);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 1rem;
        }

        .brand-text {
            font-size: 0.95rem;
            color: var(--text-secondary);
            font-weight: 500;
        }

        .generation-date {
            font-size: 0.875rem;
            color: var(--text-light);
            font-weight: 500;
        }

        /* Decorative Elements */
        .decorative-element {
            position: absolute;
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: linear-gradient(135deg, rgba(37, 99, 235, 0.1), rgba(16, 185, 129, 0.1));
            top: -50px;
            right: -50px;
            z-index: 0;
        }

        /* Print Styles */
        @media print {
            body {
                background: white;
                padding: 0;
            }
            
            .resume-container {
                box-shadow: none;
                border-radius: 0;
                max-width: 100%;
            }
            
            .resume-header,
            .resume-content,
            .resume-footer {
                padding: 1.5rem;
            }
            
            .contact-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .decorative-element {
                display: none;
            }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            body {
                padding: 10px;
            }
            
            .resume-header {
                padding: 2rem 1.5rem;
            }
            
            .resume-content {
                padding: 2rem 1.5rem;
            }
            
            .resume-footer {
                padding: 1.5rem;
            }
            
            .name-title {
                font-size: 2rem;
            }
            
            .contact-grid {
                grid-template-columns: 1fr;
                gap: 0.75rem;
            }
            
            .footer-content {
                flex-direction: column;
                text-align: center;
            }
        }

        @media (max-width: 480px) {
            .name-title {
                font-size: 1.75rem;
            }
            
            .professional-subtitle {
                font-size: 1rem;
            }
            
            .section-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.75rem;
            }
            
            .summary-content {
                padding: 1.5rem;
            }
        }

        /* Professional Typography */
        h1, h2, h3, h4, h5, h6 {
            font-weight: 600;
            letter-spacing: -0.025em;
        }

        p {
            font-weight: 400;
        }

        /* Enhanced Visual Hierarchy */
        .resume-section:nth-child(odd) .section-icon {
            background: var(--primary-gradient);
        }

        .resume-section:nth-child(even) .section-icon {
            background: linear-gradient(135deg, var(--accent-color), var(--accent-dark));
        }

        /* Professional Badge Styling */
        .professional-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.875rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        /* Accessibility Improvements */
        @media (prefers-reduced-motion: reduce) {
            * {
                transition: none !important;
                animation: none !important;
            }
        }

        /* High Contrast Mode Support */
        @media (prefers-contrast: high) {
            :root {
                --border-light: rgba(0, 0, 0, 0.3);
                --border-medium: rgba(0, 0, 0, 0.5);
            }
            
            .contact-item,
            .summary-content,
            .skill-item {
                border-width: 2px;
            }
        }
    </style>
</head>
<body>
    <div class="resume-container">
        <!-- Professional Header -->
        <header class="resume-header">
            <div class="decorative-element"></div>
            <div class="header-content">
                <h1 class="name-title">{{ $name }}</h1>
                <p class="professional-subtitle">Professional Resume</p>
                
                <!-- Contact Information Grid -->
                <div class="contact-grid">
                    <div class="contact-item">
                        <div class="contact-icon">
                            📧
                        </div>
                        <div class="contact-label">Email</div>
                        <div class="contact-value">{{ $email }}</div>
                    </div>
                    
                    <div class="contact-item">
                        <div class="contact-icon">
                            📱
                        </div>
                        <div class="contact-label">Phone</div>
                        <div class="contact-value">{{ $phone }}</div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Resume Content -->
        <main class="resume-content">
            <!-- Professional Summary Section -->
            <section class="resume-section">
                <div class="section-header">
                    <div class="section-icon">
                        👤
                    </div>
                    <h2 class="section-title">Professional Summary</h2>
                </div>
                <div class="summary-content">
                    <p class="summary-text">{{ $summary }}</p>
                </div>
            </section>

            <!-- Additional sections can be added here -->
            <!-- Example: Skills Section (uncomment if needed)
            <section class="resume-section">
                <div class="section-header">
                    <div class="section-icon">
                        🎯
                    </div>
                    <h2 class="section-title">Core Skills</h2>
                </div>
                <div class="skills-grid">
                    <div class="skill-item">
                        <strong>Leadership</strong>
                    </div>
                    <div class="skill-item">
                        <strong>Communication</strong>
                    </div>
                    <div class="skill-item">
                        <strong>Problem Solving</strong>
                    </div>
                    <div class="skill-item">
                        <strong>Team Collaboration</strong>
                    </div>
                </div>
            </section>
            -->
        </main>

        <!-- Professional Footer -->
        <footer class="resume-footer">
            <div class="footer-content">
                <div class="brand-info">
                    <div class="brand-logo">
                        SH
                    </div>
                    <span class="brand-text">Generated by SkillHub</span>
                </div>
                <div class="generation-date">
                    Generated on {{ date('F j, Y') }}
                </div>
            </div>
        </footer>
    </div>
</body>
</html>