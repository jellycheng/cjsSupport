<?php
namespace CjsSupport\DataManage;

class SeoData extends Data {

	public function setTitle($title) {
		$this->set('title', $title);
		return $this;
	}

	public function setKeywords($keywords) {
		$this->set('keywords', $keywords);
		return $this;
	}


	public function setDescription($description) {
		$this->set('description', $description);
		return $this;
	}

}


