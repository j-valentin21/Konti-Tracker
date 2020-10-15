<template>
    <div>
        <form method="POST" @submit.prevent = 'submitForm' @keydown="errors.clear($event.target.name)">
            <div class="form-group">
                <label for="email">Email Address</label>
                <input id="email"
                       v-model="email"
                       type="email"
                       class="form-control"
                       name="email"
                       autocomplete="email" autofocus>
                <strong v-if="errors.has('email')" v-text="errors.get('email')" class="help is-danger"></strong>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input id="password"
                       v-model="password"
                       type="password"
                       class="form-control"
                       name="password"
                       required
                       autocomplete="current-password">
                <strong v-if="errors.has('password')" v-text="errors.get('password')" class="help is-danger"></strong>
            </div>

            <a class="btn btn-link" href="/password/reset">
                Forgot your password?
            </a>

            <div class="mt-2 d-flex justify-content-end">
                <button type="button" class="btn btn-secondary mr-2 modal__button" data-dismiss="modal">Close</button>
                <button type="submit"  class="btn btn-primary modal__button">Login</button>
            </div>
        </form>
    </div>
</template>

<script>
    /**
     * Keeps track of all of laravel's validation errors that come from axios.
     */
    class Errors {
        /**
         * Create a new controller instance.
         *
         * @return void
         */
        constructor() {
            this.errors = {};
        }
        /**
         * Checks to see if this.errors has a 'field' property.
         *
         * @return boolean
         */
        has(field) {
            return this.errors.hasOwnProperty(field);
        }

        /**
         * Get error(field) name to display correct error.
         *
         * @return object
         */
        get(field) {
            if (this.errors[field]) {
                return this.errors[field][0];
            }
        }

        /**
         * Get error from axios and store it.
         *
         * @return void
         */
        record(errors) {
            this.errors = errors;
        }
        /**
         * Delete error message on keydown.
         *
         * @return void
         */
        clear(field) {
            delete this.errors[field];
        }

    }

    export default {
        data() {
            return {
                email:'',
                password:'',
                errors: new Errors()
            }
        },
        methods: {
            submitForm() {
                axios.post("/login", this.$data)
                    .then( response => {
                       window.location.href = '/dashboard';
                    })
                    .catch(error => this.errors.record(error.response.data.errors))
            }
        }
    }
</script>
