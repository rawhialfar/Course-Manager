// Function to add dynamic content to a html element based on id
function loadDynamicContent(filename, htmlId) {
  $.ajax({
    url: `/src/php/${filename}`,
    method: "GET",
    success: function (data) {
      $(`#${htmlId}`).html(data);
    },
  });
}
function rollDice() {
  $.ajax({

      type: "POST",
      url: "/src/php/rawhi_script.php", 
      success: function(response) {
        
        $("#diceResult").html(response);
      }
  });
}

function changeRectColor(scriptName, elementId) {
    $.ajax({

        type: "POST",
        url: `/src/php/${scriptName}`, 
        success: function(response) {
          
          $(`.${elementId}`).html(response);
        }
    });
}

function changeNav() {
    if (window.scrollY >= 400) {
        $(`.header`).css("background-color","#c20431");
    } else $(`.header`).css("background-color","transparent");
}

window.addEventListener("scroll", changeNav);