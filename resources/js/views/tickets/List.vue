<template>
    <dashboard-layout>
        <v-card class="ma-5 pa-5">
            <v-row>
                <v-col
                    cols="12"
                    md="6"
                >
                    <h4>Tickets</h4>
                </v-col>
                <v-col
                    cols="12"
                    md="6"
                >
                    <v-btn v-if="$store.getters.isAdmin" @click="showCreateDialog=!showCreateDialog" class="float-end">
                        Create
                    </v-btn>
                </v-col>
            </v-row>
        </v-card>
        <v-card class="ma-5 pa-5">
            <v-card-title>
                <v-text-field
                    v-model="search"
                    append-icon="mdi-magnify"
                    label="Search"
                    single-line
                    hide-details
                ></v-text-field>
            </v-card-title>
            <v-data-table
                :headers="headers"
                :items="tickets"
                :search="search"
                class="elevation-1"
                :loading="loading"
                loading-text="Loading... Please wait"
            >
                <template v-slot:item="row">
                    <tr>
                        <td>{{ row.item.subject }}</td>
                        <td>{{ row.item.created_at }}</td>
                        <td>{{ row.item.creator }}</td>
                        <td>
                            <v-btn class="mx-2" fab dark small color="primary" @click="showDetails(row.item)">
                                <v-icon dark>mdi-eye</v-icon>
                            </v-btn>
                        </td>
                    </tr>
                </template>
            </v-data-table>
        </v-card>
        <create
            :show-create-dialog="showCreateDialog"
            @closeCreateDialog="closeCreateDialog"
            @reloadData="loadTickets"
        />
        <show
            :show-show-dialog="showShowDialog"
            @closeShowDialog="closeShowDialog"
            :form-data="currentData"
        />
    </dashboard-layout>
</template>

<script>
import DashboardLayout from "../_layouts/DashboardLayout";
import ticketRepository from "../../repository/ticket"
import Create from "./Create";
import Show from "./Show";

export default {
    name: "List",
    components: {Show, Create, DashboardLayout},
    mounted() {
        this.loadTickets()
    },
    data() {
        return {
            search: '',
            headers: [
                {text: 'Subject', value: 'subject'},
                {text: 'Created', value: 'created_at'},
                {text: 'Creator', value: 'creator'},
                {text: '', value: ''},
            ],
            tickets: [],
            loading: false,
            showCreateDialog: false,
            showShowDialog: false,
            currentData: {
                settings: {
                    type: '',
                    tags: [],
                    priority: 1,
                    category: '',
                    status: '',
                    note: ''
                },
                subject: '',
                users: [],
                content: ''
            }
        }
    },
    methods: {
        loadTickets() {
            this.showCreateDialog = false
            this.loading = true;
            ticketRepository.getList().then((data) => {
                this.tickets = data.data;
            }).finally(() => {
                this.loading = false
            })
        },
        closeCreateDialog() {
            this.showCreateDialog = false
        },
        closeShowDialog() {
            this.showShowDialog = false
        },
        showDetails(data) {
            this.currentData = data;
            this.showShowDialog = true
        }
    }
}
</script>
