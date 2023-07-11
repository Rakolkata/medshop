@extends('layouts.admin.app')
@push('title')
<title>Medshop | Create-Order</title>
@endpush


@section('content')

<form action="{{route('admin.order_store')}}" method="post">
  @csrf
  <div class="customerInfo">
    <div class="container">
      <h2>Customer Info:</h2>
      <div class="ciRow3">
        <div class="ciCol"><label>Name</label><input type="text" name="coustomer_name" required /></div>
        <div class="ciCol"><label>Phone</label><input type="text" name="coustomer_phone" required /></div>
        <div class="ciCol"><label>Email</label><input type="email" name="coustomer_email" required /></div>
      </div>

      <div class="ciRow2">
        <div class="ciCol"><label>Address</label><textarea name="customer_address" required></textarea></div>
        <div class="ciCol"><label>Dr. Name/Reg. No.</label><textarea name="doc_name_regdno"></textarea></div>
      </div>
    </div>
  </div>
  <div class="row">
    Search
    <div class="col-md-12">
      <input name="product" id="seachprodduct" type="text" placeholder="Seach your product" style="padding:5px; margin-bottom:15px;" />
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="form-group">
        <table class="table table-striped ">

          <thead style="background-color: #60b5ba;color:#fff">

            <tr>
              <th scope="col">#</th>
              <th scope="col">Name</th>
              <th scope="col" style="display:none">Id</th>
              <th scope="col">MRP</th>
              <th scope="col">Batch No.</th>
              <th scope="col">Exp. Dt</th>
              <th scope="col">Qty</th>
              <th scope="col">Rate</th>
              <th scope="col">Discount (%)</th>
              <th scope="col" style="display:none">Subtotal</th>
              <th scope="col">GST</th>
              <th scope="col">Total (inc. GST)</th>
              <th scope="col">Total (after Dis.)</th>
              <th scope="col">Delete Row</th>
            </tr>
          </thead>
          <tbody id="table">

          </tbody>
        </table>
      </div>
    </div>
    <div class="col-md-6">
    </div>
    <div class="col-md-6">
      <div class="row">
        <div class="col-md-6">
          <ul style="text-align: right;list-style-type:none">
            <li class="mt-2" style="display:none">SubTotal</span></li>
            <li class="mt-2">Discount</li>
            <li class="mt-2">Taxable Amount</li>
            <li class="mt-2">Tax (GST)</li>
            <li class="mt-2">Rand Off</li>
            <li class="mt-2">Grand Total</li>
          </ul>
        </div>
        <div class="col-md-6">
          <ul style="text-align: right;list-style-type:none">
            <li class="p-1"><input type="number" name="total_discount" id="total_discount" readonly style="border:none"></li>
            <li class="p-1"><input type="number" name="total_taxable_amount" id="total_taxable_amount" readonly style="border:none"></li>
            <li class="p-1"><input type="number" name="total_gst" id="total_gst" readonly style="border:none"></li>
            <li class="p-1"><input type="number" name="round_off" id="round_off" readonly style="border:none"></li>
            <li class="p-1"><input type="number" name="grand_total" id="grand_total" readonly style="border:none"></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div style="text-align:right">
    <button class="btn text-white" style="background: #60b5ba">Save Order</button>
  </div>
