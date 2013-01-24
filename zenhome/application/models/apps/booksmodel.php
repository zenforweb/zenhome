<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class BooksModel extends CI_Model {

	function __construct() {
		parent::__construct();
		$this->load->database();
	}

	public function saveBook( $book, $book_id = Null ){
		$title     = isset( $book['book_title'] )     ? $this->db->escape( $book['book_title'] )  	     : '';
		$author    = isset( $book['book_author'] )    ? $this->db->escape( $book['book_author'] ) 	     : '';
		$desc      = isset( $book['book_desc'] )      ? $this->db->escape( $book['book_desc'] )				   : '';
		$genre     = isset( $book['book_genre'] )     ? $this->format_genre_sql( $book['book_genre'] )	 : '';
		$published = isset( $book['book_published'] ) ? $this->db->escape( $book['book_published'] )	   : '';
		$added     = $this->db->escape( date( 'Y-m-d H:i:s' ) );
		$cover     = ( isset( $book['book_cover'] )  && !empty( $book['book_cover'] ) )   ? $this->db->escape( $book['book_cover'] )      : Null;
		$file      = ( isset( $book['book_file']  )  && !empty( $book['book_file']  )  )  ? $this->db->escape( $book['book_file'] )       : Null;

		if( empty( $book_id ) ){
			$sql = "INSERT INTO `". DB_NAME ."`.`app_books` ( `title`, `author`, `desc`, `genre`, `published`, `added` ) 
				VALUES( $title, $author, $desc, $genre, $published, $added )";			
		} else {
			$book_id 	= $this->db->escape( $book_id );
			$added 		= ( isset( $book['book_added'] ) 			? $book['book_added']			: date( 'Y-m-d H:i:s' ) );
			$added 		= $this->db->escape( $added );
			$sql = "UPDATE `". DB_NAME ."`.`app_books` SET `title` = $title, `author` = $author, `desc` = $desc, `genre` = $genre, 
				`published` = $published, `added` = $added";
			if( !empty( $cover ) ){
				$sql .= ", `cover` = $cover ";
			}
			if( !empty( $file ) ){
				$sql .= ", `file` = $file ";
			}
			$sql .=	" WHERE `id` = $book_id";
		}
		return $this->getBook( $this->db->query( $sql ) );
	}

	public function getBooks( $by = Null ){
		$sql = "SELECT * FROM `". DB_NAME ."`.`app_books` ORDER BY ";
		if( $by == Null ){
			$sql .= "`published` DESC";
		} else {
			$sql .= "`".$by."` DESC LIMIT 15";
		}
		$query = $this->db->query( $sql );
		$books = array();
		$i  	 = 0;

		foreach( $query->result() as $row ){
			$books[$i]['id']        = $row->id;
			$books[$i]['title']     = $row->title;
			$books[$i]['desc']      = $row->desc;
			$books[$i]['published'] = $row->published;
			$books[$i]['genres']    = $this->getGenreInfo( $row->genre );
			$books[$i]['added']     = $row->added;
			$books[$i]['cover']     = $row->cover;
			$books[$i]['file']      =	$row->file;
			$books[$i]['author']    = $this->getAuthor( $row->author );
			$i++;
		}
		return $books;		
	}

	public function getBooksSlim(){
		$query = $this->db->query( "SELECT `id`, `title` FROM `". DB_NAME ."`.`app_books` ORDER BY `title`" );
		$books = array();
		$i  	 = 0;
		foreach( $query->result() as $row ){
			$books[$i]['id']        = $row->id;
			$books[$i]['title']     = $row->title;
			$i++;
		}
		return $books;		
	}

	public function getBook( $book_id ){
		$book_id = $this->db->escape( $book_id );
		$query   = $this->db->query( "SELECT * FROM `". DB_NAME ."`.`app_books` WHERE `id` = $book_id" );
		$result  = $query->result();
		$result  = $result[0];

		$book['id']        = $result->id;
		$book['title']     = $result->title;
		$book['desc']      = $result->desc;
		$book['published'] = $result->published;
		$book['genres']    = $this->getGenreInfo( $result->genre );
		$book['added']     = $result->added;
		$book['cover']     = $result->cover;
		$book['file']      = $result->file;
		$book['author']    = $this->getAuthor( $result->author );

		return $book;
	}

	public function searchBooks( $search_type, $parameter ){
		$sql = "SELECT * FROM `". DB_NAME ."`.`app_books` ";
		switch( $search_type ){
			case 'author':
				$sql .= "WHERE `author` = " . $this->db->escape( $parameter );
				break;
			case 'genre':
				$sql .= "WHERE FIND_IN_SET( " . $this->db->escape( $parameter ) . ", `genre` )";
				break;
			default:
				break;
		}
		$sql  .= " ORDER BY `published` DESC";
		$query = $this->db->query( $sql );
		$books = array();
		$i  	 = 0;
		foreach( $query->result() as $row ){
			$books[$i]['id']        = $row->id;
			$books[$i]['title']     = $row->title;
			$books[$i]['desc']      = $row->desc;
			$books[$i]['published'] = $row->published;
			$books[$i]['genres']    = $this->getGenreInfo( $row->genre );
			$books[$i]['added']     = $row->added;
			$books[$i]['cover']     = $row->cover;
			$books[$i]['file']      =	$row->file;
			$books[$i]['author']    = $this->getAuthor( $row->author );
			$i++;
		}
		return $books;
	}

	public function getBookCount(){
		$count  = $this->db->query( "SELECT COUNT(`id`) AS `count` FROM `". DB_NAME ."`.`app_books`" );
		$result = $count->result(); 
		return $result[0]->count;
	}

		//@todo make this private in the new working of this shit
			// this should probably be brought down into CI_Controller or something, lower down, then made available to Apps
	public function getDefaultBooksDir(){
		$current_dirs = explode( '/', __DIR__ );
		$dir_count = count( $current_dirs );

		$upload_dir = '';
		foreach ($current_dirs as $key => $dir) {
			if( $key < $dir_count - 3){
				$upload_dir .= '/' . $dir ;
			}
		}
		$upload_dir = $upload_dir . '/public_html/uploads/books';
		$upload_dir = substr($upload_dir, 1);
		if( ! is_dir( $upload_dir ) ){
			if( ! mkdir( $upload_dir, 0777, true ) ){
				//
			}
		}
		return $upload_dir . '/';
	}

	public function recordDownload( $book_id, $user_id ){
		$book_id   = $this->db->escape( $book_id );
		$user_id   = $this->db->escape( $user_id );
		$timestamp = $this->db->escape( date( 'Y-m-d H:i:s') );

		$sql = "INSERT INTO `". DB_NAME ."`.`app_books_downloads` ( `book_id`, `user_id`, `timestamp` ) 
			VALUES( $book_id, $user_id, $timestamp )";		
		$this->db->query( $sql );
	}

	public function addAuthors( $first_name, $last_name, $wiki ){
		$full_name  = $first_name . ' ' . $last_name;
		$full_name  = $this->db->escape( $full_name );
		$first_name = $this->db->escape( $first_name );
		$last_name  = $this->db->escape( $last_name );
		$wiki       = $this->db->escape( $wiki );

		$sql = "INSERT INTO `". DB_NAME ."`.`app_books_authors` ( `first_name`, `last_name`, `full_name`, `wikipedia_url` ) 
			VALUES( $first_name, $last_name, $full_name, $wiki )";		
		$this->db->query( $sql );
	}

	public function getAuthors(){
		$query = $this->db->query( "SELECT * FROM `". DB_NAME ."`.`app_books_authors` ORDER BY `last_name` ASC" );
		$authors = array();
		foreach( $query->result() as $row ){
			$authors[] = $row;
		}
		return $authors;
	}

	private function getAuthor( $author_id ){
		$query = $this->db->query( "SELECT * FROM `". DB_NAME ."`.`app_books_authors` WHERE `id` = $author_id " );
		$result = $query->result();
		$author = array();
		$author['id'] = $result[0]->id;
		$author['first_name'] = $result[0]->first_name;
		$author['last_name']  = $result[0]->last_name;
		$author['full_name']  = $result[0]->full_name;
		$author['wikipedia']  = $result[0]->full_name;
		return $author;
	}

	public function getGenres(){
		$query  = $this->db->query( "SELECT * FROM `". DB_NAME ."`.`app_books_genres` ORDER BY `name` ASC" );
		$genres = array();
		foreach( $query->result() as $row ){
			$genres[] = $row;
		}
		return $genres;
	}

	private function getGenreInfo( $genre_ids ){
		if( strstr( $genre_ids, ',' ) ){
			$genres_exploded = explode( ',', $genre_ids );
			$genres = array();
			foreach ( $genres_exploded as $genre_id ) {
				$sql      = "SELECT `name` FROM `". DB_NAME ."`.`app_books_genres` WHERE `id`= " . $genre_id;
				$query    = $this->db->query( $sql );
				$result   = $query->result();
				$genres[] = array( 'id' => $genre_id, 'name'=> $result[0]->name );
			}
			return $genres;
		} else {
			if( empty( $genre_ids ) )
				return;
			$sql       = "SELECT `name` FROM `". DB_NAME ."`.`app_books_genres` WHERE `id`=" . $genre_ids;
			$query     = $this->db->query( $sql );
			$result    = $query->result();
			$return    = array();
			$return[0] = array( 'id' => $genre_ids, 'name' => $result[0]->name );
			return $return;
		}
	}
	
	private function format_genre_sql( $genre ){
		$formated_genre_string = '';
		if( is_array( $genre ) ){
			foreach ( $genre as $label ) {
				$formated_genre_string .= $label . ',';
			}
			$formated_genre_string = substr( $formated_genre_string, 0, -1 );
		}
		return "'".$formated_genre_string."'";
	}

}