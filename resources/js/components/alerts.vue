<template>
    <div class="grey lighten-5 fixed fixo w-100" width="100%">
        <v-sheet class="mx-auto grey lighten-5 mt-4" width="100%">
            <v-slide-group multiple show-arrows>
                <v-slide-item v-for="(card, n) in cards" :key="n">
                    <v-col>
                        <v-alert
                            border="bottom"
                            prominent
                            :icon="card.icon"
                            :type="card.tipo"
                            >{{ card.titulo }}</v-alert
                        >
                    </v-col>
                </v-slide-item>
            </v-slide-group>
        </v-sheet>
        <v-divider></v-divider>
    </div>
</template>

<script>
export default {
    name: "alerts",
    data() {
        return {
            model: null,
            cards: [
                {
                    titulo: "Alunos",
                    icon: "mdi-account-group-outline",
                    tipo: "error",
                    color: "blue",
                },
                {
                    titulo: "Professores",
                    icon: "mdi-account-school-outline",
                    tipo: "success",
                    color: "yellow",
                },
                {
                    titulo: "Salas",
                    icon: "mdi-greenhouse",
                    tipo: "primary",
                    color: "yellow",
                },
                {
                    titulo: "Turmas",
                    icon: "mdi-account-details-outline",
                    tipo: "waring",
                    color: "yellow",
                },
            ],
        };
    },
};
</script>

<style scoped>
.fixo {
    width: 83.2% !important;
    z-index: 1;
}
</style>
