
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
