@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-extrabold text-gray-900 sm:text-5xl sm:tracking-tight lg:text-6xl">
                Simple, transparent pricing
            </h1>
            <p class="mt-5 max-w-xl mx-auto text-xl text-gray-500">
                Choose the perfect plan for your inventory management needs.
            </p>
        </div>

        <!-- Pricing Cards -->
        <div class="mt-16 space-y-8 lg:grid lg:grid-cols-3 lg:gap-8 lg:space-y-0">
            <!-- Basic Plan -->
            <div class="flex flex-col rounded-2xl shadow-xl overflow-hidden border border-gray-200">
                <div class="px-6 py-8 bg-white sm:p-10 sm:pb-6">
                    <div>
                        <h3 class="inline-flex px-4 py-1 rounded-full text-sm font-semibold tracking-wide uppercase bg-indigo-100 text-indigo-600" id="tier-basic">
                            Basic
                        </h3>
                    </div>
                    <div class="mt-4 flex items-baseline text-6xl font-extrabold">
                        $29
                        <span class="ml-1 text-2xl font-medium text-gray-500">/mo</span>
                    </div>
                    <p class="mt-5 text-lg text-gray-500">The essentials to manage your inventory effectively.</p>
                </div>
                <div class="flex-1 flex flex-col justify-between px-6 pt-6 pb-8 bg-gray-50 space-y-6 sm:p-10 sm:pt-6">
                    <ul class="space-y-4">
                        <li class="flex items-start">
                            <div class="flex-shrink-0">
                                <svg class="h-6 w-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <p class="ml-3 text-base text-gray-700">Up to 100 products</p>
                        </li>
                        <li class="flex items-start">
                            <div class="flex-shrink-0">
                                <svg class="h-6 w-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <p class="ml-3 text-base text-gray-700">Basic inventory tracking</p>
                        </li>
                        <li class="flex items-start">
                            <div class="flex-shrink-0">
                                <svg class="h-6 w-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <p class="ml-3 text-base text-gray-700">Email support</p>
                        </li>
                    </ul>
                    <div class="rounded-md shadow">
                        <a href="#" class="flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                            Get started
                        </a>
                    </div>
                </div>
            </div>

            <!-- Pro Plan -->
            <div class="flex flex-col rounded-2xl shadow-xl overflow-hidden border-2 border-indigo-500 transform scale-105 z-10">
                <div class="px-6 py-8 bg-white sm:p-10 sm:pb-6">
                    <div class="flex justify-between items-center">
                        <h3 class="inline-flex px-4 py-1 rounded-full text-sm font-semibold tracking-wide uppercase bg-indigo-100 text-indigo-600" id="tier-pro">
                            Pro
                        </h3>
                        <span class="bg-indigo-100 text-indigo-800 text-xs font-medium px-2.5 py-0.5 rounded">Most Popular</span>
                    </div>
                    <div class="mt-4 flex items-baseline text-6xl font-extrabold">
                        $79
                        <span class="ml-1 text-2xl font-medium text-gray-500">/mo</span>
                    </div>
                    <p class="mt-5 text-lg text-gray-500">Advanced features for growing businesses.</p>
                </div>
                <div class="flex-1 flex flex-col justify-between px-6 pt-6 pb-8 bg-gray-50 space-y-6 sm:p-10 sm:pt-6">
                    <ul class="space-y-4">
                        <li class="flex items-start">
                            <div class="flex-shrink-0">
                                <svg class="h-6 w-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <p class="ml-3 text-base text-gray-700">Up to 1,000 products</p>
                        </li>
                        <li class="flex items-start">
                            <div class="flex-shrink-0">
                                <svg class="h-6 w-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <p class="ml-3 text-base text-gray-700">Advanced inventory tracking</p>
                        </li>
                        <li class="flex items-start">
                            <div class="flex-shrink-0">
                                <svg class="h-6 w-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <p class="ml-3 text-base text-gray-700">Priority email & chat support</p>
                        </li>
                        <li class="flex items-start">
                            <div class="flex-shrink-0">
                                <svg class="h-6 w-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <p class="ml-3 text-base text-gray-700">Basic analytics</p>
                        </li>
                    </ul>
                    <div class="rounded-md shadow">
                        <a href="#" class="flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                            Get started
                        </a>
                    </div>
                </div>
            </div>

            <!-- Enterprise Plan -->
            <div class="flex flex-col rounded-2xl shadow-xl overflow-hidden border border-gray-200">
                <div class="px-6 py-8 bg-white sm:p-10 sm:pb-6">
                    <div>
                        <h3 class="inline-flex px-4 py-1 rounded-full text-sm font-semibold tracking-wide uppercase bg-indigo-100 text-indigo-600" id="tier-enterprise">
                            Enterprise
                        </h3>
                    </div>
                    <div class="mt-4 flex items-baseline text-6xl font-extrabold">
                        $199
                        <span class="ml-1 text-2xl font-medium text-gray-500">/mo</span>
                    </div>
                    <p class="mt-5 text-lg text-gray-500">Custom solutions for large businesses.</p>
                </div>
                <div class="flex-1 flex flex-col justify-between px-6 pt-6 pb-8 bg-gray-50 space-y-6 sm:p-10 sm:pt-6">
                    <ul class="space-y-4">
                        <li class="flex items-start">
                            <div class="flex-shrink-0">
                                <svg class="h-6 w-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <p class="ml-3 text-base text-gray-700">Unlimited products</p>
                        </li>
                        <li class="flex items-start">
                            <div class="flex-shrink-0">
                                <svg class="h-6 w-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <p class="ml-3 text-base text-gray-700">Advanced inventory & warehouse</p>
                        </li>
                        <li class="flex items-start">
                            <div class="flex-shrink-0">
                                <svg class="h-6 w-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <p class="ml-3 text-base text-gray-700">24/7 phone & email support</p>
                        </li>
                        <li class="flex items-start">
                            <div class="flex-shrink-0">
                                <svg class="h-6 w-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <p class="ml-3 text-base text-gray-700">Advanced analytics & reporting</p>
                        </li>
                    </ul>
                    <div class="rounded-md shadow">
                        <a href="#" class="flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                            Get started
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- FAQ Section -->
        <div class="mt-24">
            <h2 class="text-3xl font-extrabold text-gray-900 text-center mb-12">Frequently asked questions</h2>
            <div class="max-w-3xl mx-auto divide-y-2 divide-gray-200">
                <div class="py-8">
                    <h3 class="text-lg font-medium text-gray-900">What's included in the free trial?</h3>
                    <div class="mt-2">
                        <p class="text-base text-gray-500">Our free trial includes access to all Pro plan features for 14 days. No credit card required to start your trial.</p>
                    </div>
                </div>
                <div class="py-8">
                    <h3 class="text-lg font-medium text-gray-900">Can I change plans later?</h3>
                    <div class="mt-2">
                        <p class="text-base text-gray-500">Absolutely! You can upgrade or downgrade your plan at any time. Changes will be reflected in your next billing cycle.</p>
                    </div>
                </div>
                <div class="py-8">
                    <h3 class="text-lg font-medium text-gray-900">Is there a contract?</h3>
                    <div class="mt-2">
                        <p class="text-base text-gray-500">No long-term contracts. You can cancel your subscription at any time. We believe in earning your business every month.</p>
                    </div>
                </div>
                <div class="py-8">
                    <h3 class="text-lg font-medium text-gray-900">What payment methods do you accept?</h3>
                    <div class="mt-2">
                        <p class="text-base text-gray-500">We accept all major credit cards including Visa, Mastercard, American Express, and Discover. We also support ACH bank transfers for annual plans.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- CTA Section -->
        <div class="mt-16 bg-indigo-700 rounded-2xl overflow-hidden lg:grid lg:grid-cols-2 lg:gap-4">
            <div class="pt-10 pb-12 px-6 sm:pt-16 sm:px-16 lg:py-16 lg:pr-0 xl:py-20 xl:px-20">
                <div class="lg:self-center">
                    <h2 class="text-3xl font-extrabold text-white sm:text-4xl">
                        <span class="block">Ready to get started?</span>
                        <span class="block">Start your free trial today.</span>
                    </h2>
                    <p class="mt-4 text-lg leading-6 text-indigo-200">
                        No credit card required. Cancel anytime.
                    </p>
                    <a href="{{ route('register') }}" class="mt-8 bg-white border border-transparent rounded-md shadow px-5 py-3 inline-flex items-center text-base font-medium text-indigo-600 hover:bg-indigo-50">
                        Sign up for free
                    </a>
                </div>
            </div>
            <div class="-mt-6 aspect-w-5 aspect-h-3 md:aspect-w-2 md:aspect-h-1">
                <img class="transform translate-x-6 translate-y-6 rounded-md object-cover object-left-top sm:translate-x-16 lg:translate-y-20" src="https://images.unsplash.com/photo-1581093450231-89f5e3a3b1d3?ixlib=rb-1.2.1&auto=format&fit=crop&w=1000&q=80" alt="App screenshot">
            </div>
        </div>
    </div>
