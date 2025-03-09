<?php
session_start();
require_once '../config/database.php';

// Check if admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit();
}

// Handle movie addition
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $genre = $_POST['genre'];
    $release_year = $_POST['release_year'];
    $duration = $_POST['duration'];
    $poster_url = $_POST['poster_url'];
    $video_url = $_POST['video_url'];
    $video_type = $_POST['video_type'];
    $featured = isset($_POST['featured']) ? 1 : 0;

    $stmt = $pdo->prepare("INSERT INTO movies (title, description, genre, release_year, duration, poster_url, video_url, video_type, featured) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$title, $description, $genre, $release_year, $duration, $poster_url, $video_url, $video_type, $featured]);
}

// Get all movies
$stmt = $pdo->query("SELECT * FROM movies ORDER BY created_at DESC");
$movies = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - MovieFlix</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>
    <div class="admin-container">
        <div class="admin-dashboard">
            <div class="admin-header">
                <h1>Admin Dashboard</h1>
                <a href="logout.php" class="btn-primary">Logout</a>
            </div>

            <div class="movie-form">
                <h2>Add New Movie</h2>
                <form method="POST" action="">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" id="title" name="title" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea id="description" name="description" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="genre">Genre</label>
                        <input type="text" id="genre" name="genre" required>
                    </div>
                    <div class="form-group">
                        <label for="release_year">Release Year</label>
                        <input type="number" id="release_year" name="release_year" required>
                    </div>
                    <div class="form-group">
                        <label for="duration">Duration</label>
                        <input type="text" id="duration" name="duration" placeholder="2h 30min" required>
                    </div>
                    <div class="form-group">
                        <label for="poster_url">Poster URL</label>
                        <input type="url" id="poster_url" name="poster_url" required>
                    </div>
                    <div class="form-group">
                        <label for="video_url">Video URL</label>
                        <input type="url" id="video_url" name="video_url" required>
                    </div>
                    <div class="form-group">
                        <label for="video_type">Video Type</label>
                        <select id="video_type" name="video_type" required>
                            <option value="mp4">MP4</option>
                            <option value="m3u8">M3U8 (HLS)</option>
                            <option value="mkv">MKV</option>
                            <option value="ts">TS</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>
                            <input type="checkbox" id="featured" name="featured">
                            Featured Movie
                        </label>
                    </div>
                    <button type="submit" class="btn-primary">Add Movie</button>
                </form>
            </div>

            <div class="movies-list">
                <h2>Movies List</h2>
                <table class="movie-table">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Genre</th>
                            <th>Release Year</th>
                            <th>Video Type</th>
                            <th>Featured</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($movies as $movie): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($movie['title']); ?></td>
                            <td><?php echo htmlspecialchars($movie['genre']); ?></td>
                            <td><?php echo htmlspecialchars($movie['release_year']); ?></td>
                            <td><?php echo htmlspecialchars($movie['video_type']); ?></td>
                            <td><?php echo $movie['featured'] ? 'Yes' : 'No'; ?></td>
                            <td class="action-buttons">
                                <a href="edit.php?id=<?php echo $movie['id']; ?>" class="btn-edit">Edit</a>
                                <a href="delete.php?id=<?php echo $movie['id']; ?>" class="btn-delete" onclick="return confirm('Are you sure?')">Delete</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html> 