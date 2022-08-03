<template>
    <v-dialog
        v-model="showShowDialog"
        fullscreen
        hide-overlay
        transition="dialog-bottom-transition"
    >
        <v-form
            ref="createForm"
            lazy-validation
            @submit.prevent="submit"
            aria-label="Create ticket"
            class="mb-3"
        >
            <v-card>
                <v-toolbar
                    dark
                    color="primary"
                >
                    <v-btn
                        icon
                        dark
                        @click="$emit('closeShowDialog')"
                    >
                        <v-icon>mdi-close</v-icon>
                    </v-btn>
                    <v-toolbar-title>Details</v-toolbar-title>
                    <v-spacer></v-spacer>
                </v-toolbar>
                <v-row>
                    <v-col
                        cols="12"
                        md="4"
                    >
                        <v-card class="ma-5 pa-5">
                            <h5 class="text-center">Settings</h5>
                            <hr class="mb-7 mt-3">
                            <v-select
                                :value="formData.settings.type"
                                :items="allTypes"
                                label="Type *"
                                :rules="[rules.required]"
                                required
                                disabled
                            ></v-select>
                            <v-autocomplete
                                :value="formData.settings.tags"
                                :items="allTags"
                                dense
                                chips
                                deletable-chips
                                small-chips
                                label="Tags *"
                                multiple
                                :rules="[rules.required]"
                                disabled
                            ></v-autocomplete>
                            <v-select
                                :value="formData.settings.priority"
                                :items="allPriorities"
                                label="Priority *"
                                :rules="[rules.required]"
                                disabled
                            ></v-select>
                            <v-select
                                :value="formData.settings.category"
                                :items="allCategories"
                                label="Category *"
                                :rules="[rules.required]"
                                disabled
                            ></v-select>
                            <v-select
                                :value="formData.settings.status"
                                :items="allStatuses"
                                label="Status *"
                                :rules="[rules.required]"
                                disabled
                            ></v-select>
                            <v-textarea
                                :value="formData.settings.note"
                                label="Note *"
                                :rules="[rules.required]"
                                disabled
                            ></v-textarea>
                        </v-card>
                    </v-col>
                    <v-col
                        cols="12"
                        md="8"
                    >
                        <v-card class="ma-5 pa-5">
                            <v-text-field
                                :value="formData.subject"
                                label="Subject *"
                                :rules="[rules.required]"
                                hide-details="auto"
                                class="mb-10"
                                disabled
                            ></v-text-field>

                            <v-autocomplete
                                :value="formData.users"
                                :items="allUsers"
                                :item-text="item=>`${item.first_name} ${item.last_name} (${item.email})`"
                                :item-value="item=>item.id"
                                dense
                                chips
                                deletable-chips
                                small-chips
                                label="Users *"
                                class="mb-10"
                                multiple
                                :rules="[rules.required]"
                                disabled
                            ></v-autocomplete>

                            <editor
                                api-key="5drdtn9atcudzsaaxwrtskaew32fymzuvd2q0gzkqcm1lxxy"
                                :init="{
                                        height: 500,
                                        menubar: false,
                                        toolbar:
                                          'undo redo | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat',
                                    }"
                                :rules="[rules.required]"
                                :value="formData.content"
                                @input="validateEditor"
                                disabled
                            />
                            <div v-if="!isEditorValid" class="v-text-field__details mt-5">
                                <div class="v-messages theme--light error--text" role="alert">
                                    <div class="v-messages__wrapper">
                                        <div class="v-messages__message">This field is required</div>
                                    </div>
                                </div>
                            </div>
                        </v-card>
                    </v-col>
                </v-row>
            </v-card>
        </v-form>
        <v-btn @click="()=>{console.log(form)}">DDD</v-btn>
    </v-dialog>
</template>

<script>
import validation from "../../mixins/validation";
import Editor from '@tinymce/tinymce-vue'
import ticketRepository from "../../repository/ticket";

export default {
    name: "Show",
    mixins: [
        validation
    ],
    components: {
        'editor': Editor
    },
    props: {
        showShowDialog: {
            type: Boolean,
            default: false
        },
        formData:{
            type:Object,
            required:true
        }
    },
    data() {
        return {
            loading: false,
            allTags: [
                'Tag 1', 'Tag 2', 'Tag 3', 'Tag 4', 'Tag 5'
            ],
            allTypes: [
                'Type 1', 'Type 2', 'Type 3', 'Type 4', 'Type 5'
            ],
            allPriorities: [
                '1', '2', '3', '4', '5'
            ],
            allCategories: [
                'Category 1', 'Category 2', 'Category 3', 'Category 4', 'Category 5'
            ],
            allStatuses: [
                'Status 1', 'Status 2', 'Status 3', 'Status 4', 'Status 5'
            ],
            form: this.formData,
            allUsers: [],
            isEditorValid: true
        }
    },
    mounted() {
        this.getAllUsers()
    },
    methods: {
        getAllUsers() {
            ticketRepository.getAllUsers().then((data) => {
                this.allUsers = data;
            })
        },
        submit() {
            this.validateEditor();
            if (this.$refs.createForm.validate() && this.isEditorValid) {
                this.loading = true;
                ticketRepository.create(this.form).finally(() => {
                    this.loading = false;
                })
            }
        },
        validateEditor() {
            this.isEditorValid = !(this.form.content === "")

            if (!this.isEditorValid) {
                document.getElementsByClassName('tox-tinymce')[0].classList.add('invalid-editor')
            } else {
                document.getElementsByClassName('tox-tinymce')[0].classList.remove('invalid-editor')
            }
        }
    }
}
</script>

<style>
.tox-notifications-container {
    display: none;
}
</style>
