import validationConstants from "./validation-constants";

export default {
    mixins: [validationConstants],
    data() {
        return {
            rules: {
                email: value => {
                    const pattern = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}])|(([a-zA-Z\-\d]+\.)+[a-zA-Z]{2,}))$/;
                    return pattern.test(value) || "Invalid email address";
                },
                required: value =>
                    (value != null && value.length > 0) ||
                    "This field is required",
                select: [
                    val => typeof val != "undefined" || "This field is required"
                ],
                minLength: (min, field = "field") => val =>
                    val.length >= min ||
                    `The ${field} must be at least ${min} characters.`,
                match: (field1, field2, fieldName = "Fields") =>
                    field1 === field2 || `${fieldName} do not match`,
                contains: (option, field = "Field") => value => {
                    switch (option) {
                        case this.SPECIAL_CHARACTER: {
                            const pattern = /[^a-zA-Z\d\-\/]/;
                            return pattern.test(value) || `${field} must contain special character`;
                        }
                        case this.NUMBER: {
                            const pattern = /\d/;
                            return pattern.test(value) || `${field} must contain number`;
                        }
                        case this.LOWER_CASE: {
                            const pattern = /[a-z]/;
                            return pattern.test(value) || `${field} must contain lowercase character`;
                        }
                        case this.UPPER_CASE: {
                            const pattern = /[A-Z]/;
                            return pattern.test(value) || `${field} must contain uppercase character`;
                        }
                        default: {
                            return true
                        }
                    }
                },
                password: value => {
                    const pattern = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z\d])(?!.*\s).{8,15}$/;
                    return pattern.test(value) || "The password must be a minimum of 8 and a maximum of 15 characters and contain at least one uppercase character, one number, and one special character"
                }
            }
        }
    }
}
