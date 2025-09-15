@extends('layouts.app')

@section('title', 'AI Learning Assistant - SkillHub')
@section('description', 'Get personalized learning guidance and course recommendations from SkillHub\'s AI-powered learning assistant.')

@section('styles')
<style>
    :root {
        --primary-gradient: linear-gradient(135deg, #2563eb, #10b981);
        --primary-color: #2563eb;
        --primary-dark: #1d4ed8;
        --accent-color: #10b981;
        --accent-dark: #059669;
        --glass-bg: rgba(255, 255, 255, 0.1);
        --glass-border: rgba(255, 255, 255, 0.2);
        --text-primary: #1a202c;
        --text-secondary: #4a5568;
        --text-light: #718096;
        --surface-white: #ffffff;
        --surface-light: #f7fafc;
        --border-light: rgba(0, 0, 0, 0.06);
        --shadow-medium: 0 4px 12px rgba(0, 0, 0, 0.15);
        --shadow-large: 0 8px 25px rgba(0, 0, 0, 0.2);
        --border-radius: 20px;
        --animation-speed: 0.3s;
    }

    /* Header Section */
    .chatbot-header {
        background: var(--primary-gradient);
        color: white;
        padding: 4rem 0 2rem;
        position: relative;
        overflow: hidden;
        margin-top: -1px;
    }

    .chatbot-header::before {
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

    .chatbot-header-container {
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

    .chatbot-title {
        font-size: clamp(2.5rem, 4vw, 3.5rem);
        font-weight: 800;
        line-height: 1.1;
        margin-bottom: 1rem;
        background: linear-gradient(135deg, #ffffff 0%, #f0f8ff 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .chatbot-subtitle {
        font-size: 1.125rem;
        opacity: 0.9;
        max-width: 700px;
        margin: 0 auto;
        line-height: 1.6;
    }

    /* Main Content */
    .chatbot-content {
        background: var(--surface-light);
        border-radius: 40px 40px 0 0;
        margin-top: -1rem;
        padding: 3rem 0 2rem;
        box-shadow: 0 -10px 40px rgba(0, 0, 0, 0.1);
        min-height: 80vh;
    }

    .chatbot-container {
        max-width: 900px;
        margin: 0 auto;
        padding: 0 2rem;
    }

    /* Chat Box */
    .chat-box {
        background: var(--surface-white);
        border-radius: var(--border-radius);
        box-shadow: var(--shadow-large);
        border: 1px solid var(--border-light);
        height: 500px;
        display: flex;
        flex-direction: column;
        overflow: hidden;
        margin-bottom: 2rem;
    }

    .chat-box::before {
        content: '';
        height: 4px;
        background: var(--primary-gradient);
    }

    /* Chat Header */
    .chat-header {
        background: linear-gradient(135deg, var(--surface-white) 0%, var(--surface-light) 100%);
        padding: 1.5rem 2rem;
        border-bottom: 1px solid var(--border-light);
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .chat-avatar {
        width: 40px;
        height: 40px;
        background: var(--primary-gradient);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
    }

    .chat-info h3 {
        margin: 0 0 0.25rem 0;
        font-size: 1.125rem;
        font-weight: 600;
        color: var(--text-primary);
    }

    .chat-info p {
        margin: 0;
        font-size: 0.875rem;
        color: var(--text-light);
    }

    /* Messages Area */
    .chat-messages {
        flex: 1;
        overflow-y: auto;
        padding: 1.5rem 2rem;
        background: var(--surface-light);
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .chat-messages::-webkit-scrollbar {
        width: 6px;
    }

    .chat-messages::-webkit-scrollbar-track {
        background: var(--surface-light);
    }

    .chat-messages::-webkit-scrollbar-thumb {
        background: var(--primary-color);
        border-radius: 3px;
    }

    /* Message Bubbles */
    .message {
        display: flex;
        align-items: flex-start;
        gap: 0.75rem;
        max-width: 80%;
        animation: slideIn 0.3s ease-out;
    }

    .message.user {
        align-self: flex-end;
        flex-direction: row-reverse;
    }

    .message.bot {
        align-self: flex-start;
    }

    .message-avatar {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.875rem;
        flex-shrink: 0;
    }

    .message.user .message-avatar {
        background: var(--primary-color);
        color: white;
    }

    .message.bot .message-avatar {
        background: var(--accent-color);
        color: white;
    }

    .message-content {
        background: var(--surface-white);
        padding: 1rem 1.25rem;
        border-radius: 16px;
        box-shadow: var(--shadow-medium);
        border: 1px solid var(--border-light);
        font-size: 0.95rem;
        line-height: 1.5;
        color: var(--text-primary);
        word-wrap: break-word;
    }

    .message.user .message-content {
        background: var(--primary-color);
        color: white;
        border-color: var(--primary-color);
    }

    /* Bot Message Styling */
    .message.bot .message-content {
        background: var(--surface-white);
        color: var(--text-primary);
        line-height: 1.7;
    }

    .message.bot .message-content strong {
        color: var(--primary-color);
        font-weight: 600;
    }

    .message.bot .message-content br + br {
        line-height: 0.5;
    }

    /* Course Link Styling */
    .message.bot .message-content a {
        color: var(--primary-color) !important;
        text-decoration: none !important;
        font-weight: bold !important;
        background: linear-gradient(135deg, #e3f2fd, #bbdefb) !important;
        padding: 10px 20px !important;
        border-radius: 25px !important;
        display: inline-block !important;
        margin: 8px 0 !important;
        transition: all 0.3s ease !important;
        box-shadow: 0 2px 8px rgba(37, 99, 235, 0.2) !important;
        border: 2px solid var(--primary-color) !important;
    }

    .message.bot .message-content a:hover {
        background: var(--primary-color) !important;
        color: white !important;
        transform: translateY(-2px) !important;
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.4) !important;
    }

    /* Emoji Spacing */
    .message.bot .message-content span[style*="margin-right"] {
        margin-right: 8px;
        display: inline-block;
    }

    /* Separator Lines */
    .message.bot .message-content hr {
        border: none;
        height: 1px;
        background: linear-gradient(90deg, transparent, var(--border-light), transparent);
        margin: 15px 0;
    }

    /* Welcome Message */
    .welcome-message {
        text-align: center;
        padding: 3rem 2rem;
        color: var(--text-light);
    }

    .welcome-icon {
        width: 60px;
        height: 60px;
        background: var(--primary-gradient);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.5rem;
        margin: 0 auto 1rem;
    }

    .welcome-message h4 {
        font-size: 1.125rem;
        font-weight: 600;
        color: var(--text-primary);
        margin-bottom: 0.5rem;
    }

    .welcome-message p {
        margin: 0;
        line-height: 1.5;
    }

    /* Input Area */
    .chat-input-area {
        background: var(--surface-white);
        border-top: 1px solid var(--border-light);
        padding: 1.5rem 2rem;
    }

    .input-container {
        display: flex;
        gap: 1rem;
        align-items: flex-end;
    }

    .input-wrapper {
        flex: 1;
        position: relative;
    }

    .chat-input {
        width: 100%;
        padding: 1rem 1.25rem;
        border: 2px solid var(--border-light);
        border-radius: 12px;
        font-size: 1rem;
        font-family: inherit;
        resize: none;
        background: var(--surface-light);
        color: var(--text-primary);
        transition: all var(--animation-speed) ease;
        min-height: 44px;
        max-height: 120px;
        line-height: 1.4;
    }

    .chat-input:focus {
        outline: none;
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        background: var(--surface-white);
    }

    .send-button {
        background: var(--primary-gradient);
        color: white;
        border: none;
        border-radius: 50%;
        width: 48px;
        height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all var(--animation-speed) ease;
        font-size: 1rem;
        box-shadow: var(--shadow-medium);
        flex-shrink: 0;
    }

    .send-button:hover:not(:disabled) {
        transform: translateY(-2px);
        box-shadow: var(--shadow-large);
    }

    .send-button:disabled {
        opacity: 0.5;
        cursor: not-allowed;
        transform: none;
    }

    /* Action Buttons */
    .chat-actions {
        display: flex;
        gap: 1rem;
        justify-content: center;
        flex-wrap: wrap;
    }

    .action-btn {
        background: var(--surface-white);
        color: var(--primary-color);
        border: 2px solid var(--primary-color);
        padding: 0.75rem 1.5rem;
        border-radius: 12px;
        font-weight: 600;
        cursor: pointer;
        transition: all var(--animation-speed) ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        text-decoration: none;
        font-size: 0.875rem;
    }

    .action-btn:hover {
        background: var(--primary-color);
        color: white;
        transform: translateY(-2px);
        box-shadow: var(--shadow-medium);
    }

    .action-btn.danger {
        color: #dc2626;
        border-color: #dc2626;
    }

    .action-btn.danger:hover {
        background: #dc2626;
        color: white;
    }

    /* Typing Indicator */
    .typing-indicator {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        max-width: 150px;
        animation: slideIn 0.3s ease-out;
    }

    .typing-dots {
        background: var(--surface-white);
        padding: 1rem 1.25rem;
        border-radius: 16px;
        box-shadow: var(--shadow-medium);
        border: 1px solid var(--border-light);
        display: flex;
        align-items: center;
        gap: 0.4rem;
    }

    .typing-dot {
        width: 6px;
        height: 6px;
        background: var(--text-light);
        border-radius: 50%;
        animation: typing 1.4s infinite ease-in-out;
    }

    .typing-dot:nth-child(2) { animation-delay: -0.32s; }
    .typing-dot:nth-child(3) { animation-delay: -0.16s; }

    @keyframes typing {
        0%, 80%, 100% { transform: scale(0.8); opacity: 0.5; }
        40% { transform: scale(1); opacity: 1; }
    }

    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Error Message */
    .error-message {
        background: #fef2f2;
        color: #dc2626;
        padding: 1rem 1.25rem;
        border-radius: 12px;
        border: 1px solid #fecaca;
        margin: 1rem 0;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        font-size: 0.9rem;
        animation: slideIn 0.3s ease-out;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .chatbot-content {
            border-radius: 20px 20px 0 0;
            padding: 2rem 0 1rem;
        }

        .chatbot-container {
            padding: 0 1rem;
        }

        .chat-box {
            height: 400px;
        }

        .chat-header {
            padding: 1rem 1.5rem;
        }

        .chat-messages {
            padding: 1rem 1.5rem;
        }

        .message {
            max-width: 90%;
        }

        .chat-input-area {
            padding: 1rem 1.5rem;
        }

        .chat-actions {
            flex-direction: column;
            align-items: center;
        }

        .action-btn {
            width: 100%;
            max-width: 300px;
            justify-content: center;
        }
    }

    @media (max-width: 480px) {
        .chatbot-header {
            padding: 2rem 0 1rem;
        }

        .chatbot-header-container {
            padding: 0 1rem;
        }

        .chatbot-title {
            font-size: 2rem;
        }

        .chat-box {
            height: 350px;
        }

        .input-container {
            flex-direction: column;
            gap: 0.75rem;
        }

        .send-button {
            align-self: flex-end;
        }
    }

    /* Accessibility */
    .chat-input:focus,
    .send-button:focus,
    .action-btn:focus {
        outline: 3px solid rgba(37, 99, 235, 0.3);
        outline-offset: 2px;
    }

    @media (prefers-reduced-motion: reduce) {
        * {
            animation-duration: 0.01ms !important;
            transition-duration: 0.01ms !important;
        }
    }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endsection

@section('content')
<!-- Header Section -->
<section class="chatbot-header">
    <div class="chatbot-header-container">
        <div class="header-badge">
            <i class="fas fa-robot"></i>
            <span>AI Learning Assistant</span>
        </div>
        <h1 class="chatbot-title">Learning Path Assistant</h1>
        <p class="chatbot-subtitle">
            Get personalized learning guidance, course recommendations, and expert advice to accelerate your professional development journey.
        </p>
    </div>
</section>

<!-- Main Content -->
<div class="chatbot-content">
    <div class="chatbot-container">
        <!-- Chat Interface -->
        <div class="chat-box">
            <!-- Chat Header -->
            <div class="chat-header">
                <div class="chat-avatar">
                    <i class="fas fa-robot"></i>
                </div>
                <div class="chat-info">
                    <h3>Learning Path Assistant</h3>
                    <p>Powered by Google Gemini AI</p>
                </div>
            </div>

            <!-- Messages Area -->
            <div class="chat-messages" id="chat-messages">
                <div class="welcome-message">
                    <div class="welcome-icon">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <h4>Welcome to your AI Learning Assistant!</h4>
                    <p>Ask me about courses, career paths, learning strategies, or any questions about your professional development journey.</p>
                </div>
            </div>

            <!-- Input Area -->
            <div class="chat-input-area">
                <div class="input-container">
                    <div class="input-wrapper">
                        <textarea 
                            id="user-input" 
                            class="chat-input" 
                            placeholder="Ask me about courses, career advice, or learning paths..."
                            rows="1"
                        ></textarea>
                    </div>
                    <button id="send-button" class="send-button" onclick="sendMessage()">
                        <i class="fas fa-paper-plane"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="chat-actions">
            <button class="action-btn danger" onclick="clearChat()">
                <i class="fas fa-trash-alt"></i>
                <span>Clear Chat</span>
            </button>
            <a href="{{ url('/lms') }}" class="action-btn">
                <i class="fas fa-graduation-cap"></i>
                <span>Back to LMS</span>
            </a>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const userInput = document.getElementById('user-input');
    const sendButton = document.getElementById('send-button');
    
    // Auto-resize textarea
    userInput.addEventListener('input', function() {
        this.style.height = 'auto';
        this.style.height = Math.min(this.scrollHeight, 120) + 'px';
        
        // Enable/disable send button
        sendButton.disabled = !this.value.trim();
    });
    
    // Send on Enter (Shift+Enter for new line)
    userInput.addEventListener('keydown', function(e) {
        if (e.key === 'Enter' && !e.shiftKey) {
            e.preventDefault();
            sendMessage();
        }
    });
    
    // Initialize
    sendButton.disabled = true;
});

async function sendMessage() {
    const input = document.getElementById('user-input');
    const message = input.value.trim();
    
    if (!message) return;
    
    // Add user message
    addMessage(message, 'user');
    
    // Clear input
    input.value = '';
    input.style.height = 'auto';
    document.getElementById('send-button').disabled = true;
    
    // Show typing indicator
    const typingIndicator = showTypingIndicator();
    
    try {
        const response = await fetch('http://127.0.0.1:5000/chat', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ message })
        });
        
        // Remove typing indicator
        typingIndicator.remove();
        
        const data = await response.json();
        
        if (data.reply) {
            addMessage(data.reply, 'bot');
        } else {
            showError(data.error || 'Unknown error occurred');
        }
        
    } catch (error) {
        typingIndicator.remove();
        showError('Connection failed. Make sure the Flask server is running on http://127.0.0.1:5000');
        console.error('Error:', error);
    }
    
    // Focus input
    input.focus();
}

function addMessage(content, sender) {
    const chatMessages = document.getElementById('chat-messages');
    
    // Hide welcome message
    const welcomeMessage = chatMessages.querySelector('.welcome-message');
    if (welcomeMessage) {
        welcomeMessage.style.display = 'none';
    }
    
    const messageDiv = document.createElement('div');
    messageDiv.className = `message ${sender}`;
    
    // Format the content based on sender
    let formattedContent;
    if (sender === 'user') {
        formattedContent = content; // User messages stay as plain text
    } else {
        formattedContent = formatBotMessage(content); // Bot messages get HTML formatting
    }
    
    messageDiv.innerHTML = `
        <div class="message-avatar">
            <i class="fas fa-${sender === 'user' ? 'user' : 'robot'}"></i>
        </div>
        <div class="message-content">${formattedContent}</div>
    `;
    
    chatMessages.appendChild(messageDiv);
    chatMessages.scrollTop = chatMessages.scrollHeight;
}

function formatBotMessage(message) {
    return message
        // Convert line breaks to HTML
        .replace(/\n/g, '<br>')
        // Convert bold markdown to HTML
        .replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>')
        // Add separator lines with styling
        .replace(/─{10,}/g, '<hr style="border: none; height: 1px; background: linear-gradient(90deg, transparent, #e2e8f0, transparent); margin: 15px 0;">')
        // Add spacing around emojis for better readability
        .replace(/(📚|👨‍🏫|📂|📊|⭐|👁️|🔗|📝|🎯|✨)/g, '<span style="margin-right: 8px; display: inline-block;">$1</span>')
        // Ensure course enrollment links are properly styled and functional
        .replace(/<a ([^>]*)>/g, '<a $1 style="color: #2563eb !important; text-decoration: none !important; font-weight: bold !important; background: linear-gradient(135deg, #e3f2fd, #bbdefb); padding: 10px 20px; border-radius: 25px; display: inline-block; margin: 8px 0; transition: all 0.3s ease; box-shadow: 0 2px 8px rgba(37, 99, 235, 0.2); border: 2px solid #2563eb;" onmouseover="this.style.background=\'#2563eb\'; this.style.color=\'white\'; this.style.transform=\'translateY(-2px)\'; this.style.boxShadow=\'0 4px 12px rgba(37, 99, 235, 0.4)\';" onmouseout="this.style.background=\'linear-gradient(135deg, #e3f2fd, #bbdefb)\'; this.style.color=\'#2563eb\'; this.style.transform=\'translateY(0)\'; this.style.boxShadow=\'0 2px 8px rgba(37, 99, 235, 0.2)\';">');
}

function showTypingIndicator() {
    const chatMessages = document.getElementById('chat-messages');
    
    const typingDiv = document.createElement('div');
    typingDiv.className = 'typing-indicator';
    typingDiv.innerHTML = `
        <div class="message-avatar" style="background: var(--accent-color); color: white;">
            <i class="fas fa-robot"></i>
        </div>
        <div class="typing-dots">
            <div class="typing-dot"></div>
            <div class="typing-dot"></div>
            <div class="typing-dot"></div>
        </div>
    `;
    
    chatMessages.appendChild(typingDiv);
    chatMessages.scrollTop = chatMessages.scrollHeight;
    
    return typingDiv;
}

function showError(errorText) {
    const chatMessages = document.getElementById('chat-messages');
    
    const errorDiv = document.createElement('div');
    errorDiv.className = 'error-message';
    errorDiv.innerHTML = `
        <i class="fas fa-exclamation-triangle"></i>
        <span>${errorText}</span>
    `;
    
    chatMessages.appendChild(errorDiv);
    chatMessages.scrollTop = chatMessages.scrollHeight;
    
    // Auto-remove after 5 seconds
    setTimeout(() => errorDiv.remove(), 5000);
}

function clearChat() {
    const chatMessages = document.getElementById('chat-messages');
    
    if (chatMessages.children.length > 1) {
        if (!confirm('Are you sure you want to clear the chat?')) return;
    }
    
    chatMessages.innerHTML = `
        <div class="welcome-message">
            <div class="welcome-icon">
                <i class="fas fa-graduation-cap"></i>
            </div>
            <h4>Welcome to your AI Learning Assistant!</h4>
            <p>Ask me about courses, career paths, learning strategies, or any questions about your professional development journey.</p>
        </div>
    `;
    
    document.getElementById('user-input').focus();
}
</script>
@endsection