@include('layout.header')
<title>Add Page</title>
@include('layout.navbar')
<main>
    <div class="container mt-5">
        <div class="row">
            <div class="col-5 mx-auto px-4 py-3 border rounded">
                <h4 class="text-danger text-center">Fill The Form</h4>
                <div id="error-message" class="alert alert-danger d-none" role="alert"></div>
                <form id="addform">
                    <div class="mb-3">
                        <label for="Title" class="form-label">Name</label>
                        <input type="text" name="title" id="Title" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="Description" class="form-label">Email</label>
                        <input type="email" name="description" id="Description" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" name="image" id="image" class="form-control">
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
            const title = document.querySelector('#Title').value;
            const description = document.querySelector('#Description').value;
            const image = document.querySelector('#image').files[0];

            var formData = new FormData();
            formData.append('title', title);
            formData.append('description', description);
            formData.append('image', image);

            var response = await fetch('/api/posts', {
                method: 'POST',
                body: formData,
                headers: {
                    'Authorization': `Bearer ${token}`,
                }
            });

            var data = await response.json();
            if (data.status) {
                Swal.fire({
                    position: "top-end",
                    icon: "success",
                    title: "Data Inserted !!",
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    window.location.href = "http://localhost:8000/api/Dashborad";
                });
            } else {
                var errorMessage = Object.values(data.errors).map(err => err.join('<br>')).join('<br>');
                document.getElementById('error-message').innerHTML = errorMessage;
                document.getElementById('error-message').classList.remove('d-none');
            }
        }
    </script>

</main>
@include('layout.footer')
