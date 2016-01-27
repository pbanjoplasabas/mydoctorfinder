
	@extends('layout.layout-main')
	@section('content')

		@include('layout.search-home')


		<div class="container">
			<div class="row">

				<div class="col-sm-8">
					<div class="results-container bordered-container">
						<h1 class="main-title no-margin-top">Doctors Nearby</h1>

						@foreach ($doctors as $doctor)
							<div class="result-item">
								<div class="result-item-img">
									<img src="{{ asset('images/profiles/no-image.png') }}" />
								</div>
								<div class="result-item-content">
									<h3 class="result-content-title">
										<a href="javascript:void">Dr. {{ $doctor->full_name }}</a>
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
											<td class="content-list-value">800. KM</td>
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
						@endforeach

					</div>
				</div>

				<div class="col-sm-4">
					<div class="detail-container">
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

			</div>
		</div>
		<div class="clearfix"></div>

	@stop