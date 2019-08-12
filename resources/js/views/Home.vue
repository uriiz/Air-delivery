<template>
<div class="lp" style="background: #fff">
    <header-top></header-top>
    <div class="container">
        <welcome></welcome>
    </div>
    <div class="customers">
        <img src="https://res.cloudinary.com/dapulse/image/upload/f_auto/remote_mondaycom_static/img/customers/wework.png" alt="">
        <img src="https://res.cloudinary.com/dapulse/image/upload/f_auto/remote_mondaycom_static/img/customers/discovery.png" alt="">
        <img src="https://res.cloudinary.com/dapulse/image/upload/f_auto/remote_mondaycom_static/img/customers/carlsberg.png" alt="">
        <img src="https://res.cloudinary.com/dapulse/image/upload/f_auto/remote_mondaycom_static/img/customers/wix.png" alt="">
        <img src="https://res.cloudinary.com/dapulse/image/upload/f_auto/remote_mondaycom_static/img/customers/philips.png" alt="">
    </div>
    <div class="container">


        <div class="sec-part">
        <div class="title-container">
            <div class="topic">Simple and intuitive</div>
            <p class="animate-top is-slow-3">
                Easy onboarding, <br>
                fast adoption
            </p>
        </div>
        <div class="sec-part-img" style="background-image: url(/images/shot12.png)">

        </div>
        </div>
    </div>
    <div class="third-part" style="background-image: url(https://www.titan-soft.com/en/wp-content/uploads/2019/06/stock-photo-designers-man-drawing-website-ux-app-development-user-experience-concept-696064291-1.jpg)">

    </div>
    <div class="last-part">
        <div class="container">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 119 160" width="119" height="160" preserveAspectRatio="xMidYMid meet" style="width: 100%; height: 100%; transform: translate3d(0px, 0px, 0px);"><defs><clipPath id="animationMask_oXkrYVbDWh"><rect width="119" height="160" x="0" y="0"></rect></clipPath></defs><g clip-path="url(#animationMask_oXkrYVbDWh)"><g style="display: block;" transform="matrix(-0.6698979735374451,-0.011693112552165985,0.011693112552165985,-0.6698979735374451,101.87806701660156,145.96591186523438)" opacity="1"><g opacity="1" transform="matrix(1.5,0,0,1.5,0,0)"><path stroke-linecap="round" stroke-linejoin="round" fill-opacity="0" stroke="rgb(51,51,51)" stroke-opacity="1" stroke-width="6" d=" M1.7599999904632568,0 C1.7599999904632568,0 9.5,68.75 59.779998779296875,74.83000183105469 C85.5199966430664,78.19000244140625 93.1500015258789,44.56999969482422 72.9800033569336,29.6200008392334 C52.79999923706055,14.670000076293945 1,40.08000183105469 0.09000000357627869,93.62000274658203 C-0.8199999928474426,119.94000244140625 5.539999961853027,132.64999389648438 5.539999961853027,132.64999389648438"></path></g></g><g style="display: none;" transform="matrix(0.6253637075424194,-0.24045845866203308,-0.24045845866203308,-0.6253637075424194,93.14442443847656,158.5027618408203)" opacity="1"><g opacity="1" transform="matrix(1.5,0,0,1.5,0,0)"><path stroke-linecap="round" stroke-linejoin="round" fill-opacity="0" stroke="rgb(51,51,51)" stroke-opacity="1" stroke-width="6" d=" M1.8020000457763672,21.783000946044922 C1.8020000457763672,21.783000946044922 9.711999893188477,3.072999954223633 9.711999893188477,3.072999954223633 C9.711999893188477,3.072999954223633 23.98200035095215,17.542999267578125 23.98200035095215,17.542999267578125"></path></g></g><g style="display: block;" transform="matrix(0.6279789209365845,-0.2335432767868042,-0.2335432767868042,-0.6279789209365845,93.02388000488281,158.69342041015625)" opacity="1"><g opacity="1" transform="matrix(1.5,0,0,1.5,0,0)"><path stroke-linecap="round" stroke-linejoin="round" fill-opacity="0" stroke="rgb(51,51,51)" stroke-opacity="1" stroke-width="6" d=" M1.8020000457763672,21.783000946044922 C1.8020000457763672,21.783000946044922 9.711999893188477,3.072999954223633 9.711999893188477,3.072999954223633 C9.711999893188477,3.072999954223633 23.98200035095215,17.542999267578125 23.98200035095215,17.542999267578125"></path></g></g></g></svg>

            <div class="title-container">
                <p class="likp-p is-slow-2">
                    Workflow made simple. <span style="color:#00CC6F"> Try it for free.</span>
                </p>
                <form class="lp-form-trigger is-slow-3">
                    <input type="email" class="input lp-mail" placeholder="Enter your work email">
                    <div class="signup-button-wrapper">
                        <button type="submit">Get Started</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="last-footer">
        <div class="container">
            Made with
            <img src="https://res.cloudinary.com/dapulse/image/upload/f_auto,w_16/remote_mondaycom_static/img/heart_small.png" alt="">
            by freight Me
        </div>
    </div>
</div>
</template>

<script>
    export default {
        mounted() {
            window.onscroll = fadingEf;
            function fadingEf() {
                if($('.topic').is(":in-viewport")){
                    $('.topic').addClass('animate-top');
                    $('.lp-form-trigger').addClass('animate-top');
                    $('.likp-p').addClass('animate-top');
                    $('.last-part svg').addClass('animate-top');
                }
                if($('.last-footer').is(":in-viewport")){
                    
                    $('.last-part svg').addClass('animate-top');
                    $('.last-part .lp-form-trigger').addClass('animate-top');
                }

            }
        }
    }
</script>