
<html>
	<head>
		<!--  I USE BOOTSTRAP BECAUSE IT MAKES FORMATTING/LIFE EASIER -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"><!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css"><!-- Optional theme -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script><!-- Latest compiled and minified JavaScript -->
		<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
		<script src="http://cdn.jsdelivr.net/jquery.mixitup/latest/jquery.mixitup.min.js"></script>

		<link rel="stylesheet" href="https://mixitup.kunkalabs.com/wp-content/themes/mixitup.kunkalabs/style.css?ver=1.5.4" type="text/css">
	</head>


	<script type="text/javascript">
		$(function(){
		    $('#SandBox').mixItUp();
		});
	</script>

	<body>
		<div class="control-bar sandbox-control-bar">
			<div class="group">
				<label>Sort:</label>
				<span class="btn sort" data-sort="random">Random</span>
				<span class="btn sort" data-sort="value:asc">Ascending</span>
				<span class="btn sort" data-sort="value:desc">Descending</span>
				<span class="btn sort" data-sort="name:asc">Name: Ascending</span>
				<span class="btn sort" data-sort="name:desc">Name: Descending</span>
			</div>
			<div class="group">
				<label>Filter:</label>
				<span class="btn filter active" data-filter="all">All</span>
				<span class="btn filter" data-filter=".category-1">Blue</span>
				<span class="btn filter" data-filter=".category-2">Green</span>
				<span class="btn filter" data-filter="none">None</span>
				<span id="ToggleLayout" class="btn toggle-layout">&nbsp;<i></i></span>
				<span id="ToggleConfig" class="btn toggle-config">&nbsp;</span>
			</div>
		</div>


		<div id="SandBox" class="sandbox">
			<div class="mix category-1" data-value="1" data-name="Alex" style="display: inline-block;">Val: 1 <br> Name: Alex</div>
			<div class="mix category-1" data-value="2" data-name="Bishop" style="display: inline-block;">Val: 2 <br> Name: Bishop</div>
			<div class="mix category-2" data-value="3" data-name="Clark" style="display: inline-block;">Val: 3 <br> Name: Clark</div>
			<div class="mix category-1" data-value="4" data-name="Don" style="display: inline-block;">Val: 4 <br> Name: Don</div>
			<div class="mix category-2" data-value="5" data-name="Eric" style="display: inline-block;">Val: 5 <br> Name: Eric</div>
			<div class="mix category-2" data-value="6" data-name="Fred" style="display: inline-block;">Val: 6 <br> Name: Fred</div>
			<div class="mix category-1" data-value="7" data-name="George" style="display: inline-block;">Val: 7 <br> Name: George</div>
			<div class="mix category-2" data-value="8" data-name="Harry" style="display: inline-block;">Val: 8 <br> Name: Harry</div>
			<div class="mix category-2" data-value="9" data-name="Ian" style="display: inline-block;">Val: 9 <br> Name: Ian</div>
			<div class="mix category-1" data-value="10" data-name="John" style="display: inline-block;">Val: 10 <br> Name: John</div>
			<div class="mix category-2" data-value="11" data-name="Kal" style="display: inline-block;">Val: 11 <br> Name: Kal</div>
			<div class="mix category-2" data-value="12" data-name="Liam" style="display: inline-block;">Val: 12 <br> Name: Liam</div>
			<div class="gap"></div>
			<div class="gap"></div>
			<form class="live-config" id="LiveConfig">
				<div class="field effect no-checkbox active" data-effect="duration">
					<label>Duration</label>
					<div class="slider long" data-min="0" data-max="1000" data-unit="ms">
						<div class="scrubber" data-value="400ms" style="left: 40%;"></div>
					</div>
				</div>
				<div class="field effect checkbox active" data-effect="fade">
					<input type="checkbox" checked="">
					<label>Fade</label>
				</div>
				<div class="field effect checkbox" data-effect="scale">
					<input type="checkbox">
					<label>Scale</label>
					<div class="slider" data-min="0.01" data-max="2" data-unit="">
						<div class="scrubber" data-value="0.01" style="left: 0%;"></div>
					</div>
				</div>
				<div class="field effect checkbox" data-effect="translateX">
					<input type="checkbox">
					<label>TranslateX</label>
					<div class="slider" data-min="-100" data-max="100" data-unit="%">
						<div class="scrubber" data-value="10%" style="left: 55%;"></div>
					</div>
				</div>
				<div class="field effect checkbox" data-effect="translateY">
					<input type="checkbox">
					<label>TranslateY</label>
					<div class="slider" data-min="-100" data-max="100" data-unit="%">
						<div class="scrubber" data-value="10%" style="left: 55%;"></div>
					</div>
				</div>
				<div class="field effect checkbox active" data-effect="translateZ">
					<input type="checkbox" checked="">
					<label>TranslateZ</label>
					<div class="slider" data-min="-1000" data-max="1000" data-unit="px">
						<div class="scrubber" data-value="-360px" style="left: 32%;"></div>
					</div>
				</div>
				<div class="field effect checkbox" data-effect="rotateX">
					<input type="checkbox">
					<label>RotateX</label>
					<div class="slider" data-min="-180" data-max="180" data-unit="deg">
						<div class="scrubber" data-value="20deg" style="left: 55.5556%;"></div>
					</div>
				</div>
				<div class="field effect checkbox" data-effect="rotateY">
					<input type="checkbox">
					<label>RotateY</label>
					<div class="slider" data-min="-180" data-max="180" data-unit="deg">
						<div class="scrubber" data-value="20deg" style="left: 55.5556%;"></div>
					</div>
				</div>
				<div class="field effect checkbox" data-effect="rotateZ">
					<input type="checkbox">
					<label>RotateZ</label>
					<div class="slider" data-min="-180" data-max="180" data-unit="deg">
						<div class="scrubber" data-value="20deg" style="left: 55.5556%;"></div>
					</div>
				</div>
				<div class="field effect checkbox active" data-effect="stagger">
					<input type="checkbox" checked="">
					<label>Stagger</label>
					<div class="slider" data-min="0" data-max="200" data-unit="ms">
						<div class="scrubber" data-value="34ms" style="left: 17%;"></div>
					</div>
				</div>
				<div class="spacer"></div>
				<div class="field">
					<div class="dropdown scrollable"><span class="old"><select id="Easing" class="" data-settings="{&quot;cutOff&quot;:4}" onchange="site.sandBox.liveEasing(this.value)">
						<option value="ease">ease</option>
						<option value="cubic-bezier(0.47, 0, 0.745, 0.715)">easeInSine</option>
						<option value="cubic-bezier(0.39, 0.575, 0.565, 1)">easeOutSine</option>
						<option value="cubic-bezier(0.445, 0.05, 0.55, 0.95)">easeInOutSine</option>
						<option value="cubic-bezier(0.55, 0.085, 0.68, 0.53)">easeInQuad</option>
						<option value="cubic-bezier(0.25, 0.46, 0.45, 0.94)">easeOutQuad</option>
						<option value="cubic-bezier(0.455, 0.03, 0.515, 0.955)">easeInOutQuad</option>
						<option value="cubic-bezier(0.55, 0.055, 0.675, 0.19)">easeInCubic</option>
						<option value="cubic-bezier(0.215, 0.61, 0.355, 1)">easeOutCubic</option>
						<option value="cubic-bezier(0.645, 0.045, 0.355, 1)">easeInOutCubic</option>
						<option value="cubic-bezier(0.6, -0.28, 0.735, 0.045)">easeInBack</option>
						<option value="cubic-bezier(0.175, 0.885, 0.32, 1.275)">easeOutBack</option>
						<option value="cubic-bezier(0.68, -0.55, 0.265, 1.55)">easeInOutBack</option>
					</select></span><span class="selected">ease</span><span class="carat"></span><div><ul><li class="active">ease</li><li>easeInSine</li><li>easeOutSine</li><li>easeInOutSine</li><li>easeInQuad</li><li>easeOutQuad</li><li>easeInOutQuad</li><li>easeInCubic</li><li>easeOutCubic</li><li>easeInOutCubic</li><li>easeInBack</li><li>easeOutBack</li><li>easeInOutBack</li></ul></div></div>
				</div>
				<div class="spacer"></div>
				<div class="btn" id="Export">Export Configuration</div>
			</form>
		</div>
	</body>
</html>