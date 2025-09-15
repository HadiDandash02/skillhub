<!-- resources/views/courses.blade.php -->

@extends('layouts.app')

@section('title', 'Learning Management System - SkillHub')
@section('description', 'Explore interactive courses, AI-powered learning paths, and skill assessments on SkillHub\'s professional LMS platform.')

@section('styles')
<style>

    :root {
    --glass-bg: rgba(255, 255, 255, 0.1);
    --glass-border: rgba(255, 255, 255, 0.2);
    --primary-gradient: linear-gradient(135deg, #2563eb, #10b981);
}

    /* Pagination Styles - ADD TO YOUR EXISTING STYLES */
.pagination-container {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: 3rem;
    gap: 1rem;
    flex-wrap: wrap;
}

.pagination {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    background: var(--bg-card);
    padding: 1rem 1.5rem;
    border-radius: 50px;
    box-shadow: var(--shadow-md);
    border: 1px solid var(--border-color);
}

.pagination a,
.pagination span {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 40px;
    height: 40px;
    padding: 0 0.75rem;
    text-decoration: none;
    border-radius: 20px;
    font-weight: 600;
    font-size: 0.875rem;
    transition: all 0.3s ease;
    color: var(--text-secondary);
    border: 1px solid transparent;
}

.pagination a:hover {
    background: var(--primary-color);
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
}

.pagination .current {
    background: var(--primary-gradient);
    color: white;
    box-shadow: 0 2px 8px rgba(37, 99, 235, 0.3);
    border-color: var(--primary-color);
}

.pagination .disabled {
    color: var(--text-light);
    cursor: not-allowed;
    opacity: 0.5;
}

.pagination .disabled:hover {
    background: transparent;
    transform: none;
    box-shadow: none;
}

.pagination .prev,
.pagination .next {
    min-width: 45px;
    font-size: 1rem;
}

.pagination .dots {
    color: var(--text-light);
    cursor: default;
    font-weight: bold;
}

.pagination .dots:hover {
    background: transparent;
    transform: none;
    box-shadow: none;
}

.pagination-info {
    font-size: 0.95rem;
    color: var(--text-secondary);
    background: var(--bg-card);
    padding: 0.5rem 1rem;
    border-radius: 20px;
    border: 1px solid var(--border-color);
}

.page-info {
    font-size: 0.875rem;
    color: var(--text-secondary);
    text-align: center;
    background: var(--bg-light);
    padding: 0.75rem 1.5rem;
    border-radius: 25px;
    border: 1px solid var(--border-color);
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.quick-jump {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    background: var(--bg-card);
    padding: 0.75rem 1.25rem;
    border-radius: 25px;
    border: 1px solid var(--border-color);
    font-size: 0.875rem;
}

.quick-jump label {
    color: var(--text-secondary);
    font-weight: 600;
    white-space: nowrap;
}

.quick-jump input {
    width: 60px;
    padding: 0.375rem 0.5rem;
    border: 1px solid var(--border-color);
    border-radius: 6px;
    text-align: center;
    font-size: 0.875rem;
}

.quick-jump input:focus {
    outline: none;
    border-color: var(--primary-color);
    box-shadow: 0 0 0 2px rgba(37, 99, 235, 0.1);
}

.quick-jump button {
    background: var(--primary-color);
    color: white;
    border: none;
    padding: 0.375rem 0.75rem;
    border-radius: 6px;
    font-size: 0.75rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s ease;
}

.quick-jump button:hover {
    background: var(--primary-dark);
}

/* Responsive pagination */
@media (max-width: 768px) {
    .pagination-container {
        flex-direction: column;
        gap: 1rem;
    }

    .pagination {
        padding: 0.75rem 1rem;
    }

    .pagination a,
    .pagination span {
        min-width: 35px;
        height: 35px;
        font-size: 0.8rem;
    }

    .quick-jump {
        order: -1;
    }
}

@media (max-width: 480px) {
    .pagination {
        padding: 0.5rem;
        gap: 0.25rem;
    }

    .pagination a,
    .pagination span {
        min-width: 30px;
        height: 30px;
        padding: 0 0.5rem;
        font-size: 0.75rem;
    }
}

    /* LMS Header Section */
    .lms-header {
    background: var(--primary-gradient);
    color: white;
    padding: 4rem 0 2rem;
    margin-top: -1px;
    position: relative;
    overflow: hidden;
}

    .lms-header::before {
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

    .lms-header-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 2rem;
    position: relative;
    z-index: 2;
    text-align: center;
}

.header-badge {
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
    margin-bottom: 1.5rem;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

   .lms-title {
    font-size: clamp(2.5rem, 4vw, 3.5rem);
    font-weight: 800;
    line-height: 1.1;
    margin-bottom: 1rem;
    background: linear-gradient(135deg, #ffffff 0%, #f0f8ff 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

    .lms-subtitle {
    font-size: 1.125rem;
    opacity: 0.9;
    max-width: 700px;
    margin: 0 auto;
    line-height: 1.6;
}

    /* Filters Section */
    .filters-section {
        background: var(--bg-card);
        padding: 2rem 0;
        border-bottom: 1px solid var(--border-color);
        box-shadow: var(--shadow-sm);
    }

    .filters-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 1rem;
    }

    .filters {
        background: var(--bg-card);
        border-radius: 16px;
        padding: 2rem;
        box-shadow: var(--shadow-md);
        border: 1px solid var(--border-color);
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.5rem;
        align-items: start;
    }

    .filter-group {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    .filters label {
        font-weight: 600;
        color: var(--text-dark);
        font-size: 0.875rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        height: 20px;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .filters select,
    .filters input[type="text"] {
        padding: 0.75rem 1rem;
        border: 2px solid var(--border-color);
        border-radius: 8px;
        font-size: 0.875rem;
        transition: all 0.3s ease;
        background: white;
        color: var(--text-dark);
        height: 46px;
    }

    .filters select:focus,
    .filters input[type="text"]:focus {
        outline: none;
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    }

    .filter-buttons {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
        align-self: start;
    }

    .filter-buttons-container {
        display: flex;
        gap: 0.75rem;
        margin-top: 25px;
    }

    .btn-apply {
        background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
        color: white;
        padding: 0.75rem 1rem;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        font-size: 0.875rem;
        height: 46px;
        min-width: 120px;
    }

    .btn-apply:hover {
        background: var(--primary-dark);
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
    }

    .btn-clear {
        background: transparent;
        color: var(--text-light);
        padding: 0.75rem 1rem;
        border: 2px solid var(--border-color);
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        font-size: 0.875rem;
        height: 46px;
        min-width: 100px;
    }

    .btn-clear:hover {
        border-color: var(--text-light);
        color: var(--text-dark);
    }

    /* Courses Section */
    .courses-section {
        padding: 3rem 0;
        background: var(--bg-light);
    }

    .courses-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 1rem;
    }

    .courses-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
    }

    .courses-count {
        font-size: 1.125rem;
        color: var(--text-light);
    }

    .courses-list {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
        gap: 2rem;
    }

    .course-card {
        background: var(--bg-card);
        border-radius: 16px;
        padding: 2rem;
        box-shadow: var(--shadow-sm);
        border: 1px solid var(--border-color);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .course-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--primary-color), var(--accent-color));
        transform: scaleX(0);
        transition: transform 0.3s ease;
    }

    .course-card:hover {
        transform: translateY(-8px);
        box-shadow: var(--shadow-xl);
        border-color: var(--primary-color);
    }

    .course-card:hover::before {
        transform: scaleX(1);
    }

    .course-card h3 {
        font-size: 1.5rem;
        font-weight: 600;
        margin-bottom: 1rem;
        color: var(--text-dark);
        line-height: 1.3;
    }

    .course-card p {
        color: var(--text-light);
        line-height: 1.6;
        margin-bottom: 1.5rem;
    }

   .rating-section {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem;
    background: var(--bg-light);
    border-radius: 8px;
}

.star-rating {
    display: flex;
    gap: 2px;
    align-items: center;
}

   .star {
    font-size: 1.25rem;
    transition: all 0.2s ease;
    display: inline-block;
    line-height: 1;
}

/* FIXED: Added missing dot before star-full */
.star-full {
    color: #fbbf24 !important;
    text-shadow: 0 1px 2px rgba(251, 191, 36, 0.4);
}

/* Empty stars */
.star-empty {
    color: #d1d5db;
}

/* Half star container */
.star-half {
    position: relative;
    display: inline-block;
}

.star-half .star-empty {
    color: #d1d5db;
}

.star-half {
    position: relative;
    display: inline-block;
    color: #fbbf24;
}
.star-half::after {
    content: '★';
    color: #fbbf24 !important;
    text-shadow: 0 1px 2px rgba(251, 191, 36, 0.4);
    position: absolute;
    left: 0;
    width: 50%;
    overflow: hidden;
}

.star-half .star-fill {
    position: absolute;
    top: 0;
    left: 0;
    width: 50%;
    overflow: hidden;
    color: #fbbf24;
    text-shadow: 0 1px 2px rgba(251, 191, 36, 0.4);
}

    .star.filled {
        color: #fbbf24;
    }

   /* Rating text */
.rating-text {
    font-weight: 600;
    color: var(--text-dark);
    font-size: 0.95rem;
}

/* Hover effects */
.star:hover {
    transform: scale(1.1);
}

@keyframes starGlow {
    0%, 100% { 
        filter: brightness(1); 
    }
    50% { 
        filter: brightness(1.2); 
    }
}

.star-full {
    animation: starGlow 3s ease-in-out infinite;
}

    .star.quarter::before {
    content: "★";
    position: absolute;
    top: 0;
    left: 0;
    color: #fbbf24;
    width: 25%;
    overflow: hidden;
}

.star.three-quarter::before {
    content: "★";
    position: absolute;
    top: 0;
    left: 0;
    color: #fbbf24;
    width: 75%;
    overflow: hidden;
}

.rating-count {
    font-size: 0.8rem;
    color: var(--text-light);
    font-weight: 400;
    margin-left: 0.25rem;
}

    .star:not(.filled):not(.half) {
        color: #d1d5db;
    }

    .rating-text {
        font-weight: 600;
        color: var(--text-dark);
    }

    /* Course Actions */
    .course-actions {
        display: flex;
        gap: 1rem;
        align-items: center;
        flex-wrap: wrap;
    }

    .btn-primary {
        background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
        color: white;
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-primary:hover {
        background: var(--primary-dark);
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
    }

    .btn-warning {
        background: var(--warning-color);
        color: white;
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        border: none;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-warning:hover {
        background: #d97706;
        transform: translateY(-2px);
    }

    .rated-badge {
        background: var(--success-color);
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-size: 0.875rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    /* Rating Overlay */
    .rating-overlay {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.5);
        backdrop-filter: blur(4px);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 2000;
        opacity: 1;
        transition: all 0.3s ease;
    }

    .rating-overlay.hidden {
        opacity: 0;
        visibility: hidden;
        pointer-events: none;
    }

    .rating-popup {
        background: var(--bg-card);
        border-radius: 16px;
        padding: 2rem;
        max-width: 400px;
        width: 90%;
        position: relative;
        box-shadow: var(--shadow-xl);
        transform: scale(1);
        transition: transform 0.3s ease;
    }

    .rating-overlay.hidden .rating-popup {
        transform: scale(0.9);
    }

    .close-rating {
        position: absolute;
        top: 1rem;
        right: 1rem;
        background: none;
        border: none;
        font-size: 1.5rem;
        cursor: pointer;
        color: var(--text-light);
        width: 32px;
        height: 32px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s ease;
    }

    .close-rating:hover {
        background: var(--bg-light);
        color: var(--text-dark);
    }

    .rating-title {
        font-size: 1.5rem;
        font-weight: 600;
        margin-bottom: 1.5rem;
        color: var(--text-dark);
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

   .rating-stars input[type="radio"]:checked,
.rating-stars input[type="radio"]:checked ~ input[type="radio"] {
    + label {
        color: #fbbf24 !important;
    }
}

.rating-stars input[type="radio"]:hover,
.rating-stars input[type="radio"]:hover ~ input[type="radio"] {
    + label {
        color: #fbbf24 !important;
    }
}

/* Fill all stars up to hovered star */


    .rating-btn {
        width: 100%;
        padding: 1rem;
        font-size: 1.1rem;
    }

    /* Guest Section */
    .guest-section {
        background: var(--bg-card);
        padding: 4rem 0;
        text-align: center;
    }

    .guest-container {
        max-width: 1000px;
        margin: 0 auto;
        padding: 0 1rem;
    }

    .lms-heading {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 1rem;
        color: var(--text-dark);
    }

    .lms-subheading {
        font-size: 1.25rem;
        color: var(--text-light);
        margin-bottom: 3rem;
        max-width: 600px;
        margin-left: auto;
        margin-right: auto;
    }

    .lms-highlights {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 2rem;
        margin-bottom: 3rem;
    }

    .lms-card {
        background: var(--bg-light);
        padding: 2rem;
        border-radius: 12px;
        border: 1px solid var(--border-color);
        transition: all 0.3s ease;
    }

    .lms-card:hover {
        transform: translateY(-4px);
        box-shadow: var(--shadow-lg);
    }

    .lms-card-title {
        font-size: 1.25rem;
        font-weight: 600;
        margin-bottom: 1rem;
        color: var(--text-dark);
    }

    .lms-card-description {
        color: var(--text-light);
        line-height: 1.6;
    }

    .lms-cta {
        display: flex;
        gap: 1rem;
        justify-content: center;
        flex-wrap: wrap;
    }

    .cta-button {
        padding: 1rem 2rem;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
        font-size: 1.1rem;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .primary-cta {
        background: var(--primary-color);
        color: white;
    }

    .primary-cta:hover {
        background: var(--primary-dark);
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
    }

    .secondary-cta {
        background: transparent;
        color: var(--primary-color);
        border: 2px solid var(--primary-color);
    }

    .secondary-cta:hover {
        background: var(--primary-color);
        color: white;
    }

    /* AI Chatbot Styles */
    .ai-chatbot {
        position: fixed;
        bottom: 20px;
        right: 20px;
        width: 380px;
        max-height: 65vh;
        background: white;
        border-radius: 16px;
        box-shadow: var(--shadow-xl);
        display: none;
        flex-direction: column;
        z-index: 1000;
        overflow: hidden;
        border: 1px solid var(--border-color);
    }

    .chatbot-header {
        padding: 1rem 1.25rem;
        background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
        color: white;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .chatbot-header h4 {
        margin: 0;
        font-size: 1.1rem;
        font-weight: 600;
    }

    #close-chatbot {
        background: none;
        border: none;
        color: white;
        font-size: 1.5rem;
        cursor: pointer;
        width: 32px;
        height: 32px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background 0.2s ease;
    }

    #close-chatbot:hover {
        background: rgba(255, 255, 255, 0.2);
    }

    .chatbot-messages {
        height: 350px;
        overflow-y: auto;
        padding: 1rem;
        background: var(--bg-light);
    }

    .bot-message, .user-message {
        margin: 0.75rem 0;
        padding: 0.75rem 1rem;
        border-radius: 16px;
        max-width: 85%;
        animation: messageAppear 0.3s ease-out;
    }

    .bot-message {
        background: white;
        margin-right: auto;
        box-shadow: var(--shadow-sm);
        border: 1px solid var(--border-color);
    }

    .user-message {
        background: var(--primary-color);
        color: white;
        margin-left: auto;
    }

    .chatbot-reset-btn {
        margin: 0 1rem 0.75rem 1rem;
        background: var(--bg-light);
        border: 1px solid var(--border-color);
        border-radius: 20px;
        padding: 0.5rem 1rem;
        cursor: pointer;
        font-size: 0.875rem;
        transition: all 0.2s ease;
    }

    .chatbot-reset-btn:hover {
        background: var(--border-color);
    }

    .chatbot-input {
        display: flex;
        padding: 1rem;
        background: white;
        border-top: 1px solid var(--border-color);
        align-items: center;
        gap: 0.75rem;
    }

    #chatbot-user-input {
        flex-grow: 1;
        padding: 0.75rem 1rem;
        border: 1px solid var(--border-color);
        border-radius: 24px;
        font-size: 0.875rem;
        outline: none;
        transition: all 0.3s ease;
    }

    #chatbot-user-input:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    }

    #send-message {
        width: 40px;
        height: 40px;
        border: none;
        border-radius: 50%;
        background: var(--primary-color);
        color: white;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s ease;
    }

    #send-message:hover {
        background: var(--primary-dark);
        transform: translateY(-1px);
    }

    .chatbot-trigger {
        position: fixed;
        bottom: 20px;
        right: 20px;
        background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
        color: white;
        border: none;
        border-radius: 50px;
        padding: 1rem 1.25rem;
        cursor: pointer;
        box-shadow: var(--shadow-lg);
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        z-index: 999;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .chatbot-trigger:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-xl);
    }

    /* Course Recommendations in Chat */
    .course-recommendations {
        margin: 1rem 0;
        padding: 0;
    }

    .recommended-course {
        background: var(--bg-card);
    border-radius: 12px;
    padding: 1.5rem;
    margin: 0.75rem 0;
    border: 1px solid var(--border-color);
    box-shadow: var(--shadow-sm);
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
    }

    .recommended-course::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 3px;
    background: linear-gradient(90deg, var(--primary-color), var(--accent-color));
    transform: scaleX(0);
    transition: transform 0.3s ease;
}

