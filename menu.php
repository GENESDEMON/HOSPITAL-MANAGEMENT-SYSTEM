<?php
session_start();
?>
<style>
body {margin:0;font-family:Arial}

.topnav {
  overflow: hidden;
  background-color: #071f44;
}

.topnav a {
  float: left;
  display: block;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

.active {
  background-color: black;
  color: white;
}

.topnav .icon {
  display: none;
}

.dropdown {
  float: left;
  overflow: hidden;
}

.dropdown .dropbtn {
  font-size: 17px;    
  border: none;
  outline: none;
  color: white;
  padding: 14px 16px;
  background-color: inherit;
  font-family: inherit;
  margin: 0;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  float: none;
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
  text-align: left;
}

.topnav a:hover, .dropdown:hover .dropbtn {
  background-color: #555;
  color: white;
}

.dropdown-content a:hover {
  background-color: #ddd;
  color: black;
}

.dropdown:hover .dropdown-content {
  display: block;
}

@media screen and (max-width: 600px) {
  .topnav a:not(:first-child), .dropdown .dropbtn {
    display: none;
  }
  .topnav a.icon {
    float: right;
    display: block;
  }
}

@media screen and (max-width: 600px) {
  .topnav.responsive {position: relative;}
  .topnav.responsive .icon {
    position: absolute;
    right: 0;
    top: 0;
  }
  .topnav.responsive a {
    float: none;
    display: block;
    text-align: left;
  }
  .topnav.responsive .dropdown {float: none;}
  .topnav.responsive .dropdown-content {position: relative;}
  .topnav.responsive .dropdown .dropbtn {
    display: block;
    width: 100%;
    text-align: left;
  }
}
</style>
<?php
if(isset($_SESSION[adminid]))
{
?>
<div class="topnav" id="myTopnav">
  <a href="adminaccount.php" class="active">Home</a>
  <div class="dropdown">
    <button class="dropbtn">Profile
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
    <a href="adminprofile.php">Admin Profile</a>
    <a href="adminchangepassword.php">Change Password</a>
    <a href="addadmin.php" style="width:150px;">Add Admin</a>
    <a href="viewadmins.php" style="width:150px;">View Admin</a>
    </div>
  </div> 
  <div class="dropdown">
    <button class="dropbtn">Patient
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
    <a href="addpatient.php">Add Patient</a>
    <a href="viewpatient.php">View Patient</a>
    </div>
  </div> 
  <div class="dropdown">
    <button class="dropbtn">Appointment
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
     <a href="appointment.php" style="width:200px;">New Appointment</a>
     <a href="viewappointmentpending.php" style="width:200px;">View Pending Appointments</a>
     <a href="viewappointmentapproved.php" style="width:200px;">View Approved Appointments</a>
     <a href="viewtreatmentrecord.php">Treatment</a>
    </div>
  </div> 
  <div class="dropdown">
    <button class="dropbtn">Doctor
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
     <a href="doctor.php">Add Doctor</a>
     <a href="Viewdoctor.php">View Doctor</a>
      <a href="doctortimings.php">Add Doctor Timings</a>
     <a href="viewdoctortimings.php">View Doctor Timings</a>
    </div>
  </div> 
  <div class="dropdown">
    <button class="dropbtn">Others
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
     <a href="department.php" style="width:150px;">Add Department</a>
    	 <a href="Viewdepartment.php" style="width:150px;">View Department</a>
         <a href="treatment.php" style="width:150px;">Add Treatment type</a>
         <a href="viewtreatment.php" style="width:150px;">View Treatment types</a>
       	 <a href="medicine.php" style="width:150px;">Add Medicine</a>
    	 <a href="Viewmedicine.php" style="width:150px;">View Medicine</a>
    </div>
  </div> 
  <a href="logout.php">Logout</a>
  <a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="myFunction()">&#9776;</a>
</div>
<?php
}
?>
<?php
if(isset($_SESSION[doctorid]))
{
?>
<div class="topnav" id="myTopnav">
  <a href="doctoraccount.php" class="active">Home</a>
  <div class="dropdown">
    <button class="dropbtn">Appointment
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <a href="viewappointmentpending.php">Pending Appointment</a>
      <a href="viewappointmentapproved.php">Approved Appointments</a>
    </div>
  </div> 
  <div class="dropdown">
    <button class="dropbtn">Profie
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <a href="doctorprofile.php">View Profile</a>
      <a href="doctorchangepassword.php">Change Password</a>
       <a href="viewdoctortimings.php">View Timings</a>
    </div>
  </div> 
  <div class="dropdown">
    <button class="dropbtn">Patient
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <a href="viewpatient.php">View Patients</a>
    </div>
  </div> 
  <div class="dropdown">
    <button class="dropbtn">Treatment
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
    <a href="viewtreatmentrecord.php">View Treatment Records</a>
    <a href="viewtreatment.php">View Treatment</a>
    </div>
  </div> 
  <a href="logout.php">Logout</a>
  <a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="myFunction()">&#9776;</a>
</div>
<?php
}
?>
<?php
if(isset($_SESSION[patientid]))
{
?>
<div class="topnav" id="myTopnav">
  <a href="patientaccount.php" class="active">Home</a>
  <div class="dropdown">
    <button class="dropbtn">Appointment
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <a href="patientappointment.php">Book Appointment</a>
      <a href="viewappointment.php">View Appointments</a>
    </div>
  </div> 
  <div class="dropdown">
    <button class="dropbtn">Profie
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <a href="patientprofile.php">View Profile</a>
      <a href="patientchangepassword.php">Change Password</a>
    </div>
  </div> 
  <div class="dropdown">
    <button class="dropbtn">Prescription
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <a href="patientprescription.php">View Prescription</a>
      <a href="viewtreatmentrecord.php">View Treatment</a>
    </div>
  </div> 
  <a href="logout.php">Logout</a>
  <a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="myFunction()">&#9776;</a>
</div>
<?php
}
?>
<script>
function myFunction() {
  var x = document.getElementById("myTopnav");
  if (x.className === "topnav") {
    x.className += " responsive";
  } else {
    x.className = "topnav";
  }
}
</script>
