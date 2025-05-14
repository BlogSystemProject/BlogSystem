<?php
// Include the file that connects to the database
include 'blogConnect.php';

// Handle GET request to fetch blog post details for editing
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    // Get the blog post ID from the URL and convert it to an integer
    $id = intval($_GET['id']);
    // SQL query to fetch the blog post details by ID
    $sql = "SELECT * FROM blogs WHERE id = $id";
    // Execute the query and get the result
    $result = $conn->query($sql);

    // Check if the blog post exists
    if ($result->num_rows > 0) {
        // Fetch the blog post data into an associative array
        $row = $result->fetch_assoc();
    } else {
        // Display an error message if no blog post is found with the given ID
        echo "No blog post found with this ID.";
        exit();
    }
    // Handle POST request to update the blog post
} elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    // Get the blog post ID from the form data and convert it to an integer
    $id = intval($_POST['id']);
    // Get the updated blog post details from the form and escape special characters to prevent SQL injection
    $title = $conn->real_escape_string($_POST['title']);
    $author = $conn->real_escape_string($_POST['author']);
    $category = $conn->real_escape_string($_POST['category']);
    $content = $conn->real_escape_string($_POST['content']);

    // SQL query to update the blog post with the new details
    $updateQuery = "UPDATE blogs SET title='$title', author='$author', category='$category', content='$content' WHERE id=$id";
    // Execute the update query and check if it was successful
    if ($conn->query($updateQuery) === TRUE) {
        // If successful, redirect the user back to the home page
        header("Location: home.php");
        exit();
    } else {
        // Display an error message if there was an issue updating the record
        echo "Error updating record: " . $conn->error;
    }
    // Handle invalid requests
} else {
    // Display an error message if the request method or ID is invalid
    echo "Invalid request.";
    exit();
}

// category options for the dropdown menu
$categories = ["Technology", "Lifestyle", "Education", "Health", "Business"];
$categoryOptions = '';
foreach ($categories as $category) {
    // Check if the current category matches the one stored in the database and set it as selected
    $selected = ($category == $row['category']) ? 'selected' : '';
    $categoryOptions .= "<option value=\"$category\" $selected>$category</option>";
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Post | CST8285 Blog</title>
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
                    <li><a href="home.php"><i class="fas fa-home"></i> Home</a></li>
                    <li><a href="blog.html"><i class="fas fa-pen-fancy"></i> Write</a></li>
                    <li><a href="../Authentication/logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <div class="container">
            <section class="card animate-fade-in">
                <h2 class="section-title">Edit Post</h2>
                <p class="section-subtitle">Update your content and ideas</p>
                
                <div class="form-container">
                    <form method="POST" action="editBlog.php">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        
                        <div class="form-group">
                            <label for="title"><i class="fas fa-heading"></i> Title</label>
                            <input type="text" id="title" name="title" class="form-control"
                                value="<?php echo htmlspecialchars($row['title']); ?>" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="author"><i class="fas fa-user"></i> Author</label>
                            <input type="text" id="author" name="author" class="form-control"
                                value="<?php echo htmlspecialchars($row['author']); ?>" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="category"><i class="fas fa-tag"></i> Category</label>
                            <select name="category" id="category" class="form-control" required>
                                <option value="" disabled>Select a category</option>
                                <?php echo $categoryOptions; ?>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="content"><i class="fas fa-paragraph"></i> Content</label>
                            <textarea id="content" name="content" class="form-control"
                                required><?php echo htmlspecialchars($row['content']); ?></textarea>
                            <small class="form-text text-muted mt-1">Format your text with line breaks for better readability.</small>
                        </div>
                        
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary btn-block">
                                <i class="fas fa-save"></i> Update Post
                            </button>
                            <a href="home.php" class="btn-link text-center mt-2">
                                <i class="fas fa-times"></i> Cancel and return to home
                            </a>
                        </div>
                    </form>
                </div>
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