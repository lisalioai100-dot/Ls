<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ls Web Frontend IDE</title>
    <link rel="icon" href="{{ asset('logo.svg') }}" type="image/svg+xml">
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #06010d;
            min-height: 100vh;
            font-family: 'Courier New', Courier, monospace;
            overflow: hidden;
        }
        
        /* تأثير مصفوفة الأرقام الثنائية ثلاثية الأبعاد في الخلفية */
        .binary-3d-bg {
            position: fixed;
            top: 0; left: 0; width: 100vw; height: 100vh;
            z-index: -2;
            overflow: hidden;
            opacity: 0.15;
            perspective: 1000px;
            display: flex;
            justify-content: space-around;
            pointer-events: none;
        }
        .binary-column {
            display: flex; flex-direction: column; white-space: nowrap; font-weight: 900;
            animation: binaryMoveUpDown 12s ease-in-out infinite alternate;
        }
        .binary-column:nth-child(odd) { color: #ff69b4; text-shadow: 0 0 10px #ff69b4; animation-duration: 8s; transform: translateZ(-100px); }
        .binary-column:nth-child(even) { color: #c084fc; text-shadow: 0 0 10px #c084fc; animation-duration: 14s; transform: translateZ(-150px); }
        
        @keyframes binaryMoveUpDown {
            0% { transform: translateY(-10%) rotateX(0deg); }
            100% { transform: translateY(15%) rotateX(5deg); }
        }

        /* تنسيقات النيون والزجاج للمحرر (Glassmorphism) */
        .ide-container {
            background: rgba(15, 5, 29, 0.75);
            backdrop-filter: blur(12px);
            border: 2px solid #ff69b4;
            box-shadow: 0 0 25px rgba(218, 112, 214, 0.25);
        }
        .neon-text-pink { color: #ff69b4; text-shadow: 0 0 8px rgba(255, 105, 180, 0.6); }
        .neon-btn {
            background: linear-gradient(135deg, #ff69b4 0%, #c084fc 100%);
            transition: all 0.3s ease;
        }
        .neon-btn:hover { transform: scale(1.03); box-shadow: 0 0 15px #ff69b4; }
        
        /* ضبط ساحات كتابة الأكواد */
        .editor-box {
            direction: ltr;
            text-align: left;
            outline: none;
            caret-color: #ff69b4;
            color: #c084fc;
            background: rgba(0, 0, 0, 0.4);
        }
        
        /* شاشة العرض (Iframe Sandbox) */
        .preview-screen {
            background: #ffffff;
            border-radius: 8px;
            box-shadow: inset 0 0 20px rgba(0,0,0,0.2);
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="p-6 flex flex-col justify-between h-screen text-white">

    <div class="binary-3d-bg">
        <div class="binary-column">1010101100110101010011</div>
        <div class="binary-column">0110100101101101001011</div>
        <div class="binary-column">1100110010101100110010</div>
        <div class="binary-column">0011001101010011001101</div>
        <div class="binary-column">1010101010111010101010</div>
        <div class="binary-column">0101011001000101011001</div>
    </div>

    <div class="w-full flex justify-between items-center mb-4 pb-2 border-b border-purple-900/50">
        <div class="flex items-center space-x-3">
            <span class="text-2xl font-black neon-text-pink tracking-wider">Ls Web IDE v1.0</span>
            <span class="text-xs bg-purple-900/60 px-2 py-1 rounded text-purple-300 border border-purple-500/30">Frontend Environment</span>
        </div>
        <button onclick="runFrontendCode()" class="neon-btn text-black font-bold px-6 py-1.5 rounded-md flex items-center space-x-2 cursor-pointer text-sm">
            <span>⚡ Render Code</span>
        </button>
    </div>

    <div class="w-full flex-1 flex flex-col lg:flex-row gap-4 mb-4 overflow-hidden">
        
        <div class="w-full lg:w-1/2 flex flex-col gap-3 h-full">
            <img src="{{ asset('image/html.png') }}" width="40" height="40">
            <div class="ide-container flex-1 rounded-xl flex flex-col overflow-hidden">
                
                <div class="bg-black/40 px-3 py-1.5 text-xs font-bold text-pink-400 border-b border-purple-900/40">HTML5</div>
                <div id="htmlEditor" class="editor-box flex-1 p-3 font-mono text-xs overflow-y-auto whitespace-pre-wrap leading-5" contenteditable="true" spellcheck="false">&lt;div class="welcome-box"&gt;
  &lt;h1&gt;Welcome to Ls Academy!&lt;/h1&gt;
  &lt;p&gt;Start learning Web Front-End here.&lt;/p&gt;
  &lt;button id="magicBtn"&gt;Click Me!&lt;/button&gt;
&lt;/div&gt;</div>
            </div>
        <img src="{{ asset('image/css.png') }}" width="40" height="40">
            <div class="ide-container flex-1 rounded-xl flex flex-col overflow-hidden">

                <div class="bg-black/40 px-3 py-1.5 text-xs font-bold text-purple-400 border-b border-purple-900/40">CSS3 Standard</div>
                <div id="cssEditor" class="editor-box flex-1 p-3 font-mono text-xs overflow-y-auto whitespace-pre-wrap leading-5" contenteditable="true" spellcheck="false">body {
  background: #0f051d;
  color: white;
  font-family: sans-serif;
  display: flex; justify-content: center; align-items: center;
  height: 80vh; margin: 0;
}
.welcome-box {
  text-align: center; padding: 20px;
  border: 2px solid #ff69b4; border-radius: 12px;
  box-shadow: 0 0 15px rgba(255, 105, 180, 0.3);
}
button {
  background: #ff69b4; color: white; border: none;
  padding: 8px 16px; border-radius: 6px; cursor: pointer;
}</div>
            </div>
             <img src="{{ asset('image/js.png') }}" width="40" height="40">
            <div class="ide-container flex-1 rounded-xl flex flex-col overflow-hidden">
                <div class="bg-black/40 px-3 py-1.5 text-xs font-bold text-blue-400 border-b border-purple-900/40">JavaScript (ES6)</div>
                <div id="jsEditor" class="editor-box flex-1 p-3 font-mono text-xs overflow-y-auto whitespace-pre-wrap leading-5" contenteditable="true" spellcheck="false">document.getElementById('magicBtn').addEventListener('click', () => {
  alert('✨ Success! Frontend Code runs perfectly inside Ls Platform.');
});</div>
            </div>

        </div>

        <div class="w-full lg:w-1/2 h-full ide-container rounded-xl p-3 flex flex-col">
            <div class="text-xs text-purple-300 font-bold mb-2 flex items-center space-x-2">
                <span class="w-2.5 h-2.5 rounded-full bg-green-500 animate-pulse"></span>
                <span>LIVE PREVIEW SCREEN</span>
            </div>
            <iframe id="livePreview" class="preview-screen w-full flex-1 border-none" sandbox="allow-scripts"></iframe>
        </div>

    </div>

    <div class="w-full text-center text-xs text-purple-400/60 font-mono pt-2 border-t border-purple-900/30">
        Ls Front-End Core Simulator &bull; Compiled Successfully
    </div>
    <script>
function getCode(id) {
    const el = document.getElementById(id);
    return el ? el.textContent : '';
}

function runFrontendCode() {
    const htmlCode = getCode('htmlEditor');
    const cssCode = getCode('cssEditor');
    const jsCode = getCode('jsEditor');

    const iframe = document.getElementById('livePreview');

    const srcDoc = `
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<style>
${cssCode}
</style>
</head>
<body>

${htmlCode}

<script>
window.addEventListener('load', () => {
    try {
        ${jsCode.replace(/<\/script>/gi, '<\\/script>')}
    } catch(err) {
        document.body.innerHTML +=
        '<pre style="color:red;padding:10px;">JS Error: ' +
        err.message +
        '</pre>';
    }
});
<\/script>

</body>
</html>
`;

    iframe.srcdoc = srcDoc;
}

window.addEventListener('DOMContentLoaded', () => {
    runFrontendCode();

    document.getElementById('htmlEditor')
        .addEventListener('input', runFrontendCode);

    document.getElementById('cssEditor')
        .addEventListener('input', runFrontendCode);

    document.getElementById('jsEditor')
        .addEventListener('input', runFrontendCode);
});
</script>
</body>
</html>