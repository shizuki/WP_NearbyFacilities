    let keywordInput
    let typeInput
    let radiusInput
    let zoomInput
    let addressInput
    const obj = document.getElementById("radiusInput")
    const searchErrors = {
        "zero_results": "<%%('Zero results.')%%>",
        "error": "<%%('Server connection failed.')%%>",
        "invalid_request": "<%%('Your request was invalid.')%%>",
        "over_query_limit": "<%%('The usage limit for the request has been exceeded.')%%>",
        "request_denied": "<%%('The service could not be used.')%%>",
        "unknown_error": "<%%('An unknown error has occurred.')%%>"
    }
    const defLang = '<%%user_locale%%>'
    let placesList
    let map // = []
    <%%copy_notice%%>
    const defMapID = '<%%shortcodeMap%%>'
    const mapField = document.getElementById(defMapID)
    const marker = []
    const infoWindow = []

    function nearbyfacilities() {
        const mapi = new searchNearbyFacilities(defMapID)
        addressInput = <%%addressInput%%>;
        keywordInput = <%%keywordInput%%>;
        radiusInput  = <%%radiusInput%%>;
        typeInput    = <%%typeInput%%>;
        zoomInput    = <%%zoomInput%%>;
        mapi.getPlaces(addressInput);
    }
