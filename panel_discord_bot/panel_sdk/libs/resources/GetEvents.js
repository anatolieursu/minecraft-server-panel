const FetchAPI = require("../utilities/fetch_api");

module.exports = async (panel_url) => {
    const fetch = new FetchAPI();
    try {
        const result_events = await fetch.get(panel_url);
        return result_events;
    } catch (error) {
        console.error('Eroare la obținerea datelor:', error);
        return null; 
    }
};
