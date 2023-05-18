
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


