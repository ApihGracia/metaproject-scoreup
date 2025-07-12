
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ScoreUp | Chase Your Dream</title>
    <link rel="icon" href="/scoreup-logo.svg" type="image/svg+xml">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@900&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
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
            padding: 2rem 3rem 0 3rem;
            width: 100%;
            z-index: 10;
        }
        .nav-logo {
            font-size: 2.2rem;
            font-weight: 900;
            color: #DC2626;
            letter-spacing: -2px;
        }
        .nav-actions {
            display: flex;
            gap: 1.2rem;
            align-items: center;
        }
        .nav-actions a {
            background: #DC2626;
            color: #fff;
            border-radius: 2rem;
            padding: 0.7rem 2.7rem;
            font-weight: 700;
            font-size: 1.1rem;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: background 0.2s, color 0.2s;
        }
        .nav-actions a:hover {
            background: #F97316;
            color: #fff;
        }
        .main-card-row {
            display: flex;
            gap: 2.5rem;
            margin: 2.5rem auto 0 auto;
            max-width: 1100px;
            justify-content: center;
        }
        .main-card {
            background: #fff;
            border-radius: 2.2rem;
            box-shadow: 0 2px 16px rgba(220,38,38,0.08);
            padding: 2.2rem 2.5rem 1.7rem 2.5rem;
            min-width: 340px;
            max-width: 480px;
            display: flex;
            flex-direction: column;
            align-items: center;
            border: 2px solid #E5E7EB;
        }
        .slider-img {
            width: 100%;
            height: 260px;
            object-fit: cover;
            border-radius: 1.5rem;
            box-shadow: 0 2px 12px rgba(220,38,38,0.10);
        }
        .slider-controls {
            display: flex;
            justify-content: center;
            gap: 0.5rem;
            margin-top: 1rem;
        }
        .slider-dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: #E5E7EB;
            cursor: pointer;
        }
        .slider-dot.active {
            background: #DC2626;
        }
        .main-card-quote {
            font-size: 1.5rem;
            font-weight: 700;
            color: #DC2626;
            margin-top: 2.5rem;
            text-align: center;
        }
        .nav-tabs {
            display: flex;
            justify-content: center;
            gap: 2.5rem;
            margin: 2.5rem auto 0 auto;
            max-width: 900px;
        }
        .nav-tab {
            background: #fff;
            color: #DC2626;
            font-weight: 700;
            font-size: 1.2rem;
            border-radius: 1.5rem 1.5rem 0 0;
            padding: 1rem 2.5rem;
            border: 2px solid #DC2626;
            border-bottom: none;
            cursor: pointer;
            transition: background 0.2s, color 0.2s;
        }
        .nav-tab.active {
            background: #DC2626;
            color: #fff;
        }
        .schedule-section {
            background: #fff;
            border-radius: 2rem;
            box-shadow: 0 2px 16px rgba(220,38,38,0.08);
            padding: 2.2rem 2.5rem 1.7rem 2.5rem;
            max-width: 1100px;
            margin: 0 auto 2.5rem auto;
        }
        .schedule-header {
            font-size: 2rem;
            font-weight: 900;
            color: #DC2626;
            margin-bottom: 1.5rem;
        }
        .schedule-filters {
            display: flex;
            gap: 1.2rem;
            margin-bottom: 1.5rem;
        }
        .schedule-filters select {
            padding: 0.7rem 1.2rem;
            border-radius: 1rem;
            border: 2px solid #E5E7EB;
            font-size: 1rem;
            font-weight: 600;
            color: #1F2937;
        }
        .view-toggle-row {
            display: flex;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }
        .view-toggle-btn {
            background: #fff;
            color: #DC2626;
            border-radius: 1.5rem;
            padding: 0.7rem 2rem;
            font-weight: 700;
            font-size: 1.1rem;
            border: 2px solid #DC2626;
            cursor: pointer;
            transition: background 0.2s, color 0.2s;
        }
        .view-toggle-btn.active {
            background: #DC2626;
            color: #fff;
        }
        .schedule-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2rem;
        }
        .match-card {
            background: #fff;
            border-radius: 1.5rem;
            box-shadow: 0 2px 12px rgba(220,38,38,0.10);
            padding: 1.5rem 1.2rem 1.2rem 1.2rem;
            border: 2px solid #E5E7EB;
            display: flex;
            flex-direction: column;
            gap: 0.7rem;
        }
        .match-card .match-type {
            font-size: 1.1rem;
            font-weight: 700;
            color: #DC2626;
            margin-bottom: 0.5rem;
        }
        .match-card .match-info {
            font-size: 1rem;
            color: #1F2937;
            font-weight: 600;
        }
        .match-card .match-teams {
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 1.1rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }
        .match-card .match-score {
            background: #F97316;
            color: #fff;
            border-radius: 1rem;
            padding: 0.3rem 1.2rem;
            font-size: 1.1rem;
            font-weight: 900;
        }
        .match-card .match-status {
            font-size: 0.95rem;
            font-weight: 700;
            color: #22C55E;
        }
        @media (max-width: 1100px) {
            .main-card-row, .schedule-section { max-width: 100%; }
            .schedule-grid { grid-template-columns: repeat(2, 1fr); }
        }
        @media (max-width: 900px) {
            .main-card-row { flex-direction: column; align-items: center; gap: 1.5rem; }
            .schedule-grid { grid-template-columns: 1fr; }
        }
        @media (max-width: 700px) {
            .nav { flex-direction: column; gap: 1rem; padding: 1rem; }
            .main-card { min-width: 90vw; max-width: 98vw; }
            .schedule-section { padding: 1rem; }
        }
    </style>
