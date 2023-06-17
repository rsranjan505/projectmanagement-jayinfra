
//Employee state
$('#state_id').on('change', function () {
    let state_id = this.value;
    $.ajax({
        url: "/city/"+state_id,
        type: "get",

        success: function (res) {
            console.log(res);
            let html = "";
            html += '<select id="city_id" type="text" name="city_id" search class="form-control">';
            html += "<option value=''>Select</option>";
            res.data.forEach((val, key) => {
                html += "<option value=" + val.id + ">" + val.name + "</option>";
            });
            html += '</select>';
            $("#city_id").html("");
            $("#city_id").html(html);
        },
    });
});


//project phase location
$('#location_state_id').on('change', function () {
    let state_id = this.value;
    $.ajax({
        url: "/project/location/districts/"+state_id,
        type: "get",

        success: function (res) {
            console.log(res);
            let html = "";
            html += '<select id="location_district_id" type="text" name="location[district_id]" search class="form-control">';
            html += "<option value=''>Select</option>";
            res.data.forEach((val, key) => {
                html += "<option value=" + val.id + ">" + val.name + "</option>";
            });
            html += '</select>';
            $("#location_district_id").html("");
            $("#location_district_id").html(html);
        },
    });
});

//project phase location
$('#location_district_id').on('change', function () {
    let state_id = this.value;
    $.ajax({
        url: "/project/location/blocks/"+state_id,
        type: "get",

        success: function (res) {
            console.log(res);
            let html = "";
            html += '<select id="location_block_id" type="text" name="location[block_id]" search class="form-control">';
            html += "<option value=''>Select</option>";
            res.data.forEach((val, key) => {
                html += "<option value=" + val.id + ">" + val.name + "</option>";
            });
            html += '</select>';
            $("#location_block_id").html("");
            $("#location_block_id").html(html);
        },
    });
});

//project phase location
$('#location_block_id').on('change', function () {
    let state_id = this.value;
    $.ajax({
        url: "/project/location/panchayats/"+state_id,
        type: "get",

        success: function (res) {
            console.log(res);
            let html = "";
            html += '<select id="location_panchayat_id" type="text" name="location[panchayat_id]" search class="form-control">';
            html += "<option value=''>Select</option>";
            res.data.forEach((val, key) => {
                html += "<option value=" + val.id + ">" + val.name + "</option>";
            });
            html += '</select>';
            $("#location_panchayat_id").html("");
            $("#location_panchayat_id").html(html);
        },
    });
});


//////////////////////////////////////////////
////////////  Employee  /////////////////////////
//////////////////////////////////////////

