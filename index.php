<!DOCTYPE html>

<?php
session_start();
$username = empty($_COOKIE['userid']) ? '' : $_COOKIE['userid'];
 if (!$username) {
	header("Location: login.php");
	exit;
 }
?>
	<html xmlns="https://www.w3.org/1999/xhtml">

	<head>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
		<script src="https://cdn.jsdelivr.net/jquery.mixitup/latest/jquery.mixitup.min.js"></script>

		<link rel="stylesheet" href="https://mixitup.kunkalabs.com/wp-content/themes/mixitup.kunkalabs/style.css?ver=1.5.4" type="text/css">

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

		<link rel="stylesheet" type="text/css" href="css/dropdown-enhancement.css">

		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
		<script src="libraries/dropdown-enhancement.js"></script>

		<link rel="stylesheet" type="text/css" href="css/design.css">
	</head>

	<script type="text/javascript">
		var selected = [];
		var currentBox = -1;
		$(function() {

			$('#SandBox').mixItUp();

      //for filter checked or unchecked
			$('.car input:checkbox, .other input:checkbox').change(function() {
				if ($(this).is(":checked")) {
					selected.push($(this).attr('name'));
					var tempName = GetTempName();
					$('#SandBox').mixItUp('filter', tempName);
			  	}
        else {
					var index = selected.indexOf($(this).attr('name'));
					if (index > -1) {
						selected.splice(index, 1);
					}
					var tempName = GetTempName();
					$('#SandBox').mixItUp('filter', tempName);
			   	}
				  $('#textbox1').val($(this).is(':checked'));
		   	});

    	addItemMixBoxes($('#SandBox'));   //newfuntion

       //for rightwapper click-show up or not
			$("#rightWrapper").click(function() {
				$(this).animate({
					width: 'toggle'
				}, 512, function() {
					$("#rightTab").animate({
						width: 'toggle'
					});
				});
			});
      //for righttab click-show up or not
    	$("#rightTab").click(function() {
				$(this).animate({
					width: 'toggle'
				}, 512, function() {
					$("#rightWrapper").animate({
						width: 'toggle'
					}, 512);
				});
			});
      //student Id check
    	$("#check").click(function() {
				if ($("#student").val().trim().length < 1) {
					$("#student").attr("placeholder", "Can not be NULL");
				} else if ($("#item").val().trim().length < 1) {
					$("#item").attr("placeholder", "Can not be NULL");
				} else {
					var date = new Date();
					date.setHours(date.getHours() + 2);
					var timeDue = date.getFullYear() + "-" + date.getMonth() + "-" + date.getDay() + " " + date.getHours() + ":" + date.getMinutes() + ":00";
					$.post("checkOut.php", {
						"student": $("#student").val().trim(),
						"item": $("#item").val().trim(),
						"time": Date().substring(16, 24)
					}, function(data) {
            if(data=="existed"){
              alert(" this item already is already checked out");
            }
            else if(data=="Success"){
              alert(" successed");
            }
            else if(data=="No Change"){
              alert(" checked out fail !");
            }

					});
				}
			});

      //addEmployee part dialog  for add employee
    	$("#addEmployee").click(function() {
				if ($("#inputEmployeeUser").val().trim().length < 1) {
          $("#inputEmployeeUser").attr("placeholder", "Can not be NULL");
				} else if ($("#inputEmployeeFName").val().trim().length < 1) {
					$("#inputEmployeeFName").attr("placeholder", "Can not be NULL");
				} else if ($("#inputEmployeeLName").val().trim().length < 1) {
					$("#inputEmployeeLName").attr("placeholder", "Can not be NULL");
				} else if ($("#inputEmployeePass").val().trim().length < 1) {
					$("#inputEmployeePass").attr("placeholder", "Can not be NULL");
				} else {
					$.post("addEmployee.php", {
						"username": $("#inputEmployeeUser").val().trim(),
						"first": $("#inputEmployeeFName").val().trim(),
						"last": $("#inputEmployeeLName").val().trim(),
						"pass": $("#inputEmployeePass").val().trim(),
					}, function(data) {
						console.log(data);
					});
				}
			});
     // add a new Item
    	$("#addItem").click(function() {
				if ($("#inputItem").val().trim().length > 0) {
					$.post("addItem.php", {
						"item": $("#inputItem").val().trim()
					}, function(data) {
						addMixBox(1, 50, data, $('#SandBox'));
					});
				} else {
					$("#inputItem").attr("placeholder", "Can not be NULL");
				}
			});
    // add a new category
    	$("#addCategory").click(function() {
				if ($("#inputCategory").val().trim().length > 0) {
					$.post("addCategory.php", {
						"category": $("#inputCategory").val().trim()
					}, function(data) {
						console.log(data);
					});
				} else {
					$("#inputCategory").attr("placeholder", "Can not be NULL");
				}
			});
    // add a new location in the dialog
    	$("#addLocation").click(function() {
				if ($("#inputWaiver").val().trim().length > 0) {
					$.post("addLocation.php", {
						"location": $("#inputLocation").val().trim()
					}, function(data) {
						console.log(data);
					});
				} else {
					$("#inputLocation").attr("placeholder", "Can not be NULL");
				}
			});
    //add a new waiver
    	$("#addWaiver").click(function() {
				if ($("#inputWaiver").val().trim().length > 0) {
					$.post("addWaiver.php", {
						"waiver": $("#inputWaiver").val().trim()
					}, function(data) {
						console.log(data);
					});
				} else {
					$("#inputWaiver").attr("placeholder", "Can not be NULL");
				}
			});
    // option- find the new way search
    	$("#pickFirstName").click(function() {
				console.log("Print");
				$("#ascendingSort").attr("data-sort", "studentname:asc");
				$("#descendingSort").attr("data-sort", "studentname:desc");
			});
			$("#pickItemName").click(function() {
				console.log("Print");
				$("#ascendingSort").attr("data-sort", "itemname:asc");
				$("#descendingSort").attr("data-sort", "itemname:desc");
			});

  	});

    //for the filter
		function GetTempName() {
			var tempName = "";
			for (var i = 0; i < selected.length; i++) {
				tempName += selected[i];
				if (i < selected.length - 1) {
					tempName += ",";
				}
			}
			if (tempName == "") {
				tempName = "all";
			}
			return tempName;
		}
   //for add a new item in box
		function addItemMixBoxes(mixDiv) { //new
			$.post("getItems.php", function(data) {
				if (data != "Empty Set") {
					data = JSON.parse(data);
					data.forEach(function(element) {
						addMixBox(element, mixDiv);
					});
				}
			});
		}
   //for remve a item in item
		function removeItem(itemID) {
			$.post("deleteItem.php", {
				"id": currentBox
			}, function(data) {
				console.log(data);
				if (data == "success") {
					$("#itemQuickDisplayBox" + itemID).remove();
				}
			});
		}
    function checkinItem(itemID) {
      $.post("checkinItem.php", {
        "id": currentBox
      }, function(data) {
        console.log(data);
        if (data == "success") {
        location.reload(true);
        }
      });
    }
   //add a mixBox
		function addMixBox(itemInfo, mixDiv) {

			var sortFields = " data-itemName = '" + itemInfo.name + "'";
			if (itemInfo.checkoutInfo) {
				sortFields += "data-studentName = '" + itemInfo.checkoutInfo.studentName + "' data-overdueTime = '" + itemInfo.checkoutInfo.timeExpire + "' data-employeeName = '" + itemInfo.checkoutInfo.employeeName + "'";
			}
			var tags = "<p><b>Tags:</b>";
			var tagsClass = " ";
			itemInfo.tags.forEach(function(tag) {
				tags += "<span>" + tag + ", </span>";
				tagsClass += "item-" + tag + " ";
			});
			tags = tags.substring(0, tags.length - 9);
			tags += "</span></p>";
			var timeExpire = (itemInfo.checkoutInfo) ? "<br>" + itemInfo.checkoutInfo.timeExpire : "";
			var studentName = (itemInfo.checkoutInfo) ? itemInfo.checkoutInfo.studentName + "<br>" : "";
			var box = "<div id = 'itemQuickDisplayBox" + itemInfo.id + "' class='mix" + tagsClass + "' " + sortFields + "style='display: inline-block;'>";
			var button = "<button type='button' class='displayItemInfo btn btn-info btn-lg' data-toggle='modal' data-target='#myModal'>" + studentName + itemInfo.name + timeExpire + "</button></div>";
			var newBox = $.parseHTML(box + button);
			mixDiv.mixItUp("prepend", newBox[0]);
			$(newBox).click(function() {
				currentBox = itemInfo.id;
				$("#myModal .modal-header").html("<button type = 'button' class = 'close' data-dismiss = 'modal'>x</button><h4 class = 'modal-title'>" + itemInfo.name + " details</h4>");
				console.log(itemInfo);

        //show studentName on the dialog!
				var itemName = "<p><b>Item Name:</b><span id = 'change-name'>" + itemInfo.name + "</span></p>";
        var loanerName = (studentName) ? "<hr><p><b>Student Name:</b> <span class='modal-editable'>" + itemInfo.checkoutInfo.studentName + "</span></p>" : "";
        var time = (timeExpire) ? "<p><b>TimeExpire:</b> <span class='modal-editable'>" + itemInfo.checkoutInfo.timeExpire + "</span></p>" : "";
        var itemLocation = "<p><b>Location:</b><select id = 'select-location'>";
				$.get("getLocations.php", function(data) {
					data = JSON.parse(data);
					data.forEach(function(element) {
						$("#myModal .modal-body p #select-location").append("<option value = '" + element + "'>" + element + "</option>");
					});
					 $("#myModal .modal-body p #select-location").val(itemInfo.location);
				});
				itemLocation += "</select>";
				$("#myModal .modal-body").html(itemName + itemLocation + tags + loanerName + time);
				$("#myModal .modal-footer .checkinItem").attr("onClick", "checkinItem(" + itemInfo.id + ")");
      	$("#myModal .modal-footer .removeItem").attr("onClick", "removeItem(" + itemInfo.id + ")");
				var loanerName = (itemInfo.outName) ? "<p><b>Student Name:</b> <span class='modal-editable'>" + itemInfo.outName + "</span></p>" : "";
			});
		}
	</script>

	<body>
      <!-- this is header -->
		<nav class="navbar navbar-inverse title">

			<div class="container-fluid">

				<form class="navbar-right">

					<ul class="nav navbar-nav" id="navbar_top">

						<li><a style="color:rgba(241,184,45,.7);" href="#">Welcome! <?php echo $username;?></a></li>
						<li>
							<a style="color:rgba(241,184,45,.7);" href="#">
								<?php if($_SESSION["permissions"]<2){ echo "-Admin Model-";} else{echo "-Employee Model-";};?>
							</a>
						</li>
						<li><a style="color:white" href="login.php"><b>Log out</b></a> </li>
					</ul>
				</form>
			</div>
		</nav>

      <!-- main content -->
		<div id="container">
       <!-- left content -->
			<div id="leftWrapper">
       <!-- studentID and barcode -->
				<div id="topRibbon">

					<div id="button-div">

						<form>
							<button class="submit" id="check" type="button">Submit</button>
						</form>

						<div class="btn-group">

							<button data-toggle="dropdown" class="btn btn-primary dropdown-toggle bringButton time"> Time <span class="caret"></span></button>

							<ul class="dropdown-menu car">

								<li>
									<input type="checkbox" id="oneHour" name=".category-1" value="1">
									<label for="comp">1 hour</label>
								</li>
								<li>
									<input type="checkbox" id="twoHours" name="temp" value="1">
									<label for="car">2 hours</label>
								</li>
								<li>
									<input type="checkbox" id="threeHours" name="temp" value="1">
									<label for="car">3 hours</label>
								</li>
							</ul>
						</div>
					</div>

					<div id="scannedText-div">

						<div class="individual">

							<form id="studentID-form" class="scannedText-form">

								<label class="scannedText-label">Student ID</label>
								<input type="text" id="student" class="scanned-text" placeholder="From 1 to 10"/>
							</form>
						</div>
						<div class="individual">

							<form id="barcode-form" class="scannedText-form">

								<label class="scannedText-label">Barcode</label>
								<input type="text" id="item" class="scanned-text" placeholder="From 1 to 29" />
							</form>
						</div>
					</div>
				</div>

        <!-- ______________________this like a hr  tag _______________________ -->
				<div class="gradient-border"> </div>

        <!-- user part -->
				<div id="inUse-wrapper">
            <!-- this will show up when u click the item!        first part -->
					<div class="fade modal" id="myModal" role="dialog">
						<div class="modal-dialog modal-lg">
							<div class="modal-content">
								<div class="modal-header"></div>
								<div class="modal-body">
									<!-- <p><b>Student Name:</b> <span class="modal-editable">John</span></p>
									<p><b>Employee Name:</b> <span class="modal-editable"> Paul </span></p> -->
								</div>
								<div class="modal-footer">
                  <button type="button" class="btn btn-danger checkinItem" data-dismiss="modal">checkin</button>
                	<?php if($_SESSION["permissions"]<2){ ?>
									<button type="button" class="btn btn-danger removeItem " data-dismiss="modal">Remove</button>
									<button type="button" class="btn btn-default " data-dismiss="modal">Save</button>
                  <?php } ?>
									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								</div>
							</div>
						</div>
					</div>
            <!-- this will show up when u click the add button!  second part -->
					<div class="fade modal" id="addNew" role="dialog">
						<div class="modal-dialog modal-lg">
							<!-- Modal content-->
							<div class="modal-content">
                <!-- Modal header-->
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h4 class="modal-title">Add Information</h4>
								</div>
                <!-- Modal body-->
								<div class="modal-body">
                <!-- add a new employee -->
									<p>

										<span class="fill">

                        <button id="addEmployee" type="button" class="btn btn-default">Add</button>
                                        </span>
										<b>Employee Pawprint:</b>
										<span>

                                            <input id="inputEmployeeUser" class="add">
                                        </span>
										<b>Employee First Name:</b>
										<span>

                                            <input id="inputEmployeeFName" class="add">
                                        </span>
										<b>Employee Last Name:</b>
										<span>

                                            <input id="inputEmployeeLName" class="add">
                                        </span>
										<b>Employee Password:</b>

										<span>

                                            <input id="inputEmployeePass" class="add">
                                        </span>
									</p>
									<hr>
                <!-- add a new item-->
									<p>
										<button id="addItem" type="button" class="btn btn-default">Add</button>
										<b>Item Name:</b>
										<span><input id="inputItem" class="add"></span>
									</p>
									<hr>
                <!-- add a new category-->
									<p>
										<button id="addCategory" type="button" class="btn btn-default">Add</button>
										<b>Item Category:</b>
										<span><input id="inputCategory" class="add"></span>
									</p>
									<hr>
                <!-- add a new locarion-->
									<p>
										<button id="addLocation" type="button" class="btn btn-default" name="testme">Add</button>
										<b>Location:</b>
										<span><input id="inputLocation" class="add"></span>
									</p>
									<hr>
                <!-- add a new waiver-->
									<p>
										<button id="addWaiver" type="button" class="btn btn-default">Add</button>
										<b>Waiver:</b>
										<span><input id="inputWaiver" class="add"></span>
									</p>
								</div>
                <!-- add a close button-->
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								</div>
							</div>
						</div>
					</div>
            <!-- this is the filter and sort button      third part -->
					<div class="control-bar sandbox-control-bar" style="overflow: visible;">
						<div class="group filterAlign">

							<label>Filter:</label>
							<div class="btn-group">
								<button data-toggle="dropdown" class="btn btn-primary dropdown-toggle bringButton "> Item <span class="caret"></span></button>
								<ul class="dropdown-menu car">
									<li>
										<input type="checkbox" id="comp" name=".item-laptop" value="1">
										<label for="comp">Laptop</label>
									</li>
									<li>
										<input type="checkbox" id="car" name=".item-mac" value="2">
										<label for="car">Mac</label>
									</li>
									<li>
										<input type="checkbox" id="bike" name=".item-PC" value="3">
										<label for="bike">PC</label>
									</li>
									<li>
										<input type="checkbox" id="ping_pong" name=".item-charger" value="4">
										<label for="ping_pong">Charger</label>
									</li>
									<li>
										<input type="checkbox" id="donkey" name=".item-bike" value="5">
										<label for="donkey">Bike</label>
									</li>
								</ul>
							</div>
							<div class="btn-group">
								<button data-toggle="dropdown" class="btn btn-primary dropdown-toggle bringButton"> Category <span class="caret"></span></button>
								<ul class="dropdown-menu other">
									<li>

										<input type="checkbox" id="group1" name=".category-2" value="1">
										<label for="group1">Group 1</label>
									</li>
									<li>

										<input type="checkbox" id="group2" name="ex2" value="1">
										<label for="group2">Group 2</label>
									</li>
								</ul>
							</div>

							<div class="btn-group">

								<button data-toggle="dropdown" class="btn btn-primary dropdown-toggle bringButton"> Condition <span class="caret"></span></button>
								<ul class="dropdown-menu">

									<li>

										<input type="checkbox" id="ex2_1" name="ex2" value="1">
										<label for="ex2_1">Good</label>
									</li>
									<li>

										<input type="checkbox" id="ex2_2" name="ex2" value="2">
										<label for="ex2_2">Damaged</label>
									</li>
								</ul>
							</div>
						</div>

						<div class="group">

							<label>Sort:</label>
							<span class="btn sort" data-sort="random">Random</span>

							<div class="btn-group">
								<button data-toggle="dropdown" class="btn btn-default dropdown-toggle">Option1 <span class="caret"></span></button>
								<ul class="dropdown-menu">
									<li>
										<input type="radio" id="pickFirstName" name="ex1" value="1" checked="">
										<label for="pickFirstName">Name</label>
									</li>
									<li>
										<input type="radio" id="pickLastName" name="ex1" value="2">
										<label for="pickLastName">pickLastName</label>
									</li>
									<li>
										<input type="radio" id="pickItemName" name="ex1" value="3">
										<label for="pickItemName">Item Name</label>
									</li>
								</ul>
							</div>

							<span id="ascendingSort" class="btn sort" data-sort="firstname:asc">Ascending</span>
							<span id="descendingSort" class="btn sort" data-sort="firstname:desc">Descending</span>
						</div>
             <!-- this is a button for add more employee and item etc -->
             <?php if($_SESSION["permissions"]<2){ ?>
						<button type="button" id="plus " class="btn btn-info  " data-toggle="modal" data-target="#addNew"> + </button>
            <?php } ?>
					</div>

        <!-- ______________________this like a hr  tag _______________________ -->
					<div class="gradient-border"></div>

        <!-- sandBox-our main content                      fourth part   -->
					<div id="SandBox" class="sandbox">

						<div class="gap"></div>
						<div class="gap"></div>

					</div>
				</div>
			</div>
        <!-- ______________________this like a hr  tag _______________________ -->
			<div id="rightTab" style="display: none;">
			<span class="glyphicon glyphicon-chevron-left"></span>
			</div>
        <!-- our left content-->
			<div id="rightWrapper">
				<div id="overdue">

					<h1>Overdue</h1>
				</div>
			</div>
		</div>
	</body>
	<script>
    //for sort!
		$(".sortby").click(function() {
			$(this).toggleClass("clicked");
		});
    //add more function in jquery
		$.fn.extend({
			editable: function() {
				$(this).each(function() {
					var $el = $(this),
						$edittextbox = $('<input type="text"></input>').css('min-width', $el.width()),
						submitChanges = function() {
							if ($edittextbox.val() !== '') {
								$el.html($edittextbox.val());
								$el.show();
								$el.trigger('editsubmit', [$el.html()]);
								$(document).unbind('click', submitChanges);
								$edittextbox.detach();
							}
						},
						tempVal;
					$edittextbox.click(function(event) {
						event.stopPropagation();
					});
					$el.dblclick(function(e) {
						tempVal = $el.html();
						$edittextbox.val(tempVal).insertBefore(this)
							.bind('keypress', function(e) {
								var code = (e.keyCode ? e.keyCode : e.which);
								if (code == 13) {
									submitChanges();
								}
							}).select();
						$el.hide();
						$(document).click(submitChanges);
					});
				});
				return this;
			}
		});
		$('.modal-editable').editable().on('editsubmit', function(event, val) {
			console.log('text changed to ' + val);
		});
	</script>

	</html>
