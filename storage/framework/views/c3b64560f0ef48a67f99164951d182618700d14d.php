<ul class="d-flex">
    <li>
        <a href="<?php echo e(route('compare')); ?>">
            <div class="position-relative">
                <svg width="100%" height="100%" viewBox="0 0 18 16" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" xmlns:serif="http://www.serif.com/" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;">
                    <g transform="matrix(1,0,0,1,-57.0363,-4.35227)">
                        <g transform="matrix(1,0,0,1,53.7346,0)">
                            <g transform="matrix(0.957039,0,0,0.98305,-51.2843,0.0737701)">
                                <path d="M59.87,12.329L59.056,11.78L57.036,14.774L57.904,15.359L58.912,13.866C59.408,17.682 62.671,20.628 66.622,20.628C69.513,20.628 72.036,19.05 73.375,16.708L73.635,16.253L72.726,15.733L72.466,16.188C71.307,18.215 69.124,19.581 66.622,19.581C63.172,19.581 60.328,16.985 59.939,13.639L61.464,14.667L62.049,13.799L59.893,12.345L59.893,12.329L59.87,12.329ZM72.942,11.341L71.417,10.313L70.831,11.181L72.987,12.635L72.987,12.651L73.011,12.651L73.825,13.2L75.844,10.207L74.976,9.621L73.969,11.114C73.472,7.299 70.21,4.352 66.259,4.352C63.367,4.352 60.845,5.931 59.505,8.273L59.245,8.727L60.154,9.247L60.414,8.793C61.573,6.766 63.757,5.4 66.259,5.4C69.709,5.4 72.552,7.996 72.942,11.341Z"/>
                            </g>
                        </g>
                    </g>
                </svg>
                    <span class="counter-badge"><span ><?php echo e(Cart::instance('compare-list')->content()->count()); ?></span>
                    <span class="text compare"><?php echo e($lng->Compare); ?></span></span>
            </div>
        </a>
    </li>
    <li>
        <a href="<?php echo e(auth()->check() ? route('user.wishlist') : route('login')); ?>">
            <div class="position-relative">
                <svg width="100%" height="100%" viewBox="0 0 18 16" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" xmlns:serif="http://www.serif.com/" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;">
                    <g transform="matrix(1,0,0,1,-3,-4)">
                        <g transform="matrix(0.940519,0,0,0.91722,0.713657,0.853089)">
                            <path d="M11.713,4.85L12.001,5.108L12.289,4.85C14.469,2.892 17.838,2.958 19.938,5.061C22.033,7.162 22.11,10.505 20.17,12.692C20.165,12.697 11.999,20.875 11.999,20.875C11.999,20.875 3.835,12.697 3.835,12.697C1.89,10.511 1.966,7.159 4.062,5.062C6.164,2.961 9.527,2.89 11.713,4.85ZM19.132,5.866L19.132,5.865C17.47,4.201 14.789,4.134 13.049,5.696C13.049,5.696 12.002,6.636 12.002,6.636C12.002,6.636 10.954,5.697 10.954,5.697C9.209,4.133 6.533,4.201 4.867,5.867C3.217,7.518 3.134,10.16 4.655,11.906L4.665,11.917L12,19.264L19.335,11.918L19.345,11.907C20.867,10.16 20.785,7.522 19.132,5.866Z" style="fill-rule:nonzero;"/>
                        </g>
                    </g>
                </svg>
               <span class="counter-badge"> 
               <span><?php echo e($wishCount); ?></span>
                <span class="wishlist text"><?php echo e($lng->WishList); ?></span></span>
            </div>
        </a>
    </li>
    <li>
        <a href="javascript::void()" class="aside-cart-trigger">
            <div class="position-relative">
               <svg width="100%" height="100%" viewBox="0 0 19 15" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" xmlns:serif="http://www.serif.com/" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;">
                    <g transform="matrix(1,0,0,1,-29.0574,-5.15285)">
                        <g transform="matrix(1,0,0,1,26.4398,0)">
                            <g transform="matrix(1,0,0,1,-26.4398,0)">
                                <path d="M43.513,16.01C44.635,16.01 45.56,16.935 45.56,18.057C45.56,19.179 44.635,20.104 43.513,20.104C42.39,20.104 41.465,19.179 41.465,18.057C41.465,16.935 42.39,16.01 43.513,16.01ZM36.533,16.01C37.655,16.01 38.58,16.935 38.58,18.057C38.58,19.179 37.655,20.104 36.533,20.104C35.411,20.104 34.486,19.179 34.486,18.057C34.486,16.935 35.411,16.01 36.533,16.01ZM36.533,17.002C35.94,17.002 35.478,17.464 35.478,18.057C35.478,18.65 35.94,19.112 36.533,19.112C37.126,19.112 37.588,18.65 37.588,18.057C37.588,17.464 37.126,17.002 36.533,17.002ZM43.513,17.002C42.919,17.002 42.458,17.464 42.458,18.057C42.458,18.65 42.919,19.112 43.513,19.112C44.106,19.112 44.567,18.65 44.567,18.057C44.567,17.464 44.106,17.002 43.513,17.002ZM29.554,5.153L31.274,5.153C31.857,5.153 32.364,5.539 32.506,6.105C32.506,6.105 34.594,14.459 34.594,14.459L44.696,14.459L46.562,7.479C46.562,7.479 47.606,7.479 47.606,7.479C47.606,7.479 45.691,14.518 45.691,14.518C45.54,15.071 45.055,15.451 44.482,15.451L34.812,15.451C34.229,15.451 33.722,15.065 33.581,14.5C33.581,14.5 31.492,6.145 31.492,6.145L29.554,6.145C29.28,6.145 29.057,5.922 29.057,5.649C29.057,5.376 29.28,5.153 29.554,5.153ZM39.375,8.933L39.375,5.542L40.172,5.542L40.172,8.933L41.567,8.933L39.774,11.324L37.981,8.933L39.375,8.933Z" style="fill-rule:nonzero;"/>
                            </g>
                        </g>
                    </g>
                </svg>
                <span class="counter-badge"><span><?php echo e(Cart::instance('default')->content()->count()); ?></span>
                <span class="text cart"><?php echo e($lng->Cart); ?></span></span>
            </div>
        </a>
    </li>
</ul>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/easy/resources/views/load/front/header.blade.php ENDPATH**/ ?>