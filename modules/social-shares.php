
add_action( 'tha_content_while_before', function() {
	if( is_single() ) {
		?>
			<style type="text/css">
				.bhari-social-shares.top ul {
				    position: absolute;
				}
				.bhari-social-shares ul {
				    padding: 0;
				}
				.bhari-social-shares.top li {
				    margin-bottom: 0.5em;
				}
				.bhari-social-shares li {
				    list-style-type: none;
				}
				.bhari-social-shares a {
				    background: #fff;
				    height: 2.5em;
				    width: 2.5em;
				    line-height: 2.5em;
				    display: inline-block;
				    text-align: center;
				    vertical-align: middle;
				    font-size: 1rem;
				    font-weight: normal;
				}
				.bhari-social-shares.top {
				    position: absolute;
				    left: -3em;
				    top: 0em;
				}
				.bhari-social-shares.top span {
				    margin-bottom: 0.5em;    
				}
				.bhari-social-shares span {
				    font-size: 1rem;
				    font-weight: normal;
				    color: #838383;
				    display: inline-block;
				}
			</style>
			<div class="bhari-social-shares top">
			  	<span>Share:</span>
		  		<ul>
					<li><a href="#"> <i class="fa fa-facebook"></i> </a></li>
					<li><a href="#"> <i class="fa fa-twitter"></i> </a></li>
					<li><a href="#"> <i class="fa fa-google-plus"></i> </a></li>
				</ul>
			</div>
		<?php
	}
} );

add_action( 'tha_pagination_before', function() {
	if( is_single() ) {
		?>
			<style type="text/css">
				.bhari-social-shares.bottom li {
					display: inline-block;
				}
				.bhari-social-shares.bottom {
				    margin-top: -1em;
				    margin-bottom: 2em;
				}
			</style>
			<div class="bhari-social-shares bottom">
			  	<span>Share:</span>
		  		<ul>
					<li><a href="#"> <i class="fa fa-facebook"></i> </a></li>
					<li><a href="#"> <i class="fa fa-twitter"></i> </a></li>
					<li><a href="#"> <i class="fa fa-google-plus"></i> </a></li>
				</ul>
			</div>
		<?php
	}
} );