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
		$scanned_directory = array_diff(scandir($path), array('..', '.'));

		return $scanned_directory;
	}
}

?>