</head>
<body x-data="{ slider: 0, images: [
    '/storage/backgrounds/POSTER_BADMINTON.jpg',
    '/storage/backgrounds/POSTER_BOLASEPAK.jpg',
    '/storage/backgrounds/POSTER_FRISBEE.jpg',
    '/storage/backgrounds/POSTER_NETBALL.jpg'
], timer: null }" x-init="timer = setInterval(() => { slider = (slider + 1) % images.length }, 2000)">
    <div class="nav">
        <img src="/scoreup-logo.svg" alt="ScoreUp Logo" style="height:60px; margin-right:1rem; border-radius:12px; box-shadow:0 2px 8px rgba(220,38,38,0.10); background:#fff;">
        <div class="nav-actions">
            <a href="{{ route('login') }}">Log in</a>
            @if (Route::has('register'))
                <a href="{{ route('register') }}">Register</a>
            @endif
        </div>
    </div>

    <div class="main-card-row">
        <div class="main-card" style="flex:1;">
            <div style="width:100%;">
                <img :src="images[slider]" class="slider-img" alt="Sport Image">
                <div class="slider-controls">
                    <template x-for="(img, idx) in images">
                        <div :class="'slider-dot' + (slider === idx ? ' active' : '')" @click="slider = idx"></div>
                    </template>
                </div>
            </div>
        </div>
        <div class="main-card" style="flex:1; display:flex; align-items:center; justify-content:center;">
            <div class="main-card-quote">Upcoming event soon!<br>stay tune</div>
        </div>
    </div>

    <div class="nav-tabs">
        <a href="{{ route('user-rule') }}" class="nav-tab">Rules</a>
        <a href="#" class="nav-tab">Live Scoreboard</a>
        <a href="#" class="nav-tab active">Schedule</a>
    </div>

    <div class="schedule-section">
        <div class="schedule-header">Match Schedule</div>
        <div class="schedule-filters">
            <select id="sport-filter">
                <option value="">All Sports</option>
                <option value="Badminton">Badminton</option>
                <option value="Futsal">Futsal</option>
                <option value="Netball">Netball</option>
                <option value="Volleyball">Volleyball</option>
            </select>
            <select id="gender-filter">
                <option value="">All Gender</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Mixed">Mixed</option>
            </select>
        </div>
        <div class="view-toggle-row">
            <button class="view-toggle-btn active">Grid View</button>
            <button class="view-toggle-btn">List View</button>
        </div>
        <div class="schedule-grid">
            <!-- Example match cards, replace with dynamic data -->
            <div class="match-card">
                <div class="match-type">Badminton</div>
                <div class="match-info">Tue, July 1 &bull; 09:00</div>
                <div class="match-teams">
                    <span>KAHS</span>
                    <span class="match-score">21 : 18</span>
                    <span>KZ</span>
                </div>
                <div class="match-status">Finalized</div>
            </div>
            <div class="match-card">
                <div class="match-type">Futsal</div>
                <div class="match-info">Tue, July 1 &bull; 10:00</div>
                <div class="match-teams">
                    <span>KAB</span>
                    <span class="match-score">3 : 2</span>
                    <span>KHAR</span>
                </div>
                <div class="match-status">Ongoing</div>
            </div>
            <div class="match-card">
                <div class="match-type">Netball</div>
                <div class="match-info">Tue, July 1 &bull; 11:00</div>
                <div class="match-teams">
                    <span>KUO</span>
                    <span class="match-score">15 : 15</span>
                    <span>UKLK</span>
                </div>
                <div class="match-status">Ongoing</div>
            </div>
            <!-- Add more cards dynamically as needed -->
        </div>
    </div>
</body>
</html>