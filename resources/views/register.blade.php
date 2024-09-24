@include('layout.header')
<title>Register Page</title>
@include('layout.navbar')
<main>
    <div class="container mt-5">
        <div class="row">
            <div class="col-5 mx-auto px-4 py-3 border rounded">
                <h4 class="text-danger text-center">Register Form</h4>
                <div id="error-message" class="alert alert-danger d-none" role="alert"></div>
                <form id="addform">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" id="name" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" id="password" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">
                        Submit
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        const addForm = document.querySelector('#addform');
        addForm.onsubmit = async (e) => {
            e.preventDefault();

            const token = localStorage.getItem('api_token');

            const name = document.querySelector('#name').value;
            const email = document.querySelector('#email').value;
            const password = document.querySelector('#password').value;

            const formData = new FormData();
            formData.append('name', name);
            formData.append('email', email);
            formData.append('password', password);

            var response = await fetch('/api/register', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        // 'Authorization': `bearer ${token}`,
                    }
                })
                .then(response => response.json())
                .then(data => {
                        if (data.status) {
                            Swal.fire({
                                position: "top-end",
                                icon: "success",
                                title: "User Register Successfully !!",
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                                window.location.href = "http://localhost:8000/api/loginPage";
                            });

                        } else {
                            var errorMessage = Object.values(data.errors).map(err => err.join('<br>')).join('<br>');
                            document.getElementById('error-message').innerHTML = errorMessage;
                            document.getElementById('error-message').classList.remove('d-none');
                        }
                    }

                );
        }
    </script>

</main>
@include('layout.footer')
