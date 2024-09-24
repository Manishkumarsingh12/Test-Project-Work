@include('layout.header')
<title>Login Page</title>
@include('layout.navbar')
<main>
    <div class="conatiner mt-5">
        <div class="row">
            <div class="col-4 mx-auto px-4 py-3 border rounded">
                <h4 class="text-danger text-center">Fill The Form</h4>
                <div id="error-message" class="alert alert-danger d-none" role="alert"></div>
                <div class="mb-3">
                    <label for="" class="form-label">Email</label>
                    <input type="email" name="" id="email" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Password</label>
                    <input type="password" name="" id="password" class="form-control">
                </div>
                <button type="submit" id="login" class="btn btn-primary">
                    Login
                </button>
            </div>
        </div>
    </div>



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#login').on('click', function() {
                var email = $('#email').val();
                var password = $('#password').val();

                $.ajax({
                    url: '/api/login',
                    method: 'POST',
                    contentType: 'application/json',
                    data: JSON.stringify({
                        email: email,
                        password: password
                    }),
                    success: function(response) {
                        localStorage.setItem('api_token', response.token);
                        Swal.fire({
                            position: "top-end",
                            icon: "success",
                            title: "Login Successfull !!",
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            window.location.href =
                                "http://localhost:8000/api/Dashborad";
                        });
                    },
                    error: function(jqXHR) {
                        var errors = jqXHR.responseJSON.error;
                        var errorMessage = Array.isArray(errors) ? errors.join('<br>') : errors;
                        $('#error-message').html(errorMessage).removeClass('d-none');

                    }

                });
            });
        });
    </script>




</main>
@include('layout.footer')
