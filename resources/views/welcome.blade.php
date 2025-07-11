<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ScoreUp | Chase Your Dream</title>
    <link rel="icon" href="/scoreup-logo.svg" type="image/svg+xml">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@900&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: 'Montserrat', Arial, sans-serif;
            background: #F9FAFB;
            color: #1F2937;
        }
        .nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 2.2rem 3rem 0 3rem;
            width: 90%;
            z-index: 10;
        }
        .nav-logo {
            font-size: 2.2rem;
            font-weight: 900;
            color: #DC2626;
            letter-spacing: -2px;
        }
        .nav-links {
            display: flex;
            gap: 2.5rem;
            align-items: center;
        }
        .nav-links a {
            color: #1F2937;
            text-decoration: none;
            font-weight: 600;
            font-size: 1.1rem;
            padding: 0.2rem 0.7rem;
            border-radius: 1rem;
            transition: background 0.2s, color 0.2s;
        }
        .nav-links a:hover, .nav-links .nav-demo:hover {
            background: #F97316;
            color: #fff;
        }
        .nav-demo {
            background: #DC2626;
            color: #fff !important;
            border-radius: 2rem;
            padding: 0.7rem 1.7rem;
            font-weight: 700;
            margin-left: 1rem;
            border: none;
            cursor: pointer;
            font-size: 1.1rem;
            transition: background 0.2s, color 0.2s;
        }
        .nav-demo:hover {
            background: #F97316;
            color: #fff;
        }
        .nav-training {
            background: #fff;
            color: #1F2937;
            border-radius: 2rem;
            padding: 0.7rem 2rem;
            font-weight: 700;
            font-size: 1.1rem;
            border: 1px solid #E5E7EB;
            cursor: pointer;
            margin-left: 1.5rem;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        }
        .nav-training:hover {
            background: #F97316;
            color: #fff;
        }
        .hero-headline {
            font-size: 5vw;
            font-weight: 900;
            line-height: 1.05;
            color: #1F2937;
            margin: 3.5rem 0 2.5rem 0;
            text-align: center;
            letter-spacing: -2px;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            gap: 1.2rem;
        }
        .hero-headline img, .hero-headline .img-oval {
            width: 110px;
            height: 70px;
            object-fit: cover;
            border-radius: 2.5rem;
            margin: 0 0.5rem;
        }
        .hero-headline .img-round {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            object-fit: cover;
            margin: 0 0.5rem;
        }
        .programs-row {
            display: flex;
            justify-content: center;
            gap: 2.2rem;
            margin: 3.5rem 0 0 0;
            flex-wrap: wrap;
        }
        .program-card {
            background: #fff;
            border-radius: 2.2rem;
            box-shadow: 0 2px 16px rgba(220,38,38,0.08);
            padding: 2.2rem 2.5rem 1.7rem 2.5rem;
            min-width: 260px;
            max-width: 320px;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            gap: 1.2rem;
            border: 2px solid #E5E7EB;
        }
        .program-card.orange { background: #F97316; color: #fff; }
        .program-card.purple { background: #DC2626; color: #fff; }
        .program-card.yellow { background: #F9FAFB; color: #DC2626; border: 2px solid #DC2626; }
        .program-label {
            font-size: 1.1rem;
            font-weight: 700;
            color: #1F2937;
            margin-bottom: 0.5rem;
        }
        .program-title {
            font-size: 2rem;
            font-weight: 900;
            color: inherit;
            margin-bottom: 0.5rem;
        }
        .program-icon {
            font-size: 2.2rem;
            margin-right: 0.7rem;
        }
        .program-play {
            background: #DC2626;
            color: #fff;
            border-radius: 50%;
            width: 2.5rem;
            height: 2.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            margin-left: auto;
            margin-top: 1rem;
            cursor: pointer;
            transition: background 0.2s;
        }
        .program-play:hover {
            background: #F97316;
        }
        @media (max-width: 900px) {
            .hero-headline { font-size: 2.2rem; }
            .programs-row { flex-direction: column; align-items: center; gap: 1.5rem; }
        }
        @media (max-width: 700px) {
            .nav { flex-direction: column; gap: 1rem; padding: 1rem; }
            .hero-headline { font-size: 1.5rem; }
        }
    </style>
</head>
<body>
    <div class="nav">
        <img src="/scoreup-logo.svg" alt="ScoreUp Logo" style="height:60px; margin-right:1rem; border-radius:12px; box-shadow:0 2px 8px rgba(220,38,38,0.10); background:#fff;">
        <div class="nav-links">
            {{-- <a href="#">Explore</a>
            <a href="#">Gyms</a>
            <a href="#">Coaches</a>
            <a href="#">Calendar</a> --}}
            <a href="{{ route('user-rule') }}" class="nav-links">Sport Rule</a>
            <a href="{{ route('login') }}" class="nav-demo">Log in</a>
            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="nav-demo">Register</a>
            @endif
            {{-- <button class="nav-training">Training</button> --}}
        </div>
    </div>
    <div class="hero-headline">
        TRAIN HARD
        <img src="https://images.unsplash.com/photo-1517649763962-0c623066013b?auto=format&fit=crop&w=200&q=80" class="img-oval" alt="Shoes">
        DREAM BIG
        <img src="https://images.unsplash.com/photo-1517841905240-472988babdf9?auto=format&fit=crop&w=200&q=80" class="img-oval" alt="Gym">
        WIN MORE
        <span class="img-round" style="background:#f1f814;"><img src="https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=100&q=80" class="img-round" alt="Bottle"></span>
        NEVER QUIT
    </div>
    <div class="programs-row">
        <div class="program-card orange">
            <div class="program-label">UPCOMING SPORT</div>
            <div class="program-title"><span class="program-icon">🏸</span>BADMINTON</div>
            <div class="program-play">&#9654;</div>
        </div>
        <div class="program-card purple">
            <div class="program-label">FINISHED SPORT</div>
            <div class="program-title"><span class="program-icon">🥅</span>FUTSAL</div>
            <div class="program-play">&#9654;</div>
        </div>
        <div class="program-card yellow">
            <div class="program-label">UPCOMING SPORT</div>
            <div class="program-title"><span class="program-icon">🤾‍♂</span>NETBALL</div>
            <div class="program-play">&#9654;</div>
        </div>
    </div>
</body>
</html>