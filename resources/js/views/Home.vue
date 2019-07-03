<template>
<div>
    <div class="container">
        <div class="main-form">
            <div class="triancle"></div>
            <section>
                <b-field label="Place Of Loading">
                    <b-input value="" ></b-input>
                </b-field>

                <b-field label="Place Of Discharge">
                    <b-input value="israel"></b-input>
                </b-field>

                <b-field label="Loading Date">
                    <b-datepicker
                            :mobile-native="false"
                            :min-date="minDate"
                            placeholder="Loading Date"
                            icon="calendar-today">
                    </b-datepicker>
                </b-field>

                <b-field label="Discharge Date">
                    <b-datepicker
                            placeholder="Loading Date"
                            icon="calendar-today">
                    </b-datepicker>
                </b-field>

                <b-field label="Password"
                         type="is-warning"
                         :message="['Password is too short', 'Password must have at least 8 characters']">
                    <b-input value="123" type="password" maxlength="30"></b-input>
                </b-field>

                <b-field label="Subject">
                    <b-select placeholder="Select a subject">
                        <option value="1">Option 1</option>
                        <option value="2">Option 2</option>
                    </b-select>
                </b-field>
            </section>

        </div>
    </div>
</div>
</template>

<script>
    export default {
        data() {
            const today = new Date()

            return {
                date: new Date(),
                minDate: new Date(today.getFullYear(), today.getMonth(), today.getDate() ),
                maxDate: new Date(today.getFullYear(), today.getMonth(), today.getDate() + 5)
            }
        }
    }
</script>