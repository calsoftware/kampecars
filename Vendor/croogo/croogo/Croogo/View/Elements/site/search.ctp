 <section class="section-search">
      <div class="container">
          <?php echo $this->Form->create('Inventory', array(
		'class' => 'home-search',
		'novalidate' => true,
		'url' => array(
				'plugin' => 'cars',
				'controller' =>'Inventory',
				'action' =>'index',
		),
));?>
              <div class="row">
                  <div class="col-md-6">
                      <div class="row row-input">
                          <div class="col-sm-6">
                              <label for="make_id">Make</label>
                              <select id="make_id" name="make_id" class="form-control" data-toggle="select">
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
                                                                  </select>
                          </div>
                          <div class="col-sm-6">
                              <label for="model_id">Model</label>
                              <select id="model_id" name="model_id" class="form-control" data-toggle="select">
                                  <option value="">-- All --</option>
                              </select>
                          </div>
                      </div>
                  </div>
                  <div class="col-md-6">
                      <div class="row row-input">
                          <div class="col-sm-6">
                              <label id="price">Price</label>
                              <input id="price" name="price" type="text" value="" data-toggle="range" data-min="-900" data-max="49000" data-postfix="USD" data-step="1000">
                          </div>
                          <div class="col-sm-6 col-btn">
                              <button type="submit" class="btn-hot btn-block">Find Car</button>
                          </div>
                      </div>
                  </div>
              </div>
              <input type="hidden" name="listing_search" value="1">
         	<?php echo $this->Form->end();?>
      </div>
  </section>