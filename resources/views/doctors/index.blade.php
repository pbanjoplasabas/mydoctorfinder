
	@extends('layout.layout-main')
	@section('content')


		<div class="container">
			<div class="row">

				<div class="col-sm-4">
					<div class="row">
						@include('doctors.search-doctors')
						<div class="clearfix"></div><br />
						<div class="col-sm-12 bordered-container">
							<h1 class="main-title no-border md-margin-top">Locations</h1>
							@foreach ($opt_locs as $opt_loc)
							<div class="checkbox checkbox-danger">
								@if ($opt_loc->id == $location->id)

								@else
									<?php
										$specialtyUrl 	= (isset($_GET['specialty']) ? 'specialty='.$_GET['specialty'] : '');
										$tmpLoc_url 	= url('doctors/'.$specialty->friendly_url.'/'.$location->friendly_url).'?'.$specialtyUrl;
										if (isset($_GET['locations'])) {
											if (strpos($_GET['locations'], ''.$opt_loc->id.'') !== false) {
												$currentLoc = explode('-', $_GET['locations']);
												$pos 		= array_search($opt_loc->id, $currentLoc);
												unset ($currentLoc[$pos]);
												$append 	= '&locations='.implode('-', $currentLoc);
											}
											else {
												$currentLoc = explode('-', $_GET['locations']);
												$newLoc = explode('-', $opt_loc->id);
												$append = '&locations='.implode('-', array_merge($currentLoc,$newLoc));
												// $append = '&locations='.$_GET['locations'].'-'.$opt_loc->id;
											}
										}
										else {
											$append = 'locations='.$opt_loc->id;
										}
									?>
									<input type="checkbox" <?=(isset($_GET['locations']) ? (strpos($_GET['locations'], ''.$opt_loc->id.'') !== FALSE ? 'checked' : '') : '')?> id="chkopt-{{ $opt_loc->id }}" class="location-checkbox" value="{{ $opt_loc->id }}" />
									<label for="chkopt-{{ $opt_loc->id }}">
										<a href="{{ $tmpLoc_url.$append }}" id="location-checkbox-{{ $opt_loc->id }}">
											{{ $opt_loc->city_name }}
										</a>
									</label>
								@endif
							</div>
							@endforeach
						</div>
						<div class="clearfix"></div><br />
						<div class="col-sm-12 bordered-container">
							<h1 class="main-title no-border md-margin-top">Specializations</h1>
							@foreach ($opt_specs as $opt_spec)
							<div class="checkbox checkbox-danger">
								<?php
									$locationsUrl 	 = (isset($_GET['locations']) ? 'locations='.$_GET['locations'] : '');
									$tmpSpec_url = url('doctors/'.$specialty->friendly_url.'/'.$location->friendly_url).'?'.$locationsUrl;
									if (isset($_GET['specialty'])) {
										if (strpos($_GET['specialty'], ''.$opt_spec->id.'') !== false) {
											$currentSpec = explode('-', $_GET['specialty']);
											$pos 		= array_search($opt_spec->id, $currentSpec);
											unset ($currentSpec[$pos]);
											$append 	= '&specialty='.implode('-', $currentSpec);
										}
										else {
											$currentSpec = explode('-', $_GET['specialty']);
											$newSpec = explode('-', $opt_spec->id);
											$append = '&specialty='.implode('-', array_merge($currentSpec,$newSpec));
										}
									}
									else {
										if (isset($_GET['locations'])) {
											$append = '&specialty='.$opt_spec->id;
										}
										else {
											$append = 'specialty='.$opt_spec->id;
										}
									}
								?>
								@if ($opt_specs->id == $specialty->id)

								@else
									<input type="checkbox" <?=(isset($_GET['specialty']) ? (strpos($_GET['specialty'], ''.$opt_spec->id.'') !== FALSE ? 'checked' : '') : '')?> id="chkopt-{{ $opt_spec->id }}" class="specialty-checkbox" value="{{ $opt_spec->id }}" />
									<label for="chkopt-{{ $opt_spec->id }}">
										<a href="{{ $tmpSpec_url.$append }}">
											{{ $opt_spec->specialization }}
										</a>
									</label>
								@endif
							</div>
							@endforeach
						</div>

						<script type="text/javascript">
							$(document).ready(function() {

								// Trigger for changing the selected filter item
								$('.location-checkbox').change(function() {
									var target = $('#location-checkbox-'+$(this).val()).attr('href');
									window.location.href= target;
								});
							});
						</script>

					</div>
					<br />
					<div class="detail-container text-center">
						<div class="detail-ad-container-300">
							<a href="javascript:void" target="_blank">
								<img src="{{ asset('images/ads/300-600-flanax.jpg') }}" />
							</a>
						</div>
						<div class="clearfix"></div><br />
						<div class="detail-ad-container-300">
							<a href="javascript:void" target="_blank">
								<img src="{{ asset('images/ads/300-300-flanax.jpg') }}" />
							</a>
						</div>
					</div>
				</div>

				<div class="col-sm-8">
					<div class="results-container bordered-container">
						<h1 class="main-title no-margin-top">Doctors of {{ $specialty->specialization }} in {{ $location->city_name }}</h1>

						<div class="results-item-container">
							@forelse ($doctors as $doctor)
								<div class="result-item">
									<div class="result-item-img">
										<img src="{{ asset('images/profiles/no-image.png') }}" />
									</div>
									<div class="result-item-content">
										<h3 class="result-content-title">
											<a href="{{ url('doctors/details/'.$doctor->url) }}">Dr. {{ $doctor->full_name }}</a>
										</h3>
										<table class="table result-content-list">
											<tr>
												<td class="content-list-title">Specialty</td>
												<td class="content-list-value">
													@foreach ($doctor->specs as $spec)
													<a href="{{ url('doctors/'.$spec->friendly_url) }}">{{ ($spec->specialization) }}</a><br />
													@endforeach
												</td>
											</tr>	
											@if ($doctor->hospitals)
											<tr>
												<td class="content-list-title">Hospital</td>
												<td class="content-list-value">
													@foreach ($doctor->hospitals as $hosp)
														@if (!is_null($hosp->listing_title))
														<a href="{{ url('hospitals/'.$hosp->url) }}">{!! ucwords(strtolower($hosp->listing_title)) !!}</a> <br />
														@endif
													@endforeach
												</td>
											</tr>	
											@endif
											@if ($doctor->hmos)
											<tr>
												<td class="content-list-title">HMO</td>
												<td class="content-list-value">
													@foreach ($doctor->hmos as $hmo)
													{{ ucwords(strtolower($hmo->listing_title)) }}<br />
													@endforeach
												</td>
											</tr>	
											@endif
											<tr>
												<td class="content-list-title">Distance</td>
												<td class="content-list-value">{{ substr($doctor->distance, 0, 4) }} KM</td>
											</tr>
										</table>
									</div>
									<div class="result-item-links text-right no-padding-top">
										<a href="javascript:void" class="btn btn-labeled btn-dark-theme btn-sm">
											<span class="btn-label"><i class="fa fa-search"></i></span> View Profile
										</a>
										<a href="javascript:void" class="btn btn-labeled btn-dark-theme btn-sm">
											<span class="btn-label"><i class="fa fa-calendar"></i></span> Schedule
										</a>
									</div>
								</div>
							@empty
								<div class="col-sm-12">
									<br />
									<h3>Whoops! There are no doctors of {{ $specialty->specialization }} in {{ $location->city_name }}</h3>
									<p>Please try to search again</p>
									<br />
									<br />
									<br />
									<br />
								</div>
							@endforelse
						</div>

						<div class="col-sm-12 text-right">
							@if (isset($_GET['locations']) && isset($_GET['specialty']))
								{!! $paginator->appends(['locations' => $_GET['locations'] , 'specialty' => $_GET['specialty']])->links() !!}
							@elseif (isset($_GET['locations']) && !isset($_GET['specialty']))
								{!! $paginator->appends(['locations' => $_GET['locations']])->links() !!}
							@elseif (!isset($_GET['locations']) && isset($_GET['specialty']))
								{!! $paginator->appends(['specialty' => $_GET['specialty']])->links() !!}
							@else
								{!! $paginator->links() !!}
							@endif
						</div>

					</div>
				</div>

			</div>
		</div>
		<div class="clearfix"></div>

		<div class="modal fade" id="loading-modal" tabindex="-1" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">Loading</h4>
					</div>
					<div class="modal-body">
						<div class="progress">
							<div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">
							</div>
						</div>
					</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->

	@stop