<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ls free Acadimi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
    <link rel="icon" href="{{ asset('logo.svg') }}" type="image/svg+xml">
    <style>
 

              body {
    margin: 0;
    padding: 0;
    background-color: #24042a; 
    min-height: 100vh;
    position: relative;
    color: #ffffff; 
}


body::before {
    content: "";
    position: fixed;
    top: 0;
    left: 0;
    width: 100vw;
    height: 100vh;
    
   
    background-image: url("{{ asset('image/_ (1).jpeg') }}");
    background-repeat: no-repeat;
    background-position: center center;
    background-size: contain; 
    
    z-index: -1; 
    opacity: 0.85; 
    
    filter: hue-rotate(110deg) saturate(100%) brightness(80%) contrast(105%) drop-shadow(0 0 70px rgba(98, 1, 140, 0.4));
}

        #nebula-canvas {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            pointer-events: none;
        }
        ::selection{
            background: #f13090;
            color:white;
        }

        .nav-3d {
            background: rgba(20, 10, 35, 0.65);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 
                0 4px 30px rgba(0, 0, 0, 0.4),
                inset 0 1px 3px rgba(255, 255, 255, 0.2),
                inset 0 -2px 5px rgba(0, 0, 0, 0.5);
            transform: perspective(800px) rotateX(-2deg);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .nav-item-3d {
            position: relative;
            transition: transform 0.3s ease, color 0.3s ease;
        }

        .nav-item-3d:hover {
            color: #ff69b4;
            transform: translateY(-3px) scale(1.05);
            text-shadow: 0 0 10px rgba(255, 105, 180, 0.8), 0 0 20px rgba(255, 105, 180, 0.4);
        }

       
        header:hover .nav-3d {
            box-shadow: 
                0 15px 35px rgba(255, 105, 180, 0.25),
                0 5px 15px rgba(255, 105, 180, 0.15),
                inset 0 1px 3px rgba(255, 255, 255, 0.3);
            border-color: rgba(255, 105, 180, 0.4);
            transform: perspective(800px) rotateX(0deg) translateY(2px);
        }

        .glass-card {
            background: rgba(25, 10, 40, 0.45);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 105, 180, 0.2);
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.37);
            transition: all 0.3s ease;
        }

        .glass-card:hover {
            border-color: rgba(255, 105, 180, 0.8);
            box-shadow: 0 0 25px rgba(255, 105, 180, 0.4);
            transform: translateY(-5px);
        }
    </style>
