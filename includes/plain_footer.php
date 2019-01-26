		<script type="text/javascript">
			d = new Date();
			document.getElementById("tarehe").innerHTML = "<span class=\"glyphicon glyphicon-time\"></span> " + d.toDateString();
		</script>
	</body>
</html>
<?php
	if(isset($conn)){
		mysql_close($conn);
	}
?>