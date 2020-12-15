/**
 * Keeps track of all of laravel validation errors that come from axios.
 */
export class Errors {
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
