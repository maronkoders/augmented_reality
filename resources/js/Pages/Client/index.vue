<template>
<link rel="stylesheet" href="assets/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
<link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">
<link rel="stylesheet" href="assets/css/style.css">

  <div class="main-wrapper">

<header class="header">
<nav class="navbar navbar-expand-lg header-nav">
<div class="navbar-header">
<a id="mobile_btn" href="javascript:void(0);">
<span class="bar-icon">
<span></span>
<span></span>
<span></span>
</span>
</a>
<a href="index-2.html" class="navbar-brand logo">
<img src="assets/img/logo.png" class="img-fluid" alt="Logo">
</a>
</div>
<div class="main-menu-wrapper">
<div class="menu-header">
<a href="index-2.html" class="menu-logo">
<img src="assets/img/logo.png" class="img-fluid" alt="Logo">
</a>
<a id="menu_close" class="menu-close" href="javascript:void(0);">
<i class="fas fa-times"></i>
</a>
</div>
<ul class="main-nav">
<li class="has-submenu active">
<a href="#">Home <i class="fas fa-chevron-down"></i></a>
<ul class="submenu">
<li class="active"><a href="index-2.html">Home</a></li>
<li><a href="index-1.html">Home 1</a></li>
<li><a href="index-3.html">Home 2</a></li>
<li><a href="index-4.html">Home 3</a></li>
<li><a href="index-5.html">Home 4</a></li>
<li><a href="index-6.html">Home 5</a></li>
<li><a href="index-7.html">Home 6</a></li>
<li><a href="index-8.html">Home 7</a></li>
<li><a href="index-9.html">Home 8</a></li>
</ul>
</li>

</ul>
</div>
<ul class="nav header-navbar-rht">
<li class="nav-item contact-item">
<div class="header-contact-img">
<i class="far fa-hospital"></i>
</div>
<div class="header-contact-detail">
<p class="contact-header">Contact</p>
<p class="contact-info-header"> +263 67 369 5943</p>
</div>
</li>
<!-- <li class="nav-item">
<a class="nav-link header-login" href="login.html">login / Signup </a>
</li> -->
</ul>
</nav>
</header>


<section class="section section-search">
<div class="container-fluid">
<div class="banner-wrapper">
<div class="banner-header text-center">
<h1>Search Doctor, Make an Appointment</h1>
<p>Discover the best doctors, clinic & hospital the city nearest to you.</p>
</div>

<div class="search-box">
<form>
<div class="form-group search-info">
<input type="text" class="form-control" placeholder="Search Level">
<span class="form-text">Select your level</span>
</div>
<div class="form-group search-info">
<input type="text" class="form-control" placeholder="Search subjects">
<span class="form-text">Ex : Maths, English, Geograghy etc</span>
</div>
<button @click="searchSubjects($event)" type="submit" class="btn btn-primary search-btn mt-0"><i class="fas fa-search"></i> <span>Search</span></button>
</form>
</div>

</div>
</div>
</section>

<section class="section section-blogs" v-show="areSubjectLevels">
<div class="container-fluid">

<div class="section-header text-center">
<h2>
     {{level}}'s  {{selectSubjects}}
</h2>
<p class="sub-title">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
</div>

<div class="row blog-grid-row">
<div class="col-md-6 col-lg-3 col-sm-12">

<div class="blog grid-blog">
<div class="blog-image">
<a href="#"><img class="img-fluid" src="assets/img/blog/blog-01.jpg" alt="Post Image"></a>
</div>
<div class="blog-content">

<h3 class="blog-title"><a href="#">Doccure – Making your clinic painless visit?</a></h3>
</div>
</div>

</div>
</div>
</div>
</section>


<section class="section section-blogs" v-show="zeroSubjects">
<div class="container-fluid">

<div class="section-header text-center">
<h2>
     {{level}}'s  {{selectSubjects}}
</h2>
</div>

<div class="row blog-grid-row">
<div class="col-md-12 col-lg-12 col-sm-12">

    <center>
      <h1>
        {{level}} has no corresponding subjects, select another level.
      </h1>
    </center>

