import axios from 'axios';

/**
 * Makes a get request to the desired post type and builds the query string based on an object.
 *
 * @param {string|boolean} restBase - rest base for the query.
 * @param {object} args
 * @returns {AxiosPromise<any>}
 */
export const getDocument = () => {
    //domain.com/wp-json/complianz/v1/data/doctypes
    return axios.get(complianz_tc.site_url+`complianz_tc/v1/document`);
};
