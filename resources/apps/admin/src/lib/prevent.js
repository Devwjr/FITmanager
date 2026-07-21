/** @param {Event} event */
export const prevent = (callback) => {
    return (/** @type {Event} */ event) => {
        event.preventDefault();
        callback(event);
    };
};
