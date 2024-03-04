@push('css')
    <!-- Stripe Payment Gateway CSS-->
    <style>
        /**
         * The CSS shown here will not be introduced in the Quickstart guide, but shows
         * how you can use CSS to style your Element's container.
         */
        .StripeElement {
            box-sizing: border-box;

            height: 40px;
            width: 100%;  /*Added, customized*/

            padding: 10px 12px;

            border: 1px solid transparent;
            border-radius: 4px;
            background-color: white;

            box-shadow: 0 1px 3px 0 #e6ebf1;
            -webkit-transition: box-shadow 150ms ease;
            transition: box-shadow 150ms ease;
        }

        .StripeElement--focus {
            box-shadow: 0 1px 3px 0 #cfd7df;
        }

        .StripeElement--invalid {
            border-color: #fa755a;
        }

        .StripeElement--webkit-autofill {
            background-color: #fefde5 !important;
        }
    </style>
    <!-- /Stripe Payment Gateway CSS-->
@endpush
    <!-- Stripe Payment Gateway HTML MODIFIED-->
    <div class="form-row">
        <label class="mt-3" for="card-element">
            Credit or debit card
        </label>
        <div id="cardElement">
            <!-- A Stripe Element will be inserted here. -->
        </div>

        <!-- Used to display form errors. -->
        <small class="form-text text-muted" id="cardErrors" role="alert"></small>
        <input type="hidden" name="payment_method" id="paymentMethod">
    </div>
    <!-- /Stripe Payment Gateway HTML-->
@push('script-bottom')

    <!-- Stripe Payment Gateway JS MODIFIED-->
    <script src="https://js.stripe.com/v3/"></script>
    <script type="text/javascript">
        // Create a Stripe client.
        const stripe = Stripe('{{ config('services.stripe.key') }}'); //modified to get key from .env

        // Create an instance of Elements.
        const elements = stripe.elements();
        const cardElement = elements.create('card');

        cardElement.mount('#cardElement');

    </script>

    <script type="text/javascript">
        const form = document.getElementById('paymentForm'); //from form in blade, id of form
        const payButton = document.getElementById('paymentButton'); //from form in blade, id of submit button

        //submitting/clicking of button
        payButton.addEventListener('click', async(e) => {
            e.preventDefault();
                const { paymentMethod, error } = await stripe.createPaymentMethod(
                    'card', cardElement, {
                        billing_details: {
                            @if(Auth::check())
                                "name": "{{ Auth::user()->name }}",
                                "email": "{{ Auth::user()->email }}"
                            @endif
                        }
                    }
                );

            if (error) {
                const displayError = document.getElementById('cardErrors');
                displayError.textContent = error.message;
            } else {
                //disable button upon click
                $("#paymentButton").one('click', function (event) {
                    event.preventDefault();
                    //do something
                    const tokenInput = document.getElementById('paymentMethod');
                    tokenInput.value = paymentMethod.id;
                    form.submit();
                    $(this).prop('disabled', true);
                });
            }
        });

    </script>
    <!-- /Stripe Payment Gateway JS-->

@endpush