</form>
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css" integrity="sha384-b6lVK+yci+bfDmaY1u0zE8YYJt0TZxLEAFyYSLHId4xoVvsrQu3INevFKo+Xir8e" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script>
  function array_sum(array) {
    // console.log(array,"testttt");
    let sum = 0;

    for (const value of Object.values(array)) {
      sum += value;
    }
    return sum;
  }

  let totals = [];
  let gstValues = [];
  let discounts = [];

  $(function() {

    function log(message) {
      $("#table").append(message);
    }

    $("#seachprodduct").autocomplete({
      source: "{{ route('admin.prod_name') }}",
      dataType: "json",
      minLength: 2,
      select: function(event, ui) {
        console.log(event, "event");
        console.log(ui, "ui");
        let productV = ui.item.values.product_veriant;
        // console.log(productV, "fr3fr");
        let category = ui.item.values.category;
        var category1 = 0;
        if (category.length > 0) {
          if (category[0].Gstrate) {
            var category1 = category[0].Gstrate;
            console.log(typeof category1);
          } else if (category[0].Gstrate == null) {
            var category1 = 0;
            console.log(typeof category1);
          } else if (category[0].Gstrate == 'NULL') {
            var category1 = 0;
            console.log(typeof category1);
          } else if (category[0].Gstrate == '') {
            var category1 = 0;
            console.log(typeof category1);
          } else {
            var category1 = 0;
            console.log(typeof category1);
          }
        } else {
          var category1 = 0;
        }

        var mrp_default = 0;
        var default_strip = 0;
        var default_batch = 'Null';
        var default_expdate = 0000 - 00 - 00;
        if (productV.length > 0) {
          if (productV[0].mrp_per_unit) {
            mrp_default = productV[0].mrp_per_unit;
          } else if (productV[0].mrp_per_unit == null) {
            mrp_default = 0;
          } else if (productV[0].mrp_per_unit == 'NULL') {
            mrp_default = 0;
          } else {
            mrp_default = 0;
          }

          if (productV[0].strip) {
            default_strip = productV[0].strip;
          } else if (productV[0].strip == null) {
            default_strip = 0;
          } else if (productV[0].strip == 'NULL') {
            default_strip = 0;
          } else {
            default_strip = 0;
          }

          if (productV[0].batch) {
            default_batch = productV[0].batch;
          } else if (productV[0].batch == '') {
            default_batch = 'Null';
          } else {
            default_batch = 'Null';
          }

          if (productV[0].expdate) {
            default_expdate = productV[0].expdate;
          } else {
            default_expdate = 0000 - 00 - 00;
          }
        } else {
          mrp_default = 0;
          default_strip = 0;
          default_batch = 'Null';
          default_expdate = 0000 - 00 - 00;
        }
        // var grand_total_value = 0;

        let rowId = Date.now(); // generate a unique identifier for the row
        let newRow = $("<tr>", {
          "id": rowId
        }); // add the identifier to the new row
        if (productV.length > 0) {
          newRow.append("<td></td><td style='display:none'><input type='number' step='any' name='id[]' class='id' value='" + productV[0].pid + "' /></td><td>" + ui.item.value + "</td><td style='display:none'><input type='text' name='title[]' class='title' value='" + ui.item.label + "' /></td><td>" +
            mrp_default * default_strip + "</td><td><input type='text' name='batch_no[]' class='id' value='" +
            default_batch + "' readonly/></td><td>" +
            default_expdate + "</td>" +
            "<td><input type='number' step='any' id='" + productV[0].pid + "' name='qty[]' value=1 min=1 /></td><td>" +
            mrp_default + "</td><td style='display:none'><input type='number' step='any' name='rate[]' class='rate' value='" + mrp_default + "' /></td><td> <input type='number' step='any' name='discount[]' class='discount' min=0 max=10 value=0 /></td><td>" + category1 + "</td><td><input type='number' step='any' name='gst[]' class='gst' value='" + parseInt(mrp_default) * parseInt(category1) / 100 + "' readonly ></td><td><input type='number' step='any' name='total[]' class='total' value='" + mrp_default + "' ></td><td><i class='bi bi-trash3-fill' id='delete" + rowId + "' style='cursor: pointer; color: red;'></i></td></tr>");
          $("#table").append(newRow);
          // $("#no_data_row").remove();
          totals[rowId] = mrp_default;
          gstValues[rowId] = parseInt(mrp_default) * parseInt(category1) / 100;
          discounts[rowId] = 0;
          let grandTotal = array_sum(totals)
          grandTotal = parseFloat(grandTotal).toFixed(2);
          // console.log(totals)
grandTotal = Math.round(grandTotal * 100) / 100;
          // var grand_total = array_sum(totals);
          // if (grand_total) {
          //   grand_total_value = grand_total;
          // } else {
          //   grand_total_value = 00;
          // }
          $("#total_taxable_amount").val(grandTotal);
          $("#total_gst").val(array_sum(gstValues));
          $("#total_discount").val(array_sum(discounts));
          $("#round_off").val(grandTotal - (grandTotal));
          $("#grand_total").val(grandTotal);
        } else {
          // newRow.append("<td id='no_data_row' colspan=12 class='text_center'>This Product is not in stock.</td>");
          // $("#table").append(newRow);
          window.alert("This Product is not in Stock.");
        }

        $(document).on('change', '#' + rowId + ' .discount', function() { // listen to changes on the discount input of the corresponding row
          let discount = $(this).val();
          if (discount > 10) { // limit discount to 10%
            discount = 10;
            $(this).val(discount); // update the value of the discount input to reflect the limit
          }
          $(this).val(discount); // update the value of the discount input to reflect the limit
          let price = mrp_default;
          let qty = $(this).closest('tr').find("input[name='qty[]']").val();
          let subtotal = price * qty * (1 - discount / 100);
          subtotal = parseFloat(subtotal).toFixed(2)
          subtotal = Math.round(subtotal  * 100) / 100
          $(this).closest('tr').find(".total").text(subtotal); // update the total for the corresponding row
          $(this).closest('tr').find(".total").val(subtotal);
          let gstRate = category1;
          let gstAmount = subtotal * gstRate / 100;
          gstAmount =  parseFloat(gstAmount).toFixed(2)
          gstAmount = Math.round(gstAmount  * 100) / 100
          $(this).closest('tr').find(".gst").text(gstAmount);
          // $(this).closest('tr').find(".gst").val(gstAmount);
          // let index = totals.indexOf(rowId);
          totals[rowId] = subtotal;
          gstValues[rowId] = gstAmount;
          discounts[rowId] = (price * qty) - subtotal;
          let grandTotal = array_sum(totals)
          grandTotal = parseFloat(grandTotal).toFixed(2);
          grandTotal = Math.round(grandTotal * 100) / 100;

          let Discounts= array_sum(discounts)
          Discounts = parseFloat(Discounts).toFixed(2);
          Discounts = Math.round(Discounts * 100) / 100;
          $("#total_taxable_amount").val(grandTotal);
          $("#total_gst").val(array_sum(gstValues));
          $("#total_discount").val(Discounts);
          $("#round_off").val(grandTotal - (grandTotal));
          $("#grand_total").val(grandTotal);

        });

        $(document).on('click', '#delete' + rowId, function() {
          $('#table #' + rowId).remove();
        });

        $(document).on('change', '#' + rowId + ' input[name="qty[]"]', function() { // listen to changes on the quantity input of the corresponding row
          let qty = $(this).val();
          let price = mrp_default;
          let discount = $(this).closest('tr').find(".discount").val();
          if (discount > 10) { // limit discount to 10%
            discount = 10;
            $(this).closest('tr').find(".discount").val(discount); // update the value of the discount input to reflect the limit
          }
          $(this).closest('tr').find(".discount").val(discount); // update the value of the discount input to reflect the limit
          let subtotal = price * qty * (1 - discount / 100);
          subtotal = parseFloat(subtotal).toFixed(2)
          subtotal = Math.round(subtotal  * 100) / 100
          $(this).closest('tr').find(".total").text(subtotal); // update the total for the corresponding row
          $(this).closest('tr').find(".total").val(subtotal);
          let gstRate = category1;
          let gstAmount = subtotal * gstRate / 100;
          $(this).closest('tr').find(".gst").text(gstAmount);
          $(this).closest('tr').find(".gst").val(gstAmount);
          // let index = totals.indexOf(rowId);
          
          totals[rowId] = subtotal;
          gstValues[rowId] = gstAmount;
          discounts[rowId] = (price * qty) - subtotal;
          let grandTotal = array_sum(totals)
          grandTotal = parseFloat(grandTotal).toFixed(2);
          console.log(totals)

grandTotal = Math.round(grandTotal * 100) / 100;
          $("#total_taxable_amount").val(grandTotal);
          $("#total_gst").val(array_sum(gstValues));
          $("#total_discount").val(array_sum(discounts));
          $("#round_off").val(grandTotal - (grandTotal));
          $("#grand_total").val(grandTotal);

        });

        $(document).on('change', '#' + productV[0].pid, function() {
          $(".remaining-row" + productV[0].pid + "").remove();

          let row = $(this).closest('tr'); // Get the parent row of the changed quantity input
          // console.log(row);
          let quantity = parseInt($(this).val());
          let stock = productV[0].stock;

          if (quantity > stock) {
            // Calculate the remaining quantity
            let remainingQuantity = quantity - stock;
            parseInt($(this).val(stock));
            var total_stock = stock;
            // $(".remaining-row").remove();

            // Iterate over the product variants to add rows for each remaining quantity
            for (let i = 1; i < productV.length; i++) {
              let variant = productV[i];
              // let category = ui.item.values.category;
              // if (category[0].Gstrate) {
              //   var category1 = category[0].Gstrate;
              //   console.log(category1);
              // } else {
              //   var category1 = 0;
              //   console.log(category1);
              // }

              var mrp_default_copy = 0;
              if (productV[i].mrp_per_unit) {
                mrp_default_copy = productV[i].mrp_per_unit;
              } else {
                mrp_default_copy = 0;
              }

              var default_strip_copy = 0;
              if (productV[i].strip) {
                default_strip_copy = productV[i].strip;
              } else {
                default_strip_copy = 0;
              }

              var default_batch_copy = 'Null';
              if (productV[i].batch) {
                default_batch_copy = productV[i].batch;
              } else {
                default_batch_copy = 'Null';
              }

              var default_expdate_copy = 0000 - 00 - 00;
              if (productV[i].expdate) {
                default_expdate_copy = productV[i].expdate;
              } else {
                default_expdate_copy = 0000 - 00 - 00;
              }
              // console.log("remaining-row" + productV[0].pid + "");
              // console.log(".remaining-row " + productV[0].pid + "", "javascript")
              let variantQuantity = variant.stock;
              if (remainingQuantity > variantQuantity) {
                // Create a new row for the current variant's stock
                let newRow = $("<tr>").addClass("remaining-row" + productV[0].pid);
                newRow.append("<td></td><td style='display:none'><input type='number' step='any' name='id[]' class='id' value='" + productV[i].pid + "' /></td><td>" + ui.item.label + "</td><td style='display:none'><input type='text' name='title[]' class='title' value='" + ui.item.label + "' /></td><td>" +
                  mrp_default_copy * default_strip_copy + "</td><td><input type='text' name='batch_no[]' class='id' value='" +
                  default_batch_copy + "' readonly/></td><td>" +
                  default_expdate_copy + "</td>" +
                  "<td><input type='number' step='any' name='qty[]' value='" + variantQuantity + "' readonly/></td><td>" +
                  mrp_default_copy + "</td><td style='display:none'><input type='number' step='any' name='rate[]' class='rate' value='" + mrp_default_copy + "' /></td><td> <input type='number' step='any' name='discount[]' class='discount' min=0 max=10 value=0 /></td><td>" + category1 + "</td><td><input type='number' step='any' name='gst[]' class='gst' value='" + parseInt(mrp_default_copy) * parseInt(category1) / 100 + "' readonly></td><td><input type='number' step='any' name='total[]' class='total' value='" + mrp_default_copy + "' ></td></tr>");
                $("#table").append(newRow);
                // $("#no_data_row").remove();
                totals[rowId] = mrp_default_copy;
                gstValues[rowId] = parseInt(mrp_default_copy) * parseInt(category1) / 100;
                discounts[rowId] = 0;
                let grandTotal = array_sum(totals)
                grandTotal = parseFloat(grandTotal).toFixed(2);
               
                grandTotal = Math.round(grandTotal * 100) / 100;
                // var grand_total = array_sum(totals);
                // if (grand_total) {
                //   grand_total_value = grand_total;
                // } else {
                //   grand_total_value = 00;
                // }
                $("#total_taxable_amount").val(grandTotal);
                $("#total_gst").val(array_sum(gstValues));
                $("#total_discount").val(array_sum(discounts));
                $("#round_off").val(grandTotal - (grandTotal));
                $("#grand_total").val(grandTotal);
                // newRow.append("<td></td><td><input type='number' step='any' name='qty[]' value='" + variantQuantity + "' readonly/></td>");

                // Append the new row to the table
                $("#table").append(newRow);

                // Update the remaining quantity for the next iteration
                remainingQuantity -= variantQuantity;
                total_stock += variantQuantity
              } else {

                // Create a new row for the remaining quantity
                let newRow = $("<tr>").addClass("remaining-row" + productV[0].pid);
                newRow.append("<td></td><td style='display:none'><input type='number' step='any' name='id[]' class='id' value='" + productV[i].pid + "' /></td><td>" + ui.item.label + "</td><td style='display:none'><input type='text' name='title[]' class='title' value='" + ui.item.label + "' /></td><td>" +
                  mrp_default_copy * default_strip_copy + "</td><td><input type='text' name='batch_no[]' class='id' value='" +
                  default_batch_copy + "' readonly/></td><td>" +
                  default_expdate_copy + "</td>" +
                  "<td><input type='number' step='any' name='qty[]' value='" + remainingQuantity + "' readonly/></td><td>" +
                  mrp_default_copy + "</td><td style='display:none'><input type='number' step='any' name='rate[]' class='rate' value='" + mrp_default_copy + "' /></td><td> <input type='number' step='any' name='discount[]' class='discount' min=0 max=10 value=0 /></td><td class='gst'>" + category1 + "</td><td><input type='number' step='any' name='gst[]' class='gst' value='" + parseInt(mrp_default_copy) * parseInt(category1) / 100 + "'></td><td><input type='number' step='any' name='total[]' class='total' value='" + mrp_default_copy + "' ></td></tr>");
                $("#table").append(newRow);
                $
                // $("#no_data_row").remove();
          //       totals[(rowId+1)] = mrp_default_copy;
          //       gstValues[(rowId+1)] = parseInt(mrp_default_copy) * parseInt(category1) / 100;
          //       discounts[(rowId+1)] = 0;
                let grandTotal = array_sum(totals)
          grandTotal = parseFloat(grandTotal).toFixed(2);

grandTotal = Math.round(grandTotal * 100) / 100;
          //       var grand_total = array_sum(totals);
          //       if (grand_total) {
          //         grand_total_value = grand_total;
          //       } else {
          //         grand_total_value = 00;
          //       }
          //       $("#total_taxable_amount").val(grandTotal);
          //       $("#total_gst").val(array_sum(gstValues));
          //       $("#total_discount").val(array_sum(discounts));
          //       $("#round_off").val(grandTotal - (grandTotal));
          //       $("#grand_total").val(grandTotal);
                // newRow.append("<td></td><td><input type='number' step='any' name='qty[]' value='" + remainingQuantity + "' readonly/></td>");
                // same row data
                var curent_qty= $('.remaining-row' + productV[0].pid).find("input[name='qty[]']");
                var current_val=curent_qty.val()
                
                var prow_input= $('#' + rowId).find("input[name='total[]']");
                var prow_value= prow_input.val()
                $('#' + rowId).find("input[name='total[]']").val(prow_value-(mrp_default_copy * current_val))
                $('.remaining-row' + productV[0].pid).find("input[name='total[]']").val((mrp_default_copy * current_val))
                // console.log(current_val)
                // Append the new row to the table
                $("#table").append(newRow);



                // Exit the loop as remaining quantity is zero
                break;
              }
            }
            if (quantity > total_stock) {
              window.alert('We wre out of stock now for this product. we have only ' + total_stock + ' and you are demanding ' + quantity)
            }
          }

        });


      }
    });


  });
