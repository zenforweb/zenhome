<?php
/*
*	Books :: Index
*
*/
?>

<script type="text/javascript">
	<? 
	// setup typeahead for Book search
	$book_list_js = '';
	foreach ($books_search as $book) { $book_list_js .= '"' . $book['title'] . '",'; } ?>

	jQuery(document).ready( function(){
		$('#bookSearchBox').typeahead({
			source: [<? echo $book_list_js; ?> ]
		});


		$('.book_search').change( function(){
			var form = $(this);
			window.location.href = base_url + 'apps/books/search/' + form.attr('name') + '/' +form.val();
		});

	});
</script>

<div id="wrap" class="container-fluid">
	<!-- Page Title -->
	<div class="row-fluid">
		<div class="span4">
			<h3>Books ( <? echo $book_count; ?> )</h3>
		</div>
			<?
			if( $userACL->hasPermission( 'edit_apps' ) ){ ?>
				<div class="span2 pull-right">
					<div class="dropdown pull-right">
						<? ?>
						<a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#">
							<i class="icon-white icon-chevron-down"></i> Options
						</a>
						<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
							<? if( $userACL->hasPermission( 'edit_books' ) ){ ?>
								<li><a href="#add_book" data-toggle="modal">Add Book</a></li>
								<li><a href="#add_author" data-toggle="modal">Add Author</a></li>
							<? } ?>
							<li><a href="<? echo base_url(); ?>apps/books/settings">Settings</a></li>
						</ul>
					</div>
				</div>
			<? } ?>
	</div>

	<div class="row-fluid">
		<!-- Book Recently Relesed -->
		<div class="span6 box">
			<div class="box-header header-gradient">
				<h2>Recently Released Books</h2>
				<div class="box-controls pull-right">
					<span class="icon-chevron-up"></span>
				</div>
			</div>
			<div class="box-body">
				<?
				foreach( $books_published as $book ){
					?>
					<div class="row-fluid">
						<div class="span2">
							<?
								if( $book['cover'] != '' ){
									?>
									<a href="<? echo base_url() . 'apps/books/info/' . $book['id']; ?>">
										<img src="<? echo base_url() . FRONT_END . $book_path . $book['cover']; ?>" />
									</a>
									<?
								}
							?>
						</div>
						<div class="span8">
							<a href="<? echo base_url() . 'apps/books/info/' . $book['id']; ?>">
								<h2><? echo $book['title']; ?></h2> 
							</a>
							<br />
							<a href="<? echo base_url() . 'apps/books/search/author/' . $book['author']['id']; ?>">
								<? echo $book['author']['full_name']; ?>
							</a>
							<br />
							<?
							if( count( $book['genres'] ) > 0 ){
								foreach( $book['genres'] as $genre ){
									echo '<a style="margin:3px;" class="badge badge-inverse" href="' . base_url() . 'apps/books/search/genre/' . $genre['id'] . '"> ' . $genre['name'] . '</a>';
								}						
							}
							?>						
							<br />
							Published <? echo $book['published']; ?>
							<p><? echo $book['desc']; ?></p>
							<?
							if( ! empty( $book['file'] ) ){
								?>
								<a href="<? echo base_url() . 'apps/books/download/' . $book['id']; ?>">
									<button class="btn btn-success btn-small">Download</button>
								</a>
								<?
							}
							?>
						</div>
					</div>
					<? 
				} ?>
			</div>
		</div>

		<!-- Book Search -->
		<div class="span6 box shadow">
			<div class="box-header header-gradient">
				<h2>Book Search</h2>
				<div class="box-controls pull-right">
					<span class="icon-chevron-up"></span>
				</div>
			</div>
			<div class="box-body">
				<div class="accordion" id="bookSearchAccordion">
				  <div class="accordion-group">
				    <div class="accordion-heading">
				      <a class="accordion-toggle" data-toggle="collapse" data-parent="#bookSearchAccordion" href="#collapseOne">
				        Search By Title
				      </a>
				    </div>
				    <div id="collapseOne" class="accordion-body collapse in">
				      <div class="accordion-inner">
								<input id="bookSearchBox" class="span12" />
				      </div>
				    </div>
				  </div>
				  <div class="accordion-group">
				    <div class="accordion-heading">
				      <a class="accordion-toggle" data-toggle="collapse" data-parent="#bookSearchAccordion" href="#collapseTwo">
				        Search By Author
				      </a>
				    </div>
				    <div id="collapseTwo" class="accordion-body collapse">
				      <div class="accordion-inner">
								<select name="author" class="book_search">
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
				  </div>
				  <div class="accordion-group">
				    <div class="accordion-heading">
				      <a class="accordion-toggle" data-toggle="collapse" data-parent="#bookSearchAccordion" href="#collapseThree">
				      	Search By Genre
				      </a>
				    </div>
				    <div id="collapseThree" class="accordion-body collapse">
				      <div class="accordion-inner">
								<select name="genre" class="book_search">
									<?
									foreach ( $genres as $genre ) {
										?>
										<option value="<? echo $genre->id; ?>"><? echo $genre->name; ?></option>
										<?
									}
									?>
								</select>
				      </div>
				    </div>
				  </div>				  
				</div>
			</div>
		</div>

		<!-- Book Recently Added -->
		<div class="span6 box shadow">
			<div class="box-header header-gradient">
				<h2>Recently Added Books</h2>
				<div class="box-controls pull-right">
					<span class="icon-chevron-up"></span>
				</div>
			</div>
			<div class="box-body">
				<?
				foreach ( $books_recent as $book ) {
					?>
					<div class="row-fluid">
						<div class="span2">
							<?
								if( $book['cover'] != '' ){
									?>
									<a href="<? echo base_url() . 'apps/books/info/' . $book['id']; ?>">
										<img src="<? echo base_url() . FRONT_END . $book_path . $book['cover']; ?>" />
									</a>
									<?
								}
							?>
						</div>
						<div class="span8">
							<a href="<? echo base_url() . 'apps/books/info/' . $book['id']; ?>">
								<h2><? echo $book['title']; ?></h2> 
							</a>
							- <? echo $book['author']['full_name']; ?>
							<br />
							Published <? echo $book['published']; ?>
							<p><? echo $book['desc']; ?></p>
							<?
							if( ! empty( $book['file'] ) ){
								?>
								<a href="<? echo base_url() . 'apps/books/download/' . $book['id']; ?>">
									<button class="btn btn-success btn-small">Download</button>
								</a>
								<?
							}
							?>
						</div>
					</div>
					<?
				}
				?>
			</div>
		</div>		
	</div>

