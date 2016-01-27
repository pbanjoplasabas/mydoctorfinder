

	<div class="container">
		<div class="row">
			<div class="col-sm-6">
				<div class="search-home">
					<h1 class="search-title">Find Doctors</h1>
					<p class="search-sub-title md-padding-bottom md-margin-bottom">Bridging doctors and patients efficiently</p>
					<form role="form" action="{{ url('doctors/search') }}">
						<div class="form-group">
							<select class="search-default" name="specialty" id="specialty-id" placeholder="Select Specialty" required>
								<option disabled selected>Select Specialty</option>
								@foreach ($specialties as $specialty)
								<option value="{{ $specialty->friendly_url }}">{{ $specialty->specialization }}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group">
							<select class="search-default" name="location" id="location-id" placeholder="Select Location" required>
								<option disabled selected>Select Location</option>
								@foreach ($locations as $location)
								<option value="{{ $location->friendly_url }}">{{ $location->location_name }}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-theme btn-100">
								Find Doctors
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>	
	

	<script type="text/javascript">
		$(document).ready(function() {
			// Populate selectize field with categories
			$('.search-default').selectize();
		});
	</script>