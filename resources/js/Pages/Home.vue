<template>
    <v-app id="inspire">
        <appNavVue></appNavVue>
        <v-main>
            <v-container class="" fluid>
                <alertsVue></alertsVue>
            </v-container>
        </v-main>
    </v-app>
</template>

<script>
import appNavVue from "../Layouts/appNav.vue";
import alertsVue from "../components/alerts.vue";
export default {
    name: "home",
    components: {
        appNavVue,
        alertsVue,
    },
    data() {
        return {};
    },
};
</script>
