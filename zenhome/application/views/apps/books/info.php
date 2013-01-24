<?php
/*
*	Books :: Info
*
*/
?>

<script type="text/javascript">
	jQuery('document').ready(function($){ 
		$('.multiselect-select').change( function(){
			//@todo: remove selected item from multi-select
			var select_form    = $(this),
					select_box     = select_form.parent('.multiselect-box'),
					select_inputs  = select_box.find('.multiselect-inputs'),
					select_display = select_box.find('.multiselect-display');

			var input_to_add = '<input type="" id="book_genre_input_id_'+ select_form.val() +'" name="book_genre[]" value="' + select_form.val() + '" >',		
			    text_to_add  = '<li id="book_genre_text_id_'+ select_form.val()  +'"><span class="pull-left">' + select_form.find("option:selected").text() + '</span><span class="pull-right btn btn-danger btn-mini remove-select">x</span></li>';    
			$('.multiselect-inputs').append( input_to_add );
			$('.multiselect-display').append( text_to_add );
		});

		$('.remove-select').click( function(){
			//@todo: this does not remove js added input forms or text yet!
			var btn           = $(this),
					select_id     = $(this).parent('li').attr('id').split( 'book_genre_text_id_').pop();
			console.log( select_id );
			$('#book_genre_input_id_' + select_id  ).remove();
			btn.parent('li').remove();
		});
	});
</script>

<style type="text/css">
	.multiselect-display{
		list-style-image: none;
	}
</style>
<div id="wrap" class="container-fluid">
	<!-- Page Title -->
	<div class="row-fluid">
		<div class="span4">
			<h3>Books</h3>
		</div>
		<div class="span2 pull-right">
			<div class="dropdown pull-right">
				<a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#">
					<i class="icon-white icon-chevron-down"></i> Options
				</a>
				<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
					<li><a href="<? echo base_url(); ?>apps/books">Books</a></li>
					<? if( $userACL->hasPermission( 'edit_books' ) ){ ?><li><a href="#edit_book" data-toggle="modal">Edit Book</a></li><? } ?>
					<? if( $userACL->hasPermission( 'edit_apps' ) ){ ?><li><a href="<? echo base_url(); ?>apps/books/settings">Settings</a></li><? } ?>
				</ul>
			</div>
		</div>
	</div>

	<div class="row-fluid">
		<div class="span12 box shadow">
			<div class="box-header header-gradient">
				<div class="box-controls pull-right">
					<span class="icon-chevron-up"></span>
				</div>
			</div>
			<div class="box-body">
				<div class="span4">
					<img src="<? echo base_url() . FRONT_END . $book_path . $book['cover']; ?>" />
				</div>
				<div class="span6">
					<h3><? echo $book['title']; ?></h3>
					<h4><a href="<? echo base_url() . 'apps/books/search/author/' . $book['author']['id']; ?>"><? echo $book['author']['full_name']; ?></a></h4>
					<?
					if( count( $book['genres'] ) > 0 ){
						foreach( $book['genres'] as $genre ){
							echo '<a style="margin:3px;" class="btn btn-inverse btn-mini" href="' . base_url() . 'apps/books/search/genre/' . $genre['id'] . '"> ' . $genre['name'] . '</a>';
						}						
					}
					?>

					<br />
					Published <? echo $book['published']; ?>					
					<p><? echo $book['desc']; ?></p>
				</div>
				<div class="span2">
					<?
					if( ! empty( $book['file'] ) ){
						?>
						<a href="<? echo base_url() . 'apps/books/download/' . $book['id']; ?>">
							<button class="btn btn-success">Download</button>
						</a>
						<?
					}
					?>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- MODEL: EDIT BOOK -->
<div class="modal fade" id="edit_book">
	<div class="modal-header">
		<button class="close" data-dismiss="modal">x</button>
		<h3>Edit: <? echo $book['title']; ?></h3>
	</div>
	<form action="<? echo base_url(); ?>apps/books/save_book/<? echo $book['id']; ?>" method="POST" enctype="multipart/form-data">
		<div class="modal-body">
			<fieldset>
				<div class="control-group">
					<label class="control-label" for="book_title">Book Title</label>
					<div class="controls">
						<input name="book_title" class="input-xlarge focused" id="book_title" type="text" value="<? echo $book['title']; ?>">
					</div>
				</div>		
				<div class="control-group">
					<label class="control-label" for="book_author">Author Name</label>
					<div class="controls">
						<select name="book_author">
							<option value="<? echo $book['author']['id']; ?>"><? echo $book['author']['full_name']; ?></option>
							<?
							foreach ( $authors as $author ) {
								?>
								<option value="<? echo $author->id; ?>"><? echo $author->full_name; ?></option>
								<?
							}
							?>
						</select>
					</div>
				</div>
				<div class="control-group">
					<label for="book_published">Published Date:</label>
					<div class="controls">
						<input name="book_published" value="<? echo $book['published']; ?>">
					</div>
				</div>

				<div class="control-group">
					<label class="control-label" for="book_genre">Genre</label>
					<div class="controls" class="multiselect-box span6">
						
						<select name="book_genre_list" class="multiselect-select">
							<option value=""></option>
							<?
							foreach( $genres as $genre ){
								$show_genre = True;
								foreach( $book['genres'] as $book_genre){
									if($book_genre['id'] == $genre->id ){
										$show_genre = False;
									}
								}
								if( $show_genre ){
									echo '<option id="book_genre_id_' . $genre->id . '" value="'. $genre->id .'">' . $genre->name . '</option>';								
								}
							}
							?>
						</select>

						<div class="multiselect-inputs">
							<?
							if( count( $book['genres'] ) > 0 ){
								foreach ( $book['genres'] as $genre ) {
									echo '<input type="" id="book_genre_input_id_'. $genre['id'] .'" name="book_genre[]" value="'. $genre['id'] .'">';	
								}
							} else {
								echo '<input type="text" name="book_genre" value="">';
							}
							?>
						</div>

						<ul class="multiselect-display">
							<?
							if( count( $book['genres'] ) > 0 ){
								foreach ( $book['genres'] as $genre ) {
									echo '<li id="book_genre_text_id_'. $genre['id'].'"><span class="pull-left">'. $genre['name'].'</span>
										<span class="pull-right btn btn-danger btn-mini remove-select">x</span></li>';	
								}
							}
							?>
						</ul>

					</div>
				</div>

				<div class="control-group">
					<label class="control-label" for="book_desc">Description</label>
					<div class="controls">
						<textarea name="book_desc" id="book_desc"><? echo $book['desc']; ?></textarea>
					</div>
				</div>						
				<div class="control-group">
					<label for="book_cover">Book Cover:</label>
					<div class="controls">
						<input type="file" name="book_cover" value="<? echo $book['cover']; ?>">
					</div>
				</div>	
				<div class="control-group">
					<label for="book_file">Book File:</label>
					<div class="controls">
						<input type="file" name="book_file" value="<? echo $book['file']; ?>">
					</div>
				</div>
				<input type="hidden" name="book_added" value="<? echo $book['added']; ?>"/>
			</fieldset>
		</div>
		<div class="modal-footer">
			<a data-dismiss="modal" href="#" class="btn">Close</a>
			<button type="submit" class="btn btn-primary">Save</button>
		</div>
	</form>
</div>