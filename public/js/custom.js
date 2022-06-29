// function for Toggle show & hide ---> pass parameters = id_or_class_element 
function slideUpDown($hide_id_1, $hide_id_2 = false, $hide_id_3 = false, $hide_id_4 = false, $hide_id_5 = false, $hide_id_6 = false, $hide_id_7 = false,$hide_id_8=false) {
    if ($($hide_id_1).is(":visible") == false) { formReset('submitInvoice'); };
    $($hide_id_1).slideToggle();
    $($hide_id_2).slideToggle();
    $($hide_id_3).slideToggle();
    $($hide_id_4).slideToggle();
    $($hide_id_5).slideToggle();
    $($hide_id_6).slideToggle();
    $($hide_id_7).slideToggle();
    $($hide_id_8).slideToggle();
    return true;
}
function slideUpDownForCompanyRegisterModule($hide_id_1, $hide_id_2 = false, $hide_id_3 = false, $hide_id_4 = false, $hide_id_5 = false, $hide_id_6 = false, $hide_id_7 = false) {
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

function slideUpDownForCompanyRegisterModuleclose($hide_id_1, $hide_id_2 = false, $hide_id_3 = false, $hide_id_4 = false, $hide_id_5 = false, $hide_id_6 = false, $hide_id_7 = false) {
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

function inputFilter(textbox_id = false, inputFilter = false) {

    //Readme first
    // inputFilter = INT,FLOAT, A-Z0-9, A-Z_0-9, NAME, NUMBER, A-Z, _A-Z , 0-9, _0-9
    //----------------------------------------------------------------------
    // "_" for whitespace and "-" for Range 
    //-------------------------------------

    if (textbox_id != false && inputFilter != false) {

        switch (inputFilter) {
            case 'INT':
                inputFilter = /^-?\d*$/;
                break;
            case 'FLOAT':
                inputFilter = /^-?\d*[.,]?\d*$/;
                break;
            case 'A-Z0-9':
                inputFilter = /^[a-z0-9]*$/i;
                break;
            case 'A-Z_0-9':
                inputFilter = /^[ a-z0-9]*$/i;
                break;
            case 'NAME':
                inputFilter = /^[ a-z0-9]*$/i;
                break;
            case 'A-Z':
                inputFilter = /^[a-z]*$/i;
                break;
            case '_A-Z':
                inputFilter = /^[ a-z]*$/i;
                break;
            case '0-9':
                inputFilter = /^[0-9]*$/;
                break;
            case 'NUMBER':
                inputFilter = /^[0-9]*$/i;
                break;
            case '_0-9':
                inputFilter = /^[ 0-9]*$/;
                break;
            case '_NUMBER':
                inputFilter = /^[ 0-9]*$/i;
                break;
            case 'MIX1':
                inputFilter = /^[ a-z0-9_\-\()@#$&]*$/i;
                break;
        }

        ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"].forEach(function(event) {
            document.getElementById(textbox_id).addEventListener(event, function() {
                if (inputFilter.test(document.getElementById(textbox_id).value) == true) {
                    this.oldValue = this.value;
                    this.oldSelectionStart = this.selectionStart;
                    this.oldSelectionEnd = this.selectionEnd;
                } else if (this.hasOwnProperty("oldValue")) {
                    this.value = this.oldValue;
                    this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
                } else {
                    this.value = "";
                }
            });
        });
    }
}

function is_valid(input_val = false, filter_type = false) {
    //Readme first
    // filter_type = INT,FLOAT, A-Z0-9, A-Z_0-9, NAME, NUMBER, A-Z, _A-Z , 0-9, _0-9
    //----------------------------------------------------------------------
    // "_" for whitespace and "-" for Range 
    //-------------------------------------

    if (input_val != false && filter_type != false) {

        switch (filter_type) {
            case 'INT':
                filter_type = /^[0-9]*$/i;
                break;
            case 'FLOAT':
                filter_type = /^-?\d*[.]?\d*$/;
                break;
            case 'A-Z0-9':
                filter_type = /^[a-z0-9]*$/i;
                break;
            case 'A-Z_0-9':
                filter_type = /^[ a-z0-9]*$/i;
                break;
            case 'NAME':
                filter_type = /^[ a-z0-9]*$/i;
                break;
            case 'A-Z':
                filter_type = /^[a-z]*$/i;
                break;
            case '_A-Z':
                filter_type = /^[ a-z]*$/i;
                break;
            case '0-9':
                filter_type = /^[0-9]*$/;
                break;
            case 'NUMBER':
                filter_type = /^[0-9]*$/i;
                break;
            case '_0-9':
                filter_type = /^[ 0-9]*$/;
                break;
            case '_NUMBER':
                filter_type = /^[ 0-9]*$/i;
                break;
        }

        if (filter_type.test(input_val) == true) {
            return true;
        } else {
            return false;
        }

    }

}

function autocomplete(inp, arr, arr2 = false, function_name = '', element_id = '') {
    /*the autocomplete function takes two arguments,
    the text field element and an array of possible autocompleted values:*/

    var currentFocus;
    /*execute a function when someone writes in the text field:*/
    inp.addEventListener("input", function(e) {
        var a, b, i, val = this.value;
        /*close any already open lists of autocompleted values*/
        closeAllLists();
        if (!val) { return false; }
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
                b.setAttribute("id", this.id + "autocomplete-list");
                b.setAttribute("onclick", function_name + "('" + arr2[i] + "','" + element_id + "')");
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
        //console.log(x);
        //alert(x);
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
        if (currentFocus >= 0)
            removeActive(x);
        // if (currentFocus >= x.length) currentFocus = 0;
        // if (currentFocus < 0) currentFocus = (x.length - 1);
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
    document.addEventListener("click", function(e) {
        closeAllLists(e.target);
    });
}

function VerifyItem(itemname, element_id) {
    var focused = element_id;
    focused = focused.replace('itemname', '');
    if (focused == 'NaN') { focused = ''; }
    var inputid = focused;

    var itemid = "";
    var itemmatch = itemname.match(/(\d+)/);
    if (itemmatch) {
        itemid = itemmatch[0];
    }
    $('#' + element_id).attr('data-error', 'item');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'POST',
        url: GET_PRO_RATE,
        data: { itemid: itemid },
        success: function(data) {
            var itemrate = JSON.parse(data);
            //var dta=JSON.stringify(itemrate);
            if (itemrate.id != null) {
                document.getElementById('itemcode' + inputid).value = itemrate.item_code;
                document.getElementById('packagingunit' + inputid).value = itemrate.packagingunit;
                document.getElementById('Taxrate' + inputid).value = itemrate.tax_rate;
                document.getElementById('itemid' + inputid).value = itemrate.id;

                document.getElementById('item_tax' + inputid).value = itemrate.hsncode;
                document.getElementById('rate' + inputid).value = itemrate.rate_unit;
                document.getElementById('iteminput_img' + inputid).src = CHECK_IMG;
                document.getElementById('iteminput_img' + inputid).style.display = "block";
                $('#' + element_id).attr('data-error', 'ok');
            }
        },
        error: function(xhr) {

        }
    }, "json");
}

function FillItem(itmname, imgname) {
    var focused = itmname;
    focused = focused.replace('itemname', '');
    if (focused == 'NaN') { focused = ''; }
    var inputid = focused;
    $('#' + itmname).attr('data-error', 'item');

    document.getElementById('iteminput_img' + inputid).src = WRONG_IMG;
    document.getElementById('iteminput_img' + inputid).style.display = "block";
    $('#rate' + inputid).val('');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var itemname = document.getElementById(itmname).value;
    $.ajax({
        type: 'POST',
        url: AUTO_ITEM,
        data: { itemname: itemname },
        success: function(data) {
            var item = JSON.parse(data);
            // console.log(item);
            const names = [];
            const ids = [];
            // const icodes = [];
            for (var i = 0; i < item.length; i++) {
                //let icode = item[i].item_code;
                let iname_icode = item[i].item_name + " (" + item[i].item_code + ") ";
                let str1 = iname_icode;
                //let str1 = item[i].item_name;
                let str2 = item[i].id;
                names[i] = str1;
                ids[i] = str2;
              //  console.log(str1);
            }
            autocomplete(document.getElementById(itmname), names, ids, 'VerifyItem', itmname);
        },
        error: function(xhr) {

        }

    }, "json");
}

//filter Item by code
function FillItembyCode(itemcode, imgname) {
  
    var focused = itemcode;
  focused = focused.replace('itemcode', '');
    if (focused == 'NaN') { focused = ''; }
    var inputid = focused;
    $('#' + itemcode).attr('data-error', 'item');

    //document.getElementById('itemcodeinput_img' + inputid).src = WRONG_IMG;
    //document.getElementById('itemcodeinput_img' + inputid).style.display = "block";

    $('#rate' + inputid).val('');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var i_code = document.getElementById(itemcode).value;
    //alert(itemcode);
    $.ajax({
        type: 'POST',
        url: AUTO_ITEM,
        data: { itemcode: i_code },
        success: function(data) {
            var item = JSON.parse(data);
            console.log(item);
            const names = [];
            const ids = [];
            // const icodes = [];
            for (var i = 0; i < item.length; i++) {
                let str1 = item[i].item_code;
                // let iname_icode = item[i].item_name + " (" + item[i].item_code + ") ";
                // let str1 = iname_icode;
                //let str1 = item[i].item_name;
                let str2 = item[i].id;
                names[i] = str1;
                ids[i] = str2;
                //console.log(str1);
            }
            //alert(document.getElementById(itemcode));
            autocomplete(document.getElementById(itemcode), names, ids, 'VerifyItemCode', itemcode);
        },
        error: function(xhr) {

        }

    }, "json");
}

function VerifyItemCode(itemcode, element_id) {
    var focused = element_id;
    focused = focused.replace('itemcode', '');
    if (focused == 'NaN') { focused = ''; }
    var inputid = focused;

    var itemid = "";
    var itemmatch = itemcode.match(/(\d+)/);
    if (itemmatch) {
        itemid = itemmatch[0];
    }
    $('#' + element_id).attr('data-error', 'item');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'POST',
        url: GET_PRO_RATE,
        data: { itemid: itemid },
        success: function(data) {
            var itemrate = JSON.parse(data);
            debugger;
            //var dta=JSON.stringify(itemrate);
            if (itemrate.id != null) {
                document.getElementById('itemname' + inputid).value = itemrate.item_name;
             //   document.getElementById('packagingunit' + inputid).value = itemrate.packagingunit;
                document.getElementById('Taxrate' + inputid).value = itemrate.tax_rate;
                document.getElementById('itemid' + inputid).value = itemrate.id;

                document.getElementById('item_tax' + inputid).value = itemrate.hsncode;
                document.getElementById('rate' + inputid).value = itemrate.rate_unit;
                document.getElementById('iteminput_img' + inputid).src = CHECK_IMG;
                document.getElementById('iteminput_img' + inputid).style.display = "block";
                $('#' + element_id).attr('data-error', 'ok');
            }
        },
        error: function(xhr) {

        }
    }, "json");
}

//End Filter Item BY Code



//----------Order no autofill------------
function ValidateOrderNo() {
    $('#cus_name').val('');
    $('#cus_orders').hide();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var order_no = document.getElementById("order_no").value;
    $.ajax({
        type: 'POST',
        url: GET_ORDER_NO,
        data: { order_no: order_no },
        success: function(data) {
            autocomplete(document.getElementById("order_no"), JSON.parse(data));
        },
        error: function(xhr) {}
    }, "json");
}

//---------------------Validation Functions-------------------------------


function formReset(form_element_id = false) {
    $('#taxapplied').html('0)');
    $('#totalamount').html('0)');
    if (form_element_id != false) {
        document.getElementById(form_element_id).reset();
    }
    $('#' + form_element_id + ' select').html("");
    $('#dynamic_field .btn_remove').click();
    $('#is_update').val(0);
}

function checkMobileNo($element_is, $alert_msg = true) {
    var x = $($element_is).val();
    if ($.isNumeric(x) == true && x.length == 10) {
        return true;
    } else { if ($alert_msg == true) { alert('Invalid Mobile Number..!'); } return false; }
}