<?php

class Review
{
	private $data = array();

	public function __construct($row)
	{
		$this->data = $row;
	}

    /**
     * Вывод разметки
     *
     * @return string
     */
	public function markup()
	{
		// устанавливаем alias
		$d = &$this->data;
		
		// Конвертируем время в UNIX timestamp:
		$d['created_at'] = strtotime($d['created_at']);
		
		return '
			<div class="review">
				<div class="date" title="Добавлен '.date('H:i \o\n d M Y',$d['created_at']).'">'.date('d M Y - H:i',$d['created_at']).'</div>
				<p>Имя: '.$d['name'].'</p>
				<p>Отзыв: '.$d['text'].'</p>
			</div>
		';
	}
}

?>