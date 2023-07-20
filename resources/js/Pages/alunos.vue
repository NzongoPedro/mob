<template>
    <v-app>
        <appNavVue></appNavVue>
        <v-main>
            <alertsVue></alertsVue>

            <br /><br />
            <v-container class="mt-16 my-16">
                <v-card class="mt-6">
                    <!-- Botões no topo direito -->
                    <div class="float-right m-4">
                        <v-tooltip top color="primary">
                            <template v-slot:activator="{ on, attrs }">
                                <v-btn
                                    color="primary"
                                    depressed
                                    elevation="2"
                                    raised
                                    v-bind="attrs"
                                    v-on="on"
                                >
                                    <v-icon>mdi-format-list-text</v-icon>
                                </v-btn>
                            </template>
                            <span>Vista de grelha</span>
                        </v-tooltip>

                        <v-tooltip top color="primary">
                            <template v-slot:activator="{ on, attrs }">
                                <v-btn
                                    color="primary"
                                    depressed
                                    elevation="2"
                                    raised
                                    v-bind="attrs"
                                    v-on="on"
                                >
                                    <v-icon>mdi-table</v-icon>
                                </v-btn>
                            </template>
                            <span>Vista tabelada</span>
                        </v-tooltip>

                        <v-tooltip top color="primary">
                            <template v-slot:activator="{ on, attrs }">
                                <v-btn
                                    color="primary"
                                    depressed
                                    elevation="2"
                                    raised
                                    v-bind="attrs"
                                    v-on="on"
                                >
                                    <v-icon>mdi-file-pdf-box</v-icon>
                                </v-btn>
                            </template>
                            <span>Guardar em PDF</span>
                        </v-tooltip>

                        <modalAlunoVue></modalAlunoVue>
                    </div>

                    <v-card-title primary-title>
                        <div>
                            <h3 class="headline mb-0">Alunos</h3>
                            <div>Gerenciamento</div>
                        </div>
                    </v-card-title>
                </v-card>

                <!-- Lista de alunos -->
                <v-row class="mt-2">
                    <v-col cols="3" v-for="(aluno, i) in alunos" :key="i">
                        <v-hover open-delay="200" elevatio="5">
                            <v-card color="#FAFAFA">
                                <div
                                    class="align-center justify-center align-center m-auto"
                                >
                                    <div>
                                        <br />
                                        <v-img
                                            class="img"
                                            v-if="
                                                aluno.aluno_genero == 'Femenino'
                                            "
                                            :src="`/images/avatar_woman.png`"
                                        >
                                        </v-img>
                                        <v-img
                                            class="img"
                                            v-if="
                                                aluno.aluno_genero ==
                                                'Masculino'
                                            "
                                            src="/images/avatar_man.png"
                                        >
                                        </v-img>
                                    </div>
                                </div>
                                <div class="text-h5">
                                    <h5 class="text--grey">
                                        <inertia-link
                                            :href="`alunos/${aluno.idtb_aluno}`"
                                            class="links"
                                        >
                                            {{ aluno.aluno_nome }}
                                        </inertia-link>
                                    </h5>
                                    <span
                                        ><b
                                            >Classe:
                                            {{ aluno.aluno_id_classe }}º
                                        </b>
                                    </span>
                                    <v-divider vertical></v-divider>
                                    <span
                                        ><b
                                            >Turno:
                                            {{ aluno.aluno_id_turma }}</b
                                        >
                                    </span>
                                </div>
                            </v-card>
                        </v-hover>
                    </v-col>
                </v-row>
            </v-container>
        </v-main>
    </v-app>
</template>

<script>
import appNavVue from "../Layouts/appNav.vue";
import alertsVue from "../components/alerts.vue";
import modalAlunoVue from "../components/modalAluno.vue";
export default {
    name: "alunos",
    components: {
        appNavVue,
        alertsVue,
        modalAlunoVue,
    },
    props: ["dados"],
    data() {
        return {
            alunos: "",
        };
    },
    methods: {
        async fetchAlunos() {
            // Chamada para buscar os dados dos alunos do servidor usando o Inertia
            const response = await axios.get("/api/alunos"); // Substitua pelo endpoint correto

            // Atualize o array de alunos com os dados recebidos do servidor
            this.alunos = response.data.alunos;
        },
    },
    mounted() {
        this.fetchAlunos();
        setInterval(this.fetchAlunos, 1000);
    },
};
</script>

<style scoped>
.img {
    width: 100px;
    height: 100px;
    margin: auto !important;
    border-radius: 100%;
}
.text-h5 {
    text-align: center !important;
    margin-top: 4px;
    font-size: 15px !important;
    margin-bottom: 20px;
}
.text-h5 span {
    text-align: center !important;
    margin-top: 4px;
    font-size: 12px !important;
}

.links {
    color: #424242 !important;
}
</style>
