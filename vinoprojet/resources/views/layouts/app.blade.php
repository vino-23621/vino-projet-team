<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} - @yield('title')</title>
    <link rel="stylesheet" href="{{ asset('assets/css/import.css') }}">
    <script type="module" src="{{ asset('js/cellar-modal.js') }}"></script>
    <script type="module" src="{{ asset('js/cellar-modal-edit.js') }}"></script>
    <script type="module" src="{{ asset('js/bottle-modal.js') }}"></script>
    <script type="module" src="{{ asset('js/banner-success.js') }}"></script>
    <script type="module" src="{{ asset('js/notificationBanner.js') }}"></script>
    <script type="module" src="{{ asset('js/login_validation.js') }}"></script>
    <script type="module" src="{{ asset('js/mainNav.js') }}"></script>
    <script type="module" src="{{ asset('js/apicellar.js') }}"></script>





    <!-- Typographie -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&family=Noto+Serif:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <!-- Icones -->
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />

</head>

<body>
    @auth
    <nav id="nav-main">
        <div id="nav-main-menu">
            <a class="nav-main-menu-links {{ request()->routeIs('cellars.index') ? 'active' : '' }}" href="{{route('cellars.index')}}">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path d="M4 10.125C4 5.63769 7.63769 2 12.125 2V2C16.6123 2 20.25 5.63769 20.25 10.125V20.0556C20.25 20.8533 19.6033 21.5 18.8056 21.5H5.44444C4.6467 21.5 4 20.8533 4 20.0556V10.125Z"
                        stroke="currentColor" stroke-width="1.5" />
                    <path d="M19.4375 6.875H13.9375C13.3852 6.875 12.9375 7.32272 12.9375 7.875V11.75"
                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                    <path d="M20.2499 11.9412H9.7793C9.22701 11.9412 8.7793 12.3889 8.7793 12.9412V15.7647"
                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                    <path d="M20.25 16.625H5C4.44772 16.625 4 17.0727 4 17.625V19.875"
                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                </svg>

                <span>Celliers</span>
            </a>
            <a class="nav-main-menu-links {{ request()->routeIs('catalog.index') ? 'active' : '' }}" href="{{route('catalog.index')}}">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path d="M12.875 11.5652C12.0714 10.9402 10.625 9.5 10.625 6.34783C10.625 4.79065 10.625 3.78168 10.625 3.12434C10.625 2.50302 10.1213 2 9.5 2V2C8.87868 2 8.375 2.50209 8.375 3.12341C8.375 3.76831 8.375 4.77657 8.375 6.34783C8.375 9.3954 6.39643 12.3641 5.46913 13.5881C5.17599 13.9751 5 14.4416 5 14.9271V20C5 21.1046 5.89543 22 7 22H12.2609C13.2214 22 14 21.2214 14 20.2609V20.2609"
                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                    <path d="M16.4941 12L16.4941 19"
                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                    <path d="M13 15.505L20 15.505"
                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                </svg>
                <span>Catalogue</span>
            </a>
            <a class="nav-main-menu-links {{ request()->routeIs('wishlist.index') ? 'active' : '' }}" href="{{route('wishlist.index')}}">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path d="M11.4863 1.28345C14.6131 0.980102 17.2489 3.4435 17.249 6.51001V7.31274C18.8044 7.47811 19.9175 7.97547 20.626 8.81763C21.5042 9.8618 21.5868 11.2342 21.4453 12.5129L21.4443 12.5237L20.6943 18.5237L20.6934 18.5227C20.5824 19.5473 20.3233 20.669 19.4092 21.5042C18.498 22.3362 17.0864 22.7502 15 22.7502H9C6.91336 22.7502 5.50093 22.3365 4.58984 21.5042C3.67215 20.6656 3.41385 19.538 3.30371 18.51V18.509L2.55566 12.5237L2.55469 12.5129C2.41321 11.2344 2.49515 9.86174 3.37305 8.81763C4.08114 7.97578 5.19457 7.47837 6.74902 7.31274V6.69946C6.74934 4.10834 8.80967 1.53629 11.4863 1.28442V1.28345ZM8 8.75024C5.9533 8.7503 4.98604 9.23114 4.52148 9.78345C4.05146 10.3426 3.91746 11.1817 4.04395 12.3372L4.79395 18.3372L4.7959 18.3499V18.3508C4.89575 19.2823 5.1023 19.9404 5.60156 20.3967C6.10789 20.8593 7.06711 21.2502 9 21.2502H15C16.9324 21.2502 17.891 20.8591 18.3975 20.3967C18.8969 19.9404 19.1042 19.2824 19.2041 18.3508L19.2051 18.3372H19.2061L19.9541 12.3479L19.9902 11.927C20.0444 10.9804 19.891 10.2741 19.4785 9.78345C19.0139 9.23118 18.0467 8.75027 16 8.75024H8ZM8.50293 11.0002C9.05502 11.0005 9.50293 11.4481 9.50293 12.0002C9.50283 12.5523 9.05496 13 8.50293 13.0002H8.49316C7.94129 12.9998 7.49327 12.5522 7.49316 12.0002C7.49316 11.4482 7.94123 11.0007 8.49316 11.0002H8.50293ZM15.5049 11.0002C16.057 11.0005 16.5049 11.4481 16.5049 12.0002C16.5048 12.5524 16.057 13 15.5049 13.0002H15.4951C14.9432 12.9998 14.4952 12.5522 14.4951 12.0002C14.4951 11.4482 14.9432 11.0007 15.4951 11.0002H15.5049ZM15.749 6.51001C15.7489 4.31691 13.8647 2.5602 11.6318 2.77661H11.6289C9.8078 2.9468 8.24935 4.79225 8.24902 6.69946V7.25024H15.749V6.51001Z"
                        fill="currentColor" />
                </svg>
                <span>Liste d'achat</span>
            </a>
            <a class="nav-main-menu-links {{ request()->routeIs('user.show') ? 'active' : '' }}" href="{{ route('user.show') }}">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 1.25C17.9371 1.25 22.75 6.06294 22.75 12C22.75 16.0069 20.5561 19.4987 17.3057 21.3477C17.2928 21.355 17.2795 21.3618 17.2666 21.3691C17.1454 21.4374 17.0225 21.5027 16.8984 21.5664C16.8685 21.5818 16.8387 21.5972 16.8086 21.6123C16.7047 21.6644 16.6 21.7149 16.4941 21.7637C16.4377 21.7898 16.3812 21.8157 16.3242 21.8408C16.2333 21.8808 16.1421 21.9204 16.0498 21.958C15.9799 21.9865 15.9095 22.0139 15.8389 22.041C15.7518 22.0743 15.6643 22.1066 15.5762 22.1377C15.4998 22.1647 15.4229 22.1905 15.3457 22.2158C15.2707 22.2404 15.1958 22.2652 15.1201 22.2881C15.01 22.3215 14.8987 22.3519 14.7871 22.3818C14.7383 22.3949 14.6897 22.4085 14.6406 22.4209C14.5162 22.4524 14.3908 22.4807 14.2646 22.5078C14.2187 22.5177 14.1731 22.5288 14.127 22.5381C13.9996 22.5637 13.8712 22.5854 13.7422 22.6064C13.6976 22.6137 13.6532 22.6222 13.6084 22.6289C13.4748 22.649 13.3403 22.6656 13.2051 22.6807C13.1631 22.6853 13.1212 22.6911 13.0791 22.6953C12.9309 22.7101 12.7818 22.7208 12.6318 22.7295C12.6025 22.7312 12.5733 22.7349 12.5439 22.7363C12.3638 22.7453 12.1825 22.751 12 22.751C11.8172 22.751 11.6356 22.7453 11.4551 22.7363C11.4257 22.7349 11.3965 22.7312 11.3672 22.7295C11.2172 22.7208 11.0681 22.7101 10.9199 22.6953C10.8778 22.6911 10.8359 22.6854 10.7939 22.6807C10.6587 22.6656 10.5242 22.649 10.3906 22.6289C10.3459 22.6222 10.3014 22.6137 10.2568 22.6064C10.1279 22.5854 9.99945 22.5637 9.87207 22.5381C9.82594 22.5288 9.78029 22.5177 9.73438 22.5078C9.60825 22.4807 9.48282 22.4524 9.3584 22.4209C9.30935 22.4085 9.26069 22.3949 9.21191 22.3818C9.10028 22.3519 8.98906 22.3215 8.87891 22.2881C8.80323 22.2652 8.72828 22.2404 8.65332 22.2158C8.57613 22.1905 8.49926 22.1647 8.42285 22.1377C8.33472 22.1066 8.24722 22.0743 8.16016 22.041C8.08845 22.0135 8.01725 21.985 7.94629 21.9561C7.85889 21.9204 7.77178 21.8845 7.68555 21.8467C7.61601 21.8161 7.54727 21.784 7.47852 21.752C7.39561 21.7135 7.31318 21.6743 7.23145 21.6338C7.17157 21.604 7.11197 21.5738 7.05273 21.543C6.94518 21.4871 6.83879 21.4295 6.7334 21.3701C6.71969 21.3624 6.70606 21.3545 6.69238 21.3467C3.44298 19.4975 1.25 16.0061 1.25 12C1.25 6.06294 6.06294 1.25 12 1.25ZM12.0068 16.1855C10.3196 16.1856 8.66827 16.6121 7.44727 17.4219L7.44824 17.4229C6.67713 17.9418 6.24598 18.5361 6.07812 19.1006C7.68428 20.4455 9.74384 21.25 12 21.25C14.2559 21.2499 16.3148 20.4453 17.9209 19.1006C17.753 18.5361 17.3219 17.9418 16.5508 17.4229V17.4219C15.3407 16.613 13.6949 16.1855 12.0068 16.1855ZM12 2.75C6.89137 2.75 2.75 6.89137 2.75 12C2.75 14.2731 3.57143 16.3534 4.93164 17.9639C5.29417 17.2857 5.86998 16.6776 6.61133 16.1787L6.61523 16.1758C8.13364 15.1673 10.091 14.6856 12.0068 14.6855C13.9226 14.6855 15.8771 15.1667 17.3867 16.1768L17.3887 16.1787C18.13 16.6776 18.7041 17.2866 19.0664 17.9648C20.4274 16.3542 21.25 14.2738 21.25 12C21.25 6.89137 17.1086 2.75 12 2.75ZM12.001 5.48047C14.2251 5.48062 16.0303 7.28662 16.0303 9.51074V9.51465C16.0178 11.6827 14.3128 13.4563 12.1465 13.5303C12.1025 13.5318 12.0582 13.5287 12.0146 13.5225L12.0166 13.5234C12.0141 13.5233 12.0101 13.5234 12.0049 13.5234C11.9926 13.5234 11.9807 13.5235 11.9736 13.5244C11.9345 13.5293 11.8949 13.5316 11.8555 13.5303C9.69288 13.4565 7.9711 11.6859 7.9707 9.51074C7.9707 7.28802 9.76527 5.48047 12.001 5.48047ZM12.001 6.98047C10.5967 6.98047 9.4707 8.11346 9.4707 9.51074C9.4711 10.87 10.5416 11.9756 11.8916 12.0293C11.9699 12.0243 12.0517 12.0212 12.1318 12.0273C13.4662 11.9627 14.52 10.8676 14.5303 9.51074L14.5176 9.25195C14.3878 7.97738 13.3094 6.98061 12.001 6.98047Z" fill="currentColor" />
                </svg>

                <span>Compte</span>
            </a>
            <a class="nav-main-menu-links" href="{{ route('logout') }}">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M11 20C11 19.4477 10.5523 19 10 19H5V5H10C10.5523 5 11 4.55228 11 4C11 3.44771 10.5523 3 10 3H5C3.89543 3 3 3.89543 3 5V19C3 20.1046 3.89543 21 5 21H10C10.5523 21 11 20.5523 11 20Z" fill="currentColor" />
                    <path d="M21.7136 12.7005C21.8063 12.6062 21.8764 12.498 21.9241 12.3828C21.9727 12.2657 21.9996 12.1375 22 12.003L22 12L22 11.997C21.9992 11.7421 21.9016 11.4874 21.7071 11.2929L17.7071 7.29289C17.3166 6.90237 16.6834 6.90237 16.2929 7.29289C15.9024 7.68342 15.9024 8.31658 16.2929 8.70711L18.5858 11H9C8.44771 11 8 11.4477 8 12C8 12.5523 8.44771 13 9 13H18.5858L16.2929 15.2929C15.9024 15.6834 15.9024 16.3166 16.2929 16.7071C16.6834 17.0976 17.3166 17.0976 17.7071 16.7071L21.7064 12.7078L21.7136 12.7005Z" fill="currentColor" />
                </svg>
                <span>Déconnexion</span>
            </a>
        </div>
    </nav>
    @endauth

    <main>
        @if (session('success'))
        <div data-js="notification-banner" class="notification-banner">
            <div>
                <i class="fa-solid fa-check notification-banner-icon"></i>
                <div>
                    <span class="notification-banner-title">Succès :</span>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
            <i data-js="notification-close" class="fa-solid fa-xmark notification-banner-icon"></i>
        </div>
        @endif

        @if (session('error'))
        <div data-js="notification-banner" class="notification-banner fail">
            <div>
                <i class="fa-solid fa-triangle-exclamation notification-banner-icon"></i>
                <div>
                    <span class="notification-banner-title">Erreur :</span>
                    <span>{{ session('error') }}</span>
                </div>
            </div>
            <i data-js="notification-close" class="fa-solid fa-xmark notification-banner-icon"></i>
        </div>
        @endif
        @if (session('information'))
        <div data-js="notification-banner" class="notification-banner information">
            <div>
                <i class="fa-solid fa-circle-info notification-banner-icon"></i>
                <div>
                    <span class="notification-banner-title">Bienvenu</span>
                    <span>{{ session('information') }}</span>
                </div>
            </div>
            <i data-js="notification-close" class="fa-solid fa-xmark notification-banner-icon"></i>
        </div>
        @endif

        @yield ('content')
    </main>

</body>

</html>