.recommended-course:hover {
    transform: translateY(-4px);
    box-shadow: var(--shadow-lg);
    border-color: var(--primary-color);
}

.recommended-course.enhanced-course-card:hover::before {
    transform: scaleX(1);
}

    .recommended-course a {
        text-decoration: none;
        font-weight: 600;
    }

    .recommended-course a:hover {
        text-decoration: underline;
    }

    .course-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 1rem;
    gap: 1rem;
}

.course-header h4 {
    margin: 0;
    font-size: 1.125rem;
    font-weight: 600;
    line-height: 1.4;
    flex: 1;
}

.course-header h4 a {
    color: var(--text-dark);
    text-decoration: none;
    transition: color 0.3s ease;
    display: block;
}

.course-header h4 a:hover {
    color: var(--primary-color);
    text-decoration: underline;
}

.course-rank {
    background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
    color: white;
    padding: 0.375rem 0.75rem;
    border-radius: 20px;
    font-size: 0.875rem;
    font-weight: 600;
    white-space: nowrap;
    box-shadow: 0 2px 8px rgba(37, 99, 235, 0.25);
    flex-shrink: 0;
}

.course-meta-enhanced {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
    margin-bottom: 1rem;
    padding: 1rem;
    background: var(--bg-light);
    border-radius: 8px;
    border: 1px solid var(--border-color);
}

    .course-meta {
        display: flex;
        gap: 1rem;
        font-size: 0.8rem;
        color: var(--text-light);
        margin-top: 0.5rem;
    }

    .course-excerpt {
        margin-top: 0.5rem;
        font-size: 0.875rem;
        color: var(--text-light);
    }

    .rating-display {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
}

