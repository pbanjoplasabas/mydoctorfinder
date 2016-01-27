	
	@if (Request::segment(1) == '')
		{{-- Footer Mobile App Ad --}}
		<div class="container-fluid mobile-app-ad">
			<div class="container">
				<div class="col-lg-6">
					<h2 class="mobile-app-ad-txt-header">Doctor's Location on the Go!</h2>
					<p class="mobile-app-ad-txt-content">Find a nearby doctor or dentist and book an appointment instantly. And it's free!</p>
					<br />
					<p class="mobile-app-ad-sub-header">Features:</p>
					<p class="mobile-app-ad-txt-content">
						View a map of doctors in your insurance network. <br />
						Read patient reviews to help you choose the right doctor
					</p>
					<br /><br />
					<p class="mobile-app-ad-sub-header">Get the App:</p>
					<div class="mobile-app-ad-img">
						<img src="{{ asset('images/pages/index/img-app-store.png') }}" />
					</div>
					<div class="mobile-app-ad-img">
						<img src="{{ asset('images/pages/index/img-android.png') }}" />
					</div>
				</div>
				<div class="col-lg-6">
					<div class="mobile-ad-splash">
						<img src="{{ asset('images/pages/index/img-phone-app.png') }}" />
					</div>
				</div>
			</div>
		</div>
	@else 
		<br />
	@endif

	<div class="container-fluid footer-container">
		<div class="container">
			<div class="footer-menu-section">

					<div class="col-sm-4 sm-margin-top">
						<h5 class="footer-title">Search</h5>
						<ul class="footer-menu">
							<li><a href="javascript:void">Find Hospitals</a></li>
							<li><a href="javascript:void">Pharmacy</a></li>
							<li><a href="javascript:void">Special Clinics</a></li>
							<li><a href="javascript:void">Find Doctors</a></li>
						</ul>	
					</div>
					<div class="col-sm-4 sm-margin-top">
						<h5 class="footer-title">Connect With Us</h5>
						<ul class="footer-menu">
							<li><a href="javascript:void">Contact Us</a></li>
							<li><a href="javascript:void">About Us</a></li>
							<li><a href="javascript:void">Advertise Here</a></li>
						</ul>	
					</div>
					<div class="col-sm-4 sm-margin-top">
						<h5 class="footer-title">About</h5>
						<ul class="footer-menu">
							<li><a href="javascript:void">The nearest doctor in your area?</a></li>
							<li><a href="javascript:void">A doctor with specialty on your ailment?</a></li>
							<li><a href="javascript:void">A dental, optical, dermatology clinic near you?</a></li>
							<li><a href="javascript:void">A pharmacy around your city?</a></li>
							<li><a href="javascript:void">A hospital that accepts your HMO?</a></li>
						</ul>	
					</div>

			</div>
			<div class="footer-menu-section">

					<div class="col-sm-4 sm-margin-top">
						<h5 class="footer-title">Sign In</h5>
						<ul class="footer-menu">
							<li><a href="javascript:void">Doctor Login</a></li>
							<li><a href="javascript:void">Patient Login</a></li>
						</ul>	
						<div class="clearfix"></div>
						<h5 class="footer-title">Follow us</h5>
						<a href="javascript" class="sm-margin-right"><i class="fa fa-facebook-square fa-2x"></i></a>
						<a href="javascript"><i class="fa fa-twitter-square fa-2x"></i></a>
					</div>
					<div class="col-sm-4 sm-margin-top">
						<h5 class="footer-title">Relevant Articles</h5>
						<ul class="footer-menu">
							<li><a href="javascript:void">Health Blogs</a></li>
							<li><a href="javascript:void">Recommended Doctors</a></li>
							<li><a href="javascript:void">Top Hospitals & Clinics</a></li>
						</ul>	
					</div>
					<div class="col-sm-4 sm-margin-top">
						<h5 class="footer-title">Downloads</h5>
						<a href="javascript:void" class="sm-margin-right"><img class="footer-img-link" src="{{ asset('images/links/link-appstore.png') }}" /></a>
						<a href="javascript:void" class="sm-margin-right"><img class="footer-img-link" src="{{ asset('images/links/link-googleplay.png') }}" /></a>
					</div>

			</div>
		</div>
	</div>