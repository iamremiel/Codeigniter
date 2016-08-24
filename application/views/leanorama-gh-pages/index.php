<!DOCTYPE html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="description" content="Leanorama - Panoramic images viewer">
        <meta name="viewport" content="width=device-width">
        
        <title>Leandigo | Leanorama panoramic viewer</title>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <script src="js/jquery.transit.js"></script>
        <script src="js/jquery.leanorama.js"></script>
        <script src="js/jquery.leanorama.hotspot.js"></script>
        <script src="js/jquery.leanorama.controlbar.js"></script>
        <script src="js/jquery.leanorama.infobox.js"></script>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="css/index.css">
        <link rel="stylesheet" href="css/leanorama.css">
        <link rel="stylesheet" href="css/leanorama.hotspot.css">
        <link rel="stylesheet" href="css/leanorama.controlbar.css">
        <link rel="stylesheet" href="css/leanorama.infobox.css">
    </head>
    <body>
     
        <div id="pano-outer">
            <div id="pano"></div>
        </div>
        <!-- // <script src="example/tour.js"></script> -->
        <script>
        var leftpano="<?php echo 'example/28/pano_1_left.jpg';?>";
        var tour = {
        transporter: {
        sides: [leftpano, 'example/28/pano_1_front.jpg', 'example/28/pano_1_right.jpg', 'example/28/pano_1_back.jpg', 'example/28/pano_1_top.jpg', 'example/28/pano_1_bottom.jpg'],
        autorotate: false,
        infobox: '<b>Transporter Room</b><br>Where do you want to go?',
        touch: true,
        gyro: true,
        hotspots: [
            { type: 'nav', face: 0, x: 200, y: 500, name:'Snowy Mounta', value: 'snow' },
            { type: 'nav', face: 3, x: 500, y: 500, name:'Arcade', value: 'arcade' },
            { type: 'nav', face: 2, x: 800, y: 500, name:'Archives', value: 'archives' },
            { type: 'nav', face: 0, x: 800, y: 500, name:'Concert Hall', value: 'hall' },
            { type: 'nav', face: 1, x: 500, y: 500, name:'Japanese Hut', value: 'hut' },
            { type: 'nav', face: 2, x: 200, y: 500, name:'Abandoned House', value: 'ruins' },
            { type: 'info', face: 3, x: 20, y: 500, name:'What is this place?', value: 'While these might look like regular elevators, they magically transport you to far away places.<br>Feel free to explore.<img src="http://upload.wikimedia.org/wikipedia/en/thumb/c/c7/Transporter2.jpg/250px-Transporter2.jpg"><p>If you get lost, simply refresh the page</p>' },
        ]
    },
    snow: {
        infobox: '<b>Bundok ng Yelo</b>',
        sides: ['example/05/0000.jpg', 'example/05/0001.jpg', 'example/05/0002.jpg', 'example/05/0003.jpg', 'example/05/0004.jpg', 'example/05/0005.jpg'],
        hotspots: [
            { type: 'nav', face: 0, x: 200, y: 500, name:'Beam Me Out', value: 'transporter' },
            { type: 'info', face: 3, x: 50, y: 500, name:'How cold is it?', value: '<a href="http://www.wunderground.com/cgi-bin/findweather/getForecast?query=zmw:00000.2.06717&bannertypeclick=wu_blueglass"><img src="http://weathersticker.wunderground.com/cgi-bin/banner/ban/wxBanner?bannertype=wu_blueglass&airportcode=&ForcedCity=Chamonix&ForcedState=" alt="Click for Chamonix, France Forecast" height="90" width="160" /></a>' },
        ]
    },
    arcade: {
        infobox: '<b>Arcade</b><br>Somewhere in Japan',
        sides: ['example/19/0000.jpg', 'example/19/0001.jpg', 'example/19/0002.jpg', 'example/19/0003.jpg', 'example/19/0004.jpg', 'example/19/0005.jpg'],
        hotspots: [
            { type: 'nav', face: 0, x: 500, y: 500, name:'Beam Me Up', value: 'transporter' },
            { type: 'nav', face: 3, x: 250, y: 450, name:'Photo Studio', value: 'studio' },
        ]
    },
    studio: {
        infobox: '<b>Photo Studio</b>',
        sides: ['example/20/0000.jpg', 'example/20/0001.jpg', 'example/20/0002.jpg', 'example/20/0003.jpg', 'example/20/0004.jpg', 'example/20/0005.jpg'],
        hotspots: [
            { type: 'nav', face: 1, x: 1000, y: 500, name:'Beam Me Up', value: 'transporter' },
            { type: 'nav', face: 3, x: 350, y: 850, name:'Back to Arcade', value: 'arcade' },
        ]
    },
    archives: {
        infobox: '<b>The Archives</b><br>In the basement',
        sides: ['example/14/0000.jpg', 'example/14/0001.jpg', 'example/14/0002.jpg', 'example/14/0003.jpg', 'example/14/0004.jpg', 'example/14/0005.jpg'],
        hotspots: [
            { type: 'nav', face: 3, x: 400, y: 500, name:'Beam Me Up', value: 'transporter' },
            { type: 'link', face: 5, x: 0, y: 100, name:'You\'ve found the configuration script!', value: 'example/tour.js' },
        ]
    },
    hall: {
        infobox: '<b>Concert Hall</b>',
        sides: ['example/17/0000.jpg', 'example/17/0001.jpg', 'example/17/0002.jpg', 'example/17/0003.jpg', 'example/17/0004.jpg', 'example/17/0005.jpg'],
        hotspots: [
            { type: 'nav', face: 3, x: 400, y: 500, name:'Beam Me Up', value: 'transporter' },
            { type: 'nav', face: 3, x: 650, y: 600, name:'Exit to the Lounge', value: 'lounge' },
        ]
    },
    lounge: {
        infobox: '<b>Lounge</b>',
        sides: ['example/27/0000.jpg', 'example/27/0001.jpg', 'example/27/0002.jpg', 'example/27/0003.jpg', 'example/27/0004.jpg', 'example/27/0005.jpg'],
        hotspots: [
            { type: 'nav', face: 3, x: 400, y: 500, name:'Beam Me Up', value: 'transporter' },
            { type: 'nav', face: 0, x: 980, y: 500, name:'Back to the Concert Hall', value: 'hall' },

        ]
    },
    hut: {
        infobox: '<b>Japanese Hut</b><br>Please take off your shoes',
        sides: ['example/18/0000.jpg', 'example/18/0001.jpg', 'example/18/0002.jpg', 'example/18/0003.jpg', 'example/18/0004.jpg', 'example/18/0005.jpg'],
        hotspots: [
            { type: 'nav', face: 3, x: 400, y: 500, name:'Beam Me Up', value: 'transporter' },
        ]
    },
    ruins: {
        infobox: '<b>Abandoned House</b>',
        sides: ['example/24/0000.jpg', 'example/24/0001.jpg', 'example/24/0002.jpg', 'example/24/0003.jpg', 'example/24/0004.jpg', 'example/24/0005.jpg'],
        hotspots: [
            { type: 'nav', face: 1, x: 0, y: 500, name:'Beam Me Up', value: 'transporter' },
            { type: 'nav', face: 4, x: 200, y: 1000, name:'Climb the Stairs', value: 'wtf' },
        ]
    },
    wtf: {
        infobox: 'WTF?',
        autorotate:.5,
        sides: ['example/11/0000.jpg', 'example/11/0001.jpg', 'example/11/0002.jpg', 'example/11/0003.jpg', 'example/11/0004.jpg', 'example/11/0005.jpg'],
        hotspots: [
            { type: 'nav', face: 1, x: 0, y: 500, name:'GET OUTTA HERE!', value: 'transporter' },
        ]
    }
};

$('#pano').leanorama(tour.transporter).on('leanoramaHotspotClick', function(e, hotspot) {
    if (hotspot.type == 'nav') $(this).trigger('leanoramaRefresh', tour[hotspot.value]);
});
        </script>
    </body>
</html>
