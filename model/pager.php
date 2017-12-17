<?php
/**
* 
*/
class Pagination
{
	public $total_tintuc,
			$total_page,
			$current_page,
			$limit_link;
	public $limit;		

	public function __construct($total_tintuc,$current_page=1,$limit=1,$limit_link=1)
	{
		$this->total_tintuc = $total_tintuc;
		$this->limit = $limit;
		if($limit_link%2==0)
		{
			$limit_link += 1;
		}
		$this->limit_link = $limit_link;
		$this->current_page = $current_page;
		$this->total_page = ceil($total_tintuc/$limit);
	}

	public function get_limit()
	{
		return $this->limit;
	}
	public function get_current_page()
	{
		return $this->current_page;
	}
	public function show_html()
	{
		$html = '';
		if($this->total_page > 1)
		{
			$actual_link = isset($_SERVER['https'])?'https':'http'."://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
			if(isset($_GET['page']))
			{
				if((int)($_GET['page']) >= 10)
				{
					$actual_link = substr($actual_link,0,-8);
				}
				else
				{
					$actual_link = substr($actual_link,0,-7);	
				}
			}
			$start = '';
			$prev = '';
			if($this->current_page > 1)
			{
				$start = '<li><a href="'.$actual_link.'/page/1">Quay về</a></li>';
				$prev = '<li><a href="'.$actual_link.'/page/'.($this->current_page-1).'">&laquo;</a></li>';
			}
			$end = '';
			$next = '';
			if($this->current_page < $this->total_page)
			{
				$next = '<li><a href="'.$actual_link.'/page/'.($this->current_page+1).'">&raquo;</a></li>';
				$end = '<li><a href="'.$actual_link.'/page/'.$this->total_page.'">Tới Cuối</a></li>';
			}
			if($this->limit_link < $this->total_page)
			{
				if($this->current_page == 1)
				{
					$startPage = 1;
					$endPage = $this->limit_link;
				}
				else if($this->current_page == $this->total_page)
				{
					$startPage = $this->total_page - $this->limit_link;
					$endPage = $this->total_page;
				}
				else
				{
					$startPage = $this->current_page - ($this->limit_link-1)/2;
					$endPage = $this->current_page + ($this->limit-1)/2;
					if($startPage<1)
					{
						$endPage = $endPage + 1;
						$startPage = 1;
					}
					if($endPage>$this->total_page)
					{
						$endPage = $this->total_page;
						$startPage = $endPage - $this->limit_link + 1;
					}
				}
			}
			else
			{
				$startPage = 1;
				$endPage = $this->total_page;
			}
			//list
			$list = '';
			for ($i=$startPage; $i <= $endPage; $i++) { 
				if($this->current_page == $i)
				{
					$list .= '<li class="active"><a>'.$i.'</a></li>';
				}
				else
				{
					$list .= '<li><a href="'.$actual_link.'/page/'.$i.'">'.$i.'</a></li>';
				}
			}
			$html = '<ul class="pagination">'.$start.$prev.$list.$next.$end.'</ul>';
		}
		return $html;
	}
}
?>