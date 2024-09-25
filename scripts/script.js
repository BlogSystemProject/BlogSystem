// Wait until the document is fully loaded before running the script
document.addEventListener("DOMContentLoaded", () => {
  // Get references to the form and input fields by their IDs
  const form = document.getElementById("blog-form");
  const title = document.getElementById("title");
  const author = document.getElementById("author");
  const content = document.getElementById("content");
  const category = document.getElementById("category");

  // Add an event listener to the form to handle the submit event
  form.addEventListener("submit", (e) => {
    // Clear any existing error messages
    clearErrors();

    // Check if the title field is empty
    if (title.value.trim() === "") {
      // If empty, show an error message and prevent form submission
      showError(title, "Title is required.");
      e.preventDefault();
    }

    // Check if the author field is empty
    if (author.value.trim() === "") {
      // If empty, show an error message and prevent form submission
      showError(author, "Author is required.");
      e.preventDefault();
    }

    // Check if the content field is empty
    if (content.value.trim() === "") {
      // If empty, show an error message and prevent form submission
      showError(content, "Content is required.");
      e.preventDefault();
    }

    // Check if a category is selected
    if (category.value === "") {
      // If not selected, show an error message and prevent form submission
      showError(category, "Please select a category.");
      e.preventDefault();
    }
  });

  // Function to display an error message for a specific input field
  function showError(input, message) {
    // Create a new div element to hold the error message
    const errorElement = document.createElement("div");
    // Add a class to the error element for styling
    errorElement.className = "error";
    // Set the error message text
    errorElement.innerText = message;
    // Append the error message below the input field
    input.parentElement.appendChild(errorElement);
    // Add a class to the input field to indicate an error
    input.classList.add("error-input");
  }

  // Function to remove all error messages from the form
  function clearErrors() {
    // Select all elements with the "error" class and remove them
    const errors = document.querySelectorAll(".error");
    errors.forEach((error) => error.remove());

    // Select all input fields with the "error-input" class and remove the class
    const errorInputs = document.querySelectorAll(".error-input");
    errorInputs.forEach((input) => input.classList.remove("error-input"));
  }
});
