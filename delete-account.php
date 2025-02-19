<?php
session_start(); // Start the session



// Include the database connection
require_once 'mysql.php';

// Get the logged-in user's username
$username = $_SESSION['username'];

try {
    // Delete the user from the database
    $stmt = $mysql->prepare("DELETE FROM accounts WHERE USERNAME = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();

    // Log the user out
    session_unset(); // Clear all session variables
    session_destroy(); // Destroy the session

    // Redirect to the homepage with a success message
    $_SESSION['message'] = "Your account has been deleted successfully.";
    header("Location: index.php");
    exit;
} catch (PDOException $e) {
    // Log the error and show a user-friendly message
    error_log("Account deletion error: " . $e->getMessage());
    $_SESSION['error'] = "An error occurred while deleting your account.";
    header("Location: geheim.php");
    exit;
}
?>