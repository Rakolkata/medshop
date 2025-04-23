@extends('layouts.admin.app')
@push('title')
  <title>Medshop | Create-Order</title>
@endpush


@section('content')

  <form action="{{route('admin.order_store')}}" method="post">
    @csrf
    <div class="d-flex mb-3 justify-center align-middle text-center">
    <div>
      <h3 style="font-size: 24px; line-height: 38px; margin-bottom: 0;">Bill:</h3>
    </div>
    <div class="d-flex mx-2 ">
      <select style="padding:5px; margin-bottom:15px;" class="selectBox">
      <option selected>Cash</option>
      <option value="1">Online</option>
      </select>
    </div>
    </div>
    <div class="customerInfo">
    <div class="container1">
      <h2>Customer Info:</h2>
      <div class="row">
      <div class="col-md-3">
        <!-- <label>Name</label> -->
        <input type="text" name="coustomer_name" placeholder="Name" required id="name" />
      </div>
      <div class="col-md-3">
        <!-- <label>Phone</label> -->
        <input type="text" name="coustomer_phone" placeholder="Phone" required id="phone" />
      </div>
      <div class="col-md-3">
        <!-- <label>Email</label> -->
        <input type="email" name="coustomer_email" placeholder="Email" required id="email" />
      </div>
      <div class="col-md-3">
        <!-- <label>Address</label> -->
        <textarea name="customer_address" placeholder="Address" required id="address"></textarea>
      </div>
      </div>

      <div class="row">
      <div class="col-md-3">
        <!-- <label>Dr. Name/Reg. No.</label> -->
        <textarea name="doc_name_regdno" placeholder="Dr. Name/Reg. No." id="regno"></textarea>
      </div>
      </div>
    </div>
    </div>
    <div class="row">
    Search
    <div class="col-md-12">
      <input name="product" id="seachprodduct" type="text" placeholder="Seach your product"
      style="padding:5px; margin-bottom:15px;" />
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
          <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody id="table">
        <tr>
          <td class="row">1</td>
          <td style="position: relative;">
          <input type="text" name="product_name[]" class="form-control product-name ProductNameSearch"
            placeholder="Enter product name" value="" />
          </td>
          <td style="display:none;">
          <input type="number" step="any" name="id[]" class="id" value="" />
          <input type="text" name="title[]" class="title" value="" />
          <input type="text" name="exp[]" class="id" value="" />
          </td>
          <td>
          <div class="d-flex align-items-center">
            <strong class="me-1">₹</strong>00
          </div>
          </td>
          <td>
          <input type="text" class="form-control" name="batch_no[]" value="" placeholder="Enter Batch No"
            readonly />
          </td>
          <td id="year">yyyy-mm-dd</td>
          <td>
          <input type="number" step="any" class="form-control qty" name="qty[]" value="1" min="1" id=""
            placeholder="Enter Quantity" />
          </td>
          <td>
          <div class="d-flex align-items-center">
            <strong class="me-1">₹</strong>00
          </div>
          <input type="hidden" name="rate[]" class="rate" value="" />
          </td>
          <td>
          <input type="number" step="any" class="form-control discount" name="discount[]" min="0" max="20"
            value="0" placeholder="Enter Discount" />
          </td>
          <td style="display:none;"></td>
          <td>
          <span>00</span>
          </td>
          <td>
          <input type="text" class=" form-control gst" name="gst[]" value="" placeholder="Enter Total" readonly />
          </td>
          <td>
          <input type='number' step='any' name='total[]' class='form-control total' value=''
            placeholder="Enter Total After Discount" readonly>
          </td>
          <td class="d-flex gap-2">
          <a href="#" class="delete" id="delete${rowId}" data-bs-target="#staticBackdrop">
            <svg width="21" height="19" fill="red" xmlns="http://www.w3.org/2000/svg">
            <path
              d="M0.41 3.05C0.18 3.05 0 2.87 0 2.64C0 2.41 0.18 2.23 0.41 2.23L19.69 2.26C19.92 2.26 20.1 2.44 20.1 2.67C20.1 2.9 19.92 3.08 19.69 3.08L0.41 3.05ZM3.58 3.89C3.58 3.66 3.76 3.48 3.99 3.48C4.22 3.48 4.4 3.66 4.4 3.89V18.01L16.41 17.88V4.04C16.41 3.81 16.59 3.63 16.82 3.63C17.05 3.63 17.23 3.81 17.23 4.04V18.74L3.56 18.88V3.89H3.58Z"
              fill="white" />
            <path
              d="M13.75 15.88C13.52 15.88 13.34 15.7 13.34 15.47V5.73C13.34 5.5 13.52 5.32 13.75 5.32C13.98 5.32 14.16 5.5 14.16 5.73V15.47C14.18 15.7 13.98 15.88 13.75 15.88ZM7.28 15.88C7.05 15.88 6.87 15.7 6.87 15.47V5.73C6.87 5.5 7.05 5.32 7.28 5.32C7.51 5.32 7.69 5.5 7.69 5.73V15.47C7.71 15.7 7.51 15.88 7.28 15.88ZM10.52 15.88C10.29 15.88 10.11 15.7 10.11 15.47V5.73C10.11 5.5 10.29 5.32 10.52 5.32C10.75 5.32 10.93 5.5 10.93 5.73V15.47C10.94 15.7 10.75 15.88 10.52 15.88ZM13.19 2.48V1.48C13.19 1.12 12.9 0.82 12.53 0.82H8.33C7.96 0.82 7.68 1.12 7.68 1.49V2.36H6.86V1.49C6.86 0.67 7.53 0 8.35 0H12.55C13.37 0 14.04 0.67 14.04 1.49V2.49H13.19V2.48Z"
              fill="white" />
            </svg>
          </a>
          <a href="#" class="addbtn">
            <svg width="20" height="20" fill="green" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" clip-rule="evenodd"
              d="M8.75 11.25V20H11.25V11.25H20V8.75H11.25V0H8.75V8.75H0V11.25H8.75Z" fill="white" />
            </svg>
          </a>
          </td>
        </tr>
        </tbody>
      </table>
      </div>
    </div>
    <div class="col-md-6">
    </div>
    <!-- <div class="col-md-6">
      <div class="row">
      <div class="col-md-6">
      <ul style="text-align: right;list-style-type:none">
      <li class="mt-2" style="display:none">SubTotal</span></li>
      <li class="mt-2">Discount</li>
      <li class="mt-2">Sub Total</li>
      <li class="mt-2">Tax (GST)</li>
      <li class="mt-2">Round Off</li>
      <li class="mt-2">Grand Total</li>
      </ul>
      </div>
      <div class="col-md-6">
      <ul style="text-align: right;list-style-type:none">
      <li class="p-1"><input type="number" name="total_discount" id="total_discount" readonly style="border:none">
      </li>
      <li class="p-1"><input type="number" name="total_taxable_amount" id="total_taxable_amount" readonly
      style="border:none"></li>
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
    </div> -->
    <div class="container-fluid my-3">
      <div class="row justify-content-end">
      <div class="col-md-4 ">
        <div>
        <h4>Price details</h4>
        <table class="table">
          <tbody>
          <tr>
            <td>Discount</td>
            <td><strong>₹ </strong><input type="number" name="total_discount" id="total_discount" readonly
              style="border:none"></td>
          </tr>
          <tr>
            <td>Taxable Amount</td>
            <td><strong>₹ </strong><input type="number" name="total_taxable_amount" id="total_taxable_amount"
              readonly style="border:none"></td>
          </tr>
          <tr>
            <td>Tax (GST)</td>
            <td><strong>₹ </strong><input type="number" name="total_gst" id="total_gst" readonly
              style="border:none"></td>
          </tr>
          <tr>
            <td>Rand Off</td>
            <td><strong>₹ </strong><input type="number" name="round_off" id="round_off" readonly
              style="border:none"></td>
          </tr>
          <tr class="grandtotal">
            <td>Grand Total</td>
            <td><strong>₹ </strong><input type="number" name="grand_total" id="grand_total" readonly
              style="border:none"></td>
          </tr>
          </tbody>
        </table>
        </div>
        <button class="btn background btn-lg btn-primary text-white border-0 fs-6 p-3 rounded-0 w-100"
        style="background: #60b5ba">Save
        Order</button>
      </div>
      </div>
  </form>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css"
    integrity="sha384-b6lVK+yci+bfDmaY1u0zE8YYJt0TZxLEAFyYSLHId4xoVvsrQu3INevFKo+Xir8e" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
  <script>
    let id = 2;
    let rowId;
    function amountCalculation() {
    // console.log("enter in calculate function");

    var grandTotalArray = [];
    var gstAmountArray = [];
    var DiscountsArray = [];
    $('.discount').each(function (index, element) {
      let discount = $(this).val();
      let price = $(this).data('id') || parseFloat($(this).closest('tr').find(".rate").text().replace('₹', '').trim()) || 0;
      let qty = $(this).closest('tr').find("input[name='qty[]']").val();
      let discountAmount = (price * qty * discount) / 100
      let subtotal = (price * qty) - discountAmount;
      $(this).closest('tr').find(".total").val(subtotal.toFixed(2));
      let gstRate = $(this).data('gst');
      let gstAmount = subtotal * gstRate / 100;
      $(this).closest('tr').find(".gst").val(gstAmount.toFixed(2));
      // console.log("price", price);
      // console.log("discount", discount);
      // console.log("qty", qty);
      // console.log("discount amount", discountAmount);
      // console.log("subtotal", subtotal);

      grandTotal = subtotal - gstAmount;
      grandTotalArray[index] = grandTotal;
      gstAmountArray[index] = gstAmount;
      DiscountsArray[index] = discountAmount;
    });
    var fiGrandTotal = (array_sum(grandTotalArray) + array_sum(gstAmountArray)).toFixed(2);
    var roundOff = (Math.round(fiGrandTotal) - fiGrandTotal).toFixed(2);
    // console.log("grand total ",array_sum(grandTotalArray).toFixed(2));

    $("#total_taxable_amount").val(array_sum(grandTotalArray).toFixed(2));
    $("#total_gst").val(array_sum(gstAmountArray).toFixed(2));
    $("#total_discount").val(array_sum(DiscountsArray).toFixed(2));
    $("#round_off").val(roundOff);
    $("#grand_total").val(parseFloat(array_sum([parseFloat(fiGrandTotal), parseFloat(roundOff)])).toFixed(2));

    }

    $(document).on('change', '.discount', function () {
    let discount = $(this).val();
    if (discount > 20) { // limit discount to 10%
      discount = 20;
      $(this).val(discount); // update the value of the discount input to reflect the limit
    }
    amountCalculation()
    });

    $(document).on('input', '.qty', function () { // listen to changes on the quantity input of the corresponding row
    amountCalculation()
    });

    $(document).on('click', '.delete', function () {
    const row = $(this).closest('tr');
    const rowId = row.attr('id');
    delete totals[rowId];
    delete gstValues[rowId];
    delete discounts[rowId];
    row.remove();
    id = id - 1;
    amountCalculation();
    });

    $(document).on('click', '.addbtn', function () {
    console.log("clicked");
    let rowId = Date.now(); // unique ID
    let newRow = $("<tr>", {
      "id": rowId
    });

    // Create new row with appropriate structure
    newRow.append(`
      <td class="row">${id}</td>
      <td style="position: relative;">
      <input type="text" name="product_name[]" id="product_name_${rowId}" class="form-control product-name" placeholder="Enter product name">
      </td>
      <td style="display:none;">
      <input type="number" step="any" name="id[]" class="id" id="product_id_${rowId}" value="" />
      <input type="text" name="title[]" class="title" id="title_${rowId}" value="" />
      <input type="text" name="exp[]" class="id" id="hidden_exp_${rowId}" value="" />
      </td>
      <td class="d-flex align-items-center" id="mrp_${rowId}"><strong class="me-1">₹</strong>00</td>
      <td><input type="text" class="form-control batch-no" id="batch_no_${rowId}" name="batch_no[]" placeholder="Batch No." /></td>
      <td class="exp-date" id="exp_date_${rowId}" name="exp[]">yyyy-mm-dd</td>
      <td><input type="text" class="form-control qty" id="qty_${rowId}" name="qty[]" placeholder="Qty" /></td>
      <td><div class="d-flex align-items-center rate" id="rate_div_${rowId}"><strong class="me-1">₹</strong>00</div>
      <input type="hidden" name="rate[]" id="rate_${rowId}" class="rate" value="" /></td>
      <td><input type="number" step="any" class="form-control discount" name="discount[]" min="0" max="20" value="0" /></td>
      <td style="display:none;"></td>
      <td class="gst-amount" id="gst_${rowId}">00</td>
      <td><input type="text" class=" form-control gst" name="gst[]" id="gst_amount_${rowId}" placeholder="Total" /></td>
      <td><input type="text"  step='any' name='total[]' class='form-control total' id="total_after_discount_${rowId}" placeholder="TotalAfterDiscount" /></td>
      <td class="d-flex gap-2">
      <a href="#" class="delete" id="delete${rowId}" data-bs-target="#staticBackdrop">
      <svg width="21" height="19" fill="red" xmlns="http://www.w3.org/2000/svg">
      <path d="M0.41 3.05C0.18 3.05 0 2.87 0 2.64C0 2.41 0.18 2.23 0.41 2.23L19.69 2.26C19.92 2.26 20.1 2.44 20.1 2.67C20.1 2.9 19.92 3.08 19.69 3.08L0.41 3.05ZM3.58 3.89C3.58 3.66 3.76 3.48 3.99 3.48C4.22 3.48 4.4 3.66 4.4 3.89V18.01L16.41 17.88V4.04C16.41 3.81 16.59 3.63 16.82 3.63C17.05 3.63 17.23 3.81 17.23 4.04V18.74L3.56 18.88V3.89H3.58Z" fill="white"/>
      <path d="M13.75 15.88C13.52 15.88 13.34 15.7 13.34 15.47V5.73C13.34 5.5 13.52 5.32 13.75 5.32C13.98 5.32 14.16 5.5 14.16 5.73V15.47C14.18 15.7 13.98 15.88 13.75 15.88ZM7.28 15.88C7.05 15.88 6.87 15.7 6.87 15.47V5.73C6.87 5.5 7.05 5.32 7.28 5.32C7.51 5.32 7.69 5.5 7.69 5.73V15.47C7.71 15.7 7.51 15.88 7.28 15.88ZM10.52 15.88C10.29 15.88 10.11 15.7 10.11 15.47V5.73C10.11 5.5 10.29 5.32 10.52 5.32C10.75 5.32 10.93 5.5 10.93 5.73V15.47C10.94 15.7 10.75 15.88 10.52 15.88ZM13.19 2.48V1.48C13.19 1.12 12.9 0.82 12.53 0.82H8.33C7.96 0.82 7.68 1.12 7.68 1.49V2.36H6.86V1.49C6.86 0.67 7.53 0 8.35 0H12.55C13.37 0 14.04 0.67 14.04 1.49V2.49H13.19V2.48Z" fill="white"/>
      </svg>
      </a>
      <a href="#" class="addbtn">
      <svg width="20" height="20" fill="green" xmlns="http://www.w3.org/2000/svg">
      <path fill-rule="evenodd" clip-rule="evenodd" d="M8.75 11.25V20H11.25V11.25H20V8.75H11.25V0H8.75V8.75H0V11.25H8.75Z" fill="white"/>
      </svg>
      </a>
      </td>
    `);

    // Append the newly created row to the table
    $("#table").append(newRow);
    id++;
    // Autocomplete functionality for the new product input field
    $(`#product_name_${rowId}`).autocomplete({
      source: "{{ route('admin.prod_name') }}",
      dataType: "json",
      minLength: 2,
      select: function (event, ui) {
      console.log("ui", ui);

      let $input = $(this);
      let $row = $input.closest("tr");
      let rowId = $row.attr("id");  // Capture the correct rowId dynamically

      let productV = ui.item.values.product_veriant;
      let category = ui.item.values.category;
      let category1 = 12;
      if (category.length > 0) {
        let rawGst = parseFloat(category[0].Gstrate);
        if (!isNaN(rawGst)) category1 = rawGst;
      }

      let rate_default = 0;
      let default_strip = 0;
      let default_batch = "Null";
      let default_expdate = "0000-00-00";

      if (productV.length > 0) {
        rate_default = parseFloat(productV[0].rate);
        if (isNaN(rate_default)) {
        rate_default = parseFloat(productV[0].mrp_per_unit);
        if (isNaN(rate_default)) rate_default = 0;
        }

        default_strip = parseFloat(productV[0].strip);
        if (isNaN(default_strip)) default_strip = 0;

        default_batch = productV[0].batch || "Null";
        default_expdate = productV[0].expdate || "0000-00-00";
      }

      // Fill fields with the selected data
      $(`#product_name_${rowId}`).val(ui.item.label);
      $(`#product_id_${rowId}`).val(ui.item.id);
      $(`#batch_no_${rowId}`).val(default_batch);
      $(`#exp_date_${rowId}`).text(default_expdate);
      $(`#mrp_${rowId}`).text(productV[0].mrp_per_unit.toFixed(2));
      $(`#rate_div_${rowId}`).text(rate_default.toFixed(2));
      $(`#gst_${rowId}`).text(category1);
      $(`#qty_${rowId}`).val(1);
      $(`#title_${rowId}`).val(ui.item.label);
      $(`#hidden_exp_${rowId}`).val(default_expdate);
      $(`#rate_${rowId}`).val(rate_default);
      // Add data attributes to the discount input field
      $row.find(".discount").data("id", rate_default).data("gst", category1);

      // GST Calculation
      let gstAmount = (parseFloat(rate_default) * parseFloat(category1) / 100).toFixed(2);
      $(`#gst_amount_${rowId}`).val(gstAmount);

      // Total Calculation
      let totalAfterDiscount = rate_default;
      $(`#total_after_discount_${rowId}`).val(totalAfterDiscount.toFixed(2));
      amountCalculation();
      }
    });
    });

    function array_sum(array) {
    let sum = 0;
    for (const value of Object.values(array)) {
      let v = parseFloat(value);
      if (!isNaN(v)) {
      sum += v;
      }
    }
    return sum;
    }

    let totals = [];
    let gstValues = [];
    let discounts = [];

    $(function () {

    function log(message) {
      $("#table").append(message);
    }

    $("#seachprodduct").autocomplete({
      source: "{{ route('admin.prod_name') }}",
      dataType: "json",
      minLength: 2,
      select: function (event, ui) {
      console.log(event, "event");
      console.log(ui, "ui");
      let productV = ui.item.values.product_veriant;
      console.log(productV, "fr3fr");
      let category = ui.item.values.category;
      var category1 = 0;
      if (category.length > 0) {
        if (category[0].Gstrate) {
        var category1 = category[0].Gstrate;
        console.log(typeof category1);
        } else if (category[0].Gstrate == null) {
        var category1 = 12;
        console.log(typeof category1);
        } else if (category[0].Gstrate == 'NULL') {
        var category1 = 12;
        console.log(typeof category1);
        } else if (category[0].Gstrate == '') {
        var category1 = 12;
        console.log(typeof category1);
        } else {
        var category1 = 12;
        console.log(typeof category1);
        }
      } else {
        var category1 = 12;
      }

      var rate_default = 0;
      var default_strip = 0;
      var default_batch = 'Null';
      var default_expdate = 0000 - 00 - 00;
      if (productV.length > 0) {
        if (productV[0].rate) {
        rate_default = productV[0].rate;
        } else if (productV[0].rate == null) {
        rate_default = productV[0].mrp_per_unit;
        } else if (productV[0].rate == 'NULL') {
        rate_default = productV[0].mrp_per_unit;
        } else {
        rate_default = 0;
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
        rate_default = 0;
        default_strip = 0;
        default_batch = 'Null';
        default_expdate = 0000 - 00 - 00;
      }
      // var grand_total_value = 0;

      rowId = Date.now(); // generate a unique identifier for the row
      let newRow = $("<tr>", {
        "id": rowId
      }); // add the identifier to the new row
      if (productV.length > 0) {
        newRow.append(`<td class="row">${id}</td>
    <td style="position: relative;">
      <input type="text" name="product_name[]" class="form-control product-name ProductNameSearch" placeholder="Enter product name" value="${ui.item.label}" readonly />
    </td>
    <td style="display:none;">
      <input type="number" step="any" name="id[]" class="id" value="${productV[0].pid}" />
      <input type="text" name="title[]" class="title" value="${ui.item.label}" />
      <input type="text" name="exp[]" class="id" value="${default_expdate}" />
    </td>
    <td>
      <div class="d-flex align-items-center">
      <strong class="me-1">₹</strong>${productV[0].mrp_per_unit}
      </div>
    </td>
    <td>
      <input type="text" class="form-control" name="batch_no[]" value="${default_batch}" readonly />
    </td>
    <td>${default_expdate}</td>
    <td>
      <input type="number" step="any" class="form-control qty" name="qty[]" value="1" min="1" id="qty_${productV[0].pid}" />
    </td>
    <td>
      <div class="d-flex align-items-center">
      <strong class="me-1">₹</strong>${rate_default}
      </div>
      <input type="hidden" name="rate[]" class="rate" value="${rate_default}" />
    </td>
    <td>
      <input type="number" step="any" class="form-control discount" name="discount[]" data-id="${rate_default}" data-gst="${category1}" min="0" max="20" value="0" />
    </td>
    <td style="display:none;"></td>
    <td>
      ${category1}
    </td>
    <td>
      <input type="text" class=" form-control gst" name="gst[]" value="${(parseFloat(rate_default) * parseFloat(category1) / 100).toFixed(2)}" readonly />
    </td>
    <td>
      <input type='number' step='any' name='total[]' class='form-control total' value='${rate_default}' readonly>
    </td>
    <td class="d-flex gap-2">
      <a href="#" class="delete" id="delete${rowId}" data-bs-target="#staticBackdrop">
      <svg width="21" height="19" fill="red" xmlns="http://www.w3.org/2000/svg">
      <path d="M0.41 3.05C0.18 3.05 0 2.87 0 2.64C0 2.41 0.18 2.23 0.41 2.23L19.69 2.26C19.92 2.26 20.1 2.44 20.1 2.67C20.1 2.9 19.92 3.08 19.69 3.08L0.41 3.05ZM3.58 3.89C3.58 3.66 3.76 3.48 3.99 3.48C4.22 3.48 4.4 3.66 4.4 3.89V18.01L16.41 17.88V4.04C16.41 3.81 16.59 3.63 16.82 3.63C17.05 3.63 17.23 3.81 17.23 4.04V18.74L3.56 18.88V3.89H3.58Z" fill="white"/>
      <path d="M13.75 15.88C13.52 15.88 13.34 15.7 13.34 15.47V5.73C13.34 5.5 13.52 5.32 13.75 5.32C13.98 5.32 14.16 5.5 14.16 5.73V15.47C14.18 15.7 13.98 15.88 13.75 15.88ZM7.28 15.88C7.05 15.88 6.87 15.7 6.87 15.47V5.73C6.87 5.5 7.05 5.32 7.28 5.32C7.51 5.32 7.69 5.5 7.69 5.73V15.47C7.71 15.7 7.51 15.88 7.28 15.88ZM10.52 15.88C10.29 15.88 10.11 15.7 10.11 15.47V5.73C10.11 5.5 10.29 5.32 10.52 5.32C10.75 5.32 10.93 5.5 10.93 5.73V15.47C10.94 15.7 10.75 15.88 10.52 15.88ZM13.19 2.48V1.48C13.19 1.12 12.9 0.82 12.53 0.82H8.33C7.96 0.82 7.68 1.12 7.68 1.49V2.36H6.86V1.49C6.86 0.67 7.53 0 8.35 0H12.55C13.37 0 14.04 0.67 14.04 1.49V2.49H13.19V2.48Z" fill="white"/>
      </svg>
      </a>
      <a href="#" class="addbtn">
      <svg width="20" height="20" fill="green" xmlns="http://www.w3.org/2000/svg">
      <path fill-rule="evenodd" clip-rule="evenodd" d="M8.75 11.25V20H11.25V11.25H20V8.75H11.25V0H8.75V8.75H0V11.25H8.75Z" fill="white"/>
      </svg>
      </a>
    </td></tr>`
        );
        $("#table").append(newRow);
        id = id + 1;
        // $("#no_data_row").remove();
        totals[rowId] = rate_default;
        // gstValues[rowId] = parseInt(rate_default) * parseInt(category1) / 100;
        gstValues[rowId] = parseInt(rate_default) * parseInt(category1) / 100;

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
        amountCalculation()
      } else {
        // newRow.append("<td id='no_data_row' colspan=12 class='text_center'>This Product is not in stock.</td>");
        // $("#table").append(newRow);
        window.alert("This Product is not in Stock.");
      }
      $(document).on('change', '#' + productV[0].pid, function () {
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

          var rate_default_copy = 0;
          if (productV[i].mrp_per_unit) {
          rate_default_copy = productV[i].mrp_per_unit;
          } else {
          rate_default_copy = 0;
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
          newRow.append(`<td class="row">${id}</td>
    <td style="position: relative;">
    <input type="text" name="product_name[]" class="form-control product-name ProductNameSearch"  value="${ui.item.label}" readonly />
    </td>
    <td style="display:none;">
    <input type="text" name="exp[]" class="id" value="${default_expdate_copy}" />
    <input type="number" name="id[]" class="id" value="${productV[i].pid}" />
    <input type="text" name="title[]" class="title" value="${ui.item.label}" />
    </td>
    <td>
    <div class="d-flex align-items-center">
      <strong class="me-1">₹</strong>${rate_default_copy * default_strip_copy}
    </div>
    </td>
    <td>
    <input type="text" class="form-control" name="batch_no[]" value="${default_batch_copy}" readonly />
    </td>
    <td>${default_expdate_copy}</td>
    <td>
    <input type="number" step="any" class="form-control qty" name="qty[]" value="${variantQuantity}" readonly />
    </td>
    <td>
    <div class="d-flex align-items-center">
      <strong class="me-1">₹</strong>${rate_default_copy}
    </div>
    <input type="hidden" name="rate[]" class="rate" value="${rate_default_copy}" />
    </td>
    <td>
    <input type="number" step="any" class="form-control discount" name="discount[]" min="0" max="20" value="0" />
    </td>
    <td style="display:none;"></td>
    <td>
      ${category1}
    </td>
    <td>
      <input type="text" class="form-control gst" name="gst[]" value="${(parseFloat(rate_default) * parseFloat(category1) / 100).toFixed(2)}" readonly />
    </td>
    <td>
      <input type='number' step='any' name='total[]' class='form-control total' value='${rate_default}' readonly>
    </td>
    <td class="d-flex gap-2">
    <a href="#" class="delete" id="delete${rowId}" data-bs-target="#staticBackdrop">
      <svg width="21" height="19" fill="red" xmlns="http://www.w3.org/2000/svg">
      <path d="M0.41 3.05C0.18 3.05 0 2.87 0 2.64C0 2.41 0.18 2.23 0.41 2.23L19.69 2.26C19.92 2.26 20.1 2.44 20.1 2.67C20.1 2.9 19.92 3.08 19.69 3.08L0.41 3.05ZM3.58 3.89C3.58 3.66 3.76 3.48 3.99 3.48C4.22 3.48 4.4 3.66 4.4 3.89V18.01L16.41 17.88V4.04C16.41 3.81 16.59 3.63 16.82 3.63C17.05 3.63 17.23 3.81 17.23 4.04V18.74L3.56 18.88V3.89H3.58Z" fill="white"/>
      <path d="M13.75 15.88C13.52 15.88 13.34 15.7 13.34 15.47V5.73C13.34 5.5 13.52 5.32 13.75 5.32C13.98 5.32 14.16 5.5 14.16 5.73V15.47C14.18 15.7 13.98 15.88 13.75 15.88ZM7.28 15.88C7.05 15.88 6.87 15.7 6.87 15.47V5.73C6.87 5.5 7.05 5.32 7.28 5.32C7.51 5.32 7.69 5.5 7.69 5.73V15.47C7.71 15.7 7.51 15.88 7.28 15.88ZM10.52 15.88C10.29 15.88 10.11 15.7 10.11 15.47V5.73C10.11 5.5 10.29 5.32 10.52 5.32C10.75 5.32 10.93 5.5 10.93 5.73V15.47C10.94 15.7 10.75 15.88 10.52 15.88ZM13.19 2.48V1.48C13.19 1.12 12.9 0.82 12.53 0.82H8.33C7.96 0.82 7.68 1.12 7.68 1.49V2.36H6.86V1.49C6.86 0.67 7.53 0 8.35 0H12.55C13.37 0 14.04 0.67 14.04 1.49V2.49H13.19V2.48Z" fill="white"/>
      </svg>
    </a>
    <a href="#" class="addbtn">
      <svg width="20" height="20" fill="green" xmlns="http://www.w3.org/2000/svg">
      <path fill-rule="evenodd" clip-rule="evenodd" d="M8.75 11.25V20H11.25V11.25H20V8.75H11.25V0H8.75V8.75H0V11.25H8.75Z" fill="white"/>
      </svg>
    </a>
    </td></tr>`);
          $("#table").append(newRow);
          // $("#no_data_row").remove();
          totals[rowId] = rate_default_copy;
          gstValues[rowId] = parseInt(rate_default_copy) * parseInt(category1) / 100;
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
          // $("#total_taxable_amount").val(grandTotal);
          // $("#total_gst").val(array_sum(gstValues));
          // $("#total_discount").val(array_sum(discounts));
          // $("#round_off").val(grandTotal - (grandTotal));
          // $("#grand_total").val(grandTotal);
          // newRow.append("<td></td><td><input type='number' step='any' name='qty[]' value='" + variantQuantity + "' readonly/></td>");

          // Append the new row to the table
          $("#table").append(newRow);

          // Update the remaining quantity for the next iteration
          remainingQuantity -= variantQuantity;
          total_stock += variantQuantity
          } else {

          // Create a new row for the remaining quantity
          let newRow = $("<tr>").addClass("remaining-row" + productV[0].pid);
          newRow.append(`<th class="row">${id}</th>
    <td style="position: relative;">
    <input type="text" name="product_name[]" class="form-control product-name ProductNameSearch"  value="${ui.item.label}" readonly />
    </td>

    <!-- Hidden Inputs -->
    <td style="display:none;">
    <input type="text" name="exp[]" class="id" value="${default_expdate}" />
    <input type="number" step="any" name="id[]" class="id" value="${productV[i].pid}" />
    <input type="text" name="title[]" class="title" value="${ui.item.label}" />
    </td>

    <!-- MRP -->
    <td>
    <div class="d-flex align-items-center">
      <strong class="me-1">₹</strong>${rate_default_copy * default_strip_copy}
    </div>
    </td>

    <!-- Batch -->
    <td>
    <input type="text" name="batch_no[]" class="form-control" value="${default_batch_copy}" readonly />
    </td>

    <!-- Expiry -->
    <td>${default_expdate_copy}</td>

    <!-- Quantity -->
    <td>
    <input type="number" name="qty[]" step="any" class="form-control qty" value="${remainingQuantity}" readonly />
    </td>

    <!-- Rate per unit -->
    <td>
    <div class="d-flex align-items-center">
      <strong class="me-1">₹</strong>${rate_default_copy}
    </div>
    <input type="hidden" name="rate[]" class="rate" value="${rate_default_copy}" />
    </td>

    <!-- Discount -->
    <td>
    <input type="number" step="any" name="discount[]" class="form-control discount" min="0" max="20" value="0" />
    </td>

    <td>
      ${category1}
    </td>
    <td>
      <input type="text" class="form-control gst" name="gst[]" value="${(parseFloat(rate_default) * parseFloat(category1) / 100).toFixed(2)}" readonly />
    </td>
    <td>
      <input type='number' step='any' name='total[]' class='form-control total' value='${rate_default}' readonly>
    </td></tr>`);

          $("#table").append(newRow);

          // $("#no_data_row").remove();
          //       totals[(rowId+1)] = rate_default_copy;
          //       gstValues[(rowId+1)] = parseInt(rate_default_copy) * parseInt(category1) / 100;
          //       discounts[(rowId+1)] = 0;
          let grandTotal = array_sum(totals)
          grandTotal = parseFloat(grandTotal).toFixed(2);

          grandTotal[rowId] = Math.round(grandTotal * 100) / 100;
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
          var curent_qty = $('.remaining-row' + productV[0].pid).find("input[name='qty[]']");
          var current_val = curent_qty.val()

          var prow_input = $('#' + rowId).find("input[name='total[]']");
          var prow_value = prow_input.val();
          $('#' + rowId).find("input[name='total[]']").val(prow_value - (rate_default_copy * current_val))
          totals[rowId] = parseFloat(prow_value - (rate_default_copy * current_val));
          $('.remaining-row' + productV[0].pid).find("input[name='total[]']").val((rate_default_copy * current_val))
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

    jQuery("#phone").autocomplete({
      source: "{{ route('admin.customer_data') }}",
      dataType: "json",
      minLength: 2,
      select: function (event, ui) {
      console.log(ui);
      $("#email").val(ui.item.values.email);
      $("#name").val(ui.item.values.name);
      $("#address").val(ui.item.values.Address);
      $("#regno").val(ui.item.values.Doc_Name_RegdNo);
      }
    });
    });


    $(".ProductNameSearch").autocomplete({
    source: "{{ route('admin.prod_name') }}",
    dataType: "json",
    minLength: 2,
    select: function (event, ui) {
      let $input = $(this);
      let $row = $input.closest("tr");

      let productV = ui.item.values.product_veriant;
      let category = ui.item.values.category;
      let category1 = 12;
      if (category.length > 0) {
      let rawGst = parseFloat(category[0].Gstrate);
      if (!isNaN(rawGst)) category1 = rawGst;
      }

      let rate_default = 0;
      let default_strip = 0;
      let default_batch = "Null";
      let default_expdate = "0000-00-00";

      if (productV.length > 0) {
      rate_default = parseFloat(productV[0].rate);
      if (isNaN(rate_default)) {
        rate_default = parseFloat(productV[0].mrp_per_unit);
        if (isNaN(rate_default)) rate_default = 0;
      }

      default_strip = parseFloat(productV[0].strip);
      if (isNaN(default_strip)) default_strip = 0;

      default_batch = productV[0].batch || "Null";
      default_expdate = productV[0].expdate || "0000-00-00";
      }

      // Fill the row
      $row.find("input.title").val(ui.item.label);
      $row.find("input.id").val(ui.item.id);
      $row.find("input[name='batch_no[]']").val(default_batch);
      $row.find("input.rate").val(rate_default);
      $row.find("input[name='exp[]']").val(default_expdate);

      // Set data attributes correctly for calculation
      $row.find(".discount").data("id", rate_default);
      $row.find(".discount").data("gst", category1);

      let gstAmount = (rate_default * category1) / 100;
      $row.find("input.gst").val(isNaN(gstAmount) ? 0 : gstAmount.toFixed(2));

      $row.find("td:nth-child(4) div").html(`<strong class="me-1">₹</strong>${productV[0].mrp_per_unit || 0}`);
      $row.find("td:nth-child(8) div").html(`<strong class="me-1">₹</strong>${rate_default}`);
      $row.find("td:nth-child(11)").html(`${category1}`);
      $row.find("td:nth-child(6)").html(`${default_expdate}`);

      amountCalculation();
    }
    })

  </script>



  @push('styles')
    <style>
    /* ul li:hover {
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
    } */

    /*.ciRow3 .ciCol {
    width: 31%;
    float: left;
    margin-right: 2%;
    }

    .ciRow2 .ciCol {
    width: 48%;
    float: left;
    margin-right: 2%;
    }*/

    /* .ciRow3 .ciCol label {
    clear: both;
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
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
    font-weight: bold;
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
    } */
    ul li:hover {
    cursor: copy;
    background-color: #60b5ba;
    color: #fff;
    }

    .container {
    width: 1100px;
    margin: 0 auto;
    }

    /* .ciRow3,
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
    } */

    /*.ciRow3 .ciCol {
    width: 31%;
    float: left;
    margin-right: 2%;
    }

    .ciRow2 .ciCol {
    width: 48%;
    float: left;
    margin-right: 2%;
    }*/

    /* .ciRow3 .ciCol label {
    clear: both;
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
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
    font-weight: bold;
    }

    .ciRow2 .ciCol textarea {
    border: 1px solid #ebebeb;
    padding: 10px;
    width: 91%;
    } */

    .customerInfo input,
    .customerInfo textarea {
    width: 100%;
    padding: 10px;
    font-size: 14px;
    box-sizing: border-box;
    border: 1px solid #ccc;
    border-radius: 4px;
    resize: none;
    height: 40px;
    margin: 10px 0px;
    }

    .customerInfo .container1 {
    /* background: #f7f7f7;
    padding: 30px; */
    /* border-radius: 0px 0px 20px 20px; */
    max-width: 100%;
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

    .selectBox {
    color: #858796;
    }

    .grandtotal {
    border-top: 2px solid #E0E0E0;
    font-size: 14px;
    font-weight: 600;
    text-transform: uppercase;
    }

    .delete {
    width: 40px;
    height: 40px;
    border-radius: 6px;
    background-color: #E94F4F;
    text-align: center;
    display: block;
    margin-right: 10px;
    }

    .delete svg {
    margin-top: 10px;
    }

    .addbtn {
    width: 40px;
    height: 40px;
    border-radius: 6px;
    background-color: #35B71D;
    text-align: center;
    display: block;
    }

    .addbtn svg {
    margin-top: 10px;
    }
    </style>
  @endpush
@endsection