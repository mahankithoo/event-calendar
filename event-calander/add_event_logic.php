<?php
session_start();
require_once 'dbconnect.php';

// Set default values for session variables
$_SESSION['addEvent'] = '';

// Check if user_id is set in the session
// $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

// if button was clicked, submit the data
if (isset($_POST['event_button'])) {
    $event_title = filter_var($_POST['event_title'], FILTER_SANITIZE_STRING);
    $event_desc = filter_var($_POST['event_desc'], FILTER_SANITIZE_STRING);
    $event_time = filter_var($_POST['event_time'], FILTER_SANITIZE_STRING);
    $user_id = filter_var($_POST['user_id'], FILTER_VALIDATE_INT, array('options' => array('min_range' => 0)));
    $event_date = filter_var($_POST['event_date'], FILTER_SANITIZE_STRING);

    // Validate and parse the event_date
    if (!$event_date || !strtotime($event_date)) {
        $_SESSION['addEvent'] = "Please provide a valid date";
    } else {
        // Extract year, month, and day
        $event_year = date('Y', strtotime($event_date));
        $event_month = date('m', strtotime($event_date));
        $event_day = date('d', strtotime($event_date));
    }

    // validate all input values
    if (!$event_title) {
        $_SESSION['addEvent'] = "Please add any title";
    } elseif (!$event_desc) {
        $_SESSION['addEvent'] = "Please add any description";
    } elseif (!$event_date) {
        $_SESSION['addEvent'] = "Please add any date";
    } elseif (!$event_time) {
        $_SESSION['addEvent'] = "Please add any time";
    } elseif ($user_id === false) {
        $_SESSION['addEvent'] = "Please add a valid Teacher ID";
    }
}

// redirect back to the add home page if there is any problem
if ($_SESSION['addEvent']) {
    // pass form data back to the home page
    $_SESSION['addEvent-data'] = $_POST;
    header('location: add-event.php');
    die();
} else {
    // Combine date and time to create a DATETIME value
    $event_datetime = "{$event_year}-{$event_month}-{$event_day} {$event_timing}";

    // insert the new post into the posts table
    $insert_event_query = "INSERT INTO `events` (`event_title`, `event_desc`, `event_timing`, `user_id`) 
                           VALUES ('$event_title', '$event_desc', '$event_datetime', '$user_id')";

    $insert_event_result = mysqli_query($conn, $insert_event_query);

    if (!$insert_event_result) {
        die("Error: " . mysqli_error($conn));
    }

    // Redirect based on user role
    header("location: index.php");
    die();
}
?>