</div>
</div>
</div>
</section>


<footer class="footer">

<div class="footer-top">
<div class="container-fluid">
<div class="row">
<div class="col-lg-3 col-md-6">

<div class="footer-widget footer-about">
<div class="footer-logo">
<img src="assets/img/footer-logo.png" alt="logo">
</div>
<div class="footer-about-content">
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
<div class="social-icon">
<ul>
<li>
<a href="#" target="_blank"><i class="fab fa-facebook-f"></i> </a>
</li>
<li>
<a href="#" target="_blank"><i class="fab fa-twitter"></i> </a>
</li>
<li>
<a href="#" target="_blank"><i class="fab fa-linkedin-in"></i></a>
</li>
<li>
<a href="#" target="_blank"><i class="fab fa-instagram"></i></a>
</li>
<li>
<a href="#" target="_blank"><i class="fab fa-dribbble"></i> </a>
</li>
</ul>
</div>
</div>
</div>

</div>
<div class="col-lg-3 col-md-6">

<div class="footer-widget footer-menu">
<h2 class="footer-title">For Patients</h2>
<ul>
<li><a href="search.html">Search for Doctors</a></li>
<li><a href="login.html">Login</a></li>
<li><a href="register.html">Register</a></li>
<li><a href="booking.html">Booking</a></li>
<li><a href="patient-dashboard.html">Patient Dashboard</a></li>
</ul>
</div>

</div>
<div class="col-lg-3 col-md-6">

<div class="footer-widget footer-menu">
<h2 class="footer-title">For Doctors</h2>
<ul>
<li><a href="appointments.html">Appointments</a></li>
<li><a href="chat.html">Chat</a></li>
<li><a href="login.html">Login</a></li>
<li><a href="doctor-register.html">Register</a></li>
<li><a href="doctor-dashboard.html">Doctor Dashboard</a></li>
</ul>
</div>

</div>
<div class="col-lg-3 col-md-6">

<div class="footer-widget footer-contact">
<h2 class="footer-title">Contact Us</h2>
<div class="footer-contact-info">
<div class="footer-address">
<span><i class="fas fa-map-marker-alt"></i></span>
<p> 3556 Beech Street, San Francisco,<br> California, CA 94108 </p>
</div>
<p>
<i class="fas fa-phone-alt"></i>
+1 315 369 5943
</p>
<p class="mb-0">
<i class="fas fa-envelope"></i>
</p>
</div>
</div>

</div>
</div>
</div>
</div>


<div class="footer-bottom">
<div class="container-fluid">

<div class="copyright">
<div class="row">
<div class="col-md-6 col-lg-6">
<div class="copyright-text">
<p class="mb-0">&copy; 2020 Doccure. All rights reserved.</p>
</div>
</div>
<div class="col-md-6 col-lg-6">

<div class="copyright-menu">
<ul class="policy-menu">
<li><a href="term-condition.html">Terms and Conditions</a></li>
<li><a href="privacy-policy.html">Policy</a></li>
</ul>
</div>

</div>
</div>
</div>

</div>
</div>

</footer>

</div>
</template>

<script>
import axios from 'axios';
export default {
    data()
    {
      return {
          levels:[],
          subjects:[],
          level:'',
          selectSubjects:[],
          areSubjectLevels:false,
          zeroSubjects:false
      }
    },
    methods:{

    },
    mounted:{
      searchSubjects:function(e)
      {
        e.preventDefault();
        this.areSubjectLevels = true;


      },
      getLevels:function()
      {
        axios.get('/api/get_levels')
            .then(response => {
              if(response.data.success)
              {
                  this.levels = response.data.levels;
              }
            })
            .catch();
      },
      getSubjects:function()
      {

         axios.get('/api/get_subjects')
            .then(response => {
              if(response.data.success)
              {
                  this.subjects = response.data.subjects;
              }
            })
            .catch();

      }

    }
}
</script>
