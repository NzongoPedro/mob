<template>
    <div>
        <v-system-bar app>
            <v-spacer></v-spacer>

            <v-icon>mdi-square</v-icon>

            <v-icon>mdi-circle</v-icon>

            <v-icon>mdi-triangle</v-icon>
        </v-system-bar>

        <v-navigation-drawer v-model="drawer" app>
            <v-sheet color="grey lighten-4" class="pa-4 w-100">
                <v-avatar class="mb-4" size="64">
                    <img class="img" :src="`/images/avatar-05.png`" />
                </v-avatar>

                <div>Josemar Camisinha</div>
            </v-sheet>

            <v-divider></v-divider>

            <v-list>
                <v-list-item
                    v-for="[icon, text, route] in links"
                    :key="icon"
                    link
                >
                    <v-list-item-icon>
                        <v-icon>{{ icon }}</v-icon>
                    </v-list-item-icon>

                    <v-list-item-content>
                        <v-list-item-title>
                            <inertia-link :href="`${route}`" class="links">
                                {{ text }}
                            </inertia-link>
                        </v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
            </v-list>
        </v-navigation-drawer>
    </div>
</template>

<script>
export default {
    name: "appNav",
    data: () => ({
        drawer: null,
        links: [
            ["mdi-monitor-dashboard", "Dashboard", "home"],
            ["mdi-account-group-outline", "Alunos", "alunos"],
            ["mdi-list-box-outline", "matrículas", "matriculados"],
            ["mdi-account-school-outline", "professores", "professores"],
            ["mdi-account-credit-card-outline", "funcionários", "funcionarios"],
            ["mdi-message-text-clock-outline", "horários", "horarios"],
            ["mdi-cash", "Pagamentos", "paagamentos"],
            ["mdi-alert-octagon", "Spam"],
        ],
    }),
};
</script>

<style>
.links {
    color: #424242 !important;
    text-transform: uppercase;
    font-size: 14px;
}
</style>
