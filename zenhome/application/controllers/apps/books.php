<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Books extends MY_Controller {

	/**    
	 *	 _____         _       
	 *	| __  |___ ___| |_ ___ 
	 *	| __ -| . | . | '_|_ -|
	 *	|_____|___|___|_,_|___|
	 *
	 * 	Allows you to manage an ePUB collection.
	 *
	 *	 ____ FILE MANIFEST ___________________________________________________
	 *	|		/application/controllers/apps/books                 CONTROLLER
	 *	|		/application/models/apps/booksmodel.php             MODEL
	 *	|		/application/views/apps/books/index.php             VIEW
	 *	|		/application/views/apps/books/edit.php              VIEW	 
	 *	|		/application/views/apps/books/settings.php			VIEW
	 *	|		/application/views/apps/books/user_settings.php     VIEW
	 *
	 *			
	 *	 ___ APPP USER SETTINGS _____________
	 *	|		enabled 				@bool
	 */

	public function __construct(){
		parent::__construct();
		$this->load->model('AppsModel');
		$this->app_id    = $this->AppsModel->getAppID('books');
		$this->book_path = 'uploads/books/'; 		//@todo: update to pull from app setting
		//$this->userAppSet = $this->AppsModel->getUserAppSettings( $this->app_id, $this->user['user_id']);
	}

	public function test_func(){
		$this->load->model('apps/BooksModel');
		echo $this->BooksModel->getDefaultBooksDir();
		die();
	}

	/**
	* Method which will render the Apps landing page
	*
	*/
	public function index(){
		$this->load->model('apps/BooksModel');
		$data = array(
			'authors'         => $this->BooksModel->getAuthors(),
			'books_published' => $this->BooksModel->getBooks(),
			'books_recent'    => $this->BooksModel->getBooks( 'added' ),
			'book_path'       => 'uploads/books/',
		);
		$this->view( 'apps/books/index', $data );
	}

	/**
	* Method which will render the settings for an App
	*
	*/
	public function settings(){
		$this->view( 'apps/books/settings' );
	}

	/**
	* Add a new book to the DB
	*
	*/
	public function save_book( $book_id = Null ){
		$book = array();
		$book['book_id']		= isset( $book_id ) ? $book_id : '';
		$book['book_title']     = $_REQUEST['book_title'];
		$book['book_author']    = $_REQUEST['book_author'];
		$book['book_desc']      = $_REQUEST['book_desc'];
		$book['book_genre']     = $_REQUEST['book_genre'];
		$book['book_published'] = $_REQUEST['book_published'];
		$book['book_added']     = ( isset( $_REQUEST['book_added'] ) ? $_REQUEST['book_added'] : "" );

		if( $_REQUEST['book_title'] == '' || $_REQUEST['book_author'] == '' ){
			$this->setMessage('error', 'You didnt specify a title');
			$this->redirect( 'apps/books' );	
		}

		$this->load->model('apps/BooksModel');

		$book = $this->save_book_files( $book );

		if( $book_id == Null ){
			$this->BooksModel->saveBook( $book );	
			$this->setMessage('success', 'Book was added');
		} else {
			$this->BooksModel->saveBook( $book, $book_id );
			$this->setMessage('info', 'Book was updated');
			redirect( 'apps/books/info/' . $book_id );
		}
		redirect( 'apps/books/' );
	}

	private function save_book_files( $book ){
		if( isset( $_FILES['book_cover']) && !empty( $_FILES['book_cover'] ) ){
			$book['book_cover'] = $this->upload_file( $_FILES['book_cover'], $this->BooksModel->getDefaultBooksDir(), $book['book_id'], True );
		}
		if( isset( $_FILES['book_file']) && !empty( $_FILES['book_file'] ) ){
			$book['book_file'] = $this->upload_file( $_FILES['book_file'], $this->BooksModel->getDefaultBooksDir(), $book['book_id'], True );
		}		
		return $book;
	}

	/**
	* @todo move this down to a helper so all apps can benifit from it
	*
	* @param
	*	$file       : array() : $_FILES 
	*	$path       : string  : full path to where to upload the file
	* 	$file_name  : string  : new file name without extension
	*	$overwrite  : bool    : overwrite the file if exists or no
	*	$extensions : array() : accepted file extensions
	*
	* @return string : new file name with extension
	*/
	public function upload_file( $file, $path, $file_name, $overwrite = False, $extensions = Null ){

		//function to check if $path exists, create if it doesnt


		if( $extensions == Null ){
			$extensions = array( 'jpg', 'jpeg', 'gif', 'png', 'epub', 'zip' );
		}

		$file_extension_array = explode( '.',  $file['name'] );
		$file_extension_array = array_reverse( $file_extension_array );
		$file_extension = $file_extension_array[0];


		//@todo kick out if they suck
		try {
			move_uploaded_file(  $file['tmp_name'], $path . $file_name . '.' . $file_extension );
		}
		catch( Exception $e ){

			//	alix data dump	{debug}	
			echo "<pre>"; print_r( $e ); die();

		 }

		return $file_name . '.'  . $file_extension;
	}

	/**
	* Get book info
	*
	*/
	public function info( $book_id ){
		$this->load->model('apps/BooksModel');
		$data = array(
			'book' 		=> $this->BooksModel->getBook( $book_id ),
			'authors'   => $this->BooksModel->getAuthors(),
			'book_path' => $this->book_path,
		);
		$this->view( 'apps/books/info', $data );
	}


	/**
	* Download the book and track it
	*
	*/
	public function download( $book_id ){
		$this->load->model('apps/BooksModel');
		$book = $this->BooksModel->getBook( $book_id );
		$book_file = base_url() . FRONT_END .'uploads/books/'. $book['file'];
		$this->BooksModel->recordDownload( $book_id, $_SESSION['user_id'] );
		//@todo: this currently doesnt work for iOS because of a bad zip header
		header( 'Content-type: "application/epub+zip"' );		
		header( 'Content-Disposition: attachment; filename="'. slug_out( $book['title'] ) . '.epub"' );
		readfile( $book_file );		
	}

	/**
	* Add a new author to the DB
	*
	*/
	public function add_author(){
		$this->load->model('apps/BooksModel');
		$this->BooksModel->addAuthors( $_REQUEST['author_first'], $_REQUEST['author_last'], $_REQUEST['author_wiki'] );
		$this->setMessage('success', 'Added Author');
		redirect( 'apps/books' );
	}

}

/* End of file books.php */
/* Location: ./application/controllers/apps/books.php */