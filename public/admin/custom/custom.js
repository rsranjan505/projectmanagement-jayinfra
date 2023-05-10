
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


$(function () {
    $.validator.setDefaults({
      submitHandler: function () {
        // action="{{ route('save-user')}}" method="post"
        alert( "Form successful submitted!" );
      }
    });
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