</div>

<!-- Terms and Conditions Modal -->
<div id="termsModal" class="fixed z-50 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" id="termsModalBackdrop"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full sm:p-6">
            <div class="absolute top-0 right-0 pt-4 pr-4">
                <button type="button" id="closeTermsModal" class="bg-white rounded-md text-gray-400 hover:text-gray-500 focus:outline-none">
                    <span class="sr-only">Close</span>
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="sm:flex sm:items-start">
                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                    <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                        Terms and Conditions
                    </h3>
                    <div class="mt-4 text-sm text-gray-500 max-h-96 overflow-y-auto pr-4">
                        <h4 class="font-medium text-gray-900 mb-2">1. Subscription Terms</h4>
                        <p class="mb-4">By subscribing to our service, you agree to pay the monthly subscription fee applicable to the selected plan. Your subscription will automatically renew each month unless you cancel before the end of your current billing period.</p>
                        
                        <h4 class="font-medium text-gray-900 mb-2">2. Payment and Billing</h4>
                        <p class="mb-4">All payments are processed through our secure payment gateway. You will be billed on the same day each month based on your subscription start date. We accept all major credit cards and may offer additional payment methods at our discretion.</p>
                        
                        <h4 class="font-medium text-gray-900 mb-2">3. Cancellation Policy</h4>
                        <p class="mb-4">You may cancel your subscription at any time. Upon cancellation, you will continue to have access to the service until the end of your current billing period. No refunds will be provided for partial months of service.</p>
                        
                        <h4 class="font-medium text-gray-900 mb-2">4. Data Usage and Privacy</h4>
                        <p class="mb-4">We respect your privacy and are committed to protecting your data. Your information will be used in accordance with our Privacy Policy. We will never sell or share your data with third parties without your explicit consent.</p>
                        
                        <h4 class="font-medium text-gray-900 mb-2">5. Service Availability</h4>
                        <p class="mb-4">We strive to maintain 99.9% uptime for our service. However, we cannot guarantee that the service will be available at all times. Scheduled maintenance may be performed during off-peak hours.</p>
                        
                        <h4 class="font-medium text-gray-900 mb-2">6. Changes to Terms</h4>
                        <p>We reserve the right to modify these terms at any time. We will provide notice of any significant changes via email or through our service. Your continued use of the service after such changes constitutes your acceptance of the new terms.</p>
                    </div>
                </div>
            </div>
            <div class="mt-5 sm:mt-6">
                <button type="button" id="acceptTerms" class="inline-flex justify-center w-full rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:text-sm">
                    I Accept the Terms and Conditions
                </button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Terms and Conditions Modal
    function openTermsModal() {
        document.getElementById('termsModal').classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    }

    function closeTermsModal() {
        document.getElementById('termsModal').classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }

    // Close modal when clicking outside or pressing Escape
    document.getElementById('termsModalBackdrop').addEventListener('click', closeTermsModal);
    document.getElementById('closeTermsModal').addEventListener('click', closeTermsModal);
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeTermsModal();
        }
    });

    // Handle plan selection
    document.querySelectorAll('[data-plan]').forEach(button => {
        button.addEventListener('click', function() {
            const plan = this.getAttribute('data-plan');
            // Store selected plan in localStorage or form field
            localStorage.setItem('selectedPlan', plan);
            openTermsModal();
        });
    });

    // Handle terms acceptance
    document.getElementById('acceptTerms').addEventListener('click', function() {
        // Proceed to checkout or registration with selected plan
        const selectedPlan = localStorage.getItem('selectedPlan') || 'pro';
        window.location.href = '/register?plan=' + selectedPlan;
    });
</script>
@endpush
@endsection
