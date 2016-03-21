<?php
$applyfilter = isset($applyfilter)?true:false; 
$submit      = isset($submit)?$submit:'Search';
extract($search_data);
echo $this->Form->create('Inventory', array(
		'class' => 'home-search',
		'novalidate' => true,
		'url' => array(
				'plugin' => 'cars',
				'controller' =>'Inventory',
				'action' =>'index',
		),
));
?>

					<input type="hidden" name="controller" value="pjFullsite">
					<input type="hidden" name="action" value="pjActionInventory">
					<input type="hidden" name="listing_search" value="1">
					<div class="row">
						<div class="col-md-4 col-lg-3">
							<label>Car type</label>
							<div class="group-checkbox">
								<input id="car_type_used" name="car_type_used" value="T" type="checkbox">
								<label for="car_type_used">Used cars</label>
								<input id="car_type_new" name="car_type_new" value="T" type="checkbox">
								<label for="car_type_new">New cars</label>
							</div>
						</div>
						<div class="col-md-8 col-lg-9">
							<div class="row row-input">
								<div class="col-sm-4">
									<label for="make_id">Make</label>
									<?php /*?><select id="make_id" name="make_id" class="form-control" data-toggle="select">
										<option value="">-- All --</option>
																					<option value="5">Audi</option>
																					<option value="9">Bmw</option>
																					<option value="14">Chrysler</option>
																					<option value="122">Daf</option>
																					<option value="28">Ford</option>
																					<option value="30">Honda</option>
																					<option value="35">Isuzu</option>
																					<option value="126">Iveco</option>
																					<option value="36">Jaguar</option>
																					<option value="107">Land rover</option>
																					<option value="41">Lexus</option>
																					<option value="46">Mazda</option>
																					<option value="47">Mercedes</option>
																					<option value="51">Mitsubishi</option>
																					<option value="54">Nissan</option>
																					<option value="78">Subaru</option>
																					<option value="79">Suzuki</option>
																					<option value="85">Toyota</option>
																					<option value="90">Vw</option>
																			</select><?php */?>
								<?php 
									echo $this->form->input('Make.id',array('options'=>$make_options,'empty'=>'-- All --','label'=>false,'class'=>'form-control'))	;
										?>
                                </div>
								<div class="col-sm-4">
									<label for="model_id">Model</label>
									<select id="model_id" name="model_id" class="form-control" data-toggle="select">
										<option value="">-- All --</option>
																			</select>
								</div>
								<?php /*?><div class="col-sm-4">
									<label for="location_id">Location</label>
									<select id="location_id" name="location_id" class="form-control" data-toggle="select">
										<option value="">-- All --</option>
																					<option value="1">Local</option>
																					<option value="26">Durban</option>
																					<option value="10">Japan</option>
																					<option value="24">Messina</option>
																					<option value="17">U.K</option>
																			</select>
								</div><?php */?>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-6">
							<div class="row row-input">
								<div class="col-sm-6">
									<label for="year">Year</label>
									<input id="year" name="year" type="text" value="" data-toggle="range-year" data-min="1992" data-max="2015">
								</div>
								<div class="col-sm-6">
									<label id="power">Motor Power</label>
									<input id="power" name="power" type="text" value="" data-toggle="range" data-min="34" data-max="244" data-postfix="kw" data-step="10">
								</div>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="row row-input">
								<div class="col-sm-6">
									<label for="mileage">Mileage</label>
									<input id="mileage" name="mileage" type="text" value="" data-toggle="range" data-min="0" data-max="706345" data-postfix="km" data-step="1000">
								</div>
								<div class="col-sm-6">
									<label id="price">Price</label>
									<input id="price" name="price" type="text" value="" data-toggle="range" data-min="-900" data-max="49000" data-postfix="USD" data-step="1000">
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-6">
							<div class="row row-input">
								<div class="col-sm-6">
									<label for="feature_fuel_id">Fuel Type</label>
									<!--<select id="feature_fuel_id" name="feature_fuel_id" class="form-control" data-toggle="select">
										<option value="">-- All --</option>
																					<option value="10">diesel</option>
																					<option value="14">electric</option>
																					<option value="13">hybrid</option>
																					<option value="11">petrol</option>
																			</select>-->
                                                                            <?php 
									echo $this->form->input('Fuel.id',array('options'=>$fuels,'empty'=>'-- All --','label'=>false,'class'=>'form-control'))	;
										?>
								</div>
								<div class="col-sm-6">
									<label for="feature_type_id">Vehicle Type</label>
									<?php /*?><select id="feature_type_id" name="feature_type_id" class="form-control" data-toggle="select">
										<option value="">-- All --</option>
																					<option value="7">Convertible</option>
																					<option value="53">Double Cab</option>
																					<option value="55">Hatchback</option>
																					<option value="1">Limousine</option>
																					<option value="5">Off-road</option>
																					<option value="9">Other</option>
																					<option value="6">Pickup Truck</option>
																					<option value="50">Sedan</option>
																					<option value="54">Single Cab</option>
																					<option value="2">Small Car</option>
																					<option value="8">Sports car/Coupe</option>
																					<option value="3">Station Wagon</option>
																					<option value="56">SUV</option>
																					<option value="95">Truck</option>
																					<option value="4">Van/Minibus</option>
																			</select><?php */?>
                                                                            
                                                                             <?php 
									echo $this->form->input('Vehicle.id',array('options'=>$vehicle_types,'empty'=>'-- All --','label'=>false,'class'=>'form-control'))	;
										?>
								</div>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="row row-input">
								<div class="col-sm-6">
									<label for="feature_class_id">Engine Capacity</label>
									<select id="feature_class_id" name="feature_class_id" class="form-control" data-toggle="select">
										<option value="">-- All --</option>
																					<option value="68">1000cc</option>
																					<option value="85">1200cc</option>
																					<option value="70">1300cc</option>
																					<option value="94">1400cc</option>
																					<option value="69">1500cc</option>
																					<option value="86">1600cc</option>
																					<option value="90">1700cc</option>
																					<option value="71">1800cc</option>
																					<option value="72">2000cc</option>
																					<option value="96">2100cc</option>
																					<option value="73">2200cc</option>
																					<option value="89">2400cc</option>
																					<option value="74">2500cc</option>
																					<option value="75">2600cc</option>
																					<option value="88">2700cc</option>
																					<option value="76">2800cc</option>
																					<option value="77">3000cc</option>
																					<option value="78">3200cc</option>
																					<option value="91">3400cc</option>
																					<option value="79">3500cc</option>
																					<option value="87">3700cc</option>
																					<option value="80">4000cc</option>
																					<option value="82">4200cc</option>
																					<option value="81">4500cc</option>
																					<option value="83">4600cc</option>
																					<option value="84">4800cc</option>
																					<option value="93">6700cc</option>
																			</select>
									</select>
								</div>
								<div class="col-sm-6">
									<label for="feature_gearbox_id">Gearbox</label>
									<?php /*?><select id="feature_gearbox_id" name="feature_gearbox_id" class="form-control" data-toggle="select">
										<option value="">-- All --</option>
																					<option value="19">automatic</option>
																					<option value="18">manual</option>
																					<option value="20">semi-automatic</option>
																			</select><?php */?>
                                                                             <?php 
									echo $this->form->input('Gearboxes.id',array('options'=>$gearboxes,'empty'=>'-- All --','label'=>false,'class'=>'form-control'))	;
										?>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-6">
							<div class="row row-input">
								<div class="col-sm-6">
									<label for="feature_colors_id">Color</label>
									<?php /*?><select id="feature_colors_id" name="feature_colors_id" class="form-control" data-toggle="select">
										<option value="">-- All --</option>
																					<option value="37">Beige</option>
																					<option value="59">Beige</option>
																					<option value="38">Black</option>
																					<option value="39">Blue</option>
																					<option value="40">Brown</option>
																					<option value="67">Burgundy</option>
																					<option value="41">Gold</option>
																					<option value="42">Green</option>
																					<option value="43">Grey</option>
																					<option value="44">Orange</option>
																					<option value="60">Pearl</option>
																					<option value="58">Pink</option>
																					<option value="45">Purple</option>
																					<option value="46">Red</option>
																					<option value="47">Silver</option>
																					<option value="48">White</option>
																					<option value="92">Wine red</option>
																					<option value="49">Yellow</option>
																			</select><?php */?>
                                                                              <?php 
									echo $this->form->input('Color.id',array('options'=>$colors,'empty'=>'-- All --','label'=>false,'class'=>'form-control'))	;
										?>
								</div>
								<div class="col-sm-6">
									<label for="feature_doors_id">Doors</label>
									<?php /*?><select id="feature_doors_id" name="feature_doors_id" class="form-control" data-toggle="select">
										<option value="">-- All --</option>
																					<option value="29">2/3</option>
																					<option value="30">4/5</option>
																			</select><?php */?>
                                                                            
                                                                              <?php 
									echo $this->form->input('door.id',array('options'=>$doors,'empty'=>'-- All --','label'=>false,'class'=>'form-control'))	;
										?>
								</div>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="row row-input">
								<div class="col-sm-6">
									<label for="feature_seats_id">Number of seats</label>
									<?php /*?><select id="feature_seats_id" name="feature_seats_id" class="form-control" data-toggle="select">
										<option value="">-- All --</option>
																					<option value="63">10</option>
																					<option value="66">10</option>
																					<option value="62">15</option>
																					<option value="21">2</option>
																					<option value="22">2+1</option>
																					<option value="23">3</option>
																					<option value="24">4</option>
																					<option value="25">4+1</option>
																					<option value="64">42</option>
																					<option value="26">5</option>
																					<option value="27">5+1</option>
																					<option value="65">6</option>
																					<option value="57">7</option>
																					<option value="61">8</option>
																			</select><?php */?>
                                                                            
                                                                             <?php 
									echo $this->form->input('seat.id',array('options'=>$number_of_seat,'empty'=>'-- All --','label'=>false,'class'=>'form-control'))	;
										?>
                                                                            
								</div>
								<div class="col-sm-6">
									<label for="listing_refid">Reference ID</label>
									<input id="listing_refid" name="listing_refid" class="form-control" placeholder="Reference ID" value="">
								</div>
							</div>
						</div>
					</div>
					<div class="row row-input row-btn">
						<div class="col-xs-6 col-sm-6 col-lg-3 col-left">
							<button class="btn-hot btn-block btn-apply"><?php echo $submit ?></button>
						</div>
						<?php if($applyfilter){ ?>
						<div class="col-xs-6 col-sm-6 col-lg-3 col-lg-offset-6 col-right">
							<a href="inventory.html" class="btn-blank btn-block btn-clear">
								<span class="btitle">Clear Filters</span>
							</a>
						</div>
						<?php } ?>
					</div>
					
	<?php echo $this->Form->end();?>