</head>
<body class="text-white flex flex-col min-h-screen">


    <canvas id="nebula-canvas"></canvas>

    <header class="w-full pt-6 px-4 z-10">
        <div class="max-w-4xl mx-auto nav-3d rounded-2xl px-6 py-4 flex flex-col md:flex-row items-center justify-between gap-4">
            <div class="text-xl font-bold tracking-wider text-transparent bg-clip-text bg-gradient-to-r from-pink-400 to-purple-400">
               Ls free Acadimi
            </div>
            
            <nav class="flex flex-wrap justify-center gap-6 md:gap-8 text-sm font-medium tracking-wide">
                <a href="{{route('student.info')}}" class="nav-item-3d"  target="_blank" rel="noopener noreferrer">news</a>
                <a href="{{ route('student.python') }}" target="_blank" rel="noopener noreferrer" class="nav-item-3d">python text editor</a>
                <a href="{{ route('student.frontIde') }}" target="_blank" rel="noopener noreferrer" class="nav-item-3d">web front end editor</a>
             <a href="{{ route('student.c') }}" target="_blank" rel="noopener noreferrer" class="nav-item-3d">c++ editor</a>

                <a href="#support" class="nav-item-3d">support</a>
            </nav>
            
        </div>
      <x-application-logo width="150" height="100" class="mx-auto mt-12 mb-6" title="Ls free Acadimi"/>

    </header>
     <main class="flex-grow flex flex-col items-center justify-center px-4 py-12 text-center z-10 w-full">
    <h1 class="text-2xl md:text-3xl font-black tracking-wider text-transparent bg-clip-text bg-gradient-to-r from-pink-400 to-purple-400 uppercase mb-4">
       Welcome all to Ls free Acadimi
    </h1>
    <p class="text-gray-400 max-w-xl mb-12 text-xs md:text-sm leading-relaxed">
        A comprehensive programming environment for teaching students frontend interfaces and the Python programming language with a modern engineering perspective.
    </p>

    <div class="w-full max-w-5xl flex flex-col md:flex-row flex-wrap justify-center items-stretch gap-6 md:gap-8">
        
        @foreach($category as $c)
            <form action="{{ route('student.category', $c->id) }}" method="GET" 
                  class="glass-card p-6 rounded-2xl text-right flex flex-col justify-between items-start gap-4 w-full md:w-[280px] shrink-0">
                
                <div class="w-full">
                    <div class="text-pink-500 mb-4 bg-purple-950/40 p-3 rounded-xl border border-white/5 inline-block">
                        <img src="{{ asset('storage/'.$c->image) }}" alt="{{ $c->name }}" class="w-12 h-12 object-contain">
                    </div>
                    
                    <h3 class="text-lg font-bold tracking-wide text-purple-200">{{ $c->name }}</h3>
                </div>

                <button type="submit" 
                        class="w-full mt-2 bg-gradient-to-r from-pink-500/10 to-purple-500/10 hover:from-pink-500 hover:to-purple-500 border border-pink-500/30 hover:border-transparent text-pink-400 hover:text-white font-bold text-xs py-2 px-4 rounded-xl transition-all duration-300 cursor-pointer shadow-sm text-center">
                    ENTER COURSE &rarr;
                </button>
            </form>
        @endforeach

    </div> </main>
    <footer id="support" class="w-full z-10 py-6 px-4 border-t border-purple-950/40 bg-black/40 backdrop-blur-sm">
        <div class="max-w-5xl mx-auto flex flex-col md:flex-row items-center justify-between gap-4 text-xs text-gray-500">
            <div>
                &copy; 2026 Ls free Acadimi. All rights reserved.
            </div>
            <div class="flex gap-4">
                <a href="https://www.facebook.com/Liol L Liol"  class="hover:text-pink-400 transition-colors" target="_blank" rel="noopener noreferrer"><img src="{{asset('image/facbook.png')}}" alt="Facebook"></a>
                <a href="https://wa.me/779947345" class="hover:text-pink-400 transition-colors" target="_blank" rel="noopener noreferrer" style="width:58px;height:58px;"><img src="{{asset('image/wats.png')}}"></a>
            </div>
            <div class="text-gray-600 font-mono">
                we will teach all programming languages in the future for free , and we will add more features to the website.
            </div>
        </div>
    </footer>

    <script>
    
        const canvas = document.querySelector('#nebula-canvas');
        const scene = new THREE.Scene();
        
        scene.fog = new THREE.FogExp2(0x0b0214, 0.001);

        const camera = new THREE.PerspectiveCamera(60, window.innerWidth / window.innerHeight, 0.1, 2000);
        camera.position.set(0, 50, 200); 

        const renderer = new THREE.WebGLRenderer({ canvas: canvas, antialias: true });
        renderer.setSize(window.innerWidth, window.innerHeight);

      
        const backStarCount = 10000;
        const backGeometry = new THREE.BufferGeometry();
        const backPositions = new Float32Array(backStarCount * 3);
        const backColors = new Float32Array(backStarCount * 3);

        for (let i = 0; i < backStarCount * 3; i += 3) {
            backPositions[i] = Math.random() * 2000 - 1000;
            backPositions[i + 1] = Math.random() * 2000 - 1000;
            backPositions[i + 2] = Math.random() * 1000 - 800;

            const colorBack = new THREE.Color().setHSL(Math.random(), 0.2, Math.random() * 0.5 + 0.1);
            backColors[i] = colorBack.r;
            backColors[i + 1] = colorBack.g;
            backColors[i + 2] = colorBack.b;
        }
        backGeometry.setAttribute('position', new THREE.BufferAttribute(backPositions, 3));
        backGeometry.setAttribute('color', new THREE.BufferAttribute(backColors, 3));
        const backMaterial = new THREE.PointsMaterial({ size: 1.2, vertexColors: true, transparent: true, opacity: 0.6 });
        const backStars = new THREE.Points(backGeometry, backMaterial);
        scene.add(backStars);

        const starCount = 6000;
        const positions = new Float32Array(starCount * 3);
        const colors = new Float32Array(starCount * 3);
        const sizes = new Float32Array(starCount);

        const colorPink = new THREE.Color('#ff69b4');
        const colorPurple = new THREE.Color('#8a2be2');
        const colorDeep = new THREE.Color('#4b0082');

        const spiralArms = 3;
        const spiralTension = 4.0;
        const galaxyRadius = 400;

        for (let i = 0; i < starCount; i++) {
            const i3 = i * 3;
            const radius = Math.random() * galaxyRadius;
            const branchAngle = (i % spiralArms) * ((Math.PI * 2) / spiralArms);
            const spinAngle = radius * spiralTension;

            positions[i3] = Math.sin(branchAngle + spinAngle) * radius + (Math.random() - 0.5) * 50;
            positions[i3 + 1] = (Math.random() - 0.5) * 60; 
            positions[i3 + 2] = Math.cos(branchAngle + spinAngle) * radius + (Math.random() - 0.5) * 50;

            let mixedColor = colorPink.clone();
            let rand = Math.random();
            if (rand > 0.3 && rand < 0.7) {
                mixedColor.lerp(colorPurple, Math.random());
            } else if (rand >= 0.7) {
                mixedColor.lerp(colorDeep, Math.random());
            }

            colors[i3] = mixedColor.r;
            colors[i3 + 1] = mixedColor.g;
            colors[i3 + 2] = mixedColor.b;

            sizes[i] = Math.random() * 2.5 + 1.2;
        }

        const geometry = new THREE.BufferGeometry();
        geometry.setAttribute('position', new THREE.BufferAttribute(positions, 3));
        geometry.setAttribute('color', new THREE.BufferAttribute(colors, 3));
        
        const pMaterial = new THREE.PointsMaterial({
            size: 3.5, 
            vertexColors: true,
            transparent: true,
            opacity: 0.9,
            blending: THREE.AdditiveBlending, 
            depthWrite: false,
        });

        const starField = new THREE.Points(geometry, pMaterial);
        scene.add(starField);

        const ambientLight = new THREE.AmbientLight(0xff69b4, 0.2);
        scene.add(ambientLight);

        function animate() {
            requestAnimationFrame(animate);

            starField.rotation.y += 0.001; 
            
            const time = Date.now() * 0.0005;
            starField.position.y = Math.sin(time * 0.5) * 5;

            renderer.render(scene, camera);
        }
        animate();

        window.addEventListener('resize', () => {
            camera.aspect = window.innerWidth / window.innerHeight;
            camera.updateProjectionMatrix();
            renderer.setSize(window.innerWidth, window.innerHeight);
        });
    </script>
</body>
</html>