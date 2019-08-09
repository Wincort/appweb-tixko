<!-- language: php -->
<?php
error_reporting(0); // disable the annoying error report
class Paginacion
{
   // Properties
   var $current_page;
   var $amount_of_data;
   var $page_total;
   var $row_per_page;

   // Constructor
   function Paginacion($rows_per_page)
   {
      $this->row_per_page = $rows_per_page;

      $this->current_page = $_GET['page'];
      if (empty($this->current_page))
         $this->current_page = 1;
   }

   function set_CantidadFilas($amount)
   {
      $this->amount_of_data = $amount;
      $this->page_total= 
         ceil($amount / $this->row_per_page);
   }   

   function get_FilaInicial()
   {
      $starting_record = ($this->current_page - 1) * 
                     $this->row_per_page;
      return $starting_record;               
   }   

   function MostrarLinksPaginas()
   {
      if ($this->page_total > 1)
      {
        //print("<center><div class=\"notice\"><span class=\"note\">Páginas: ");
        for ($hal = 1; $hal <= $this->page_total; $hal++)
        {
           if ($hal == $this->current_page)
              //echo "$hal | ";
              echo "<li class='active'><a href=\"#\">$hal</a></li>";
           else   
              {
                 $script_name = $_SERVER['PHP_SELF'];

                 //echo "<a href=\"$script_name?page=$hal\">$hal</a> |\n";
                 echo "<li><a href=\"$script_name?page=$hal\">$hal</a></li>\n";
              }
        }   
      }
   }
   function MostrarLinksPaginasBuscador($condicion)
   {
      if ($this->page_total > 1)
      {
        for ($hal = 1; $hal <= $this->page_total; $hal++)
        {
           if ($hal == $this->current_page)
              echo "<li class='active'><a href=\"#\">$hal</a></li>";
           else   
              {
                 $script_name = $_SERVER['PHP_SELF'];
                 echo "<li><a href=\"$script_name?$condicion&page=$hal\">$hal</a></li>\n";
              }
        }   
      }
   }    
}
?>