<?php
session_start();
require_once 'dbconnect.php';

// Check if the clicked date is provided in the request
// Sanitize and validate the input
$clicked_date_str = $_GET['clicked_date'];
$clicked_date = DateTime::createFromFormat('Y-m-d', $clicked_date_str);
// Check if the date is valid
if ($clicked_date) {
    // Extract year, month, and day from the clicked date
    $clicked_year = $clicked_date->format('Y');
    $clicked_month = $clicked_date->format('m');
    $clicked_day = $clicked_date->format('d');

    // Prepare and execute the SQL query
    $query = "SELECT * FROM events 
              WHERE event_year = $clicked_year
              AND event_month = $clicked_month
              AND event_day = $clicked_day";

    // Execute the query
    $result = mysqli_query($conn, $query);

    // Check if there are any results
    if ($result) {
        $events = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $events[] = $row;
        }

        // Output the events as JSON
        echo json_encode($events);
    } else {
        // Handle query error
        echo json_encode(['error' => 'Error executing the query']);
    }
} else {
    // Handle missing parameter
    echo json_encode(['error' => 'Missing clicked_date parameter']);
}
error_log("Error executing the query: " . mysqli_error($conn));
?>
