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
        addressInput = document.getElementById("addressInput").value
        keywordInput = document.getElementById("keywordInput").value
        typeInput    = document.getElementById("typeInput").value
        radiusInput  = Number(document.getElementById("radiusInput").value)
        zoomInput    = Number(document.getElementById("zoomInput").value)
        mapi.getPlaces(addressInput)
    }

    function makeShortCode() {
        document.getElementById("shortCode").readOnly = false
        let code = '[nearbyFacilities ' +
            `address="${document.getElementById("addressInput").value}" ` +
            `type="${document.getElementById("typeInput").value}" ` +
            `zoom="${Number(document.getElementById("zoomInput").value)}" ` +
            `radius="${Number(obj.options[obj.selectedIndex].value)}"`
        if (document.getElementById("keywordInput").value != '') {
            code = `${code} keyword="${document.getElementById("keywordInput").value}"`
        }
        code = code + ']'
        document.getElementById("shortCode").value = code
        document.getElementById("shortCode").readOnly = true
        nearbyfacilities()
    }

    function copyShortCode() {
        document.getElementById("shortCode").select()
        document.execCommand("Copy")
        const notice = document.getElementById("copy_notice")
        const text_value = copy_notice.replace("%s", document.getElementById("shortCode").value)
        const span = document.createElement('span')
        span.style.position = 'absolute';
        span.style.top = '-1000px';
        span.style.left = '-1000px';
        span.style.whiteSpace = 'nowrap'
        span.innerText = text_value
        document.body.appendChild(span)
        const notice_width = span.clientWidth + 20 + 'px'
        notice.innerText = text_value
        notice.style.width = notice_width
        notice.classList.add('is-show')
        var timer = setTimeout(() => {
            notice.classList.remove('is-show')
        }, 5000)
    }

    function showZoomVal() {
        document.getElementById("zoomLevel").innerText = Number(document.getElementById("zoomInput").value)
    }
