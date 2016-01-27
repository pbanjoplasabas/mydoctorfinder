
	<div class="col-sm-12 bordered-container">
		<h1 class="search-title md-margin-top">Find Doctors</h1>
		<br />
		<form role="form" action="{{ url('doctors/search') }}">
			<div class="form-group">
				<select class="search-default" name="specialty" id="specialty-id" placeholder="Select Specialty">
					<option disabled selected>Select Specialty</option>
					@foreach ($specialties as $opt_spec)
					<option value="{{ $opt_spec->friendly_url }}">{{ $opt_spec->specialization }}</option>
					@endforeach
				</select>
			</div>
			<div class="form-group">
				<select class="search-default" name="location" id="location-id" placeholder="Select Location">
					<option disabled selected>Select Location</option>
					@foreach ($locations as $opt_loc)
					<option value="{{ $opt_loc->friendly_url }}">{{ $opt_loc->location_name }}</option>
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
	<script type="text/javascript">
		$(document).ready(function() {
			// Populate selectize field with categories
			$('.search-default').selectize();
		});
	</script>