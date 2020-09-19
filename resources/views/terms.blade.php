@extends('app')

@section('title', 'trach.io - Tracheostomy patient monitoring app for your loved ones!')

@section('content')

@include('partials.nav')

<section class="h-full bg-white">

    <div class="container mx-auto mt-0 pb-4 md:pb-24 px-5">

        <h2
            class="w-full pt-4 sm:pt-8 text-xl sm:text-2xl font-semibold text-left text-gray-700 uppercase  text-purple-700 ">
            TERMS & CONDITIONS</h2>
        <div class="container mx-auto md:flex">
            <div class="w-full">
                <div class="w-full flex py-4">
                    {{-- <div class="flex-shrink-0">
                      <img class="h-12 w-12" src="/images/new_logos/blue_logos/rConfig_blue_trnsprnt_1_64px.png" alt="rConfig Logo">
                    </div> --}}
                    <div class="">
                        <div class="w-full">
                            <h2 class="font-semibold text-gray-600 tracking-wide uppercase text-purple-700">1.
                                Acceptance of our Terms</h2>
                            <p class="mb-2">By visiting the website trach.io, viewing, accessing or otherwise using any
                                of the services or information created, collected, compiled or submitted to trach.io,
                                you agree to be bound by the following Terms and Conditions of Service. If you do not
                                want to be bound by our Terms your only option is not to visit, view or otherwise use
                                the services of trach.io. You understand, agree and acknowledge that these Terms
                                constitute a legally binding agreement between you and trach.io and that your use of
                                trach.io shall indicate your conclusive acceptance of this agreement.</p>
                            <h2 class="font-semibold text-gray-600 tracking-wide uppercase text-purple-700">2. Provision
                                of Services</h2>
                            <p class="mb-2">You agree and acknowledge that trach.io is entitled to modify, improve or
                                discontinue any of its services at its sole discretion and without notice to you even if
                                it may result in you being prevented from accessing any information contained in it.
                                Furthermore, you agree and acknowledge that trach.io is entitled to provide services to
                                you through subsidiaries or affiliated entities.</p>
                            <h2 class="font-semibold text-gray-600 tracking-wide uppercase text-purple-700">3.
                                Proprietary Rights</h2>
                            <p class="mb-2">You acknowledge and agree that trach.io may contain proprietary and
                                confidential information including trademarks, service marks and patents protected by
                                intellectual property laws and international intellectual property treaties. trach.io
                                authorizes you to view and make a single copy of portions of its content for offline,
                                personal, non-commercial use. Our content may not be sold, reproduced, or distributed
                                without our written permission. Any third-party trademarks, service marks and logos are
                                the property of their respective owners. Any further rights not specifically granted
                                herein are reserved.</p>
                            <h2 class="font-semibold text-gray-600 tracking-wide uppercase text-purple-700">4. Submitted
                                Content</h2>
                            <p class="mb-2">When you submit content to trach.io you simultaneously grant trach.io an
                                irrevocable, worldwide, royalty free license to publish, display, modify, distribute and
                                syndicate your content worldwide. You confirm and warrant that you have the required
                                authority to grant the above license to trach.io.</p>
                            <h2 class="font-semibold text-gray-600 tracking-wide uppercase text-purple-700">5.
                                Termination of Agreement</h2>
                            <p class="mb-2">The Terms of this agreement will continue to apply in perpetuity until
                                terminated by either party without notice at any time for any reason. Terms that are to
                                continue in perpetuity shall be unaffected by the termination of this agreement.</p>
                            <h2 class="font-semibold text-gray-600 tracking-wide uppercase text-purple-700">6.
                                Disclaimer of Warranties</h2>
                            <p class="mb-2">You understand and agree that your use of trach.io is entirely at your own
                                risk and that our services are provided "As Is" and "As Available". trach.io does not
                                make any express or implied warranties, endorsements or representations whatsoever as to
                                the operation of the trach.io website, information, content, materials, or products.
                                This shall include, but not be limited to, implied warranties of merchantability and
                                fitness for a particular purpose and non-infringement, and warranties that access to or
                                use of the service will be uninterrupted or error-free or that defects in the service
                                will be corrected.</p>
                            <h2 class="font-semibold text-gray-600 tracking-wide uppercase text-purple-700">7.
                                Limitation of Liability</h2>
                            <p class="mb-2">You understand and agree that trach.io and any of its subsidiaries or
                                affiliates shall in no event be liable for any direct, indirect, incidental,
                                consequential, or exemplary damages. This shall include, but not be limited to damages
                                for loss of profits, business interruption, business reputation or goodwill, loss of
                                programs or information or other intangible loss arising out of the use of or the
                                inability to use the service, or information, or any permanent or temporary cessation of
                                such service or access to information, or the deletion or corruption of any content or
                                information, or the failure to store any content or information. The above limitation
                                shall apply whether or not trach.io has been advised of or should have been aware of the
                                possibility of such damages. In jurisdictions where the exclusion or limitation of
                                liability for consequential or incidental damages is not allowed the liability of
                                trach.io is limited to the greatest extent permitted by law.</p>
                            <h2 class="font-semibold text-gray-600 tracking-wide uppercase text-purple-700">8. External
                                Content</h2>
                            <p class="mb-2">trach.io may include hyperlinks to third-party content, advertising or
                                websites. You acknowledge and agree that trach.io is not responsible for and does not
                                endorse any advertising, products or resource available from such resources or websites.
                            </p>
                            <h2 class="font-semibold text-gray-600 tracking-wide uppercase text-purple-700">9.
                                Jurisdiction</h2>
                            <p class="mb-2">You expressly understand and agree to submit to the personal and exclusive
                                jurisdiction of the courts of the country, state, province or territory determined
                                solely by trach.io to resolve any legal matter arising from this agreement or related to
                                your use of trach.io. If the court of law having jurisdiction, rules that any provision
                                of the agreement is invalid, then that provision will be removed from the Terms and the
                                remaining Terms will continue to be valid.</p>
                            <h2 class="font-semibold text-gray-600 tracking-wide uppercase text-purple-700">10. Entire
                                Agreement</h2>
                            <p class="mb-2">You understand and agree that the above Terms constitute the entire general
                                agreement between you and trach.io. You may be subject to additional Terms and
                                conditions when you use, purchase or access other services, affiliate services or
                                third-party content or material.</p>
                            <h2 class="font-semibold text-gray-600 tracking-wide uppercase text-purple-700">11. Changes
                                to the Terms</h2>
                            <p class="mb-2">trach.io reserves the right to modify these Terms from time to time at our
                                sole discretion and without any notice. Changes to our Terms become effective on the
                                date they are posted and your continued use of trach.io after any changes to Terms will
                                signify your agreement to be bound by them.</p>
                            </p>
                            <a class="text-white py-2 px-6 rounded bg-indigo-600  w-full sm:w-2/3 mt-4 sm:mt-0 shadow hover:shadow-lg hover:bg-indigo-500"
                                href="/register">Sign up for a trial</a>
                            <a class="text-blue-600 ml-0 sm:ml-4 py-2 px-6 rounded bg-gray-200 w-full sm:w-2/3 mt-4 sm:mt-0 shadow hover:shadow-lg hover:bg-gray-300 hover:text-blue-700 ml-6"
                                href="/">Learn More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
