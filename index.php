<?php
require_once 'config/database.php';

// Get featured movies
$stmt = $pdo->query("SELECT * FROM movies WHERE featured = 1 ORDER BY created_at DESC");
$featured_movies = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Get all movies
$stmt = $pdo->query("SELECT * FROM movies ORDER BY created_at DESC");
$all_movies = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MovieFlix - Stream Movies Online</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <nav class="navbar">
        <div class="logo">
            <h1>MovieFlix</h1>
        </div>
        <div class="nav-links">
            <a href="#" class="active">Home</a>
            <a href="#movies">Movies</a>
            <a href="#featured">Featured</a>
            <a href="admin/login.php" class="admin-link">Admin</a>
        </div>
    </nav>

    <header class="hero">
        <div class="hero-content">
            <h1>Welcome to MovieFlix</h1>
            <p>Stream your favorite movies anytime, anywhere</p>
        </div>
    </header>

    <main>
        <section id="featured" class="featured-movies">
            <h2>Featured Movies</h2>
            <div class="movie-grid">
                <?php foreach ($featured_movies as $movie): ?>
                <div class="movie-card">
                    <img src="<?php echo htmlspecialchars($movie['poster_url']); ?>" alt="<?php echo htmlspecialchars($movie['title']); ?>">
                    <div class="movie-info">
                        <h3><?php echo htmlspecialchars($movie['title']); ?></h3>
                        <p><?php echo htmlspecialchars($movie['genre']); ?> | <?php echo htmlspecialchars($movie['release_year']); ?></p>
                        <p><?php echo htmlspecialchars($movie['duration']); ?></p>
                        <button onclick="playMovie('<?php echo htmlspecialchars($movie['video_url']); ?>', '<?php echo htmlspecialchars($movie['title']); ?>', '<?php echo htmlspecialchars($movie['video_type']); ?>')" class="play-btn">
                            Play Movie
                        </button>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </section>

        <section id="movies" class="all-movies">
            <h2>All Movies</h2>
            <div class="movie-grid">
                <?php foreach ($all_movies as $movie): ?>
                <div class="movie-card">
                    <img src="<?php echo htmlspecialchars($movie['poster_url']); ?>" alt="<?php echo htmlspecialchars($movie['title']); ?>">
                    <div class="movie-info">
                        <h3><?php echo htmlspecialchars($movie['title']); ?></h3>
                        <p><?php echo htmlspecialchars($movie['genre']); ?> | <?php echo htmlspecialchars($movie['release_year']); ?></p>
                        <p><?php echo htmlspecialchars($movie['duration']); ?></p>
                        <button onclick="playMovie('<?php echo htmlspecialchars($movie['video_url']); ?>', '<?php echo htmlspecialchars($movie['title']); ?>', '<?php echo htmlspecialchars($movie['video_type']); ?>')" class="play-btn">
                            Play Movie
                        </button>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </section>
    </main>

    <footer>
        <div class="footer-content">
            <div class="footer-section">
                <h3>MovieFlix</h3>
                <p>Your ultimate movie streaming destination</p>
            </div>
            <div class="footer-section">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#movies">Movies</a></li>
                    <li><a href="#featured">Featured</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Connect With Us</h3>
                <div class="social-links">
                    <a href="#"><i class="fab fa-facebook"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2024 MovieFlix. All rights reserved.</p>
        </div>
    </footer>

    <script>
    function playMovie(videoUrl, title, videoType) {
        const modal = document.createElement('div');
        modal.className = 'movie-modal';
        
        let videoPlayer;
        if (videoType === 'm3u8') {
            // HLS player for m3u8
            videoPlayer = `
                <video id="hlsPlayer" controls>
                    <source src="${videoUrl}" type="application/x-mpegURL">
                    Your browser does not support the video tag.
                </video>
                <script src="https://cdn.jsdelivr.net/npm/hls.js@latest"><\/script>
                <script>
                    if (Hls.isSupported()) {
                        const video = document.getElementById('hlsPlayer');
                        const hls = new Hls();
                        hls.loadSource('${videoUrl}');
                        hls.attachMedia(video);
                    }
                <\/script>
            `;
        } else {
            // Regular video player for mp4, mkv, ts
            videoPlayer = `
                <video controls>
                    <source src="${videoUrl}" type="video/${videoType}">
                    Your browser does not support the video tag.
                </video>
            `;
        }

        modal.innerHTML = `
            <div class="modal-content">
                <div class="modal-header">
                    <h2>${title}</h2>
                    <button onclick="closeModal()" class="close-btn">&times;</button>
                </div>
                ${videoPlayer}
            </div>
        `;

        document.body.appendChild(modal);
    }

    function closeModal() {
        const modal = document.querySelector('.movie-modal');
        if (modal) {
            modal.remove();
        }
    }
    </script>
</body>
</html> 