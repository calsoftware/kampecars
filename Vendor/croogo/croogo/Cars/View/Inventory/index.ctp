<?php 

echo $this->Layout->js();
		echo $this->Html->script(array(
			'/croogo/front-end/js/inventory',
		));
?>
<div class="block push inventory-wrap">
	<div class="page-heading">
		<div class="container">
			<div class="row row-heading">
				<div class="col-sm-6">
					<h1>Inventory</h1>
				</div>
				<div class="col-sm-6 col-right">
					<button id="expand-sort" class="btn-blank">Sort By<span class="icon-up native-svg i-append i-close"></span><span class="icon-down native-svg i-append i-open"></span></button>
					<button id="expand-filter" class="btn-blank"><span class="icon-plus native-svg i i-close"></span><span class="icon-minus native-svg i i-open"></span>Filters</button>
				</div>
			</div>
		</div>
	</div>
	<div class="filter-sort">
		<div id="section-filter" class="section-filter collapsed">
			<div class="container">
				<?php echo $this->element('site/filter',array('submit'=>'Find Car')); ?>
			</div>
		</div>
		<div id="section-sort" class="section-sort collapsed">
			<div class="container">
				<ul>
					<li class="active asc"><a href="inventory/listing-1/sortby-listing_price/direction-desc.html">Price<span class="chevron"></span></a></li>
					<li class=""><a href="inventory/listing-1/sortby-listing_year/direction-asc.html">Registration year<span class="chevron"></span></a></li>
					<li class=""><a href="inventory/listing-1/sortby-listing_mileage/direction-asc.html">Mileage<span class="chevron"></span></a></li>
				</ul>
			</div>
		</div>
	</div>

	<div class="container">
		
							<ul id="car-list" class="cars">
							<li>
					<div class="poster">
						<img src="/kampe/croogo/upload/large/1.jpg" alt="Toyota Starlet">
						<div class="type">Hatchback</div>
						<div class="over">
							<div class="desc">1998 / 46699 km / 60 kW / petrol / Hatchback / Blue</div>
							<a href="inventory/Starlet-15069G-179.html" class="btn-blue btn-detail">View Details</a>
						</div>
					</div>
					<a href="inventory/Starlet-15069G-179.html" class="title">Toyota Starlet</a>
					<div class="price">FOB: $ 100.00</div>
				</li>
							<li>
					<div class="poster">
						<img src="/kampe/croogo/upload/large/2.jpg" alt="Nissan Sunny">
						<div class="type">Sedan</div>
						<div class="over">
							<div class="desc">2002 / 19109 km / 80 kW / petrol / Sedan / Silver</div>
							<a href="inventory/Sunny-15003y-192.html" class="btn-blue btn-detail">View Details</a>
						</div>
					</div>
					<a href="inventory/Sunny-15003y-192.html" class="title">Nissan Sunny</a>
					<div class="price">FOB: $ 160.00</div>
				</li>
							<li>
					<div class="poster">
						<img src="/kampe/croogo/upload/large/3.jpg" alt="Nissan Bluebird Sylphy">
						<div class="type">Sedan</div>
						<div class="over">
							<div class="desc">2005 / 127370 km / 80 kW / petrol / Sedan / Silver</div>
							<a href="inventory/Sylphy-15004y-193.html" class="btn-blue btn-detail">View Details</a>
						</div>
					</div>
					<a href="inventory/Sylphy-15004y-193.html" class="title">Nissan Bluebird Sylphy</a>
					<div class="price">FOB: $ 160.00</div>
				</li>
							<li>
					<div class="poster">
						<img src="/kampe/croogo/upload/large/4.jpg" alt="Nissan March">
						<div class="type">Hatchback</div>
						<div class="over">
							<div class="desc">1999 / 64110 km / 44 kW / petrol / Hatchback / Silver</div>
							<a href="inventory/March-15041g-201.html" class="btn-blue btn-detail">View Details</a>
						</div>
					</div>
					<a href="inventory/March-15041g-201.html" class="title">Nissan March</a>
					<div class="price">FOB: $ 160.00</div>
				</li>
							
							</ul>
								<div align="center"><a id="load-more" class="btn-more" href="inventory/listing-1/pjPage-2.html" class="btn-main btn-lg uppercase">Load More</a></div>
			</div>

</div>