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
    <!-- Metadata and link to external CSS -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Blog Platform</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <!-- Header section with the page title and navigation menu -->
    <header>
        <h1>Blog Platform</h1>
        <nav>
            <ul>
                <li><a href="../Authentication/logout.php">Logout</a></li>
                <li><a href="home.php">Home</a></li>
                <li><a href="blog.html">Add Blog</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <!-- Form to search for blog posts -->
        <form method="GET" action="home.php" id="search-filter">
            <input id="search-input" type="text" name="search" placeholder="Search blogs..."
                value="<?php echo htmlspecialchars($searchQuery); ?>">
            <button type="submit">Search</button>
        </form>

        <!-- Section to display all blog posts -->
        <section id="blog-posts">
            <h2>All Blog Posts</h2>
            <?php
            // Check if there are any blog posts in the result
            if ($result->num_rows > 0) {
                // Loop through each blog post and display its details
                while ($row = $result->fetch_assoc()) {
                    echo "<article>";
                    echo "<h3>" . htmlspecialchars($row['title']) . "</h3>";
                    echo "<p><strong>Author:</strong> " . htmlspecialchars($row['author']) . "</p>";
                    echo "<p><strong>Category:</strong> " . htmlspecialchars($row['category']) . "</p>";
                    echo "<p>" . nl2br(htmlspecialchars($row['content'])) . "</p>";

                    // Form to edit the blog post
                    echo "<form method='GET' action='editBlog.php'>";
                    echo "<input type='hidden' name='id' value='" . htmlspecialchars($row['id']) . "'>";
                    echo "<button type='submit'>Edit</button>";
                    echo "</form>";

                    // Form to delete the blog post with a confirmation prompt
                    echo "<form method='POST' action='blogdeletion.php' onsubmit='return confirm(\"Are you sure you want to delete this post?\");'>";
                    echo "<input type='hidden' name='id' value='" . htmlspecialchars($row['id']) . "'>";
                    echo "<button type='submit'>Delete</button>";
                    echo "</form>";

                    echo "</article><hr>";
                }
            } else {
                // Message to display if no blog posts are available
                echo "<p>No blog posts available.</p>";
            }
            ?>
        </section>
    </main>
</body>

</html>

<?php
// Close the database connection
$conn->close();
?>