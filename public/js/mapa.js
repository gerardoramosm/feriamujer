const latitude = parseFloat(document.getElementById("lat").value)==null || parseFloat(document.getElementById("lat").value)==0  ? -17.3930281 : parseFloat(document.getElementById("lat").value);
const longitude = parseFloat(document.getElementById("lon").value)==null || parseFloat(document.getElementById("lon").value)==0 ? -66.1523097 : parseFloat(document.getElementById("lon").value);
//console.log(latitude,longitude)
var mymap = L.map('address-map').setView([latitude,longitude], 15);
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
  attribution: 'Map data &copy; <a href="https://openstreetmap.org">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://cloudmade.com">CloudMade</a>',
  maxZoom: 18//        id: 'mapbox/streets-v11',
//        tileSize: 512,
//        zoomOffset: -1,
//        accessToken: 'pk.eyJ1IjoiamNhcmRlbmFzZCIsImEiOiJjazhsMHc4ODEwMm1wM2xycWtkam5kNG1lIn0.8oZqs6ibViJKzVo330_QPA'
  }).addTo(mymap);
var marker = L.marker([latitude,longitude],{draggable:'true'}).addTo(mymap);
//var geocodeService = L.esri.Geocoding.geocodeService();

marker.on('dragend', function(event){
  var marker = event.target;
  var position = marker.getLatLng();
  document.getElementById("lat").value=position.lat;
  document.getElementById("lon").value=position.lng;
//  console.log(position);
/*  getAddress(position.lat,position.lng).then(data=>{
//    console.log(data);
    document.getElementById("direccion").value=data.address.road+((data.address.house_number==null) ? "":" "+data.address.house_number+" ") +", "+ data.address.city +", "+data.address.country;
  });*/
  marker.setLatLng(position,{draggable:'true'}).bindPopup(position).update();
});

function onMapClick(e) {  
  var latlng = mymap.mouseEventToLatLng(e.originalEvent);
  document.getElementById("lat").value=latlng.lat;
  document.getElementById("lon").value=latlng.lng;
  marker.setLatLng(latlng,{draggable:'true'}).bindPopup(latlng).update();
/*  geocodeService.reverse().latlng(latlng).run(function(error, result){
    console.log(result);
  });*/
  /*getAddress(latlng.lat,latlng.lng).then(data=>{
    //console.log(data);
    document.getElementById("direccion").value=data.address.road+((data.address.house_number==null) ? "":" "+data.address.house_number+" ") +", "+ data.address.city +", "+data.address.country;
  });*/
//  console.log(latlng.lat + ', ' + latlng.lng);
//    alert("You clicked the map at " + e.latlng);
}
//marker.on('dragend',function(e){

//})
mymap.on('click', onMapClick);

async function getAddress(lat,lon){
  let response=await fetch("https://nominatim.openstreetmap.org/reverse?lat="+lat+"&lon="+lon+"&zoom=20&addressdetails=1&format=json");
  return response.json();
}

