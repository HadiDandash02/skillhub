@extends('layouts.app')

@section('title', 'Challenge: ' . $challenge->title . ' - SkillHub')

@section('styles')
<meta name="csrf-token" content="{{ csrf_token() }}">
<style>
    .header-actions {
    margin-top: 2rem;
}

.btn-back {
    background: rgba(255, 255, 255, 0.1);
    border: 2px solid rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(20px);
    color: white;
    padding: 1rem 2rem;
    border-radius: 16px;
    text-decoration: none;
    font-weight: 700;
    font-size: 1rem;
    transition: all var(0.4s) var(cubic-bezier(0.4, 0, 0.2, 1));
    display: inline-flex;
    align-items: center;
    gap: 0.75rem;
}

.btn-back:hover {
    background: rgba(255, 255, 255, 0.2);
    border-color: white;
    transform: translateY(-2px);
    color: white;
}
    /* Challenge Page Styling */
    .challenge-page {
        min-height: 100vh;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    /* Hero Section */
    .hero-section {
        padding: 4rem 0;
        text-align: center;
        color: white;
        background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
    }

    .hero-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 2rem;
    }

    .challenge-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: rgba(255, 255, 255, 0.2);
        padding: 0.5rem 1rem;
        border-radius: 25px;
        margin-bottom: 1rem;
        font-size: 0.875rem;
        font-weight: 600;
    }

    .hero-title {
        font-size: 3rem;
        font-weight: 800;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 1rem;
    }

    .hero-description {
        font-size: 1.25rem;
        margin-bottom: 2rem;
        opacity: 0.9;
    }

    .hero-stats {
        display: flex;
        justify-content: center;
        gap: 2rem;
        flex-wrap: wrap;
    }

    .stat-item {
        background: rgba(255, 255, 255, 0.1);
        padding: 1rem 1.5rem;
        border-radius: 15px;
        text-align: center;
        min-width: 120px;
    }

    .stat-number {
        display: block;
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 0.25rem;
    }

    .stat-label {
        font-size: 0.875rem;
        opacity: 0.8;
    }

    /* Back Button */
    .btn-secondary {
        position: fixed;
        top: 20px;
        left: 20px;
        z-index: 1000;
        background: #6b7280;
        color: white;
        padding: 0.75rem 1.5rem;
        border-radius: 10px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-secondary:hover {
        background: #4b5563;
        transform: translateY(-2px);
    }

    /* Content Wrapper */
    .content-wrapper {
        background: #f8fafc;
        border-radius: 30px 30px 0 0;
        margin-top: -1rem;
        padding: 3rem 0;
    }

    .content-container {
        max-width: 1200px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 2rem;
        padding: 0 1rem;
    }

    /* Content Cards */
    .challenge-content,
    .challenge-editor-section {
        background: white;
        border-radius: 20px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        overflow: hidden;
    }

    .section-header {
        background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
        color: white;
        padding: 1.5rem 2rem;
    }

    .section-title {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        margin: 0;
        font-size: 1.25rem;
        font-weight: 600;
    }

    .section-icon {
        width: 24px;
        height: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .section-content {
        padding: 2rem;
    }

    /* Challenge Content */
    .challenge-description {
        color: #4b5563;
        line-height: 1.7;
        margin-bottom: 2rem;
        font-size: 1rem;
    }

    .instructions-card,
    .expected-output-card,
    .test-cases-preview {
        background: #f8fafc;
        border-radius: 15px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        border: 1px solid #e5e7eb;
    }

    .instructions-card h4,
    .expected-output-card h4,
    .test-cases-preview h4 {
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: #374151;
        font-weight: 600;
    }

    .instructions-text {
        color: #4b5563;
        line-height: 1.7;
    }

    .expected-output-text {
        background: white;
        border: 1px solid #e5e7eb;
        border-radius: 10px;
        padding: 1rem;
        font-family: 'Courier New', monospace;
        font-size: 0.875rem;
        color: #374151;
        white-space: pre-wrap;
    }

    .test-case-item {
        background: white;
        border-radius: 10px;
        padding: 1rem;
        margin-bottom: 1rem;
        border: 1px solid #e5e7eb;
    }

    .test-case-item:last-child {
        margin-bottom: 0;
    }

    .test-case-header {
        font-weight: 600;
        color: #374151;
        margin-bottom: 0.75rem;
        padding-bottom: 0.5rem;
        border-bottom: 1px solid #e5e7eb;
    }

    .test-case-details {
        font-size: 0.875rem;
        color: #4b5563;
        line-height: 1.6;
    }

    /* .test-case-details code {
        background: #f3f4f6;
        padding: 0.25rem 0.5rem;
        border-radius: 6px;
        font-family: 'Courier New', monospace;
        border: 1px solid #e5e7eb;
    } */

    /* Language Info */
    .language-info {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
        padding: 1rem;
        background: #f8fafc;
        border-radius: 15px;
        border: 1px solid #e5e7eb;
    }

    .language-badge {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-size: 0.875rem;
        font-weight: 600;
    }

    .challenge-info {
        font-size: 0.875rem;
        color: #6b7280;
    }

    /* Code Editor */
    .code-editor-container {
        position: relative;
        margin-bottom: 1.5rem;
    }

    .editor-toolbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: #1e293b;
        padding: 0.75rem 1rem;
        border-radius: 12px 12px 0 0;
    }

    .editor-title {
        color: #e2e8f0;
        font-size: 0.875rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .editor-actions {
        display: flex;
        gap: 0.5rem;
    }

    .editor-btn {
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        color: #e2e8f0;
        padding: 0.375rem 0.75rem;
        border-radius: 6px;
        font-size: 0.75rem;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .editor-btn:hover:not(:disabled) {
        background: rgba(255, 255, 255, 0.2);
    }

    .editor-btn:disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }

    .code-editor {
        width: 100%;
        min-height: 300px;
        font-family: 'Courier New', monospace;
        font-size: 0.875rem;
        background: #1e293b;
        color: #e2e8f0;
        border: none;
        border-radius: 0 0 12px 12px;
        padding: 1rem;
        resize: vertical;
    }

    .code-editor:focus {
        outline: none;
    }

    .code-editor:disabled {
        opacity: 0.7;
        cursor: not-allowed;
    }

    /* Editor Features */
    .editor-features {
        display: flex;
        gap: 1rem;
        margin-bottom: 1.5rem;
        flex-wrap: wrap;
    }

    .feature-badge {
        padding: 0.5rem 1rem;
        background: #f8fafc;
        border-radius: 20px;
        font-size: 0.75rem;
        color: #6b7280;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        border: 1px solid #e5e7eb;
    }

    /* Challenge Controls */
    .challenge-controls {
        background: #f8fafc;
        border-radius: 15px;
        padding: 1.5rem;
        border: 1px solid #e5e7eb;
    }

    .controls-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1rem;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .controls-header h4 {
        margin: 0;
        color: #374151;
        font-size: 1.125rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .timer-display {
        background: white;
        border: 2px solid #e5e7eb;
        border-radius: 10px;
        padding: 0.75rem 1rem;
        font-family: 'Courier New', monospace;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: #374151;
    }

    .timer-display.running {
        border-color: #10b981;
        background: linear-gradient(135deg, #ecfdf5, #f0f9ff);
    }

    .timer-display.paused {
        border-color: #f59e0b;
        background: linear-gradient(135deg, #fffbeb, #fef3c7);
    }

    .challenge-actions {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
    }

    /* Buttons */
    .btn {
        padding: 0.75rem 1.5rem;
        border-radius: 10px;
        border: none;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        font-size: 0.875rem;
    }

    .btn-primary {
        background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
        color: white;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
    }

    .btn-danger {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        color: white;
    }

    .btn-danger:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(239, 68, 68, 0.3);
    }

    .btn-success {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: white;
    }

    .btn-success:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
    }

    .btn-warning {
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        color: white;
    }

    .btn-warning:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(245, 158, 11, 0.3);
    }

    .btn:disabled {
        opacity: 0.6;
        cursor: not-allowed;
        transform: none !important;
        box-shadow: none !important;
    }

    .btn.loading {
        pointer-events: none;
    }

    /* Status Indicators */
    .status-indicator {
        padding: 0.25rem 0.75rem;
        border-radius: 15px;
        font-size: 0.75rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 0.375rem;
        text-transform: uppercase;
    }

    .status-passed {
        background: #dcfce7;
        color: #16a34a;
    }

    .status-failed,
    .status-error {
        background: #fef2f2;
        color: #dc2626;
    }

    /* Loading Overlay */
    .loading-overlay {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.8);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 2000;
    }

    .loading-content {
        background: white;
        border-radius: 20px;
        padding: 2rem;
        text-align: center;
        max-width: 400px;
        width: 90%;
    }

    .loading-spinner {
        width: 60px;
        height: 60px;
        border: 4px solid #e5e7eb;
        border-top: 4px solid #667eea;
        border-radius: 50%;
        animation: spin 1s linear infinite;
        margin: 0 auto 1rem;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    .loading-steps {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
        margin-top: 1rem;
    }

    .step {
        padding: 0.5rem 1rem;
        border-radius: 10px;
        background: #f3f4f6;
        color: #6b7280;
        transition: all 0.3s ease;
    }

    .step.active {
        background: #667eea;
        color: white;
    }

    /* Notifications */
    .notification {
        position: fixed;
        top: 20px;
        right: 20px;
        background: white;
        border-radius: 10px;
        padding: 1rem 1.5rem;
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        display: flex;
        align-items: center;
        gap: 0.75rem;
        z-index: 3000;
        min-width: 300px;
        animation: slideInRight 0.3s ease;
    }

    .notification-success {
        border-left: 4px solid #10b981;
    }

    .notification-error {
        border-left: 4px solid #ef4444;
    }

    .notification-info {
        border-left: 4px solid #667eea;
    }

    .notification-close {
        background: none;
        border: none;
        font-size: 1.25rem;
        cursor: pointer;
        margin-left: auto;
        color: #6b7280;
    }

    @keyframes slideInRight {
        from {
            transform: translateX(100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

    /* Results Modal */
    .results-overlay {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.8);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 2000;
    }

    .results-modal {
    background: white;
    border-radius: 20px;
    max-width: 800px;
    width: 95%;
    max-height: 90vh;
    overflow-y: auto;
    overflow-x: hidden; /* Optional: Prevent horizontal scroll */
    box-shadow: 0 20px 40px rgba(0,0,0,0.3);

    /* Optional: Firefox scrollbar style */
    scrollbar-width: thin;
    scrollbar-color: #c1c1c1 transparent;
}

/* Optional: Webkit browsers scrollbar style (Chrome, Safari, Edge) */
.results-modal::-webkit-scrollbar {
    width: 8px;
}

.results-modal::-webkit-scrollbar-track {
    background: transparent;
}

.results-modal::-webkit-scrollbar-thumb {
    background-color: #c1c1c1;
    border-radius: 10px;
}


    .results-header {
        background: linear-gradient(135deg, #2563eb, #10b981);
        color: white;
        padding: 1.5rem 2rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .results-header h3 {
        margin: 0;
        font-size: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        font-weight: 700;
    }

    .close-results {
        background: rgba(255, 255, 255, 0.2);
        border: none;
        color: white;
        font-size: 1.5rem;
        cursor: pointer;
        width: 35px;
        height: 35px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .results-summary {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 1rem;
        padding: 2rem;
        background: #f8fafc;
    }

    .result-stat {
        background: white;
        padding: 1rem;
        border-radius: 10px;
        text-align: center;
        border: 1px solid #e5e7eb;
    }

    .stat-label {
        font-size: 0.875rem;
        margin-bottom: 0.25rem;
    }

    .stat-value {
        font-weight: 700;
        font-size: 1.1rem;
        color: #374151;
    }

    /* Test Results in Modal */
    .error-section {
        padding: 2rem;
        background: #fef2f2;
        border-top: 1px solid #e5e7eb;
    }

    .error-section h4 {
        color: #dc2626;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .error-message {
        background: white;
        border: 1px solid #fecaca;
        color: #dc2626;
        padding: 1rem;
        border-radius: 10px;
        font-family: 'Courier New', monospace;
        overflow-x: auto;
        white-space: pre-wrap;
    }

    .test-cases-section {
        padding: 2rem;
        border-top: 1px solid #e5e7eb;
    }

    .test-cases-section h4 {
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        color: #374151;
        font-weight: 600;
        font-size: 1.25rem;
    }

    .test-cases-list {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .test-case {
        border: 1px solid #e5e7eb;
        border-radius: 15px;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .test-case.passed {
        border-color: #10b981;
        background: linear-gradient(to right, #f0fdf4, white);
    }

    .test-case.failed {
        border-color: #ef4444;
        background: linear-gradient(to right, #fef2f2, white);
    }

    .test-header {
        padding: 1rem;
        background: #f8fafc;
        display: flex;
        align-items: center;
        gap: 1rem;
        flex-wrap: wrap;
        border-bottom: 1px solid #e5e7eb;
    }

    .test-number {
        font-weight: 700;
        color: #374151;
        background: white;
        padding: 0.5rem 1rem;
        border-radius: 15px;
        border: 1px solid #e5e7eb;
    }

    .test-status {
        padding: 0.5rem 1rem;
        border-radius: 15px;
        font-size: 0.75rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        text-transform: uppercase;
    }

    .test-case.passed .test-status {
        background: #dcfce7;
        color: #16a34a;
    }

    .test-case.failed .test-status {
        background: #fef2f2;
        color: #dc2626;
    }

    .test-description {
        font-size: 0.875rem;
        color: #6b7280;
        font-style: italic;
        background: white;
        padding: 0.5rem 1rem;
        border-radius: 10px;
        border: 1px solid #e5e7eb;
    }

    .test-details {
        padding: 1.5rem;
        background: white;
    }

    .test-io {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .test-io > div {
        display: flex;
        align-items: flex-start;
        gap: 1rem;
        padding: 1rem;
        background: #f8fafc;
        border-radius: 10px;
        border: 1px solid #e5e7eb;
    }

    .test-io strong {
        min-width: 100px;
        color: #374151;
        font-weight: 600;
    }

    .test-io code {
        background: white;
        border: 1px solid #e5e7eb;
        border-radius: 6px;
        padding: 0.5rem 0.75rem;
        font-family: 'Courier New', monospace;
        font-size: 0.875rem;
        flex-grow: 1;
        line-height: 1.4;
    }

    .test-io code.correct {
        background: #f0fdf4;
        border-color: #bbf7d0;
        color: #166534;
    }

    .test-io code.incorrect {
        background: #fef2f2;
        border-color: #fecaca;
        color: #dc2626;
    }

    .results-actions {
        padding: 2rem;
        border-top: 1px solid #e5e7eb;
        display: flex;
        gap: 1rem;
        justify-content: flex-end;
        flex-wrap: wrap;
        background: #f8fafc;
    }

    /* Celebration */
    .celebration-overlay {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.9), rgba(147, 51, 234, 0.9));
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 5000;
    }

    .celebration-content {
        text-align: center;
        color: white;
        max-width: 500px;
        padding: 3rem;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 20px;
        backdrop-filter: blur(20px);
    }

    .celebration-animation {
        margin-bottom: 2rem;
    }

    .trophy-icon {
        font-size: 4rem;
        animation: bounce 2s infinite;
    }

    @keyframes bounce {
        0%, 20%, 50%, 80%, 100% {
            transform: translateY(0);
        }
        40% {
            transform: translateY(-30px);
        }
        60% {
            transform: translateY(-15px);
        }
    }

    .celebration-content h2 {
        font-size: 2rem;
        margin-bottom: 1rem;
        font-weight: 800;
    }

    .celebration-content p {
        font-size: 1.1rem;
        margin-bottom: 1rem;
        opacity: 0.95;
    }

    .continue-btn {
        margin-top: 2rem;
        font-size: 1rem;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .content-container {
            grid-template-columns: 1fr;
        }
        
        .hero-title {
            font-size: 2rem;
            flex-direction: column;
            gap: 0.5rem;
        }
        
        .hero-stats {
            gap: 1rem;
        }
        
        .controls-header {
            flex-direction: column;
            align-items: stretch;
        }
        
        .challenge-actions {
            flex-direction: column;
        }
        
        .btn {
            width: 100%;
            justify-content: center;
        }
        
        .test-io > div {
            flex-direction: column;
            gap: 0.5rem;
        }
        
        .test-io strong {
            min-width: auto;
        }
        
        .language-info {
            flex-direction: column;
            gap: 1rem;
            align-items: stretch;
            text-align: center;
        }
        
        .editor-toolbar {
            flex-direction: column;
            gap: 0.5rem;
            align-items: stretch;
        }
        
        .editor-actions {
            justify-content: center;
        }
        
        .notification {
            right: 10px;
            left: 10px;
            min-width: auto;
        }
        
        .results-modal {
            width: 95%;
            margin: 1rem;
        }
        
        .results-summary {
            grid-template-columns: 1fr;
        }
        
        .celebration-content {
            padding: 2rem 1rem;
        }
        
        .celebration-content h2 {
            font-size: 1.5rem;
        }
        
        .trophy-icon {
            font-size: 3rem;
        }
    }

    @media (max-width: 480px) {
        .hero-section {
            padding: 2rem 0;
        }
        
        .hero-container {
            padding: 0 1rem;
        }
        
        .hero-title {
            font-size: 1.5rem;
        }
        
        .hero-description {
            font-size: 1rem;
        }
        
        .stat-item {
            min-width: 100px;
            padding: 0.75rem 1rem;
        }
        
        .stat-number {
            font-size: 1.25rem;
        }
        
        .content-container {
            padding: 0 0.5rem;
        }
        
        .section-content {
            padding: 1.5rem;
        }
        
        .challenge-controls {
            padding: 1rem;
        }
        
        .code-editor {
            min-height: 250px;
            font-size: 0.8rem;
        }
        
        .btn {
            padding: 0.875rem 1rem;
            font-size: 0.8rem;
        }
        
        .feature-badge {
            font-size: 0.7rem;
            padding: 0.375rem 0.75rem;
        }
    }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endsection

@section('content')
<div class="challenge-page">
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-container">
            <div class="challenge-badge">
                <i class="fas fa-code"></i>
                <span>{{ ucfirst($challenge->language_name) }} Challenge</span>
            </div>
            
            <h1 class="hero-title">
                <i class="fas fa-trophy"></i>
                {{ $challenge->title }}
            </h1>
            
            <p class="hero-description">
                Solve this {{ $challenge->language_name }} programming challenge
            </p>
            
            <div class="hero-stats">
                <div class="stat-item">
                    <span class="stat-number">{{ ucfirst($challenge->language_name) }}</span>
                    <span class="stat-label">Language</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">{{ ucfirst($challenge->difficulty ?? 'Medium') }}</span>
                    <span class="stat-label">Difficulty</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">{{ $challenge->attempts ?? 0 }}</span>
                    <span class="stat-label">Attempts</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">{{ $challenge->success_rate ?? 0 }}%</span>
                    <span class="stat-label">Success Rate</span>
                </div>
            </div>
            <!-- Navigation -->
        <div class="header-actions">
                    <a href="{{  url()->previous()}}" class="btn-back">
                        <i class="fas fa-arrow-left"></i>
                        <span>Back</span>
                    </a>
                </div>
        </div>
    </section>

    <!-- Content Wrapper -->
    <div class="content-wrapper">
        <div class="content-container">
            <!-- Left Side - Challenge Details -->
            <div class="challenge-content">
                <div class="section-header">
                    <div class="section-title">
                        <div class="section-icon">
                            <i class="fas fa-info-circle"></i>
                        </div>
                        <span>Challenge Overview</span>
                    </div>
                </div>
                
                <div class="section-content">
                    <div class="challenge-description">
                        {{ $challenge->description }}
                    </div>

                    <div class="instructions-card">
                        <h4>
                            <i class="fas fa-list-ol"></i>
                            Instructions
                        </h4>
                        <div class="instructions-text">
                            {{ $challenge->instructions ?? 'No specific instructions provided for this challenge.' }}
                        </div>
                    </div>

                    <div class="expected-output-card">
                        <h4>
                            <i class="fas fa-bullseye"></i>
                            Expected Output
                        </h4>
                        <div class="expected-output-text">{{ $challenge->expected_output ?? 'No expected output provided.' }}</div>
                    </div>

                    @if($challenge->testCases && $challenge->testCases->count() > 0)
                    <div class="test-cases-preview">
                        <h4>
                            <i class="fas fa-flask"></i>
                            Sample Test Cases
                        </h4>
                        @foreach($challenge->testCases->take(2) as $index => $testCase)
                        <div class="test-case-item">
                            <div class="test-case-header">Test Case {{ $index + 1 }}</div>
                            <div class="test-case-details">
                                @if($testCase->input)
                                <div><strong>Input:</strong> <code>{{ $testCase->input }}</code></div>
                                @endif
                                <div><strong>Expected Output:</strong> <code>{{ $testCase->expected_output }}</code></div>
                                @if($testCase->description)
                                <div><strong>Description:</strong> {{ $testCase->description }}</div>
                                @endif
                            </div>
                        </div>
                        @endforeach
                        @if($challenge->testCases->count() > 2)
                        <p style="margin-top: 1rem; font-size: 0.875rem; color: #6b7280; text-align: center;">
                            <i class="fas fa-info-circle"></i>
                            {{ $challenge->testCases->count() - 2 }} more test cases will be used for evaluation
                        </p>
                        @endif
                    </div>
                    @endif

                    @if($latestSubmission)
                    <div class="test-cases-preview">
                        <h4>
                            <i class="fas fa-history"></i>
                            Latest Submission
                        </h4>
                        <div class="test-case-item">
                            <div class="test-case-details">
                                <div><strong>Status:</strong> 
                                    <span class="status-indicator status-{{ $latestSubmission->status }}">
                                        <i class="fas fa-{{ $latestSubmission->status === 'passed' ? 'check' : 'times' }}"></i>
                                        {{ ucfirst($latestSubmission->status) }}
                                    </span>
                                </div>
                                <div><strong>Score:</strong> {{ $latestSubmission->score }}%</div>
                                <div><strong>Tests Passed:</strong> {{ $latestSubmission->passed_tests_count }}/{{ $latestSubmission->total_tests_count }}</div>
                                <div><strong>Submitted:</strong> {{ $latestSubmission->submitted_at->diffForHumans() }}</div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Right Side - Code Editor -->
            <div class="challenge-editor-section">
                <div class="section-header">
                    <div class="section-title">
                        <div class="section-icon">
                            <i class="fas fa-terminal"></i>
                        </div>
                        <span>{{ ucfirst($challenge->language_name) }} Code Editor</span>
                    </div>
                </div>

                <div class="section-content">
                    <div class="language-info">
                        <div class="language-badge">
                            <i class="fas fa-code"></i>
                            <span>{{ ucfirst($challenge->language_name) }} Only</span>
                        </div>
                        <div class="challenge-info">
                            This challenge must be solved in {{ ucfirst($challenge->language_name) }}
                        </div>
                    </div>

                    <div class="code-editor-container">
                        <div class="editor-toolbar">
                            <div class="editor-title">
                                <i class="fas fa-file-code"></i>
                                <span>{{ ucfirst($challenge->language_name) }} Solution</span>
                            </div>
                            <div class="editor-actions">
                                <button class="editor-btn" id="formatCode" disabled>
                                    <i class="fas fa-magic"></i> Format
                                </button>
                                <button class="editor-btn" id="resetCode" disabled>
                                    <i class="fas fa-undo"></i> Reset
                                </button>
                            </div>
                        </div>

                        <textarea 
                            id="codeEditor" 
                            class="code-editor" 
                            placeholder="{{ $challenge->code_placeholder ?? '// Write your ' . $challenge->language_name . ' solution here...' }}"
                            disabled
                        >{{ $latestSubmission ? $latestSubmission->code : ($challenge->code_placeholder ?? '') }}</textarea>
                    </div>

                    <div class="editor-features">
                        <div class="feature-badge">
                            <i class="fas fa-code"></i>
                            <span>{{ ucfirst($challenge->language_name) }}</span>
                        </div>
                        <div class="feature-badge">
                            <i class="fas fa-magic"></i>
                            <span>Syntax Highlighting</span>
                        </div>
                        <div class="feature-badge">
                            <i class="fas fa-save"></i>
                            <span>Auto Save</span>
                        </div>
                        <div class="feature-badge">
                            <i class="fas fa-keyboard"></i>
                            <span>Shortcuts</span>
                        </div>
                    </div>

                    <div class="challenge-controls">
                        <div class="controls-header">
                            <h4>
                                <i class="fas fa-gamepad"></i>
                                Challenge Controls
                            </h4>
                            <div class="timer-display" id="timerDisplay">
                                <i class="fas fa-clock"></i>
                                <span id="timer">00:00</span>
                            </div>
                        </div>

                        <div class="challenge-actions">
                            <button class="btn btn-primary" id="StartChallenge">
                                <i class="fas fa-play"></i>
                                <span>Start Challenge</span>
                            </button>
                            <button class="btn btn-danger" id="StopChallenge" style="display: none;">
                                <i class="fas fa-pause"></i>
                                <span>Pause</span>
                            </button>
                            <button class="btn btn-success" id="SubmitChallenge" style="display: none;" disabled>
                                <i class="fas fa-check"></i>
                                <span>Submit {{ ucfirst($challenge->language_name) }} Solution</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    let timerInterval;
    let seconds = 0;
    let isPaused = false;
    let isStarted = false;

    const startButton = document.getElementById('StartChallenge');
    const stopButton = document.getElementById('StopChallenge');
    const submitButton = document.getElementById('SubmitChallenge');
    const codeEditor = document.getElementById('codeEditor');
    const formatCodeBtn = document.getElementById('formatCode');
    const resetCodeBtn = document.getElementById('resetCode');
    const timerText = document.getElementById('timer');
    const timerDisplay = document.getElementById('timerDisplay');

    // Challenge language (fixed for this challenge)
    const challengeLanguage = '{{ $challenge->language_name }}';

    function startChallenge() {
        console.log('Starting {{ $challenge->language_name }} challenge...');
        
        // Enable editor and buttons
        codeEditor.disabled = false;
        formatCodeBtn.disabled = false;
        resetCodeBtn.disabled = false;
        
        // Update UI state
        isStarted = true;
        isPaused = false;

        // Update buttons
        startButton.innerHTML = '<i class="fas fa-redo"></i><span>Restart Challenge</span>';
        startButton.classList.remove('btn-primary');
        startButton.classList.add('btn-warning');

        stopButton.style.display = 'inline-flex';
        submitButton.style.display = 'inline-flex';
        submitButton.disabled = false;

        // Update timer display
        timerDisplay.classList.add('running');
        timerDisplay.classList.remove('paused');

        // Reset and start timer
        clearInterval(timerInterval);
        seconds = 0;
        updateTimer();

        timerInterval = setInterval(() => {
            seconds++;
            updateTimer();
        }, 1000);

        showNotification(`{{ ucfirst($challenge->language_name) }} challenge started!`, 'success');
        codeEditor.focus();
    }

    function toggleTimer() {
        if (isPaused) {
            // Resume
            timerInterval = setInterval(() => {
                seconds++;
                updateTimer();
            }, 1000);

            stopButton.innerHTML = '<i class="fas fa-pause"></i><span>Pause</span>';
            stopButton.classList.remove('btn-success');
            stopButton.classList.add('btn-danger');
            
            timerDisplay.classList.add('running');
            timerDisplay.classList.remove('paused');
            
            isPaused = false;
        } else {
            // Pause
            clearInterval(timerInterval);
            
            stopButton.innerHTML = '<i class="fas fa-play"></i><span>Resume</span>';
            stopButton.classList.remove('btn-danger');
            stopButton.classList.add('btn-success');
            
            timerDisplay.classList.remove('running');
            timerDisplay.classList.add('paused');
            
            isPaused = true;
        }
    }

    function submitChallenge() {
        const code = codeEditor.value.trim();
        
        if (!code) {
            showNotification('Please write some {{ $challenge->language_name }} code before submitting!', 'error');
            return;
        }

        // Stop timer
        clearInterval(timerInterval);
        
        // Update UI
        submitButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i><span>Evaluating {{ ucfirst($challenge->language_name) }}...</span>';
        submitButton.classList.add('loading');
        submitButton.disabled = true;

        // Show loading overlay
        showLoadingOverlay();
        
        // Submit to backend
        fetch(`/challenge/{{ $challenge->id }}/submit`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json'
            },
            body: JSON.stringify({ 
                code: code
            })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            hideLoadingOverlay();
            handleSubmissionResult(data);
        })
        .catch(error => {
            console.error('Submission error:', error);
            hideLoadingOverlay();
            
            // Reset button
            submitButton.innerHTML = '<i class="fas fa-check"></i><span>Submit {{ ucfirst($challenge->language_name) }} Solution</span>';
            submitButton.classList.remove('loading');
            submitButton.disabled = false;
        });
    }

    function handleSubmissionResult(data) {
        console.log('Submission result:', data);
        
        // Reset button
        submitButton.innerHTML = '<i class="fas fa-check"></i><span>Submit {{ ucfirst($challenge->language_name) }} Solution</span>';
        submitButton.classList.remove('loading');
        submitButton.disabled = false;
        
        // Update timer display
        timerDisplay.classList.remove('running', 'paused');
        
        if (data.success) {
            handleSuccessfulSubmission(data);
        } else {
            handleFailedSubmission(data);
        }
        
        // Show detailed results
        showResultsModal(data);
    }

    function handleSuccessfulSubmission(data) {
        showNotification(`🎉 Congratulations! All tests passed in {{ $challenge->language_name }}!`, 'success');
        
        // Disable further submissions
        submitButton.innerHTML = '<i class="fas fa-trophy"></i><span>{{ ucfirst($challenge->language_name) }} Challenge Completed</span>';
        submitButton.disabled = true;
        submitButton.classList.add('btn-success');
        
        // Show celebration animation
        if (data.celebration) {
            showCelebration(data.celebration);
        }
    }

    function handleFailedSubmission(data) {
        const message = data.error_message || `${data.passed_tests}/${data.total_tests} tests passed`;
        showNotification(message, 'error');
    }

    function showLoadingOverlay() {
        const overlay = document.createElement('div');
        overlay.className = 'loading-overlay';
        overlay.innerHTML = `
            <div class="loading-content">
                <div class="loading-spinner"></div>
                <h3>Evaluating {{ ucfirst($challenge->language_name) }} Code...</h3>
                <p>Running test cases and checking your solution</p>
                <div class="loading-steps">
                    <div class="step active">Compiling {{ $challenge->language_name }} code...</div>
                    <div class="step">Running test cases...</div>
                    <div class="step">Calculating results...</div>
                </div>
            </div>
        `;
        
        document.body.appendChild(overlay);
        
        // Simulate loading steps
        setTimeout(() => {
            const steps = overlay.querySelectorAll('.step');
            steps[0].classList.remove('active');
            steps[1].classList.add('active');
        }, 1000);
        
        setTimeout(() => {
            const steps = overlay.querySelectorAll('.step');
            steps[1].classList.remove('active');
            steps[2].classList.add('active');
        }, 2000);
    }

    function hideLoadingOverlay() {
        const overlay = document.querySelector('.loading-overlay');
        if (overlay) {
            document.body.removeChild(overlay);
        }
    }

    function showNotification(message, type = 'info') {
        const notification = document.createElement('div');
        notification.className = `notification notification-${type}`;
        notification.innerHTML = `
            <i class="fas fa-${type === 'success' ? 'check-circle' : type === 'error' ? 'exclamation-circle' : 'info-circle'}"></i>
            <span>${message}</span>
            <button class="notification-close">&times;</button>
        `;
        
        document.body.appendChild(notification);
        
        // Auto remove after 5 seconds
        setTimeout(() => {
            if (document.body.contains(notification)) {
                document.body.removeChild(notification);
            }
        }, 5000);
        
        // Manual close
        notification.querySelector('.notification-close').addEventListener('click', () => {
            if (document.body.contains(notification)) {
                document.body.removeChild(notification);
            }
        });
    }

    function showResultsModal(data) {
        // Create results modal
        const modal = document.createElement('div');
        modal.className = 'results-overlay';
        modal.innerHTML = `
            <div class="results-modal">
                <div class="results-header">
                    <h3>
                        <i class="fas fa-${data.success ? 'trophy' : 'bug'}"></i>
                        {{ ucfirst($challenge->language_name) }} Submission Results
                    </h3>
                    <button class="close-results">&times;</button>
                </div>
                
                <div class="results-summary">
                    <div class="result-stat">
                        <span class="stat-label">Language:</span>
                        <span class="stat-value">{{ ucfirst($challenge->language_name) }}</span>
                    </div>
                    <div class="result-stat">
                        <span class="stat-label">Status:</span>
                        <span class="stat-value status-${data.status}">${data.status.toUpperCase()}</span>
                    </div>
                    <div class="result-stat">
                        <span class="stat-label">Score:</span>
                        <span class="stat-value">${data.score}%</span>
                    </div>
                    <div class="result-stat">
                        <span class="stat-label">Tests Passed:</span>
                        <span class="stat-value">${data.passed_tests}/${data.total_tests}</span>
                    </div>
                    <div class="result-stat">
                        <span class="stat-label">Execution Time:</span>
                        <span class="stat-value">${data.execution_time}ms</span>
                    </div>
                </div>

                ${data.error_message ? `
                    <div class="error-section">
                        <h4><i class="fas fa-exclamation-triangle"></i> Error</h4>
                        <pre class="error-message">${data.error_message}</pre>
                    </div>
                ` : ''}

                <div class="test-cases-section">
                    <h4><i class="fas fa-list-check"></i> Test Cases Results</h4>
                    <div class="test-cases-list">
                        ${data.test_results.map((test, index) => `
                            <div class="test-case ${test.passed ? 'passed' : 'failed'}">
                                <div class="test-header">
                                    <span class="test-number">#${index + 1}</span>
                                    <span class="test-status">
                                        <i class="fas fa-${test.passed ? 'check' : 'times'}"></i>
                                        ${test.passed ? 'PASSED' : 'FAILED'}
                                    </span>
                                    ${test.description ? `<span class="test-description">${test.description}</span>` : ''}
                                </div>
                                <div class="test-details">
                                    <div class="test-io">
                                        <div>
                                            <strong>Input:</strong>
                                            <code>${test.input || 'No input'}</code>
                                        </div>
                                        <div>
                                            <strong>Expected:</strong>
                                            <code>${test.expected}</code>
                                        </div>
                                        <div>
                                            <strong>Your Output:</strong>
                                            <code class="${test.passed ? 'correct' : 'incorrect'}">${test.actual || 'No output'}</code>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `).join('')}
                    </div>
                </div>

                <div class="results-actions">
                    ${data.success ? `
                    ` : `
                        <button class="btn btn-primary try-again">
                            <i class="fas fa-redo"></i> <span>Try Again</span>
                        </button>
                    `}
                </div>
            </div>
        `;
        
        document.body.appendChild(modal);
        
        // Add event listeners
        modal.querySelector('.close-results').addEventListener('click', () => {
            document.body.removeChild(modal);
        });
        
        modal.querySelector('.close-results-btn').addEventListener('click', () => {
            document.body.removeChild(modal);
        });
        
        modal.addEventListener('click', (e) => {
            if (e.target === modal) {
                document.body.removeChild(modal);
            }
        });

        const tryAgainBtn = modal.querySelector('.try-again');
        if (tryAgainBtn) {
            tryAgainBtn.addEventListener('click', () => {
                document.body.removeChild(modal);
                codeEditor.focus();
            });
        }
    }

    function showCelebration(celebrationData) {
        if (!celebrationData) return;
        
        const celebration = document.createElement('div');
        celebration.className = 'celebration-overlay';
        celebration.innerHTML = `
            <div class="celebration-content">
                <div class="celebration-animation">
                    <div class="trophy-icon">🏆</div>
                </div>
                <h2>🎉 {{ ucfirst($challenge->language_name) }} Challenge Completed!</h2>
                <p>${celebrationData.message}</p>
                ${celebrationData.rank ? `<p>Your rank: <strong>#${celebrationData.rank}</strong></p>` : ''}
                ${celebrationData.improvement ? `<p>${celebrationData.improvement}</p>` : ''}
                <button class="btn btn-primary continue-btn">
                    <i class="fas fa-arrow-right"></i> <span>Continue Learning</span>
                </button>
            </div>
        `;
        
        document.body.appendChild(celebration);
        
        celebration.querySelector('.continue-btn').addEventListener('click', () => {
            document.body.removeChild(celebration);
        });
        
        // Auto remove after 10 seconds
        setTimeout(() => {
            if (document.body.contains(celebration)) {
                document.body.removeChild(celebration);
            }
        }, 10000);
    }

    function updateTimer() {
        const minutes = Math.floor(seconds / 60);
        const secs = seconds % 60;
        const formattedTime = `${minutes.toString().padStart(2, '0')}:${secs.toString().padStart(2, '0')}`;
        timerText.textContent = formattedTime;
    }

    // Auto-save functionality
    function autoSave() {
        const code = codeEditor.value;
        localStorage.setItem('challenge_code_{{ $challenge->id }}', code);
        console.log('{{ ucfirst($challenge->language_name) }} code auto-saved');
    }

    function loadSavedCode() {
        if (!codeEditor.value.trim()) {
            const savedCode = localStorage.getItem('challenge_code_{{ $challenge->id }}');
            if (savedCode) {
                codeEditor.value = savedCode;
                console.log('Loaded saved {{ $challenge->language_name }} code');
            }
        }
    }

    // Format code button
    formatCodeBtn.addEventListener('click', function() {
        const lines = codeEditor.value.split('\n');
        let indentLevel = 0;
        const formattedLines = lines.map(line => {
            const trimmed = line.trim();
            if (trimmed.includes('}') || trimmed.includes('end') || trimmed.startsWith('</')) {
                indentLevel = Math.max(0, indentLevel - 1);
            }
            const formatted = '    '.repeat(indentLevel) + trimmed;
            if (trimmed.includes('{') || trimmed.includes('def ') || trimmed.includes('function') || trimmed.startsWith('<')) {
                indentLevel++;
            }
            return formatted;
        });
        codeEditor.value = formattedLines.join('\n');
        showNotification('{{ ucfirst($challenge->language_name) }} code formatted!', 'success');
    });

    // Reset code button
    resetCodeBtn.addEventListener('click', function() {
        if (confirm('Are you sure you want to reset your {{ $challenge->language_name }} code? This cannot be undone.')) {
            codeEditor.value = `{{ addslashes($challenge->code_placeholder ?? '') }}`;
            showNotification('Code reset to template', 'info');
        }
    });

    // Keyboard shortcuts
    function handleKeyboardShortcuts(e) {
        // Ctrl/Cmd + Enter to submit
        if ((e.ctrlKey || e.metaKey) && e.key === 'Enter') {
            e.preventDefault();
            if (isStarted && submitButton.style.display !== 'none' && !submitButton.disabled) {
                submitChallenge();
            }
        }
        
        // Ctrl/Cmd + S to save
        if ((e.ctrlKey || e.metaKey) && e.key === 's') {
            e.preventDefault();
            autoSave();
            showNotification('{{ ucfirst($challenge->language_name) }} code saved! 💾', 'success');
        }
    }

    // Event listeners
    startButton.addEventListener('click', startChallenge);
    stopButton.addEventListener('click', toggleTimer);
    submitButton.addEventListener('click', submitChallenge);
    
    // Auto-save on code change
    codeEditor.addEventListener('input', debounce(autoSave, 1000));
    
    // Keyboard shortcuts
    document.addEventListener('keydown', handleKeyboardShortcuts);
    
    // Load saved code on page load
    loadSavedCode();

    // Tab key handling in textarea
    codeEditor.addEventListener('keydown', function(e) {
        if (e.key === 'Tab') {
            e.preventDefault();
            const start = this.selectionStart;
            const end = this.selectionEnd;
            
            // Insert tab character
            this.value = this.value.substring(0, start) + '    ' + this.value.substring(end);
            
            // Put cursor at correct position
            this.selectionStart = this.selectionEnd = start + 4;
        }
    });

    // Debounce function for auto-save
    function debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }

    // Prevent accidental page reload when challenge is active
    window.addEventListener('beforeunload', function(e) {
        if (isStarted && !isPaused && seconds > 30) {
            e.preventDefault();
            e.returnValue = 'You have an active {{ $challenge->language_name }} challenge. Are you sure you want to leave?';
            return e.returnValue;
        }
    });

    console.log('{{ ucfirst($challenge->language_name) }} challenge page initialized successfully! 🚀');
});
</script>
@endsection