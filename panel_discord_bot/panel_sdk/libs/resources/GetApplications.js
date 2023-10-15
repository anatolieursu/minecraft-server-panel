const FetchAPI = require("../utilities/fetch_api");

module.exports = async (staff_applications_url) => {
    const fetch = new FetchAPI();
    try {
        const result_events = await fetch.get(staff_applications_url);
        return result_events;
    } catch (error) {
        console.error('Eroare la obținerea datelor:', error);
        return null; 
    }
};