</div>

<? if( $userACL->hasPermission( 'edit_books' ) ){ ?>
	<!-- MODEL: ADD BOOK -->
	<div class="modal fade" id="add_book">
		<div class="modal-header">
			<button class="close" data-dismiss="modal">x</button>
			<h3>Add a New Book</h3>
		</div>
		<form action="<? echo base_url(); ?>apps/books/save_book/" method="POST" enctype="multipart/form-data">
			<div class="modal-body">
				<fieldset>
					<div class="control-group">
						<label class="control-label" for="book_title">Book Title</label>
						<div class="controls">
							<input name="book_title" class="input-xlarge focused" id="book_title" type="text" value="">
					</div>
				</div>		
				<div class="control-group">
					<label class="control-label" for="book_author">Author Name</label>
					<div class="controls">
						<select name="book_author">
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
						<input name="book_published">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="book_genre">Genre</label>
					<div class="controls">
						<input name="book_genre" class="input-xlarge focused" id="book_title" type="text" value="">
						<span class="help-block">Comma separated</span>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="book_desc">Description</label>
					<div class="controls">
						<textarea name="book_desc" id="book_desc"></textarea>
					</div>
				</div>
			</fieldset>
		</div>
			<div class="modal-footer">
				<a data-dismiss="modal" href="#" class="btn">Close</a>
				<button type="submit" class="btn btn-primary">Save</button>
			</div>
		</form>
	</div>

	<!-- MODEL: ADD AUTHOR -->
	<div class="modal fade" id="add_author">
		<div class="modal-header">
			<button class="close" data-dismiss="modal">x</button>
			<h3>Add a New Author</h3>
		</div>
		<form action="<? echo base_url(); ?>apps/books/add_author/" method="POST" enctype="multipart/form-data">
			<div class="modal-body">
				<fieldset>
					<div class="control-group">
						<label class="control-label" for="book_title">Author's Name</label>
						<div class="controls row-fluid">
							<input name="author_first" class="span4 focused" id="author_first" type="text" placeholder="First Name">
							<input name="author_last" class="span4" id="author_last" type="text" placeholder="Last Name">
						</div>
					</div>	
					<div class="control-group">
						<label class="control-label" for="book_title">Author's Wikipedia Page</label>
						<div class="controls">
							<input name="author_wiki" class="input-xlarge span4" id="author_first" type="text" placeholder="http://en.wikipedia.org/wiki/Cory_Doctorow">
						</div>
					</div>	
				</fieldset>
			</div>
			<div class="modal-footer">
				<a data-dismiss="modal" href="#" class="btn">Close</a>
				<button type="submit" class="btn btn-primary">Save</button>
			</div>
		</form>
	</div>
<? } ?>