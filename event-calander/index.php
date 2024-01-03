<?php 
session_start();
require_once 'dbconnect.php';
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Dynamic Calendar</title>
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Google Font Link for Icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
    <script src="script.js" defer></script>
  </head>
  <body>
    <div class="wrapper">
      <header>
        <p class="current-date"></p>
        <div class="icons">
          <span id="prev" class="material-symbols-rounded">chevron_left</span>
          <span id="next" class="material-symbols-rounded">chevron_right</span>
        </div>
      </header>
      <div class="content-container">
        <div class="calendar">
          <ul class="weeks">
            <li>Sun</li>
            <li>Mon</li>
            <li>Tue</li>
            <li>Wed</li>
            <li>Thu</li>
            <li>Fri</li>
            <li>Sat</li>
          </ul>
          <ul class="days"></ul>
        </div>
      </div>
    </div>
    <div class="wrapper-details">
      <div class="event-details">
       
        <div class="event-details-content">
          <h2 class="event-title"></h2>
          <p class="event-description"></p>
          <p class="event-time"></p>

       
          <div class="teacher-info">
            <!-- <img src="teacher-profile-image.jpg" alt="Teacher Profile Image" class="teacher-profile-img"> -->
            <p class="teacher-name"></p>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
