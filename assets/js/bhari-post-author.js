jQuery(document).ready(function($) {
	jQuery( ".bhari-post-author-author-box" ).tabs();



});

jQuery( document ).on('click', '.get-all-posts', function(event) {
	event.preventDefault();
	var btn           = jQuery(this);
	var author_id     = btn.attr('data-id') || '';
	// var file_url      = jQuery(this).attr('data-url');
	// var previewWindow = jQuery( this ).closest('._s-module-demo').find( '._s-module-demo-content' );
	// var file_parent   = previewWindow.find('.edit-html-wrap');
	// var editor_id     = previewWindow.find('pre').attr('id');

	// var editor    = ace.edit( editor_id );
	// var file_code =  encodeURI( editor.getSession().getValue() );

	// //	Processing start
	// btn.removeClass('dashicons-upload').addClass('dashicons-image-rotate _s-processing');
	
	jQuery( '.posts-list' ).slideUp( '3000' );

	jQuery.ajax({
		url: BhariPostAuthor.ajax_url,
		type: 'POST',
		data: {
			action: 'bhari_post_author_get_all_recent_posts',
			id: author_id,
		},
	})
	.done(function( response ) {
		console.log( 'result: ' + response );
		// console.log("success");
		jQuery('.posts-list').append( response ).slideDown( '3000', function() {

			btn.attr( 'disabled', 'disabled' );
			btn.html( 'No more posts.' );
			
		});
		
		
		//	Processing end
		// btn.removeClass('dashicons-image-rotate _s-processing').addClass('dashicons-yes _s-processing-success');
		// setTimeout(function() {
		// 	btn.removeClass('dashicons-yes _s-processing-success').addClass('dashicons-upload');
		// }, 700);
	})
	.fail(function() {
		console.log("error");
	})
	.always(function() {
		// console.log("complete");
	});
});

jQuery( document ).on('click', '.send-email', function(event) {
	event.preventDefault();
	var btn           = jQuery(this);
	// var author_id     = btn.attr('data-id') || '';
	// var file_url      = jQuery(this).attr('data-url');
	// var previewWindow = jQuery( this ).closest('._s-module-demo').find( '._s-module-demo-content' );
	// var file_parent   = previewWindow.find('.edit-html-wrap');
	// var editor_id     = previewWindow.find('pre').attr('id');

	// var editor    = ace.edit( editor_id );
	// var file_code =  encodeURI( editor.getSession().getValue() );

	// //	Processing start
	// btn.removeClass('dashicons-upload').addClass('dashicons-image-rotate _s-processing');
	
	// jQuery( '.posts-list' ).slideUp( '3000' );

	jQuery.ajax({
		url: BhariPostAuthor.ajax_url,
		type: 'POST',
		data: {
			action: 'bhari_post_author_send_email',
		},
	})
	.done(function( response ) {
		console.log( 'result: ' + response );
		// console.log("success");
		// jQuery('.posts-list').append( response ).slideDown( '3000', function() {

		// 	btn.attr( 'disabled', 'disabled' );
		// 	btn.html( 'No more posts.' );
			
		// });
	})
	.fail(function() {
		console.log("error");
	})
	.always(function() {
		// console.log("complete");
	});
	

});