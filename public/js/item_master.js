
 window.onload = function() {  
 document.getElementById('Update').style.visibility = 'hidden';    
};

$('#Update').click(function(){    
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
       type:'POST',
       url:"{{ route('storeupdate.item') }}",
       data:$('#updaterecord').serialize(),
       success:function(data){ 
        if(data.status==true)
        {
          alert('Updated Successfully!');
          location.reload(true);
        }        
       },error: function (xhr) {
                        
      }   
    },"json");
});

//------------------------------------------//
  function myfunction(item)
    {  
      document.getElementById('submitbtn').style.visibility = 'hidden';
      document.getElementById('Update').style.visibility = 'visible';
      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
        }
    }); 
     //var id = document.getElementById("categoryid").value; 
        $.ajax({
           type:'POST',
           url:"{{ route('edit.item') }}",
           data:{item:item},
           success:function(data){
            var item =JSON.parse(data);
            document.getElementById("itemid").value=item["id"];
            document.getElementById("myInput").value=item["item_name"];
            document.getElementById("quantity").value=item["quantity"]; 
            document.getElementById("hsn").value=item["hsn"];
            document.getElementById("sku").value=item["sku"];
            document.getElementById("rate_unit").value=item["rate_unit"];
            document.getElementById("itemdisc").value=item["itemdisc"];
            document.getElementById("tax").value=item["tax_rate"];
            document.getElementById("costprice").value=item["costprice"];
            document.getElementById("description").value=item["description"];
            $("#brands option").filter(function(){
              return $(this).attr('value')==item["brand"];
            }).attr('selected',true);
            $("#unit option").filter(function(){
              return $(this).attr('value')==item["unit"];
            }).attr('selected',true);
            $("#category option").filter(function(){
              return $(this).attr('value')==item["category"];
            }).attr('selected',true);
            
          },error: function (xhr) {
                        console.log((xhr.responseJSON.errors));
                    }
                
        },"json");
               
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

//------------------------- Modified ------------------
$(document).ready(function(){
  $('#myInput').focusout(function(){
    if($('#res_im').val() == 'false'){
      $(this).val('');
    }
  });
});
//------------------------- Modified ------------------
function ValidateUserId(){
  setTimeout(function ajaxfun()
    { 
      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    }); 
     var itemname = document.getElementById("myInput").value;
        $.ajax({
           type:'POST',
           url:"{{ route('getitem.name') }}",
           data:{itemname:itemname},
           success:function(data){
            var item =JSON.parse(data); 

            const names = [];
            if(item.length > 0 ){
              
              for(var i = 0; i < item.length; i++) {
                let str1 = item[i].item_name;
                
                if(str1.toLowerCase() == itemname.trimEnd().toLowerCase()){
                  $('#wr_img').show();
                  $('#ch_img').hide();
                  $('#res_im').val('false');
                }
                else 
                {
                  $('#wr_img').hide();
                  $('#ch_img').show();
                  $('#res_im').val('true');
                }
                if(itemname == null || itemname == ""){
                  $('#wr_img').hide();
                  $('#ch_img').hide();
                  $('#res_im').val('false');
                }
                
                let str2 = "("+item[i].id+")"; 
                names[i]=str1
              }
            }else{ 
              if(itemname == null || itemname == ""){
                  $('#wr_img').hide();
                  $('#ch_img').hide();
                  $('#res_im').val('false');
                }else{ $('#ch_img').show(); $('#res_im').val('true');}
             }
            
    autocomplete(document.getElementById("myInput"), names);
           },error: function (xhr) {
                        console.log((xhr.responseJSON.errors));
                    }
        },"json");
               
    });
}




function checkAlert(input_val){
  alert("Only Letters"); 
 var letterNumber = /^[a-zA-Z0-9-() \s]+$/;
 if(!input_val.value.match(letterNumber)) 
  {
    alert("Only letters,-, (), & numbers are allowed."+input_val.value); 
   input_val.value = "";
    
  }

  }



function checkletter(input_val,expression){
  alert("Only Letters"); 
  var letterNumber = /^[a-zA-Z0-9-() \s]+$/;
 if(input_val.value.match(letterNumber)) 
  {
    alert("Only Letters"); 
   input_val.value = "";
  }

  }
