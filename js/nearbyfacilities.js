class getShortCode {

    constructor() {
        // this.Map = null
        placesList = new Array()
    }

    getGeocode(address, initflag = false) {
        const geocoder = new google.maps.Geocoder()
        geocoder.geocode({ address: address }, (results, status) => {
            if (status == google.maps.GeocoderStatus.OK) {
                if (initflag) {
                    this.startMap(results[0].geometry.location)
                    return
                }
                this.startNearbySearch(results[0].geometry.location)
                return
            }
            alert(addressInput + "：Location information could not be obtained.")
        })
    }

    initMap(address) {
        this.getGeocode(address, true)
    }

    startMap(LatLng) {
        new google.maps.Map(mapField, {
            zoom: zoomInput,
            center: LatLng,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });
    }

    getPlaces(address) {
        placesList = new Array()
        if (address == "") {
            return;
        }
        this.getGeocode(address)
    }

    startNearbySearch(latLng) {
        if (!latLng) {
            console.log(`${Number(shortcodeLat)}, ${Number(shortcodeLng)}`)
            latLng = new google.maps.LatLng(Number(shortcodeLat), Number(shortcodeLng))
        }
        map = new google.maps.Map(mapField, {
            zoom: zoomInput,
            center: latLng,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });
        const service = new google.maps.places.PlacesService(map)
        const searchOptions = {
            location: latLng,
            radius: radiusInput,
            type: [typeInput],
            keyword: keywordInput,
            language: defLang
        }
        service.nearbySearch(searchOptions, this.catchResults.bind(this))
        new google.maps.Circle(
            {
                map: map,
                center: latLng,
                radius: radiusInput,
                fillColor: '#ff0000',
                fillOpacity: 0.3,
                strokeColor: '#ff0000',
                strokeOpacity: 0.5,
                strokeWeight: 1
            }
        );
    }

    catchResults(results, status, pagination) {
        if (status == google.maps.places.PlacesServiceStatus.OK) {
            placesList = placesList.concat(results);
            if (pagination.hasNextPage) {
                setTimeout(pagination.nextPage(), 1000);
            } else {
                for (var i = 0; i < placesList.length; i++) {
                    if (placesList[i].rating == undefined) {
                        placesList[i].rating = -1;
                    }
                }
                placesList.sort(function (a, b) {
                    if (a.rating > b.rating) return -1;
                    if (a.rating < b.rating) return 1;
                    return 0;
                });
                for (let i = 0; i < placesList.length; i++) {
                    this.createMarker(placesList[i], i)
                }
            }
        } else {
            if (status == google.maps.places.PlacesServiceStatus.ZERO_RESULTS) {
                alert(searchErrors.zero_results)
            } else if (status == google.maps.places.PlacesServiceStatus.ERROR) {
                alert(searchErrors.error)
            } else if (status == google.maps.places.PlacesServiceStatus.INVALID_REQUEST) {
                alert(searchErrors.invalid_request)
            } else if (status == google.maps.places.PlacesServiceStatus.OVER_QUERY_LIMIT) {
                alert(searchErrors.over_query_limit)
            } else if (status == google.maps.places.PlacesServiceStatus.REQUEST_DENIED) {
                alert(searchErrors.request_denied)
            } else if (status == google.maps.places.PlacesServiceStatus.UNKNOWN_ERROR) {
                alert(searchErrors.unknown_error)
            }
        }
    }

    createMarker(options, cnt) {
        marker[cnt] = new google.maps.Marker({
            position: options.geometry.location,
            map: map,
            // icon: options.icon,
            title: options.name,
            clickable: true,
            draggable: false,
            opacity: 1,
            zIndex: cnt,
            animation: google.maps.Animation.DROP
        })
        const hasImages = Array.isArray(options.photos) && options.photos.length > 0
        const noImage = `            <div class="swiper-slide" style="background-image: url(http://placehold.jp/262x104.png?text=No%20Image);"></div>\n`
        // <img src="http://placehold.jp/262x104.png?text=No%20Image">
        // </div>\n`
        const contentTop = `<div class="facilitiesinfo">
    <div class="facilityName">
        <div>${options.name}</div>
    </div><!-- end facilityName -->
    <div class="swiper-container horizonal">
        <div class="swiper-wrapper">\n`
        let contentImages
        if (hasImages) {
            contentImages = options.photos.map(value => {
                return `            <div class="swiper-slide" style="background-image: url(${value.getUrl()});"></div>`
                //     <img src="${value.getUrl()}">
                // </div>`
            }).join('\n')// + noImage
        } else {
            contentImages = noImage
        }
        let content = contentTop + contentImages + `\n        </div><!-- end swiper-wrapper -->\n`
        // if (hasImages) {
        //     content = content + `        <div class="swiper-pagination horizonal-pagination"></div>
        // <div class="swiper-button-next horizonal-button-next"></div>
        // <div class="swiper-button-prev horizonal-button-prev"></div>\n`
        // }
        content = content + `    </div><!-- end swiper-container -->
</div><!-- end facilitiesinfo -->\n`
        infoWindow[cnt] = new google.maps.InfoWindow({
            content: content,
            maxWidth: 300,
            zIndex: cnt,
        });
        this.markerEvent(options, cnt, () => {
        })
    }

    switchBounceMotion(cnt) {
        const bounceMotion = marker[cnt].getAnimation() !== null ? null : google.maps.Animation.BOUNCE
        marker[cnt].setAnimation(bounceMotion)
    }

    markerEvent(options, cnt) {
        // Configurable event handlers are click, dblclick, mousemove, mouseout, mouseover, rightclick
        google.maps.event.addListener(marker[cnt], 'click', () => {
            infoWindow.map(val => {
                val.close()
            })
            infoWindow[cnt].open(map, marker[cnt])
            // Add bounce motion.
            this.switchBounceMotion(cnt)
            setTimeout(this.switchBounceMotion, 2500, cnt)
        })
        google.maps.event.addListener(infoWindow[cnt], "domready", () => {
            var swiper = new Swiper('.horizonal', {
                loop: true,
                pagination: {
                    el: '.horizonal-button-next',
                    clickable: true,
                },
                navigation: {
                    nextEl: '.horizonal-button-next',
                    prevEl: '.horizonal-button-prev',
                }
            })
        })
    }

}
