<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ls - Registration</title>
    <link rel="icon" href="{{ asset('logo.svg') }}" type="image/svg+xml">

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <style>
        body {
            background-color: #06010d;
            overflow-x: hidden;
            perspective: 1000px;
        }

      
        .glass-form {
            background: rgba(15, 5, 29, 0.65);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 2px solid rgba(255, 105, 180, 0.2);
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5);
            transition: all 0.4s ease;
        }
     
        .glass-form:hover {
            border-color: #ff69b4;
            box-shadow: 0 0 30px rgba(255, 105, 180, 0.25), 0 0 60px rgba(192, 132, 252, 0.15);
        }

       
        .cyber-input {
            background: rgba(0, 0, 0, 0.4);
            border: 1px solid rgba(192, 132, 252, 0.3);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .cyber-input:focus, .cyber-input:hover {
            border-color: #c084fc;
            box-shadow: 0 0 15px rgba(192, 132, 252, 0.4);
            transform: translateY(-2px);
        }

    
        .neon-btn {
            background: linear-gradient(135deg, #ff69b4 0%, #c084fc 100%);
            transition: all 0.3s ease;
            box-shadow: 0 0 10px rgba(255, 105, 180, 0.3);
        }
        .neon-btn:hover {
            transform: translateY(-3px) scale(1.02);
            box-shadow: 0 0 20px #ff69b4, 0 0 35px #c084fc;
        }

      
        @keyframes floatUpAndDown {
            0% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-10px) rotate(3deg); }
            100% { transform: translateY(0px) rotate(0deg); }
        }

    
        .scattered-tech-img {
            position: absolute;
            width: 65px;
            height: 65px;
            object-fit: contain;
            opacity: 0.5;
            filter: grayscale(30%) drop-shadow(0 0 5px rgba(0,0,0,0.5));
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            pointer-events: auto;
            z-index: 1;
        }

       
        .scattered-tech-img:hover {
            opacity: 1;
            filter: grayscale(0%) drop-shadow(0 0 20px #ff69b4);
            transform: scale(1.3) translateZ(50px) rotate(8deg);
            z-index: 50;
            cursor: pointer;
        }

    
        .img-1 { top: 10%; left: 8%; animation: floatUpAndDown 6s ease-in-out infinite; }
        .img-2 { top: 15%; right: 12%; animation: floatUpAndDown 7s ease-in-out infinite 1s; }
        .img-3 { top: 40%; left: 5%; animation: floatUpAndDown 5s ease-in-out infinite 0.5s; }
        .img-4 { top: 45%; right: 6%; animation: floatUpAndDown 8s ease-in-out infinite 2s; }
        .img-5 { bottom: 12%; left: 10%; animation: floatUpAndDown 6.5s ease-in-out infinite 1.5s; }
        .img-6 { bottom: 15%; right: 14%; animation: floatUpAndDown 7.5s ease-in-out infinite 0.3s; }
        .img-7 { top: 28%; left: 22%; animation: floatUpAndDown 5.5s ease-in-out infinite 2.5s; }
        .img-8 { top: 25%; right: 25%; animation: floatUpAndDown 9s ease-in-out infinite 1s; }
        .img-9 { bottom: 30%; left: 20%; animation: floatUpAndDown 6s ease-in-out infinite 0.8s; }
        .img-10 { bottom: 28%; right: 22%; animation: floatUpAndDown 7s ease-in-out infinite 1.2s; }
        .img-11 { top: 5%; left: 45%; animation: floatUpAndDown 8.5s ease-in-out infinite 1.7s; }
        .img-12 { bottom: 5%; right: 48%; animation: floatUpAndDown 6.8s ease-in-out infinite 2.2s; }
    </style>
</head>
<body class="min-height-screen flex items-center justify-center text-white relative p-4 selection:bg-pink-500 selection:text-black">
    @if(session('setRegister'))
        <script>{{session('setRegister')}}</script>
    @endif

    @if(session('error'))

        <script>{{session('error')}}</script>
   
    @endif
    <div class="absolute inset-0 w-full h-full pointer-events-none overflow-hidden container">
        <img src="{{asset('image/linux.png')}}" alt="Linux" class="scattered-tech-img img-1" title="Linux">
        <img src="{{asset('image/php.png')}}" alt="PHP" class="scattered-tech-img img-2" title="PHP">
        <img src="{{asset('image/docker.png')}}" alt="Docker" class="scattered-tech-img img-3" title="Docker">
        <img src="{{asset('image/mysql.png')}}" alt="MySQL" class="scattered-tech-img img-4" title="MySQL">
        <img src="{{asset('image/js.png')}}" alt="JS" class="scattered-tech-img img-5" title="JS">
        <img src="{{asset('image/python.png')}}" alt="Python" class="scattered-tech-img img-6" title="Python">
        <img src="{{asset('image/tensorflow.png')}}" alt="TensorFlow" class="scattered-tech-img img-7" title="TensorFlow">
        <img src="{{asset('image/c.png')}}" alt="C++" class="scattered-tech-img img-8" title="C++">
        <img src="{{asset('image/flutter.png')}}" alt="Flutter" class="scattered-tech-img img-9" title="Flutter">
        <img src="{{asset('image/react.png')}}" alt="React" class="scattered-tech-img img-10" title="React">
        <img src="{{asset('image/css.png')}}" alt="CSS" class="scattered-tech-img img-11" title="CSS">
        <img src="{{asset('image/html.png')}}" alt="HTML" class="scattered-tech-img img-12" title="HTML">
    </div>

    <main class="w-full max-w-md z-10 my-auto">
        <div class="glass-form rounded-2xl p-8 flex flex-col items-center">
            
            <div class="text-center mb-8">
                <h1 class="text-3xl font-black tracking-wider text-transparent bg-clip-text bg-gradient-to-r from-pink-400 to-purple-400 mb-2">
                    CREATE ACCOUNT
                </h1>
                <p class="text-xs text-purple-300/60 font-mono">Join Ls Academy Code Universe</p>
            </div>

            <form action="{{route('student.setRegister')}}" method="POST" class="w-full flex flex-col space-y-5">
                @csrf 
                @method('POST')
                
                <div class="flex flex-col space-y-1">
                    <label class="text-xs font-bold text-pink-400 tracking-wide ml-1 font-mono">FULL NAME</label>
                    <input type='text' 
                           name='name' 
                           placeholder='Type your name' 
                           required 
                           class="cyber-input w-full px-4 py-3 rounded-xl text-sm text-purple-200 placeholder-purple-400/40 outline-none">
                </div>

                <div class="flex flex-col space-y-1">
                    <label class="text-xs font-bold text-purple-400 tracking-wide ml-1 font-mono">EMAIL ADDRESS</label>
                    <input type='email' 
                           name='email' 
                           placeholder='Type your email' 
                           required
                           class="cyber-input w-full px-4 py-3 rounded-xl text-sm text-purple-200 placeholder-purple-400/40 outline-none">
                </div>

                <button type="submit" class="neon-btn w-full text-black font-black uppercase text-sm tracking-widest py-3.5 rounded-xl cursor-pointer mt-4">
                    Register Now
                </button>
            </form>

        </div>
    </main>

</body>
</html>