<template>
    <div class="flex-center position-ref full-height">
        <div class="content">
            <div class="title m-b-md">
                {{title}}
            </div>
            <div>
                <b-alert show>Default Alert</b-alert>

                <b-alert variant="success" show>Success Alert</b-alert>

                <b-alert variant="danger"
                         dismissible
                         :show="showDismissibleAlert"
                         @dismissed="showDismissibleAlert=false">
                    Dismissible Alert!
                </b-alert>

                <b-alert :show="dismissCountDown"
                         dismissible
                         variant="warning"
                         @dismissed="dismissCountDown=0"
                         @dismiss-count-down="countDownChanged">
                    <p>This alert will dismiss after {{dismissCountDown}} seconds...</p>
                    <b-progress variant="warning"
                                :max="dismissSecs"
                                :value="dismissCountDown"
                                height="4px">
                    </b-progress>
                </b-alert>

                <b-btn @click="showAlert" variant="info" class="m-1">
                    Show alert with count-down timer
                </b-btn>
                <b-btn @click="showDismissibleAlert=true" variant="info" class="m-1">
                    Show dismissible alert ({{showDismissibleAlert?'visible':'hidden'}})
                </b-btn>
                <b-table striped hover :items="items"></b-table>
            </div>
        </div>
    </div>
</template>
<script>

    const items = [
        { isActive: true, age: 40, first_name: "Dickerson", last_name: "Macdonald" },
        { isActive: false, age: 21, first_name: "Larsen", last_name: "Shaw" },
        { isActive: false, age: 89, first_name: "Geneva", last_name: "Wilson" },
        { isActive: true, age: 38, first_name: "Jami", last_name: "Carney" }
    ];

    export default {
        props : ['title'],
        name: "HelloWorld",
        data() {
            return {
                msg: "Welcome to Your Shiny New Vue.js App",
                dismissSecs: 10,
                dismissCountDown: 0,
                showDismissibleAlert: false,
                items: items
            };
        },
        methods: {
            countDownChanged(dismissCountDown) {
                this.dismissCountDown = dismissCountDown;
            },
            showAlert() {
                this.dismissCountDown = this.dismissSecs;
            }
        }
    };

</script>
<style scoped>
    html, body {
        background-color: #fff;
        color: #636b6f;
        font-family: 'Raleway', sans-serif;
        font-weight: 100;
        height: 100vh;
        margin: 0;
    }

    .full-height {
        height: 100vh;
    }

    .flex-center {
        align-items: center;
        display: flex;
        justify-content: center;
    }

    .position-ref {
        position: relative;
    }

    .top-right {
        position: absolute;
        right: 10px;
        top: 18px;
    }

    .content {
        text-align: center;
    }

    .title {
        font-size: 84px;
    }

    .links > a {
        color: #636b6f;
        padding: 0 25px;
        font-size: 12px;
        font-weight: 600;
        letter-spacing: .1rem;
        text-decoration: none;
        text-transform: uppercase;
    }

    .m-b-md {
        margin-bottom: 30px;
    }
</style>
