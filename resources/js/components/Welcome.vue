<template>
    <div>Welcome to Vue</div>
    <div if="">This is loaded via Connah's Vue Component!</div>
</template>

<script>
    export default {
        name: "welcome",
        props: [''],
        data() {
            return {
                test: ""
            }
        },
        methods: {
            functionsWouldGoHere(){
                this.wouldDo("Something");
            }
        }
    }
</script>
