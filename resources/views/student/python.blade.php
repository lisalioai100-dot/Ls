<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ls Python IDE </title>
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
        body::before {
            content: "";
            position: fixed;
            top: 0; left: 0; width: 100vw; height: 100vh;
            background-image: url("{{ asset('image/Planet.png') }}");
            background-repeat: no-repeat;
            background-position: center center;
            background-size: contain;
            z-index: -2;
            opacity: 0.35; 
            filter: hue-rotate(115deg) saturate(220%) brightness(50%) contrast(100%);
        }
        
        .ide-container {
            background: rgba(15, 5, 29, 0.75);
            backdrop-filter: blur(12px);
            border: 2px solid #ff69b4;
            box-shadow: 0 0 25px rgba(218, 112, 214, 0.3);
        }
        .neon-text-pink { color: #ff69b4; text-shadow: 0 0 8px rgba(255, 105, 180, 0.6); }
        .neon-btn {
            background: linear-gradient(135deg, #ff69b4 0%, #c084fc 100%);
            transition: all 0.3s ease;
        }
        .neon-btn:hover {
            transform: scale(1.05);
            box-shadow: 0 0 15px #ff69b4;
        }
        .editor-area {
            direction: ltr; 
            text-align: left;
            outline: none;
            caret-color: #ff69b4; 
            color: #c084fc; 
        }
        .line-numbers {
            color: #ff69b4;
            opacity: 0.5;
            text-align: right;
            user-select: none;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="p-6 flex flex-col justify-between h-screen">

    <div class="w-full flex justify-between items-center mb-4 pb-2 border-b border-purple-900/50">
        <div class="flex items-center space-x-3">
            <img src="{{ asset('image/python.png')}}" alt="python" width="40" height="40">
            <span class="text-2xl font-black neon-text-pink tracking-wider">Ls IDE v1.0</span>
            
            <span class="text-xs bg-purple-900/60 px-2 py-1 rounded text-purple-300 border border-purple-500/30">main.py</span>
        </div>
        <button onclick="runPythonCode()" class="neon-btn text-black font-bold px-5 py-1.5 rounded-md flex items-center space-x-2 cursor-pointer text-sm">
            <span>▶ Run Code</span>
        </button>
    </div>

    <div class="ide-container w-full flex-1 rounded-xl flex overflow-hidden mb-4">
        
        <div id="lineNumbers" class="line-numbers w-12 py-4 pr-3 bg-black/30 font-mono text-sm leading-6 flex flex-col">
            <div>1</div>
        </div>

        <div id="codeEditor" 
             class="editor-area flex-1 py-4 px-3 font-mono text-sm leading-6 overflow-y-auto whitespace-pre-wrap" 
             contenteditable="true" 
             spellcheck="false"
             oninput="updateLineNumbers()">print("Hello, Welcome to Ls Space Platform!")
# Write your python code here...
x = 5
y = 10
print("Result of x + y is:", x + y)</div>
    </div>

    <div class="w-full h-48 bg-black/80 rounded-xl border border-purple-500/30 flex flex-col overflow-hidden">
        <div class="bg-purple-950/40 px-4 py-2 text-xs text-purple-300 border-b border-purple-900/30 flex justify-between">
            <span>💻 TERMINAL / OUTPUT</span>
            <span class="cursor-pointer hover:text-white" onclick="clearTerminal()">Clear</span>
        </div>
        <div id="terminalOutput" class="flex-1 p-4 font-mono text-xs text-pink-300 overflow-y-auto whitespace-pre-line leading-5">
            Press "Run Code" to see the execution output here...
        </div>
    </div>
      <script>
    function updateLineNumbers() {
        const editor = document.getElementById('codeEditor');
        const lineNumContainer = document.getElementById('lineNumbers');
        const lines = editor.innerText.split('\n');
        let lineCount = lines.length;
        if (lines[lines.length - 1] === '') { lineCount--; }
        
        lineNumContainer.innerHTML = '';
        for (let i = 1; i <= Math.max(1, lineCount); i++) {
            const div = document.createElement('div');
            div.innerText = i;
            lineNumContainer.appendChild(div);
        }
    }

    function runPythonCode() {
        const code = document.getElementById('codeEditor').innerText;
        const terminal = document.getElementById('terminalOutput');
        terminal.innerHTML = "<span class='text-purple-400'>Executing main.py...</span>\n";

        setTimeout(() => {
            try {
                let output = [];
                const lines = code.split('\n');
                let variables = {};

                for (let line of lines) {
                    let trimmed = line.trim();
                    if (!trimmed || trimmed.startsWith('#')) continue;

                    if (trimmed.includes('input(')) {
                        let [partsLeft, partsRight] = trimmed.split('=');
                        let varName = partsLeft.trim();
                        
                        let match = partsRight.match(/input\((['"])(.*?)\1\)/);
                        let promptMessage = match ? match[2] : "Please enter a value:";
                        
                        let userInput = prompt(promptMessage);
                        
                        variables[varName] = isNaN(userInput) ? userInput : Number(userInput);
                        continue;
                    }

                    if (trimmed.includes('=') && !trimmed.includes('input(')) {
                        let [partsLeft, partsRight] = trimmed.split('=');
                        let varName = partsLeft.trim();
                        let varVal = partsRight.trim();
                        try {
                            variables[varName] = eval(varVal.replace(/([a-zA-Z_]\w*)/g, match => variables[match] !== undefined ? variables[match] : match));
                        } catch(e) {}
                    }

                    if (trimmed.startsWith('print(') && trimmed.endsWith(')')) {
                        let content = trimmed.substring(6, trimmed.length - 1);
                        let evaluatedContent = content.split(',').map(part => {
                            part = part.trim();
                            if ((part.startsWith('"') && part.endsWith('"')) || (part.startsWith("'") && part.endsWith("'"))) {
                                return part.slice(1, -1);
                            }
                            return variables[part] !== undefined ? variables[part] : eval(part.replace(/([a-zA-Z_]\w*)/g, match => variables[match] !== undefined ? variables[match] : match));
                        }).join(' ');

                        output.push(evaluatedContent);
                    }
                }

                if(output.length > 0) {
                    terminal.innerText = output.join('\n');
                } else {
                    terminal.innerHTML = "<span class='text-purple-400'>Process finished with exit code 0.</span>";
                }

            } catch (err) {
                terminal.innerHTML = `<span class='text-red-500 font-bold'>💥 Python Error:</span> \n<span class='text-red-400'>${err.message}</span>`;
            }
        }, 400);
    }

    function clearTerminal() {
        document.getElementById('terminalOutput').innerText = 'Terminal cleared. Waiting for execution...';
    }

    updateLineNumbers();
</script>
</body>
</html>
