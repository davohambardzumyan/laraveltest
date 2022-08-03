export default {
    data() {
        return {
            errorMessages: {},
        }
    },
    methods: {
        setErrorMessages(errorMessages) {
            this.errorMessages = errorMessages;
        },
        setErrorMessage(key, message) {
            this.errorMessages = {...this.errorMessages, [key]: message}
        },
        clearErrorMessages() {
            this.errorMessages = [];
        },
        clearErrorMessage(key) {
            if (this.errorMessages && this.errorMessages[key]) {
                this.errorMessages[key] = []
            }
        }
    }
}
