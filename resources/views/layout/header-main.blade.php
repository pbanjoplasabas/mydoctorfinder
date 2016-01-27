	
	{{-- Upper Navigation Elements --}}
	<div class="container-fluid upper-nav-container">
		<div class="col-sm-12">
			<ul class="nav navbar-nav navbar-right upper-nav">
				{{-- <li><a href="javascript:void"><i class="fa fa-cog icon-nav"></i>&nbsp;Account Settings</a></li> --}}
				<li><a href="javascript:void"><i class="fa fa-lock icon-nav"></i>&nbsp;Sign In</a></li>
				<li><a href="javascript:void"><i class="fa fa-user icon-nav"></i>&nbsp;Sign Up</a></li>
			</ul>
		</div>
	</div>

	{{-- Main Navigation Elements --}}

	<nav class="navbar navbar-default nav-main-menu no-margin-bottom" role="navigation">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#example-navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="javascript:void">
				<img src="{{ asset('images/logo/logo_temp.png') }}" />
			</a>
		</div>
		<div class="collapse navbar-collapse" id="example-navbar-collapse">
			<ul class="nav navbar-nav navbar-right main-nav">
				<li><a href="javascript:void" class="no-border"><i class="fa fa-home icon-nav header-menu-icons"></i>&nbsp;Home</a></li>
				<li><a href="javascript:void"><i class="fa fa-stethoscope icon-nav header-menu-icons"></i>&nbsp;Find Doctors</a></li>
				<li><a href="javascript:void"><i class="fa fa-hospital-o icon-nav header-menu-icons"></i>&nbsp;Find Hospitals</a></li>
				<li><a href="javascript:void"><i class="fa fa-medkit icon-nav header-menu-icons"></i>&nbsp;Pharmacy</a></li>
				<li><a href="javascript:void"><i class="fa fa-ambulance icon-nav header-menu-icons"></i>&nbsp;Special Clinics</a></li>
				<li><a href="javascript:void"><i class="fa fa-comment icon-nav header-menu-icons"></i>&nbsp;Healthy Blog</a></li>
				<li><a href="javascript:void"><i class="fa fa-phone icon-nav header-menu-icons"></i>&nbsp;Contact Us</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right account-links">
				<li><a href="javascript:void"><i class="fa fa-lock icon-nav header-menu-icons"></i>&nbsp;Sign In</a></li>
				<li><a href="javascript:void"><i class="fa fa-user icon-nav header-menu-icons"></i>&nbsp;Sign Up</a></li>
			</ul>
		</div>
	</nav>