$(function () {
    // $.validator.setDefaults({
    //   submitHandler: function () {
    //     // action="{{ route('save-user')}}" method="post"
    //     alert( "Form successful submitted!" );
    //   }
    // });
    $('#add-employee-form').validate({
      rules: {
        name: {
            required: true,
            name: true,
        },
        mobile: {
            required: true,
            mobile: true,
          },
        email: {
          required: true,
          email: true,
        },
        password: {
          required: true,
          minlength: 5
        },
      },
      messages: {
        name: {
            required: "Please enter a name ",
            name: "Please enter a valid name"
        },
        mobile: {
            required: "Please enter a mobile ",
            mobile: "Please enter a valid mobile "
            },
        email: {
          required: "Please enter a email address",
          email: "Please enter a valid email address"
        },
        password: {
          required: "Please provide a password",
          minlength: "Your password must be at least 5 characters long"
        }
      },
      errorElement: 'span',
      errorPlacement: function (error, element) {
        error.addClass('invalid-feedback');
        element.closest('.form-group').append(error);
      },
      highlight: function (element, errorClass, validClass) {
        $(element).addClass('is-invalid');
      },
      unhighlight: function (element, errorClass, validClass) {
        $(element).removeClass('is-invalid');
      }
    });
  });


  $(function () {

    var table = $('#user-table').DataTable({
        processing: true,
        serverSide: false,
        paging: true,
        ajax: "employee/",
        columns: [
          {
              data: "DT_RowIndex",
              name: "SL No",
              className: "text-center",
              orderable: false,
              searchable: false,
          },
            {data: 'Full Name', name: 'Full Name'},
            {data: 'Email', name: 'Email'},
            {data: 'Mobile', name: 'Mobile'},
            {data: 'Gender', name: 'Gender'},
            {data: 'User Type', name: 'User Type'},
            {data: 'Address', name: 'Address'},
            {data: 'City', name: 'City'},
            {data: 'State', name: 'State'},
            {data: 'Pincode', name: 'Pincode'},
            {data: 'Created Date', name: 'Created Date'},
            {data: 'Status', name: 'Status'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

  });


//////////////////////////////////////////////
////////////  Roles  /////////////////////////
//////////////////////////////////////////

  $(function () {
    $('#add-roles-form').validate({
      rules: {
        name: {
            required: true,
            name: true,
        },
      },
      messages: {
        name: {
            required: "Please enter a name ",
            name: "Please enter a valid name"
        },
      },
      errorElement: 'span',
      errorPlacement: function (error, element) {
        error.addClass('invalid-feedback');
        element.closest('.form-group').append(error);
      },
      highlight: function (element, errorClass, validClass) {
        $(element).addClass('is-invalid');
      },
      unhighlight: function (element, errorClass, validClass) {
        $(element).removeClass('is-invalid');
      }
    });
  });

  $(function () {
    $('#roles-table').DataTable({
        processing: true,
        serverSide: true,
        paging:true,
        ajax: "roles/",

    columns: [
        {
            data: "DT_RowIndex",
            name: "SL No",
            className: "text-center",
            orderable: false,
            searchable: false,
        },
        {data: 'Name', name: 'Name'},
        {data: 'Status', name: 'Status'},
        {data: 'action', name: 'action', orderable: false, searchable: false},
    ],
    // columnDefs: [
    //     {
    //         targets: 0, // your case first column
    //         className: "text-center",
    //         width: "20%",
    //     },
    //     {
    //         targets: 1, // your case first column
    //         width: "60%",
    //     },
    // ],
    });
  });


  //////////////////////////////////////////////
////////////  Units  /////////////////////////
//////////////////////////////////////////

$(function () {
    $('#add-units-form').validate({
      rules: {
        name: {
            required: true,
            name: true,
        },
        sku: {
            required: true,
            name: true,
        },
      },
      messages: {
        name: {
            required: "Please enter a name ",
            name: "Please enter a valid name"
        },
        sku: {
            required: "Please enter a name ",
            name: "Please enter a valid name"
        },
      },
      errorElement: 'span',
      errorPlacement: function (error, element) {
        error.addClass('invalid-feedback');
        element.closest('.form-group').append(error);
      },
      highlight: function (element, errorClass, validClass) {
        $(element).addClass('is-invalid');
      },
      unhighlight: function (element, errorClass, validClass) {
        $(element).removeClass('is-invalid');
      }
    });
  });

  $(function () {
    $('#units-table').DataTable({
        processing: true,
        serverSide: false,
        paging: true,
        ajax: "units/",

    columns: [
        {
            data: "DT_RowIndex",
            name: "SL No",
            className: "text-center",
            orderable: false,
            searchable: false,
        },
        {data: 'Name', name: 'Name'},
        {data: 'Short Name', name: 'Short Name'},
        {data: 'Status', name: 'Status'},
        {data: 'action', name: 'action', orderable: false, searchable: false},
    ],

    });
  });


/////////////////////////////////////////////
////////////  Product Category  /////////////////////////
//////////////////////////////////////////

$(function () {
    $('#add-category-form').validate({
      rules: {
        name: {
            required: true,
            name: true,
        },
      },
      messages: {
        name: {
            required: "Please enter a name ",
            name: "Please enter a valid name"
        },
      },
      errorElement: 'span',
      errorPlacement: function (error, element) {
        error.addClass('invalid-feedback');
        element.closest('.form-group').append(error);
      },
      highlight: function (element, errorClass, validClass) {
        $(element).addClass('is-invalid');
      },
      unhighlight: function (element, errorClass, validClass) {
        $(element).removeClass('is-invalid');
      }
    });
  });

  $(function () {
    $('#category-table').DataTable({
        processing: true,
        serverSide: false,
        paging: true,
        ajax: "category/",

    columns: [
        {
            data: "DT_RowIndex",
            name: "SL No",
            className: "text-center",
            orderable: false,
            searchable: false,
        },
        {data: 'Category Name', name: 'Category Name'},
        {data: 'Sub Category Name', name: 'Sub Category Name'},
        {data: 'Status', name: 'Status'},
        {data: 'action', name: 'action', orderable: false, searchable: false},
    ],

    });
  });



  //Product settings
  $(function () {
    $('#add-brands-form').validate({
      rules: {
        name: {
            required: true,
            name: true,
        },
      },
      messages: {
        name: {
            required: "Please enter a name ",
            name: "Please enter a valid name"
        },
      },
      errorElement: 'span',
      errorPlacement: function (error, element) {
        error.addClass('invalid-feedback');
        element.closest('.form-group').append(error);
      },
      highlight: function (element, errorClass, validClass) {
        $(element).addClass('is-invalid');
      },
      unhighlight: function (element, errorClass, validClass) {
        $(element).removeClass('is-invalid');
      }
    });
  });

  $(function () {
    $('#brands-table').DataTable({
        processing: true,
        serverSide: false,
        paging: true,
        ajax: "brands/",

    columns: [
        {
            data: "DT_RowIndex",
            name: "SL No",
            className: "text-center",
            orderable: false,
            searchable: false,
        },
        {data: 'Name', name: 'Name'},
        {data: 'Status', name: 'Status'},
        {data: 'action', name: 'action', orderable: false, searchable: false},
    ],
    });
  });


  //taxrates
  $(function () {
    $('#add-taxrates-form').validate({
      rules: {
        name: {
            required: true,
            name: true,
        },
        sku: {
            required: true,
            name: true,
        },
      },
      messages: {
        name: {
            required: "Please enter a name ",
            name: "Please enter a valid name"
        },
        sku: {
            required: "Please enter a name ",
            name: "Please enter a valid name"
        },
      },
      errorElement: 'span',
      errorPlacement: function (error, element) {
        error.addClass('invalid-feedback');
        element.closest('.form-group').append(error);
      },
      highlight: function (element, errorClass, validClass) {
        $(element).addClass('is-invalid');
      },
      unhighlight: function (element, errorClass, validClass) {
        $(element).removeClass('is-invalid');
      }
    });
  });

  $(function () {
    $('#taxrates-table').DataTable({
        processing: true,
        serverSide: false,
        paging: true,
        ajax: "taxrates/",

    columns: [
        {
            data: "DT_RowIndex",
            name: "SL No",
            className: "text-center",
            orderable: false,
            searchable: false,
        },
        {data: 'Name', name: 'Name'},
        {data: 'Value', name: 'Value'},
        {data: 'Status', name: 'Status'},
        {data: 'action', name: 'action', orderable: false, searchable: false},
    ],
    });
  });




 //sweet alert


//////////////////////////////////////////////
///////Departments/////////////////////////
//////////////////////////////////////////

$(function () {
    $('#add-departments-form').validate({
      rules: {
        name: {
            required: true,
            name: true,
        },
      },
      messages: {
        name: {
            required: "Please enter a name ",
            name: "Please enter a valid name"
        },
      },
      errorElement: 'span',
      errorPlacement: function (error, element) {
        error.addClass('invalid-feedback');
        element.closest('.form-group').append(error);
      },
      highlight: function (element, errorClass, validClass) {
        $(element).addClass('is-invalid');
      },
      unhighlight: function (element, errorClass, validClass) {
        $(element).removeClass('is-invalid');
      }
    });
  });


  $(function () {
    $('#department-table').DataTable({
        processing: true,
        serverSide: false,
        paging: true,
         ajax: "departments/",
         columns: [
           {
               data: "DT_RowIndex",
               name: "SL No",
               className: "text-center",
               orderable: false,
               searchable: false,
           },
             {data: 'Name', name: 'Name'},
             {data: 'Status', name: 'Status'},
             {data: 'action', name: 'action', orderable: false, searchable: false},
         ]
     });

   });


//////////////////////////////////////////////
///////   Designations/////////////////////////
//////////////////////////////////////////

   $(function () {
    $('#add-designations-form').validate({
      rules: {
        name: {
            required: true,
            name: true,
        },
      },
      messages: {
        name: {
            required: "Please enter a name ",
            name: "Please enter a valid name"
        },
      },
      errorElement: 'span',
      errorPlacement: function (error, element) {
        error.addClass('invalid-feedback');
        element.closest('.form-group').append(error);
      },
      highlight: function (element, errorClass, validClass) {
        $(element).addClass('is-invalid');
      },
      unhighlight: function (element, errorClass, validClass) {
        $(element).removeClass('is-invalid');
      }
    });
  });

  $(function () {

    $('#designation-table').DataTable({
          processing: true,
          serverSide: false,
          paging: true,
         ajax: "designations/",
         columns: [
           {
               data: "DT_RowIndex",
               name: "SL No",
               className: "text-center",
               orderable: false,
               searchable: false,
           },
             {data: 'Name', name: 'Name'},
             {data: 'Status', name: 'Status'},
             {data: 'action', name: 'action', orderable: false, searchable: false},
         ]
     });

   });


   //////////////////////////////////////////////
   /////////////    Inventory   ////////////////
   /////////////////////////////////////////////


   //Product entry
   $(function () {
    $('#add-products-form').validate({
      rules: {
        name: {
            required: true,
            name: true,
        },
      },
      messages: {
        name: {
            required: "Please enter a name ",
            name: "Please enter a valid name"
        },
      },
      errorElement: 'span',
      errorPlacement: function (error, element) {
        error.addClass('invalid-feedback');
        element.closest('.form-group').append(error);
      },
      highlight: function (element, errorClass, validClass) {
        $(element).addClass('is-invalid');
      },
      unhighlight: function (element, errorClass, validClass) {
        $(element).removeClass('is-invalid');
      }
    });
  });

  $(function () {
    $('#products-table').DataTable({
        processing: true,
        serverSide: false,
        paging: true,
        ajax: "products/",

    columns: [
        {
            data: "DT_RowIndex",
            name: "SL No",
            className: "text-center",
            orderable: false,
            searchable: false,
        },
        {data: 'Product Category', name: 'Product Category'},
        {data: 'Product Name', name: 'Product Name'},
        {data: 'Brand', name: 'Brand'},
        {data: 'Model No', name: 'Model No'},
        {data: 'Serial No', name: 'Serial No'},
        {data: 'Tax Rate', name: 'Tax Rate'},
        {data: 'Hsn Code', name: 'Hsn Code'},
        {data: 'Added By', name: 'Added By'},
        {data: 'Created Date', name: 'Created Date'},
        {data: 'Status', name: 'Status'},
        {data: 'action', name: 'action', orderable: false, searchable: false},
    ],

    });
  });


     //Supplier entry
    $(function () {
        $('#add-suppliers-form').validate({
            rules: {
                name: {
                    required: true,
                    name: true,
                },
                business_name: {
                    required: true,
                    business_name: true,
                },
                email: {
                    required: true,
                    email: true,
                },
                address: {
                    required: true,
                    address: true,
                },
                gstin: {
                    required: true,
                    gstin: true,
                },
                state_id: {
                    required: true,
                    state_id: true,
                },
                city_id: {
                    required: true,
                    city_id: true,
                },
            },
            messages: {
                    name: {
                        required: "Please enter a name ",
                        name: "Please enter a valid name"
                    },

                    business_name: {
                        required: "Please enter a name ",
                        business_name: "Please enter a valid name"
                    },
                    email: {
                        required: "Please enter a name ",
                        email: "Please enter a valid name"
                    },
                    address: {
                        required: "Please enter a address ",
                        address: "Please enter a valid address"
                    },
                    gstin: {
                        required: "Please enter a gstin ",
                        gstin: "Please enter a valid gstin"
                    },
                    state_id: {
                        required: "Please enter a state ",
                        state_id: "Please enter a valid state"
                    },
                    city_id: {
                        required: "Please enter a city ",
                        city_id: "Please enter a valid city"
                    },
                },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
    });

      $(function () {
        $('#suppliers-table').DataTable({
            processing: true,
            serverSide: false,
            paging: true,
            ajax: "suppliers/",

        columns: [
            {
                data: "DT_RowIndex",
                name: "SL No",
                className: "text-center",
                orderable: false,
                searchable: false,
            },
            {data: 'Contact Name', name: 'Contact Name'},
            {data: 'Business Name', name: 'Business Name'},
            {data: 'Registration Number', name: 'Registration Number'},
            {data: 'Pan', name: 'Pan'},
            {data: 'Email', name: 'Email'},
            {data: 'Mobile', name: 'Mobile'},
            {data: 'Address', name: 'Address'},
            {data: 'City', name: 'City'},
            {data: 'State', name: 'State'},
            {data: 'Postcode', name: 'Postcode'},
            {data: 'Added By', name: 'Added By'},
            {data: 'Created Date', name: 'Created Date'},
            {data: 'Status', name: 'Status'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ],

        });
      });


    function calculateValueByTextChange() {
        // $(this).change(function(){
            var quantity = $('#input_quantity').val();
            var unit_price = $('#input_unit_price').val();
            $('#input_total_price').val(quantity * unit_price);
        // });
    }


    //net Amount calculation
    // function billAmount(subTotal,tax_rate,taxAmount,totalAmountEle,shippingChargeEle,taxAmountEle,invoiceAmountEle) {


    //     $(totalAmountEle).val(subTotal);

    //     let shipping_charge =$(shippingChargeEle).val();
    //     let pos = tax_rate.indexOf("%");
    //     var taxValue = tax_rate.substring(0, parseInt(pos));
    //     let taxamt = (parseInt(totalVal) * parseInt(taxValue))/100;
    //     taxAmount = taxAmount + parseInt(taxamt);
    //     $(taxAmountEle).val(taxAmount);

    //     let netTotal =  parseInt(subTotal) + parseInt(taxAmount) + parseInt(shipping_charge);

    //     $(invoiceAmountEle).val(netTotal);

    //  }

    //purchase list

    $(function () {
        $('#purchase-table').DataTable({
            processing: true,
            serverSide: false,
            paging: true,
            ajax: "purchases/",

        columns: [
            {
                data: "DT_RowIndex",
                name: "SL No",
                className: "text-center",
                orderable: false,
                searchable: false,
            },
            {data: 'Supplier Name', name: 'Supplier Name'},
            {data: 'Invoice Number', name: 'Invoice Number'},
            {data: 'Invoice Date', name: 'Invoice Date'},
            {data: 'Payment Mode', name: 'Payment Mode'},
            {data: 'Sub Total', name: 'Sub Total'},
            {data: 'Tax Amount', name: 'Tax Amount'},
            {data: 'Shipping Charge', name: 'Shipping Charge'},
            {data: 'Invoice Amount', name: 'Invoice Amount'},
            {data: 'Added By', name: 'Added By'},
            {data: 'Created Date', name: 'Created Date'},
            {data: 'Status', name: 'Status'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ],

        });
      });



     function purchaseDatapopulate(amount,tax_amount,shipping_charge)
     {
        var rowIdx = 0;
        var billAmount = 0;

        var subTotal = $('#'+amount).val();
        var taxAmount =  $('#'+tax_amount).val();
        var shiping = $('#'+shipping_charge).val();

        var totalVal=0;
        var tax_rate =0;

        // jQuery button click event to add a row
        $('#addBtn').on('click', function () {

            var product_id = $('#input_product_id').val();
            var quantity = $('#input_quantity').val();
            var unit_id = $('#input_unit_id').val();
            var tax_rate_id = $('#input_taxrate_id').val();
            var unit_price = $('#input_unit_price').val();
            var total_price = $('#input_total_price').val();
            var product = $( "#input_product_id option:selected" ).text()
            var unit = $( "#input_unit_id option:selected" ).text()
            tax_rate = $( "#input_taxrate_id option:selected" ).text()


            // $('#product_error').attr('style','display:none;');
            if(product_id =='' || quantity =='' || unit_id =='' || unit_price ==''){

                $('#input_product_id').attr('style','border:#B03A2E 1px solid;');
                $('#input_quantity').attr('style','border:#B03A2E 1px solid;');
                $('#input_unit_id').attr('style','border:#B03A2E 1px solid;');
                $('#input_unit_price').attr('style','border:#B03A2E 1px solid;');
                $('#input_taxrate_id').attr('style','border:#B03A2E 1px solid;');
                $('#product_error').attr('style','display:solid;');
                $('#product_error').append(`<ul><li>Value required</li></ul>`);
                return false;
            }else{
                $('#product_error').attr('style','display:none;');

                $("#input_product_id").removeAttr("style");
                $("#input_quantity").removeAttr("style");
                $("#input_unit_id").removeAttr("style");
                $("#input_unit_price").removeAttr("style");
                $("#input_taxrate_id").removeAttr("style");
                // $('#product_error').removeAttr("style");



                // Adding a row inside the tbody.
                $('#item_row').append(`<tr id="R${++rowIdx}" >
                    <td>${rowIdx}</td>
                    <td>
                        <select id="product_id" name="product_items[${rowIdx}][product_id]" value="${product}" class="form-control" readonly>
                            <option value="${product_id}">${product}</option>
                        </select>
                    </td>

                    <td>
                        <input id="quantity${rowIdx}" type="text" name="product_items[${rowIdx}][quantity]" value="${quantity}" class="form-control" readonly/>
                    </td>
                    <td>
                        <select id="unit_id" type="text" name="product_items[${rowIdx}][unit_id]" class="form-control"><option value="${unit_id}">${unit}</option>
                        </select>
                    </td>
                    <td>
                        <select id="tax_rate_id${rowIdx}" type="text" name="product_items[${rowIdx}][tax_rate_id]" class="form-control"><option value="${tax_rate_id }">${tax_rate}</option>
                        </select>
                    </td>
                    <td>
                        <input id="unit_amount${rowIdx}" type="decimal" value="${unit_price}" name="product_items[${rowIdx}][unit_amount]" class="form-control" readonly/>
                    </td>
                    <td>
                        <input id="total_amount${rowIdx}" type="decimal" value="${total_price}" name="product_items[${rowIdx}][total_amount]" class="form-control" readonly/>
                    </td>
                    <td class="text-center">
                        <button class="btn btn-danger remove"
                        type="button"><i class="fa fa-trash" aria-hidden="true"></i></button>
                        </td>
                    </tr>`);
                }

                clearPurchaseFields();
                totalVal = $('#total_amount'+rowIdx).val();
                subTotal = parseInt(totalVal) + parseInt(subTotal);
                amountCalculation(subTotal,totalVal,taxAmount,tax_rate,rowIdx,'add');

            });



            // jQuery button click event to remove a row.
            $('#item_row').on('click', '.remove', function () {

                var child = $(this).closest('tr').nextAll();
                child.each(function () {

                var id = $(this).attr('id');
                var idx = $(this).children('.row-index').children('p');
                var dig = parseInt(id.substring(1));
                idx.html(`Row ${dig - 1}`);
                $(this).attr('id', `R${dig - 1}`);
                });
                console.log(subTotal);

                totalVal = $('#total_amount'+rowIdx).val();
                console.log(totalVal);
                subTotal =  parseInt(subTotal) - parseInt(totalVal);

                amountCalculation(subTotal,totalVal,taxAmount,tax_rate,rowIdx,'remove');

                $(this).closest('tr').remove();

                //

                rowIdx--;

            clearPurchaseFields();
        });
     }

    function clearPurchaseFields(){
        $('#input_product_id').val('');
        $('#input_quantity').val('');
        $('#input_unit_id').val('');
        $('#input_unit_price').val('');
        $('#input_total_price').val('');
        $('#input_taxrate_id').val('');

    }

    function billAmountFieldChange(){
        let subTol = $('#amount').val();
        let taxamt =  $('#tax_amount').val();
        let shiping = $('#shipping_charge').val();

        let netamt = parseInt(subTol) +  parseInt(taxamt) + parseInt(shiping);
        $('#invoice_amount').val(netamt);

        produceError(subTol);
     }
    function produceError(subTol)
    {
        let billamt = $('#amount').val();
        console.log(billamt);
        console.log(subTol);
        if(subTol != billamt){
            //alert('df');
            // $('#amount').attr('style','border:#B03A2E 1px solid;');
        }
    }

    function amountCalculation(subTotal,totalVal,taxAmount,tax_rate,rowIdx,type)
    {
        var netTotal=0;

        var taxAmount = $('#tax_amount').val();

        if(type == 'add'){


            $('#amount').val(subTotal);

            let shipping_charge =$('#shipping_charge').val();
            let pos = tax_rate.indexOf("%");
            var taxValue = tax_rate.substring(0, parseInt(pos));
            let taxamt = (parseInt(totalVal) * parseInt(taxValue))/100;
            taxAmount = parseInt(taxAmount) + parseInt(taxamt);
            $('#tax_amount').val(taxAmount);

            netTotal =  parseInt(subTotal) + parseInt(taxAmount) + parseInt(shipping_charge);

        }else{

            totalVal = $('#total_amount'+rowIdx).val();

            // subTotal =  parseInt(subTotal) - parseInt(totalVal);
            $('#amount').val(subTotal);

            let shipping_charge = $('#shipping_charge').val();
            let pos = tax_rate.indexOf("%");
            var taxValue = tax_rate.substring(0, parseInt(pos));
            let taxamt = (parseInt(totalVal) * parseInt(taxValue))/100;
            taxAmount = parseInt(taxAmount) - parseInt(taxamt);
            $('#tax_amount').val(taxAmount);

            netTotal =  parseInt(subTotal) - (parseInt(totalVal) + parseInt(taxamt) + parseInt(shipping_charge));
        }


        $('#invoice_amount').val(netTotal);
    }

    //puchase validation
    $(function () {
        // $.validator.setDefaults({
        //     submitHandler: function () {
        //         // action="{{ route('save-user')}}" method="post"
        //         alert( "Form successful submitted!" );
        //     }
        //     });
        $('#add-purchase-form').validate({
          rules: {
            supplier_id: {
                required: true,
                supplier_id: true,
            },
            invoice_number: {
                required: true,
                invoice_number: true,
            },
            invoice_date: {
                required: true,
                invoice_date: true,
            },
            payment_mode: {
                required: true,
                payment_mode: true,
            },
            // amount_val: {
            //     required: true,
            //     amount_val: true,
            // },
            // tax_amount: {
            //     required: true,
            //     tax_amount: true,
            // },
            // invoice_amount: {
            //     required: true,
            //     name: true,
            // },
          },
          messages: {
            supplier_id: {
                required: "Please select supplier name ",
                supplier_id: "Please select supplier name"
            },
            invoice_number: {
                required: "Please enter a invoice number ",
                invoice_number: "Please enter a valid invoice number"
            },
            invoice_date: {
                required: "Please enter a invoice date ",
                invoice_date: "Please enter a valid invoice date"
            },
            payment_mode: {
                required: "Please select payment mode ",
                payment_mode: "Please select payment mode"
            },
            // amount_val: {
            //     required: "Please enter a amount ",
            //     amount_val: "Please enter a valid amount"
            // },
            // tax_amount: {
            //     required: "Please enter a tax_amount ",
            //     tax_amount: "Please enter a valid tax amount"
            // },
            // invoice_amount: {
            //     required: "Please enter a invoice amount ",
            //     tax_amount: "Please enter a valid invoice amount"
            // },
          },
          errorElement: 'span',
          errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
          },
          highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
          },
          unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
          }
        });
      });


      //Item Transactions

    function itemlist(productId){
        $(function () {
            var url = "../items-show/"+productId;
            $('#purchase-items-table').DataTable({
                processing: true,
                serverSide: false,
                paging: true,
                ajax: url,

            columns: [
                {
                    data: "DT_RowIndex",
                    name: "SL No",
                    className: "text-center",
                    orderable: false,
                    searchable: false,
                },
                {data: 'Product Name', name: 'Product Name'},
                {data: 'Type', name: 'Type'},
                {data: 'Quantity', name: 'Quantity'},
                {data: 'Unit', name: 'Unit'},
                {data: 'Tax Rate', name: 'Tax Rate'},
                {data: 'Unit Amount', name: 'Unit Amount'},
                {data: 'Total Amount', name: 'Total Amount'},
                {data: 'Tax Amount', name: 'Tax Amount'},
                {data: 'Net Amount', name: 'Net Amount'},
                {data: 'Status', name: 'Status'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],

            });
          });

    }


    //stock
    $(function () {
        $('#stock-table').DataTable({
            processing: true,
            serverSide: false,
            paging: true,
            ajax: "stock-list",

        columns: [
            {
                data: "DT_RowIndex",
                name: "SL No",
                className: "text-center",
                orderable: false,
                searchable: false,
            },
            {data: 'Product Name', name: 'Product Name'},
            {data: 'Quantity', name: 'Quantity'},
            {data: 'Unit', name: 'Quantity'},
            {data: 'Status', name: 'Status'},
            // {data: 'action', name: 'action', orderable: false, searchable: false},
        ],

        });
      });



    ////////////////////////////////////////////////////////
    ////////////// project Location /////////////////////

    //District
    $(function () {
        $('#add-district-form').validate({
          rules: {
            state_id: {
                required: true,
                state_id: true,
            },
            name: {
                required: true,
                name: true,
            },
          },
          messages: {
            state_id: {
                required: "Please enter a name ",
                state_id: "Please enter a state name"
            },
            name: {
                required: "Please enter a name ",
                name: "Please enter a valid name"
            },
          },
          errorElement: 'span',
          errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
          },
          highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
          },
          unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
          }
        });
      });

      $(function () {

        $('#district-table').DataTable({
            processing: true,
            serverSide: false,
            paging: true,
             ajax: "districts/",
             columns: [
               {
                   data: "DT_RowIndex",
                   name: "SL No",
                   className: "text-center",
                   orderable: false,
                   searchable: false,
               },
                 {data: 'State Name', name: 'State Name'},
                 {data: 'Code', name: 'Code'},
                 {data: 'District Name', name: 'District Name'},
                 {data: 'Status', name: 'Status'},
                 {data: 'action', name: 'action', orderable: false, searchable: false},
             ]
         });

       });

    //Block
    $(function () {
        $('#add-block-form').validate({
          rules: {
            district_id: {
                required: true,
                state_id: true,
            },
            name: {
                required: true,
                name: true,
            },
          },
          messages: {
            district_id: {
                required: "Please enter a name ",
                district_id: "Please enter a state name"
            },
            name: {
                required: "Please enter a name ",
                name: "Please enter a valid name"
            },
          },
          errorElement: 'span',
          errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
          },
          highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
          },
          unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
          }
        });
      });

      $(function () {

        $('#block-table').DataTable({
            processing: true,
            serverSide: false,
            paging: true,
             ajax: "blocks/",
             columns: [
               {
                   data: "DT_RowIndex",
                   name: "SL No",
                   className: "text-center",
                   orderable: false,
                   searchable: false,
               },
                 {data: 'District Name', name: 'District Name'},
                 {data: 'Code', name: 'Code'},
                 {data: 'Block Name', name: 'Block Name'},
                 {data: 'Status', name: 'Status'},
                 {data: 'action', name: 'action', orderable: false, searchable: false},
             ]
         });

       });

    //Panchayats
    $(function () {
        $('#add-panchayat-form').validate({
          rules: {
           block_id: {
                required: true,
                state_id: true,
            },
            name: {
                required: true,
                name: true,
            },
          },
          messages: {
            block_id: {
                required: "Please enter a name ",
                block_id: "Please enter a state name"
            },
            name: {
                required: "Please enter a name ",
                name: "Please enter a valid name"
            },
          },
          errorElement: 'span',
          errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
          },
          highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
          },
          unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
          }
        });
      });

      $(function () {

        $('#panchayat-table').DataTable({
            processing: true,
            serverSide: false,
            paging: true,
             ajax: "panchayats/",
             columns: [
               {
                   data: "DT_RowIndex",
                   name: "SL No",
                   className: "text-center",
                   orderable: false,
                   searchable: false,
               },
                 {data: 'District Name', name: 'District Name'},
                 {data: 'Block Name', name: 'Block Name'},
                 {data: 'Code', name: 'Code'},
                 {data: 'Panchayat Name', name: 'Panchayat Name'},
                 {data: 'Status', name: 'Status'},
                 {data: 'action', name: 'action', orderable: false, searchable: false},
             ]
         });

       });


    //Villages
    $(function () {
        $('#add-village-form').validate({
          rules: {
           panchayat_id: {
                required: true,
                state_id: true,
            },
            name: {
                required: true,
                name: true,
            },
          },
          messages: {
            panchayat_id: {
                required: "Please enter a name ",
                panchayat_id: "Please enter a state name"
            },
            name: {
                required: "Please enter a name ",
                name: "Please enter a valid name"
            },
          },
          errorElement: 'span',
          errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
          },
          highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
          },
          unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
          }
        });
      });

      $(function () {

        $('#village-table').DataTable({
            processing: true,
            serverSide: false,
            paging: true,
             ajax: "villages/",
             columns: [
               {
                   data: "DT_RowIndex",
                   name: "SL No",
                   className: "text-center",
                   orderable: false,
                   searchable: false,
               },
                 {data: 'District Name', name: 'District Name'},
                 {data: 'Block Name', name: 'Block Name'},
                 {data: 'Panchayat Name', name: 'Panchayat Name'},
                 {data: 'Village Name', name: 'Village Name'},
                 {data: 'Status', name: 'Status'},
                 {data: 'action', name: 'action', orderable: false, searchable: false},
             ]
         });

       });


    //client

         //Supplier entry
         $(function () {
            $('#add-client-form').validate({
                rules: {
                    name: {
                        required: true,
                        name: true,
                    },
                    business_name: {
                        required: true,
                        business_name: true,
                    },
                    email: {
                        required: true,
                        email: true,
                    },
                    address: {
                        required: true,
                        address: true,
                    },
                    type: {
                        required: true,
                        type: true,
                    },
                    state_id: {
                        required: true,
                        state_id: true,
                    },
                    city_id: {
                        required: true,
                        city_id: true,
                    },
                    postcode: {
                        required: true,
                        postcode: true,
                    },
                },
                messages: {
                        name: {
                            required: "Please enter a name ",
                            name: "Please enter a valid name"
                        },
                        business_name: {
                            required: "Please enter a name ",
                            business_name: "Please enter a valid name"
                        },
                        email: {
                            required: "Please enter a name ",
                            email: "Please enter a valid name"
                        },
                        address: {
                            required: "Please enter a address ",
                            address: "Please enter a valid address"
                        },
                        type: {
                            required: "Please select a type ",
                            type: "Please enter a valid type"
                        },
                        state_id: {
                            required: "Please select a state ",
                            state_id: "Please select a valid state"
                        },
                        city_id: {
                            required: "Please select a city ",
                            city_id: "Please select a valid city"
                        },
                        postcode: {
                            required: "Please enter a postcode ",
                            postcode: "Please enter a valid postcode"
                        },
                    },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });

          $(function () {
            $('#clients-table').DataTable({
              processing: true,
              serverSide: false,
              paging: true,
                ajax: "clients/",

            columns: [
                {
                    data: "DT_RowIndex",
                    name: "SL No",
                    className: "text-center",
                    orderable: false,
                    searchable: false,
                },
                {data: 'Client Name', name: 'Client Name'},
                {data: 'Business Name', name: 'Business Name'},
                {data: 'Type', name: 'Type'},
                {data: 'Email', name: 'Email'},
                {data: 'Mobile', name: 'Mobile'},
                {data: 'Address', name: 'Address'},
                {data: 'City', name: 'City'},
                {data: 'State', name: 'State'},
                {data: 'Postcode', name: 'Postcode'},
                {data: 'Added By', name: 'Added By'},
                {data: 'Created Date', name: 'Created Date'},
                {data: 'Status', name: 'Status'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],

            });
          });


    //Project
    $(function () {

            $('#add-project-form').validate({
              rules: {
                name: {
                    required: true,
                    name: true,
                },
                project_type: {
                    required: true,
                    project_type: true,
                  },
                short_desc: {
                  required: true,
                  short_desc: true,
                },
                start_date: {
                  required: true,
                  start_date: true
                },
              },
              messages: {
                name: {
                    required: "Please enter a name ",
                    name: "Please enter a valid name"
                },
                project_type: {
                    required: "Please enter a project type ",
                    project_type: "Please enter a valid project type "
                    },
                short_desc: {
                  required: "Please enter a short description ",
                  short_desc: "Please enter a valid short description "
                },
                start_date: {
                  required: "Please provide a date",
                  start_date: "Please provide a date"
                }
              },
              errorElement: 'span',
              errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
              },
              highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
              },
              unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
              }
            });
    });


    $(function () {

        var table = $('#project-table').DataTable({
          processing: true,
          serverSide: false,
          paging: true,
            ajax: "/project",
            columns: [
                {
                    data: "DT_RowIndex",
                    name: "SL No",
                    className: "text-center",
                    orderable: false,
                    searchable: false,
                },
                {data: 'Project Name', name: 'Project Name'},
                {data: 'Short Desciption', name: 'Short Desciption'},
                {data: 'Desciption', name: 'Desciption'},
                {data: 'Project Manager', name: 'Project Manager'},
                {data: 'Project Type', name: 'Project Type'},
                {data: 'Start Date', name: 'Start Date'},
                {data: 'Deadline', name: 'Deadline'},
                {data: 'Project Extimated Cost', name: 'Project Extimated Cost'},
                {data: 'Client Name', name: 'Client Name'},
                {data: 'Added By', name: 'Added By'},
                {data: 'Created Date', name: 'Created Date'},
                {data: 'Project Status', name: 'Project Status'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });

    });

    //Project Phase
    $(function () {

        var table = $('#project-phase-table').DataTable({
            processing: true,
            serverSide: false,
            paging: true,
            ajax: "/project/phases",
            columns: [
                {
                    data: "DT_RowIndex",
                    name: "SL No",
                    className: "text-center",
                    orderable: false,
                    searchable: false,
                },
                {data: 'Project Name', name: 'Project Name'},
                {data: 'Title', name: 'Title'},
                {data: 'Category', name: 'Category'},

                {data: 'Phase Manager', name: 'Phase Manager'},
                {data: 'Description', name: 'Description'},

                {data: 'Start Date', name: 'Start Date'},
                {data: 'Deadline', name: 'Deadline'},
                {data: 'Phase Extimated Cost', name: 'Phase Extimated Cost'},
                {data: 'Added By', name: 'Added By'},
                {data: 'Created Date', name: 'Created Date'},
                {data: 'Project Status', name: 'Project Status'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });

    });


    // Expense Section

    $(function () {
        $('#expense-table').DataTable({
          processing: true,
          serverSide: false,
          paging: true,
            ajax: "expenses/",

        columns: [
            {
                data: "DT_RowIndex",
                name: "SL No",
                className: "text-center",
                orderable: false,
                searchable: false,
            },
            {data: 'Expense Type', name: 'Expense Type'},
            {data: 'Status', name: 'Status'},

            {data: 'Amount', name: 'Amount'},
            {data: 'Description', name: 'Description'},

            {data: 'Added By', name: 'Added By'},
            {data: 'Created Date', name: 'Created Date'},

            {data: 'action', name: 'action', orderable: false, searchable: false},
        ],

        });
      });

//sweet alert
function deleteConfirmation(id,model){
        console.log(model);

        if(model == 'item'){
            var url = "../../purchases/items-delete/"+id;
        }else if(model == 'purchase'){
            var url = "purchases/delete/"+id;
        }

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            customClass: {
            confirmButton: 'btn btn-primary',
            cancelButton: 'btn btn-outline-danger ms-1'
            },
            buttonsStyling: false
        }).then(function (result) {
            if (result.value) {
                $.ajax({
                    url:url,
                    type: "GET",
                    // data: {
                    //     id: 5
                    // },
                    dataType: "html",
                    success: function (data) {

                        Swal.fire({
                            icon: 'success',
                            title: 'Deleted!',
                            text: 'Your file has been deleted.',
                            customClass: {
                            confirmButton: 'btn btn-success'
                            }
                        }).then(function(success){
                            location.reload();
                        });
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        var err = JSON.parse(xhr.responseText);
                        Swal.fire({
                            title: 'Cancelled',
                            text: err.message,
                            icon: 'error',
                            customClass: {
                            confirmButton: 'btn btn-success'
                            }
                        });

                    },

                });
            } else if (result.dismiss === Swal.DismissReason.cancel) {
            Swal.fire({
                title: 'Cancelled',
                text: 'Your imaginary file is safe :)',
                icon: 'error',
                customClass: {
                confirmButton: 'btn btn-success'
                }
            });
            }
        });
}


