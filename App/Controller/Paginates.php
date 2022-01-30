<?php

namespace App\Controller;

use App\Helpers\URI;
use App\Model\ListingModel;
use App\Tables\Builder\QueryBuilder;

class Paginates extends ListingModel {

    private $table;

    private $per;

    /**
     * @var string
     */
    private $currentPage = '';

    /**
     * @var int
     */
    private $currentPages = 1;

    /**
     * @var int
     */
    private $pages = 1;

    /**
     * @var QueryBuilder
     */
    private QueryBuilder $query;

    public function __construct(QueryBuilder $query, $per = 6)
    {
        $this->per = $per;
        $this->query = $query;
        $this->currentPage = URI::getInt('paginate', 1);
       
        $this->pages = ceil(count($this->query->execute()) / $this->per);

        if ($this->currentPage >= $this->pages) {
            $this->currentPage = $this->pages;
        }
    }

    /**
     * Nombre de produit par page
     * 
     * @return int
     */
    public function getPerPage (): int {
        return $this->per;
    }


    

 
    /**
     * @return array
     */
    public function getItems (): array {

        return $this->query
        ->offsets($this->offset())
        ->limit($this->per)
        ->execute();
       
      
    }

    /**
     * @return int
     */
    public function offset (): int {
        $offset = $this->per * ($this->currentPage - 1);
        return $offset < 0 ? $offset * (-1): $offset;
    }


    /**
     * Aller à la page précedente
     * 
     * @return string|null
     */
    public function previous (): ?string {
        $this->currentPage = $this->currentPage;
        $this->pages = $this->pages;

        
        if ($this->currentPage > 1 && $this->pages > 2) {
           $link = URI::params('paginate', ($this->currentPage - 1));
           return <<< HTML
           
            <a href="{$link}" class="link-paginate">&laquo; précedent </a>
            {$this->start()}
           HTML;
        }

        return null;
    }

    /**
     * lien de pagination
     * 
     * @return void
     */
    public function pagine (): void {
        
        if ($this->pages > 1 && $this->currentPage > 1) {
          
            $limit = 3;
            $intervalLimit = 10;
           
           if ($this->currentPage > $intervalLimit) {
                $linkVal = URI::params('paginate' , ($this->currentPage - $intervalLimit)); 
               echo <<< HTML
                 <a href="{$linkVal}" class="link-pagine">...</a>
               HTML;
           }

            for ($i = ($this->currentPage - $limit); $i <= ($this->currentPage - 1) ; $i++) {
                if ($i > 0) {
                    $links = URI::params('paginate' , $i); 
                    echo <<< HTML
                    <a href="{$links}" class="link-pagine">{$i}</a>
                    HTML;
                }
             
            }

            echo <<< HTML
            <span class="link-pagine" style="background: #000; color: #fff">{$this->currentPage}</span>
            HTML;

            for ($i = ($this->currentPage + 1); $i <= ($this->currentPage + $limit); $i++) {

                if ($i <= $this->pages) {
                    $links = URI::params('paginate' , $i); 
                    $active = ($this->currentPage == $i) ? 'active' : '';
                    echo <<< HTML
                    <a href="{$links}" class="link-pagine">{$i}</a>
                    HTML;
                }
                
            }

            if ($this->currentPage > $intervalLimit && $this->currentPage <= ($this->pages - $intervalLimit)) {
                $linkVal = URI::params('paginate' , ($this->currentPage + $intervalLimit)); 
               echo <<< HTML
                 <a href="{$linkVal}" class="link-pagine">...</a>
               HTML;
           }
        }
    }

    /**
     * Aller à la page suivante 
     * 
     * @return string|null
     */
    public function next (): ?string {
        $this->currentPage = $this->currentPage;
        $this->pages = $this->pages;
        $link = URI::params('paginate' ,($this->currentPage + 1));
        if(($this->pages > $this->currentPage && $this->currentPage <= $this->pages)){
            return <<< HTML
            {$this->end()}
             <a href="{$link}" class="link-paginate">suivant &raquo;</a>
             
            HTML;
        } 
        return null;
    }

    public function end (): string {
        $this->pages = $this->pages;
        $link = URI::params('paginate' ,($this->pages));
        return <<< HTML
        <a href="{$link}" class="link-paginate">fin</a>
       HTML;
    }

    /**
     * @return string|null
     */
    public function start (): ?string {
        $this->currentPage = $this->currentPage;
        $this->pages = $this->pages;
        if ($this->currentPage > 5 && $this->pages > 2) {
           $link = URI::params('paginate', (1));
           return <<< HTML
            <a href="{$link}" class="link-paginate">début</a>
           HTML;
        }
        return null;
    }
}