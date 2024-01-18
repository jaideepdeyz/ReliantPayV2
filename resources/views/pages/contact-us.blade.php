@extends('layouts.website-base')

@section('content')
<section style="background: #f2f2f2;padding:20px 0">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3><b>Contact Us</b></h3>
            </div>
        </div>
    </div>
</section>
<section style="padding:30px 0">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h3>Contact us</h3>
                <p>If you have any questions or need assistance, please don't hesitate to contact us using the information below.</p>
                <address>
                    <strong>Reliantpay</strong><br>
                    123 Main Street<br>
                    City, State ZIP Code<br>
                    <abbr title="Phone">Phone:</abbr> (123) 456-7890<br>
                    <abbr title="Email">Email:</abbr> <a href="mailto:info@example.com">info@reliantpay.com</a>
                </address>
            </div>
            <div class="col-md-6">
                <h3>Contact Form</h3>
                <form>
                    <div class="form-group">
                        <label for="name">Your Name</label>
                        <input type="text" class="form-control" id="name" placeholder="Your Name">
                    </div>
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" class="form-control" id="email" placeholder="Your Email">
                    </div>
                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea class="form-control" id="message" rows="4" placeholder="Your Message"></textarea>
                    </div>
                    {!! RecaptchaV3::field('contact') !!}
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection
