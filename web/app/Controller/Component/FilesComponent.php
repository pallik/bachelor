<?php

class FilesComponent extends Component {


	/**
	 * get directory list files
	 * exclude '.', '..'
	 *
	 * @param $path
	 * @return array
	 */
	public function getDirFiles($path) {
		$scanned_directory = array_diff(scandir($path), array('..', '.', 'thumb'));

		return $scanned_directory;
	}

	/**
	 * @param $formData
	 * @return SimpleXMLElement
	 */
	public function getYoutubeToken($formData) {
		$video_title = $formData['Attachment']['name'];
		$video_description = $formData['Attachment']['text'];

		$youtube_email = "palli@kominak.sk"; // Change this to your youtube sign in email.
		$youtube_password = "flash5flash"; // Change this to your youtube sign in password.
		$key = "AI39si6KHEDR4RtxM9uIAe3ZBMd7bmX5edEn9iUtPYxTbQsvBfFosswBasi53KJSwmML1J_RDwRhWatJxTKKKPe2H0q3i6E7-g";
//		 Developer key: Get your key here: http://code.google.com/apis/youtube/dashboard/.

//		$youtube_email = "synchronized.presentations@gmail.com"; // Change this to your youtube sign in email.
//		$youtube_password = "5ynchr0n1z3d"; // Change this to your youtube sign in password.
//		$key = "AI39si7keFiaZ7u8Zk_LJVOHw76he2ekay94cUj9sFLzbTNTtx7v79ysgfiHTRdvqcN-yZvVXlhfORq03CFXGKHi_Y872qH1RQ";

		$source = 'synchronized.presentations'; // A short string that identifies your application for logging purposes.
		$postdata = "Email=".$youtube_email."&Passwd=".$youtube_password."&service=youtube&source=" . $source;
		$curl = curl_init( "https://www.google.com/youtube/accounts/ClientLogin" );
		curl_setopt( $curl, CURLOPT_HEADER, "Content-Type:application/x-www-form-urlencoded" );
		curl_setopt( $curl, CURLOPT_POST, 1 );
		curl_setopt( $curl, CURLOPT_POSTFIELDS, $postdata );
		curl_setopt( $curl, CURLOPT_SSL_VERIFYPEER, 0 );
		curl_setopt( $curl, CURLOPT_RETURNTRANSFER, 1 );
		curl_setopt( $curl, CURLOPT_SSL_VERIFYHOST, 2 );
		$response = curl_exec( $curl );
		curl_close( $curl );

		list( $auth, $youtubeuser ) = explode( "\n", $response );
		list( $authlabel, $authvalue ) = array_map( "trim", explode( "=", $auth ) );
		list( $youtubeuserlabel, $youtubeuservalue ) = array_map( "trim", explode( "=", $youtubeuser ) );

		$youtube_video_title = $video_title; // This is the uploading video title.
		$youtube_video_description = $video_description; // This is the uploading video description.
		$youtube_video_keywords = "synchronized, presentations, lessons, courses"; // This is the uploading video keywords.
		$youtube_video_category = "Education"; // This is the uploading video category. There are only certain categories that are accepted. See below

		$data = '<?xml version="1.0"?>
                <entry xmlns="http://www.w3.org/2005/Atom"
                  xmlns:media="http://search.yahoo.com/mrss/"
                  xmlns:yt="http://gdata.youtube.com/schemas/2007">
                  <media:group>
                    <media:title type="plain">' . stripslashes( $youtube_video_title ) . '</media:title>
                    <media:description type="plain">' . stripslashes( $youtube_video_description ) . '</media:description>
                    <media:category
                      scheme="http://gdata.youtube.com/schemas/2007/categories.cat">'.$youtube_video_category.'</media:category>
                    <media:keywords>'.$youtube_video_keywords.'</media:keywords>
                  </media:group>
                </entry>';

		$headers = array( "Authorization: GoogleLogin auth=".$authvalue,
			"GData-Version: 2",
			"X-GData-Key: key=".$key,
			"Content-length: ".strlen( $data ),
			"Content-Type: application/atom+xml; charset=UTF-8" );

		$curl = curl_init( "http://gdata.youtube.com/action/GetUploadToken");
		curl_setopt( $curl, CURLOPT_USERAGENT, $_SERVER["HTTP_USER_AGENT"] );
		curl_setopt( $curl, CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $curl, CURLOPT_TIMEOUT, 10 );
		curl_setopt( $curl, CURLOPT_SSL_VERIFYPEER, false );
		curl_setopt( $curl, CURLOPT_POST, 1 );
		curl_setopt( $curl, CURLOPT_FOLLOWLOCATION, 1 );
		curl_setopt( $curl, CURLOPT_HTTPHEADER, $headers );
		curl_setopt( $curl, CURLOPT_POSTFIELDS, $data );
		curl_setopt( $curl, CURLOPT_REFERER, true );
		curl_setopt( $curl, CURLOPT_FOLLOWLOCATION, 1 );
		curl_setopt( $curl, CURLOPT_HEADER, 0 );

		$response = simplexml_load_string( curl_exec( $curl ) );
		curl_close( $curl );

		return $response;
	}
}

?>