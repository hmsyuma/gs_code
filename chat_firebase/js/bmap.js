//************************************************************************************
// BingMaps Functions
//************************************************************************************
"use strict";

/**
 * MapView
 * @method mapStart
 * @param target (string)  ["#id"]
 * @param lat    (float)   [47.6149]
 * @param lon    (float)   [-122.1941]
 * @param id     (string)  ["load","aerial","canvasDark","canvasLight","birdseye","grayscale","streetside"]
 * @param num    (int)     [1...20]
 * @returns {boolean=false} OR {Object=Map}
 */
function mapStart(target, lat, lon, id, num){
    //MapObject
    return new Microsoft.Maps.Map(target, {
        center: new Microsoft.Maps.Location(lat,lon), //Location center position
        mapTypeId: eval("Microsoft.Maps.MapTypeId."+id), //Type: [load, aerial,canvasDark,canvasLight,birdseye,grayscale,streetside]
        zoom: num  //Zoom:1=zoomOut, 20=zoomUp[ 1~20 ]
    });
}

/**
 * MapViewMove
 * @method mapChangeView
 * @param map    (object)  [mapObject]
 * @param lat    (float)   [47.6149]
 * @param lon    (float)   [-122.1941]
 * @param id     (string)  ["load","aerial","canvasDark","canvasLight","birdseye","grayscale","streetside"]
 * @param num    (int)     [1...20]
 */
function mapChangeView(map, lat, lon, id, num){
    //MapObject
    const loc = new Microsoft.Maps.Location(lat,lon);
    map.setView({
        mapTypeId: eval("Microsoft.Maps.MapTypeId."+id),
        center: loc,
        zoom: num,
        bounds:loc.bestView
    });
}

/**
* Pushpin:Add
* @method mapPushpin
* @param map    (object)   [mapObject]
* @param lat    (float)    [47.6149]
* @param lon    (float)    [-122.1941]
* @param color  (string)   ["#ff0000"]
* @param[arguments] drag   (boolean)  [true or false]
* @param[arguments] clicked (boolean) [true or false]
* @param[arguments] hover  (boolean)  [true or false]
* @param[arguments] visib  (boolean)  [true or false]
* @returns {boolean=false OR void }
*/
function mapPushpin(map, lat, lon, color){
    //Param Check
    let drag,clicked,hover,visib;
    if(map=="" || lat=="" || lon=="" || color==""){
        return false;
    }
    //arguments[4...7]
    if(typeof arguments[4]=="undefined" || arguments[4]==false){drag=false;}else{drag=true;};
    if(typeof arguments[5]=="undefined" || arguments[5]==false){clicked=false;}else{clicked=true;};
    if(typeof arguments[6]=="undefined" || arguments[6]==false){hover=false;}else{hover=true;};
    if(typeof arguments[7]=="undefined" || arguments[7]==true){visib = true;}else{visib=false;};
    const location =  new Microsoft.Maps.Location(lat,lon);
    const pin = new Microsoft.Maps.Pushpin(location, {
        color: color,                //Color
        draggable:drag,              //MouseDraggable
        enableClickedStyle:clicked,  //Click
        enableHoverStyle:hover,      //MouseOver
        visible:visib                //show/hide
    });
    map.entities.push(pin);
}

/**
 * Infobox:Add
 * @method mapInfobox
 * @param map    (object)   [mapObject]
 * @param lat    (float)    [47.6149]
 * @param lon    (float)    [-122.1941]
 * @param t      (string)   ["title"]
 * @param d      (string)   ["description"]
 */
function mapInfobox(map, lat, lon, t, d){
    //Infobox
    const location = new Microsoft.Maps.Location(lat,lon);
    const infobox  = new Microsoft.Maps.Infobox(location,{
        title: t,
        description: d
    });
    infobox.setMap(map); //Add infobox to Map
}