</script>



@push('styles')
<style>
  ul li:hover {
    cursor: copy;
    background-color: #60b5ba;
    color: #fff;
  }

  .container {
    width: 1100px;
    margin: 0 auto;
  }

  .ciRow3,
  .ciRow2 {
    clear: both;
    display: block;
    margin-bottom: 15px;
  }

  .ciRow3:after,
  .ciRow2:after {
    content: "";
    clear: both;
    display: block;
    height: 1px;
    width: 100%;
  }

  .ciRow3 .ciCol {
    width: 31%;
    float: left;
    margin-right: 2%;
  }

  .ciRow2 .ciCol {
    width: 48%;
    float: left;
    margin-right: 2%;
  }

  .ciRow3 .ciCol label {
    clear: both;
    display: block;
    margin-bottom: 5px;
  }

  .ciRow3 .ciCol input {
    border: 1px solid #ebebeb;
    padding: 10px;
    width: 90%;
  }

  .ciRow2 .ciCol label {
    clear: both;
    display: block;
    margin-bottom: 5px;
  }

  .ciRow2 .ciCol textarea {
    border: 1px solid #ebebeb;
    padding: 10px;
    width: 91%;
  }

  .customerInfo .container {
    background: #f7f7f7;
    padding: 30px;
    border-radius: 0px 0px 20px 20px;
    margin-bottom: 10px;
  }

  .qty_outoff_stock {
    background-color: red;
    color: #fff;
  }

  .qty_in_stock {
    background-color: #fff;
  }

  .text_center {
    text-align: center;
  }
</style>
@endpush
@endsection