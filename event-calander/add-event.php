<?php session_start();
require_once 'dbconnect.php';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Add Event</title>
    <link rel="stylesheet" href="../assests/css/library_managment.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
  </head>
  <body>
    
  <?php 
  // require_once '../partials/second_nav.php';
   ?>

<section
class="form__section">
<div class="container form__section-container">
     <h2>Add Event</h2>
     <?php if (isset($_SESSION['addEvent'])) :  ?>
      <div class="error-message">
        <p>
          <?= $_SESSION['addEvent'];
      unset($_SESSION['addEvent']);
     ?>
     </p>
    </div>
      <?php endif ?>
<form action="/event-calander/add_event_logic.php" enctype="multipart/form-data" method="POST">
<input type="text" placeholder="Event Title" name="event_title">
<textarea  rows="10" placeholder="Event Description" name="event_desc"></textarea>
<input type="date" placeholder="Date" name="event_date">
<input type="text" placeholder="Time" name="event_time">
<input type="text" placeholder="Assign Teacher" name="user_id">
<button type="submit" class="btn" name="event_button">Add Event</button>
</form>
</div>
</section>

<!-- ===========Form ENDS HERE============= -->
</body>
</html>

</body>
</html>
