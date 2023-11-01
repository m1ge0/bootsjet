<div class="vh-100 d-flex justify-content-center align-items-center">
    <div class="container">
        <div class="row justify-content-center my-5">
            <div class="col-sm-12 col-md-8 col-lg-5 my-4">
                <div>
                    {{ $logo }}
                </div>

                <div class="card card-bg shadow-sm px-3 mx-4 py-1">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>
</div>
