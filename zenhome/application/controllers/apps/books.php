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
	 *	|    /application/controllers/apps/books                 CONTROLLER
	 *	|    /application/models/apps/booksmodel.php             MODEL
	 *	|    /application/views/apps/books/index.php             VIEW
	 *	|    /application/views/apps/books/info.php              VIEW	 
	 *	|    /application/views/apps/books/settings.php          VIEW
	 *	|    /application/views/apps/books/user_settings.php     VIEW
	 *
	 *
	 *	 ___ APPP SETTINGS ___________________
	 *	|  book_path         	 @bool
	 *
	 *
	 *	 ___ APPP USER SETTINGS ______________
	 *	|  enabled               @bool
	 */

	public function __construct(){
		parent::__construct();
		$this->load->model('AppsModel');
		$this->app_id    = $this->AppsModel->getAppID('books');
		$this->book_path = 'uploads/books/'; 		// @todo: update to pull from app setting
		//$this->userAppSet = $this->AppsModel->getUserAppSettings( $this->app_id, $this->user['user_id']);
	}

	/**
	* Method which will render the book landing page
	*
	*/
	public function index(){
		$this->load->model('apps/BooksModel');
		$data = array(
			'authors'         => $this->BooksModel->getAuthors(),
			'genres'          => $this->BooksModel->getGenres(),
			'books_published' => $this->BooksModel->getBooks(),
			'books_recent'    => $this->BooksModel->getBooks( 'added' ),
			'books_search'    => $this->BooksModel->getBooksSlim(),
			'book_path'       => 'uploads/books/',
			'book_count'	  => $this->BooksModel->getBookCount(),
		);
		$this->view( 'apps/books/index', $data );
	}

	public function search( $search_type, $parameter ){
		$this->load->model('apps/BooksModel');
		$data = array(
			'books'       => $this->BooksModel->searchBooks( $search_type, $parameter ),
			'book_path'   => 'uploads/books/',
			'search_type' => $search_type,
		);
		$this->view( 'apps/books/search', $data );
	}

	/**
	* Get book info
	*
	*/
	public function info( $book_id ){
		$this->load->model('apps/BooksModel');
		$data = array(
			'book'      => $this->BooksModel->getBook( $book_id ),
			'authors'   => $this->BooksModel->getAuthors(),
			'genres'		=> $this->BooksModel->getGenres(),
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
		$book_file = $this->BooksModel->getDefaultBooksDir() . $book['file'];
		$this->BooksModel->recordDownload( $book_id, $_SESSION['user_id'] );
		//@todo: this currently doesnt work for iOS because of a bad zip header
		//@todo: doesnt properly add .epub to download
		header('Content-type: application/epub+zip');
		header('Content-disposition:attachment;filename="'. slug_out( $book['title'] ) . '.epub"');
		header('Content-Transfer-Encoding: binary');
		readfile( $book_file );
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
	* or update if $book_id is passed
	*
	*/
	public function save_book( $book_id = Null ){
		$book = array();
		$book['book_id']		= isset( $book_id ) ? $book_id : '';
		$book['book_title']     = $_REQUEST['book_title'];
		$book['book_author']    = $_REQUEST['book_author'];
		$book['book_desc']      = $_REQUEST['book_desc'];
		$book['book_genre']     = isset( $_REQUEST['book_genre'] )   ? $_REQUEST['book_genre'] : '';
		$book['book_published'] = $_REQUEST['book_published'];
		$book['book_added']     = isset( $_REQUEST['book_added'] )   ? $_REQUEST['book_added'] : '';

		if( $_REQUEST['book_title'] == '' || $_REQUEST['book_author'] == '' ){
			$this->setMessage('error', 'You didnt specify a title');
			$this->redirect( 'apps/books' );
		}

		$this->load->model('apps/BooksModel');

		if( $book_id == Null ){
			$this->BooksModel->saveBook( $book );	
			$this->setMessage('success', 'Book was added');
		} else {
			$book = $this->save_book_files( $book );
			$this->BooksModel->saveBook( $book, $book_id );
			$this->setMessage('info', 'Book was updated');
			redirect( 'apps/books/info/' . $book_id );
		}
		redirect( 'apps/books/' );
	}

	private function save_book_files( $book ){
		$this->load->helper('upload');
		$books_dir = $this->BooksModel->getDefaultBooksDir();
		if( isset( $_FILES['book_cover'] ) && $_FILES['book_cover']['error'] == 0 ){
			$book['book_cover'] = upload_zenhome_file( $_FILES['book_cover'], $books_dir, $book['book_id'], True );
		}
		if( isset( $_FILES['book_file'] ) && $_FILES['book_file']['error'] == 0 ){
			$book['book_file'] = upload_zenhome_file( $_FILES['book_file'], $books_dir, $book['book_id'], True );
		}
		return $book;
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