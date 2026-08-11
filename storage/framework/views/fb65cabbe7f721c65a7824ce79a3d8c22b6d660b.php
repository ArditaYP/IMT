<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IMT AI Assistant</title>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-gradient: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            --glass-bg: rgba(255, 255, 255, 0.03);
            --glass-border: rgba(255, 255, 255, 0.08);
            --primary: #3b82f6;
            --primary-hover: #2563eb;
            --text-main: #f8fafc;
            --text-muted: #94a3b8;
            --user-msg: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            --ai-msg: rgba(255, 255, 255, 0.06);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg-gradient);
            color: var(--text-main);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        /* Animated Background Elements */
        .bg-orb-1 {
            position: absolute;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(59,130,246,0.15) 0%, rgba(0,0,0,0) 70%);
            top: -100px;
            left: -100px;
            border-radius: 50%;
            animation: float 8s ease-in-out infinite;
        }
        
        .bg-orb-2 {
            position: absolute;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(232,134,46,0.1) 0%, rgba(0,0,0,0) 70%);
            bottom: -150px;
            right: -100px;
            border-radius: 50%;
            animation: float 10s ease-in-out infinite reverse;
        }

        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(30px); }
            100% { transform: translateY(0px); }
        }

        .chat-container {
            width: 100%;
            max-width: 900px;
            height: 85vh;
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            border-radius: 24px;
            display: flex;
            flex-direction: column;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            position: relative;
            z-index: 10;
            overflow: hidden;
        }

        .chat-header {
            padding: 24px 32px;
            border-bottom: 1px solid var(--glass-border);
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .header-icon {
            width: 48px;
            height: 48px;
            background: linear-gradient(135deg, #3b82f6, #8b5cf6);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.4);
        }

        .header-info h1 {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 4px;
            letter-spacing: 0.5px;
        }

        .header-info p {
            font-size: 13px;
            color: var(--text-muted);
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .status-dot {
            width: 8px;
            height: 8px;
            background: #10b981;
            border-radius: 50%;
            box-shadow: 0 0 10px #10b981;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.4); }
            70% { box-shadow: 0 0 0 6px rgba(16, 185, 129, 0); }
            100% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0); }
        }

        .chat-messages {
            flex: 1;
            padding: 32px;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            gap: 24px;
            scroll-behavior: smooth;
        }

        .chat-messages::-webkit-scrollbar {
            width: 6px;
        }
        .chat-messages::-webkit-scrollbar-track {
            background: transparent;
        }
        .chat-messages::-webkit-scrollbar-thumb {
            background: rgba(255,255,255,0.1);
            border-radius: 10px;
        }

        .message {
            max-width: 80%;
            display: flex;
            gap: 16px;
            animation: slideUp 0.4s cubic-bezier(0.16, 1, 0.3, 1) forwards;
            opacity: 0;
            transform: translateY(20px);
        }

        @keyframes slideUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .message.user {
            align-self: flex-end;
            flex-direction: row-reverse;
        }

        .avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            flex-shrink: 0;
        }

        .avatar.ai {
            background: rgba(255,255,255,0.1);
            border: 1px solid rgba(255,255,255,0.2);
        }

        .avatar.user {
            background: var(--primary);
        }

        .bubble {
            padding: 16px 20px;
            border-radius: 20px;
            font-size: 15px;
            line-height: 1.6;
            letter-spacing: 0.2px;
            position: relative;
        }

        .message.ai .bubble {
            background: var(--ai-msg);
            border: 1px solid var(--glass-border);
            border-top-left-radius: 4px;
            color: #e2e8f0;
        }

        .message.user .bubble {
            background: var(--user-msg);
            border-top-right-radius: 4px;
            color: #fff;
            box-shadow: 0 10px 25px -5px rgba(59, 130, 246, 0.4);
        }
        
        .bubble p {
            margin-bottom: 10px;
        }
        .bubble p:last-child {
            margin-bottom: 0;
        }

        .typing-indicator {
            display: none;
            gap: 6px;
            padding: 16px 20px;
            background: var(--ai-msg);
            border: 1px solid var(--glass-border);
            border-radius: 20px;
            border-top-left-radius: 4px;
            width: fit-content;
        }

        .typing-indicator span {
            width: 8px;
            height: 8px;
            background: var(--text-muted);
            border-radius: 50%;
            animation: bounce 1.4s infinite ease-in-out both;
        }

        .typing-indicator span:nth-child(1) { animation-delay: -0.32s; }
        .typing-indicator span:nth-child(2) { animation-delay: -0.16s; }

        @keyframes bounce {
            0%, 80%, 100% { transform: scale(0); }
            40% { transform: scale(1); }
        }

        .chat-input-area {
            padding: 24px 32px;
            border-top: 1px solid var(--glass-border);
            background: rgba(0,0,0,0.2);
        }

        .input-wrapper {
            display: flex;
            gap: 16px;
            position: relative;
        }

        .input-wrapper input {
            flex: 1;
            background: rgba(255,255,255,0.05);
            border: 1px solid var(--glass-border);
            border-radius: 16px;
            padding: 16px 24px;
            color: #fff;
            font-size: 15px;
            font-family: inherit;
            outline: none;
            transition: all 0.3s ease;
        }

        .input-wrapper input:focus {
            background: rgba(255,255,255,0.08);
            border-color: rgba(59, 130, 246, 0.5);
            box-shadow: 0 0 20px rgba(59, 130, 246, 0.1);
        }
        
        .input-wrapper input::placeholder {
            color: #64748b;
        }

        .send-btn {
            width: 52px;
            height: 52px;
            border-radius: 16px;
            background: var(--primary);
            border: none;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 8px 20px rgba(59, 130, 246, 0.3);
        }

        .send-btn:hover {
            background: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(59, 130, 246, 0.4);
        }
        
        .send-btn:active {
            transform: translateY(0);
        }

        .send-btn svg {
            width: 20px;
            height: 20px;
            fill: none;
            stroke: currentColor;
            stroke-width: 2;
            stroke-linecap: round;
            stroke-linejoin: round;
            transition: transform 0.3s ease;
        }

        .send-btn:hover svg {
            transform: translateX(2px) translateY(-2px);
        }

        .send-btn:disabled {
            background: #475569;
            cursor: not-allowed;
            box-shadow: none;
            transform: none;
        }
        
        /* Markdown minimal styling */
        .bubble strong { color: #fff; font-weight: 600; }
        .bubble em { font-style: italic; opacity: 0.9; }

    </style>
</head>
<body>

    <div class="bg-orb-1"></div>
    <div class="bg-orb-2"></div>

    <div class="chat-container">
        <div class="chat-header">
            <div class="header-icon">✨</div>
            <div class="header-info">
                <h1>IMT Discovery Assistant</h1>
                <p><span class="status-dot"></span> Online & Ready</p>
            </div>
        </div>

        <div class="chat-messages" id="chatBox">
            <!-- Initial Greeting -->
            <div class="message ai">
                <div class="avatar ai">✨</div>
                <div class="bubble">
                    <p>Halo! Saya adalah asisten cerdas IMT Discovery. Ada yang bisa saya bantu terkait laporan, asesmen, atau teori psikologi hari ini?</p>
                </div>
            </div>
            
            <div class="message ai" id="typingIndicator" style="display: none; opacity:1; transform:none;">
                <div class="avatar ai">✨</div>
                <div class="typing-indicator" style="display: flex;">
                    <span></span><span></span><span></span>
                </div>
            </div>
        </div>

        <div class="chat-input-area">
            <form id="chatForm" class="input-wrapper">
                <input type="text" id="messageInput" placeholder="Tanyakan sesuatu kepada AI..." autocomplete="off" required>
                <button type="submit" class="send-btn" id="sendBtn">
                    <svg viewBox="0 0 24 24"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>
                </button>
            </form>
        </div>
    </div>

    <script>
        const chatForm = document.getElementById('chatForm');
        const messageInput = document.getElementById('messageInput');
        const chatBox = document.getElementById('chatBox');
        const typingIndicator = document.getElementById('typingIndicator');
        const sendBtn = document.getElementById('sendBtn');
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // Simple markdown to HTML parser for basic formatting
        function parseMarkdown(text) {
            let html = text
                .replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>')
                .replace(/\*(.*?)\*/g, '<em>$1</em>')
                .replace(/\n/g, '<br>');
            return html;
        }

        function appendMessage(text, sender) {
            const msgDiv = document.createElement('div');
            msgDiv.className = `message ${sender}`;
            
            const avatar = document.createElement('div');
            avatar.className = `avatar ${sender}`;
            avatar.innerHTML = sender === 'user' ? '👤' : '✨';
            
            const bubble = document.createElement('div');
            bubble.className = 'bubble';
            bubble.innerHTML = sender === 'ai' ? parseMarkdown(text) : text;
            
            msgDiv.appendChild(avatar);
            msgDiv.appendChild(bubble);
            
            // Insert before typing indicator
            chatBox.insertBefore(msgDiv, typingIndicator);
            scrollToBottom();
        }

        function scrollToBottom() {
            chatBox.scrollTop = chatBox.scrollHeight;
        }

        chatForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            
            const message = messageInput.value.trim();
            if (!message) return;

            // UI Updates
            appendMessage(message, 'user');
            messageInput.value = '';
            messageInput.disabled = true;
            sendBtn.disabled = true;
            typingIndicator.style.display = 'flex';
            scrollToBottom();

            try {
                const response = await fetch('/chat/send', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ message })
                });

                const data = await response.json();
                
                typingIndicator.style.display = 'none';
                
                if (response.ok) {
                    appendMessage(data.reply, 'ai');
                } else {
                    appendMessage("⚠️ " + (data.error || "Gagal menghubungi server."), 'ai');
                }
            } catch (error) {
                typingIndicator.style.display = 'none';
                appendMessage("⚠️ Terjadi kesalahan jaringan.", 'ai');
            } finally {
                messageInput.disabled = false;
                sendBtn.disabled = false;
                messageInput.focus();
                scrollToBottom();
            }
        });
    </script>
</body>
</html>
<?php /**PATH C:\Users\CSO KUTA 2\Documents\web\IMT\resources\views/chat.blade.php ENDPATH**/ ?>