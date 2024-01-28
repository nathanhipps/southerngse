<div>
    <div
        x-init="startup($refs)"
        x-data="{
            startup($refs) {
                this.stripe = Stripe('{{ env('STRIPE_PUBLIC')  }}');
                this.elements = this.stripe.elements();
                this.card = this.elements.create('card', {style: this.style});
                this.card.mount($refs.card);

                this.card.addEventListener('change', event => {
                    const displayError = $refs.errors
                    if (event.error) {
                        displayError.textContent = event.error.message;
                    } else {
                        displayError.textContent = '';
                    }
                });
            },
            complete: false,
            loading: false,
            stripe: {},
            elements: {},
            card: {},
            style: {
                base: {
                    color: '#32325d',
                    fontFamily: 'Helvetica, sans-serif',
                    fontSmoothing: 'antialiased',
                    fontSize: '16px',
                    '::placeholder': {
                        color: 'black'
                    }
                },
                invalid: {
                    color: '#fa755a',
                    iconColor: '#fa755a'
                }
            },

            handleSubmit($refs) {
                this.loading = true;
                setTimeout(() => this.loading = false, 5000);

                this.stripe.createToken(this.card).then(result => {
                    if (result.error) {
                        $refs.errors.textContent = result.error.message;
                    } else {
                        this.$wire.createCard(result.token)
                        console.log(result.token);
                        this.card.clear();
                    }
                });
            }
        }"
    >
        <form x-on:submit.prevent="handleSubmit($refs)">
            <div class="md:flex items-center">
                <div class="flex-1 md:mr-2">
                    <div x-ref="card"></div>
                    <div x-ref="errors" role="alert"></div>
                </div>
                <div class="mt-4 md:mt-0">
                    <x-button>
                        <span x-show="loading">
                            <x-icons.spinner class="w-5 animate-spin"/>
                        </span>
                        <span x-show="! loading">
                            Add Card
                        </span>
                    </x-button>
                </div>
            </div>
        </form>
    </div>

</div>