.rating-display .stars {
    display: flex;
    gap: 2px;
    font-size: 1.125rem;
    color:#fbbf24;
    line-height: 1;
}

.rating-display .stars .star-full,
.rating-display .stars ★ {
    color: #fbbf24;
    text-shadow: 0 1px 2px rgba(251, 191, 36, 0.4);
}

.rating-display .stars .star-empty,
.rating-display .stars ☆ {
    color: #d1d5db;
}

.rating-display .rating-text {
    font-weight: 600;
    color: var(--text-dark);
    font-size: 0.95rem;
    background: white;
    padding: 0.25rem 0.5rem;
    border-radius: 4px;
    border: 1px solid var(--border-color);
}

.rating-display .rating-count {
    font-size: 0.875rem;
    color: var(--text-light);
    font-weight: 400;
}

/* Course Stats */
.course-stats {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    flex-wrap: wrap;
}

.course-stats span {
    display: inline-flex;
    align-items: center;
    gap: 0.375rem;
    font-size: 0.875rem;
    font-weight: 500;
    padding: 0.19rem;
    border-radius: 20px;
    border: 1px solid var(--border-color);
    background: white;
    color: var(--text-secondary);
    transition: all 0.2s ease;
}

.course-stats .views {
    color: var(--info-color, #3b82f6);
    border-color: rgba(59, 130, 246, 0.2);
    background: rgba(59, 130, 246, 0.05);
}

.course-stats .difficulty {
    color: var(--warning-color, #f59e0b);
    border-color: rgba(245, 158, 11, 0.2);
    background: rgba(245, 158, 11, 0.05);
    text-transform: capitalize;
}


.course-stats .category {
    color: var(--success-color, #10b981);
    border-color: rgba(16, 185, 129, 0.2);
    background: rgba(16, 185, 129, 0.05);
}

.course-stats span:hover {
    transform: translateY(-1px);
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

/* Course Excerpt */
.course-excerpt {
    color: var(--text-light);
    line-height: 1.6;
    margin: 1rem 0;
    font-size: 0.9rem;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* Course Instructor */
.course-instructor {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    margin-top: 1rem;
    padding: 0.75rem 1rem;
    background: linear-gradient(135deg, rgba(37, 99, 235, 0.05), rgba(16, 185, 129, 0.05));
    border-radius: 8px;
    border: 1px solid rgba(37, 99, 235, 0.1);
    font-size: 0.875rem;
    color: var(--text-secondary);
}

.course-instructor i {
    color: var(--primary-color);
    font-size: 1rem;
}

.course-instructor span {
    font-weight: 500;
}

@media (max-width: 768px) {
    .course-header {
        flex-direction: column;
        gap: 0.75rem;
    }
    
    .course-rank {
        align-self: flex-start;
    }
    
    .course-meta-enhanced {
        padding: 0.75rem;
    }
    
    .rating-display {
        gap: 0.5rem;
    }
    
    .course-stats {
        gap: 0.5rem;
    }
    
    .course-stats span {
        font-size: 0.8rem;
        padding: 0.25rem 0.5rem;
    }
}

@media (max-width: 480px) {
    .recommended-course.enhanced-course-card {
        padding: 1rem;
        margin: 0.5rem 0;
    }
    
    .course-header h4 {
        font-size: 1rem;
    }
    
    .course-rank {
        font-size: 0.8rem;
        padding: 0.25rem 0.5rem;
    }
    
    .course-stats {
        flex-direction: column;
        align-items: stretch;
    }
    
    .course-stats span {
        justify-content: center;
        text-align: center;
    }
}

@keyframes slideInFromBottom {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.recommended-course.enhanced-course-card {
    animation: slideInFromBottom 0.4s ease-out;
}

.recommended-course.enhanced-course-card:nth-child(2) {
    animation-delay: 0.1s;
}

.recommended-course.enhanced-course-card:nth-child(3) {
    animation-delay: 0.2s;
}

.recommended-course.enhanced-course-card:nth-child(4) {
    animation-delay: 0.3s;
}

/* Loading state for course recommendations */
.course-recommendations.loading .recommended-course {
    opacity: 0.6;
    pointer-events: none;
}

/* Enhanced hover effects */
.recommended-course.enhanced-course-card:hover .course-header h4 a {
    color: var(--primary-color);
}

.recommended-course.enhanced-course-card:hover .course-rank {
    transform: scale(1.05);
    box-shadow: 0 4px 12px rgba(37, 99, 235, 0.35);
}

.recommended-course.enhanced-course-card:hover .rating-display .stars {
    animation: starPulse 0.6s ease-in-out;
}

@keyframes starPulse {
    0%, 100% { 
        transform: scale(1); 
    }
    50% { 
        transform: scale(1.1); 
    }
}

@media (prefers-color-scheme: dark) {
    .course-meta-enhanced {
        background: rgba(255, 255, 255, 0.05);
        border-color: rgba(255, 255, 255, 0.1);
    }
    
    .rating-display .rating-text {
        background: rgba(255, 255, 255, 0.1);
        border-color: rgba(255, 255, 255, 0.2);
        
    }
    
    .course-stats span {
        background: rgba(255, 255, 255, 0.1);
        border-color: rgba(255, 255, 255, 0.2);
        color: rgba(255, 255, 255, 0.8);
    }
}

    /* Typing Indicator */
    .typing-dots {
        display: inline-flex;
        align-items: center;
        height: 17px;
    }

    .typing-dots span {
        width: 8px;
        height: 8px;
        margin: 0 2px;
        background-color: var(--text-light);
        border-radius: 50%;
        display: inline-block;
        animation: typingAnimation 1.4s infinite ease-in-out both;
    }

    .typing-dots span:nth-child(1) { animation-delay: -0.32s; }
    .typing-dots span:nth-child(2) { animation-delay: -0.16s; }

    @keyframes typingAnimation {
        0%, 80%, 100% { transform: scale(0); }
        40% { transform: scale(1); }
    }

    @keyframes messageAppear {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .lms-title {
            font-size: 2rem;
        }

        .filters {
            grid-template-columns: 1fr;
            gap: 1rem;
        }

        .filter-buttons {
            grid-column: 1;
            justify-content: stretch;
        }

        .courses-list {
            grid-template-columns: 1fr;
        }

        .lms-highlights {
            grid-template-columns: 1fr;
        }

        .lms-cta {
            flex-direction: column;
            align-items: center;
        }

        .ai-chatbot {
            width: 90%;
            right: 5%;
            bottom: 10px;
        }

        .course-actions {
            justify-content: center;
        }
    }

    /* Loading States */
    .loading {
        opacity: 0.6;
        pointer-events: none;
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        color: var(--text-light);
    }

    .empty-state h3 {
        font-size: 1.5rem;
        margin-bottom: 1rem;
        color: var(--text-dark);
    }



    /* ADD THIS CSS TO YOUR EXISTING STYLES SECTION */

/* Professional Rate Button Styling */
.btn-warning {
    background: linear-gradient(135deg, #f59e0b, #d97706);
    color: white;
    padding: 0.75rem 1.25rem;
    border-radius: 8px;
    border: none;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.875rem;
    box-shadow: 0 2px 8px rgba(245, 158, 11, 0.25);
    position: relative;
    overflow: hidden;
    text-decoration: none;
    min-width: 120px;
    justify-content: center;
}

.btn-warning::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
    transition: left 0.5s ease;
}

.btn-warning:hover {
    background: linear-gradient(135deg, #d97706, #b45309);
    transform: translateY(-2px);
    box-shadow: 0 4px 16px rgba(245, 158, 11, 0.35);
}

.btn-warning:hover::before {
    left: 100%;
}

.btn-warning:active {
    transform: translateY(0);
    box-shadow: 0 2px 8px rgba(245, 158, 11, 0.25);
}

.btn-warning i {
    font-size: 0.875rem;
    transition: transform 0.2s ease;
}

.btn-warning:hover i {
    transform: rotate(15deg) scale(1.1);
}

/* Enhanced Course Actions Layout */
.course-actions {
    display: flex;
    gap: 0.75rem;
    align-items: center;
    flex-wrap: wrap;
    margin-top: 1.5rem;
    padding-top: 1rem;
    border-top: 1px solid var(--border-color);
    /* Force visibility - no hover dependencies */
    opacity: 1 !important;
    visibility: visible !important;
    transform: none !important;
}

/* Enhanced Primary Button */
.btn-primary {
    background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
    color: white;
    padding: 0.75rem 1.25rem;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.875rem;
    box-shadow: 0 2px 8px rgba(37, 99, 235, 0.25);
    position: relative;
    overflow: hidden;
    min-width: 120px;
    justify-content: center;
}

.btn-primary::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
    transition: left 0.5s ease;
}

.btn-primary:hover {
    background: linear-gradient(135deg, #1d4ed8, #1e40af);
    transform: translateY(-2px);
    box-shadow: 0 4px 16px rgba(37, 99, 235, 0.35);
}

.btn-primary:hover::before {
    left: 100%;
}

.btn-primary i {
    transition: transform 0.2s ease;
}

.btn-primary:hover i {
    transform: translateX(2px);
}

/* Professional Rated Badge */
.rated-badge {
    background: linear-gradient(135deg, var(--success-color), #059669);
    color: white;
    padding: 0.75rem 1.25rem;
    border-radius: 8px;
    font-size: 0.875rem;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    box-shadow: 0 2px 8px rgba(16, 185, 129, 0.25);
    border: none;
    min-width: 120px;
    justify-content: center;
}

.rated-badge i {
    font-size: 0.875rem;
}

/* Responsive Actions */
@media (max-width: 768px) {
    .course-actions {
        flex-direction: column;
        gap: 0.5rem;
    }
    
    .btn-primary,
    .btn-warning,
    .rated-badge {
        width: 100%;
        min-width: auto;
    }
}

/* Loading State for Rate Button */
.btn-warning.loading {
    pointer-events: none;
    opacity: 0.8;
}

.btn-warning.loading i {
    animation: spin 1s linear infinite;
}

@keyframes spin {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}

/* Tooltip for Rate Button */
.btn-warning {
    position: relative;
}

.btn-warning::after {
    content: 'Share your experience with other learners';
    position: absolute;
    bottom: -45px;
    left: 50%;
    transform: translateX(-50%);
    background: rgba(0, 0, 0, 0.8);
    color: white;
    padding: 0.5rem 0.75rem;
    border-radius: 6px;
    font-size: 0.75rem;
    white-space: nowrap;
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s ease;
    z-index: 1000;
    pointer-events: none;
}

.btn-warning:hover::after {
    opacity: 1;
    visibility: visible;
    bottom: -40px;
}

/* Enhanced Card Interaction */
.course-card {
    background: var(--bg-card);
    border-radius: 16px;
    padding: 2rem;
    box-shadow: var(--shadow-sm);
    border: 1px solid var(--border-color);
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    height: 100%;
}

.course-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, var(--primary-color), var(--accent-color));
    transform: scaleX(0);
    transition: transform 0.3s ease;
}

.course-card:hover {
    transform: translateY(-8px);
    box-shadow: var(--shadow-xl);
    border-color: var(--primary-color);
}

.course-card:hover::before {
    transform: scaleX(1);
}

/* Ensure course content grows to push actions to bottom */
.course-content {
    display: flex;
    flex-direction: column;
    flex-grow: 1;
}

.course-content p {
    flex-grow: 1;
    margin-bottom: 1rem;
}

/* Button Focus States for Accessibility */
.btn-primary:focus,
.btn-warning:focus {
    outline: 2px solid var(--primary-color);
    outline-offset: 2px;
}

/* Success Animation for Rating */
@keyframes ratingSuccess {
    0% { transform: scale(1); }
    50% { transform: scale(1.05); }
    100% { transform: scale(1); }
}

.rated-badge.new-rating {
    animation: ratingSuccess 0.6s ease;
}

.current-rating {
    background: var(--info-color, #3b82f6);
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.875rem;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    box-shadow: 0 2px 8px rgba(59, 130, 246, 0.25);
}

/* Update button text color for re-rating */
.btn-warning.update-rating {
    background: linear-gradient(135deg, #8b5cf6, #7c3aed);
}

.btn-warning.update-rating:hover {
    background: linear-gradient(135deg, #7c3aed, #6d28d9);
}

/* Enhanced rating popup for updates */
.rating-popup.update-mode .rating-title::after {
    content: " (Update Your Rating)";
    color: var(--warning-color);
    font-size: 0.875rem;
}
.course-info-row {
    display: flex;
    gap: 1.25rem;
    margin: 0.5rem 0 1rem 0;
    flex-wrap: wrap;
    align-items: center; /* Center align the items */
}

.course-info-row > div {
    display: flex;
    align-items: center;
    font-size: 0.95rem;
    font-weight: 500;
    color: var(--text-secondary, #374151);
    background: #f8fafc;
    border: 1px solid var(--border-color, #e5e7eb);
    border-radius: 20px;
    padding: 0.25rem 0.75rem;
    margin: 0; /* REMOVED: margin-left: 16px; */
    transition: box-shadow 0.2s;
    white-space: nowrap; /* Prevent text wrapping */
}

.course-info-row > div i {
    margin-right: 0.4em;
    color: var(--primary-color, #2563eb);
    font-size: 1em;
}

/* ENHANCED: Better spacing and styling for level and instructor */
.course-level,
.course-instructor {
    flex-shrink: 0; /* Prevent shrinking */
}

.course-level span {
    font-weight: 600;
    text-transform: capitalize;
}



/* FALLBACK: Class-based approach for more reliable styling */
.course-level.beginner {
    background: rgba(16, 185, 129, 0.1) !important;
    border-color: rgba(16, 185, 129, 0.3) !important;
}

.course-level.beginner span {
    color: #10b981 !important;
}

.course-level.intermediate {
    background: rgba(245, 158, 11, 0.1) !important;
    border-color: rgba(245, 158, 11, 0.3) !important;
}

.course-level.intermediate span {
    color: #f59e0b !important;
}

.course-level.advanced {
    background: rgba(239, 68, 68, 0.1) !important;
    border-color: rgba(239, 68, 68, 0.3) !important;
}

.course-level.advanced span {
    color: #ef4444 !important;
}

/* JavaScript-based fallback - if classes aren't working */
.course-level[data-difficulty="beginner"] {
    background: rgba(16, 185, 129, 0.15) !important;
    border-color: rgba(16, 185, 129, 0.4) !important;
}

.course-level[data-difficulty="beginner"] span {
    color: #059669 !important;
}

.course-level[data-difficulty="intermediate"] {
    background: rgba(245, 158, 11, 0.15) !important;
    border-color: rgba(245, 158, 11, 0.4) !important;
}

.course-level[data-difficulty="intermediate"] span {
    color: #d97706 !important;
}

.course-level[data-difficulty="advanced"] {
    background: rgba(239, 68, 68, 0.15) !important;
    border-color: rgba(239, 68, 68, 0.4) !important;
}

.course-level[data-difficulty="advanced"] span {
    color: #dc2626 !important;
}

.course-instructor span {
    color: var(--info-color, #3b82f6);
    font-weight: 600;
}

@media (max-width: 480px) {
    .course-info-row {
        flex-direction: row; /* Keep side by side even on mobile */
        gap: 0.75rem;
    }
    
    .course-info-row > div {
        font-size: 0.85rem;
        padding: 0.2rem 0.6rem;
    }
}

/* ALTERNATIVE: If you want them to stack on very small screens */
@media (max-width: 360px) {
    .course-info-row {
        flex-direction: column;
        align-items: flex-start;
        gap: 0.5rem;
    }
    
    .course-info-row > div {
        width: 100%;
        justify-content: center;
    }
}

</style>

<style>
   /* FIXED: Enhanced Guest Welcome Modal Styles */
.guest-welcome-modal {
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
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s ease;
    padding: 1rem;
}

.guest-welcome-modal.show {
    opacity: 1;
    visibility: visible;
}

.modal-content {
    background: white;
    border-radius: 20px;
    max-width: 700px;
    width: 100%;
    max-height: 90vh;
    /* FIXED: Re-enable scrolling for the entire modal content */
    overflow-y: auto;
    position: relative;
    box-shadow: 
        0 25px 50px -12px rgba(0, 0, 0, 0.25),
        0 0 0 1px rgba(255, 255, 255, 0.1);
    transform: scale(0.9) translateY(20px);
    transition: transform 0.3s ease;
    /* ENHANCED: Keep flexbox for proper layout */
    display: flex;
    flex-direction: column;
}

/* ENHANCED: Custom Scrollbar for Modal Content */
.modal-content::-webkit-scrollbar {
    width: 8px;
}

.modal-content::-webkit-scrollbar-track {
    background: #f1f5f9;
    border-radius: 10px;
}

.modal-content::-webkit-scrollbar-thumb {
    background: linear-gradient(135deg, #667eea, #764ba2);
    border-radius: 10px;
    box-shadow: inset 0 1px 3px rgba(0,0,0,0.3);
}

.modal-content::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(135deg, #5a67d8, #6b46c1);
}

/* Firefox scrollbar */
.modal-content {
    scrollbar-width: thin;
}

.guest-welcome-modal.show .modal-content {
    transform: scale(1) translateY(0);
}

.modal-close {
    position: absolute;
    top: 1.5rem;
    right: 1.5rem;
    background: rgba(255, 255, 255, 0.2);
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
    transition: all 0.2s ease;
    z-index: 10;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.3);
}

.modal-close:hover {
    background: rgba(255, 255, 255, 0.3);
    color: white;
    transform: scale(1.1);
}

/* ENHANCED: Header Content Stacked Vertically */
.modal-header {
    text-align: center;
    padding: 3rem 3rem 2rem;
    color: white;
    border-radius: 20px 20px 0 0;
    position: relative;
    overflow: hidden;
    /* FIXED: Allow header to shrink if needed */
    flex-shrink: 0;
    /* ENHANCED: Stack content vertically */
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 1.5rem;
}

.modal-header::before {
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

.modal-header > * {
    position: relative;
    z-index: 2;
}

.modal-icon {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2.5rem;
    backdrop-filter: blur(20px);
    margin: 0;
}

.modal-title {
    font-size: 2.5rem;
    font-weight: 800;
    margin: 0;
    line-height: 1.2;
    background: linear-gradient(135deg, #ffffff 0%, #f0f8ff 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.modal-subtitle {
    font-size: 1.125rem;
    opacity: 0.95;
    line-height: 1.6;
    max-width: 500px;
    margin: 0 auto;
}

/* FIXED: Modal Body - Proper Flex Layout */
.modal-body {
    padding: 2rem 3rem;
    /* FIXED: Allow body to grow and shrink as needed */
    flex: 1;
    /* FIXED: Prevent overflow issues */
    min-height: 0;
}

.benefits-grid {
    display: grid;
    gap: 1.5rem;
    margin-bottom: 2rem;
}

.benefit-item {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
    padding: 1.5rem;
    background: var(--bg-light, #f8fafc);
    border-radius: 12px;
    border: 1px solid var(--border-color, #e2e8f0);
    transition: all 0.3s ease;
}

.benefit-item:hover {
    transform: translateY(-4px);
    box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    border-color: var(--primary-color, #3b82f6);
}

.benefit-icon {
    font-size: 2rem;
    line-height: 1;
    flex-shrink: 0;
}

.benefit-content h4 {
    font-size: 1.125rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
    color: var(--text-dark, #1f2937);
}

.benefit-content p {
    font-size: 0.9rem;
    color: var(--text-light, #6b7280);
    line-height: 1.5;
    margin: 0;
}

.social-proof {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 2rem;
    border-radius: 16px;
    text-align: center;
    margin-top: 1rem;
}

.proof-stats {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
    gap: 2rem;
}

.stat {
    display: flex;
    flex-direction: column;
    align-items: center;
}

.stat-number {
    font-size: 2rem;
    font-weight: 800;
    line-height: 1;
    margin-bottom: 0.5rem;
}

.stat-label {
    font-size: 0.875rem;
    opacity: 0.9;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

.modal-footer {
    padding: 2rem 3rem 3rem;
    background: var(--bg-light, #f8fafc);
    border-radius: 0 0 20px 20px;
    text-align: center;
    /* FIXED: Keep footer at bottom */
    flex-shrink: 0;
}

.modal-actions {
    display: flex;
    gap: 1rem;
    justify-content: center;
    margin-bottom: 1.5rem;
    flex-wrap: wrap;
}

.btn-modal-primary,
.btn-modal-secondary {
    padding: 1rem 2rem;
    border-radius: 10px;
    text-decoration: none;
    font-weight: 600;
    font-size: 1.1rem;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 0.75rem;
    border: none;
    cursor: pointer;
    min-width: 200px;
    justify-content: center;
    position: relative;
    overflow: hidden;
}

.btn-modal-primary {
    background: linear-gradient(135deg, #2563eb, #10b981);
    color: white;
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
}

.btn-modal-primary::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
    transition: left 0.5s ease;
}

.btn-modal-primary:hover {
    background: linear-gradient(135deg, #5a67d8, #6b46c1);
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
}

.btn-modal-primary:hover::before {
    left: 100%;
}

.btn-modal-secondary {
    background: transparent;
    color: var(--primary-color, #3b82f6);
    border: 2px solid var(--primary-color, #3b82f6);
}

.btn-modal-secondary:hover {
    background: var(--primary-color, #3b82f6);
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(59, 130, 246, 0.2);
}

/* Enhanced Responsive Design */
@media (max-width: 768px) {
    .modal-content {
        margin: 1rem;
        max-height: calc(100vh - 2rem);
        border-radius: 16px;
    }
    
    .modal-header {
        padding: 2rem 2rem 1.5rem;
        border-radius: 16px 16px 0 0;
        gap: 1rem;
    }
    
    .modal-title {
        font-size: 2rem;
    }
    
    .modal-subtitle {
        font-size: 1rem;
    }
    
    .modal-body {
        padding: 1.5rem 2rem;
    }
    
    .modal-footer {
        padding: 1.5rem 2rem 2rem;
        border-radius: 0 0 16px 16px;
    }
    
    .benefits-grid {
        grid-template-columns: 1fr;
        gap: 1rem;
    }
    
    .benefit-item {
        padding: 1rem;
    }
    
    .modal-actions {
        flex-direction: column;
        align-items: center;
    }
    
    .btn-modal-primary,
    .btn-modal-secondary {
        width: 100%;
        min-width: auto;
    }
    
    .proof-stats {
        grid-template-columns: repeat(3, 1fr);
        gap: 1rem;
    }
    
    .stat-number {
        font-size: 1.5rem;
    }
}

@media (max-width: 480px) {
    .modal-header {
        padding: 1.5rem 1.5rem 1rem;
        gap: 0.75rem;
    }
    
    .modal-body {
        padding: 1rem 1.5rem;
    }
    
    .modal-footer {
        padding: 1rem 1.5rem 1.5rem;
    }
    
    .modal-title {
        font-size: 1.75rem;
    }
    
    .modal-icon {
        width: 60px;
        height: 60px;
        font-size: 2rem;
    }
    
    .benefit-item {
        flex-direction: column;
        text-align: center;
        gap: 0.75rem;
    }
    
    .social-proof {
        padding: 1.5rem;
    }
    
    .proof-stats {
        gap: 0.75rem;
    }
}

/* FIXED: Better height management for small screens */
@media (max-height: 700px) {
    .modal-content {
        max-height: 95vh;
    }
    
    .modal-header {
        padding: 1.5rem 3rem 1rem;
        gap: 1rem;
    }
    
    .modal-body {
        padding: 1rem 3rem;
    }
    
    .modal-footer {
        padding: 1rem 3rem 1.5rem;
    }
    
    .modal-icon {
        width: 60px;
        height: 60px;
        font-size: 2rem;
    }
    
    .modal-title {
        font-size: 2rem;
    }
}

/* Enhanced Animation */
@keyframes modalSlideIn {
    from {
        opacity: 0;
        transform: scale(0.8) translateY(30px);
    }
    to {
        opacity: 1;
        transform: scale(1) translateY(0);
    }
}

.guest-welcome-modal.show .modal-content {
    animation: modalSlideIn 0.4s ease-out;
}

/* Loading state for buttons */
.btn-modal-primary.loading,
.btn-modal-secondary.loading {
    pointer-events: none;
    opacity: 0.8;
}

.btn-modal-primary.loading::after,
.btn-modal-secondary.loading::after {
    content: '';
    width: 16px;
    height: 16px;
    border: 2px solid currentColor;
    border-top-color: transparent;
    border-radius: 50%;
    animation: spin 1s linear infinite;
    margin-left: 0.5rem;
}

@keyframes spin {
    to {
        transform: rotate(360deg);
    }
}
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endsection

@section('content')
    <!-- LMS Header Section -->
    <section class="lms-header">
    <div class="lms-header-container">
        <div class="header-badge">
            <i class="fas fa-graduation-cap"></i>
            <span>Learning Management System</span>
        </div>
        <h1 class="lms-title">Learning Management System</h1>
        <p class="lms-subtitle">
            Discover interactive courses, AI-powered learning paths, and skill assessments designed to advance your career
        </p>
    </div>
</section>

    <!-- Filters Section -->
    <section class="filters-section">
        <div class="filters-container">
            <form method="GET" action="{{ route('lms') }}">
                <div class="filters">
                    <div class="filter-group">
                        <label for="category">
                            <i class="fas fa-tags"></i> Category
                        </label>
                        <select id="category" name="category">
                        <option value="all" {{ request('category') == 'all' ? 'selected' : '' }}>All Categories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}>
                                {{ $category }}
                            </option>
                        @endforeach
                    </select>
                    </div>

                    <div class="filter-group">
                        <label for="difficulty">
                            <i class="fas fa-chart-line"></i> Difficulty
                        </label>
                        <select id="difficulty" name="difficulty">
                            <option value="all" {{ request('difficulty') == 'all' ? 'selected' : '' }}>All Levels</option>
                            <option value="beginner" {{ request('difficulty') == 'beginner' ? 'selected' : '' }}>Beginner</option>
                            <option value="intermediate" {{ request('difficulty') == 'intermediate' ? 'selected' : '' }}>Intermediate</option>
                            <option value="advanced" {{ request('difficulty') == 'advanced' ? 'selected' : '' }}>Advanced</option>
                        </select>
                    </div>

                    <div class="filter-group">
                        <label for="courseSearch">
                            <i class="fas fa-search"></i> Search Courses
                        </label>
                        <input type="text" id="courseSearch" placeholder="Search for a course..." />
                    </div>

                    <div class="filter-buttons">
                        <div class="filter-buttons-container">
                            <button id="apply" type="submit" class="btn-apply">
                                <i class="fas fa-filter"></i>
                                Apply Filters
                            </button>
                            <a id="clear" href="/lms" class="btn-clear">
                                <i class="fas fa-times"></i>
                                Clear
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <!-- Courses Section -->
    <section class="courses-section">
        <div class="courses-container">
            <div class="courses-header">
    <h2 style="font-size: 2rem; font-weight: 600; color: var(--text-dark);">
        <i class="fas fa-graduation-cap"></i>
        Available Courses
    </h2>
    <div style="display: flex; gap: 1rem; align-items: center; flex-wrap: wrap;">
        <p class="courses-count">
            <i class="fas fa-book"></i>
            {{ $courses->total() }} courses available
        </p>
        @if($courses->total() > 6)
            <div class="pagination-info">
                <i class="fas fa-info-circle"></i>
                Showing {{ $courses->firstItem() }}-{{ $courses->lastItem() }} of {{ $courses->total() }}
            </div>
        @endif
    </div>
</div>

            <div class="courses-list">
                @forelse ($courses as $course)
                    <div class="course-card">
                        <div class="course-content">
                            <h3>{{ $course->title }}</h3>
                            <!-- Course Level -->
                            <div class="course-info-row">
                             <div class="course-level {{ strtolower($course->difficulty) }}" data-difficulty="{{ strtolower($course->difficulty) }}">
                                <span>Level: {{ $course->difficulty}}</span>
                            </div>
                            <!-- Instructor Name -->
                            <div class="course-instructor">
                                <span>Instructor: {{ $course->instructor }}</span>
                            </div>
                            </div>
                            <p class="course-description">{{ $course->description }}</p>
                            
                            <!-- Star Rating Display -->
                           <div class="rating-section">
                            <div class="star-rating">
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
                            <span class="rating-text">{{ number_format($course->averageRating(), 2) }}/5</span>
                        </div>
                        <div class="course-info-row">
                        <!-- Views -->
                            <div class="course-views">
                                <span>Views: {{ $course->views }}</span>
                            </div>
                        </div>

                            <div class="course-actions">
                                <a href="{{ route('courses.show', $course->id) }}" class="btn-primary">
                                    <i class="fas fa-play"></i>
                                    Learn More
                                </a>
                                
                                 @auth
                            <!-- Always show rate button, but change text based on rating status -->
                            <button class="btn-warning rate-toggle" data-course="{{ $course->id }}">
                                <i class="fas fa-star"></i>
                                {{ $course->isRated ? 'Rate' : 'Rate ' }}
                            </button>
                        @endauth
                            </div>
                        </div>
                    </div>

                    <!-- Floating Rating Form -->
                    <div class="rating-overlay hidden" id="rating-overlay-{{ $course->id }}">
                        <div class="rating-popup">
                            <span class="close-rating" data-course="{{ $course->id }}">&times;</span>
                            <form action="{{ route('ratings.store', $course->id) }}" method="POST" class="rating-form">
                                @csrf
                                <h3 class="rating-title">Rate this Course</h3>
                                <div class="rating-stars">
                                    @for ($i = 5; $i >= 1; $i--)
                                        <input type="radio" id="star{{ $i }}-{{ $course->id }}" name="rating" value="{{ $i }}" required>
                                        <label for="star{{ $i }}-{{ $course->id }}" class="star">&#9733;</label>
                                    @endfor
                                </div>
                                <button type="submit" class="btn-primary rating-btn">
                                    <i class="fas fa-star"></i>
                                    Submit Rating
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="empty-state">
                        <i class="fas fa-book-open" style="font-size: 4rem; color: var(--text-light); margin-bottom: 1rem;"></i>
                        <h3>No courses found</h3>
                        <p>Try adjusting your filters or search terms to find courses.</p>
                    </div>
                @endforelse
            </div>
            <!-- ADD THIS AFTER YOUR COURSES-LIST DIV -->
<!-- Pagination Section -->
@if($courses->hasPages())
    <div class="pagination-container">
        <!-- Page Info -->
        <div class="page-info">
            <i class="fas fa-file-alt"></i>
            Page {{ $courses->currentPage() }} of {{ $courses->lastPage() }}
        </div>

        <!-- Main Pagination -->
        <div class="pagination">
            {{-- Previous Page Link --}}
            @if ($courses->onFirstPage())
                <span class="prev disabled">
                    <i class="fas fa-chevron-left"></i>
                </span>
            @else
                <a href="{{ $courses->appends(request()->query())->previousPageUrl() }}" class="prev">
                    <i class="fas fa-chevron-left"></i>
                </a>
            @endif

            {{-- Pagination Elements --}}
            @php
                $start = max(1, $courses->currentPage() - 2);
                $end = min($courses->lastPage(), $courses->currentPage() + 2);
            @endphp

            {{-- First Page --}}
            @if($start > 1)
                <a href="{{ $courses->appends(request()->query())->url(1) }}">1</a>
                @if($start > 2)
                    <span class="dots">...</span>
                @endif
            @endif

            {{-- Page Links --}}
            @for ($i = $start; $i <= $end; $i++)
                @if ($i == $courses->currentPage())
                    <span class="current">{{ $i }}</span>
                @else
                    <a href="{{ $courses->appends(request()->query())->url($i) }}">{{ $i }}</a>
                @endif
            @endfor

            {{-- Last Page --}}
            @if($end < $courses->lastPage())
                @if($end < $courses->lastPage() - 1)
                    <span class="dots">...</span>
                @endif
                <a href="{{ $courses->appends(request()->query())->url($courses->lastPage()) }}">{{ $courses->lastPage() }}</a>
            @endif

            {{-- Next Page Link --}}
            @if ($courses->hasMorePages())
                <a href="{{ $courses->appends(request()->query())->nextPageUrl() }}" class="next">
                    <i class="fas fa-chevron-right"></i>
                </a>
            @else
                <span class="next disabled">
                    <i class="fas fa-chevron-right"></i>
                </span>
            @endif
        </div>

        <!-- Quick Jump -->
        @if($courses->lastPage() > 5)
            <div class="quick-jump">
                <label for="jumpToPage">
                    <i class="fas fa-external-link-alt"></i>
                    Jump to:
                </label>
                <input type="number" id="jumpToPage" min="1" max="{{ $courses->lastPage() }}" 
                       value="{{ $courses->currentPage() }}" placeholder="Page">
                <button type="button" onclick="jumpToPage()">Go</button>
            </div>
        @endif
    </div>
@endif
        </div>
    </section>
    

    @auth
    <!-- AI Chatbot -->
    <div id="ai-chatbot" class="ai-chatbot">
        <div class="chatbot-header">
            <h4>
                <i class="fas fa-robot"></i>
                Learning Path Assistant
            </h4>
            <button id="close-chatbot">&times;</button>
        </div>
        <div class="chatbot-messages" id="chatbot-messages">
            <div class="bot-message">
                <p>👋 Hello! I'm here to help you find the perfect learning path.</p>
                <p>Let's start with your interests. What would you like to learn?</p>
            </div>
        </div>
        <button id="chatbot-reset" class="chatbot-reset-btn">
            🔄 Start Over
        </button>
        <div class="chatbot-input">
            <input type="text" id="chatbot-user-input" placeholder="Type your message..." aria-label="Chat input">
            <button id="send-message" aria-label="Send message">
                <i class="fas fa-paper-plane"></i>
            </button>
        </div>
    </div>

    <a id="open-chatbot" class="chatbot-trigger" href="/chatbot">
        <i class="fas fa-robot"></i> 
        AI Learning Assistant
        
        {{-- on click te5dak 3l chatbot.blade.php --}}
    </a>
    @endauth    

    {{-- ADD THIS RIGHT BEFORE @endsection FOR CONTENT --}}

@guest
<!-- Welcome Modal -->
<div class="guest-welcome-modal" id="guestWelcomeModal">
    <div class="modal-content">
        <button class="modal-close" onclick="hideWelcomeModal()" aria-label="Close modal">&times;</button>
        
        <div class="modal-header">
            <div class="modal-icon">
                <i class="fas fa-graduation-cap"></i>
            </div>
            <h2 class="modal-title">Welcome to SkillHub LMS!</h2>
            <p class="modal-subtitle">
                You're viewing our course catalog as a guest. Create a free account to unlock the full learning experience.
            </p>
        </div>
        
        <div class="modal-body">
            <!-- Benefits Grid -->
            <div class="benefits-grid">
                <div class="benefit-item">
                    <div class="benefit-icon">💻</div>
                    <div class="benefit-content">
                        <h4>Interactive Challenges</h4>
                        <p>Hands-on coding practice with real projects</p>
                    </div>
                </div>
                <div class="benefit-item">
                    <div class="benefit-icon">🎯</div>
                    <div class="benefit-content">
                        <h4>Personalized Learning</h4>
                        <p>AI-powered recommendations for your goals</p>
                    </div>
                </div>
                <div class="benefit-item">
                    <div class="benefit-icon">📝</div>
                    <div class="benefit-content">
                        <h4>Interactive MCQ Quizzes</h4>
                        <p>Test your knowledge with engaging multiple-choice questions and track your performance in real time.</p>
                    </div>

                </div>
                <div class="benefit-item">
                <div class="benefit-icon">🌟</div>
                <div class="benefit-content">
                    <h4>Rate Courses</h4>
                    <p>Give feedback and rate courses to help others choose the best learning path.</p>
                </div>
                </div>
            </div>
        </div>
        
        <div class="modal-footer">
            <!-- Primary Actions -->
            <div class="modal-actions">
                <a href="{{ route('register') }}" class="btn-modal-primary">
                    <i class="fas fa-user-plus"></i>
                    Create Free Account
                </a>
                <a href="{{ route('login') }}" class="btn-modal-secondary">
                    <i class="fas fa-sign-in-alt"></i>
                    I Have an Account
                </a>
            </div>
        </div>
    </div>
</div>
@endguest
@endsection

@section('scripts')


<script>
// 🎯 GUEST MODAL FIX - Simplified and Working Version
document.addEventListener('DOMContentLoaded', function() {
    console.log('🎉 LMS Script Loaded');
    
    // Convert PHP boolean to JS boolean properly
    const isGuest = @json(auth()->guest());
    
    console.log('User is guest:', isGuest);
    
    // Initialize course search for everyone
    initCourseSearch();
    
    // Initialize features based on authentication
    if (isGuest) {
        console.log('👋 Initializing GUEST features');
        initGuestWelcomeModal();
    } else {
        console.log('✅ Initializing AUTHENTICATED features');
        initAuthenticatedFeatures();
    }
});

// Course search functionality
function initCourseSearch() {
    const courseSearch = document.getElementById('courseSearch');
    const courseCards = document.querySelectorAll('.course-card');
    
    if (courseSearch && courseCards.length > 0) {
        const filterCourses = () => {
            const searchText = courseSearch.value.toLowerCase();
            
            courseCards.forEach(card => {
                const courseTitle = card.querySelector('h3').textContent.toLowerCase();
                const courseDescription = card.querySelector('p').textContent.toLowerCase();

                if (courseTitle.includes(searchText) || courseDescription.includes(searchText)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        };

        courseSearch.addEventListener('input', filterCourses);
    }
}

// 👋 GUEST WELCOME MODAL - FIXED VERSION
function initGuestWelcomeModal() {
    console.log('🎯 Initializing guest welcome modal...');
    
    const modal = document.getElementById('guestWelcomeModal');
    
    if (!modal) {
        console.error('❌ Modal element #guestWelcomeModal not found!');
        return;
    }
    
    console.log('✅ Modal element found');
    
    // Check if dismissed
    const dismissed = localStorage.getItem('welcomeModalDismissed') === 'true';
    const shownThisSession = sessionStorage.getItem('modalShownThisSession') === 'true';
    
    if (dismissed || shownThisSession) {
        console.log('🚫 Modal already dismissed/shown');
        return;
    }
    
    // Setup event listeners first
    setupModalEventListeners(modal);
    
    // Show modal after 2 seconds
    console.log('⏰ Will show modal in 2 seconds...');
    setTimeout(() => {
        console.log('🚀 SHOWING MODAL NOW!');
        showModal(modal);
    }, 2000);
}

function showModal(modal) {
    if (!modal) return;
    
    console.log('🎊 Displaying welcome modal');
    
    // Force display
    modal.style.display = 'flex';
    modal.style.opacity = '0';
    
    // Trigger animation
    setTimeout(() => {
        modal.classList.add('show');
        modal.style.opacity = '1';
        document.body.style.overflow = 'hidden';
        
        // Mark as shown
        sessionStorage.setItem('modalShownThisSession', 'true');
        
        console.log('✅ Modal is now visible');
    }, 50);
}

function hideModal(modal) {
    if (!modal) return;
    
    console.log('❌ Hiding modal');
    
    modal.classList.remove('show');
    document.body.style.overflow = '';
    
    setTimeout(() => {
        modal.style.display = 'none';
    }, 300);
}

function setupModalEventListeners(modal) {
    // Close button
    const closeBtn = modal.querySelector('.modal-close');
    if (closeBtn) {
        closeBtn.addEventListener('click', () => hideModal(modal));
    }
    
    // Background click
    modal.addEventListener('click', function(e) {
        if (e.target === modal) {
            hideModal(modal);
        }
    });
    
    // Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && modal.classList.contains('show')) {
            hideModal(modal);
        }
    });
    
    // Don't show again checkbox
    const checkbox = modal.querySelector('#dontShowAgain');
    if (checkbox) {
        checkbox.addEventListener('change', function() {
            if (this.checked) {
                localStorage.setItem('welcomeModalDismissed', 'true');
                console.log('🚫 Modal permanently dismissed');
            }
        });
    }
    
    // CTA buttons
    const ctaButtons = modal.querySelectorAll('.btn-modal-primary, .btn-modal-secondary');
    ctaButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            sessionStorage.setItem('modalShownThisSession', 'true');
        });
    });
    
    console.log('🔧 Event listeners setup complete');
}

// Global functions for HTML onclick handlers
window.hideWelcomeModal = function() {
    const modal = document.getElementById('guestWelcomeModal');
    hideModal(modal);
};

window.setDontShowAgain = function(checked) {
    if (checked) {
        localStorage.setItem('welcomeModalDismissed', 'true');
        sessionStorage.setItem('modalShownThisSession', 'true');
        window.hideWelcomeModal();
    }
};

// Debug function - call this in console to test
window.testModal = function() {
    localStorage.removeItem('welcomeModalDismissed');
    sessionStorage.removeItem('modalShownThisSession');
    const modal = document.getElementById('guestWelcomeModal');
    if (modal) {
        showModal(modal);
    }
};

// 🔐 AUTHENTICATED USER FEATURES
function initAuthenticatedFeatures() {
    @auth
    // Your existing chatbot and rating code here
    initChatbot();
    initRatingSystem();
    @endauth
}

function initChatbot() {
    // Your existing chatbot code
    console.log('🤖 Chatbot initialized');
}

function initRatingSystem() {
    // Your existing rating system code
    console.log('⭐ Rating system initialized');
}

console.log('🎉 Script initialization complete!');
</script>

<!-- Debug Console Commands -->
<script>
console.log('🔧 DEBUG COMMANDS AVAILABLE:');
console.log('- testModal() : Force show the modal');
console.log('- hideWelcomeModal() : Hide the modal');
console.log('- Guest status:', @json(auth()->guest()));
</script>

<script>// ADD THIS TO YOUR EXISTING SCRIPT SECTION
// Pagination functionality
window.jumpToPage = function() {
    const pageInput = document.getElementById('jumpToPage');
    const page = parseInt(pageInput.value);
    const maxPage = parseInt(pageInput.getAttribute('max'));
    
    if (page >= 1 && page <= maxPage) {
        // Get current URL parameters
        const urlParams = new URLSearchParams(window.location.search);
        urlParams.set('page', page);
        
        // Navigate to new page
        window.location.href = window.location.pathname + '?' + urlParams.toString();
    } else {
        alert(`Please enter a page number between 1 and ${maxPage}`);
        pageInput.value = {{ $courses->currentPage() }};
    }
};

// Enter key support for quick jump
const jumpInput = document.getElementById('jumpToPage');
if (jumpInput) {
    jumpInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            jumpToPage();
        }
    });
}
</script>







{{-- Rating script --}}
<script>
 // 🎯 FINAL RATING FIX - Replace your rating script with this

document.addEventListener('DOMContentLoaded', function() {
    console.log('🎯 FINAL RATING FIX LOADED - Supports Re-rating!');
    
    // 1. OPEN RATING POPUP
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
                            title.innerHTML = `Update Your Rating <span style="color: #f59e0b; font-size: 0.9rem;">(Currently: ${existingRating}/5)</span>`;
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

    // 4. STAR RATING - ENHANCED FOR RE-RATING
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
                    console.log('⭐ Selected rating:', rating);
                });
                
                // Hover effect
                label.addEventListener('mouseenter', function() {
                    updateStarDisplay(starGroup, rating);
                });
            }
        });
        
        // Reset on mouse leave
        starGroup.addEventListener('mouseleave', function() {
            const checkedInput = starGroup.querySelector('input:checked');
            if (checkedInput) {
                updateStarDisplay(starGroup, parseInt(checkedInput.value));
            } else {
                resetStars(starGroup);
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
                    label.style.transform = 'scale(1.1)';
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
                title.innerHTML = 'Rate this Course';
            }
        }
    }

    // Helper function to get user's current rating from the page
    function getUserCurrentRating(courseId) {
        const ratingSpan = document.querySelector(`[data-course="${courseId}"]`)?.parentElement?.querySelector('.current-rating');
        if (ratingSpan) {
            const match = ratingSpan.textContent.match(/Your rating: (\d+)\/5/);
            return match ? parseInt(match[1]) : null;
        }
        return null;
    }

    // 5. FORM SUBMISSION - FIXED SUCCESS DETECTION
    document.querySelectorAll('.rating-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault(); // STOP default submission
            
            const selectedRating = this.querySelector('input[name="rating"]:checked');
            const submitBtn = this.querySelector('.rating-btn');
            const courseId = extractCourseId(this);
            const existingRating = getUserCurrentRating(courseId);
            
            console.log('🚀 SUBMITTING RATING:', {
                courseId: courseId,
                rating: selectedRating ? selectedRating.value : 'NONE',
                existingRating: existingRating,
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
            
            // AJAX submission with better success detection
            const formData = new FormData();
            formData.append('rating', selectedRating.value);
            formData.append('_token', getCSRFToken());
            
            // Use your Laravel route
            const submitUrl = this.action; // Use the form's action URL directly
            
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
    
    // SUCCESS: Either JSON response or redirect
    if (response.ok || response.status === 302) {
        console.log('✅ SUCCESS: Rating submitted successfully');
        
        // Try to get JSON response for new average rating
        if (response.headers.get('content-type')?.includes('application/json')) {
            return response.json().then(data => {
                console.log('📊 Got JSON response:', data);
                
                // Close popup
                const overlay = this.closest('.rating-overlay');
                if (overlay) {
                    overlay.classList.add('hidden');
                    resetRatingPopup(overlay);
                }
                
                // Update button and rating display
                updateRatingButton(courseId, selectedRating.value, existingRating);
                
                // 🔥 NEW: Refresh the course rating display with new average
                if (data.average_rating) {
                    refreshCourseRating(courseId, data.average_rating);
                }
                
               
            });
        } else {
            // For redirect responses, manually fetch the new rating
            console.log('📡 Got redirect, fetching new rating manually...');
            
            // Close popup
            const overlay = this.closest('.rating-overlay');
            if (overlay) {
                overlay.classList.add('hidden');
                resetRatingPopup(overlay);
            }
            
            // Update button
            updateRatingButton(courseId, selectedRating.value, existingRating);
            
            // 🔥 NEW: Fetch and update the new average rating
            fetch(`/lms/${courseId}/rating-info`, {
                headers: { 'Accept': 'application/json' }
            })
            .then(r => r.json())
            .then(data => {
                if (data.success) {
                    refreshCourseRating(courseId, data.average_rating);
                }
            })
            .catch(e => console.log('Could not fetch updated rating:', e));
            
            // Show success message
            const isUpdate = existingRating !== null;
            const message = isUpdate 
                ? `✅ Rating updated to ${selectedRating.value}/5!` 
                : `✅ Rating submitted: ${selectedRating.value}/5!`;
            showSuccessNotification(message);
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
    
    function updateRatingButton(courseId, newRating, existingRating) {
    const rateButton = document.querySelector(`[data-course="${courseId}"]`);
    
    if (rateButton) {
        rateButton.innerHTML = `<i class="fas fa-star"></i> Rate`;
    }
    
}
    
    
    

    function refreshCourseRating(courseId, newAverageRating) {
    console.log('🔄 Refreshing course rating display for course:', courseId);
    console.log('📊 New average rating:', newAverageRating);
    
    // Find the course card by finding the rate button and going up to the card
    const rateButton = document.querySelector(`[data-course="${courseId}"]`);
    const courseCard = rateButton?.closest('.course-card');
    
    if (!courseCard) {
        console.log('❌ Could not find course card');
        return;
    }
    
    // Find the rating section in this course card
    const ratingSection = courseCard.querySelector('.rating-section');
    if (!ratingSection) {
        console.log('❌ Could not find rating section');
        return;
    }
    
    // Update the rating text (e.g., "4.2/5")
    const ratingText = ratingSection.querySelector('.rating-text');
    if (ratingText) {
        const formattedRating = parseFloat(newAverageRating).toFixed(2);
        ratingText.textContent = `${formattedRating}/5`;
        console.log('✅ Updated rating text to:', `${formattedRating}/5`);
    }
    
    // Update the star display
    const starRating = ratingSection.querySelector('.star-rating');
    if (starRating) {
        updateCourseStars(starRating, newAverageRating);
    }
    
    console.log('✅ Course rating display updated successfully');
}


// 2. ADD THIS FUNCTION to update the visual stars
// FIXED STAR UPDATE FUNCTION - This was the main issue
function updateCourseStars(starContainer, averageRating) {
    const rating = parseFloat(averageRating);
    const fullStars = Math.floor(rating);
    const decimal = rating - fullStars;
    const hasHalfStar = decimal >= 0.25 && decimal < 0.75; // More precise half-star logic
    const emptyStars = 5 - fullStars - (hasHalfStar ? 1 : 0);
    
    console.log('⭐ Updating stars with details:', { 
        rating, 
        fullStars, 
        decimal, 
        hasHalfStar, 
        emptyStars 
    });
    
    // Clear existing stars
    starContainer.innerHTML = '';
    
    // Add full stars (★)
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
        halfStar.style.color = '#d1d5db'; // Gray background
        halfStar.innerHTML = '★';
        
        // Create the half-fill overlay
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
    
    // Add empty stars (☆)
    for (let i = 1; i <= emptyStars; i++) {
        const star = document.createElement('span');
        star.className = 'star star-empty';
        star.innerHTML = '☆';
        star.style.color = '#d1d5db';
        starContainer.appendChild(star);
    }
    
    console.log('✅ Successfully updated star display');
}

function handleRatingSubmissionSuccess(form, selectedRating, existingRating) {
    const courseId = extractCourseId(form);
    
    // Close popup
    const overlay = form.closest('.rating-overlay');
    if (overlay) {
        overlay.classList.add('hidden');
        resetRatingPopup(overlay);
    }
    
    // Update button
    updateRatingButton(courseId, selectedRating.value, existingRating);
    
    // Calculate new average rating manually (simplified approach)
    // This avoids the need for additional API calls
    setTimeout(() => {
        // Force page refresh for accurate data - most reliable solution
        window.location.reload();
    }, 1000);
    
}
    
    console.log('🎉 FINAL RATING FIX COMPLETE - Re-rating Enabled!');
});
</script>


{{-- <script>
    document.addEventListener('DOMContentLoaded', () => {
  const openBtn = document.getElementById('open-chatbot');
  const closeBtn = document.getElementById('close-chatbot');
  const chatbot = document.getElementById('ai-chatbot');
  const messagesContainer = document.getElementById('chatbot-messages');
  const userInput = document.getElementById('chatbot-user-input');
  const sendBtn = document.getElementById('send-message');
  const resetBtn = document.getElementById('chatbot-reset');

  // Open chatbot
  openBtn.addEventListener('click', () => {
    chatbot.style.display = 'block';
    userInput.focus();
  });

  // Close chatbot
  closeBtn.addEventListener('click', () => {
    chatbot.style.display = 'none';
  });

  // Reset chat messages
  resetBtn.addEventListener('click', () => {
    messagesContainer.innerHTML = `
      <div class="bot-message">
        <p>👋 Hello! I'm here to help you find the perfect learning path.</p>
        <p>Let's start with your interests. What would you like to learn?</p>
      </div>`;
    userInput.value = '';
    userInput.focus();
  });

  // Helper to append messages
  function appendMessage(text, sender = 'bot') {
    const div = document.createElement('div');
    div.className = sender === 'bot' ? 'bot-message' : 'user-message';
    div.innerHTML = `<p>${text}</p>`;
    messagesContainer.appendChild(div);
    messagesContainer.scrollTop = messagesContainer.scrollHeight;
  }

  // Send user message to backend Laravel API
  async function sendMessage(message) {
    appendMessage(message, 'user');
    userInput.value = '';

    try {
      const response = await fetch('/api/chatbot', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        },
        body: JSON.stringify({ message }),
      });
      const data = await response.json();
      appendMessage(data.reply, 'bot');
    } catch (error) {
      appendMessage('Sorry, something went wrong. Please try again later.', 'bot');
      console.error(error);
    }
  }

  // Send on button click or Enter key
  sendBtn.addEventListener('click', () => {
    if (userInput.value.trim()) {
      sendMessage(userInput.value.trim());
    }
  });
  userInput.addEventListener('keydown', (e) => {
    if (e.key === 'Enter' && userInput.value.trim()) {
      sendMessage(userInput.value.trim());
    }
  });
});
</script> --}}

@endsection