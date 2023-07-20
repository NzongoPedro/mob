<template>
    <v-dialog transition="dialog-bottom-transition" width="55%" persistent>
        <template v-slot:activator="{ on, attrs }">
            <v-btn
                color="primary"
                depressed
                elevation="2"
                raised
                v-bind="attrs"
                v-on="on"
            >
                <v-icon>mdi-account-plus-outline</v-icon>
            </v-btn>
        </template>

        <template v-slot:default="dialog">
            <v-card>
                <v-toolbar color="secondary" dark
                    >MATRÍCULA DE ALUNOS</v-toolbar
                >
                <v-card-text class="mt-5">
                    <v-form @submit.prevent="submit" class="form-data">
                        <v-container>
                            <!-- Primaeira linha de campos -->
                            <v-row>
                                <v-col cols="12" md="4">
                                    <v-text-field
                                        required
                                        v-model="datas.nome"
                                        class="custom-label"
                                        label="Nome completo"
                                        clearable
                                        outlined
                                    ></v-text-field>
                                </v-col>

                                <v-col cols="12" md="4">
                                    <v-text-field
                                        required
                                        v-model="datas.bi"
                                        class="custom-label"
                                        label="Número BI ou cédula"
                                        clearable
                                        outlined
                                    ></v-text-field>
                                </v-col>

                                <v-col cols="12" md="4">
                                    <div>
                                        <v-menu
                                            ref="menu"
                                            required
                                            v-model="menu"
                                            :close-on-content-click="false"
                                            transition="scale-transition"
                                            offset-y
                                            min-width="auto"
                                        >
                                            <template
                                                v-slot:activator="{ on, attrs }"
                                            >
                                                <v-text-field
                                                    required
                                                    v-model="
                                                        datas.data_nascimento
                                                    "
                                                    class="custom-label"
                                                    label="data de nascimento"
                                                    readonly
                                                    outlined
                                                    v-bind="attrs"
                                                    v-on="on"
                                                ></v-text-field>
                                            </template>
                                            <v-date-picker
                                                required
                                                v-model="datas.data_nascimento"
                                                :active-picker.sync="
                                                    activePicker
                                                "
                                                :max="
                                                    new Date(
                                                        Date.now() -
                                                            new Date().getTimezoneOffset() *
                                                                60000
                                                    )
                                                        .toISOString()
                                                        .substr(0, 10)
                                                "
                                                min="1950-01-01"
                                                @change="save"
                                            ></v-date-picker>
                                        </v-menu>
                                    </div>
                                </v-col>
                            </v-row>
                            <!-- Segunda linha de dados -->
                            <v-row>
                                <v-col cols="12" md="4">
                                    <v-select
                                        required
                                        v-model="datas.genero"
                                        clearable
                                        chips
                                        class="custom-label"
                                        label="* Genero"
                                        :items="['Femenino', 'Masculino']"
                                        variant="outlined"
                                    ></v-select>
                                </v-col>
                                <v-col cols="12" md="4">
                                    <v-text-field
                                        required
                                        v-model="datas.naturalidade"
                                        class="custom-label"
                                        label="* Naturalidade"
                                        clearable
                                        outlined
                                    ></v-text-field>
                                </v-col>
                                <v-col cols="12" md="4">
                                    <v-select
                                        required
                                        v-model="datas.provincia"
                                        clearable
                                        chips
                                        class="custom-label"
                                        label="* Província"
                                        :items="[
                                            'Bengo',
                                            'Benguela',
                                            'Bié',
                                            'Cabinda',
                                            'Cuando Cubango',
                                            'Cuanza Norte',
                                            'Cuanza Sul',
                                            'Cunene',
                                            'Huambo',
                                            'Huíla',
                                            'Luanda',
                                            'Lunda Norte',
                                            'Lunda Sul',
                                            'Malanje',
                                            'Moxico',
                                            'Namibe',
                                            'Uíge',
                                            'Zaire',
                                        ]"
                                        variant="outlined"
                                    ></v-select>
                                </v-col>
                            </v-row>
                            <!-- Terceira linha de campos -->
                            <v-row>
                                <v-col cols="12" md="4">
                                    <v-text-field
                                        required
                                        v-model="datas.morada"
                                        class="custom-label"
                                        label="Morada"
                                        clearable
                                        outlined
                                    ></v-text-field>
                                </v-col>

                                <v-col cols="12" md="4">
                                    <v-text-field
                                        required
                                        v-model="datas.nome_do_pai"
                                        class="custom-label"
                                        label="Nome do pai"
                                        clearable
                                        outlined
                                    ></v-text-field>
                                </v-col>

                                <v-col cols="12" md="4">
                                    <v-text-field
                                        required
                                        v-model="datas.nome_da_mae"
                                        class="custom-label"
                                        label="Nome da mãe"
                                        clearable
                                        outlined
                                    ></v-text-field>
                                </v-col>
                            </v-row>
                            <!-- Quarta linha de campos -->
                            <v-row>
                                <v-col cols="12" md="4">
                                    <v-select
                                        required
                                        v-model="datas.classe"
                                        clearable
                                        chips
                                        class="custom-label"
                                        label="* Classe"
                                        :items="[0, 1, 2, 3, 4, 5]"
                                        variant="outlined"
                                    ></v-select>
                                </v-col>
                                <v-col cols="12" md="4">
                                    <v-select
                                        required
                                        v-model="datas.turma"
                                        clearable
                                        chips
                                        class="custom-label"
                                        label="* Turma"
                                        :items="[1, 2, 3, 4, 5]"
                                        variant="outlined"
                                    ></v-select>
                                </v-col>
                                <v-col cols="12" md="4">
                                    <v-select
                                        required
                                        v-model="datas.sala"
                                        clearable
                                        chips
                                        class="custom-label"
                                        label="* Sala"
                                        :items="[1, 2, 3, 4, 5]"
                                        variant="outlined"
                                    ></v-select>
                                </v-col>
                            </v-row>
                            <div v-if="alerta.texto && alerta.tipo">
                                <v-alert
                                    closable
                                    variant="autolined"
                                    :type="alerta.tipo"
                                    >{{ alerta.texto }}</v-alert
                                >
                            </div>

                            <v-card-actions class="justify-end">
                                <v-btn
                                    depressed
                                    raised
                                    color="primary"
                                    dark
                                    type="submit"
                                    >Registrar</v-btn
                                >
                                <v-btn text @click="dialog.value = false"
                                    >Close</v-btn
                                >
                            </v-card-actions>
                        </v-container>
                    </v-form>
                </v-card-text>
            </v-card>
        </template>
    </v-dialog>
