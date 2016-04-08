<?php 

namespace App\Http; 

class Flash {

	/**
	 * [create description]
	 * @param  [type] $title   [description]
	 * @param  [type] $message [description]
	 * @param  [type] $level   [description]
	 * @return [type]          [description]
	 */
	public function create($title, $message, $level, $key = 'flash_message')
	{
		session()->flash($key, [
				'title' 	=> $title,
				'message' 	=> $message, 
				'level'		=> $level
			]); 
	}

	/**
	 * return info flash message
	 * @param  [type] $title   [description]
	 * @param  [type] $message [description]
	 * @return [type]          [description]
	 */
	public function info($title, $message)
	{
		return $this->create($title, $message, 'info'); 		
	}

	/**
	 * return success flash message 
	 * @param  [type] $title   [description]
	 * @param  [type] $message [description]
	 * @return [type]          [description]
	 */
 	public function success($title, $message)
 	{
 		return $this->create($title, $message, 'success'); 
 		
 	}

 	/**
 	 * retunr error flash message
 	 * @param  [type] $title   [description]
 	 * @param  [type] $message [description]
 	 * @return [type]          [description]
 	 */
 	public function error($title, $message)
 	{
 		return $this->create($title, $message, 'error'); 

 	}

 	/**
 	 * [error description]
 	 * @param  [type] $title   [description]
 	 * @param  [type] $message [description]
 	 * @return [type]          [description]
 	 */
 	public function overlay($title, $message, $level='success')
 	{
 		return $this->create($title, $message, $level, 'flash_message_overlay'); 

 	}


}