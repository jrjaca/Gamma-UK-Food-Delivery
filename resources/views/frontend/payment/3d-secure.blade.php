@extends('layouts.app')

@section('title')
    {{--{{ $site_setting->main_title }} ||--}} Stripe Payment SCA
@endsection

@section('content')

    <br/><br/><br/>
    <div class="container">
        <div class="row justify-content-around">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Complete the security steps.</div>
                    <div class="card-body">
                        <b>
                            You need to follow some steps to complete this payment.
                        </b>
                    </div>
                </div>
            </div>
        </div>
    </div>]
    <br/><br/><br/>

    @push('script-bottom')
        <!-- Stripe Payment Gateway JS MODIFIED-->
        <script src="https://js.stripe.com/v3/"></script>
        <script type="text/javascript">
            // Create a Stripe client.
            const stripe = Stripe('{{ config('services.stripe.key') }}'); //modified to get key from .env
            stripe.handleCardAction("{{ $clientSecret }}")
                .then(function(result){
                    if (result.error){
                        window.location.replace("{{ route('stripe.cancelled') }}");
                    } else {
                        window.location.replace("{{ route('stripe.approval') }}");
                    }
                });
        </script>
    @endpush

@endsection

