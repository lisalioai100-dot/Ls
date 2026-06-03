<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ls Academy - News & Updates</title>
    <script src="https://cdn.tailwindcss.com"></script>
   <link rel="icon" href="{{ asset('logo.svg') }}" type="image/svg+xml">

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: linear-gradient(135deg, #0f0c20 0%, #15102a 100%);
        }
        .card-3d {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.08);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3),
                        inset 0 1px 2px rgba(255, 255, 255, 0.1);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        .card-3d:hover {
            transform: translateY(-10px) scale(1.01);
            box-shadow: 0 30px 60px rgba(219, 39, 119, 0.15), 
                        0 0 40px rgba(124, 58, 237, 0.1),
                        inset 0 1px 3px rgba(255, 255, 255, 0.2);
            border-color: rgba(219, 39, 119, 0.4);
        }
    </style>
</head>
<body class="text-gray-100 min-h-screen antialiased selection:bg-pink-500 selection:text-white">

    <div class="fixed top-0 left-1/4 w-96 h-96 bg-purple-600/10 rounded-full blur-[120px] pointer-events-none"></div>
    <div class="fixed bottom-0 right-1/4 w-96 h-96 bg-pink-600/10 rounded-full blur-[120px] pointer-events-none"></div>

    <div class="max-w-4xl mx-auto px-4 py-12 relative z-10">
        
        <header class="mb-16 text-center">
            <h1 class="text-4xl font-extrabold tracking-tight bg-gradient-to-r from-pink-400 via-purple-400 to-indigo-400 bg-clip-text text-transparent">
                Ls Academy News
            </h1>
            <p class="text-gray-400 mt-2 text-sm font-medium tracking-wide">LATEST ACADEMY UPDATES & ANNOUNCEMENTS</p>
            <div class="w-12 h-1 bg-gradient-to-r from-pink-500 to-purple-500 mx-auto mt-4 rounded-full"></div>
        </header>

        <div class="space-y-12">
            @forelse($info as $item)
                <article class="card-3d rounded-2xl p-6 md:p-8 flex flex-col gap-6">
                    
                    @if($item->article)
                        <p class="text-gray-200 text-lg leading-relaxed font-medium">
                            {{ $item->article }}
                        </p>
                    @endif

                    @if($item->image || $item->video)
                        <div class="relative rounded-xl overflow-hidden shadow-inner bg-black/20 border border-white/5 group">
                            
                            @if($item->image)
                                <img src="{{ asset('storage/'.$item->image) }}" 
                                     alt="News Image" 
                                     class="w-full h-auto max-h-[450px] object-cover transition-transform duration-700 group-hover:scale-105">
                            @endif


                            @if($item->video)
                                <div class="w-full aspect-video bg-black/40">
                                    <video class="w-full h-full object-cover" controls preload="metadata" controlsList="nodownload" oncontextmenu="return false;">
                                        <source src="{{ asset('storage/'.$item->video) }}" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                </div>
                            @endif
                            
                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent opacity-60 pointer-events-none"></div>
                        </div>
                    @endif

                    <div class="flex items-center justify-between pt-4 border-t border-white/5 text-xs text-gray-400 font-medium">
                        <span class="flex items-center gap-1.5 text-pink-400/90">
                            <span class="w-2 h-2 rounded-full bg-pink-500 animate-pulse"></span> Published
                        </span>
                        <span>{{ $item->created_at?->diffForHumans() ?? 'Just now' }}</span>
                    </div>

                </article>
            @empty
                <div class="card-3d rounded-2xl p-12 text-center text-gray-400">
                    <p class="text-lg">No news published yet.</p>
                    <p class="text-sm text-gray-500 mt-1">Check back later for new updates from the Academy.</p>
                </div>
            @endforelse
        </div>
    </div>

</body>
</html>