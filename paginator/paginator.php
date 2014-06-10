<?php

// ==================================================================
	//  Author: Ted Kappes (pesoto74@soltec.net)
	//	Web: 	http://tkap.org/paginator/
	//	Name: 	Paginator
	// 	Desc: 	Class to help make pagination more easy.
	//
	// 7/21/2003
	//
	//  Please send me a mail telling me what you think of Paginator
	//  and what your using it for. [ pesoto74@soltec.net]
	//
// ==================================================================
class Paginator {
				//all variables are pivate.
					var $previous;	
					var $current;
					var $next;
					var $page;
					var $total_pages;
					var $link_arr;
					var $range1;
					var $range2;
					var $num_rows;
					var $first;
					var $last;
					var $first_of;
					var $second_of;
					var $limit;
					var $prev_next;
					var $base_page_num;
					var $extra_page_num;
					var $total_items;
					var $pagename;
//========agregando un par de variables para el id, asignacion, tipo, materia, fechaini y fechafin..======================//
					var $idcol;
					var $asignacion;
					var $tipo;
					var $camara;
					var $tipoproy;
					var $materia;
					var $fechaini;
					var $fechafin;
 					var $get1;
 					var $get2;
 					var $get3;
 					var $get4;
 					var $get5;
 					var $get6;
 					var $get7;
 					var $get8;

//Creando funciones para obtener las variables en cada pagina del paginador//
		function getParamEstadmin($id_estado="",$mat="",$tipomateria="",$estadoadmin=""){
	$this->id_estado=$id_estado;
	$this->mat=$mat;
	$this->tipomateria=$tipomateria;
	$this->estadoadmin=$estadoadmin;
		}
		
		function getParamExpColaboradores($id="",$mat="")
		{
			$this->idcol=$id;
			$this->materia=$mat;
		}
		
		function getParamExp($id="",$asig="",$ti="",$mat="",$fini="",$ffin="")
		{
			$this->idcol=$id;
			$this->asignacion=$asig;
			$this->tipo=$ti;
			$this->materia=$mat;
			$this->fechaini=$fini;
			$this->fechafin=$ffin;
		}
		
		function getParameters($id="",$asig="",$ti="",$tip="",$mat="",$fini="",$ffin="")
		{
			$this->idcol=$id;
			$this->asignacion=$asig;
			$this->tipo=$ti;
			$this->tipoproy=$tip;
			$this->materia=$mat;
			$this->fechaini=$fini;
			$this->fechafin=$ffin;
		}

		function getParams($ti="",$mat="",$cam="",$jui="",$fini="",$ffin="")
		{
			$this->tipo=$ti;
			$this->materia=$mat;
			$this->camara=$cam;
			$this->juicio=$jui;
			$this->desde=$fini;
			$this->hasta=$ffin;
		}

		function getGet1()
		{
						$this->get1 = $this->idcol;
						return $this->get1;

		}

		function getGet2()
		{
						$this->get2 = $this->asignacion;
						return $this->get2;

		}

		function getGet3()
		{
						$this->get3 = $this->tipo;
						return $this->get3;

		}

		function getGet4()
		{
						$this->get4 = $this->materia;
						return $this->get4;

		}
		function getGet5()
		{
						$this->get5 = $this->fechaini;
						return $this->get5;

		}

		function getGet6()
		{
						$this->get6 = $this->fechafin;
						return $this->get6;

		}

		function getGet7()
		{
						$this->get7 = $this->tipoproy;
						return $this->get7;

		}

		function getGet8()
		{
						$this->get8 = $this->camara;
						return $this->get8;

		}
		function getGet9()
		{
						$this->get9 = $this->id_estado;
						return $this->get9;

		}
		function getGet10()
		{
						$this->get10 = $this->mat;
						return $this->get10;

		}
		function getGet11()
		{
						$this->get11 = $this->estadoadmin;
						return $this->get11;

		}
		function getGet12()
		{
						$this->get12 = $this->tipomateria;
						return $this->get12;

		}


//=========================================================================================================//

