		<div class = "container-fluid px10top footer">
			<div class = "row" style = "font-size:0.8em;">
				<div class = "col-lg-4">
					<h4>Disclaimer</h4>
					<p>
						Voters Lounge is a propietary application, any alteration to the source code is strictly prohibited 
						unless authorised.
					</p>
				</div>
				<div class = "col-lg-4">
					<h4>Motivation</h4>
					<p>
						Feel at home, Voters Lounge is the place to be :-D
					</p>
				</div>
				<div class = "col-lg-4">\
					<h4>Contact</h4>
					<p>
						Phone: 0720052568 <br />
						email: <a href = "mailto:dismuskiplimo@gmail.com">dismus</a>
						
						
					</p>
				</div>
			</div>
			<div class = "row">
				<div class = "col-lg-12 center">
					<p style = "font-size:0.8em;"><br />Copyright 2015&copy; Voters Lounge inc</p>
				</div>
			</div>
		</div>
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