


function slideUpDownForOrderModule($hide_id_1, $hide_id_2 = false, $hide_id_3 = false, $hide_id_4 = false, $hide_id_5 = false, $hide_id_6 = false, $hide_id_7 = false) {
    if ($($hide_id_1).is(":visible") == false) { formReset('updaterecord'); };
    $($hide_id_1).slideToggle();
    $($hide_id_2).slideToggle();
    $($hide_id_3).slideToggle();
    $($hide_id_4).slideToggle();
    $($hide_id_5).slideToggle();
    $($hide_id_6).slideToggle();
    $($hide_id_7).slideToggle();
    return true;
}

function slideUpDownForOrderModuleclose($hide_id_1, $hide_id_2 = false, $hide_id_3 = false, $hide_id_4 = false, $hide_id_5 = false, $hide_id_6 = false, $hide_id_7 = false) {
    if ($($hide_id_1).is(":visible") == false) { formReset('updaterecord'); };
    $($hide_id_1).slideToggle();
    $hide_id_5.is(":visible") == false;
    $($hide_id_2).slideToggle();
    $($hide_id_3).slideToggle();
    $($hide_id_4).slideToggle();
    $($hide_id_5).slideToggle();
    $($hide_id_6).slideToggle();
    $($hide_id_7).slideToggle();
    return true;
} 

  function autocomplete(inp, arr) {
  /*the autocomplete function takes two arguments,
  the text field element and an array of possible autocompleted values:*/
  var currentFocus;
  /*execute a function when someone writes in the text field:*/
  inp.addEventListener("input", function(e) {
      var a, b, i, val = this.value;
      /*close any already open lists of autocompleted values*/
      closeAllLists();
      if (!val) { return false;}
      currentFocus = -1;
      /*create a DIV element that will contain the items (values):*/
      a = document.createElement("DIV");
      a.setAttribute("id", this.id + "autocomplete-list");
      a.setAttribute("class", "autocomplete-items");
      /*append the DIV element as a child of the autocomplete container:*/
      this.parentNode.appendChild(a);
      /*for each item in the array...*/
      for (i = 0; i < arr.length; i++) {
        /*check if the item starts with the same letters as the text field value:*/
        if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
          /*create a DIV element for each matching element:*/
          b = document.createElement("DIV");
          /*make the matching letters bold:*/
          b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
          b.innerHTML += arr[i].substr(val.length);
          /*insert a input field that will hold the current array item's value:*/
          b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
          /*execute a function when someone clicks on the item value (DIV element):*/
          b.addEventListener("click", function(e) {
              /*insert the value for the autocomplete text field:*/
              inp.value = this.getElementsByTagName("input")[0].value;
              /*close the list of autocompleted values,
              (or any other open lists of autocompleted values:*/
              closeAllLists();
          });
          a.appendChild(b);
        }
      }
  });
  /*execute a function presses a key on the keyboard:*/
  inp.addEventListener("keydown", function(e) {
      var x = document.getElementById(this.id + "autocomplete-list");
      if (x) x = x.getElementsByTagName("div");
      if (e.keyCode == 40) {
        /*If the arrow DOWN key is pressed,
        increase the currentFocus variable:*/
        currentFocus++;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 38) { //up
        /*If the arrow UP key is pressed,
        decrease the currentFocus variable:*/
        currentFocus--;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 13) {
        /*If the ENTER key is pressed, prevent the form from being submitted,*/
        e.preventDefault();
        if (currentFocus > -1) {
          /*and simulate a click on the "active" item:*/
          if (x) x[currentFocus].click();
        }
      }
  });
  function addActive(x) {
    /*a function to classify an item as "active":*/
    if (!x) return false;
    /*start by removing the "active" class on all items:*/
    removeActive(x);
    if (currentFocus >= x.length) currentFocus = 0;
    if (currentFocus < 0) currentFocus = (x.length - 1);
    /*add class "autocomplete-active":*/
    x[currentFocus].classList.add("autocomplete-active");
  }
  function removeActive(x) {
    /*a function to remove the "active" class from all autocomplete items:*/
    for (var i = 0; i < x.length; i++) {
      x[i].classList.remove("autocomplete-active");
    }
  }
  function closeAllLists(elmnt) {
    /*close all autocomplete lists in the document,
    except the one passed as an argument:*/
    var x = document.getElementsByClassName("autocomplete-items");
    for (var i = 0; i < x.length; i++) {
      if (elmnt != x[i] && elmnt != inp) {
        x[i].parentNode.removeChild(x[i]);
      }
    }
  }
  /*execute a function when someone clicks in the document:*/
  document.addEventListener("click", function (e) {
      closeAllLists(e.target);
  });
}



function slideUpDownForOrderModuleclose($hide_id_1, $hide_id_2 = false, $hide_id_3 = false, $hide_id_4 = false, $hide_id_5 = false, $hide_id_6 = false, $hide_id_7 = false) {
    if ($($hide_id_1).is(":visible") == false) { formReset('updaterecord'); };
    $($hide_id_1).slideToggle();
    $hide_id_5.is(":visible") == false;
    $($hide_id_2).slideToggle();
    $($hide_id_3).slideToggle();
    $($hide_id_4).slideToggle();
    $($hide_id_5).slideToggle();
    $($hide_id_6).slideToggle();
    $($hide_id_7).slideToggle();
    return true;
}
 
function checknumberletter(input_val)
 {
 var numberletter =/^[A-Za-z0-9\(\)\-&\.\@\#\,\s\-\/]+$/i;
 if(input_val.value.match(numberletter)) 
  {
    console.log('true');
   //pass
  }
else
  { 
   alert("Please enter letters and numbers only."); 
   input_val.value = "";
  }
  };
  
function checkletter(input_val)
{
 var letter =/^[A-Za-z\(\)\-&\.\#\,\s\-\/]+$/i;
 if(input_val.value.match(letter)) 
  {
    console.log('true');
   //pass
  }
else
  { 
   alert("Please enter only letters....!"); 
   input_val.value = "";
  }
  };

 function ValidatePhoneNumber(input_val)
 {
  var phoneno = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;
  if(input_val.value.match(phoneno))
  {
   console.log('Valid Mobile no');
  }
  else
  {
    alert("Invalid Mobile Number..!");
    input_val.value = "";
  }
};

  function checkPassword(input_val)
  {
    var password = /^.*(?=.{8,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%&]).*$/;
    if(password.value.match(input_val))
    {
        console.log('Password true');
    }
    else{
        alert("Password must contain at least 1 capital letter,\n\n1 small letter, 1 number and 1 special character.\n\nFor special characters you can pick one of these -,(,!,@,#,$,),%,<,>..!");
    }   input_val.value = "";
};

