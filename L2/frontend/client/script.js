// js code to scroll 
const container = document.querySelector('.cards-container');
const prevButton = document.querySelector('.prev');
const nextButton = document.querySelector('.next');

let scrollAmount = 0;
const cardWidth = document.querySelector('.card').offsetWidth + 20;

function scrollCards(direction) {
  scrollAmount += direction * cardWidth;
  container.scrollTo({
    top: 0,
    left: scrollAmount,
    behavior: 'smooth'
  });
  
  checkScrollButtons();
}

function checkScrollButtons() {
  prevButton.disabled = scrollAmount === 0;
  nextButton.disabled = scrollAmount === (container.scrollWidth -
    (document.documentElement.clientWidth + 1)); 
    container.style.overflowY = 'hidden';
    }
    checkScrollButtons();
    prevButton.addEventListener('click', () => scrollCards(-1));
    nextButton.addEventListener('click', () => scrollCards(1));


// js code function for request book borrow popup

const borrowBtn = document.getElementById("borrow-request-btn");
const popup = document.querySelector(".borrow-request-popup");
const closeBtn = document.querySelector(".close");

borrowBtn.addEventListener("click", function() {
  popup.style.display = "block";
});

closeBtn.addEventListener("click", function() {
  popup.style.display = "none";
});


//reserve a book
// Get the reserve book popup and reserve book button
const reserveBookPopup = document.querySelector(".reserve-book-popup");
const reserveBookBtn = document.querySelector("#reserve-book-btn");

// Get the close button for the popup
const closePopupBtn = document.querySelector(".close-popup-btn");

// When the user clicks the reserve book button, show the popup
reserveBookBtn.addEventListener("click", function() {
  reserveBookPopup.style.display = "block";
});

// When the user clicks the close button or outside the popup, hide the popup
closePopupBtn.addEventListener("click", function() {
  reserveBookPopup.style.display = "none";
});

window.addEventListener("click", function(event) {
  if (event.target === reserveBookPopup) {
    reserveBookPopup.style.display = "none";
  }
});






    