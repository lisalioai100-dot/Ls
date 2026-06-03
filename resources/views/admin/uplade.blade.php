<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHq6BvJzT2uQj9Vb5y5K5t1e">
    <link rel="icon" href="{{ asset('logo.svg') }}" type="image/svg+xml">

    <style>
       

              body {
    margin: 0;
    padding: 0;
    background-color: #24042b; 
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
    
   
    background-image: url("{{ asset('image/robott.jpeg') }}");
    background-repeat: no-repeat;
    background-position: center center;
    background-size: contain; 
    
    z-index: -1; 
    opacity: 0.85; 
    
    filter: hue-rotate(105deg) saturate(100%) brightness(80%) contrast(105%) drop-shadow(0 0 70px rgba(98, 1, 140, 0.4));
}
        :root {
            --bg-base: #0a0a0c;
            --bg-surface: #121216;
            --text-main: #f3f4f6;
            --text-muted: #9ca3af;
            --neon-pink: #ff2a74;
            --neon-purple: #9d4edd;
            --gradient-glow: linear-gradient(135deg, #ff2a74, #9d4edd);
            --border-color: #22222a;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
        }

        body {
            background-color: var(--bg-base);
            color: var(--text-main);
            overflow: hidden;
            height: 100vh;
        }

        /* Dashboard Wrapper Layout */
        .dashboard-container {
            display: flex;
            height: 100vh;
            width: 100vw;
            position: relative;
        }

        /* Sidebar Navigation */
        .sidebar {
            width: 260px;
            background-color: var(--bg-surface);
            border-right: 1px solid var(--border-color);
            display: flex;
            flex-direction: column;
            padding: 20px;
            z-index: 10;
            transition: all 0.3s ease;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 16px;
            font-weight: 700;
            letter-spacing: 1px;
            padding-bottom: 30px;
            border-bottom: 1px solid var(--border-color);
            color: #fff;
        }

        .brand i {
            color: var(--neon-pink);
            text-shadow: 0 0 10px var(--neon-pink);
        }

        .nav-links {
            list-style: none;
            margin-top: 30px;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .nav-item a {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 14px 16px;
            color: var(--text-muted);
            text-decoration: none;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .nav-item a i {
            font-size: 18px;
            width: 25px;
            transition: transform 0.3s ease;
        }

        /* Hover effects with Pink and Purple glow */
        .nav-item a:hover {
            color: #fff;
            background: rgba(255, 42, 116, 0.05);
            box-shadow: inset 0 0 15px rgba(157, 78, 221, 0.1), 0 0 10px rgba(255, 42, 116, 0.1);
            border: 1px solid var(--neon-pink);
            transform: translateX(5px);
        }

        .nav-item a:hover i {
            color: var(--neon-purple);
            transform: scale(1.2);
            text-shadow: 0 0 8px var(--neon-purple);
        }

        .nav-item.active a {
            background: var(--gradient-glow);
            color: #fff;
            border: none;
            box-shadow: 0 0 20px rgba(255, 42, 116, 0.4);
        }
        .nav-item.active a i {
            color: #fff;
        }

        /* Main Workspace Content Area */
        .main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            position: relative;
            height: 100%;
            overflow-y: auto;
        }

        /* Top Header Navigation */
        .header {
            height: 70px;
            background-color: rgba(18, 18, 22, 0.8);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 30px;
            z-index: 5;
        }

        .search-box {
            position: relative;
            display: flex;
            align-items: center;
        }

        .search-box input {
            background: var(--bg-base);
            border: 1px solid var(--border-color);
            padding: 10px 15px 10px 40px;
            border-radius: 20px;
            color: #fff;
            outline: none;
            width: 250px;
            transition: all 0.3s ease;
        }

        .search-box input:focus {
            border-color: var(--neon-purple);
            box-shadow: 0 0 10px rgba(157, 78, 221, 0.3);
            width: 300px;
        }

        .search-box i {
            position: absolute;
            left: 15px;
            color: var(--text-muted);
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 15px;
            cursor: pointer;
        }

        .user-avatar {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: var(--gradient-glow);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            border: 2px solid var(--border-color);
            transition: all 0.3s ease;
        }

        .user-profile:hover .user-avatar {
            border-color: var(--neon-pink);
            box-shadow: 0 0 12px var(--neon-pink);
        }

      
        #three-canvas-container {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1;
        }

      
        .cards-overlay {
            position: relative;
            z-index: 2;
            padding: 30px;
            pointer-events: none; 
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 25px;
            width: 100%;
        }

        .card {
            background: rgba(18, 18, 22, 0.45);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: 16px;
            padding: 25px;
            pointer-events: auto; 
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5), 
                        inset 0 1px 1px rgba(255, 255, 255, 0.1);
            transform-style: preserve-3d;
            perspective: 1000px;
        }

        .card:hover {
            border-color: var(--neon-purple);
            transform: translateY(-8px) rotateX(2deg) rotateY(2deg);
            box-shadow: 0 20px 40px rgba(157, 78, 221, 0.15), 
                        0 0 30px rgba(255, 42, 116, 0.05),
                        inset 0 1px 1px rgba(255, 255, 255, 0.2);
        }

        .card-header {
            display: flex;
            flex-direction: column;
            gap: 15px;
            color: var(--text-main);
            font-size: 15px;
            width: 100%;
        }

        .card-header > span {
            font-weight: 600;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            font-size: 13px;
            color: var(--text-muted);
            border-bottom: 1px solid var(--border-color);
            padding-bottom: 10px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .card-header i {
            color: var(--neon-pink);
            font-size: 18px;
            text-shadow: 0 0 8px var(--neon-pink);
        }

        .card-value {
            font-size: 32px;
            font-weight: 700;
            color: #fff;
            margin-top: 10px;
            margin-bottom: 5px;
            text-shadow: 0 2px 4px rgba(0,0,0,0.5);
        }

        .card-meta {
            font-size: 12px;
            color: #10b981; 
            display: flex;
            align-items: center;
            gap: 5px;
        }

       
        form {
            display: flex;
            flex-direction: column;
            gap: 16px;
            width: 100%;
            margin-top: 5px;
            transform: translateZ(20px); 
        }

        form input[type="text"],
        form input[type="number"] {
            width: 100%;
            background: rgba(10, 10, 12, 0.7);
            border: 1px solid var(--border-color);
            padding: 12px 16px;
            border-radius: 8px;
            color: #fff;
            font-size: 14px;
            outline: none;
            transition: all 0.3s ease;
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.5);
        }

        form input[type="text"]:focus,
        form input[type="number"]:focus {
            border-color: var(--neon-pink);
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.5),
                        0 0 12px rgba(255, 42, 116, 0.2);
            background: rgba(18, 18, 22, 0.9);
        }

        form input[type="file"] {
            width: 100%;
            font-size: 13px;
            color: var(--text-muted);
            background: rgba(255, 255, 255, 0.02);
            border: 1px dashed var(--border-color);
            padding: 10px;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        form input[type="file"]::file-selector-button {
            background: var(--border-color);
            border: 1px solid rgba(255,255,255,0.05);
            color: #fff;
            padding: 6px 12px;
            border-radius: 6px;
            cursor: pointer;
            margin-right: 10px;
            transition: all 0.3s ease;
        }

        form input[type="file"]:hover {
            border-color: var(--neon-purple);
            background: rgba(157, 78, 221, 0.03);
        }

        form input[type="file"]:hover::file-selector-button {
            background: var(--neon-purple);
            box-shadow: 0 0 10px rgba(157, 78, 221, 0.5);
        }

        /* 3D Tactile Neon Button */
        form button[type="submit"] {
            background: var(--gradient-glow);
            color: #fff;
            border: none;
            padding: 14px;
            font-size: 14px;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.2, 0.8, 0.2, 1);
            box-shadow: 0 4px 15px rgba(255, 42, 116, 0.3),
                        inset 0 1px 0 rgba(255, 255, 255, 0.2);
            position: relative;
        }

        form button[type="submit"]:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(255, 42, 116, 0.5),
                        0 0 15px rgba(157, 78, 221, 0.3);
            filter: brightness(1.1);
        }

        form button[type="submit"]:active {
            transform: translateY(1px);
            box-shadow: 0 2px 8px rgba(255, 42, 116, 0.4);
        }

        /* Bottom Floating Console Status */
        .system-status {
            position: absolute;
            bottom: 20px;
            right: 30px;
            z-index: 2;
            background: rgba(18, 18, 22, 0.8);
            backdrop-filter: blur(10px);
            border: 1px solid var(--border-color);
            padding: 12px 20px;
            border-radius: 30px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 13px;
        }

        .status-dot {
            width: 8px;
            height: 8px;
            background-color: #10b981;
            border-radius: 50%;
            box-shadow: 0 0 8px #10b981;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7); }
            70% { transform: scale(1); box-shadow: 0 0 0 6px rgba(16, 185, 129, 0); }
            100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(16, 185, 129, 0); }
        }

        /* --- MICIT RESPONSIVE / MEDIA QUERIES --- */
        @media (max-width: 992px) {
            .sidebar {
                width: 80px;
                padding: 15px 10px;
            }
            .brand span, .nav-item a span {
                display: none;
            }
            .brand {
                justify-content: center;
                padding-bottom: 20px;
            }
            .nav-item a {
                justify-content: center;
                padding: 15px 0;
            }
            .nav-item a:hover {
                transform: none;
            }
        }

        @media (max-width: 576px) {
            .sidebar {
                position: absolute;
                bottom: 0;
                left: 0;
                width: 100vw;
                height: 60px;
                flex-direction: row;
                justify-content: space-around;
                padding: 0;
                border-right: none;
                border-top: 1px solid var(--border-color);
                box-shadow: 0 -10px 20px rgba(0,0,0,0.5);
            }
            .brand { display: none; }
            .nav-links {
                flex-direction: row;
                width: 100%;
                justify-content: space-around;
                margin-top: 0;
                gap: 0;
            }
            .nav-item a { padding: 0; height: 100%; width: 50px; }
            .main-content { height: calc(100vh - 60px); }
            .cards-overlay { grid-template-columns: 1fr; padding: 15px; }
            .search-box input { width: 140px; }
            .search-box input:focus { width: 160px; }
            .system-status { display: none; }
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
</head>
<body>
    <x-application-logo width="50" height="50"/>
    <div class="dashboard-container">
        
        <aside class="sidebar">
            <div class="brand">
                <i class="fa-solid fa-cubes-three-d"></i>
                <span>Publish Category & lessons</span>
            </div>
       
        </aside>

        <main class="main-content">
            
            <header class="header">
                <div class="search-box">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    
                </div>
                <div class="user-profile">
                    <div class="user-avatar">L</div>
                </div>
            </header>
            @if(session('lesson_fail'))
                   <script>
                     alert("{{ session('lesson_fail') }}");
                   </script>
            @endif

            @if(session('done'))
                <script>
                alert("{{ session('done') }}");
               </script>
            @endif

             @if(session('fail'))
               <script>
                alert("{{ session('fail') }}");
               </script>
             @endif
             @if(session('success'))
               <script>
                alert("{{ session('success') }}");
               </script>
               @endif
            <div id="three-canvas-container">
            <div>
   
            
</div>

            <div class="cards-overlay">
                
                <div class="card">
                    <div class="card-header">
                        <span><i class="fa-solid fa-folder-plus"></i> Publish Category</span>
                        <form action="{{route('admin.setUpload')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="file" name="image" id="fileToUpload" required>
                            <input type="text" name="name" placeholder="Set the name of category" required>
                            <button type="submit">Upload Category</button>
                        </form>
                    </div>
                </div>
             
                <div class="card">
                    <div class="card-header">
                        <span><i class="fa-solid fa-box-open"></i> Publish Lessons Related to Category</span>
                        <form action="{{route('admin.setLesson')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input name="name" type="text" placeholder="Set the name of product" required>
                            <input name="image" type="file" placeholder="Set the poster of lesson" required>
                            <input name="video" type="file" required placeholder="Set the video of lesson">
                            <input name="category_id" type="number" placeholder="Set the number of category" required>
                            <button type="submit">Set Product</button>
                        </form>
                    </div>
                </div>

                  <div class="card">
                    <div class="card-header">
                        <span><i class="fa-solid fa-box-open"></i> Publish Lessons Related to Category</span>
                        <form action="{{route('admin.setInfo')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <input name="article" type="text" placeholder="Set the article of news" >
                            <input name="image" type="file" placeholder="Set the photo of news" >
                            <input name="video" type="file"  placeholder="Set the video of news">
                            <button type="submit">Set news</button>
                        </form>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <span>TOTAL VISITS</span>
                        <i class="fa-solid fa-users"></i>
                    </div>
                    <div class="card-value">

            @foreach($category as $c)
            <article>
            <p>name :{{$c->name}}</p>
            <p>id : {{$c->id}}</p>
            <article>
            @endforeach 

                    </div>
                    <div class="card-meta"><i class="fa-solid fa-arrow-trend-up"></i>categories</div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <span>3D CORE CAPACITY</span>
                        <i class="fa-solid fa-server"></i>
                    </div>
                    <div class="card-value">31.42%</div>
                    <div class="card-meta" style="color: var(--text-muted);"><i class="fa-solid fa-microchip"></i> Optimal State</div>
                </div>

            </div>

            <div class="system-status">
                <div class="status-dot"></div>
                <span>Lisa Developer</span>
            </div>

        </main>
    </div>

</body>
</html>