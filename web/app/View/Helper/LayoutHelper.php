<?php
/**
 * Created by IntelliJ IDEA.
 * User: palli
 * Date: 2/28/13
 * Time: 11:57 AM
 * To change this template use File | Settings | File Templates.
 */ 
class LayoutHelper extends AppHelper {

/**
* Other helpers used by this helper
*
* @var array
* @access public
*/
	public $helpers = array(
		'Html',
		'Form',
		'Session',
		'Js',
	);



/**
 * Status
 *
 * instead of 0/1, show tick/cross
 *
 * @param integer $value 0 or 1
 * @return string formatted img tag
 */
	public function status($value) {
		if ($value == 1) {
			$output = $this->Html->image('/img/icons/tick.png');
		} else {
			$output = $this->Html->image('/img/icons/cross.png');
		}
		return $output;
	}

	/**
	 * @param $blocks
	 * @return array
	 */
	public function getLessonChapters($blocks) {
		$chapters = array();

		foreach ($blocks as $block) {
			foreach ($block['Timestamp'] as $timestamp) {
				if ($timestamp['chapter']) {
					$chapters[$timestamp['start']] = array(
						'name' => $timestamp['chapter'],
						'start' => $timestamp['start'],
						'end' => $timestamp['end']
					);
				}
			}

		}

		ksort($chapters);
		return $chapters;
	}

	/**
	 * @param $timestamp
	 * @return string
	 */
	public function getThumbnailForScroller($timestamp) {

		$output = '';
		switch($timestamp['Attachment']['Type']['name']) {
			case 'image':
				$output = $this->imageForScroller($timestamp);
				break;
			case 'text':
				$output = $this->textForScroller($timestamp);
				break;
			case 'video':
				break;
			default:
				break;
		}

		return $output;
	}

	/**
	 * @param $timestamp
	 * @return mixed
	 */
	private function imageForScroller($timestamp) {
		$urlInfo = pathinfo($timestamp['Attachment']['url']);
		$thumbUrl = $urlInfo['dirname'] . DS . 'thumb' . DS . $urlInfo['basename'];

		return $this->Html->image($thumbUrl, array(
				'width' => '100',
			));
	}

	/**
	 * @param $timestamp
	 * @return mixed
	 */
	private function textForScroller($timestamp) {
		return $timestamp['Attachment']['name'];
	}
}