</template>

<script>
import axios from "axios";
import inputTextNomeVue from "./forms/inputTextNome.vue";
export default {
    name: "modalAluno",
    components: {
        inputTextNomeVue,
    },
    data() {
        return {
            activePicker: null,
            date: null,
            menu: false,
            alerta: { tipo: "", texto: "", titulo: "" },
            datas: {
                nome: "",
                bi: "",
                data_nascimento: "",
                genero: "Femenino",
                naturalidade: "",
                provincia: "Bengo",
                morada: "",
                nome_do_pai: "",
                nome_da_mae: "",
                turma: 1,
                classe: 2,
                sala: 2,
            },
        };
    },

    watch: {
        menu(val) {
            val && setTimeout(() => (this.activePicker = "YEAR"));
        },
    },
    methods: {
        save(date) {
            this.$refs.menu.save(date);
        },
        submit() {
            const dadosRegistro = this.datas;
            axios
                .post("/alunos", dadosRegistro)
                .then((response) => {
                    // Se a resposta for bem-sucedida, significa que o registro foi realizado com sucesso
                    this.alerta.titulo = "SUCESSO";
                    this.alerta.tipo = "success";
                    this.alerta.texto = response.data.message;
                    console.log(response.data.status);
                })
                .catch((error) => {
                    // Se ocorrer um erro na resposta (status diferente de 200), exibir os erros de validação na interface
                    if (error.response && error.response.status === 422) {
                        this.alerta.titulo = "ERRO";
                        this.alerta.tipo = "error";
                        this.alerta.texto = error.response.data.errors;
                    } else {
                        // Outros erros, caso ocorram
                        console.error(error);
                    }
                });
        },
    },
};
</script>

<style scoped>
.custom-label label {
    color: red !important; /* Defina a cor desejada para o label */
}
</style>
