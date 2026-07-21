export class GenericException extends Error {}

export class ApiException extends GenericException {
    /** @type {number} */
    status;

    /**
     * @param {string} message
     * @param {number} [status=500]
     */
    constructor(message, status = 500) {
        super();
        this.status = status;
        this.message = message;
    }
}
