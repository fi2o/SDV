<?php
class Pagination {
	
	private $base_uri			= ''; // La uri a donde se dirigiran los links.
	private $total_rows  		= ''; // El total de resultados devueltos en el query.
	private $per_page	 		= 10; // Numero de resultados por pagina.
	private $num_links			= 8; // Numero de links  a mostrar antes y despues de la pagina actual.
	private $cur_page	 		= 1; // El numero de la pagina actual.
	private $prev_link_text		= ''; // Texto del link "Atras".
	private $next_link_text		= ''; // Texto del link "Siguiente".
	private $box_id				= 'pag_box'; // El id del DIV que contiene los links.
	
	private function build_query($var='') {
		parse_str($_SERVER['QUERY_STRING'], $query_string_vars);
		$var = explode('=',$var);
		if (!empty($var)) {
			$query_string_vars[$var[0]] = $var[1];
		}
		$query_string = http_build_query($query_string_vars);
			
		return $query_string;
	}
	
	public function init($params = array()) {
		if (count($params) > 0) {
			foreach ($params as $key => $val) {
				if (isset($this->{$key})) {
					$this->{$key} = $val;
				}
			}		
		}
	}
	
	public function generate($params = array()) {
		if (count($params) > 0) {
			$this->init($params);		
		}
		
		// -------------------------------------------------------
		if ($this->total_rows > $this->per_page) {
			$output = '';
			
			$output.= '<div class="pagination-wrap" id="'. $this->box_id .'">';
			
			if($this->cur_page > 1){
				$output.= '<a class="prev-page page-control" href="'. $this->base_uri . $this->build_query('pag='. ($this->cur_page - 1)) .'">'. $this->prev_link_text .'</a>';
			}
			
			else{
				$output.= '<span class="prev-page page-control inactive">'. $this->prev_link_text .'</span>';
			}
			
			$num_pages = ceil($this->total_rows / $this->per_page);
			
			for ($i = 1; $i <= $num_pages; $i++) {
				if ($i == $this->cur_page) {
					/** Muestra la pagina actual */
					$output.= ' <span class="curr-page page-number">'.$i.'</span> ';
				} else {
					/** Muestra las paginas antecesoras */
					if ($i > ($this->cur_page - $this->num_links) && $i < $this->cur_page) {
						$output.= ' <a class="available-page page-number" href="'. $this->base_uri . $this->build_query("pag=$i").'">'.$i.'</a> ';
					}
					/** Muestra las paginas predecesoras */
					if ($i < ($this->cur_page + $this->num_links) && $i > $this->cur_page) {
						$output.= ' <a class="available-page page-number" href="'. $this->base_uri . $this->build_query("pag=$i").'">'.$i.'</a> ';
					}
				}
			}
			
			if ($this->cur_page < $num_pages) {
				$output.= '<a class="next-page page-control" href="'. $this->base_uri . $this->build_query('pag='. ($this->cur_page + 1)).'">'. $this->next_link_text .'</a>';
			}
			
			else{
				$output.= '<span class="next-page page-control inactive">'. $this->next_link_text .'</span>';
			}

			$output.= '</div>';
			
			return $output;
		}
	}
	
}
?>