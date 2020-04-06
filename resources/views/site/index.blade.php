@extends('site.layouts.base')

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css">
@endsection
@section('js')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js">
</script>

<script>
    $('.main-banner-slider').slick({
        arrows: false,
        dots: false,
        autoplay: true
        });
</script>
@endsection

@section('content')

{{-- slider  --}}
<div class="main-banner-slider">
    <a href="">
        <div style="background-image:url(images/slider/img_1.jpg)">
        </div>
    </a>
    <a href="">
        <div style="background-image:url(images/slider/img_2.jpg)">
        </div>
    </a>
    <a href="">
        <div style="background-image:url(images/slider/img_3.jpg)">
        </div>
    </a>
    <a href="">
        <div style="background-image:url(images/slider/img_4.jpg)">
        </div>
    </a>
</div>
{{--!ends slider  --}}



{{-- about us  --}}
<div class="container-fluid about-us-container mt-4 mb-4">
    <div class="row justify-content-center">
        <div class="col-12 col-md-6">
            <div class="h3 title text-center">
                <span>About Us</span>
            </div>
            <div class="about-us-container--content">
                <p>
                    A blood donation occurs when a person voluntarily has blood drawn and used for transfusions and/or
                    made into
                    biopharmaceutical medications by a process called fractionation (separation of whole-blood
                    components). Donation may be
                    of whole blood, or of specific components directly (the latter called apheresis). Blood banks often
                    participate in the
                    collection process as well as the procedures that follow it. <br>

                    Today in the developed world, most blood donors are unpaid volunteers who donate blood for a
                    community supply. In some
                    countries, established supplies are limited and donors usually give blood when family or friends
                    need a transfusion
                    (directed donation). Many donors donate as an act of charity, but in countries that allow paid
                    donation some donors are
                    paid, and in some cases there are incentives other than money such as paid time off from work.
                    Donors can also have
                    blood drawn for their own future use (autologous donation). Donating is relatively safe, but some
                    donors have bruising
                    where the needle is inserted or may feel faint.
                </p>
            </div>
            <div class="event-btn">
                <div class="text-center mt-2">
                    <a href="/public-events" class="btn  px-5 text-capitalize btn-more_info">Check Our Upcoming Events</a>
                </div>
            </div>
        </div>
    </div>
</div>
{{--!ends about us  --}}




@endsection