			//Constructor for Paginator.  Takes the current page and the number of items
			//in the source data and sets the current page ($this->page) and the total
			//items in the source ($this->total_items).
			function Paginator($page,$num_rows) 
			{ 
			    if(!$page)
					{
			    $this->page=1;
					} else {
				  $this->page=$page;
				  }
				  $this->num_rows=$num_rows;
					$this->total_items = $this->num_rows;
			}
			//Takes  $limit and sets $this->limit. Calls private mehods
			//setBasePage() and setExtraPage() which use $this->limit.
			function set_Limit($limit=5)
			{
			    $this->limit = $limit;
					$this->setBasePage();
					$this->setExtraPage();
			}
			//This method creates a number that setExtraPage() uses to if there are
			//and extra pages after limit has divided the total number of pages.
			function setBasePage()
			{
			    $div=$this->num_rows/$this->limit;	
				  $this->base_page_num=floor($div);
			}
			function setExtraPage()
			{
				  $this->extra_page_num=$this->num_rows - ($this->base_page_num*$this->limit);
			}
			//Used in making numbered links.  Sets the number of links behind and 
			//ahead of the current page.  For example if there were a possiblity of
			//20 numbered links and this was set to 5 and the current link was 10
			//the result would be this 5 6 7 8 9 10 11 12 13 14 15.
			
			function set_Links($prev_next=5)
			{
			    $this->prev_next = $prev_next;
			}
			//method to get the total items.
			function getTotalItems()
			{
			$this->total_items = $this->num_rows;
			return $this->total_items;
			}
			//method to get the base number to use in queries and such.
			function getRange1()
			{
			    $this->range1=($this->limit*$this->page)-$this->limit;	
			    return $this->range1;
			}
			//method to get the offset.
			function getRange2()
			{
			    if($this->page==$this->base_page_num + 1)
 	        {
	        $this->range2=$this->extra_page_num;
				  } else { $this->range2=$this->limit;
					}
				  return $this->range2;
			}
			//method to get the first of number as in 5 of .
			function getFirstOf()
			{
			    $this->first_of=$this->range1 + 1;
			    return $this->first_of;
			}
			//method to get the second number in a series as in 5 of 8.
			function getSecondOf()
			{
			    if($this->page==$this->base_page_num + 1)
 	        {
				  $this->second_of=$this->range1 + $this->extra_page_num;
				  } else { $this->second_of=$this->range1 + $this->limit;
					       }
				  return $this->second_of;
			}
			//method to get the total number of pages.
			function getTotalPages()
			{
			    if($this->extra_page_num)
					{
					$this->total_pages = $this->base_page_num + 1;
					} else {
				  $this->total_pages = $this->base_page_num;
					       }
					return $this->total_pages;
			}
			//method to get the first link number.
			function getFirst()
			{
			    $this->first=1;
			    return $this->first;
			}
			//method to get the last link number.
			function getLast()
			{
			    if($this->page == $this->total_pages)
					{
					$this->last=0;
					}else { $this->last = $this->total_pages;
					      }
					return $this->last;  
			}
			function getPrevious()
			{
			    if($this->page > 1)
	        {
	        $this->previous = $this->page - 1;
	        }
					return $this->previous;
			}
			//method to get the number of the link previous to the current link.
			function getCurrent()
			{
			    $this->current = $this->page;
					return $this->current;
			}
			//method to get the current page name. Is mostly used in links to the next 
			//page.
			function getPageName()
			{
			    $this->pagename = $_SERVER['PHP_SELF'];;
					return $this->pagename;
			}
			//method to get the number of the link after the current link.
			function getNext()
			{   
			    $this->getTotalPages();
			    if($this->total_pages != $this->page)
				  {
				  $this->next = $this->page + 1;
				  }
					return $this->next;
			}
			//method that returns an array of the numbered links that should be 
			//displayed.   
			function getLinkArr()
      {
       //gets the top range   
       $top = $this->getTotalPages()- $this->getCurrent();
       if($top <= $this->prev_next)
         {
         $top = $top;
	       $top_range = $this->getCurrent() + $top;
	       } else { $top = $this->prev_next; $top_range = $this->getCurrent() + $top; }
				 
				//gets the bottom range
	     $bottom = $this->getCurrent() -1;
       if($bottom <= $this->prev_next)
	       {
	       $bottom = $bottom;
	       $bottom_range = $this->getCurrent() - $bottom;
	       } else { $bottom = $this->prev_next; $bottom_range = $this->getCurrent() - $bottom; } 
	 
	       $j=0;
       foreach(range($bottom_range, $top_range) as $i)
	       {
	       $this->link_arr[$j] = $i;
		     $j++;
		     }
		   return $this->link_arr;
      }
			
	}//ends Paginator class
	?>	
