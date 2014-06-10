<?php 
// ==================================================================
	//  Author: Ted Kappes (pesoto74@soltec.net)
	//	Web: 	http://tkap.org/paginator/
	//	Name: 	Paginator_html
	// 	Desc: 	Class extension for Paginator. Adds pre-made link sets.
	//
	// 7/21/2003
	//
	//  Please send me a mail telling me what you think of Paginator
	//  and what your using it for. [ pesoto74@soltec.net]
	//
// ==================================================================

      
			class Paginator_html5 extends Paginator { 
			
			  //outputs a link set like this 1 of 4 of 25 First | Prev | Next | Last |              
			 function firstLast()
			  {				

			 if($this->getCurrent()==1)
		         {
		         $first = "Primero | ";
		         } else { $first="<a href=\"" . $this->getPageName() ."?id_estado=".$this->getGet9()."&mat=".$this->getGet10()."&estadoadmin=".$this->getGet11()."&tipomateria=".$this->getGet12()."&page=" . $this->getFirst() . "\">Primero</a> |"; }  

		         if($this->getPrevious())
		         {
		         $prev = "<a href=\"" . $this->getPageName() ."?id_estado=".$this->getGet9()."&mat=".$this->getGet10()."&estadoadmin=".$this->getGet11()."&tipomateria=".$this->getGet12()."&page=" . $this->getPrevious() . "\">Anterior</a> | ";
		         } else { $prev="Anterior | "; }
		
		         if($this->getNext())
		         {
		         $next = "<a href=\"" . $this->getPageName() ."?id_estado=".$this->getGet9()."&mat=".$this->getGet10()."&estadoadmin=".$this->getGet11()."&tipomateria=".$this->getGet12()."&page=" . $this->getNext() . "\">Siguiente</a> | ";
		         } else { $next="Siguiente | "; }
				
		         if($this->getLast())
		         {
		         $last = "<a href=\"" . $this->getPageName() ."?id_estado=".$this->getGet9()."&mat=".$this->getGet10()."&estadoadmin=".$this->getGet11()."&tipomateria=".$this->getGet12()."&page=" . $this->getLast() . "\">&Uacute;ltimo</a>&nbsp;";
		         } else { $last="&Uacute;ltimo&nbsp;"; }
		         echo "\t<tr class='grid_footer'>\n\t\t<td align = 'right' colspan='3'><table width = '100%' cellspacing='0' cellpadding='0' border='0' align = 'right'>\n\t\t<tr class='grid_footer'>\n\t\t\t<td width = '35%'></td>\n\t\t\t<td width = '30%' align = 'center'>".$this->getFirstOf() . " al " .$this->getSecondOf() . " de " . $this->getTotalItems() . " </td>\n";
	 	         echo "\t\t\t<td width = '35%' align = 'right'>". $first . " " . $prev . " " . $next . " " . $last . "</td>\n\t\t</tr>\n\t\t</table>\n\t</tr>\n</table>\n";
			} 
				//outputs a link set like this Previous 1 2 3 4 5 6 Next   
				function previousNext()
				{
					if($this->getPrevious())
		        	{
			        echo "<a href=\"" . $this->getPageName() . "?page=" . $this->getPrevious() . "\">Previous</a> ";
			        }
						$links = $this->getLinkArr();
			        foreach($links as $link)
	                	{
		          	if($link == $this->getCurrent())
					    {
					     echo " $link ";
					    } else { echo "<a href=\"" . $this->getPageName() . "?page=$link\">" . $link . "</a> ";
					    }
			        } 
				if($this->getNext())
			        {
		         	 echo "<a href=\"" . $this->getPageName() . "?page=" . $this->getNext() . "\">Next</a> ";
		          	}
		        }  
	}//ends class


         ?>
				 
