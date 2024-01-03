const daysTag = document.querySelector(".days"),
  currentDate = document.querySelector(".current-date"),
  prevNextIcon = document.querySelectorAll(".icons span");

// getting new date, current year and month
let date = new Date(),
  currYear = date.getFullYear(),
  currMonth = date.getMonth() + 1; // Adjusted to match database representation

// storing full name of all months in array
const months = [
  "", // Leave an empty string at index 0 since JavaScript months are zero-based
  "January",
  "February",
  "March",
  "April",
  "May",
  "June",
  "July",
  "August",
  "September",
  "October",
  "November",
  "December",
];

const renderCalendar = () => {
  let firstDayofMonth = new Date(currYear, currMonth - 1, 1).getDay(),
    lastDateofMonth = new Date(currYear, currMonth, 0).getDate(),
    lastDayofMonth = new Date(currYear, currMonth - 1, lastDateofMonth).getDay(),
    lastDateofLastMonth = new Date(currYear, currMonth - 1, 0).getDate();
  let liTag = "";

  for (let i = firstDayofMonth; i > 0; i--) {
    liTag += `<li class="inactive">${lastDateofLastMonth - i + 1}</li>`;
  }

  for (let i = 1; i <= lastDateofMonth; i++) {
    let isToday =
      i === date.getDate() &&
      currMonth === date.getMonth() + 1 &&
      currYear === date.getFullYear()
        ? "active"
        : "";
    liTag += `<li class="${isToday}" data-day="${i}">${i}</li>`;
  }

  for (let i = lastDayofMonth; i < 6; i++) {
    liTag += `<li class="inactive">${i - lastDayofMonth + 1}</li>`;
  }
  currentDate.innerText = `${months[currMonth]} ${currYear}`;
  daysTag.innerHTML = liTag;
// Add this function to format the date
function formatDate(date) {
    const year = date.getFullYear();
    const month = String(date.getMonth() + 1).padStart(2, '0'); // Adjust month format
    const day = String(date.getDate()).padStart(2, '0'); // Adjust day format
    return `${year}-${month}-${day}`;
  }

  
  // Add event listeners to each date element
  const dateElements = document.querySelectorAll(".days li");
  dateElements.forEach((dateElement) => {
    dateElement.addEventListener("click", () => {
      const clickedDate = dateElement.dataset.day;

      // Make an AJAX request to get event details for the clicked date
      fetch(`get_events.php?clicked_date=${clickedDate}`)
        .then((response) => response.json())
        .then((data) => {
          // Handle the returned data, e.g., update UI with event details
          console.log(data);

          // Add your logic here to display event details on the UI
          updateEventDetails(data);
        })
        .catch((error) => console.error("Error fetching events:", error));
    });
  });
};

// Helper function to update the event details on the UI
function updateEventDetails(events) {
  const eventDetailsContainer = document.querySelector(".event-details-content");

  if (events.length > 0) {
    const firstEvent = events[0];
    eventDetailsContainer.innerHTML = `
      <h2 class="event-title">${firstEvent.event_title}</h2>
      <p class="event-description">${firstEvent.event_desc}</p>
      <p class="event-time">${firstEvent.event_time}</p>
      <div class="teacher-info">
        <img src="teacher-profile-image.jpg" alt="Teacher Profile Image" class="teacher-profile-img">
        <p class="teacher-name">${firstEvent.teacher_name}</p>
      </div>
    `;
  } else {
    eventDetailsContainer.innerHTML = "No events for this date.";
  }

  document.querySelector(".wrapper-details").style.display = "block";
}

renderCalendar();

prevNextIcon.forEach((icon) => {
  icon.addEventListener("click", () => {
    currMonth = icon.id === "prev" ? currMonth - 1 : currMonth + 1;

    if (currMonth < 1) {
      currMonth = 12;
      currYear--;
    } else if (currMonth > 12) {
      currMonth = 1;
      currYear++;
    }

    renderCalendar();
  });
});
