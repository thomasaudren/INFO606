<div id='footer'>
</div>
</body>
<script type="text/javascript">
var mois ={
	1:"Janvier",
	2 :"Février",
	3 :"Mars",
	4 :"Avril",
	5 :"Mai",
	6 :"Juin",
	7 :"Juillet",
	8 :"Août",
	9 :"Septembre",
	10 :"Octobre",
	11 :"Novembre",
	12 :"Décembre",
};
var notif = (function(valeur){
		$("#notif").text(valeur);
	});
var calendar = (function(valeur){
	var date = new Date();
		$("#jour").text(date.getDate());
		$("#mois").text(mois[date.getMonth()+1]);
	});

$(document).ready(
	function(){
		notif("9+");
		calendar();
	}
);

</script>	
</html>