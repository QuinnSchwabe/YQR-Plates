

function updateCSSClassStyle(className, property, value) {
  // Loop through all the stylesheets

  for (let sheet of document.styleSheets) {
    
    try {
      
      // Iterate over the CSS rules in each stylesheet
      for (let rule of sheet.cssRules) {
       
        if (rule.selectorText === className) {
      
          rule.style[property] = "inline-block"; // Update the style of the class
  
        }
      }
    } catch (e) {
      // This handles cross-origin issues that may arise with external stylesheets
      console.error(e);
    }
  }
}

function updateCSSClassStyle2(className, property, value) {
  // Loop through all the stylesheets

  for (let sheet of document.styleSheets) {
 
    try {
      
      // Iterate over the CSS rules in each stylesheet
      for (let rule of sheet.cssRules) {
       
        if (rule.selectorText === className) {
          
          rule.style[property] = "none"; // Update the style of the class
          
        }
      }
    } catch (e) {
      // This handles cross-origin issues that may arise with external stylesheets
      console.error(e);
    }
  }
}
  function priceRange(dropdown){
    const div2 = document.querySelectorAll('.choices__list--single')[1];
    if(dropdown.value === ""){

      div2.classList.remove('reveal');
    }
    else{

      div2.classList.add('reveal');
    }
  }

  function foodType(dropdown){
    const div1 = document.querySelectorAll('.choices__list--single')[0];
    if(dropdown.value === ""){

      div1.classList.remove('reveal');
    }
    else{

      div1.classList.add('reveal');
    }
  }




  $(document).ready(function() {
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
        }, 900, function() {
          // Add hash (#) to URL when done scrolling (default click behavior)
          window.location.hash = hash;
        });
      } // End if
    });
    $(window).scroll(function() {
      $(".slideanim").each(function() {
        var pos = $(this).offset().top;
        var winTop = $(window).scrollTop();
        if (pos < winTop + 600) {
          $(this).addClass("slide");
        }
      });
    });
  })

 