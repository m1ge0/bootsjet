{{-- <div class="vh-100">
    <div class="d-flex justify-content-center align-items-center">
        <div>
            <div class="d-flex justify-content-center">
                {{ $logo }}
            </div>
            <div class="bg-white w-100 mt-5 px-4 py-3 shadow-sm rounded-3">
                {{ $slot }}
            </div>
        </div>
    </div>
</div> --}}

<div class="vh-100 d-flex justify-content-center align-items-center">
    <div class="container">
        <div class="row justify-content-center my-5">
            <div class="col-sm-12 col-md-8 col-lg-5 my-4">
                <div>
                    {{ $logo }}
                </div>

                <div class="card shadow-sm px-3 mx-4 py-1">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>
</div>

{{-- <div class="vh-100 d-flex justify-content-center align-items-center">
    <div class="container">
        <div class="row justify-content-center my-5">
            <div class="col-sm-12 col-md-8 col-lg-5 my-2">
                <div>
                    {{ $logo }}
                </div>

                <div class="rounded-3 bg-white shadow-sm mt-4 px-4 mx-1 py-3">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>
</div> --}}


{{-- <div class="vh-100 d-flex justify-content-center algin-items-center">
    <div class="rounded-lg">
        <div>
            {{ $logo }}
        </div>

        <div class="w-100 mt-6 px-5 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            {{ $slot }}
        </div>
    </div>
</div> --}}
