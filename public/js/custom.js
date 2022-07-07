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

