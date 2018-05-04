# wcms-shop
This is a plugin for WonderCMS (https://www.wondercms.com).

This plugin using jQuery Smart Cart 3 (http://techlaboratory.net/smartcart/documentation).

# Demo
http://dudul.xyz/shop

# Download and Setup
1. Download the ZIP file.
2. Create folder named "shop" in WonderCMS plugins folder.
3. Unzip all folders and files from zip file in to created folder.

# Install instructions
Copy URL to ZIP file: 
Paste URL in Settings->Themes & plugins
#Put the code below in your theme.php anywhere you want to display it
Change Paypal Email your.email@example.com to your actual email

	<section class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Products
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <!-- BEGIN PRODUCTS -->
					        <?php
								$i=0;
								foreach ($_SESSION['productList'] as $product) {
							?>
                            <div class="col-md-4 col-sm-6">
                                <div class="sc-product-item thumbnail">
                                    <img data-name="product_image" src="<?=$product['images']?>" alt="...">
                                    <div class="caption">
                                        <h4 data-name="product_name"><?=$product['productName']?></h4>
                                        <p data-name="product_desc"><?=$product['description']?></p>
                                        <hr class="line">
                                            <div class="form-group2">
                                                <input class="sc-cart-item-qty" name="product_quantity" min="1" value="1" type="number">
                                            </div>
                                           <h4 class="price pull-left">$ <?=$product['price']?></h4>
                                            <input name="product_price" value="<?=$product['price']?>" type="hidden" />
                                            <input name="product_id" value="12" type="hidden" />
                                            <button class="sc-add-to-cart btn btn-success btn-sm pull-right">Add to cart</button>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                            <!-- END PRODUCTS -->
                            <?php $i++; } ?>	
                        </div>
                    </div>
                </div>
            </div>
            
            <aside class="col-md-4">
                
                <!-- Paypal Submit URL : https://www.paypal.com/cgi-bin/webscr -->
                <!-- Paypal Sandbox Submit URL: https://www.sandbox.paypal.com/cgi-bin/webscr -->      
                
                <!-- Paypal Cart submit form -->
                <form action="https://www.paypal.com/cgi-bin/webscr" method="POST"> 
                    <!-- SmartCart element -->
                    <div id="smartcart"></div>
                   
                    <!-- Paypal required info, Please update based on your details -->
                    <input name="business" value="your.email@example.com" type="hidden">            
                    <input name="currency_code" value="USD" type="hidden">
                    <input name="return" value="http://www.dudul.xyz/success" type="hidden">  <!--  Success Url -->
                    <input name="cancel_return" value="http://www.dudul.xyz/cancel" type="hidden">  <!--  Cancel Url -->
                    <input name="cmd" value="_cart" type="hidden">    
                    <input name="upload" value="1" type="hidden">            
                </form>
				
            </aside>
        </div>
    </section>	

# Display form on a specific page
Add Before <section>
	<?php if (wCMS::$currentPage == 'shop'): ?>

Add Code Before </section>
	<?php endif ?>
	
Change 'shop' in the code below and add it to your theme.php (to show it on that specific page)
Make sure 'shop' exists.

#Password Admin editor
default is admin212


# Features
- Image Upload.
- Suports Version WonderCMS-2.x.x.
- Admin Area.
- Product Editor ( Create , Update, Edit, Delete ).
- Paypal Checkout.

# Update
 - Demo version.
