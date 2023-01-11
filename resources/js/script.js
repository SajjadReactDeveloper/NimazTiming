AOS.init();

$(function () {
  $(".main__hijri-date").hijriDate();
});

// Get Current Date
var today = new Date();
$(".main__english-date").text(today.toDateString());

// Get Current Time
function updateTime() {
  var currentTime = new Date();
  var hours = currentTime.getHours();
  var minutes = currentTime.getMinutes();
  var seconds = currentTime.getSeconds();
  var ampm = hours >= 12 ? "PM" : "AM";
  hours = hours > 12 ? hours - 12 : hours;
  hours = hours == 0 ? 12 : hours;
  var time = hours + ":" + minutes + ":" + seconds + " " + ampm;
  $(".main__current-time").text(time);
}
setInterval(updateTime, 1000);

const getTimeDifference = () => {
  var targetHours = 5;
  var targetMinutes = 0;
  var targetSeconds = 0;

  // Get the current time
  var currentTime = new Date();
  var currentHours = currentTime.getHours();
  var currentMinutes = currentTime.getMinutes();
  var currentSeconds = currentTime.getSeconds();

  // Calculate the time difference
  var hoursDifference = targetHours - currentHours;
  var minutesDifference = targetMinutes - currentMinutes;
  var secondsDifference = targetSeconds - currentSeconds;

  // If the difference is negative, add 24 hours (86400 seconds)
  if (
    hoursDifference < 0 ||
    (hoursDifference == 0 && minutesDifference < 0) ||
    (hoursDifference == 0 && minutesDifference == 0 && secondsDifference < 0)
  ) {
    hoursDifference += 24;
  }
  if (minutesDifference < 0) {
    minutesDifference += 60;
  }
  if (secondsDifference < 0) {
    secondsDifference += 60;
    minutesDifference -= 1;
  }

  // Format the time difference as a string
  var timeDifference =
    hoursDifference +
    " hours, " +
    minutesDifference +
    " minutes, " +
    secondsDifference +
    " seconds";
  $(".main__remaining-time").text(timeDifference);
};

setInterval(getTimeDifference, 1000);
