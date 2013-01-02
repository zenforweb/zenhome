<?php
/*
*	Books :: Info
*
*/
?>

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
					<h4><? echo $book['author']['full_name']; ?></h4>
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
					<div class="controls">
						<input name="book_genre" class="input-xlarge focused" id="book_title" type="text" value="<? echo $book['genre']; ?>">
						<span class="help-block">Comma separated</span>
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
						!<input type="file" name="book_cover" value="<? echo $book['cover']; ?>">
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