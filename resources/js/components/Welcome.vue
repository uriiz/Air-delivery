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
                <div class="example-slide" style="background-image: url(/images/shot53.png)"></div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
        },
        data() {
            return {
                data: [
                    '',
                    '<div class="example-slide" style="background-image: url(/images/shot30.png)"></div>',
                    '<div class="example-slide" style="background-image: url(/images/shot12.png)"></div>',

                ],
            }
        },
    }
</script>