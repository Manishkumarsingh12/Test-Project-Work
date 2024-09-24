@include('layout.header')
<title>Home Page</title>
@include('layout.navbar')

<main>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 p-0">
                <img src="{{ asset('images/img1.avif') }}" alt="Header Image"
                    style="width: 100%; height: 80vh; object-fit: cover;">

                <div style="position: absolute; bottom: 200px; left: 80px; color: white;">
                    <h1>Technology Meets Agriculture</h1>
                    <h3>CONTACT US FOR A FREE QUOTE: + 720-909-8300</h3>
                </div>

                <div class="text-center my-5 py-5">
                    <h1>
                        We cultivate Hemp, Technology, and Your Farm. From seed to<br> sale,
                        we help you become a success.
                    </h1>
                </div>

                <img src="{{ asset('images/img4.avif') }}" alt="Header Image"
                    style="width: 100%; height: 60vh; object-fit: cover;">

                <div style="position: absolute; bottom: -300px; left: 430px; color: white;">
                    <h2>Technology Meets Agriculture</h2>
                </div>
                <div style="position: absolute; bottom: -520px; left: 50%; transform: translateX(-50%); color: white;">
                    <div class="container">
                        <div class="row d-flex justify-content-center">
                            <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <div class="row">
                                            <div class="col-4">
                                                <img src="{{ asset('images/img1.avif') }}" class="d-block w-100"
                                                    alt="Image 1">
                                            </div>
                                            <div class="col-4">
                                                <img src="{{ asset('images/img1.avif') }}" class="d-block w-100"
                                                    alt="Image 2">
                                            </div>
                                            <div class="col-4">
                                                <img src="{{ asset('images/img1.avif') }}" class="d-block w-100"
                                                    alt="Image 3">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <div class="row">
                                            <div class="col-4">
                                                <img src="{{ asset('images/img1.avif') }}" class="d-block w-100"
                                                    alt="Image 4">
                                            </div>
                                            <div class="col-4">
                                                <img src="{{ asset('images/img1.avif') }}" class="d-block w-100"
                                                    alt="Image 5">
                                            </div>
                                            <div class="col-4">
                                                <img src="{{ asset('images/img1.avif') }}" class="d-block w-100"
                                                    alt="Image 6">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <button class="carousel-control-prev" type="button"
                                    data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button"
                                    data-bs-target="#carouselExampleControls" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col d-flex flex-row-reverse">
                    <img src="{{ asset('images/im6.avif') }}" class="d-block w-70" style="height: 58%;" alt="Image 6">
                </div>
                <div class="col py-5">
                    <h2 class="text-secondary">LET AS HELP YOU TO GET <br>STARTED RIGHT !</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis eos alias quaerat ex. Atque
                        assumenda quo, quibusdam placeat illum laudantium nobis! Quia aliquid ad, consequuntur cum odit
                        repellat aspernatur vero.</p>
                </div>
            </div>

            <div class="row">
                <img src="{{ asset('images/img6.avif') }}" alt="Header Image"
                    style="width: 100%; height: 60vh; object-fit: cover;">

                <div style="position: absolute; bottom: -1400px; left: 430px; color: white;">
                    <h2>Technology Meets Agriculture</h2>
                </div>
            </div>
        </div>

</main>

@include('layout.footer')
