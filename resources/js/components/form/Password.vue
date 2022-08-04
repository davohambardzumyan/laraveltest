<template>
    <v-text-field
        :value="value"
        :label="label"
        :rules="rules"
        :error-messages="errorMessages"
        @input="$emit('input', $event)"
        :append-icon="inputType ? 'mdi-eye' : 'mdi-eye-off'"
        :type="inputType ? 'password' : 'text'"
        @click:append="changeInputType"
    ></v-text-field>
</template>

<script>
export default {
    name: "Password",
    props: {
        value: {
            type: String,
            required: true
        },
        label: {
            type: String,
            default: "Password"
        },
        rules: {
            type: Array,
            default: () => []
        },
        errorMessages: {
            type: Array,
            default: () => []
        },
    },
    data() {
        return {
            inputType: String
        }
    },
    methods: {
        changeInputType() {
            this.inputType = !this.inputType
        }
    }
}
</script>
