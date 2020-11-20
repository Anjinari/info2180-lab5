window.onload = function() {

    var xhttp = new XMLHttpRequest();

    document.getElementById("lookup").onclick = findCountry;
    document.getElementById("citylookup").onclick = findCity;

    function findCountry() {
        var country_input = document.getElementById("country").value;
        xhttp.onreadystatechange = search();
        xhttp.open("GET", "world.php?country=" + country_input, true);
        xhttp.send();
    }

    function findCity() {
        var city_input = document.getElementById("country").value;
        xhttp.onreadystatechange = search();
        xhttp.open("GET", "world.php?country=" + city_input + "&context=cities",true);
        xhttp.send();
    }

    function search() {
        if(xhttp.readyState === XMLHttpRequest.DONE && xhttp.status === 200) {
            var result = xhttp.responseText;
            document.getElementById("result").innerHTML = result;
        } 
    }
};