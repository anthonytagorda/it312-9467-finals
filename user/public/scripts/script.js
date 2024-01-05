/* SCRIPTS FOR USER SIDE */
const allSideMenu = document.querySelectorAll('#sidebar .side-menu.top li a');

allSideMenu.forEach(item=>{
    const li = item.parentElement;

    item.addEventListener('click', function () {
        allSideMenu.forEach(i => {
            i.parentElement.classList.remove('active');
        });
        li.classList.add('active');
    })
});

// TOGGLE SIDEBAR
const menuBar = document.querySelector('#content nav .bx.bx-menu-alt-left');
const sideBar = document.getElementById('sidebar');

menuBar.addEventListener('click', function () {
    sideBar.classList.toggle('hide');
})

// COUNT NUMBER OF RESERVATIONS
// Fetch reservation count
function fetchReservationCount() {
    fetch('/reservationCount')
    .then(response => response.json())
    .then(data => {
        const count = data.count;
        document.querySelector('#reservationCount').innerText = count;
    })
    .catch(error => console.error('Error fetching reservation count:', error));
}

// Call the function initially to set the count
fetchReservationCount();

// Optionally, you can set an interval to periodically update the count
setInterval(fetchReservationCount, 60000);  // Update every 60 seconds 

// LOGOUT MODAL UI
function openLogoutModal() {
    document.getElementById('logoutModal').style.display = 'block';
}

function closeLogoutModal() {
    document.getElementById('logoutModal').style.display = 'none';
}

function logout() {
    window.location.href = "/auth/logout";
}

// DATE FORMAT
function formatDate(dateString) {
    const [datePart, timePart] = dateString.split(' ');
    const [year, month, day] = datePart.split('-');
    const [hour, minute, second] = timePart.split(':');

    return `${year}-${month}-${day} ${hour}:${minute}:${second}`;
}

// RESPONSIVENESS
const searchButton = document.querySelector('#content nav form .form-input button');
const searchForm = document.querySelector('#content nav form');

searchButton.addEventListener('click', function (e) {
    if (window.innerWidth < 576) {
        e.preventDefault();
        searchForm.classList.toggle('show');
        if(searchForm.classList.contains('show')) {
            searchButtonIcon.classList.replace('bx-search', 'bx-x');
        }
    }
})

if(window.innerWidth < 768) {
    sideBar.classList.add('hide');
} else if (window.innerWidth < 576) {
    searchButtonIcon.classList.replace('bx-x', 'bx-search');
    searchForm.classList.remove('show');
}

window.addEventListener('resize', function() {
    if(this.window.innerWidth < 576) {
        searchButtonIcon.classList.replace('bx-x', 'bx-search');
        searchForm.classList.remove('show');
    }
})
