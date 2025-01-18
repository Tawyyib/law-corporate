
// Function to run counters sequentially with an initial delay without the counterUp dependency
function runSequentialCounters(counters, index = 0, startDelay = 0) {

  // Check if there are more counters left to animate
  if (index < counters.length) {

    const currentCounter = counters[index];
    const startValue = 0;
    const endValue = parseInt(currentCounter.getAttribute('data-count'));
    const interval = 1000;
    const duration = Math.floor(interval / endValue);

     // Set a timeout to start the counter after the specified start delay
    setTimeout(() => {
      // Initialize start value and interval
      let currentValue = startValue;

      // Set up an interval to update the counter
      let counterInterval = setInterval(() => {
        currentValue += 1; // Increment the value
        currentCounter.textContent = currentValue; // Update the display
        if (currentValue >= endValue) { // Stop when reaching the end value
          clearInterval(counterInterval);
        }
      }, duration);

      // Set a timeout to start the next counter after the current one finishes
      setTimeout(() => {
        runSequentialCounters(counters, index + 1, startDelay);  // Move to the next counter
      }, ); // Ensure the next counter starts after the current one finishes
    }, startDelay);  // Apply the initial delay before starting the counter
  }
}

// Create an IntersectionObserver to trigger the counters when they come into view
const callback = (entries, observer) => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      const counters = document.querySelectorAll('.counter');
      runSequentialCounters(counters, 0, 500); // Start the counters with a 1000ms delay
      observer.disconnect(); // Stop observing after triggering the counters
    }
  });
};

// Create an IntersectionObserver instance with a threshold of 1 (fully visible)
const IO = new IntersectionObserver(callback, { threshold: 1 });

// Select all counters and observe them
const counters = document.querySelectorAll('.counter');
counters.forEach(counter => {
  IO.observe(counter);
});

