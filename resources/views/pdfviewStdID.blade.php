@extends('layouts.app')
<title>SMS Library Management | User Profile</title>
@section('content')
<div class="container">
	
<hr>


<div class="card">
	<div class="row">
		<aside class="col-sm-5 border-right">
<article class="gallery-wrap">
<div class="img-big-wrap">
  <div> </div>

<div class="img-small-wrap">

</div>
</article>   	@foreach ($users as $key => $user)
		</aside>
		<aside class="col-sm-7">
<article class="card-body p-5">
	<h3 class="title mb-3">{{ $user->name}}</h3>

<!-- <p class="price-detail-wrap">
	<span class="price h3 text-warning">
		<span class="currency">US $</span><span class="num">1299</span>
	</span>
	<span>/per kg</span>
</p>  -->
<dl class="item-property">
  <dt>Email</dt>
  <dd><p>{{ $user->email}}</p></dd>
</dl>
<dl class="param param-feature">
  <dt>Role</dt>
  <dd>{{ $user->role}}</dd>
</dl>  <!-- item-property-hor .// -->
<dl class="param param-feature">
  <dt>Address</dt>
  <dd>{{ $user->address}}</dd>
</dl>  <!-- item-property-hor .// -->
<dl class="param param-feature">
  <dt>Phone Number</dt>
  <dd>{{ $user->phone_number}}</dd>
</dl>  <!-- item-property-hor .// -->

<hr>
<div class="row">
  <div class="container text-center" style=" solid #a1a1a1;padding: 15px;width: 70%;">
  <dl class="param param-feature">
		<dt>Student ID</dt>
    <dd><td><img src="data:image/png;base64,{{DNS1D::getBarcodePNG($user->id , 'C39')}}" alt="barcode" /></td></dd>
  </dl>
</div>	@endforeach
</div>
	<!-- <div class="row">
		<div class="col-sm-5">
			<dl class="param param-inline">
			  <dt>Quantity: </dt>
			  <dd>
			  	<select class="form-control form-control-sm" style="width:70px;">
			  		<option> 1 </option>
			  		<option> 2 </option>
			  		<option> 3 </option>
			  	</select>
			  </dd>
			</dl>
		</div>  -->
		<!-- <div class="col-sm-7">
			<dl class="param param-inline">
				  <dt>Size: </dt>
				  <dd>
				  	<label class="form-check form-check-inline">
					  <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
					  <span class="form-check-label">SM</span>
					</label>
					<label class="form-check form-check-inline">
					  <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
					  <span class="form-check-label">MD</span>
					</label>
					<label class="form-check form-check-inline">
					  <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
					  <span class="form-check-label">XXL</span>
					</label>
				  </dd>
			</dl>
		</div>  -->
	<!-- </div>
	<hr>
	<a href="#" class="btn btn-lg btn-primary text-uppercase"> Buy now </a>
	<a href="#" class="btn btn-lg btn-outline-primary text-uppercase"> <i class="fas fa-shopping-cart"></i> Add to cart </a>
</article>
		</aside>
	</div> <> -->
</div> <!-- card.// -->


</div>
<!--container.//-->


@endsection
<style>
.gallery-wrap .img-big-wrap img {
    height: 450px;
    width: auto;
    display: inline-block;
    cursor: zoom-in;
}


.gallery-wrap .img-small-wrap .item-gallery {
    width: 60px;
    height: 60px;
    border: 1px solid #ddd;
    margin: 7px 2px;
    display: inline-block;
    overflow: hidden;
}

.gallery-wrap .img-small-wrap {
    text-align: center;
}
.gallery-wrap .img-small-wrap img {
    max-width: 100%;
    max-height: 100%;
    object-fit: cover;
    border-radius: 4px;
    cursor: zoom-in;
}
</style>
