<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $lesson->name }} - Playlist</title>
    <link rel="icon" href="{{ asset('logo.svg') }}" type="image/svg+xml">

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <style>
        body {
            background-color: #06010d;
            min-height: 100vh;
            perspective: 1200px;
        }

     
        .lesson-card {
            background: rgba(15, 5, 29, 0.6);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 2px solid rgba(192, 132, 252, 0.15);
            transform-style: preserve-3d;
            transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        }

      
        .lesson-card:hover {
            border-color: #ff69b4;
            transform: translateY(-8px) rotateX(4deg) rotateY(-2deg);
            box-shadow: 0 15px 35px rgba(255, 105, 180, 0.25), 0 5px 15px rgba(192, 132, 252, 0.2);
        }

        .lesson-card:hover .lesson-title {
            color: #ff69b4;
            text-shadow: 0 0 10px rgba(255, 105, 180, 0.6);
            transform: translateZ(30px); 
        }
    </style>
</head>
<body class="p-6 md:p-12 text-white selection:bg-pink-500 selection:text-black">

    <div class="max-w-7xl mx-auto">
        
        <div class="mb-10 pb-4 border-b border-purple-950/60 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h1 class="text-3xl font-black tracking-wider text-transparent bg-clip-text bg-gradient-to-r from-pink-400 to-purple-400 uppercase">
                    {{ $lesson->name }}
                </h1>
                <p class="text-xs text-purple-400/70 font-mono mt-1">Course Curriculum & Video Lectures</p>
            </div>
            <div class="text-xs bg-purple-900/40 px-3 py-1.5 rounded-md border border-purple-500/20 text-purple-300 font-mono self-start md:self-auto">
                🎬 Total: {{ count($lesson->lessons) }} Lectures
            </div>
        </div>

        <main class="flex flex-wrap justify-center lg:justify-start gap-8 w-full">
            @foreach($lesson->lessons as $l)
                <div class="lesson-card w-full sm:w-[420px] rounded-2xl p-4 flex flex-col gap-4">
                    
                    <div class="relative overflow-hidden rounded-xl bg-black/50 aspect-video border border-purple-950/40 shadow-inner">
                        <video controls 
       controlsList="nodownload" 
       oncontextmenu="return false;"
       poster="{{ asset('storage/'.$l->image) }}" 
       class="w-full h-full object-cover rounded-xl focus:outline-none">
    <source src="{{ asset('storage/'.$l->video) }}">
    Your browser does not support the video tag.
      </video>
                    </div>

                    <div class="flex items-start space-x-3 mt-1 px-1">
                        <div class="w-2.5 h-2.5 rounded-full bg-gradient-to-r from-pink-500 to-purple-500 mt-1.5 shrink-0 animate-pulse"></div>
                        <p class="lesson-title font-mono text-sm font-bold text-purple-200 transition-all duration-300 tracking-wide leading-relaxed">
                            {{ $l->name }}
                        </p>
                    </div>

                </div>
            @endforeach
            
        </main>

    </div>

</body>
</html>