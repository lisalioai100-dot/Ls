<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ls C++ IDE </title>
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
        
        /* ضبط ساحة كتابة الأكواد والترمينال */
        .editor-box {
            direction: ltr;
            text-align: left;
            outline: none;
            caret-color: #ff69b4;
            color: #c084fc;
            background: rgba(0, 0, 0, 0.4);
        }
        .terminal-box {
            background: #090214;
            border-top: 2px solid #3b0764;
            box-shadow: inset 0 0 20px rgba(0,0,0,0.6);
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
        <img src="{{asset('image/c.png')}}">
        <div class="flex items-center space-x-3">
            <span class="text-2xl font-black neon-text-pink tracking-wider">Ls C++ IDE v1.0</span>
            <span class="text-xs bg-purple-900/60 px-2 py-1 rounded text-purple-300 border border-purple-500/30">Native Simulator</span>
        </div>
        <button onclick="runCPPCode()" class="neon-btn text-black font-bold px-6 py-1.5 rounded-md flex items-center space-x-2 cursor-pointer text-sm">
            <span>▶ Run Code</span>
        </button>
    </div>

    <div class="w-full flex-1 flex flex-col gap-4 mb-4 overflow-hidden">
        
        <div class="ide-container flex-[2] rounded-xl flex flex-col overflow-hidden">
            <div class="bg-black/40 px-3 py-1.5 text-xs font-bold text-pink-400 border-b border-purple-900/40 flex justify-between items-center">
                <span>main.cpp</span>
                <span class="text-[10px] text-purple-400/70">ISO C++17</span>
            </div>
            <div id="cppEditor" class="editor-box flex-1 p-4 font-mono text-xs overflow-y-auto whitespace-pre leading-5" contenteditable="true" spellcheck="false">#include &lt;iostream&gt;
using namespace std;

int main() {
    cout << "Welcome to Ls C++ Academy!" << endl;
    
    int age = 16;
    cout << "Student Age: " << age << endl;
    
    return 0;
}</div>
        </div>

        <div class="ide-container flex-1 rounded-xl flex flex-col overflow-hidden">
            <div class="bg-black/40 px-3 py-1.5 text-xs font-bold text-purple-400 border-b border-purple-900/40 flex justify-between items-center">
                <span>Console Output</span>
                <button onclick="clearTerminal()" class="text-[10px] hover:text-pink-400 transition-colors">Clear</button>
            </div>
            <div id="terminalOutput" class="terminal-box flex-1 p-4 font-mono text-xs overflow-y-auto text-green-400 leading-5 whitespace-pre-wrap">Terminal ready. Press Run to compile...</div>
        </div>

    </div>

    <div class="w-full text-center text-xs text-purple-400/60 font-mono pt-2 border-t border-purple-900/30">
        Ls C++ Core Simulator &bull; Environment Isolated
    </div>

    <script>

let globalVariables = {};

    function runCPPCode() {
        const code = document.getElementById('cppEditor').innerText;
        const terminal = document.getElementById('terminalOutput');
        
        terminal.innerHTML = "<span class='text-purple-400'>g++ main.cpp -o main...</span>\n<span class='text-purple-300'>Executing ./main...</span>\n\n";
        
        globalVariables = {}; 
        const lines = code.split('\n');
       
        if (!code.includes('main()')) {
            terminal.innerHTML += `<span class='text-red-500 font-bold'>💥 Compilation Error:</span> \n<span class='text-red-400'>Required 'main()' function is missing.</span>`;
            return;
        }

        
        executeLine(lines, 0, terminal);
    }

    async function executeLine(lines, index, terminal) {
        if (index >= lines.length) {
            terminal.innerHTML += "\n\n<span class='text-green-500'>--------------------------------\nProcess finished with exit code 0</span>";
            return;
        }

        let trimmed = lines[index].trim();

        if (!trimmed || trimmed.startsWith('#') || trimmed.startsWith('using') || trimmed === '{' || trimmed === '}' || trimmed.startsWith('return')) {
            executeLine(lines, index + 1, terminal);
            return;
        }

        try {
            if (trimmed.startsWith('int ') || trimmed.startsWith('double ') || trimmed.startsWith('float ')) {
                let cleanLine = trimmed.replace(/^(int|double|float)\s+/, '').replace(';', '');
                if (cleanLine.includes('=')) {
                    let [varName, varVal] = cleanLine.split('=');
                    globalVariables[varName.trim()] = Number(varVal.trim());
                } else {
                    globalVariables[cleanLine.trim()] = 0; 
                }
                executeLine(lines, index + 1, terminal);
                return;
            }

            
            if (trimmed.startsWith('cin')) {
                if (!trimmed.endsWith(';')) throw new Error(`Expected ';' at line ${index + 1}`);
                
            
                let varName = trimmed.replace('cin', '').replace(';', '').replace('>>', '').trim();
                
             
                terminal.innerHTML += `<span class='text-yellow-400 font-bold'>Enter value for ${varName}: </span>`;
                
                
                let inputElem = document.createElement('input');
                inputElem.type = 'text';
                inputElem.className = 'bg-transparent border-b border-pink-500 outline-none text-pink-400 font-mono text-xs w-20 ml-2';
                terminal.appendChild(inputElem);
                inputElem.focus();

               
                await new Promise((resolve) => {
                    inputElem.addEventListener('keydown', function(e) {
                        if (e.key === 'Enter') {
                            globalVariables[varName] = isNaN(inputElem.value) ? inputElem.value : Number(inputElem.value);
                           
                            terminal.innerHTML += inputElem.value + '\n';
                            resolve();
                        }
                    });
                });

               
                executeLine(lines, index + 1, terminal);
                return;
            }

           
            if (trimmed.startsWith('cout')) {
                if (!trimmed.endsWith(';')) throw new Error(`Expected ';' at line ${index + 1}`);
                
                let parts = trimmed.replace(';', '').split('<<');
                parts.shift(); 
                
                let lineOutput = '';
                for (let part of parts) {
                    part = part.trim();
                    if (part === 'endl') {
                        lineOutput += '\n';
                        continue;
                    }
                    
                    if (part.startsWith('"') && part.endsWith('"')) {
                        lineOutput += part.slice(1, -1);
                    } else {
                        if (globalVariables[part] !== undefined) {
                            lineOutput += globalVariables[part];
                        } else {
                            try { lineOutput += eval(part); } catch(e) { lineOutput += part; }
                        }
                    }
                }
                terminal.innerText += lineOutput;
                executeLine(lines, index + 1, terminal);
                return;
            }

            executeLine(lines, index + 1, terminal);

        } catch (err) {
            terminal.innerHTML += `\n<span class='text-red-500 font-bold'>💥 Runtime Error:</span> \n<span class='text-red-400'>${err.message}</span>`;
        }
    }

    function clearTerminal() {
        document.getElementById('terminalOutput').innerText = 'Terminal cleared. Waiting for execution...';
    }
</script>
</body>
</html>