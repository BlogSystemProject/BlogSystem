<?php
// Include the file that connects to the database
include 'blogConnect.php';

// Initialize an empty search query
$searchQuery = "";

// Default SQL query to fetch all blogs ordered by id in descending order
$sql = "SELECT * FROM blogs ORDER BY id DESC";

// Check if the form was submitted via GET request with a search query
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['search'])) {
    // Sanitize the search query to prevent SQL injection
    $searchQuery = $conn->real_escape_string($_GET['search']);
    // Modify the SQL query to search for blogs by title, content, or author
    $sql = "SELECT * FROM blogs WHERE title LIKE '%$searchQuery%' OR content LIKE '%$searchQuery%' OR author LIKE '%$searchQuery%' ORDER BY id DESC";
}

// Execute the SQL query
$result = $conn->query($sql);

// Check if the query execution resulted in an error
if ($result === FALSE) {
    echo "Error: " . $conn->error;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $searchQuery ? "Search: $searchQuery" : "Home"; ?> | CST8285 Blog</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
    <header>
        <div class="header-bg"></div>
        <div class="container header-content">
            <div class="site-branding">
                <i class="fas fa-laptop-code site-logo"></i>
                <h1 class="site-title">CST8285 Blog</h1>
            </div>
            <nav>
                <ul>
                    <li><a href="home.php" class="active"><i class="fas fa-home"></i> Home</a></li>
                    <li><a href="blog.html"><i class="fas fa-pen-fancy"></i> Write</a></li>
                    <li><a href="../Authentication/logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <div class="container">
            <!-- Search Form -->
            <div class="search-container animate-fade-in">
                <form method="GET" action="home.php">
                    <input type="text" name="search" class="search-input" placeholder="Search posts, authors, or topics..." value="<?php echo htmlspecialchars($searchQuery); ?>">
                    <button type="submit" class="search-button"><i class="fas fa-search"></i></button>
                </form>
            </div>

            <!-- Blog Posts Section -->
            <section class="animate-fade-in">
                <h2 class="section-title"><?php echo $searchQuery ? "Search Results" : "Latest Posts"; ?></h2>
                <?php if ($searchQuery): ?>
                    <p class="section-subtitle">Showing results for "<?php echo htmlspecialchars($searchQuery); ?>"</p>
                <?php else: ?>
                    <p class="section-subtitle">Discover the latest thoughts and ideas</p>
                <?php endif; ?>

                <?php if ($result->num_rows > 0): ?>
                    <div class="blog-grid">
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <article class="blog-card animate-fade-in">
                                <div class="blog-card-content">
                                    <h3 class="blog-card-title"><?php echo htmlspecialchars($row['title']); ?></h3>
                                    
                                    <div class="blog-card-meta">
                                        <span class="blog-card-meta-item">
                                            <i class="fas fa-user"></i> <?php echo htmlspecialchars($row['author']); ?>
                                        </span>
                                        <span class="blog-card-meta-item">
                                            <i class="fas fa-tag"></i> 
                                            <span class="category-badge"><?php echo htmlspecialchars($row['category']); ?></span>
                                        </span>
                                        <span class="blog-card-meta-item">
                                            <i class="far fa-calendar-alt"></i> 
                                            <?php echo date('M j, Y', strtotime($row['created_at'])); ?>
                                        </span>
                                    </div>
                                    
                                    <div class="blog-card-excerpt">
                                        <?php 
                                            $content = htmlspecialchars($row['content']);
                                            echo nl2br(substr($content, 0, 150)) . (strlen($content) > 150 ? '...' : '');
                                        ?>
                                    </div>
                                    
                                    <div class="blog-card-actions">
                                        <form method="GET" action="editBlog.php">
                                            <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id']); ?>">
                                            <button type="submit" class="btn btn-primary"><i class="fas fa-edit"></i> Edit</button>
                                        </form>
                                        <form method="POST" action="blogdeletion.php" onsubmit="return confirm('Are you sure you want to delete this post?');">
                                            <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id']); ?>">
                                            <button type="submit" class="btn btn-delete"><i class="fas fa-trash-alt"></i> Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </article>
                        <?php endwhile; ?>
                    </div>
                <?php else: ?>
                    <div class="empty-state">
                        <i class="fas fa-file-alt empty-state-icon"></i>
                        <h3 class="empty-state-title">No posts found</h3>
                        <?php if ($searchQuery): ?>
                            <p class="empty-state-description">We couldn't find any posts matching "<?php echo htmlspecialchars($searchQuery); ?>"</p>
                            <a href="home.php" class="btn btn-primary"><i class="fas fa-home"></i> Back to Home</a>
                        <?php else: ?>
                            <p class="empty-state-description">Share your first post with the world!</p>
                            <a href="blog.html" class="btn btn-primary"><i class="fas fa-pen-fancy"></i> Create Post</a>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </section>
        </div>
    </main>

    <footer>
        <div class="container footer-content">
            <div class="footer-logo">
                <i class="fas fa-laptop-code"></i> CST8285 Blog
            </div>
            <p class="footer-copyright">&copy; 2024 CST8285 Blog Platform. All rights reserved.</p>
        </div>
    </footer>
</body>

</html>

<?php
// Close the database connection
$conn->close();
?>