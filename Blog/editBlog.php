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
    <!-- Metadata and link to external CSS -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Blog - Blog Platform</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <!-- Header section with the page title -->
    <header>
        <h1>Edit Blog Post</h1>
    </header>
    <main>
        <!-- Section containing the form to edit the blog post -->
        <section id="edit-blog-form">
            <!-- Form to submit the updated blog post data -->
            <form method="POST" action="editBlog.php">
                <!-- Hidden input to store the blog post ID -->
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

                <!-- Input field for the blog title -->
                <label for="title" class="edit-label">Title:</label>
                <input type="text" id="title" name="title" class="edit-input"
                    value="<?php echo htmlspecialchars($row['title']); ?>" required><br>

                <!-- Input field for the blog author -->
                <label for="author" class="edit-label">Author:</label>
                <input type="text" id="author" name="author" class="edit-input"
                    value="<?php echo htmlspecialchars($row['author']); ?>" required><br>

                <!-- Dropdown menu for selecting the blog category -->
                <label for="category" class="edit-label">Category:</label>
                <select name="category" id="category" required>
                    <option value="" disabled>Select a category</option>
                    <?php echo $categoryOptions; ?>
                </select><br>

                <!-- Textarea for the blog content -->
                <label for="content" class="edit-label">Content:</label>
                <textarea id="content" name="content" class="edit-textarea"
                    required><?php echo htmlspecialchars($row['content']); ?></textarea><br>

                <!-- Submit button to update the blog post -->
                <button type="submit" class="edit-button">Update Blog</button>
            </form>
        </section>
    </main>
</body>

</html>