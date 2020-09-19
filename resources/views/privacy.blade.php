@extends('app')

@section('title', 'trach.io - Tracheostomy patient monitoring app for your loved ones!')

@section('content')

@include('partials.nav')

<section class="h-full bg-white">

    <div class="container mx-auto mt-0 pb-4 md:pb-24 px-5">

        <h2
            class="w-full pt-4 sm:pt-8 text-xl sm:text-2xl font-semibold text-left  uppercase text-purple-700 ">
            PRIVACY</h2>
        <div class="container mx-auto md:flex">
            <div class="w-full">
                <div class="w-full flex py-4">
                    {{-- <div class="flex-shrink-0">
                      <img class="h-12 w-12" src="/images/new_logos/blue_logos/trach.io_blue_trnsprnt_1_64px.png" alt="trach.io Logo">
                    </div> --}}
                    <div class="w-full">
                <h1 class="font-semibold text-gray-600 tracking-wide uppercase text-purple-700 mt-2">Website Privacy
                    Statement</h1>
                <p>trach.io is committed to preserving the privacy of all visitors to www.trach.io (“our website”).
                    This privacy statement relates to our practices in connection with our website. trach.io's
                    Comprehensive fully respects your right to privacy. We will not collect personal
                    information/personal data about you when you visit our website unless you choose to provide that
                    information using the “contact" form. By using this site, you consent to the collection and use
                    of your information under the terms of this privacy statement which is in accordance with the Data
                    Protection Acts, 1988 and 2003 and the European Communities (Electronic Communications Networks and
                    Services) (Privacy and Electronic Communications) Regulations 2011. Please read the following
                    privacy statement to understand how we use and protect the information that you choose to provide to
                    us. </p>
                <h2 class="font-semibold text-gray-600 tracking-wide uppercase text-purple-700 mt-2">Personal information
                    which we collect from you</h2>
                <p> When you visit our website you may wish to provide certain information about yourself, such as when
                    you complete our “Contact Us” form. trach.io does not collect any personal data about you on this
                    website, apart from the information which you volunteer to send us in the “Contact Us” form. </p>
                <h2 class="font-semibold text-gray-600 tracking-wide uppercase text-purple-700 mt-2">Non-Personal
                    information which we collect </h2>
                <p> Where you visit our website, certain non-personal data is available to us through our internet
                    service provider. This non-personal data is collected on a statistical, aggregate, non-individual
                    basis. This information may include the IP address from which you access our website, the type of
                    browser used to access our website (Internet Explorer, Firefox, etc.), the type of operating system
                    used to access our website (Windows, Macintosh, etc.), the “top-level” domain name used (ie, .com,
                    .org, etc.), the date and time of your visit to our website and the number of pages you visited on
                    our website. </p>
                <h2 class="font-semibold text-gray-600 tracking-wide uppercase text-purple-700 mt-2">Use of your
                    information</h2>
                <p> Any information which you provide using the “Contact Us” form is not made available to any third
                    parties and is only used by trach.io in line with the purposes for which you provided it (e.g. to
                    contact you and answer any queries which you have raised in the “Contact Us” form or to address any
                    other feedback which you send us in the “Contact Us” form) or for any reasonably incidental purpose.
                </p>
                <h2 class="font-semibold text-gray-600 tracking-wide uppercase text-purple-700 mt-2">Disclosure to Other
                    People</h2>
                <p> We do not disclose, sell or distribute any personal information which you send to us to any third
                    parties. We may pass aggregate information on the usage of our site to third parties, but this will
                    not include information that can be used to identify you. Your personal data may also be anonymised
                    and used for statistical purposes. Unless required to do so by law, we will not otherwise share,
                    sell or distribute any of the information you provide to us without your consent. </p>
                <h2 class="font-semibold text-gray-600 tracking-wide uppercase text-purple-700 mt-2">IP Addresses</h2>
                <p> An IP address is a number that is assigned to your computer automatically when you use the internet.
                    When you visit any web page in our website, our servers log your IP address. We may use your IP
                    address to help diagnose problems with our server and to administer our website. Your IP address is
                    also used to help identify you and to gather broad demographic information. </p>
                <h2 class="font-semibold text-gray-600 tracking-wide uppercase text-purple-700 mt-2">Cookies</h2>
                <p> A cookie is a small file sent to your browser from a Web server and stored on your computer's hard
                    drive to identify you as the user of the website. Many internet sites use cookies. Typically they
                    are used by the website to identify the person accessing the website to track the person’s use of
                    the site and any repeat visits made by that person. </p>
                <p>By using our website, you agree that we can place these types of cookies on your device. Your browser
                    will give you the option of preventing websites using cookies, or deleting cookies that have been
                    accepted. Your browser’s help service or help manual will show you how this is done. If you do not
                    want your browser to accept cookies, you can “turn off” the cookie acceptance setting on your
                    browser setting. However you must note that this may stop our website from working properly on your
                    device. If you do not change your browser settings to refuse cookies, our website will issue cookies
                    when you visit our website. If you continue to use our website, you agree and consent to our use of
                    cookies on your device. </p>
                <h2 class="font-semibold text-gray-600 tracking-wide uppercase text-purple-700 mt-2">Security</h2>
                <p> We employ security measures to protect your information from access by unauthorised persons and to
                    guard against unlawful processing, accidental loss, destruction and damage and we will do our best
                    to ensure that all records we hold remain secure in line with our obligations under Data Protection
                    Acts, 1988 and 2003. We take our security responsibilities seriously, employing the most appropriate
                    physical and technical measures, including staff training and awareness. We review our security
                    procedures regularly. </p>
                <h2 class="font-semibold text-gray-600 tracking-wide uppercase text-purple-700 mt-2">Retention </h2>
                <p> We do not retain your personal data for longer than it is necessary for us to comply with the
                    purpose for which you gave it to us. Any personal data which you provide to us using this website
                    will be used in line with the purposes for which you provided it (e.g. to contact you and answer any
                    queries which you have raised in the “Contact Us” form or to address any other feedback which you
                    send us in the “Contact Us” form) and after this purpose has been completed, we will delete your
                    personal data. </p>
                <h2 class="font-semibold text-gray-600 tracking-wide uppercase text-purple-700 mt-2">Accessing Your
                    Information</h2>
                <p> You are entitled to see the information we hold about you. On written request, we supply copies of
                    your personal data which you may have supplied to us using our website. If you wish to obtain copies
                    of this personal data, you should write to the COO of trach.io and ask that they provide you with an
                    Access Request Form. The law entitles us to charge you a fee for doing so (which currently is
                    €6.35). Your request will be dealt with as soon as possible and will not take more than 40 days to
                    process. If you discover St Aidan's Comprehensive holds inaccurate information about you, you can
                    request that we correct that information. In certain circumstances, you may also request that data
                    which you have supplied via our website be deleted (although you should note that if you request a
                    deletion, you would generally be expected to identify some contravention of data protection law in
                    the manner in which
                    <name of="" school="">
                        processes the data concerned). Upon written request, we will supply you with a Data
                        Rectification/Erasure Form for this purpose.
                    </name>
                </p>
                <h2 class="font-semibold text-gray-600 tracking-wide uppercase text-purple-700 mt-2">Contacting Us </h2>
                <p> If you are concerned about how your personal data is processed by our website, please do not
                    hesitate to bring these concerns to our attention using the "contact us" form on this
                    website. </p>
            </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
