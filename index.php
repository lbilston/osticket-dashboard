<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
<head>
<title>Dashboard Example</title>
<style type="text/css">
body, html { margin: 0; padding: 0; width: 100%; height: 100%; overflow: hidden; }
iframe { border: none; width: 100%; height: 100%; display: none; }
iframe.active { display: block;}
</style>
<script type="text/javascript">
var Dash = {
    nextIndex: 0,

    dashboards: [
		{url: "http://helpdesk.warringapark.vic.edu.au/dashboard/dashboard.php", time: 20, refresh: true},
        {url: "http://disco.warringapark.vic.edu.au:9292/Public/HeldDevices/Noticeboard", time: 20, refresh: true},
        {url: "https://status.compass.education", time: 20, refresh: true},
        {url: "https://www.apple.com/au/support/systemstatus", time: 20, refresh: true},
        {url: "http://broadband.doe.wan", time: 20, refresh: true}

		
    ],
    
    startup: function () {
        for (var index = 0; index < Dash.dashboards.length; index++) {
						Dash.loadFrame(index);
				}
        setTimeout(Dash.display, Dash.dashboards[0].time * 1000);
    },
    
    loadFrame: function (index) {
				var iframe = document.getElementById(index);
				iframe.src = Dash.dashboards[index].url;
    },

    display: function () {
        var dashboard = Dash.dashboards[Dash.nextIndex];
				Dash.hideFrame(Dash.nextIndex - 1);
				if (dashboard.refresh) {
						Dash.loadFrame(Dash.nextIndex);
				}
				Dash.showFrame(Dash.nextIndex);
        Dash.nextIndex = (Dash.nextIndex + 1) % Dash.dashboards.length;
        setTimeout(Dash.display, dashboard.time * 1000);
    },
    
    hideFrame: function (index) {
				if (index < 0) {
						index = Dash.dashboards.length - 1;
				}
				document.getElementById(index).removeAttribute('class');
    },
    
    showFrame: function (index) {
				document.getElementById(index).setAttribute('class', 'active');
    }
};

window.onload = Dash.startup;
</script>
</head>
<body>
<iframe id="0" class="active"></iframe>
<iframe id="1"></iframe>
<iframe id="2"></iframe>
<iframe id="3"></iframe>
<iframe id="4"></iframe>
</body>
</html>