@include('layout.header')
<title>Dashboard Page</title>
<!-- Required meta tags -->
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

<!-- Bootstrap CSS v5.2.1 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <main>
        <div class="container ">
            <div class="row">
                <div>
                    <h4 class="text-center text-danger my-3">Dashboard page</h4>
                    <a href="{{ route('addPage') }}" class="btn btn-success">+ Add</a>
                    <a href="#" class="btn btn-primary" id="logout">Logout</a>

                    <div class="table-responsive mt-2">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Image</th>
                                    <th class="text-center" colspan="3">Status</th>
                                </tr>
                            </thead>
                            <tbody id="postContainer" class=" shadow p-3">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Single Modal -->
        <div class="modal fade" id="singleRecord" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title offset-3" id="staticBackdropLabel">Single Record Show</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        ...
                    </div>
                </div>
            </div>
        </div>


        <!-- Update Modal -->
        <div class="modal fade" id="updateRecord" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title offset-3" id="staticBackdropLabel">Update Record</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div id="error-message" class="alert alert-danger d-none" role="alert"></div>
                    <div class="modal-body">
                        <form id="updateForm">
                            <input type="hidden" name="" id="EditId" class="form-control">
                            <div class="mb-3">
                                <label for="" class="form-label">Name</label>
                                <input type="text" name="" id="EditTitle" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Email</label>
                                <input type="email" name="" id="EditDescription" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Image</label>
                                <br>
                                <img id="EditImageShow" class="img-fluid rounded-top" width="100px" />
                                <br>
                                <input type="file"
                                    onchange="document.querySelector('#EditImageShow').src=window.URL.createObjectURL(this.files[0])"
                                    id="EditImage" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-primary">
                                Submit
                            </button>

                        </form>
                    </div>

                </div>
            </div>
        </div>



        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script>
            // ADD DATA
            function loadData() {
                // const token = localStorage.getItem('api_token');

                fetch('/api/posts', {
                        method: 'GET',
                        headers: {
                            // 'Authorization': `bearer ${token}`
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        var allpost = data.data;

                        const postContainer = document.querySelector('#postContainer');
                        postContainer.innerHTML = '';

                        allpost.forEach(post => {
                            var tabledata = `
                <tr>
                    <td>${post.id}</td>
                    <td>${post.title}</td>
                    <td>${post.description}</td>
                    <td><img src="/uploads/${post.image}" width="70px"></td>
                    <td><a href="" data-bs-postid="${post.id}" data-bs-toggle="modal" data-bs-target="#singleRecord" class="text-primary">View</a></td>
                    <td><a href="" data-bs-editid="${post.id}" data-bs-toggle="modal" data-bs-target="#updateRecord" class="text-success">Update</a></td>
                    <td><a href="" onclick="deletePost(${post.id})" class="text-danger">Delete</a></td>
                </tr>
                `;
                            postContainer.innerHTML += tabledata;
                        });
                    });
            }
            loadData();





            //Single Record

            var singleData = document.getElementById('singleRecord')
            singleData.addEventListener('show.bs.modal', function(event) {
                var button = event.relatedTarget
                var id = button.getAttribute('data-bs-postid')

                // console.log(id);

                // const token = localStorage.getItem('api_token');
                fetch(`/api/posts/${id}`, {
                        method: 'GET',
                        headers: {
                            // 'Authorization': `bearer ${token}`
                            'Content-Type': 'application/json',
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        // console.log(data.data);
                        const post = data.data;
                        //  alert(post);
                        const modelBody = document.querySelector('#singleRecord .modal-body');
                        modelBody.innerHTML = "";
                        modelBody.innerHTML = `
                        Name: ${post.title}
                        <br>
                        Email : ${post.description}
                        <br>
                        Image :<br>
                        <img src="http://localhost:8000/uploads/${post.image}" width="80px">
                   `;

                    })
            });



            // Update Record Show

            var editShow = document.getElementById('updateRecord')
            editShow.addEventListener('show.bs.modal', function(event) {
                var button = event.relatedTarget
                var id = button.getAttribute('data-bs-editid')
                // console.log(id);
                fetch(`/api/posts/${id}`, {
                        method: 'GET',
                        headers: {
                            //'Authorization': `bearer ${token}`,
                            'Content-Type': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        // console.log(data.data);
                        const edit = data.data;
                        document.querySelector('#EditId').value = edit.id;
                        document.querySelector('#EditTitle').value = edit.title;
                        document.querySelector('#EditDescription').value = edit.description;
                        document.querySelector('#EditImageShow').src =
                            `/uploads/${edit.image}`;

                    })
            })


            // Update Data
            const updateFormData = document.querySelector('#updateForm');
            updateFormData.onsubmit = async (e) => {
                e.preventDefault();

                const editid = document.querySelector('#EditId').value;
                const title1 = document.querySelector('#EditTitle').value;
                const description1 = document.querySelector('#EditDescription').value;

                var updateData = new FormData();
                updateData.append('id', editid);
                updateData.append('title', title1);
                updateData.append('description', description1);

                const imageInput = document.querySelector('#EditImage');
                if (imageInput.files.length > 0) {
                    const image1 = imageInput.files[0];
                    updateData.append('image', image1);
                }

                var response = await fetch(`/api/posts/${editid}`, {
                    method: 'POST',
                    body: updateData,
                    headers: {
                        'X-HTTP-Method-Override': 'PUT'
                    }
                })
                var data = await response.json();
                if (data.status) {
                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: "Data Updated !!",
                        showConfirmButton: false,
                        timer: 1000
                    }).then(() => {
                        window.location.href = "http://localhost:8000/api/Dashborad";
                    });
                } else {
                    if (data.errors) {
                        var errorMessage = Object.values(data.errors).map(err => err.join('<br>')).join('<br>');
                        document.getElementById('error-message').innerHTML = errorMessage;
                        document.getElementById('error-message').classList.remove('d-none');
                    } else {
                        document.getElementById('error-message').innerHTML = "Fill All The Fields.";
                        document.getElementById('error-message').classList.remove('d-none');
                    }
                }
            }


            //Delete Record 
            async function deletePost(delId) {
                // const token = localStorage.getItem('api_token');

                let response = await fetch(`/api/posts/${delId}`, {
                        method: 'DELETE',
                        headers: {
                            //  'Authorization': `bearer${token}`
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        console.log(data);

                    })
            }


            document.querySelector("#logout").addEventListener('click', function() {
                const token = localStorage.getItem('api_token');

                fetch('/api/logout', {
                        method: 'POST',
                        headers: {
                            'Authorization': `Bearer ${token}`,
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        // console.log(data);
                        window.location.href = "http://localhost:8000/";
                    })
            })
        </script>

    </main>

    @include('layout.footer')
