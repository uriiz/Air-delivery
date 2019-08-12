<template>
    <div class="">
        <div class="top-landing">
            <div class="title-container">
                <p class="animate-top">
                    A new way to manage <br>your <span style="color:#00CC6F">Shipment</span>
                </p>
                <form class="lp-form-trigger animate-top is-slow-1">
                    <input type="email" class="input lp-mail" placeholder="Enter your work email">
                    <div class="signup-button-wrapper">
                        <button type="submit">Get Started</button>
                    </div>
                </form>
            </div>
            <div class="slider-land">
                <carousel :interval="3000" direction="left"
                        :data="['<img src=\'/images/shot7.png\'>', '<img src=\'/images/shot8.png\'>', '<img src=\'/images/shot9.png\'>', '<img src=\'/images/shot10.png\'>']"></carousel>
            </div>
        </div>
    </div>
</template>