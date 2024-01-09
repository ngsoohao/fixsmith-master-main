<div>
    @livewireStyles
    @include('utils.sessionFlash')
        <section class="min-h-screen md:flex sm:block">

            <div class="flex-shrink-0 mr-5 border-r-2 w-1/7 border-slate-500">
                @include("nav.side-nav")        
            </div>

            <div class="flex-grow overflow-auto w-6/7">
                <h1 class="text-xl font-bold">Manage Payouts</h1>
                @if (!$linkAccount)
                    <h2>You are not able to receive payouts yet</h2>
                    <h2>Please setup the stripe connect account to receive payouts</h2>
                    <button class="px-4 py-2 text-white rounded-md bg-slate-700 hover:bg-slate-400" wire:click='addStripeConnect'>Set Up Stripe Connect</button>

                @else
                <section class="items-center w-3/4 p-4 mx-auto mt-10 text-center rounded-md bg-slate-300">
                    <h1 class="mb-5 font-bold">My Payout Account Details</h1>
                    <div class="mb-5">
                        <label>My connected Stripe account ID</label>
                        <p class="w-2/5 p-2 mx-auto text-white rounded-md bg-slate-700">{{ $linkAccount->connectedAccountID }}</p>
                    </div>
                    <label>My dashboard</label>
                    <div>
                        <a href="https://dashboard.stripe.com/test/balance/overview" target="_blank" rel="noopener noreferrer">
                            <button class="w-2/5 p-2 text-white rounded-md shadow-lg hover:text-slate-200 bg-slate-700 hover:bg-slate-400">
                                Go to My Stripe Dashboard
                            </button>
                        </a>
                    </div>
                </section>
                @endif

            </div>
        </section>
</div>