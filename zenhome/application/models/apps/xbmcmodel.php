<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class XbmcModel extends CI_Model {

	function __construct() {
		parent::__construct();
		$this->load->database();
		$this->xbmc_videoDB = 'MyVideos60';
	}

// SELECT * FROM 
// 			`MyVideos60`.`episodeview`,
// 			`MyVideos60`.`tvshowview` 
// 			WHERE `episodeview`.`idShow` = `tvshowview`.`idShow` ORDER BY `episodeview`.`c05` DESC LIMIT 10

	public function recentTvShows(){
		$sql = "SELECT 
				`tvshowview`.`c00` AS 'show_name',
				`tvshowview`.`c06` AS 'show_art',
				`tvshowview`.`c08` AS 'show_genre',
				`tvshowview`.`c14` AS 'show_studio',
				`tvshowview`.`totalCount`,
				`tvshowview`.`watchedcount`,
				`episodeview`.`c00` AS 'episode_name',
				`episodeview`.`c01` AS 'episode_desc',
				`episodeview`.`c06` AS 'episode_art',
				`episodeview`.`c05` AS 'episode_aired',
				`episodeview`.`mpaa`,
				`episodeview`.`playCount`,
				`episodeview`.`strPath`,
				`episodeview`.`strFileName`
			FROM 
				`$this->xbmc_videoDB`.`episodeview`,
				`$this->xbmc_videoDB`.`tvshowview` 
			WHERE `episodeview`.`idShow` = `tvshowview`.`idShow` ORDER BY `episodeview`.`c05` DESC LIMIT 10";
		$query = $this->db->query( $sql );
		$shows = array();
		$i = 0;
		foreach( $query->result() as $row ){
			$art_urls = array();
			$art_urls['graphical'] = array();
			$art_urls['posters']   = array();
			if( $row->show_art != ''){
				$art_urls_raw = explode( 'http:', $row->show_art );
				foreach ($art_urls_raw as $url) {
					if( strpos( $url, 'graphical' ) !== false ) {
						
						$stripped_url = str_replace( '<thumb aspect="banner">',	'', $url 					);
						$stripped_url = str_replace( "<thumb aspect='>", 				'', $stripped_url	);
						$stripped_url = str_replace( '<thumb aspect=">', 				'', $stripped_url	);
						$stripped_url = str_replace( '<thumb aspect=', 					'', $stripped_url	);
						$stripped_url = str_replace( '<thumb>', 								'', $stripped_url	);
						$stripped_url = str_replace( '</thumb>', 								'', $stripped_url	);
						$art_urls['graphical'][] = 'http:' . $stripped_url;
					} elseif( strpos( $url, 'posters' ) !== false ){
						$stripped_url = str_replace('<thumb aspect="poster">', '', $url);
						$stripped_url = str_replace('</thumb>', '', $stripped_url);
						$art_urls['posters'][] = 'http:' . $url;
					}
				}
			}

			$shows[$i] = array(
				'show_name'  					=> $row->show_name,
				'show_art' 						=> $art_urls,
				'show_genre'					=> $row->show_genre,
				'show_studio'					=> $row->show_studio,
				'show_episode_count'	=> $row->totalCount,
				'show_play_count'			=> $row->watchedcount,
				'episode_name'  			=> $row->episode_name,
				'episode_desc'				=> $row->episode_desc,
				'epidsode_art'  			=> $row->episode_art,
				'episode_aired' 			=> $row->episode_aired,
				'episode_mpaa'				=> $row->mpaa,				
				'episode_play_count'	=> $row->playCount,
				'episode_path'				=> $row->strPath . $row->strFileName,
			);
			$i++;
		}
		return $shows;
	}

}