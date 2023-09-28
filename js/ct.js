document.addEventListener('DOMContentLoaded', function() {
    let timerInterval;
    let startTime;
    let currentTime;
    let running = false;

    let timerInterval1;

    document.getElementById('start1').addEventListener('click', function() {
        const datetimeInput = document.getElementById('datetime');
        const targetDate = new Date(datetimeInput.value).getTime();

        if (isNaN(targetDate)) {
            alert('Please enter a valid date and time.');
            return;
        }

        const timerElement = document.getElementById('timer1');

        timerInterval1 = setInterval(function() {
            const now = new Date().getTime();
            const distance = targetDate - now;

            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            timerElement.innerHTML = `
                <div>${days} <span>Days</span></div>
                <div>${hours} <span>Hours</span></div>
                <div>${minutes} <span>Minutes</span></div>
                <div>${seconds} <span>Seconds</span></div>
            `;

            if (distance < 0) {
                clearInterval(timerInterval1);
                timerElement.innerHTML = "Countdown Expired";
            }
        }, 1000);
    });

    // Stop the timer if the user wants to reset the countdown
    document.getElementById('datetime').addEventListener('input', function() {
        clearInterval(timerInterval1);
        document.getElementById('timer').innerHTML = '';
    });

    function updateTimer() {
        const timeDifference = currentTime - startTime;
        const hours = Math.floor((timeDifference % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((timeDifference % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((timeDifference % (1000 * 60)) / 1000);

        const timerElement = document.getElementById('timer');
        timerElement.textContent = `${String(hours).padStart(2, '0')}:${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
    }

    function startTimer() {
        if (!running) {
            startTime = new Date().getTime() - (currentTime - startTime);
            timerInterval = setInterval(function() {
                currentTime = new Date().getTime();
                updateTimer();
            }, 1000);
            running = true;
        }
    }

    function stopTimer() {
        if (running) {
            clearInterval(timerInterval);
            running = false;
        }
    }

    function resetTimer() {
        stopTimer();
        startTime = new Date().getTime();
        currentTime = startTime;
        updateTimer();
    }

    function restartTimer() {
        resetTimer();
        startTimer();
    }

    document.getElementById('start').addEventListener('click', startTimer);
    document.getElementById('stop').addEventListener('click', stopTimer);
    document.getElementById('reset').addEventListener('click', resetTimer);
    document.getElementById('restart').addEventListener('click', restartTimer);

    resetTimer(); // Initialize timer
});
