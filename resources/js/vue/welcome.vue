<template>
    <div>Welcome to Vue</div>
    <div if="showDescription">This is loaded via Connah's Vue Component!</div>
</template>

<script>
    export default {
        name: "welcome",
        props: ['showDescription'],
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
