    // function searchTable() {
    //   // Get input and table elements
    //   var input = document.getElementById("searchInput");
    //   var table = document.getElementById("bookTable");
    //   // Get table rows
    //   var rows = table.getElementsByTagName("tr");
    //   // Get search value
    //   var searchValue = input.value.toUpperCase();
    
    //   // Loop through rows and hide those that do not match search value
    //   for (var i = 0; i < rows.length; i++) {
    //     var row = rows[i];
    //     var cols = row.getElementsByTagName("td");
    //     var found = false;
    //     for (var j = 0; j < cols.length; j++) {
    //       var cell = cols[j];
    //       if (cell.innerHTML.toUpperCase().indexOf(searchValue) > -1) {
    //         found = true;
    //         break;
    //       }
    //     }
    //     if (found) {
    //       row.style.display = "";
    //     } else {
    //       row.style.display = "none";
    //     }
    //   }
    // }

    //reserve a book
// Get the reserve book popup and reserve book button
const reserveBookPopup = document.querySelector(".add-book");
const reserveBookBtn = document.querySelector("#show-add-popup");

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

