<footer>
    <div class="container">
        <p>Contactez-nous: contact@sportify.com | 01 23 45 67 89</p>
        <p>Adresse: 123 Rue Principale, 75001 Paris</p>
        <div id="map"></div>
    </div>
    <script src="scripts.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap" async defer></script>
<script>
    function initMap() {
        var sportifyLocation = {lat: 48.8566, lng: 2.3522}; // Coordonnées pour Paris
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 15,
            center: sportifyLocation
        });
        var marker = new google.maps.Marker({
            position: sportifyLocation,
            map: map
        });
    }
</script>
</footer>
</body>
</html>
