if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition((position) => {
        localCoord = position.coords;
        objLocalCoord = {
            lat: localCoord.latitude,
            lng: localCoord.longitude,
        };
        console.log("localCoord", objLocalCoord);
        // Initialize the platform object:
        let platform = new H.service.Platform({
            apikey: window.hereApiKey,
        });

        // Obtain the default map types from the platform object
        let defaultLayers = platform.createDefaultLayers();

        // Instantiate (and display) a map object:
        let map = new H.Map(
            document.getElementById("mapContainer"),
            defaultLayers.vector.normal.map,
            {
                zoom: 13,
                center: objLocalCoord,
                pixelRatio: window.devicePixelRatio || 1,
            }
        );
        window.addEventListener("load", () => map.getViewPort().resize());
        window.addEventListener("resize", () => map.getViewPort().resize());

        let ui = H.ui.UI.createDefault(map, defaultLayers);
        let mapEvents = new H.mapevents.MapEvents(map);
        let behavior = new H.mapevents.Behavior(mapEvents);

        function addDragableMarker(map, behavior) {
            let inputLat = document.getElementById("lat");
            let inputLng = document.getElementById("lng");

            if (inputLat.value != "" && inputLng.value != "") {
                objLocalCoord = {
                    lat: inputLat.value,
                    lng: inputLng.value,
                };
            }

            let marker = new H.map.Marker(objLocalCoord, {
                volatility: true,
            });

            marker.draggable = true;
            map.addObject(marker);

            map.addEventListener(
                "dragstart",
                function (ev) {
                    let target = ev.target,
                        pointer = ev.currentPointer;
                    if (target instanceof H.map.Marker) {
                        let targetPosition = map.geoToScreen(
                            target.getGeometry()
                        );
                        target["offset"] = new H.math.Point(
                            pointer.viewportX - targetPosition.x,
                            pointer.viewportY - targetPosition.y
                        );
                        behavior.disable();
                    }
                },
                false
            );
            map.addEventListener(
                "drag",
                function (ev) {
                    let target = ev.target,
                        pointer = ev.currentPointer;
                    if (target instanceof H.map.Marker) {
                        target.setGeometry(
                            map.screenToGeo(
                                pointer.viewportX - target["offset"].x,
                                pointer.viewportY - target["offset"].y
                            )
                        );
                    }
                },
                false
            );

            map.addEventListener(
                "dragend",
                function (ev) {
                    let target = ev.target;
                    if (target instanceof H.map.Marker) {
                        behavior.enable();
                        let resultCoord = map.screenToGeo(
                            ev.currentPointer.viewportX,
                            ev.currentPointer.viewportY
                        );

                        inputLat.value = resultCoord.lat.toFixed(5);
                        inputLng.value = resultCoord.lng.toFixed(5);
                    }
                },
                false
            );
        }
        if (window.action == "submit") {
            addDragableMarker(map, behavior);
        }
        if (window.action == "show") {
            let inputLat = document.getElementById("lat");
            let inputLng = document.getElementById("lng");

            if (inputLat.value != "" && inputLng.value != "") {
                objLocalCoord = {
                    lat: inputLat.value,
                    lng: inputLng.value,
                };
            }

            let marker = new H.map.Marker(objLocalCoord, {
                volatility: true,
            });

            marker.draggable = true;
            map.addObject(marker);
            map.setCenter({ lat: inputLat.value, lng: inputLng.value });
        }
    });
} else {
    console.error("Geolocation is not support in this browser");
}
