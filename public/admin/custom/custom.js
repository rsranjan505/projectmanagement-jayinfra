
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
            res.data.forEach((val, key) => {
                html += "<option value=" + val.id + ">" + val.name + "</option>";
            });
            html += '</select>';
            $("#city_id").html("");
            $("#city_id").html(html);
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
        serverSide: true,
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
        serverSide: true,
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
        serverSide: true,
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
        serverSide: true,
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
        serverSide: true,
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
           serverSide: true,
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
           serverSide: true,
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
        serverSide: true,
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
        $('#suppliers-table').DataTable({
            processing: true,
            serverSide: true,
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



     function purchaseDatapopulate()
     {
        var rowIdx = 0;
        var subTotal = 0;
        var taxAmount = 0;
        var billAmount = 0;

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

                $(this).closest('tr').remove();

                // amountCalculation(subTotal,totalVal,taxAmount,tax_rate,rowIdx,'remove');

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
        if(type == 'add'){


            $('#amount').val(subTotal);

            let shipping_charge =$('#shipping_charge').val();
            let pos = tax_rate.indexOf("%");
            var taxValue = tax_rate.substring(0, parseInt(pos));
            let taxamt = (parseInt(totalVal) * parseInt(taxValue))/100;
            taxAmount = taxAmount + parseInt(taxamt);
            $('#tax_amount').val(taxAmount);

            netTotal =  parseInt(subTotal) + parseInt(taxAmount) + parseInt(shipping_charge);

        }else{

            // totalVal = $('#total_amount'+rowIdx).val();
          console.log(totalVal);
          console.log(rowIdx);

            subTotal =  parseInt(subTotal) - parseInt(totalVal);
            $('#amount').val(subTotal);

            let shipping_charge = $('#shipping_charge').val();
            let pos = tax_rate.indexOf("%");
            var taxValue = tax_rate.substring(0, parseInt(pos));
            let taxamt = (parseInt(totalVal) * parseInt(taxValue))/100;
            taxAmount = taxAmount - parseInt(taxamt);
            $('#tax_amount').val(taxAmount);

            netTotal =   p(arseInt(taxAmount) + parseInt(shipping_charge)) - parseInt(subTotal);
        }


        $('#invoice_amount').val(netTotal);
    }

    //puchase validation
    $(function () {

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
               serverSide: true,
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
               serverSide: true,
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
               serverSide: true,
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
               serverSide: true,
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


//sweet alert
function deleteConfirmation(id,model){

    // var id = id;
    // if(model=='feature'){
    //     var url ='';
    // }else if(model=='amenity'){
    //     var url ='';
    // }

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
            Swal.fire({
                icon: 'success',
                title: 'Deleted!',
                text: 'Your file has been deleted.',
                customClass: {
                confirmButton: 'btn btn-success'
                }
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


