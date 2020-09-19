<template>
    <div class="flex-1 border-l-2 border-gray-200 ">

        <div class="mx-2 md:mx-auto w-full md:w-3/4 text-gray-800 p-4 md:p-8 bg-white rounded mt-2 lg:mt-8 mb-12">
            <h2 class="font-bold text-2xl text-left">Welcome, how can we help?</h2>
            <p class="mt-2 text-left">Hello, stuck somewhere? Don't worry, we're here to help you. All important support
                information is below.</p>

            <hr class="border-gray-200 my-4 md:my-8">

            <div class="block md:flex w-full">
                <div class="w-1/3 font-semibold text-lg mb-2 md:mb-0">Documentation</div>
                <div class="w-2/3">
                    <p class="text-gray-800 text-sm">We provide a set of videos to get you up and running with trach.io.
                        Select a video from the list below;</p>
                    <ul class="mt-4">
                        <li class="flex mt-1">
                            <icon-video class="text-gray-900"></icon-video><a
                                class="text-gray-900 hover:text-gray-700 underline text-sm ml-2" href="#">Introduction
                                (2:11)</a>
                        </li>
                        <li class="flex mt-1">
                            <icon-video class="text-gray-900"></icon-video><a
                                class="text-gray-900 hover:text-gray-700 underline text-sm ml-2" href="#">Shifts
                                (3:15)</a>
                        </li>
                        <li class="flex mt-1">
                            <icon-video class="text-gray-900"></icon-video><a
                                class="text-gray-900 hover:text-gray-700 underline text-sm ml-2" href="#">Actions
                                (1:15)</a>
                        </li>
                        <li class="flex mt-1">
                            <icon-video class="text-gray-900"></icon-video><a
                                class="text-gray-900 hover:text-gray-700 underline text-sm ml-2" href="#">Reports
                                (6:55)</a>
                        </li>
                        <li class="flex mt-1">
                            <icon-video class="text-gray-900"></icon-video><a
                                class="text-gray-900 hover:text-gray-700 underline text-sm ml-2" href="#">Users
                                (3:55)</a>
                        </li>
                        <li class="flex mt-1">
                            <icon-video class="text-gray-900"></icon-video><a
                                class="text-gray-900 hover:text-gray-700 underline text-sm ml-2" href="#">Logs &
                                Notifications (4:23)</a>
                        </li>
                    </ul>
                </div>
            </div>

            <hr class="border-gray-200 my-4 md:my-8">

            <div class="block md:flex w-full">
                <div class="w-1/3 font-semibold text-lg mb-2 md:mb-0">Account Information</div>
                <div class="w-2/3">
                    <p class="text-gray-700 text-sm">If you are the primary account holder for this trach.io tenant, you
                        will be able to see subscription status by clikcing the link below.</p>
                    <p class="mt-2"><a class="text-gray-900 hover:text-gray-700 underline text-sm "
                            href="/profile/billing">Account Information</a></p>
                </div>
            </div>
            <hr class="border-gray-200 my-4 md:my-8">

            <div class="block md:flex w-full">
                <div class="w-1/3 font-semibold text-lg mb-2 md:mb-0">Contact us</div>
                <div class="w-2/3">
                    <p class="text-gray-700 text-sm">Yuu can contact us anytime as an account holder for support,
                        general questions or trach.io product feedback. </p>
                    <p class="mt-4">
                        <button
                            @click="openContactModal()"
                            class="rounded shadow px-3 py-1 bg-gray-800 hover:bg-gray-700 hover:shadow-xl text-white">
                            Contact us
                        </button >
                    </p>
                    <p class="mt-4 text-gray-700 text-sm"> Tenant ID: {{this.$tenantId}}</p>
                </div>
            </div>
            <hr class="border-gray-200 my-4 md:my-8">

            <div class="block md:flex w-full">
                <div class="w-1/3 font-semibold text-lg mb-2 md:mb-0">Privacy & Security</div>
                <div class="w-2/3">
                    <p class="text-gray-700 text-sm">Copyright &copy; {{ new Date().getFullYear() }} trach.io. All
                        rights
                        reserved. </p>
                    <p class="text-gray-700 text-sm mt-4">
                        <a href="/terms" class="text-gray-900 hover:text-gray-700 underline text-sm">Terms</a>
                        <span class="mx-2">|</span>
                        <a href="/privacy" class="text-gray-900 hover:text-gray-700 underline text-sm">Privacy
                            Policy</a></p>
                </div>
            </div>
            <hr class="border-gray-200 my-4 md:my-8">

            <div class="block md:flex w-full">
                <div class="w-1/3 font-semibold text-lg mb-2 md:mb-0">About us</div>
                <div class="w-2/3">
                <p class="text-gray-700 text-sm mt-4">We care a lot about tracheostomy management for patients. Trach.io was built by parents for parents.</p>
                    <p class="flex items-center text-gray-700 text-sm mt-4">
                        <svg class="fill-current h-8 text-gray-800" viewBox="0 0 100 125">
                            <path
                                style="font-size:medium;font-style:normal;font-variant:normal;font-weight:400;font-stretch:normal;text-indent:0;text-align:start;text-decoration:none;line-height:normal;letter-spacing:normal;word-spacing:normal;text-transform:none;direction:ltr;block-progression:tb;writing-mode:lr-tb;text-anchor:start;baseline-shift:baseline;opacity:1;color:#000;fill:#000;fill-opacity:1;stroke:none;stroke-width:3.9999988100000001;marker:none;visibility:visible;display:inline;overflow:visible;enable-background:accumulate;font-family:Sans;-inkscape-font-specification:Sans"
                                d="M50 6C33.455 6 20 19.455 20 36c0 2.96.453 5.806 1.25 8.5.8 2.705 2.835 6.805 5.5 11.781 2.665 4.976 5.932 10.711 9.125 16.157 6.386 10.89 12.438 20.624 12.438 20.624a2 2 0 003.374 0s6.052-9.734 12.438-20.624c3.193-5.446 6.46-11.181 9.125-16.157 2.665-4.976 4.7-9.076 5.5-11.781A29.91 29.91 0 0080 36C80 19.455 66.545 6 50 6zm0 4c14.383 0 26 11.617 26 26 0 2.562-.37 5.031-1.063 7.375-.561 1.899-2.563 6.1-5.187 11s-5.885 10.612-9.063 16.031C55.203 79.762 51.33 85.973 50 88.125c-1.33-2.152-5.202-8.363-10.688-17.719-3.177-5.419-6.438-11.132-9.062-16.031-2.624-4.9-4.626-9.101-5.188-11A25.936 25.936 0 0124 36c0-14.383 11.617-26 26-26zm0 12c-7.708 0-14 6.292-14 14s6.292 14 14 14 14-6.292 14-14-6.292-14-14-14zm0 4a9.97 9.97 0 0110 10 9.97 9.97 0 01-10 10 9.97 9.97 0 01-10-10 9.97 9.97 0 0110-10z" />
                        </svg>
                        <span class="ml-2">Cork, Ireland</span>
                    </p>
                    <p class="flex items-center text-gray-700 text-sm">
                        <svg class="fill-current h-6 text-gray-800 mt-2 ml-1" viewBox="0 0 24 30">
                            <path
                                d="M21.25 4H2.75A2.752 2.752 0 000 6.75v10.5A2.752 2.752 0 002.75 20h18.5A2.752 2.752 0 0024 17.25V6.75A2.752 2.752 0 0021.25 4zM1.5 17.25V6.75c0-.156.037-.303.089-.441l6.71 5.249-6.738 5.996c-.025-.1-.061-.197-.061-.304zM12 12.548L2.99 5.5h18.02L12 12.548zm-2.5-.051l2.038 1.594a.75.75 0 00.924 0l2.038-1.594 6.746 6.003H2.754L9.5 12.497zm6.201-.94l6.71-5.249c.052.139.089.286.089.442v10.5c0 .107-.036.204-.061.303l-6.738-5.996z" />
                        </svg>
                        <span class="ml-2"><a href="mailto:admin@trach.io"
                                class="text-gray-900 hover:text-gray-700 underline text-sm">admin@trach.io</a></span>
                    </p>
                </div>
            </div>
            <hr class="border-gray-200 my-4 md:my-8">

            <div class="block md:flex w-full">
                <div class="w-1/3 font-semibold text-lg mb-2 md:mb-0">Credits</div>
                <div class="w-2/3">
                    <p class="text-gray-700 text-sm">Built with loving care with <a
                            class="text-gray-900 hover:text-gray-700 underline text-sm" target="_blank"
                            href="https://tailwindcss.com/">Tailwind</a>, <a
                            class="text-gray-900 hover:text-gray-700 underline text-sm" target="_blank"
                            href="www.laravel.com">Laravel</a>, <a
                            class="text-gray-900 hover:text-gray-700 underline text-sm" target="_blank"
                            href="https://vuejs.org/">VueJS</a> & <a
                            class="text-gray-900 hover:text-gray-700 underline text-sm" target="_blank"
                            href="https://thenounproject.com/">Noun project icons</a>
                    </p>
                </div>
            </div>

        </div>
        <alert v-if="showAlert" :messagedata="alertmessage" @close="showAlert = false"></alert>

        <support-contact-modal :showModal="showContactModal" @close="showContactModal = false"
            @alert="alert($event)"></support-contact-modal>
    </div>

</template>

<script>
import Alert from '../components/Alert';
import IconVideo from '../components/support/svgs/IconVideo';
import SupportContactModal from '../components/support/SupportContactModal';
export default {
    data: () => ({
        pagename: 'support',
        showAlert: false,
        showContactModal: false,
        errors: [],
    }),
    components: {Alert, IconVideo, SupportContactModal},
    methods: {
        alert(event) {
            this.sendMessage(event.status, event.message);
        },
        openContactModal() {
            this.showContactModal = true;
        },
    },
}
</script>