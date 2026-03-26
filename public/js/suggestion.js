
  function myFunc() {
  // Get the checkbox
  var checkBox = document.getElementById("btn-check-2");
  // Get the output text
  var text = document.getElementById("prefences");
  var text2 = document.getElementById("using");

  // If the checkbox is checked, display the output text
  if (checkBox.checked == true){
    text.style.display = "";
    text2.style.display = "none";
  } else {
    text.style.display = "none";
    text2.style.display = "";
  }
}
$(document).ready(function(){
  // Add smooth scrolling to all links in navbar + footer link
  $(".navbar a, footer a[href='#myPage']").on('click', function(event) {
    // Make sure this.hash has a value before overriding default behavior
    if (this.hash !== "") {
      // Prevent default anchor click behavior
      event.preventDefault();

      // Store hash
      var hash = this.hash;

      // Using jQuery's animate() method to add smooth page scroll
      // The optional number (900) specifies the number of milliseconds it takes to scroll to the specified area
      $('html, body').animate({
        scrollTop: $(hash).offset().top
      }, 900, function(){
   
        // Add hash (#) to URL when done scrolling (default click behavior)
        window.location.hash = hash;
      });
    } // End if
  });
})
