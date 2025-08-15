<?php
// --- Database Connection Details ---
// Replace the following with your actual database credentials.
$servername = "db";
$username = "user";
$password = "password";
$dbname = "database";

// --- Create a Database Connection ---
// We are using the mysqli extension, which is the modern way to interact with MySQL databases in PHP.
$conn = new mysqli($servername, $username, $password, $dbname);

// --- Check the Connection ---
// It's important to check if the connection was successful before proceeding.
if ($conn->connect_error) {
    // If there is a connection error, stop the script and display the error message.
    die("Connection failed: " . $conn->connect_error);
}

// --- SQL Query ---
// This is the query to select the "voornaam" (first name) from a table called "users".
// You should replace "users" with the actual name of your table if it's different.
$sql = "SELECT voornaam FROM users";

// --- Execute the Query ---
$result = $conn->query($sql);

// --- Check if the Query was Successful and Returned Rows ---
if ($result && $result->num_rows > 0) {
    // --- Loop Through the Results ---
    // The while loop iterates over each row of the result set.
    // `mysqli_fetch_assoc` fetches one row as an associative array.
    echo "<h1>First Names</h1>";
    echo "<ul>";
    while($row = $result->fetch_assoc()) {
        // We access the "voornaam" column from the associative array.
        // We use htmlspecialchars to prevent XSS vulnerabilities when displaying user-provided data.
        $doe = htmlspecialchars($row["voornaam"]);
        echo "<li>" . $doe . "</li>";
    }
    echo "</ul>";
} else {
    // If the query returned no results, display a message.
    echo "No results found.";
}

// --- Close the Connection ---
// It's a good practice to close the database connection when you're done with it.
$conn->close();

?>
