export default {
    data() {
        return {
            loading: false
        }
    },
    computed: {
        isLoading() {
            return this.loading;
        }
    },
    methods: {
        startLoading() {
            this.loading = true;
        },
        stopLoading() {
            this.loading = false;
        }
    }
}
