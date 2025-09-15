<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'SkillHub - Professional Learning & Career Platform')</title>
    <meta name="description" content="@yield('description', 'Advance your career with SkillHub - Complete learning management system with personalized career development tools')">
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- External Libraries -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --primary-color: #2563eb;
            --primary-dark: #1d4ed8;
            --primary-gradient: linear-gradient(135deg, #2563eb, #10b981);
            --accent-color: #10b981;
            --accent-dark: #059669;
            --secondary-color: #f59e0b;
            --warning-color: #ef4444;
            --success-color: #10b981;
            --info-color: #06b6d4;
            --text-primary: #1a202c;
            --text-secondary: #4a5568;
            --text-light: #718096;
            --text-white: #ffffff;
            --bg-primary: #ffffff;
            --bg-secondary: #f7fafc;
            --bg-card: #ffffff;
            --bg-overlay: rgba(26, 32, 44, 0.8);
            --border-color: #e2e8f0;
            --border-light: #f1f5f9;
            --shadow-sm: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
            --shadow-2xl: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            --radius-lg: 12px;
            --radius-xl: 16px;
            --radius-2xl: 20px;
            --radius-full: 9999px;
            --space-sm: 0.5rem;
            --space-md: 1rem;
            --space-lg: 1.5rem;
            --space-xl: 2rem;
            --space-2xl: 3rem;
            --animation-normal: 0.3s;
            --ease-out: cubic-bezier(0, 0, 0.2, 1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
            height: 100%;
            scroll-padding-top: 80px;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            line-height: 1.6;
            color: var(--text-primary);
            background-color: var(--bg-secondary);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        header {
            background: var(--bg-card);
            box-shadow: var(--shadow-sm);
            position: sticky;
            top: 0;
            z-index: 1000;
            border-bottom: 1px solid var(--border-light);
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.95);
        }

        nav {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 var(--space-lg);
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 75px;
            position: relative;
        }

        .logo {
            font-size: 1.75rem;
            font-weight: 800;
            color: var(--primary-color);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: var(--space-sm);
            transition: all var(--animation-normal) var(--ease-out);
        }

        .logo:hover {
            transform: translateY(-1px);
            color: var(--primary-dark);
        }

        .logo-icon {
            width: 40px;
            height: 40px;
            background: var(--primary-gradient);
            border-radius: var(--radius-lg);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 1.1rem;
            box-shadow: var(--shadow-md);
            position: relative;
            overflow: hidden;
        }

        .logo-icon::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: left 0.6s ease;
        }

        .logo:hover .logo-icon::before {
            left: 100%;
        }

        .nav-right-section {
            display: flex;
            align-items: center;
            gap: var(--space-md);
        }

        .nav-user-info {
            display: flex;
            align-items: center;
            gap: var(--space-sm);
        }

        .user-profile-section {
            display: flex;
            align-items: center;
            gap: var(--space-sm);
            padding: var(--space-sm) var(--space-md);
            background: var(--bg-secondary);
            border-radius: var(--radius-xl);
            border: 2px solid var(--border-color);
            transition: all var(--animation-normal) var(--ease-out);
            cursor: pointer;
        }

        .user-profile-section:hover {
            background: var(--bg-card);
            box-shadow: var(--shadow-md);
            transform: translateY(-2px);
            border-color: var(--primary-color);
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--primary-gradient);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 1rem;
            box-shadow: var(--shadow-sm);
            transition: all var(--animation-normal) var(--ease-out);
        }

        .user-profile-section:hover .user-avatar {
            transform: scale(1.1);
            box-shadow: var(--shadow-md);
        }

        .user-details {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .user-name {
            font-size: 0.95rem;
            font-weight: 600;
            color: var(--text-primary);
            line-height: 1.2;
        }

        .user-role {
            font-size: 0.75rem;
            color: var(--text-light);
            text-transform: uppercase;
            letter-spacing: 0.05em;
            font-weight: 500;
        }

        .mobile-menu-toggle {
            display: flex;
            background: var(--primary-color);
            border: 2px solid var(--primary-dark);
            font-size: 1.25rem;
            color: white;
            cursor: pointer;
            padding: var(--space-sm);
            border-radius: var(--radius-lg);
            transition: all var(--animation-normal) var(--ease-out);
            width: 45px;
            height: 45px;
            justify-content: center;
            align-items: center;
            box-shadow: var(--shadow-md);
        }

        .mobile-menu-toggle:hover {
            background: var(--primary-dark);
            transform: scale(1.05);
            box-shadow: var(--shadow-lg);
        }

        .mobile-menu-toggle.active {
            background: var(--warning-color);
            border-color: #dc2626;
        }

        .mobile-menu-toggle i {
            transition: all var(--animation-normal) var(--ease-out);
        }

        .menu-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
            backdrop-filter: blur(4px);
        }

        .menu-overlay.active {
            display: block;
        }

        .mobile-menu {
            display: none;
            position: fixed;
            top: 75px;
            right: 0;
            width: 320px;
            max-height: calc(100vh - 75px);
            background: var(--bg-card);
            box-shadow: var(--shadow-2xl);
            border: 1px solid var(--border-light);
            border-radius: var(--radius-xl) 0 0 var(--radius-xl);
            overflow-y: auto;
            animation: slideInRight var(--animation-normal) var(--ease-out);
            z-index: 1000;
        }

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

        .mobile-menu.active {
            display: block;
        }

        .menu-header {
            background: var(--primary-gradient);
            color: white;
            padding: var(--space-xl);
            border-radius: var(--radius-xl) 0 0 0;
        }

        .menu-user-info {
            display: flex;
            align-items: center;
            gap: var(--space-md);
            margin-bottom: var(--space-md);
        }

        .menu-user-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 1.25rem;
            border: 2px solid rgba(255, 255, 255, 0.3);
        }

        .menu-user-details h3 {
            margin: 0;
            font-size: 1.1rem;
            font-weight: 600;
        }

        .menu-user-details p {
            margin: 0;
            font-size: 0.85rem;
            opacity: 0.9;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .menu-welcome {
            font-size: 0.9rem;
            opacity: 0.9;
            margin: 0;
        }

        .mobile-menu ul {
            list-style: none;
            margin: 0;
            padding: var(--space-lg) 0;
            display: flex;
            flex-direction: column;
            gap: 0;
        }

        .mobile-menu ul li {
            margin: 0;
        }

        .mobile-menu ul li a {
            display: flex;
            align-items: center;
            padding: var(--space-lg) var(--space-xl);
            color: var(--text-secondary);
            font-weight: 500;
            gap: var(--space-md);
            transition: all var(--animation-normal) var(--ease-out);
            text-decoration: none;
            border-left: 4px solid transparent;
            position: relative;
        }

        .mobile-menu ul li a::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 0;
            background: var(--primary-gradient);
            transition: width var(--animation-normal) var(--ease-out);
        }

        .mobile-menu ul li a:hover {
            background: rgba(37, 99, 235, 0.05);
            color: var(--primary-color);
            transform: translateX(5px);
            border-left-color: var(--primary-color);
        }

        .mobile-menu ul li a:hover::before {
            width: 4px;
        }

        .mobile-menu ul li a.active {
            background: var(--primary-color);
            color: white;
            font-weight: 600;
            border-left-color: var(--primary-dark);
        }

        .mobile-menu ul li a.active::before {
            width: 4px;
            background: var(--primary-dark);
        }

        .mobile-menu ul li a i {
            font-size: 1.1rem;
            width: 24px;
            text-align: center;
            opacity: 0.8;
        }

        .mobile-menu ul li a:hover i,
        .mobile-menu ul li a.active i {
            opacity: 1;
        }

        .nav-role-indicator {
            display: inline-flex;
            align-items: center;
            padding: 4px 10px;
            background: var(--accent-color);
            color: white;
            font-size: 0.65rem;
            border-radius: var(--radius-full);
            margin-left: auto;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            box-shadow: var(--shadow-sm);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .nav-role-admin { 
            background: linear-gradient(135deg, #dc2626, #ef4444);
        }
        .nav-role-hr { 
            background: linear-gradient(135deg, #7c3aed, #8b5cf6);
        }
        .nav-role-instructor { 
            background: linear-gradient(135deg, #059669, #10b981);
        }
        .nav-role-career { 
            background: linear-gradient(135deg, #ea580c, #f97316);
        }

        .menu-section {
            border-top: 1px solid var(--border-light);
            padding: var(--space-md) 0;
        }

        .menu-section-title {
            padding: var(--space-sm) var(--space-xl);
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--text-light);
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin: 0;
        }

        .menu-logout {
            border-top: 2px solid var(--border-light);
            padding: var(--space-lg);
        }

        .logout-button {
            background: linear-gradient(135deg, #ef4444, #dc2626) !important;
            color: white !important;
            padding: var(--space-md) var(--space-lg) !important;
            border-radius: var(--radius-lg) !important;
            font-weight: 600 !important;
            justify-content: center !important;
            border: none !important;
            box-shadow: var(--shadow-md) !important;
            width: 100% !important;
            display: flex !important;
            align-items: center !important;
            gap: var(--space-sm) !important;
            transition: all var(--animation-normal) var(--ease-out) !important;
            text-decoration: none !important;
            cursor: pointer !important;
        }

        .logout-button:hover {
            background: linear-gradient(135deg, #dc2626, #b91c1c) !important;
            transform: translateY(-2px) !important;
            box-shadow: var(--shadow-lg) !important;
        }

        main {
            flex: 1;
            width: 100%;
            position: relative;
        }

        /* COMPACT FOOTER */
        footer {
            background: var(--text-primary);
            color: var(--text-white);
            margin-top: auto;
            position: relative;
            overflow: hidden;
        }

        footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: var(--primary-gradient);
            opacity: 0.08;
            z-index: -1;
        }

        .footer-content {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 var(--space-lg);
        }

        /* Compact Footer Main Content */
        .footer-main {
            display: grid;
            grid-template-columns: 1.5fr 1fr 1fr;
            gap: var(--space-xl);
            padding: var(--space-xl) 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.15);
        }

        .footer-section {
            display: flex;
            flex-direction: column;
            gap: var(--space-md);
        }

        /* Compact Company Info */
        .company-info {
            max-width: 350px;
        }

        .footer-logo {
            display: flex;
            align-items: center;
            gap: var(--space-sm);
            margin-bottom: var(--space-md);
        }

        .footer-logo .logo-icon {
            width: 32px;
            height: 32px;
            background: var(--primary-gradient);
            border-radius: var(--radius-lg);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 0.9rem;
        }

        .footer-logo .logo-text {
            font-size: 1.25rem;
            font-weight: 800;
            color: white;
        }

        .company-description {
            color: rgba(255, 255, 255, 0.8);
            line-height: 1.5;
            margin-bottom: var(--space-sm);
            font-size: 0.9rem;
        }

        /* Compact Footer Titles */
        .footer-title {
            color: white;
            font-size: 1rem;
            font-weight: 700;
            margin: 0 0 var(--space-sm) 0;
            position: relative;
        }

        .footer-title::after {
            content: '';
            position: absolute;
            bottom: -6px;
            left: 0;
            width: 25px;
            height: 2px;
            background: var(--accent-color);
            border-radius: 2px;
        }

        /* Compact Contact Info */
        .contact-info {
            display: flex;
            flex-direction: column;
            gap: var(--space-sm);
        }

        .contact-item {
            display: flex;
            align-items: center;
            gap: var(--space-sm);
            color: rgba(255, 255, 255, 0.8);
            cursor: pointer;
            transition: all var(--animation-normal) var(--ease-out);
            padding: var(--space-sm);
            border-radius: var(--radius-lg);
            font-size: 0.9rem;
        }

        .contact-item:hover {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            transform: translateX(3px);
        }

        .contact-item i {
            color: var(--accent-color);
            width: 14px;
            text-align: center;
            flex-shrink: 0;
        }

        /* Compact Help Center */
        .help-links {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .help-links a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: all var(--animation-normal) var(--ease-out);
            padding: var(--space-sm) 0;
            position: relative;
            display: flex;
            align-items: center;
            gap: var(--space-sm);
            border-radius: var(--radius-lg);
            font-size: 0.9rem;
        }

        .help-links a::before {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 0;
            height: 2px;
            background: var(--accent-color);
            transition: width var(--animation-normal) var(--ease-out);
        }

        .help-links a:hover {
            color: white;
            transform: translateX(3px);
            background: rgba(255, 255, 255, 0.05);
            padding-left: var(--space-sm);
        }

        .help-links a:hover::before {
            width: 100%;
        }

        .help-links a i {
            color: var(--accent-color);
            width: 14px;
            text-align: center;
            font-size: 0.85rem;
        }

        /* Compact Footer Bottom */
        .footer-bottom {
            padding: var(--space-md) 0;
        }

        .footer-bottom-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: var(--space-md);
        }

        .copyright p {
            color: rgba(255, 255, 255, 0.7);
            margin: 0;
            font-size: 0.85rem;
        }

        .legal-links {
            display: flex;
            gap: var(--space-md);
            flex-wrap: wrap;
        }

        .legal-links a {
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            font-size: 0.85rem;
            transition: all var(--animation-normal) var(--ease-out);
        }

        .legal-links a:hover {
            color: white;
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(5px);
        }

        .modal-content {
            background-color: var(--bg-card);
            margin: 5% auto;
            padding: 0;
            border-radius: var(--radius-xl);
            width: 90%;
            max-width: 900px;
            box-shadow: var(--shadow-xl);
            animation: modalSlideIn 0.3s ease-out;
        }

        @keyframes modalSlideIn {
            from {
                opacity: 0;
                transform: translateY(-50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .modal-header {
            background: var(--primary-gradient);
            color: white;
            padding: var(--space-xl);
            border-radius: var(--radius-xl) var(--radius-xl) 0 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-header h2 {
            margin: 0;
            font-size: 1.5rem;
            font-weight: 700;
        }

        .close {
            color: white;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
            border: none;
            background: none;
            padding: var(--space-sm);
            border-radius: 50%;
            transition: all var(--animation-normal) var(--ease-out);
        }

        .close:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: scale(1.1);
        }

        .modal-body {
            padding: var(--space-xl);
            max-height: 60vh;
            overflow-y: auto;
        }

        .help-category {
            background: var(--bg-secondary);
            padding: var(--space-lg);
            border-radius: var(--radius-lg);
            margin-bottom: var(--space-lg);
            border-left: 4px solid var(--primary-color);
        }

        .help-category h3 {
            color: var(--primary-color);
            margin-bottom: var(--space-md);
            font-size: 1.1rem;
            display: flex;
            align-items: center;
            gap: var(--space-sm);
        }

        .help-item {
            padding: var(--space-sm) 0;
            border-bottom: 1px solid var(--border-light);
        }

        .help-item:last-child {
            border-bottom: none;
        }

        .help-item a {
            color: var(--text-secondary);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: var(--space-sm);
            transition: all var(--animation-normal) var(--ease-out);
            padding: var(--space-sm);
            border-radius: var(--radius-lg);
        }

        .help-item a:hover {
            color: var(--primary-color);
            background: rgba(37, 99, 235, 0.05);
            transform: translateX(5px);
        }

        .help-item a i {
            color: var(--accent-color);
            width: 16px;
        }

        /* Responsive Footer */
        @media (max-width: 768px) {
            nav {
                padding: 0 var(--space-md);
                height: 65px;
            }
            
            .user-details {
                display: none;
            }
            
            .user-avatar {
                width: 36px;
                height: 36px;
                font-size: 0.9rem;
            }

            .mobile-menu {
                width: 280px;
                top: 65px;
            }

            .footer-content {
                padding: 0 var(--space-md);
            }

            .footer-main {
                grid-template-columns: 1fr;
                gap: var(--space-lg);
                padding: var(--space-lg) 0;
            }

            .company-info {
                max-width: none;
                text-align: center;
            }

            .footer-bottom-content {
                flex-direction: column;
                text-align: center;
                gap: var(--space-sm);
            }

            .legal-links {
                justify-content: center;
                gap: var(--space-sm);
            }

            .modal-content {
                margin: 10% var(--space-md);
                width: calc(100% - 2rem);
            }
        }

        @media (max-width: 480px) {
            nav {
                padding: 0 var(--space-sm);
                height: 60px;
            }
            
            .logo {
                font-size: 1.25rem;
            }
            
            .logo-icon {
                width: 28px;
                height: 28px;
                font-size: 0.8rem;
            }

            .mobile-menu {
                width: 100%;
                top: 60px;
                border-radius: 0;
            }

            .menu-header {
                border-radius: 0;
            }

            .legal-links {
                flex-direction: column;
                gap: var(--space-sm);
            }

            .footer-main {
                padding: var(--space-md) 0;
            }
        }

        .alert {
            padding: var(--space-lg) var(--space-xl);
            border-radius: var(--radius-lg);
            margin: var(--space-lg) auto;
            font-weight: 500;
            max-width: 1400px;
            position: relative;
            display: flex;
            align-items: center;
            gap: var(--space-md);
            border-left: 4px solid;
            backdrop-filter: blur(10px);
            animation: slideInDown var(--animation-normal) var(--ease-out);
        }

        @keyframes slideInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .alert::before {
            content: '';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            font-size: 1.25rem;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }

        .alert-success {
            background: rgba(16, 185, 129, 0.1);
            color: var(--success-color);
            border-color: var(--success-color);
        }

        .alert-success::before {
            content: '\f00c';
            background: var(--success-color);
        }

        .alert-error {
            background: rgba(239, 68, 68, 0.1);
            color: var(--warning-color);
            border-color: var(--warning-color);
        }

        .alert-error::before {
            content: '\f071';
            background: var(--warning-color);
        }

        .alert-info {
            background: rgba(6, 182, 212, 0.1);
            color: var(--info-color);
            border-color: var(--info-color);
        }

        .alert-info::before {
            content: '\f05a';
            background: var(--info-color);
        }

        .alert-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: var(--space-sm);
        }

        .alert-close {
            background: none;
            border: none;
            color: currentColor;
            cursor: pointer;
            padding: var(--space-sm);
            border-radius: 50%;
            transition: all var(--animation-normal) var(--ease-out);
            opacity: 0.7;
            width: 35px;
            height: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .alert-close:hover {
            opacity: 1;
            background: rgba(0, 0, 0, 0.1);
            transform: scale(1.1);
        }

        @keyframes slideOutUp {
            from {
                opacity: 1;
                transform: translateY(0);
            }
            to {
                opacity: 0;
                transform: translateY(-20px);
            }
        }

        .loading-spinner {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            border-top-color: currentColor;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }
    </style>

    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    @yield('styles')
</head>
<body>
    <header>
        <nav>
            <a href="{{ route('home') }}" class="logo">
                <div class="logo-icon">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                SkillHub
            </a>

            <div class="nav-right-section">
                <div class="nav-user-info">
                    @auth
                    <div class="user-profile-section" onclick="window.location.href='{{ route('profile.edit') }}'">
                        <div class="user-avatar">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>
                        <div class="user-details">
                            <span class="user-name">{{ auth()->user()->name }}</span>
                            <span class="user-role">
                                @if(auth()->user()->role === 'careerM')
                                    Career Manager
                                @else
                                    {{ ucfirst(auth()->user()->role) }}
                                @endif
                            </span>
                        </div>
                    </div>
                    @endauth
                    @guest
                    <div class="user-profile-section" onclick="window.location.href='{{ route('login') }}'">
                        <div class="user-avatar">
                            G
                        </div>
                        <div class="user-details">
                            <span class="user-name">Guest</span>
                            <span class="user-role">Visitor</span>
                        </div>
                    </div>
                    @endguest
                </div>

                <button class="mobile-menu-toggle" onclick="toggleMobileMenu()">
                    <i class="fas fa-bars"></i>
                </button>
            </div>

            <div class="menu-overlay" id="menuOverlay" onclick="closeMobileMenu()"></div>

            <div class="mobile-menu" id="mobileMenu">
                <div class="menu-header">
                    <div class="menu-user-info">
                        <div class="menu-user-avatar">
                            {{ auth()->check() ? strtoupper(substr(auth()->user()->name, 0, 1)) : 'G' }}
                        </div>
                        <div class="menu-user-details">
                            @auth
                            <h3>{{ auth()->user()->name }}</h3>
                            <p>
                                @if(auth()->user()->role === 'careerM')
                                    Career Manager
                                @else
                                    {{ ucfirst(auth()->user()->role) }}
                                @endif
                            </p>
                            @endauth
                            @guest
                            <h3>Guest User</h3>
                            <p>Visitor</p>
                            @endguest
                        </div>
                    </div>
                    <p class="menu-welcome">Welcome to SkillHub</p>
                </div>

                <ul>
                    @guest
                        <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">
                            <i class="fas fa-home"></i>
                            Home
                        </a></li>
                        <li><a href="{{ url('/lms') }}" class="{{ request()->is('lms*') ? 'active' : '' }}">
                            <i class="fas fa-book"></i>
                            LMS
                        </a></li>
                        <li><a href="{{ route('careerservices') }}" class="{{ request()->routeIs('careerservices') ? 'active' : '' }}">
                            <i class="fas fa-briefcase"></i>
                            Career Services
                        </a></li>
                    @endguest

                    @auth
                        @if(auth()->user()->role === 'admin')
                            <li><a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.*') ? 'active' : '' }}">
                                <i class="fas fa-tachometer-alt"></i>
                                Admin Dashboard
                            </a></li>
                            <li><a href="{{ route('admin.applications') }}" class="{{ request()->routeIs('admin.applications') ? 'active' : '' }}">
                                <i class="fas fa-file-alt"></i>
                                Job Applications
                            </a></li>
                        @endif

                        @if(auth()->user()->role === 'user')
                            <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">
                                <i class="fas fa-home"></i>
                                Home
                            </a></li>
                            <li><a href="{{ url('/lms') }}" class="{{ request()->is('lms*') ? 'active' : '' }}">
                                <i class="fas fa-book"></i>
                                LMS
                            </a></li>
                            <li><a href="{{ route('careerservices') }}" class="{{ request()->routeIs('careerservices') ? 'active' : '' }}">
                                <i class="fas fa-briefcase"></i>
                                Career Services
                            </a></li>
                        @endif

                        @if(auth()->user()->role === 'instructor')
                            <li><a href="{{ route('instructor.dashboard') }}" class="{{ request()->routeIs('instructor.*') ? 'active' : '' }}">
                                <i class="fas fa-chalkboard-teacher"></i>
                                Instructor Dashboard
                            </a></li>
                        @endif

                        @if(auth()->user()->role === 'careerM')
                            <li><a href="{{ route('careerM.jobs') }}" class="{{ request()->routeIs('careerM.jobs') ? 'active' : '' }}">
                                <i class="fas fa-briefcase"></i>
                                Jobs
                            </a></li>
                            <li><a href="{{ route('careerM.career-advice') }}" class="{{ request()->routeIs('careerM.career-advice') ? 'active' : '' }}">
                                <i class="fas fa-lightbulb"></i>
                                Career Advice
                            </a></li>
                            <li><a href="{{ route('careerM.applications') }}" class="{{ request()->routeIs('careerM.applications') ? 'active' : '' }}">
                                <i class="fas fa-file-alt"></i>
                                Job Applications
                            </a></li>
                        @endif
                    @endauth
                </ul>

                @auth
                <div class="menu-section">
                    <h4 class="menu-section-title">Account</h4>
                    <ul>
                        <li><a href="{{ route('profile.edit') }}" class="{{ request()->routeIs('profile.*') ? 'active' : '' }}">
                            <i class="fas fa-user-cog"></i>
                            Profile Settings
                        </a></li>
                    </ul>
                </div>
                @endauth

                @guest
                <div class="menu-section">
                    <h4 class="menu-section-title">Get Started</h4>
                    <ul>
                        <li><a href="{{ route('login') }}" class="{{ request()->routeIs('login') ? 'active' : '' }}">
                            <i class="fas fa-sign-in-alt"></i>
                            Sign In
                        </a></li>
                        <li><a href="{{ route('register') }}" class="{{ request()->routeIs('register') ? 'active' : '' }}">
                            <i class="fas fa-user-plus"></i>
                            Create Account
                        </a></li>
                    </ul>
                </div>
                @endguest

                @auth
                <div class="menu-logout">
                    <a href="{{ route('logout') }}" 
                       onclick="event.preventDefault(); document.getElementById('logout-form-mobile').submit();"
                       class="logout-button">
                        <i class="fas fa-sign-out-alt"></i>
                        Sign Out
                    </a>
                    <form id="logout-form-mobile" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
                @endauth
            </div>
        </nav>
    </header>

    @if(session('success'))
        <div class="alert alert-success">
            <div class="alert-content">
                <strong>Success!</strong>
                <span>{{ session('success') }}</span>
            </div>
            <button class="alert-close" onclick="this.parentElement.style.display='none'">
                <i class="fas fa-times"></i>
            </button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-error">
            <div class="alert-content">
                <strong>Error!</strong>
                <span>{{ session('error') }}</span>
            </div>
            <button class="alert-close" onclick="this.parentElement.style.display='none'">
                <i class="fas fa-times"></i>
            </button>
        </div>
    @endif

    @if(session('info'))
        <div class="alert alert-info">
            <div class="alert-content">
                <strong>Info!</strong>
                <span>{{ session('info') }}</span>
            </div>
            <button class="alert-close" onclick="this.parentElement.style.display='none'">
                <i class="fas fa-times"></i>
            </button>
        </div>
    @endif

    <main>
        @yield('content')
    </main>

    <!-- COMPACT FOOTER -->
    <footer>
        <div class="footer-content">
            <div class="footer-main">
                <!-- Company Info -->
                <div class="footer-section company-info">
                    <div class="footer-logo">
                        <div class="logo-icon">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <span class="logo-text">SkillHub</span>
                    </div>
                    <p class="company-description">
                        Professional learning management system designed for career advancement and skill development.
                    </p>
                </div>

                <!-- Contact Section -->
                <div class="footer-section">
                    <h4 class="footer-title">Contact Us</h4>
                    <div class="contact-info">
                        <div class="contact-item" onclick="window.open('mailto:skillhub@gmail.com')">
                            <i class="fas fa-envelope"></i>
                            <span>skillhub@gmail.com</span>
                        </div>
                        <div class="contact-item" onclick="window.open('tel:+96181032851')">
                            <i class="fas fa-phone"></i>
                            <span>+961 81-032-851/81-395-437</span>
                        </div>
                    </div>
                </div>

                <!-- Help Center -->
                <div class="footer-section">
                    <h4 class="footer-title">Help Center</h4>
                    <ul class="help-links">
                        <li><a href="#" onclick="openHelpModal('platform')">
                            <i class="fas fa-question-circle"></i>
                            Platform Guide
                        </a></li>
                        <li><a href="#" onclick="openHelpModal('account')">
                            <i class="fas fa-user-cog"></i>
                            Account Support
                        </a></li>
                        <li><a href="#" onclick="openHelpModal('technical')">
                            <i class="fas fa-tools"></i>
                            Technical Help
                        </a></li>
                    </ul>
                </div>
            </div>

            <div class="footer-bottom">
                <div class="footer-bottom-content">
                    <div class="copyright">
                        <p>&copy; {{ date('Y') }} SkillHub. All rights reserved.</p>
                    </div>
                    <div class="legal-links">
                        <a href="#" onclick="openLegalModal('privacy')">Privacy</a>
                        <a href="#" onclick="openLegalModal('terms')">Terms</a>
                        <a href="#" onclick="openLegalModal('cookies')">Cookies</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>


    <!-- Help Modal (add this just before </body>) -->
    <div id="helpModal" class="modal" tabindex="-1" role="dialog" aria-modal="true" aria-labelledby="helpModalTitle" style="display:none;">
        <div class="modal-content">
            <div class="modal-header">
                <h2 id="helpModalTitle"><i class="fas fa-question-circle"></i> Help Center</h2>
                <button class="close" onclick="closeModal('helpModal')" aria-label="Close">&times;</button>
            </div>
            <div class="modal-body" id="helpModalContent">
                <!-- Help content will be injected here -->
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
    
    <script>
        // Add this variable to track the current help category
        let currentHelpCategory = 'platform';

        function toggleMobileMenu() {
            const mobileMenu = document.getElementById('mobileMenu');
            const menuOverlay = document.getElementById('menuOverlay');
            const toggleButton = document.querySelector('.mobile-menu-toggle');
            const icon = toggleButton.querySelector('i');
            
            mobileMenu.classList.toggle('active');
            menuOverlay.classList.toggle('active');
            
            if (mobileMenu.classList.contains('active')) {
                icon.className = 'fas fa-times';
                toggleButton.classList.add('active');
                document.body.style.overflow = 'hidden';
            } else {
                icon.className = 'fas fa-bars';
                toggleButton.classList.remove('active');
                document.body.style.overflow = 'auto';
            }
        }

        function closeMobileMenu() {
            const mobileMenu = document.getElementById('mobileMenu');
            const menuOverlay = document.getElementById('menuOverlay');
            const toggleButton = document.querySelector('.mobile-menu-toggle');
            const icon = toggleButton.querySelector('i');
            
            mobileMenu.classList.remove('active');
            menuOverlay.classList.remove('active');
            icon.className = 'fas fa-bars';
            toggleButton.classList.remove('active');
            document.body.style.overflow = 'auto';
        }

        function openHelpModal(category = 'platform') {
            const modal = document.getElementById('helpModal');
            const content = document.getElementById('helpModalContent');
            
            // Store the current category
            currentHelpCategory = category;
            
            const helpContent = getSkillHubHelpContent(category);
            content.innerHTML = helpContent;
            
            modal.style.display = 'block';
            document.body.style.overflow = 'hidden';
        }

        function openLegalModal(type) {
            const modal = document.getElementById('legalModal');
            const title = document.getElementById('legalModalTitle');
            const content = document.getElementById('legalModalContent');
            
            const legalData = getLegalContent(type);
            title.innerHTML = legalData.title;
            content.innerHTML = legalData.content;
            
            modal.style.display = 'block';
            document.body.style.overflow = 'hidden';
        }

        function closeModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
            document.body.style.overflow = 'auto';
        }

        function getSkillHubHelpContent(category) {
            const helpContent = {
                platform: `
                    <div class="help-category">
                        <h3><i class="fas fa-graduation-cap"></i> Getting Started with SkillHub</h3>
                        <div class="help-item">
                            <a href="#" onclick="showHelpDetail('registration')">
                                <i class="fas fa-user-plus"></i>
                                How to create your SkillHub account
                            </a>
                        </div>
                        <div class="help-item">
                            <a href="#" onclick="showHelpDetail('navigation')">
                                <i class="fas fa-compass"></i>
                                Navigating the SkillHub platform
                            </a>
                        </div>
                        <div class="help-item">
                            <a href="#" onclick="showHelpDetail('lms-access')">
                                <i class="fas fa-book-open"></i>
                                Accessing the Learning Management System
                            </a>
                        </div>
                    </div>
                    <div class="help-category">
                        <h3><i class="fas fa-briefcase"></i> Career Services</h3>
                        <div class="help-item">
                            <a href="#" onclick="showHelpDetail('career-tools')">
                                <i class="fas fa-tools"></i>
                                Using career development tools
                            </a>
                        </div>
                        <div class="help-item">
                            <a href="#" onclick="showHelpDetail('job-applications')">
                                <i class="fas fa-file-alt"></i>
                                Managing job applications
                            </a>
                        </div>
                        <div class="help-item">
                            <a href="#" onclick="showHelpDetail('resume-builder')">
                                <i class="fas fa-file"></i>
                                Building your professional resume
                            </a>
                        </div>
                    </div>
                `,
                account: `
                    <div class="help-category">
                        <h3><i class="fas fa-user-circle"></i> Account Management</h3>
                        <div class="help-item">
                            <a href="#" onclick="showHelpDetail('profile-setup')">
                                <i class="fas fa-id-card"></i>
                                Setting up your profile
                            </a>
                        </div>
                        <div class="help-item">
                            <a href="#" onclick="showHelpDetail('password-security')">
                                <i class="fas fa-shield-alt"></i>
                                Password and account security
                            </a>
                        </div>
                        <div class="help-item">
                            <a href="#" onclick="showHelpDetail('account-roles')">
                                <i class="fas fa-user-tag"></i>
                                Understanding user roles
                            </a>
                        </div>
                        <div class="help-item">
                            <a href="#" onclick="showHelpDetail('profile-editing')">
                                <i class="fas fa-edit"></i>
                                Editing your profile information
                            </a>
                        </div>
                    </div>
                `,
                technical: `
                    <div class="help-category">
                        <h3><i class="fas fa-laptop-code"></i> Technical Support</h3>
                        <div class="help-item">
                            <a href="#" onclick="showHelpDetail('browser-requirements')">
                                <i class="fas fa-globe"></i>
                                Browser requirements and compatibility
                            </a>
                        </div>
                        <div class="help-item">
                            <a href="#" onclick="showHelpDetail('connectivity-issues')">
                                <i class="fas fa-wifi"></i>
                                Troubleshooting connectivity issues
                            </a>
                        </div>
                        <div class="help-item">
                            <a href="#" onclick="showHelpDetail('mobile-access')">
                                <i class="fas fa-mobile-alt"></i>
                                Mobile platform access
                            </a>
                        </div>
                        <div class="help-item">
                            <a href="#" onclick="showHelpDetail('performance-optimization')">
                                <i class="fas fa-tachometer-alt"></i>
                                Platform performance optimization
                            </a>
                        </div>
                    </div>
                    <div class="help-category">
                        <h3><i class="fas fa-headset"></i> Contact Support</h3>
                        <div class="help-item">
                            <a href="mailto:skillhub@gmail.com">
                                <i class="fas fa-envelope"></i>
                                Email Support: skillhub@gmail.com
                            </a>
                        </div>
                        <div class="help-item">
                            <a href="tel:+96181032851">
                                <i class="fas fa-phone"></i>
                                Phone Support: +961 81-032-851
                            </a>
                        </div>
                    </div>
                `
            };
            
            return helpContent[category] || helpContent.platform;
        }

        function getLegalContent(type) {
            const legalContent = {
                privacy: {
                    title: '<i class="fas fa-shield-alt"></i> Privacy Policy',
                    content: `
                        <div style="max-height: 400px; overflow-y: auto;">
                            <h3>SkillHub Privacy Policy</h3>
                            <p><strong>Effective Date:</strong> ${new Date().toLocaleDateString()}</p>
                            
                            <h4>Information Collection</h4>
                            <p>SkillHub collects information necessary to provide our learning management and career services, including:</p>
                            <ul>
                                <li>Account registration details (name, email, professional information)</li>
                                <li>Learning progress and course completion data</li>
                                <li>Career profile and professional development information</li>
                                <li>Platform usage analytics for service improvement</li>
                            </ul>
                            
                            <h4>Data Usage</h4>
                            <p>Your information is used to:</p>
                            <ul>
                                <li>Provide personalized learning experiences</li>
                                <li>Track your progress and achievements</li>
                                <li>Connect you with relevant career opportunities</li>
                                <li>Improve our platform and services</li>
                            </ul>
                            
                            <h4>Data Protection</h4>
                            <p>SkillHub implements industry-standard security measures to protect your personal information. We do not sell your data to third parties.</p>
                            
                            <h4>Contact</h4>
                            <p>For privacy concerns, contact us at <a href="mailto:skillhub@gmail.com">skillhub@gmail.com</a></p>
                        </div>
                    `
                },
                terms: {
                    title: '<i class="fas fa-file-contract"></i> Terms of Service',
                    content: `
                        <div style="max-height: 400px; overflow-y: auto;">
                            <h3>SkillHub Terms of Service</h3>
                            <p><strong>Last Updated:</strong> ${new Date().toLocaleDateString()}</p>
                            
                            <h4>Platform Access</h4>
                            <p>By using SkillHub, you agree to:</p>
                            <ul>
                                <li>Provide accurate registration information</li>
                                <li>Use the platform for legitimate learning and career development</li>
                                <li>Respect intellectual property rights</li>
                                <li>Maintain the security of your account credentials</li>
                            </ul>
                            
                            <h4>Learning Content</h4>
                            <p>All course materials and content on SkillHub are protected by copyright. Users may access content for personal learning but may not redistribute or resell materials.</p>
                            
                            <h4>Career Services</h4>
                            <p>SkillHub provides career development tools and job matching services. We do not guarantee employment outcomes but strive to connect users with relevant opportunities.</p>
                            
                            <h4>Account Termination</h4>
                            <p>SkillHub reserves the right to terminate accounts that violate these terms or engage in harmful activities on the platform.</p>
                        </div>
                    `
                },
                cookies: {
                    title: '<i class="fas fa-cookie-bite"></i> Cookie Policy',
                    content: `
                        <div style="max-height: 400px; overflow-y: auto;">
                            <h3>SkillHub Cookie Policy</h3>
                            
                            <h4>What Are Cookies</h4>
                            <p>Cookies are small text files stored on your device to enhance your SkillHub experience and provide personalized learning.</p>
                            
                            <h4>How We Use Cookies</h4>
                            <p>SkillHub uses cookies for:</p>
                            <ul>
                                <li><strong>Essential Functions:</strong> Login sessions, platform navigation, security</li>
                                <li><strong>Learning Analytics:</strong> Progress tracking, course recommendations</li>
                                <li><strong>Performance:</strong> Platform optimization and loading speeds</li>
                                <li><strong>Personalization:</strong> Customized learning paths and career suggestions</li>
                            </ul>
                            
                            <h4>Cookie Management</h4>
                            <p>You can manage cookies through your browser settings. Note that disabling certain cookies may limit platform functionality.</p>
                            
                            <h4>Third-Party Cookies</h4>
                            <p>SkillHub may use third-party analytics tools to improve our services. These partners have their own privacy policies.</p>
                        </div>
                    `
                }
            };
            
            return legalContent[type] || legalContent.privacy;
        }

        function showHelpDetail(topic) {
            const skillHubTopics = {
                'registration': {
                    title: 'Creating Your SkillHub Account',
                    content: `
                        <div class="help-category">
                            <h3><i class="fas fa-user-plus"></i> Account Registration</h3>
                            <div style="padding: 1rem; background: #f8fafc; border-radius: 8px; margin-bottom: 1rem;">
                                <h4>Step-by-Step Registration:</h4>
                                <ol style="margin-left: 1.5rem; margin-top: 0.5rem;">
                                    <li>Click "Create Account" on the SkillHub homepage menu</li>
                                    <li>Provide your details (name, email, password)</li>
                                    <li>Choose a secure password with at least 8 characters</li>
                                    <li>Complete your profile setup</li>
                                </ol>
                            </div>
                        </div>
                    `
                },
                'navigation': {
                    title: 'Navigating the SkillHub Platform',
                    content: `
                        <div class="help-category">
                            <h3><i class="fas fa-compass"></i> Platform Navigation</h3>
                            <div style="padding: 1rem; background: #f8fafc; border-radius: 8px; margin-bottom: 1rem;">
                                <h4>Main Navigation Areas:</h4>
                                <ul style="margin-left: 1.5rem; margin-top: 0.5rem;">
                                    <li><strong>Home:</strong> Overview dashboard and quick access to features</li>
                                    <li><strong>LMS:</strong> Learning Management System for courses</li>
                                    <li><strong>Career Services:</strong> Job opportunities and career development</li>
                                </ul>
                                <p style="margin-top: 1rem;"><strong>Tip:</strong> Use the mobile menu button (☰) for easy navigation on smaller screens.</p>
                            </div>
                        </div>
                    `
                },
                'lms-access': {
                    title: 'Accessing the Learning Management System',
                    content: `
                        <div class="help-category">
                            <h3><i class="fas fa-book-open"></i> LMS Access & Features</h3>
                            <div style="padding: 1rem; background: #f8fafc; border-radius: 8px; margin-bottom: 1rem;">
                                <h4>How to Access the LMS:</h4>
                                <ol style="margin-left: 1.5rem; margin-top: 0.5rem;">
                                    <li>Click "LMS" in the main navigation menu</li>
                                    <li>Browse available courses and materials</li>
                                    <li>Access course content</li>
                                    <li>Complete quizzes and challenges</li>
                                </ol>
                                <p style="margin-top: 1rem;"><strong>Note:</strong> LMS features may vary based on your user role and permissions.</p>
                            </div>
                        </div>
                    `
                },
                'career-tools': {
                    title: 'Using Career Development Tools',
                    content: `
                        <div class="help-category">
                            <h3><i class="fas fa-tools"></i> Career Development Tools</h3>
                            <div style="padding: 1rem; background: #f8fafc; border-radius: 8px; margin-bottom: 1rem;">
                                <h4>Available Career Services:</h4>
                                <ul style="margin-left: 1.5rem; margin-top: 0.5rem;">
                                    <li><strong>Job Listings:</strong> Browse and apply for available positions</li>
                                    <li><strong>Career Advice:</strong> Access professional development resources</li>
                                    <li><strong>Application Tracking:</strong> Monitor your job application status</li>
                                </ul>
                                <p style="margin-top: 1rem;"><strong>Access:</strong> All career tools are available through the "Career Services" section.</p>
                            </div>
                        </div>
                    `
                },
                'job-applications': {
                    title: 'Managing Job Applications',
                    content: `
                        <div class="help-category">
                            <h3><i class="fas fa-file-alt"></i> Job Application Management</h3>
                            <div style="padding: 1rem; background: #f8fafc; border-radius: 8px; margin-bottom: 1rem;">
                                <h4>Application Features:</h4>
                                <ul style="margin-left: 1.5rem; margin-top: 0.5rem;">
                                    <li><strong>Apply for Jobs:</strong> Submit applications directly through SkillHub</li>
                                    <li><strong>Track Status:</strong> Monitor your application progress</li>
                                    <li><strong>View History:</strong> Access all your past applications</li>
                                    <li><strong>Receive Updates:</strong> Get notified about application status changes</li>
                                </ul>
                                
                            </div>
                        </div>
                    `
                },
                'resume-builder': {
                    title: 'Building Your Professional Resume',
                    content: `
                        <div class="help-category">
                            <h3><i class="fas fa-file"></i> Professional Resume</h3>
                            <div style="padding: 1rem; background: #f8fafc; border-radius: 8px; margin-bottom: 1rem;">
                                <h4>Resume Building Tips:</h4>
                                <ul style="margin-left: 1.5rem; margin-top: 0.5rem;">
                                    <li><strong>Complete Information:</strong> Fill out all resume sections thoroughly</li>
                                    <li><strong>Professional Format:</strong> Use a clean, professional resume template</li>
                                    <li><strong>Skills & Experience:</strong> Highlight your relevant abilities and work history</li>
                                    <li><strong>Career Objectives:</strong> Include a clear professional summary</li>
                                    <li><strong>Regular Updates:</strong> Keep your resume current with new experiences</li>
                                </ul>
                                <p style="margin-top: 1rem;"><strong>Impact:</strong> A well-crafted resume increases your chances with potential employers.</p>
                            </div>
                        </div>
                    `
                },
                'profile-setup': {
                    title: 'Setting Up Your Profile',
                    content: `
                        <div class="help-category">
                            <h3><i class="fas fa-id-card"></i> Profile Configuration</h3>
                            <div style="padding: 1rem; background: #f8fafc; border-radius: 8px; margin-bottom: 1rem;">
                                <h4>Essential Profile Information:</h4>
                                <ul style="margin-left: 1.5rem; margin-top: 0.5rem;">
                                    <li><strong>Basic Details:</strong> Name, email, password</li>
                                    <li><strong>Password Security:</strong> Change your password regularly using the Update Password section</li>
                                    <li><strong>Account Protection:</strong> Use strong, unique passwords </li>
                                    <li><strong>Account Deletion:</strong> Permanently removes all your data (irreversible action)</li>
                                </ul>
                                <p style="margin-top: 1rem;"><strong>Pro Tip:</strong> Keep your profile updated to ensure proper system functionality.</p>
                            </div>
                        </div>
                    `
                },
                'password-security': {
                    title: 'Password and Account Security',
                    content: `
                        <div class="help-category">
                            <h3><i class="fas fa-shield-alt"></i> Account Security</h3>
                            <div style="padding: 1rem; background: #f8fafc; border-radius: 8px; margin-bottom: 1rem;">
                                <h4>Security Best Practices:</h4>
                                <ul style="margin-left: 1.5rem; margin-top: 0.5rem;">
                                    <li><strong>Strong Passwords:</strong> Use at least 8 characters with mixed case, numbers, and symbols</li>
                                    <li><strong>Regular Updates:</strong> Change your password periodically</li>
                                    <li><strong>Secure Logout:</strong> Always log out from shared computers</li>
                                    <li><strong>Report Issues:</strong> Contact support for any suspicious account activity</li>
                                </ul>
                                <p style="margin-top: 1rem;"><strong>Support:</strong> Contact skillhub@gmail.com for security concerns or password recovery.</p>
                            </div>
                        </div>
                    `
                },
                'account-roles': {
                    title: 'Understanding User Roles',
                    content: `
                        <div class="help-category">
                            <h3><i class="fas fa-user-tag"></i> SkillHub User Roles</h3>
                            <div style="padding: 1rem; background: #f8fafc; border-radius: 8px; margin-bottom: 1rem;">
                                <h4>Available Roles:</h4>
                                <ul style="margin-left: 1.5rem; margin-top: 0.5rem;">
                                    <li><strong>User:</strong> Access to LMS, career services, and job applications</li>
                                    <li><strong>Admin:</strong> Full platform management and user administration</li>
                                    <li><strong>Instructor:</strong> Create and manage learning content</li>
                                    <li><strong>Career Manager:</strong> Oversee career services and job postings</li>
                                </ul>
                                <p style="margin-top: 1rem;"><strong>Note:</strong> Your role determines which features and sections you can access on SkillHub.</p>
                            </div>
                        </div>
                    `
                },
                'profile-editing': {
                    title: 'Editing Your Profile Information',
                    content: `
                        <div class="help-category">
                            <h3><i class="fas fa-edit"></i> Profile Editing</h3>
                            <div style="padding: 1rem; background: #f8fafc; border-radius: 8px; margin-bottom: 1rem;">
                                <h4>How to Edit Your Profile:</h4>
                                <ol style="margin-left: 1.5rem; margin-top: 0.5rem;">
                                    <li>Click on your profile section in the top navigation</li>
                                    <li>Select "Profile Settings" from the menu</li>
                                    <li>Update any information you want to change</li>
                                    <li>Save your changes to update your profile</li>
                                </ol>
                                <h4 style="margin-top: 1rem;">Editable Information:</h4>
                                <ul style="margin-left: 1.5rem; margin-top: 0.5rem;">
                                    <li>Personal details (name, email, etc)</li>
                                    <li>Password and security settings</li>
                                </ul>
                            </div>
                        </div>
                    `
                },
                'browser-requirements': {
                    title: 'Browser Requirements and Compatibility',
                    content: `
                        <div class="help-category">
                            <h3><i class="fas fa-globe"></i> Browser Compatibility</h3>
                            <div style="padding: 1rem; background: #f8fafc; border-radius: 8px; margin-bottom: 1rem;">
                                <h4>Supported Browsers:</h4>
                                <ul style="margin-left: 1.5rem; margin-top: 0.5rem;">
                                    <li><strong>Chrome:</strong> Version 90+ (Recommended for best performance)</li>
                                    <li><strong>Firefox:</strong> Version 88+ (Excellent compatibility)</li>
                                    <li><strong>Safari:</strong> Version 14+ (macOS and iOS support)</li>
                                    <li><strong>Edge:</strong> Version 90+ (Windows optimization)</li>
                                </ul>
                                <h4 style="margin-top: 1rem;">Requirements:</h4>
                                <ul style="margin-left: 1.5rem; margin-top: 0.5rem;">
                                    <li>JavaScript must be enabled</li>
                                    <li>Cookies must be allowed for SkillHub</li>
                                    <li>Minimum screen resolution: 1024x768</li>
                                    <li>Stable internet connection</li>
                                </ul>
                            </div>
                        </div>
                    `
                },
                'connectivity-issues': {
                    title: 'Troubleshooting Connectivity Issues',
                    content: `
                        <div class="help-category">
                            <h3><i class="fas fa-wifi"></i> Connection Troubleshooting</h3>
                            <div style="padding: 1rem; background: #f8fafc; border-radius: 8px; margin-bottom: 1rem;">
                                <h4>Common Solutions:</h4>
                                <ol style="margin-left: 1.5rem; margin-top: 0.5rem;">
                                    <li><strong>Check Internet Connection:</strong> Verify your network is stable</li>
                                    <li><strong>Refresh the Page:</strong> Press F5 or Ctrl+R to reload SkillHub</li>
                                    <li><strong>Clear Browser Cache:</strong> Remove stored data that might be corrupted</li>
                                    <li><strong>Disable Extensions:</strong> Temporarily turn off browser add-ons</li>
                                    <li><strong>Try Incognito Mode:</strong> Test if the issue persists in private browsing</li>
                                    <li><strong>Restart Router:</strong> Unplug for 30 seconds, then reconnect</li>
                                </ol>
                                <p style="margin-top: 1rem;"><strong>Still Having Issues?</strong> Contact support at skillhub@gmail.com</p>
                            </div>
                        </div>
                    `
                },
                'mobile-access': {
                    title: 'Mobile Platform Access',
                    content: `
                        <div class="help-category">
                            <h3><i class="fas fa-mobile-alt"></i> Mobile Experience</h3>
                            <div style="padding: 1rem; background: #f8fafc; border-radius: 8px; margin-bottom: 1rem;">
                                <h4>Mobile Optimization:</h4>
                                <ul style="margin-left: 1.5rem; margin-top: 0.5rem;">
                                    <li><strong>Responsive Design:</strong> SkillHub adapts to all screen sizes</li>
                                    <li><strong>Touch Navigation:</strong> Optimized for finger-friendly interaction</li>
                                    <li><strong>Mobile Menu:</strong> Easy access to all features via hamburger menu</li>
                                    <li><strong>Fast Loading:</strong> Optimized for mobile network speeds</li>
                                </ul>
                                <h4 style="margin-top: 1rem;">Best Practices:</h4>
                                <ul style="margin-left: 1.5rem; margin-top: 0.5rem;">
                                    <li>Use landscape mode on tablets for better viewing</li>
                                    <li>Ensure stable Wi-Fi or cellular connection</li>
                                    <li>Keep your mobile browser updated</li>
                                    <li>Close other apps for better performance</li>
                                </ul>
                            </div>
                        </div>
                    `
                },
                'performance-optimization': {
                    title: 'Platform Performance Optimization',
                    content: `
                        <div class="help-category">
                            <h3><i class="fas fa-tachometer-alt"></i> Performance Tips</h3>
                            <div style="padding: 1rem; background: #f8fafc; border-radius: 8px; margin-bottom: 1rem;">
                                <h4>Optimization Steps:</h4>
                                <ol style="margin-left: 1.5rem; margin-top: 0.5rem;">
                                    <li><strong>Close Unused Tabs:</strong> Reduce memory usage</li>
                                    <li><strong>Clear Cache Regularly:</strong> Remove temporary files</li>
                                    <li><strong>Update Your Browser:</strong> Keep your browser current</li>
                                    <li><strong>Check System Resources:</strong> Ensure sufficient RAM and storage</li>
                                    <li><strong>Stable Connection:</strong> Use reliable internet for best experience</li>
                                </ol>
                                <h4 style="margin-top: 1rem;">Recommended Specifications:</h4>
                                <ul style="margin-left: 1.5rem; margin-top: 0.5rem;">
                                    <li>Minimum 4GB RAM (8GB recommended)</li>
                                    <li>At least 1GB free storage space</li>
                                    <li>Modern browser (released within last 2 years)</li>
                                </ul>
                            </div>
                        </div>
                    `
                }
            };
            
            const helpInfo = skillHubTopics[topic];
            if (helpInfo) {
                // Update the modal content with the detailed help information
                const modalContent = document.getElementById('helpModalContent');
                modalContent.innerHTML = `
                    <div style="padding-bottom: 1rem;">
                        <button onclick="openHelpModal('${currentHelpCategory}')" style="
                            background: #e2e8f0; 
                            border: none; 
                            padding: 0.5rem 1rem; 
                            border-radius: 8px; 
                            cursor: pointer; 
                            display: flex; 
                            align-items: center; 
                            gap: 0.5rem;
                            margin-bottom: 1rem;
                            transition: all 0.3s ease;
                        " onmouseover="this.style.background='#cbd5e0'" onmouseout="this.style.background='#e2e8f0'">
                            <i class="fas fa-arrow-left"></i> Back to Help Categories
                        </button>
                        <h3 style="margin-bottom: 1rem; color: var(--primary-color);">${helpInfo.title}</h3>
                        ${helpInfo.content}
                    </div>
                `;
            }
        }

        function showAlert(type, message) {
            const alert = document.createElement('div');
            alert.className = `alert alert-${type}`;
            alert.innerHTML = `
                <div class="alert-content">
                    <span>${message}</span>
                </div>
                <button class="alert-close" onclick="this.parentElement.remove()">
                    <i class="fas fa-times"></i>
                </button>
            `;
            
            const header = document.querySelector('header');
            header.insertAdjacentElement('afterend', alert);
            
            setTimeout(() => {
                if (alert.parentNode) {
                    alert.style.animation = 'slideOutUp 0.3s ease-out forwards';
                    setTimeout(() => alert.remove(), 300);
                }
            }, 5000);
        }

        // Close modals when clicking outside
        window.onclick = function(event) {
            const modals = ['helpModal', 'legalModal'];
            modals.forEach(modalId => {
                const modal = document.getElementById(modalId);
                if (event.target === modal) {
                    closeModal(modalId);
                }
            });
        }

        // Close modals with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                const openModals = document.querySelectorAll('.modal[style*="block"]');
                openModals.forEach(modal => {
                    modal.style.display = 'none';
                });
                document.body.style.overflow = 'auto';
                closeMobileMenu();
            }
        });

        document.addEventListener('click', function(event) {
            const mobileMenu = document.getElementById('mobileMenu');
            const toggleButton = document.querySelector('.mobile-menu-toggle');
            const userProfile = document.querySelector('.user-profile-section');
            
            if (!mobileMenu.contains(event.target) && 
                !toggleButton.contains(event.target) && 
                !userProfile.contains(event.target)) {
                closeMobileMenu();
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            const navLinks = document.querySelectorAll('.mobile-menu a');
            navLinks.forEach(link => {
                link.addEventListener('click', function() {
                    setTimeout(() => {
                        closeMobileMenu();
                    }, 150);
                });
            });

            document.querySelectorAll('form').forEach(form => {
                form.addEventListener('submit', function(e) {
                    const submitBtn = form.querySelector('button[type="submit"], input[type="submit"]');
                    if (submitBtn && !submitBtn.classList.contains('no-loading')) {
                        const originalContent = submitBtn.innerHTML;
                        const loadingContent = submitBtn.getAttribute('data-loading') || 'Processing...';
                        
                        submitBtn.innerHTML = `<i class="fas fa-spinner fa-spin"></i> ${loadingContent}`;
                        submitBtn.disabled = true;
                        
                        setTimeout(() => {
                            submitBtn.innerHTML = originalContent;
                            submitBtn.disabled = false;
                        }, 15000);
                    }
                });
            });

            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                const closeBtn = alert.querySelector('.alert-close');
                if (closeBtn) {
                    closeBtn.addEventListener('click', function() {
                        alert.style.animation = 'slideOutUp 0.3s ease-out forwards';
                        setTimeout(() => alert.remove(), 300);
                    });
                }
            });

            setTimeout(() => {
                alerts.forEach(alert => {
                    if (alert.parentNode) {
                        alert.style.animation = 'slideOutUp 0.3s ease-out forwards';
                        setTimeout(() => {
                            if (alert.parentNode) {
                                alert.remove();
                            }
                        }, 300);
                    }
                });
            }, 7000);
        });

        $(document).ready(function() {
            $('.select2').select2({
                theme: 'default',
                width: '100%',
                placeholder: 'Select an option...',
                allowClear: true
            });
        });

        window.addEventListener('load', function() {
            console.log('🚀 SkillHub Platform loaded successfully!');
        });
    </script>

    @yield('scripts')
</body>
</html>